-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_ukk_soleh
CREATE DATABASE IF NOT EXISTS `db_ukk_soleh` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_ukk_soleh`;

-- Dumping structure for table db_ukk_soleh.anggota_jurnal
CREATE TABLE IF NOT EXISTS `anggota_jurnal` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_siswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nipd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_ukk_soleh.anggota_jurnal: ~37 rows (approximately)
/*!40000 ALTER TABLE `anggota_jurnal` DISABLE KEYS */;
INSERT INTO `anggota_jurnal` (`id`, `nama_siswa`, `nipd`, `kelas`, `jurusan`, `created_at`, `updated_at`) VALUES
	(1, 'Melvin Olivia', '242510046', 'X', 'BIDI 1', '2026-04-03 10:29:12', '2026-04-03 10:29:13'),
	(2, 'Reni Anggraeni', '242510047', 'X', 'BIDI 1', '2026-04-03 10:29:14', '2026-04-03 10:29:15'),
	(3, 'Dita Nofita Syahrani', '242510048', 'X', 'BIDI 2', '2026-04-03 10:29:16', '2026-04-03 10:29:17'),
	(4, 'Puspita Sari', '242510049', 'X', 'BIDI 2', '2026-04-03 10:29:17', '2026-04-03 10:29:18'),
	(5, 'MUHAMMAD FAREL ANDRIANI', '242510050', 'X', 'BIDI3', '2026-04-03 10:29:19', '2026-04-03 10:29:19'),
	(6, 'Sonia Alifia', '242510051', 'X', 'RPL', '2026-04-03 10:29:21', '2026-04-03 10:29:22'),
	(7, 'Naurelia Azzahra Rahmadhani', '242510052', 'X', 'RPL', '2026-04-03 10:29:23', '2026-04-03 10:29:24'),
	(8, 'Karina Dwi Astuti', '242510053', 'X', 'TKJ 1', '2026-04-03 10:29:25', '2026-04-03 10:29:25'),
	(9, 'Novita Damayanti', '242510054', 'X', 'TKJ 1', '2026-04-03 10:29:26', '2026-04-03 10:29:27'),
	(10, 'Mutia Putri Ramdania', '242510055', 'X', 'TKJ 2', '2026-04-03 10:29:28', '2026-04-03 10:29:29'),
	(11, 'Derrick Delvydi', '242510056', 'X', 'TKJ 2', '2026-04-03 10:29:29', '2026-04-03 10:29:30'),
	(12, 'Alya Khadijah', '242510057', 'X', 'DKV', '2026-04-03 10:29:31', '2026-04-03 10:29:31'),
	(13, 'Felicyna Aprilie Susanto Lie', '242510058', 'X', 'DKV', '2026-04-03 10:29:32', '2026-04-03 10:29:33'),
	(14, 'Muhammad Ihwan Utomo', '242510059', 'XI', 'BIDI 1', '2026-04-03 10:29:34', '2026-04-03 10:30:01'),
	(15, 'RAMADHAN AGIL SIRAJ', '242510060', 'XI', 'BIDI 1', '2026-04-03 10:29:35', '2026-04-03 10:30:02'),
	(16, 'Lusi cahyati', '242510061', 'XI', 'BIDI 2', '2026-04-03 10:29:36', '2026-04-03 10:30:03'),
	(17, 'risma', '242510062', 'XI', 'BIDI 2', '2026-04-03 10:29:37', '2026-04-03 10:30:03'),
	(18, 'MOCH AL IMRAN HARDIYATNA', '242510063', 'XI', 'BIDI 3', '2026-04-03 10:29:39', '2026-04-03 10:30:04'),
	(19, 'Najwa Juliani', '242510064', 'XI', 'BIDI 3', '2026-04-03 10:29:40', '2026-04-03 10:30:05'),
	(20, 'Soma Winata', '242510065', 'XI', 'RPL', '2026-04-03 10:29:41', '2026-04-03 10:30:06'),
	(21, 'fizzi Ahmad rajib', '242510066', 'XI', 'RPL', '2026-04-03 10:29:42', '2026-04-03 10:30:07'),
	(22, 'zulaikha muharam', '242510067', 'XI', 'RPL', '2026-04-03 10:29:43', '2026-04-03 10:30:07'),
	(23, 'Gusti permas A.r', '242510068', 'XI', 'TKJ 1', '2026-04-03 10:29:45', '2026-04-03 10:30:08'),
	(24, 'Sukses mulya saputra', '242510069', 'XI', 'TKJ 1', '2026-04-03 10:29:46', '2026-04-03 10:30:10'),
	(25, 'Muhamad Iqbal', '242510072', 'XI', 'TKJ 1', '2026-04-03 10:29:46', '2026-04-03 10:30:11'),
	(26, 'Wulan Apriliani', '242510071', 'XI', 'TKJ 2', '2026-04-03 10:29:47', '2026-04-03 10:30:12'),
	(27, 'Kezia Manuel Pratama', '242510072', 'XI', 'TKJ 2', '2026-04-03 10:29:48', '2026-04-03 10:30:13'),
	(28, 'MILLATU AKMALIA', '242510073', 'XI', 'TKJ 2', '2026-04-03 10:29:49', '2026-04-03 10:30:14'),
	(29, 'JASMINE SHALSABILLA', '242510074', 'XI', 'DKV', '2026-04-03 10:29:51', '2026-04-03 10:30:15'),
	(30, 'Berliana Cahya dewi', '242510075', 'XI', 'DKV', '2026-04-03 10:29:52', '2026-04-03 10:30:16'),
	(31, 'Sabria Widi Mulia', '242510076', 'XI', 'DKV', '2026-04-03 10:29:53', '2026-04-03 10:30:17'),
	(32, 'tasyah utama dewi', '242510077', 'XI', 'DKV', '2026-04-03 10:29:53', '2026-04-03 10:30:18'),
	(33, 'Risma aulia salsabila', '242510078', 'XI', 'RPL', '2026-04-03 10:29:56', '2026-04-03 10:30:19'),
	(34, 'Beryl Adrienne widayat', '242510079', 'XI', 'RPL', '2026-04-03 10:29:57', '2026-04-03 10:30:19'),
	(35, 'Shereen Naurah salsabila', '242510080', 'XI', 'BIDI 1', '2026-04-03 10:29:57', '2026-04-03 10:30:20'),
	(36, 'NIA FIRNITA BUNGA JELITA', '242510081', 'XI', 'BIDI 2', '2026-04-03 10:29:58', '2026-04-03 10:30:21'),
	(37, 'Manda Stela fauzia', '242510082', 'XI', 'BIDI 3', '2026-04-03 10:29:59', '2026-04-03 10:30:22');
/*!40000 ALTER TABLE `anggota_jurnal` ENABLE KEYS */;

-- Dumping structure for table db_ukk_soleh.anggota_marchingband
CREATE TABLE IF NOT EXISTS `anggota_marchingband` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_siswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nipd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_ukk_soleh.anggota_marchingband: ~17 rows (approximately)
/*!40000 ALTER TABLE `anggota_marchingband` DISABLE KEYS */;
INSERT INTO `anggota_marchingband` (`id`, `nama_siswa`, `nipd`, `kelas`, `jurusan`, `created_at`, `updated_at`) VALUES
	(3, 'fadilla nur azizah', '242510169', 'X', 'BIDI 1', '2026-04-01 12:06:00', '2026-04-01 12:06:01'),
	(4, 'DHEA AMELIA', '242510170', 'X', 'BIDI1', '2026-04-01 12:06:02', '2026-04-01 12:06:03'),
	(5, 'Nurhayati', '242510171', 'X', 'BIDI 2', '2026-04-01 12:06:04', '2026-04-01 12:06:05'),
	(6, 'Resti Alilah', '242510172', 'X', 'BIDI 3', '2026-04-01 12:06:07', '2026-04-01 12:06:05'),
	(7, 'eka putri agustin', '242510173', 'X', 'RPL', '2026-04-01 12:06:08', '2026-04-01 12:06:06'),
	(8, 'ADHWAA ALYAA SYAFAA', '242510174', 'X', 'DKV', '2026-04-01 12:06:09', '2026-04-01 12:06:07'),
	(9, 'SYIFA NUR AINI', '242510175', 'X', 'TKJ 1', '2026-04-01 12:06:10', '2026-04-01 12:06:16'),
	(10, 'Raisya Choirunnisa', '242510176', 'X', 'TKJ 2', '2026-04-01 12:06:10', '2026-04-01 12:06:17'),
	(11, 'Citra mustika', '242510177', 'XI', 'RPL', '2026-04-01 12:06:11', '2026-04-01 12:06:17'),
	(12, 'Aprilia Tri Anjani', '242510178', 'XI', 'DKV', '2026-04-01 12:06:12', '2026-04-01 12:06:18'),
	(13, 'dhemalia permana', '242510179', 'XI', 'TKJ 1', '2026-04-01 12:06:12', '2026-04-01 12:06:19'),
	(14, 'SHINTA NURCAHYATI JUWITA', '242510180', 'XI', 'TKJ 2', '2026-04-01 12:06:13', '2026-04-01 12:06:19'),
	(15, 'Tita Aurelia Candra', '242510181', 'XI', 'BIDI 1', '2026-04-01 12:06:14', '2026-04-01 12:06:20'),
	(16, 'Ghaishani najwa alifah', '242510182', 'XI', 'BIDI 2', '2026-04-01 12:06:15', '2026-04-01 12:06:21'),
	(17, 'Rasti Rumi Yanto', '242510183', 'XI', 'BIDI 3', '2026-04-01 12:06:15', '2026-04-01 12:06:22');
/*!40000 ALTER TABLE `anggota_marchingband` ENABLE KEYS */;

-- Dumping structure for table db_ukk_soleh.anggota_natbinari
CREATE TABLE IF NOT EXISTS `anggota_natbinari` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_siswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nipd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_ukk_soleh.anggota_natbinari: ~18 rows (approximately)
/*!40000 ALTER TABLE `anggota_natbinari` DISABLE KEYS */;
INSERT INTO `anggota_natbinari` (`id`, `nama_siswa`, `nipd`, `kelas`, `jurusan`, `created_at`, `updated_at`) VALUES
	(3, 'PUTRA KASELA', '242510083', 'X', 'BIDI 1', '2026-04-01 12:15:45', '2026-04-01 12:15:46'),
	(4, 'Zaskia ayu putri', '242510084', 'X', 'BIDI1', '2026-04-01 12:15:47', '2026-04-01 12:15:47'),
	(5, 'Muhamad Mujopar', '242510085', 'X', 'BIDI 2', '2026-04-01 12:15:48', '2026-04-01 12:15:49'),
	(6, 'Nurlita', '242510086', 'X', 'BIDI 3', '2026-04-01 12:15:51', '2026-04-01 12:15:50'),
	(7, 'dira oktavia', '242510087', 'X', 'RPL', '2026-04-01 12:15:51', '2026-04-01 12:15:52'),
	(8, 'Robiyatun Nisa', '242510088', 'X', 'DKV', '2026-04-01 12:15:53', '2026-04-01 12:15:52'),
	(9, 'TASYA FIRMANSYAH', '242510089', 'X', 'TKJ 1', '2026-04-01 12:15:54', '2026-04-01 12:16:02'),
	(10, 'Diana', '242510090', 'X', 'TKJ 2', '2026-04-01 12:15:54', '2026-04-01 12:16:03'),
	(11, 'Ulan Nainda Suci Diani', '242510091', 'XI', 'RPL', '2026-04-01 12:15:55', '2026-04-01 12:16:04'),
	(12, 'syaira lailatul jihan', '242510092', 'XI', 'DKV', '2026-04-01 12:15:56', '2026-04-01 12:16:04'),
	(13, 'ARFINA FEBRIANTIKA', '242510093', 'XI', 'TKJ 1', '2026-04-01 12:15:57', '2026-04-01 12:16:05'),
	(14, 'Nursaila', '242510094', 'XI', 'TKJ 2', '2026-04-01 12:15:57', '2026-04-01 12:16:06'),
	(15, 'SINTA', '242510095', 'XI', 'BIDI 1', '2026-04-01 12:15:58', '2026-04-01 12:16:06'),
	(16, 'FIKRI AKBAR MAULANA', '242510096', 'XI', 'BIDI 2', '2026-04-01 12:15:59', '2026-04-01 12:16:07'),
	(17, 'farel apandi', '242510097', 'XI', 'BIDI 3', '2026-04-01 12:16:00', '2026-04-01 12:16:08'),
	(18, 'VILLYAL ARDAIRO', '242510098', 'XI', 'RPL', '2026-04-01 12:16:00', '2026-04-01 12:16:09'),
	(19, 'Raisya Choirunnisa', '242510099', 'XI', 'RPL', '2026-04-01 12:16:01', '2026-04-01 12:16:11'),
	(20, 'rijal zumalin Karim', '242510100', 'XI', 'TKJ 1', '2026-04-01 12:16:01', '2026-04-01 12:16:11');
/*!40000 ALTER TABLE `anggota_natbinari` ENABLE KEYS */;

-- Dumping structure for table db_ukk_soleh.anggota_paskibra
CREATE TABLE IF NOT EXISTS `anggota_paskibra` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_siswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nipd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_ukk_soleh.anggota_paskibra: ~38 rows (approximately)
/*!40000 ALTER TABLE `anggota_paskibra` DISABLE KEYS */;
INSERT INTO `anggota_paskibra` (`id`, `nama_siswa`, `nipd`, `kelas`, `jurusan`, `created_at`, `updated_at`) VALUES
	(3, 'MOCHAMMAD IRFAN ARDIANSYAH', '242510000', 'X', 'BIDI 1', '2026-04-01 13:04:59', '2026-04-01 13:05:00'),
	(4, 'MOCHAMMAD IRFAN ARDIANSYAH', '242510001', 'X', 'BIDI 2', '2026-04-01 13:05:01', '2026-04-01 13:05:02'),
	(5, 'Muhammad Dafi Nur Awali', '242510002', 'X', 'BIDI 3', '2026-04-01 13:05:05', '2026-04-01 13:05:03'),
	(6, 'FIKRI BAYHAQI', '242510003', 'X', 'BIDI 1', '2026-04-01 13:05:06', '2026-04-01 13:05:41'),
	(7, 'RIDHO NURUL FAIZIN', '242510004', 'X', 'BIDI 2', '2026-04-01 13:05:07', '2026-04-01 13:05:42'),
	(8, 'Marchel Hugo Putra Ramadhan', '242510005', 'X', 'BIDI 3', '2026-04-01 13:05:08', '2026-04-01 13:05:43'),
	(9, 'varent ninna nafisya', '242510006', 'X', 'RPL', '2026-04-01 13:05:08', '2026-04-01 13:05:44'),
	(10, 'Muhammad Faiz ramadhan', '242510007', 'X', 'RPL', '2026-04-01 13:05:10', '2026-04-01 13:05:45'),
	(11, 'Reyvan Darmawan', '242510008', 'X', 'TKJ 1', '2026-04-01 13:05:09', '2026-04-01 13:05:46'),
	(12, 'Edward Raya Fadillah', '242510009', 'X', 'TKJ 2', '2026-04-01 13:05:11', '2026-04-01 13:05:47'),
	(13, 'M.FAHRY TRI GUNAWAN', '242510010', 'X', 'DKV', '2026-04-01 13:05:12', '2026-04-01 13:05:48'),
	(14, 'akmal', '242510011', 'X', 'DKV', '2026-04-01 13:05:13', '2026-04-01 13:05:49'),
	(15, 'HAFIZH KURNIAWAN', '242510012', 'XI', 'RPL', '2026-04-01 13:05:13', '2026-04-01 13:05:50'),
	(16, 'MUHAMMAD FAHRI ALMANSYAH', '242510013', 'XI', 'RPL', '2026-04-01 13:05:14', '2026-04-01 13:05:51'),
	(17, 'Rizky', '242510014', 'XI', 'RPL', '2026-04-01 13:05:15', '2026-04-01 13:05:52'),
	(18, 'KHOIRUL SIDIQ', '242510015', 'XI', 'TKJ 1', '2026-04-01 13:05:15', '2026-04-01 13:05:53'),
	(19, 'Nurhadi', '242510016', 'XI', 'TKJ 1', '2026-04-01 13:05:18', '2026-04-01 13:05:55'),
	(20, 'Fikri Bayhaqi', '242510017', 'XI', 'TKJ 2', '2026-04-01 13:05:19', '2026-04-01 13:05:56'),
	(21, 'Lukman nul hakim', '242510018', 'XI', 'TKJ 2', '2026-04-01 13:05:19', '2026-04-01 13:05:56'),
	(22, 'RIRIN DWI LESTARI', '242510019', 'XI', 'DKV', '2026-04-01 13:05:20', '2026-04-01 13:05:57'),
	(23, 'Bagas Ardy Nugroho', '242510020', 'XI', 'DKV', '2026-04-01 13:05:21', '2026-04-01 13:05:58'),
	(24, 'jesica', '242510021', 'XI', 'RPL', '2026-04-01 13:05:22', '2026-04-01 13:06:00'),
	(25, 'khansa febriah utami', '242510022', 'XI', 'DKV', '2026-04-01 13:05:23', '2026-04-01 13:06:01'),
	(26, 'Aryo Tri Panjalu', '242510023', 'XI', 'TKJ 1', '2026-04-01 13:05:24', '2026-04-01 13:06:02'),
	(27, 'Bayu riffiansyah sukardi', '242510024', 'XI', 'TKJ 2', '2026-04-01 13:05:25', '2026-04-01 13:06:05'),
	(28, 'fiqih Al Farizi', '242510025', 'XI', 'TKJ 1', '2026-04-01 13:05:26', '2026-04-01 13:06:05'),
	(29, 'ARFAN MAULANA', '242510026', 'XI', 'TKJ 2', '2026-04-01 13:05:26', '2026-04-01 13:06:06'),
	(30, 'THRESIA TIARA AULIA PUTRI', '242510027', 'XI', 'DKV', '2026-04-01 13:05:30', '2026-04-01 13:06:07'),
	(31, 'MUSTOPA', '242510028', 'XI', 'DKV', '2026-04-01 13:05:30', '2026-04-01 13:06:08'),
	(32, 'nibras ibnu nauval', '242510029', 'XI', 'BIDI 1', '2026-04-01 13:05:31', '2026-04-01 13:06:09'),
	(33, 'HAMAMI', '242510030', 'XI', 'BIDI 1', '2026-04-01 13:05:32', '2026-04-01 13:06:11'),
	(34, 'Fatir Muhammad', '242510031', 'XI', 'BIDI 2', '2026-04-01 13:05:32', '2026-04-01 13:06:12'),
	(35, 'jonathan martua simbolon', '242510032', 'XI', 'BIDI 3', '2026-04-01 13:05:33', '2026-04-01 13:06:13'),
	(36, 'Arya Aditya Naufal', '242510033', 'XI', 'BIDI 3', '2026-04-01 13:05:34', '2026-04-01 13:06:14'),
	(37, 'nira azahra', '242510034', 'XI', 'BIDI 2', '2026-04-01 13:05:36', '2026-04-01 13:06:16'),
	(38, 'NABILA', '242510035', 'XI', 'BIDI 2', '2026-04-01 13:05:37', '2026-04-01 13:06:16'),
	(39, 'Anisa Nurbaiti Sakinah', '242510036', 'XI', 'BIDI 1', '2026-04-01 13:05:38', '2026-04-01 13:06:17'),
	(40, 'Dylan Akilah Iswahyudhi', '242510037', 'XI', 'BIDI 3', '2026-04-01 13:05:38', '2026-04-01 13:06:18');
/*!40000 ALTER TABLE `anggota_paskibra` ENABLE KEYS */;

-- Dumping structure for table db_ukk_soleh.anggota_pmr
CREATE TABLE IF NOT EXISTS `anggota_pmr` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_siswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nipd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_ukk_soleh.anggota_pmr: ~16 rows (approximately)
/*!40000 ALTER TABLE `anggota_pmr` DISABLE KEYS */;
INSERT INTO `anggota_pmr` (`id`, `nama_siswa`, `nipd`, `kelas`, `jurusan`, `created_at`, `updated_at`) VALUES
	(3, 'Rolita wintarsih', '242510028', 'X', 'RPL', '2026-04-01 13:19:24', '2026-04-01 13:19:25'),
	(4, 'Laila Seftya Rahayu', '242510029', 'X', 'BIDI 1', '2026-04-01 13:19:26', '2026-04-01 13:19:26'),
	(5, 'jesi aulia a', '242510030', 'X', 'BIDI 2', '2026-04-01 13:19:27', '2026-04-01 13:19:28'),
	(6, 'NAYSILA INSANI', '242510031', 'X', 'TKJ 1', '2026-04-01 13:19:29', '2026-04-01 13:19:29'),
	(7, 'nazwa zahra aulia', '242510032', 'X', 'TKJ 2', '2026-04-01 13:19:30', '2026-04-01 13:19:31'),
	(8, 'Amelia Putri', '242510033', 'X', 'DKV', '2026-04-01 13:19:32', '2026-04-01 13:19:33'),
	(9, 'anis', '242510034', 'X', 'DKV', '2026-04-01 13:19:33', '2026-04-01 13:19:34'),
	(10, 'Nazwa Safitri', '242510035', 'XI', 'RPL', '2026-04-01 13:19:35', '2026-04-01 13:19:36'),
	(11, 'Dara Nur Syafitri', '242510036', 'XI', 'RPL', '2026-04-01 13:19:36', '2026-04-01 13:19:37'),
	(12, 'Amelia Putri', '242510037', 'XI', 'DKV', '2026-04-01 13:19:38', '2026-04-01 13:19:39'),
	(13, 'Robiatul Kamila', '242510038', 'XI', 'DKV', '2026-04-01 13:19:39', '2026-04-01 13:19:40'),
	(14, 'Junia Khairunnisya', '242510039', 'XI', 'BIDI 1', '2026-04-01 13:19:41', '2026-04-01 13:19:42'),
	(15, 'sitinurlita', '242510040', 'XI', 'BIDI 3', '2026-04-01 13:19:43', '2026-04-01 13:19:44'),
	(16, 'safira cahya kirana', '242510041', 'XI', 'TKJ 1', '2026-04-01 13:19:44', '2026-04-01 13:19:45'),
	(17, 'safira cahya kirana', '242510042', 'XI', 'TKJ 2', '2026-04-01 13:19:46', '2026-04-01 13:19:47'),
	(18, 'Nasya Ayudia Nugroho', '242510043', 'XI', 'TKJ 1', '2026-04-01 13:19:47', '2026-04-01 13:19:48');
/*!40000 ALTER TABLE `anggota_pmr` ENABLE KEYS */;

-- Dumping structure for table db_ukk_soleh.anggota_pramuka
CREATE TABLE IF NOT EXISTS `anggota_pramuka` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_siswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nipd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_ukk_soleh.anggota_pramuka: ~21 rows (approximately)
/*!40000 ALTER TABLE `anggota_pramuka` DISABLE KEYS */;
INSERT INTO `anggota_pramuka` (`id`, `nama_siswa`, `nipd`, `kelas`, `jurusan`, `created_at`, `updated_at`) VALUES
	(3, 'Aliffia Rafifah Indrani', '242510149', 'X', 'BIDI 1', NULL, NULL),
	(4, 'BUDI HARIANTO', '242510150', 'X', 'BIDI 2', NULL, NULL),
	(5, 'Safa Putri Kirana', '242510151', 'X', 'BIDI 1', NULL, NULL),
	(6, 'BAGAS KHAIDAR NURALIMIN', '242510152', 'X', 'BIDI 2', NULL, NULL),
	(7, 'Ratu Haerunnisa', '242510153', 'X', 'RPL', NULL, NULL),
	(8, 'BELA SILVIA SARI', '242510154', 'X', 'DKV', NULL, NULL),
	(9, 'Alip pirdaus', '242510155', 'X', 'TKJ 1', NULL, NULL),
	(10, 'Qushay abdilah', '242510156', 'X', 'TKJ 2', NULL, NULL),
	(11, 'Imam Ahmad Rosyidin', '242510157', 'X', 'TKJ 1', NULL, NULL),
	(12, 'Jahra', '242510158', 'X', 'RPL', NULL, NULL),
	(13, 'MUHAMMAD MOMO AL ALIF', '242510159', 'XI', 'DKV', NULL, NULL),
	(14, 'inka shilpia', '242510160', 'XI', 'DKV', NULL, NULL),
	(15, 'ROSA ANGGRAENI', '242510161', 'XI', 'RPL', NULL, NULL),
	(16, 'ajeng safahatul', '242510162', 'XI', 'TKJ 1', NULL, NULL),
	(17, 'RIANTI NURISWAYNI', '242510163', 'XI', 'TKJ 2', NULL, NULL),
	(18, 'NIKEN AYU', '242510164', 'XI', 'BIDI 1', NULL, NULL),
	(19, 'HELGA FAUSTINA SANJAYA', '242510165', 'XI', 'BIDI 2', NULL, NULL),
	(20, 'MAULANA YUSUF ARDIANSYAH', '242510166', 'XI', 'RPL', NULL, NULL),
	(21, 'Muhammad Ridho faizumillah', '242510167', 'XI', 'BIDI 1', NULL, NULL),
	(22, 'M. Ridho solihin', '242510168', 'XI', 'BIDI 2', NULL, NULL),
	(23, 'SITI LAELA SARI', '242510169', 'XI', 'TKJ 1', NULL, NULL);
/*!40000 ALTER TABLE `anggota_pramuka` ENABLE KEYS */;

-- Dumping structure for table db_ukk_soleh.contacts
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pesan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_ukk_soleh.contacts: ~0 rows (approximately)
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;

-- Dumping structure for table db_ukk_soleh.eskul
CREATE TABLE IF NOT EXISTS `eskul` (
  `id_eskul` int(11) NOT NULL AUTO_INCREMENT,
  `nama_eskul` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_eskul`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table db_ukk_soleh.eskul: ~6 rows (approximately)
/*!40000 ALTER TABLE `eskul` DISABLE KEYS */;
INSERT INTO `eskul` (`id_eskul`, `nama_eskul`) VALUES
	(1, 'jurnal'),
	(2, 'marchingband'),
	(3, 'natbinari'),
	(4, 'paskibra'),
	(5, 'pmr'),
	(6, 'pramuka');
/*!40000 ALTER TABLE `eskul` ENABLE KEYS */;

-- Dumping structure for table db_ukk_soleh.pembina
CREATE TABLE IF NOT EXISTS `pembina` (
  `id_pembina` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pembina` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `no_telp` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_pembina`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table db_ukk_soleh.pembina: ~5 rows (approximately)
/*!40000 ALTER TABLE `pembina` DISABLE KEYS */;
INSERT INTO `pembina` (`id_pembina`, `nama_pembina`, `email`, `no_telp`, `alamat`) VALUES
	(1, 'dono', 'dono@gmail.com', '0857898662', 'perum'),
	(2, 'komar', 'komar@gmail.com', '0838916651', 'jakarta'),
	(3, 'ade cucu mulyana', 'ade@gmail.com', '0867177156', 'cicalung'),
	(4, 'haerudin', 'heru@gmail.com', '08128718121', 'cilejet'),
	(5, 'reza nugraha', 'reza@gmail.com', '086991961671', 'ciparay'),
	(6, 'acang', 'acang@gmail.com', '08767851235', 'kabasiran');
/*!40000 ALTER TABLE `pembina` ENABLE KEYS */;

-- Dumping structure for table db_ukk_soleh.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_ukk_soleh.personal_access_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table db_ukk_soleh.rekap_jurnal
CREATE TABLE IF NOT EXISTS `rekap_jurnal` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_siswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nipd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eskul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_ukk_soleh.rekap_jurnal: ~0 rows (approximately)
/*!40000 ALTER TABLE `rekap_jurnal` DISABLE KEYS */;
/*!40000 ALTER TABLE `rekap_jurnal` ENABLE KEYS */;

-- Dumping structure for table db_ukk_soleh.rekap_marchingband
CREATE TABLE IF NOT EXISTS `rekap_marchingband` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_siswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nipd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `predikat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_ukk_soleh.rekap_marchingband: ~0 rows (approximately)
/*!40000 ALTER TABLE `rekap_marchingband` DISABLE KEYS */;
/*!40000 ALTER TABLE `rekap_marchingband` ENABLE KEYS */;

-- Dumping structure for table db_ukk_soleh.rekap_natbinari
CREATE TABLE IF NOT EXISTS `rekap_natbinari` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_siswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nipd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `predikat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_ukk_soleh.rekap_natbinari: ~0 rows (approximately)
/*!40000 ALTER TABLE `rekap_natbinari` DISABLE KEYS */;
/*!40000 ALTER TABLE `rekap_natbinari` ENABLE KEYS */;

-- Dumping structure for table db_ukk_soleh.rekap_paskibra
CREATE TABLE IF NOT EXISTS `rekap_paskibra` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_siswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nipd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `predikat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskrispsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_ukk_soleh.rekap_paskibra: ~0 rows (approximately)
/*!40000 ALTER TABLE `rekap_paskibra` DISABLE KEYS */;
/*!40000 ALTER TABLE `rekap_paskibra` ENABLE KEYS */;

-- Dumping structure for table db_ukk_soleh.rekap_pmr
CREATE TABLE IF NOT EXISTS `rekap_pmr` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_siswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nipd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `predikat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_ukk_soleh.rekap_pmr: ~0 rows (approximately)
/*!40000 ALTER TABLE `rekap_pmr` DISABLE KEYS */;
/*!40000 ALTER TABLE `rekap_pmr` ENABLE KEYS */;

-- Dumping structure for table db_ukk_soleh.rekap_pramuka
CREATE TABLE IF NOT EXISTS `rekap_pramuka` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_siswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nipd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `predikat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_ukk_soleh.rekap_pramuka: ~0 rows (approximately)
/*!40000 ALTER TABLE `rekap_pramuka` DISABLE KEYS */;
/*!40000 ALTER TABLE `rekap_pramuka` ENABLE KEYS */;

-- Dumping structure for table db_ukk_soleh.siswa
CREATE TABLE IF NOT EXISTS `siswa` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nipd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_siswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gmail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_ukk_soleh.siswa: ~145 rows (approximately)
/*!40000 ALTER TABLE `siswa` DISABLE KEYS */;
INSERT INTO `siswa` (`id`, `nipd`, `nama_siswa`, `jenis_kelamin`, `gmail`, `no_telp`, `created_at`, `updated_at`) VALUES
	(1, '242510046', 'Melvin Olivia', 'P', 'melvinolivia14@gmail.com', '085779485241', '2026-04-09 14:35:56', '2026-04-09 14:35:57'),
	(2, '242510047', 'Reni Anggraeni', 'P', 'Reni.ang1510@gmail.com', '085892872381', '2026-04-09 14:35:58', '2026-04-09 14:35:58'),
	(3, '242510048', 'Dita Nofita Syahrani', 'P', 'ditanofitasyahrani@gmail.com', '085813392341', '2026-04-09 14:36:00', '2026-04-09 14:36:00'),
	(4, '242510049', 'Puspita Sari', 'P', 'sarisari879760@gmail.com', '085888261397', '2026-04-09 14:36:02', '2026-04-09 14:36:01'),
	(5, '242510050', 'MUHAMMAD FAREL ANDRIANI', 'L', 'muhammadfarelandriani@gmail.com', '085776649749', '2026-04-09 14:36:03', '2026-04-09 14:36:03'),
	(6, '242510051', 'Sonia Alifia', 'P', 'soniadago123@gmail.com', '081400832625', '2026-04-09 14:36:04', '2026-04-09 14:36:05'),
	(7, '242510052', 'Naurelia Azzahra Rahmadhani', 'P', 'naureliaazzahrarahmadhani@gmail.com', '089516413853', '2026-04-09 14:36:06', '2026-04-09 14:36:06'),
	(8, '242510053', 'Karina Dwi Astuti', 'P', 'karinadwii666@gmail.com', '085718085018', '2026-04-09 14:36:07', '2026-04-09 14:36:08'),
	(9, '242510054', 'Novita Damayanti', 'P', 'novitadamayanti401@gmail.com', '08953248003', '2026-04-09 14:36:09', '2026-04-09 14:36:09'),
	(10, '242510055', 'Mutia Putri Ramdania', 'P', 'mutiaputriramdania8@gmail.com', '089630308804', '2026-04-09 14:36:10', '2026-04-09 14:36:11'),
	(11, '242510056', 'Derrick Delvydi', 'L', 'derpro056.09@gmail.com', '088809074037', '2026-04-09 14:36:12', '2026-04-09 14:36:12'),
	(12, '242510057', 'Alya Khadijah', 'P', 'ivantheyaoiking@gmail.com', '081315736767', '2026-04-09 14:36:13', '2026-04-09 14:36:13'),
	(13, '242510058', 'Felicyna Aprilie Susanto Lie', 'P', 'feli91478@gmail.com', '088200878781', '2026-04-09 14:36:15', '2026-04-09 14:36:15'),
	(14, '242510059', 'Muhammad Ihwan Utomo', 'L', 'utomoihwan@gmail.com', '085710480148', '2026-04-09 14:36:16', '2026-04-09 14:36:17'),
	(15, '242510060', 'RAMADHAN AGIL SIRAJ', 'L', 'honibusa2008@gmail.com', '085871615850', '2026-04-09 14:36:17', '2026-04-09 14:36:18'),
	(16, '242510061', 'Lusi Cahyati', 'P', 'lusicahyati17@gmail.com', '083863689498', '2026-04-09 14:36:19', '2026-04-09 14:36:19'),
	(17, '242510062', 'Risma', 'P', 'salsabilarismaaulia@gmail.com', '085158911091', '2026-04-09 14:36:20', '2026-04-09 14:36:21'),
	(18, '242510063', 'MOCH AL IMRAN HARDIYATNA', 'L', 'bocahkepo166@gmail.com', '08818020358', '2026-04-09 14:36:23', '2026-04-09 14:36:22'),
	(19, '242510064', 'Najwa Juliani', 'P', 'awajuliani583@gmail.com', '088213014210', '2026-04-09 14:36:25', '2026-04-09 14:36:24'),
	(20, '242510065', 'Soma Winata', 'L', 'exelim09@gmail.com', '08159956342', '2026-04-09 14:36:26', '2026-04-09 14:36:27'),
	(21, '242510066', 'Fizzi Ahmad Rajib', 'L', 'fizziahmadrjib@gmail.com', '085693935305', '2026-04-09 14:36:29', '2026-04-09 14:36:28'),
	(22, '242510067', 'Zulaikha Muharam', 'P', 'zulaikhamuharam39@gmail.com', '08953289592', '2026-04-09 14:36:34', '2026-04-09 14:36:34'),
	(23, '242510068', 'Gusti Permas A.r', 'L', 'gustipermaspermas@gmail.com', '08581306020', '2026-04-09 14:36:36', '2026-04-09 14:36:35'),
	(24, '242510069', 'Sukses Mulya Saputra', 'L', 'suksesmulya30@gmail.com', '08891557299', '2026-04-09 14:36:37', '2026-04-09 14:36:37'),
	(25, '242510072', 'Muhamad Iqbal', 'L', 'muhamad.iqbal252010@gmail.com', '085692788722', '2026-04-09 14:36:39', '2026-04-09 14:36:38'),
	(26, '242510071', 'Wulan Apriliani', 'P', 'wapriliani356@gmail.com', '083866954709', '2026-04-09 14:36:40', '2026-04-09 14:36:41'),
	(27, '242510072', 'Kezia Manuel Pratama', 'P', 'keziamanuelp@gmail.com', '087185154334', '2026-04-09 14:36:43', '2026-04-09 14:36:42'),
	(28, '242510073', 'MILLATU AKMALIA', 'P', 'millatuakmalia@gmail.com', '081410212679', '2026-04-09 14:36:44', '2026-04-09 14:36:44'),
	(29, '242510074', 'JASMINE SHALSABILLA', 'P', 'J6289870@gmail.com', '08892203529', '2026-04-09 14:36:46', '2026-04-09 14:36:45'),
	(30, '242510075', 'Berliana Cahya Dewi', 'P', 'cahyadewiberliana8@gmail.com', '081943342438', '2026-04-09 14:36:47', '2026-04-09 14:36:46'),
	(31, '242510076', 'Sabria Widi Mulia', 'P', 'swidimulia@gmail.com', '085945628814', '2026-04-09 14:36:48', '2026-04-09 14:36:48'),
	(32, '242510077', 'Tasyah Utama Dewi', 'P', 'utamadewitasyah@gmail.com', '081398434332', '2026-04-09 14:36:51', '2026-04-09 14:36:51'),
	(33, '242510078', 'Risma Aulia Salsabila', 'P', 'salsabilarismaaulia@gmail.com', '085158911091', '2026-04-09 14:36:52', '2026-04-09 14:36:53'),
	(34, '242510079', 'Beryl Adrienne Widayat', 'P', 'beryladrienne30@gmail.com', '08953280778', '2026-04-09 14:36:54', '2026-04-09 14:36:53'),
	(35, '242510080', 'Shereen Naurah Salsabila', 'P', 'sirentigor@gmail.com', '089537690067', '2026-04-09 14:36:55', '2026-04-09 14:36:56'),
	(36, '242510081', 'NIA FIRNITA BUNGA JELITA', 'P', 'nfbjelita@gmail.com', '087880365504', '2026-04-09 14:36:57', '2026-04-09 14:36:56'),
	(37, '242510082', 'Manda Stela Fauzia', 'P', 'mandasteylafauziah@gmail.com', '083811687936', '2026-04-09 14:36:58', '2026-04-09 14:36:59'),
	(38, '242510169', 'Fadilla Nur Azizah', 'P', 'fadillanurzzh@gmail.com', '085775185591', '2026-04-09 14:37:00', '2026-04-09 14:37:00'),
	(39, '242510170', 'DHEA AMELIA', 'P', 'dheaamelia696@gmail.com', '085719525622', '2026-04-09 14:37:01', '2026-04-09 14:37:02'),
	(40, '242510171', 'Nurhayati', 'P', 'yatin9881@gmail.com', '085770187096', '2026-04-09 14:37:03', '2026-04-09 14:37:03'),
	(41, '242510172', 'Resti Alilah', 'P', 'restialilah@gmail.com', '089560863100', '2026-04-09 14:37:05', '2026-04-09 14:37:04'),
	(42, '242510173', 'Eka Putri Agustin', 'P', 'supriana2484@gmail.com', '081317894522', '2026-04-09 14:37:07', '2026-04-09 14:37:06'),
	(43, '242510174', 'ADHWAA ALYAA SYAFAA', 'P', 'diandrafarel091221@gmail.com', '081288769209', '2026-04-09 14:37:10', '2026-04-09 14:37:12'),
	(44, '242510175', 'SYIFA NUR AINI', 'P', 'cipaanuraini2@gmail.com', '088214475384', '2026-04-09 14:37:11', '2026-04-09 14:37:13'),
	(45, '242510176', 'Raisya Choirunnisa', 'P', 'raisyachoirunnisa2@gmail.com', '089668229592', '2026-04-09 14:37:13', '2026-04-09 14:37:15'),
	(46, '242510177', 'Citra Mustika', 'P', 'citramustika368@gmail.com', '085718524550', '2026-04-09 14:37:14', '2026-04-09 14:37:15'),
	(47, '242510178', 'Aprilia Tri Anjani', 'P', 'anjaniaprilia081@gmail.com', '089534814721', '2026-04-09 14:37:16', '2026-04-09 14:37:18'),
	(48, '242510179', 'Dhemalia Permana', 'P', 'dhemaliadem@gmail.com', '085892563424', '2026-04-09 14:37:17', '2026-04-09 14:37:19'),
	(49, '242510180', 'SHINTA NURCAHYATI JUWITA', 'P', 'shintashinta4320@gmail.com', '081584899631', '2026-04-09 14:37:21', '2026-04-09 14:37:20'),
	(50, '242510181', 'Tita Aurelia Candra', 'P', 'titaaureliacandra@gmail.com', '085774683450', '2026-04-09 14:37:22', '2026-04-09 14:37:21'),
	(51, '242510182', 'Ghaishani Najwa Alifah', 'P', 'Jjuaalie@gmail.com', '085892485894', '2026-04-09 14:37:23', '2026-04-09 14:37:24'),
	(52, '242510183', 'Rasti Rumi Yanto', 'P', 'rastirumi22@gmail.com', '085282929377', '2026-04-09 14:37:25', '2026-04-09 14:37:26'),
	(53, '242510083', 'PUTRA KASELA', 'L', 'hokiphone137@gmail.com', '083874599435', '2026-04-09 14:37:28', '2026-04-09 14:37:27'),
	(54, '242510084', 'Zaskia Ayu Putri', 'P', 'zaskiaayuputri738@gmail.com', '089510825394', '2026-04-09 14:37:30', '2026-04-09 14:37:30'),
	(55, '242510085', 'Muhamad Mujopar', 'L', 'mujapar@gmail.com', '085782301164', '2026-04-09 14:37:31', '2026-04-09 14:37:32'),
	(56, '242510086', 'Nurlita', 'P', 'lita8531@gmail.com', '089651810420', '2026-04-09 14:37:33', '2026-04-09 14:37:34'),
	(57, '242510087', 'Dira Oktavia', 'P', 'diraoktavia16@gmail.com', '083169252530', '2026-04-09 14:37:36', '2026-04-09 14:37:37'),
	(58, '242510088', 'Robiyatun Nisa', 'P', 'robiyatunnisa14@gmail.com', '085691838442', '2026-04-09 14:37:38', '2026-04-09 14:37:39'),
	(59, '242510089', 'Tasya Firmansyah', 'P', 'acaasyaafrmnsyh@gmail.com', '085695692006', '2026-04-09 14:37:40', '2026-04-09 14:37:41'),
	(60, '242510090', 'Diana', 'P', 'naac9335@gmail.com', '083187612556', '2026-04-09 14:37:42', '2026-04-09 14:37:43'),
	(61, '242510091', 'Ulan Nainda Suci Diani', 'P', 'ulandiani34@gmail.com', '089629678945', '2026-04-09 14:37:44', '2026-04-09 14:37:44'),
	(62, '242510092', 'Syaira Lailatul Jihan', 'P', 'syairaa831@gmail.com', '083827809968', '2026-04-09 14:37:46', '2026-04-09 14:37:45'),
	(63, '242510093', 'ARFINA FEBRIANTIKA', 'P', 'arfinafebriantika1@gmail.com', '08979180434', '2026-04-09 14:37:47', '2026-04-09 14:37:47'),
	(64, '242510094', 'Nursaila', 'P', 'nursailaa213@gmail.com', '083839729242', '2026-04-09 14:37:49', '2026-04-09 14:37:48'),
	(65, '242510095', 'SINTA', 'P', 'sintasintasinta305@gmail.com', '081283901715', '2026-04-09 14:37:50', '2026-04-09 14:37:51'),
	(66, '242510096', 'FIKRI AKBAR MAULANA', 'L', 'fikrichaamn@gmail.com', '085124793821', '2026-04-09 14:37:53', '2026-04-09 14:37:52'),
	(67, '242510097', 'Farel Apandi', 'L', 'apandifarel@gmail.com', '08983000362', '2026-04-09 14:37:54', '2026-04-09 14:37:55'),
	(68, '242510098', 'VILLYAL ARDAIRO', 'L', 'villyalardairo746@gmail.com', '081398631245', '2026-04-09 14:37:57', '2026-04-09 14:37:58'),
	(69, '242510099', 'Raisya Choirunnisa', 'P', 'raisyachoirunnisa2@gmail.com', '089668229592', '2026-04-09 14:38:00', '2026-04-09 14:37:59'),
	(70, '242510100', 'Rijal Zumalin Karim', 'L', 'rijal090310@gmail.com', '085836729276', '2026-04-09 14:38:01', '2026-04-09 14:38:00'),
	(71, '242510000', 'MOCHAMMAD IRFAN ARDIANSYAH', 'L', 'fanzfu6@gmail.com', '081525776692', '2026-04-09 14:38:03', '2026-04-09 14:38:02'),
	(72, '242510001', 'MOCHAMMAD IRFAN ARDIANSYAH', 'L', 'fanzfu6@gmail.com', '081525776692', '2026-04-09 14:38:04', '2026-04-09 14:38:04'),
	(73, '242510002', 'Muhammad Dafi Nur Awali', 'L', 'muhammaddafi132@gmail.com', '081617419508', '2026-04-09 14:38:06', '2026-04-09 14:38:06'),
	(74, '242510003', 'FIKRI BAYHAQI', 'L', 'fikribayhaqi51@gmail.com', '087885079793', '2026-04-09 14:38:08', '2026-04-09 14:38:09'),
	(75, '242510004', 'RIDHO NURUL FAIZIN', 'L', 'ridonoretri@gmail.com', '085694135593', '2026-04-09 14:38:10', '2026-04-09 14:38:09'),
	(76, '242510005', 'Marchel Hugo Putra Ramadhan', 'L', 'osinken2000@gmail.com', '085882270825', '2026-04-09 14:38:12', '2026-04-09 14:38:12'),
	(77, '242510006', 'Varent Ninna Nafisya', 'P', 'nafisyavarentninna@gmail.com', '085313709583', '2026-04-09 14:38:13', '2026-04-09 14:38:14'),
	(78, '242510007', 'Muhammad Faiz Ramadhan', 'L', 'faizramadhan.m13@gmail.com', '085693013577', '2026-04-09 14:38:16', '2026-04-09 14:38:15'),
	(79, '242510008', 'Reyvan Darmawan', 'L', 'reyvandarmawan21008@gmail.com', '08886159470', '2026-04-09 14:38:17', '2026-04-09 14:38:18'),
	(80, '242510009', 'Edward Raya Fadillah', 'L', 'edoikawa6@gmail.com', '0881010525695', '2026-04-09 14:38:19', '2026-04-09 14:38:19'),
	(81, '242510010', 'M.FAHRY TRI GUNAWAN', 'L', 'fahri08111@gmail.com', '087771517495', '2026-04-09 14:38:20', '2026-04-09 14:38:21'),
	(82, '242510011', 'Akmal', 'L', 'akmalfachrudin78@gmail.com', '088296603174', '2026-04-09 14:38:22', '2026-04-09 14:38:21'),
	(83, '242510012', 'HAFIZH KURNIAWAN', 'L', 'gantenghafidzh3@gmail.com', '085220204193', '2026-04-09 14:38:38', '2026-04-09 14:38:39'),
	(84, '242510013', 'MUHAMMAD FAHRI ALMANSYAH', 'L', 'fahrialmansyah1@gmail.com', '088973684320', '2026-04-09 14:38:40', '2026-04-09 14:38:40'),
	(85, '242510014', 'Rizky', 'L', 'rizkykijem655@gmail.com', '085817982235', '2026-04-09 14:38:41', '2026-04-09 14:38:42'),
	(86, '242510015', 'KHOIRUL SIDIQ', 'L', 'ksidiq829@gmail.com', '083150228179', '2026-04-09 14:38:43', '2026-04-09 14:38:44'),
	(87, '242510016', 'Nurhadi', 'L', 'hadisilvi5@gmail.com', '085711692608', '2026-04-09 14:38:45', '2026-04-09 14:38:44'),
	(88, '242510017', 'Fikri Bayhaqi', 'L', 'fikribayhaqi51@gmail.com', '087885079793', '2026-04-09 14:38:46', '2026-04-09 14:38:46'),
	(89, '242510018', 'Lukman Nul Hakim', 'L', 'profluckman76@gmail.com', '081617224517', '2026-04-09 14:38:48', '2026-04-09 14:38:47'),
	(90, '242510019', 'RIRIN DWI LESTARI', 'P', 'ar9609367@gmail.com', '085719388532', '2026-04-09 14:38:52', '2026-04-09 14:38:51'),
	(91, '242510020', 'Bagas Ardy Nugroho', 'L', 'bagas.ardy06@gmail.com', '081932648534', '2026-04-09 14:38:52', '2026-04-09 14:38:53'),
	(92, '242510021', 'Jesica', 'P', 'jessicamilla872@gmail.com', '083843962291', '2026-04-09 14:38:54', '2026-04-09 14:38:54'),
	(93, '242510022', 'Khansa Febriah Utami', 'P', 'sa2650681@gmail.com', '083191929626', '2026-04-09 14:38:55', '2026-04-09 14:38:55'),
	(94, '242510023', 'Aryo Tri Panjalu', 'L', 'panjaluaryotri1@gmail.com', '085890562542', '2026-04-09 14:38:56', '2026-04-09 14:38:56'),
	(95, '242510024', 'Bayu Riffiansyah Sukardi', 'L', 'bayuriffiansyah@gmail.com', '089501948140', '2026-04-09 14:38:57', '2026-04-09 14:38:58'),
	(96, '242510025', 'Fiqih Al Farizi', 'L', 'alfarizifiki125@gmail.com', '081999718152', '2026-04-09 14:38:59', '2026-04-09 14:38:59'),
	(97, '242510026', 'ARFAN MAULANA', 'L', 'skidibiopl@gmail.com', '083166015301', '2026-04-09 14:39:01', '2026-04-09 14:39:00'),
	(98, '242510027', 'THRESIA TIARA AULIA PUTRI', 'P', 'tiaraauliap23@gmail.com', '081617246196', '2026-04-09 14:39:01', '2026-04-09 14:39:02'),
	(99, '242510028', 'MUSTOPA', 'L', 'mustopaopeng684@gmail.com', '085811878457', '2026-04-09 14:39:02', '2026-04-09 14:39:03'),
	(100, '242510029', 'Nibras Ibnu Nauval', 'L', 'nibrasganteng254@gmail.com', '089603208120', '2026-04-09 14:39:18', '2026-04-09 14:39:19'),
	(101, '242510030', 'HAMAMI', 'L', 'hamzsky95@gmail.com', '083894092274', '2026-04-09 14:39:21', '2026-04-09 14:39:20'),
	(102, '242510031', 'Fatir Muhammad', 'L', 'fatirmaheesa@gmail.com', '083115872097', '2026-04-09 14:39:21', '2026-04-09 14:39:22'),
	(103, '242510032', 'Jonathan Martua Simbolon', 'L', 'nathanskibidi20@gmail.com', '089525948820', '2026-04-09 14:39:24', '2026-04-09 14:39:23'),
	(104, '242510033', 'Arya Aditya Naufal', 'L', 'palepal466@gmail.com', '0895374927772', '2026-04-09 14:39:27', '2026-04-09 14:39:28'),
	(105, '242510034', 'Nira Azahra', 'P', 'azanira29@gmail.com', '087884297959', '2026-04-09 14:39:29', '2026-04-09 14:39:28'),
	(106, '242510035', 'NABILA', 'P', 'pp5630820@gmail.com', '0881024416254', '2026-04-09 14:39:33', '2026-04-09 14:39:33'),
	(107, '242510036', 'Anisa Nurbaiti Sakinah', 'P', 'asakinah219@gmail.com', '081585313844', '2026-04-09 14:39:35', '2026-04-09 14:39:34'),
	(108, '242510037', 'Dylan Akilah Iswahyudhi', 'L', 'iswahyudhidylan@gmail.com', '087882319295', '2026-04-09 14:39:36', '2026-04-09 14:39:36'),
	(109, '242510028', 'Rolita Wintarsih', 'P', 'rolitawintarsihlita@gmail.com', '085817762030', '2026-04-09 14:39:37', '2026-04-09 14:39:38'),
	(110, '242510029', 'Laila Seftya Rahayu', 'P', 'seftyarahayulaila@gmail.com', '087726358603', '2026-04-09 14:39:39', '2026-04-09 14:39:39'),
	(111, '242510030', 'Jesi Aulia A', 'P', 'iniindriyah@gmail.com', '08978584876', '2026-04-09 14:39:40', '2026-04-09 14:39:40'),
	(112, '242510031', 'NAYSILA INSANI', 'P', 'inaysila26@gmail.com', '089508180613', '2026-04-09 14:39:45', '2026-04-09 14:39:47'),
	(113, '242510032', 'Nazwa Zahra Aulia', 'P', 'nazwazahraaulia4@gmail.com', '087802062659', '2026-04-09 14:39:48', '2026-04-09 14:39:47'),
	(114, '242510033', 'Amelia Putri', 'P', 'rugidongluparugi@gmail.com', '085880173039', '2026-04-09 14:39:51', '2026-04-09 14:39:50'),
	(115, '242510034', 'Anis', 'P', 'anisnov35@gmail.com', '083106091130', '2026-04-09 14:39:52', '2026-04-09 14:39:50'),
	(116, '242510035', 'Nazwa Safitri', 'P', 'nazwa7467@gmail.com', '089562234772', '2026-04-09 14:39:55', '2026-04-09 14:39:53'),
	(117, '242510036', 'Dara Nur Syafitri', 'P', 'daranursyafitri@gmail.com', '085774026487', '2026-04-09 14:39:55', '2026-04-09 14:39:54'),
	(118, '242510037', 'Amelia Putri', 'P', 'rugidongluparugi@gmail.com', '085880173039', '2026-04-09 14:40:30', '2026-04-09 14:40:26'),
	(119, '242510038', 'Robiatul Kamila', 'P', 'robiatukamila@gmail.com', '089532779', '2026-04-09 14:40:31', '2026-04-09 14:40:27'),
	(120, '242510039', 'Junia Khairunnisya', 'P', 'juniaica2@gmail.com', '089532375477', '2026-04-09 14:40:31', '2026-04-09 14:40:28'),
	(121, '242510040', 'Siti Nurlita', 'P', 'sitinurlita582@gmail.com', '085810760671', '2026-04-09 14:40:32', '2026-04-09 14:40:28'),
	(122, '242510041', 'Safira Cahya Kirana', 'P', 'safiracahyakirana@gmail.com', '083847694101', '2026-04-09 14:40:33', '2026-04-09 14:40:29'),
	(123, '242510042', 'Safira Cahya Kirana', 'P', 'safiracahyakirana@gmail.com', '083847694101', '2026-04-09 14:40:33', '2026-04-09 14:40:23'),
	(124, '242510043', 'Nasya Ayudia Nugroho', 'P', 'nayudianugroho@gmail.com', '085691552799', '2026-04-09 14:40:34', '2026-04-09 14:40:22'),
	(125, '242510149', 'Aliffia Rafifah Indrani', 'P', 'ranialiffia@gmail.com', '089540073701', '2026-04-09 14:40:35', '2026-04-09 14:40:22'),
	(126, '242510150', 'BUDI HARIANTO', 'L', 'Budiharianto430@gmail.com', '089540073701', '2026-04-09 14:40:37', '2026-04-09 14:40:21'),
	(127, '242510151', 'Safa Putri Kirana', 'P', 'safakirana0403@gmail.com', '083137912391', '2026-04-09 14:40:38', '2026-04-09 14:40:20'),
	(128, '242510152', 'BAGAS KHAIDAR NURALIMIN', 'L', 'sulharosmani@gmail.com', '088975197848', '2026-04-09 14:40:39', '2026-04-09 14:40:17'),
	(129, '242510153', 'Ratu Haerunnisa', 'P', 'ratuhrnns@gmail.com', '083819607701', '2026-04-09 14:40:39', '2026-04-09 14:40:16'),
	(130, '242510154', 'BELA SILVIA SARI', 'P', 'belasilviasari@gmail.com', '088290645151', '2026-04-09 14:40:43', '2026-04-09 14:40:14'),
	(131, '242510155', 'Alip Pirdaus', 'L', 'Pirda231228@gmail.com', '085798824206', '2026-04-09 14:40:42', '2026-04-09 14:40:14'),
	(132, '242510156', 'Qushay Abdilah', 'L', 'xshayyyyy2124@gmail.com', '085775589170', '2026-04-09 14:40:44', '2026-04-09 14:40:13'),
	(133, '242510157', 'Imam Ahmad Rosyidin', 'L', 'imamahmadr7@gmail.com', '089580324674', '2026-04-09 14:40:45', '2026-04-09 14:40:13'),
	(134, '242510158', 'Jahra', 'P', 'za2127902@gmail.com', '085710452119', '2026-04-09 14:40:46', '2026-04-09 14:40:12'),
	(135, '242510159', 'MUHAMMAD MOMO AL ALIF', 'L', 'momoalalif126@gmail.com', '085974818326', '2026-04-09 14:40:47', '2026-04-09 14:40:09'),
	(136, '242510160', 'Inka Shilpia', 'P', 'inkashilpia@gmail.com', '088212946975', '2026-04-09 14:40:48', '2026-04-09 14:40:10'),
	(137, '242510161', 'ROSA ANGGRAENI', 'P', 'ocaaanggraeni81@gmail.com', '083843601681', '2026-04-09 14:40:49', '2026-04-09 14:40:11'),
	(138, '242510162', 'Ajeng Safahatul', 'P', 'safahatuladjeng@gmail.com', '085813047022', '2026-04-09 14:40:50', '2026-04-09 14:40:08'),
	(139, '242510163', 'RIANTI NURISWAYNI', 'P', 'riantinuriswayni@gmail.com', '083117761296', '2026-04-09 14:40:51', '2026-04-09 14:40:07'),
	(140, '242510164', 'NIKEN AYU', 'P', 'nikenofficial2024@gmail.com', '081543498142', '2026-04-09 14:40:52', '2026-04-09 14:40:07'),
	(141, '242510165', 'HELGA FAUSTINA SANJAYA', 'L', 'helgafaustina5@gmail.com', '088554516902', '2026-04-09 14:40:53', '2026-04-09 14:40:06'),
	(142, '242510166', 'MAULANA YUSUF ARDIANSYAH', 'L', 'maulanaya347@gmail.com', '083811948458', '2026-04-09 14:40:54', '2026-04-09 14:40:05'),
	(143, '242510167', 'Muhammad Ridho Faizumillah', 'L', 'ridhojelek01@gmail.com', '085814503018', '2026-04-09 14:40:54', '2026-04-09 14:40:04'),
	(144, '242510168', 'M. Ridho Solihin', 'P', 'ridhosolihin18@gmail.com', '085814193167', '2026-04-09 14:40:03', '2026-04-09 14:40:04'),
	(145, '242510169', 'Siti Laela Sari', 'P', 'sitilailasari52@gmail.com', '083830513279', '2026-04-09 14:40:01', '2026-04-09 14:40:02');
/*!40000 ALTER TABLE `siswa` ENABLE KEYS */;

-- Dumping structure for table db_ukk_soleh.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_ukk_soleh.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
