-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2019 at 02:39 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lookathijab`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktivitas`
--

CREATE TABLE `aktivitas` (
  `kd_aktivitas` char(8) NOT NULL,
  `nama_aktivitas` varchar(20) DEFAULT NULL,
  `satuan` char(5) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aktivitas`
--

INSERT INTO `aktivitas` (`kd_aktivitas`, `nama_aktivitas`, `satuan`, `tarif`) VALUES
('AKT-0001', 'Jahit', 'Menit', 500),
('AKT-0002', 'Potong', 'Menit', 300);

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `no_akun` char(3) NOT NULL,
  `nama_akun` varchar(40) DEFAULT NULL,
  `header_akun` char(1) DEFAULT NULL,
  `saldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`no_akun`, `nama_akun`, `header_akun`, `saldo`) VALUES
('112', 'Piutang', '1', 0),
('121', 'Persediaan Bahan Baku', '1', 20000000),
('122', 'Persediaan Barang Dalam Proses', '1', 0),
('123', 'BDP - Biaya Tenaga Kerja Langsung', '1', 0),
('124', 'BDP - Biaya Overhead Pabrik', '1', 0),
('125', 'BDP - Biaya Bahan Baku', '1', 0),
('411', 'Penjualan', '4', 10000000),
('512', 'Beban Upah', '5', 10000000),
('513', 'BOP Yang Dibebankan', '5', 10000000);

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `kd_bahan_baku` char(8) NOT NULL,
  `nama_bahan_baku` varchar(20) DEFAULT NULL,
  `jenis_bahan_baku` char(8) DEFAULT NULL,
  `satuan` char(10) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan_baku`
--

INSERT INTO `bahan_baku` (`kd_bahan_baku`, `nama_bahan_baku`, `jenis_bahan_baku`, `satuan`, `harga`) VALUES
('BHN-0001', 'Kain Diamond', 'Utama', 'Meter', 23000),
('BHN-0002', 'Kain Katun', 'Utama', 'Meter', 20000),
('BHN-0003', 'Kain Sifon', 'Utama', 'Meter', 18000),
('BHN-0004', 'Kain Bubblecraft', 'Utama', 'Meter', 18000),
('BHN-0005', 'Kain Wolvis', 'Utama', 'Meter', 22000),
('BHN-0006', 'Benang', 'Utama', 'pcs', 1500),
('BHN-0007', 'Kancing', 'Penolong', 'pcs', 200),
('BHN-0008', 'Headband Mutiara', 'Penolong', 'pcs', 12000),
('BHN-0009', 'Renda', 'Penolong', 'pcs', 4000);

-- --------------------------------------------------------

--
-- Table structure for table `bom`
--

CREATE TABLE `bom` (
  `kd_produk` char(8) DEFAULT NULL,
  `kd_bahan_baku` char(8) DEFAULT NULL,
  `kuantitas` int(11) DEFAULT NULL,
  `status` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bom`
--

INSERT INTO `bom` (`kd_produk`, `kd_bahan_baku`, `kuantitas`, `status`) VALUES
('PDK-0001', 'BHN-0001', 1, 'Selesai'),
('PDK-0001', 'BHN-0006', 1, 'Selesai'),
('PDK-0002', 'BHN-0002', 1, 'Selesai'),
('PDK-0002', 'BHN-0006', 1, 'Selesai'),
('PDK-0003', 'BHN-0003', 1, 'Selesai'),
('PDK-0003', 'BHN-0006', 1, 'Selesai'),
('PDK-0004', 'BHN-0001', 1, 'Selesai'),
('PDK-0004', 'BHN-0006', 1, 'Selesai'),
('PDK-0004', 'BHN-0007', 2, 'Selesai'),
('PDK-0004', 'BHN-0008', 1, 'Selesai'),
('PDK-0005', 'BHN-0004', 1, 'Selesai'),
('PDK-0005', 'BHN-0006', 1, 'Selesai'),
('PDK-0005', 'BHN-0007', 2, 'Selesai'),
('PDK-0005', 'BHN-0009', 1, 'Selesai'),
('PDK-0006', 'BHN-0005', 1, 'Selesai'),
('PDK-0006', 'BHN-0006', 1, 'Selesai'),
('PDK-0006', 'BHN-0007', 2, 'Selesai'),
('PDK-0006', 'BHN-0009', 1, 'Selesai'),
('PDK-0007', 'BHN-0003', 1, 'Selesai'),
('PDK-0007', 'BHN-0006', 1, 'Selesai'),
('PDK-0007', 'BHN-0007', 2, 'Selesai'),
('PDK-0007', 'BHN-0009', 1, 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `kd_pesanan` char(8) DEFAULT NULL,
  `kd_produk` char(8) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jam_mesin`
--

CREATE TABLE `jam_mesin` (
  `kd_produk` char(8) DEFAULT NULL,
  `kd_mesin` char(8) DEFAULT NULL,
  `waktu` int(11) DEFAULT NULL,
  `status` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jam_mesin`
--

INSERT INTO `jam_mesin` (`kd_produk`, `kd_mesin`, `waktu`, `status`) VALUES
('PDK-0001', 'MSN-0002', 3, 'Selesai'),
('PDK-0002', 'MSN-0002', 4, 'Selesai'),
('PDK-0003', 'MSN-0002', 2, 'Selesai'),
('PDK-0004', 'MSN-0001', 3, 'Selesai'),
('PDK-0004', 'MSN-0002', 5, 'Selesai'),
('PDK-0005', 'MSN-0001', 2, 'Selesai'),
('PDK-0005', 'MSN-0002', 4, 'Selesai'),
('PDK-0007', 'MSN-0001', 2, 'Selesai'),
('PDK-0007', 'MSN-0002', 4, 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE `jurnal` (
  `no` int(11) NOT NULL,
  `no_akun` char(3) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `posisi` char(6) DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kebutuhan_akt`
--

CREATE TABLE `kebutuhan_akt` (
  `kd_pesanan` char(8) DEFAULT NULL,
  `kd_produk` char(8) DEFAULT NULL,
  `kd_aktivitas` char(8) DEFAULT NULL,
  `tarif` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kebutuhan_bb`
--

CREATE TABLE `kebutuhan_bb` (
  `kd_pesanan` char(8) DEFAULT NULL,
  `kd_produk` char(8) DEFAULT NULL,
  `kd_bahan_baku` char(8) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kebutuhan_m`
--

CREATE TABLE `kebutuhan_m` (
  `kd_pesanan` char(8) DEFAULT NULL,
  `kd_produk` char(8) DEFAULT NULL,
  `kd_mesin` char(8) DEFAULT NULL,
  `tarif` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mesin`
--

CREATE TABLE `mesin` (
  `kd_mesin` char(8) NOT NULL,
  `nama_mesin` varchar(20) DEFAULT NULL,
  `satuan` char(5) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mesin`
--

INSERT INTO `mesin` (`kd_mesin`, `nama_mesin`, `satuan`, `tarif`) VALUES
('MSN-0001', 'Mesin Obras', 'Menit', 200),
('MSN-0002', 'Mesin Jahit', 'Menit', 400);

-- --------------------------------------------------------

--
-- Table structure for table `mps`
--

CREATE TABLE `mps` (
  `kd_pesanan` char(8) DEFAULT NULL,
  `kd_produk` char(8) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `sisawaktu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mrp_ii`
--

CREATE TABLE `mrp_ii` (
  `kd_mrp_ii` char(10) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `total_bbb` int(11) DEFAULT NULL,
  `total_btkl` int(11) DEFAULT NULL,
  `total_bop` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` char(8) NOT NULL,
  `nama_pelanggan` varchar(30) DEFAULT NULL,
  `no_telp` char(12) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `no_telp`, `email`, `alamat`) VALUES
('PLG-0001', 'Okta Pascal', '085213485640', 'oktapascal48@gmail.com', 'RT 04 RW 09, Kampung Cicariang, Kelurahan Karsamenak, Kecamatan Kawalu'),
('PLG-0002', 'Billy', '084256738999', 'mmbalyann@gmail.com', 'Kp. Cijeungjing, No. 102, Kec. Bojongsoang, Kab. Bandung'),
('PLG-0003', 'Wildan', '082245672873', 'fathoniwildan27@gmail.com', 'Jl. Perintis Kemerdekaan No. 10, Kel. Karsamenak, Kec. Kawalu, Kota Tasikmalaya');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `kd_pesanan` char(8) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `status` char(7) DEFAULT NULL,
  `id_pelanggan` char(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `kd_produk` char(8) NOT NULL,
  `nama_produk` varchar(20) DEFAULT NULL,
  `satuan` char(3) NOT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`kd_produk`, `nama_produk`, `satuan`, `harga`) VALUES
('PDK-0001', 'Pashmina Diamond', 'pcs', 27000),
('PDK-0002', 'Pashmina Katun', 'pcs', 25000),
('PDK-0003', 'Pashmina Sifon', 'pcs', 24000),
('PDK-0004', 'Khimar Diamond', 'pcs', 30000),
('PDK-0005', 'Khimar Bubblecraft', 'pcs', 25000),
('PDK-0006', 'Khimar Wolvis', 'pcs', 29000),
('PDK-0007', 'Khimar Sifon', 'pcs', 26000);

-- --------------------------------------------------------

--
-- Table structure for table `routing`
--

CREATE TABLE `routing` (
  `kd_produk` char(8) DEFAULT NULL,
  `kd_aktivitas` char(8) DEFAULT NULL,
  `waktu` int(11) DEFAULT NULL,
  `status` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routing`
--

INSERT INTO `routing` (`kd_produk`, `kd_aktivitas`, `waktu`, `status`) VALUES
('PDK-0001', 'AKT-0001', 3, 'Selesai'),
('PDK-0002', 'AKT-0001', 4, 'Selesai'),
('PDK-0003', 'AKT-0001', 2, 'Selesai'),
('PDK-0004', 'AKT-0002', 3, 'Selesai'),
('PDK-0004', 'AKT-0001', 5, 'Selesai'),
('PDK-0005', 'AKT-0002', 2, 'Selesai'),
('PDK-0005', 'AKT-0001', 4, 'Selesai'),
('PDK-0007', 'AKT-0002', 2, 'Selesai'),
('PDK-0007', 'AKT-0001', 4, 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(15) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `akses` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `akses`) VALUES
('Penjualan', '5a9ba7e7854365a1303fa79c86d09556', 'Penjualan'),
('Produksi', '6d646a467905fc06cbfe549e05989edd', 'Produksi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktivitas`
--
ALTER TABLE `aktivitas`
  ADD PRIMARY KEY (`kd_aktivitas`);

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`no_akun`);

--
-- Indexes for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`kd_bahan_baku`);

--
-- Indexes for table `bom`
--
ALTER TABLE `bom`
  ADD KEY `kd_produk` (`kd_produk`),
  ADD KEY `kd_bahan_baku` (`kd_bahan_baku`);

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD KEY `kd_pesanan` (`kd_pesanan`),
  ADD KEY `kd_produk` (`kd_produk`);

--
-- Indexes for table `jam_mesin`
--
ALTER TABLE `jam_mesin`
  ADD KEY `kd_produk` (`kd_produk`),
  ADD KEY `kd_mesin` (`kd_mesin`);

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`no`),
  ADD KEY `no_akun` (`no_akun`);

--
-- Indexes for table `kebutuhan_akt`
--
ALTER TABLE `kebutuhan_akt`
  ADD KEY `kd_pesanan` (`kd_pesanan`),
  ADD KEY `kd_produk` (`kd_produk`),
  ADD KEY `kd_aktivitas` (`kd_aktivitas`);

--
-- Indexes for table `kebutuhan_bb`
--
ALTER TABLE `kebutuhan_bb`
  ADD KEY `kd_pesanan` (`kd_pesanan`),
  ADD KEY `kd_produk` (`kd_produk`),
  ADD KEY `kd_bahan_baku` (`kd_bahan_baku`);

--
-- Indexes for table `kebutuhan_m`
--
ALTER TABLE `kebutuhan_m`
  ADD KEY `kd_pesanan` (`kd_pesanan`),
  ADD KEY `kd_produk` (`kd_produk`),
  ADD KEY `kd_mesin` (`kd_mesin`);

--
-- Indexes for table `mesin`
--
ALTER TABLE `mesin`
  ADD PRIMARY KEY (`kd_mesin`);

--
-- Indexes for table `mps`
--
ALTER TABLE `mps`
  ADD KEY `kd_pesanan` (`kd_pesanan`),
  ADD KEY `kd_produk` (`kd_produk`);

--
-- Indexes for table `mrp_ii`
--
ALTER TABLE `mrp_ii`
  ADD PRIMARY KEY (`kd_mrp_ii`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`kd_pesanan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`kd_produk`);

--
-- Indexes for table `routing`
--
ALTER TABLE `routing`
  ADD KEY `kd_produk` (`kd_produk`),
  ADD KEY `kd_aktivitas` (`kd_aktivitas`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bom`
--
ALTER TABLE `bom`
  ADD CONSTRAINT `bom_ibfk_1` FOREIGN KEY (`kd_produk`) REFERENCES `produk` (`kd_produk`),
  ADD CONSTRAINT `bom_ibfk_2` FOREIGN KEY (`kd_bahan_baku`) REFERENCES `bahan_baku` (`kd_bahan_baku`);

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`kd_pesanan`) REFERENCES `pesanan` (`kd_pesanan`),
  ADD CONSTRAINT `detail_pesanan_ibfk_2` FOREIGN KEY (`kd_produk`) REFERENCES `produk` (`kd_produk`);

--
-- Constraints for table `jam_mesin`
--
ALTER TABLE `jam_mesin`
  ADD CONSTRAINT `jam_mesin_ibfk_1` FOREIGN KEY (`kd_produk`) REFERENCES `produk` (`kd_produk`),
  ADD CONSTRAINT `jam_mesin_ibfk_2` FOREIGN KEY (`kd_mesin`) REFERENCES `mesin` (`kd_mesin`);

--
-- Constraints for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD CONSTRAINT `jurnal_ibfk_1` FOREIGN KEY (`no_akun`) REFERENCES `akun` (`no_akun`);

--
-- Constraints for table `kebutuhan_akt`
--
ALTER TABLE `kebutuhan_akt`
  ADD CONSTRAINT `kebutuhan_akt_ibfk_1` FOREIGN KEY (`kd_pesanan`) REFERENCES `pesanan` (`kd_pesanan`),
  ADD CONSTRAINT `kebutuhan_akt_ibfk_2` FOREIGN KEY (`kd_produk`) REFERENCES `produk` (`kd_produk`),
  ADD CONSTRAINT `kebutuhan_akt_ibfk_3` FOREIGN KEY (`kd_aktivitas`) REFERENCES `aktivitas` (`kd_aktivitas`);

--
-- Constraints for table `kebutuhan_bb`
--
ALTER TABLE `kebutuhan_bb`
  ADD CONSTRAINT `kebutuhan_bb_ibfk_1` FOREIGN KEY (`kd_pesanan`) REFERENCES `pesanan` (`kd_pesanan`),
  ADD CONSTRAINT `kebutuhan_bb_ibfk_2` FOREIGN KEY (`kd_produk`) REFERENCES `produk` (`kd_produk`),
  ADD CONSTRAINT `kebutuhan_bb_ibfk_3` FOREIGN KEY (`kd_bahan_baku`) REFERENCES `bahan_baku` (`kd_bahan_baku`);

--
-- Constraints for table `kebutuhan_m`
--
ALTER TABLE `kebutuhan_m`
  ADD CONSTRAINT `kebutuhan_m_ibfk_1` FOREIGN KEY (`kd_pesanan`) REFERENCES `pesanan` (`kd_pesanan`),
  ADD CONSTRAINT `kebutuhan_m_ibfk_2` FOREIGN KEY (`kd_produk`) REFERENCES `produk` (`kd_produk`),
  ADD CONSTRAINT `kebutuhan_m_ibfk_3` FOREIGN KEY (`kd_mesin`) REFERENCES `mesin` (`kd_mesin`);

--
-- Constraints for table `mps`
--
ALTER TABLE `mps`
  ADD CONSTRAINT `mps_ibfk_1` FOREIGN KEY (`kd_pesanan`) REFERENCES `pesanan` (`kd_pesanan`),
  ADD CONSTRAINT `mps_ibfk_2` FOREIGN KEY (`kd_produk`) REFERENCES `produk` (`kd_produk`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`);

--
-- Constraints for table `routing`
--
ALTER TABLE `routing`
  ADD CONSTRAINT `routing_ibfk_1` FOREIGN KEY (`kd_aktivitas`) REFERENCES `aktivitas` (`kd_aktivitas`),
  ADD CONSTRAINT `routing_ibfk_2` FOREIGN KEY (`kd_produk`) REFERENCES `produk` (`kd_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
