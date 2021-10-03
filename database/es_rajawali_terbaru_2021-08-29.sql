-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2021 at 10:35 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `es_rajawali`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `id_bahan_baku` int(3) NOT NULL,
  `nama_bahan_baku` varchar(25) NOT NULL,
  `satuan` varchar(25) NOT NULL,
  `harga_satuan` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan_baku`
--

INSERT INTO `bahan_baku` (`id_bahan_baku`, `nama_bahan_baku`, `satuan`, `harga_satuan`) VALUES
(1, 'Es', 'Pak', 50000),
(2, 'Susu', 'Kaleng', 10000),
(3, 'Rumput Laut', 'Kg', 15000),
(4, 'Gelas', 'Unit', 300),
(5, 'adas', 'asdas', 4214),
(6, 'indomie', 'bks', 2000),
(8, 'Mises', '-', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
--

CREATE TABLE `cabang` (
  `id_cabang` int(3) NOT NULL,
  `nama_cabang` varchar(25) NOT NULL,
  `pj` varchar(25) NOT NULL,
  `alamat` text NOT NULL,
  `nohp` varchar(14) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cabang`
--

INSERT INTO `cabang` (`id_cabang`, `nama_cabang`, `pj`, `alamat`, `nohp`, `username`, `password`, `status`) VALUES
(6, 'A Yani saja', 'Hamid Septian', 'A Yani aqe23', '000000000', '0010', '0010', ''),
(7, 'Patimura', 'sfsdfsdf', 'disana', '0812', '002', '002', 'Cabang Utama'),
(8, 'Lubuk Buaya', 'Ucok Baba', 'Lubuk Buaya', '081212121212', '003', '003', '');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `id_cabang` varchar(5) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `id_penggajian` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `id_cabang`, `nama`, `alamat`, `nohp`, `id_penggajian`) VALUES
(12, '6', 'Ahmad', 'disana', '0812', '12'),
(13, '6', 'Idul', 'disini', '08121212', '10');

-- --------------------------------------------------------

--
-- Table structure for table `management_bahan_baku`
--

CREATE TABLE `management_bahan_baku` (
  `id_managemen` int(11) NOT NULL,
  `id_bahan_baku` varchar(5) NOT NULL,
  `nama_bahan_baku` varchar(25) NOT NULL,
  `harga_satuan` int(15) NOT NULL,
  `satuan` varchar(25) NOT NULL,
  `qty` int(5) NOT NULL,
  `jenis` varchar(15) NOT NULL,
  `id_cabang` varchar(5) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `management_bahan_baku`
--

INSERT INTO `management_bahan_baku` (`id_managemen`, `id_bahan_baku`, `nama_bahan_baku`, `harga_satuan`, `satuan`, `qty`, `jenis`, `id_cabang`, `tgl_transaksi`, `status`) VALUES
(22, '2', 'Susu', 10000, 'Kaleng', 2, 'Masuk', '', '2021-07-27', 'Selesai'),
(23, '5', 'adas', 4214, 'asdas', 2, 'Masuk', '', '2021-07-27', 'Selesai'),
(24, '6', 'indomie', 2000, 'bks', 3, 'Masuk', '', '2021-07-27', 'Selesai'),
(25, '3', 'Rumput Laut', 15000, 'Kg', 5, 'Masuk', '', '2021-08-27', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `alamat_pelanggan` text NOT NULL,
  `nohp_pelanggan` varchar(16) NOT NULL,
  `email_pelanggan` text NOT NULL,
  `password` text NOT NULL,
  `reg_via` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat_pelanggan`, `nohp_pelanggan`, `email_pelanggan`, `password`, `reg_via`) VALUES
(4, 'Hamid Septian', 'Maransi city', '081212121212', 'hamidseptian@gmail.com', '11', 'Online'),
(5, 'Ucok Baba', 'Padang ', '081212121212', 'ucok@gmail.com', '123', 'Online');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pelanggan` varchar(5) NOT NULL,
  `id_cabang` varchar(5) NOT NULL,
  `waktu_pesan` varchar(25) NOT NULL,
  `file` text NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pelanggan`, `id_cabang`, `waktu_pesan`, `file`, `status`) VALUES
(8, '4', '6', '2021-04-13 15:03:09', '210415120924eoqm.PNG', 'Acc'),
(9, '5', '6', '2021-04-15 12:34:11', '210415123516cbt_us_sma5.PNG', 'Acc'),
(10, '5', '6', '2021-04-15 12:47:00', '210415124706gambarproject_untitled.jpg', 'Acc');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `id_cabang` varchar(5) NOT NULL,
  `kategori` varchar(25) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `biaya` int(15) NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `id_cabang`, `kategori`, `keterangan`, `tanggal_transaksi`, `biaya`, `bulan`, `tahun`) VALUES
(10, '6', 'Penggajian', 'Pembayaran gaji karyawan', '2021-07-20', 16500000, 0, 0),
(11, '6', 'Operasional', 'Listrik', '2021-07-20', 500000, 0, 0),
(13, '6', 'Penggajian', 'Pembayaran gaji karyawan', '2021-07-20', 16500000, 0, 0),
(14, '6', 'Penggajian', 'Pembayaran gaji karyawan', '2021-07-20', 165000, 0, 0),
(15, '6', 'Operasional', 'lampu', '2021-08-07', 200000, 0, 0),
(16, '6', 'Penggajian', 'Pembayaran gaji karyawan', '2021-07-27', 6500000, 0, 0),
(17, '1', 'Bahan Baku', 'modal bahan baku', '2021-07-27', 600000, 0, 0),
(19, '7', 'Bahan Baku', 'modal', '2021-07-27', 500000, 0, 0),
(20, '7', 'Bahan Baku', 'Modal', '2021-08-27', 500000, 0, 0),
(21, '7', 'Bahan Baku', '+', '2021-08-27', 200000, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `penggajian`
--

CREATE TABLE `penggajian` (
  `id_penggajian` int(11) NOT NULL,
  `id_cabang` varchar(5) NOT NULL,
  `jabatan` varchar(25) NOT NULL,
  `gaji` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penggajian`
--

INSERT INTO `penggajian` (`id_penggajian`, `id_cabang`, `jabatan`, `gaji`) VALUES
(3, '', 'Manager Cabang', 5000000),
(4, '', 'Cooker', 4000000),
(5, '', 'Helper', 3500000),
(6, '7', 'Owner se', 7000000),
(7, '7', 'Manager', 5000000),
(8, '7', 'Cooker', 2500000),
(9, '7', 'Helper', 2400000),
(10, '6', 'Manager', 4000000),
(11, '6', 'Pelayan', 200000),
(12, '6', 'Chef', 2500000);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(3) NOT NULL,
  `produk` varchar(25) NOT NULL,
  `harga_satuan` int(15) NOT NULL,
  `qty` int(5) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `jam_transaksi` varchar(10) NOT NULL,
  `id_cabang` varchar(5) NOT NULL,
  `pesan_via` varchar(15) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `produk`, `harga_satuan`, `qty`, `tanggal_transaksi`, `jam_transaksi`, `id_cabang`, `pesan_via`, `keterangan`) VALUES
(98, 'asdas', 213, 121, '2021-08-29', '', '6', '', ''),
(99, 'Es kelapa', 5000, 334, '2021-08-29', '', '6', '', ''),
(100, 'Es cendol', 10000, 534, '2021-08-29', '', '6', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_pelanggan` varchar(5) NOT NULL,
  `id_produk` varchar(5) NOT NULL,
  `harga_satuan` int(10) NOT NULL,
  `qty` int(4) NOT NULL,
  `id_cabang` varchar(5) NOT NULL,
  `waktu_pesan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_pelanggan`, `id_produk`, `harga_satuan`, `qty`, `id_cabang`, `waktu_pesan`, `status`) VALUES
(4, '4', '4', 90000, 50, '4', '2021-04-13 08:02:39', 'Order'),
(6, '4', '6', 5000, 5, '6', '2021-04-13 08:03:09', 'Order'),
(7, '4', '4', 90000, 3, '7', '2021-04-13 08:02:33', 'Order'),
(8, '4', '4', 90000, 8, '7', '2021-04-12 19:56:50', 'Order'),
(9, '5', '6', 5000, 3, '6', '2021-04-15 05:40:36', 'Selesai'),
(10, '5', '7', 8000, 20, '6', '2021-04-15 05:40:36', 'Selesai'),
(11, '5', '4', 90000, 22, '6', '2021-04-15 05:40:36', 'Selesai'),
(12, '5', '4', 90000, 900, '6', '2021-04-15 05:47:31', 'Selesai'),
(13, '5', '5', 15000, 8, '6', '2021-04-15 05:47:31', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(3) NOT NULL,
  `id_cabang` varchar(5) NOT NULL,
  `nama_produk` varchar(25) NOT NULL,
  `harga` int(10) NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_cabang`, `nama_produk`, `harga`, `gambar`) VALUES
(11, '0', 'asdas', 213, '210719113638padi.jpg'),
(12, '7', 'Es durian', 30000, '210719114304kochenk.jpg'),
(13, '6', 'Es kelapa', 5000, '210720023024kwitasni.jpg'),
(14, '6', 'Es cendol', 10000, '210720081108kochenk.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `target`
--

CREATE TABLE `target` (
  `id_target` int(11) NOT NULL,
  `id_cabang` varchar(2) NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` int(4) NOT NULL,
  `target_penjualan` decimal(15,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `target`
--

INSERT INTO `target` (`id_target`, `id_cabang`, `bulan`, `tahun`, `target_penjualan`) VALUES
(1, '6', 4, 2021, '400000'),
(2, '7', 4, 2021, '50000'),
(3, '7', 7, 2021, '45000'),
(4, '6', 8, 2021, '70000'),
(5, '7', 8, 2021, '46000'),
(6, '8', 8, 2021, '6000'),
(7, '7', 4, 2020, '5'),
(8, '7', 5, 2021, '7000000'),
(9, '6', 7, 2021, '60000'),
(10, '6', 9, 2021, '1000'),
(11, '8', 7, 2021, '50000'),
(12, '7', 1, 2021, '500');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(3) NOT NULL,
  `nama_user` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` text NOT NULL,
  `level` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `level`) VALUES
(1, 'Hamid Septian', '11', '11', 'Admin Master'),
(4, 'Defrianto', '22', '22', 'Admin Gudang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`id_bahan_baku`);

--
-- Indexes for table `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id_cabang`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `management_bahan_baku`
--
ALTER TABLE `management_bahan_baku`
  ADD PRIMARY KEY (`id_managemen`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indexes for table `penggajian`
--
ALTER TABLE `penggajian`
  ADD PRIMARY KEY (`id_penggajian`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `target`
--
ALTER TABLE `target`
  ADD PRIMARY KEY (`id_target`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  MODIFY `id_bahan_baku` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cabang`
--
ALTER TABLE `cabang`
  MODIFY `id_cabang` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `management_bahan_baku`
--
ALTER TABLE `management_bahan_baku`
  MODIFY `id_managemen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `penggajian`
--
ALTER TABLE `penggajian`
  MODIFY `id_penggajian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `target`
--
ALTER TABLE `target`
  MODIFY `id_target` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
