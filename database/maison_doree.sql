-- phpMyAdmin-ready database schema and seed data for Maison Doree
-- Import this file in phpMyAdmin or run it from MySQL/MariaDB.

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `maison_doree_shop`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `maison_doree_shop`;

DROP TABLE IF EXISTS `appointment_requests`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `admin_users`;
DROP TABLE IF EXISTS `footer_links`;
DROP TABLE IF EXISTS `navigation_items`;
DROP TABLE IF EXISTS `testimonials`;
DROP TABLE IF EXISTS `site_settings`;
DROP TABLE IF EXISTS `section_items`;
DROP TABLE IF EXISTS `page_sections`;
DROP TABLE IF EXISTS `hero_slides`;
DROP TABLE IF EXISTS `product_categories`;
DROP TABLE IF EXISTS `products`;
DROP TABLE IF EXISTS `categories`;
DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` VARCHAR(80) NOT NULL,
  `title` VARCHAR(160) NOT NULL,
  `meta_description` VARCHAR(255) DEFAULT NULL,
  `template_file` VARCHAR(120) NOT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `sort_order` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_pages_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `categories` (
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

CREATE TABLE `products` (
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

CREATE TABLE `product_categories` (
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

CREATE TABLE `hero_slides` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(160) NOT NULL,
  `subtitle` VARCHAR(180) DEFAULT NULL,
  `image_path` VARCHAR(255) NOT NULL,
  `image_alt` VARCHAR(255) NOT NULL,
  `link_url` VARCHAR(255) DEFAULT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `sort_order` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idx_hero_slides_active_sort` (`is_active`, `sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `page_sections` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_id` INT UNSIGNED NOT NULL,
  `section_key` VARCHAR(80) NOT NULL,
  `eyebrow` VARCHAR(120) DEFAULT NULL,
  `title` VARCHAR(200) NOT NULL,
  `body` TEXT DEFAULT NULL,
  `image_path` VARCHAR(255) DEFAULT NULL,
  `image_alt` VARCHAR(255) DEFAULT NULL,
  `cta_label` VARCHAR(120) DEFAULT NULL,
  `cta_url` VARCHAR(255) DEFAULT NULL,
  `sort_order` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_page_sections_page_key` (`page_id`, `section_key`),
  KEY `idx_page_sections_page_sort` (`page_id`, `sort_order`),
  CONSTRAINT `fk_page_sections_page`
    FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `section_items` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `section_id` INT UNSIGNED NOT NULL,
  `label` VARCHAR(120) NOT NULL,
  `value` VARCHAR(255) DEFAULT NULL,
  `sort_order` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idx_section_items_section_sort` (`section_id`, `sort_order`),
  CONSTRAINT `fk_section_items_section`
    FOREIGN KEY (`section_id`) REFERENCES `page_sections` (`id`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `testimonials` (
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
  KEY `idx_testimonials_active_sort` (`is_active`, `sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `navigation_items` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `label` VARCHAR(80) NOT NULL,
  `url` VARCHAR(255) NOT NULL,
  `location` ENUM('header','mobile','footer','social') NOT NULL DEFAULT 'header',
  `css_class` VARCHAR(80) DEFAULT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `sort_order` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idx_navigation_location_sort` (`location`, `is_active`, `sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `footer_links` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `group_title` VARCHAR(120) NOT NULL,
  `label` VARCHAR(120) NOT NULL,
  `url` VARCHAR(255) NOT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `sort_order` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idx_footer_links_group_sort` (`group_title`, `is_active`, `sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `site_settings` (
  `setting_key` VARCHAR(100) NOT NULL,
  `setting_value` TEXT NOT NULL,
  PRIMARY KEY (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `appointment_requests` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` VARCHAR(160) NOT NULL,
  `email` VARCHAR(190) NOT NULL,
  `phone` VARCHAR(40) DEFAULT NULL,
  `message` TEXT DEFAULT NULL,
  `status` ENUM('new','confirmed','cancelled','completed') NOT NULL DEFAULT 'new',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_appointment_status_created` (`status`, `created_at`),
  KEY `idx_appointment_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `admin_users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(120) NOT NULL,
  `email` VARCHAR(190) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_admin_users_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `email` VARCHAR(190) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `role` VARCHAR(20) NOT NULL DEFAULT 'user',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_users_username` (`username`),
  UNIQUE KEY `uq_users_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pages` (`id`, `slug`, `title`, `meta_description`, `template_file`, `sort_order`) VALUES
(1, 'home', 'Maison Doree - Home', 'Luxury fragrance and perfume boutique homepage.', 'index.php', 1),
(2, 'collections', 'Maison Doree - Collections', 'Browse perfume and fragrance collections.', 'collections.php', 2),
(3, 'shop', 'Maison Doree - Shop', 'Shop curated luxury fragrances and perfumes.', 'shop.php', 3),
(4, 'story', 'Maison Doree - Our Story', 'Learn about the Maison Doree heritage.', 'story.php', 4),
(5, 'fragrance-guide', 'Maison Doree - Fragrance Guide', 'Choose perfume by scent family, mood, occasion, concentration, and personal style.', 'fragrance-guide.php', 5),
(6, 'contact', 'Maison Doree - Contact', 'Request an appointment or visit the atelier.', 'contact.php', 6);

INSERT INTO `categories` (`id`, `slug`, `name`, `description`, `image_path`, `image_alt`, `product_count`, `sort_order`) VALUES
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

INSERT INTO `products`
(`id`, `sku`, `slug`, `name`, `brand`, `description`, `price`, `currency`, `image_path`, `image_alt`, `badge`, `is_featured`, `stock_quantity`, `sort_order`) VALUES
(1, 'MD-ARMANI-SWYI', 'emporio-armani-stronger-with-you-intensely', 'Emporio Armani Stronger With You Intensely', 'Emporio Armani', 'Warm amber fragrance with an intense modern character.', 4850.00, 'USD', 'images/image_c9888d.jpg', 'Emporio Armani Stronger With You Intensely perfume bottle', 'New', 1, 12, 1),
(2, 'MD-JPG-LMLP', 'jean-paul-gaultier-le-male-le-parfum', 'Jean Paul Gaultier Le Male Le Parfum', 'Jean Paul Gaultier', 'Deep masculine fragrance in the iconic black torso bottle.', 3200.00, 'USD', 'images/jpg.jpg', 'Jean Paul Gaultier Le Male Le Parfum black perfume bottle', 'Bestseller', 0, 18, 2),
(3, 'MD-VAL-UOMO', 'valentino-uomo-born-in-roma', 'Valentino Uomo Born in Roma', 'Valentino', 'Textured glass bottle with a refined aromatic profile.', 1450.00, 'USD', 'images/valentino.jpg', 'Valentino Uomo Born in Roma perfume bottle', NULL, 0, 20, 3),
(4, 'MD-VRS-EROS', 'versace-eros', 'Versace Eros', 'Versace', 'Fresh and bold fragrance in a turquoise Medusa bottle.', 5600.00, 'USD', 'images/versace.jpg', 'Versace Eros turquoise perfume bottle', NULL, 0, 9, 4),
(5, 'MD-XER-NAXOS', 'xerjoff-naxos', 'Xerjoff Naxos', 'Xerjoff', 'Elegant honeyed fragrance in a white and gold bottle.', 2800.00, 'USD', 'images/xerjoff.jpg', 'Xerjoff Naxos perfume bottle', NULL, 0, 7, 5),
(6, 'MD-YSL-Y', 'yves-saint-laurent-y-eau-de-parfum', 'Yves Saint Laurent Y Eau de Parfum', 'Yves Saint Laurent', 'Sleek black bottle with a clean and confident scent profile.', 950.00, 'USD', 'images/ysl.jpg', 'Yves Saint Laurent Y black perfume bottle', NULL, 0, 15, 6);

INSERT INTO `product_categories` (`product_id`, `category_id`) VALUES
(1, 4), (1, 5), (1, 8), (1, 10),
(2, 2), (2, 8), (2, 10),
(3, 1), (3, 7), (3, 9),
(4, 3), (4, 7), (4, 10),
(5, 2), (5, 6), (5, 9),
(6, 3), (6, 7), (6, 10);

INSERT INTO `hero_slides` (`title`, `subtitle`, `image_path`, `image_alt`, `link_url`, `sort_order`) VALUES
('Serpentine Collection', NULL, 'images/Clive_christian_perfume.jpg', 'Clive Christian perfume collection', 'collections.php', 1),
('Roja perfumes', NULL, 'images/Roja_perfumes.jpg', 'Roja perfumes collection', 'collections.php', 2),
('Xerjoff perfumes', NULL, 'images/Xerjoff_perfumes.jpg', 'Xerjoff perfumes collection', 'collections.php', 3);

INSERT INTO `page_sections`
(`id`, `page_id`, `section_key`, `eyebrow`, `title`, `body`, `image_path`, `image_alt`, `cta_label`, `cta_url`, `sort_order`) VALUES
(1, 1, 'hero', 'Luxury Fragrance Boutique', 'Where Scent Becomes Art', 'Discover curated perfumes from iconic houses and niche makers, selected for elegance, character, and lasting impression.', NULL, NULL, 'Explore Collections', 'collections.php', 1),
(2, 1, 'featured_fragrance', 'Featured Fragrance', 'Emporio Armani Stronger With You Intensely', 'A warm amber fragrance with an intense modern character, presented as a featured scent from the boutique.', 'images/image_c9888d.jpg', 'Emporio Armani Stronger With You Intensely perfume bottle', 'View in Shop', 'shop.php', 2),
(3, 2, 'collections_intro', 'Find Your Fragrance', 'Perfume Collections', 'Explore scents by fragrance family, mood, occasion, and personal style.', NULL, NULL, 'Shop All Fragrances', 'shop.php', 1),
(4, 3, 'shop_intro', NULL, 'Our Shop', 'Discover curated fragrances available for purchase.', NULL, NULL, NULL, NULL, 1),
(5, 4, 'story', 'Our Heritage', 'Three Generations of Fragrance Curation', 'Maison Doree began as a family boutique dedicated to elegant perfumes, thoughtful selection, and personal scent consultations.', 'images/maison-doree-05.jpg', 'Curated fragrance boutique display', NULL, NULL, 1),
(6, 5, 'fragrance_guide', 'Scent Discovery', 'Find a Fragrance That Feels Like You', 'Compare scent families, mood, occasion, concentration, longevity, and personal style with practical guidance from our curated boutique.', 'images/Roja_perfumes.jpg', 'Curated luxury perfume bottles', 'Explore Scent Families', 'collections.php', 1),
(7, 6, 'contact', 'Visit Our Boutique', 'Experience Maison Doree', 'Visit for a personal scent consultation and discover fragrances in a relaxed, considered setting.', NULL, NULL, NULL, NULL, 1);

INSERT INTO `section_items` (`section_id`, `label`, `value`, `sort_order`) VALUES
(2, 'Scent Family', 'Amber Gourmand', 1),
(2, 'Concentration', 'Eau de Parfum', 2),
(2, 'Best For', 'Evening and cool weather', 3),
(6, 'Scent Families', 'Floral, woody, fresh, amber, gourmand', 1),
(6, 'Choosing Well', 'Mood, occasion, concentration, and style', 2),
(6, 'Testing Advice', 'Let the fragrance develop fully on skin', 3),
(7, 'Address', '742 Fifth Avenue, Suite 1200, New York, NY 10019', 1),
(7, 'Hours', 'Tuesday - Saturday, 10:00 AM to 06:00 PM; Sunday - Monday, By Appointment', 2),
(7, 'Contact', '+1 (212) 555-1234; hello@maisondoree.com', 3);

INSERT INTO `testimonials`
(`author_name`, `author_detail`, `quote`, `rating`, `avatar_path`, `avatar_alt`, `sort_order`) VALUES
('Catherine W.', 'Wedding Day Fragrance', 'Maison Doree helped me find a luminous floral perfume for my wedding day. It lasted beautifully from the ceremony through the final dance and now brings the whole day back with one spray.', 5, 'images/avatar-01.jpg', 'Portrait of Catherine W.', 1),
('Michael T.', 'Personal Scent Consultation', 'The fragrance consultation was thoughtful and effortless. The team listened to the notes I enjoy and introduced me to a warm amber scent that feels completely personal.', 5, 'images/avatar-02.jpg', 'Portrait of Michael T.', 2),
('Eleanor M.', 'Heritage Fragrance Collection', 'I discovered a refined perfume with soft woods and iris that has become my everyday signature. The quality is exceptional, and I receive compliments whenever I wear it.', 5, 'images/avatar-03.jpg', 'Portrait of Eleanor M.', 3);

INSERT INTO `navigation_items` (`label`, `url`, `location`, `css_class`, `sort_order`) VALUES
('Collections', 'collections.php', 'header', NULL, 1),
('Shop', 'shop.php', 'header', NULL, 2),
('Our Story', 'story.php', 'header', NULL, 3),
('Fragrance Guide', 'fragrance-guide.php', 'header', NULL, 4),
('Visit Us', 'contact.php', 'header', NULL, 5),
('Book Appointment', 'contact.php', 'header', 'nav-cta', 6),
('Instagram', '#', 'social', NULL, 1),
('Pinterest', '#', 'social', NULL, 2),
('Facebook', '#', 'social', NULL, 3);

INSERT INTO `footer_links` (`group_title`, `label`, `url`, `sort_order`) VALUES
('Collections', 'All Collections', 'collections.php', 1),
('Collections', 'Shop', 'shop.php', 2),
('Collections', 'Floral', 'shop.php?collection=floral', 3),
('Collections', 'Woody', 'shop.php?collection=woody', 4),
('Collections', 'Fresh', 'shop.php?collection=fresh', 5),
('Collections', 'Gift Sets', 'shop.php?collection=gift-sets', 6),
('Company', 'Our Story', 'story.php', 1),
('Company', 'Fragrance Guide', 'fragrance-guide.php', 2),
('Company', 'Visit Us', 'contact.php', 3),
('Company', 'Scent Families', 'collections.php', 4),
('Company', 'Scent Consultation', 'contact.php', 5);

INSERT INTO `site_settings` (`setting_key`, `setting_value`) VALUES
('brand_name', 'Maison Doree'),
('footer_tagline', 'Curated fragrances chosen for character, quality, and style. Discover a scent that feels distinctly your own.'),
('address_line_1', '742 Fifth Avenue, Suite 1200'),
('address_line_2', 'New York, NY 10019'),
('phone', '+1 (212) 555-1234'),
('email', 'hello@maisondoree.com'),
('footer_about_title', 'THE ART OF FRAGRANCE'),
('footer_about_text', 'Welcome to our online boutique, where the mastery of perfumery meets modern elegance. Our mission is to bring you exclusive scents that highlight your personality and leave an unforgettable impression.'),
('copyright_text', '(c) 2026 Maison Doree.');

INSERT INTO `admin_users` (`name`, `email`, `password_hash`) VALUES
('Admin User', 'admin@maisondoree.test', '$2y$10$DUk6yaIZVr5y7aAgNqpbNuTDFqWWJ.QLhosrpB01vrNn5t/e84aMe');

INSERT INTO `users` (`username`, `email`, `password_hash`, `role`) VALUES
('user1', 'user1@example.com', '$2y$10$yZ1Y03FRVBgSk0tQJNU64eLC9N52tX3boIYPRqncG9vS5oq/YhbOG', 'user'),
('user2', 'user2@example.com', '$2y$10$FbJwQK/ESHYN8hw6NGrg8e9KnrJgm6NsaKeS/lXE2g2OBnWp3Dm92', 'user'),
('user3', 'user3@example.com', '$2y$10$KcWBgfOTUVtWoVwIBHjhO.zLe8gIQhEKF1C04QwkzbP33Bnno2/Hq', 'user'),
('user4', 'user4@example.com', '$2y$10$Tvjd.tvbt0l/X5Y.DXyUNeg6sNcH2G.zdJeUUGzBfnT65krXDEx6.', 'user'),
('user5', 'user5@example.com', '$2y$10$/bs4.x3tfN5MjEugxElyAey8/zpxjogmIVLeUTU6EFl70u7n49eWu', 'user');

COMMIT;
