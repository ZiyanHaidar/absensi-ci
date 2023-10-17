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
            // Anda juga harus mengatur status ke "belum Pulang".
            $data['tanggal'] = date('Y-m-d');
            $data['jam_masuk'] = date('H:i:s');
            $data['status'] = 'Belum Pulang';
        
            // Selanjutnya, masukkan data ini ke tabel "absensi".
            $this->db->insert('absensi', $data);
        
            // Kembalikan ID dari data yang baru saja ditambahkan
            return $this->db->insert_id();
        }
    
        public function setAbsensiPulang($absen_id) {
            // Fungsi ini digunakan untuk mengisi jam pulang dan mengubah status menjadi "pulang".
            $data = array(
                'jam_pulang' => date('H:i:s'),
                'status' => 'Pulang'
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
                'keterangan_izin' => $data['keterangan'],      // Menggunakan data dari parameter
                'tanggal' => date('Y-m-d'),
                'kegiatan' => '-',
                'jam_masuk' => '-',
                'jam_pulang' => '-',
                'status' => 'done'
            );
        
            // Selanjutnya, masukkan data ini ke tabel "absensi".
            $this->db->insert('absensi', $data);
        }
    
        public function hapusAbsensi($absen_id) {
            $this->db->where('id', $absen_id);
            $this->db->delete('absensi');
        }    
    
        public function updateAbsensi($absen_id, $data) {
            // Perbarui data absensi berdasarkan $absen_id
            $this->db->where('id', $absen_id);
            $this->db->update('absensi', $data);
        }
        
        public function getAbsensiById($absen_id) {
            return $this->db->get_where('absensi', array('id' => $absen_id))->row();
        }      
    
        public function update($table, $data, $where)
        {
            $data = $this->db->update($table, $data, $where);
            return $this->db->affected_rows();
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
}