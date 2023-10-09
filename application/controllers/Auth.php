<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

 function __construct()
 {
  parent::__construct();
  $this->load->model('m_model');
  $this->load->helper('my_helper');
 }

 public function index()
 {
  $this->load->view('auth/login');
 }

 public function aksi_login()
 {
  $email = $this->input->post('email', true);
  $password = $this->input->post('password', true);
  $data = [ 'email' => $email, ];
  $query = $this->m_model->getwhere('admin', $data);
  $result = $query->row_array();

  if (!empty($result) && md5($password) === $result['password']) {
   $data = [
    'logged_in' => TRUE,
    'email' => $result['email'],
    'username' => $result['username'],
    'role' => $result['role'],
    'id' => $result['id'],
   ];
   $this->session->set_userdata($data);
   if ($this->session->userdata('role') == 'admin') {
    redirect(base_url()."admin");
   } elseif($this->session->userdata('role') == 'keuangan'){
    redirect(base_url()."keuangan") ;
   }
 else {
    redirect(base_url()."auth");
   }
  } else {
   redirect(base_url()."auth");
  }
 }

 function logout() {
  $this->session->sess_destroy(); // Menggunakan sess_destroy() untuk mengakhiri sesi
  redirect(base_url('auth'));
 }
 public function register() {
  // Muat tampilan formulir pendaftaran
  $this->load->view('auth/register');
}
 public function aksi_register() {
  $username = $this->input->post('username', true);
  $email = $this->input->post('email', true);
  $firstName = $this->input->post('nama_depan', true); // Ubah nama_depan sesuai dengan nama input pada formulir
  $lastName = $this->input->post('nama_belakang', true); // Ubah nama_belakang sesuai dengan nama input pada formulir
  $password = $this->input->post('password', true);

  // Periksa jika panjang kata sandi minimal 8 karakter
  if (strlen($password) < 8) {
      // Kata sandi terlalu pendek, tangani sesuai dengan kebutuhan Anda
      redirect(base_url() . "auth/register");
  }

  // Hash kata sandi
  $hashed_password = password_hash($password, PASSWORD_BCRYPT);

  // Persiapkan data untuk dimasukkan ke dalam database
  $data = [
      'username' => $username,
      'email' => $email,
      'nama_depan' => $firstName,
      'nama_belakang' => $lastName,
      'password' => $hashed_password,
      'role' => 'user'
      // Anda dapat menambahkan bidang 'image' jika mengelola gambar profil
  ];

  // Muat model database dan masukkan data
  $this->load->model('M_model');
  $registration_result = $this->M_model->register_user($data);

  if ($registration_result) {
      // Pendaftaran berhasil
      $this->session->set_userdata([
          'logged_in' => TRUE,
          'email' => $email,
          'username' => $username,
          'role' => 'user'
      ]);

      redirect(base_url() . "auth");
  } else {
      // Pendaftaran gagal, tangani sesuai dengan kebutuhan Anda
      redirect(base_url() . "auth/register");
  }
}


}