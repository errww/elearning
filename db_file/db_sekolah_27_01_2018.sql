-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 27, 2018 at 10:05 PM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 5.6.30-10+deb.sury.org~xenial+2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, '1', '$2y$10$b6JskNdwYq6ekZfQRuh.M.8E2K63fjVe.TF25pKUhQ3HlorFQJgki'),
(2, '2', '$2y$10$hIyPyjZ0kuJtbDaACFtOyOi6vwMFYFJajC3kgnft3a0PMomxCoGgi'),
(3, '3', '3');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `book_isbn` int(11) NOT NULL,
  `book_title` varchar(50) NOT NULL,
  `book_author` varchar(50) NOT NULL,
  `book_category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `telp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tgl_lahir` varchar(255) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nama`, `nik`, `password`, `telp`, `email`, `alamat`, `tgl_lahir`, `jenis_kelamin`, `foto`) VALUES
(45, 'Gurih Gurih nyoy', '141201234567', '$2y$10$s2VdHHM2IaygI9Iugb2fN.VzGYwrnkqR/Saa4fuVcRVk6I9GAR/2q', '1234567890', 'ahaha@fjshjf.cc', 'Bantul,Yogyakarta. jl srandakan km 01', '30-04-1990', 'P', 'a5e964f72b3c63628325c56975a0b6f2.jpg'),
(46, 'paijo', '898999', '$2y$10$s2VdHHM2IaygI9Iugb2fN.VzGYwrnkqR/Saa4fuVcRVk6I9GAR/2q', '', '', '', '2018-01-26', 'L', '');

-- --------------------------------------------------------

--
-- Table structure for table `guru_mapel`
--

CREATE TABLE `guru_mapel` (
  `id_guru` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru_mapel`
--

INSERT INTO `guru_mapel` (`id_guru`, `id_mapel`) VALUES
(45, 1),
(45, 2),
(45, 3),
(45, 4);

-- --------------------------------------------------------

--
-- Table structure for table `guru_pesan_informasi`
--

CREATE TABLE `guru_pesan_informasi` (
  `id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `isi` longtext,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru_pesan_informasi`
--

INSERT INTO `guru_pesan_informasi` (`id`, `guru_id`, `title`, `isi`, `created_at`) VALUES
(3, 46, 'hehehehe', 'hehehehe jaajjaaj', '2018-01-27 07:19:17'),
(36, 45, 'pengumuman libur hari sabtu', '<p>ini deskipsi aja yaaa</p>\r\n', '2018-01-27 14:30:46'),
(37, 45, 'pengumuan pengambilan raport kelas duaa', '<p>pengumuman pengambilan raport untuk murid</p>\r\n', '2018-01-27 14:10:56'),
(38, 45, 'wawawaw hehehe', '<p>ini dalahh sempel mantabbb</p>\r\n', '2018-01-27 14:49:16'),
(40, 45, 'hahaha', '<p>afjafhjahfjhaj</p>\n', '2018-01-27 14:26:09'),
(41, 45, 'wkwkwk', '<p>jkjkjkjkjkjkjkjkj</p>\r\n', '2018-01-27 14:47:54'),
(42, 45, 'hohoho', '<p>hohohohoho</p>\r\n', '2018-01-27 14:47:39'),
(43, 45, 'wkwkwk', '<p>sjfkskjfkjskjf</p>\n', '2018-01-27 14:26:28'),
(45, 45, 'dfnjdnjfdnjfnj', '<p>njdnjvnjdnjv</p>\r\n', '2018-01-27 14:57:24'),
(48, 45, 'test mozilla', '<p>javascript</p>\r\n', '2018-01-27 14:57:44'),
(49, 45, 'mantabb', '<p>yeaahhhh</p>\r\n', '2018-01-27 14:45:21'),
(50, 45, 'testt', '<p>sfjksjkfjskjfk</p>\r\n', '2018-01-27 14:52:53'),
(51, 45, 'sample ayee', '<p>mantabbbbb broooooo</p>\n', '2018-01-27 14:51:36'),
(52, 45, 'testt', '<p>skfskmfksmkmfms</p>\n', '2018-01-27 14:58:35');

-- --------------------------------------------------------

--
-- Table structure for table `hari`
--

CREATE TABLE `hari` (
  `id_hari` int(11) NOT NULL,
  `nama_hari` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hari`
--

INSERT INTO `hari` (`id_hari`, `nama_hari`) VALUES
(1, 'Senin'),
(2, 'Selasa'),
(3, 'Rabau'),
(4, 'Kamis'),
(5, 'Jumat'),
(6, 'Sabtu'),
(7, 'Minggu');

-- --------------------------------------------------------

--
-- Table structure for table `jammapel`
--

CREATE TABLE `jammapel` (
  `id` int(11) NOT NULL,
  `jam_mulai` varchar(20) NOT NULL,
  `jam_selesai` varchar(20) NOT NULL,
  `hari_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jammapel`
--

INSERT INTO `jammapel` (`id`, `jam_mulai`, `jam_selesai`, `hari_id`, `kelas_id`, `mapel_id`, `guru_id`) VALUES
(1, '00:00', '04:00', 1, 10, 5, 45),
(2, '01:00', '01:00', 2, 10, 6, 45),
(3, '01:00', '02:00', 3, 10, 7, 46),
(4, '01:25', '01:30', 4, 11, 6, 46);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL,
  `jadwal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `jadwal`) VALUES
(10, '1 A', '<p>njjnjnjnjnjnjnj</p>\r\n'),
(11, '2b', '');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id` int(11) NOT NULL,
  `mapel` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id`, `mapel`) VALUES
(5, 'Matematika'),
(6, 'Bahasa Korea'),
(7, 'Bahasa Mandarin');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id` int(11) NOT NULL,
  `file` varchar(300) NOT NULL,
  `id_guru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `file` varchar(300) NOT NULL,
  `id_guru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis_siswa` int(11) NOT NULL,
  `nama_siswa` varchar(225) NOT NULL,
  `password` varchar(300) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_thajaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis_siswa`, `nama_siswa`, `password`, `id_kelas`, `id_thajaran`) VALUES
(21, 1, '1', '$2y$10$rvm/yAixBVgcOJ.KVljce.cZXzHkXxslZsFqzuztxsQEjf0VQAOnW', 1, 1),
(28, 1481, 'davit', '$2y$10$mu/hZ79Fde0inRk8WrnYief6UiLXmwJEvNjN6TkrSWDhARuL1TW6i', 10, 15);

-- --------------------------------------------------------

--
-- Table structure for table `thajaran`
--

CREATE TABLE `thajaran` (
  `id` int(11) NOT NULL,
  `thajaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `thajaran`
--

INSERT INTO `thajaran` (`id`, `thajaran`) VALUES
(15, '2010/13'),
(16, '2018/1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indexes for table `guru_mapel`
--
ALTER TABLE `guru_mapel`
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- Indexes for table `guru_pesan_informasi`
--
ALTER TABLE `guru_pesan_informasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hari`
--
ALTER TABLE `hari`
  ADD PRIMARY KEY (`id_hari`);

--
-- Indexes for table `jammapel`
--
ALTER TABLE `jammapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_guru` (`id_guru`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_guru` (`id_guru`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `nis_siswa` (`nis_siswa`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_thajaran` (`id_thajaran`);

--
-- Indexes for table `thajaran`
--
ALTER TABLE `thajaran`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `guru_pesan_informasi`
--
ALTER TABLE `guru_pesan_informasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `hari`
--
ALTER TABLE `hari`
  MODIFY `id_hari` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `jammapel`
--
ALTER TABLE `jammapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `thajaran`
--
ALTER TABLE `thajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
