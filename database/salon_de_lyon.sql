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


-- Dumping database structure for salon_de_lyon
CREATE DATABASE IF NOT EXISTS `salon_de_lyon` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `salon_de_lyon`;

-- Dumping data for table salon_de_lyon.customers: ~4 rows (approximately)
INSERT INTO `customers` (`id`, `name`, `phone`, `email`, `address`, `created_at`, `updated_at`) VALUES
	(1, 'Agatha', '086813327865', 'destaeka.trn2004@gmail.com', NULL, '2026-09-19 00:23:52', '2026-09-19 00:23:52'),
	(2, 'Hanif Handino Putra', '081959605095', NULL, NULL, '2026-09-19 01:57:39', '2026-09-19 01:57:39'),
	(3, 'ahya', '0828080112', 'desta.eka2004@gmail.com', NULL, '2026-09-19 03:03:33', '2026-09-20 23:45:55'),
	(4, 'Sze', '0888888888', 'sze@gmail.com', NULL, '2026-09-19 03:18:53', '2026-09-19 03:18:53'),
	(5, 'nabil', '0859345678', NULL, NULL, '2026-09-22 00:31:24', '2026-09-22 00:31:24'),
	(6, 'Nabila Gita Cahya', '0895322261665', 'nabila235@gmail.com', NULL, '2026-09-22 06:08:46', '2026-09-22 06:08:46');

-- Dumping data for table salon_de_lyon.failed_jobs: ~0 rows (approximately)

-- Dumping data for table salon_de_lyon.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_100000_create_password_resets_table', 1),
	(2, '2019_08_19_000000_create_failed_jobs_table', 1),
	(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(4, '2024_01_01_000001_create_users_table', 1),
	(5, '2024_01_01_000002_create_customers_table', 1),
	(6, '2024_01_01_000003_create_stylists_table', 1),
	(7, '2024_01_01_000004_create_treatments_table', 1),
	(8, '2024_01_01_000005_create_stylist_treatment_table', 1),
	(9, '2024_01_01_000006_create_reservations_table', 1),
	(10, '2024_01_01_000007_create_transactions_table', 1),
	(11, '2024_01_01_000008_create_reservation_status_logs_table', 1),
	(12, '2024_02_01_000001_add_gender_to_stylists_table', 1);

-- Dumping data for table salon_de_lyon.password_resets: ~0 rows (approximately)

-- Dumping data for table salon_de_lyon.personal_access_tokens: ~0 rows (approximately)

-- Dumping data for table salon_de_lyon.reservations: ~7 rows (approximately)
INSERT INTO `reservations` (`id`, `reservation_code`, `customer_id`, `stylist_id`, `treatment_id`, `reservation_date`, `start_time`, `end_time`, `source`, `status`, `notes`, `cancelled_reason`, `created_by`, `created_at`, `updated_at`) VALUES
	(1, 'RSV-000001', 1, 3, 1, '2026-09-19', '14:00:00', '15:00:00', 'Web/App Customer', 'Selesai', NULL, NULL, NULL, '2026-09-19 00:23:52', '2026-09-19 03:00:48'),
	(2, 'RSV-000002', 2, 3, 12, '2026-09-28', '16:00:00', '17:00:00', 'Web/App Customer', 'Selesai', 'Desta Eka Tiarani itu pacar gua,ngga ada yg bolehh deketin dia bahkan sampe megang megang dia badannya GA BOLEH, tahta harta Desta thats mine, cewe gua cantik imut lucu manis wangi baik hati dan banyakk bangettt, my bini Desta Eka Tiarani', NULL, NULL, '2026-09-19 01:57:39', '2026-09-19 03:23:31'),
	(3, 'RSV-000003', 3, 4, 42, '2026-09-19', '15:00:00', '16:00:00', 'Web/App Customer', 'Dibatalkan', NULL, 'Dibatalkan oleh customer.', NULL, '2026-09-19 03:03:33', '2026-09-20 23:47:31'),
	(4, 'RSV-000004', 4, 2, 21, '2026-09-19', '17:00:00', '21:30:00', 'Web/App Customer', 'Dikonfirmasi', NULL, NULL, NULL, '2026-09-19 03:18:53', '2026-09-19 03:24:09'),
	(5, 'RSV-000005', 3, 3, 1, '2026-09-22', '10:00:00', '11:00:00', 'Web/App Customer', 'Dikonfirmasi', 'balala', NULL, NULL, '2026-09-20 23:45:55', '2026-09-20 23:47:05'),
	(6, 'RSV-000006', 5, 4, 47, '2026-09-22', '17:00:00', '18:30:00', 'Web/App Customer', 'Selesai', 'balalala', NULL, NULL, '2026-09-22 00:31:24', '2026-09-22 00:32:52'),
	(7, 'RSV-000007', 6, 3, 1, '2026-09-30', '11:00:00', '12:00:00', 'Web/App Customer', 'Selesai', NULL, NULL, NULL, '2026-09-22 06:08:46', '2026-09-22 06:10:21');

-- Dumping data for table salon_de_lyon.reservation_status_logs: ~17 rows (approximately)
INSERT INTO `reservation_status_logs` (`id`, `reservation_id`, `old_status`, `new_status`, `changed_by`, `note`, `changed_at`) VALUES
	(1, 1, NULL, 'Menunggu Konfirmasi', NULL, 'Booking mandiri oleh customer lewat web.', '2026-09-19 00:23:52'),
	(2, 1, 'Menunggu Konfirmasi', 'Dikonfirmasi', 1, NULL, '2026-09-19 00:25:19'),
	(3, 2, NULL, 'Menunggu Konfirmasi', NULL, 'Booking mandiri oleh customer lewat web.', '2026-09-19 01:57:39'),
	(4, 2, 'Menunggu Konfirmasi', 'Dikonfirmasi', 1, NULL, '2026-09-19 01:58:49'),
	(5, 1, 'Dikonfirmasi', 'Selesai', 1, 'Transaksi dicatat.', '2026-09-19 03:00:48'),
	(6, 1, 'Selesai', 'Selesai', 1, NULL, '2026-09-19 03:00:57'),
	(7, 3, NULL, 'Menunggu Konfirmasi', NULL, 'Booking mandiri oleh customer lewat web.', '2026-09-19 03:03:33'),
	(8, 3, 'Menunggu Konfirmasi', 'Dikonfirmasi', 1, NULL, '2026-09-19 03:04:01'),
	(9, 4, NULL, 'Menunggu Konfirmasi', NULL, 'Booking mandiri oleh customer lewat web.', '2026-09-19 03:18:53'),
	(10, 2, 'Dikonfirmasi', 'Selesai', 1, NULL, '2026-09-19 03:23:31'),
	(11, 4, 'Menunggu Konfirmasi', 'Dikonfirmasi', 1, NULL, '2026-09-19 03:24:09'),
	(12, 5, NULL, 'Menunggu Konfirmasi', NULL, 'Booking mandiri oleh customer lewat web.', '2026-09-20 23:45:55'),
	(13, 5, 'Menunggu Konfirmasi', 'Dikonfirmasi', 1, NULL, '2026-09-20 23:47:05'),
	(14, 3, 'Dikonfirmasi', 'Dibatalkan', NULL, 'Dibatalkan mandiri oleh customer.', '2026-09-20 23:47:31'),
	(15, 6, NULL, 'Menunggu Konfirmasi', NULL, 'Booking mandiri oleh customer lewat web.', '2026-09-22 00:31:24'),
	(16, 6, 'Menunggu Konfirmasi', 'Dikonfirmasi', 1, NULL, '2026-09-22 00:32:38'),
	(17, 6, 'Dikonfirmasi', 'Selesai', 1, 'Transaksi dicatat.', '2026-09-22 00:32:52'),
	(18, 7, NULL, 'Menunggu Konfirmasi', NULL, 'Booking mandiri oleh customer lewat web.', '2026-09-22 06:08:46'),
	(19, 7, 'Menunggu Konfirmasi', 'Dikonfirmasi', 1, NULL, '2026-09-22 06:09:12'),
	(20, 7, 'Dikonfirmasi', 'Selesai', 1, NULL, '2026-09-22 06:10:21');

-- Dumping data for table salon_de_lyon.stylists: ~4 rows (approximately)
INSERT INTO `stylists` (`id`, `name`, `specialization`, `gender`, `photo`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Sarah', 'Coloring & Styling', 'P', 'stylists/d9Rc4vyrvXhOH3PGwPAjvXHp2gmBBi2AQhGMeISS.jpg', 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:26:43'),
	(2, 'Dinda', 'Smoothing & Perm', 'P', 'stylists/xfDZkIurnAHX9KF2untq1WtHbgKRHmkJK86JXZxw.jpg', 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:26:16'),
	(3, 'Rizky', 'Hair Cut & Men Style', 'L', 'stylists/DWjrJ15rTOqI0GDX9FdSDgPCVWNa85c6UbRY234s.jpg', 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:26:28'),
	(4, 'Dimas', 'Treatment & Hair Spa', 'L', 'stylists/rXecLVcJxOZUo7J4dFuwTvEMoYHPmP5Rr4dc7dBc.jpg', 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:25:58');

-- Dumping data for table salon_de_lyon.stylist_treatment: ~66 rows (approximately)
INSERT INTO `stylist_treatment` (`id`, `stylist_id`, `treatment_id`) VALUES
	(1, 1, 30),
	(2, 1, 31),
	(3, 1, 32),
	(4, 1, 33),
	(5, 1, 34),
	(6, 1, 35),
	(7, 1, 36),
	(8, 1, 37),
	(9, 1, 38),
	(10, 1, 39),
	(11, 1, 62),
	(12, 1, 63),
	(13, 1, 64),
	(14, 1, 65),
	(15, 1, 66),
	(16, 2, 15),
	(17, 2, 16),
	(18, 2, 17),
	(19, 2, 18),
	(20, 2, 19),
	(21, 2, 20),
	(22, 2, 21),
	(23, 2, 22),
	(24, 2, 23),
	(25, 2, 24),
	(26, 2, 25),
	(27, 2, 26),
	(28, 2, 27),
	(29, 2, 28),
	(30, 2, 29),
	(31, 3, 1),
	(32, 3, 2),
	(33, 3, 3),
	(34, 3, 4),
	(35, 3, 5),
	(36, 3, 6),
	(37, 3, 7),
	(38, 3, 8),
	(39, 3, 9),
	(40, 3, 10),
	(41, 3, 11),
	(42, 3, 12),
	(43, 3, 13),
	(44, 3, 14),
	(45, 4, 40),
	(46, 4, 41),
	(47, 4, 42),
	(48, 4, 43),
	(49, 4, 44),
	(50, 4, 45),
	(51, 4, 46),
	(52, 4, 47),
	(53, 4, 48),
	(54, 4, 49),
	(55, 4, 50),
	(56, 4, 51),
	(57, 4, 52),
	(58, 4, 53),
	(59, 4, 54),
	(60, 4, 55),
	(61, 4, 56),
	(62, 4, 57),
	(63, 4, 58),
	(64, 4, 59),
	(65, 4, 60),
	(66, 4, 61);

-- Dumping data for table salon_de_lyon.transactions: ~2 rows (approximately)
INSERT INTO `transactions` (`id`, `transaction_code`, `reservation_id`, `total_amount`, `payment_status`, `payment_method`, `transaction_date`, `processed_by`, `created_at`, `updated_at`) VALUES
	(1, 'TRX-000001', 1, 400000.00, 'Lunas', 'QRIS', '2026-09-19 10:00:48', 1, '2026-09-19 03:00:48', '2026-09-19 03:00:48'),
	(2, 'TRX-000002', 2, 600000.00, 'Lunas', 'Kartu Debit/Kredit', '2026-09-19 10:23:42', 1, '2026-09-19 03:23:42', '2026-09-19 03:23:42'),
	(3, 'TRX-000003', 6, 3000000.00, 'Lunas', 'Cash', '2026-09-22 07:32:52', 1, '2026-09-22 00:32:52', '2026-09-22 00:32:52');

-- Dumping data for table salon_de_lyon.treatments: ~66 rows (approximately)
INSERT INTO `treatments` (`id`, `name`, `category`, `description`, `price`, `duration_minutes`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Wanita Cut Dewasa', 'Cut Woman', 'Gunting + Blow. Tambahan untuk rambut panjang \'all-wave blow\': +Rp 50.000.', 400000.00, 60, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(2, 'Wanita Cut Remaja', 'Cut Woman', 'Untuk usia SMP - SMA.', 300000.00, 45, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(3, 'Wanita Cut Anak-anak', 'Cut Woman', 'Di bawah SD kelas 6.', 200000.00, 40, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(4, 'Wanita Cut Scaling', 'Cut Woman', 'Membuka pori-pori tersumbat, membantu pertumbuhan rambut, scaling kapalan & sebum, memberi gizi langsung dari luar (scaling kulit rambut + tonik).', 600000.00, 75, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(5, 'Wanita Cut Scalp Massage', 'Cut Woman', 'Cut Scaling + massage peredaran darah kepala, kulit, dan bahu + penguat rambut PPT.', 700000.00, 90, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(6, 'Cut Mucota', 'Cut Woman', 'Konsentrasi nutrisi rambut rusak singkat. Curl elastis, efek penumbuhan, sistem reaksi Mucota (45 tingkat pemberian nutrisi).', 700000.00, 90, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(7, 'Cut Root-Volume', 'Cut Woman', 'Pemberian volume di bagian akar rambut setelah perm, meskipun curl bagian bawah sudah cukup bagus.', 700000.00, 90, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(8, 'Pria Cut Dewasa', 'Cut Man', 'Gunting + Styling standard.', 300000.00, 45, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(9, 'Pria Cut Remaja', 'Cut Man', 'Untuk usia SMP - SMA.', 250000.00, 30, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(10, 'Pria Cut Anak-anak', 'Cut Man', 'Di bawah SD kelas 6.', 200000.00, 30, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(11, 'Pria Cut Scaling', 'Cut Man', 'Membuka pori-pori tersumbat, membantu pertumbuhan rambut, scaling kapalan & sebum, nutrisi kulit kepala.', 500000.00, 60, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(12, 'Pria Cut Scalp Massage', 'Cut Man', 'Cut Scaling + massage peredaran darah kepala, kulit, dan bahu + penguat rambut PPT.', 600000.00, 60, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(13, 'Basic Side Down Cut', 'Cut Man', 'Perawatan menurunkan rambut terapung di bagian samping dan leher belakang dengan produk perm.', 500000.00, 60, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(14, 'Magic Side Down Cut', 'Cut Man', 'Perawatan menurunkan rambut terapung di bagian samping dan leher belakang dengan volume magic.', 500000.00, 75, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(15, 'Basic Perm', 'Perm Woman', 'Perm biasa.', 1000000.00, 150, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(16, 'Clinic Perm', 'Perm Woman', 'Perm klinik (dengan nutrisi).', 1200000.00, 150, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(17, 'Straight Perm', 'Perm Woman', 'Perm lurus / smoothing.', 1000000.00, 180, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(18, 'Magic Perm', 'Perm Woman', 'Pelurusan magic.', 1200000.00, 210, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(19, 'Volume Magic Perm', 'Perm Woman', 'Volume magic.', 1500000.00, 240, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(20, 'Digital Perm', 'Perm Woman', 'Perm digital.', 2000000.00, 210, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(21, 'Mix Perm', 'Perm Woman', 'Volume magic + digital.', 2500000.00, 270, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(22, 'Root Perm', 'Perm Woman', 'Partial (volume keseluruhan spesial): Rp 400.000. Whole (akar rambut atas, samping & crown): Rp 800.000.', 400000.00, 90, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(23, 'Poni Perm', 'Perm Woman', 'Perm khusus bagian poni.', 200000.00, 60, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(24, 'Basic Perm (Pria)', 'Perm Man', 'Perm standar pria.', 800000.00, 120, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(25, 'Clinic Perm (Pria)', 'Perm Man', 'Perm klinik pria.', 1000000.00, 120, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(26, 'Down + Volume Perm', 'Perm Man', 'Kombinasi down perm & volume perm.', 1000000.00, 120, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(27, 'Magic (Pria)', 'Perm Man', 'Pelurusan magic pria.', 1000000.00, 150, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(28, 'Volume Magic (Pria)', 'Perm Man', 'Volume magic pria.', 1500000.00, 150, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(29, 'Perm Spesial', 'Perm Man', 'Custom perm (setelah konsultasi) — harga bervariasi, hubungi kasir.', 0.00, 120, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(30, 'Basic Color', 'Color', 'Pewarnaan dasar. Wanita: Rp 800.000 / Pria: Rp 700.000.', 700000.00, 120, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(31, 'Clinic Color', 'Color', 'Refleksi sinar dan tambahan ampul perobatan.', 900000.00, 120, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(32, 'Premium Color', 'Color', 'Dengan 2 jenis ampul persediaan air & membantu kelembutan rambut.', 1000000.00, 150, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(33, 'Inoa Color', 'Color', 'Tidak bau, tanpa amoniak, kulit kepala tenang, proteksi rambut, pewarna mengkilap.', 1000000.00, 120, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(34, 'Penutup Color (Uban)', 'Color', 'Manfaat khusus customer yang coloring 1x/lebih dalam sebulan. Service perobatan PPT pada rambut (Cut + Coloring + Perobatan PPT).', 600000.00, 120, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(35, 'Mucota & Color', 'Color', 'Pertemuan color dengan mucota (kombinasi superlatif).', 1300000.00, 180, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(36, 'Hena', 'Color', 'Perangsang ke rambut & kulit hampir tidak ada, tahan lama, efek pengobatan lebih lama.', 800000.00, 120, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(37, 'Squid Tinta', 'Color', 'Pewarnaan tinta cumi (alami & pekat).', 800000.00, 120, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(38, 'Manicure & Waxing', 'Color', 'Mengkilap dan elastisitas sangat tinggi oleh coating kuat di atas cuticle.', 800000.00, 120, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(39, 'Bleaching', 'Color', '1 kali bleach.', 600000.00, 90, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(40, 'Water Care', 'Clinic Hair & Mucota', 'Persediaan air.', 500000.00, 60, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(41, 'Protein Care', 'Clinic Hair & Mucota', 'Penambahan protein.', 600000.00, 60, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(42, 'Basic Ample Care', 'Clinic Hair & Mucota', 'Ampul basic.', 600000.00, 60, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(43, 'Mucota Clinic Small', 'Clinic Hair & Mucota', 'Mucota Clinic ukuran rambut pendek.', 1000000.00, 75, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(44, 'Mucota Clinic Medium', 'Clinic Hair & Mucota', 'Mucota Clinic ukuran rambut sedang.', 1300000.00, 90, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(45, 'Mucota Clinic Large', 'Clinic Hair & Mucota', 'Mucota Clinic ukuran rambut panjang.', 1600000.00, 90, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(46, '3x Mucota Package Small', 'Clinic Hair & Mucota', 'Paket 3 sesi Mucota Clinic Small.', 2500000.00, 75, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(47, '3x Mucota Package Medium', 'Clinic Hair & Mucota', 'Paket 3 sesi Mucota Clinic Medium.', 3000000.00, 90, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(48, '3x Mucota Package Large', 'Clinic Hair & Mucota', 'Paket 3 sesi Mucota Clinic Large.', 3500000.00, 90, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(49, '5x Mucota Package Small', 'Clinic Hair & Mucota', 'Paket 5 sesi Mucota Clinic Small.', 4000000.00, 75, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(50, '5x Mucota Package Medium', 'Clinic Hair & Mucota', 'Paket 5 sesi Mucota Clinic Medium.', 5000000.00, 90, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(51, '5x Mucota Package Large', 'Clinic Hair & Mucota', 'Paket 5 sesi Mucota Clinic Large.', 6000000.00, 90, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(52, 'Basic Scaling', 'Scalp Care', 'Membersihkan kapalan lama dan sisa buangan di atas kulit kepala.', 500000.00, 60, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(53, 'Khusus Oily, Dry & Sensitive', 'Scalp Care', 'Sistem khusus mengontrol kulit kepala oily, dry, dan ketombe.', 1000000.00, 60, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(54, 'Khusus Ketombe, Tox & Sensitif', 'Scalp Care', 'Pemberian nutrisi kulit kepala sensitif & melonggarkan peradangan.', 1000000.00, 75, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(55, 'Khusus Kerontokan - Konsentrasi Toxin', 'Scalp Care', 'Detoks & nutrisi pencegahan kerontokan.', 1200000.00, 75, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(56, 'Khusus Kerontokan - Konsentrasi Penumbuhan', 'Scalp Care', 'Nutrisi rambut tua untuk menunda kerontokan & bantu rambut baru tumbuh kuat.', 1500000.00, 90, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(57, 'Khusus Kerontokan - Konsentrasi Penguat Rambut', 'Scalp Care', 'Penguatan akar & batang rambut.', 1500000.00, 90, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(58, 'Basic Scaling 5x', 'Scalp Care', 'Paket 5 kali perawatan basic scaling.', 2500000.00, 60, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(59, 'Basic Scaling 10x + Special Gift', 'Scalp Care', 'Paket 10 kali perawatan basic scaling + hadiah spesial.', 3000000.00, 60, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(60, 'Control Perbaikan Kulit Kepala (Ketombe & Oily)', 'Scalp Care', 'Per sesi. Paket 5x: Rp 5.000.000 (1x service + produk). Paket 10x: Rp 8.000.000 (2x service + produk).', 1000000.00, 60, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(61, 'Control Konsentrasi Kulit Kepala (Kerontokan)', 'Scalp Care', 'Per sesi. Paket 5x: Rp 7.500.000 (1x service + produk). Paket 10x: Rp 11.000.000 (2x service + produk).', 1500000.00, 75, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(62, 'Basic / Blow Dry', 'Styling & Cut Package', 'Pengeringan & blow standar.', 200000.00, 45, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(63, 'Set / Wave Dry', 'Styling & Cut Package', 'Styling gelombang / curl temporary.', 300000.00, 45, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(64, 'Semi-Up Style', 'Styling & Cut Package', 'Penataan rambut setengah naik / acara santai.', 500000.00, 60, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(65, 'Up Style', 'Styling & Cut Package', 'Sanggul / penataan formal / pesta.', 800000.00, 90, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58'),
	(66, 'Cut Package (4x)', 'Styling & Cut Package', 'Paket gunting 4x. Berlaku 1 tahun, bisa ditransfer ke orang lain. Mengutamakan reservasi dahulu.', 1000000.00, 60, 'aktif', '2026-09-19 00:06:58', '2026-09-19 00:06:58');

-- Dumping data for table salon_de_lyon.users: ~0 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin Salon De Lyon', 'admin@salondelyon.test', '$2y$10$ntmdG2kA0jULhvbBIkVAOOzQlLSGm1V7QIEspVKEfgSKypERAmLr6', 'admin', 'aktif', 'qTVjY4bVBNAfuQaKDvX4TDzCEHfjsvCm9GRRE45c6Kd9VYgulLzQJSXv1EgQ', '2026-09-19 00:06:58', '2026-09-19 00:06:58');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
