<?php
class Profile extends CI_controller
{
	function __construct()
	{
		parent::__construct();
	}
	function index()
	{
		$row = $this->db->get_where('tbl_login', array('id_login' => $this->session->id_login))->row();
		$x = array(
			'page_title' => 'Edit Profile',
			'id_user' => $row->id_login,
			'username' => $row->username,
			'password' => $row->password,
			'nama' => $row->name,
			'level' => $row->level,
			'status' => $row->status,
		);
		$this->template->load('Template', 'profil', $x);
	}
	function action_insert()
	{
		if ($_SERVER['REQUEST_METHOD'] == "POST") {

			$data = array(
				'username' => $this->input->post('username', TRUE),
				'password' => $this->input->post('password', TRUE),
				'nama' => $this->input->post('nama', TRUE),
				'level' => $this->input->post('level'),
				'log' => date('Y-m-d H:i:s'),
			);
			$this->db->update('tbl_login', $data, array('id_login' => $this->session->id_login));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		$this->form_validation->set_rules('nama', 'nama', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}
