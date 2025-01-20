-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2025 at 05:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipkd_balatkop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_subkegiatan`
--

CREATE TABLE `detail_subkegiatan` (
  `id_subdet` varchar(15) NOT NULL,
  `kode_sub_kegiatan` varchar(50) NOT NULL,
  `kode_rekening` varchar(50) NOT NULL,
  `pagu_subdet` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_subkegiatan`
--

INSERT INTO `detail_subkegiatan` (`id_subdet`, `kode_sub_kegiatan`, `kode_rekening`, `pagu_subdet`) VALUES
('SUB0001', '2.17.01.1.01.0006', '5.1.01.03.07.0001', 1000000),
('SUB0002', '2.17.01.1.01.0006', '5.1.01.03.08.0002', 5000),
('SUB0003', '2.17.01.1.01.0006', '5.1.02.01.01.0024', 5000),
('SUB0004', '2.17.01.1.01.0006', '5.1.02.01.01.0025', 100000000);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `kode_kegiatan` varchar(25) NOT NULL,
  `nama_kegiatan` varchar(75) NOT NULL,
  `pagu_kegiatan` int(15) NOT NULL,
  `kode_program` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`kode_kegiatan`, `nama_kegiatan`, `pagu_kegiatan`, `kode_program`) VALUES
('2.17.01.1.01', 'Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', 68331700, '2.17.01'),
('2.17.01.1.02', 'Administrasi Keuangan Perangkat Daerah', 124707500, '2.17.01'),
('2.17.01.1.05', 'Administrasi Kepegawaian Perangkat Daerah', 259120000, '2.17.01');

-- --------------------------------------------------------

--
-- Table structure for table `kode_rekening`
--

CREATE TABLE `kode_rekening` (
  `kode_rekening` varchar(17) NOT NULL,
  `nama_rekening` varchar(140) NOT NULL,
  `keterangan_rekening` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kode_rekening`
--

INSERT INTO `kode_rekening` (`kode_rekening`, `nama_rekening`, `keterangan_rekening`) VALUES
('5.1.01.03.07.0001', 'Belanja Honorarium Penanggungjawaban Pengelola Keuangan', 'Honorarium KPA, PPTK, Dll'),
('5.1.01.03.08.0002', 'Belanja Jasa Pengelolaan BMD yang Tidak Menghasilkan Pendapatan', 'Honorarium Pengurus Barang'),
('5.1.02.01.01.0024', 'Belanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor', 'ATK'),
('5.1.02.01.01.0025', 'Belanja Alat/Bahan untuk Kegiatan Kantor- Kertas dan Cover', 'Kertas dan Cover'),
('5.1.02.01.01.0029', 'Belanja Alat/Bahan untuk Kegiatan Kantor-Bahan Komputer', 'Belanja Bahan Komputer'),
('5.1.02.01.01.0052', 'Belanja Makanan dan Minuman Rapat', 'Makan Minum Rapat'),
('5.1.02.02.01.0027', 'Belanja Jasa Tenaga Operator Komputer', 'Operator Keuangan'),
('5.1.02.02.02.0005', 'Belanja Iuran Jaminan Kesehatan bagi Non ASN', 'Iuran BPJS Kesehatan Non ASN'),
('5.1.02.02.02.0006', 'Belanja Iuran Jaminan Kecelakaan Kerja bagi Non ASN', 'Jaminan Kecelakaan Kerja bagi Non ASN'),
('5.1.02.02.02.0007', 'Belanja Iuran Jaminan Kematian bagi Non ASN', 'Iuran Jaminan Kematian bagi Non ASN');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pejabat_pelaksana`
--

CREATE TABLE `pejabat_pelaksana` (
  `id_pejabat` int(11) NOT NULL,
  `nama_pejabat` varchar(70) NOT NULL,
  `nip_pejabat` varchar(25) NOT NULL,
  `pelaksana_pejabat` varchar(50) NOT NULL,
  `jabatan_pejabat` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pejabat_pelaksana`
--

INSERT INTO `pejabat_pelaksana` (`id_pejabat`, `nama_pejabat`, `nip_pejabat`, `pelaksana_pejabat`, `jabatan_pejabat`) VALUES
(1, 'Lanang Budi Wibowo, MP', '19670712 199603 1 004', 'Kuasa Pengguna Anggaran', 'Kepala Balai'),
(2, 'Ernita Sarmini, SE. M.Pd                               ', '19700902 199303 2 007', 'PPTK', 'Kasubbag Tata Usaha'),
(3, 'Muhammad Husni, S.IP                             ', '19691010 199403 1 012', 'PPTK', 'Kasi Diklat SDM Koperasi'),
(4, 'Rohadi Nursetya W, S.Kom', '19840422 201001 1 005', 'PPTK', 'Staf Diklat SDM UMKM'),
(5, 'Muhammad Satria Ardanias, S.Kom., MM', '19851214 200903 1 003', 'Bendahara Pengeluaran Pembantu', 'Staf');

-- --------------------------------------------------------

--
-- Table structure for table `penyedia`
--

CREATE TABLE `penyedia` (
  `id_penyedia` int(4) NOT NULL,
  `nama` varchar(70) NOT NULL,
  `nip` varchar(24) DEFAULT NULL,
  `npwp` varchar(24) DEFAULT NULL,
  `no_rekening` varchar(30) DEFAULT NULL,
  `keterangan` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyedia`
--

INSERT INTO `penyedia` (`id_penyedia`, `nama`, `nip`, `npwp`, `no_rekening`, `keterangan`) VALUES
(6, 'Lanang Budi Wibowo, MP', '19670712 199603 1 004', '1', '123', 'Kepala Balai'),
(7, 'Dio', '0', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `kode_program` varchar(8) NOT NULL,
  `nama_program` varchar(75) NOT NULL,
  `pagu_program` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`kode_program`, `nama_program`, `pagu_program`) VALUES
('2.17.01', 'Program Penunjang Urusan Pemerintah Daerah', 7134000000),
('2.17.05', 'Program Pendidikan dan Latihan Perkoperasian', 1548000000),
('2.17.07', 'Program Pemberdayaan Usaha Menengah, Usaha Kecil, dan Usaha Mikro (UMKM)', 1982000000);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0HMSySnbYxRdQ2eM2xA9gQsBdJFzcyBxd2sjib6L', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiT1IyVXQ1c2EzeHVPZ3JLSlBZTFNYYmpObjBGU3pHVmJUWGl3R1JKUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1737389633);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kegiatan`
--

CREATE TABLE `sub_kegiatan` (
  `kode_sub_kegiatan` varchar(30) NOT NULL,
  `nama_sub_kegiatan` varchar(150) NOT NULL,
  `pagu_sub_kegiatan` double NOT NULL,
  `kode_kegiatan` varchar(15) NOT NULL,
  `id_pejabat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_kegiatan`
--

INSERT INTO `sub_kegiatan` (`kode_sub_kegiatan`, `nama_sub_kegiatan`, `pagu_sub_kegiatan`, `kode_kegiatan`, `id_pejabat`) VALUES
('2.17.01.1.02.0002', 'Penyediaan Administrasi Pelaksanaan Tugas ASN', 124707500, '2.17.01.1.02', 2),
('2.17.01.1.02.0004', 'Koordinasi dan Pelaksanaan Akuntansi SKPD', 53300400, '2.17.01.1.02', 2),
('2.17.01.1.05.0009', 'Pendidikan dan Pelatihan Pegawai Berdasarkan Tugas dan Fungsi', 259120000, '2.17.01.1.05', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `nip` varchar(30) DEFAULT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `pangkat_golongan` int(11) NOT NULL,
  `jabatan` int(11) NOT NULL,
  `no_telp` int(15) DEFAULT NULL,
  `usertype` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `nip`, `tempat_lahir`, `tgl_lahir`, `pangkat_golongan`, `jabatan`, `no_telp`, `usertype`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Asfarrian', '20000514 202421 1 003', 'Tanah Laut', '2000-05-14', 9, 9, NULL, 'admin', 'asfarrian', NULL, '$2y$12$HCenGFMWvfdJ74Y78sKVbeXgiZrdLg2ANWj1KIcVM3AUbqRmsConq', NULL, NULL, '2024-11-13 23:03:39'),
(2, 'Dio', '0', 'Banjarmasin', '2024-11-21', 0, 0, 1234567, 'user', 'aa', NULL, '$2y$12$uKTJ1TzYlsF.FQe58ARaMuQNuQneKa53CzfNltPka5B41iplDckWW', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `detail_subkegiatan`
--
ALTER TABLE `detail_subkegiatan`
  ADD PRIMARY KEY (`id_subdet`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`kode_kegiatan`);

--
-- Indexes for table `kode_rekening`
--
ALTER TABLE `kode_rekening`
  ADD PRIMARY KEY (`kode_rekening`) USING BTREE;

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pejabat_pelaksana`
--
ALTER TABLE `pejabat_pelaksana`
  ADD PRIMARY KEY (`id_pejabat`);

--
-- Indexes for table `penyedia`
--
ALTER TABLE `penyedia`
  ADD PRIMARY KEY (`id_penyedia`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`kode_program`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sub_kegiatan`
--
ALTER TABLE `sub_kegiatan`
  ADD PRIMARY KEY (`kode_sub_kegiatan`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pejabat_pelaksana`
--
ALTER TABLE `pejabat_pelaksana`
  MODIFY `id_pejabat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `penyedia`
--
ALTER TABLE `penyedia`
  MODIFY `id_penyedia` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
