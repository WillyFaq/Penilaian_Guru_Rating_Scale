-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.6.26 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for dbpenilaian_kinerja
CREATE DATABASE IF NOT EXISTS `dbpenilaian_kinerja` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `dbpenilaian_kinerja`;

-- Dumping structure for table dbpenilaian_kinerja.data_guru
CREATE TABLE IF NOT EXISTS `data_guru` (
  `nip` varchar(50) NOT NULL,
  `nama_guru` varchar(100) DEFAULT NULL,
  `alamat` text,
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `status_kawin` char(1) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `status_guru` varchar(20) DEFAULT NULL,
  `pendidikan_terakhir` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dbpenilaian_kinerja.data_guru: ~5 rows (approximately)
/*!40000 ALTER TABLE `data_guru` DISABLE KEYS */;
INSERT INTO `data_guru` (`nip`, `nama_guru`, `alamat`, `tgl_lahir`, `jenis_kelamin`, `status_kawin`, `no_telp`, `status_guru`, `pendidikan_terakhir`) VALUES
	('123123123001', 'Achmad Ali Adruino', 'Surabaya', '1989-07-05', 'P', 'K', '088787676565', 'Tetap', 'S3'),
	('199409875', 'Fariz Andi akbar', 'Sidoarjo', '2015-06-17', 'P', 'B', '09876543266', 'Honorer', 'SMA'),
	('9878767656545001', 'Bambang Budi Burhan', 'Surabaya s', '1980-03-21', 'P', 'K', '088787676565', 'Tetap', 'S2'),
	('9878767656545011', 'Surya dua belas', 'surabaya', '1989-02-06', 'P', 'K', '088887876765', 'Tetap', 'S3'),
	('9878767656545012', 'Jamari Sanusi', 'Jombang', '1997-08-23', 'P', 'B', '077676656545', 'Honorer', 'S1');
/*!40000 ALTER TABLE `data_guru` ENABLE KEYS */;

-- Dumping structure for table dbpenilaian_kinerja.detail_penilaian
CREATE TABLE IF NOT EXISTS `detail_penilaian` (
  `id_detail_penilaian` int(11) NOT NULL AUTO_INCREMENT,
  `id_penilaian` char(15) DEFAULT NULL,
  `id_pertanyaan` int(11) DEFAULT NULL,
  `skor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_detail_penilaian`),
  KEY `id_penilaian` (`id_penilaian`),
  KEY `id_pertanyaan` (`id_pertanyaan`),
  CONSTRAINT `FK_detail_penilaian_penilaian` FOREIGN KEY (`id_penilaian`) REFERENCES `penilaian` (`id_penilaian`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_detail_penilaian_pertanyaan` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id_pertanyaan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=348 DEFAULT CHARSET=latin1;

-- Dumping data for table dbpenilaian_kinerja.detail_penilaian: ~108 rows (approximately)
/*!40000 ALTER TABLE `detail_penilaian` DISABLE KEYS */;
INSERT INTO `detail_penilaian` (`id_detail_penilaian`, `id_penilaian`, `id_pertanyaan`, `skor`) VALUES
	(216, 'PN0000000000001', 4, 4),
	(217, 'PN0000000000001', 5, 4),
	(218, 'PN0000000000001', 12, 5),
	(219, 'PN0000000000001', 6, 5),
	(220, 'PN0000000000001', 7, 3),
	(221, 'PN0000000000001', 14, 4),
	(222, 'PN0000000000002', 4, 4),
	(223, 'PN0000000000002', 5, 5),
	(224, 'PN0000000000002', 12, 4),
	(225, 'PN0000000000002', 6, 3),
	(226, 'PN0000000000002', 7, 4),
	(227, 'PN0000000000002', 14, 4),
	(234, 'PN0000000000004', 4, 4),
	(235, 'PN0000000000004', 5, 3),
	(236, 'PN0000000000004', 12, 2),
	(237, 'PN0000000000004', 6, 3),
	(238, 'PN0000000000004', 7, 2),
	(239, 'PN0000000000004', 14, 3),
	(240, 'PN0000000000001', 8, 3),
	(241, 'PN0000000000001', 9, 4),
	(242, 'PN0000000000001', 75, 3),
	(243, 'PN0000000000001', 10, 3),
	(244, 'PN0000000000001', 11, 5),
	(245, 'PN0000000000001', 82, 5),
	(246, 'PN0000000000002', 8, 3),
	(247, 'PN0000000000002', 9, 4),
	(248, 'PN0000000000002', 75, 5),
	(249, 'PN0000000000002', 10, 5),
	(250, 'PN0000000000002', 11, 5),
	(251, 'PN0000000000002', 82, 5),
	(258, 'PN0000000000004', 8, 3),
	(259, 'PN0000000000004', 9, 2),
	(260, 'PN0000000000004', 75, 3),
	(261, 'PN0000000000004', 10, 3),
	(262, 'PN0000000000004', 11, 4),
	(263, 'PN0000000000004', 82, 3),
	(264, 'PN0000000000005', 8, 3),
	(265, 'PN0000000000005', 9, 4),
	(266, 'PN0000000000005', 75, 5),
	(267, 'PN0000000000005', 10, 4),
	(268, 'PN0000000000005', 11, 4),
	(269, 'PN0000000000005', 82, 5),
	(270, 'PN0000000000005', 4, 3),
	(271, 'PN0000000000005', 5, 4),
	(272, 'PN0000000000005', 12, 5),
	(273, 'PN0000000000005', 6, 5),
	(274, 'PN0000000000005', 7, 4),
	(275, 'PN0000000000005', 14, 5),
	(276, 'PN0000000000006', 4, 4),
	(277, 'PN0000000000006', 5, 4),
	(278, 'PN0000000000006', 12, 4),
	(279, 'PN0000000000006', 6, 4),
	(280, 'PN0000000000006', 7, 5),
	(281, 'PN0000000000006', 14, 4),
	(282, 'PN0000000000007', 4, 4),
	(283, 'PN0000000000007', 5, 4),
	(284, 'PN0000000000007', 12, 5),
	(285, 'PN0000000000007', 6, 4),
	(286, 'PN0000000000007', 7, 4),
	(287, 'PN0000000000007', 14, 5),
	(294, 'PN0000000000009', 4, 3),
	(295, 'PN0000000000009', 5, 4),
	(296, 'PN0000000000009', 12, 3),
	(297, 'PN0000000000009', 6, 4),
	(298, 'PN0000000000009', 7, 5),
	(299, 'PN0000000000009', 14, 5),
	(300, 'PN0000000000010', 4, 5),
	(301, 'PN0000000000010', 5, 4),
	(302, 'PN0000000000010', 12, 5),
	(303, 'PN0000000000010', 6, 3),
	(304, 'PN0000000000010', 7, 3),
	(305, 'PN0000000000010', 14, 3),
	(306, 'PN0000000000006', 8, 4),
	(307, 'PN0000000000006', 9, 3),
	(308, 'PN0000000000006', 75, 5),
	(309, 'PN0000000000006', 10, 1),
	(310, 'PN0000000000006', 11, 1),
	(311, 'PN0000000000006', 82, 2),
	(312, 'PN0000000000007', 8, 2),
	(313, 'PN0000000000007', 9, 3),
	(314, 'PN0000000000007', 75, 2),
	(315, 'PN0000000000007', 10, 3),
	(316, 'PN0000000000007', 11, 2),
	(317, 'PN0000000000007', 82, 3),
	(324, 'PN0000000000009', 8, 3),
	(325, 'PN0000000000009', 9, 2),
	(326, 'PN0000000000009', 75, 2),
	(327, 'PN0000000000009', 10, 2),
	(328, 'PN0000000000009', 11, 2),
	(329, 'PN0000000000009', 82, 1),
	(330, 'PN0000000000010', 8, 2),
	(331, 'PN0000000000010', 9, 2),
	(332, 'PN0000000000010', 75, 1),
	(333, 'PN0000000000010', 10, 2),
	(334, 'PN0000000000010', 11, 1),
	(335, 'PN0000000000010', 82, 2),
	(336, 'PN0000000000011', 4, 4),
	(337, 'PN0000000000011', 5, 4),
	(338, 'PN0000000000011', 12, 3),
	(339, 'PN0000000000011', 6, 4),
	(340, 'PN0000000000011', 7, 4),
	(341, 'PN0000000000011', 14, 3),
	(342, 'PN0000000000011', 8, 4),
	(343, 'PN0000000000011', 9, 4),
	(344, 'PN0000000000011', 75, 4),
	(345, 'PN0000000000011', 10, 5),
	(346, 'PN0000000000011', 11, 5),
	(347, 'PN0000000000011', 82, 5);
/*!40000 ALTER TABLE `detail_penilaian` ENABLE KEYS */;

-- Dumping structure for table dbpenilaian_kinerja.kategori_penilaian_kinerja
CREATE TABLE IF NOT EXISTS `kategori_penilaian_kinerja` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) NOT NULL,
  `keterangan` int(11) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table dbpenilaian_kinerja.kategori_penilaian_kinerja: ~4 rows (approximately)
/*!40000 ALTER TABLE `kategori_penilaian_kinerja` DISABLE KEYS */;
INSERT INTO `kategori_penilaian_kinerja` (`id_kategori`, `nama_kategori`, `keterangan`) VALUES
	(1, 'Pedagodik', 1),
	(3, 'Kepribadian', 1),
	(4, 'Sosial', 2),
	(5, 'Profesional', 2);
/*!40000 ALTER TABLE `kategori_penilaian_kinerja` ENABLE KEYS */;

-- Dumping structure for table dbpenilaian_kinerja.pengguna
CREATE TABLE IF NOT EXISTS `pengguna` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `hak_akses` int(11) DEFAULT NULL COMMENT '1 : Kepala Sekolah; 2 : Wakil Kepala Sekolah; 3 : Tata Usaha',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dbpenilaian_kinerja.pengguna: ~3 rows (approximately)
/*!40000 ALTER TABLE `pengguna` DISABLE KEYS */;
INSERT INTO `pengguna` (`username`, `password`, `nama`, `hak_akses`) VALUES
	('achmad', 'achmad', 'Achmad Budiarjo ali', 3),
	('admin', 'admin', 'admin sekali', 0),
	('budi', 'budi', 'Budi Dharmawan', 2),
	('joko', 'joko123', 'Joko Sanusi', 1);
/*!40000 ALTER TABLE `pengguna` ENABLE KEYS */;

-- Dumping structure for table dbpenilaian_kinerja.penilaian
CREATE TABLE IF NOT EXISTS `penilaian` (
  `id_penilaian` char(15) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `skor_absen` double NOT NULL DEFAULT '0',
  `skor_pertanyaan` double NOT NULL DEFAULT '0',
  `total_skor` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_penilaian`),
  KEY `id_periode` (`id_periode`),
  KEY `nip` (`nip`),
  CONSTRAINT `FK_penilaian_data_guru` FOREIGN KEY (`nip`) REFERENCES `data_guru` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_penilaian_periode` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dbpenilaian_kinerja.penilaian: ~8 rows (approximately)
/*!40000 ALTER TABLE `penilaian` DISABLE KEYS */;
INSERT INTO `penilaian` (`id_penilaian`, `id_periode`, `nip`, `skor_absen`, `skor_pertanyaan`, `total_skor`) VALUES
	('PN0000000000001', 1, '123123123001', 120, 3.999975, 73.59999),
	('PN0000000000002', 1, '9878767656545001', 119, 4.25, 73.1),
	('PN0000000000004', 1, '9878767656545011', 120, 2.916675, 73.16667),
	('PN0000000000005', 1, '9878767656545012', 120, 4.25, 73.7),
	('PN0000000000006', 2, '123123123001', 90, 3.41665, 55.36666),
	('PN0000000000007', 2, '9878767656545001', 89, 3.41665, 54.76666),
	('PN0000000000009', 2, '9878767656545011', 80, 3, 49.2),
	('PN0000000000010', 2, '9878767656545012', 90, 2.750025, 55.10001),
	('PN0000000000011', 2, '199409875', 150, 4.08335, 91.63334);
/*!40000 ALTER TABLE `penilaian` ENABLE KEYS */;

-- Dumping structure for table dbpenilaian_kinerja.periode
CREATE TABLE IF NOT EXISTS `periode` (
  `id_periode` int(11) NOT NULL AUTO_INCREMENT,
  `nama_periode` varchar(50) DEFAULT NULL,
  `sts` int(11) DEFAULT '0',
  `batas_waktu` date DEFAULT '0000-00-00',
  PRIMARY KEY (`id_periode`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table dbpenilaian_kinerja.periode: ~2 rows (approximately)
/*!40000 ALTER TABLE `periode` DISABLE KEYS */;
INSERT INTO `periode` (`id_periode`, `nama_periode`, `sts`, `batas_waktu`) VALUES
	(1, '2016-2017 Semester Ganjil', 0, '2017-06-30'),
	(2, '2016-2017 Semester Genap', 1, '2017-12-28'),
	(3, '2017-2018 Semester Ganjil', 0, '2018-06-30');
/*!40000 ALTER TABLE `periode` ENABLE KEYS */;

-- Dumping structure for table dbpenilaian_kinerja.pertanyaan
CREATE TABLE IF NOT EXISTS `pertanyaan` (
  `id_pertanyaan` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) NOT NULL,
  `isi_pernyataan` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_pertanyaan`),
  KEY `id_kategori` (`id_kategori`),
  CONSTRAINT `FK_pertanyaan_kategori_penilaian_kinerja` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_penilaian_kinerja` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;

-- Dumping data for table dbpenilaian_kinerja.pertanyaan: ~14 rows (approximately)
/*!40000 ALTER TABLE `pertanyaan` DISABLE KEYS */;
INSERT INTO `pertanyaan` (`id_pertanyaan`, `id_kategori`, `isi_pernyataan`, `status`) VALUES
	(4, 1, 'Memahami karakteristik peserta didik yang berkaitan dengan aspek fisik, intelektual, sosial-emosional, moral, spiritual, dan latar belakang sosialbudaya..', 0),
	(5, 1, 'Mengidentifikasi potensi peserta didik dalam mata pelajaran yang diampu. ', 0),
	(6, 3, 'Menghargai peserta didik tanpa membedakan keyakinan yang dianut, suku, adat-istiadat, daerah asal, dan gender.', 0),
	(7, 3, 'Bersikap sesuai dengan norma agama yang dianut, hukum dan sosial yang berlaku dalam masyarakat, dan kebudayaan nasional Indonesia yang beragam. ', 0),
	(8, 4, 'Bersikap inklusif dan objektif terhadap peserta didik, teman sejawat dan lingkungan sekitar dalam melaksanakan pembelajaran. ', 0),
	(9, 4, 'Tidak bersikap diskriminatif terhadap peserta didik, teman sejawat, orang tua peserta didik dan lingkungan sekolah karena perbedaan agama, suku, jenis kelamin, latar belakang keluarga, dan status sosial-ekonomi. ', 0),
	(10, 5, 'Memahami standar kompetensi mata pelajaran yang diampu. ', 0),
	(11, 5, 'Memahami kompetensi dasar mata pelajaran yang diampu.', 0),
	(12, 1, 'Mengidentifikasi bekal-ajar awal peserta didik dalam mata pelajaran yang diampu.', 0),
	(14, 3, 'Berperilaku jujur, tegas, dan manusiawi.', 0),
	(75, 4, 'Berkomunikasi dengan teman sejawat dan komunitas ilmiah lainnya secara santun, empatik dan efekti', 0),
	(82, 5, 'Memahami tujuan pembelajaran yang diampu', 0);
/*!40000 ALTER TABLE `pertanyaan` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
