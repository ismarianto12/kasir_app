<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_login extends CI_Model
{
    //fungsi cek session logged in
    function is_logged_in()
    {
        return $this->session->userdata('id_login');
    }

    //fungsi cek level
    function is_role()
    {
        return $this->session->userdata('level');
    }

    //fungsi check login
    /*
    function check_login($table, $field1, $field2)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($field1);
        $this->db->where($field2);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    } */

    function cek_login($username,$password){
        $hasil=$this->db->query("SELECT * FROM tbl_login WHERE username='$username' AND `password` ='$password'");
        if ($hasil->num_rows() == 0) {
            return FALSE;
        } else {
            return $hasil->result();
        }

    }    
}
