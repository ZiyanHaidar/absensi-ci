<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function getKaryawan() {
        $query = $this->db->get('user');
        return $query->result_array();
    }

    public function getRekapHarian() {
        $this->db->select('tanggal, COUNT(*) as total_absensi');
        $this->db->from('absensi');
        $this->db->group_by('tanggal');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getRekapMingguan() {
        $query = $this->db->query("SELECT WEEK(tanggal) as minggu, COUNT(*) as total_absensi FROM absensi GROUP BY minggu");
        return $query->result_array();
    }

    public function getRekapBulanan() {
        $query = $this->db->query("SELECT MONTH(tanggal) as bulan, COUNT(*) as total_absensi FROM absensi GROUP BY bulan");
        return $query->result_array();
    }

    public function exportDataKaryawan() {
    }

    public function exportDataRekapHarian() {
    }

    public function exportDataRekapMingguan() {
    }

    public function exportDataRekapBulanan() {
    }
}