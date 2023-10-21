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
    function delete($table, $field, $id)
    {
        $data = $this->db->delete($table, array($field => $id));
        return $data;
    }

    public function getPerHari($tanggal)
        {
            $this->db->select('absensi.*, users.username');
            $this->db->from('absensi');
            $this->db->join('users', 'absensi.id_karyawan = users.id', 'left');
            $this->db->where('date', $tanggal);
            $query = $this->db->get();
            return $query->result();
        }

     
    public function getMingguanData($tanggal_awal, $tanggal_akhir) {
        $this->db->select('absensi.id, users.username, absensi.kegiatan, absensi.date as date, absensi.jam_masuk, absensi.jam_pulang, absensi.keterangan_izin, absensi.status');
        $this->db->from('absensi');
        $this->db->join('users', 'users.id = absensi.id_karyawan', 'left');
        $this->db->where("WEEK(absensi.date, 3) BETWEEN $tanggal_awal AND $tanggal_akhir");
    
        $query = $this->db->get();
    
        return $query->result();
    }
    public function getAbsensiLast7Days() {
        $this->load->database();
        $end_tanggal = date('Y-m-d');
        $start_tanggal = date('Y-m-d', strtotime('-7 days', strtotime($end_tanggal)));            
        $query = $this->db->select('date, kegiatan, jam_masuk, jam_pulang, keterangan_izin, status, COUNT(*) AS total_absences')
                            ->from('absensi')
                            ->where('date >=', $start_tanggal)
                            ->where('date <=', $end_tanggal)
                            ->group_by('date, kegiatan, jam_masuk, jam_pulang, keterangan_izin, status')
                            ->get();

        return $query->result_array();
    }

        public function getRekapPerBulan($bulan) {
            $this->db->select('MONTH(date) as bulan, COUNT(*) as total_absensi, users.username');
            $this->db->from('absensi');
            $this->db->join('users', 'absensi.id_karyawan = users.id', 'left');
            $this->db->where('MONTH(date)', $bulan); // Menyaring data berdasarkan bulan
            $this->db->group_by('bulan');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function getRekapHarianByBulan($bulan) {
            $this->db->select('absensi.*, users.username');
            $this->db->from('absensi');
            $this->db->join('users', 'absensi.id_karyawan = users.id', 'left');
            $this->db->where('MONTH(absensi.date)', $bulan);
            $query = $this->db->get();
            return $query->result_array();
        }

        public function getBulanan($bulan)
        {
            $this->db->select("absensi.*, users.username");
            $this->db->from("absensi");
            $this->db->join("users", "absensi.id_karyawan = users.id", "left");
            $this->db->where("DATE_FORMAT(date, '%m') = ", $bulan); // Perbaikan di sini
            $query = $this->db->get();
            return $query->result();
        }
 
    
        public function getExportKaryawan() {
            $this->db->select('absensi.id, users.username, absensi.kegiatan, absensi.date as date, absensi.jam_masuk, absensi.jam_pulang, absensi.keterangan_izin, absensi.status');
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
  
    public function getDataAbsensi()
    {
        // Ganti 'absensi' dengan tabel yang sesuai dalam database Anda
        $this->db->select('absensi.*, users.username');
        $this->db->from('absensi');
        $this->db->join('users', 'absensi.id_karyawan = users.id', 'left');
        return $this->db->get()->result();
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

        public function update_data($table, $data, $where)
        {
            $this->db->update($table, $data, $where);
            return $this->db->affected_rows();
        }
         
            public function image_akun()
            {
                $id_karyawan = $this->session->akundata('id');
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
            
            public function get_karyawan_image_by_id($id)
            {
                $this->db->select('image');
                $this->db->from('users');
                $this->db->where('id', $id);
                $query = $this->db->get();
        
                if ($query->num_rows() > 0) {
                    $result = $query->row();
                    return $result->image;
                } else {
                    return false;
                }
            }
            public function update_image($akun_id, $new_image)
            {
                $data = array(
                    'image' => $new_image
                );
        
                $this->db->where('id', $akun_id); // Sesuaikan dengan kolom dan nama tabel yang sesuai
                $this->db->update('users', $data); // Sesuaikan dengan nama tabel Anda
        
                return $this->db->affected_rows(); // Mengembalikan jumlah baris yang diupdate
            }
        
            public function get_current_image($akun_id)
            {
                $this->db->select('image');
                $this->db->from('users'); // Gantilah 'akun_table' dengan nama tabel Anda
                $this->db->where('id', $akun_id);
                $query = $this->db->get();
        
                if ($query->num_rows() > 0) {
                    $row = $query->row();
                    return $row->image;
                }
        
                return null; // Kembalikan null jika data tidak ditemukan
            }
            public function ubah_data($table, $data, $where) { 
                $this->db->update($table, $data, $where); 
                return $this->db->affected_rows(); 
            }
            function get_masuk($id_karyawan) {
                $this->db->where('id_karyawan', $id_karyawan);
                return $this->db->get('absensi')->result();
            }
    
            function get_izin($table, $id_karyawan)
            {
                return $this->db->where('id_karyawan', $id_karyawan)
                ->where('kegiatan', '-')
                ->get($table);
            }
    
            function get_absen($table, $id_karyawan)
            {
                return $this->db->where('id_karyawan', $id_karyawan)
                ->where('keterangan_izin', '-')
                ->get($table);
            }
            function get_absensi_by_karyawan($id_karyawan) {
                $this->db->where('id_karyawan', $id_karyawan);
                return $this->db->get('absensi')->result();
            }
}