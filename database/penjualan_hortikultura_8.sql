-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2021 at 03:55 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan_hortikultura`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail_transaksi` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah_beli` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail_transaksi`, `id_transaksi`, `id_user`, `id_produk`, `jumlah_beli`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 5, 82, 2, 1, '2021-11-04 07:16:33', '2021-11-04 07:16:33', NULL),
(4, 5, 82, 4, 2, '2021-11-04 07:16:33', '2021-11-04 07:16:33', NULL),
(5, 6, 82, 2, 2, '2021-11-08 06:36:09', '2021-11-08 06:36:09', NULL),
(6, 6, 82, 4, 2, '2021-11-08 06:36:09', '2021-11-08 06:36:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(120) DEFAULT NULL,
  `deskripsi_kategori` text DEFAULT NULL,
  `foto_kategori` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `deskripsi_kategori`, `foto_kategori`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Sayuran', 'merupakan jenis jenis sayuran segar', '1635886397748.jpg', '2021-10-31 07:57:51', '2021-11-02 13:53:17', NULL),
(2, 'Umbi-umbian', 'merupakan jenis tanaman umbi-umbian', '1635886517058.jpg', '2021-10-31 07:58:21', '2021-11-02 13:55:17', NULL),
(3, 'tes', 'mau diapus', NULL, '2021-10-31 08:03:17', '2021-10-31 08:03:26', '2021-10-31');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `jumlah_beli` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2021_02_23_021334__table_user_', 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `nama_produk` varchar(120) DEFAULT NULL,
  `foto_produk` varchar(120) DEFAULT NULL,
  `harga` int(11) NOT NULL DEFAULT 0,
  `stok` int(11) NOT NULL DEFAULT 0,
  `deskripsi_produk` text DEFAULT NULL,
  `cara_penyimpanan` text DEFAULT NULL,
  `diskon` int(11) DEFAULT 0,
  `manfaat_produk` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_supplier`, `id_kategori`, `nama_produk`, `foto_produk`, `harga`, `stok`, `deskripsi_produk`, `cara_penyimpanan`, `diskon`, `manfaat_produk`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Buncis', '1635742717548.jpg', 1000, 100, 'Buncis Segar', 'Di dalam tempat dingin', 20, NULL, '2021-10-31 14:58:37', '2021-11-08 06:23:32', NULL),
(2, 1, 2, 'Singkong Raja', '1635753093231.jpg', 1500, 25, 'Singkong Nya besar dan kuat', 'Di tempat bersih', 5, NULL, '2021-10-31 17:51:33', '2021-11-08 06:23:24', NULL),
(3, 1, 1, 'aa', '1635755849695.png', 222, 1111, 'aaaa', 'wwww', 0, NULL, '2021-10-31 18:37:29', '2021-10-31 18:37:41', '2021-11-01'),
(4, 1, 1, 'Sawi', '1635948615387.jpg', 3000, 50, 'Sawi Segar Pegunungan', 'di tempat dingin', 10, 'Dapat digunakan untuk sayuran segar setiap hari', '2021-11-03 07:10:15', '2021-11-08 06:23:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `created_by` int(10) NOT NULL DEFAULT 1,
  `updated_by` int(10) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'web_name', 'Ladomudo', 1, 1, NULL, NULL),
(2, 'web_url', 'https://nyantri.net/', 1, 1, NULL, NULL),
(3, 'web_description', 'Website Penjualan Hortikultura Ladomudo', 1, 1, NULL, NULL),
(4, 'web_keyword', 'Penjualan Hortikultura Ladomudo', 1, 1, NULL, NULL),
(5, 'web_owner', 'Oktavia', 1, 1, NULL, NULL),
(6, 'email', 'admin@gmail.com', 1, 1, NULL, NULL),
(7, 'telephone', '0821111222', 1, 1, NULL, NULL),
(8, 'fax', '-', 1, 1, NULL, NULL),
(9, 'address', 'Indonesia', 1, 1, NULL, NULL),
(12, 'facebook', '-', 1, 1, NULL, NULL),
(13, 'twitter', '-', 1, 1, NULL, NULL),
(14, 'instagram', '-', 1, 1, NULL, NULL),
(15, 'youtube', '-', 1, 1, NULL, NULL),
(16, '_token', '4Iry4BFQP1AoTAEc7NgU4NP7m5oWFOUqAChyjYFf', 1, 1, NULL, NULL),
(17, 'logo', 'img/1616861409198.jpg', 1, 1, NULL, NULL),
(18, 'favicon', 'img/1616861409204.jpg', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(120) NOT NULL,
  `alamat_supplier` text DEFAULT NULL,
  `phone_supplier` varchar(20) DEFAULT NULL,
  `foto_supplier` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat_supplier`, `phone_supplier`, `foto_supplier`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Kelompok Tani 1', 'Natar 2 , Lampung Selatan', '089711114445', '1636344880301.png', '2021-10-31 14:12:22', '2021-10-31 14:16:43', NULL),
(2, 'Kelompok Tani 2', 'aaaa', '028282829', NULL, '2021-10-31 14:17:09', '2021-10-31 14:17:13', '2021-11-01');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `total_harga` int(11) DEFAULT 0,
  `bukti_bayar` varchar(100) DEFAULT NULL,
  `status_transaksi` enum('Menunggu','Diproses','Selesai','Dibatalkan') NOT NULL DEFAULT 'Menunggu',
  `tanggal_kirim` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `total_harga`, `bukti_bayar`, `status_transaksi`, `tanggal_kirim`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 82, 7500, '1636119205940.jpeg', 'Diproses', '2021-11-06', '2021-11-04 07:16:33', '2021-11-05 07:31:17', NULL),
(6, 82, 8250, NULL, 'Menunggu', NULL, '2021-11-08 06:36:09', '2021-11-08 06:36:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ulasan_rating`
--

CREATE TABLE `ulasan_rating` (
  `id_ulasan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `ulasan` text DEFAULT NULL,
  `rating` int(11) NOT NULL DEFAULT 1 COMMENT 'rating 1-5',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ulasan_rating`
--

INSERT INTO `ulasan_rating` (`id_ulasan`, `id_user`, `id_produk`, `ulasan`, `rating`, `created_at`, `updated_at`) VALUES
(1, 82, 4, 'Sawi ini sangat segar ! , saya suka sekali membeli disini', 5, '2021-11-08 07:47:22', '2021-11-08 07:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_user` enum('user','admin') COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `foto`, `phone`, `alamat`, `token`, `remember_token`, `jenis_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
(27, 'admin@gmail.com', '$2y$10$1qZzCfm0vYLAivPeJdDZ0.oAeCROXA5YMMtTCgtb2aQn6oMV7461m', 'Admin Utama', 'admin.jpg', '+6281392339773', NULL, '5RBVUp6MRdN7Pkz8HFdI2g3dJrhVdw1K5VTUF5x4EeucUAAsgqLFysdoROHimlrvN19cM0tcHIXdpB48', '', 'admin', '2021-03-17 11:16:58', '2021-04-13 06:36:33', NULL),
(82, 'dekker@gmail.com', '$2y$10$R5XVGECFj40JxgsEgLvUROw/Kd5/KPG8XXC88MFy87wIwvTvpd2IS', 'Douwes Dekker', '1635175914612.jpg', '081292929292', 'Kedaton, Bandar Lampung', NULL, NULL, 'user', '2021-10-25 08:31:54', '2021-10-25 08:31:54', NULL),
(83, 'yami@gmail.com', '$2y$10$U9QlRkbAtKGzkHnTeyOsYuFigGfxrLMO1uRuX.UhJ1hJNTDIh4wPW', 'Muh Yamin', NULL, '0821121212', 'Natar , lampung Selatan', NULL, NULL, 'user', '2021-11-04 08:00:59', '2021-11-04 08:00:59', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `ulasan_rating`
--
ALTER TABLE `ulasan_rating`
  ADD PRIMARY KEY (`id_ulasan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ulasan_rating`
--
ALTER TABLE `ulasan_rating`
  MODIFY `id_ulasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
