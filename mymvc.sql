CREATE DATABASE IF NOT EXISTS `mymvc`
DEFAULT CHARACTER SET `utf8`
DEFAULT COLLATE `utf8_general_ci`;

USE `mymvc`;

CREATE TABLE IF NOT EXISTS `users` (
`id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`name` VARCHAR(255) NOT NULL,
`password` VARCHAR(255) NOT NULL,
`email` VARCHAR(255) NOT NULL UNIQUE KEY,
`role_id` TINYINT UNSIGNED,
CONSTRAINT `fk_users_roles` FOREIGN KEY (`role_id`)
REFERENCES `roles` (`id`) ON DELETE RESTRICT);

CREATE TABLE IF NOT EXISTS `roles` (
`id` TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`name` VARCHAR(50) NOT NULL,
`weight` TINYINT NOT NULL);

SELECT 
	`u`.`id`,
    `u`.`name`,
    `u`.`email`,
    `u`.`password`,
    `r`.`name` AS `role`
FROM `users` AS `u`
	LEFT JOIN `roles` AS `r`
    ON `u`.`role_id` = `r`.`id`
WHERE `u`.`email` = 'bay_milen@abv.bg';