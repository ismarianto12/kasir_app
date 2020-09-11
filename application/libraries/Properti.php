<?php
//by ismarianto 


class Properti
{

    private $aControllers;

    function __construct()
    {
        $this->ci  = &get_instance();
    }

    function checkkaryawan($username, $password)
    {
        return $this->ci->db->query(" 
            SELECT
            tbl_login.id_login, 
            tbl_login.karyawan_id, 
            tbl_login.username, 
            tbl_login.password, 
            tbl_login.name, 
            tbl_login.level, 
            tbl_login.status,  

            tbl_karyawan.id_karyawan, 
            tbl_karyawan.id_jabatan, 
            tbl_karyawan.nm_karyawan, 
            tbl_karyawan.tmpt_lahir, 
            tbl_karyawan.tgl_lahir, 
            tbl_karyawan.alamat, 
            tbl_karyawan.no_tlpn, 
            tbl_karyawan.photo, 
            tbl_karyawan.status, 
            tbl_karyawan.log
            FROM
            tbl_login
            INNER JOIN
            tbl_karyawan
            ON 
            tbl_login.karyawan_id = tbl_karyawan.id_karyawan
            where 
            tbl_login.username = '" . $username . "' AND
            tbl_login.password = '" . sha1($password) . "'

            ");
    }

    public function attemp($username, $password)
    {
        $r_pass   = trim($password);
        $checking = $this->ci->db->get_where('tbl_login', ['username' => $username, 'password' => sha1($r_pass)]);
        if ($checking->num_rows() > 0) {
            if ($checking->row()->level == 'manager' or $checking->row()->level == 'admin') {
                $session_data = array(
                    'id_login'  => $checking->row()->id_login,
                    'username'  => $checking->row()->username,
                    'password'  => $checking->row()->password,
                    'name'      => $checking->row()->name,
                    'level'     => $checking->row()->level,
                    'status'    => $checking->row()->status
                );
                echo json_encode(['response' => 'ok']);
                //set session userdata
                $this->ci->session->set_userdata($session_data);
            } else {
                //if karyawan 
                $checking = $this->checkkaryawan($username, $password);
                if ($checking->num_rows() > 0) {
                    $session_data = array(
                        'id_login'  => $checking->row()->id_login,
                        'username'  => $checking->row()->username,
                        'password'  => $checking->row()->password,
                        'name'      => $checking->row()->nm_karyawan,
                        'level'     => $checking->row()->level,
                        'status'    => $checking->row()->status
                    );
                    echo json_encode(['response' => 'ok']);
                    //set session userdata
                    $this->ci->session->set_userdata($session_data);
                }
            }
        } else {
            echo json_encode(['response' => 'fails']);
        }
    }

    //istance
    public function set_access(array $level)
    {
        $get_access = null;
        if (in_array($get_access, $level)) {
        } else {
            return $this->ci->load->view('restric_area');
        }
    }

    ///set code post 
    //kode to str
    function itemcode()
    {
        $data = $this->ci->db->select('count(kode_barang) as itmkode')
            ->from('tbl_barang')
            ->get();

        $data   = (int) $data->row()->itmkode;
        if ($data == 0) {
            $nilai = 1;
        } else {
            $nilai = $data + 1;
        }
        $hasil   = $nilai++;
        $r_hasil =  str_pad($hasil, 9, '0', STR_PAD_LEFT);
        return '1054' . $r_hasil;
    }

    function post_code()
    {
        $data = $this->ci->db->select_max('id')
            ->from('tmpenjualan')
            ->get();

        $data    = (int) $data->row()->id;
        if ($data == 0) {
            $nilai = 1;
        } else {
            $nilai = $data;
        }
        $hasil   = $nilai++;
        $r_hasil =  str_pad($hasil, 8, '0', STR_PAD_LEFT);
        return 'STR-BJ' . $r_hasil;
    }

    function rian_encp($key)
    {
        return sha1('rian' . md5($key) . 'rian');
    }

    function getData($table, $column, $id, $value)
    {
        $r =  $this->ci->db->get_where($table, [$column, $id]);
        if ($r->num_rows() > 0) {
            return $r->row()->$value;
        } else {
            return null;
        }
    }

    //library menu
    function menu_app($level)
    {
        //         id_login
        // username
        // password
        // level
        // status
        $this->parent = '';
        $this->child  = '';
    }
    function akses()
    {
        if ($this->ci->session->userdata('id_login') != '') {
        } else {
            redirect(base_url());
        }
    }


    public function identitas($params)
    {
        $arr = [
            'nama_instansi',
            'alamat_lengkap',
            'telp',
            'informasi',
            'keterangan_situs',
            'fax',
            'npwp',
            'logo',
            'jabatan',
            'nip',
            'nama_pejabat',
            'ip_addres',
            'favicon',
        ];
        if (in_array($params, $arr)) {
            $data = $this->ci->db->select($params)->limit(1)->from('instansi')->get();
            return $data->row()->$params;
        } else {
            return null;
        }
    }

    function get_access()
    {
        $this->ci->load->helper('file');
        $controllers = get_filenames(APPPATH . 'controllers/');

        foreach ($controllers as $k => $v) {
            if (strpos($v, '.php') === FALSE) {
                unset($controllers[$k]);
            }
        }

        foreach ($controllers as $controller) {
            $scontroller = str_replace('.php', '', $controller);
            echo '<option><b>' . $scontroller . '</b></option>';

            include_once APPPATH . 'controllers/' . $controller;
            $methods = get_class_methods(str_replace('.php', '', $controller));

            foreach ($methods as $method) {

                $pattern = "/^.*json$/";
                $string  = $method;
                $count   = preg_match($pattern, $string);

                $pattern1 = "/^.*private function$/";
                $string1  = $method;
                $count1   = preg_match($pattern1, $string1);

                if (!$count && !$count1) {
                    if ($method != "__construct" && $method != "get_instance" && $method != "index" && $method != '_rules' && $method != 'json') {
                        $cmethod = str_replace('.php', '', $method);
                        echo '<option value="' . $scontroller . '/' . $cmethod . '">---' . ucfirst($cmethod) . '</option>';
                    }
                } else {
                }
            }
            echo '</option>';
        }
    }

    function getModul()
    {
        return $this->ci->db->get_where('tmmodul', ['active' => 'Y'])->result();
    }
    //get list class
    function getlist()
    {

        $controllers = get_filenames(APPPATH . 'controllers/');
        foreach ($controllers as $modules_all) {

            if (is_dir($modules_all)) {
                $dirname = basename($modules_all);
                foreach (glob(APPPATH . 'controllers/*') as $subdircontroller) {
                    $subdircontrollername = basename($subdircontroller, 'php');


                    if (!class_exists($subdircontrollername)) {
                        $this->ci->load->file($subdircontroller);
                    }

                    $aMethods = get_class_methods($subdircontrollername);
                    $aUserMethods = array();
                    foreach ($aMethods as $method) {
                        if ($method != '__construct' && $method != 'get_instance' && $method != $subdircontrollername) {
                            $aUserMethods[] = $method;
                        }
                    }
                    return  $this->setControllerMethods($subdircontrollername, $aUserMethods);
                }
            }
        }
    }

    public function setControllerMethods($p_sControllerName, $p_aControllerMethods)
    {
        $this->aControllers[$p_sControllerName] = $p_aControllerMethods;
    }

    //limitation access 

    function limitaccess($user_id, $request_mod)
    {

        require_once 'Template.php';
        $template    = new Template;
        // id
        // user_id
        // priv_name
        // params
        // updated_at
        // created_at
        $data =  $this->ci->db->select('
            user_id,
            priv_name,
            params  
            ')->from('tmprivelage')
            ->where('user_id', $user_id)
            ->get();
        if ($data->num_rows() > 0) {
            $ls = explode('.', $data->row()->priv_name);
            foreach ($ls as $l) {
                $mod = trim($l);
                $ck = $this->ci->db->get_where(
                    'tmmodul',
                    [
                        'modulnm' => $mod,
                        'url'     => $request_mod,
                    ]
                );
                if ($ck->num_rows() > 0) {
                } else {
                    redirect('forbiden');
                    exit();
                }
            }
        } else {
            redirect('forbiden');
            exit();
        }
    }
    function isAutority(array $params)
    {
        if (is_array($params)) {
            if (in_array($params, $this->ci->session->userdata('level'))) {
                //  return true;
            } else {
                //    return false;        
            }
        } else {
            echo "cannot init";
        }
    }


    function getMaager()
    {
        $data = $this->ci->db->query("SELECT
            tbl_karyawan.id_karyawan,
            gaiabai.tbl_karyawan.id_jabatan,
            gaiabai.tbl_karyawan.nm_karyawan,
            gaiabai.tbl_karyawan.tgl_lahir,
            gaiabai.tbl_karyawan.tmpt_lahir,
            gaiabai.tbl_karyawan.alamat,
            gaiabai.tbl_login.username,
            gaiabai.tbl_login.`name`,
            gaiabai.tbl_login.`password`,
            gaiabai.tbl_login.`status`,
            gaiabai.tbl_login.`level` 
        FROM
            gaiabai.tbl_karyawan
            INNER JOIN gaiabai.tbl_login ON gaiabai.tbl_karyawan.id_karyawan = gaiabai.tbl_login.karyawan_id 
        WHERE
            tbl_login.LEVEL = 'manager' 
            OR tbl_login.LEVEL = 'administrator'");
        if ($data->num_rows() > 0) {
            $nmanager = $data->row()->nm_karyawan;
        } else {
            $nmanager = 'null';
        }
    }

    function Greeting()
    {
        return "Aplikasi BUTIQUE POIN OF SALE V.1";
    }
    function tgl_indonesia($tgl)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tgl);
        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }

    function generatebr($code)
    { 
        $this->zend->load('Zend/Barcode');

        $imageResource = Zend_Barcode::factory('code128', 'image', array('text' => $code), array())->draw();
        $imageName = $code . '.jpg';
        $imagePath = 'assets/barcode/'; // penyimpanan file barcode
        imagejpeg($imageResource, $imagePath . $imageName);
        $pathBarcode = $imagePath . $imageName; //Menyimpan path image bardcode kedatabase
        return $pathBarcode;
    }
}
