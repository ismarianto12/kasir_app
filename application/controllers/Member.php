<?php

/*developed by ismarianto putra
  you can visit my site in ismarianto.com
  for more complain anda more information.  
*/

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Member extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Member_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $x['page_title'] = 'Data : Member';
        $this->template->load('Template', 'member/member_list', $x);
    }

    public function json($params = '')
    {
        header('Content-Type: application/json');
        $val = ($params) ? $params : null;
        echo $this->Member_model->json($val);
    }

    public function detail($id)
    {
        $row = $this->Member_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'kode' => $row->kode,
                'nama' => $row->nama,
                'alamat' => $row->alamat,
                'ttl' => $row->ttl,
                'jk' => $row->jk,
                'active' => $row->active,
                'user_id' => $row->user_id,
                'date_created' => $row->date_created,
                'date_updated' => $row->date_updated,

                'page_title' => 'Detail :  MEMBER',
            );
            $this->template->load('Template', 'member/member_read', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warniing fade-in">Data Tidak Di Temukan.</div>');
            redirect(site_url('member'));
        }
    }

    public function tambah()
    {
        $data = array(
            'page_title' => 'Tambah Member',
            'button' => 'Create',
            'action' => site_url('member/tambah_data'),
            'id' => set_value('id'),
            'kode' => set_value('kode'),
            'nama' => set_value('nama'),
            'alamat' => set_value('alamat'),
            'ttl' => set_value('ttl'),
            'jk' => set_value('jk'),
            'active' => set_value('active'),
            'user_id' => set_value('user_id'),
            'date_created' => set_value('date_created'),
            'date_updated' => set_value('date_updated'),
        );
        $this->load->view('member/member_form', $data);
    }

    public function tambah_data()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['type' => 2, 'msg' => validation_errors('<p><b>', '</b></p>')]);
        } else {
            $data = array(
                'kode' => $this->input->post('kode', TRUE),
                'nama' => $this->input->post('nama', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
                'ttl' => $this->input->post('ttl', TRUE),
                'jk' => $this->input->post('jk', TRUE),
                'active' => $this->input->post('active', TRUE),
                'user_id' => $this->session->id_login,
                'date_created' => date('Y-m-d H:i:s'),
                'date_updated' => date('Y-m-d H:i:s'),
            );
            $this->Member_model->insert($data);
            echo json_encode(['type' => 1, 'msg' => "Data berhasil di simpan"]);
        }
    }

    public function edit($id)
    {
        $row = $this->Member_model->get_by_id($id);

        if ($row) {
            $data = array(
                'page_title' => 'Data MEMBER',
                'button' => 'Update',
                'action' => site_url('member/edit_data'),
                'id' => set_value('id', $row->id),
                'kode' => set_value('kode', $row->kode),
                'nama' => set_value('nama', $row->nama),
                'alamat' => set_value('alamat', $row->alamat),
                'ttl' => set_value('ttl', $row->ttl),
                'jk' => set_value('jk', $row->jk),
                'active' => set_value('active', $row->active),
                'user_id' => set_value('user_id', $row->user_id),
                'date_created' => set_value('date_created', $row->date_created),
                'date_updated' => set_value('date_updated', $row->date_updated),
            );
            $this->load->view('member/member_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-info fade-in">Data Tidak Di Temukan.</div>');
            redirect(site_url('member'));
        }
    }

    public function edit_data()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['type' => 2, 'msg' => "<?= validation_errors() ?>"]);
        } else {
            $data = array(
                'kode' => $this->input->post('kode', TRUE),
                'nama' => $this->input->post('nama', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
                'ttl' => $this->input->post('ttl', TRUE),
                'jk' => $this->input->post('jk', TRUE),
                'active' => $this->input->post('active', TRUE),
                'user_id' => $this->session->id_login,
                'date_created' => date('Y-m-d H:i:s'),
                'date_updated' => date('Y-m-d H:i:s'),
            );

            $this->Member_model->update($this->input->post('id', TRUE), $data);
            echo json_encode(['type' => 1, 'msg' => "Data berhasil di simpan"]);
        }
    }

    public function hapus($id)
    {
        $row = $this->Member_model->get_by_id($id);

        if ($row) {
            $this->Member_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert alert-danger fade-in"><i class="fa fa-check"></i>Data Berhasil Di Hapus</div>');
            redirect(site_url('member'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warniing fade-in">Ops Something Went Wrong Please Contact Administrator.</div>');
            redirect(site_url('member'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('kode', 'kode', 'trim|required');
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('ttl', 'ttl', 'trim|required');
        $this->form_validation->set_rules('jk', 'jk', 'trim|required');
        $this->form_validation->set_rules('active', 'active', 'trim|required');
 
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "member.xls";
        $page_title = "member";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Kode");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama");
        xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
        xlsWriteLabel($tablehead, $kolomhead++, "Ttl");
        xlsWriteLabel($tablehead, $kolomhead++, "Jk");
        xlsWriteLabel($tablehead, $kolomhead++, "Active");
        xlsWriteLabel($tablehead, $kolomhead++, "User Id");
        xlsWriteLabel($tablehead, $kolomhead++, "Date Created");
        xlsWriteLabel($tablehead, $kolomhead++, "Date Updated");

        foreach ($this->Member_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->kode);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama);
            xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
            xlsWriteLabel($tablebody, $kolombody++, $data->ttl);
            xlsWriteLabel($tablebody, $kolombody++, $data->jk);
            xlsWriteLabel($tablebody, $kolombody++, $data->active);
            xlsWriteNumber($tablebody, $kolombody++, $data->user_id);
            xlsWriteLabel($tablebody, $kolombody++, $data->date_created);
            xlsWriteLabel($tablebody, $kolombody++, $data->date_updated);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=member.doc");

        $data = array(
            'member_data' => $this->Member_model->get_all(),
            'start' => 0
        );

        $this->load->view('template', 'member/member_doc', $data);
    }
}
