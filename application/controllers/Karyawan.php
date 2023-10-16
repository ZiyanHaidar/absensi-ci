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
	public function upload_image($field_name)
    {
        $config['upload_path'] = './images/user/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 30000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($field_name)) {
            $error = array('error' => $this->upload->display_errors());
            return array(false, $error);
        } else {
            $data = $this->upload->data();
            $file_name = $data['file_name'];
            return array(true, $file_name);
        }
    }
//karyawan
	public function index()
	{
		
        $data['users'] = $this->m_model->get_data('users')->result();
        $data['absensi'] = $this->m_model->get_data('absensi')->result();
        $this->load->view('karyawan/index', $data);
	}
	public function edit_profile()
	{
		
        $data['users'] = $this->m_model->get_data('users')->result();
              $this->load->view('karyawan/edit_profile', $data);
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
            redirect('karyawan/menu_izin');
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
	public function profile() {
        $data['users'] = $this->m_model->get_by_id('users', 'id', $this->session->userdata('id'));
        $this->load->view('karyawan/profile', $data);
    }

    public function ubah_absensi($absen_id) {
        if ($this->session->userdata('role') === 'karyawan') {
            // Mengambil data absensi berdasarkan ID yang diberikan
            $absensi = $this->m_model->getAbsensiById($absen_id);

            // Periksa apakah data absensi ditemukan
            if ($absensi) {
                // Mengecek apakah pengguna mengirimkan formulir perubahan
                if ($this->input->post()) {
                    // Lakukan validasi terhadap input
                    $this->form_validation->set_rules('kegiatan', 'Kegiatan', 'required');
                    $this->form_validation->set_rules('jam_masuk', 'Jam Masuk', 'required');

                    if ($this->form_validation->run() === TRUE) {
                        // Dapatkan data input pengguna
                        $kegiatan = $this->input->post('kegiatan');
                        $jam_masuk = $this->input->post('jam_masuk');

                        // Lakukan pembaruan data absensi
                        $data = array(
                            'kegiatan' => $kegiatan,
                            'jam_masuk' => $jam_masuk
                        );

                        $this->m_model->updateAbsensi($absen_id, $data);

                        // Set pesan sukses
                        $this->session->set_flashdata('success', 'Data absensi berhasil diubah.');

                        // Redirect kembali ke halaman riwayat absen
                        redirect('karyawan/history');
                    }
                }

                $data['absensi'] = $absensi;
                $data['absen_id'] = $absen_id;
                $this->load->view('karyawan/ubah_absensi', $data);

            } else {
                // Data absensi tidak ditemukan, tampilkan pesan error
                show_error('Data absensi tidak ditemukan.', 404, 'Data Tidak Ditemukan');
            }
        } else {
            // Pengguna bukan karyawan, redirect ke halaman lain
            redirect('karyawan/ubah_absensi');
        }
    }
    public function aksi_edit_profile()
    {
        
        if ($image[0] == false) {
            $password_baru = $this->input->post('password_baru');
            $konfirmasi_password = $this->input->post('konfirmasi_password');
            $email = $this->input->post('email');
            $username = $this->input->post('username');
            $nama_depan = $this->input->post('nama_depan');
            $nama_belakang = $this->input->post('nama_belakang');
            $data = [
                'image' => 'User.png', // Ganti 'foto' menjadi 'image'
                'email' => $email,
                'username' => $username,
                'nama_depan' => $nama_depan,
                'nama_belakang' => $nama_belakang,
            ];
            

            if (!empty($password_baru)) {
                if ($password_baru === $konfirmasi_password) {
                    $data['password'] = md5($password_baru);
                } else {
                    $this->session->set_flashdata('message', 'Password baru dan Konfirmasi password harus sama');
                    redirect(base_url('karyawan/profile'));
                }
            }
            $this->session->set_userdata($data);
            $update_result = $this->m_model->update('users', $data, ['id' => $this->session->userdata('id')]);

            if ($update_result) {
                redirect(base_url('karyawan/profile'));
            } else {
                redirect(base_url('karyawan/profile'));
            }
        } else {
            $password_baru = $this->input->post('password_baru');
            $konfirmasi_password = $this->input->post('konfirmasi_password');
            $email = $this->input->post('email');
            $username = $this->input->post('username');
            $nama_depan = $this->input->post('nama_depan');
            $nama_belakang = $this->input->post('nama_belakang');
            $data = [
                'foto' => $image[1],
                'email' => $email,
                'username' => $username,
                'nama_depan' => $nama_depan,
                'nama_belakang' => $nama_belakang,
            ];
            if (!empty($password_baru)) {
                if ($password_baru === konfirmasi_password) {
                    $data['password'] = md5($password_baru);
                } else {
                    $this->session->set_flashdata('message', 'Password baru dan Konfirmasi password harus sama');
                    redirect(base_url('karyawan/profile'));
                }
            }
            $this->session->set_userdata($data);
            $update_result = $this->m_model->update('users', $data, ['id' => $this->session->userdata('id')]);

            if ($update_result) {
                redirect(base_url('karyawan/profile'));
            } else {
                redirect(base_url('karyawan/profile'));
            }
        }
    }
}
?>