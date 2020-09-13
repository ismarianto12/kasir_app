<?php

/*developed by ismarianto putra
  you can visit my site in ismarianto.com
  for more complain anda more information.  
*/ 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['Tmpenjualan_model', 'Trtransaksi_model']);
        $this->load->library(['form_validation', 'Datatables']);
    }

    public function index()
    {
        $x['page_title'] = 'Data : Penjualan';
        $this->template->load('template', 'tmpenjualan/tmpenjualan_list', $x);
    }

    public function json($params = '')
    {
        if ($params != '' || $params = 'transaksi') {
            echo $this->Trtransaksi_model->json();
        } else {
            echo $this->Tmpenjualan_model->json();
        }
    }

    public function detail($id)
    {
        $row = $this->Tmpenjualan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'no_penjualan' => $row->no_penjualan,
                'kasir_id' => $row->kasir_id,
                'barang_id' => $row->barang_id,
                'member_id' => $row->member_id,
                'jumlah' => $row->jumlah,
                'date_created' => $row->date_created,
                'date_updated' => $row->date_updated,
                'page_title' => 'Detail :  TMPENJUALAN',
            );
            $this->template->load('template', 'tmpenjualan/tmpenjualan_read', $data);
        } else {
        }
    }

    public function tambah($get_encp = '')
    {
        $encp = $this->properti->rian_encp(RIAN_ENCP);
        if ($encp === $get_encp) {
            $data = array(
                'page_title' => 'Tambah Tmpenjualan',
                'button' => 'Create',
                'action' => site_url('tmpenjualan/tambah_data'),
                'id' => set_value('id'),
                'no_penjualan' => set_value('no_penjualan'),
                'kasir_id' => set_value('kasir_id'),
                'barang_id' => set_value('barang_id'),
                'member_id' => set_value('member_id'),
                'jumlah' => set_value('jumlah'),
                'date_created' => set_value('date_created'),
                'date_updated' => set_value('date_updated'),
            );
            $this->load->view('tmpenjualan/tmpenjualan_form', $data);
        } else {
            echo json_encode(['msg' => 'gagal parsing data ke halamana']);
        }
    }

    public function tambah_data()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            // $diskon    = (int) $this->input->post('diskon');
            // $id_barang = (int) $this->input->post('id_barang');
            // if ($diskon != '') {
            // } else {
            // }

            $data = array(
                'no_penjualan' => $this->input->post('no_penjualan', TRUE),
                'kasir_id' => $this->session->id_login,
                'barang_id' => $this->input->post('barang_id', TRUE),
                'member_id' => $this->input->post('member_id', TRUE),
                'jumlah' => $this->input->post('jumlah', TRUE),
                'diskon' => ($this->input->post('diskon')) ? $this->input->post('diskon') : 0,
                'date_created' => date('Y-m-d H:i:s'),
                'date_updated' => date('Y-m-d H:i:s'),
            );
            $this->Trtansaksi_model->insert($data);
        }
    }

    public function edit($id, $get_encp = '')
    {

        $encp = $this->properti->rian_encp(RIAN_ENCP);
        if ($encp === $get_encp) {
            $row = $this->Tmpenjualan_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('tmpenjualan/edit_data'),
                    'id' => set_value('id', $row->id),
                    'no_penjualan' => set_value('no_penjualan', $row->no_penjualan),
                    'kasir_id' => set_value('kasir_id', $row->kasir_id),
                    'barang_id' => set_value('barang_id', $row->barang_id),
                    'member_id' => set_value('member_id', $row->member_id),
                    'jumlah' => set_value('jumlah', $row->jumlah),
                    'date_created' => set_value('date_created', $row->date_created),
                    'date_updated' => set_value('date_updated', $row->date_updated),
                );
                $this->template->load('template', 'tmpenjualan/tmpenjualan_form', $data);
            } else {
            }
        } else {
            echo json_encode(['msg' => 'data tidak terparsing dengan baik']);
        }
    }

    public function edit_data()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id', TRUE));
        } else {
            $data = array(
                'no_penjualan' => $this->input->post('no_penjualan', TRUE),
                'kasir_id' => $this->session->id_login,
                'barang_id' => $this->input->post('barang_id', TRUE),
                'member_id' => $this->input->post('member_id', TRUE),
                'jumlah' => $this->input->post('jumlah', TRUE),
                'diskon' => ($this->input->post('diskon')) ? $this->input->post('diskon') : 0,
                'date_created' => date('Y-m-d H:i:s'),
                'date_updated' => date('Y-m-d H:i:s'),
            );
            $this->Tmpenjualan_model->update($this->input->post('id', TRUE), $data);
        }
    }

    public function hapus()
    {
        if ($_REQUEST['METHOD'] == "POST") {
            $id  = $this->input->post('id');
            $row = $this->Tmpenjualan_model->get_by_id($id);
            if ($row) {
                $this->Tmpenjualan_model->delete($id);
                echo json_encode(['msg' => 'data berhasil di hapus']);
            } else {
                echo json_encode(['msg' => 'maaf kesalah teknis data untuk saat ini tidak bisa di hapus .']);
            }
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('no_penjualan', 'no penjualan', 'trim|required');
        $this->form_validation->set_rules('kasir_id', 'kasir id', 'trim|required');
        $this->form_validation->set_rules('barang_id', 'barang id', 'trim|required');
        $this->form_validation->set_rules('member_id', 'member id', 'trim|required');
        $this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');
        $this->form_validation->set_rules('date_created', 'date created', 'trim|required');
        $this->form_validation->set_rules('date_updated', 'date updated', 'trim|required');
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tmpenjualan.xls";
        $page_title = "tmpenjualan";
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
        xlsWriteLabel($tablehead, $kolomhead++, "No Penjualan");
        xlsWriteLabel($tablehead, $kolomhead++, "Kasir Id");
        xlsWriteLabel($tablehead, $kolomhead++, "Barang Id");
        xlsWriteLabel($tablehead, $kolomhead++, "Member Id");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
        xlsWriteLabel($tablehead, $kolomhead++, "Date Created");
        xlsWriteLabel($tablehead, $kolomhead++, "Date Updated");

        foreach ($this->Tmpenjualan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_penjualan);
            xlsWriteLabel($tablebody, $kolombody++, $data->kasir_id);
            xlsWriteLabel($tablebody, $kolombody++, $data->barang_id);
            xlsWriteNumber($tablebody, $kolombody++, $data->member_id);
            xlsWriteLabel($tablebody, $kolombody++, $data->jumlah);
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
        header("Content-Disposition: attachment;Filename=tmpenjualan.doc");

        $data = array(
            'tmpenjualan_data' => $this->Tmpenjualan_model->get_all(),
            'start' => 0
        );

        $this->load->view('template', 'tmpenjualan/tmpenjualan_doc', $data);
    }
}
