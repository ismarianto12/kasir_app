-- MySQL dump 10.13  Distrib 8.0.21, for Linux (x86_64)
--
-- Host: localhost    Database: db_butik
-- ------------------------------------------------------
-- Server version	8.0.21-0ubuntu0.20.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_adjust`
--

DROP TABLE IF EXISTS `tbl_adjust`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_adjust` (
  `id_adjust` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `kode_barang` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `adjust_min` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `adjust_plus` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `log` datetime DEFAULT NULL,
  PRIMARY KEY (`id_adjust`) USING BTREE,
  KEY `tbl_adjust_FK` (`kode_barang`) USING BTREE,
  CONSTRAINT `tbl_adjust_FK` FOREIGN KEY (`kode_barang`) REFERENCES `tbl_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_adjust`
--

LOCK TABLES `tbl_adjust` WRITE;
/*!40000 ALTER TABLE `tbl_adjust` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_adjust` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_barang`
--

DROP TABLE IF EXISTS `tbl_barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_barang` (
  `kode_barang` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `nm_barang` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `jenis` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `model` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `warna` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ukuran` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tambahan` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sync` int NOT NULL,
  `status` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `log` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`kode_barang`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_barang`
--

LOCK TABLES `tbl_barang` WRITE;
/*!40000 ALTER TABLE `tbl_barang` DISABLE KEYS */;
INSERT INTO `tbl_barang` VALUES ('ATJDBRUS01','test','AT','JD','BRU','S','01',1,'1','2020-07-30 17:27:38');
/*!40000 ALTER TABLE `tbl_barang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_barang_keluar_dtl`
--

DROP TABLE IF EXISTS `tbl_barang_keluar_dtl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_barang_keluar_dtl` (
  `struk_penjualan` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `kode_barang` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `jml_barang` int NOT NULL,
  `hrg_satuan` int NOT NULL,
  `hrg_jual` int NOT NULL,
  `status` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`struk_penjualan`,`kode_barang`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_barang_keluar_dtl`
--

LOCK TABLES `tbl_barang_keluar_dtl` WRITE;
/*!40000 ALTER TABLE `tbl_barang_keluar_dtl` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_barang_keluar_dtl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_barang_keluar_hdr`
--

DROP TABLE IF EXISTS `tbl_barang_keluar_hdr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_barang_keluar_hdr` (
  `struk_penjualan` varchar(30) NOT NULL,
  `kode_barang` varchar(100) NOT NULL DEFAULT '',
  `id_pelanggan` varchar(100) NOT NULL,
  `total_harga` int NOT NULL,
  `ppn` int NOT NULL,
  `grandtotal` int NOT NULL,
  `total_bayar` int NOT NULL,
  `total_kembalian` int NOT NULL,
  `tanggal_jual` date NOT NULL,
  `no_fakturjual` varchar(20) NOT NULL,
  `tgl_fakturjual` date NOT NULL,
  `status` char(1) NOT NULL,
  `log` datetime DEFAULT NULL,
  PRIMARY KEY (`struk_penjualan`,`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_barang_keluar_hdr`
--

LOCK TABLES `tbl_barang_keluar_hdr` WRITE;
/*!40000 ALTER TABLE `tbl_barang_keluar_hdr` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_barang_keluar_hdr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_barang_kembali`
--

DROP TABLE IF EXISTS `tbl_barang_kembali`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_barang_kembali` (
  `id_barang_kembali` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `id_pelanggan` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `kode_barang` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `keterangan` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tgl_retrun` datetime DEFAULT NULL,
  `log` datetime DEFAULT NULL,
  PRIMARY KEY (`id_barang_kembali`) USING BTREE,
  KEY `tbl_restrun_FK` (`id_pelanggan`) USING BTREE,
  KEY `tbl_restrun_FK_1` (`kode_barang`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_barang_kembali`
--

LOCK TABLES `tbl_barang_kembali` WRITE;
/*!40000 ALTER TABLE `tbl_barang_kembali` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_barang_kembali` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_gaji`
--

DROP TABLE IF EXISTS `tbl_gaji`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_gaji` (
  `id_gaji` varchar(100) NOT NULL DEFAULT '',
  `id_karyawan` varchar(100) DEFAULT NULL,
  `gaji_pokok` bigint DEFAULT NULL,
  `tunjangan` bigint DEFAULT NULL,
  `status` enum('0','1','2') DEFAULT NULL,
  `log` datetime DEFAULT NULL,
  PRIMARY KEY (`id_gaji`),
  KEY `tbl_gaji_FK` (`id_karyawan`),
  CONSTRAINT `tbl_gaji_FK` FOREIGN KEY (`id_karyawan`) REFERENCES `tbl_karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_gaji`
--

LOCK TABLES `tbl_gaji` WRITE;
/*!40000 ALTER TABLE `tbl_gaji` DISABLE KEYS */;
INSERT INTO `tbl_gaji` VALUES ('GAJI0001','IDK001',1500000,500000,'1','2020-07-31 00:25:49');
/*!40000 ALTER TABLE `tbl_gaji` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_gambar`
--

DROP TABLE IF EXISTS `tbl_gambar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_gambar` (
  `kode_barang` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `gambar` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `log` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `tbl_gambar_FK` (`kode_barang`) USING BTREE,
  CONSTRAINT `tbl_gambar_FK` FOREIGN KEY (`kode_barang`) REFERENCES `tbl_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_gambar`
--

LOCK TABLES `tbl_gambar` WRITE;
/*!40000 ALTER TABLE `tbl_gambar` DISABLE KEYS */;
INSERT INTO `tbl_gambar` VALUES ('ATJDBRUS01','1596130014_9905.png','2020-07-30 17:26:54');
/*!40000 ALTER TABLE `tbl_gambar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_harga`
--

DROP TABLE IF EXISTS `tbl_harga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_harga` (
  `kode_barang` varchar(100) DEFAULT NULL,
  `harga_beli_lama` varchar(100) DEFAULT NULL,
  `harga_beli_baru` varchar(100) DEFAULT NULL,
  `harga_jual_lama` varchar(100) DEFAULT NULL,
  `harga_jual_baru` varchar(100) DEFAULT NULL,
  `log` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `tbl_price_FK` (`kode_barang`),
  CONSTRAINT `tbl_price_FK` FOREIGN KEY (`kode_barang`) REFERENCES `tbl_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_harga`
--

LOCK TABLES `tbl_harga` WRITE;
/*!40000 ALTER TABLE `tbl_harga` DISABLE KEYS */;
INSERT INTO `tbl_harga` VALUES ('ATJDBRUS01','400000','300000','70000','800000','2020-07-30 17:28:07');
/*!40000 ALTER TABLE `tbl_harga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_insentif`
--

DROP TABLE IF EXISTS `tbl_insentif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_insentif` (
  `id_insentif` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `id_karyawan` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `nm_insentif` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `total_insentif` bigint DEFAULT NULL,
  `bulan` enum('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tahun` int DEFAULT NULL,
  `tgl_terima` date DEFAULT NULL,
  `status` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `log` datetime DEFAULT NULL,
  PRIMARY KEY (`id_insentif`) USING BTREE,
  KEY `tbl_insentif_FK` (`id_karyawan`) USING BTREE,
  CONSTRAINT `tbl_insentif_FK` FOREIGN KEY (`id_karyawan`) REFERENCES `tbl_karyawan` (`id_karyawan`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_insentif`
--

LOCK TABLES `tbl_insentif` WRITE;
/*!40000 ALTER TABLE `tbl_insentif` DISABLE KEYS */;
INSERT INTO `tbl_insentif` VALUES ('INF00001','IDK001','test',300000,'Januari',2020,'2020-07-02','1','2020-07-31 00:29:24');
/*!40000 ALTER TABLE `tbl_insentif` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_jabatan`
--

DROP TABLE IF EXISTS `tbl_jabatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_jabatan` (
  `id_jabatan` varchar(100) NOT NULL DEFAULT '',
  `nm_jabatan` varchar(100) DEFAULT NULL,
  `status` enum('0','1','2') DEFAULT NULL,
  `log` datetime DEFAULT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_jabatan`
--

LOCK TABLES `tbl_jabatan` WRITE;
/*!40000 ALTER TABLE `tbl_jabatan` DISABLE KEYS */;
INSERT INTO `tbl_jabatan` VALUES ('JBT001','Manager','1','2020-07-31 00:24:34'),('JBT002','Kasir','1','2020-07-31 00:24:41');
/*!40000 ALTER TABLE `tbl_jabatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_karyawan`
--

DROP TABLE IF EXISTS `tbl_karyawan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_karyawan` (
  `id_karyawan` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `id_jabatan` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `nm_karyawan` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tmpt_lahir` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `no_tlpn` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `photo` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `status` enum('0','1','2') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `log` datetime DEFAULT NULL,
  PRIMARY KEY (`id_karyawan`) USING BTREE,
  KEY `tbl_karyawan_FK` (`id_jabatan`) USING BTREE,
  CONSTRAINT `tbl_karyawan_FK` FOREIGN KEY (`id_jabatan`) REFERENCES `tbl_jabatan` (`id_jabatan`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_karyawan`
--

LOCK TABLES `tbl_karyawan` WRITE;
/*!40000 ALTER TABLE `tbl_karyawan` DISABLE KEYS */;
INSERT INTO `tbl_karyawan` VALUES ('IDK001','JBT001','Test1','Jambi','2020-07-01','Jambi','0852','1596129903_7489.png','1','2020-07-31 00:25:11');
/*!40000 ALTER TABLE `tbl_karyawan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_klaim`
--

DROP TABLE IF EXISTS `tbl_klaim`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_klaim` (
  `id_claim` varchar(100) NOT NULL DEFAULT '',
  `kode_barang` varchar(100) DEFAULT NULL,
  `id_supplier` varchar(100) DEFAULT NULL,
  `keterangan` text,
  `tgl_claim` date DEFAULT NULL,
  `log` datetime DEFAULT NULL,
  PRIMARY KEY (`id_claim`),
  KEY `tbl_claim_FK` (`kode_barang`),
  KEY `tbl_claim_FK_1` (`id_supplier`),
  CONSTRAINT `tbl_claim_FK` FOREIGN KEY (`kode_barang`) REFERENCES `tbl_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_claim_FK_1` FOREIGN KEY (`id_supplier`) REFERENCES `tbl_pemasok` (`id_pemasok`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_klaim`
--

LOCK TABLES `tbl_klaim` WRITE;
/*!40000 ALTER TABLE `tbl_klaim` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_klaim` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_log`
--

DROP TABLE IF EXISTS `tbl_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_log` (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `id_login` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tipe_log` int DEFAULT NULL,
  `ket_log` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `time_log` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_log`) USING BTREE,
  KEY `tbl_log_FK` (`id_login`) USING BTREE,
  CONSTRAINT `tbl_log_FK` FOREIGN KEY (`id_login`) REFERENCES `tbl_login` (`id_login`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_log`
--

LOCK TABLES `tbl_log` WRITE;
/*!40000 ALTER TABLE `tbl_log` DISABLE KEYS */;
INSERT INTO `tbl_log` VALUES (137,'IDL001',2,'Menambah data karyawan','2020-07-30 17:25:03'),(138,'IDL001',3,'Mengubah status karyawan','2020-07-30 17:25:11'),(139,'IDL001',2,'Menambahkan data Pemasok','2020-07-30 17:26:03'),(140,'IDL001',2,'Menambah data Pelanggan','2020-07-30 17:26:17'),(141,'IDL001',2,'Menambahkan data barang','2020-07-30 17:26:54'),(142,'IDL001',3,'Mengubah data harga barang','2020-07-30 17:27:20'),(143,'IDL001',3,'Mengubah status barang','2020-07-30 17:27:38');
/*!40000 ALTER TABLE `tbl_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_login`
--

DROP TABLE IF EXISTS `tbl_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_login` (
  `id_login` varchar(100) NOT NULL DEFAULT '',
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `level` enum('administrator','admin','kasir') DEFAULT NULL,
  `status` enum('0','1','2') DEFAULT NULL,
  `updatefromweb` int NOT NULL,
  `updatefromdesk` int NOT NULL,
  `databaru` int NOT NULL,
  `log` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_login`
--

LOCK TABLES `tbl_login` WRITE;
/*!40000 ALTER TABLE `tbl_login` DISABLE KEYS */;
INSERT INTO `tbl_login` VALUES ('IDL0002','test','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','kasir','1',1,0,0,'2020-07-31 00:29:35'),('IDL001','admin','d033e22ae348aeb5660fc2140aec35850c4da997','admin','1',0,0,0,'2020-07-31 00:23:10');
/*!40000 ALTER TABLE `tbl_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pelanggan`
--

DROP TABLE IF EXISTS `tbl_pelanggan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_pelanggan` (
  `id_pelanggan` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `nm_pelanggan` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `alamat` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `no_tlpn` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `log` datetime DEFAULT NULL,
  `sync` int NOT NULL,
  PRIMARY KEY (`id_pelanggan`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pelanggan`
--

LOCK TABLES `tbl_pelanggan` WRITE;
/*!40000 ALTER TABLE `tbl_pelanggan` DISABLE KEYS */;
INSERT INTO `tbl_pelanggan` VALUES ('IDP0001','Test1','test2','0852','1','2020-07-31 00:26:17',0);
/*!40000 ALTER TABLE `tbl_pelanggan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pemasok`
--

DROP TABLE IF EXISTS `tbl_pemasok`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_pemasok` (
  `id_pemasok` varchar(100) NOT NULL DEFAULT '',
  `nm_pemasok` varchar(100) DEFAULT NULL,
  `alamat` text,
  `no_tlpn` varchar(100) DEFAULT NULL,
  `status` char(1) NOT NULL,
  `log` datetime DEFAULT NULL,
  `sync` int NOT NULL,
  PRIMARY KEY (`id_pemasok`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pemasok`
--

LOCK TABLES `tbl_pemasok` WRITE;
/*!40000 ALTER TABLE `tbl_pemasok` DISABLE KEYS */;
INSERT INTO `tbl_pemasok` VALUES ('IDS0001','Test1','Test','0852','1','2020-07-31 00:26:03',1);
/*!40000 ALTER TABLE `tbl_pemasok` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pembelian`
--

DROP TABLE IF EXISTS `tbl_pembelian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_pembelian` (
  `id_pembelian` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `id_pemasok` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `no_fakturbeli` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `total_harga` int DEFAULT NULL,
  `biaya_lainnya` int DEFAULT NULL,
  `total_bayar` int DEFAULT NULL,
  `tgl_pembelian` date DEFAULT NULL,
  `tgl_fakturbeli` date DEFAULT NULL,
  `status` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `log` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pembelian`) USING BTREE,
  KEY `FK_tbl_barang_masuk_hdr_tbl_pemasok` (`id_pemasok`) USING BTREE,
  CONSTRAINT `tbl_pembelian_FK` FOREIGN KEY (`id_pemasok`) REFERENCES `tbl_pemasok` (`id_pemasok`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pembelian`
--

LOCK TABLES `tbl_pembelian` WRITE;
/*!40000 ALTER TABLE `tbl_pembelian` DISABLE KEYS */;
INSERT INTO `tbl_pembelian` VALUES ('PMB00001','IDS0001','101010',3000000,0,3000000,'2020-07-02','2020-07-01','1','2020-07-31 00:28:11');
/*!40000 ALTER TABLE `tbl_pembelian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_penggajian`
--

DROP TABLE IF EXISTS `tbl_penggajian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_penggajian` (
  `id_penggajian` varchar(100) NOT NULL DEFAULT '',
  `bulan` enum('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember') DEFAULT NULL,
  `tahun` varchar(10) DEFAULT NULL,
  `catatan` text,
  `tgl_penggajian` date DEFAULT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `log` datetime DEFAULT NULL,
  PRIMARY KEY (`id_penggajian`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_penggajian`
--

LOCK TABLES `tbl_penggajian` WRITE;
/*!40000 ALTER TABLE `tbl_penggajian` DISABLE KEYS */;
INSERT INTO `tbl_penggajian` VALUES ('PGA00001','Januari','2020','test1','2020-07-01','1','2020-07-31 00:29:00');
/*!40000 ALTER TABLE `tbl_penggajian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_referensi`
--

DROP TABLE IF EXISTS `tbl_referensi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_referensi` (
  `ref` char(3) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `link` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `kode_ref` char(3) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `keterangan_ref` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `log` datetime DEFAULT NULL,
  PRIMARY KEY (`ref`,`kode_ref`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_referensi`
--

LOCK TABLES `tbl_referensi` WRITE;
/*!40000 ALTER TABLE `tbl_referensi` DISABLE KEYS */;
INSERT INTO `tbl_referensi` VALUES ('COL','0','BRU','BIRU',NULL),('COL','0','MRH','MERAH',NULL),('JNS','1','AT','ATAS',NULL),('JNS','2','BW','BAWAH',NULL),('JNS','3','DL','DALAMAN',NULL),('MDL','2','JC','CELANA',NULL),('MDL','1','JD','DRESS',NULL),('MDL','1','JG','GAMIS',NULL),('MDL','2','JR','ROK',NULL),('MDL','1','JT','TUNIK',NULL),('OPT','0','00','DEFAULT',NULL),('OPT','0','01','KANCING',NULL),('OPT','0','02','LENGAN PANJANG',NULL),('OPT','0','03','LENGAN PENDEK',NULL),('UKR','2','33','UKURAN 79','2020-07-22 12:36:52'),('UKR','2','55','UKURAN 84','2020-07-22 12:32:26'),('UKR','2','89','UKURAN 89','2020-07-22 12:33:11'),('UKR','2','94','UKURAN 94','2020-07-22 12:33:42'),('UKR','1','L','LONG',NULL),('UKR','1','S','SHORT',NULL),('UKR','1','XL','EXTRA LONG',NULL),('UKR','1','XXL','DOUBLE EXTRA LONG',NULL);
/*!40000 ALTER TABLE `tbl_referensi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_rincian_pembelian`
--

DROP TABLE IF EXISTS `tbl_rincian_pembelian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_rincian_pembelian` (
  `id_rincian_pembelian` int NOT NULL AUTO_INCREMENT,
  `id_pembelian` varchar(30) DEFAULT NULL,
  `kode_barang` varchar(100) DEFAULT '',
  `jumlah` int DEFAULT NULL,
  `harga` bigint DEFAULT NULL,
  `subtotal` bigint DEFAULT NULL,
  `status` enum('0','1','2') DEFAULT NULL,
  `log` datetime DEFAULT NULL,
  PRIMARY KEY (`id_rincian_pembelian`),
  KEY `tbl_barang_masuk_dtl_FK` (`id_pembelian`),
  KEY `tbl_barang_masuk_dtl_FK_1` (`kode_barang`),
  CONSTRAINT `tbl_rincian_pembelian_FK` FOREIGN KEY (`id_pembelian`) REFERENCES `tbl_pembelian` (`id_pembelian`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_rincian_pembelian_FK_1` FOREIGN KEY (`kode_barang`) REFERENCES `tbl_barang` (`kode_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_rincian_pembelian`
--

LOCK TABLES `tbl_rincian_pembelian` WRITE;
/*!40000 ALTER TABLE `tbl_rincian_pembelian` DISABLE KEYS */;
INSERT INTO `tbl_rincian_pembelian` VALUES (17,'PMB00001','ATJDBRUS01',10,300000,3000000,'1','2020-07-31 00:28:07');
/*!40000 ALTER TABLE `tbl_rincian_pembelian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_rincian_penggajian`
--

DROP TABLE IF EXISTS `tbl_rincian_penggajian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_rincian_penggajian` (
  `id_rincian` int NOT NULL AUTO_INCREMENT,
  `id_penggajian` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `id_gaji` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `total_terima` bigint DEFAULT NULL,
  `status` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `log` datetime DEFAULT NULL,
  PRIMARY KEY (`id_rincian`) USING BTREE,
  KEY `tbl_rincian_penggajian_FK` (`id_gaji`) USING BTREE,
  KEY `tbl_rincian_penggajian_FK_2` (`id_penggajian`) USING BTREE,
  CONSTRAINT `tbl_rincian_penggajian_FK` FOREIGN KEY (`id_gaji`) REFERENCES `tbl_gaji` (`id_gaji`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tbl_rincian_penggajian_FK_2` FOREIGN KEY (`id_penggajian`) REFERENCES `tbl_penggajian` (`id_penggajian`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_rincian_penggajian`
--

LOCK TABLES `tbl_rincian_penggajian` WRITE;
/*!40000 ALTER TABLE `tbl_rincian_penggajian` DISABLE KEYS */;
INSERT INTO `tbl_rincian_penggajian` VALUES (55,'PGA00001','GAJI0001',2000000,'1','2020-07-31 00:28:57');
/*!40000 ALTER TABLE `tbl_rincian_penggajian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_stok`
--

DROP TABLE IF EXISTS `tbl_stok`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_stok` (
  `kode_barang` varchar(100) DEFAULT NULL,
  `stock` varchar(100) DEFAULT NULL,
  `return` varchar(100) DEFAULT NULL,
  `damage` varchar(100) DEFAULT NULL,
  `loss` varchar(100) DEFAULT NULL,
  `log` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `tbl_stock_FK` (`kode_barang`),
  CONSTRAINT `tbl_stock_FK` FOREIGN KEY (`kode_barang`) REFERENCES `tbl_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_stok`
--

LOCK TABLES `tbl_stok` WRITE;
/*!40000 ALTER TABLE `tbl_stok` DISABLE KEYS */;
INSERT INTO `tbl_stok` VALUES ('ATJDBRUS01','40','0','0','0','2020-07-30 17:28:07');
/*!40000 ALTER TABLE `tbl_stok` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'db_butik'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-07-31 14:59:16
