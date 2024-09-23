-- -- phpMyAdmin SQL Dump
-- -- version 5.2.1
-- -- https://www.phpmyadmin.net/
-- --
-- -- Host: 127.0.0.1
-- -- Generation Time: Sep 09, 2024 at 02:49 AM
-- -- Server version: 10.4.32-MariaDB
-- -- PHP Version: 8.1.25

-- SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- START TRANSACTION;
-- SET time_zone = "+00:00";


-- /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
-- /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
-- /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
-- /*!40101 SET NAMES utf8mb4 */;

-- --
-- -- Database: `db_banhang`
-- --

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `bills`
-- --

-- CREATE TABLE `bills` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `id_customer` int(11) DEFAULT NULL,
--   `date_order` date DEFAULT NULL,
--   `total` float DEFAULT NULL COMMENT 'tổng tiền',
--   `payment` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'hình thức thanh toán',
--   `note` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
--   `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
--   `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
--   `updated_at` timestamp NULL DEFAULT current_timestamp()
-- ) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --
-- -- Dumping data for table `bills`
-- --

-- INSERT INTO `bills` (`id`, `id_customer`, `date_order`, `total`, `payment`, `note`, `status`, `created_at`, `updated_at`) VALUES
-- (57, 40, '2024-08-26', 43900, 'COD', NULL, 'New', '2024-08-25 19:43:34', '2024-08-25 19:43:34'),
-- (56, 47, '2024-08-26', 43900, 'COD', 'nds', 'New', '2024-08-25 19:40:49', '2024-08-25 19:40:49'),
-- (55, 40, '2024-08-26', 139000, 'COD', 'f', 'New', '2024-08-25 19:35:32', '2024-08-25 19:35:32'),
-- (54, 40, '2024-08-26', 100000, 'COD', 'd', 'Cancelled', '2024-08-26 02:36:53', '2024-08-25 19:36:53'),
-- (53, 40, '2024-08-26', 14400, 'COD', NULL, 'Cancelled', '2024-08-26 02:36:54', '2024-08-25 19:36:54'),
-- (52, 40, '2024-08-26', 35000, 'COD', 't', 'Cancelled', '2024-08-26 02:36:55', '2024-08-25 19:36:55'),
-- (51, 40, '2024-08-26', 45000, 'COD', '1', 'Cancelled', '2024-08-26 02:36:56', '2024-08-25 19:36:56'),
-- (50, 45, '2024-08-26', 18000, 'COD', 'ẻ', 'Cancelled', '2024-08-26 02:36:57', '2024-08-25 19:36:57'),
-- (49, 45, '2024-08-26', 1116000, 'COD', 'giao sớm nhất có thể nha', 'Cancelled', '2024-08-26 02:36:33', '2024-08-25 19:36:33'),
-- (48, 44, '2024-06-26', 18000, 'COD', 'nhanh', 'Cancelled', '2024-06-26 07:03:00', '2024-06-26 00:03:00'),
-- (47, 44, '2024-06-26', 734000, 'ATM', 'GIAO SỚM', 'New', '2024-06-26 00:00:18', '2024-06-26 00:00:18'),
-- (46, 44, '2024-06-26', 45000, 'COD', 'd', 'Cancelled', '2024-06-26 06:56:58', '2024-06-25 23:56:58'),
-- (45, 40, '2024-06-26', 305000, 'COD', 'á', 'Cancelled', '2024-06-26 06:56:59', '2024-06-25 23:56:59'),
-- (44, 41, '2024-06-26', 139000, 'COD', 'v', 'Delivered', '2024-06-26 05:00:00', '2024-06-25 22:00:00'),
-- (43, 41, '2024-06-26', 14400, 'COD', 'cx', 'Cancelled', '2024-06-26 06:57:00', '2024-06-25 23:57:00'),
-- (42, 41, '2024-06-26', 196000, 'COD', 'vcv', 'Cancelled', '2024-08-26 02:42:03', '2024-08-25 19:42:03'),
-- (41, 40, '2024-06-26', 867000, 'ATM', 'xa', 'In progress', '2024-06-26 04:12:36', '2024-06-25 21:12:36');

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `bill_detail`
-- --

-- CREATE TABLE `bill_detail` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `id_bill` int(10) NOT NULL,
--   `id_product` int(10) NOT NULL,
--   `quantity` int(11) NOT NULL COMMENT 'số lượng',
--   `unit_price` double NOT NULL,
--   `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
--   `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
-- ) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --
-- -- Dumping data for table `bill_detail`
-- --

-- INSERT INTO `bill_detail` (`id`, `id_bill`, `id_product`, `quantity`, `unit_price`, `created_at`, `updated_at`) VALUES
-- (65, 57, 76, 1, 43900, '2024-08-25 19:43:34', '2024-08-25 19:43:34'),
-- (64, 56, 76, 1, 43900, '2024-08-25 19:40:49', '2024-08-25 19:40:49'),
-- (63, 55, 100, 1, 139000, '2024-08-25 19:35:32', '2024-08-25 19:35:32'),
-- (62, 54, 73, 1, 48000, '2024-08-25 19:28:01', '2024-08-25 19:28:01'),
-- (61, 53, 69, 1, 14400, '2024-08-25 19:22:34', '2024-08-25 19:22:34'),
-- (60, 52, 71, 1, 35000, '2024-08-25 19:19:41', '2024-08-25 19:19:41'),
-- (59, 51, 81, 1, 45000, '2024-08-25 19:13:12', '2024-08-25 19:13:12'),
-- (58, 50, 85, 1, 18000, '2024-08-25 19:10:11', '2024-08-25 19:10:11'),
-- (57, 49, 117, 4, 279000, '2024-08-25 19:07:56', '2024-08-25 19:07:56'),
-- (56, 48, 68, 1, 18000, '2024-06-26 00:01:23', '2024-06-26 00:01:23'),
-- (55, 47, 97, 1, 305000, '2024-06-26 00:00:18', '2024-06-26 00:00:18'),
-- (54, 47, 107, 3, 143000, '2024-06-26 00:00:18', '2024-06-26 00:00:18'),
-- (53, 46, 81, 1, 45000, '2024-06-25 22:08:00', '2024-06-25 22:08:00'),
-- (52, 45, 97, 1, 305000, '2024-06-25 22:01:17', '2024-06-25 22:01:17'),
-- (51, 44, 103, 1, 139000, '2024-06-25 21:31:55', '2024-06-25 21:31:55'),
-- (50, 43, 69, 1, 14400, '2024-06-25 21:17:44', '2024-06-25 21:17:44'),
-- (49, 42, 79, 4, 49000, '2024-06-25 21:12:23', '2024-06-25 21:12:23'),
-- (48, 41, 141, 3, 289000, '2024-06-25 21:01:55', '2024-06-25 21:01:55');

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `cartegory`
-- --

-- CREATE TABLE `cartegory` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `name` varchar(255) NOT NULL,
--   `description` text DEFAULT NULL,
--   `parent_id` int(10) UNSIGNED DEFAULT NULL,
--   `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
--   `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --
-- -- Dumping data for table `cartegory`
-- --

-- INSERT INTO `cartegory` (`id`, `name`, `description`, `parent_id`, `created_at`, `updated_at`) VALUES
-- (1, 'Rau củ quả', 'Danh mục cho các loại rau, củ và quả', NULL, '2024-06-25 19:07:38', '2024-06-25 19:07:38'),
-- (2, 'Thịt', 'Danh mục cho các loại thịt', NULL, '2024-06-25 19:07:38', '2024-06-25 19:07:38'),
-- (3, 'Bơ sữa', 'Danh mục cho các loại bơ sữa cá', NULL, '2024-06-25 19:07:38', '2024-06-25 18:09:51'),
-- (5, 'Hải sản', 'Danh mục Thủy hải sản', NULL, '2024-06-25 18:10:09', '2024-06-25 18:20:51'),
-- (6, 'Cá', 'Cá tươi', NULL, '2024-06-25 18:21:04', '2024-06-25 18:21:04');

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `category`
-- --

-- CREATE TABLE `category` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `name` varchar(255) NOT NULL,
--   `description` text DEFAULT NULL,
--   `parent_id` int(10) UNSIGNED DEFAULT NULL,
--   `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
--   `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `contacts`
-- --

-- CREATE TABLE `contacts` (
--   `id` int(11) NOT NULL,
--   `name` varchar(255) NOT NULL,
--   `email` varchar(255) NOT NULL,
--   `subject` varchar(255) NOT NULL,
--   `message` text NOT NULL,
--   `created_at` datetime NOT NULL,
--   `updated_at` datetime NOT NULL,
--   `status` varchar(255) NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `coupons`
-- --

-- CREATE TABLE `coupons` (
--   `id` int(11) NOT NULL,
--   `code` varchar(50) NOT NULL,
--   `discount_percent` decimal(5,2) NOT NULL,
--   `valid_from` date NOT NULL,
--   `valid_to` date NOT NULL,
--   `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
--   `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --
-- -- Dumping data for table `coupons`
-- --

-- INSERT INTO `coupons` (`id`, `code`, `discount_percent`, `valid_from`, `valid_to`, `created_at`, `updated_at`) VALUES
-- (4, 'GIAM20', 20.00, '2024-06-26', '2024-06-28', '2024-06-25 23:58:28', '2024-06-25 23:58:28');

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `customer`
-- --

-- CREATE TABLE `customer` (
--   `id` int(11) UNSIGNED NOT NULL,
--   `name` varchar(100) NOT NULL,
--   `gender` varchar(10) NOT NULL,
--   `email` varchar(50) NOT NULL,
--   `address` varchar(100) NOT NULL,
--   `phone_number` varchar(20) NOT NULL,
--   `note` varchar(200) NOT NULL,
--   `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
--   `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
-- ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --
-- -- Dumping data for table `customer`
-- --

-- INSERT INTO `customer` (`id`, `name`, `gender`, `email`, `address`, `phone_number`, `note`, `created_at`, `updated_at`) VALUES
-- (29, 'Cô linh', 'nam', 'admin@gmail.com', 'Đà Nẵng', '0332541965', 'dffd', '2024-06-20 01:57:02', '2024-06-20 01:57:02'),
-- (47, 'tran van tam', 'nam', 'vantamtran1233331@gmail.com', 'Đà Nẵng', '0332541965', 'nds', '2024-08-25 19:40:49', '2024-08-25 19:40:49'),
-- (46, 'Trần Văn Tâm', 'nam', 'vantamtran12331@gmail.com', 'Đà Nẵng', '0332541965', 'giao sớm nhất có thể nha', '2024-08-25 19:08:25', '2024-08-25 19:08:25'),
-- (45, 'Trần Văn Tâm', 'nam', 'vantamtran1221@gmail.com', 'Đà Nẵng', '0332541965', 'giao sớm nhất có thể nha', '2024-08-25 19:07:55', '2024-08-25 19:07:55'),
-- (43, '[value-2]', '[value-3]', '[value-4]', '[value-5]', '[value-6]', '[value-7]', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
-- (44, 'adada', 'nam', 'dungle29011@gmail.com', 'Bình Định', '0332541965', 'd', '2024-06-25 22:08:00', '2024-06-25 22:08:00'),
-- (41, 'Lê Hoàng Dung', 'nam', 'vantamtran143@gmail.com', 'Quảng Nam', '0899930639', 'vcv', '2024-06-25 21:12:23', '2024-06-25 21:12:23'),
-- (40, 'tran van tam', 'nam', 'vantamtran1233@gmail.com', 'Đà Nẵng', '0332541965', 'xa', '2024-06-25 21:01:55', '2024-06-25 21:01:55');

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `favorites`
-- --

-- CREATE TABLE `favorites` (
--   `product_id` int(11) NOT NULL,
--   `id_customer` int(11) NOT NULL,
--   `id` int(11) NOT NULL,
--   `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
--   `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --
-- -- Dumping data for table `favorites`
-- --

-- INSERT INTO `favorites` (`product_id`, `id_customer`, `id`, `created_at`, `updated_at`) VALUES
-- (77, 44, 18, '2024-06-26 00:04:12', '2024-06-26 00:04:12');

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `migrations`
-- --

-- CREATE TABLE `migrations` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `migration` varchar(255) NOT NULL,
--   `batch` int(11) NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `news`
-- --

-- CREATE TABLE `news` (
--   `id` int(10) NOT NULL,
--   `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'tiêu đề',
--   `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'nội dung',
--   `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'hình',
--   `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
--   `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
-- ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `products`
-- --

-- CREATE TABLE `products` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `name` varchar(100) DEFAULT NULL,
--   `id_type` int(10) UNSIGNED DEFAULT NULL,
--   `description` text DEFAULT NULL,
--   `unit_price` float DEFAULT NULL,
--   `promotion_price` float DEFAULT NULL,
--   `image` varchar(255) DEFAULT NULL,
--   `unit` varchar(255) DEFAULT NULL,
--   `new` tinyint(4) DEFAULT 0,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --
-- -- Dumping data for table `products`
-- --

-- INSERT INTO `products` (`id`, `name`, `id_type`, `description`, `unit_price`, `promotion_price`, `image`, `unit`, `new`, `created_at`, `updated_at`) VALUES
-- (68, 'Cam sành vắt nước Tiền Giang, 150g', 15, 'Cam sành vắt nước Tiền Giang, 150g', 20000, 18000, '1719365755_171268-300x300.jpg', NULL, 1, '2024-06-25 18:30:28', '2024-06-25 18:35:55'),
-- (69, 'Dưa hấu Hắc Mỹ Nhân loại 1', 15, 'Dưa hấu Hắc Mỹ Nhân loại 1', 18000, 14400, '1719365764_148341-300x300.jpg', NULL, 1, '2024-06-25 18:31:39', '2024-06-25 18:36:04'),
-- (70, 'Dưa hấu Hắc Mỹ Nhân', 15, 'Dưa hấu Hắc Mỹ Nhân', 18000, 12000, '1719365790_107994-300x300.jpg', NULL, 0, '2024-06-25 18:36:30', '2024-06-25 18:36:30'),
-- (71, 'Dưa lưới tròn ruột cam', 15, 'Dưa lưới tròn ruột cam Tây Ninh', 35000, 0, '1719365844_163466-300x300.jpg', NULL, 1, '2024-06-25 18:37:24', '2024-06-25 18:37:24'),
-- (72, 'Dứa Tân Lập Long An, 900g', 15, 'Dứa Tân Lập Long An, 900g', 22000, 18000, '1719365878_76378-300x300.jpg', NULL, 1, '2024-06-25 18:37:58', '2024-06-25 18:37:58'),
-- (73, 'Xoài cát chu vàng Đồng Tháp, 250g', 15, 'Xoài cát chu vàng Đồng Tháp, 250g', 48000, 0, '1719365906_347287-300x300.jpg', NULL, 1, '2024-06-25 18:38:26', '2024-06-25 18:38:26'),
-- (74, 'Chuối sứ Bến Tre', 15, 'Chuối sứ Bến Tre', 27000, 0, '1719365933_162966-300x300.jpg', NULL, 0, '2024-06-25 18:38:53', '2024-06-25 18:38:53'),
-- (75, 'Chanh không hạt Long An', 15, 'Chanh không hạt Long An', 32000, 29000, '1719365984_171266-1-300x300.jpg', NULL, 0, '2024-06-25 18:39:44', '2024-06-25 18:39:44'),
-- (76, 'Thanh long ruột trắng, 400g', 15, 'Thanh long ruột trắng, 400g', 45000, 43900, '1719366023_171269-300x300.jpg', NULL, 1, '2024-06-25 18:40:23', '2024-06-25 18:40:23'),
-- (77, 'Dưa hấu không hạt loại 1', 15, 'Dưa hấu không hạt loại 1', 19000, 0, '1719366056_35575-1-300x300.jpg', NULL, 1, '2024-06-25 18:40:56', '2024-06-25 18:40:56'),
-- (78, 'Cam Valencia nhập khẩu', 16, 'Cam Valencia nhập khẩu xuất xứ Úc', 49000, 0, '1719366136_391588-1-300x300.jpg', NULL, 1, '2024-06-25 18:42:16', '2024-06-25 18:42:16'),
-- (79, 'Chanh vàng nhập khẩu', 16, 'Chanh vàng nhập khẩu Trung Quốc', 49000, 0, '1719366429_424497-300x300.jpg', NULL, 1, '2024-06-25 18:47:09', '2024-06-25 18:47:09'),
-- (80, 'Táo Candine We Are Fresh', 16, 'Táo Candine We Are Fresh nhập khẩu xuất xứ Pháp', 69000, 59000, '1719366479_376300-300x300.jpg', NULL, 1, '2024-06-25 18:47:59', '2024-06-25 18:47:59'),
-- (81, 'Me ngọt NK Thái Lan, hộp 450g', 15, 'Me ngọt nhập khẩu Thái Lan, hộp 450g', 45000, 0, '1719366523_389599-300x300.jpg', 'hộp', 1, '2024-06-25 18:48:43', '2024-06-25 18:48:43'),
-- (82, 'Dâu tây Hàn Quốc hộp 250g', 16, 'Dâu tây Hàn Quốc nhập khẩu, hộp 250g', 99000, 0, '1719366575_350501-300x300.jpg', 'hộp', 1, '2024-06-25 18:49:35', '2024-06-25 18:49:35'),
-- (83, 'Xà lách Iceberg Đà Lạt', 17, 'Xà lách Iceberg Đà Lạt', 50000, 42000, '1719366653_76471-300x300.jpg', NULL, 1, '2024-06-25 18:50:53', '2024-06-25 18:50:53'),
-- (84, 'Hành tây Đà Lạt', 17, 'Hành tây Đà Lạt', 29000, 0, '1719366686_171262-300x300.jpg', NULL, 0, '2024-06-25 18:51:26', '2024-06-25 18:51:26'),
-- (85, 'Rau muống We Are Fresh, 500g', 17, 'Rau muống We Are Fresh, 500g', 18000, 0, '1719366729_201036-300x300.jpg', 'cái', 1, '2024-06-25 18:52:09', '2024-06-25 18:52:09'),
-- (86, 'Xà lách lô lô xanh Đà Lạt', 17, 'Xà lách lô lô xanh Đà Lạt', 34000, 0, '1719366754_76469-300x300.jpg', NULL, 0, '2024-06-25 18:52:34', '2024-06-25 18:52:34'),
-- (87, 'Mướp hương', 17, 'Mướp hương', 35000, 29000, '1719366787_75905-300x300.jpg', NULL, 0, '2024-06-25 18:53:07', '2024-06-25 18:53:07'),
-- (88, 'Nấm đùi gà tươi Trâm Anh, 500g', 18, 'Nấm đùi gà tươi Trâm Anh, 500g', 35000, 29000, '1719366848_129041-300x300.jpg', 'cái', 1, '2024-06-25 18:54:08', '2024-06-25 18:54:08'),
-- (89, 'Nấm đông cô tươi Trâm Anh, 195g', 18, 'Nấm đông cô tươi Trâm Anh, 195g', 35000, 29000, '1719366869_144062-300x300.jpg', 'cái', 0, '2024-06-25 18:54:29', '2024-06-25 18:54:29'),
-- (90, 'Hành tây loại 1 xuất xứ Trung Quốc', 18, 'Hành tây loại 1 xuất xứ Trung Quốc', 22000, 0, '1719366896_76438-300x300.jpg', NULL, 0, '2024-06-25 18:54:56', '2024-06-25 18:54:56'),
-- (91, 'Tỏi cô đơn Trung Quốc, 500g', 18, 'Tỏi cô đơn Trung Quốc, 500g', 80000, 0, '1719366959_390760-300x300.jpg', 'cái', 1, '2024-06-25 18:55:59', '2024-06-25 18:55:59'),
-- (92, 'Nấm linh chi trắng Trung Quốc, 150g', 18, 'Nấm linh chi trắng Trung Quốc, 150g', 18000, 14000, '1719366991_123616-300x300.jpg', 'cái', 1, '2024-06-25 18:56:31', '2024-06-25 18:56:31'),
-- (93, 'Măng luộc xé Vĩ Lâm, 500g', 19, 'Măng luộc xé Vĩ Lâm, 500g', 35000, 0, '1719367036_356760-300x300.jpg', 'cái', 1, '2024-06-25 18:57:16', '2024-06-25 18:57:16'),
-- (94, 'Cải chua Vĩ Lâm, 500g', 19, 'Cải chua Vĩ Lâm, 500g', 49000, 43900, '1719367073_356754-300x300.jpg', 'cái', 1, '2024-06-25 18:57:53', '2024-06-25 18:57:53'),
-- (95, 'Cóc ngâm chua ngọt Bốn Mùa, 500g', 19, 'Cóc ngâm chua ngọt Bốn Mùa, 500g', 49000, 45000, '1719367113_152796-300x300.jpg', 'hộp', 0, '2024-06-25 18:58:33', '2024-06-25 18:58:33'),
-- (96, 'Me chín nấu canh, 200g', 19, 'Me chín nấu canh, 200g', 89000, 0, '1719367148_390502-300x300.jpg', NULL, 0, '2024-06-25 18:59:08', '2024-06-25 18:59:08'),
-- (97, 'Bắp đùi/tay bò tinh loại 1', 20, 'Bắp đùi/tay bò tinh loại 1', 305000, 0, '1719367229_2310-300x300.jpg', NULL, 1, '2024-06-25 19:00:29', '2024-06-25 19:00:29'),
-- (98, 'Nạc bò xay', 20, 'Nạc bò xay', 169000, 159000, '1719367285_177629-1-300x300.jpg', NULL, 0, '2024-06-25 19:01:25', '2024-06-25 19:01:25'),
-- (99, 'Nạm bò nguyên', 20, 'Nạm bò nguyên', 217000, 0, '1719367363_206531-300x300.jpg', NULL, 1, '2024-06-25 19:02:43', '2024-06-25 19:02:43'),
-- (100, 'Ba chỉ bò cắt lát xuất xứ Mỹ, 500g', 20, 'Ba chỉ bò cắt lát xuất xứ Mỹ, 500g', 144000, 139000, '1719367393_213306-300x300.jpg', 'cái', 1, '2024-06-25 19:03:13', '2024-06-25 19:03:13'),
-- (101, 'Ba chỉ bò Mỹ cắt lát xuất xứ Mỹ, 500g', 20, 'Ba chỉ bò Mỹ cắt lát xuất xứ Mỹ, 500g', 109000, 0, '1719367428_228460-300x300.jpg', 'cái', 0, '2024-06-25 19:03:48', '2024-06-25 19:03:48'),
-- (102, 'Sườn non heo We Are Fresh đông lạnh nhập khẩu', 21, 'Sườn non heo We Are Fresh đông lạnh nhập khẩu', 169000, 0, '1719367528_241394-300x300.jpg', NULL, 1, '2024-06-25 19:05:28', '2024-06-25 19:05:28'),
-- (103, 'Nạc dăm heo loại 1 We Are Fresh VietGAP', 21, 'Nạc dăm heo loại 1 We Are Fresh VietGAP', 157000, 139000, '1719367558_378654-300x300.jpg', NULL, 1, '2024-06-25 19:05:58', '2024-06-25 19:05:58'),
-- (104, 'Nạc heo xay', 21, 'Nạc heo xay', 99000, 0, '1719367605_225743-300x300.jpg', NULL, 0, '2024-06-25 19:06:45', '2024-06-25 19:06:45'),
-- (105, 'Chân giò heo loại 1 We Are Fresh VietGAP', 21, 'Chân giò heo loại 1 We Are Fresh VietGAP', 149000, 0, '1719367643_378658-300x300.jpg', NULL, 1, '2024-06-25 19:07:23', '2024-06-25 19:07:23'),
-- (106, 'Ba rọi heo We Are Fresh VietGAP loại 1', 21, 'Ba rọi heo We Are Fresh VietGAP loại 1', 144000, 0, '1719367684_378649-2-300x300.jpg', NULL, 1, '2024-06-25 19:08:04', '2024-06-25 19:08:04'),
-- (107, 'Gà ta nguyên con', 22, 'Gà ta nguyên con', 143000, 0, '1719367816_2085-300x300.jpg', 'cái', 1, '2024-06-25 19:10:16', '2024-06-25 19:10:16'),
-- (108, 'Đùi gà tháo khớp CP, 500g', 22, 'Đùi gà tháo khớp CP, 500g', 69000, 0, '1719367866_351035-300x300.jpg', 'cái', 1, '2024-06-25 19:11:06', '2024-06-25 19:11:06'),
-- (109, 'Má đùi gà công nghiêp MM, 1kg', 22, 'Má đùi gà công nghiêp MM, 1kg', 99000, 89000, '1719367892_191949-300x300.jpg', NULL, 0, '2024-06-25 19:11:32', '2024-06-25 19:11:32'),
-- (110, 'Ức phi lê gà khay CP', 22, 'Ức phi lê gà khay CP', 99000, 79000, '1719367930_351030-300x300.jpg', NULL, 0, '2024-06-25 19:12:10', '2024-06-25 19:12:10'),
-- (111, 'Gà công nghiệp bọng', 22, 'Gà công nghiệp bọng', 72000, 0, '1719367959_2096-300x300.jpg', 'cái', 0, '2024-06-25 19:12:39', '2024-06-25 19:12:39'),
-- (112, 'Bắp cừu đông lạnh We Are Fresh xuất xứ Úc', 23, 'Bắp cừu đông lạnh We Are Fresh xuất xứ Úc', 380000, 359000, '1719368020_130635-300x300.jpg', NULL, 1, '2024-06-25 19:13:40', '2024-06-25 19:13:40'),
-- (113, 'Nạc đùi cừu đông lạnh We Are Fresh xuất xứ Úc', 23, 'Nạc đùi cừu đông lạnh We Are Fresh xuất xứ Úc', 349000, 0, '1719368049_130626-300x300.jpg', NULL, 1, '2024-06-25 19:14:09', '2024-06-25 19:14:09'),
-- (114, 'Cốt lết cừu đông lạnh xuất xứ Ú', 23, 'Cốt lết cừu đông lạnh xuất xứ Ú', 269000, 0, '1719368091_130632-300x300.jpg', NULL, 1, '2024-06-25 19:14:51', '2024-06-25 19:14:51'),
-- (115, 'Tôm sú sống, 35-40 con/kg', 24, 'Tôm sú sống, 35-40 con/kg', 339000, 329000, '1719368158_17691-300x300.jpg', NULL, 1, '2024-06-25 19:15:58', '2024-06-25 19:15:58'),
-- (116, 'Bạch tuộc tươi nguyên con', 24, 'Bạch tuộc tươi nguyên con', 125900, 0, '1719368197_384262-300x300.jpg', NULL, 0, '2024-06-25 19:16:37', '2024-06-25 19:16:37'),
-- (117, 'Mực ống tươi nguyên con, 15cm trở lên', 24, 'Mực ống tươi nguyên con, 15cm trở lên', 305000, 279000, '1719368244_371154-300x300.jpg', NULL, 1, '2024-06-25 19:17:24', '2024-06-25 19:17:24'),
-- (118, 'Mực muối, 250g', 24, 'Mực muối, 250g', 112900, 0, '1719368273_398329-300x300.jpg', 'cái', 0, '2024-06-25 19:17:53', '2024-06-25 19:17:53'),
-- (119, 'Thịt càng ghẹ MM loại nhỏ, 340g/500g', 25, 'Thịt càng ghẹ MM loại nhỏ, 340g/500g', 156000, 0, '1719368336_258262-300x300.jpg', 'cái', 1, '2024-06-25 19:18:56', '2024-06-25 19:18:56'),
-- (120, 'Cua thịt tươi', 25, 'Cua thịt tươi', 185000, 0, '1719368389_36357-300x300.jpg', NULL, 1, '2024-06-25 19:19:49', '2024-06-25 19:19:49'),
-- (121, 'Cua thịt sống không dây bao ăn, 250g trở lên', 25, 'Cua thịt sống không dây bao ăn, 250g trở lên', 339000, 0, '1719368421_369092-300x300.jpg', NULL, 0, '2024-06-25 19:20:21', '2024-06-25 19:20:21'),
-- (122, 'Sò méo sống', 25, 'Sò méo sống', 35000, 0, '1719368458_236150-300x300.jpg', NULL, 0, '2024-06-25 19:20:58', '2024-06-25 19:20:58'),
-- (123, 'Tôm khô loại 3, 100g', 26, 'Tôm khô loại 3, 100g', 99000, 0, '1719368543_398326-300x300.jpg', 'cái', 1, '2024-06-25 19:22:23', '2024-06-25 19:22:23'),
-- (124, 'Khô cá cơm, 100g', 26, 'Khô cá cơm, 100g', 28000, 0, '1719368571_398308-300x300.jpg', 'cái', 0, '2024-06-25 19:22:51', '2024-06-25 19:22:51'),
-- (125, 'Khô cá chỉ vàng, 200g', 26, 'Khô cá chỉ vàng, 200g', 99000, 43900, '1719368602_398315-300x300.jpg', 'cái', 1, '2024-06-25 19:23:22', '2024-06-25 19:23:22'),
-- (126, 'Khô cá thiều, 200g', 26, 'Khô cá thiều, 200g', 35000, 0, '1719368632_398301-300x300.jpg', 'cái', 1, '2024-06-25 19:23:52', '2024-06-25 19:23:52'),
-- (127, 'Tôm khô Côn Đảo, 200g', 26, 'Tôm khô Côn Đảo, 200g', 364000, 0, '1719368679_322249-300x300.jpg', 'cái', 0, '2024-06-25 19:24:39', '2024-06-25 19:24:39'),
-- (128, 'Cua đồng xay đông lạnh TLE, 500g', 27, 'Cua đồng xay đông lạnh TLE, 500g', 72000, 0, '1719368720_213235-300x300.jpg', 'cái', 0, '2024-06-25 19:25:20', '2024-06-25 19:25:20'),
-- (129, 'Nghêu thịt hấp đông lạnh 700-1000 con, 500g', 27, 'Nghêu thịt hấp đông lạnh 700-1000 con, 500g', 54000, 48000, '1719368749_369495-300x300.jpg', 'cái', 1, '2024-06-25 19:25:49', '2024-06-25 19:25:49'),
-- (130, 'Mực cắt hoa đông lạnh, 600g', 27, 'Mực cắt hoa đông lạnh, 600g', 70000, 0, '1719368777_407885-300x300.jpg', 'cái', 0, '2024-06-25 19:26:17', '2024-06-25 19:26:17'),
-- (131, 'Tôm sú PD 13-15, 300g', 27, 'Tôm sú PD 13-15, 300g', 99000, 0, '1719368802_338733-300x300.jpg', 'cái', 0, '2024-06-25 19:26:42', '2024-06-25 19:26:42'),
-- (132, 'Tôm thẻ chỉ Nigico size L, 500g', 27, 'Tôm thẻ chỉ Nigico size L, 500g', 99000, 88000, '1719368828_153804-300x300.jpg', 'cái', 0, '2024-06-25 19:27:08', '2024-06-25 19:27:08'),
-- (133, 'Phi lê cá basa Vĩnh Hoàn, gói 1kg', 33, 'Phi lê cá basa Vĩnh Hoàn, gói 1kg', 169000, 0, '1719368893_143974-300x300.jpg', 'cái', 0, '2024-06-25 19:28:13', '2024-06-25 19:28:13'),
-- (134, 'Cá chẽm tươi, 0.5-2 kg/con', 33, 'Cá chẽm tươi, 0.5-2 kg/con', 95000, 0, '1719368938_174006-300x300.jpg', NULL, 0, '2024-06-25 19:28:58', '2024-06-25 19:28:58'),
-- (135, 'Cá ngừ bông tươi, 0.4-2.0 kg/con', 33, 'Cá ngừ bông tươi, 0.4-2.0 kg/con', 49000, 43900, '1719368964_174404-300x300.jpg', NULL, 0, '2024-06-25 19:29:24', '2024-06-25 19:29:24'),
-- (136, 'Cá chim trắng sống, 0.7-1.4 kg/con', 33, 'Cá chim trắng sống, 0.7-1.4 kg/con', 229000, 0, '1719368984_136550-300x300.jpg', NULL, 0, '2024-06-25 19:29:44', '2024-06-25 19:29:44'),
-- (137, 'Cá thu Sanma  , 60-120 g/con', 33, 'Cá thu Sanma đông lạnh nhập khẩu We Are Fresh, 60-120 g/con', 99000, 0, '1719369024_407389-300x300.jpg', 'cái', 0, '2024-06-25 19:30:24', '2024-06-25 19:30:24'),
-- (138, 'Cá diêu hồng sống, 0.8-1.0 kg/con', 34, 'Cá diêu hồng sống, 0.8-1.0 kg/con', 77000, 0, '1719369091_16438-300x300.jpg', NULL, 0, '2024-06-25 19:31:31', '2024-06-25 19:31:31'),
-- (139, 'Cá kèo sống, 10-15 cm/con', 34, 'Cá kèo sống, 10-15 cm/con', 369000, 0, '1719369132_62494-300x300.jpg', NULL, 0, '2024-06-25 19:32:12', '2024-06-25 19:32:12'),
-- (140, 'Cá lóc đen sống, 0.5-0.8 kg/con', 34, 'Cá lóc đen sống, 0.5-0.8 kg/con', 88000, 0, '1719369156_177741-300x300.jpg', NULL, 0, '2024-06-25 19:32:36', '2024-06-25 19:32:36'),
-- (141, 'Cá lăng đỏ sống, 0.8-1.7 kg/con', 34, 'Cá lăng đỏ sống, 0.8-1.7 kg/con', 289000, 0, '1719369178_159902-300x300.jpg', NULL, 1, '2024-06-25 19:32:58', '2024-06-25 19:32:58'),
-- (142, 'Cá hồi Nauy We Are Fresh phi lê tươi còn da', 34, 'Cá hồi Nauy We Are Fresh phi lê tươi còn da', 459000, 0, '1719369239_320514-300x300.jpg', NULL, 0, '2024-06-25 19:33:59', '2024-06-25 19:33:59'),
-- (143, 'Cá hồi nhập khẩu xông khói Amigo, 100g', 35, 'Cá hồi nhập khẩu xông khói Amigo, 100g', 104000, 0, '1719369313_162305-300x300.jpg', 'cái', 0, '2024-06-25 19:35:13', '2024-06-25 19:35:13'),
-- (144, 'Cá bạc má đông lạnh, 8-10 con/kg', 35, 'Cá bạc má đông lạnh, 8-10 con/kg', 69000, 0, '1719369336_313117-300x300.jpg', NULL, 0, '2024-06-25 19:35:36', '2024-06-25 19:35:36'),
-- (145, 'Cá tra cắt khoanh', 15, 'Cá tra cắt khoanh We Are Fresh, 1kg', 89000, 0, '1719369371_352925-300x300.jpg', NULL, 0, '2024-06-25 19:36:11', '2024-06-25 20:41:16'),
-- (146, 'Phi lê cá saba rút xương', 15, 'Phi lê cá saba rút xương, gói 250g', 99000, 0, '1719369399_143974-300x300.jpg', 'cái', 0, '2024-06-25 19:36:39', '2024-06-25 20:41:02'),
-- (147, 'Lườn cá hồi nhập khẩu', 15, 'Lườn cá hồi nhập khẩu đông lạnh 1-3cm', 119000, 0, '1719369424_237676-300x300.jpg', NULL, 0, '2024-06-25 19:37:04', '2024-06-25 20:40:50');

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `slide`
-- --

-- CREATE TABLE `slide` (
--   `id` int(11) NOT NULL,
--   `image` varchar(100) NOT NULL,
--   `stt` int(10) NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --
-- -- Dumping data for table `slide`
-- --

-- INSERT INTO `slide` (`id`, `image`, `stt`) VALUES
-- (10, '1719373775_banner3.jpg', 2),
-- (11, '1719373784_banner4.jpg', 3),
-- (12, '1719373879_banner1.jpg', 1);

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `type_products`
-- --

-- CREATE TABLE `type_products` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `name` varchar(100) NOT NULL,
--   `cartegory_id` int(11) DEFAULT NULL,
--   `description` text NOT NULL,
--   `image` varchar(255) NOT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --
-- -- Dumping data for table `type_products`
-- --

-- INSERT INTO `type_products` (`id`, `name`, `cartegory_id`, `description`, `image`, `created_at`, `updated_at`) VALUES
-- (15, 'Trái cây trong nước', 1, 'Trái cây trong nước', '1719364288_cuba.png', '2024-06-25 18:11:28', '2024-06-25 18:11:28'),
-- (16, 'Trái cây nhập khẩu', 1, 'Trái cây nhập khẩu', '1719364381_My.jpg', '2024-06-25 18:13:01', '2024-06-25 18:13:01'),
-- (17, 'Rau củ quả trong nước', 1, 'Rau củ quả trong nước', '1719364427_cuba.png', '2024-06-25 18:13:47', '2024-06-25 18:13:47'),
-- (18, 'Rau nhập khẩu', 1, 'Rau nhập khẩu', '1719364449_cuba.png', '2024-06-25 18:14:09', '2024-06-25 18:14:09'),
-- (19, 'Trái cây - Rau củ chế biến', 1, 'Trái cây - Rau củ chế biến', '1719364502_cuba.png', '2024-06-25 18:15:02', '2024-06-25 18:15:02'),
-- (20, 'Thịt bò', 2, 'Thịt bò', '1719364528_cuba.png', '2024-06-25 18:15:28', '2024-06-25 18:15:28'),
-- (21, 'Thịt heo', 2, 'Thịt heo', '1719364543_cuba.png', '2024-06-25 18:15:43', '2024-06-25 18:15:43'),
-- (22, 'Thịt gia cầm', 2, 'Thịt gia cầm', '1719364565_cuba.png', '2024-06-25 18:16:05', '2024-06-25 18:16:05'),
-- (23, 'Các loại thịt khác', 2, 'Các loại thịt khác', '1719364581_cuba.png', '2024-06-25 18:16:21', '2024-06-25 18:16:21'),
-- (24, 'Mực - Bạch tuộc', 5, 'Mực - Bạch tuộc', '1719364607_cuba.png', '2024-06-25 18:16:47', '2024-06-25 18:16:58'),
-- (25, 'Cua - Ghẹ', 5, 'Cua - Ghẹ', '1719364680_cuba.png', '2024-06-25 18:18:00', '2024-06-25 18:18:00'),
-- (26, 'Hải sản chế biến', 5, 'Hải sản chế biến', '1719364697_cuba.png', '2024-06-25 18:18:17', '2024-06-25 18:18:17'),
-- (27, 'Hải sản đông lạnh', 5, 'Hải sản đông lạnh', '1719364715_cuba.png', '2024-06-25 18:18:35', '2024-06-25 18:18:35'),
-- (28, 'Sữa chua - Bánh flan', 3, 'Sữa chua - Bánh flan', '1719364758_cuba.png', '2024-06-25 18:19:18', '2024-06-25 18:19:18'),
-- (29, 'Cream', 3, 'Cream', '1719364772_cuba.png', '2024-06-25 18:19:32', '2024-06-25 18:19:32'),
-- (30, 'Phô mai', 3, 'Phô mai', '1719364791_cuba.png', '2024-06-25 18:19:51', '2024-06-25 18:19:51'),
-- (31, 'Bơ - Bơ thực vật', 3, 'Bơ - Bơ thực vật', '1719364833_cuba.png', '2024-06-25 18:20:33', '2024-06-25 18:20:33'),
-- (32, 'Sữa đậu nành', 3, 'Sữa đậu nành', '1719364900_cuba.png', '2024-06-25 18:21:40', '2024-06-25 18:21:40'),
-- (33, 'Cá biển', 6, 'Cá biển', '1719364929_cuba.png', '2024-06-25 18:22:09', '2024-06-25 18:22:09'),
-- (34, 'Cá sông', 6, 'Cá sông', '1719364943_cuba.png', '2024-06-25 18:22:23', '2024-06-25 18:22:23'),
-- (35, 'Cá đông lạnh', 6, 'Cá đông lạnh', '1719364957_cuba.png', '2024-06-25 18:22:37', '2024-06-25 18:22:37');

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `users`
-- --

-- CREATE TABLE `users` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `full_name` varchar(255) NOT NULL,
--   `email` varchar(255) NOT NULL,
--   `password` varchar(255) NOT NULL,
--   `phone` varchar(20) DEFAULT NULL,
--   `address` varchar(255) DEFAULT NULL,
--   `level` int(11) NOT NULL,
--   `remember_token` varchar(100) DEFAULT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --
-- -- Dumping data for table `users`
-- --

-- INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `phone`, `address`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
-- (41, 'Lê Hoàng Dung', 'vantamtran143@gmail.com', '$2y$12$Lt9rfzd/UA.GUf.ZsTrKV.7IaohQIJaofoh9I7u5DElHC9bjZJH.6', '0899930639', 'Quảng Nam', 3, NULL, '2024-06-25 21:03:02', '2024-06-25 21:05:20'),
-- (44, 'adada', 'dungle29011@gmail.com', '$2y$12$zkJ8stn4pNk2ZxOq58oa1uEwiOPQGUISirP9.lNEFudWYuhvW8nj.', '0332541965', 'Bình Định', 3, NULL, '2024-06-25 22:05:57', '2024-06-25 22:05:57'),
-- (46, 'Trần Văn Tâm', 'admin@gmail.com', '$2y$12$E61O8zEqyauOnWf/4OOkquBLQCbbZhoOBYIRhij7AzLFihnP2UwVG', '0332541965', 'Đà Nẵng', 1, NULL, '2024-08-18 23:46:17', '2024-08-18 23:46:17'),
-- (47, 'Trần Văn Tâm', 'vantamtran1221@gmail.com', '$2y$12$6twHujKjIv0RfN6CC7s70eP/g2Ea90XS5FibnTnzy1jHTd3hxnW0G', '0332541965', 'Đà Nẵng', 3, NULL, '2024-08-25 19:04:38', '2024-08-25 19:04:38'),
-- (48, 'tam', 'vantamtran1233@gmail.com', '$2y$12$YmHKpSAqZjjSd/vB7gdiC.tQ1FVZjzCypDzFnlPkIx4EligNdIGTu', '32421121', 'Da Nang', 3, NULL, '2024-08-25 19:12:06', '2024-08-25 19:12:06');

-- --
-- -- Indexes for dumped tables
-- --

-- --
-- -- Indexes for table `bills`
-- --
-- ALTER TABLE `bills`
--   ADD PRIMARY KEY (`id`),
--   ADD KEY `bills_ibfk_1` (`id_customer`);

-- --
-- -- Indexes for table `bill_detail`
-- --
-- ALTER TABLE `bill_detail`
--   ADD PRIMARY KEY (`id`),
--   ADD KEY `bill_detail_ibfk_2` (`id_product`);

-- --
-- -- Indexes for table `cartegory`
-- --
-- ALTER TABLE `cartegory`
--   ADD PRIMARY KEY (`id`),
--   ADD KEY `parent_id` (`parent_id`);

-- --
-- -- Indexes for table `category`
-- --
-- ALTER TABLE `category`
--   ADD PRIMARY KEY (`id`),
--   ADD KEY `parent_id` (`parent_id`);

-- --
-- -- Indexes for table `contacts`
-- --
-- ALTER TABLE `contacts`
--   ADD PRIMARY KEY (`id`);

-- --
-- -- Indexes for table `coupons`
-- --
-- ALTER TABLE `coupons`
--   ADD PRIMARY KEY (`id`);

-- --
-- -- Indexes for table `customer`
-- --
-- ALTER TABLE `customer`
--   ADD PRIMARY KEY (`id`);

-- --
-- -- Indexes for table `favorites`
-- --
-- ALTER TABLE `favorites`
--   ADD PRIMARY KEY (`id`);

-- --
-- -- Indexes for table `migrations`
-- --
-- ALTER TABLE `migrations`
--   ADD PRIMARY KEY (`id`);

-- --
-- -- Indexes for table `news`
-- --
-- ALTER TABLE `news`
--   ADD PRIMARY KEY (`id`);

-- --
-- -- Indexes for table `products`
-- --
-- ALTER TABLE `products`
--   ADD PRIMARY KEY (`id`),
--   ADD KEY `products_id_type_foreign` (`id_type`);

-- --
-- -- Indexes for table `slide`
-- --
-- ALTER TABLE `slide`
--   ADD PRIMARY KEY (`id`);

-- --
-- -- Indexes for table `type_products`
-- --
-- ALTER TABLE `type_products`
--   ADD PRIMARY KEY (`id`);

-- --
-- -- Indexes for table `users`
-- --
-- ALTER TABLE `users`
--   ADD PRIMARY KEY (`id`),
--   ADD UNIQUE KEY `users_email_unique` (`email`);

-- --
-- -- AUTO_INCREMENT for dumped tables
-- --

-- --
-- -- AUTO_INCREMENT for table `bills`
-- --
-- ALTER TABLE `bills`
--   MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

-- --
-- -- AUTO_INCREMENT for table `bill_detail`
-- --
-- ALTER TABLE `bill_detail`
--   MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

-- --
-- -- AUTO_INCREMENT for table `cartegory`
-- --
-- ALTER TABLE `cartegory`
--   MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

-- --
-- -- AUTO_INCREMENT for table `category`
-- --
-- ALTER TABLE `category`
--   MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

-- --
-- -- AUTO_INCREMENT for table `contacts`
-- --
-- ALTER TABLE `contacts`
--   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

-- --
-- -- AUTO_INCREMENT for table `coupons`
-- --
-- ALTER TABLE `coupons`
--   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

-- --
-- -- AUTO_INCREMENT for table `customer`
-- --
-- ALTER TABLE `customer`
--   MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

-- --
-- -- AUTO_INCREMENT for table `favorites`
-- --
-- ALTER TABLE `favorites`
--   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

-- --
-- -- AUTO_INCREMENT for table `migrations`
-- --
-- ALTER TABLE `migrations`
--   MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

-- --
-- -- AUTO_INCREMENT for table `products`
-- --
-- ALTER TABLE `products`
--   MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

-- --
-- -- AUTO_INCREMENT for table `slide`
-- --
-- ALTER TABLE `slide`
--   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

-- --
-- -- AUTO_INCREMENT for table `type_products`
-- --
-- ALTER TABLE `type_products`
--   MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

-- --
-- -- AUTO_INCREMENT for table `users`
-- --
-- ALTER TABLE `users`
--   MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

-- --
-- -- Constraints for dumped tables
-- --

-- --
-- -- Constraints for table `cartegory`
-- --
-- ALTER TABLE `cartegory`
--   ADD CONSTRAINT `cartegory_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`) ON DELETE SET NULL;

-- --
-- -- Constraints for table `category`
-- --
-- ALTER TABLE `category`
--   ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`) ON DELETE SET NULL;

-- --
-- -- Constraints for table `products`
-- --
-- ALTER TABLE `products`
--   ADD CONSTRAINT `products_id_type_foreign` FOREIGN KEY (`id_type`) REFERENCES `type_products` (`id`);
-- COMMIT;

-- /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
-- /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
-- /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
