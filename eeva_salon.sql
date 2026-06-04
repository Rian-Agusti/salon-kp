-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20251121.233dc54ce8
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 04, 2026 at 04:13 AM
-- Server version: 9.7.0
-- PHP Version: 8.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eeva_salon`
--

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` enum('hair','facial','coloring','other') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'other',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Galeri foto portofolio hasil treatment';

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(170) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `stock` smallint UNSIGNED NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Produk perawatan yang dijual salon';

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `price`, `stock`, `image`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pikaru Keratin Anti Frizz', 'pikaru-keratin-anti-frizz', 'Perawatan keratin rambut anti frizz asal Korea', 280000.00, 20, NULL, 1, '2026-06-04 03:32:33', '2026-06-04 03:32:33', NULL),
(2, 'Pikaru Keratin Treatment', 'pikaru-keratin-treatment', 'Treatment keratin intensif Pikaru', 350000.00, 15, NULL, 1, '2026-06-04 03:32:33', '2026-06-04 03:32:33', NULL),
(3, 'Pikaru Hair Serum', 'pikaru-hair-serum', 'Serum rambut Pikaru untuk rambut berkilau', 150000.00, 30, NULL, 1, '2026-06-04 03:32:33', '2026-06-04 03:32:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Promosi dan penawaran khusus salon';

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `title`, `description`, `image`, `start_date`, `end_date`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Happy Hour — Diskon 50%', 'Diskon 50% untuk semua layanan hair treatment setiap hari pukul 10.00–12.00', NULL, '2025-01-01', '2025-12-31', 1, '2026-06-04 03:32:33', '2026-06-04 03:32:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `reservation_code` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Contoh: REV-20250615-0001',
  `booking_date` date NOT NULL,
  `booking_time` time NOT NULL,
  `status` enum('pending','confirmed','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Header reservasi layanan pelanggan';

-- --------------------------------------------------------

--
-- Table structure for table `reservation_items`
--

CREATE TABLE `reservation_items` (
  `id` bigint UNSIGNED NOT NULL,
  `reservation_id` bigint UNSIGNED NOT NULL,
  `service_id` bigint UNSIGNED NOT NULL COMMENT 'Referensi ke services (soft-delete safe)',
  `service_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nama layanan saat reservasi dibuat',
  `service_price` decimal(12,2) NOT NULL COMMENT 'Harga layanan saat reservasi dibuat',
  `service_duration` smallint UNSIGNED NOT NULL COMMENT 'Durasi (menit) saat reservasi dibuat',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Item layanan per reservasi — dengan snapshot harga';

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(170) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `duration_minutes` smallint UNSIGNED NOT NULL DEFAULT '60',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'SoftDelete — baris tidak dihapus fisik'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Katalog layanan salon';

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `slug`, `description`, `price`, `duration_minutes`, `image`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hair Spa', 'hair-spa', 'Perawatan rambut dengan masker intensif', 85000.00, 60, NULL, 1, '2026-06-04 03:32:32', '2026-06-04 03:32:32', NULL),
(2, 'Creambath', 'creambath', 'Creambath dengan vitamin rambut', 100000.00, 75, NULL, 1, '2026-06-04 03:32:32', '2026-06-04 03:32:32', NULL),
(3, 'Hair Treatment', 'hair-treatment', 'Treatment rambut rusak & rontok', 150000.00, 90, NULL, 1, '2026-06-04 03:32:32', '2026-06-04 03:32:32', NULL),
(4, 'Smoothing Pendek', 'smoothing-pendek', 'Smoothing untuk rambut pendek', 300000.00, 120, NULL, 1, '2026-06-04 03:32:32', '2026-06-04 03:32:32', NULL),
(5, 'Smoothing Panjang', 'smoothing-panjang', 'Smoothing untuk rambut panjang', 400000.00, 150, NULL, 1, '2026-06-04 03:32:32', '2026-06-04 03:32:32', NULL),
(6, 'Colouring Full', 'colouring-full', 'Pewarnaan rambut penuh satu warna', 250000.00, 120, NULL, 1, '2026-06-04 03:32:32', '2026-06-04 03:32:32', NULL),
(7, 'Highlights', 'highlights', 'Pewarnaan sebagian rambut', 350000.00, 150, NULL, 1, '2026-06-04 03:32:32', '2026-06-04 03:32:32', NULL),
(8, 'Facial Basic', 'facial-basic', 'Perawatan wajah dasar', 100000.00, 60, NULL, 1, '2026-06-04 03:32:32', '2026-06-04 03:32:32', NULL),
(9, 'Totok Wajah', 'totok-wajah', 'Pijat relaksasi totok wajah', 80000.00, 45, NULL, 1, '2026-06-04 03:32:32', '2026-06-04 03:32:32', NULL),
(10, 'Manicure', 'manicure', 'Perawatan kuku tangan', 60000.00, 45, NULL, 1, '2026-06-04 03:32:32', '2026-06-04 03:32:32', NULL),
(11, 'Pedicure', 'pedicure', 'Perawatan kuku kaki', 70000.00, 45, NULL, 1, '2026-06-04 03:32:32', '2026-06-04 03:32:32', NULL),
(12, 'Manicure + Pedicure', 'manicure-pedicure', 'Paket perawatan kuku tangan dan kaki', 120000.00, 80, NULL, 1, '2026-06-04 03:32:32', '2026-06-04 03:32:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `salon_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Eeva Hair & Beauty Salon',
  `address` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiktok` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_maps` text COLLATE utf8mb4_unicode_ci COMMENT 'Embed URL Google Maps',
  `opening_hour` time NOT NULL DEFAULT '09:00:00',
  `closing_hour` time NOT NULL DEFAULT '19:00:00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Pengaturan website — hanya satu record (id=1)';

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `salon_name`, `address`, `phone`, `email`, `instagram`, `facebook`, `tiktok`, `google_maps`, `opening_hour`, `closing_hour`, `created_at`, `updated_at`) VALUES
(1, 'Eeva Hair & Beauty Salon', 'Jl. Raya Pondok Aren No.74, Pondok Aren, Kota Tangerang Selatan, Banten 15224', '0812-1111-6051', 'eeva.salon@gmail.com', '@eevasalon', NULL, NULL, NULL, '09:00:00', '19:00:00', '2026-06-04 03:32:33', '2026-06-04 03:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Akun pengguna (customer) dan admin';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_galleries_category` (`category`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_products_slug` (`slug`),
  ADD KEY `idx_products_active` (`is_active`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_promotions_dates` (`start_date`,`end_date`),
  ADD KEY `idx_promotions_active` (`is_active`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_reservations_code` (`reservation_code`),
  ADD KEY `idx_reservations_user` (`user_id`),
  ADD KEY `idx_reservations_date` (`booking_date`),
  ADD KEY `idx_reservations_status` (`status`);

--
-- Indexes for table `reservation_items`
--
ALTER TABLE `reservation_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_items_reservation` (`reservation_id`),
  ADD KEY `idx_items_service` (`service_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_services_slug` (`slug`),
  ADD KEY `idx_services_active` (`is_active`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_users_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation_items`
--
ALTER TABLE `reservation_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_reservations_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `reservation_items`
--
ALTER TABLE `reservation_items`
  ADD CONSTRAINT `fk_items_reservation` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_items_service` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
