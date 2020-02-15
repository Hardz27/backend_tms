-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 15, 2020 at 12:23 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nm_admin` varchar(20) NOT NULL,
  `no_hp_admin` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nm_admin`, `no_hp_admin`) VALUES
(1, 'Sofyan Maulana', '0895334623006');

-- --------------------------------------------------------

--
-- Table structure for table `cv_jobseeker`
--

CREATE TABLE `cv_jobseeker` (
  `id_cv_jobseeker` int(11) NOT NULL,
  `file_cv_jobseeker` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cv_jobseeker`
--

INSERT INTO `cv_jobseeker` (`id_cv_jobseeker`, `file_cv_jobseeker`) VALUES
(2, 'CV_Hilmi_Aan_Putra.pdf'),
(4, 'Hardiansyah Maulana.pdf'),
(5, 'Sofyan Maulana.pdf'),
(6, 'Hardiansyah Maulana.pdf'),
(7, 'Hilmi Aan.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `id_jawaban` int(11) NOT NULL,
  `jawaban` varchar(500) NOT NULL,
  `id_soal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id_jawaban`, `jawaban`, `id_soal`) VALUES
(26, 'C++', 14),
(27, 'JavaScript', 14),
(28, 'PHP', 14),
(29, 'Python', 14),
(30, 'Create Semi Recursive Force', 15),
(31, 'Membuat token pada form', 15),
(32, 'Membuat tampilan laravel lebih menarik', 15),
(33, 'Tidak tahu', 15),
(34, 'Ya A', 16),
(35, 'Ini Jawabannya', 16),
(36, 'Ini C', 16),
(37, 'ini D', 16),
(38, 'RN A', 17),
(39, 'RN B', 17),
(40, 'RN C', 17),
(41, 'ini jawabannya', 17),
(42, 'Bahasa Pemrograman', 18),
(43, 'Framework', 18),
(44, 'Aplikasi Interpreter', 18),
(45, 'Aplikasi Editor', 18),
(46, 'JavaScript', 19),
(47, 'Java', 19),
(48, 'Python', 19),
(49, 'Semua salah', 19),
(50, '5.4', 20),
(51, '6.0', 20),
(52, '5.8', 20),
(53, '5.6', 20),
(54, 'Model View Controller', 21),
(55, 'Model Viva Contoh', 21),
(56, 'Miu Value Code', 21),
(57, 'Margin interVal Correction', 21);

-- --------------------------------------------------------

--
-- Table structure for table `jobseeker`
--

CREATE TABLE `jobseeker` (
  `id_jobseeker` int(11) NOT NULL,
  `nm_jobseeker` varchar(20) NOT NULL,
  `email_jobseeker` varchar(255) NOT NULL,
  `password_jobseeker` varchar(255) NOT NULL,
  `tgl_lahir_jobseeker` varchar(10) NOT NULL,
  `jk_jobseeker` varchar(10) NOT NULL,
  `alamat_jobseeker` varchar(50) NOT NULL,
  `no_hp_jobseeker` varchar(14) NOT NULL,
  `id_cv_jobseeker` int(11) DEFAULT NULL,
  `images` varchar(50) DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobseeker`
--

INSERT INTO `jobseeker` (`id_jobseeker`, `nm_jobseeker`, `email_jobseeker`, `password_jobseeker`, `tgl_lahir_jobseeker`, `jk_jobseeker`, `alamat_jobseeker`, `no_hp_jobseeker`, `id_cv_jobseeker`, `images`, `id_perusahaan`) VALUES
(1, 'Hilmi Aan Putra', 'hilmi@gmail.com', 'hilmi275', '12-12-1998', 'Pria', 'cari ajalah sendiir, lupa ding', '089999888777', 7, NULL, NULL),
(2, 'Sofyan Maulana', 'maulana27051998@gmail.com', 'hardianz7', '22-02-1994', 'Pria', 'Balongan', '0895334623006', 5, NULL, 1),
(4, 'Hardiansyah Maulana', 'hardz@gmail.com', 'hardianz7', '12-12-1992', 'Pria', 'Balunjan', '089999999999', 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_soal`
--

CREATE TABLE `kategori_soal` (
  `id_kategori_soal` int(11) NOT NULL,
  `tag_soal` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_soal`
--

INSERT INTO `kategori_soal` (`id_kategori_soal`, `tag_soal`, `created_at`, `updated_at`, `updated_by`) VALUES
(1, 'Laravel', '2020-01-28 17:00:00', '2020-01-28 17:00:00', 'Sofyan Maulana'),
(2, 'Code Igniter', '2020-01-28 17:00:00', '2020-01-28 17:00:00', 'Sofyan Maulana'),
(3, 'React Native', '2020-01-28 17:00:00', '2020-01-28 17:00:00', 'Sofyan Maulana'),
(4, 'Flutter', '2020-02-11 21:34:15', '2020-02-11 21:34:15', 'Sofyan Maulana');

-- --------------------------------------------------------

--
-- Table structure for table `kompetensi`
--

CREATE TABLE `kompetensi` (
  `id_kompetensi` int(11) NOT NULL,
  `id_jobseeker` int(11) DEFAULT NULL,
  `id_kategori_soal` int(11) NOT NULL,
  `skor` varchar(5) DEFAULT NULL,
  `id_kebutuhan_skill` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kompetensi`
--

INSERT INTO `kompetensi` (`id_kompetensi`, `id_jobseeker`, `id_kategori_soal`, `skor`, `id_kebutuhan_skill`) VALUES
(1, 1, 2, '90', NULL),
(2, 1, 1, '70', NULL),
(3, NULL, 1, NULL, 1),
(4, NULL, 2, NULL, 1),
(5, NULL, 3, NULL, 1),
(6, NULL, 3, NULL, 2),
(7, NULL, 3, NULL, 3),
(11, 2, 3, '100', NULL),
(13, 4, 1, '50.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kunci_jawaban`
--

CREATE TABLE `kunci_jawaban` (
  `id_kunci_jawaban` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `jawaban_id_jawaban` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kunci_jawaban`
--

INSERT INTO `kunci_jawaban` (`id_kunci_jawaban`, `id_soal`, `jawaban_id_jawaban`) VALUES
(4, 14, 28),
(5, 15, 31),
(6, 16, 35),
(7, 17, 41),
(8, 19, 46),
(9, 18, 43),
(10, 20, 51),
(11, 21, 54);

-- --------------------------------------------------------

--
-- Table structure for table `loker`
--

CREATE TABLE `loker` (
  `id_loker` int(11) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `judul_loker` varchar(40) NOT NULL,
  `deskripsi_loker` varchar(500) NOT NULL,
  `id_kebutuhan_skill` int(11) DEFAULT NULL,
  `status_loker` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `due_date` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loker`
--

INSERT INTO `loker` (`id_loker`, `id_perusahaan`, `judul_loker`, `deskripsi_loker`, `id_kebutuhan_skill`, `status_loker`, `created_at`, `updated_at`, `due_date`) VALUES
(1, 1, 'Web Developer', 'Yaa ngembangin Web intinya', 1, 'open', '2020-02-05 17:00:00', '2020-02-05 17:00:00', '06-03-2020'),
(2, 1, 'Android Developer', 'Harus dikasih tau lagi kah? -_', 2, 'Open', '2020-02-05 17:00:00', '2020-02-05 17:00:00', '26-02-2020'),
(3, 2, 'Android Developer', 'Ngebangin Android Pake otaq', 3, 'Open', '2020-02-05 17:00:00', '2020-02-05 17:00:00', '20-02-2020');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_02_05_041218_add_email_password_jobseeker_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penyaluran`
--

CREATE TABLE `penyaluran` (
  `id_penyaluran` int(11) NOT NULL,
  `id_jobseeker` int(11) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `id_loker` int(11) NOT NULL,
  `status_penyaluran` varchar(20) NOT NULL,
  `kebutuhan_skill` varchar(35) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyaluran`
--

INSERT INTO `penyaluran` (`id_penyaluran`, `id_jobseeker`, `id_perusahaan`, `id_loker`, `status_penyaluran`, `kebutuhan_skill`, `created_at`, `updated_at`) VALUES
(6, 2, 1, 1, 'Dikirim', 'React Native', '2020-02-11 00:46:35', '2020-02-11 00:46:35'),
(7, 2, 1, 2, 'Dikirim', 'React Native', '2020-02-11 00:46:35', '2020-02-11 00:46:35'),
(8, 2, 2, 3, 'Dikirim', 'React Native', '2020-02-11 00:46:35', '2020-02-11 00:46:35'),
(9, 1, 1, 1, 'Dikirim', 'Laravel', '2020-02-09 00:47:07', '2020-02-11 00:47:07'),
(10, 1, 1, 1, 'Dikirim', 'Laravel', '2020-02-14 06:16:50', '2020-02-14 06:16:50'),
(11, 1, 1, 1, 'Dikirim', 'Code Igniter', '2020-02-14 06:16:50', '2020-02-14 06:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id_perusahaan` int(11) NOT NULL,
  `nm_perusahaan` varchar(50) NOT NULL,
  `nm_hrd_perusahaan` varchar(20) NOT NULL,
  `no_hp_perusahaan` varchar(14) NOT NULL,
  `alamat_perusahaan` varchar(50) NOT NULL,
  `bidang_perusahaan` varchar(50) NOT NULL,
  `email_perusahaan` varchar(25) NOT NULL,
  `password_perusahaan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`id_perusahaan`, `nm_perusahaan`, `nm_hrd_perusahaan`, `no_hp_perusahaan`, `alamat_perusahaan`, `bidang_perusahaan`, `email_perusahaan`, `password_perusahaan`) VALUES
(1, 'Google .inc', 'Hardianz', '0895334623006', 'Florida, Korea Utara', 'IT', 'hardianz@gmail.com', 'hardianz7'),
(2, 'Facebook .inc', 'Mark Zuck Madick', '0894623662008', 'Samping bundaran HI, Pakistan', 'IT', 'mark@facebook.com', 'hardianz7');

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id_soal` int(11) NOT NULL,
  `soal` varchar(500) NOT NULL,
  `id_kategori_soal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id_soal`, `soal`, `id_kategori_soal`) VALUES
(14, 'Laravel termasuk framework pengembangan dari bahasa.. ?', 1),
(15, 'Apa fungsi dari CSRF?', 1),
(16, 'Pertanyaan tentang CI', 2),
(17, 'Pertanyaan tentang RN', 3),
(18, 'Code Igniter merupakan..', 2),
(19, 'FLutter termasuk framework berbahasa?', 4),
(20, 'Laravel Versi terbaru adalah', 1),
(21, 'MVC adalah ?', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `cv_jobseeker`
--
ALTER TABLE `cv_jobseeker`
  ADD PRIMARY KEY (`id_cv_jobseeker`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `join_jawaban_dengan_soal` (`id_soal`);

--
-- Indexes for table `jobseeker`
--
ALTER TABLE `jobseeker`
  ADD PRIMARY KEY (`id_jobseeker`),
  ADD KEY `cv_join` (`id_cv_jobseeker`),
  ADD KEY `jobseeker_id_perusahaan_foreign` (`id_perusahaan`);

--
-- Indexes for table `kategori_soal`
--
ALTER TABLE `kategori_soal`
  ADD PRIMARY KEY (`id_kategori_soal`);

--
-- Indexes for table `kompetensi`
--
ALTER TABLE `kompetensi`
  ADD PRIMARY KEY (`id_kompetensi`),
  ADD KEY `kompetensi_id_kategori_soal_foreign` (`id_kategori_soal`),
  ADD KEY `kompetensi_id_jobseeker_foreign` (`id_jobseeker`);

--
-- Indexes for table `kunci_jawaban`
--
ALTER TABLE `kunci_jawaban`
  ADD PRIMARY KEY (`id_kunci_jawaban`),
  ADD KEY `join_jawaban_soal_dan_kunci` (`id_soal`);

--
-- Indexes for table `loker`
--
ALTER TABLE `loker`
  ADD PRIMARY KEY (`id_loker`),
  ADD KEY `loker_id_perushaan_foreign` (`id_perusahaan`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `penyaluran`
--
ALTER TABLE `penyaluran`
  ADD PRIMARY KEY (`id_penyaluran`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `soal_join` (`id_kategori_soal`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cv_jobseeker`
--
ALTER TABLE `cv_jobseeker`
  MODIFY `id_cv_jobseeker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `jobseeker`
--
ALTER TABLE `jobseeker`
  MODIFY `id_jobseeker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori_soal`
--
ALTER TABLE `kategori_soal`
  MODIFY `id_kategori_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kompetensi`
--
ALTER TABLE `kompetensi`
  MODIFY `id_kompetensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kunci_jawaban`
--
ALTER TABLE `kunci_jawaban`
  MODIFY `id_kunci_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `loker`
--
ALTER TABLE `loker`
  MODIFY `id_loker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penyaluran`
--
ALTER TABLE `penyaluran`
  MODIFY `id_penyaluran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `join_jawaban_dengan_soal` FOREIGN KEY (`id_soal`) REFERENCES `soal` (`id_soal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jobseeker`
--
ALTER TABLE `jobseeker`
  ADD CONSTRAINT `cv_join` FOREIGN KEY (`id_cv_jobseeker`) REFERENCES `cv_jobseeker` (`id_cv_jobseeker`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jobseeker_id_perusahaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaan` (`id_perusahaan`);

--
-- Constraints for table `kompetensi`
--
ALTER TABLE `kompetensi`
  ADD CONSTRAINT `kompetensi_id_jobseeker_foreign` FOREIGN KEY (`id_jobseeker`) REFERENCES `jobseeker` (`id_jobseeker`),
  ADD CONSTRAINT `kompetensi_id_kategori_soal_foreign` FOREIGN KEY (`id_kategori_soal`) REFERENCES `kategori_soal` (`id_kategori_soal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kunci_jawaban`
--
ALTER TABLE `kunci_jawaban`
  ADD CONSTRAINT `join_jawaban_soal_dan_kunci` FOREIGN KEY (`id_soal`) REFERENCES `soal` (`id_soal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `loker`
--
ALTER TABLE `loker`
  ADD CONSTRAINT `loker_id_perushaan_foreign` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaan` (`id_perusahaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `soal`
--
ALTER TABLE `soal`
  ADD CONSTRAINT `soal_join` FOREIGN KEY (`id_kategori_soal`) REFERENCES `kategori_soal` (`id_kategori_soal`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
