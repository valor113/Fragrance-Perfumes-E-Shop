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
  `piece_count` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
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

INSERT INTO `pages` (`id`, `slug`, `title`, `meta_description`, `template_file`, `sort_order`) VALUES
(1, 'home', 'Maison Doree - Home', 'Luxury fragrance and perfume boutique homepage.', 'index.php', 1),
(2, 'collections', 'Maison Doree - Collections', 'Browse perfume and fragrance collections.', 'collections.php', 2),
(3, 'shop', 'Maison Doree - Shop', 'Shop curated luxury fragrances and perfumes.', 'shop.php', 3),
(4, 'story', 'Maison Doree - Our Story', 'Learn about the Maison Doree heritage.', 'story.php', 4),
(5, 'craftsmanship', 'Maison Doree - Craftsmanship', 'Discover the art behind Maison Doree creations.', 'craftsmanship.php', 5),
(6, 'contact', 'Maison Doree - Contact', 'Request an appointment or visit the atelier.', 'contact.php', 6);

INSERT INTO `categories` (`id`, `slug`, `name`, `description`, `image_path`, `image_alt`, `piece_count`, `sort_order`) VALUES
(1, 'bridal', 'Bridal', 'Elegant pieces crafted for special occasions.', 'images/maison-hero-03.jpg', 'Bridal fragrance collection', 24, 1),
(2, 'everyday-elegance', 'Everyday Elegance', 'Refined scents for daily wear.', 'images/maison-doree-01.jpg', 'Everyday perfume collection', 36, 2),
(3, 'statement', 'Statement', 'Bold fragrances with memorable presence.', 'images/maison-doree-02.jpg', 'Statement perfume collection', 18, 3),
(4, 'heritage', 'Heritage', 'Timeless signatures inspired by classic perfumery.', 'images/maison-doree-03.jpg', 'Heritage fragrance collection', 12, 4),
(5, 'mens-collection', 'Men''s Collection', 'Sophisticated fragrances for men.', 'images/maison-doree-04.jpg', 'Men''s fragrance collection', 15, 5);

INSERT INTO `products`
(`id`, `sku`, `slug`, `name`, `brand`, `description`, `price`, `currency`, `image_path`, `image_alt`, `badge`, `is_featured`, `stock_quantity`, `sort_order`) VALUES
(1, 'MD-ARMANI-SWYI', 'emporio-armani-stronger-with-you-intensely', 'Emporio Armani Stronger With You Intensely', 'Emporio Armani', 'Warm amber fragrance with an intense modern character.', 4850.00, 'USD', 'images/image_c9888d.jpg', 'Emporio Armani Stronger With You Intensely perfume bottle', 'New', 1, 12, 1),
(2, 'MD-JPG-LMLP', 'jean-paul-gaultier-le-male-le-parfum', 'Jean Paul Gaultier Le Male Le Parfum', 'Jean Paul Gaultier', 'Deep masculine fragrance in the iconic black torso bottle.', 3200.00, 'USD', 'images/jpg.jpg', 'Jean Paul Gaultier Le Male Le Parfum black perfume bottle', 'Bestseller', 0, 18, 2),
(3, 'MD-VAL-UOMO', 'valentino-uomo-born-in-roma', 'Valentino Uomo Born in Roma', 'Valentino', 'Textured glass bottle with a refined aromatic profile.', 1450.00, 'USD', 'images/valentino.jpg', 'Valentino Uomo Born in Roma perfume bottle', NULL, 0, 20, 3),
(4, 'MD-VRS-EROS', 'versace-eros', 'Versace Eros', 'Versace', 'Fresh and bold fragrance in a turquoise Medusa bottle.', 5600.00, 'USD', 'images/versace.jpg', 'Versace Eros turquoise perfume bottle', NULL, 0, 9, 4),
(5, 'MD-XER-NAXOS', 'xerjoff-naxos', 'Xerjoff Naxos', 'Xerjoff', 'Elegant honeyed fragrance in a white and gold bottle.', 2800.00, 'USD', 'images/xerjoff.jpg', 'Xerjoff Naxos perfume bottle', NULL, 0, 7, 5),
(6, 'MD-YSL-Y', 'yves-saint-laurent-y-eau-de-parfum', 'Yves Saint Laurent Y Eau de Parfum', 'Yves Saint Laurent', 'Sleek black bottle with a clean and confident scent profile.', 950.00, 'USD', 'images/ysl.jpg', 'Yves Saint Laurent Y black perfume bottle', NULL, 0, 15, 6);

INSERT INTO `product_categories` (`product_id`, `category_id`) VALUES
(1, 3),
(1, 5),
(2, 4),
(2, 5),
(3, 2),
(4, 3),
(5, 4),
(6, 5);

INSERT INTO `hero_slides` (`title`, `subtitle`, `image_path`, `image_alt`, `link_url`, `sort_order`) VALUES
('Serpentine Collection', NULL, 'images/Clive_christian_perfume.jpg', 'Clive Christian perfume collection', 'collections.php', 1),
('Roja perfumes', NULL, 'images/Roja_perfumes.jpg', 'Roja perfumes collection', 'collections.php', 2),
('Xerjoff perfumes', NULL, 'images/Xerjoff_perfumes.jpg', 'Xerjoff perfumes collection', 'collections.php', 3);

INSERT INTO `page_sections`
(`id`, `page_id`, `section_key`, `eyebrow`, `title`, `body`, `image_path`, `image_alt`, `cta_label`, `cta_url`, `sort_order`) VALUES
(1, 1, 'hero', 'Artisan Gold Jewelry Since 1987', 'Where Gold Becomes Art', 'Each piece in our collection is handcrafted by master artisans, transforming the finest gold into wearable works of art that tell your unique story.', NULL, NULL, 'Explore Collections', 'collections.php', 1),
(2, 1, 'featured_piece', 'Featured Piece', 'Emporio Armani Stronger With You Intensely', 'A warm amber fragrance with an intense modern character, presented as the primary featured product of the boutique.', 'images/image_c9888d.jpg', 'Emporio Armani Stronger With You Intensely perfume bottle', 'Inquire About This Piece', 'contact.php', 2),
(3, 2, 'collections_intro', NULL, 'Our Collections', 'Discover pieces crafted for every chapter of your story.', NULL, NULL, 'View All Collections', '#', 1),
(4, 3, 'shop_intro', NULL, 'Our Shop', 'Discover exquisite pieces available for purchase.', NULL, NULL, NULL, NULL, 1),
(5, 4, 'story', 'Our Heritage', 'Three Generations of Golden Mastery', 'Founded in 1987 by master goldsmith Henri Beaumont, Maison Doree has remained a family atelier dedicated to the art of fine gold jewelry. Today, our third-generation artisans continue the tradition, blending time-honored techniques with contemporary design sensibilities.', 'images/maison-doree-05.jpg', 'Goldsmith at work', NULL, NULL, 1),
(6, 5, 'craftsmanship', 'The Art of Creation', 'Crafted by Hand, Treasured Forever', 'Each Maison Doree piece undergoes a meticulous journey from concept to completion. Our artisans employ traditional techniques passed down through generations.', 'images/maison-doree-07.jpg', 'Jewelry craftsmanship workshop', 'Commission a Custom Piece', 'contact.php', 1),
(7, 6, 'contact', 'Visit Our Atelier', 'Experience Maison Doree', 'We invite you to visit our atelier for a personal consultation. Discover our collections in an intimate setting and work with our designers to create something truly unique.', NULL, NULL, NULL, NULL, 1);

INSERT INTO `section_items` (`section_id`, `label`, `value`, `sort_order`) VALUES
(2, 'Material', '22K Yellow Gold', 1),
(2, 'Weight', '18.5 grams', 2),
(2, 'Chain Length', '18 inches (adjustable)', 3),
(6, 'Years of Excellence', '37', 1),
(6, 'Master Artisans', '12', 2),
(6, 'Pieces Created', '8K+', 3),
(7, 'Address', '742 Fifth Avenue, Suite 1200, New York, NY 10019', 1),
(7, 'Hours', 'Tuesday - Saturday, 10:00 AM to 06:00 PM; Sunday - Monday, By Appointment', 2),
(7, 'Contact', '+1 (212) 555-1234; hello@maisondoree.com', 3);

INSERT INTO `testimonials`
(`author_name`, `author_detail`, `quote`, `rating`, `avatar_path`, `avatar_alt`, `sort_order`) VALUES
('Catherine W.', 'Bridal Collection', 'The attention to detail is extraordinary. My wedding set from Maison Doree is not just jewelry; it is a work of art that I will cherish forever.', 5, 'images/avatar-01.jpg', 'Catherine W.', 1),
('Michael T.', 'Custom Design', 'Working with the design team to create a custom anniversary gift was seamless. They understood my vision and exceeded expectations.', 5, 'images/avatar-02.jpg', 'Michael T.', 2),
('Eleanor M.', 'Heritage Collection', 'Three generations of my family have now worn pieces from Maison Doree. The quality is unmatched and each piece tells our story.', 5, 'images/avatar-03.jpg', 'Eleanor M.', 3);

INSERT INTO `navigation_items` (`label`, `url`, `location`, `css_class`, `sort_order`) VALUES
('Collections', 'collections.php', 'header', NULL, 1),
('Shop', 'shop.php', 'header', NULL, 2),
('Our Story', 'story.php', 'header', NULL, 3),
('Craftsmanship', 'craftsmanship.php', 'header', NULL, 4),
('Visit Us', 'contact.php', 'header', NULL, 5),
('Book Appointment', 'contact.php', 'header', 'nav-cta', 6),
('Instagram', '#', 'social', NULL, 1),
('Pinterest', '#', 'social', NULL, 2),
('Facebook', '#', 'social', NULL, 3);

INSERT INTO `footer_links` (`group_title`, `label`, `url`, `sort_order`) VALUES
('Collections', 'All Collections', 'collections.php', 1),
('Collections', 'Shop', 'shop.php', 2),
('Collections', 'Bridal', '#', 3),
('Collections', 'Everyday Elegance', '#', 4),
('Collections', 'Statement Pieces', '#', 5),
('Collections', 'Men''s Collection', '#', 6),
('Company', 'Our Story', 'story.php', 1),
('Company', 'Craftsmanship', 'craftsmanship.php', 2),
('Company', 'Visit Us', 'contact.php', 3),
('Company', 'Custom Design', '#', 4),
('Company', 'Care Guide', '#', 5);

INSERT INTO `site_settings` (`setting_key`, `setting_value`) VALUES
('brand_name', 'Maison Doree'),
('footer_tagline', 'Exquisite fragrances crafted with passion and elegance. Discover your signature scent in our curated collection of luxury perfumes.'),
('address_line_1', '742 Fifth Avenue, Suite 1200'),
('address_line_2', 'New York, NY 10019'),
('phone', '+1 (212) 555-1234'),
('email', 'hello@maisondoree.com'),
('footer_about_title', 'THE ART OF FRAGRANCE'),
('footer_about_text', 'Welcome to our online boutique, where the mastery of perfumery meets modern elegance. Our mission is to bring you exclusive scents that highlight your personality and leave an unforgettable impression.'),
('copyright_text', '(c) 2026 Maison Doree.');

COMMIT;
