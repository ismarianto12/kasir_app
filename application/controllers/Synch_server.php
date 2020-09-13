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
                echo json_encode($data, JSON_PRETTY_PRINT);
            } else {
                echo json_encode([], JSON_PRETTY_PRINT);
            }
        } else {
            echo json_encode(['msg' => 'false'], JSON_PRETTY_PRINT);
        }
    }

    function show_barang($params)
    {
        $json = self::get_data();
        if ($json->api_key == 'rian123') {
            $tbl_barang  = $this->db->get('tbl_barang');
            if ($tbl_barang->num_rows() > 0) {
                $sdata      = $tbl_barang->result_array();
                $tbl_harga  = $this->db->get('tbl_harga')->result_array();
                $tbl_gambar = $this->db->get('tbl_gambar')->result_array();
                $tbl_stok    = $this->db->get('tbl_stok')->result_array();
                $data       = array_merge($sdata, $tbl_harga, $tbl_harga);
                if ($params ==  'barang') {
                    echo json_encode($sdata);
                } else if ($params == 'harga') {

                    echo json_encode($tbl_harga);
                } elseif ($params == 'gambar') {

                    echo json_encode($tbl_gambar);
                } elseif ($params == 'stok') {

                    echo json_encode($tbl_stok);
                }
            } else {
                echo json_encode([null]);
            }
        }
    }

    //receive data from client 

    function insert_barang()
    {
        $json_str = file_get_contents('php://input');
        $from_data  = json_decode($json_str);

        if ($from_data['api_key'] == 'rian123') {
            foreach ($from_data as $rbarang) {
                $check = $this->db->get_where('tbl_barang', ['kode_barang' => $rbarang['kode_barang']]);
                if ($check->num_rows() > 0) {
                } else {
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
                }
            }
            foreach ($from_data as $rbarang) {
                $check = $this->db->get_where('tbl_harga', ['kode_barang' => $rbarang['kode_barang']]);
                if ($check->num_rows() > 0) {
                } else {
                    $stokinsert =  [
                        'kode_barang' => $rbarang['kode_barang'],
                        'stock' => $rbarang['stock'],
                        'return' => $rbarang['return'],
                        'damage' => $rbarang['damage'],
                        'loss' => $rbarang['loss'],
                        'log' => $rbarang['log'],
                    ];
                    $this->db->insert('tbl_stok', $stokinsert);
                }
            }
            foreach ($from_data as $rbarang) {
                $check = $this->db->get_where('tbl_gambar', ['kode_barang' => $rbarang['kode_barang']]);
                if ($check->num_rows() > 0) {
                } else {
                    $datagambar =  [
                        'kode_barang' => $rbarang['kode_barang'],
                        'gambar' => $rbarang['gambar'],
                        'log' => $rbarang['log'],
                    ];
                    $this->db->insert('tbl_gambar', $datagambar);
                }
            }
            echo json_encode(['status' => 1, 'msg' => 'data berhasil di sychkan']);
        }
    }

    function receive_transac()
    {
        $json_str = file_get_contents('php://input');
        $rtransaksi  = json_decode($json_str, TRUE);
        if ($rtransaksi['api_key'] == 'rian123') {
            foreach ($rtransaksi as $ls) {
                $check = $this->db->get_where('tmpenjualan', [
                    'no_penjualan' => $ls['no_penjualan'],
                ]);
                if ($check->num_rows() > 0) {
                } else {
                    $updata = [
                        'no_penjualan' => $ls['no_penjualan'],
                        'kasir_id' => $ls['kasir_id'],
                        'barang_id' => $ls['barang_id'],
                        'member_id' => $ls['member_id'],
                        'jumlah' => $ls['jumlah'],
                        'diskon' => $ls['diskon'],
                        'price' => $ls['price'],
                        'item_name' => $ls['item_name'],
                        'date_created' => date('Y-m-d H:i:s'),
                        'date_updated' => date('Y-m-d H:i:s'),
                    ];
                    $data = $this->db->insert('tmpenjualan', $updata);
                }
            }
            echo json_encode(['status' => 1, 'msg' => 'data berhasil di singkronkan']);
        } else {
            echo json_encode(['msg' => 'method not allowed']);
        }
    }
}
