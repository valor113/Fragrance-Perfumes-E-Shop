-- Maison Doree single database setup script.
-- Import only this file. It is safe to rerun: tables use IF NOT EXISTS and
-- seed rows use stable unique keys with INSERT IGNORE.

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `maison_doree_shop`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `maison_doree_shop`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `email` VARCHAR(190) NOT NULL,
  `phone_number` VARCHAR(30) NOT NULL DEFAULT '',
  `password_hash` VARCHAR(255) NOT NULL,
  `role` VARCHAR(20) NOT NULL DEFAULT 'user',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_users_username` (`username`),
  UNIQUE KEY `uq_users_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(120) NOT NULL,
  `email` VARCHAR(190) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_admin_users_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `categories` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` VARCHAR(80) NOT NULL,
  `name` VARCHAR(120) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `image_path` VARCHAR(255) DEFAULT NULL,
  `image_alt` VARCHAR(255) DEFAULT NULL,
  `product_count` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `sort_order` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_categories_slug` (`slug`),
  KEY `idx_categories_active_sort` (`is_active`, `sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `products` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `sku` VARCHAR(64) NOT NULL,
  `slug` VARCHAR(100) NOT NULL,
  `name` VARCHAR(160) NOT NULL,
  `brand` VARCHAR(120) DEFAULT NULL,
  `description` TEXT NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `currency` CHAR(3) NOT NULL DEFAULT 'USD',
  `image_path` VARCHAR(255) NOT NULL,
  `image_alt` VARCHAR(255) NOT NULL,
  `badge` ENUM('New','Bestseller') DEFAULT NULL,
  `is_featured` TINYINT(1) NOT NULL DEFAULT 0,
  `stock_quantity` INT UNSIGNED NOT NULL DEFAULT 0,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `sort_order` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_products_sku` (`sku`),
  UNIQUE KEY `uq_products_slug` (`slug`),
  KEY `idx_products_active_sort` (`is_active`, `sort_order`),
  KEY `idx_products_featured` (`is_featured`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `product_categories` (
  `product_id` INT UNSIGNED NOT NULL,
  `category_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`product_id`, `category_id`),
  KEY `idx_product_categories_category` (`category_id`),
  CONSTRAINT `fk_product_categories_product`
    FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_product_categories_category`
    FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `cart_items` (
  `user_id` INT UNSIGNED NOT NULL,
  `product_id` INT UNSIGNED NOT NULL,
  `quantity` INT UNSIGNED NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`, `product_id`),
  KEY `idx_cart_items_product` (`product_id`),
  CONSTRAINT `fk_cart_items_user`
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_cart_items_product`
    FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `appointment_requests` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED DEFAULT NULL,
  `full_name` VARCHAR(120) NOT NULL,
  `email` VARCHAR(190) NOT NULL,
  `phone` VARCHAR(40) DEFAULT NULL,
  `message` TEXT DEFAULT NULL,
  `status` VARCHAR(30) NOT NULL DEFAULT 'new',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_appointment_user` (`user_id`),
  KEY `idx_appointment_status_created` (`status`, `created_at`),
  KEY `idx_appointment_email` (`email`),
  CONSTRAINT `fk_appointment_requests_user`
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
    ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `hero_slides` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(160) NOT NULL,
  `subtitle` VARCHAR(180) DEFAULT NULL,
  `image_path` VARCHAR(255) NOT NULL,
  `image_alt` VARCHAR(255) NOT NULL,
  `link_url` VARCHAR(255) DEFAULT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `sort_order` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_hero_slides_title` (`title`),
  KEY `idx_hero_slides_active_sort` (`is_active`, `sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `author_name` VARCHAR(120) NOT NULL,
  `author_detail` VARCHAR(120) DEFAULT NULL,
  `quote` TEXT NOT NULL,
  `rating` TINYINT UNSIGNED NOT NULL DEFAULT 5,
  `avatar_path` VARCHAR(255) DEFAULT NULL,
  `avatar_alt` VARCHAR(255) DEFAULT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `sort_order` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_testimonials_author` (`author_name`),
  KEY `idx_testimonials_active_sort` (`is_active`, `sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT IGNORE INTO `admin_users` (`name`, `email`, `password_hash`) VALUES
('Admin User', 'admin@maisondoree.test', '$2y$10$DUk6yaIZVr5y7aAgNqpbNuTDFqWWJ.QLhosrpB01vrNn5t/e84aMe');

INSERT IGNORE INTO `users` (`username`, `email`, `phone_number`, `password_hash`, `role`) VALUES
('user1', 'user1@example.com', '+421 900 000 001', '$2y$10$yZ1Y03FRVBgSk0tQJNU64eLC9N52tX3boIYPRqncG9vS5oq/YhbOG', 'user'),
('user2', 'user2@example.com', '+421 900 000 002', '$2y$10$FbJwQK/ESHYN8hw6NGrg8e9KnrJgm6NsaKeS/lXE2g2OBnWp3Dm92', 'user'),
('user3', 'user3@example.com', '+421 900 000 003', '$2y$10$KcWBgfOTUVtWoVwIBHjhO.zLe8gIQhEKF1C04QwkzbP33Bnno2/Hq', 'user'),
('user4', 'user4@example.com', '+421 900 000 004', '$2y$10$Tvjd.tvbt0l/X5Y.DXyUNeg6sNcH2G.zdJeUUGzBfnT65krXDEx6.', 'user'),
('user5', 'user5@example.com', '+421 900 000 005', '$2y$10$/bs4.x3tfN5MjEugxElyAey8/zpxjogmIVLeUTU6EFl70u7n49eWu', 'user');

INSERT IGNORE INTO `categories`
(`id`, `slug`, `name`, `description`, `image_path`, `image_alt`, `product_count`, `sort_order`) VALUES
(1, 'floral', 'Floral', 'Petal-led perfumes ranging from airy and luminous to rich and romantic.', 'images/Roja_perfumes.jpg', 'Floral perfume collection', 1, 1),
(2, 'woody', 'Woody', 'Grounded scents shaped by cedar, sandalwood, vetiver, and aromatic woods.', 'images/xerjoff.jpg', 'Woody perfume collection', 2, 2),
(3, 'fresh', 'Fresh', 'Crisp citrus, aquatic, green, and aromatic fragrances with an easy brightness.', 'images/versace.jpg', 'Fresh perfume collection', 2, 3),
(4, 'oriental', 'Amber and Oriental', 'Warm, enveloping perfumes with amber, spice, resin, and vanilla facets.', 'images/image_c9888d.jpg', 'Amber and oriental perfume collection', 1, 4),
(5, 'gourmand', 'Gourmand', 'Comforting fragrances with delicious impressions of vanilla, cocoa, honey, and caramel.', 'images/armani.jpg', 'Gourmand perfume collection', 1, 5),
(6, 'luxury', 'Luxury Editions', 'Distinctive compositions and elevated presentations from celebrated fragrance houses.', 'images/Clive_christian_perfume.jpg', 'Luxury perfume collection', 1, 6),
(7, 'everyday-wear', 'Everyday Wear', 'Versatile scents selected for workdays, weekends, and effortless daily use.', 'images/ysl.jpg', 'Everyday perfume collection', 3, 7),
(8, 'date-night', 'Date Night', 'Magnetic, warm, and expressive fragrances for evenings and close occasions.', 'images/jpg.jpg', 'Date night perfume collection', 2, 8),
(9, 'seasonal-scents', 'Seasonal Scents', 'Fragrances chosen to complement changing weather, atmosphere, and mood.', 'images/valentino.jpg', 'Seasonal perfume collection', 2, 9),
(10, 'bestsellers', 'Bestsellers', 'Customer favorites and enduring signatures from the Maison Doree selection.', 'images/Xerjoff_perfumes.jpg', 'Bestselling perfume collection', 4, 10),
(11, 'gift-sets', 'Gift Sets', 'Thoughtful fragrance gifts for celebrations, milestones, and scent discovery.', 'images/maison-hero-03.jpg', 'Perfume gift set collection', 0, 11);

INSERT IGNORE INTO `products`
(`id`, `sku`, `slug`, `name`, `brand`, `description`, `price`, `currency`, `image_path`, `image_alt`, `badge`, `is_featured`, `stock_quantity`, `sort_order`) VALUES
(1, 'MD-ARMANI-SWYI', 'emporio-armani-stronger-with-you-intensely', 'Emporio Armani Stronger With You Intensely', 'Emporio Armani', 'Warm amber fragrance with an intense modern character.', 73.00, 'USD', 'images/image_c9888d.jpg', 'Emporio Armani Stronger With You Intensely perfume bottle', 'New', 1, 12, 1),
(2, 'MD-JPG-LMLP', 'jean-paul-gaultier-le-male-le-parfum', 'Jean Paul Gaultier Le Male Le Parfum', 'Jean Paul Gaultier', 'Deep masculine fragrance in the iconic black torso bottle.', 82.00, 'USD', 'images/jpg.jpg', 'Jean Paul Gaultier Le Male Le Parfum black perfume bottle', 'Bestseller', 0, 18, 2),
(3, 'MD-VAL-UOMO', 'valentino-uomo-born-in-roma', 'Valentino Uomo Born in Roma', 'Valentino', 'Textured glass bottle with a refined aromatic profile.', 76.00, 'USD', 'images/valentino.jpg', 'Valentino Uomo Born in Roma perfume bottle', NULL, 0, 20, 3),
(4, 'MD-VRS-EROS', 'versace-eros', 'Versace Eros', 'Versace', 'Fresh and bold fragrance in a turquoise Medusa bottle.', 66.00, 'USD', 'images/versace.jpg', 'Versace Eros turquoise perfume bottle', NULL, 0, 9, 4),
(5, 'MD-XER-NAXOS', 'xerjoff-naxos', 'Xerjoff Naxos', 'Xerjoff', 'Elegant honeyed fragrance in a white and gold bottle.', 192.00, 'USD', 'images/xerjoff.jpg', 'Xerjoff Naxos perfume bottle', NULL, 0, 7, 5),
(6, 'MD-YSL-Y', 'yves-saint-laurent-y-eau-de-parfum', 'Yves Saint Laurent Y Eau de Parfum', 'Yves Saint Laurent', 'Sleek black bottle with a clean and confident scent profile.', 84.00, 'USD', 'images/ysl.jpg', 'Yves Saint Laurent Y black perfume bottle', NULL, 0, 15, 6);

INSERT IGNORE INTO `product_categories` (`product_id`, `category_id`) VALUES
(1, 4), (1, 5), (1, 8), (1, 10),
(2, 2), (2, 8), (2, 10),
(3, 1), (3, 7), (3, 9),
(4, 3), (4, 7), (4, 10),
(5, 2), (5, 6), (5, 9),
(6, 3), (6, 7), (6, 10);

INSERT IGNORE INTO `hero_slides`
(`title`, `subtitle`, `image_path`, `image_alt`, `link_url`, `sort_order`) VALUES
('Serpentine Collection', NULL, 'images/Clive_christian_perfume.jpg', 'Clive Christian perfume collection', 'collections.php', 1),
('Roja perfumes', NULL, 'images/Roja_perfumes.jpg', 'Roja perfumes collection', 'collections.php', 2),
('Xerjoff perfumes', NULL, 'images/Xerjoff_perfumes.jpg', 'Xerjoff perfumes collection', 'collections.php', 3);

INSERT IGNORE INTO `testimonials`
(`author_name`, `author_detail`, `quote`, `rating`, `avatar_path`, `avatar_alt`, `sort_order`) VALUES
('Catherine W.', 'Wedding Day Fragrance', 'Maison Doree helped me find a luminous floral perfume for my wedding day. It lasted beautifully from the ceremony through the final dance and now brings the whole day back with one spray.', 5, 'images/avatar-01.jpg', 'Portrait of Catherine W.', 1),
('Michael T.', 'Personal Scent Consultation', 'The fragrance consultation was thoughtful and effortless. The team listened to the notes I enjoy and introduced me to a warm amber scent that feels completely personal.', 5, 'images/avatar-02.jpg', 'Portrait of Michael T.', 2),
('Eleanor M.', 'Heritage Fragrance Collection', 'I discovered a refined perfume with soft woods and iris that has become my everyday signature. The quality is exceptional, and I receive compliments whenever I wear it.', 5, 'images/avatar-03.jpg', 'Portrait of Eleanor M.', 3);
