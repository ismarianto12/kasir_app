<?php

/*developed by ismarianto putra
  you can visit my site in ismarianto.com
  for more complain anda more information.  
*/

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tmmodul extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tmmodul_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $x['page_title'] = 'Data : Tmmodul';
        $this->template->load('Template', 'tmmodul/tmmodul_list', $x);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Tmmodul_model->json();
    }

    public function detail($id)
    {
        $row = $this->Tmmodul_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'modulnm' => $row->modulnm,
                'url' => $row->url,
                'params' => $row->params,
                'active' => $row->active,
                'user_id' => $row->user_id,
                'date_created' => $row->date_created,
                'date_updated' => $row->date_updated,

                'page_title' => 'Detail :  TMMODUL',
            );
            $this->template->load('Template', 'tmmodul/tmmodul_read', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warniing fade-in">Data Tidak Di Temukan.</div>');
            redirect(site_url('tmmodul'));
        }
    }

    public function tambah()
    {
        $data = array(
            'page_title' => 'Tambah Tmmodul',
            'button' => 'Create',
            'action' => site_url('tmmodul/tambah_data'),
            'id' => set_value('id'),
            'modulnm' => set_value('modulnm'),
            'url' => set_value('url'),
            'params' => set_value('params'),
            'active' => set_value('active'),
            'user_id' => set_value('user_id'),
            'date_created' => set_value('date_created'),
            'date_updated' => set_value('date_updated'),
        );
        $this->template->load('Template', 'tmmodul/tmmodul_form', $data);
    }

    public function tambah_data()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $data = array(
                'modulnm' => $this->input->post('modulnm', TRUE),
                'url' => $this->input->post('url', TRUE),
                'params' => $this->input->post('params', TRUE),
                'active' => $this->input->post('active', TRUE),
                'user_id' => $this->input->post('user_id', TRUE),
                'date_created' => $this->input->post('date_created', TRUE),
                'date_updated' => $this->input->post('date_updated', TRUE),
            );

            $this->Tmmodul_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success fade-in"><i class="fa fa-check"></i>Data Berhasil Di Tambahkan.</div>');
            redirect(site_url('tmmodul'));
        }
    }

    public function edit($id)
    {
        $row = $this->Tmmodul_model->get_by_id($id);

        if ($row) {
            $data = array(
                'page_title' => 'Data TMMODUL',
                'button' => 'Update',
                'action' => site_url('tmmodul/edit_data'),
                'id' => set_value('id', $row->id),
                'modulnm' => set_value('modulnm', $row->modulnm),
                'url' => set_value('url', $row->url),
                'params' => set_value('params', $row->params),
                'active' => set_value('active', $row->active),
                'user_id' => set_value('user_id', $row->user_id),
                'date_created' => set_value('date_created', $row->date_created),
                'date_updated' => set_value('date_updated', $row->date_updated),
            );
            $this->template->load('Template', 'tmmodul/tmmodul_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-info fade-in">Data Tidak Di Temukan.</div>');
            redirect(site_url('tmmodul'));
        }
    }

    public function edit_data()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id', TRUE));
        } else {
            $data = array(
                'modulnm' => $this->input->post('modulnm', TRUE),
                'url' => $this->input->post('url', TRUE),
                'params' => $this->input->post('params', TRUE),
                'active' => $this->input->post('active', TRUE),
                'user_id' => $this->input->post('user_id', TRUE),
                'date_created' => $this->input->post('date_created', TRUE),
                'date_updated' => $this->input->post('date_updated', TRUE),
            );

            $this->Tmmodul_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success fade-in"><i class="fa fa-check"></i>Edit Data Berhasil.</div>');
            redirect(site_url('tmmodul'));
        }
    }

    public function hapus($id)
    {
        $row = $this->Tmmodul_model->get_by_id($id);

        if ($row) {
            $this->Tmmodul_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert alert-danger fade-in"><i class="fa fa-check"></i>Data Berhasil Di Hapus</div>');
            redirect(site_url('tmmodul'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warniing fade-in">Ops Something Went Wrong Please Contact Administrator.</div>');
            redirect(site_url('tmmodul'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('modulnm', 'modulnm', 'trim|required');
        $this->form_validation->set_rules('url', 'url', 'trim|required');
        $this->form_validation->set_rules('params', 'params', 'trim|required');
        $this->form_validation->set_rules('active', 'active', 'trim|required');
        $this->form_validation->set_rules('user_id', 'user id', 'trim|required');
        $this->form_validation->set_rules('date_created', 'date created', 'trim|required');
        $this->form_validation->set_rules('date_updated', 'date updated', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tmmodul.xls";
        $page_title = "tmmodul";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Modulnm");
        xlsWriteLabel($tablehead, $kolomhead++, "Url");
        xlsWriteLabel($tablehead, $kolomhead++, "Params");
        xlsWriteLabel($tablehead, $kolomhead++, "Active");
        xlsWriteLabel($tablehead, $kolomhead++, "User Id");
        xlsWriteLabel($tablehead, $kolomhead++, "Date Created");
        xlsWriteLabel($tablehead, $kolomhead++, "Date Updated");

        foreach ($this->Tmmodul_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->modulnm);
            xlsWriteLabel($tablebody, $kolombody++, $data->url);
            xlsWriteLabel($tablebody, $kolombody++, $data->params);
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
        header("Content-Disposition: attachment;Filename=tmmodul.doc");

        $data = array(
            'tmmodul_data' => $this->Tmmodul_model->get_all(),
            'start' => 0
        );

        $this->load->view('Template', 'tmmodul/tmmodul_doc', $data);
    }
}
