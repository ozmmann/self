-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 07 2016 г., 16:03
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `selfservice`
--

-- --------------------------------------------------------

--
-- Структура таблицы `ss_auth_assignment`
--

CREATE TABLE IF NOT EXISTS `ss_auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `ss_auth_assignment`
--

INSERT INTO `ss_auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('moderator', '13', 1467801791),
('partner', '12', 1467801735),
('partner', '14', 1467801861);

-- --------------------------------------------------------

--
-- Структура таблицы `ss_auth_item`
--

CREATE TABLE IF NOT EXISTS `ss_auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `ss_auth_item`
--

INSERT INTO `ss_auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1467801471, 1467801471),
('createStock', 2, 'Create a stock', NULL, NULL, 1467801471, 1467801471),
('moderator', 1, NULL, NULL, NULL, 1467801471, 1467801471),
('partner', 1, NULL, NULL, NULL, 1467801471, 1467801471),
('updateStock', 2, 'Update stock', NULL, NULL, 1467801471, 1467801471);

-- --------------------------------------------------------

--
-- Структура таблицы `ss_auth_item_child`
--

CREATE TABLE IF NOT EXISTS `ss_auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `ss_auth_item_child`
--

INSERT INTO `ss_auth_item_child` (`parent`, `child`) VALUES
('admin', 'createStock'),
('partner', 'createStock'),
('admin', 'updateStock'),
('moderator', 'updateStock');

-- --------------------------------------------------------

--
-- Структура таблицы `ss_auth_rule`
--

CREATE TABLE IF NOT EXISTS `ss_auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `ss_city`
--

CREATE TABLE IF NOT EXISTS `ss_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `notGhost` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `ss_city`
--

INSERT INTO `ss_city` (`id`, `name`, `notGhost`) VALUES
(1, 'Киев', 1),
(2, 'Ивано-Франковск', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `ss_commission`
--

CREATE TABLE IF NOT EXISTS `ss_commission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cityType` enum('REGION','GHOST') NOT NULL,
  `stockCategoryId` int(11) DEFAULT NULL,
  `percent` float DEFAULT NULL,
  `fixed` float DEFAULT NULL,
  `free` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-ss_commission-stockCategoryId` (`stockCategoryId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `ss_commission`
--

INSERT INTO `ss_commission` (`id`, `cityType`, `stockCategoryId`, `percent`, `fixed`, `free`) VALUES
(1, 'REGION', 1, 10, 522, 80),
(2, 'GHOST', 1, 12, 1111, 50);

-- --------------------------------------------------------

--
-- Структура таблицы `ss_confirm`
--

CREATE TABLE IF NOT EXISTS `ss_confirm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(50) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `sendDate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-ss_confirm-userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `ss_migration`
--

CREATE TABLE IF NOT EXISTS `ss_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ss_migration`
--

INSERT INTO `ss_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1465987751),
('m140506_102106_rbac_init', 1467801461),
('m160603_202039_create_ss_city', 1465987755),
('m160603_202429_create_ss_stockcategory', 1465987755),
('m160603_202446_create_ss_commission', 1465987755),
('m160603_204222_create_ss_stocktype', 1465987756),
('m160603_212820_create_ss_user', 1465987756),
('m160603_213840_create_ss_confirm', 1465987757),
('m160603_213851_create_ss_restore', 1465987757),
('m160603_214003_create_ss_stock', 1465987758);

-- --------------------------------------------------------

--
-- Структура таблицы `ss_restore`
--

CREATE TABLE IF NOT EXISTS `ss_restore` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(50) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `sendDate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-ss_restore-userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `ss_stock`
--

CREATE TABLE IF NOT EXISTS `ss_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `commissionType` enum('FREE','PERCENT','FIXED') DEFAULT NULL,
  `commissionValue` float DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE','BLOCKED','FINISHED') DEFAULT 'INACTIVE',
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `condition` text,
  `organizer` text,
  `location` text,
  PRIMARY KEY (`id`),
  KEY `idx-ss_stock-categoryId` (`categoryId`),
  KEY `idx-ss_stock-userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `ss_stockcategory`
--

CREATE TABLE IF NOT EXISTS `ss_stockcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(155) DEFAULT NULL,
  `parentId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `ss_stockcategory`
--

INSERT INTO `ss_stockcategory` (`id`, `name`, `parentId`) VALUES
(1, 'Еда', NULL),
(2, 'Доставка пиццы', 1),
(3, 'Услуги', NULL),
(4, 'Массаж', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `ss_stocktype`
--

CREATE TABLE IF NOT EXISTS `ss_stocktype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `ss_stocktype`
--

INSERT INTO `ss_stocktype` (`id`, `name`) VALUES
(1, 'Местные услуги');

-- --------------------------------------------------------

--
-- Структура таблицы `ss_user`
--

CREATE TABLE IF NOT EXISTS `ss_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` enum('PARTNER','MODERATOR','ADMIN') DEFAULT 'PARTNER',
  `confirmed` tinyint(4) DEFAULT '0',
  `status` enum('ACTIVE','INACTIVE','BLOCKED') DEFAULT 'INACTIVE',
  `registrationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(18) DEFAULT NULL,
  `secondPhone` varchar(18) DEFAULT NULL,
  `stockTypeId` int(11) DEFAULT NULL,
  `cityId` int(11) DEFAULT NULL,
  `inn` varchar(11) DEFAULT NULL,
  `site` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-ss_user-stockTypeId` (`stockTypeId`),
  KEY `idx-ss_user-cityId` (`cityId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `ss_user`
--

INSERT INTO `ss_user` (`id`, `email`, `password`, `role`, `confirmed`, `status`, `registrationDate`, `name`, `phone`, `secondPhone`, `stockTypeId`, `cityId`, `inn`, `site`) VALUES
(12, 'admin@admin.loc', '$2y$13$9vj2ZBwjTMiTIcWJ7Kg11ex5.8uviy.u7YM/b75HXPw8SbmUiHo8O', 'ADMIN', 0, 'INACTIVE', '2016-07-06 10:42:15', 'Admin admin', '0994897692', '', 1, 2, NULL, ''),
(13, 'osman.ramazanov@gmail.com', '$2y$13$4KjQxuNlXOm/agrtrs.nxejYm.crkrYZCStsQ5OI91Ys.8pRD/krW', 'MODERATOR', 0, 'INACTIVE', '2016-07-06 10:43:11', 'Moderator moderator', '0994897692', '', 1, 2, NULL, ''),
(14, 'ozmmann@gmail.com', '$2y$13$pHl2KLUxyEMrJ5IKjj7jnebM8JH7J/qJPe2t2ad0tN0oEkbyinWC.', 'PARTNER', 1, 'ACTIVE', '2016-07-06 10:44:21', 'Partner', '0994897692', '', 1, 1, '3293118251', 'http://site.com');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `ss_auth_assignment`
--
ALTER TABLE `ss_auth_assignment`
  ADD CONSTRAINT `ss_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `ss_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `ss_auth_item`
--
ALTER TABLE `ss_auth_item`
  ADD CONSTRAINT `ss_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `ss_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `ss_auth_item_child`
--
ALTER TABLE `ss_auth_item_child`
  ADD CONSTRAINT `ss_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `ss_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ss_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `ss_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `ss_commission`
--
ALTER TABLE `ss_commission`
  ADD CONSTRAINT `fk-ss_commission-stockCategoryId` FOREIGN KEY (`stockCategoryId`) REFERENCES `ss_stockcategory` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `ss_confirm`
--
ALTER TABLE `ss_confirm`
  ADD CONSTRAINT `fk-ss_confirm-userId` FOREIGN KEY (`userId`) REFERENCES `ss_user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `ss_restore`
--
ALTER TABLE `ss_restore`
  ADD CONSTRAINT `fk-ss_restore-userId` FOREIGN KEY (`userId`) REFERENCES `ss_user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `ss_stock`
--
ALTER TABLE `ss_stock`
  ADD CONSTRAINT `fk-ss_stock-categoryId` FOREIGN KEY (`categoryId`) REFERENCES `ss_stockcategory` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-ss_stock-userId` FOREIGN KEY (`userId`) REFERENCES `ss_user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `ss_user`
--
ALTER TABLE `ss_user`
  ADD CONSTRAINT `fk-ss_user-cityId` FOREIGN KEY (`cityId`) REFERENCES `ss_city` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-ss_user-stockTypeId` FOREIGN KEY (`stockTypeId`) REFERENCES `ss_stocktype` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
