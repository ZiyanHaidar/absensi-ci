<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    function get_data($table){
        return $this->db->get($table);
    }
    public function get_by_id($table, $id_column, $id) { 
        $data = $this->db->where($id_column, $id)->get($table); 
        return $data; 
    }

    public function getRekapHarian($tanggal) {
        $this->db->select('absensi.id, absensi.tanggal, absensi.kegiatan, absensi.id_karyawan, absensi.jam_masuk, absensi.jam_pulang, absensi.status');
        $this->db->from('absensi');
        $this->db->where('absensi.tanggal', $tanggal); // Menyaring data berdasarkan tanggal
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getAbsensiLast7Days() {
        $this->load->database();
        $end_tanggal = date('Y-m-d');
        $start_tanggal = date('Y-m-d', strtotime('-7 days', strtotime($end_tanggal)));            
        $query = $this->db->select('tanggal, kegiatan, jam_masuk, jam_pulang, keterangan_izin, status, COUNT(*) AS total_absences')
                    ->from('absensi')
                    ->where('tanggal >=', $start_tanggal)
                    ->where('tanggal <=', $end_tanggal)
                    ->group_by('tanggal, kegiatan, jam_masuk, jam_pulang, keterangan_izin, status')
                    ->get();

        return $query->result_array();
    }
    
    
    public function getRekapBulanan($bulan) {
        $this->db->select('MONTH(tanggal) as bulan, COUNT(*) as total_absensi');
        $this->db->from('absensi');
        $this->db->where('MONTH(tanggal)', $bulan); // Menyaring data berdasarkan bulan
        $this->db->group_by('bulan');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getRekapHarianByBulan($bulan) {
        $this->db->select('absensi.id, absensi.tanggal, absensi.kegiatan, absensi.id_karyawan, absensi.jam_masuk, absensi.jam_pulang, absensi.status');
        $this->db->from('absensi');
        $this->db->where('MONTH(absensi.tanggal)', $bulan);
        $query = $this->db->get();
        return $query->result_array();
    }    
    
    public function getExportKaryawan() {
        $this->db->select('absensi.id, users.username, absensi.kegiatan, absensi.tanggal, absensi.jam_masuk, absensi.jam_pulang, absensi.status');
        $this->db->from('absensi');
        $this->db->join('users', 'users.id = absensi.id_karyawan', 'left');
        $query = $this->db->get();
    
        return $query->result();
    }
    
    public function exportDataRekapHarian($tanggal_awal, $tanggal_akhir) {
        $this->db->select('tanggal, COUNT(*) as total_absensi');
        $this->db->from('absensi');
        $this->db->where('tanggal >=', $tanggal_awal);
        $this->db->where('tanggal <=', $tanggal_akhir);
        $this->db->group_by('tanggal');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function exportDataRekapMingguan() {
        $this->db->select('WEEK(tanggal) as minggu, COUNT(*) as total_absensi');
        $this->db->from('absensi');
        $this->db->group_by('minggu');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function exportDataRekapBulanan() {
        $this->db->select('MONTH(tanggal) as bulan, COUNT(*) as total_absensi');
        $this->db->from('absensi');
        $this->db->group_by('bulan');
        $query = $this->db->get();
        return $query->result_array();
    }
      // get karyawan
      public function get_karyawan($table)
      {
      return $this->db->where('role', 'karyawan')
                      ->get($table);
      }
      public function count_absen() {
        return $this->db->count_all_results('absensi'); 
    }
    public function get_absen_page($limit, $offset)
    {
        $this->db->limit($limit, $offset);
        $query = $this->db->get('absensi');
        return $query->result();
    }
    public function image_user()
        {
            $id_karyawan = $this->session->userdata('id');
            $this->db->select('image');
            $this->db->from('users');
            $this->db->where('id_karyawan');
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $result = $query->row();
                return $result->image;
            } else {
                return false;
            }
        }

        public function update_image($user_id, $new_image) {
            $data = array(
                'image' => $new_image
            );
    
            $this->db->where('id', $user_id); // Sesuaikan dengan kolom dan nama tabel yang sesuai
            $this->db->update('users', $data); // Sesuaikan dengan nama tabel Anda
    
            return $this->db->affected_rows(); // Mengembalikan jumlah baris yang diupdate
        }

        public function get_current_image($user_id) {
            $this->db->select('image');
            $this->db->from('users'); // Gantilah 'user_table' dengan nama tabel Anda
            $this->db->where('id', $user_id);
            $query = $this->db->get();
    
            if ($query->num_rows() > 0) {
                $row = $query->row();
                return $row->image;
            }
    
            return null; // Kembalikan null jika data tidak ditemukan
        }
        public function getBulanan($bulan)
        {
            $this->db->select("absensi.*, users.username");
            $this->db->from("absensi");
            $this->db->join("users", "absensi.id_karyawan = users.id", "left");
            $this->db->where("DATE_FORMAT(tanggal, '%m') = ", $bulan); // Perbaikan di sini
            $query = $this->db->get();
            return $query->result();
        }

        public function get_absensi_count() {
            return $this->db->count_all_results('absensi');
        }

        public function get_karyawan_rows() {
            return $this->db->get_where('users', array('role' => 'karyawan'))->num_rows();
        }
        
        public function get_data_by_role($role)
        {
            $this->db->where('role', $role);
            return $this->db->get('users');
        }

        public function getDataAbsensi()
        {
            // Ganti 'absensi' dengan tabel yang sesuai dalam database Anda
            $this->db->select('absensi.*, users.username');
            $this->db->from('absensi');
            $this->db->join('users', 'absensi.id_karyawan = users.id', 'left');
            return $this->db->get()->result();
        }
        public function getPerHari($tanggal)
        {
            $this->db->select('absensi.*, users.username');
            $this->db->from('absensi');
            $this->db->join('users', 'absensi.id_karyawan = users.id', 'left');
            $this->db->where('tanggal', $tanggal);
            $query = $this->db->get();
            return $query->result();
        }
}