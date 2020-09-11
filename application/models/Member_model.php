<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Member_model extends CI_Model
{

    public $table = 'member';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json($params = '')
    {
        $this->datatables->select('id,kode,nama,alamat,ttl,jk,active,user_id,date_created,date_updated');
        $this->datatables->from('member');
        //add this line for join
        //$this->datatables->join('table2', 'member.field = table2.field');
        if ($params == 'select_data') {
            $this->datatables->add_column('action', "<a href='#' id='add_list' class='btn btn-info btn-xs' data-member_id='$1' data-membernm='$2'><i class='fa fa-add'></i> Pilih</a>", 'id,nama');
        } else {
            $this->datatables->add_column('action', "
            <a href='#' class='btn btn-danger btn-xs delete' onclick='javasciprt: return hapus($1)'><i class='fa fa-print'></i> Print </a>
            <a href='#' load='" . base_url('member/edit/$1') . "' class='btn btn-info btn-xs' id='edit'><i class='fa fa-edit'></i> Edit</a>
            <a href='#' class='btn btn-danger btn-xs delete' onclick='javasciprt: return hapus($1)'><i class='fa fa-trash'></i> Delete</a>", 'id');
        }
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('id', $q);
        $this->db->or_like('kode', $q);
        $this->db->or_like('nama', $q);
        $this->db->or_like('alamat', $q);
        $this->db->or_like('ttl', $q);
        $this->db->or_like('jk', $q);
        $this->db->or_like('active', $q);
        $this->db->or_like('user_id', $q);
        $this->db->or_like('date_created', $q);
        $this->db->or_like('date_updated', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('kode', $q);
        $this->db->or_like('nama', $q);
        $this->db->or_like('alamat', $q);
        $this->db->or_like('ttl', $q);
        $this->db->or_like('jk', $q);
        $this->db->or_like('active', $q);
        $this->db->or_like('user_id', $q);
        $this->db->or_like('date_created', $q);
        $this->db->or_like('date_updated', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}
