-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16 Agu 2018 pada 17.37
-- Versi Server: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk-pm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `user` varchar(16) NOT NULL,
  `pass` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`user`, `pass`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_alternatif`
--

CREATE TABLE `tb_alternatif` (
  `kode_alternatif` varchar(8) NOT NULL,
  `nama_alternatif` varchar(64) DEFAULT NULL,
  `user` varchar(16) DEFAULT NULL,
  `pass` varchar(16) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `rank` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_alternatif`
--

INSERT INTO `tb_alternatif` (`kode_alternatif`, `nama_alternatif`, `user`, `pass`, `total`, `rank`) VALUES
('AL001', 'Muhammad Indra Saputra', 'indra', 'indra', NULL, NULL),
('AL002', 'Nindiya Kumalasari Putri', 'nindi', 'nindi', NULL, NULL),
('AL003', 'Farhan Mahesa Ramadhan', 'farha', 'farha', NULL, NULL),
('AL004', 'Nur Aisyah Fauziah', 'zia', 'zia', NULL, NULL),
('AL005', 'Dhiana Putri Kartika', 'AL005', 'AL005', NULL, NULL),
('AL006', 'Syahrul Muhammad Abdullah', 'AL006', 'AL006', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_aspek`
--

CREATE TABLE `tb_aspek` (
  `kode_aspek` varchar(8) NOT NULL,
  `nama_aspek` varchar(64) DEFAULT NULL,
  `persen` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_aspek`
--

INSERT INTO `tb_aspek` (`kode_aspek`, `nama_aspek`, `persen`) VALUES
('A01', 'Akademik', 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_crips`
--

CREATE TABLE `tb_crips` (
  `kode_crips` double NOT NULL,
  `kode_kriteria` varchar(255) DEFAULT NULL,
  `nama_crips` varchar(255) DEFAULT NULL,
  `nilai_crips` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_crips`
--

INSERT INTO `tb_crips` (`kode_crips`, `kode_kriteria`, `nama_crips`, `nilai_crips`) VALUES
(1, 'KR01', 'Sangat Kurang', 1),
(2, 'KR01', 'Kurang', 2),
(3, 'KR01', 'Cukup', 3),
(4, 'KR01', 'Baik', 4),
(5, 'KR01', 'Sangat Baik', 5),
(6, 'KR02', 'Sangat Kurang', 1),
(7, 'KR02', 'Kurang', 2),
(8, 'KR02', 'Cukup', 3),
(9, 'KR02', 'Baik', 4),
(10, 'KR02', 'Sangat Baik', 5),
(11, 'KR03', 'Sangat Kurang', 1),
(12, 'KR03', 'Kurang', 2),
(13, 'KR03', 'Cukup', 3),
(14, 'KR03', 'Baik', 4),
(15, 'KR03', 'Sangat Baik', 5),
(16, 'KR04', 'Sangat Kurang', 1),
(17, 'KR04', 'Kurang', 2),
(18, 'KR04', 'Cukup', 3),
(19, 'KR04', 'Baik', 4),
(20, 'KR04', 'Sangat Baik', 5),
(21, 'KR05', 'Sangat Kurang', 1),
(22, 'KR05', 'Kurang', 2),
(23, 'KR05', 'Cukup', 3),
(24, 'KR05', 'Baik', 4),
(25, 'KR05', 'Sangat Baik', 5),
(26, 'KR06', 'Sangat Kurang', 1),
(27, 'KR06', 'Kurang', 2),
(28, 'KR06', 'Cukup', 3),
(29, 'KR06', 'Baik', 4),
(30, 'KR06', 'Sangat Baik', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `kode_kriteria` varchar(16) NOT NULL,
  `nama_kriteria` varchar(64) NOT NULL,
  `kode_aspek` varchar(8) NOT NULL,
  `nilai_kriteria` int(11) NOT NULL,
  `factor` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`kode_kriteria`, `nama_kriteria`, `kode_aspek`, `nilai_kriteria`, `factor`) VALUES
('KR01', 'Nilai Pend. Agama Islam', 'A01', 5, 'Core'),
('KR02', 'Nilai Matematika', 'A01', 4, 'Core'),
('KR03', 'Nilai IPA', 'A01', 4, 'Core'),
('KR04', 'Nilai IPS', 'A01', 3, 'Secondary'),
('KR05', 'Nilai Bahasa Indonesia', 'A01', 3, 'Secondary'),
('KR06', 'Nilai Bahasa Inggris', 'A01', 3, 'Secondary');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_profile`
--

CREATE TABLE `tb_profile` (
  `ID` int(11) NOT NULL,
  `kode_alternatif` varchar(8) DEFAULT NULL,
  `kode_aspek` varchar(8) DEFAULT NULL,
  `kode_kriteria` varchar(8) DEFAULT NULL,
  `kode_crips` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_profile`
--

INSERT INTO `tb_profile` (`ID`, `kode_alternatif`, `kode_aspek`, `kode_kriteria`, `kode_crips`) VALUES
(368, 'AL001', 'A01', 'KR01', 4),
(369, 'AL001', 'A01', 'KR02', 8),
(370, 'AL001', 'A01', 'KR03', 14),
(371, 'AL001', 'A01', 'KR04', 18),
(372, 'AL001', 'A01', 'KR05', 24),
(373, 'AL001', 'A01', 'KR06', 29),
(374, 'AL002', 'A01', 'KR01', 4),
(375, 'AL002', 'A01', 'KR02', 9),
(376, 'AL002', 'A01', 'KR03', 13),
(377, 'AL002', 'A01', 'KR04', 18),
(378, 'AL002', 'A01', 'KR05', 23),
(379, 'AL002', 'A01', 'KR06', 29),
(380, 'AL003', 'A01', 'KR01', 5),
(381, 'AL003', 'A01', 'KR02', 9),
(382, 'AL003', 'A01', 'KR03', 14),
(383, 'AL003', 'A01', 'KR04', 19),
(384, 'AL003', 'A01', 'KR05', 24),
(385, 'AL003', 'A01', 'KR06', 28),
(386, 'AL004', 'A01', 'KR01', 4),
(387, 'AL004', 'A01', 'KR02', 9),
(388, 'AL004', 'A01', 'KR03', 14),
(389, 'AL004', 'A01', 'KR04', 18),
(390, 'AL004', 'A01', 'KR05', 24),
(391, 'AL004', 'A01', 'KR06', 29),
(392, 'AL005', 'A01', 'KR01', 5),
(393, 'AL005', 'A01', 'KR02', 8),
(394, 'AL005', 'A01', 'KR03', 14),
(395, 'AL005', 'A01', 'KR04', 18),
(396, 'AL005', 'A01', 'KR05', 24),
(397, 'AL005', 'A01', 'KR06', 28),
(398, 'AL006', 'A01', 'KR01', 5),
(399, 'AL006', 'A01', 'KR02', 8),
(400, 'AL006', 'A01', 'KR03', 13),
(401, 'AL006', 'A01', 'KR04', 19),
(402, 'AL006', 'A01', 'KR05', 24),
(403, 'AL006', 'A01', 'KR06', 29);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  ADD PRIMARY KEY (`kode_alternatif`);

--
-- Indexes for table `tb_aspek`
--
ALTER TABLE `tb_aspek`
  ADD PRIMARY KEY (`kode_aspek`);

--
-- Indexes for table `tb_crips`
--
ALTER TABLE `tb_crips`
  ADD PRIMARY KEY (`kode_crips`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`kode_kriteria`);

--
-- Indexes for table `tb_profile`
--
ALTER TABLE `tb_profile`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_crips`
--
ALTER TABLE `tb_crips`
  MODIFY `kode_crips` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `tb_profile`
--
ALTER TABLE `tb_profile`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=404;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
