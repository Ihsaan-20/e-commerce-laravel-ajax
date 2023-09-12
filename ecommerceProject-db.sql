/*
SQLyog Ultimate v12.5.0 (64 bit)
MySQL - 10.4.27-MariaDB : Database - ecommerceproject
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ecommerceproject` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `ecommerceproject`;

/*Table structure for table `brands` */

DROP TABLE IF EXISTS `brands`;

CREATE TABLE `brands` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('active','block') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `brands` */

insert  into `brands`(`id`,`brand_name`,`slug`,`status`,`created_at`,`updated_at`) values 
(3,'Dell Computers','dell-computers','active','2023-09-08 19:51:31','2023-09-08 19:51:31'),
(4,'Hp Computers','hp-computers','active','2023-09-08 19:51:43','2023-09-10 13:35:58'),
(6,'Samsung Mobiles','samsung-mobiles','active','2023-09-08 19:52:16','2023-09-10 13:35:54'),
(7,'Oppo Mobiles','oppo-mobiles','active','2023-09-08 19:57:30','2023-09-08 20:18:16');

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('active','block') NOT NULL DEFAULT 'active',
  `show` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categories` */

insert  into `categories`(`id`,`category_name`,`slug`,`image`,`status`,`show`,`created_at`,`updated_at`) values 
(38,'Communication Devices','communication-devices',NULL,'block','no','2023-09-08 19:53:42','2023-09-09 20:19:20'),
(40,'Entertainment Devices','entertainment-devices',NULL,'block','no','2023-09-08 19:54:22','2023-09-09 20:19:14'),
(41,'Home Automation Devices','home-automation-devices',NULL,'block','no','2023-09-08 19:54:38','2023-09-09 20:19:05'),
(42,'Wearable Devices','wearable-devices',NULL,'block','no','2023-09-08 19:54:55','2023-09-09 20:18:59'),
(44,'Shopping Shoes','shopping-shoes',NULL,'block','no','2023-09-09 19:49:39','2023-09-09 20:18:50'),
(45,'Men\'s Fashion','mens-fashion','45-1694336918.jpg','active','yes','2023-09-09 20:19:58','2023-09-10 09:08:39'),
(46,'Women\'s Fashion','womens-fashion','46-1694336154.jpg','active','yes','2023-09-09 20:20:17','2023-09-10 08:55:55'),
(47,'Electronics','electronics','47-1694336808.jpg','active','yes','2023-09-09 20:20:50','2023-09-10 09:06:48'),
(48,'Applicances','applicances','48-1694336751.jpg','active','yes','2023-09-09 20:21:04','2023-09-10 09:05:51'),
(49,'Ihsaan Chandio','ihsaan-chandio','49.png','active','yes','2023-09-10 13:22:39','2023-09-10 13:22:39');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_reset_tokens_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2023_09_03_143314_alter_users_table',1),
(6,'2023_09_04_065243_create_categories_table',1),
(7,'2023_09_04_141804_create_temp_images_table',2),
(8,'2023_09_06_200558_create_sub_categories_table',3),
(9,'2023_09_07_161027_create_brands_table',4),
(10,'2023_09_07_164107_create_brands_table',5),
(11,'2023_09_08_101520_create_products_table',6),
(12,'2023_09_08_101528_create_product_images_table',6),
(13,'2023_09_08_134322_modify_products_table',7),
(14,'2023_09_09_193807_alter_categories_table',8),
(15,'2023_09_09_194140_alter_categories_table',9),
(16,'2023_09_09_194317_alter_categories_table',10),
(17,'2023_09_09_194456_alter_categories_table',11),
(18,'2023_09_09_195148_alter_sub_categories_table',12);

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `product_images` */

DROP TABLE IF EXISTS `product_images`;

CREATE TABLE `product_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_product_id_foreign` (`product_id`),
  CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_images` */

insert  into `product_images`(`id`,`product_id`,`image`,`sort_order`,`created_at`,`updated_at`) values 
(49,25,'25-49-1694338483.jpg',NULL,'2023-09-10 09:34:43','2023-09-10 09:34:43'),
(50,26,'26-50-1694338624.jpg',NULL,'2023-09-10 09:37:04','2023-09-10 09:37:04'),
(51,27,'27-51-1694338772.jpg',NULL,'2023-09-10 09:39:32','2023-09-10 09:39:32'),
(52,28,'28-52-1694338833.jpg',NULL,'2023-09-10 09:40:33','2023-09-10 09:40:33'),
(53,29,'29-53-1694340699.jpg',NULL,'2023-09-10 10:11:39','2023-09-10 10:11:39'),
(54,26,'26-54-1694345625.jpg',NULL,'2023-09-10 11:33:45','2023-09-10 11:33:45'),
(55,26,'26-55-1694345633.jpg',NULL,'2023-09-10 11:33:53','2023-09-10 11:33:53');

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned NOT NULL,
  `sub_category_id` bigint(20) unsigned DEFAULT NULL,
  `brand_id` bigint(20) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` double(10,2) NOT NULL,
  `compare_price` double(10,2) DEFAULT NULL,
  `is_featured` enum('yes','no') NOT NULL DEFAULT 'no',
  `sku` varchar(255) NOT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `track_qty` enum('yes','no') NOT NULL DEFAULT 'yes',
  `qty` int(11) DEFAULT NULL,
  `status` enum('active','block') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_sub_category_id_foreign` (`sub_category_id`),
  KEY `products_brand_id_foreign` (`brand_id`),
  CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `products` */

insert  into `products`(`id`,`category_id`,`sub_category_id`,`brand_id`,`title`,`slug`,`description`,`price`,`compare_price`,`is_featured`,`sku`,`barcode`,`track_qty`,`qty`,`status`,`created_at`,`updated_at`) values 
(25,47,46,NULL,'Sony Camera','sony-camera','<p>This is sony camera..</p>',1500.00,1650.00,'yes','SNY-01',NULL,'yes',10,'active','2023-09-10 09:34:43','2023-09-10 09:37:15'),
(26,47,32,7,'Andriod Watch','andriod-watch','<p>this is Andriod watch</p>',500.00,550.00,'yes','ANW-01',NULL,'yes',10,'active','2023-09-10 09:37:04','2023-09-10 09:37:04'),
(27,45,39,NULL,'Nikke Shoes','nikke-shoes','<p>this is nike shoes...</p>',1500.00,1850.00,'yes','NIK-025',NULL,'yes',100,'active','2023-09-10 09:39:32','2023-09-10 09:39:32'),
(28,46,40,NULL,'Female\'s Upper','females-upper','<p>This is female\'s upper</p>',350.00,550.00,'yes','FLU-152',NULL,'yes',100,'active','2023-09-10 09:40:33','2023-09-10 09:40:33'),
(29,46,42,NULL,'Face wash for female','face-wash-for-female','<p>females facewash</p>',150.00,250.00,'no','FWC-555',NULL,'yes',200,'active','2023-09-10 10:11:39','2023-09-10 10:11:39');

/*Table structure for table `sub_categories` */

DROP TABLE IF EXISTS `sub_categories`;

CREATE TABLE `sub_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sub_cate_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `status` varchar(255) NOT NULL,
  `show` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_categories_category_id_foreign` (`category_id`),
  CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sub_categories` */

insert  into `sub_categories`(`id`,`sub_cate_name`,`slug`,`category_id`,`status`,`show`,`created_at`,`updated_at`) values 
(32,'Mobile','mobile',47,'active','yes','2023-09-09 20:22:14','2023-09-09 20:22:14'),
(33,'Tablets','tablets',47,'active','yes','2023-09-09 20:22:26','2023-09-09 21:10:27'),
(34,'Leptops','leptops',47,'active','yes','2023-09-09 20:22:40','2023-09-09 21:10:33'),
(35,'Speakers','speakers',48,'active','yes','2023-09-09 20:22:53','2023-09-09 20:22:53'),
(36,'Watches','watches',48,'active','yes','2023-09-09 20:23:03','2023-09-09 20:23:03'),
(37,'Shirts-m','shirts-m',45,'active','yes','2023-09-09 20:23:32','2023-09-09 21:11:21'),
(38,'Jeans-m','jeans-m',45,'active','yes','2023-09-09 20:23:48','2023-09-09 20:23:48'),
(39,'Shoes-m','shoes-m',45,'active','yes','2023-09-09 20:24:01','2023-09-09 20:24:01'),
(40,'T-shirts-w','t-shirts-w',46,'active','yes','2023-09-09 20:24:20','2023-09-09 20:24:20'),
(41,'Jeans-w','jeans-w',46,'active','yes','2023-09-09 20:24:46','2023-09-09 21:11:00'),
(42,'Perfumes-w','perfumes-w',46,'active','yes','2023-09-09 20:25:03','2023-09-09 21:10:55'),
(43,'Tv','tv',48,'active','yes','2023-09-09 20:25:25','2023-09-09 20:25:25'),
(44,'Washing Machines','washing-machines',48,'active','no','2023-09-09 20:25:41','2023-09-09 21:09:38'),
(45,'Air Conditioner','air-conditioner',48,'active','yes','2023-09-09 20:26:01','2023-09-09 21:09:34'),
(46,'Cameras','cameras',47,'active','yes','2023-09-10 09:31:00','2023-09-10 10:00:47'),
(47,'Graphic Design','graphic-design',49,'active','no','2023-09-10 13:29:01','2023-09-10 13:29:25');

/*Table structure for table `temp_images` */

DROP TABLE IF EXISTS `temp_images`;

CREATE TABLE `temp_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `temp_images` */

insert  into `temp_images`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'1693989643-jpg','2023-09-06 08:40:43','2023-09-06 08:40:43'),
(2,'1693989734-PNG','2023-09-06 08:42:14','2023-09-06 08:42:14'),
(3,'1693989816.PNG','2023-09-06 08:43:36','2023-09-06 08:43:36'),
(4,'1693989929.png','2023-09-06 08:45:29','2023-09-06 08:45:29'),
(5,'1693990194.PNG','2023-09-06 08:49:54','2023-09-06 08:49:54'),
(6,'1693990246.PNG','2023-09-06 08:50:46','2023-09-06 08:50:46'),
(7,'1693990315.PNG','2023-09-06 08:51:55','2023-09-06 08:51:55'),
(8,'1693991119.png','2023-09-06 09:05:19','2023-09-06 09:05:19'),
(9,'1693995769.PNG','2023-09-06 10:22:49','2023-09-06 10:22:49'),
(10,'1693995810.PNG','2023-09-06 10:23:30','2023-09-06 10:23:30'),
(11,'1694001287.PNG','2023-09-06 11:54:47','2023-09-06 11:54:47'),
(12,'1694001298.PNG','2023-09-06 11:54:58','2023-09-06 11:54:58'),
(13,'1694001661.PNG','2023-09-06 12:01:01','2023-09-06 12:01:01'),
(14,'1694002359.PNG','2023-09-06 12:12:39','2023-09-06 12:12:39'),
(15,'1694002468.PNG','2023-09-06 12:14:28','2023-09-06 12:14:28'),
(16,'1694002528.png','2023-09-06 12:15:28','2023-09-06 12:15:28'),
(17,'1694002767.png','2023-09-06 12:19:27','2023-09-06 12:19:27'),
(18,'1694005292.PNG','2023-09-06 13:01:32','2023-09-06 13:01:32'),
(19,'1694027013.PNG','2023-09-06 19:03:33','2023-09-06 19:03:33'),
(20,'1694027044.png','2023-09-06 19:04:04','2023-09-06 19:04:04'),
(21,'1694029883.png','2023-09-06 19:51:23','2023-09-06 19:51:23'),
(22,'1694079971.png','2023-09-07 09:46:11','2023-09-07 09:46:11'),
(23,'1694081905.jfif','2023-09-07 10:18:25','2023-09-07 10:18:25'),
(24,'1694082726.jfif','2023-09-07 10:32:06','2023-09-07 10:32:06'),
(25,'1694082739.jfif','2023-09-07 10:32:19','2023-09-07 10:32:19'),
(26,'1694082781.jfif','2023-09-07 10:33:01','2023-09-07 10:33:01'),
(27,'1694083605.jfif','2023-09-07 10:46:45','2023-09-07 10:46:45'),
(28,'1694083617.jfif','2023-09-07 10:46:57','2023-09-07 10:46:57'),
(29,'1694189533.jfif','2023-09-08 16:12:13','2023-09-08 16:12:13'),
(30,'1694189538.jfif','2023-09-08 16:12:18','2023-09-08 16:12:18'),
(31,'1694189538.jfif','2023-09-08 16:12:18','2023-09-08 16:12:18'),
(32,'1694190102.jfif','2023-09-08 16:21:42','2023-09-08 16:21:42'),
(33,'1694190103.jfif','2023-09-08 16:21:43','2023-09-08 16:21:43'),
(34,'1694190121.jfif','2023-09-08 16:22:01','2023-09-08 16:22:01'),
(35,'1694190128.jfif','2023-09-08 16:22:08','2023-09-08 16:22:08'),
(36,'1694190129.jfif','2023-09-08 16:22:09','2023-09-08 16:22:09'),
(37,'1694191138.jfif','2023-09-08 16:38:58','2023-09-08 16:38:58'),
(38,'1694191138.jfif','2023-09-08 16:38:58','2023-09-08 16:38:58'),
(39,'1694191139.PNG','2023-09-08 16:38:59','2023-09-08 16:38:59'),
(40,'1694191140.png','2023-09-08 16:39:00','2023-09-08 16:39:00'),
(41,'1694191140.png','2023-09-08 16:39:00','2023-09-08 16:39:00'),
(42,'1694191342.jfif','2023-09-08 16:42:22','2023-09-08 16:42:22'),
(43,'1694191343.jfif','2023-09-08 16:42:23','2023-09-08 16:42:23'),
(44,'1694191792.PNG','2023-09-08 16:49:52','2023-09-08 16:49:52'),
(45,'1694191876.png','2023-09-08 16:51:16','2023-09-08 16:51:16'),
(46,'1694192078.jfif','2023-09-08 16:54:38','2023-09-08 16:54:38'),
(47,'1694192317.jfif','2023-09-08 16:58:37','2023-09-08 16:58:37'),
(48,'1694192407.jfif','2023-09-08 17:00:07','2023-09-08 17:00:07'),
(49,'1694202333.png','2023-09-08 19:45:33','2023-09-08 19:45:33'),
(50,'1694203243.jpg','2023-09-08 20:00:43','2023-09-08 20:00:43'),
(51,'1694203738.jpg','2023-09-08 20:08:58','2023-09-08 20:08:58'),
(52,'1694203741.jpg','2023-09-08 20:09:01','2023-09-08 20:09:01'),
(53,'1694204112.jpg','2023-09-08 20:15:12','2023-09-08 20:15:12'),
(54,'1694248533.png','2023-09-09 08:35:33','2023-09-09 08:35:33'),
(55,'1694261309.PNG','2023-09-09 12:08:29','2023-09-09 12:08:29'),
(56,'1694261311.png','2023-09-09 12:08:31','2023-09-09 12:08:31'),
(57,'1694261733.png','2023-09-09 12:15:33','2023-09-09 12:15:33'),
(58,'1694262263.PNG','2023-09-09 12:24:23','2023-09-09 12:24:23'),
(59,'1694262264.PNG','2023-09-09 12:24:24','2023-09-09 12:24:24'),
(60,'1694262264.PNG','2023-09-09 12:24:24','2023-09-09 12:24:24'),
(61,'1694262264.PNG','2023-09-09 12:24:24','2023-09-09 12:24:24'),
(62,'1694262265.png','2023-09-09 12:24:25','2023-09-09 12:24:25'),
(63,'1694262667.PNG','2023-09-09 12:31:07','2023-09-09 12:31:07'),
(64,'1694262667.PNG','2023-09-09 12:31:07','2023-09-09 12:31:07'),
(65,'1694262942.PNG','2023-09-09 12:35:42','2023-09-09 12:35:42'),
(66,'1694262945.PNG','2023-09-09 12:35:45','2023-09-09 12:35:45'),
(67,'1694262949.PNG','2023-09-09 12:35:49','2023-09-09 12:35:49'),
(68,'1694262949.png','2023-09-09 12:35:49','2023-09-09 12:35:49'),
(69,'1694262956.png','2023-09-09 12:35:56','2023-09-09 12:35:56'),
(70,'1694262959.PNG','2023-09-09 12:35:59','2023-09-09 12:35:59'),
(71,'1694262962.png','2023-09-09 12:36:02','2023-09-09 12:36:02'),
(72,'1694263089.PNG','2023-09-09 12:38:09','2023-09-09 12:38:09'),
(73,'1694263091.png','2023-09-09 12:38:11','2023-09-09 12:38:11'),
(74,'1694263100.png','2023-09-09 12:38:20','2023-09-09 12:38:20'),
(75,'1694266117.jpg','2023-09-09 13:28:37','2023-09-09 13:28:37'),
(76,'1694266119.jpg','2023-09-09 13:28:39','2023-09-09 13:28:39'),
(77,'1694267340.jpg','2023-09-09 13:49:00','2023-09-09 13:49:00'),
(78,'1694336130.jpg','2023-09-10 08:55:30','2023-09-10 08:55:30'),
(79,'1694336141.jpg','2023-09-10 08:55:41','2023-09-10 08:55:41'),
(80,'1694336153.jpg','2023-09-10 08:55:53','2023-09-10 08:55:53'),
(81,'1694336169.jpg','2023-09-10 08:56:09','2023-09-10 08:56:09'),
(82,'1694336749.jpg','2023-09-10 09:05:49','2023-09-10 09:05:49'),
(83,'1694336806.jpg','2023-09-10 09:06:46','2023-09-10 09:06:46'),
(84,'1694336911.jpg','2023-09-10 09:08:31','2023-09-10 09:08:31'),
(85,'1694336918.jpg','2023-09-10 09:08:38','2023-09-10 09:08:38'),
(86,'1694338223.jpg','2023-09-10 09:30:23','2023-09-10 09:30:23'),
(87,'1694338472.jpg','2023-09-10 09:34:32','2023-09-10 09:34:32'),
(88,'1694338503.jpg','2023-09-10 09:35:03','2023-09-10 09:35:03'),
(89,'1694338525.jpg','2023-09-10 09:35:25','2023-09-10 09:35:25'),
(90,'1694338645.jpg','2023-09-10 09:37:25','2023-09-10 09:37:25'),
(91,'1694338786.jpg','2023-09-10 09:39:46','2023-09-10 09:39:46'),
(92,'1694340646.jpg','2023-09-10 10:10:46','2023-09-10 10:10:46'),
(93,'1694352157.png','2023-09-10 13:22:37','2023-09-10 13:22:37');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `image` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`role`,`image`,`remember_token`,`created_at`,`updated_at`) values 
(1,'Admin','admin@gmail.com',NULL,'$2y$10$ERDTuJfmH5oZQ8tbCxMiUOD92Rdt4yRCOTrCKnCFDF3gjX9HE4v16','admin',NULL,NULL,NULL,NULL),
(2,'User Ihsan','ihsan@gmail.com',NULL,'$2y$10$xsQYEtXTJtb6FRRxxpn/0.L3bgEqj9cNv44AQUWq5C5Unhc33sgya','user',NULL,NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
