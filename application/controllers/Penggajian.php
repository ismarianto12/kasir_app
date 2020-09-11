<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penggajian extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->id_login == '') {
            redirect(base_url('login?params=true'));
            exit();
        }
        //load model
        $this->load->model('m_crud');
        $this->load->model('m_master');
        $this->load->model('m_login');
        $this->load->model('m_grafik');
    }

    ///////////////////////////////////////////////////////////////////
    /// Controller Penggajian
    //////////////////////////////////////////////////////////////////
    public function index()
    {
        $role = $this->m_login->is_role();

        $data = array(
            'title_penggajian' => "Data Penggajian",
            'faicon_penggajian' => "fa-money",
            'title_insentif' => "Data Insentif",
            'faicon_insentif' => "fa-dollar"
        );
        $data['grafik_karyawan'] = $this->m_grafik->total_karyawan()->result();
        $data['grafik_penggajian'] = $this->m_grafik->total_entri_penggajian()->result();
        $data['data_penggajian'] = $this->m_crud->tampil('tbl_penggajian')->result();
        $data['data_insentif'] = $this->m_master->data_insentif()->result();
        $data['content'] = 'penggajian';
        $this->load->view('gaiabiai', $data);
    }

    function penggajianjson()
    {
        error_reporting(0);
        $this->db->db_debug = false;
        try {
            $search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : '';
            $limit = $_POST['length']; // Ambil data limit per page
            $start = $_POST['start']; // Ambil data start
            $sql = $this->db->query("SELECT *,DATE_FORMAT(tgl_penggajian, '%d/%m/%Y') AS tgl_penggajian_format  FROM tbl_penggajian ORDER BY id_penggajian ASC"); // Query untuk menghitung seluruh data
            $sql->row();

            $query = "SELECT *,DATE_FORMAT(tgl_penggajian, '%d/%m/%Y') AS tgl_penggajian_format FROM tbl_penggajian WHERE (catatan LIKE '%" . $search . "%' OR bulan LIKE '%" . $search . "%')";
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

    function addpenggajian()
    {
        $bulan = $this->input->post('input_bulan');
        $tahun = $this->input->post('input_tahun');
        $catatan = $this->input->post('input_catatan');
        // Konversi Tanggal
        $input_tgl_penggajian = $this->input->post('input_tgl_penggajian');
        $pemisah = explode('/', $input_tgl_penggajian);
        $array = array($pemisah[2], $pemisah[1], $pemisah[0]);
        $tgl_penggajian = implode('-', $array);
        // End Konversi

        $log = date("Y-m-d H:i:s");
        // Generate ID
        $queryGK = $this->db->query("SELECT MAX(id_penggajian) AS kode FROM tbl_penggajian ORDER BY id_penggajian ASC");
        $Gkode = $queryGK->row();
        $kode = $Gkode->kode;
        $noUrut = (int) substr($kode, 4, 5);
        $noUrut++;
        $char = "PGA";
        $id_penggajian = $char . sprintf("%05s", $noUrut);
        // Generate ID

        $data = array(
            'id_penggajian' => $id_penggajian,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'catatan' => $catatan,
            'tgl_penggajian' => $tgl_penggajian,
            'status' => 1,
            'log' => $log
        );

        $this->m_crud->tambah($data, 'tbl_penggajian');
        // SELECT GAJI
        $cari_gaji = $this->db->query("SELECT * FROM tbl_gaji WHERE status='1'")->result();
        //$hasi_cari = $cari_gaji->row();

        foreach ($cari_gaji as $row) {
            $id_gaji = $row->id_gaji;
            $gaji_pokok = $row->gaji_pokok;
            $tunjangan = $row->tunjangan;
            $total_terima = $gaji_pokok + $tunjangan;
            $rincian = array(
                'id_rincian' => null,
                'id_penggajian' => $id_penggajian,
                'id_gaji' => $id_gaji,
                'total_terima' => $total_terima,
                'status' => '0',
                'log' => $log
            );
            $this->m_crud->tambah($rincian, 'tbl_rincian_penggajian');
        }

        $this->session->set_flashdata('berhasil', 'Data Berhasil Di Tambah');
        redirect('penggajian');
    }

    function editpenggajian()
    {
        $id_penggajian = $this->input->post('edit_id_penggajian');
        $bulan = $this->input->post('edit_bulan');
        $tahun = $this->input->post('edit_tahun');
        $catatan = $this->input->post('edit_catatan');
        // Konversi Tanggal
        $edit_tgl_penggajian = $this->input->post('edit_tgl_penggajian');
        $pemisah = explode('/', $edit_tgl_penggajian);
        $array = array($pemisah[2], $pemisah[1], $pemisah[0]);
        $tgl_penggajian = implode('-', $array);
        // End Konversi

        $log = date("Y-m-d H:i:s");
        $data = array(
            'bulan' => $bulan,
            'tahun' => $tahun,
            'catatan' => $catatan,
            'tgl_penggajian' => $tgl_penggajian,
            'log' => $log
        );

        $where = array(
            'id_penggajian' => $id_penggajian
        );

        $this->m_crud->ubah($where, $data, 'tbl_penggajian');
        $this->session->set_flashdata('informasi', 'Data Berhasil Di Ubah');
        redirect('penggajian');
    }

    function delpenggajian($id_penggajian)
    {
        $where = array('id_penggajian' => $id_penggajian);
        $this->m_crud->hapus($where, 'tbl_penggajian');
        $this->session->set_flashdata('informasi', 'Data Berhasil Di Hapus');
        redirect('penggajian');
    }
    ///////////////////////////////////////////////////////////////////
    /// Controller Insentif
    //////////////////////////////////////////////////////////////////
    function insentifjson()
    {
        error_reporting(0);
        $this->db->db_debug = false;
        try {
            $search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : '';
            $limit = $_POST['length']; // Ambil data limit per page
            $start = $_POST['start']; // Ambil data start


            $session  = $this->session->level;
            $id_login = $this->session->id_login;

            if ($session == 'manager' or $session == 'administrator') {
                $where  = '';
                $wheres = '';
            } else {
                $where  = ' where tbl_login.id_login="' . $id_login . '"';
                $wheres = ' and tbl_login.id_login="' . $id_login . '"';
            }
            $sql = $this->db->query("SELECT tbl_login.karyawan_id,tbl_insentif.id_insentif,tbl_insentif.id_karyawan,tbl_karyawan.nm_karyawan,tbl_insentif.nm_insentif,tbl_insentif.total_insentif,tbl_insentif.bulan,tbl_insentif.tahun,tbl_insentif.tgl_terima,DATE_FORMAT(tbl_insentif.tgl_terima, '%d/%m/%Y') AS tgl_terima_format,tbl_insentif.status,tbl_insentif.log FROM tbl_insentif
            INNER JOIN tbl_karyawan ON tbl_karyawan.id_karyawan = tbl_insentif.id_karyawan
            LEFT OUTER JOIN tbl_login on tbl_karyawan.id_karyawan = tbl_login.karyawan_id  
             $where"); // Query untuk menghitung seluruh data
            $sql->row();

            $query = "SELECT tbl_login.karyawan_id,tbl_insentif.id_insentif,tbl_insentif.id_karyawan,tbl_karyawan.nm_karyawan,tbl_insentif.nm_insentif,tbl_insentif.total_insentif,tbl_insentif.bulan,tbl_insentif.tahun,tbl_insentif.tgl_terima,DATE_FORMAT(tbl_insentif.tgl_terima, '%d/%m/%Y') AS tgl_terima_format,tbl_insentif.status,tbl_insentif.log FROM tbl_insentif
            INNER JOIN tbl_karyawan ON tbl_karyawan.id_karyawan = tbl_insentif.id_karyawan
            LEFT OUTER JOIN tbl_login on tbl_karyawan.id_karyawan = tbl_login.karyawan_id 

            WHERE (tbl_insentif.nm_insentif LIKE '%" . $search . "%' OR tbl_insentif.bulan LIKE '%" . $search . "%') $wheres";


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

    function addinsentif()
    {
        $bulan = $this->input->post('input_bulan_insentif');
        $tahun = $this->input->post('input_tahun_insentif');
        $id_karyawan = $this->input->post('pop_id_karyawan');
        $nm_insentif = $this->input->post('input_nm_insentif');
        $total_insentif = str_replace(".", "", $this->input->post('input_total_insentif'));
        // Konversi Tanggal
        $input_tgl_terima = $this->input->post('input_tgl_terima');
        $pemisah = explode('/', $input_tgl_terima);
        $array = array($pemisah[2], $pemisah[1], $pemisah[0]);
        $tgl_terima = implode('-', $array);
        // End Konversi

        $log = date("Y-m-d H:i:s");
        // Generate ID
        $queryGK = $this->db->query("SELECT MAX(id_insentif) AS kode FROM tbl_insentif ORDER BY id_insentif ASC");
        $Gkode = $queryGK->row();
        $kode = $Gkode->kode;
        $noUrut = (int) substr($kode, 4, 5);
        $noUrut++;
        $char = "INF";
        $id_insentif = $char . sprintf("%05s", $noUrut);
        // Generate ID

        $data = array(
            'id_insentif' => $id_insentif,
            'id_karyawan' => $id_karyawan,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'nm_insentif' => $nm_insentif,
            'tgl_terima' => $tgl_terima,
            'total_insentif' => $total_insentif,
            'status' => '0',
            'log' => $log
        );

        $this->m_crud->tambah($data, 'tbl_insentif');
        $this->session->set_flashdata('berhasil', 'Data Berhasil Di Tambah');
        redirect('penggajian');
    }

    function editinsentif()
    {
        $id_insentif = $this->input->post('edit_id_insentif');
        $bulan = $this->input->post('edit_bulan_insentif');
        $tahun = $this->input->post('edit_tahun_insentif');
        $id_karyawan = $this->input->post('pop_edit_id_karyawan');
        $nm_insentif = $this->input->post('edit_nm_insentif');
        $total_insentif = str_replace(".", "", $this->input->post('edit_total_insentif'));
        // Konversi Tanggal
        $edit_tgl_terima = $this->input->post('edit_tgl_terima');
        $pemisah = explode('/', $edit_tgl_terima);
        $array = array($pemisah[2], $pemisah[1], $pemisah[0]);
        $tgl_terima = implode('-', $array);
        // End Konversi

        $log = date("Y-m-d H:i:s");
        $data = array(
            'id_karyawan' => $id_karyawan,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'nm_insentif' => $nm_insentif,
            'tgl_terima' => $tgl_terima,
            'total_insentif' => $total_insentif,
            'log' => $log
        );

        $where = array(
            'id_insentif' => $id_insentif
        );

        $this->m_crud->ubah($where, $data, 'tbl_insentif');
        $this->session->set_flashdata('informasi', 'Data Berhasil Di Ubah');
        redirect('penggajian');
    }

    function delinsentif($id_insentif)
    {
        $where = array('id_insentif' => $id_insentif);
        $this->m_crud->hapus($where, 'tbl_insentif');
        $this->session->set_flashdata('informasi', 'Data Berhasil Di Hapus');
        redirect('penggajian');
    }

    function insentif_selesai($id_insentif)
    {
        $log = date("Y-m-d H:i:s");
        $data = array(
            'status' => '1',
            'log' => $log
        );

        $where = array('id_insentif' => $id_insentif);
        $this->m_crud->ubah($where, $data,  'tbl_insentif');
        $this->session->set_flashdata('informasi', 'Data Berhasil Di Hapus');
        redirect('penggajian');
    }

    function rincian_penggajian($id_penggajian = '')
    {
        // $role = $this->m_login->is_role();
        // if ($role != "admin" && $role != "administrator") {
        //     redirect("login/");
        // } else {
        $data = array(
            'title' => "Data Rincian",
            'faicon' => "fa-money",
        );
        $level = $this->session->userdata('level');

        $data['grafik'] = $this->m_grafik->total_akun()->result();
        $data['data_rincian_penggajian'] = $this->m_master->data_rincian_penggajian($id_penggajian, $level)->result();
        $data['info_penggajian'] = $this->m_master->info_penggajian($id_penggajian)->result();
        $data['cek_status_button'] = $this->m_master->cek_status_button($id_penggajian)->result();
        $data['content'] = 'rincian_penggajian';
        $this->load->view('gaiabiai', $data);
        //}
    }

    function kunci_rincian_penggajian($id_rincian, $id_penggajian)
    {
        $log = date("Y-m-d H:i:s");
        $data = array(
            'status' => '1',
            'log' => $log
        );

        $where = array('id_rincian' => $id_rincian);
        $this->m_crud->ubah($where, $data,  'tbl_rincian_penggajian');
        $this->session->set_flashdata('berhasil', 'Data Berhasil Di Komfrimasi');
        redirect('penggajian/rincian_penggajian/' . $id_penggajian . '');
    }

    function lock_srp($id_penggajian)
    {
        $log = date("Y-m-d H:i:s");
        $data = array(
            'status' => '1',
            'log' => $log
        );

        $where = array('id_penggajian' => $id_penggajian);
        $this->m_crud->ubah($where, $data,  'tbl_penggajian');
        $this->session->set_flashdata('berhasil', 'Data Berhasil Di Komfrimasi');
        redirect('penggajian/rincian_penggajian/' . $id_penggajian . '');
    }

    ///print gaji slip 

    function cetak_rincian_gaji($id)
    {
        $session = $this->session->userdata('level');
        if ($id != '') {
            error_reporting(0);
            $data  = $this->m_master->cetak_struk($id);
            if ($data->num_rows() > 0) {
                $manager = 'Manager';
                $render =
                    [
                        'karyawan_id'   => $data->row()->id_karyawan,
                        'namakaryawan'  => $data->row()->nm_karyawan,
                        'gajipokok'     => $data->row()->gaji_pokok,
                        'tunjangan'     => $data->row()->tunjangan,
                        'period_dari'   => ($data->row()->tgl_penggajian) ? $data->row()->tgl_penggajian : '',
                        'period_sampai' => ($data->row()->tgl_penggajian) ? $data->row()->tgl_penggajian : '',
                        'manager'       => $manager,
                    ];
                $this->load->view('struk_gaji', $render);
            } else {
                echo 'data tidak terparsing dengan baik';
            }
        } else {
            echo 'data tidak terparsing dengan baik';
        }
    }
    ///cetak insentif
    function cetakinsentif($id)
    {
        if ($id) {
            $data  = $this->m_master->cetak_insentif($id);
        }
    }
}
