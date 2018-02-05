-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 05, 2018 at 05:57 PM
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
  `password` varchar(300) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`) VALUES
(1, '1', '$2y$10$b6JskNdwYq6ekZfQRuh.M.8E2K63fjVe.TF25pKUhQ3HlorFQJgki', ''),
(2, '2', '$2y$10$hIyPyjZ0kuJtbDaACFtOyOi6vwMFYFJajC3kgnft3a0PMomxCoGgi', ''),
(3, '3', '3', '');

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
  `level` enum('guru','admin') NOT NULL,
  `telp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `tgl_lahir` varchar(255) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nama`, `nik`, `password`, `level`, `telp`, `email`, `alamat`, `tgl_lahir`, `jenis_kelamin`, `foto`) VALUES
(45, 'Masbuloh S.pd', '123456', '$2y$10$s2VdHHM2IaygI9Iugb2fN.VzGYwrnkqR/Saa4fuVcRVk6I9GAR/2q', 'admin', '1234567890', 'ahaha@fjshjf.cc', 'Bantul,Yogyakarta. jl srandakan km 01', '20-01-2001', 'P', '0a57f0d4d704ea2d42ce80fdf26b1311.jpg'),
(46, 'paijo', '898999', '$2y$10$j1fIIuJCN1c2CZWLN1TWl.abmE5dHowliiQEJLz1WtD.hwJPHFUoe', 'guru', '57487584785', 'fhsjhf@hjfhsj.cc', 'Pakem Sleman', '20-01-2001', 'L', 'addba1572b4151992a58bfe5b0fc2745.jpg');

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
(45, 3),
(46, 11),
(46, 2);

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
(3, 46, 'KPK Siap Hadapi Sidang Praperadilan Fredrich di PN Jaksel Senin', '\n <b>Jakarta</b> -\n KPK sudah menyiapkan berkas untuk sidang praperadilan yang diajukan Fredrich Yunadi di Pengadilan Negeri Jakarta Selatan. Menurut KPK, penetapan tersangka Fredrich Yunadi atas perkara menghalangi penyidikan Setyo Novanto sudah sesuai prosedur.<br><br>"Jadi ada beberapa hal yang masih perlu dilengkapi lebih lanjut bukti-bukti sebenarnya kita sudah cukup banyak ya. Karena kita sudah firm juga tentang peristiwa 15-16 November (2017 tersebut, namun ada beberapa hal yang masih perlu dipastikan dan agar seluruh berkas kemudian bisa menjadi solid dan buktinya bisa siap dibawa ke persidangan," ujar Kabiro Humas KPK Febri Diansyah di Kantornya, Jalan Kuningan Persada, Jakarta, Selasa (30/1/2018).<br><br>Febri menyakini KPK mempunyai alat bukti penetapan tersangka Fredrich dan dr Bimanesh yang menghalangi proses penyidikan kasus proyek e-KTP. Alat bukti itu diyakini kuat bisa menjerat Fredrich dan Bimanesh. <br><br><!--s:parallaxindetail--><script type="text/javascript"><!--// <![CDATA[\nOA_show(\'parallaxindetail\'); \n// ]]> --></script><div id="beacon_b0fb17c452" style="position: absolute; left: 0px; top: 0px; visibility: hidden;"><img src="https://newrevive.detik.com/delivery/lg.php?bannerid=0&amp;campaignid=0&amp;zoneid=642&amp;loc=https%3A%2F%2Fnews.detik.com%2Fberita%2Fd-3841774%2Fkpk-siap-hadapi-sidang-praperadilan-fredrich-di-pn-jaksel-senin&amp;referer=https%3A%2F%2Fwww.detik.com%2F&amp;cb=b0fb17c452" width="0" height="0" alt="" style="width: 0px; height: 0px;"></div>\n<!--e:parallaxindetail-->"Kami yakin seluruh proses formil yang dilakukan oleh KPK dalam proses penyelidikan dan penyidikan dengan dua tersangka ini Fredrich dan Bimanesh itu kami lakukan secara benar sesuai dengan hukum Acara yang berlaku. Dan substansi hukumnya substansi buktinya juga sangat kuat dugaan bahwa ada perbuatan-perbuatan menghalangi-halangi penanganan kasus e-KTP itu sudah kita miliki buktinya," jelas Febri. <br><br><table class="linksisip"><tbody><tr><td><div class="lihatjg"><strong>Baca juga: </strong><a href="https://news.detik.com/read/2018/01/30/100809/3840432/10/pn-jaksel-jelaskan-soal-praperadilan-fredrich-dipercepat-seminggu" target="_blank" data-label="List Berita" data-action="Berita Pilihan" data-category="Detil Artikel"><span style="color: blue;">PN Jaksel Jelaskan soal Praperadilan Fredrich Dipercepat Seminggu</span></a></div></td></tr></tbody></table><br>Selain itu, KPK sudah menerima surat jadwal praperadilan yang digelar 5 Februari 2018. Surat yang tercantum nomor perkara register perkara nomor 11/Pid.Pra/2018/PN Jkt.Sel. <br><br>"Ada dua surat kami terima register nomer 9 perkara dan nomer 11. Tentu kami terima pertama register nomer 9 agenda tanggal 12 Februari. Baru kemarin kami terima untuk register nomer 11 justru dipercepat tanggal 5 Februari," ucap Febri. <br><br>Pejabat humas PN Jaksel Achmad Guntur sebelumnya menjelaskan majunya jadwal praperadilan itu lantaran sebelumnya pihak Fredrich mencabut gugatan, kemudian mendaftarkannya lagi.<br><br><table class="linksisip"><tbody><tr><td><div class="lihatjg"><strong>Baca juga: </strong><a href="https://news.detik.com/read/2018/01/29/191139/3839738/10/kpk-nilai-majunya-jadwal-sidang-praperadilan-fredrich-janggal" target="_blank" data-label="List Berita" data-action="Berita Pilihan" data-category="Detil Artikel"><span style="color: blue;">KPK Nilai Majunya Jadwal Sidang Praperadilan Fredrich Janggal</span></a></div></td></tr></tbody></table><br>Setelah mencabut gugatannya, Fredrich lalu mendaftarkan kembali dengan nomor perkara register perkara nomor 11/Pid.Pra/2018/PN Jkt.Sel. Achmad mengatakan alamat kuasa hukum Fredrich telah diganti menjadi di wilayah Jakarta Selatan sehingga bisa lebih cepat.<br><br>Hakim yang akan memeriksa dan mengadili perkara tersebut tetap sama yakni hakim tunggal Ratmoho. Sidang tersebut diagendakan digelar 5 Februari dengan agenda pembacaan permohonan gugatan praperadilan. <br><br> \n <br><strong>(fai/idh)</strong>', '2018-01-30 13:39:13'),
(38, 45, 'Lorem ipsum dolor sit amet amet', '\n <b>Jakarta</b> -\n KPK sudah menyiapkan berkas untuk sidang praperadilan yang diajukan Fredrich Yunadi di Pengadilan Negeri Jakarta Selatan. Menurut KPK, penetapan tersangka Fredrich Yunadi atas perkara menghalangi penyidikan Setyo Novanto sudah sesuai prosedur.<br><br>"Jadi ada beberapa hal yang masih perlu dilengkapi lebih lanjut bukti-bukti sebenarnya kita sudah cukup banyak ya. Karena kita sudah firm juga tentang peristiwa 15-16 November (2017 tersebut, namun ada beberapa hal yang masih perlu dipastikan dan agar seluruh berkas kemudian bisa menjadi solid dan buktinya bisa siap dibawa ke persidangan," ujar Kabiro Humas KPK Febri Diansyah di Kantornya, Jalan Kuningan Persada, Jakarta, Selasa (30/1/2018).<br><br>Febri menyakini KPK mempunyai alat bukti penetapan tersangka Fredrich dan dr Bimanesh yang menghalangi proses penyidikan kasus proyek e-KTP. Alat bukti itu diyakini kuat bisa menjerat Fredrich dan Bimanesh. <br><br><!--s:parallaxindetail--><script type="text/javascript"><!--// <![CDATA[\nOA_show(\'parallaxindetail\'); \n// ]]> --></script><div id="beacon_b0fb17c452" style="position: absolute; left: 0px; top: 0px; visibility: hidden;"><img src="https://newrevive.detik.com/delivery/lg.php?bannerid=0&amp;campaignid=0&amp;zoneid=642&amp;loc=https%3A%2F%2Fnews.detik.com%2Fberita%2Fd-3841774%2Fkpk-siap-hadapi-sidang-praperadilan-fredrich-di-pn-jaksel-senin&amp;referer=https%3A%2F%2Fwww.detik.com%2F&amp;cb=b0fb17c452" width="0" height="0" alt="" style="width: 0px; height: 0px;"></div>\n<!--e:parallaxindetail-->"Kami yakin seluruh proses formil yang dilakukan oleh KPK dalam proses penyelidikan dan penyidikan dengan dua tersangka ini Fredrich dan Bimanesh itu kami lakukan secara benar sesuai dengan hukum Acara yang berlaku. Dan substansi hukumnya substansi buktinya juga sangat kuat dugaan bahwa ada perbuatan-perbuatan menghalangi-halangi penanganan kasus e-KTP itu sudah kita miliki buktinya," jelas Febri. <br><br><table class="linksisip"><tbody><tr><td><div class="lihatjg"><strong>Baca juga: </strong><a href="https://news.detik.com/read/2018/01/30/100809/3840432/10/pn-jaksel-jelaskan-soal-praperadilan-fredrich-dipercepat-seminggu" target="_blank" data-label="List Berita" data-action="Berita Pilihan" data-category="Detil Artikel"><span style="color: blue;">PN Jaksel Jelaskan soal Praperadilan Fredrich Dipercepat Seminggu</span></a></div></td></tr></tbody></table><br>Selain itu, KPK sudah menerima surat jadwal praperadilan yang digelar 5 Februari 2018. Surat yang tercantum nomor perkara register perkara nomor 11/Pid.Pra/2018/PN Jkt.Sel. <br><br>"Ada dua surat kami terima register nomer 9 perkara dan nomer 11. Tentu kami terima pertama register nomer 9 agenda tanggal 12 Februari. Baru kemarin kami terima untuk register nomer 11 justru dipercepat tanggal 5 Februari," ucap Febri. <br><br>Pejabat humas PN Jaksel Achmad Guntur sebelumnya menjelaskan majunya jadwal praperadilan itu lantaran sebelumnya pihak Fredrich mencabut gugatan, kemudian mendaftarkannya lagi.<br><br><table class="linksisip"><tbody><tr><td><div class="lihatjg"><strong>Baca juga: </strong><a href="https://news.detik.com/read/2018/01/29/191139/3839738/10/kpk-nilai-majunya-jadwal-sidang-praperadilan-fredrich-janggal" target="_blank" data-label="List Berita" data-action="Berita Pilihan" data-category="Detil Artikel"><span style="color: blue;">KPK Nilai Majunya Jadwal Sidang Praperadilan Fredrich Janggal</span></a></div></td></tr></tbody></table><br>Setelah mencabut gugatannya, Fredrich lalu mendaftarkan kembali dengan nomor perkara register perkara nomor 11/Pid.Pra/2018/PN Jkt.Sel. Achmad mengatakan alamat kuasa hukum Fredrich telah diganti menjadi di wilayah Jakarta Selatan sehingga bisa lebih cepat.<br><br>Hakim yang akan memeriksa dan mengadili perkara tersebut tetap sama yakni hakim tunggal Ratmoho. Sidang tersebut diagendakan digelar 5 Februari dengan agenda pembacaan permohonan gugatan praperadilan. <br><br> \n <br><strong>(fai/idh)</strong>', '2018-01-30 13:39:38'),
(40, 45, 'Lorem Lorem Ipsum Ipsum', '\n <b>Jakarta</b> -\n KPK sudah menyiapkan berkas untuk sidang praperadilan yang diajukan Fredrich Yunadi di Pengadilan Negeri Jakarta Selatan. Menurut KPK, penetapan tersangka Fredrich Yunadi atas perkara menghalangi penyidikan Setyo Novanto sudah sesuai prosedur.<br><br>"Jadi ada beberapa hal yang masih perlu dilengkapi lebih lanjut bukti-bukti sebenarnya kita sudah cukup banyak ya. Karena kita sudah firm juga tentang peristiwa 15-16 November (2017 tersebut, namun ada beberapa hal yang masih perlu dipastikan dan agar seluruh berkas kemudian bisa menjadi solid dan buktinya bisa siap dibawa ke persidangan," ujar Kabiro Humas KPK Febri Diansyah di Kantornya, Jalan Kuningan Persada, Jakarta, Selasa (30/1/2018).<br><br>Febri menyakini KPK mempunyai alat bukti penetapan tersangka Fredrich dan dr Bimanesh yang menghalangi proses penyidikan kasus proyek e-KTP. Alat bukti itu diyakini kuat bisa menjerat Fredrich dan Bimanesh. <br><br><!--s:parallaxindetail--><script type="text/javascript"><!--// <![CDATA[\nOA_show(\'parallaxindetail\'); \n// ]]> --></script><div id="beacon_b0fb17c452" style="position: absolute; left: 0px; top: 0px; visibility: hidden;"><img src="https://newrevive.detik.com/delivery/lg.php?bannerid=0&amp;campaignid=0&amp;zoneid=642&amp;loc=https%3A%2F%2Fnews.detik.com%2Fberita%2Fd-3841774%2Fkpk-siap-hadapi-sidang-praperadilan-fredrich-di-pn-jaksel-senin&amp;referer=https%3A%2F%2Fwww.detik.com%2F&amp;cb=b0fb17c452" width="0" height="0" alt="" style="width: 0px; height: 0px;"></div>\n<!--e:parallaxindetail-->"Kami yakin seluruh proses formil yang dilakukan oleh KPK dalam proses penyelidikan dan penyidikan dengan dua tersangka ini Fredrich dan Bimanesh itu kami lakukan secara benar sesuai dengan hukum Acara yang berlaku. Dan substansi hukumnya substansi buktinya juga sangat kuat dugaan bahwa ada perbuatan-perbuatan menghalangi-halangi penanganan kasus e-KTP itu sudah kita miliki buktinya," jelas Febri. <br><br><table class="linksisip"><tbody><tr><td><div class="lihatjg"><strong>Baca juga: </strong><a href="https://news.detik.com/read/2018/01/30/100809/3840432/10/pn-jaksel-jelaskan-soal-praperadilan-fredrich-dipercepat-seminggu" target="_blank" data-label="List Berita" data-action="Berita Pilihan" data-category="Detil Artikel"><span style="color: blue;">PN Jaksel Jelaskan soal Praperadilan Fredrich Dipercepat Seminggu</span></a></div></td></tr></tbody></table><br>Selain itu, KPK sudah menerima surat jadwal praperadilan yang digelar 5 Februari 2018. Surat yang tercantum nomor perkara register perkara nomor 11/Pid.Pra/2018/PN Jkt.Sel. <br><br>"Ada dua surat kami terima register nomer 9 perkara dan nomer 11. Tentu kami terima pertama register nomer 9 agenda tanggal 12 Februari. Baru kemarin kami terima untuk register nomer 11 justru dipercepat tanggal 5 Februari," ucap Febri. <br><br>Pejabat humas PN Jaksel Achmad Guntur sebelumnya menjelaskan majunya jadwal praperadilan itu lantaran sebelumnya pihak Fredrich mencabut gugatan, kemudian mendaftarkannya lagi.<br><br><table class="linksisip"><tbody><tr><td><div class="lihatjg"><strong>Baca juga: </strong><a href="https://news.detik.com/read/2018/01/29/191139/3839738/10/kpk-nilai-majunya-jadwal-sidang-praperadilan-fredrich-janggal" target="_blank" data-label="List Berita" data-action="Berita Pilihan" data-category="Detil Artikel"><span style="color: blue;">KPK Nilai Majunya Jadwal Sidang Praperadilan Fredrich Janggal</span></a></div></td></tr></tbody></table><br>Setelah mencabut gugatannya, Fredrich lalu mendaftarkan kembali dengan nomor perkara register perkara nomor 11/Pid.Pra/2018/PN Jkt.Sel. Achmad mengatakan alamat kuasa hukum Fredrich telah diganti menjadi di wilayah Jakarta Selatan sehingga bisa lebih cepat.<br><br>Hakim yang akan memeriksa dan mengadili perkara tersebut tetap sama yakni hakim tunggal Ratmoho. Sidang tersebut diagendakan digelar 5 Februari dengan agenda pembacaan permohonan gugatan praperadilan. <br><br> \n <br><strong>(fai/idh)</strong>', '2018-01-30 13:39:48'),
(41, 46, 'Lorem ipsum dolor sit amet yayaya', '<p><strong>Jakarta</strong> - KPK sudah menyiapkan berkas untuk sidang praperadilan yang diajukan Fredrich Yunadi di Pengadilan Negeri Jakarta Selatan. Menurut KPK, penetapan tersangka Fredrich Yunadi atas perkara menghalangi penyidikan Setyo Novanto sudah sesuai prosedur.<br />\r\n<br />\r\n&quot;Jadi ada beberapa hal yang masih perlu dilengkapi lebih lanjut bukti-bukti sebenarnya kita sudah cukup banyak ya. Karena kita sudah firm juga tentang peristiwa 15-16 November (2017 tersebut, namun ada beberapa hal yang masih perlu dipastikan dan agar seluruh berkas kemudian bisa menjadi solid dan buktinya bisa siap dibawa ke persidangan,&quot; ujar Kabiro Humas KPK Febri Diansyah di Kantornya, Jalan Kuningan Persada, Jakarta, Selasa (30/1/2018).<br />\r\n<br />\r\nFebri menyakini KPK mempunyai alat bukti penetapan tersangka Fredrich dan dr Bimanesh yang menghalangi proses penyidikan kasus proyek e-KTP. Alat bukti itu diyakini kuat bisa menjerat Fredrich dan Bimanesh.<br />\r\n<br />\r\n<!--s:parallaxindetail--></p>\r\n\r\n<p><img alt="" src="https://newrevive.detik.com/delivery/lg.php?bannerid=0&amp;campaignid=0&amp;zoneid=642&amp;loc=https%3A%2F%2Fnews.detik.com%2Fberita%2Fd-3841774%2Fkpk-siap-hadapi-sidang-praperadilan-fredrich-di-pn-jaksel-senin&amp;referer=https%3A%2F%2Fwww.detik.com%2F&amp;cb=b0fb17c452" style="height:0px; width:0px" /></p>\r\n\r\n<p><!--e:parallaxindetail--></p>\r\n\r\n<p>&quot;Kami yakin seluruh proses formil yang dilakukan oleh KPK dalam proses penyelidikan dan penyidikan dengan dua tersangka ini Fredrich dan Bimanesh itu kami lakukan secara benar sesuai dengan hukum Acara yang berlaku. Dan substansi hukumnya substansi buktinya juga sangat kuat dugaan bahwa ada perbuatan-perbuatan menghalangi-halangi penanganan kasus e-KTP itu sudah kita miliki buktinya,&quot; jelas Febri.<br />\r\n&nbsp;</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Baca juga: </strong><a href="https://news.detik.com/read/2018/01/30/100809/3840432/10/pn-jaksel-jelaskan-soal-praperadilan-fredrich-dipercepat-seminggu" target="_blank">PN Jaksel Jelaskan soal Praperadilan Fredrich Dipercepat Seminggu</a></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><br />\r\nSelain itu, KPK sudah menerima surat jadwal praperadilan yang digelar 5 Februari 2018. Surat yang tercantum nomor perkara register perkara nomor 11/Pid.Pra/2018/PN Jkt.Sel.<br />\r\n<br />\r\n&quot;Ada dua surat kami terima register nomer 9 perkara dan nomer 11. Tentu kami terima pertama register nomer 9 agenda tanggal 12 Februari. Baru kemarin kami terima untuk register nomer 11 justru dipercepat tanggal 5 Februari,&quot; ucap Febri.<br />\r\n<br />\r\nPejabat humas PN Jaksel Achmad Guntur sebelumnya menjelaskan majunya jadwal praperadilan itu lantaran sebelumnya pihak Fredrich mencabut gugatan, kemudian mendaftarkannya lagi.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Baca juga: </strong><a href="https://news.detik.com/read/2018/01/29/191139/3839738/10/kpk-nilai-majunya-jadwal-sidang-praperadilan-fredrich-janggal" target="_blank">KPK Nilai Majunya Jadwal Sidang Praperadilan Fredrich Janggal</a></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><br />\r\nSetelah mencabut gugatannya, Fredrich lalu mendaftarkan kembali dengan nomor perkara register perkara nomor 11/Pid.Pra/2018/PN Jkt.Sel. Achmad mengatakan alamat kuasa hukum Fredrich telah diganti menjadi di wilayah Jakarta Selatan sehingga bisa lebih cepat.<br />\r\n<br />\r\nHakim yang akan memeriksa dan mengadili perkara tersebut tetap sama yakni hakim tunggal Ratmoho. Sidang tersebut diagendakan digelar 5 Februari dengan agenda pembacaan permohonan gugatan praperadilan.<br />\r\n<br />\r\n<br />\r\n<strong>(fai/idh)</strong></p>\r\n', '2018-01-31 05:34:01');

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
(3, 'Rabu'),
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
(7, '07:00', '08:15', 1, 17, 12, 46),
(8, '08:20', '09:50', 1, 17, 11, 45),
(10, '10:00', '11:00', 1, 17, 10, 46),
(11, '07:00', '09:00', 2, 17, 12, 46),
(13, '10:00', '11:00', 2, 17, 3, 46),
(14, '11:00', '12:00', 2, 17, 2, 46);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(17, '10A'),
(18, '10B'),
(19, '10C');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL,
  `nama_mapel` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `nama_mapel`) VALUES
(1, 'Matematika'),
(2, 'Bahasa Korea'),
(3, 'Bahasa Mandarin'),
(10, 'Bahasa Yunani'),
(11, 'Fisika Terapan'),
(12, 'Statistik');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id_materi` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_tahunajaran` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `nama_materi` varchar(300) DEFAULT NULL,
  `tgl_upload` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `file_materi` varchar(255) DEFAULT NULL,
  `tipe_materi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `file` varchar(300) DEFAULT NULL,
  `id_guru` int(11) NOT NULL,
  `id_tahunajaran` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id_semester` int(11) NOT NULL,
  `semester` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id_semester`, `semester`) VALUES
(1, 'ganjil'),
(2, 'genap');

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
  `id_thajaran` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telp` varchar(255) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` text,
  `tgl_lahir` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis_siswa`, `nama_siswa`, `password`, `id_kelas`, `id_thajaran`, `foto`, `email`, `telp`, `jenis_kelamin`, `alamat`, `tgl_lahir`) VALUES
(39, 123456, 'Welly Anna', '$2y$10$P0hV0iPOI3LSFvhTh/9..O1YY0tvrINUEzZT1EnI99wmkoJ4p2VK2', 17, 39, 'c10f588dd223263d62b39b6d4ee08473.jpg', 'test@mail.cc', '47284782', 'L', 'Pakem,Sleman', '01-01-1990');

-- --------------------------------------------------------

--
-- Table structure for table `tahunajaran`
--

CREATE TABLE `tahunajaran` (
  `id_tahunajaran` int(11) NOT NULL,
  `tahun` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahunajaran`
--

INSERT INTO `tahunajaran` (`id_tahunajaran`, `tahun`) VALUES
(39, '2018/2019');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `guru_id` (`guru_id`);

--
-- Indexes for table `hari`
--
ALTER TABLE `hari`
  ADD PRIMARY KEY (`id_hari`);

--
-- Indexes for table `jammapel`
--
ALTER TABLE `jammapel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hari_id` (`hari_id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `mapel_id` (`mapel_id`),
  ADD KEY `guru_id` (`guru_id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `id_tahunajaran` (`id_tahunajaran`),
  ADD KEY `semester` (`semester`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_guru_2` (`id_guru`),
  ADD KEY `id_mapel_2` (`id_mapel`),
  ADD KEY `id_tahunajaran_2` (`id_tahunajaran`),
  ADD KEY `id_tahunajaran_3` (`id_tahunajaran`),
  ADD KEY `id_kelas_2` (`id_kelas`),
  ADD KEY `id_kelas_3` (`id_kelas`),
  ADD KEY `semester_2` (`semester`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_tahunajaran` (`id_tahunajaran`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `semester` (`semester`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_guru_2` (`id_guru`),
  ADD KEY `semester_2` (`semester`),
  ADD KEY `id_kelas_2` (`id_kelas`),
  ADD KEY `id_kelas_3` (`id_kelas`),
  ADD KEY `id_mapel_2` (`id_mapel`),
  ADD KEY `id_tahunajaran_2` (`id_tahunajaran`),
  ADD KEY `id_guru_3` (`id_guru`),
  ADD KEY `id_mapel_3` (`id_mapel`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id_semester`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `nis_siswa` (`nis_siswa`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_thajaran` (`id_thajaran`);

--
-- Indexes for table `tahunajaran`
--
ALTER TABLE `tahunajaran`
  ADD PRIMARY KEY (`id_tahunajaran`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `hari`
--
ALTER TABLE `hari`
  MODIFY `id_hari` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `jammapel`
--
ALTER TABLE `jammapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id_semester` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `tahunajaran`
--
ALTER TABLE `tahunajaran`
  MODIFY `id_tahunajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `guru_mapel`
--
ALTER TABLE `guru_mapel`
  ADD CONSTRAINT `guru_mapel_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `guru_mapel_ibfk_2` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`) ON DELETE CASCADE;

--
-- Constraints for table `guru_pesan_informasi`
--
ALTER TABLE `guru_pesan_informasi`
  ADD CONSTRAINT `guru_pesan_informasi_ibfk_1` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jammapel`
--
ALTER TABLE `jammapel`
  ADD CONSTRAINT `jammapel_ibfk_1` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jammapel_ibfk_2` FOREIGN KEY (`mapel_id`) REFERENCES `mapel` (`id_mapel`) ON DELETE CASCADE,
  ADD CONSTRAINT `jammapel_ibfk_3` FOREIGN KEY (`hari_id`) REFERENCES `hari` (`id_hari`) ON DELETE CASCADE,
  ADD CONSTRAINT `jammapel_ibfk_4` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE;

--
-- Constraints for table `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `materi_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `materi_ibfk_2` FOREIGN KEY (`id_tahunajaran`) REFERENCES `tahunajaran` (`id_tahunajaran`) ON DELETE CASCADE,
  ADD CONSTRAINT `materi_ibfk_3` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`) ON DELETE CASCADE,
  ADD CONSTRAINT `materi_ibfk_4` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE,
  ADD CONSTRAINT `materi_ibfk_5` FOREIGN KEY (`semester`) REFERENCES `semester` (`id_semester`) ON DELETE CASCADE;

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`id_tahunajaran`) REFERENCES `tahunajaran` (`id_tahunajaran`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_3` FOREIGN KEY (`semester`) REFERENCES `semester` (`id_semester`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_4` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_5` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_thajaran`) REFERENCES `tahunajaran` (`id_tahunajaran`) ON DELETE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
