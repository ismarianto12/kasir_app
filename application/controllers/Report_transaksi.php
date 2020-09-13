<?php

/*developed by ismarianto putra
  you can visit my site in ismarianto.com
  for more complain anda more information.  
*/

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_transaksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mreport_transaksi');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $x['page_title'] = 'Data Report Penjulan';
        $this->template->load('template', 'report_transaksi/tmpenjualan_list', $x);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Mreport_transaksi->json();
    }

    public function detail($id)
    {
        $row = $this->Mreport_transaksi->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'no_penjualan' => $row->no_penjualan,
                'kasir_id' => $row->kasir_id,
                'barang_id' => $row->barang_id,
                'member_id' => $row->member_id,
                'jumlah' => $row->jumlah,
                'diskon' => $row->diskon,
                'price' => $row->price,
                'item_name' => $row->item_name,
                'date_created' => $row->date_created,
                'date_updated' => $row->date_updated,

                'page_title' => 'Detail :  REPORT_TRANSAKSI',
            );
            $this->template->load('template', 'report_transaksi/tmpenjualan_read', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warniing fade-in">Data Tidak Di Temukan.</div>');
            redirect(site_url('report_transaksi'));
        }
    }

    public function tambah()
    {
        $data = array(
            'page_title' => 'Tambah Report transaksi',
            'button' => 'Create',
            'action' => site_url('report_transaksi/tambah_data'),
            'id' => set_value('id'),
            'no_penjualan' => set_value('no_penjualan'),
            'kasir_id' => set_value('kasir_id'),
            'barang_id' => set_value('barang_id'),
            'member_id' => set_value('member_id'),
            'jumlah' => set_value('jumlah'),
            'diskon' => set_value('diskon'),
            'price' => set_value('price'),
            'item_name' => set_value('item_name'),
            'date_created' => set_value('date_created'),
            'date_updated' => set_value('date_updated'),
        );
        $this->template->load('template', 'report_transaksi/tmpenjualan_form', $data);
    }

    public function tambah_data()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $data = array(
                'no_penjualan' => $this->input->post('no_penjualan', TRUE),
                'kasir_id' => $this->input->post('kasir_id', TRUE),
                'barang_id' => $this->input->post('barang_id', TRUE),
                'member_id' => $this->input->post('member_id', TRUE),
                'jumlah' => $this->input->post('jumlah', TRUE),
                'diskon' => $this->input->post('diskon', TRUE),
                'price' => $this->input->post('price', TRUE),
                'item_name' => $this->input->post('item_name', TRUE),
                'date_created' => $this->input->post('date_created', TRUE),
                'date_updated' => $this->input->post('date_updated', TRUE),
            );

            $this->Mreport_transaksi->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success fade-in"><i class="fa fa-check"></i>Data Berhasil Di Tambahkan.</div>');
            redirect(site_url('report_transaksi'));
        }
    }

    public function edit($id)
    {
        $row = $this->Mreport_transaksi->get_by_id($id);

        if ($row) {
            $data = array(
                'page_title' => 'Data REPORT_TRANSAKSI',
                'button' => 'Update',
                'action' => site_url('report_transaksi/edit_data'),
                'id' => set_value('id', $row->id),
                'no_penjualan' => set_value('no_penjualan', $row->no_penjualan),
                'kasir_id' => set_value('kasir_id', $row->kasir_id),
                'barang_id' => set_value('barang_id', $row->barang_id),
                'member_id' => set_value('member_id', $row->member_id),
                'jumlah' => set_value('jumlah', $row->jumlah),
                'diskon' => set_value('diskon', $row->diskon),
                'price' => set_value('price', $row->price),
                'item_name' => set_value('item_name', $row->item_name),
                'date_created' => set_value('date_created', $row->date_created),
                'date_updated' => set_value('date_updated', $row->date_updated),
            );
            $this->template->load('template', 'report_transaksi/tmpenjualan_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-info fade-in">Data Tidak Di Temukan.</div>');
            redirect(site_url('report_transaksi'));
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
                'kasir_id' => $this->input->post('kasir_id', TRUE),
                'barang_id' => $this->input->post('barang_id', TRUE),
                'member_id' => $this->input->post('member_id', TRUE),
                'jumlah' => $this->input->post('jumlah', TRUE),
                'diskon' => $this->input->post('diskon', TRUE),
                'price' => $this->input->post('price', TRUE),
                'item_name' => $this->input->post('item_name', TRUE),
                'date_created' => $this->input->post('date_created', TRUE),
                'date_updated' => $this->input->post('date_updated', TRUE),
            );

            $this->Mreport_transaksi->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success fade-in"><i class="fa fa-check"></i>Edit Data Berhasil.</div>');
            redirect(site_url('report_transaksi'));
        }
    }

    public function hapus($id)
    {
        $row = $this->Mreport_transaksi->get_by_id($id);
        if ($row) {
            $this->Mreport_transaksi->delete($id);
       
         } else { 
        }
        echo json_encode(['msg'=>'data berhasil di hapus ']);
    }

    public function _rules()
    {
        $this->form_validation->set_rules('no_penjualan', 'no penjualan', 'trim|required');
        $this->form_validation->set_rules('kasir_id', 'kasir id', 'trim|required');
        $this->form_validation->set_rules('barang_id', 'barang id', 'trim|required');
        $this->form_validation->set_rules('member_id', 'member id', 'trim|required');
        $this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');
        $this->form_validation->set_rules('diskon', 'diskon', 'trim|required');
        $this->form_validation->set_rules('price', 'price', 'trim|required|numeric');
        $this->form_validation->set_rules('item_name', 'item name', 'trim|required');
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
        xlsWriteLabel($tablehead, $kolomhead++, "Diskon");
        xlsWriteLabel($tablehead, $kolomhead++, "Price");
        xlsWriteLabel($tablehead, $kolomhead++, "Item Name");
        xlsWriteLabel($tablehead, $kolomhead++, "Date Created");
        xlsWriteLabel($tablehead, $kolomhead++, "Date Updated");

        foreach ($this->Mreport_transaksi->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_penjualan);
            xlsWriteLabel($tablebody, $kolombody++, $data->kasir_id);
            xlsWriteLabel($tablebody, $kolombody++, $data->barang_id);
            xlsWriteNumber($tablebody, $kolombody++, $data->member_id);
            xlsWriteLabel($tablebody, $kolombody++, $data->jumlah);
            xlsWriteNumber($tablebody, $kolombody++, $data->diskon);
            xlsWriteNumber($tablebody, $kolombody++, $data->price);
            xlsWriteLabel($tablebody, $kolombody++, $data->item_name);
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
            'tmpenjualan_data' => $this->Mreport_transaksi->get_all(),
            'start' => 0
        );

        $this->load->view('template', 'report_transaksi/tmpenjualan_doc', $data);
    }
}
