-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 20, 2019 at 11:27 AM
-- Server version: 10.0.21-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aljunawe_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_alamat`
--

CREATE TABLE `tb_alamat` (
  `id_alamat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_alamat`
--

INSERT INTO `tb_alamat` (`id_alamat`, `id_user`, `id_kota`, `nama`, `alamat`, `no_telp`) VALUES
(8, 24, 1, 'sdfsdfsdf', 'sdfsdfsdfsdf', '234324234'),
(11, 24, 1, 'sdfsdf', 'sdfsfsd', '243434'),
(42, 23, 6, 'bagus prabowo', 'Jl. Teuku Umar', '0898797878757'),
(44, 23, 31, 'Caca', 'fghfgh', '6575675'),
(45, 23, 1, 'Tyytt', 'Rdtfg', '8858986'),
(46, 27, 39, 'iqbal busthomi', 'rt 01 sindet, trimulyo', '089609889491'),
(47, 23, 1, 'Indra', 'denpasar', '0855565555');

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `kode_barang` char(8) NOT NULL,
  `nama_barang` varchar(150) NOT NULL,
  `id_kategori` int(3) NOT NULL,
  `stok` int(4) NOT NULL,
  `satuan` varchar(5) NOT NULL,
  `berat` int(11) NOT NULL,
  `harga` int(8) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`kode_barang`, `nama_barang`, `id_kategori`, `stok`, `satuan`, `berat`, `harga`, `gambar`) VALUES
('11ACSBL', 'Axcel Achieve Carbon CXL Sight RH Blue', 10, 6, 'pcs', 1000, 6000000, 'b-1548073048.png'),
('11ATXSBK', 'AVALON TEC-X SHORTY FOR COMPOUND BOW', 10, 6, 'pcs', 1000, 1450000, 'b-1548073707.jpg'),
('11HCPVRD', 'Hoyt Prevail 35\" FX X3 50# RED', 4, 10, 'set', 15000, 21000000, 'b-1548071559.png'),
('13CLES20', 'CARTEL Sirius Edge Limbs 60/20', 6, 10, 'set', 2000, 1700000, 'b-1548072076.png'),
('13EPAS15', 'EASTON Platinum Plus Arrow Shaft 1516', 1, 9, 'dz', 1000, 1350000, 'b-1548073564.jpg'),
('14AMBSGR', 'AVALON Alumunium Magnetic Bow Stand A3 Green', 22, 10, 'pcs', 1000, 300000, 'b-1548073860.png'),
('14FAGJGR', 'FIVICS Arm Guard Harness jelly Green', 19, 10, 'pcs', 1000, 250000, 'b-1548074857.jpg'),
('14SPB16', 'SHIBUYA Plunger Button 5/16', 14, 10, 'pcs', 1000, 640000, 'b-1548074480.png'),
('14WTMBL', 'W&W 360 Cordovan Finger Tab \"M\" RH Black', 13, 10, 'pcs', 1000, 650000, 'b-1548075062.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_pesanan`
--

CREATE TABLE `tb_detail_pesanan` (
  `id_detail` int(11) NOT NULL,
  `id_pesanan` int(11) DEFAULT NULL,
  `kode_barang` char(8) DEFAULT NULL,
  `nama_barang` varchar(150) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `jumlah` int(4) DEFAULT NULL,
  `satuan` varchar(5) DEFAULT NULL,
  `berat` int(11) DEFAULT NULL,
  `harga` int(8) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_pesanan`
--

INSERT INTO `tb_detail_pesanan` (`id_detail`, `id_pesanan`, `kode_barang`, `nama_barang`, `kategori`, `jumlah`, `satuan`, `berat`, `harga`, `gambar`) VALUES
(1, 1, '11HCPVRD', 'Hoyt Prevail 35\" FX X3 50# RED', 'Compound Bow', 1, 'set', 15000, 21000000, 'b-1548071559.png'),
(2, 2, '13CLES20', 'CARTEL Sirius Edge Limbs 60/20', 'Standard Bow', 1, 'set', 2000, 1700000, 'b-1548072076.png'),
(3, 3, '13EPAS15', 'EASTON Platinum Plus Arrow Shaft 1516', 'Arrow', 2, 'dz', 1000, 1350000, 'b-1548073564.jpg'),
(4, 4, '14FAGJGR', 'FIVICS Arm Guard Harness jelly Green', 'Arm Guard', 1, 'pcs', 1000, 250000, 'b-1548074857.jpg'),
(5, 5, '11ATXSBK', 'AVALON TEC-X SHORTY FOR COMPOUND BOW', 'Viser Sightn', 1, 'pcs', 1000, 1450000, 'b-1548073707.jpg'),
(6, 6, '11ATXSBK', 'AVALON TEC-X SHORTY FOR COMPOUND BOW', 'Viser Sightn', 2, 'pcs', 1000, 1450000, 'b-1548073707.jpg'),
(7, 7, '11HCPVRD', 'Hoyt Prevail 35\" FX X3 50# RED', 'Compound Bow', 2, 'set', 15000, 21000000, 'b-1548071559.png'),
(8, 8, '11ATXSBK', 'AVALON TEC-X SHORTY FOR COMPOUND BOW', 'Viser Sightn', 1, 'pcs', 1000, 1450000, 'b-1548073707.jpg'),
(9, 9, '13CLES20', 'CARTEL Sirius Edge Limbs 60/20', 'Standard Bow', 1, 'set', 2000, 1700000, 'b-1548072076.png'),
(10, 10, '11ATXSBK', 'AVALON TEC-X SHORTY FOR COMPOUND BOW', 'Viser Sight', 1, 'pcs', 1000, 1450000, 'b-1548073707.jpg'),
(11, 10, '11ACSBL', 'Axcel Achieve Carbon CXL Sight RH Blue', 'Viser Sight', 2, 'pcs', 1000, 6000000, 'b-1548073048.png'),
(12, 11, '11ACSBL', 'Axcel Achieve Carbon CXL Sight RH Blue', 'Viser Sight', 2, 'pcs', 1000, 6000000, 'b-1548073048.png'),
(13, 11, '11ATXSBK', 'AVALON TEC-X SHORTY FOR COMPOUND BOW', 'Viser Sight', 1, 'pcs', 1000, 1450000, 'b-1548073707.jpg'),
(14, 12, '13EPAS15', 'EASTON Platinum Plus Arrow Shaft 1516', 'Arrow', 10, 'dz', 1000, 1350000, 'b-1548073564.jpg'),
(15, 13, '13EPAS15', 'EASTON Platinum Plus Arrow Shaft 1516', 'Arrow', 0, 'dz', 1000, 1350000, 'b-1548073564.jpg'),
(16, 14, '11ATXSBK', 'AVALON TEC-X SHORTY FOR COMPOUND BOW', 'Viser Sight', 2, 'pcs', 1000, 1450000, 'b-1548073707.jpg'),
(17, 14, '11ACSBL', 'Axcel Achieve Carbon CXL Sight RH Blue', 'Viser Sight', 2, 'pcs', 1000, 6000000, 'b-1548073048.png'),
(18, 15, '11ACSBL', 'Axcel Achieve Carbon CXL Sight RH Blue', 'Viser Sight', 2, 'pcs', 1000, 6000000, 'b-1548073048.png'),
(19, 15, '13CLES20', 'CARTEL Sirius Edge Limbs 60/20', 'Standard Bow', 1, 'set', 2000, 1700000, 'b-1548072076.png'),
(20, 16, '14AMBSGR', 'AVALON Alumunium Magnetic Bow Stand A3 Green', 'Bow Stand', 1, 'pcs', 1000, 300000, 'b-1548073860.png'),
(21, 16, '14WTMBL', 'W&W 360 Cordovan Finger Tab \"M\" RH Black', 'Finger Tab', 1, 'pcs', 1000, 650000, 'b-1548075062.png'),
(22, 17, '11ATXSBK', 'AVALON TEC-X SHORTY FOR COMPOUND BOW', 'Viser Sight', 2, 'pcs', 1000, 1450000, 'b-1548073707.jpg'),
(23, 17, '13EPAS15', 'EASTON Platinum Plus Arrow Shaft 1516', 'Arrow', 1, 'dz', 1000, 1350000, 'b-1548073564.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_transaksi`
--

CREATE TABLE `tb_detail_transaksi` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `kode_barang` char(8) DEFAULT NULL,
  `nama_barang` varchar(150) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `jumlah` int(4) DEFAULT NULL,
  `satuan` varchar(5) DEFAULT NULL,
  `berat` int(11) DEFAULT NULL,
  `harga` int(8) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_transaksi`
--

INSERT INTO `tb_detail_transaksi` (`id_detail`, `id_transaksi`, `kode_barang`, `nama_barang`, `kategori`, `jumlah`, `satuan`, `berat`, `harga`, `gambar`) VALUES
(1, 1, '11HCPVRD', 'Hoyt Prevail 35\" FX X3 50# RED', 'Compound Bow', 1, 'set', 15000, 21000000, 'b-1548071559.png'),
(2, 2, '13CLES20', 'CARTEL Sirius Edge Limbs 60/20', 'Standard Bow', 1, 'set', 2000, 1700000, 'b-1548072076.png'),
(3, 3, '13EPAS15', 'EASTON Platinum Plus Arrow Shaft 1516', 'Arrow', 2, 'dz', 1000, 1350000, 'b-1548073564.jpg'),
(4, 4, '14FAGJGR', 'FIVICS Arm Guard Harness jelly Green', 'Arm Guard', 1, 'pcs', 1000, 250000, 'b-1548074857.jpg'),
(5, 5, '11ATXSBK', 'AVALON TEC-X SHORTY FOR COMPOUND BOW', 'Viser Sightn', 1, 'pcs', 1000, 1450000, 'b-1548073707.jpg'),
(6, 6, '11ATXSBK', 'AVALON TEC-X SHORTY FOR COMPOUND BOW', 'Viser Sightn', 2, 'pcs', 1000, 1450000, 'b-1548073707.jpg'),
(7, 7, '11HCPVRD', 'Hoyt Prevail 35\" FX X3 50# RED', 'Compound Bow', 2, 'set', 15000, 21000000, 'b-1548071559.png'),
(8, 8, '11ATXSBK', 'AVALON TEC-X SHORTY FOR COMPOUND BOW', 'Viser Sightn', 1, 'pcs', 1000, 1450000, 'b-1548073707.jpg'),
(9, 9, '13CLES20', 'CARTEL Sirius Edge Limbs 60/20', 'Standard Bow', 1, 'set', 2000, 1700000, 'b-1548072076.png'),
(10, 10, '11ATXSBK', 'AVALON TEC-X SHORTY FOR COMPOUND BOW', 'Viser Sight', 1, 'pcs', 1000, 1450000, 'b-1548073707.jpg'),
(11, 10, '11ACSBL', 'Axcel Achieve Carbon CXL Sight RH Blue', 'Viser Sight', 2, 'pcs', 1000, 6000000, 'b-1548073048.png'),
(12, 11, '11ACSBL', 'Axcel Achieve Carbon CXL Sight RH Blue', 'Viser Sight', 2, 'pcs', 1000, 6000000, 'b-1548073048.png'),
(13, 11, '11ATXSBK', 'AVALON TEC-X SHORTY FOR COMPOUND BOW', 'Viser Sight', 1, 'pcs', 1000, 1450000, 'b-1548073707.jpg'),
(14, 12, '13EPAS15', 'EASTON Platinum Plus Arrow Shaft 1516', 'Arrow', 10, 'dz', 1000, 1350000, 'b-1548073564.jpg'),
(15, 13, '13EPAS15', 'EASTON Platinum Plus Arrow Shaft 1516', 'Arrow', 0, 'dz', 1000, 1350000, 'b-1548073564.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(3) NOT NULL,
  `kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Arrow'),
(2, 'Arrow Rest'),
(3, 'Kick Stand'),
(4, 'Compound Bow'),
(5, 'Recurve Bow'),
(6, 'Standard Bow'),
(7, 'Quiver'),
(8, 'Stabilizer'),
(9, 'Puller'),
(10, 'Viser Sight'),
(11, 'Limb'),
(12, 'String'),
(13, 'Finger Tab'),
(14, 'Plugger Button'),
(15, 'Trigger'),
(16, 'Kick Stand'),
(17, 'Silencer'),
(18, 'Wax'),
(19, 'Arm Guard'),
(20, 'Noct'),
(21, 'Tools'),
(22, 'Bow Stand');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kota`
--

CREATE TABLE `tb_kota` (
  `id_kota` int(11) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kota`
--

INSERT INTO `tb_kota` (`id_kota`, `kota`, `tarif`) VALUES
(1, 'Badung, Bali', 36000),
(4, 'Bangli, Bali', 37000),
(5, 'Buleleng, Bali', 41000),
(6, 'Denpasar, Bali', 25000),
(8, 'Gianyar, Bali', 37000),
(9, 'Jembrana, Bali', 41000),
(10, 'Karang Asem, Bali', 37000),
(11, 'Klungkung, Bali', 31000),
(12, 'Tabanan, Bali', 31000),
(13, 'Bangka, Bangka Belitung', 59000),
(14, 'Bangka Barat, Bangka Belitung', 59000),
(15, 'Bangka Selatan, Bangka Belitung', 59000),
(16, 'Bangka Tengah, Bangka Belitung', 59000),
(17, 'Belitung, Bangka Belitung', 59000),
(18, 'Belitung Timur, Bangka Belitung', 68000),
(19, 'Pangkal Pinang, Bangka Belitung', 38000),
(20, 'Balaraja, Banten', 20000),
(21, 'Cilegon, Banten', 20000),
(22, 'Ciputat, Banten', 23000),
(23, 'Serang, Banten', 37000),
(24, 'Lebak, Banten', 30000),
(25, 'Pandeglang, Banten', 30000),
(26, 'Serang, Banten', 20000),
(27, 'Tangerang, Banten', 23000),
(28, 'Argamakmur, Bengkulu', 63000),
(29, 'Bengkulu, Bengkulu', 35000),
(30, 'Bengkulu Tengah, Bengkulu', 79000),
(31, 'Kaur, Bengkulu', 63000),
(32, 'Kepahiang, Bengkulu', 63000),
(33, 'Lebong, Bengkulu', 63000),
(34, 'Lubuk Linggau, Bengkulu', 58000),
(35, 'Manna, Bengkulu', 79000),
(36, 'Muko-muko, Bengkulu', 63000),
(37, 'Rejang Lebong, Bengkulu', 63000),
(38, 'Seluma, Bengkulu', 79000),
(39, 'Bantul, Yogyakarta', 7000),
(40, 'Kulonprogo, Yogyakarta', 9000),
(41, 'Sleman, Yogyakarta', 8000),
(42, 'Wonosari, Yogyakarta', 9000),
(43, 'Yogyakarta, Yogyakarta', 8000),
(44, 'Jakarta, Jakarta', 19000),
(45, 'Gorontalo, Gorontalo', 71000),
(46, 'Gorontalo Utara, Gorontalo', 113000),
(47, 'Marisa, Gorontalo', 95000),
(48, 'Suwawa, Gorontalo', 113000),
(49, 'Tilamuta, Gorontalo', 95000),
(50, 'Bangko, Jambi', 58000),
(51, 'Batang Hari, Jambi', 63000),
(52, 'Jambi, Jambi', 35000),
(53, 'Kerinci, Jambi', 79000),
(54, 'Muara Bungo, Jambi', 58000),
(55, 'Muara Jambi, Jambi', 58000),
(56, 'Sarolang, Jambi', 58000),
(57, 'Sungai Penuh, Jambi', 58000),
(58, 'Tanjung Jabung Barat, Jambi', 58000),
(59, 'Tanjung Jabung Timur, Jambi', 58000),
(60, 'Tebo, Jambi', 58000),
(61, 'Bandung, Jawa Barat', 20000),
(62, 'Banjar, Jawa Barat', 32000),
(63, 'Bekasi, Jawa Barat', 23000),
(64, 'Bogor, Jawa Barat', 23000),
(65, 'Ciamis, Jawa Barat', 30000),
(66, 'Cianjur, Jawa Barat', 30000),
(67, 'Cibinong, Jawa Barat', 23000),
(68, 'Cikampek, Jawa Barat', 23000),
(69, 'Cikarang, Jawa Barat', 23000),
(70, 'Cimahi, Jawa Barat', 20000),
(71, 'Cirebon, Jawa Barat', 20000),
(72, 'Depok, Jawa Barat', 23000),
(73, 'Garut, Jawa Barat', 30000),
(74, 'Indramayu, Jawa Barat', 30000),
(75, 'Karawang, Jawa Barat', 25000),
(76, 'Kuningan, Jawa Barat', 30000),
(77, 'Majalengka, Jawa Barat', 30000),
(78, 'Ngamprah, Jawa Barat', 20000),
(79, 'Pangandara, Jawa Barat', 37000),
(80, 'Pelabuhan Ratu, Jawa Barat', 35000),
(81, 'Purwakarta, Jawa Barat', 30000),
(82, 'Singaparna, Jawa Barat', 30000),
(83, 'Soreang, Jawa Barat', 20000),
(84, 'Subang, Jawa Barat', 30000),
(85, 'Sukabumi, Jawa Barat', 30000),
(86, 'Sumber, Jawa Barat', 20000),
(87, 'Sumedang, Jawa Barat', 30000),
(88, 'Tasikmalaya, Jawa Barat', 30000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pesanan`
--

CREATE TABLE `tb_pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `waktu` datetime NOT NULL,
  `subtotal` int(11) NOT NULL,
  `subtotalongkir` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `bukti` varchar(20) DEFAULT NULL,
  `resi` varchar(12) DEFAULT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pesanan`
--

INSERT INTO `tb_pesanan` (`id_pesanan`, `id_user`, `waktu`, `subtotal`, `subtotalongkir`, `total`, `nama`, `kota`, `alamat`, `no_telp`, `bukti`, `resi`, `status`) VALUES
(1, '23', '2019-01-29 00:00:00', 21000000, 0, 21000000, 'fghfgh', 'Badung, Bali', 'rtyhrt', '456456', '', '', '5'),
(2, '23', '2019-01-30 02:03:32', 1700000, 108000, 1808000, 'fghfgh', 'Badung, Bali', 'rtyhrt', '456456', '', '', '5'),
(3, '23', '2019-01-30 07:32:08', 2700000, 0, 2700000, 'fghfgh', 'Badung, Bali', 'rtyhrt', '456456', '', '', '5'),
(4, '23', '2019-01-30 07:54:42', 250000, 72000, 322000, 'fghfgh', 'Badung, Bali', 'rtyhrt', '456456', '', '', '5'),
(5, '23', '2019-01-30 13:19:14', 1450000, 72000, 1522000, 'fghfgh', 'Badung, Bali', 'rtyhrt', '456456', '', '', '5'),
(6, '23', '2019-01-31 01:03:55', 2900000, 108000, 3008000, 'fghfgh', 'Badung, Bali', 'rtyhrt', '456456', '', '', '5'),
(7, '23', '2019-01-30 13:11:00', 42000000, 1116000, 43116000, 'fghfgh', 'Badung, Bali', 'rtyhrt', '456456', '', '', '5'),
(8, '23', '2019-01-31 14:56:54', 1450000, 72000, 1522000, 'fghfgh', 'Badung, Bali', 'rtyhrt', '456456', '', '', '5'),
(9, '23', '2019-02-12 00:00:00', 1700000, 75000, 1775000, 'bagus prabowo', 'Denpasar, Bali', 'kutee', '456456', 'bukti_533371396.jpg', '', '5'),
(10, '23', '2019-02-17 17:01:11', 13450000, 100000, 13550000, 'bagus prabowo', 'Denpasar, Bali', 'kute', '456456', '', '', '5'),
(11, '23', '2019-02-26 14:35:03', 13450000, 100000, 13550000, 'bagus prabowo', 'Denpasar, Bali', 'Jl. Teuku Umar', '0898797878757', 'bukti_919866612.jpg', '856545566885', '2'),
(12, '23', '2019-02-27 19:57:56', 13500000, 275000, 13775000, 'bagus prabowo', 'Denpasar, Bali', 'Jl. Teuku Umar', '0898797878757', '', '', '6'),
(13, '23', '2019-02-27 19:59:30', 0, 25000, 25000, 'bagus prabowo', 'Denpasar, Bali', 'Jl. Teuku Umar', '0898797878757', 'bukti_582478100.jpg', '', '2'),
(14, '23', '2019-06-18 21:55:21', 14900000, 125000, 15025000, 'bagus prabowo', 'Denpasar, Bali', 'Jl. Teuku Umar', '0898797878757', 'bukti_758777461.jpg', '', '2'),
(15, '27', '2019-06-24 00:10:27', 13700000, 35000, 13735000, 'iqbal busthomi', 'Bantul, Yogyakarta', 'rt 01 sindet, trimulyo', '089609889491', 'bukti_773209967.jpg', '6565645665', '4'),
(16, '27', '2019-06-24 09:33:18', 950000, 21000, 971000, 'iqbal busthomi', 'Bantul, Yogyakarta', 'rt 01 sindet, trimulyo', '089609889491', '', '', '6'),
(17, '23', '2019-06-24 14:04:35', 4250000, 144000, 4394000, 'Indra', 'Badung, Bali', 'denpasar', '0855565555', 'bukti_292016069.jpg', '', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `waktu` datetime NOT NULL,
  `subtotal` int(11) NOT NULL,
  `subtotalongkir` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `bukti` varchar(20) DEFAULT NULL,
  `resi` varchar(12) DEFAULT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_user`, `waktu`, `subtotal`, `subtotalongkir`, `total`, `nama`, `kota`, `alamat`, `no_telp`, `bukti`, `resi`, `status`) VALUES
(1, '23', '2019-01-29 00:00:00', 21000000, 0, 21000000, 'fghfgh', 'Badung, Bali', 'rtyhrt', '456456', '', '', '5'),
(2, '23', '2019-01-30 02:03:32', 1700000, 108000, 1808000, 'fghfgh', 'Badung, Bali', 'rtyhrt', '456456', '', '', '5'),
(3, '23', '2019-01-30 07:32:08', 2700000, 0, 2700000, 'fghfgh', 'Badung, Bali', 'rtyhrt', '456456', '', '', '5'),
(4, '23', '2019-01-30 07:54:42', 250000, 72000, 322000, 'fghfgh', 'Badung, Bali', 'rtyhrt', '456456', '', '', '5'),
(5, '23', '2019-01-30 13:19:14', 1450000, 72000, 1522000, 'fghfgh', 'Badung, Bali', 'rtyhrt', '456456', '', '', '5'),
(6, '23', '2019-01-31 01:03:55', 2900000, 108000, 3008000, 'fghfgh', 'Badung, Bali', 'rtyhrt', '456456', '', '', '5'),
(7, '23', '2019-01-30 13:11:00', 42000000, 1116000, 43116000, 'fghfgh', 'Badung, Bali', 'rtyhrt', '456456', '', '', '5'),
(8, '23', '2019-01-31 14:56:54', 1450000, 72000, 1522000, 'fghfgh', 'Badung, Bali', 'rtyhrt', '456456', '', '', '5'),
(9, '23', '2019-02-12 00:00:00', 1700000, 75000, 1775000, 'bagus prabowo', 'Denpasar, Bali', 'kutee', '456456', 'bukti_533371396.jpg', '', '5'),
(10, '23', '2019-02-17 17:01:11', 13450000, 100000, 13550000, 'bagus prabowo', 'Denpasar, Bali', 'kute', '456456', '', '', '5'),
(11, '23', '2019-02-26 14:35:03', 13450000, 100000, 13550000, 'bagus prabowo', 'Denpasar, Bali', 'Jl. Teuku Umar', '0898797878757', 'bukti_919866612.jpg', '856545566885', '2'),
(12, '23', '2019-02-27 19:57:56', 13500000, 275000, 13775000, 'bagus prabowo', 'Denpasar, Bali', 'Jl. Teuku Umar', '0898797878757', '', '', '5'),
(13, '23', '2019-02-27 19:59:30', 0, 25000, 25000, 'bagus prabowo', 'Denpasar, Bali', 'Jl. Teuku Umar', '0898797878757', 'bukti_582478100.jpg', '', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_troli`
--

CREATE TABLE `tb_troli` (
  `id_troli` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode_barang` varchar(48) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_troli`
--

INSERT INTO `tb_troli` (`id_troli`, `id_user`, `kode_barang`, `jumlah`) VALUES
(1, 23, '11ACSBL', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `hak`) VALUES
(1, 'paijo', 'paijo123', 1),
(4, 'rohim', 'rohim123', 2),
(9, 'catur', 'catur123', 1),
(11, 'arif', 'arif123', 1),
(12, 'hsdjf', 'jklasdka', 1),
(13, 'sfgsd', '34534df', 1),
(14, 'dfgdf', 'fgdfgdfg', 1),
(15, 'dfghfg', '45645gr', 1),
(23, 'bagus', 'bagus123', 2),
(26, 'ahahaha', 'ahahahah', 2),
(27, 'iqbal', 'iqbal123', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_alamat`
--
ALTER TABLE `tb_alamat`
  ADD PRIMARY KEY (`id_alamat`);

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `tb_detail_pesanan`
--
ALTER TABLE `tb_detail_pesanan`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_kota`
--
ALTER TABLE `tb_kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `tb_troli`
--
ALTER TABLE `tb_troli`
  ADD PRIMARY KEY (`id_troli`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_alamat`
--
ALTER TABLE `tb_alamat`
  MODIFY `id_alamat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tb_detail_pesanan`
--
ALTER TABLE `tb_detail_pesanan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_kota`
--
ALTER TABLE `tb_kota`
  MODIFY `id_kota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_troli`
--
ALTER TABLE `tb_troli`
  MODIFY `id_troli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
