ALTER TABLE `users`
  ADD COLUMN IF NOT EXISTS `phone_number` VARCHAR(30) NOT NULL DEFAULT '' AFTER `email`;

UPDATE `users` SET `phone_number` = '+421 900 000 001'
WHERE `email` = 'user1@example.com' AND `phone_number` = '';

UPDATE `users` SET `phone_number` = '+421 900 000 002'
WHERE `email` = 'user2@example.com' AND `phone_number` = '';

UPDATE `users` SET `phone_number` = '+421 900 000 003'
WHERE `email` = 'user3@example.com' AND `phone_number` = '';

UPDATE `users` SET `phone_number` = '+421 900 000 004'
WHERE `email` = 'user4@example.com' AND `phone_number` = '';

UPDATE `users` SET `phone_number` = '+421 900 000 005'
WHERE `email` = 'user5@example.com' AND `phone_number` = '';
