<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_model');
		$this->load->helper('my_helper');
		$this->load->library('upload');	
		if ($this->session->userdata('logged_in')  != true && $this->session->userdata('role') != 'admin') {
			redirect(base_url() . 'auth');
		}
	}
	// admin
	public function index()
	{
		$data['mapel'] = $this->m_model->get_data('mapel')->num_rows();
		$data['siswa'] = $this->m_model->get_data('siswa')->num_rows();
		$data['guru'] = $this->m_model->get_data('guru')->num_rows();
		$data['kelas'] = $this->m_model->get_data('kelas')->num_rows();
		$this->load->view('admin/index', $data);
	}
	public function upload_img($value)
{
    $kode = round(microtime(true) * 1000);
    $config['upload_path'] = './images/siswa/';
    $config['allowed_types'] = 'jpg|png|jpeg';
    $config['max_size'] = '30000';
    $config['file_name'] = $kode;
    
    $this->load->library('upload', $config); // Load library 'upload' with config
    
    if (!$this->upload->do_upload($value)) {
        return array(false, '');
    } else {
        $fn = $this->upload->data();
        $nama = $fn['file_name'];
        return array(true, $nama);
    }
}

	//from untuk siswa
	public function siswa()
	{
		$data['siswa'] = $this->m_model->get_data('siswa')->result();
		$this->load->view('admin/siswa', $data);
	}
	public function tambah_siswa()
	{
		$data['kelas'] = $this->m_model->get_data('kelas')->result();
		$this->load->view('admin/tambah_siswa', $data);
	}
	public function aksi_tambah_siswa()
  {
    $file_name = $_FILES['foto']['name'];
    $file_temp = $_FILES['foto']['tmp_name'];
    $kode = round(microtime(true) * 1000);
    $file_name = $kode . '_' . $file_name;
    $upload_path = './images/siswa/' . $file_name;

    if (move_uploaded_file($file_temp, $upload_path)) {
      $data = [
        'foto' => $file_name,
        'nama_siswa' => $this->input->post('nama'),
        'nisn' => $this->input->post('nisn'),
        'gender' => $this->input->post('gender'),
        'id_kelas' => $this->input->post('kelas'),
      ];
      $this->m_model->tambah_data('siswa', $data);
      redirect(base_url('admin/siswa'));
    } else {
      $data = [
        'foto' => 'User.png',
        'nama_siswa' => $this->input->post('nama'),
        'nisn' => $this->input->post('nisn'),
        'gender' => $this->input->post('gender'),
        'id_kelas' => $this->input->post('kelas'),
      ];
      $this->m_model->tambah_data('siswa', $data);
      redirect(base_url('admin/siswa'));
    }
  }	
	
	public function ubah_siswa($id)
	{
		$data['siswa'] = $this->m_model->get_by_id('siswa', 'id_siswa', $id)->result();
		$data['kelas'] = $this->m_model->get_data('kelas')->result();
         $this->load->view('admin/ubah_siswa', $data);
	}
	public function aksi_ubah_siswa()
	{
		$foto = $_FILES['foto']['name'];
		$foto_temp = $_FILES['foto']['tmp_name'];

		// Jika ada foto yang diunggah
		if ($foto) {
			$kode = round(microtime(true) * 1000);
			$file_name = $kode . '_' . $foto;
			$upload_path = './images/siswa/' . $file_name;

			if (move_uploaded_file($foto_temp, $upload_path)) {
				// Hapus foto lama jika ada
				$old_file = $this->m_model->get_siswa_foto_by_id($this->input->post('id_siswa'));
				if ($old_file && file_exists('./images/siswa/' . $old_file)) {
					unlink('./images/siswa/' . $old_file);
				}

				$data = [
					'foto' => $file_name,
					'nama_siswa' => $this->input->post('nama'),
					'nisn' => $this->input->post('nisn'),
					'gender' => $this->input->post('gender'),
					'id_kelas' => $this->input->post('kelas'),
				];
			} else {
				// Gagal mengunggah foto baru
				redirect(base_url('admin/ubah_siswa/' . $this->input->post('id_siswa')));
			}
		} else {
			// Jika tidak ada foto yang diunggah
			$data = [
				'nama_siswa' => $this->input->post('nama'),
				'nisn' => $this->input->post('nisn'),
				'gender' => $this->input->post('gender'),
				'id_kelas' => $this->input->post('kelas'),
			];
		}

		// Eksekusi dengan model ubah_data
		$eksekusi = $this->m_model->ubah_data('siswa', $data, array('id_siswa' => $this->input->post('id_siswa')));

		if ($eksekusi) {
			redirect(base_url('admin/siswa'));
		} else {
			redirect(base_url('admin/ubah_siswa/' . $this->input->post('id_siswa')));
		}
	}
	// hapus 
	public function hapus_siswa($id)
	{
		$siswa = $this->m_model->get_by_id('siswa', 'id_siswa', $id)->row();
		if($siswa) {
			if ($siswa->foto !== 'User.png') {
				$file_path = './images/siswa/' . $siswa->foto;

				if (file_exists($file_path)) {

					if (unlink($file_path)) {
						// hapus file berhasil menggunakan model delete
						$this->m_model->deelete('siswa', 'id_siswa',$id);
						redirect(base_url('admin/siswa'));
					} else {
						//gagal menghapus file
						echo "Gagal menghapus file.";
					}
				} else {
					//file tidak ditemukan
					echo "File tidak ditemukan.";
				}
			} else {
				//Tanpa hapus file 'User.png'
				$this->m_model->delete('siswa', 'id_siswa', $id);
				redirect(nase_url('admin/siswa'));
			}
		} else {
			//Siswa tidak ditemukan
			echo "Siswa tidak ditemukan.";
		}
	}

	public function akun()
	{
		$data['user'] = $this->m_model->get_by_id('admin', 'id', $this->session->userdata('id'))->result();
		$this->load->view('admin/akun', $data);
	}
// from untuk ubah akun
public function aksi_ubah_akun()
 {
	$passswod_baru = $this->input->post('password_baru');
	$konfirmasi_password = $this->input->post('konfirmasi_password');
	$email = $this->input->post('email');
	$username = $this->input->post('username');

	//data yg akan diubah
	$data = [
		'email'=> $email,
		'username'=> $username,
	];

	//kondisi jika ada password baru
	if (!empty($password_baru)) {
		//pastikan password baru dan konfirmasi password sama
		if ($password_baru === $konfirmasi_password){
			//wadah password baru
			$data['password'] = md5($password_baru);
		} else {
			$this->session->set_flashdata('message', 'Password baru dan konfirmasi password harus sama');
			redirect(base_url('admin/akun'));
		}
	}

	//untuk melakukan pembaruan data
	$this->session->set_userdata($data);
	$update_result = $this->m_model->ubah_data('admin', $data, array('id' => $this->session->userdata('id')));

	if ($update_result) {
		redirect(base_url('admin/akun'));
	} else {
		redirect(base_url('admin/akun'));
	}
  }
 

}
?>