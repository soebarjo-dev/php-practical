-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for perpustakaan
CREATE DATABASE IF NOT EXISTS `perpustakaan` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `perpustakaan`;

-- Dumping structure for table perpustakaan.buku
CREATE TABLE IF NOT EXISTS `buku` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(200) NOT NULL DEFAULT '0',
  `penulis` varchar(100) NOT NULL DEFAULT '0',
  `tahun_terbit` year DEFAULT NULL,
  `jenis_buku` enum('referensi','biasa','unknown') DEFAULT 'unknown',
  `status_buku` enum('tersedia','dipinjam') NOT NULL,
  `tanggal_buat` datetime NOT NULL DEFAULT (now()),
  `tanggal_ubah` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `tanggal_hapus` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='tabel untuk simpan data buku';

-- Dumping data for table perpustakaan.buku: ~3 rows (approximately)
INSERT INTO `buku` (`id`, `judul`, `penulis`, `tahun_terbit`, `jenis_buku`, `status_buku`, `tanggal_buat`, `tanggal_ubah`, `tanggal_hapus`) VALUES
	(9, 'Buku Sejarah', 'Jaya Abadi', '2020', 'biasa', 'tersedia', '2026-02-04 21:16:14', NULL, NULL),
	(10, 'Buku Musik', 'Ahmad Albar', '2022', 'biasa', 'tersedia', '2026-02-04 21:16:30', NULL, NULL),
	(11, 'Buku IPA', 'Ahmad Muthohar', '2009', 'biasa', 'tersedia', '2026-02-04 21:16:51', '2026-02-04 21:19:47', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
