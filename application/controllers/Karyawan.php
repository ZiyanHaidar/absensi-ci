<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_model');
		$this->load->helper('my_helper');
        $this->load->library('session');
        $this->load->library('upload');
		$this->load->library('form_validation'); // Memuat pustaka form_validation
		if ($this->session->userdata('logged_in')  != true && $this->session->userdata('role') != 'karyawan') {
			redirect(base_url() . 'auth');
		}
	}
	
//karyawan
	public function index()
	{
        $id_karyawan = $this->session->userdata('id');
		$data['absensi'] = $this->m_model->get_absensi_by_karyawan($id_karyawan);
		$data['absensi_count'] = count($data['absensi']);
        $data['total_absen'] = $this->m_model->get_absen('absensi', $this->session->userdata('id'))->num_rows();
        $data['total_izin'] = $this->m_model->get_izin('absensi', $this->session->userdata('id'))->num_rows();
        $data['akun'] = $this->m_model->get_by_id('users', 'id', $this->session->userdata('id'))->result();
        $this->load->view('karyawan/index', $data);
	}
	
	public function history() {
        if ($this->session->userdata('role') === 'karyawan') {
            // Set zona waktu ke 'Asia/Jakarta'
            date_default_timezone_set('Asia/jakarta');
    
            $data['absensi'] = $this->m_model->get_data('absensi')->result();
            $data['akun'] = $this->m_model->get_by_id('users', 'id', $this->session->userdata('id'))->result();
            $this->load->view('karyawan/history', $data);
        } else {
            redirect('other_page');
        }
    }
	public function menu_absen() {
    
            $data['absensi'] = $this->m_model->get_data('absensi')->result();
            $data['akun'] = $this->m_model->get_by_id('users', 'id', $this->session->userdata('id'))->result();
            $this->load->view('karyawan/menu_absen', $data);
    }
    
    public function aksi_menu_absen() {
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
                    'date' => date('Y-m-d'),
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
    
        $data['absensi'] = $this->m_model->get_data('absensi')->result();
        $data['akun'] = $this->m_model->get_by_id('users', 'id', $this->session->userdata('id'))->result();
        $this->load->view('karyawan/menu_izin', $data);
}

    public function aksi_menu_izin() {
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

                    if ($this->form_validation->run() === TRUE) {
                        // Dapatkan data input pengguna
                        $kegiatan = $this->input->post('kegiatan');
    
                        // Lakukan pembaruan data absensi
                        $data = array(
                            'kegiatan' => $kegiatan
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
    public function profile()
    {
        $data['akun'] = $this->m_model->get_by_id('users', 'id', $this->session->userdata('id'))->result();
        $this->load->view('karyawan/profile', $data);
    }

    public function edit_profile()
	{
		$password_lama = $this->input->post('password_lama');
		$password_baru = $this->input->post('password_baru');
		$konfirmasi_password = $this->input->post('konfirmasi_password');
		$email = $this->input->post('email');
		$username = $this->input->post('username');
		$nama_depan = $this->input->post('nama_depan');
		$nama_belakang = $this->input->post('nama_belakang');

		$data = array(
			'email' => $email,
			'username' => $username,
			'nama_depan' => $nama_depan,
			'nama_belakang' => $nama_belakang,
		);

		$stored_password = $this->m_model->getPasswordById($this->session->userdata('id')); // Ganti dengan metode sesuai dengan struktur database Anda
        if (md5($password_lama) != $stored_password) {
            $this->session->set_flashdata('kesalahan_password_lama', 'Password lama yang dimasukkan salah');
            redirect(base_url('karyawan/profile'));
        } else {
            if (!empty($password_baru)) {
                if ($password_baru === $konfirmasi_password) {
                    $data['password'] = md5($password_baru);
                    $this->session->set_flashdata('ubah_password', 'Berhasil mengubah password');
                } else {
                    $this->session->set_flashdata('kesalahan_password', 'Password baru dan Konfirmasi password tidak sama');
                    redirect(base_url('karyawan/profile'));
                }
            }
        }

		$this->session->set_userdata($data);
		$update_result = $this->m_model->update_data('users', $data, array('id' => $this->session->userdata('id')));

		if ($update_result) {
			$this->session->set_flashdata('update_user', 'Data berhasil diperbarui');
			redirect(base_url('karyawan/profile'));
		} else {
			$this->session->set_flashdata('gagal_update', 'Gagal memperbarui data');
			redirect(base_url('karyawan/profile'));
		}
	}

    public function edit_image()
    {
        $image = $_FILES['image']['name'];
        $image_temp = $_FILES['image']['tmp_name'];

        // Jika ada image yang diunggah
        if ($image) {
            $kode = round(microtime(true) * 1000);
            $file_name = $kode . '_' . $image;
            $upload_path = './images/user/' . $file_name;
            $this->session->set_flashdata('berhasil_ubah_foto', 'Foto berhasil diperbarui.');
            if (move_uploaded_file($image_temp, $upload_path)) {
                // Hapus image lama jika ada
                $old_file = $this->m_model->get_karyawan_image_by_id($this->input->post('id'));
                if ($old_file && file_exists('./images/user/' . $old_file)) {
                    unlink('./images/user/' . $old_file);
                }

                $data = [
                    'image' => $file_name
                ];
            } else {
                // Gagal mengunggah image baru
                redirect(base_url('karyawan/ubah_image/' . $this->input->post('id')));
            }
        } else {
            // Jika tidak ada image yang diunggah
            $data = [
                'image' => 'User.png'
            ];
        }

        // Eksekusi dengan model ubah_data
        $eksekusi = $this->m_model->ubah_data('users', $data, array('id' => $this->input->post('id')));

        if ($eksekusi) {
            redirect(base_url('karyawan/profile'));
        } else {
            redirect(base_url('karyawan/ubah_image/' . $this->input->post('id')));
        }
    }

 
}
?>