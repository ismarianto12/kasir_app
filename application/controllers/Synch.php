<?php
class Synch extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == '') {
            redirect(base_url('/'));
        }
        $this->load->model('m_master'); 
        $this->load->library(['zend']);
    }
    function index()
    {
        $render = [
            'page_title' => "Sinkronisasi data",
        ];
        $this->template->load('template', 'synch/sync', $render);
    }
  
    public function code($params)
    { 
        $this->set_barcode($params);
    }

    private function set_barcode($code)
    {
        $this->zend->load('Zend/Barcode');
        Zend_Barcode::render('code39', 'image', array('text' => $code));
    }
    function sycndata_barang($params)
    {
       error_reporting(0);
        if ($params == 'send') {
            $this->server->trans_begin();
            $tbl_barang  = $this->server->get('tbl_barang');
            foreach ($tbl_barang->result_array() as $rbarang) {
                $check = $this->server->get_where('tbl_barang', ['kode_barang' => $rbarang['kode_barang']]);
                 
                if ($check->num_rows() > 0) {
                    //$this->set_barcode($rbarang['kode_barang']);
                
                    $updata = [
                        'kode_barang' => $rbarang['kode_barang'],
                        'nm_barang' => $rbarang['nm_barang'],
                        'jenis' => $rbarang['jenis'],
                        'model' => $rbarang['model'],
                        'warna' => $rbarang['warna'],
                        'ukuran' => $rbarang['ukuran'],
                        'catatan' => $rbarang['catatan'],
                        'tambahan' => $rbarang['tambahan'],
                        'sync' => $rbarang['sync'],
                        'status' => $rbarang['status'],
                        'log' => $rbarang['log'],
                    ];
                    $this->server->update('tbl_barang', $updata, ['kode_barang' => $rbarang['kode_barang']]);
                } else {
                    $this->set_barcode($rbarang['kode_barang']);
                
                    $data = [
                        'kode_barang' => $rbarang['kode_barang'],
                        'nm_barang' => $rbarang['nm_barang'],
                        'jenis' => $rbarang['jenis'],
                        'model' => $rbarang['model'],
                        'warna' => $rbarang['warna'],
                        'ukuran' => $rbarang['ukuran'],
                        'catatan' => $rbarang['catatan'],
                        'tambahan' => $rbarang['tambahan'],
                        'sync' => $rbarang['sync'],
                        'status' => $rbarang['status'],
                        'log' => $rbarang['log'],
                    ];
                    $this->server->insert('tbl_barang', $data);
                }
            }
            //trans stok
            $tbl_stok   = $this->server->get('tbl_stok');
            foreach ($tbl_stok->result_array() as $rstok) {
                $check = $this->server->get_where('tbl_stok', ['kode_barang' => $rstok['kode_barang']]);
                if ($check->num_rows() > 0) {
                } else {
                    $stokinsert =  [
                        'kode_barang' => $rstok['kode_barang'],
                        'stock' => $rstok['stock'],
                        'return' => $rstok['return'],
                        'damage' => $rstok['damage'],
                        'loss' => $rstok['loss'],
                        'log' => $rstok['log'],
                    ];
                    $this->server->insert('tbl_stok', $stokinsert);
                }
            }

            //tbl harga     
            $tbl_harga   = $this->server->get('tbl_harga');
            foreach ($tbl_harga->result_array() as $rharga) {
                $check = $this->server->get_where('tbl_harga', ['kode_barang' => $rharga['kode_barang']]);
                if ($check->num_rows() > 0) {
                } else {
                    $dharga = [
                        'kode_barang' => $rharga['kode_barang'],
                        'harga_beli_lama' => $rharga['harga_beli_lama'],
                        'harga_beli_baru' => $rharga['harga_beli_baru'],
                        'harga_jual_lama' => $rharga['harga_jual_lama'],
                        'harga_jual_baru' => $rharga['harga_jual_baru'],
                        'log' => $rharga['log'],
                    ];
                    $this->server->insert('tbl_harga', $dharga);
                }
            }
            $tbl_gambar  = $this->server->get('tbl_gambar');
            foreach ($tbl_gambar->result_array() as $rgambar) {
                $check = $this->server->get_where('tbl_gambar', ['kode_barang' => $rharga['kode_barang']]);
                if ($check->num_rows() > 0) {
                } else {
                    $datagambar =  [
                        'kode_barang' => $rgambar['kode_barang'],
                        'gambar' => $rgambar['gambar'],
                        'log' => $rgambar['log'],
                    ];
                    $this->server->insert('tbl_gambar', $datagambar);
                }
            }

            if ($this->lokal->trans_status() === FALSE) {
                $this->lokal->trans_rollback();
                echo json_encode(['status' => 2, 'msg' => 'dalam proses']);
            } else {
                $this->lokal->trans_commit();
                echo json_encode(['status' => 1, 'msg' => 'data berhasil di sychkan']);
            }
        } elseif ($params == 'receive') {
            $this->lokal->trans_begin();
            $tbl_barang  = $this->server->get('tbl_barang');
            foreach ($tbl_barang->result_array() as $rbarang) {
                $check = $this->lokal->get_where('tbl_barang', ['kode_barang' => $rbarang['kode_barang']]);
                if ($check->num_rows() > 0) {
                      $updata = [
                        'kode_barang' => $rbarang['kode_barang'],
                        'nm_barang' => $rbarang['nm_barang'],
                        'jenis' => $rbarang['jenis'],
                        'model' => $rbarang['model'],
                        'warna' => $rbarang['warna'],
                        'ukuran' => $rbarang['ukuran'],
                        'catatan' => $rbarang['catatan'],
                        'tambahan' => $rbarang['tambahan'],
                        'sync' => $rbarang['sync'],
                        'status' => $rbarang['status'],
                        'log' => $rbarang['log'],
                    ];
                    $this->lokal->update('tbl_barang', $updata, ['kode_barang' => $rbarang['kode_barang']]);
                } else {
                    $this->set_barcode($rbarang['kode_barang']);
                
                    $data = [
                        'kode_barang' => $rbarang['kode_barang'],
                        'nm_barang' => $rbarang['nm_barang'],
                        'jenis' => $rbarang['jenis'],
                        'model' => $rbarang['model'],
                        'warna' => $rbarang['warna'],
                        'ukuran' => $rbarang['ukuran'],
                        'catatan' => $rbarang['catatan'],
                        'tambahan' => $rbarang['tambahan'],
                        'sync' => $rbarang['sync'],
                        'status' => $rbarang['status'],
                        'log' => $rbarang['log'],
                    ];
                    $this->lokal->insert('tbl_barang', $data);
                }
            }
            //trans stok
            $tbl_stok   = $this->server->get('tbl_stok');
            foreach ($tbl_stok->result_array() as $rstok) {
                $check = $this->lokal->get_where('tbl_stok', ['kode_barang' => $rstok['kode_barang']]);
                if ($check->num_rows() > 0) {
                } else {
                    $stokinsert =  [
                        'kode_barang' => $rstok['kode_barang'],
                        'stock' => $rstok['stock'],
                        'return' => $rstok['return'],
                        'damage' => $rstok['damage'],
                        'loss' => $rstok['loss'],
                        'log' => $rstok['log'],
                    ];
                    $this->lokal->insert('tbl_stok', $stokinsert);
                }
            }

            //tbl harga     
            $tbl_harga   = $this->server->get('tbl_harga');
            foreach ($tbl_harga->result_array() as $rharga) {
                $check = $this->lokal->get_where('tbl_harga', ['kode_barang' => $rharga['kode_barang']]);
                if ($check->num_rows() > 0) {
                } else {
                    $dharga = [
                        'kode_barang' => $rharga['kode_barang'],
                        'harga_beli_lama' => $rharga['harga_beli_lama'],
                        'harga_beli_baru' => $rharga['harga_beli_baru'],
                        'harga_jual_lama' => $rharga['harga_jual_lama'],
                        'harga_jual_baru' => $rharga['harga_jual_baru'],
                        'log' => $rharga['log'],
                    ];
                    $this->lokal->insert('tbl_harga', $dharga);
                }
            }

            $tbl_gambar  = $this->server->get('tbl_gambar');
            foreach ($tbl_gambar->result_array() as $rgambar) {
                $check = $this->lokal->get_where('tbl_gambar', ['kode_barang' => $rharga['kode_barang']]);
                if ($check->num_rows() > 0) {
                } else {
                    $datagambar =  [
                        'kode_barang' => $rgambar['kode_barang'],
                        'gambar' => $rgambar['gambar'],
                        'log' => $rgambar['log'],
                    ];
                    $this->db->insert('tbl_gambar', $datagambar);
                }
            }

            if ($this->lokal->trans_status() === FALSE) {
                $this->lokal->trans_rollback();
                echo json_encode(['status' => 2, 'msg' => 'dalam proses']);
            } else {
                $this->lokal->trans_commit();
                echo json_encode(['status' => 1, 'msg' => 'data berhasil di singkronkan']);
            }
        }
    }

    // sycn transaction data
    function sycndata_transaksi($params)
    {
        if ($params == 'send') {
            $this->server->trans_begin();
            $tbl_barang  = $this->server->get('trtransaksi');
            foreach ($tbl_barang->result_array() as $rtransaksi) {
                $check = $this->server->get_where('trtransaksi', ['no_penjualan' => $rtransaksi['no_penjualan']]);
                if ($check->num_rows() > 0) {
                    $updata = [
                        'no_penjualan' => $rtransaksi['no_penjualan'],
                        'kasir_id' => $rtransaksi['kasir_id'],
                        'barang_id' => $rtransaksi['barang_id'],
                        'member_id' => $rtransaksi['member_id'],
                        'price' => $rtransaksi['price'],
                        'item_name' => $rtransaksi['item_name'],
                        'jumlah' => $rtransaksi['jumlah'],
                        'diskon' => $rtransaksi['diskon'],
                        'finish' => $rtransaksi['finish'],
                        'date_updated' => $rtransaksi['date_updated'],
                        'date_created' => $rtransaksi['date_created'],
                        'subtotal' => $rtransaksi['subtotal'],
                    ];
                    $this->server->update('trtransaksi', $updata, ['no_penjualan' => $rtransaksi['no_penjualan']]);
                } else {
                    $inserttr = [
                        'no_penjualan' => $rtransaksi['no_penjualan'],
                        'kasir_id' => $rtransaksi['kasir_id'],
                        'barang_id' => $rtransaksi['barang_id'],
                        'member_id' => $rtransaksi['member_id'],
                        'price' => $rtransaksi['price'],
                        'item_name' => $rtransaksi['item_name'],
                        'jumlah' => $rtransaksi['jumlah'],
                        'diskon' => $rtransaksi['diskon'],
                        'finish' => $rtransaksi['finish'],
                        'date_updated' => $rtransaksi['date_updated'],
                        'date_created' => $rtransaksi['date_created'],
                        'subtotal' => $rtransaksi['subtotal'],
                    ];
                    $this->server->insert('trtransaksi', $inserttr);
                }
            }
            if ($this->server->trans_status() === FALSE) {
                $this->server->trans_rollback();
                echo json_encode(['status' => 2, 'msg' => 'dalam proses']);
            } else {
                $this->server->trans_commit();
                echo json_encode(['status' => 1, 'msg' => 'data berhasil di singkronkan']);
            }
            //trans stok
        } elseif ($params == 'receive') {
            $this->lokal->trans_begin();
            $datatr  = $this->server->get('trtransaksi');
            foreach ($datatr->result_array() as $rtransaksi) {
                $check = $this->lokal->get_where('trtransaksi', ['no_penjualan' => $rtransaksi['no_penjualan']]);
                if ($check->num_rows() > 0) {
                    $updata = [
                        'no_penjualan' => $rtransaksi['no_penjualan'],
                        'kasir_id' => $rtransaksi['kasir_id'],
                        'barang_id' => $rtransaksi['barang_id'],
                        'member_id' => $rtransaksi['member_id'],
                        'price' => $rtransaksi['price'],
                        'item_name' => $rtransaksi['item_name'],
                        'jumlah' => $rtransaksi['jumlah'],
                        'diskon' => $rtransaksi['diskon'],
                        'finish' => $rtransaksi['finish'],
                        'date_updated' => $rtransaksi['date_updated'],
                        'date_created' => $rtransaksi['date_created'],
                        'subtotal' => $rtransaksi['subtotal'],
                    ];
                    $this->lokal->update('trtransaksi', $updata, ['no_penjualan' => $rtransaksi['no_penjualan']]);
                } else {
                    $inserttr = [
                        'no_penjualan' => $rtransaksi['no_penjualan'],
                        'kasir_id' => $rtransaksi['kasir_id'],
                        'barang_id' => $rtransaksi['barang_id'],
                        'member_id' => $rtransaksi['member_id'],
                        'price' => $rtransaksi['price'],
                        'item_name' => $rtransaksi['item_name'],
                        'jumlah' => $rtransaksi['jumlah'],
                        'diskon' => $rtransaksi['diskon'],
                        'finish' => $rtransaksi['finish'],
                        'date_updated' => $rtransaksi['date_updated'],
                        'date_created' => $rtransaksi['date_created'],
                        'subtotal' => $rtransaksi['subtotal'],
                    ];
                    $this->lokal->insert('trtransaksi', $inserttr);
                }
            }
            if ($this->lokal->trans_status() === FALSE) {
                $this->lokal->trans_rollback();
                echo json_encode(['status' => 2, 'msg' => 'dalam proses']);
            } else {
                $this->lokal->trans_commit();
                echo json_encode(['status' => 1, 'msg' => 'data berhasil di singkronkan']);
            }
        }
    }
}
