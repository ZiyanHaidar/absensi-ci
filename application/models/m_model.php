<?php

class M_model extends CI_Model{
    function get_data($table){
        return $this->db->get($table);
    }

    function getwhere($table, $data)
    {
        return $this->db->get_where($table, $data);
    }
    function delete($table, $field, $id)
    {
        $data = $this->db->delete($table, array($field => $id));
        return $data;
    }

    function tambah_data($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    public function get_by_id($table, $id_column, $id) { 
        $data = $this->db->where($id_column, $id)->get($table); 
        return $data; 
    }

    public function ubah_data($table, $data, $where) { 
        $this->db->update($table, $data, $where); 
        return $this->db->affected_rows(); 
    }
    


        public function register_user($data) {
            // Masukkan data ke dalam tabel 'users' dan kembalikan hasilnya
            return $this->db->insert('users', $data);
        }
    
    
        public function addAbsensi($data) {
            // Fungsi ini digunakan untuk menambahkan data absensi.
            // Anda dapat mengisi tanggal dan jam masuk sesuai dengan waktu saat ini.
            // Anda juga harus mengatur status ke "Not Done".
            $data['tanggal'] = date('Y-m-d');
            $data['jam_masuk'] = date('H:i:s');
            $data['status'] = 'Not Done';
        
            // Selanjutnya, masukkan data ini ke tabel "absensi".
            $this->db->insert('absensi', $data);
        
            // Kembalikan ID dari data yang baru saja ditambahkan
            return $this->db->insert_id();
        }
    
        public function setAbsensiPulang($absen_id) {
            // Fungsi ini digunakan untuk mengisi jam pulang dan mengubah status menjadi "Done".
            $data = array(
                'jam_pulang' => date('H:i:s'),
                'status' => 'Done'
            );
    
            // Ubah data absensi berdasarkan absen_id.
            $this->db->where('id', $absen_id);
            $this->db->update('absensi', $data);
        }
    
        public function addIzin($data) {
            // Fungsi ini digunakan untuk menambahkan izin.
            // Anda dapat mengisi tanggal saat ini sebagai tanggal izin.
            // Anda juga perlu mengatur status ke "done" dan jam masuk serta jam pulang ke NULL.
        
            $data = array(
                'id_karyawan' => $data['id_karyawan'], // Menggunakan data dari parameter
                'kegiatan' => $data['keterangan'],      // Menggunakan data dari parameter
                'tanggal' => date('Y-m-d'),
                'jam_masuk' => '-',
                'jam_pulang' => '-',
                'status' => 'done'
            );
        
            // Selanjutnya, masukkan data ini ke tabel "absensi".
            $this->db->insert('absensi', $data);
        }

    
}