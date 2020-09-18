<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trtransaksi_model extends CI_Model
{

    public $table = 'trtransaksi';
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
                    trtransaksi.id as id_penjualan,
                    trtransaksi.no_penjualan, 
                    trtransaksi.jumlah, 
                    trtransaksi.member_id,  
                    trtransaksi.price,  
                    trtransaksi.barang_id, 
                    trtransaksi.barang_id,  
                    trtransaksi.kasir_id, 
                    trtransaksi.diskon, 
                    trtransaksi.finish,
                    trtransaksi.subtotal,  
                    
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
                    tbl_login.status,
                    
                    tbl_harga.kode_barang,
                    tbl_harga.harga_beli_lama,
                    tbl_harga.harga_beli_baru,
                    tbl_harga.harga_jual_lama,
                    tbl_harga.harga_jual_baru
 

        ');
        $this->datatables->from('trtransaksi');
        $this->datatables->join('tbl_barang', 'tbl_barang.kode_barang = trtransaksi.barang_id', 'left outer');
        $this->datatables->join('tbl_stok', 'tbl_stok.kode_barang = tbl_barang.kode_barang', 'left outer');
        $this->datatables->join('member', 'trtransaksi.member_id  = member.id', 'left outer');
        $this->datatables->join('tbl_login', 'trtransaksi.kasir_id = tbl_login.id_login', 'left outer');
        $this->datatables->join('tbl_harga', 'tbl_barang.kode_barang = tbl_harga.kode_barang', 'left outer');
        $this->datatables->where('trtransaksi.finish', '0');
        $this->datatables->group_by('trtransaksi.id');
        $this->datatables->add_column('action', "<a href='#' class='btn btn-warning btn-xs edit' to='" . base_url('trtransaksi/edit/$1') . "'><i class='fa fa-pencil'></i> Edit</a> <a href='#' class='btn btn-danger btn-xs delete' onclick='javasciprt: return hapus($1,\"$2\")'><i class='fa fa-trash'></i> Delete</a>", 'id_penjualan,nm_barang');
        return $this->datatables->generate();
    }

    //get detail
    function strukPrint($no_penjualan)
    {
        $this->db->select('
                    trtransaksi.id as id_penjualan,
                    trtransaksi.no_penjualan, 
                    trtransaksi.jumlah, 
                    trtransaksi.price as hargabeli, 
                    trtransaksi.member_id,  
                    trtransaksi.barang_id, 
                    trtransaksi.barang_id,  
                    trtransaksi.kasir_id, 
                    trtransaksi.diskon, 
                    trtransaksi.finish,
                    trtransaksi.subtotal,
                    
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
                    tbl_login.status,
                    
                    tbl_harga.kode_barang,
                    tbl_harga.harga_beli_lama,
                    tbl_harga.harga_beli_baru,
                    tbl_harga.harga_jual_lama,
                    tbl_harga.harga_jual_baru
 

        ');
        $this->db->from('trtransaksi');
        $this->db->join('tbl_barang', 'tbl_barang.kode_barang = trtransaksi.barang_id', 'left outer');
        $this->db->join('tbl_stok', 'tbl_stok.kode_barang = tbl_barang.kode_barang', 'left outer');
        $this->db->join('member', 'trtransaksi.member_id  = member.id', 'left outer');
        $this->db->join('tbl_login', 'trtransaksi.kasir_id = tbl_login.id_login', 'left outer');
        $this->db->join('tbl_harga', 'tbl_barang.kode_barang = tbl_harga.kode_barang', 'left outer');
        $this->db->where('trtransaksi.finish', '1');
        $this->db->where('trtransaksi.no_penjualan', $no_penjualan);
        $this->db->group_by('trtransaksi.id');
        return $this->db->get();
    }

    //get by scanner
    function getdatabarang($kode_barang)
    {
        $this->db->select('
                    tbl_barang.kode_barang, 
                    tbl_barang.nm_barang, 
                    tbl_barang.jenis, 
                    tbl_barang.model, 
                    tbl_barang.warna, 
                    tbl_barang.ukuran, 
                    tbl_barang.tambahan, 

                    tbl_stok.kode_barang, 
                    tbl_stok.stock,
                     
                    tbl_harga.kode_barang,
                    tbl_harga.harga_beli_lama,
                    tbl_harga.harga_beli_baru,
                    tbl_harga.harga_jual_lama,
                    tbl_harga.harga_jual_baru

        ');
        $this->db->from('tbl_barang');
        $this->db->join('tbl_stok', 'tbl_stok.kode_barang = tbl_barang.kode_barang', 'left outer');
        $this->db->join('tbl_harga', 'tbl_barang.kode_barang = tbl_harga.kode_barang', 'left outer');
        $this->db->where('tbl_barang.kode_barang',$kode_barang); 
        $this->db->group_by('tbl_barang.kode_barang', $kode_barang);
        return $this->db->get();
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
        $this->db->or_like('price', $q);
        $this->db->or_like('item_name', $q);
        $this->db->or_like('jumlah', $q);
        $this->db->or_like('diskon', $q);
        $this->db->or_like('date_updated', $q);
        $this->db->or_like('date_created', $q);
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
        $this->db->or_like('price', $q);
        $this->db->or_like('item_name', $q);
        $this->db->or_like('jumlah', $q);
        $this->db->or_like('diskon', $q);
        $this->db->or_like('date_updated', $q);
        $this->db->or_like('date_created', $q);
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
