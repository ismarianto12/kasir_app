<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->session->userdata('id_login') != '') {
            redirect(base_url('/home?page=login'));
            exit();
        };
        
        $x   = [
            'page_title' => 'Login Aplikasi',
        ];
        $this->load->view('login_apps', $x);
    }

    function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $this->properti->attemp($username, $password);
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
