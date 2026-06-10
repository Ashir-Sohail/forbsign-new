-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jul 26, 2025 at 07:52 AM
-- Server version: 10.1.38-MariaDB-1~bionic
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_forbsign_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `image`, `phone`, `email`, `password`, `created_at`, `updated_at`) VALUES
(9, 'Admin User', 'https://laravel.com/img/logomark.min.svg', '894849484', 'admin@gmail.com', '$2y$10$1Y8q9vQabpm6VCTmoLDIS.mlxOS9bJm1xREpFOsfMw7KoTMp2/bwu', '2025-07-18 05:47:43', '2025-07-18 05:47:43');

-- --------------------------------------------------------

--
-- Table structure for table `billing_addresses`
--

CREATE TABLE `billing_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address1` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` text COLLATE utf8mb4_unicode_ci,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_input` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `billing_addresses`
--

INSERT INTO `billing_addresses` (`id`, `user_id`, `address1`, `address2`, `zip_code`, `city`, `check_input`, `company`, `contact`, `created_at`, `updated_at`, `phone`) VALUES
(1, 5, 'Lahore guldberg 2 near hico icecream factory', 'dfasfa', '54000', 'Lahore', NULL, NULL, NULL, '2025-07-19 04:36:03', '2025-07-19 04:36:03', '03126521376'),
(2, 7, 'Lahore guldberg 2 near hico icecream factory', 'dfasfa', '54000', 'Lahore', NULL, NULL, '03126521376', '2025-07-19 05:25:48', '2025-07-21 07:03:06', '03126521376');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `meta_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `image`, `name`, `slug`, `status`, `created_at`, `updated_at`, `meta_title`, `meta_url`, `meta_keyword`, `meta_description`) VALUES
(1, 'brand/H0d5dP4x1B9D984jHyr6icjL2iG3j1zIkQm5ASMd.jpg', 'test brands', 'test-brands', 1, '2025-07-18 07:19:20', '2025-07-18 07:19:20', 'test', 'test', '[{\"value\":\"test\"}]', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `selectedFont` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `selectedSize` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overallWidth` decimal(8,2) DEFAULT NULL,
  `selectedSignLayout` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `homeNumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `streetName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `textStyle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `top` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bottom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `image`, `name`, `slug`, `meta_title`, `meta_url`, `meta_keyword`, `meta_description`, `serial`, `status`, `created_at`, `updated_at`, `parent_id`) VALUES
(1, 'category/5haXjnOEglsMFF7osBgW92hg38BDwHiseKVqpWf3.jpg', 'test category', 'test-category', 'test', 'test', '[{\"value\":\"test\"}]', 'test', 1, 1, '2025-07-18 07:16:50', '2025-07-18 07:16:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `child_categories`
--

CREATE TABLE `child_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `sub_cat_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `compares`
--

CREATE TABLE `compares` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_colors`
--

CREATE TABLE `custom_colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hex_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `serial` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_images`
--

CREATE TABLE `custom_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `per_character_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `serial` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_sizes`
--

CREATE TABLE `custom_sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `serial` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq_categories`
--

CREATE TABLE `faq_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manage_sites`
--

CREATE TABLE `manage_sites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manage_sites`
--

INSERT INTO `manage_sites` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(16, 'home_page', '{\"image1\":null,\"image2\":\"home_page\\/9GfuOweUdRdQcPwtq5MbPQMuuBVuHt4rGlC0Fr9l.jpg\",\"title1\":\"test\",\"title2\":\"test\",\"sub_title1\":\"test\",\"sub_title2\":\"test\",\"url1\":\"https:\\/\\/docs.google.com\\/spreadsheets\\/d\\/1lUvf82ReHTL2V1m3najglsZ70B3pMJLxtFUsfnsWyzs\\/edit?gid=0#gid=0\",\"url2\":\"https:\\/\\/docs.google.com\\/spreadsheets\\/d\\/1lUvf82ReHTL2V1m3najglsZ70B3pMJLxtFUsfnsWyzs\\/edit?gid=0#gid=0\"}', '2025-07-19 02:37:04', '2025-07-19 02:37:38');

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_08_06_032636_create_admins_table', 1),
(6, '2023_08_06_034116_create_categories_table', 1),
(7, '2023_08_06_035815_create_sub_categories_table', 1),
(8, '2023_08_06_040751_create_child_categories_table', 1),
(9, '2023_08_06_041648_create_brands_table', 1),
(10, '2023_08_06_042245_create_products_table', 1),
(11, '2023_08_06_045831_create_manage_sites_table', 1),
(12, '2023_08_06_052209_create_sliders_table', 1),
(13, '2023_08_06_053046_create_services_table', 1),
(14, '2023_08_06_071702_create_faq_categories_table', 1),
(15, '2023_08_06_072502_create_faqs_table', 1),
(16, '2023_08_06_073005_create_blog_categories_table', 1),
(17, '2023_08_06_073310_create_blogs_table', 1),
(18, '2023_08_06_092028_create_billing_addresses_table', 1),
(19, '2023_08_06_093017_create_shipping_addresses_table', 1),
(20, '2023_08_06_094451_create_wishlists_table', 1),
(21, '2023_08_06_145523_create_compares_table', 1),
(22, '2023_08_06_145726_create_carts_table', 1),
(23, '2023_08_06_155435_create_subscribes_table', 1),
(24, '2023_08_06_162048_create_contacts_table', 1),
(25, '2023_09_05_182525_add_phone_to_billing_addresses', 1),
(26, '2023_09_11_091731_add_photo_to_users', 1),
(27, '2023_09_12_154611_create_review_table', 1),
(28, '2024_09_15_220841_create_product_sizes_table', 1),
(29, '2024_09_25_222356_update_carts_table_add_fields', 1),
(30, '2025_04_26_093805_add_column_to_brands_table', 1),
(31, '2025_04_28_055358_add_parent_id_to_categories_table', 1),
(32, '2025_04_29_070949_create_options_table', 1),
(33, '2025_05_07_062736_create_option_values_table', 1),
(34, '2025_05_08_095054_create_product_option_values_table', 1),
(35, '2025_05_16_184146_add_check_input_to_billing_addresses_table', 1),
(36, '2025_05_23_053047_drop_cat_id_from_blogs_table', 1),
(37, '2025_05_23_055310_drop_blog_categories_table', 1),
(38, '2025_05_23_061819_add_url_column_to_blogs', 1),
(39, '2025_05_24_055912_add_contact_to_billing_addresses_table', 1),
(40, '2025_05_24_071113_add_url_to_products_table', 1),
(41, '2025_05_28_113438_add_meta_title_to_blogs_table', 1),
(42, '2025_05_30_085812_create_product_options_table', 1),
(43, '2025_06_04_053649_create_orders_table', 1),
(44, '2025_06_04_070959_create_order_items_table', 1),
(45, '2025_06_05_052547_create_transactions_table', 1),
(46, '2025_06_14_071818_add_points_and_weight_to_products_table', 1),
(47, '2025_06_15_153327_add_meta_title_and_meta_url_to_categories_table', 1),
(48, '2025_06_18_050053_create_pages_table', 1),
(49, '2025_06_28_100038_create_custom_images_table', 1),
(50, '2025_06_28_115139_create_custom_sizes_table', 1),
(51, '2025_06_28_121602_create_custom_colors_table', 1),
(52, '2025_06_30_175950_add_customization_to_order_items', 1),
(53, '2025_07_12_113745_add_informative_to_products_table', 1),
(54, '2025_07_12_120657_create_product_enquiries_table', 1),
(55, '2025_07_14_121135_update_products_table_foreign_keys', 1),
(56, '2025_07_18_120744_make_phone_nullable_in_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `image`, `option_name_en`, `option_name_ar`, `input_type`, `serial`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Size', 'Size', 'select', 1, 1, '2025-07-19 05:33:04', '2025-07-21 05:04:24');

-- --------------------------------------------------------

--
-- Table structure for table `option_values`
--

CREATE TABLE `option_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `option_name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_id` bigint(20) UNSIGNED NOT NULL,
  `serial` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `option_values`
--

INSERT INTO `option_values` (`id`, `option_name_en`, `option_name_ar`, `option_id`, `serial`, `image`, `created_at`, `updated_at`) VALUES
(1, '12', '12', 1, 2, '', '2025-07-19 05:33:04', '2025-07-19 05:33:04'),
(2, '14', '14', 1, 1, '', '2025-07-19 05:33:04', '2025-07-19 05:33:04'),
(3, '16', '16', 1, 3, '', '2025-07-19 05:33:04', '2025-07-19 05:33:04'),
(4, '18', '18', 1, 4, '', '2025-07-19 05:33:04', '2025-07-19 05:33:04');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `billing_address_id` bigint(20) UNSIGNED NOT NULL,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `total` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `billing_address_id`, `order_status`, `total`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'processing', 2900, '2025-07-19 04:36:03', '2025-07-19 04:36:10'),
(2, 5, 1, 'processing', 500, '2025-07-19 05:01:54', '2025-07-19 05:01:55'),
(3, 7, 2, 'delivered', 700, '2025-07-19 05:25:48', '2025-07-19 05:30:48'),
(4, 7, 2, 'processing', 1326, '2025-07-21 06:14:53', '2025-07-21 06:15:05'),
(5, 7, 2, 'processing', 400, '2025-07-21 06:17:22', '2025-07-21 06:17:23'),
(6, 7, 2, 'processing', 266, '2025-07-21 06:22:07', '2025-07-21 06:22:08'),
(7, 7, 2, 'processing', 266, '2025-07-21 06:33:26', '2025-07-21 06:33:27'),
(8, 7, 2, 'processing', 200, '2025-07-21 06:35:57', '2025-07-21 06:35:58'),
(9, 7, 2, 'processing', 500, '2025-07-21 06:54:12', '2025-07-21 06:54:14'),
(10, 7, 2, 'processing', 500, '2025-07-21 07:01:52', '2025-07-21 07:01:54'),
(11, 7, 2, 'processing', 1000, '2025-07-21 07:03:06', '2025-07-21 07:03:07'),
(12, 7, 2, 'processing', 500, '2025-07-21 07:06:38', '2025-07-21 07:06:39'),
(13, 7, 2, 'processing', 500, '2025-07-21 07:13:04', '2025-07-21 07:13:06'),
(14, 7, 2, 'processing', 500, '2025-07-21 07:17:52', '2025-07-21 07:17:53'),
(15, 7, 2, 'processing', 500, '2025-07-21 07:30:16', '2025-07-21 07:30:18');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `option_value_ids` text COLLATE utf8mb4_unicode_ci,
  `customization` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `option_value_ids`, `customization`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '500.00', NULL, '{\"text_input\":\"test order\",\"font_style\":\"Arial\",\"text_color\":\"#000000\",\"usage_type\":\"indoor\",\"text_align\":\"left\"}', '2025-07-19 04:36:03', '2025-07-19 04:36:03'),
(2, 1, 2, 12, '200.00', NULL, '{\"text_input\":\"r34wee d23wqe 23\",\"font_style\":\"Arial\",\"text_color\":\"#000000\",\"usage_type\":\"indoor\",\"text_align\":\"left\"}', '2025-07-19 04:36:03', '2025-07-19 04:36:03'),
(3, 2, 1, 1, '500.00', NULL, '{\"text_input\":\"ersdfredfcerwesdfc 23we e23 e\",\"font_style\":\"Arial\",\"text_color\":\"#000000\",\"usage_type\":\"indoor\",\"text_align\":\"right\"}', '2025-07-19 05:01:54', '2025-07-19 05:01:54'),
(4, 3, 2, 1, '200.00', NULL, '{\"text_input\":\"3wer d23 qwe\",\"font_style\":\"Arial\",\"text_color\":\"#000000\",\"usage_type\":\"indoor\",\"text_align\":\"left\"}', '2025-07-19 05:25:48', '2025-07-19 05:25:48'),
(5, 3, 1, 1, '500.00', NULL, '{\"text_input\":\"wee 23 rd2 3\",\"font_style\":\"Arial\",\"text_color\":\"#000000\",\"usage_type\":\"outdoor\",\"text_align\":\"left\"}', '2025-07-19 05:25:48', '2025-07-19 05:25:48'),
(6, 4, 3, 1, '100.00', '[\"1\"]', '{\"text_input\":\"Test Name Plate\",\"font_style\":\"Arial\",\"text_color\":\"#000000\",\"usage_type\":\"indoor\",\"text_align\":\"left\"}', '2025-07-21 06:14:53', '2025-07-21 06:14:53'),
(7, 4, 3, 3, '320.00', '[\"3\"]', '{\"text_input\":\"test order\",\"font_style\":\"Arial\",\"text_color\":\"#000000\",\"usage_type\":\"indoor\",\"text_align\":\"left\"}', '2025-07-21 06:14:53', '2025-07-21 06:14:53'),
(8, 4, 3, 1, '266.00', '[\"2\"]', '{\"text_input\":\"test\",\"font_style\":\"Arial\",\"text_color\":\"#000000\",\"usage_type\":\"outdoor\",\"text_align\":\"left\"}', '2025-07-21 06:14:53', '2025-07-21 06:14:53'),
(9, 5, 3, 1, '400.00', '[\"4\"]', '{\"text_input\":\"test order\",\"font_style\":\"Arial\",\"text_color\":\"#000000\",\"usage_type\":\"outdoor\",\"text_align\":\"left\"}', '2025-07-21 06:17:22', '2025-07-21 06:17:22'),
(10, 6, 3, 1, '266.00', '[\"2\"]', '{\"text_input\":\"3wedrf\",\"font_style\":\"Arial\",\"text_color\":\"#000000\",\"usage_type\":\"outdoor\",\"text_align\":\"left\"}', '2025-07-21 06:22:07', '2025-07-21 06:22:07'),
(11, 7, 3, 1, '266.00', '[\"2\"]', '{\"text_input\":\"3erf\",\"font_style\":\"Arial\",\"text_color\":\"#000000\",\"usage_type\":\"indoor\",\"text_align\":\"left\"}', '2025-07-21 06:33:26', '2025-07-21 06:33:26'),
(12, 8, 2, 1, '200.00', NULL, '{\"text_input\":\"ef ew rd\",\"font_style\":\"Arial\",\"text_color\":\"#000000\",\"usage_type\":\"indoor\",\"text_align\":\"left\"}', '2025-07-21 06:35:57', '2025-07-21 06:35:57'),
(13, 9, 1, 1, '500.00', NULL, '{\"text_input\":\"test\",\"font_style\":\"Georgia\",\"text_color\":\"#000000\",\"usage_type\":\"indoor\",\"text_align\":\"left\"}', '2025-07-21 06:54:12', '2025-07-21 06:54:12'),
(14, 10, 1, 1, '500.00', NULL, '{\"text_input\":\"hi, what are you doing\",\"font_style\":\"Arial\",\"text_color\":\"#000000\",\"usage_type\":\"outdoor\",\"text_align\":\"center\"}', '2025-07-21 07:01:52', '2025-07-21 07:01:52'),
(15, 11, 1, 2, '500.00', NULL, '{\"text_input\":\"fsdsd\",\"font_style\":\"Arial\",\"text_color\":\"#000000\",\"usage_type\":\"indoor\",\"text_align\":\"left\"}', '2025-07-21 07:03:06', '2025-07-21 07:03:06'),
(16, 12, 1, 1, '500.00', NULL, '{\"text_input\":\"test\",\"font_style\":\"Arial\",\"text_color\":\"#c81414\",\"usage_type\":\"indoor\",\"text_align\":\"center\"}', '2025-07-21 07:06:38', '2025-07-21 07:06:38'),
(17, 13, 1, 1, '500.00', NULL, '{\"text_input\":\"test\",\"font_style\":\"Georgia\",\"text_color\":\"#000000\",\"usage_type\":\"indoor\",\"text_align\":\"left\"}', '2025-07-21 07:13:04', '2025-07-21 07:13:04'),
(18, 14, 1, 1, '500.00', NULL, '{\"text_input\":\"test\",\"font_style\":\"Times New Roman\",\"text_color\":\"#f23131\",\"usage_type\":\"indoor\",\"text_align\":\"center\"}', '2025-07-21 07:17:52', '2025-07-21 07:17:52'),
(19, 15, 1, 1, '500.00', NULL, '{\"text_input\":\"test\",\"font_style\":\"Courier New\",\"text_color\":\"#000000\",\"usage_type\":\"indoor\",\"text_align\":\"left\"}', '2025-07-21 07:30:16', '2025-07-21 07:30:16');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `meta_url`, `type`, `created_at`, `updated_at`) VALUES
(7, 'About Us', 'This is the About Us page.', 'About Us - Company Info', 'Learn about our company, team, and mission.', 'about us, company, team, mission', 'about-us', 'about_us', '2025-07-18 05:47:43', '2025-07-18 05:47:43'),
(8, 'Terms & Conditions', 'These are the terms and conditions.', 'Terms & Conditions - Our Policies', 'Read our website terms, usage policy, and conditions.', 'terms, conditions, policy', 'terms-and-conditions', 'terms_condition', '2025-07-18 05:47:43', '2025-07-18 05:47:43'),
(9, 'Delivery Information', 'Details about how and when we deliver products.', 'Delivery Info - Shipping & Time', 'Understand our delivery policies and timelines.', 'delivery, shipping, shipping time, delivery info', 'delivery-information', 'delivery_info', '2025-07-18 05:47:43', '2025-07-18 05:47:43');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `short_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `specifications` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `meta_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_price` decimal(10,2) NOT NULL,
  `previous_price` decimal(10,2) NOT NULL,
  `points` int(11) DEFAULT NULL,
  `weight` decimal(8,2) DEFAULT NULL,
  `cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_stock` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `informative` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `featured_image`, `images`, `short_description`, `description`, `specifications`, `meta_title`, `meta_keyword`, `meta_description`, `meta_url`, `current_price`, `previous_price`, `points`, `weight`, `cat_id`, `brand_id`, `total_stock`, `status`, `informative`, `created_at`, `updated_at`) VALUES
(1, 'test product', 'test-product', 'products/test-product/IJ8n2ws5PsgovAINmj9MHxvgdqx30jWzlj5JHcDz.jpg', '[\"products\\/test-product\\/2koCWwL9hRegI4N74YjioR5uwg1z7MhgVG1xCN2x.jpg\",\"products\\/test-product\\/mnf64xsuCGVVU7l9OlSWSOAbi2A0bMoctPJbDp65.jpg\"]', 'test', 'test', NULL, 'test', '[{\"value\":\"test\"}]', 'test', 'test', '500.00', '2000.00', 2, '1.00', 1, 1, '4', 1, 0, '2025-07-18 07:21:00', '2025-07-21 07:30:16'),
(2, 'nemo product', 'nemo-product', 'products/nemo-product/x4T0jyZWOIoICrF2ErNHgKIvTzHgzzu3oGQiUKpQ.jpg', '[\"products\\/nemo-product\\/hxvpeOFMwr5uae4ZHlwIjyeWJzckzo06Pgxk2cjx.jpg\",\"products\\/nemo-product\\/h7Mz3fakqnC4JZdz0ygZ5IAGmA0vzfyl0pAlPc0J.jpg\",\"products\\/nemo-product\\/598Fu1zuVc4crWCzQJedi6kvkAVXy0zx8zTnorQo.jpg\",\"products\\/nemo-product\\/giI80B9Y7fUbWGcb4m7CkLWt2goMjlTXBkcYNyQF.jpg\"]', 'test', 'test', NULL, 'test', '[{\"value\":\"test\"}]', 'test', 'test', '200.00', '10001.00', 2, '2.00', 1, 1, '10', 1, 0, '2025-07-18 07:50:53', '2025-07-21 06:35:57'),
(3, 'Name Plate 2025', 'name-plate-2025', 'products/name-plate/ZNZjtA8gSwdK8kW4CJl2JwpmuP0iYjD2npsXNcna.jpg', '[\"products\\/name-plate\\/zwU8i9tua5getrfcSXgLOixh97KJwTpxmeCBa2L5.jpg\",\"products\\/name-plate\\/kanelaNGrbJwnRacHDOoJoIUxPCdgR2xfnGMHDQW.jpg\",\"products\\/name-plate\\/QtPR0XfxJqpVzXVdJ4PpWyHwza0yXIXDOneeyVqR.jpg\",\"products\\/name-plate\\/9D4WkHcdC7lIP6MapXnw9OayEEr9x5rLv8UyDAPP.jpg\"]', 'test name plate 2022', 'test name plate 2022 test name plate 2022 test name plate 2022test name plate 2022 test name plate 2022 test name plate 2022 test name plate 2022', NULL, 'name plate', '[{\"value\":\"customised name plate\"}]', 'test name plate 2022 test name plate 2022test name plate 2022', 'name-plate', '200.00', '300.00', 232, '0.50', 1, 1, '100', 1, 0, '2025-07-19 05:37:01', '2025-07-19 05:45:19');

-- --------------------------------------------------------

--
-- Table structure for table `product_enquiries`
--

CREATE TABLE `product_enquiries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_enquiries`
--

INSERT INTO `product_enquiries` (`id`, `product_id`, `name`, `email`, `contact_number`, `message`, `file`, `created_at`, `updated_at`) VALUES
(1, 3, 'Ashir Sohail', 'sohailashir786@gmail.com', '03126521376', 'What the reson of this product?', 'product_enquiriy/176bnN4jj2kfY9cCxOwIr8EaqZzoMxIIF5VSDP8x.jpg', '2025-07-19 05:40:23', '2025-07-19 05:40:23');

-- --------------------------------------------------------

--
-- Table structure for table `product_options`
--

CREATE TABLE `product_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `option_id` bigint(20) UNSIGNED NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_options`
--

INSERT INTO `product_options` (`id`, `product_id`, `option_id`, `required`, `created_at`, `updated_at`) VALUES
(2, 3, 1, 1, '2025-07-19 05:59:07', '2025-07-19 05:59:07');

-- --------------------------------------------------------

--
-- Table structure for table `product_option_values`
--

CREATE TABLE `product_option_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `option_value_id` bigint(20) UNSIGNED NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `subtract` tinyint(1) NOT NULL DEFAULT '1',
  `price_prefix` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '+',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `points_prefix` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '+',
  `points` int(11) NOT NULL DEFAULT '0',
  `weight_prefix` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '+',
  `weight` decimal(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_option_values`
--

INSERT INTO `product_option_values` (`id`, `product_id`, `option_value_id`, `required`, `quantity`, `subtract`, `price_prefix`, `price`, `points_prefix`, `points`, `weight_prefix`, `weight`, `created_at`, `updated_at`) VALUES
(5, 3, 1, 0, 24, 1, '-', '100.00', '+', 20, '+', '20.00', '2025-07-19 05:59:07', '2025-07-21 06:14:53'),
(6, 3, 2, 0, 22, 1, '+', '66.00', '+', 30, '+', '10.00', '2025-07-19 05:59:07', '2025-07-21 06:33:26'),
(7, 3, 3, 0, 22, 1, '+', '120.00', '+', 40, '+', '5.00', '2025-07-19 05:59:07', '2025-07-21 06:14:53'),
(8, 3, 4, 0, 24, 1, '+', '200.00', '+', 50, '+', '20.00', '2025-07-19 05:59:07', '2025-07-21 06:17:22');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `image`, `title`, `details`, `created_at`, `updated_at`) VALUES
(1, 'service/DED6EITltGSgKSn4OHz7KCRYs892KTp9QYOtbZsn.jpg', 'wqsd', 'ewsdwe', '2025-07-19 01:25:55', '2025-07-19 01:25:55'),
(2, 'service/uuormDtWpUK3KV0M5t2OkXg8t1Sq2DB9aSblHfC0.jpg', '3w23qw', '2ewsfdweds 2qws', '2025-07-19 01:26:12', '2025-07-19 01:27:10');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_addresses`
--

CREATE TABLE `shipping_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address1` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` text COLLATE utf8mb4_unicode_ci,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `details`, `url`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Home Essentials', 'Help You Create Something Special', 'https://www.awesomescreenshot.com/', 'slider/Em5lhzd6bPjSe9JXtYnkJf2b4IQtj9Q5L61t7qhE.jpg', '2025-07-19 00:56:53', '2025-07-19 01:15:06'),
(2, 'Title Image', 'Data collection is the process of gathering', 'https://imgbb.com/', 'slider/SrPg5jctOly7XLZ1mxfbdDd0k2FtYlShvQB20jKE.jpg', '2025-07-19 01:17:12', '2025-07-19 01:24:50');

-- --------------------------------------------------------

--
-- Table structure for table `subscribes`
--

CREATE TABLE `subscribes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribes`
--

INSERT INTO `subscribes` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'sohailashir786@gmail.com', '2025-07-18 07:15:03', '2025-07-18 07:15:03');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_charge_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `order_id`, `user_id`, `total_amount`, `payment_status`, `payment_method`, `stripe_charge_id`, `created_at`, `updated_at`) VALUES
(1, 1, 5, '2900.00', 'paid', 'stripe', 'ch_3RmXBY4hZpYkYpha0WalY8eW', '2025-07-19 04:36:10', '2025-07-19 04:36:10'),
(2, 2, 5, '500.00', 'paid', 'stripe', 'ch_3RmXaZ4hZpYkYpha1IYByfau', '2025-07-19 05:01:55', '2025-07-19 05:01:55'),
(3, 3, 7, '700.00', 'paid', 'stripe', 'ch_3RmXxg4hZpYkYpha0Cb50hpC', '2025-07-19 05:25:49', '2025-07-19 05:25:49'),
(4, 4, 7, '1326.00', 'paid', 'stripe', 'ch_3RnHgJ4hZpYkYpha1guc4UFe', '2025-07-21 06:15:05', '2025-07-21 06:15:05'),
(5, 5, 7, '400.00', 'paid', 'stripe', 'ch_3RnHih4hZpYkYpha0ltdgRIj', '2025-07-21 06:17:23', '2025-07-21 06:17:23'),
(6, 6, 7, '266.00', 'paid', 'stripe', 'ch_3RnHnH4hZpYkYpha1bZ9zjkz', '2025-07-21 06:22:08', '2025-07-21 06:22:08'),
(7, 7, 7, '266.00', 'paid', 'stripe', 'ch_3RnHyF4hZpYkYpha0MboH9DK', '2025-07-21 06:33:27', '2025-07-21 06:33:27'),
(8, 8, 7, '200.00', 'paid', 'stripe', 'ch_3RnI0g4hZpYkYpha16w6ZX15', '2025-07-21 06:35:58', '2025-07-21 06:35:58'),
(9, 9, 7, '500.00', 'paid', 'stripe', 'ch_3RnIIL4hZpYkYpha0kRaOCQQ', '2025-07-21 06:54:14', '2025-07-21 06:54:14'),
(10, 10, 7, '500.00', 'paid', 'stripe', 'ch_3RnIPl4hZpYkYpha1sVnMd6E', '2025-07-21 07:01:54', '2025-07-21 07:01:54'),
(11, 11, 7, '1000.00', 'paid', 'stripe', 'ch_3RnIQx4hZpYkYpha1q2llAMc', '2025-07-21 07:03:07', '2025-07-21 07:03:07'),
(12, 12, 7, '500.00', 'paid', 'stripe', 'ch_3RnIUN4hZpYkYpha1eaBuON9', '2025-07-21 07:06:39', '2025-07-21 07:06:39'),
(13, 13, 7, '500.00', 'paid', 'stripe', 'ch_3RnIab4hZpYkYpha0hYrKICF', '2025-07-21 07:13:06', '2025-07-21 07:13:06'),
(14, 14, 7, '500.00', 'paid', 'stripe', 'ch_3RnIfF4hZpYkYpha13nXvf2U', '2025-07-21 07:17:53', '2025-07-21 07:17:53'),
(15, 15, 7, '500.00', 'paid', 'stripe', 'ch_3RnIrF4hZpYkYpha06Ij9yqq', '2025-07-21 07:30:18', '2025-07-21 07:30:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `name`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `photo`) VALUES
(4, 'test', 'order', 'test order', 'testorder@gmail.com', NULL, NULL, '$2y$10$ZdrmXzvHnQELUU9bFbxV6eEEvriE4woSu.LwJV58x3Cfv8ND68Lmi', NULL, '2025-07-19 03:05:37', '2025-07-19 03:05:37', 'null'),
(5, 'test', 'account', 'test account', 'testaccount@gmail.com', NULL, NULL, '$2y$10$aH14JDhOOSC2hJljTcrIgOplzR9jWOjiuMG0giIcUeaVBFBR1dkgm', NULL, '2025-07-19 03:22:01', '2025-07-19 04:27:44', 'users/5/profile.jpg'),
(6, 'Mrs Elon', 'Usman Ijaz', 'test accounts', 'testaccountsss@gmail.com', '031242333242', NULL, '$2y$10$fR7DhMZHvmxxa/y4tQqo6.rW.MiS4bCApkY/4frOE0HYz8DKn80qO', NULL, '2025-07-19 03:24:03', '2025-07-19 03:28:01', 'null'),
(7, 'test', 'one', 'test one', 'testone@gmail.com', NULL, NULL, '$2y$10$gkGkxSv06EDANmUhUWxy0O7MIrOlqya6eRPxbY1YtVL.UHV3m/IK2', NULL, '2025-07-19 05:12:53', '2025-07-19 05:12:53', 'null'),
(8, 'Ashir', 'Sohail', 'Ashir Sohail', 'sohailashir786@gmail.com', NULL, NULL, '$2y$10$eKU0VgSIzA6PsWTWooV9vuqsXwb7tzLcIijr6HZ10ajyonA2GivKm', NULL, '2025-07-21 23:54:59', '2025-07-21 23:54:59', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 4, '2025-07-19 03:05:48', '2025-07-19 03:05:48'),
(2, 1, 4, '2025-07-19 03:08:12', '2025-07-19 03:08:12'),
(3, 1, 5, '2025-07-19 05:01:33', '2025-07-19 05:01:33'),
(4, 2, 5, '2025-07-19 05:06:53', '2025-07-19 05:06:53'),
(8, 1, 7, '2025-07-19 05:16:19', '2025-07-19 05:16:19'),
(9, 3, 7, '2025-07-21 05:39:23', '2025-07-21 05:39:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing_addresses`
--
ALTER TABLE `billing_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `billing_addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `compares`
--
ALTER TABLE `compares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compares_product_id_foreign` (`product_id`),
  ADD KEY `compares_user_id_foreign` (`user_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_colors`
--
ALTER TABLE `custom_colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_images`
--
ALTER TABLE `custom_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_sizes`
--
ALTER TABLE `custom_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faqs_cat_id_foreign` (`cat_id`);

--
-- Indexes for table `manage_sites`
--
ALTER TABLE `manage_sites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `option_values`
--
ALTER TABLE `option_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `option_values_option_id_foreign` (`option_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_billing_address_id_foreign` (`billing_address_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`(191),`tokenable_id`);

--
-- Indexes for table `product_enquiries`
--
ALTER TABLE `product_enquiries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_enquiries_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_options`
--
ALTER TABLE `product_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_options_product_id_foreign` (`product_id`),
  ADD KEY `product_options_option_id_foreign` (`option_id`);

--
-- Indexes for table `product_option_values`
--
ALTER TABLE `product_option_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_option_values_product_id_foreign` (`product_id`),
  ADD KEY `product_option_values_option_value_id_foreign` (`option_value_id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_sizes_product_id_foreign` (`product_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_product_id_foreign` (`product_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipping_addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribes`
--
ALTER TABLE `subscribes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_order_id_foreign` (`order_id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `billing_addresses`
--
ALTER TABLE `billing_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `compares`
--
ALTER TABLE `compares`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_colors`
--
ALTER TABLE `custom_colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_images`
--
ALTER TABLE `custom_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_sizes`
--
ALTER TABLE `custom_sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
