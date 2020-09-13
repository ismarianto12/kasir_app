 <?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Home extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            if ($this->session->userdata('id_login') == '') {
                redirect(base_url('/'));
            }
            $this->load->model('m_login');
        }

        function index()
        {
            $x = [
                'page_title' => 'Halaman awal',
                'jbarang' => '',
                'itemjual' => '',

            ];
            $this->template->load('template', 'home', $x);
        }

        function limit_access()
        {
            $x = ['page_title' => 'Halaman Forbiden'];
            $this->template->load('template', 'forbiden_access', $x);
        }
    }
