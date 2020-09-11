<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //load model admin
        $this->load->model('m_crud');
        $this->load->model('m_grafik');
        $this->load->model('m_login');

        // print_r($_SERVER['PATH_INFO']);
        // exit();

        // $this->user_id = $this->session->user_id;
        // $this->access  = $_SERVER['PATH_INFO'];
        // $this->properti->limitaccess($this->user_id, $this->access);


    }
    ///////////////////////////////////////////////////////////////////
    /// Controller akun
    //////////////////////////////////////////////////////////////////
    public function index()
    {
        $data = array(
            'title' => "Data Akun",
            'faicon' => "fa-user"
        );

        $data['grafik'] = $this->m_grafik->total_akun()->result();
        $data['data_akun'] = $this->m_crud->tampil('tbl_login')->result();
        $data['content'] = 'akun';
        $this->load->view('gaiabiai', $data);
    }

    function akun()
    {
        $data = array(
            'title' => "Data Akun"
        );
        $data['data_akun'] = $this->m_pengaturan->data_akun()->result();
        $this->load->view('administrator/akun', $data);
    }

    function akunjson()
    {
        // error_reporting(0);
        // $this->db->db_debug = false;
        try {
            $search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : '';
            $limit = $_POST['length']; // Ambil data limit per page
            $start = $_POST['start']; // Ambil data start
            $sql = $this->db->query("SELECT * FROM tbl_login 
             INNER JOIN tbl_karyawan on tbl_karyawan.id_karyawan = tbl_login.karyawan_id 
             WHERE  tbl_login.status  in ('0','1') ORDER BY id_login ASC"); // Query untuk menghitung seluruh data
            $sql->row();

            $query = "SELECT * FROM tbl_login 
                       INNER JOIN tbl_karyawan on tbl_karyawan.id_karyawan = tbl_login.karyawan_id  
                       WHERE  tbl_login.status  in ('0','1') AND (username LIKE '%" . $search . "%')";
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

    function addakun()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $username = $this->input->post('input_username');
            $password = $this->input->post('input_password');
            $level = $this->input->post('input_level');
            $name  = ($this->input->post('nama_karyawan')) ? $this->input->post('nama_karyawan') : '';
            $karyawan_id = $this->input->post('karyawan_id');

            $log = date("Y-m-d H:i:s");
            // Generate ID
            $queryGK = $this->db->query("SELECT MAX(SUBSTR(id_login,-1)) as kode from tbl_login ORDER BY id_login ASC");
            $Gkode = $queryGK->row();
            $kode = $Gkode->kode;
            $kode++;
            $char = "IDL";
            $id_login = $char . sprintf("%04s", $kode);
            // Generate ID


            $data = array(
                'id_login' => $id_login,
                'karyawan_id' => $this->input->post('karyawan_id'),
                'username' => $username,
                'name' => ($this->input->post('nama_karyawan')) ? $this->input->post('nama_karyawan') : '',
                'password' => SHA1($password),
                'level' => $level,
                'status' => 1,
                'updatefromweb' => 1,
                'log' => $log
            );

            $ValDat = $this->db->query("SELECT username FROM tbl_login WHERE username='$username'");
            $getValDat = $ValDat->num_rows();

            if ($getValDat > 0) {
                echo json_encode(['status' => 2, 'msg' => 'Data user sudah ada ']);
            } else {
                $cek = $this->db->get_where('tbl_login', ['karyawan_id' => $karyawan_id]);
                if ($cek->num_rows() > 0) {
                    echo json_encode(['status' => 2, 'msg' => 'Data user sudah ada ']);
                } else {
                    $this->m_crud->tambah($data, 'tbl_login');
                    $hak_akses = implode('.', $this->input->post('hak_akses[]'));

                    $this->db->insert('tmprivelage', [
                        'user_id' => $id_login,
                        'priv_name' => $hak_akses,
                    ]);
                    echo json_encode(['status' => 1, 'msg' => 'data berhasil di simpan.']);
                }
            }
        } else {
            echo json_encode(['msg' => 'maaf serer tidak bisa menerima request cliennt support id']);
        }
    }

    function editstatus($id_login)
    {
        $GetStatus = $this->db->query("SELECT `status` FROM tbl_login WHERE id_login='$id_login'");
        $Astatus = $GetStatus->row();
        $Hstatus = $Astatus->status;
        $log = date("Y-m-d H:i:s");
        if ($Hstatus == "1") {
            $status = "0";
        } else {
            $status = "1";
        }
        $data = array(
            'status' => $status,
            'log' => $log
        );


        $where = array(
            'id_login' => $id_login
        );

        $this->m_crud->ubah($where, $data, 'tbl_login');
        $hak_akses = implode('.', $this->input->post('hak_akses[]'));

        $this->session->set_flashdata('berhasil', 'Status Akun Berhasil Di Ubah!');
        redirect('akun');
    }

    function arsipakun($id_login)
    {
        $log = date("Y-m-d H:i:s");
        $data = array(
            'status' => '2',
            'log' => $log
        );


        $where = array(
            'id_login' => $id_login
        );
        $this->m_crud->ubah($where, $data, 'tbl_login');
        $this->session->set_flashdata('berhasil', 'Akun Berhasil Di Arsip!');
        redirect('akun');
    }

    /*
    function delakun($id_login)
    {
        $where = array('id_login' => $id_login);
        $this->m_pengaturan->delete_akun($where, 'tbl_login');
        $this->session->set_flashdata('informasi', 'Data Berhasil Di Hapus');
        redirect('administrator/pengaturan/akun');
    }
    */

    function editakun()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $id_login   = $this->input->post('edit_id_login');
            $username   = $this->input->post('edit_username');
            $password   = $this->input->post('edit_password');
            $name       = $this->input->post('name');
            $karyawan_id = $this->input->post('karyawan_id');

            $check_data = $this->db->get_where(
                'tbl_login',
                [
                    'username' => trim($this->input->post('username'))
                ]
            );
            if ($check_data->num_rows() > 0) {
                echo json_encode(['status' => 2, 'msg' => 'Data username sudah ada ']);
            } else {
                $GetPassOld = $this->db->query("SELECT `password` FROM tbl_login WHERE id_login='$id_login'");
                $Apass = $GetPassOld->row();
                $Hpass = $Apass->password;
                if ($Hpass == $password) {
                    $pass = $password;
                } else {
                    $pass = SHA1($password);
                }
                $level = $this->input->post('edit_level');
                $log = date("Y-m-d H:i:s");
                $data = array(
                    'id_login' => $id_login,
                    'username' => $username,
                    'password' => $pass,
                    'name'     => $name,
                    'level'    => $level,
                    'updatefromweb' => 1,
                    'log' => $log
                );
                $where = array(
                    'id_login' => $id_login
                );

                $this->m_crud->ubah($where, $data, 'tbl_login');
                $mod = implode('.', $this->input->post('hak_akses[]'));

                $this->db->update(
                    'tmprivelage',
                    [
                        'priv_name' => $mod,
                    ],
                    [
                        'user_id' => $id_login
                    ]
                );
                echo json_encode(['status' => 1, 'msg' => 'data tidak bisa response silahkan periksa paramter ...']);
            }
        } else {
            echo json_encode(['msg' => 'data tidak bisa response silahkan periksa paramter ...']);
        }
    }
}
