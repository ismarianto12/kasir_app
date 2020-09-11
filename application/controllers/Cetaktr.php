<?php


class CetakTr extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
        $this->load->library('escpos');
        $this->load->model(['Trtransaksi_model']);
    }
    public function cetak_struk($id = '')
    {
        if ($id != '') {
            // membuat connector printer ke shared printer bernama "printer_a" (yang telah disetting sebelumnya)
            $connector = new Escpos\PrintConnectors\WindowsPrintConnector("php://stdout");

            // membuat objek $printer agar dapat di lakukan fungsinya
            $printer = new Escpos\Printer($connector);

            // membuat fungsi untuk membuat 1 baris tabel, agar dapat dipanggil berkali-kali dgn mudah
            function buatBaris4Kolom($kolom1, $kolom2, $kolom3, $kolom4)
            {
                // Mengatur lebar setiap kolom (dalam satuan karakter)
                $lebar_kolom_1 = 12;
                $lebar_kolom_2 = 8;
                $lebar_kolom_3 = 8;
                $lebar_kolom_4 = 9;
                $lebar_kolom_5 = 9;
                
                // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
                $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
                $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
                $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);
                $kolom4 = wordwrap($kolom4, $lebar_kolom_4, "\n", true);
                $kolom5 = wordwrap($kolom4, $lebar_kolom_5, "\n", true);

                // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
                $kolom1Array = explode("\n", $kolom1);
                $kolom2Array = explode("\n", $kolom2);
                $kolom3Array = explode("\n", $kolom3);
                $kolom4Array = explode("\n", $kolom4);
                $kolom5Array = explode("\n", $kolom5);

                // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
                $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array), count($kolom4Array),count($kolom5Array));

                // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
                $hasilBaris = array();

                // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
                for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {

                    // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
                    $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
                    $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ");

                    // memberikan rata kanan pada kolom 3 dan 4 karena akan kita gunakan untuk harga dan total harga
                    $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_LEFT);
                    $hasilKolom4 = str_pad((isset($kolom4Array[$i]) ? $kolom4Array[$i] : ""), $lebar_kolom_4, " ", STR_PAD_LEFT);

                    
                    $hasilKolom5 = str_pad((isset($kolom5Array[$i]) ? $kolom5Array[$i] : ""), $lebar_kolom_5, " ", STR_PAD_LEFT);
                    $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3 . " " . $hasilKolom4."".$hasilKolom5;
                }
                // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
                return implode($hasilBaris, "\n") . "\n";
            }

            $data      = $this->Trtransaksi_model->strukPrint(trim($id));

            // Membuat judul
            $printer->initialize();
            $printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_HEIGHT); // Setting teks menjadi lebih besar
            $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER); // Setting teks menjadi rata tengah
            $printer->text("Nama Toko\n");
            $printer->text("\n");

            // Data transaksi
            $printer->initialize();
            $printer->text("Kasir : \n");
            $printer->text("Waktu :  ".date('Y-m-d H:i:s'));

            // Membuat tabel
            $printer->initialize(); // Reset bentuk/jenis teks
            $printer->text("----------------------------------------\n");
            $printer->text(buatBaris4Kolom("Barang", "qty", "Harga","Disc", "Subtotal"));
            $printer->text("----------------------------------------\n");

            $total = 0;
            $r_tot = 0;
            foreach ($data->result_array() as $ls) {
                $total += $ls['hargabeli'];

                $allcount = (int)$ls['hargabeli'] * (int) $ls['jumlah'];
                $disc     = ((int)$ls['diskon'] / (int)100) * $allcount;
                $hasil    = (int)$allcount - $disc;
                $r_tot    += $hasil;
 
                $printer->text(buatBaris4Kolom($ls['nm_barang'], $ls['jumlah'],number_format((int)$ls['hargabeli'], 0, 0, '.'),$ls['diskon'],number_format($hasil, 0, 0, '.')));
            }

            //$printer->text(buatBaris4Kolom("Telur", "2pcs", "5.000", "10.000"));
            //$printer->text(buatBaris4Kolom("Tepung terigu", "1pcs", "8.200", "16.400"));
            $printer->text("----------------------------------------\n");
            $printer->text(buatBaris4Kolom('', '', "Total","",number_format($r_tot, 0, 0, '.')));
            $printer->text("\n");

            // Pesan penutup
            $printer->initialize();
            $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
            $printer->text("Terima kasih telah berbelanja\n");
            $printer->text("butikgaiabai.com\n");
            $printer->feed(5); // mencetak 5 baris kosong agar terangkat (pemotong kertas saya memiliki jarak 5 baris dari toner)
            $printer->close();
        } else {
            echo json_decode(['msg' => 'data tidak tidak bisa diakse']);
        }
    }
}
