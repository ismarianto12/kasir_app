<?php

class Synch_server extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    }

    public function get_data()
    {
        $json_str = file_get_contents('php://input');
        $data = json_decode($json_str);
        return $data;
    }

    //send data to client
    function show_transaction()
    {
        $json = self::get_data();
        if ($json->api_key == 'rian123') {
            $tbl_barang  = $this->db->get('trtransaksi');
            if ($tbl_barang->num_rows() > 0) {
                $data = $tbl_barang->result_array();
                echo json_encode([
                    'status' => 'ok',
                    'data' => $data,
                ], JSON_PRETTY_PRINT);
            } else {
                echo json_encode([
                    'status' => 'ok',
                    'data' => null,
                ], JSON_PRETTY_PRINT);
            }
        } else {
            echo json_encode(['msg' => 'false'], JSON_PRETTY_PRINT);
        }
    }

    function show_barang()
    {
        $json = self::get_data();
        if ($json->api_key == 'rian123') {
            $tbl_barang  = $this->db->get('tbl_barang');
            if ($tbl_barang->num_rows() > 0) {
                $sdata      = $tbl_barang->result_array();
                $tbl_harga  = $this->db->get('tbl_harga')->result_array();
                $tbl_barang = $this->db->get('tbl_gambar')->result_array();
                $data       = array_merge($sdata, $tbl_harga, $tbl_harga);
                echo json_encode([
                    'status' => 'ok',
                    'data' => $data,
                ], JSON_PRETTY_PRINT);
            } else {
                echo json_encode([
                    'status' => 'ok',
                    'data' => null,
                ], JSON_PRETTY_PRINT);
            }
        }
    }

    //receive data from client 
    function insert_transaction()
    {
        $rtransaksi = self::get_data();
        if ($rtransaksi['api_key'] == 'rian123') {
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
            $this->db->insert('trtransaksi', $updata, ['no_penjualan' => $rtransaksi['no_penjualan']]);
            echo json_encode(['status' => 1, 'msg' => 'data berhasil di singkronkan']);
        } else {
            show_404();
            exit();
        }
    }

    function insert_barang()
    { 
        $json_str = file_get_contents('php://input');
        $rbarang  = json_decode($json_str);

        if ($rbarang['api_key'] == 'rian123') { 
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
            $this->db->insert('tbl_barang', $data);
            $stokinsert =  [
                'kode_barang' => $rbarang['kode_barang'],
                'stock' => $rbarang['stock'],
                'return' => $rbarang['return'],
                'damage' => $rbarang['damage'],
                'loss' => $rbarang['loss'],
                'log' => $rbarang['log'],
            ];
            $this->db->insert('tbl_stok', $stokinsert);

            $datagambar =  [
                'kode_barang' => $rbarang['kode_barang'],
                'gambar' => $rbarang['gambar'],
                'log' => $rbarang['log'],
            ];
            $this->db->insert('tbl_gambar', $datagambar);
            echo json_encode(['status' => 1, 'msg' => 'data berhasil di sychkan']);
        }
    }
}
