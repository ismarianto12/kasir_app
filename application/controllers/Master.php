<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->username == '') {
            redirect(base_url(''));
            exit();
        }

        $this->load->model('m_crud');
        $this->load->model('m_master');
        $this->load->model('m_login');
        $this->load->model('m_grafik');
        $this->load->library(['zend']);
    }

    ///////////////////////////////////////////////////////////////////
    /// Controller Pemasok
    //////////////////////////////////////////////////////////////////
    function pemasok()
    {

        $data = array(
            'title' => "Data Pemasok",
            'faicon' => "fa-bell"
        );

        $data['data_pemasok'] = $this->m_crud->tampil('tbl_pemasok')->result();
        $data['content'] = 'pemasok';
        $this->load->view('gaiabiai', $data);
    }

    function pemasokjson()
    {
        error_reporting(0);
        $this->db->db_debug = false;
        try {
            $search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : '';
            $limit = $_POST['length']; // Ambil data limit per page
            $start = $_POST['start']; // Ambil data start
            $sql = $this->db->query("SELECT * FROM tbl_pemasok ORDER BY id_pemasok ASC"); // Query untuk menghitung seluruh data
            $sql->row();

            $query = "SELECT * FROM tbl_pemasok WHERE (nm_pemasok LIKE '%" . $search . "%' OR no_tlpn LIKE '%" . $search . "%' OR alamat LIKE '%" . $search . "%')";
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

    function addpemasok()
    {
        $nm_pemasok = $this->input->post('input_nm_pemasok');
        $alamat = $this->input->post('input_alamat');
        $no_tlpn = $this->input->post('input_no_tlpn');
        $log = date("Y-m-d H:i:s");
        // Generate ID
        $queryGK = $this->db->query("SELECT MAX(id_pemasok) AS kode FROM tbl_pemasok ORDER BY id_pemasok ASC");
        $Gkode = $queryGK->row();
        $kode = $Gkode->kode;
        $noUrut = (int) substr($kode, 4, 4);
        $noUrut++;
        $char = "IDS";
        $id_pemasok = $char . sprintf("%04s", $noUrut);
        // Generate ID

        $data = array(
            'id_pemasok' => $id_pemasok,
            'nm_pemasok' => $nm_pemasok,
            'alamat' => $alamat,
            'no_tlpn' => $no_tlpn,
            'status' => 1,
            'log' => $log,
            'sync' => 1
        );

        $this->m_crud->tambah($data, 'tbl_pemasok');
        $this->session->set_flashdata('berhasil', 'Data Berhasil Di Tambah');
        helper_log("tambah", "Menambahkan data Pemasok");
        redirect('master/pemasok');
    }

    function delpemasok($id_pemasok)
    {
        $query = $this->db->delete('tbl_pemasok', ['id_pemasok' => $id_pemasok]);
        if ($query) {
            $msg = "Data Berhasil Di Hapus";
            $notif = "berhasil";
        } else {
            $this->session->set_flashdata('gagal', 'Pemasok Terintegrasi Pada Data Lain. Silahkan Arsip.');
            redirect('master/pemasok');
        }
        $this->session->set_flashdata($notif, $msg);
        helper_log("hapus", "Menghapus data pemasok");
        redirect('master/pemasok');
    }

    function editpemasok()
    {
        $id_pemasok = $this->input->post('edit_id_pemasok');
        $nm_pemasok = $this->input->post('edit_nm_pemasok');
        $no_tlpn = $this->input->post('edit_no_tlpn');
        $alamat = $this->input->post('edit_alamat');
        $log = date("Y-m-d H:i:s");
        $data = array(
            'id_pemasok' => $id_pemasok,
            'nm_pemasok' => $nm_pemasok,
            'alamat' => $alamat,
            'no_tlpn' => $no_tlpn,
            'log' => $log
        );

        $where = array(
            'id_pemasok' => $id_pemasok
        );

        $this->m_crud->ubah($where, $data, 'tbl_pemasok');
        $this->session->set_flashdata('informasi', 'Data Berhasil Di Ubah');
        helper_log("ubah", "mengubah data pemasok");
        redirect('master/pemasok');
    }
    ///////////////////////////////////////////////////////////////////
    /// Controller Pelanggan
    //////////////////////////////////////////////////////////////////
    function pelanggan()
    {

        $data = array(
            'title' => "Data Pelanggan",
            'faicon' => "fa-handshake-o"
        );

        $data['data_pelanggan'] = $this->m_crud->tampil('tbl_pelanggan')->result();
        $data['content'] = 'pelanggan';
        $this->load->view('gaiabiai', $data);
    }

    function pelangganjson()
    {
        error_reporting(0);
        $this->db->db_debug = false;
        try {
            $search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : '';
            $limit = $_POST['length']; // Ambil data limit per page
            $start = $_POST['start']; // Ambil data start
            $sql = $this->db->query("SELECT * FROM tbl_pelanggan"); // Query untuk menghitung seluruh data
            $sql->row();

            $query = "SELECT * FROM tbl_pelanggan WHERE (nm_pelanggan LIKE '%" . $search . "%' OR no_tlpn LIKE '%" . $search . "%' OR alamat LIKE '%" . $search . "%')";
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

    function addpelanggan()
    {
        $nm_pelanggan = $this->input->post('input_nm_pelanggan');
        $no_tlpn = $this->input->post('input_no_tlpn');
        $alamat = $this->input->post('input_alamat');
        $log = date("Y-m-d H:i:s");
        // Generate ID
        $queryGK = $this->db->query("SELECT MAX(id_pelanggan) AS kode FROM tbl_pelanggan ORDER BY id_pelanggan ASC");
        $Gkode = $queryGK->row();
        $kode = $Gkode->kode;
        $noUrut = (int) substr($kode, 4, 4);
        $noUrut++;
        $char = "IDP";
        $id_pelanggan = $char . sprintf("%04s", $noUrut);
        // Generate ID    

        $data = array(
            'id_pelanggan' =>  $id_pelanggan,
            'nm_pelanggan' =>  $nm_pelanggan,
            'alamat' =>  $alamat,
            'no_tlpn' =>  $no_tlpn,
            'status' =>  '1',
            'log' =>  $log,
            'sync' =>  '0'
        );

        $this->m_crud->tambah($data, 'tbl_pelanggan');
        $this->session->set_flashdata('berhasil', 'Data Berhasil Di Tambah');
        helper_log("tambah", "Menambah data Pelanggan");
        redirect('master/pelanggan');
    }

    function delpelanggan($id_pelanggan)
    {
        $where = array('id_pelanggan' => $id_pelanggan);
        $this->m_crud->hapus($where, 'tbl_pelanggan');
        $this->session->set_flashdata('informasi', 'Data Berhasil Di Hapus');
        helper_log("hapus", "Menghapus data Pelanggan");
        redirect('master/pelanggan');
    }

    function editpelanggan()
    {
        $id_pelanggan = $this->input->post('edit_id_pelanggan');
        $nm_pelanggan = $this->input->post('edit_nm_pelanggan');
        $no_tlpn = $this->input->post('edit_no_tlpn');
        $alamat = $this->input->post('edit_alamat');
        $log = date("Y-m-d H:i:s");
        $data = array(
            'id_pelanggan' => $id_pelanggan,
            'nm_pelanggan' => $nm_pelanggan,
            'alamat' => $alamat,
            'no_tlpn' => $no_tlpn,
            'log' => $log
        );

        $where = array(
            'id_pelanggan' => $id_pelanggan
        );

        $this->m_crud->ubah($where, $data, 'tbl_pelanggan');
        $this->session->set_flashdata('informasi', 'Data Berhasil Di Ubah');
        helper_log("ubah", "Menghapus data Pelanggan");
        redirect('master/pelanggan');
    }
    ///////////////////////////////////////////////////////////////////
    /// Controller Karyawan
    //////////////////////////////////////////////////////////////////
    function karyawan()
    {

        $data = array(
            'title_karyawan' => "Data Karyawan",
            'faicon_karyawan' => "fa-id-badge",
            'title_jabatan' => "Data Jabatan",
            'faicon_jabatan' => "fa-bookmark",
            'title_gaji' => "Data Gaji",
            'faicon_gaji' => "fa-money"
        );

        $data['data_karyawan'] = $this->m_crud->tampil('tbl_karyawan')->result();
        $data['data_jabatan'] = $this->m_crud->tampil('tbl_jabatan')->result();
        $data['data_gaji'] = $this->m_master->data_gaji()->result();
        $data['grafik_karyawan'] = $this->m_grafik->total_karyawan()->result();
        $data['grafik_jabatan'] = $this->m_grafik->total_jabatan()->result();
        $data['idk'] = $this->generateidkaryawan();
        $data['content'] = 'karyawan';
        $this->load->view('gaiabiai', $data);
    }

    function karyawanjson()
    {
        error_reporting(0);
        $this->db->db_debug = false;
        try {
            $search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : '';
            $limit = $_POST['length']; // Ambil data limit per page
            $start = $_POST['start']; // Ambil data start
            $sql = $this->db->query("SELECT tbl_karyawan.id_karyawan,tbl_karyawan.nm_karyawan,tbl_karyawan.id_jabatan,tbl_jabatan.nm_jabatan,tbl_karyawan.tmpt_lahir,DATE_FORMAT(tbl_karyawan.tgl_lahir, '%d/%m/%Y') AS tgl_lahir,tbl_karyawan.alamat,tbl_karyawan.no_tlpn,tbl_karyawan.photo,tbl_karyawan.status 
            FROM tbl_karyawan INNER JOIN tbl_jabatan ON tbl_jabatan.id_jabatan = tbl_karyawan.id_jabatan WHERE tbl_karyawan.status in ('0','1')"); // Query untuk menghitung seluruh data
            $sql->row();

            // Konversi Tanggal
            $pemisah = explode('/', $search);
            $array = array($pemisah[2], $pemisah[1], $pemisah[0]);
            $tgl_lahir = implode('-', $array);
            // End Konversi

            $query = "SELECT tbl_karyawan.id_karyawan,tbl_karyawan.nm_karyawan,tbl_karyawan.id_jabatan,tbl_jabatan.nm_jabatan,tbl_karyawan.tmpt_lahir,DATE_FORMAT(tbl_karyawan.tgl_lahir, '%d/%m/%Y') AS tgl_lahir,tbl_karyawan.alamat,tbl_karyawan.no_tlpn,tbl_karyawan.photo,tbl_karyawan.status 
            FROM tbl_karyawan INNER JOIN tbl_jabatan ON tbl_jabatan.id_jabatan = tbl_karyawan.id_jabatan 
            WHERE tbl_karyawan.status in ('0','1') AND (tbl_karyawan.nm_karyawan LIKE '%" . $search . "%' or tbl_karyawan.tgl_lahir LIKE '%" . $tgl_lahir . "%' or tbl_jabatan.nm_jabatan LIKE '%" . $search . "%' or tbl_karyawan.alamat LIKE '%" . $search . "%' or tbl_karyawan.no_tlpn LIKE '%" . $search . "%')";
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


    function carikaryawanjson($params = '')
    {
        //error_reporting(0);
        //$this->db->db_debug = false;
        try {

            $search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : '';
            $limit = $_POST['length']; // Ambil data limit per page
            $start = $_POST['start']; // Ambil data start
            $sql = $this->db->query("SELECT * FROM tbl_karyawan WHERE status='1'"); // Query untuk menghitung seluruh data
            $sql->row();

            if ($params != '') {
                $qlogin = $this->db->get_where('tbl_login', ['karyawan_id !=' => NULL]);
                $rdata = array();
                foreach ($qlogin->result() as $ls) {
                    $rdata[] = '"' . $ls->karyawan_id . '"';
                }
                $hasil = implode(',', $rdata);
                $query = "
            SELECT
                    * 
                FROM
                    tbl_karyawan
              WHERE tbl_karyawan.id_karyawan NOT IN (" . $hasil . ")";
            } else {
                $query = "SELECT * FROM tbl_karyawan WHERE status='1' AND (nm_karyawan LIKE '%" . $search . "%' OR id_karyawan LIKE '%" . $search . "%')";
            }
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

    function generateidkaryawan()
    {
        // Generate ID
        $queryGK = $this->db->query("SELECT MAX(id_karyawan) AS kode FROM tbl_karyawan ORDER BY id_karyawan ASC");
        $Gkode = $queryGK->row();
        $kode = $Gkode->kode;
        $noUrut = (int) substr($kode, 4, 3);
        $noUrut++;
        $char = "IDK";
        $id = $char . sprintf("%03s", $noUrut);
        // Generate ID   
        return $id;
    }
    function addkaryawan()
    {
        $id_karyawan = $this->input->post('input_id_karyawan');
        $nm_karyawan = $this->input->post('input_nm_karyawan');
        $tmpt_lahir = $this->input->post('input_tmpt_lahir');
        $jabatan = $this->input->post('input_jabatan');
        // Konversi Tanggal
        $input_tgl_lahir = $this->input->post('input_tgl_lahir');
        $pemisah = explode('/', $input_tgl_lahir);
        $array = array($pemisah[2], $pemisah[1], $pemisah[0]);
        $tgl_lahir = implode('-', $array);
        // End Konversi
        $alamat = $this->input->post('input_alamat');
        $no_tlpn = $this->input->post('input_no_tlpn');

        $log = date("Y-m-d H:i:s");

        $ValDat = $this->db->query("SELECT id_karyawan FROM tbl_karyawan WHERE id_karyawan='$id_karyawan'");
        $getValDat = $ValDat->num_rows();
        /////////////////////////////////////////////////////////////////
        //upload photo
        /////////////////////////////////////////////////////////////////
        $file_name        = $_FILES['input_photo']['name'];
        $file_ext        = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        //$nama_file 		= time().'_'.rand(1000,9999).'.'.$file_ext;
        $config['upload_path'] = 'photo/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        //$config['file_name'] = $id_karyawan . '.png';
        $config['file_name'] = time() . '_' . rand(1000, 9999) . '.' . $file_ext;
        $config['max_size'] = 0;
        // $config['max_width'] = 1024;
        // $config['max_height'] = 768; 
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('input_photo')) {
            $this->session->set_flashdata('gagal', 'Gagal Upload Photo!');
            redirect('master/karyawan');
        } else {
            $data = array('upload_data' => $this->upload->data());
        }
        //$photo = $config['upload_path'] . $config['file_name'];
        //$photo = $config['file_name'];
        $photo = $config['file_name'];
        /////////////////////////////////////////////////////////////////

        $data = array(
            'id_karyawan' => $id_karyawan,
            'id_jabatan' => $jabatan,
            'nm_karyawan' => $nm_karyawan,
            'tmpt_lahir' => $tmpt_lahir,
            'tgl_lahir' => $tgl_lahir,
            'alamat' => $alamat,
            'no_tlpn' => $no_tlpn,
            'photo' => $photo,
            'status' => '0',
            'log' => $log
        );

        if ($getValDat > 0) {
            $this->session->set_flashdata('gagal', 'ID Karyawan Sudah Ada.');
            redirect('master/karyawan');
        } else {
            //$this->m_master->add_karyawan($id_karyawan, $nm_karyawan, $tmpt_lahir, $tgl_lahir, $alamat, $no_tlpn, $log);
            $this->m_crud->tambah($data, 'tbl_karyawan');
            $this->session->set_flashdata('berhasil', 'Data Berhasil Di Tambah');
            helper_log("tambah", "Menambah data karyawan");
            redirect('master/karyawan');
        }
    }

    function delkaryawan($id_karyawan)
    {
        $_id = $this->db->get_where('tbl_karyawan', ['id_karyawan' => $id_karyawan])->row();
        $query = $this->db->delete('tbl_karyawan', ['id_karyawan' => $id_karyawan]);
        if ($query) {
            unlink("photo/" . $_id->photo);
        } else {
            $this->session->set_flashdata('gagal', 'Karyawan Terintegrasi Pada Data Lain. Silahkan Arsip.');
            redirect('master/karyawan');
        }
        $this->session->set_flashdata('informasi', 'Data Berhasil Di Hapus');
        helper_log("hapus", "Menghapus data karyawan");
        redirect('master/karyawan');
    }

    function editkaryawan()
    {
        $id_karyawan = $this->input->post('edit_id_karyawan');
        $nm_karyawan = $this->input->post('edit_nm_karyawan');
        $tmpt_lahir = $this->input->post('edit_tmpt_lahir');
        // Konversi Tanggal
        $edit__tgl_lahir = $this->input->post('edit_tgl_lahir');
        $pemisah = explode('/', $edit__tgl_lahir);
        $array = array($pemisah[2], $pemisah[1], $pemisah[0]);
        $tgl_lahir = implode('-', $array);
        // End Konversi
        $jabatan = $this->input->post('input_jabatan');
        $alamat = $this->input->post('edit_alamat');
        $no_tlpn = $this->input->post('edit_no_tlpn');
        $log = date("Y-m-d H:i:s");

        /////////////////////////////////////////////////////////////////
        //upload photo
        /////////////////////////////////////////////////////////////////
        if ($_FILES["edit_photo"]["name"] !== '') {
            // code...
            $file_name        = $_FILES['edit_photo']['name'];
            $file_ext        = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $config['upload_path'] = 'photo/';
            $config['allowed_types']      = 'jpeg|jpg|png';
            //$config['file_name']          = $id_karyawan . '.png';
            $config['file_name'] = time() . '_' . rand(1000, 9999) . '.' . $file_ext;
            $config['max_size']             = 0;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;
            $this->load->library('upload', $config);
            // $this->upload->do_upload('userfile');
            $this->upload->initialize($config);
            //
            if (!$this->upload->do_upload('edit_photo')) {
                $this->session->set_flashdata('gagal', 'Gagal Upload Photo!');
                redirect('master/karyawan');
            } else {
                unlink("photo/" . $this->input->post('edit_photo_before'));
                $data = array('upload_data' => $this->upload->data());
            }
            // exit;
            $photo = $config['file_name'];
        } else {
            $photo = $this->input->post('edit_photo_before');
        }
        /////////////////////////////////////////////////////////////////
        //// Insert Data Karyawan
        /////////////////////////////////////////////////////////////////
        $data = array(
            'id_jabatan' => $jabatan,
            'nm_karyawan' => $nm_karyawan,
            'tmpt_lahir' => $tmpt_lahir,
            'tgl_lahir' => $tgl_lahir,
            'alamat' => $alamat,
            'no_tlpn' => $no_tlpn,
            'photo' => $photo,
            'log' => $log
        );

        $where = array(
            'id_karyawan' => $id_karyawan
        );

        $this->m_crud->ubah($where, $data, 'tbl_karyawan');
        $this->session->set_flashdata('informasi', 'Data Berhasil Di Ubah');
        helper_log("ubah", "Mengubah data karyawan");
        redirect('master/karyawan');
    }

    function status_karyawan($id_karyawan)
    {
        $query = $this->db->query("SELECT `status` FROM tbl_karyawan WHERE id_karyawan='$id_karyawan'");
        $cari_status = $query->row();
        $hasil_status = $cari_status->status;
        $log = date("Y-m-d H:i:s");
        if ($hasil_status == "1") {
            $status = "0";
            $notif = "Status Berhasil Di Non-aktifkan!";
        } else {
            $status = "1";
            $notif = "Status Berhasil Di Aktifkan!";
        }

        $data = array(
            'status' => $status,
            'log' => $log
        );

        $where = array(
            'id_karyawan' => $id_karyawan
        );

        $this->m_crud->ubah($where, $data, 'tbl_karyawan');
        $this->session->set_flashdata('berhasil', $notif);
        helper_log("ubah", "Mengubah status karyawan");
        redirect('master/karyawan');
    }

    function arsipkaryawan($id_karyawan)
    {
        $query = $this->db->query("SELECT `status` FROM tbl_karyawan WHERE id_karyawan='$id_karyawan'");
        $cek_status = $query->row();
        $hasil_status = $cek_status->status;
        $log = date("Y-m-d H:i:s");
        $data = array(
            'status' => '2',
            'log' => $log
        );
        $where = array(
            'id_karyawan' => $id_karyawan
        );

        if ($hasil_status == "1") {
            $msg = "informasi";
            $notif = "Status Karyawan Masih Aktif";
        } else {
            $msg = "berhasil";
            $notif = "Karyawan Berhasil Di Arsip.";
            $this->m_crud->ubah($where, $data, 'tbl_karyawan');
        }

        $this->session->set_flashdata($msg, $notif);
        helper_log("ubah", "Mengarsip status karyawan");
        redirect('master/karyawan');
    }

    ///////////////////////////////////////////////////////////////////
    /// Controller Jabatan
    //////////////////////////////////////////////////////////////////
    function jabatanjson()
    {
        error_reporting(0);
        $this->db->db_debug = false;
        try {
            $search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : '';
            $limit = $_POST['length']; // Ambil data limit per page
            $start = $_POST['start']; // Ambil data start
            $sql = $this->db->query("SELECT * FROM tbl_jabatan WHERE status='1'"); // Query untuk menghitung seluruh data
            $sql->row();

            $query = "SELECT * FROM tbl_jabatan WHERE status='1' AND (nm_jabatan LIKE '%" . $search . "%')";
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

    function addjabatan()
    {
        $nm_jabatan = $this->input->post('input_nm_jabatan');
        $log = date("Y-m-d H:i:s");
        // Generate ID
        $queryGK = $this->db->query("SELECT MAX(id_jabatan) AS kode FROM tbl_jabatan ORDER BY id_jabatan ASC");
        $Gkode = $queryGK->row();
        $kode = $Gkode->kode;
        $noUrut = (int) substr($kode, 4, 3);
        $noUrut++;
        $char = "JBT";
        $id_jabatan = $char . sprintf("%03s", $noUrut);
        // Generate ID    

        $data = array(
            'id_jabatan' => $id_jabatan,
            'nm_jabatan' => $nm_jabatan,
            'status' => '1',
            'log' => $log
        );

        $this->m_crud->tambah($data, 'tbl_jabatan');
        $this->session->set_flashdata('berhasil', 'Data Berhasil Di Tambah');
        redirect('master/karyawan');
    }

    function editjabatan()
    {
        $id_jabatan = $this->input->post('edit_id_jabatan');
        $nm_jabatan = $this->input->post('edit_nm_jabatan');
        $log = date("Y-m-d H:i:s");
        $data = array(
            'nm_jabatan' => $nm_jabatan,
            'log' => $log
        );

        $where = array(
            'id_jabatan' => $id_jabatan
        );

        $this->m_crud->ubah($where, $data, 'tbl_jabatan');
        $this->session->set_flashdata('informasi', 'Data Berhasil Di Ubah');
        redirect('master/karyawan');
    }

    function deljabatan($id_jabatan)
    {
        $where = array('id_jabatan' => $id_jabatan);
        $this->m_crud->hapus($where, 'tbl_jabatan');
        $this->session->set_flashdata('informasi', 'Data Berhasil Di Hapus');
        redirect('master/karyawan');
    }

    ///////////////////////////////////////////////////////////////////
    /// Kategori
    //////////////////////////////////////////////////////////////////
    function kategori()
    {
        $data = array(
            'title' => "Data Kategori"
        );
        $data['data_kategori'] = $this->m_master->data_kategori()->result();
        $this->load->view('admin/kategori', $data);
    }
    function kategorijson()
    {
        error_reporting(0);
        $this->db->db_debug = false;
        try {
            $search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : '';
            $limit = $_POST['length']; // Ambil data limit per page
            $start = $_POST['start']; // Ambil data start
            $sql = $this->db->query("SELECT * FROM tbl_kategori"); // Query untuk menghitung seluruh data
            $sql->row();

            $query = "SELECT * FROM tbl_kategori WHERE (nm_kategori LIKE '%" . $search . "%')";
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
    function addkategori()
    {
        $nm_kategori = $this->input->post('input_nm_kategori');
        $log = date("Y-m-d H:i:s");
        // Generate ID
        $queryGK = $this->db->query("SELECT MAX(id_kategori) AS kode FROM tbl_kategori ORDER BY id_kategori ASC");
        $Gkode = $queryGK->row();
        $kode = $Gkode->kode;
        $noUrut = (int) substr($kode, 4, 4);
        $noUrut++;
        $char = "IDK";
        $id_kategori = $char . sprintf("%04s", $noUrut);
        // Generate ID    
        $this->m_master->add_kategori($id_kategori, $nm_kategori, $log);
        $this->session->set_flashdata('berhasil', 'Data Berhasil Di Tambah');
        redirect('admin/master/kategori');
    }
    function delkategori($id_kategori)
    {
        $where = array('id_kategori' => $id_kategori);
        $this->m_master->delete_kategori($where, 'tbl_kategori');
        $this->session->set_flashdata('informasi', 'Data Berhasil Di Hapus');
        redirect('admin/master/kategori');
    }
    function editkategori()
    {
        $id_kategori = $this->input->post('edit_id_kategori');
        $nm_kategori = $this->input->post('edit_nm_kategori');
        $log = date("Y-m-d H:i:s");
        $data = array(
            'id_kategori' => $id_kategori,
            'nm_kategori' => $nm_kategori,
            'log' => $log
        );

        $where = array(
            'id_kategori' => $id_kategori
        );

        $this->m_master->edit_kategori($where, $data, 'tbl_kategori');
        $this->session->set_flashdata('informasi', 'Data Berhasil Di Ubah');
        redirect('admin/master/kategori');
    }
    ///////////////////////////////////////////////////////////////////
    /// Satuan
    //////////////////////////////////////////////////////////////////
    function satuan()
    {
        $data = array(
            'title' => "Data Satuan"
        );
        $data['data_satuan'] = $this->m_master->data_satuan()->result();
        $this->load->view('admin/satuan', $data);
    }
    function satuanjson()
    {
        error_reporting(0);
        $this->db->db_debug = false;
        try {
            $search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : '';
            $limit = $_POST['length']; // Ambil data limit per page
            $start = $_POST['start']; // Ambil data start
            $sql = $this->db->query("SELECT * FROM tbl_satuan"); // Query untuk menghitung seluruh data
            $sql->row();

            $query = "SELECT * FROM tbl_satuan WHERE (nm_satuan LIKE '%" . $search . "%')";
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
    function addsatuan()
    {
        $nm_satuan = $this->input->post('input_nm_satuan');
        $jumlah = $this->input->post('input_jumlah');
        $log = date("Y-m-d H:i:s");
        // Generate ID
        $queryGK = $this->db->query("SELECT MAX(id_satuan) AS kode FROM tbl_satuan ORDER BY id_satuan ASC");
        $Gkode = $queryGK->row();
        $kode = $Gkode->kode;
        $noUrut = (int) substr($kode, 5, 4);
        $noUrut++;
        $char = "IDST";
        $id_satuan = $char . sprintf("%04s", $noUrut);
        // Generate ID    
        $this->m_master->add_satuan($id_satuan, $nm_satuan, $jumlah, $log);
        $this->session->set_flashdata('berhasil', 'Data Berhasil Di Tambah');
        redirect('admin/master/satuan');
    }
    function delsatuan($id_satuan)
    {
        $where = array('id_satuan' => $id_satuan);
        $this->m_master->delete_satuan($where, 'tbl_satuan');
        $this->session->set_flashdata('informasi', 'Data Berhasil Di Hapus');
        redirect('admin/master/satuan');
    }
    function editsatuan()
    {
        $id_satuan = $this->input->post('edit_id_satuan');
        $nm_satuan = $this->input->post('edit_nm_satuan');
        $jumlah = $this->input->post('edit_jumlah');
        $log = date("Y-m-d H:i:s");
        $data = array(
            'id_satuan' => $id_satuan,
            'nm_satuan' => $nm_satuan,
            'jumlah' => $jumlah,
            'log' => $log
        );

        $where = array(
            'id_satuan' => $id_satuan
        );

        $this->m_master->edit_satuan($where, $data, 'tbl_satuan');
        $this->session->set_flashdata('informasi', 'Data Berhasil Di Ubah');
        redirect('admin/master/satuan');
    }
    ///////////////////////////////////////////////////////////////////
    /// Barang
    //////////////////////////////////////////////////////////////////    
    function barang()
    {

        $data = array(
            'title_barang' => "Data Barang",
            'faicon_barang' => "fa-cube",
            'title_harga' => "Detail Harga Barang",
            'faicon_harga' => "fa-dollar"
        );

        // Referensi
        $data['ref_jenis'] = $this->m_master->ref_jenis()->result();
        $data['edit_ref_jenis'] = $this->m_master->ref_jenis()->result();

        $data['ref_model'] = $this->m_master->ref_model()->result();
        $data['edit_ref_model'] = $this->m_master->ref_model()->result();

        $data['ref_warna'] = $this->m_master->ref_warna()->result();
        $data['edit_ref_warna'] = $this->m_master->ref_warna()->result();

        $data['ref_ukuran'] = $this->m_master->ref_ukuran()->result();
        $data['edit_ref_ukuran'] = $this->m_master->ref_ukuran()->result();

        $data['ref_optional'] = $this->m_master->ref_optional()->result();
        $data['edit_ref_optional'] = $this->m_master->ref_optional()->result();
        // End Referensi
        // Grafik
        $data['grafik_barang'] = $this->m_grafik->grafik_barang()->result();
        // End Grafik
        $data['data_barang'] = $this->m_master->data_barang()->result();
        $data['content'] = 'barang';
        $this->load->view('gaiabiai', $data);
    }

    function get_koderef_jenis()
    {
        $kode_ref = $this->input->post('kode_ref');
        $data = $this->m_master->ref_jenis_barang($kode_ref);
        echo json_encode($data);
    }

    function get_koderef_model()
    {
        $kode_ref = $this->input->post('kode_ref');
        $data = $this->m_master->ref_jenis_model($kode_ref);
        echo json_encode($data);
    }

    function barangjson()
    {
        error_reporting(0);
        $this->db->db_debug = false;
        try {
            $search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : '';
            $limit = $_POST['length']; // Ambil data limit per page
            $start = $_POST['start']; // Ambil data start
            $sql = $this->db->query("SELECT tbl_barang.kode_barang,tbl_gambar.gambar,tbl_barang.nm_barang,tbl_stok.stock,tbl_harga.harga_beli_baru,tbl_harga.harga_jual_baru,tbl_barang.status,tbl_barang.log FROM tbl_barang
            INNER JOIN tbl_stok ON tbl_stok.kode_barang = tbl_barang.kode_barang 
            INNER JOIN tbl_harga ON tbl_harga.kode_barang = tbl_barang.kode_barang
            INNER JOIN tbl_gambar ON tbl_gambar.kode_barang = tbl_barang.kode_barang "); // Query untuk menghitung seluruh data
            $sql->row();

            $query = "SELECT tbl_barang.kode_barang,tbl_barang.nm_barang,tbl_gambar.gambar,tbl_stok.stock,tbl_harga.harga_beli_baru,tbl_harga.harga_jual_baru,tbl_barang.status,tbl_barang.log FROM tbl_barang
            INNER JOIN tbl_stok ON tbl_stok.kode_barang = tbl_barang.kode_barang 
            INNER JOIN tbl_harga ON tbl_harga.kode_barang = tbl_barang.kode_barang 
            INNER JOIN tbl_gambar ON tbl_gambar.kode_barang = tbl_barang.kode_barang WHERE (tbl_barang.nm_barang LIKE '%" . $search . "%' OR tbl_barang.kode_barang LIKE '%" . $search . "%')";
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

    function hargabarangjson()
    {
        error_reporting(0);
        $this->db->db_debug = false;
        try {
            $search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : '';
            $limit = $_POST['length']; // Ambil data limit per page
            $start = $_POST['start']; // Ambil data start
            $sql = $this->db->query("SELECT tbl_barang.kode_barang,tbl_barang.nm_barang,tbl_stok.stock,tbl_harga.harga_beli_lama,tbl_harga.harga_beli_baru,tbl_harga.harga_jual_lama,tbl_harga.harga_jual_baru,tbl_barang.status,tbl_harga.log FROM tbl_barang
            INNER JOIN tbl_stok ON tbl_stok.kode_barang = tbl_barang.kode_barang 
            INNER JOIN tbl_harga ON tbl_harga.kode_barang = tbl_barang.kode_barang"); // Query untuk menghitung seluruh data
            $sql->row();

            $query = "SELECT tbl_barang.kode_barang,tbl_barang.nm_barang,tbl_stok.stock,tbl_harga.harga_beli_lama,tbl_harga.harga_beli_baru,tbl_harga.harga_jual_lama,tbl_harga.harga_jual_baru,tbl_barang.status,tbl_harga.log FROM tbl_barang
            INNER JOIN tbl_stok ON tbl_stok.kode_barang = tbl_barang.kode_barang 
            INNER JOIN tbl_harga ON tbl_harga.kode_barang = tbl_barang.kode_barang WHERE (tbl_barang.nm_barang LIKE '%" . $search . "%' OR tbl_barang.kode_barang LIKE '%" . $search . "%')";
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


    private function generatebr($code)
    {
        $this->zend->load('Zend/Barcode'); 
        $imageResource = Zend_Barcode::factory('code128', 'image', array('text' => $code), array())->draw();
        $imageName = $code . '.jpg';
        $imagePath = 'assets/barcode/'; // penyimpanan file barcode
        imagejpeg($imageResource, $imagePath . $imageName);
        $pathBarcode = $imagePath . $imageName; //Menyimpan path image bardcode kedatabase
        return $pathBarcode;
    }



    function addbarang()
    {
        $nm_barang = $this->input->post('input_nm_barang');
        $pilih_jenis = $this->input->post('pilih_jenis');
        $pilih_model = $this->input->post('pilih_model');
        $pilih_warna = $this->input->post('pilih_warna');
        $pilih_ukuran = $this->input->post('pilih_ukuran');
        $pilih_optional = $this->input->post('pilih_optional');
        $catatan = $this->input->post('catatan');

        $kode_barang = $this->properti->itemcode();

        /////////////////////////////////////////////////////////////////
        //upload Gambar
        /////////////////////////////////////////////////////////////////
        $file_name        = $_FILES['input_gambar']['name'];
        $file_ext        = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        //$nama_file 		= time().'_'.rand(1000,9999).'.'.$file_ext;
        $config['upload_path'] = 'gambar/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        //$config['file_name'] = $id_karyawan . '.png';
        $config['file_name'] = time() . '_' . rand(1000, 9999) . '.' . $file_ext;
        $config['max_size'] = 0;
        // $config['max_width'] = 1024;
        // $config['max_height'] = 768; 
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('input_gambar')) {
            $this->session->set_flashdata('gagal', 'Gagal Upload Gambar!');
            redirect('master/barang');
        } else {
            $data_gambar = array('upload_data' => $this->upload->data());
        }
        //$photo = $config['upload_path'] . $config['file_name'];
        //$photo = $config['file_name'];
        $gambar = $config['file_name'];
        /////////////////////////////////////////////////////////////////

        $data_barang = array(
            'kode_barang' => $kode_barang,
            'nm_barang' => $nm_barang,
            'jenis' => $pilih_jenis,
            'model' => $pilih_model,
            'warna' => $pilih_warna,
            'ukuran' => $pilih_ukuran,
            'tambahan' => $pilih_optional,
            'catatan' => $catatan,
            'sync' => '1',
            'status' => '0'
        );

        $data_stock = array(
            'kode_barang' => $kode_barang,
            'stock' => 0,
            'return' => 0,
            'damage' => 0,
            'loss' => 0
        );

        $data_harga = array(
            'kode_barang' => $kode_barang,
            'harga_beli_lama' => 0,
            'harga_beli_baru' => 0,
            'harga_jual_lama' => 0,
            'harga_jual_baru' => 0
        );

        $data_gambar = array(
            'kode_barang' => $kode_barang,
            'gambar' => $gambar
        );


        $ValDat = $this->db->query("SELECT kode_barang FROM tbl_barang WHERE kode_barang='$kode_barang'");
        $getValDat = $ValDat->num_rows();

        if ($getValDat > 0) {
            $this->session->set_flashdata('gagal', 'Kode Barang Sudah Ada.');
            redirect('master/barang');
        } else {
            $this->generatebr($kode_barang);
            $this->m_master->tambah_barang($data_barang, $data_stock, $data_harga, $data_gambar);
            //$this->m_crud->tambah($data_barang, 'tbl_barang');
            //$this->m_crud->tambah($data_stock, 'tbl_stok');
            $this->session->set_flashdata('berhasil', 'Data Berhasil Di Tambah');
            helper_log("tambah", "Menambahkan data barang");
            redirect('master/barang');
        }
    }

    function delbarang($kode_barang)
    {
        $_id = $this->db->get_where('tbl_gambar', ['kode_barang' => $kode_barang])->row();
        $query = $this->db->delete('tbl_barang', ['kode_barang' => $kode_barang]);
        if ($query) {
            $msg = "Data Berhasil Di Hapus";
            $notif = "berhasil";
            unlink("gambar/" . $_id->gambar);
        } else {
            //$msg = "Barang Terintegrasi Pada Data Lain. Silahkan Arsip.";
            //$notif = "gagal";
            $this->session->set_flashdata('gagal', 'Barang Terintegrasi Pada Data Lain. Silahkan Arsip.');
            redirect('master/barang');
        }
        unlink("assets/barcode/" . $_id->kode_barang . '.jpg');
        $this->session->set_flashdata($notif, $msg);
        helper_log("hapus", "Menghapus data barang");
        redirect('master/barang');
    }

    function status_barang($kode_barang)
    {
        $query = $this->db->query("SELECT `status` FROM tbl_barang WHERE kode_barang='$kode_barang'");
        $cek_status = $query->row();
        $hasil_status = $cek_status->status;
        $log = date("Y-m-d H:i:s");
        if ($hasil_status == "1") {
            $status = "0";
            $notif = "Status Berhasil Di Non-aktifkan!";
        } else {
            $status = "1";
            $notif = "Status Berhasil Di Aktifkan!";
        }
        $data = array(
            'status' => $status,
            'log' => $log
        );

        $where = array(
            'kode_barang' => $kode_barang
        );

        $this->m_crud->ubah($where, $data, 'tbl_barang');
        $this->session->set_flashdata('berhasil', $notif);
        helper_log("ubah", "Mengubah status barang");
        redirect('master/barang');
    }

    function editbarang()
    {
        $kode_barang = $this->input->post('edit_kode_barang');
        $nm_barang = $this->input->post('edit_nm_barang');
        $catatan = $this->input->post('catatan');
        /////////////////////////////////////////////////////////////////
        //upload gambar
        /////////////////////////////////////////////////////////////////
        if ($_FILES["edit_gambar"]["name"] !== '') {
            // code...
            $file_name        = $_FILES['edit_gambar']['name'];
            $file_ext        = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $config['upload_path'] = 'gambar/';
            $config['allowed_types']      = 'jpeg|jpg|png';
            //$config['file_name']          = $id_karyawan . '.png';
            $config['file_name'] = time() . '_' . rand(1000, 9999) . '.' . $file_ext;
            $config['max_size']             = 0;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;
            $this->load->library('upload', $config);
            // $this->upload->do_upload('userfile');
            $this->upload->initialize($config);
            //
            if (!$this->upload->do_upload('edit_gambar')) {
                $this->session->set_flashdata('gagal', 'Gagal Upload Gambar!');
                redirect('master/barang');
            } else {
                unlink("gambar/" . $this->input->post('edit_gambar_before'));
                $data_gambar = array('upload_data' => $this->upload->data());
            }
            // exit;
            $gambar = $config['file_name'];
        } else {
            $gambar = $this->input->post('edit_gambar_before');
        }

        $data_barang = array(
            'nm_barang' => $nm_barang,
            'catatan' => $catatan
        );
        $data_gambar = array(
            'gambar' => $gambar
        );

        $where = array(
            'kode_barang' => $kode_barang
        );

        //$this->m_crud->ubah($where, $data, 'tbl_barang');
        $this->m_master->ubah_barang($where, $data_barang);
        $this->m_master->ubah_gambar_barang($where, $data_gambar);
        $this->session->set_flashdata('informasi', 'Data Berhasil Di Ubah');
        helper_log("ubah", "Mengubah data barang");
        redirect('master/barang');
    }

    function edithargabarang()
    {
        $kode_barang = $this->input->post('edit_kode_barang_harga');
        $stock = $this->input->post('edit_stok');
        $harga_beli_lama = str_replace(".", "", $this->input->post('edit_harga_beli_lama'));
        $harga_beli_baru = str_replace(".", "", $this->input->post('edit_harga_beli_baru'));
        $harga_jual_lama = str_replace(".", "", $this->input->post('edit_harga_jual_lama'));
        $harga_jual_baru = str_replace(".", "", $this->input->post('edit_harga_jual_baru'));
        $log = date("Y-m-d H:i:s");
        $data_stok = array(
            'stock' => $stock,
            'log' =>  $log
        );

        $data_harga = array(
            'harga_beli_lama' => $harga_beli_lama,
            'harga_beli_baru' => $harga_beli_baru,
            'harga_jual_lama' => $harga_jual_lama,
            'harga_jual_baru' => $harga_jual_baru,
            'log' =>  $log
        );


        $where = array(
            'kode_barang' => $kode_barang
        );
        if (!file_exists('assets/barcode/' . $kode_barang . '.jpg')) {
            $this->generatebr($kode_barang);
        }


        //$this->m_crud->ubah($where, $data, 'tbl_gaji');
        $this->m_master->ubah_detail_stok($where, $data_stok);
        $this->m_master->ubah_detail_barang($where, $data_harga);
        $this->session->set_flashdata('informasi', 'Detail Barang Berhasil Di Ubah');
        helper_log("ubah", "Mengubah data harga barang");
        redirect('master/barang');
    }

    ///////////////////////////////////////////////////////////////////
    /// Data Referensi
    //////////////////////////////////////////////////////////////////
    function referensi()
    {

        $data = array(
            'title_referensi' => "Referensi Barang",
            'faicon_referensi' => "fa-cube"
        );
        $data['data_referensi'] = $this->m_crud->tampil('tbl_referensi')->result();
        $data['ref_jenis'] = $this->m_master->ref_jenis()->result();
        $data['ref_jenis_list'] = $this->m_master->ref_jenis_list()->result();
        $data['ref_warna'] = $this->m_master->ref_warna()->result();
        $data['ref_optional'] = $this->m_master->ref_optional()->result();

        $data['grafik_referensi'] = $this->m_grafik->total_referensi()->result();
        ///// UKR ///////////////
        $data['ref_ukuran'] = $this->m_master->ref_jenis_show();
        $data['ref_ukuran_input'] = $this->m_master->ref_jenis_show_input();
        ///// UKR ///////////////

        ///// MDL ///////////////
        $data['ref_model'] = $this->m_master->ref_model_show();
        $data['ref_model_input'] = $this->m_master->ref_model_show_input();
        ///// MDL ///////////////


        $data['content'] = 'referensi';
        $this->load->view('gaiabiai', $data);
    }


    function add_ref()
    {
        $ref = $this->input->post('ref_ref');
        // Urut Link
        $queryUR = $this->db->query("SELECT MAX(link) AS link FROM tbl_referensi WHERE ref='$ref' ORDER BY link ASC ");
        $Gkode = $queryUR->row();
        $kode = $Gkode->link;
        // Urut Link
        if ($ref == "JNS") {
            $link = $kode + 1;
        } elseif ($ref == "UKR") {
            $bl = $this->input->post('ref_link');
            $url = "?pilih_jenis=$bl";
            $link = $this->input->post('ref_link');
        } elseif ($ref == "MDL") {
            $bl = $this->input->post('ref_link');
            $url = "?model_jenis=$bl";
            $link = $this->input->post('ref_link');
        } elseif ($ref == "COL") {
            $url = "";
            $link = '0';
        } elseif ($ref == "OPT") {
            $url = "";
            $link = '0';
        } else {
            $url = "";
            $link = $this->input->post('ref_link');
        }

        $kode_ref = $this->input->post('input_kode_jenis');
        $keterangan_ref = $this->input->post('input_nm_jenis');
        $log = date("Y-m-d H:i:s");

        $data = array(
            'ref' => $ref,
            'link' => $link,
            'kode_ref' => $kode_ref,
            'keterangan_ref' => $keterangan_ref,
            'log' => $log
        );

        $ValDat = $this->db->query("SELECT link FROM tbl_referensi WHERE ref='$ref' AND kode_ref='$kode_ref'");
        $getValDat = $ValDat->num_rows();

        if ($getValDat > 0) {
            $this->session->set_flashdata('gagal', 'Kode Sudah Ada.');
            redirect('master/referensi');
        } else {

            $this->m_crud->tambah($data, 'tbl_referensi');
            $this->session->set_flashdata('berhasil', 'Data Berhasil Di Tambah');
            redirect('master/referensi/' . $url . '');
        }
    }

    function edit_ref()
    {
        $ref = $this->input->post('edit_ref');
        $link = $this->input->post('edit_link');
        $kode_ref = $this->input->post('edit_kode_ref');
        $keterangan_ref = $this->input->post('edit_keterangan_ref');

        $log = date("Y-m-d H:i:s");
        $data = array(
            'keterangan_ref' => $keterangan_ref,
            'log' => $log
        );

        $where = array(
            'kode_ref' => $kode_ref
        );

        if ($ref == "UKR") {
            $url = "?pilih_jenis=$link";
        } elseif ($ref == "MDL") {
            $url = "?model_jenis=$link";
        } else {
            $url = "";
        }


        $this->m_crud->ubah($where, $data, 'tbl_referensi');
        $this->session->set_flashdata('informasi', 'Data Berhasil Di Ubah');
        redirect('master/referensi/' . $url . '');
    }

    function del_ref($kode_ref, $ref, $link)
    {
        if ($ref == "UKR") {
            $url = "?pilih_jenis=$link";
        } elseif ($ref == "MDL") {
            $url = "?model_jenis=$link";
        } else {
            $url = "";
        }
        $where = array('kode_ref' => $kode_ref);
        $this->m_crud->hapus($where, 'tbl_referensi');
        $this->session->set_flashdata('informasi', 'Data Berhasil Di Hapus');
        redirect('master/referensi/' . $url . '');
    }

    ///////////////////////////////////////////////////////////////////
    /// Controller Gaji
    //////////////////////////////////////////////////////////////////
    function gajijson()
    {
        error_reporting(0);
        $this->db->db_debug = false;
        try {
            $search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : '';
            $limit = $_POST['length']; // Ambil data limit per page
            $start = $_POST['start']; // Ambil data start

            $sql = $this->db->query("SELECT tbl_gaji.id_gaji,tbl_gaji.id_karyawan,tbl_karyawan.nm_karyawan,tbl_gaji.gaji_pokok,tbl_gaji.tunjangan,tbl_gaji.status,tbl_gaji.log 
            FROM tbl_gaji
            INNER JOIN tbl_karyawan ON tbl_karyawan.id_karyawan = tbl_gaji.id_karyawan"); // Query untuk menghitung seluruh data
            $sql->row();

            $query = "SELECT tbl_gaji.id_gaji,tbl_gaji.id_karyawan,tbl_karyawan.nm_karyawan,tbl_gaji.gaji_pokok,tbl_gaji.tunjangan,tbl_gaji.status,tbl_gaji.log 
            FROM tbl_gaji
            INNER JOIN tbl_karyawan ON tbl_karyawan.id_karyawan = tbl_gaji.id_karyawan WHERE (tbl_karyawan.nm_karyawan LIKE '%" . $search . "%')";
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
    function addgaji()
    {
        $id_karyawan = $this->input->post('pop_id_karyawan');
        //$nm_karyawan = $this->input->post('pop_nm_karyawan');
        $gaji_pokok = str_replace(".", "", $this->input->post('input_gaji_pokok'));
        $tunjangan = str_replace(".", "", $this->input->post('input_tunjangan'));

        $log = date("Y-m-d H:i:s");
        // Generate ID
        $queryGK = $this->db->query("SELECT MAX(id_gaji) AS kode FROM tbl_gaji ORDER BY id_gaji ASC");
        $Gkode = $queryGK->row();
        $kode = $Gkode->kode;
        $noUrut = (int) substr($kode, 5, 4);
        $noUrut++;
        $char = "GAJI";
        $id_gaji = $char . sprintf("%04s", $noUrut);
        // Generate ID    

        $data = array(
            'id_gaji' => $id_gaji,
            'id_karyawan' => $id_karyawan,
            'gaji_pokok' => $gaji_pokok,
            'tunjangan' => $tunjangan,
            'status' => '0',
            'log' => $log
        );

        $this->m_crud->tambah($data, 'tbl_gaji');
        $this->session->set_flashdata('berhasil', 'Data Berhasil Di Tambah');
        redirect('master/karyawan');
    }

    function editgaji()
    {
        $id_gaji = $this->input->post('edit_id_gaji');
        $id_karyawan = $this->input->post('pop_edit_id_karyawan');
        $gaji_pokok = str_replace(".", "", $this->input->post('edit_gaji_pokok'));
        $tunjangan = str_replace(".", "", $this->input->post('edit_tunjangan'));

        $log = date("Y-m-d H:i:s");
        $data = array(
            'id_karyawan' => $id_karyawan,
            'gaji_pokok' => $gaji_pokok,
            'tunjangan' => $tunjangan,
            'log' => $log
        );

        $where = array(
            'id_gaji' => $id_gaji
        );

        $this->m_crud->ubah($where, $data, 'tbl_gaji');
        $this->session->set_flashdata('informasi', 'Data Berhasil Di Ubah');
        redirect('master/karyawan');
    }

    function delgaji($id_gaji)
    {
        $where = array('id_gaji' => $id_gaji);
        $this->m_crud->hapus($where, 'tbl_gaji');
        $this->session->set_flashdata('informasi', 'Data Berhasil Di Hapus');
        redirect('master/karyawan');
    }

    function kuncigaji($id_gaji)
    {
        $GetStatus = $this->db->query("SELECT `status` FROM tbl_gaji WHERE id_gaji='$id_gaji'");
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
            'id_gaji' => $id_gaji
        );

        $this->m_crud->ubah($where, $data, 'tbl_gaji');
        $this->session->set_flashdata('berhasil', 'Status Akun Berhasil Di Ubah!');
        redirect('master/karyawan');
    }

    public function code($params)
    {
        // You can put anything here to generate of barcode
        $this->set_barcode($params);
    }

    private function set_barcode($code)
    {
        $this->zend->load('Zend/Barcode');
        Zend_Barcode::render('code39', 'image', array('text' => $code));
    }
}
