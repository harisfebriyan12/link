-- Script to reset portal_karawang database tables and insert card data

CREATE DATABASE IF NOT EXISTS `portal_karawang` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `portal_karawang`;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL UNIQUE,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
('Admin', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NOW(), NOW());

DROP TABLE IF EXISTS `cards`;
CREATE TABLE `cards` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `cards` (`judul`, `deskripsi`, `gambar`, `link`, `created_at`, `updated_at`) VALUES
('Card 1', 'Description for card 1', 'card1.jpg', 'https://example.com/card1', NOW(), NOW()),
('Card 2', 'Description for card 2', 'card2.jpg', 'https://example.com/card2', NOW(), NOW()),
('Card 3', 'Description for card 3', 'card3.jpg', 'https://example.com/card3', NOW(), NOW()),
('Card 4', 'Description for card 4', 'card4.jpg', 'https://example.com/card4', NOW(), NOW()),
('Card 5', 'Description for card 5', 'card5.jpg', 'https://example.com/card5', NOW(), NOW()),
('Card 6', 'Description for card 6', 'card6.jpg', 'https://example.com/card6', NOW(), NOW()),
('Card 7', 'Description for card 7', 'card7.jpg', 'https://example.com/card7', NOW(), NOW()),
('Card 8', 'Description for card 8', 'card8.jpg', 'https://example.com/card8', NOW(), NOW()),
('Card 9', 'Description for card 9', 'card9.jpg', 'https://example.com/card9', NOW(), NOW()),
('Card 10', 'Description for card 10', 'card10.jpg', 'https://example.com/card10', NOW(), NOW());
