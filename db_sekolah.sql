-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2017 at 03:58 PM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
  `profile` text NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nama`, `nik`, `password`, `profile`, `pesan`) VALUES
(2, '123', '123', '$2y$10$625WFSrKIpW.e74k8rSOBedxuMCDmCd8yJgdPMMF2g.NIZVCc325C', '<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>&nbsp;</p>\r\n', '<p>Guru meminta murid menghormati orang yang lebih tua bukan berarti dia gila hormat. Ada manfaat khusus bagi mereka yang lebih muda jika menghormati orang tua.</p>\r\n\r\n<p>Saat menjadi pegawai, menghormati atasan atau rekan kerja yang lebih tua pasti membuat kita mendapat penghargaan di mata mereka karena dianggap tahu sopan santun. Tapi ingat, menghormati bukan berarti mengiyakan apa saja perkataan mereka.</p>\r\n\r\n<p>Buat wirausaha, menghormati pekerja yang berusia lebih tua juga bagus untuk menunjukkan etika sehingga pekerja lain segan terhadap kita.</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(4, '222', '222', '$2y$10$TEnq3NZXUN86acC7SW8AtO3iN4860onkSOUj27LOK5IXkzbmkdvxO', '<p>222</p>\r\n', '<p>222</p>\r\n'),
(33, '56', '56', '$2y$10$F9HgNCMVB0WpzQTJBpcdDeZTTDmDhbvU8kZsQI2RerL7Z0UXw3DR6', '', ''),
(38, '5', '5', '$2y$10$PTlcJ/jmh1aB5W/NfCyXnu0QNdrQPl6z4fAHeE.rbwrZaQnaxb0SW', '', '');

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
(38, 1),
(38, 2),
(38, 4),
(33, 4);

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
(1, '1 A', '<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>Senin :<br />\r\n			<br />\r\n			-mtk = 08.00</p>\r\n\r\n			<p>-ipa = 09.00</p>\r\n\r\n			<p>-dst</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Selasa</p>\r\n\r\n			<p>-dst</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Rabu</p>\r\n\r\n			<p>-dst</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Kamis</p>\r\n\r\n			<p>-dst</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Jumat</p>\r\n\r\n			<p>-dst</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Sabut</p>\r\n\r\n			<p>-dst</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(3, '1 B', ''),
(4, '1 C', ''),
(5, '1 D', 'jpnn.com, JAKARTA - Kementerian Pendidikan dan Kebudayaan (Kemendikbud) melansir contoh jadwal pelajaran program sekolah lima hari.  Diharapkan dengan contoh jadwal ini, sekolah memiliki gambaran jelas terkait pelaksanaan sekolah lima hari.  Yang menarik dari contoh jadwal pelajaran itu adalah untuk siswa kelas I-III SD. Bagi anak kelas bawah itu, jadwal pelajaran tematik atau kurikuler, berjalan sampai pukul 10.45.  Khusus untuk hari Jumat sampai pukul 11.35. Setelah itu disusul kegiatan ekstra kurikuler sampai anak-anak pulang pukul 15.00.  Nah bagi siswa yang masih kelas I-III kegiatan wajib disekolahnya hanya sampai pukul 13.10 saja. Yakni setelah jam pelajaran tematik, ditambah dua kali jam pelajaran ekstra kurikuler. '),
(6, '2 A', '<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>Senin :<br />\r\n			<br />\r\n			-mtk = 08.00</p>\r\n\r\n			<p>-ipa = 09.00</p>\r\n\r\n			<p>-dst</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Selasa</p>\r\n\r\n			<p>-dst</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Rabu</p>\r\n\r\n			<p>-dst</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Kamis</p>\r\n\r\n			<p>-dst</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Jumat</p>\r\n\r\n			<p>-dst</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Sabut</p>\r\n\r\n			<p>-dst</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n');

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
(1, 'IPA'),
(2, 'IPS'),
(4, 'LALALA LILILI');

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
(22, 45, '45', '$2y$10$UoJKA/bkOyV5k60ltU50N.pI/vIg1h.ZCMzb9.LN6EYHk/0VQIHm6', 4, 1),
(23, 2, '2', '$2y$10$Ci819mOltDlEUYndRu9PGeSw84npLL/IfkEAQhzR/T5bTF/eW7cWG', 5, 2);

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
(1, '2015/2016'),
(2, '2016/2017'),
(3, '2017/2018');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `thajaran`
--
ALTER TABLE `thajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
