-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2021 at 07:02 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unkos`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_fasilitas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id`, `nama_fasilitas`, `created_at`, `updated_at`) VALUES
(1, 'AC', '2020-11-07 09:34:34', '2020-11-07 09:34:34'),
(2, 'Parkiran', '2020-11-07 09:34:42', '2020-11-07 09:34:42'),
(3, 'Lemari', '2020-11-07 09:34:48', '2020-11-07 09:34:48'),
(4, 'Kulkas', '2020-11-07 09:34:54', '2021-07-03 13:58:38');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_kos`
--

CREATE TABLE `fasilitas_kos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kos` bigint(20) UNSIGNED NOT NULL,
  `id_fasilitas` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fasilitas_kos`
--

INSERT INTO `fasilitas_kos` (`id`, `id_kos`, `id_fasilitas`, `created_at`, `updated_at`) VALUES
(5, 2, 3, NULL, NULL),
(6, 3, 2, NULL, NULL),
(7, 3, 3, NULL, NULL),
(8, 4, 1, NULL, NULL),
(9, 4, 2, NULL, NULL),
(11, 5, 2, NULL, NULL),
(14, 6, 1, NULL, NULL),
(52, 19, 2, NULL, NULL),
(53, 20, 1, NULL, NULL),
(54, 20, 2, NULL, NULL),
(55, 20, 3, NULL, NULL),
(56, 20, 4, NULL, NULL),
(57, 5, 1, NULL, NULL),
(58, 21, 2, NULL, NULL),
(59, 21, 3, NULL, NULL),
(60, 22, 2, NULL, NULL),
(61, 22, 3, NULL, NULL),
(62, 23, 2, NULL, NULL),
(63, 23, 3, NULL, NULL),
(64, 24, 3, NULL, NULL),
(65, 24, 4, NULL, NULL),
(66, 25, 2, NULL, NULL),
(67, 25, 3, NULL, NULL),
(68, 25, 4, NULL, NULL),
(69, 26, 2, NULL, NULL),
(70, 26, 3, NULL, NULL),
(71, 27, 2, NULL, NULL),
(72, 27, 3, NULL, NULL),
(73, 28, 3, NULL, NULL),
(74, 28, 4, NULL, NULL),
(82, 30, 1, NULL, NULL),
(83, 29, 1, NULL, NULL),
(84, 29, 2, NULL, NULL),
(95, 36, 2, NULL, NULL),
(96, 36, 3, NULL, NULL),
(97, 37, 2, NULL, NULL),
(98, 37, 3, NULL, NULL),
(99, 37, 4, NULL, NULL),
(100, 38, 2, NULL, NULL),
(101, 38, 3, NULL, NULL),
(102, 38, 4, NULL, NULL),
(103, 39, 2, NULL, NULL),
(104, 39, 3, NULL, NULL),
(105, 40, 3, NULL, NULL),
(106, 41, 2, NULL, NULL),
(107, 41, 3, NULL, NULL),
(108, 42, 3, NULL, NULL),
(109, 43, 2, NULL, NULL),
(110, 43, 3, NULL, NULL),
(111, 44, 1, NULL, NULL),
(112, 44, 2, NULL, NULL),
(113, 44, 3, NULL, NULL),
(114, 44, 4, NULL, NULL),
(115, 45, 1, NULL, NULL),
(116, 45, 2, NULL, NULL),
(117, 45, 3, NULL, NULL),
(118, 45, 4, NULL, NULL),
(119, 46, 2, NULL, NULL),
(120, 46, 3, NULL, NULL),
(121, 47, 2, NULL, NULL),
(122, 47, 3, NULL, NULL),
(123, 47, 4, NULL, NULL),
(124, 48, 1, NULL, NULL),
(125, 48, 3, NULL, NULL),
(126, 48, 4, NULL, NULL),
(127, 49, 2, NULL, NULL),
(128, 49, 3, NULL, NULL),
(129, 50, 2, NULL, NULL),
(130, 50, 3, NULL, NULL),
(131, 51, 2, NULL, NULL),
(132, 51, 3, NULL, NULL),
(133, 51, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gambars`
--

CREATE TABLE `gambars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kamar` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gambars`
--

INSERT INTO `gambars` (`id`, `nama`, `id_kamar`, `created_at`, `updated_at`) VALUES
(75, 'pattayas-070705100-1623808404.PNG', 36, '2021-06-15 18:53:25', '2021-06-15 18:53:25'),
(76, 'pattayas-026782900-1623808405.PNG', 36, '2021-06-15 18:53:25', '2021-06-15 18:53:25'),
(77, 'pattayas-036787700-1623808405.jpg', 36, '2021-06-15 18:53:25', '2021-06-15 18:53:25'),
(78, 'pattayas-042962800-1623808405.jpg', 36, '2021-06-15 18:53:25', '2021-06-15 18:53:25'),
(84, 'kostan-putri-8-019500600-1625387506.jpg', 39, '2021-07-04 01:31:46', '2021-07-04 01:31:46'),
(85, 'kostan-putri-8-059368500-1625387545.PNG', 40, '2021-07-04 01:32:25', '2021-07-04 01:32:25'),
(86, 'kostan-putri-8-069409100-1625387545.jpg', 40, '2021-07-04 01:32:25', '2021-07-04 01:32:25');

-- --------------------------------------------------------

--
-- Table structure for table `kamars`
--

CREATE TABLE `kamars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `desc_kamar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slot` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'F',
  `id_kos` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kamars`
--

INSERT INTO `kamars` (`id`, `desc_kamar`, `slot`, `id_kos`, `created_at`, `updated_at`) VALUES
(36, 'fcefefe', 'F', 6, '2021-06-15 18:53:24', '2021-06-15 18:53:24'),
(39, 'kamar 1', 'F', 51, '2021-07-04 01:31:45', '2021-07-04 01:31:45'),
(40, 'Kamar 2', 'T', 51, '2021-07-04 01:32:25', '2021-07-04 01:32:53');

-- --------------------------------------------------------

--
-- Table structure for table `kos`
--

CREATE TABLE `kos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_kos` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `harga` bigint(20) NOT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `id_pemilik` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kos`
--

INSERT INTO `kos` (`id`, `title`, `desc_kos`, `gambar`, `harga`, `lat`, `lng`, `id_pemilik`, `created_at`, `updated_at`) VALUES
(2, 'Kantin Surabaya', 'Jl. Meruya selatan rt001 rw08 no.6, RT.1/RW.8, Meruya Sel., Kec. Kembangan, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11650,\r\n\r\nkos2an dekat dengan universitas mercubuana', '-1604822169-.jfif', 850000, -6.210877103114441, 106.73778365249314, 1, '2020-11-08 00:56:10', '2020-11-08 00:56:10'),
(3, 'BWYI Futsal', 'Jl. Meruya Selatan No.111, Jl. Meruya Selatan No.RT.07, RT.10/RW.4, Meruya Sel., Kec. Kembangan, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11640', '-1604825468-.jfif', 1200000, -6.210589227742858, 106.73780267170804, 1, '2020-11-08 01:51:08', '2020-11-08 01:51:08'),
(4, 'OMAH KOS DPA', 'Jalan H.Juhri', '-1607873040-.jfif', 700000, -6.21017061267942, 106.73274463032493, 1, '2020-12-13 08:24:00', '2020-12-13 08:24:00'),
(5, 'Kos Putri KESHA', 'Jalan H. Juhri', '-1607873448-.jfif', 900000, -6.2098897456115765, 106.73407988926834, 1, '2020-12-13 08:30:48', '2021-06-19 10:32:09'),
(6, 'PATTAYA\'S', 'Jalan H. Juhri', '-1607879037-.jfif', 900000, -6.209884019369198, 106.7340783317278, 1, '2020-12-13 10:03:57', '2021-06-19 10:38:27'),
(19, 'Kosan ganteng', 'Kosan ini bagus banget loh, ada di jl.H.madun', '-1623960735-.jpg', 600000, -6.2071537280899065, 106.73617377145558, 6, '2021-06-17 13:12:15', '2021-06-17 13:12:15'),
(20, 'Kosan Bapak ku', 'ada di belakang mercubuana deket tukang cilok...', '-1623960866-.PNG', 200000, -6.205745822398697, 106.73964991433911, 6, '2021-06-17 13:14:26', '2021-06-17 13:14:26'),
(21, 'Adiba', 'Kost-kosan putri', '-1624127555-.PNG', 700000, -6.215236238950354, 106.73455932754945, 1, '2021-06-19 11:32:35', '2021-06-19 11:32:35'),
(22, 'kostan putri 1', 'kostan dekat univrsitas mercubuana', '-1624127784-.PNG', 600000, -6.214884500201933, 106.73469533149392, 1, '2021-06-19 11:36:24', '2021-06-19 17:34:15'),
(23, 'Kostan putri 2', 'ini kos-kosan putri', '-1624128128-.PNG', 800000, -6.214841617032178, 106.73495931856996, 1, '2021-06-19 11:42:08', '2021-06-19 11:42:08'),
(24, 'Kostan putri 3', 'Kost an dekat universitas merubuana', '-1624128785-.PNG', 700000, -6.210876800976379, 106.73950055284178, 1, '2021-06-19 11:53:05', '2021-06-19 17:11:54'),
(25, 'Kostan putra/putri 1', 'Kostan pria/wanita dekat universitas mercubuana', '-1624128979-.PNG', 900000, -6.211097721495804, 106.74074208521034, 1, '2021-06-19 11:56:19', '2021-06-19 17:26:03'),
(26, 'kostan putri 4', 'kostan putri dekat universitas mercubuana', '-1624129287-.PNG', 650000, -6.211000734449939, 106.739632894691, 1, '2021-06-19 12:01:27', '2021-06-19 12:01:27'),
(27, 'Kostan putra/putri 2', 'Kost-kosan dekat universitas mercubuana', '-1624129808-.jfif', 750000, -6.208423832120985, 106.7374437523697, 1, '2021-06-19 12:10:08', '2021-06-19 17:32:34'),
(28, 'Kostan putra/putri 3', 'Kost-kosan dekat universitas mercubuana', '-1624129997-.jfif', 700000, -6.20846925331179, 106.73667791740849, 1, '2021-06-19 12:13:17', '2021-06-19 17:30:47'),
(29, 'Kostan putra/putri 4', 'Kost-kosa dekat dengan universitas mercubuana', '-1624130635-.jfif', 700000, -6.20649458157105, 106.73609626922564, 1, '2021-06-19 12:23:55', '2021-06-19 17:31:46'),
(30, 'BNB KOST', 'Kost-kosan dekat universitas mercubuana', '-1624131999-.jfif', 800000, -6.207958132603295, 106.73623382003831, 1, '2021-06-19 12:46:39', '2021-06-19 12:47:16'),
(36, 'Kost Putri 5', 'Kost-kosan dekat universitas mercubuana', '-1624137216-.PNG', 800000, -6.207818053828163, 106.7362171240294, 1, '2021-06-19 14:13:36', '2021-06-19 14:13:36'),
(37, 'Kostan putri 6', 'kost-kosan dekat universitas mercubuana', '-1624137600-.jfif', 400000, -6.209224853472875, 106.73678953710134, 1, '2021-06-19 14:20:00', '2021-06-19 14:20:00'),
(38, 'Kostan putri 7', 'kost-kosan putri dekat universitas mercubuana', '-1624138021-.jfif', 800000, -6.210405630958604, 106.73608679065876, 1, '2021-06-19 14:27:01', '2021-06-19 17:42:19'),
(39, 'Kostan putra/putri 5', 'kost-kosan', '-1624138343-.jfif', 700000, -6.210365587210816, 106.73580324336046, 1, '2021-06-19 14:32:23', '2021-06-19 17:34:42'),
(40, 'kostan putra 1', 'kost-kosan dekat universitas mercubuana', '-1624138736-.jpeg', 700000, -6.208791572088316, 106.73618837091726, 1, '2021-06-19 14:38:56', '2021-06-19 17:23:10'),
(41, 'Kostan putra/putri 6', 'kost-kosan dekat universitas mercubuna', '-1624139300-.jpeg', 1200000, -6.209129004069496, 106.73425759451015, 1, '2021-06-19 14:48:20', '2021-06-19 17:36:20'),
(42, 'Kostan putra 3', 'Kost- kosan Dekat Universitas mercubuana', '-1624139563-.jfif', 800000, -6.209154981372805, 106.73373575734553, 1, '2021-06-19 14:52:43', '2021-06-19 17:24:04'),
(43, 'Kostan putra/putri 8', 'kost-kosan dekat universitas mercubuana', '-1624140206-.jfif', 1100000, -6.214341050122982, 106.73195027326875, 1, '2021-06-19 15:03:26', '2021-06-19 17:37:58'),
(44, 'Kostan putra/putri 7', 'kostan dekat universitas mercubuana', '-1624143799-.jpeg', 1200000, -6.214938710006962, 106.73254176745729, 1, '2021-06-19 16:03:19', '2021-06-19 17:37:04'),
(45, 'KOOL KOST', 'Kost dekat universitas mercubuana', '-1624144411-.jfif', 1200000, -6.213690475385917, 106.73784746988252, 1, '2021-06-19 16:13:31', '2021-06-19 16:13:31'),
(46, 'Kostan putra 2', 'Kostan dekat universitas mercubuana', '-1624144676-.PNG', 800000, -6.214345128085711, 106.73817348350536, 1, '2021-06-19 16:17:56', '2021-06-19 17:22:29'),
(47, 'Kostan putra/putri 9', 'Kosta dekat universitas mercubuana', '-1624145599-.PNG', 800000, -6.211922653095499, 106.7366352619647, 1, '2021-06-19 16:33:19', '2021-06-19 17:38:35'),
(48, 'Kostan putra/putri 10', 'Kosta dekat universitas mercubuana', '-1624145694-.PNG', 1200000, -6.211971689723157, 106.73667993114361, 1, '2021-06-19 16:34:54', '2021-06-19 17:39:47'),
(49, 'Kosta putra 4', 'Kosta dekat universitas mercubuana', '-1624146515-.jfif', 800000, -6.209813492762507, 106.73466508251477, 1, '2021-06-19 16:48:35', '2021-06-19 17:24:46'),
(50, 'Kostan putra/putri 11', 'Kosta dekat universitas mercubuana', '-1624146593-.jfif', 700000, -6.210404449884223, 106.73577219058126, 1, '2021-06-19 16:49:53', '2021-06-19 17:40:37'),
(51, 'Kostan putri 8', 'Kosta dekat universitas mercubuana', '-1624146675-.jfif', 900000, -6.209158920608985, 106.73450007302944, 1, '2021-06-19 16:51:15', '2021-06-19 17:16:58');

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
(1, '2010_08_25_151934_create_roles_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_08_25_153210_create_pemiliks_table', 1),
(6, '2020_08_14_101142_create_kos_table', 1),
(7, '2020_08_25_151550_create_kamars_table', 1),
(8, '2020_08_25_151723_create_gambars_table', 1),
(9, '2020_08_25_152010_create_role_user_table', 1),
(10, '2020_11_05_144229_create_fasilitas_table', 1),
(11, '2020_11_05_144416_create_fasilitas_kos_table', 1),
(12, '2020_11_05_162158_create_universitas_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('avatardiva@yahoo.com', '$2y$10$rz.FsV4w/96ha8Q/Uc249OPCBGigIGvRqpeSrwkcXxIyb49AbXW6W', '2021-06-15 18:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `pemiliks`
--

CREATE TABLE `pemiliks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemiliks`
--

INSERT INTO `pemiliks` (`id`, `id_user`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-11-07 09:24:24', '2020-11-07 09:24:24'),
(3, 4, '2020-12-08 16:09:00', '2020-12-08 16:09:00'),
(6, 7, '2021-06-14 08:08:40', '2021-06-14 08:08:40'),
(7, 8, '2021-06-14 13:11:29', '2021-06-14 13:11:29');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL),
(2, 'pemilik', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_role` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `id_user`, `id_role`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL),
(2, 2, 1, NULL, NULL),
(4, 4, 2, NULL, NULL),
(7, 7, 2, NULL, NULL),
(8, 8, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `universitas`
--

CREATE TABLE `universitas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_universitas` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `universitas`
--

INSERT INTO `universitas` (`id`, `nama`, `desc_universitas`, `gambar`, `lat`, `lng`, `created_at`, `updated_at`) VALUES
(1, 'Mercubuana', 'Universitas mercubuana daerah meruya selatan jakarta barat', 'mercubuana-1623963668-.jpg', -6.2097560000000005, 106.738513, '2020-11-07 09:34:19', '2021-06-17 14:01:08'),
(2, 'Budi Luhur', 'Universitas budi luhur adalah universitas andalan didaerah perbatasan tangerang dengan jakarta xa', 'budi-luhur-1623963704-.png', -6.24207, 106.814316, '2020-11-07 09:48:14', '2021-07-03 13:57:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `gambar_profil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `phone` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `email_verified_at`, `gambar_profil`, `phone`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Pramudya Diva', 'avatardiva@yahoo.com', NULL, 'pramudya-diva-1607755549-.PNG', '02221', '$2y$10$gal37osrWopQpwcrGJLqlO34tnN.P4bCD6hhvEIrewpw3eE97KyJK', 'Fl7ZQ4CSJmGNqWhDazQwG9XVVceuzHPBkKfrcL7V2URqd0143SZJthrrZEfp', '2020-11-07 09:24:24', '2021-06-14 08:37:30'),
(2, 'admin jelek', 'adminx@gmail.com', NULL, 'admin-ganteng-1623960949-.jpg', '089532421211', '$2y$10$fk.XJ05c2fswgv.WSGfuk.Cba.cY1w5HxxbjfM.ak1OGWHjSRhX3a', 'wp0ZBIn1SFTNbxL8HJYKqURb0dAN1JtnOqaTRx4W4Ap7XawdVrn8XUAbToWI', NULL, '2021-07-04 20:56:42'),
(4, 'pramud', 'avatardiva5@yahoo.com', NULL, 'default.jpg', '0815117882153', '$2y$10$fk.XJ05c2fswgv.WSGfuk.Cba.cY1w5HxxbjfM.ak1OGWHjSRhX3a', NULL, '2020-12-08 16:08:59', '2020-12-08 16:08:59'),
(7, 'dipA', 'pramudyaalamsyah@gmail.com', NULL, 'dipa-1623960514-.jpg', '089512313', '$2y$10$34Ab93CNUbllmbR/t7GV4OZtKY6kahXrlTb84UTj5TFuT6Cxdn6ee', 'jxdLqGrd6pI2oQjLggAdDfBTJ8lGTngCZ5aNVUybpi2oQOrFo9Jr70BH0EXK', '2021-06-14 08:08:40', '2021-06-17 13:08:34'),
(8, 'pramudya', 'pramudyaalamsyah2@gmail.com', NULL, 'pramudya-1623701553-.jpg', '0895347024882', '$2y$10$eVNeVZ86BwZRNVeUWupZOuUqHgOYzwbs0FgEqsVIY5SRW4mfyI3za', NULL, '2021-06-14 13:11:28', '2021-06-14 13:12:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fasilitas_kos`
--
ALTER TABLE `fasilitas_kos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fasilitas_kos_id_kos_foreign` (`id_kos`),
  ADD KEY `fasilitas_kos_id_fasilitas_foreign` (`id_fasilitas`);

--
-- Indexes for table `gambars`
--
ALTER TABLE `gambars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gambars_id_kamar_foreign` (`id_kamar`);

--
-- Indexes for table `kamars`
--
ALTER TABLE `kamars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kamars_id_kos_foreign` (`id_kos`);

--
-- Indexes for table `kos`
--
ALTER TABLE `kos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kos_id_pemilik_foreign` (`id_pemilik`);

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
-- Indexes for table `pemiliks`
--
ALTER TABLE `pemiliks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemiliks_id_user_foreign` (`id_user`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_id_user_foreign` (`id_user`),
  ADD KEY `role_user_id_role_foreign` (`id_role`);

--
-- Indexes for table `universitas`
--
ALTER TABLE `universitas`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `fasilitas_kos`
--
ALTER TABLE `fasilitas_kos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `gambars`
--
ALTER TABLE `gambars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `kamars`
--
ALTER TABLE `kamars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `kos`
--
ALTER TABLE `kos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pemiliks`
--
ALTER TABLE `pemiliks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `universitas`
--
ALTER TABLE `universitas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fasilitas_kos`
--
ALTER TABLE `fasilitas_kos`
  ADD CONSTRAINT `fasilitas_kos_id_fasilitas_foreign` FOREIGN KEY (`id_fasilitas`) REFERENCES `fasilitas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fasilitas_kos_id_kos_foreign` FOREIGN KEY (`id_kos`) REFERENCES `kos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gambars`
--
ALTER TABLE `gambars`
  ADD CONSTRAINT `gambars_id_kamar_foreign` FOREIGN KEY (`id_kamar`) REFERENCES `kamars` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kamars`
--
ALTER TABLE `kamars`
  ADD CONSTRAINT `kamars_id_kos_foreign` FOREIGN KEY (`id_kos`) REFERENCES `kos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kos`
--
ALTER TABLE `kos`
  ADD CONSTRAINT `kos_id_pemilik_foreign` FOREIGN KEY (`id_pemilik`) REFERENCES `pemiliks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pemiliks`
--
ALTER TABLE `pemiliks`
  ADD CONSTRAINT `pemiliks_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_id_role_foreign` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
