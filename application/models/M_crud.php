<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class M_crud extends CI_Model
{
    ///////////////////////////////////////////////////////////////////
    /// Model Global CRUD
    //////////////////////////////////////////////////////////////////
    function tambah($data, $table)
    {
        $this->db->insert($table, $data);
    }
    function tampil($table)
    {
        return $this->db->get($table);
    }

    function ubah($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function hapus($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

}
