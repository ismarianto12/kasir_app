<?php

/*developed by ismarianto putra
  you can visit my site in ismarianto.com
  for more complain anda more information.  
*/
// jasa program bisa di tunggu ismarianto 
// table yang perlu di tambah pada app
// tbl_barang
// tbl_stok
// trtransaksi
// member
// tbl_login
// sett

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trtransaksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->properti->akses();
        $this->load->model(['Trtransaksi_model']);
        $this->load->library(['form_validation', 'Datatables']);
    }

    public function index()
    {
        $x['page_title'] = 'Data : Penjualan';
        $this->template->load('template', 'trtransaksi/trtransaksi_list', $x);
    }

    public function json($params = '')
    {
        echo $this->Trtransaksi_model->json();
    }

    public function detail($id)
    {
        $row = $this->Trtransaksi_model->get_by_id($id);
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
                'page_title' => 'Detail : Penjualan',
            );
            $this->template->load('template', 'trtransaksi/trtransaksi_read', $data);
        } else {
        }
    }

    public function tambah($get_encp = '')
    {
        $encp = $this->properti->rian_encp(RIAN_ENCP);
        if ($encp === $get_encp) {
            $data = array(
                'page_title' => 'Tambah trtransaksi',
                'button' => 'Create',
                'action' => site_url('trtransaksi/tambah_data'),
                'id' => set_value('id'),
                'no_penjualan' => set_value('no_penjualan'),
                'kasir_id' => set_value('kasir_id'),
                'barang_id' => set_value('barang_id'),
                'member_id' => set_value('member_id'),
                'jumlah' => set_value('jumlah'),
                'price' => set_value('price'),
                'nm_barang' => set_value('nm_barang'),
                'diskon' => set_value('diskon'),
                'date_created' => set_value('date_created'),
                'date_updated' => set_value('date_updated'),
            );
            $this->load->view('trtransaksi/trtransaksi_form', $data);
        } else {
            echo json_encode(['msg' => 'gagal parsing data ke halamana']);
        }
    }

    public function tambah_data()
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $pesan = ['msg' => str_replace('<span class="text-danger"></span>', ' ', validation_errors())];
            echo json_encode($pesan);
        } else {

            $diskon       = (int) $this->input->post('diskon');
            $id_barang    = (int) $this->input->post('barang_id');
            if ($diskon > 0 || $diskon != '') {
                $rharga   = (int)$this->input->post('price') * ($this->input->post('diskon') / 100);
                $subtotal = (int)$this->input->post('price') - $rharga;
            } else {
                $subtotal = $this->input->post('price');
            }

            $cek_barang = $this->db->get_where('trtransaksi', [
                'no_penjualan' => $this->input->post('no_penjualan')
            ]);


            //cek datai table stok
            $rstok = $this->db->get_where('tbl_stok', [
                'kode_barang' => $this->input->post('barang_id'),
            ]);
            $fharga  = $this->input->post('price');
            $fdiskon = ($this->input->post('diskon')) ? $this->input->post('diskon') : 0;
            if ($cek_barang->num_rows() > 0) {

                if ($rstok->num_rows() > 0) {
                    $upstok = (int) $rstok->row()->stock;
                    $stok2  =  (int) $cek_barang->row()->jumlah;
                    if ($upstok < $stok2) {
                        $pesan = ['msg' => 'jumlah stok tidak memadai'];
                        echo json_encode($pesan);
                        exit();
                    }
                }
                $jumlahupdate =  (int) $cek_barang->row()->jumlah * (int) $this->input->post('jumlah');
                $gjumlah      =  (int)$this->input->post('price') * (int) $jumlahupdate - ((int) $this->input->post('diskon') / 100) * $this->input->post('price');
                $rsubtotal    =  $gjumlah * (int) $jumlahupdate;


                $data = array(
                    'no_penjualan' => $this->input->post('no_penjualan', TRUE),
                    'kasir_id' => $this->session->id_login,
                    'barang_id' => $this->input->post('barang_id', TRUE),
                    'member_id' => $this->input->post('member_id', TRUE),
                    'jumlah' => $jumlahupdate,
                    'price' => $this->input->post('price'),
                    'item_name' => $this->input->post('item'),
                    'subtotal' => $rsubtotal,
                    'diskon' => ($this->input->post('diskon')) ? $this->input->post('diskon') : 0,
                );
                $stat = $this->db->update('trtransaksi', $data, [
                    'no_penjualan' => $this->input->post('no_penjualan')
                ]);
                $pesan = ['msg' => 'ok'];
                echo json_encode($pesan);
            } else {

                if ($rstok->num_rows() > 0) {
                    $upstok = (int) $rstok->row()->stock;
                    $stok2  =  (int) $this->input->post('jumlah');
                    if ($upstok <= $stok2) {
                        $pesan = ['msg' => 'jumlah stok tidak memadai'];
                        echo json_encode($pesan);
                        exit();
                    }
                }
                $totalj       =  (int)$this->input->post('price') * $this->input->pot('jumlah');
                $rsubtotal    =  $totalj  - ((int) $this->input->post('diskon') / 100) * $this->input->post('price');
               
                $data = array(
                    'no_penjualan' => $this->input->post('no_penjualan', TRUE),
                    'kasir_id' => $this->session->id_login,
                    'barang_id' => $this->input->post('barang_id', TRUE),
                    'member_id' => $this->input->post('member_id', TRUE),
                    'jumlah' => ($this->input->post('jumlah', TRUE)) ? $this->input->post('jumlah', TRUE) : 'null',
                    'price' => $this->input->post('price'),
                    'item_name' => $this->input->post('price'),
                    'subtotal' => $rsubtotal,
                    'diskon' => $fdiskon,
                );
                $stat = $this->Trtransaksi_model->insert($data);
                $pesan = ['msg' => 'ok'];
                echo json_encode($pesan);
            }
        }
    }
    function hapus_transaksi()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $faktur_no   = $this->input->post('ktransaksi');
            $data        = $this->db->get_where('trtransaksi', ['no_penjualan' => trim($faktur_no)]);
            if ($data->num_rowS() > 0) {
                $procesed = $this->db->delete('trtransaksi', ['no_penjualan' => $faktur_no]);
                if ($procesed) {
                    echo json_encode(['stat' => 1, 'msg' => 'Data Penjualan telah di batalkan']);
                } else {
                    echo json_encode(['stat' => 2, 'msg' => 'Data base tidak mengenali kode faktur saat ini']);
                }
            } else {
                echo json_encode(['stat' => 2, 'msg' => 'data penjualan gagal di hapus']);
            }
        }
    }

    function simpan_penjualan()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $faktur_no   = $this->input->post('ktransaksi');
            $data        = $this->db->get_where('trtransaksi', ['no_penjualan' => trim($faktur_no)]);
            if ($data->num_rowS() > 0) {
                $datalist = [];
                foreach ($data->result() as $row) {
                    $datalist[] = [
                        'no_penjualan' => $row->no_penjualan,
                        'kasir_id' => $this->session->id_login,
                        'barang_id' => $row->barang_id,
                        'member_id' => $row->member_id,
                        'jumlah' => $row->jumlah,
                        'subtotal' => $row->subtotal,
                        'date_created' => date('Y-m-d h:i:s'),
                        'date_updated' => date('Y-m-d h:i:s'),
                    ];
                }
                $procesed = $this->db->insert_batch('tmpenjualan', $datalist);
                $procesed = $this->db->update(
                    'trtransaksi',
                    array('finish' => '1'),
                    array('no_penjualan' => trim($faktur_no))
                );

                $rstok = $this->db->get_where('tbl_stok', [
                    'kode_barang' => $row->barang_id
                ]);
                if ($rstok->num_rows() > 0) {
                    $upstok = (int) $rstok->row()->stock - (int) $row->jumlah;
                    $this->db->update('tbl_stok', [
                        'stock' => $upstok
                    ], [
                        'kode_barang' => $row->barang_id
                    ]);
                }

                if ($procesed) {
                    echo json_encode(['stat' => 1, 'msg' => 'Data Penjualan telah di simpan']);
                } else {
                    echo json_encode(['stat' => 2, 'msg' => 'Data base tidak mengenali kode faktur saat ini']);
                }
            } else {
                echo json_encode(['stat' => 2, 'msg' => 'data penjualan gagal di simpan']);
            }
        }
    }

    function getStruckno($rian_encp)
    {
        $encp = $this->properti->rian_encp(RIAN_ENCP);

        $nomor = $this->properti->post_code();
        echo json_encode(['stat' => 'ok', 'nomor' => $nomor]);
    }
    //get detail transaksi
    function detail_transaki($id)
    {
        if ($id != '') {
            $this->db->select('
            trtransaksi.id as id_penjualan,
            trtransaksi.no_penjualan, 
            trtransaksi.jumlah, 
            trtransaksi.member_id,  
            trtransaksi.barang_id, 
            trtransaksi.barang_id,  
            trtransaksi.kasir_id,  
            trtransaksi.price, 
            trtransaksi.diskon, 
            trtransaksi.finish,
            
            tbl_barang.kode_barang, 
            tbl_barang.nm_barang, 
            tbl_barang.jenis, 
            tbl_barang.model, 
            tbl_barang.warna, 
            tbl_barang.ukuran, 
            tbl_barang.tambahan, 

            tbl_stok.kode_barang, 
            tbl_stok.stock,

            member.nama, 
            member.alamat, 
            member.ttl, 
            member.kode,  
            member.id, 

            tbl_login.username, 
            tbl_login.password, 
            tbl_login.id_login, 
            tbl_login.level, 
            tbl_login.status,
            
            tbl_harga.kode_barang,
            tbl_harga.harga_beli_lama,
            tbl_harga.harga_beli_baru,
            tbl_harga.harga_jual_lama,
            tbl_harga.harga_jual_baru ');
            $this->db->from('trtransaksi');
            $this->db->join('tbl_barang', 'tbl_barang.kode_barang = trtransaksi.barang_id', 'left outer');
            $this->db->join('tbl_stok', 'tbl_stok.kode_barang = tbl_barang.kode_barang', 'left outer');
            $this->db->join('member', 'trtransaksi.member_id  = member.id', 'left outer');
            $this->db->join('tbl_login', 'trtransaksi.kasir_id = tbl_login.id_login', 'left outer');
            $this->db->join('tbl_harga', 'tbl_barang.kode_barang = tbl_harga.kode_barang', 'left outer');
            $this->db->where('trtransaksi.finish', '0');
            $this->db->where('trtransaksi.id', $id);
            $this->db->group_by('trtransaksi.id');
            return $this->db->get();
        } else {
            return null;
        }
    }

    public function edit($id, $get_encp = '')
    {

        $encp = $this->properti->rian_encp(RIAN_ENCP);
        //  if ($encp === $get_encp) {
        $check = $this->detail_transaki($id);
        if ($check->num_rows() > 0) {
            $row = $check->row();
            $data = array(
                'button' => 'Update',
                'action' => site_url('trtransaksi/edit_data'),
                'id' => set_value('id', $row->id_penjualan),
                'no_penjualan' => set_value('no_penjualan', $row->no_penjualan),
                'nm_barang' => set_value('nm_barang', $row->nm_barang),
                'kasir_id' => set_value('kasir_id', $row->kasir_id),
                'barang_id' => set_value('barang_id', $row->barang_id),
                'member_id' => set_value('member_id', $row->member_id),
                'jumlah' => set_value('jumlah', $row->jumlah),
                'price' => set_value('price', $row->price),
                'diskon' => set_value('diskon', $row->diskon),
            );
            $this->load->view('trtransaksi/trtransaksi_form', $data);
        } else {
        }
        // } else {
        //     echo json_encode(['msg' => 'data tidak terparsing dengan baik']);
        // }
    }

    public function edit_data()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $pesan = ['msg' => validation_errors()];
            echo json_encode($pesan);
        } else {
            $diskon    = (int) $this->input->post('diskon');
            $id_barang = (int) $this->input->post('id_barang');
            if ($diskon > 0 || $diskon != '') {
                $rharga   = (int)$this->input->post('price') * ($this->input->post('diskon') / 100);
                $subtotal = (int)$this->input->post('price') - $rharga;
            } else {
                $subtotal = $this->input->post('price');
            }

            $rsubtotal = $subtotal * (int) $this->input->post('jumlah');

            //cek datai table stok
            $rstok = $this->db->get_where('tbl_stok', [
                'kode_barang' => $this->input->post('id_barang'),
            ]);

            if ($rstok->num_rows() > 0) {
                $upstok = (int) $rstok->row()->stock;
                $stok2  =  (int) $this->input->post('jumlah');
                if ($upstok  <= $stok2) {
                    $pesan = ['msg' => 'jumlah stok tidak memadai'];
                    echo json_encode($pesan);
                    exit();
                }
            }

            $data = array(
                'no_penjualan' => $this->input->post('no_penjualan', TRUE),
                'kasir_id' => $this->session->id_login,
                'barang_id' => $this->input->post('barang_id', TRUE),
                'member_id' => $this->input->post('member_id', TRUE),
                'jumlah' => $this->input->post('jumlah', TRUE),
                'subtotal' => $rsubtotal,
                'diskon' => ($this->input->post('diskon')) ? $this->input->post('diskon') : 0,
                'date_created' => date('Y-m-d H:i:s'),
                'date_updated' => date('Y-m-d H:i:s'),
            );
            $stat = $this->Trtransaksi_model->update($this->input->post('id', TRUE), $data);
            $pesan = ['msg' => 'ok'];
            echo json_encode($pesan);
        }
    }

    public function hapus()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $id  = $this->input->post('id');
            $row = $this->Trtransaksi_model->get_by_id($id);
            if ($row) {
                $this->Trtransaksi_model->delete($id);
                echo json_encode(['msg' => 'data berhasil di hapus']);
            } else {
                echo json_encode(['msg' => 'maaf kesalah teknis data untuk saat ini tidak bisa di hapus .']);
            }
        }
    }

    public function get_scan()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            error_reporting(0);
            $no_barang = $this->input->post('no_barang');
            $data      = $this->Trtransaksi_model->getdatabarang($no_barang);
            if ($data->num_rows() > 0) {
                $response = [
                    'nm_barang' => $data->row()->nm_barang,
                    'kode_barang' => $data->row()->kode_barang,
                    'item' => $data->row()->nm_barang,
                    'price' => $data->row()->harga_jual_baru,
                ];
                echo json_encode($response);
            } else {
                $response = [
                    'nm_barang' => '',
                    'kode_barang' => '',
                    'item' => '',
                    'price' => '',
                ];
                echo json_encode($response);
            }
        }
    }

    function print_struk($id)
    {
        if ($id != '') {
            $data      = $this->Trtransaksi_model->strukPrint(trim($id));
            if ($data->num_rows() > 0) {
                $x    = [
                    'n_struk' => $id,
                    'render' => $data
                ];
                $this->load->view('trtransaksi/struk', $x);
                $data = ['stock' => -1];
                $this->db->update("tbl_stok", $data, ['kode_barang' => $id]);
            } else {
                echo json_encode(['msg' => 'data tidak terparsing dengan baik']);
            }
        } else {
        }
    }






    public function _rules()
    {
        $this->form_validation->set_rules('no_penjualan', 'no penjualan', 'trim|required');
        $this->form_validation->set_rules('barang_id', 'barang id', 'trim|required');
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "trtransaksi.xls";
        $page_title = "trtransaksi";
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

        foreach ($this->Trtransaksi_model->get_all() as $data) {
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
        header("Content-Disposition: attachment;Filename=trtransaksi.doc");

        $data = array(
            'trtransaksi_data' => $this->Trtransaksi_model->get_all(),
            'start' => 0
        );

        $this->load->view('Template', 'trtransaksi/trtransaksi_doc', $data);
    }
}
