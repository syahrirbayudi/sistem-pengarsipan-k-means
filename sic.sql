-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2020 at 02:44 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sic`
--

-- --------------------------------------------------------

--
-- Table structure for table `centroid_temp`
--

CREATE TABLE `centroid_temp` (
  `id` int(5) NOT NULL,
  `iterasi` int(11) NOT NULL,
  `c1` varchar(50) NOT NULL,
  `c2` varchar(50) NOT NULL,
  `c3` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `centroid_temp`
--

INSERT INTO `centroid_temp` (`id`, `iterasi`, `c1`, `c2`, `c3`) VALUES
(1, 1, '0', '1', '0'),
(2, 1, '0', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `no_data` int(5) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sub` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`no_data`, `title`, `sub`) VALUES
(1, 'SISTEM INFORMASI PENGARSIPAN P.O MEDAN JAYA', ''),
(2, 'Petunjuk Penggunaan', 'Hello'),
(3, 'Tentang', 'kanjbhsd asdlkjbkasd'),
(4, 'Wewenang', 'lmkansfas alsmdkasd');

-- --------------------------------------------------------

--
-- Table structure for table `data_bus`
--

CREATE TABLE `data_bus` (
  `no` int(5) NOT NULL,
  `merk_bus` varchar(127) NOT NULL,
  `kelas_bus` varchar(32) NOT NULL,
  `jumlah_tujuan` varchar(10) NOT NULL,
  `jumlah_kursi` varchar(12) NOT NULL,
  `persen_ketersediaan` varchar(19) NOT NULL,
  `total_sedia` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_bus`
--

INSERT INTO `data_bus` (`no`, `merk_bus`, `kelas_bus`, `jumlah_tujuan`, `jumlah_kursi`, `persen_ketersediaan`, `total_sedia`) VALUES
(3, 'Mersedes Bens', 'AC', '6', '43', '34', '23'),
(8, 'Mersedes Bens 1609', 'AC', '5', '45', '0', '0'),
(13, 'golden dragon', 'AC Exclusive', '4', '55', '0', '0'),
(14, 'Mercedes-Benz OH', 'AC Exclusive', '4', '45', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `data_fasilitas`
--

CREATE TABLE `data_fasilitas` (
  `no_fasilitas` int(5) NOT NULL,
  `nama_fasilitas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_fasilitas`
--

INSERT INTO `data_fasilitas` (`no_fasilitas`, `nama_fasilitas`) VALUES
(1, 'AC'),
(2, 'Sofa'),
(3, 'komputer');

-- --------------------------------------------------------

--
-- Table structure for table `data_loket`
--

CREATE TABLE `data_loket` (
  `no_loket` int(5) NOT NULL,
  `nama_loket` varchar(28) NOT NULL,
  `jumlah_penumpang_total` int(10) NOT NULL,
  `ketersediaan_bus_total` int(10) NOT NULL,
  `jumlah_fasilitas_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_loket`
--

INSERT INTO `data_loket` (`no_loket`, `nama_loket`, `jumlah_penumpang_total`, `ketersediaan_bus_total`, `jumlah_fasilitas_total`) VALUES
(10, 'PO Medan Jaya', 0, 0, 0),
(11, 'PO Medan Jaya P.B', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_pasien`
--

CREATE TABLE `data_pasien` (
  `no_pasien` int(5) NOT NULL,
  `nama_pasien` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_tahun`
--

CREATE TABLE `data_tahun` (
  `no_tahun` int(10) NOT NULL,
  `nama_tahun` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_tahun`
--

INSERT INTO `data_tahun` (`no_tahun`, `nama_tahun`) VALUES
(1, 2017),
(2, 2018),
(5, 2019),
(6, 2020);

-- --------------------------------------------------------

--
-- Table structure for table `data_tujuan`
--

CREATE TABLE `data_tujuan` (
  `no_tujuan` int(5) NOT NULL,
  `nama_tujuan` varchar(41) DEFAULT NULL,
  `no` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_tujuan`
--

INSERT INTO `data_tujuan` (`no_tujuan`, `nama_tujuan`, `no`) VALUES
(2, 'Aceh', 6),
(3, 'ujung  bau rokan', 7),
(4, 'Aceh', 7),
(5, 'Jakarta', 13),
(6, 'Palembang', 13);

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id` int(5) NOT NULL,
  `no_loket` int(5) NOT NULL,
  `predikat` varchar(30) NOT NULL,
  `d1` int(11) NOT NULL,
  `d2` int(11) NOT NULL,
  `d3` int(11) NOT NULL,
  `d4` int(11) NOT NULL,
  `d5` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id`, `no_loket`, `predikat`, `d1`, `d2`, `d3`, `d4`, `d5`) VALUES
(1, 10, 'Kurang Sekali', 79, 58, 47, 29, 23),
(2, 11, 'Kurang Sekali', 87, 66, 55, 37, 31);

-- --------------------------------------------------------

--
-- Table structure for table `hasil_centroid`
--

CREATE TABLE `hasil_centroid` (
  `nomor` int(2) NOT NULL,
  `c1a` varchar(50) NOT NULL,
  `c1b` varchar(50) NOT NULL,
  `c1c` varchar(50) NOT NULL,
  `c2a` varchar(50) NOT NULL,
  `c2b` varchar(50) NOT NULL,
  `c2c` varchar(50) NOT NULL,
  `c3a` varchar(50) NOT NULL,
  `c3b` varchar(50) NOT NULL,
  `c3c` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jumlah_bus_loket`
--

CREATE TABLE `jumlah_bus_loket` (
  `no_jumlah_bus` int(5) NOT NULL,
  `no_loket` int(5) NOT NULL,
  `no` int(5) NOT NULL,
  `jumlah_bus` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jumlah_bus_loket`
--

INSERT INTO `jumlah_bus_loket` (`no_jumlah_bus`, `no_loket`, `no`, `jumlah_bus`) VALUES
(3, 10, 8, 10),
(5, 10, 7, 10),
(6, 10, 13, 5),
(7, 11, 13, 3),
(8, 11, 8, 6);

-- --------------------------------------------------------

--
-- Table structure for table `jumlah_fasilitas_loket`
--

CREATE TABLE `jumlah_fasilitas_loket` (
  `no_jumlah_fasilitas` int(5) NOT NULL,
  `no_fasilitas` int(5) NOT NULL,
  `no_loket` int(5) NOT NULL,
  `jumlah_fasilitas` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jumlah_fasilitas_loket`
--

INSERT INTO `jumlah_fasilitas_loket` (`no_jumlah_fasilitas`, `no_fasilitas`, `no_loket`, `jumlah_fasilitas`) VALUES
(4, 2, 10, 3),
(5, 3, 10, 6),
(6, 1, 11, 5);

-- --------------------------------------------------------

--
-- Table structure for table `jumlah_tujuan_loket`
--

CREATE TABLE `jumlah_tujuan_loket` (
  `no_jumlah_tujuan` int(5) NOT NULL,
  `no_tahun` int(5) NOT NULL,
  `no_loket` int(5) NOT NULL,
  `nama_penumpang` varchar(255) NOT NULL,
  `no_tujuan` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jumlah_tujuan_loket`
--

INSERT INTO `jumlah_tujuan_loket` (`no_jumlah_tujuan`, `no_tahun`, `no_loket`, `nama_penumpang`, `no_tujuan`) VALUES
(1, 6, 8, 'asdasdass', 3),
(2, 5, 8, 'asdzzzx', 1),
(3, 6, 8, 'aaaaaaaaaaaaaaa', 0),
(4, 6, 8, 'dddddddddddddddddd', 0),
(5, 6, 8, 'awasdasd', 0),
(6, 6, 8, 'awasdasd', 0),
(7, 6, 8, 'awasdasd', 0),
(11, 6, 10, 'dadang', 3),
(12, 6, 10, 'hantu', 2),
(13, 6, 10, 'tantan', 5),
(14, 5, 10, 'rani', 5),
(15, 6, 10, 'yuda', 5),
(16, 5, 11, 'tuti', 5),
(17, 5, 11, 'janur', 3),
(18, 6, 11, 'era', 6);

-- --------------------------------------------------------

--
-- Table structure for table `rata_rata`
--

CREATE TABLE `rata_rata` (
  `id` int(5) NOT NULL,
  `no_loket` int(5) NOT NULL,
  `rata_rata` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rata_rata`
--

INSERT INTO `rata_rata` (`id`, `no_loket`, `rata_rata`) VALUES
(1, 10, 13),
(2, 11, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(5) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(1) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`, `nama`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'ADMIN'),
(2, 'pimpinan', '59335c9f58c78597ff73f6706c6c8fa278e08b3a', 2, 'PIMPINAN'),
(3, 'kabag', 'e2979e759574b094b7c50f54846af43ef8eff1a0', 3, 'KAP.BAGIAN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `centroid_temp`
--
ALTER TABLE `centroid_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`no_data`);

--
-- Indexes for table `data_bus`
--
ALTER TABLE `data_bus`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `data_fasilitas`
--
ALTER TABLE `data_fasilitas`
  ADD PRIMARY KEY (`no_fasilitas`);

--
-- Indexes for table `data_loket`
--
ALTER TABLE `data_loket`
  ADD PRIMARY KEY (`no_loket`);

--
-- Indexes for table `data_pasien`
--
ALTER TABLE `data_pasien`
  ADD PRIMARY KEY (`no_pasien`);

--
-- Indexes for table `data_tahun`
--
ALTER TABLE `data_tahun`
  ADD PRIMARY KEY (`no_tahun`);

--
-- Indexes for table `data_tujuan`
--
ALTER TABLE `data_tujuan`
  ADD PRIMARY KEY (`no_tujuan`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasil_centroid`
--
ALTER TABLE `hasil_centroid`
  ADD PRIMARY KEY (`nomor`);

--
-- Indexes for table `jumlah_bus_loket`
--
ALTER TABLE `jumlah_bus_loket`
  ADD PRIMARY KEY (`no_jumlah_bus`);

--
-- Indexes for table `jumlah_fasilitas_loket`
--
ALTER TABLE `jumlah_fasilitas_loket`
  ADD PRIMARY KEY (`no_jumlah_fasilitas`);

--
-- Indexes for table `jumlah_tujuan_loket`
--
ALTER TABLE `jumlah_tujuan_loket`
  ADD PRIMARY KEY (`no_jumlah_tujuan`);

--
-- Indexes for table `rata_rata`
--
ALTER TABLE `rata_rata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `centroid_temp`
--
ALTER TABLE `centroid_temp`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `no_data` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_bus`
--
ALTER TABLE `data_bus`
  MODIFY `no` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `data_fasilitas`
--
ALTER TABLE `data_fasilitas`
  MODIFY `no_fasilitas` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_loket`
--
ALTER TABLE `data_loket`
  MODIFY `no_loket` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `data_pasien`
--
ALTER TABLE `data_pasien`
  MODIFY `no_pasien` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_tahun`
--
ALTER TABLE `data_tahun`
  MODIFY `no_tahun` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `data_tujuan`
--
ALTER TABLE `data_tujuan`
  MODIFY `no_tujuan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hasil_centroid`
--
ALTER TABLE `hasil_centroid`
  MODIFY `nomor` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jumlah_bus_loket`
--
ALTER TABLE `jumlah_bus_loket`
  MODIFY `no_jumlah_bus` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jumlah_fasilitas_loket`
--
ALTER TABLE `jumlah_fasilitas_loket`
  MODIFY `no_jumlah_fasilitas` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jumlah_tujuan_loket`
--
ALTER TABLE `jumlah_tujuan_loket`
  MODIFY `no_jumlah_tujuan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `rata_rata`
--
ALTER TABLE `rata_rata`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
