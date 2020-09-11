<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //load model
        $this->load->model('m_crud');
        $this->load->model('m_master');
        $this->load->model('m_login');
        $this->load->model('m_grafik');
    }

    ///////////////////////////////////////////////////////////////////
    /// Controller Pembelian
    //////////////////////////////////////////////////////////////////
    public function index()
    {
        $role = $this->m_login->is_role();
        if ($role != "admin" && $role != "administrator") {
            redirect("login/");
        } else {
            $data = array(
                'title' => "Data Pembelian",
                'faicon' => "fa-cart-arrow-down"
            );

            $data['data_pembelian'] = $this->m_master->data_pembelian()->result();
            $data['content'] = 'pembelian';
            $this->load->view('gaiabiai', $data);
        }
    }

    function pembelianjson()
    {
        error_reporting(0);
        $this->db->db_debug = false;
        try {
            $search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : '';
            $limit = $_POST['length']; // Ambil data limit per page
            $start = $_POST['start']; // Ambil data start
            $sql = $this->db->query("SELECT tbl_pembelian.id_pembelian,tbl_pembelian.id_pemasok,tbl_pemasok.nm_pemasok,tbl_pembelian.no_fakturbeli,DATE_FORMAT(tbl_pembelian.tgl_fakturbeli, '%d/%m/%Y') AS tgl_fakturbeli_format,tbl_pembelian.tgl_fakturbeli,tbl_pembelian.total_harga,tbl_pembelian.biaya_lainnya,tbl_pembelian.total_bayar,
            DATE_FORMAT(tbl_pembelian.tgl_pembelian, '%d/%m/%Y') AS tgl_pembelian_format,tbl_pembelian.tgl_pembelian,tbl_pembelian.status,tbl_pembelian.log 
            FROM tbl_pembelian 
            INNER JOIN tbl_pemasok ON tbl_pemasok.id_pemasok = tbl_pembelian.id_pemasok ORDER BY tbl_pembelian.id_pembelian ASC"); // Query untuk menghitung seluruh data
            $sql->row();

            $query = "SELECT tbl_pembelian.id_pembelian,tbl_pembelian.id_pemasok,tbl_pemasok.nm_pemasok,tbl_pembelian.no_fakturbeli,DATE_FORMAT(tbl_pembelian.tgl_fakturbeli, '%d/%m/%Y') AS tgl_fakturbeli_format,tbl_pembelian.tgl_fakturbeli,tbl_pembelian.total_harga,tbl_pembelian.biaya_lainnya,tbl_pembelian.total_bayar,
            DATE_FORMAT(tbl_pembelian.tgl_pembelian, '%d/%m/%Y') AS tgl_pembelian_format,tbl_pembelian.tgl_pembelian,tbl_pembelian.status,tbl_pembelian.log 
            FROM tbl_pembelian 
            INNER JOIN tbl_pemasok ON tbl_pemasok.id_pemasok = tbl_pembelian.id_pemasok WHERE (tbl_pembelian.no_fakturbeli LIKE '%" . $search . "%' OR tbl_pemasok.nm_pemasok LIKE '%" . $search . "%')";
            $order_index = $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
            $order_field = $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
            $order_ascdesc = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
            $order = " ORDER BY " . $order_field . " " . $order_ascdesc;

            $sql_data = $this->db->query($query . $order . " LIMIT " . $limit . " OFFSET " . $start); // Query untuk data yang akan di tampilkan
            $sql_data->row();

            $sql_filter = $this->db->query($query); // Query untuk count jumlah data sesuai dengan filter pada textbox pencarian
            $sql_filter->row();


            $callback = array(
                'draw' => $_POST['draw'], // Ini dari datatablenya
                'recordsTotal' => $sql->num_rows(), // Hitung data yg ada pada query $sql
                'recordsFiltered' => $sql_filter->num_rows(), // Hitung data yg ada pada query $sql_filter
                'data' => $sql_data->result()
            );

            header('Content-Type: application/json');
            echo json_encode($callback); // Convert array $callback ke json    
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function addpembelian()
    {
        $no_fakturbeli = $this->input->post('input_no_faktur');
        $id_pemasok = $this->input->post('pop_id_pemasok');
        //$nm_jabatan = $this->input->post('input_nm_jabatan');

        // Konversi Tanggal
        $input_tgl_fakturbeli = $this->input->post('input_tgl_fakturbeli');
        $pemisah = explode('/', $input_tgl_fakturbeli);
        $array = array($pemisah[2], $pemisah[1], $pemisah[0]);
        $tgl_fakturbeli = implode('-', $array);
        // End Konversi

        // Konversi Tanggal
        $input_tgl_pembelian = $this->input->post('input_tgl_pembelian');
        $pemisah = explode('/', $input_tgl_pembelian);
        $array = array($pemisah[2], $pemisah[1], $pemisah[0]);
        $tgl_pembelian = implode('-', $array);
        // End Konversi


        // Generate ID
        $query = $this->db->query("SELECT MAX(id_pembelian) AS id_pem FROM tbl_pembelian ORDER BY id_pembelian ASC");
        $getid = $query->row();
        $id_pem = $getid->id_pem;
        $noUrut = (int) substr($id_pem, 4, 5);
        $noUrut++;
        $char = "PMB";
        $id_pembelian = $char . sprintf("%05s", $noUrut);
        // Generate ID    

        $log = date("Y-m-d H:i:s");

        $data = array(
            'id_pembelian' => $id_pembelian,
            'id_pemasok' => $id_pemasok,
            'no_fakturbeli' => $no_fakturbeli,
            'tgl_fakturbeli' => $tgl_fakturbeli,
            'tgl_pembelian' => $tgl_pembelian,
            'total_harga' => 0,
            'biaya_lainnya' => 0,
            'total_bayar' => 0,
            'status' => '0',
            'log' => $log
        );

        $this->m_crud->tambah($data, 'tbl_pembelian');
        $this->session->set_flashdata('berhasil', 'Data Berhasil Di Tambah');
        redirect('pembelian');
    }
    function editpembelian()
    {
        $id_pembelian = $this->input->post('edit_id_pembelian');
        $no_fakturbeli = $this->input->post('edit_no_faktur');
        $id_pemasok = $this->input->post('pop_edit_id_pemasok');

        // Konversi Tanggal
        $edit_tgl_fakturbeli = $this->input->post('edit_tgl_fakturbeli');
        $pemisah = explode('/', $edit_tgl_fakturbeli);
        $array = array($pemisah[2], $pemisah[1], $pemisah[0]);
        $tgl_fakturbeli = implode('-', $array);
        // End Konversi

        // Konversi Tanggal
        $edit_tgl_pembelian = $this->input->post('edit_tgl_pembelian');
        $pemisah = explode('/', $edit_tgl_pembelian);
        $array = array($pemisah[2], $pemisah[1], $pemisah[0]);
        $tgl_pembelian = implode('-', $array);
        // End Konversi
        $log = date("Y-m-d H:i:s");
        $data = array(
            'id_pemasok' => $id_pemasok,
            'no_fakturbeli' => $no_fakturbeli,
            'tgl_fakturbeli' => $tgl_fakturbeli,
            'tgl_pembelian' => $tgl_pembelian,
            'log' => $log
        );

        $where = array(
            'id_pembelian' => $id_pembelian,
        );

        $this->m_crud->ubah($where, $data, 'tbl_pembelian');
        $this->session->set_flashdata('berhasil', 'Data Berhasil Di Ubah');
        redirect('pembelian');
    }

    ///////////////////////////////////////////////////////////////////
    /// Controller Rincian Pembelian
    //////////////////////////////////////////////////////////////////
    function rincian($id_pembelian = '')
    {
        $role = $this->m_login->is_role();
        if ($role != "admin" && $role != "administrator") {
            redirect("login/");
        } else {
            $data = array(
                'title' => "Rincian Pembelian",
                'faicon' => "fa-cart-arrow-down"
            );

            //$data['grafik'] = $this->m_grafik->total_akun()->result();
            $data['data_rincian_pembelian'] = $this->m_master->data_rincian_pembelian($id_pembelian)->result();
            $data['data_pembelian_id'] = $this->m_master->data_pembelian_id($id_pembelian)->result();
            $data['info_pembelian'] = $this->m_master->info_pembelian($id_pembelian)->result();
            $data['cek_status_pembelian'] = $this->m_master->cek_status_pembelian($id_pembelian)->result();
            $data['biaya_lain'] = $this->m_master->biaya_lain($id_pembelian)->result();

            $data['content'] = 'rincian_pembelian';
            $this->load->view('gaiabiai', $data);
        }
    }

    function addrpembelian()
    {
        $id_pembelian = $this->input->post('input_id_pembelian');
        $kode_barang = $this->input->post('pop_kode_barang');
        $jumlah = $this->input->post('input_jumlah');
        $harga = str_replace(".", "", $this->input->post('input_harga'));
        $subtotal = $harga * $jumlah;
        $log = date("Y-m-d H:i:s");

        $query = $this->db->query("SELECT kode_barang,jumlah,harga,`status` FROM tbl_rincian_pembelian WHERE id_pembelian='$id_pembelian' AND kode_barang='$kode_barang'");
        $cari_barang = $query->num_rows();
        $qstatus = $query->row()->status;
        $jumlah_lama = $query->row()->jumlah;
        //$qharga = $query->row()->harga;

        $jumlah_baru = $jumlah_lama + $jumlah;
        //$tambah_harga = $qharga + $harga;
        $subtotal_baru = $jumlah_baru * $harga;

        $update = array(
            'jumlah' => $jumlah_baru,
            'harga' => $harga,
            'subtotal' => $subtotal_baru,
            'log' => $log
        );

        $data = array(
            'id_rincian_pembelian' => null,
            'id_pembelian' => $id_pembelian,
            'kode_barang' => $kode_barang,
            'jumlah' => $jumlah,
            'harga' => $harga,
            'subtotal' => $subtotal,
            'status' => '0',
            'log' => $log
        );

        $where = array(
            'id_pembelian' => $id_pembelian,
            'kode_barang' => $kode_barang
        );

        if ($cari_barang > 0 && $qstatus == 1) {
            $this->session->set_flashdata('gagal', 'Barang telah terselesaikan!');
            redirect('pembelian/rincian/' . $id_pembelian . '');
        } elseif ($cari_barang > 0) {
            $this->m_crud->ubah($where, $update, 'tbl_rincian_pembelian');
            $this->session->set_flashdata('berhasil', 'Data Berhasil Di Perbaharui');
            redirect('pembelian/rincian/' . $id_pembelian . '');
        } else {
            $this->m_crud->tambah($data, 'tbl_rincian_pembelian');
            $this->session->set_flashdata('berhasil', 'Data Berhasil Di Tambah');
            redirect('pembelian/rincian/' . $id_pembelian . '');
        }
    }

    function editrpembelian()
    {
        $id_rincian_pembelian = $this->input->post('edit_id_rincian_pembelian');
        $id_pembelian = $this->input->post('edit_id_pembelian');
        $kode_barang = $this->input->post('pop_edit_kode_barang');
        $jumlah = $this->input->post('edit_jumlah');
        $harga = str_replace(".", "", $this->input->post('edit_harga'));
        $log = date("Y-m-d H:i:s");
        /////////////////////////////////////////////////////////////////////////////
        $query = $this->db->query("SELECT id_rincian_pembelian,kode_barang,jumlah,harga FROM tbl_rincian_pembelian WHERE id_pembelian='$id_pembelian' AND kode_barang='$kode_barang'");
        $cari_barang = $query->num_rows();
        $qid = $query->row()->id_rincian_pembelian;
        //$cari_kode =  $query->row()->kode_barang;
        $jumlah_lama = $query->row()->jumlah;

        $jumlah_baru = $jumlah_lama + $jumlah;
        $subtotal = $jumlah * $harga;
        $subtotal_baru = $jumlah * $harga;

        $update = array(
            'jumlah' => $jumlah,
            'harga' => $harga,
            'subtotal' => $subtotal,
            'log' => $log
        );

        $where_update = array(
            'id_rincian_pembelian' => $qid
        );

        /////////////////////////////////////////////////////////////////////////////
        $data = array(
            'kode_barang' => $kode_barang,
            'jumlah' => $jumlah,
            'harga' => $harga,
            'subtotal' => $subtotal_baru,
            'log' => $log
        );

        $where = array(
            'id_rincian_pembelian' => $id_rincian_pembelian
        );

        if ($cari_barang > 0 && $qid != $id_rincian_pembelian) {
            $this->m_crud->ubah($where_update, $update, 'tbl_rincian_pembelian');
            $this->m_crud->hapus($where, 'tbl_rincian_pembelian');
            $this->session->set_flashdata('berhasil', 'Data Berhasil Di Perbaharui');
            redirect('pembelian/rincian/' . $id_pembelian . '');
        } else {
            $this->m_crud->ubah($where, $data, 'tbl_rincian_pembelian');
            $this->session->set_flashdata('berhasil', 'Data Berhasil Di Perbaharui');
            redirect('pembelian/rincian/' . $id_pembelian . '');
        }
    }

    function delrpembelian($id_rincian_pembelian, $id_pembelian)
    {
        $where = array('id_rincian_pembelian' => $id_rincian_pembelian);
        $this->m_crud->hapus($where, 'tbl_rincian_pembelian');
        $this->session->set_flashdata('informasi', 'Data Berhasil Di Hapus');
        redirect('pembelian/rincian/' . $id_pembelian . '');
    }

    function kunci($id_rincian_pembelian, $id_pembelian, $kode_barang)
    {
        $log = date("Y-m-d H:i:s");
        $update = array(
            'status' => '1',
            'log' => $log
        );

        $where = array(
            'id_rincian_pembelian' => $id_rincian_pembelian
        );

        $log = date("Y-m-d H:i:s");
        $this->m_crud->ubah($where, $update, 'tbl_rincian_pembelian');
        $this->m_master->update_stok_barang($id_rincian_pembelian, $id_pembelian, $kode_barang, $log);
        $this->m_master->update_harga_barang($id_rincian_pembelian, $kode_barang, $log);
        $this->session->set_flashdata('berhasil', 'Rincian Berhasil Di Selesaikan !');
        redirect('pembelian/rincian/' . $id_pembelian . '');
    }

    function rincian_selesai($id_pembelian)
    {
        $subtotal = $this->db->query("SELECT SUM(subtotal) AS total_harga FROM tbl_rincian_pembelian WHERE id_pembelian='$id_pembelian'");
        $total_harga = $subtotal->row()->total_harga;

        $biaya = $this->db->query("SELECT biaya_lainnya FROM tbl_pembelian WHERE id_pembelian='$id_pembelian'");
        $biaya_lainnya = $biaya->row()->biaya_lainnya;

        $total_bayar = $total_harga + $biaya_lainnya;
        $log = date("Y-m-d H:i:s");
        $update = array(
            'total_harga' => $total_harga,
            'total_bayar' => $total_bayar,
            'status' => '1',
            'log' => $log
        );

        $where = array(
            'id_pembelian' => $id_pembelian
        );

        $log = date("Y-m-d H:i:s");
        $this->m_crud->ubah($where, $update, 'tbl_pembelian');
        $this->session->set_flashdata('berhasil', 'Rincian Berhasil Di Selesaikan !');
        redirect('pembelian/rincian/' . $id_pembelian . '');
    }

    function biayalainnya()
    {
        $id_pembelian = $this->input->post('biaya_id_pembelian');
        $biaya_lainnya = str_replace(".", "", $this->input->post('biaya_lainnya'));
        $log = date("Y-m-d H:i:s");
        $update = array(
            'biaya_lainnya' => $biaya_lainnya,
            'log' => $log
        );
        $where = array(
            'id_pembelian' => $id_pembelian
        );
        $this->m_crud->ubah($where, $update, 'tbl_pembelian');
        redirect('pembelian/rincian/' . $id_pembelian . '');
    }
}
