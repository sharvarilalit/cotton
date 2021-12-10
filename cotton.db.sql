-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.13-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for cotton_business
CREATE DATABASE IF NOT EXISTS `cotton_business` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `cotton_business`;

-- Dumping structure for table cotton_business.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cotton_business.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table cotton_business.farmer
CREATE TABLE IF NOT EXISTS `farmer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `truck_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `cotton_weight` enum('kintal','kilo') DEFAULT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `paid_amount` decimal(10,2) DEFAULT NULL,
  `pending_amount` decimal(10,2) DEFAULT NULL,
  `payment_status` enum('Paid','Pending') DEFAULT NULL,
  `payment_mode` enum('Online','Offline') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_farmer_truck` (`truck_id`),
  CONSTRAINT `FK_farmer_truck` FOREIGN KEY (`truck_id`) REFERENCES `truck` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cotton_business.farmer: ~2 rows (approximately)
/*!40000 ALTER TABLE `farmer` DISABLE KEYS */;
INSERT IGNORE INTO `farmer` (`id`, `truck_id`, `name`, `location`, `date`, `cotton_weight`, `quantity`, `price`, `total_amount`, `paid_amount`, `pending_amount`, `payment_status`, `payment_mode`, `created_at`, `updated_at`) VALUES
	(1, 1, 'sharvari', 'sawantwadi', '2021-12-08 00:00:00', 'kilo', '100', 50.00, 10000.00, 6000.00, 4000.00, 'Pending', 'Online', '2021-12-08 11:49:51', '2021-12-10 08:37:01'),
	(2, 1, 'test', 'NAVI MUMBAI', '2021-12-10 00:00:00', 'kintal', '200', 100.00, 20000.00, 6000.00, 14000.00, 'Pending', 'Online', '2021-12-10 08:50:02', '2021-12-10 08:50:02');
/*!40000 ALTER TABLE `farmer` ENABLE KEYS */;

-- Dumping structure for table cotton_business.market
CREATE TABLE IF NOT EXISTS `market` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `market_name` varchar(50) DEFAULT NULL,
  `market_location` varchar(50) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `truck_weight` enum('kintal','kilo') DEFAULT NULL,
  `truck_id` int(10) unsigned DEFAULT NULL,
  `market_price` decimal(10,2) DEFAULT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_market_truck` (`truck_id`) USING BTREE,
  CONSTRAINT `FK_market_truck` FOREIGN KEY (`truck_id`) REFERENCES `truck` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cotton_business.market: ~0 rows (approximately)
/*!40000 ALTER TABLE `market` DISABLE KEYS */;
/*!40000 ALTER TABLE `market` ENABLE KEYS */;

-- Dumping structure for table cotton_business.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cotton_business.migrations: ~4 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table cotton_business.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cotton_business.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table cotton_business.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cotton_business.personal_access_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table cotton_business.proft_loss_table
CREATE TABLE IF NOT EXISTS `proft_loss_table` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `total_profit_per_truck` varchar(50) DEFAULT NULL,
  `truck_id` int(10) unsigned DEFAULT NULL,
  `total_vehicale_charges` decimal(10,2) DEFAULT NULL,
  `total_benifit` decimal(10,2) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_profit_losss_table_truck` (`truck_id`) USING BTREE,
  CONSTRAINT `FK_profit_losss_table_truck` FOREIGN KEY (`truck_id`) REFERENCES `truck` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cotton_business.proft_loss_table: ~0 rows (approximately)
/*!40000 ALTER TABLE `proft_loss_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `proft_loss_table` ENABLE KEYS */;

-- Dumping structure for table cotton_business.truck
CREATE TABLE IF NOT EXISTS `truck` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `truck_no` varchar(50) DEFAULT NULL,
  `truck_mapadi_name` varchar(50) DEFAULT NULL,
  `truck_person_name` varchar(50) DEFAULT NULL,
  `truck_status` int(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cotton_business.truck: ~1 rows (approximately)
/*!40000 ALTER TABLE `truck` DISABLE KEYS */;
INSERT IGNORE INTO `truck` (`id`, `truck_no`, `truck_mapadi_name`, `truck_person_name`, `truck_status`, `created_at`, `updated_at`) VALUES
	(1, 'MH34578', 'test', 'xyz', 1, '2021-12-07 22:47:07', '2021-12-07 17:45:01');
/*!40000 ALTER TABLE `truck` ENABLE KEYS */;

-- Dumping structure for table cotton_business.truck_charges
CREATE TABLE IF NOT EXISTS `truck_charges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `truck_id` int(10) unsigned DEFAULT NULL,
  `driver_name` varchar(50) DEFAULT NULL,
  `location_from_to` varchar(50) DEFAULT NULL,
  `vehicile_charges` varchar(50) DEFAULT NULL,
  `labour_charges` varchar(50) DEFAULT NULL,
  `village_commisions` varchar(50) DEFAULT NULL,
  `route_charges` varchar(50) DEFAULT NULL,
  `total_charges` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_truck_charges_truck` (`truck_id`),
  CONSTRAINT `FK_truck_charges_truck` FOREIGN KEY (`truck_id`) REFERENCES `truck` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cotton_business.truck_charges: ~0 rows (approximately)
/*!40000 ALTER TABLE `truck_charges` DISABLE KEYS */;
/*!40000 ALTER TABLE `truck_charges` ENABLE KEYS */;

-- Dumping structure for table cotton_business.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_phone_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cotton_business.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin12', 'admin@gmail.com', '1234567891', NULL, '$2y$10$A6r4esir5bUzEITEy2JMbONu3itxmMoUaPQcT3tRS49GYDfW5UpmW', 'fKwcIjeoqysLthKtzb4wPmrnWLbgzkd2zJfTMCDk4stC0550YI7GzJShsjf8', '2021-11-26 17:38:35', '2021-11-26 18:42:44');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
