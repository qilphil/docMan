# --------------------------------------------------------
# Host:                         127.0.0.1
# Server version:               5.5.16
# Server OS:                    Win32
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2012-01-24 20:44:48
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

# Dumping database structure for app_docman
CREATE DATABASE IF NOT EXISTS `app_docman` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `app_docman`;


# Dumping structure for table app_docman.files
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `lastchange` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `filename` varchar(250) DEFAULT NULL,
  `stored_filename` varchar(250) DEFAULT NULL,
  `file_md5` varchar(32) DEFAULT NULL,
  `extension` varchar(50) DEFAULT NULL,
  `filesize` bigint(20) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `lastchange_id` int(11) DEFAULT NULL,
  `version` int(11) DEFAULT NULL,
  `deleted` tinyint(11) NOT NULL DEFAULT '0',
  `parent_version_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `extension` (`extension`),
  KEY `owner_id` (`owner_id`),
  KEY `creator_id` (`creator_id`),
  KEY `deleted` (`deleted`),
  KEY `parent_version_id` (`parent_version_id`),
  CONSTRAINT `FK_files_users` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_files_users_2` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Data exporting was unselected.


# Dumping structure for table app_docman.log
CREATE TABLE IF NOT EXISTS `log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `logtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `log_text` text NOT NULL,
  `log_data` mediumblob,
  `log_table` varchar(50) DEFAULT NULL,
  `log_item` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `log_table` (`log_table`,`log_item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Data exporting was unselected.


# Dumping structure for table app_docman.projects
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL DEFAULT 'New Project',
  `creator_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `lastchange_id` int(11) NOT NULL,
  `lastchange` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` text,
  `metadata` mediumblob,
  `status` varchar(50) NOT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `creator_id` (`creator_id`),
  KEY `lastchange_id` (`lastchange_id`),
  KEY `status` (`status`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Data exporting was unselected.


# Dumping structure for table app_docman.tags
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `creator_id` int(10) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `lastchange_id` int(11) NOT NULL,
  `lastchange` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tag_type` varchar(50) NOT NULL DEFAULT 'tag',
  `tag_name` varchar(250) NOT NULL,
  `tag_name_lower` varchar(250) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `parent_tag_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_unique_idx` (`tag_name`,`tag_type`),
  KEY `tags_parent_tag_id_idx` (`parent_tag_id`),
  KEY `lastchange_idx` (`lastchange_id`),
  KEY `creator_idx` (`creator_id`),
  KEY `tag_type_idx` (`tag_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Data exporting was unselected.


# Dumping structure for table app_docman.tags_files
CREATE TABLE IF NOT EXISTS `tags_files` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tag_id` int(10) NOT NULL,
  `file_id` int(10) NOT NULL,
  `owner_id` int(10) NOT NULL,
  `lastchange` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_id_file_id` (`tag_id`,`file_id`),
  KEY `owner_id` (`owner_id`),
  KEY `lastchange` (`lastchange`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Data exporting was unselected.


# Dumping structure for table app_docman.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `pass_sha` varchar(50) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `lastchange` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_profile` mediumblob,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_level` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Data exporting was unselected.
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
