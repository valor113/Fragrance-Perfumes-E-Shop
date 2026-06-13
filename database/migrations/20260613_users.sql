CREATE TABLE IF NOT EXISTS `users` (
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

INSERT IGNORE INTO `users` (`username`, `email`, `password_hash`, `role`) VALUES
('user1', 'user1@example.com', '$2y$10$yZ1Y03FRVBgSk0tQJNU64eLC9N52tX3boIYPRqncG9vS5oq/YhbOG', 'user'),
('user2', 'user2@example.com', '$2y$10$FbJwQK/ESHYN8hw6NGrg8e9KnrJgm6NsaKeS/lXE2g2OBnWp3Dm92', 'user'),
('user3', 'user3@example.com', '$2y$10$KcWBgfOTUVtWoVwIBHjhO.zLe8gIQhEKF1C04QwkzbP33Bnno2/Hq', 'user'),
('user4', 'user4@example.com', '$2y$10$Tvjd.tvbt0l/X5Y.DXyUNeg6sNcH2G.zdJeUUGzBfnT65krXDEx6.', 'user'),
('user5', 'user5@example.com', '$2y$10$/bs4.x3tfN5MjEugxElyAey8/zpxjogmIVLeUTU6EFl70u7n49eWu', 'user');
