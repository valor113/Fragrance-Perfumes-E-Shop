-- Replace the legacy collection taxonomy and page metadata with perfume-focused content.

ALTER TABLE `categories`
  CHANGE COLUMN `piece_count` `product_count` SMALLINT UNSIGNED NOT NULL DEFAULT 0;

DELETE FROM `product_categories`;
DELETE FROM `categories`;

INSERT INTO `categories`
(`id`, `slug`, `name`, `description`, `image_path`, `image_alt`, `product_count`, `is_active`, `sort_order`) VALUES
(1, 'floral', 'Floral', 'Petal-led perfumes ranging from airy and luminous to rich and romantic.', 'images/Roja_perfumes.jpg', 'Floral perfume collection', 1, 1, 1),
(2, 'woody', 'Woody', 'Grounded scents shaped by cedar, sandalwood, vetiver, and aromatic woods.', 'images/xerjoff.jpg', 'Woody perfume collection', 2, 1, 2),
(3, 'fresh', 'Fresh', 'Crisp citrus, aquatic, green, and aromatic fragrances with an easy brightness.', 'images/versace.jpg', 'Fresh perfume collection', 2, 1, 3),
(4, 'oriental', 'Amber and Oriental', 'Warm, enveloping perfumes with amber, spice, resin, and vanilla facets.', 'images/image_c9888d.jpg', 'Amber and oriental perfume collection', 1, 1, 4),
(5, 'gourmand', 'Gourmand', 'Comforting fragrances with delicious impressions of vanilla, cocoa, honey, and caramel.', 'images/armani.jpg', 'Gourmand perfume collection', 1, 1, 5),
(6, 'luxury', 'Luxury Editions', 'Distinctive compositions and elevated presentations from celebrated fragrance houses.', 'images/Clive_christian_perfume.jpg', 'Luxury perfume collection', 1, 1, 6),
(7, 'everyday-wear', 'Everyday Wear', 'Versatile scents selected for workdays, weekends, and effortless daily use.', 'images/ysl.jpg', 'Everyday perfume collection', 3, 1, 7),
(8, 'date-night', 'Date Night', 'Magnetic, warm, and expressive fragrances for evenings and close occasions.', 'images/jpg.jpg', 'Date night perfume collection', 2, 1, 8),
(9, 'seasonal-scents', 'Seasonal Scents', 'Fragrances chosen to complement changing weather, atmosphere, and mood.', 'images/valentino.jpg', 'Seasonal perfume collection', 2, 1, 9),
(10, 'bestsellers', 'Bestsellers', 'Customer favorites and enduring signatures from the Maison Doree selection.', 'images/Xerjoff_perfumes.jpg', 'Bestselling perfume collection', 4, 1, 10),
(11, 'gift-sets', 'Gift Sets', 'Thoughtful fragrance gifts for celebrations, milestones, and scent discovery.', 'images/maison-hero-03.jpg', 'Perfume gift set collection', 0, 1, 11);

INSERT INTO `product_categories` (`product_id`, `category_id`) VALUES
(1, 4), (1, 5), (1, 8), (1, 10),
(2, 2), (2, 8), (2, 10),
(3, 1), (3, 7), (3, 9),
(4, 3), (4, 7), (4, 10),
(5, 2), (5, 6), (5, 9),
(6, 3), (6, 7), (6, 10);

UPDATE `pages`
SET
  `slug` = 'fragrance-guide',
  `title` = 'Maison Doree - Fragrance Guide',
  `meta_description` = 'Choose perfume by scent family, mood, occasion, concentration, and personal style.',
  `template_file` = 'fragrance-guide.php'
WHERE `id` = 5;

UPDATE `page_sections`
SET
  `eyebrow` = 'Luxury Fragrance Boutique',
  `title` = 'Where Scent Becomes Art',
  `body` = 'Discover curated perfumes from iconic houses and niche makers, selected for elegance, character, and lasting impression.',
  `cta_label` = 'Explore Collections',
  `cta_url` = 'collections.php'
WHERE `id` = 1;

UPDATE `page_sections`
SET
  `section_key` = 'featured_fragrance',
  `eyebrow` = 'Featured Fragrance',
  `body` = 'A warm amber fragrance with an intense modern character, presented as a featured scent from the boutique.',
  `cta_label` = 'View in Shop',
  `cta_url` = 'shop.php'
WHERE `id` = 2;

UPDATE `page_sections`
SET
  `eyebrow` = 'Find Your Fragrance',
  `title` = 'Perfume Collections',
  `body` = 'Explore scents by fragrance family, mood, occasion, and personal style.',
  `cta_label` = 'Shop All Fragrances',
  `cta_url` = 'shop.php'
WHERE `id` = 3;

UPDATE `page_sections`
SET
  `body` = 'Discover curated fragrances available for purchase.'
WHERE `id` = 4;

UPDATE `page_sections`
SET
  `eyebrow` = 'Our Heritage',
  `title` = 'Three Generations of Fragrance Curation',
  `body` = 'Maison Doree began as a family boutique dedicated to elegant perfumes, thoughtful selection, and personal scent consultations.',
  `image_alt` = 'Curated fragrance boutique display'
WHERE `id` = 5;

UPDATE `page_sections`
SET
  `section_key` = 'fragrance_guide',
  `eyebrow` = 'Scent Discovery',
  `title` = 'Find a Fragrance That Feels Like You',
  `body` = 'Compare scent families, mood, occasion, concentration, longevity, and personal style with practical guidance from our curated boutique.',
  `image_path` = 'images/Roja_perfumes.jpg',
  `image_alt` = 'Curated luxury perfume bottles',
  `cta_label` = 'Explore Scent Families',
  `cta_url` = 'collections.php'
WHERE `id` = 6;

UPDATE `page_sections`
SET
  `eyebrow` = 'Visit Our Boutique',
  `body` = 'Visit for a personal scent consultation and discover fragrances in a relaxed, considered setting.'
WHERE `id` = 7;

DELETE FROM `section_items` WHERE `section_id` IN (2, 6);
INSERT INTO `section_items` (`section_id`, `label`, `value`, `sort_order`) VALUES
(2, 'Scent Family', 'Amber Gourmand', 1),
(2, 'Concentration', 'Eau de Parfum', 2),
(2, 'Best For', 'Evening and cool weather', 3),
(6, 'Scent Families', 'Floral, woody, fresh, amber, gourmand', 1),
(6, 'Choosing Well', 'Mood, occasion, concentration, and style', 2),
(6, 'Testing Advice', 'Let the fragrance develop fully on skin', 3);

UPDATE `navigation_items`
SET `label` = 'Fragrance Guide', `url` = 'fragrance-guide.php'
WHERE `url` = 'craftsmanship.php' OR `label` = 'Craftsmanship';

UPDATE `footer_links`
SET `label` = 'Fragrance Guide', `url` = 'fragrance-guide.php'
WHERE `url` = 'craftsmanship.php' OR `label` = 'Craftsmanship';

UPDATE `footer_links` SET `label` = 'Floral', `url` = 'shop.php?collection=floral' WHERE `group_title` = 'Collections' AND `sort_order` = 3;
UPDATE `footer_links` SET `label` = 'Woody', `url` = 'shop.php?collection=woody' WHERE `group_title` = 'Collections' AND `sort_order` = 4;
UPDATE `footer_links` SET `label` = 'Fresh', `url` = 'shop.php?collection=fresh' WHERE `group_title` = 'Collections' AND `sort_order` = 5;
UPDATE `footer_links` SET `label` = 'Gift Sets', `url` = 'shop.php?collection=gift-sets' WHERE `group_title` = 'Collections' AND `sort_order` = 6;
UPDATE `footer_links` SET `label` = 'Scent Families', `url` = 'collections.php' WHERE `group_title` = 'Company' AND `sort_order` = 4;
UPDATE `footer_links` SET `label` = 'Scent Consultation', `url` = 'contact.php' WHERE `group_title` = 'Company' AND `sort_order` = 5;
