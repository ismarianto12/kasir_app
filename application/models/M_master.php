<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class M_master extends CI_Model
{
    ///////////////////////////////////////////////////////////////////
    /// referensi
    //////////////////////////////////////////////////////////////////
    function ref_jenis()
    {
        $hasil = $this->db->query("SELECT * FROM tbl_referensi where ref='JNS'");
        return $hasil;
    }
    function ref_jenis_list()
    {
        $hasil = $this->db->query("SELECT * FROM tbl_referensi where ref='JNS'");
        return $hasil;
    }


    function ref_jenis_show()
    {
        $cari = $this->input->get_post('pilih_jenis', TRUE);
        $data = $this->db->query("SELECT * FROM tbl_referensi WHERE link='$cari' AND ref='UKR'");
        return $data->result();
    }

    function ref_jenis_show_input()
    {
        $cari = $this->input->get('pilih_jenis', TRUE);
        $data = $this->db->query("SELECT * FROM tbl_referensi WHERE link='$cari' AND ref='JNS'");
        return $data->result();
    }

    function ref_model_show()
    {
        $cari = $this->input->get_post('model_jenis', TRUE);
        $data = $this->db->query("SELECT * FROM tbl_referensi WHERE link='$cari' AND ref='MDL'");
        return $data->result();
    }
    function ref_model_show_input()
    {
        $cari = $this->input->get('model_jenis', TRUE);
        $data = $this->db->query("SELECT * FROM tbl_referensi WHERE link='$cari' AND ref='JNS'");
        return $data->result();
    }

    function ref_jenis_barang($kode_ref)
    {
        $query = $this->db->query("SELECT link FROM tbl_referensi WHERE kode_ref='$kode_ref'");
        $cek_link = $query->row();
        $link = $cek_link->link;

        $hasil = $this->db->query("SELECT * FROM tbl_referensi WHERE link='$link' AND ref='UKR'");
        return $hasil->result();
    }


    function ref_jenis_model($kode_ref)
    {
        $query = $this->db->query("SELECT link FROM tbl_referensi WHERE kode_ref='$kode_ref'");
        $cek_link = $query->row();
        $link = $cek_link->link;

        $hasil = $this->db->query("SELECT * FROM tbl_referensi WHERE link='$link' AND ref='MDL'");
        return $hasil->result();
    }

    function ref_model()
    {
        $hasil = $this->db->query("SELECT * FROM tbl_referensi where ref='MDL'");
        return $hasil;
    }
    function ref_warna()
    {
        $hasil = $this->db->query("SELECT * FROM tbl_referensi where ref='COL'");
        return $hasil;
    }
    function ref_ukuran()
    {
        $hasil = $this->db->query("SELECT * FROM tbl_referensi where ref='UKR'");
        return $hasil;
    }
    function ref_optional()
    {
        $hasil = $this->db->query("SELECT * FROM tbl_referensi where ref='OPT'");
        return $hasil;
    }
    //////////////////////////////////////////////////////////////////
    function add_ref_jenis($ref, $link, $kode_ref, $keterangan_ref, $log)
    {
        $insert = $this->db->query("INSERT INTO tbl_referensi VALUES ('$ref','$link','$kode_ref','$keterangan_ref','$log')");
        return $insert;
    }
    //////////////////////////////////////////////////////////////////
    function del_ref_jenis($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    function edit_referensi($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    ///////////////////////////////////////////////////////////////////
    /// Data Gaji
    //////////////////////////////////////////////////////////////////
    function data_gaji()
    {
        $this->db->select('tbl_gaji.id_gaji,tbl_gaji.id_karyawan,tbl_karyawan.nm_karyawan,tbl_gaji.gaji_pokok,tbl_gaji.tunjangan,tbl_gaji.status,tbl_gaji.log');
        $this->db->from('tbl_gaji');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.id_karyawan = tbl_gaji.id_karyawan');
        $query = $this->db->get();
        return $query;
    }

    function data_insentif()
    {

        $session  = $this->session->level;
        $id_login = $this->session->id_login;
        if ($session == 'manager' or $session == 'administrator') {
            $hasil = $this->db->query("SELECT tbl_insentif.id_insentif,tbl_insentif.id_karyawan,tbl_karyawan.nm_karyawan,tbl_insentif.nm_insentif,tbl_insentif.total_insentif,tbl_insentif.bulan,tbl_insentif.tahun,tbl_insentif.tgl_terima,DATE_FORMAT(tbl_insentif.tgl_terima, '%d/%m/%Y') AS tgl_terima_format,tbl_insentif.status FROM tbl_insentif
                                       INNER JOIN tbl_karyawan ON tbl_karyawan.id_karyawan = tbl_insentif.id_karyawan
           ");
            return $hasil;
        } else {
            $hasil = $this->db->query("SELECT tbl_insentif.id_insentif,tbl_insentif.id_karyawan,tbl_karyawan.nm_karyawan,tbl_insentif.nm_insentif,tbl_insentif.total_insentif,tbl_insentif.bulan,tbl_insentif.tahun,tbl_insentif.tgl_terima,DATE_FORMAT(tbl_insentif.tgl_terima, '%d/%m/%Y') AS tgl_terima_format,tbl_insentif.status FROM tbl_insentif
                                 INNER JOIN tbl_karyawan ON tbl_karyawan.id_karyawan = tbl_insentif.id_karyawan
                                 INNER JOIN tbl_login    ON tbl_login.karyawan_id = tbl_karyawan.id_karyawan
                                 WHERE tbl_login.id_login ='$id_login'    
        ");
            return $hasil;
        }
    }

    function data_rincian_penggajian($id_penggajian, $session)
    {
        if ($session == 'manager' or $session == 'administrator') {
            $hasil = $this->db->query("
            SELECT tbl_rincian_penggajian.id_rincian,tbl_rincian_penggajian.id_penggajian,tbl_karyawan.id_karyawan,tbl_karyawan.nm_karyawan,tbl_gaji.gaji_pokok,tbl_gaji.tunjangan,tbl_rincian_penggajian.total_terima,tbl_rincian_penggajian.status FROM tbl_rincian_penggajian
            INNER JOIN tbl_gaji ON tbl_gaji.id_gaji = tbl_rincian_penggajian.id_gaji 
            INNER JOIN tbl_karyawan ON tbl_karyawan.id_karyawan = tbl_gaji.id_karyawan WHERE tbl_rincian_penggajian.id_penggajian = '$id_penggajian'");
            return $hasil;
        } else {
            $id_login = $this->session->id_login;
            $hasil    = $this->db->query("SELECT tbl_rincian_penggajian.id_rincian,tbl_rincian_penggajian.id_penggajian,tbl_karyawan.id_karyawan,tbl_karyawan.nm_karyawan,tbl_gaji.gaji_pokok,tbl_gaji.tunjangan,tbl_rincian_penggajian.total_terima,tbl_rincian_penggajian.status FROM tbl_rincian_penggajian
            INNER JOIN tbl_gaji         ON tbl_gaji.id_gaji = tbl_rincian_penggajian.id_gaji 
            INNER JOIN tbl_karyawan ON tbl_karyawan.id_karyawan = tbl_gaji.id_karyawan
            INNER JOIN tbl_login    ON tbl_login.karyawan_id = tbl_karyawan.id_karyawan
            WHERE tbl_rincian_penggajian.id_penggajian = '$id_penggajian'
            AND tbl_login.id_login ='$id_login' 
            AND tbl_rincian_penggajian.status = 1
 
            ");
            return $hasil;
        }
    }

    //cetak struk gaji 
    function cetak_struk($id_penggajian)
    {
        $session = $this->session->level;
        if ($session == 'manager' or $session == 'administrator') {
            $hasil = $this->db->query("
            SELECT tbl_rincian_penggajian.id_rincian,tbl_rincian_penggajian.id_penggajian,tbl_karyawan.id_karyawan,tbl_karyawan.nm_karyawan,tbl_gaji.gaji_pokok,tbl_gaji.tunjangan,tbl_rincian_penggajian.total_terima,tbl_rincian_penggajian.status FROM tbl_rincian_penggajian
            INNER JOIN tbl_gaji ON tbl_gaji.id_gaji = tbl_rincian_penggajian.id_gaji 
            INNER JOIN tbl_karyawan ON tbl_karyawan.id_karyawan = tbl_gaji.id_karyawan WHERE tbl_rincian_penggajian.id_penggajian = '$id_penggajian'");
            return $hasil;
        } else {
            $id_login = $this->session->id_login;
            $hasil    = $this->db->query("SELECT tbl_rincian_penggajian.id_rincian,tbl_rincian_penggajian.id_penggajian,tbl_karyawan.id_karyawan,tbl_karyawan.nm_karyawan,tbl_gaji.gaji_pokok,tbl_gaji.tunjangan,tbl_rincian_penggajian.total_terima,tbl_rincian_penggajian.status FROM tbl_rincian_penggajian
        INNER JOIN tbl_gaji     ON tbl_gaji.id_gaji = tbl_rincian_penggajian.id_gaji 
        INNER JOIN tbl_karyawan ON tbl_karyawan.id_karyawan = tbl_gaji.id_karyawan
        INNER JOIN tbl_login    ON tbl_login.karyawan_id = tbl_karyawan.id_karyawan
        WHERE tbl_rincian_penggajian.id_penggajian = '$id_penggajian'
        AND tbl_login.id_login ='$id_login' 
        AND tbl_rincian_penggajian.status = 1

        ");
            return $hasil;
        }
    }


    function info_penggajian($id_penggajian)
    {
        $this->db->select('*');
        $this->db->from('tbl_penggajian');
        $this->db->where('id_penggajian', $id_penggajian);
        $query = $this->db->get();
        return $query;
    }

    function cek_status_button($id_penggajian)
    {
        $hasil = $this->db->query("SELECT id_penggajian,
        (SELECT COUNT(status) FROM tbl_rincian_penggajian WHERE id_penggajian='$id_penggajian') AS total_status,
        (SELECT COUNT(status) FROM tbl_rincian_penggajian WHERE id_penggajian='$id_penggajian' AND status='1') AS status_selesai,`status`,
        (SELECT max(status) FROM tbl_rincian_penggajian WHERE id_penggajian='$id_penggajian') AS cek FROM tbl_penggajian where id_penggajian='$id_penggajian'");
        return $hasil;
    }

    ///////////////////////////////////////////////////////////////////
    /// Barang
    //////////////////////////////////////////////////////////////////
    function tambah_barang($data_barang, $data_stock, $data_harga, $data_gambar)
    {
        $this->db->insert('tbl_barang', $data_barang);
        $this->db->insert('tbl_stok', $data_stock);
        $this->db->insert('tbl_harga', $data_harga);
        $this->db->insert('tbl_gambar', $data_gambar);
    }

    function ubah_barang($where, $data_barang)
    {
        $this->db->where($where);
        $this->db->update('tbl_barang', $data_barang);
    }

    function ubah_gambar_barang($where, $data_gambar)
    {
        $this->db->where($where);
        $this->db->update('tbl_gambar', $data_gambar);
    }

    function ubah_detail_stok($where,  $data_stok)
    {
        $this->db->where($where);
        $this->db->update('tbl_stok', $data_stok);
    }

    function ubah_detail_barang($where, $data_harga)
    {
        $this->db->where($where);
        $this->db->update('tbl_harga', $data_harga);
    }

    function data_barang()
    {
        $hasil = $this->db->query("SELECT tbl_barang.kode_barang,tbl_gambar.gambar,tbl_barang.nm_barang,tbl_barang.jenis,tbl_barang.model,tbl_barang.catatan,tbl_barang.warna,tbl_barang.ukuran,tbl_barang.tambahan,tbl_stok.stock,tbl_harga.harga_beli_lama,tbl_harga.harga_beli_baru,tbl_harga.harga_jual_lama,tbl_harga.harga_jual_baru,tbl_barang.status,tbl_barang.log 
        FROM tbl_barang
        INNER JOIN tbl_stok ON tbl_stok.kode_barang = tbl_barang.kode_barang 
        INNER JOIN tbl_harga ON tbl_harga.kode_barang = tbl_barang.kode_barang
        INNER JOIN tbl_gambar ON tbl_gambar.kode_barang = tbl_barang.kode_barang");
        return $hasil;
    }

    ///////////////////////////////////////////////////////////////////
    /// Pembelian
    //////////////////////////////////////////////////////////////////

    function data_pembelian()
    {
        $hasil = $this->db->query("SELECT tbl_pembelian.id_pembelian,tbl_pembelian.id_pemasok,tbl_pemasok.nm_pemasok,tbl_pembelian.no_fakturbeli,tbl_pembelian.tgl_fakturbeli,tbl_pembelian.total_harga,tbl_pembelian.biaya_lainnya,tbl_pembelian.total_bayar,
        tbl_pembelian.tgl_pembelian,tbl_pembelian.status,tbl_pembelian.log FROM tbl_pembelian 
        INNER JOIN tbl_pemasok ON tbl_pemasok.id_pemasok = tbl_pembelian.id_pemasok");
        return $hasil;
    }

    function data_pembelian_id($id_pembelian)
    {
        $query = $this->db->query("SELECT id_pembelian FROM tbl_pembelian WHERE id_pembelian='$id_pembelian' LIMIT 1");
        return $query;
    }

    function info_pembelian($id_pembelian)
    {
        $this->db->select('*');
        $this->db->from('tbl_pembelian');
        $this->db->where('id_pembelian', $id_pembelian);
        $query = $this->db->get();
        return $query;
    }

    function data_rincian_pembelian($id_pembelian)
    {
        $hasil = $this->db->query("SELECT tbl_rincian_pembelian.id_rincian_pembelian,tbl_rincian_pembelian.id_pembelian,tbl_rincian_pembelian.kode_barang,tbl_barang.nm_barang,tbl_rincian_pembelian.jumlah,tbl_rincian_pembelian.harga,tbl_rincian_pembelian.subtotal,tbl_rincian_pembelian.status,tbl_rincian_pembelian.log FROM tbl_rincian_pembelian
        INNER JOIN tbl_barang ON tbl_barang.kode_barang = tbl_rincian_pembelian.kode_barang
        WHERE tbl_rincian_pembelian.id_pembelian = '$id_pembelian'");
        return $hasil;
    }

    function cek_status_pembelian($id_pembelian)
    {
        $hasil = $this->db->query("SELECT id_pembelian,
        (SELECT COUNT(status) FROM tbl_rincian_pembelian WHERE id_pembelian='$id_pembelian') AS total_status,
        (SELECT COUNT(status) FROM tbl_rincian_pembelian WHERE id_pembelian='$id_pembelian' AND status='1') AS status_selesai,`status`,
        (SELECT max(status) FROM tbl_rincian_pembelian WHERE id_pembelian='$id_pembelian') AS cek FROM tbl_pembelian where id_pembelian='$id_pembelian'");
        return $hasil;
    }

    function update_stok_barang($id_rincian_pembelian, $id_pembelian, $kode_barang, $log)
    {
        $hasil = $this->db->query("UPDATE tbl_stok SET stock=stock+(SELECT jumlah FROM tbl_rincian_pembelian WHERE id_rincian_pembelian='$id_rincian_pembelian' AND kode_barang='$kode_barang' AND id_pembelian='$id_pembelian'), `log`='$log' WHERE kode_barang = '$kode_barang'");
        return $hasil;
    }

    function update_harga_barang($id_rincian_pembelian, $kode_barang, $log)
    {
        $cek_barang = $this->db->query("SELECT * FROM tbl_harga WHERE kode_barang='$kode_barang'");
        $cek_harga = $cek_barang->row();
        $harga_beli_baru = $cek_harga->harga_beli_baru;

        $query = $this->db->query("SELECT * FROM tbl_rincian_pembelian WHERE id_rincian_pembelian='$id_rincian_pembelian'");
        $cek_rincian = $query->row();
        $harga = $cek_rincian->harga;

        $hasil = $this->db->query("UPDATE tbl_harga SET harga_beli_baru='$harga',harga_beli_lama='$harga_beli_baru',`log`='$log' WHERE kode_barang = '$kode_barang'");
        return $hasil;
    }

    function biaya_lain($id_pembelian)
    {
        $query = $this->db->query("SELECT * FROM tbl_pembelian WHERE id_pembelian='$id_pembelian'");
        return $query;
    }


    ///////////////////////////////////////////////////////////////////
    /// Kategori
    //////////////////////////////////////////////////////////////////
    function data_kategori()
    {
        $hasil = $this->db->query("SELECT * FROM tbl_kategori");
        return $hasil;
    }

    function add_kategori($id_kategori, $nm_kategori, $log)
    {
        $hasil = $this->db->query("INSERT INTO tbl_kategori VALUES ('$id_kategori','$nm_kategori','$log')");
        return $hasil;
    }

    function delete_kategori($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    function edit_kategori($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    ///////////////////////////////////////////////////////////////////
    /// Satuan
    //////////////////////////////////////////////////////////////////
    function data_satuan()
    {
        $hasil = $this->db->query("SELECT * FROM tbl_satuan");
        return $hasil;
    }

    function add_satuan($id_satuan, $nm_satuan, $jumlah, $log)
    {
        $hasil = $this->db->query("INSERT INTO tbl_satuan VALUES ('$id_satuan','$nm_satuan','$jumlah','$log')");
        return $hasil;
    }

    function delete_satuan($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    function edit_satuan($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function checkdata($no_penjualan)
    {
        $this->db->select('
            tmpenjualan.no_penjualan')
            ->from('trtransaksi')
            ->join('tmpenjualan', 'trtransaksi.no_penjualan = tmpenjualan.no_penjualan', 'left')
            ->where('tmpenjualan.no_penjualan', $no_penjualan)
            ->get();
    }
}
