/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `colours` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `color_value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `contact_us` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `message_value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_us_user_id_foreign` (`user_id`),
  CONSTRAINT `contact_us_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `pictures` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `product_entries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `colour_id` bigint(20) unsigned NOT NULL,
  `size_id` bigint(20) unsigned NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_entries_colour_id_foreign` (`colour_id`),
  KEY `product_entries_size_id_foreign` (`size_id`),
  KEY `product_entries_category_id_foreign` (`category_id`),
  CONSTRAINT `product_entries_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `product_entries_colour_id_foreign` FOREIGN KEY (`colour_id`) REFERENCES `colours` (`id`),
  CONSTRAINT `product_entries_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `sale` int(11) NOT NULL,
  `special` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_name_unique` (`name`),
  UNIQUE KEY `products_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `ratings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `value_rating` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ratings_user_id_foreign` (`user_id`),
  KEY `ratings_product_id_foreign` (`product_id`),
  CONSTRAINT `ratings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sizes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `size_value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `social_accounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `social_accounts_provider_id_unique` (`provider_id`),
  KEY `social_accounts_user_id_foreign` (`user_id`),
  CONSTRAINT `social_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`id`, `category_value`, `picture`, `created_at`, `updated_at`) VALUES
(1, 'Hijab', '1.png', NULL, NULL);
INSERT INTO `categories` (`id`, `category_value`, `picture`, `created_at`, `updated_at`) VALUES
(2, 'Gamis', '2.png', NULL, NULL);


INSERT INTO `colours` (`id`, `color_value`, `created_at`, `updated_at`) VALUES
(1, 'red', NULL, NULL);
INSERT INTO `colours` (`id`, `color_value`, `created_at`, `updated_at`) VALUES
(2, 'yellow', NULL, NULL);
INSERT INTO `colours` (`id`, `color_value`, `created_at`, `updated_at`) VALUES
(3, 'blue', NULL, NULL);
INSERT INTO `colours` (`id`, `color_value`, `created_at`, `updated_at`) VALUES
(4, 'green', NULL, NULL);





INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2021_07_12_113516_create_social_accounts_table', 1),
(5, '2021_07_12_155258_create_permission_tables', 1),
(6, '2021_07_17_122501_create_categories_table', 1),
(7, '2021_07_17_162814_create_products_table', 1),
(8, '2021_07_17_162821_create_sizes_table', 1),
(9, '2021_07_17_162822_create_colours_table', 1),
(10, '2021_07_17_162823_create_product_entries_table', 1),
(11, '2021_07_19_121652_create_pictures_table', 1),
(12, '2021_07_21_141040_create_ratings_table', 2),
(13, '2021_07_26_052823_add_special_to_products_table', 3),
(14, '2021_07_26_053809_add_picture_to_categories_table', 4),
(15, '2021_07_27_142236_create_contact_us_table', 5);









INSERT INTO `pictures` (`id`, `product_slug`, `picture_name`, `created_at`, `updated_at`) VALUES
(1, 'hijab-keren', '1.jpg', NULL, NULL);
INSERT INTO `pictures` (`id`, `product_slug`, `picture_name`, `created_at`, `updated_at`) VALUES
(2, 'hijab-keren', '2.jpg', NULL, NULL);
INSERT INTO `pictures` (`id`, `product_slug`, `picture_name`, `created_at`, `updated_at`) VALUES
(3, 'hijab-keren', '3.jpg', NULL, NULL);
INSERT INTO `pictures` (`id`, `product_slug`, `picture_name`, `created_at`, `updated_at`) VALUES
(4, 'hijab-keren', '4.jpg', NULL, NULL),
(5, 'hijab-keren', '5.jpg', NULL, NULL),
(6, 'gamis-modern', '5.jpg', NULL, NULL),
(7, 'gamis-modern', '4.jpg', NULL, NULL),
(8, 'gamis-modern', '3.jpg', NULL, NULL),
(9, 'gamis-modern', '2.jpg', NULL, NULL),
(10, 'gamis-modern', '1.jpg', NULL, NULL),
(11, 'hijab-arab', '1.jpg', NULL, NULL),
(12, 'hijab-arab', '1.jpg', NULL, NULL),
(13, 'hijab-arab', '2.jpg', NULL, NULL),
(14, 'hijab-arab', '3.jpg', NULL, NULL),
(15, 'gamis-turkey', '4.jpg', NULL, NULL),
(16, 'gamis-turkey', '2.jpg', NULL, NULL),
(17, 'gamis-turkey', '3.jpg', NULL, NULL),
(18, 'hijab-tanah-abang', '1.jpg', NULL, NULL),
(19, 'hijab-tanah-abang', '4.jpg', NULL, NULL),
(20, 'hijab-tanah-abang', '3.jpg', NULL, NULL),
(21, 'hijab-baru', '5.jpg', NULL, NULL),
(22, 'hijab-baru', '2.jpg', NULL, NULL);

INSERT INTO `product_entries` (`id`, `product_slug`, `colour_id`, `size_id`, `category_id`, `stock`, `created_at`, `updated_at`) VALUES
(1, 'hijab-keren', 1, 1, 1, 10, NULL, NULL);
INSERT INTO `product_entries` (`id`, `product_slug`, `colour_id`, `size_id`, `category_id`, `stock`, `created_at`, `updated_at`) VALUES
(2, 'hijab-keren', 2, 2, 1, 5, NULL, NULL);
INSERT INTO `product_entries` (`id`, `product_slug`, `colour_id`, `size_id`, `category_id`, `stock`, `created_at`, `updated_at`) VALUES
(3, 'hijab-keren', 3, 4, 1, 4, NULL, NULL);
INSERT INTO `product_entries` (`id`, `product_slug`, `colour_id`, `size_id`, `category_id`, `stock`, `created_at`, `updated_at`) VALUES
(4, 'hijab-arab', 4, 3, 1, 8, NULL, NULL),
(5, 'gamis-modern', 2, 2, 2, 4, NULL, NULL),
(6, 'gamis-turkey', 3, 3, 2, 11, NULL, NULL),
(7, 'hijab-tanah-abang', 1, 3, 1, 12, NULL, NULL),
(8, 'hijab-keren', 2, 1, 1, 10, NULL, NULL),
(9, 'hijab-baru', 2, 3, 1, 8, NULL, NULL);

INSERT INTO `products` (`id`, `name`, `slug`, `cover`, `price`, `sale`, `special`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Hijab Keren', 'hijab-keren', '1.jpg', 200000, 10, 0, 'blabalbla', '2021-07-24 15:10:51', '0000-00-00 00:00:00');
INSERT INTO `products` (`id`, `name`, `slug`, `cover`, `price`, `sale`, `special`, `description`, `created_at`, `updated_at`) VALUES
(2, 'Gamis Modern', 'gamis-modern', '2.jpg', 45000, 60, 1, 'ekekekek', '2021-07-24 15:10:51', '0000-00-00 00:00:00');
INSERT INTO `products` (`id`, `name`, `slug`, `cover`, `price`, `sale`, `special`, `description`, `created_at`, `updated_at`) VALUES
(3, 'Hijab Arab', 'hijab-arab', '3.jpg', 35000, 10, 0, 'awkowkow', '2021-07-24 15:10:51', '0000-00-00 00:00:00');
INSERT INTO `products` (`id`, `name`, `slug`, `cover`, `price`, `sale`, `special`, `description`, `created_at`, `updated_at`) VALUES
(4, 'Gamis Turkey', 'gamis-turkey', '4.jpg', 80000, 15, 0, 'wkwkwkwk', '2021-07-24 15:10:51', '0000-00-00 00:00:00'),
(5, 'Hijab Tanah Abang', 'hijab-tanah-abang', '5.jpg', 65000, 10, 1, 'zzzzzzzzz', '2021-07-24 15:10:51', '0000-00-00 00:00:00'),
(6, 'Hijab Baru', 'hijab-baru', '6.jpg', 120000, 20, 0, 'fff', '2021-07-22 17:14:01', '2021-07-22 17:14:01');

INSERT INTO `ratings` (`id`, `user_id`, `product_id`, `value_rating`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 5, NULL, NULL);
INSERT INTO `ratings` (`id`, `user_id`, `product_id`, `value_rating`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 3, NULL, NULL);
INSERT INTO `ratings` (`id`, `user_id`, `product_id`, `value_rating`, `created_at`, `updated_at`) VALUES
(3, 1, 3, 5, NULL, NULL);
INSERT INTO `ratings` (`id`, `user_id`, `product_id`, `value_rating`, `created_at`, `updated_at`) VALUES
(4, 1, 3, 5, NULL, NULL),
(5, 1, 1, 3, NULL, NULL),
(6, 1, 4, 2, NULL, NULL),
(7, 1, 1, 5, NULL, NULL);





INSERT INTO `sizes` (`id`, `size_value`, `created_at`, `updated_at`) VALUES
(1, 'L', NULL, NULL);
INSERT INTO `sizes` (`id`, `size_value`, `created_at`, `updated_at`) VALUES
(2, 'M', NULL, NULL);
INSERT INTO `sizes` (`id`, `size_value`, `created_at`, `updated_at`) VALUES
(3, 'S', NULL, NULL);
INSERT INTO `sizes` (`id`, `size_value`, `created_at`, `updated_at`) VALUES
(4, 'XL', NULL, NULL),
(5, 'XXL', NULL, NULL);

INSERT INTO `social_accounts` (`id`, `user_id`, `provider_id`, `provider_name`, `created_at`, `updated_at`) VALUES
(1, 1, '110783976313639980820', 'google', '2021-07-21 12:31:55', '2021-07-21 12:31:55');
INSERT INTO `social_accounts` (`id`, `user_id`, `provider_id`, `provider_name`, `created_at`, `updated_at`) VALUES
(2, 2, '103278198484299944310', 'google', '2021-07-21 12:32:01', '2021-07-21 12:32:01');


INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Arsyandi Pratama', 'arsyandi.develop@gmail.com', NULL, NULL, 'rfkoSdgwXAa1OajZHnoEpzRkc1hbalLZ6h7D822EysKRS7B2agGaeDYj3jCR', '2021-07-21 12:31:55', '2021-07-21 12:31:55');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Asnur Ramdhani', 'asnurramdhani12@gmail.com', NULL, NULL, 'z5lgqZAmJiv9ZylHJHHxZJqPnYLQTOswc9mxTyK0EvrvqXk9zRatnWRihY7w', '2021-07-21 12:32:01', '2021-07-21 12:32:01');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Arsyandi Pratama', 'arsyandipratama22@gmail.com', NULL, '$2y$10$J0pzWSC4hev3bXhI56srzeU91B25AJSYaojKTzOitTOt/bXLpvRYa', NULL, '2021-08-13 04:32:47', '2021-08-13 04:32:47');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'admin', 'admin@ratuoutfit.com', NULL, '$2y$10$EobsAevbw2yQ2XFu0QNfPuuj9dRaTxFbcLSl1cEa2vRvPXzC/4KOS', NULL, '2021-08-26 18:29:09', '2021-08-26 18:29:09');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;