-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 14 Bulan Mei 2019 pada 13.37
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ahp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id`, `nama`) VALUES
(30, 'SMP 1'),
(31, 'SMP 2'),
(32, 'SMP 3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ir`
--

CREATE TABLE `ir` (
  `jumlah` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ir`
--

INSERT INTO `ir` (`jumlah`, `nilai`) VALUES
(1, 0),
(2, 0),
(3, 0.58),
(4, 0.9),
(5, 1.12),
(6, 1.24),
(7, 1.32),
(8, 1.41),
(9, 1.45),
(10, 1.49),
(11, 1.51),
(12, 1.48),
(13, 1.56),
(14, 1.57),
(15, 1.59);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id`, `nama`) VALUES
(57, 'peserta didik'),
(56, 'lingkungan dan kultu'),
(55, 'sarana dan prasarana'),
(54, 'organisasi dan kelem'),
(53, 'administrasi dan man');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perbandingan_alternatif`
--

CREATE TABLE `perbandingan_alternatif` (
  `id` int(11) NOT NULL,
  `alternatif1` int(11) NOT NULL,
  `alternatif2` int(11) NOT NULL,
  `pembanding` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `perbandingan_alternatif`
--

INSERT INTO `perbandingan_alternatif` (`id`, `alternatif1`, `alternatif2`, `pembanding`, `nilai`) VALUES
(45, 31, 32, 53, 0.333333),
(44, 30, 32, 53, 0.25),
(43, 30, 31, 53, 3),
(48, 31, 32, 54, 2),
(47, 30, 32, 54, 3),
(46, 30, 31, 54, 0.25),
(57, 31, 32, 57, 3),
(56, 30, 32, 57, 0.333333),
(55, 30, 31, 57, 2),
(54, 31, 32, 56, 3),
(53, 30, 32, 56, 4),
(52, 30, 31, 56, 3),
(51, 31, 32, 55, 0.25),
(50, 30, 32, 55, 2),
(49, 30, 31, 55, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `perbandingan_kriteria`
--

CREATE TABLE `perbandingan_kriteria` (
  `id` int(11) NOT NULL,
  `kriteria1` int(11) NOT NULL,
  `kriteria2` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `perbandingan_kriteria`
--

INSERT INTO `perbandingan_kriteria` (`id`, `kriteria1`, `kriteria2`, `nilai`) VALUES
(47, 56, 57, 5),
(46, 55, 57, 5),
(45, 55, 56, 0.333333),
(43, 54, 56, 3),
(42, 54, 55, 3),
(44, 54, 57, 4),
(38, 53, 54, 0.25),
(40, 53, 56, 0.333333),
(39, 53, 55, 0.333333),
(41, 53, 57, 0.25);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pv_alternatif`
--

CREATE TABLE `pv_alternatif` (
  `id` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pv_alternatif`
--

INSERT INTO `pv_alternatif` (`id`, `id_alternatif`, `id_kriteria`, `nilai`) VALUES
(70, 32, 53, 0.603383),
(69, 31, 53, 0.138628),
(68, 30, 53, 0.257989),
(73, 32, 54, 0.171627),
(72, 31, 54, 0.551587),
(71, 30, 54, 0.276786),
(82, 32, 57, 0.332479),
(81, 31, 57, 0.367806),
(80, 30, 57, 0.299715),
(79, 32, 56, 0.119939),
(78, 31, 56, 0.272099),
(77, 30, 56, 0.607962),
(76, 32, 55, 0.34595),
(75, 31, 55, 0.110297),
(74, 30, 55, 0.543753);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pv_kriteria`
--

CREATE TABLE `pv_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pv_kriteria`
--

INSERT INTO `pv_kriteria` (`id_kriteria`, `nilai`) VALUES
(53, 0.0622371),
(54, 0.401034),
(55, 0.17659),
(56, 0.257085),
(57, 0.103054);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ranking`
--

CREATE TABLE `ranking` (
  `id_alternatif` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ranking`
--

INSERT INTO `ranking` (`id_alternatif`, `nilai`) VALUES
(32, 0.23257),
(31, 0.357167),
(30, 0.410263);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ir`
--
ALTER TABLE `ir`
  ADD PRIMARY KEY (`jumlah`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `perbandingan_alternatif`
--
ALTER TABLE `perbandingan_alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `perbandingan_kriteria`
--
ALTER TABLE `perbandingan_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pv_alternatif`
--
ALTER TABLE `pv_alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pv_kriteria`
--
ALTER TABLE `pv_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `ranking`
--
ALTER TABLE `ranking`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `perbandingan_alternatif`
--
ALTER TABLE `perbandingan_alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `perbandingan_kriteria`
--
ALTER TABLE `perbandingan_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `pv_alternatif`
--
ALTER TABLE `pv_alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
