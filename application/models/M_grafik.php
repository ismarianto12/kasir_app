<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class M_grafik extends CI_Model
{
    function total_akun()
    {
        // total_akun, total_admin, total_kasir, total_nonaktif, total_aktif, total_arsip
        $hasil = $this->db->query("SELECT (SELECT COUNT(id_login) AS total_akun FROM tbl_login WHERE status in ('0','1')) AS total_akun,
        (SELECT COUNT(level) FROM tbl_login WHERE level='admin' AND status in ('0','1')) AS total_admin, 
        (SELECT COUNT(level) FROM tbl_login WHERE level='kasir' AND status in ('0','1')) AS total_kasir,
        (SELECT COUNT(status) FROM tbl_login WHERE status='0') AS total_nonaktif,
        (SELECT COUNT(status) FROM tbl_login WHERE status='1') AS total_aktif,
        (SELECT COUNT(status) FROM tbl_login WHERE status='2') AS total_arsip");
        return $hasil;
    }

    function total_karyawan()
    {
         // total_karyawan, total_nonaktif, total_aktif, total_arsip
        $hasil = $this->db->query("SELECT (SELECT COUNT(id_karyawan) AS total_karyawan FROM tbl_karyawan WHERE status in ('0','1')) AS total_karyawan,
        (SELECT COUNT(status) FROM tbl_karyawan WHERE status='0') AS total_nonaktif,
        (SELECT COUNT(status) FROM tbl_karyawan WHERE status='1') AS total_aktif,
        (SELECT COUNT(status) FROM tbl_karyawan WHERE status='2') AS total_arsip");
        return $hasil;
    }
    
    function total_jabatan()
    {
        $hasil = $this->db->query("SELECT (SELECT COUNT(id_jabatan) FROM tbl_jabatan WHERE status in ('0','1')) AS total_jabatan,
        (SELECT COUNT(status) FROM tbl_jabatan WHERE status='0') AS total_nonaktif,
        (SELECT COUNT(status) FROM tbl_jabatan WHERE status='1') AS total_aktif,
        (SELECT COUNT(status) FROM tbl_jabatan WHERE status='2') AS total_arsip");
        return $hasil;
    }

    function grafik_barang()
    {
        $hasil = $this->db->query("SELECT (SELECT COUNT(kode_barang) FROM tbl_barang WHERE status in ('0','1')) AS total_barang,
        (SELECT SUM(stock) FROM tbl_stok) AS total_stok,
        (SELECT COUNT(status) FROM tbl_barang WHERE status='1') AS total_aktif,
        (SELECT COUNT(status) FROM tbl_barang WHERE status='0') AS total_nonaktif");
        return $hasil;
    }

    function total_laba_barang()
    {
        $hasil = $this->db->query("SELECT (SELECT SUM(harga_jual_baru) FROM tbl_harga)*(SELECT SUM(stock) FROM tbl_stok)-(SELECT SUM(harga_beli_baru) FROM tbl_harga)*(SELECT SUM(stock) FROM tbl_stok) AS total_laba");
        return $hasil;
    }

    function total_entri_penggajian()
    {
        $hasil = $this->db->query("SELECT COUNT(id_penggajian) AS total_penggajian FROM tbl_penggajian");
        return $hasil;
    }

    function total_referensi()
    {
        $hasil = $this->db->query("SELECT (SELECT COUNT(ref) FROM tbl_referensi WHERE ref='JNS') AS total_jenis,
        (SELECT COUNT(ref) FROM tbl_referensi WHERE ref='MDL') AS total_model,
        (SELECT COUNT(ref)FROM tbl_referensi WHERE ref='COL') AS total_warna,
        (SELECT COUNT(ref) FROM tbl_referensi WHERE ref='UKR') AS total_ukuran,
        (SELECT COUNT(ref) FROM tbl_referensi WHERE ref='OPT') AS total_optional");
        return $hasil;
    }   

}
