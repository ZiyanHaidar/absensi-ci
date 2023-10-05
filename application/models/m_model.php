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
    public function get_siswa_foto_by_id($id_siswa)
    {
        $this->db->select('foto');
        $this->db->from('siswa');
        $this->db->where('id_siswa', $id_siswa);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->foto;
        } else {
            return false;
        }
    }
    public function get_by_nisn($nisn)
    {
        $this->db->select('id_siswa');
        $this->db->from('siswa');
        $this->db->where('nisn', $nisn);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->foto;
        } else {
            return false;
        }
    }
    public function getDataPembayaran() {
        $this->db->select('pembayaran.id, pembayaran.jenis_pembayaran, pembayaran.total_pembayaran, siswa.nama_siswa, kelas.tingkat_kelas, kelas.jurusan_kelas');
        $this->db->from('pembayaran');
        $this->db->join('siswa', 'siswa.id_siswa = pembayaran.id_siswa', 'left');
        $this->db->join('kelas', 'siswa.id_kelas = kelas.id', 'left');
        $query = $this->db->get();
    
        return $query->result();
    }
    public function get_data_siswa() {
        $this->db->join('kelas', 'siswa.id_kelas = kelas.id','left');
        
        $query = $this->db->get('siswa');

        // mengembalikan hasil query
        return $query->result();
    }
    public function getKelasByTingkatJurusan($tingkat_kelas, $jurusan_kelas)
    {
        $this->db->select('id');
        $this->db->where('tingkat_kelas', $tingkat_kelas);
        $this->db->where('jurusan_kelas', $jurusan_kelas);
        $query = $this->db->get('kelas');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->id;
        } else {
            return false;
        }
    
    }

    
}