<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_model');
		$this->load->helper('my_helper');
		$this->load->library('upload');	
		$this->load->library('form_validation'); // Memuat pustaka form_validation
		if ($this->session->userdata('logged_in')  != true && $this->session->userdata('role') != 'karyawan') {
			redirect(base_url() . 'auth');
		}
	}
	public function upload_img($value)
    {
        $kode = round(microtime(true) * 1000);
        $config['upload_path'] = './images/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['fle_name'] = $kode;
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($value)) {
            return [false, ''];
        } else {
            $fn = $this->upload->data();
            $nama = $fn['file_name'];
            return [true, $nama];
        }
    }
//karyawan
	public function index()
	{
		
        $data['users'] = $this->m_model->get_data('users')->result();
        $data['absensi'] = $this->m_model->get_data('absensi')->result();
        $this->load->view('karyawan/index', $data);
	}
	

	public function history() {
        if ($this->session->userdata('role') === 'karyawan') {
            // Set zona waktu ke 'Asia/Jakarta'
            date_default_timezone_set('Asia/jakarta');
    
            $data['absensi'] = $this->m_model->get_data('absensi')->result();
            $this->load->view('karyawan/history', $data);
        } else {
            redirect('other_page');
        }
    }
    

    public function menu_absen() {
        if ($this->session->userdata('role') === 'karyawan') {
            $user_id = $this->session->userdata('id'); // Ambil id pengguna yang sedang login
            $this->form_validation->set_rules('kegiatan', 'Kegiatan', 'required');
    
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('karyawan/menu_absen');
            } else {

                date_default_timezone_set('Asia/Jakarta');
                $jam_masuk = date('H:i:s');

                $data = array(
                    'id_karyawan' => $user_id, // Tetapkan id_karyawan berdasarkan pengguna yang sedang login
                    'kegiatan' => $this->input->post('kegiatan'),
                    'tanggal' => date('Y-m-d'),
                    'jam_masuk' => $jam_masuk,
                    'status' => 'Not Done'
                );
    
                // Menambahkan absensi dan mendapatkan ID data yang baru ditambahkan
                $new_absensi_id = $this->m_model->addAbsensi($data);
    
                // Redirect ke halaman history_absen dengan membawa ID baru
                redirect('karyawan/history/' . $new_absensi_id);
            }
        } else {
            redirect('karyawan/menu_absen');
        }
    }

    public function menu_izin() {
        if ($this->session->userdata('role') === 'karyawan') {
            $user_id = $this->session->userdata('id');
            $this->form_validation->set_rules('keterangan', 'Keterangan Izin', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('karyawan/menu_izin');
            } else {
                $data = array(
                    'id_karyawan' => $user_id,
                    'keterangan' => $this->input->post('keterangan'), // Mengambil data dari form input
                );

                // Memanggil fungsi untuk menambahkan izin
                $this->m_model->addIzin($data);

                // Redirect ke halaman history_absen
                redirect('karyawan/history');
            }
        } else {
            redirect('other_page');
        }
    }

    
    
    
    public function pulang($absen_id) {
        if ($this->session->userdata('role') === 'karyawan') {
            $this->m_model->setAbsensiPulang($absen_id);
    
            // Set pesan sukses
            $this->session->set_flashdata('success', 'Jam pulang berhasil diisi.');
    
            
    
            redirect('karyawan/history');
        } else {
            redirect('karyawan/history');
        }
    }
	public function hapus_history($id)
	{
		$this->m_model->delete('absensi', 'id', $id);
		$this->session->set_flashdata('success', 'History berhasil dihapus!');
		redirect(base_url('karyawan/history'));
	}
	public function profile()
    {
        $this->load->view('karyawan/profile');
    }


    
    public function edit_foto()
    {
        $config['upload_path'] = './assets/images/user/'; // Lokasi penyimpanan gambar di server
        $config['allowed_types'] = 'jpg|jpeg|png'; // Tipe file yang diizinkan
        $config['max_size'] = 5120; // Maksimum ukuran file (dalam KB)

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('userfile')) {
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];

            // Update nama file gambar baru ke dalam database untuk user yang sesuai
            $user_id = $this->session->userdata('id'); // Ganti ini dengan cara Anda menyimpan ID user yang sedang login
            $current_image = $this->m_model->get_current_image($user_id); // Dapatkan nama gambar saat ini

            if ($current_image !== 'User.png') {
                // Hapus gambar saat ini jika bukan 'User.png'
                unlink('./images/user/' . $current_image);
            }

            $this->m_model->update_image($user_id, $file_name); // Gantilah 'm_model' dengan model Anda

            // Redirect atau tampilkan pesan keberhasilan
            redirect('karyawan/profile'); // Gantilah dengan halaman yang sesuai
        } else {
            $error = array('error' => $this->upload->display_errors());
            // Tangani kesalahan unggah gambar
        }
    }
}
?>