<?php

class Synch_api extends CI_Controller
{
    function __construct()
    {
        // error_reporting(0);
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $this->load->library(['zend']);
    }

    private function generatebr($code)
    {
        $this->zend->load('Zend/Barcode');
        $imageResource = Zend_Barcode::factory('code128', 'image', array('text' => $code), array())->draw();
        $imageName = $code . '.jpg';
        $imagePath = 'assets/barcode/'; // penyimpanan file barcode
        imagejpeg($imageResource, $imagePath . $imageName);
        $pathBarcode = $imagePath . $imageName; //Menyimpan path image bardcode kedatabase
        return $pathBarcode;
    }



    function barang_kirim()
    {
        $tbl_barang = $this->db->get('tbl_barang')->result_array();
        $tbl_harga  = $this->db->get('tbl_harga')->result_array();
        $tbl_gambar = $this->db->get('tbl_gambar')->result_array();
        $key        = ['api_key' => 'rian123'];
        $data       = array_merge($tbl_barang, $tbl_harga, $tbl_gambar, $key);
        $data_app   = json_encode($data);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://gaiabiai.my.id/synch_server/insert_barang",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data_app,
            CURLOPT_HTTPHEADER => array(
                "X-API-KEY: 123",
                "Content-Type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        echo json_encode(['status' => 1, 'msg' => 'data berhasil di kirim ke server']);
    }

    function transaksi_kirim()
    {
        $transaski  = $this->db->get('tmpenjualan')->result_array();
        $key        = ['api_key' => 'rian123'];
        $data       = array_merge($transaski, $key);
        $data_app   = json_encode($data);
        $curl       = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://gaiabiai.my.id/synch_server/receive_transac",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data_app,
            CURLOPT_HTTPHEADER => array(
                "X-API-KEY: 123",
                "Content-Type: application/json",
            ),
        ));
        if (curl_error($curl)) {
            echo json_encode(['status' => 2, 'msg' => 'gagal karena']);
        }
        $response = curl_exec($curl);
        curl_close($curl);

        echo $response;
        exit();

        echo json_encode(['status' => 1, 'msg' => 'data  di kirim ke server']);
    }



    //get datat from trasaction 
    private function api_req($params)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://gaiabiai.my.id/synch_server/show_barang/" . $params,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\r\n  \"api_key\": \"rian123\"\r\n  \r\n}",
            CURLOPT_HTTPHEADER => array(
                "X-API-KEY: 123",
                "Content-Type: application/json",
                "Cookie: ci_session=mo7v1lvr6b0kb676turld64g7ln90d67"
            ),
        ));

        if (curl_errno($curl)) {
            echo 'Curl error: ' . curl_error($curl);
        }
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response);
        return $result;
    }

    function terima()
    {
        $barang_api = $this->api_req('barang');
        foreach ($barang_api as $rstok) {
            $check = $this->db->get_where('tbl_barang', ['kode_barang' => $rstok->kode_barang]);
            if ($check->num_rows() > 0) {
            } else {
                $data  = [
                    'kode_barang' => $rstok->kode_barang,
                    'nm_barang' => $rstok->nm_barang,
                    'jenis' => $rstok->jenis,
                    'model' => $rstok->model,
                    'warna' => $rstok->warna,
                    'ukuran' => $rstok->ukuran,
                    'catatan' => $rstok->catatan,
                    'tambahan' => $rstok->tambahan,
                    'sync' => $rstok->sync,
                    'status' => $rstok->status,
                    'log' => $rstok->log,
                ];
                $this->db->insert('tbl_barang', $data);
                if (!file_exists('assets/barcode/' . $rstok->kode_barang . '.jpg')) {
                    $this->generatebr($rstok->kode_barang);
                }
            }
        }

        $harga_api = $this->api_req('harga');
        foreach ($harga_api as $rstok) {
            $check = $this->db->get_where('tbl_harga', ['kode_barang' => $rstok->kode_barang]);
            if ($check->num_rows() > 0) {
            } else {
                $dharga = [
                    'kode_barang' => $rstok->kode_barang,
                    'harga_beli_lama' => $rstok->harga_beli_lama,
                    'harga_beli_baru' => $rstok->harga_beli_baru,
                    'harga_jual_lama' => $rstok->harga_jual_lama,
                    'harga_jual_baru' => $rstok->harga_jual_baru,
                    'log' => $rstok->log,
                ];
                $this->db->insert('tbl_harga', $dharga);
            }
        }

        $gambar_api = $this->api_req('gambar');
        foreach ($gambar_api as $rstok) {
            $check = $this->db->get_where('tbl_gambar', ['kode_barang' => $rstok->kode_barang]);
            if ($check->num_rows() > 0) {
            } else {
                $datagambar  =  [
                    'kode_barang' => $rstok->kode_barang,
                    'gambar' => $rstok->gambar,
                    'log' => $rstok->log,
                ];
                $this->db->insert('tbl_gambar', $datagambar);
            }
        }
        $stok_api = $this->api_req('stok');
        foreach ($stok_api as $rstok) {
            $check = $this->db->get_where('tbl_stok', ['kode_barang' => $rstok->kode_barang]);
            if ($check->num_rows() > 0) {
                
                $stokinsert =  [
                    'kode_barang' => $rstok->kode_barang,
                    'stock' => $rstok->stock,
                    'return' => $rstok->return,
                    'damage' => $rstok->damage,
                    'loss' => $rstok->loss,
                    'log' => $rstok->log,
                ];
                $this->db->update('tbl_stok', $stokinsert,[
                    'kode_barang'=>$rstok->kode_barang,
                ]);
            } else {
                $stokinsert =  [
                    'kode_barang' => $rstok->kode_barang,
                    'stock' => $rstok->stock,
                    'return' => $rstok->return,
                    'damage' => $rstok->damage,
                    'loss' => $rstok->loss,
                    'log' => $rstok->log,
                ];
                $this->db->insert('tbl_stok', $stokinsert);
            }
        }
        echo json_encode(['status' => 1, 'msg' => 'data berhasil di kirim ke server']);
    }


    function terima_transaksi()
    {
        ///table yang di pakai tmpenjualan;
        $key       = ['api_key' => 'rian123'];
        $data_app   = json_encode($key);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://gaiabiai.my.id/synch_server/show_transaction",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data_app,
            CURLOPT_HTTPHEADER => array(
                "X-API-KEY: 123",
                "Content-Type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $insert_lokal = json_decode($response, TRUE);
        foreach ($insert_lokal as $ls) {
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
                    'subtotal' => $ls['subtotal'],
                    'diskon' => $ls['diskon'],
                    'price' => $ls['price'],
                    'item_name' => $ls['item_name'],
                    'date_created' => date('Y-m-d H:i:s'),
                    'date_updated' => date('Y-m-d H:i:s'),
                ];
                $data = $this->db->insert('tmpenjualan', $updata);
            }
        }
        echo json_encode(['status' => 1, 'msg' => 'data berhasil di kirim ke server']);
    }
}
