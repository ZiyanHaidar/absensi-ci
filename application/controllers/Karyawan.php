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
		if ($this->session->userdata('logged_in')  != true && $this->session->userdata('role') != 'karyawan') {
			redirect(base_url() . 'auth');
		}
	}
//karyawan
	public function index()
	{
		
		$this->load->view('karyawan/index');
	}
    public function aksi_absen() {
		$user_id = $_SESSION['user_id']; // Ambil user_id dari sesi atau data pengguna yang login
		$kegiatan = $this->input->post('kegiatan', true);
		$tanggal = date('Y-m-d'); // Ambil tanggal saat ini
		$jam_masuk = date('H:i:s'); // Ambil jam masuk saat ini
		$status = 'pending'; // Set status menjadi pending
	
		// Simpan data absensi ke dalam database
		// Code untuk menyimpan data ke dalam tabel absensi
		// ...
	
		redirect(base_url() . "karyawan/aksi_absen"); // Redirect ke halaman dashboard atau halaman yang sesuai
	}
	public function aksi_izin() {
		$user_id = $_SESSION['user_id']; // Ambil user_id dari sesi atau data pengguna yang login
		$keterangan = $this->input->post('keterangan', true);
		$tanggal = date('Y-m-d'); // Ambil tanggal saat ini
		$status = 'done'; // Set status menjadi done
		$jam_masuk = ''; // Set jam masuk kosong
		$jam_pulang = ''; // Set jam pulang kosong
	
		// Simpan data izin ke dalam database
		// Code untuk menyimpan data ke dalam tabel izin
		// ...
	
		redirect(base_url() . "karyawan/aksi_izin"); // Redirect ke halaman dashboard atau halaman yang sesuai
	}
	public function aksi_pulang() {
		$user_id = $_SESSION['user_id']; // Ambil user_id dari sesi atau data pengguna yang login
		$tanggal = date('Y-m-d'); // Ambil tanggal saat ini
		$jam_pulang = date('H:i:s'); // Ambil jam pulang saat ini
		$status = 'done'; // Set status menjadi done
	
		// Update data absensi dalam database berdasarkan user_id dan tanggal
		// Code untuk mengupdate data dalam tabel absensi
		// ...
	
		redirect(base_url() . "karyawan/aksi_pulang"); // Redirect ke halaman dashboard atau halaman yang sesuai
	}
	
}
?>