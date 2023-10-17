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
	
//karyawan
	public function index()
	{
        $this->load->library('pagination');
        $config = array(
            'base_url' => site_url('karyawan/index'),
            'total_rows' => $this->m_model->count_absen(),
            'per_page' => 10,
            'num_links' => 4,
            'use_page_numbers' => TRUE,
        );
        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</div>';
        
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
        $data['data_keseluruhan'] = $this->m_model->get_absen_page($config['per_page'], ($page - 1) * $config['per_page']);
        $data['links'] = $this->pagination->create_links();
        $data['karyawan'] = $this-> m_model->get_karyawan('users')->num_rows();
        $data['absen'] = $this-> m_model->get_data('absensi')->num_rows();
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
        $data['akun'] = $this->m_model->get_by_id('users', 'id', $this->session->userdata('id'));
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
    public function upload_image($field_name)
    {
        $config['upload_path'] = './images/karyawan/';
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


    public function edit_profile()
	{
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

		if (!empty($password_baru)) {
			if ($password_baru === $konfirmasi_password) {
				$data['password'] = md5($password_baru);
				$this->session->set_flashdata('ubah_password', 'Berhasil mengubah password');
			} else {
				$this->session->set_flashdata('kesalahan_password', 'Password baru dan Konfirmasi password tidak sama');
				redirect(base_url('karyawan/profile'));
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

	public function edit_foto() {
		$config['upload_path'] = './images/user/'; // Lokasi penyimpanan gambar di server
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
			$this->session->set_flashdata('berhasil_ubah_foto', 'Foto berhasil diperbarui.');

	
			// Redirect atau tampilkan pesan keberhasilan
			redirect('karyawan/profile'); // Gantilah dengan halaman yang sesuai
		} else {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error_profile', $error['error']);
			redirect('karyawan/profile');
			// Tangani kesalahan unggah gambar
		}
	}
    public function import_karyawan()
    {
        if (isset($_FILES["file"]["name"])) {
            // Pastikan file yang diunggah adalah file Excel
            $allowedFileTypes = ['application/vnd.ms-excel', 'text/xls', 'text/xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
            if (in_array($_FILES["file"]["type"], $allowedFileTypes)) {
                // Path file yang diunggah
                $path = $_FILES["file"]["tmp_name"];
                
                // Load file Excel menggunakan PhpSpreadsheet
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($path);
                $worksheet = $spreadsheet->getActiveSheet();
                
                // Loop melalui data di file Excel dan masukkan ke dalam database
                foreach ($worksheet->getRowIterator(2) as $row) {
                    $namaKaryawan = $worksheet->getCellByColumnAndRow(2, $row->getRowIndex())->getValue();
                    $kegiatan = $worksheet->getCellByColumnAndRow(3, $row->getRowIndex())->getValue();
                    $tanggal = $worksheet->getCellByColumnAndRow(4, $row->getRowIndex())->getValue();
                    $jamMasuk = $worksheet->getCellByColumnAndRow(5, $row->getRowIndex())->getValue();
                    $jamPulang = $worksheet->getCellByColumnAndRow(6, $row->getRowIndex())->getValue();
                    $status = $worksheet->getCellByColumnAndRow(7, $row->getRowIndex())->getValue();
                    
                    // Simpan data ke dalam database, sesuaikan dengan struktur tabel Anda
                    $data = [
                        'kegiatan' => $kegiatan,
                        'tanggal' => $tanggal,
                        'jam_masuk' => $jam_masuk,
                        'jam_pulang' => $jam_pulang,
                        'status' => $status,
                    ];
                    
                    $this->karyawan_model->tambah_data('absensi', $data);
                }
                
                // Redirect ke halaman yang sesuai setelah import selesai
                redirect(base_url('karyawan/history'));
            } else {
                echo 'Tipe file tidak didukung.';
            }
        } else {
            echo 'File tidak diunggah.';
        }
    }
}
?>