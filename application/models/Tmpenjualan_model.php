<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tmpenjualan_model extends CI_Model
{

    public $table = 'tmpenjualan';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select('
                    tmpenjualan.no_penjualan as id_penjualan,
                    tmpenjualan.no_penjualan, 
                    tmpenjualan.jumlah, 
                    tmpenjualan.member_id,  
                    tmpenjualan.barang_id, 
                    tmpenjualan.barang_id,  
                    tmpenjualan.kasir_id,   

                    tbl_barang.kode_barang, 
                    tbl_barang.nm_barang, 
                    tbl_barang.jenis, 
                    tbl_barang.model, 
                    tbl_barang.warna, 
                    tbl_barang.ukuran, 
                    tbl_barang.tambahan, 

                    tbl_stok.kode_barang, 
                    tbl_stok.stock,

                    member.nama, 
                    member.alamat, 
                    member.ttl, 
                    member.kode,  
                    member.id, 

                    tbl_login.username, 
                    tbl_login.password, 
                    tbl_login.id_login, 
                    tbl_login.level, 
                    tbl_login.status    
        
        ');
        $this->datatables->from('tmpenjualan');
        $this->datatables->join('tbl_barang', 'tbl_barang.kode_barang = tmpenjualan.barang_id', 'left outer');
        $this->datatables->join('tbl_stok', 'tbl_stok.kode_barang = tbl_barang.kode_barang', 'left outer');
        $this->datatables->join('member', 'tmpenjualan.member_id  = member.id', 'left outer');
        $this->datatables->join('tbl_login', 'tmpenjualan.kasir_id = tbl_login.id_login', 'left outer');
        $this->datatables->add_column('action', anchor(site_url('tmpenjualan/detail/$1'), '<i class="fa fa-book"></i>Read', 'class="btn btn-info btn-xs edit"') . "  " . anchor(site_url('tmpenjualan/edit/$1'), '<i class="fa fa-edit"></i> Update', 'class="btn btn-success btn-xs edit"') . "<a href='#' class='btn btn-danger btn-xs delete' onclick='javasciprt: return hapus($1)'><i class='fa fa-trash'></i> Delete</a>", 'id_penjualan');
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
        $this->db->or_like('no_penjualan', $q);
        $this->db->or_like('kasir_id', $q);
        $this->db->or_like('barang_id', $q);
        $this->db->or_like('member_id', $q);
        $this->db->or_like('jumlah', $q);
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
        $this->db->or_like('no_penjualan', $q);
        $this->db->or_like('kasir_id', $q);
        $this->db->or_like('barang_id', $q);
        $this->db->or_like('member_id', $q);
        $this->db->or_like('jumlah', $q);
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
