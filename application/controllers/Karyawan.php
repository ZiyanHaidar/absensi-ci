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
	public function menu_absen()
	{
		
		$this->load->view('karyawan/menu_absen');
	}
	public function menu_izin()
	{
		
		$this->load->view('karyawan/menu_izin');
	}
  
}
?>