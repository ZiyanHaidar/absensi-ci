<?php

  function tampil_full_nama_byid($id)
 {
    $ci =& get_instance();
    $ci->load->database();
    $result = $ci->db->where('id', $id)->get('users');
     foreach ($result->result() as $c) {
        $stmt= $c->username;
        return $stmt;
     }
 }
  function tampil_full_role_byid($id)
 {
    $ci =& get_instance();
    $ci->load->database();
    $result = $ci->db->where('id', $id)->get('users');
     foreach ($result->result() as $c) {
        $stmt= $c->role;
        return $stmt;
     }
 }
  function tampil_full_email_byid($id)
 {
    $ci =& get_instance();
    $ci->load->database();
    $result = $ci->db->where('id', $id)->get('users');
     foreach ($result->result() as $c) {
        $stmt= $c->email;
        return $stmt;
     }
 }
 
 
?>