SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `cameramodelnames`;
CREATE TABLE `cameramodelnames` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The primary key',
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The name of the camera',
  `created` datetime NOT NULL COMMENT 'Created timestamp',
  `modified` datetime NOT NULL COMMENT 'Modified timestamp',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The primary key',
  `name` varchar(16) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Name of the Category',
  `slug` varchar(16) COLLATE utf8_unicode_ci NOT NULL COMMENT 'URL-Slug of the Category',
  `created` datetime NOT NULL COMMENT 'Created timestamp',
  `modified` datetime NOT NULL COMMENT 'Modified timestamp',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The primary key',
  `photo_id` int(10) unsigned NOT NULL COMMENT 'Foreign key to posts',
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The name of the commenter',
  `email` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The email of the commenter',
  `website` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'The website of the commenter',
  `comment` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'The comment',
  `created` datetime NOT NULL COMMENT 'Created timestamp',
  `modified` datetime NOT NULL COMMENT 'Modified timestamp',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `exposureprograms`;
CREATE TABLE `exposureprograms` (
  `id` int(11) NOT NULL COMMENT 'The primary key',
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The name of the Exposure Program',
  `created` datetime NOT NULL COMMENT 'Created timestamp',
  `modified` datetime NOT NULL COMMENT 'Modified timestamp',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `exposureprograms` (`id`, `name`, `created`, `modified`) VALUES
(0, 'Not defined', '2012-09-03 21:11:57', '2012-09-03 21:11:57'),
(1, 'Manual', '2012-09-03 21:11:57', '2012-09-03 21:11:57'),
(2, 'Normal program', '2012-09-03 21:11:57', '2012-09-03 21:11:57'),
(3, 'Aperture priority', '2012-09-03 21:11:57', '2012-09-03 21:11:57'),
(4, 'Shutter priority', '2012-09-03 21:11:57', '2012-09-03 21:11:57'),
(5, 'Creative program', '2012-09-03 21:11:57', '2012-09-03 21:11:57'),
(6, 'Action program', '2012-09-03 21:11:57', '2012-09-03 21:11:57'),
(7, 'Portrait mode', '2012-09-03 21:11:57', '2012-09-03 21:11:57'),
(8, 'Landscape mode', '2012-09-03 21:11:57', '2012-09-03 21:11:57');

DROP TABLE IF EXISTS `flashes`;
CREATE TABLE `flashes` (
  `id` int(11) NOT NULL COMMENT 'The primary key',
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The type of flash',
  `created` datetime NOT NULL COMMENT 'Created timestamp',
  `modified` datetime NOT NULL COMMENT 'Modified timestamp',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `flashes` (`id`, `name`, `created`, `modified`) VALUES
(0, 'Flash did not fire', '2012-09-03 21:11:57', '2012-09-03 21:11:57'),
(1, 'Flash fired', '2012-09-03 21:11:57', '2012-09-03 21:11:57'),
(5, 'Strobe return light not detected', '2012-09-03 21:11:57', '2012-09-03 21:11:57'),
(7, 'Strobe return light detected', '2012-09-03 21:11:57', '2012-09-03 21:11:57'),
(9, 'Flash fired, compulsory flash mode', '2012-09-03 21:11:57', '2012-09-03 21:11:57'),
(13, 'Flash fired, compulsory flash mode, return light not detected', '2012-09-03 21:11:57', '2012-09-03 21:11:57'),
(15, 'Flash fired, compulsory flash mode, return light detected', '2012-09-03 21:11:57', '2012-09-03 21:11:57'),
(16, 'Flash did not fire, compulsory flash mode', '2012-09-03 21:11:57', '2012-09-03 21:11:57'),
(24, 'Flash did not fire, auto mode', '2012-09-03 21:11:57', '2012-09-03 21:11:57'),
(25, 'Flash fired, auto mode', '2012-09-03 21:11:57', '2012-09-03 21:11:57'),
(29, 'Flash fired, auto mode, return light not detected', '2012-09-03 21:11:57', '2012-09-03 21:11:57'),
(31, 'Flash fired, auto mode, return light detected', '2012-09-03 21:11:57', '2012-09-03 21:11:57'),
(32, 'No flash function', '2012-09-03 21:11:57', '2012-09-03 21:11:57'),
(65, 'Flash fired, red-eye reduction mode', '2012-09-03 21:11:58', '2012-09-03 21:11:58'),
(69, 'Flash fired, red-eye reduction mode, return light not detected', '2012-09-03 21:11:58', '2012-09-03 21:11:58'),
(71, 'Flash fired, red-eye reduction mode, return light detected', '2012-09-03 21:11:58', '2012-09-03 21:11:58'),
(73, 'Flash fired, compulsory flash mode, red-eye reduction mode', '2012-09-03 21:11:58', '2012-09-03 21:11:58'),
(77, 'Flash fired, compulsory flash mode, red-eye reduction mode, return light not detected', '2012-09-03 21:11:58', '2012-09-03 21:11:58'),
(79, 'Flash fired, compulsory flash mode, red-eye reduction mode, return light detected', '2012-09-03 21:11:58', '2012-09-03 21:11:58'),
(89, 'Flash fired, auto mode, red-eye reduction mode', '2012-09-03 21:11:58', '2012-09-03 21:11:58'),
(93, 'Flash fired, auto mode, return light not detected, red-eye reduction mode', '2012-09-03 21:11:58', '2012-09-03 21:11:58'),
(95, 'Flash fired, auto mode, return light detected, red-eye reduction mode ', '2012-09-03 21:11:58', '2012-09-03 21:11:58');

DROP TABLE IF EXISTS `lenses`;
CREATE TABLE `lenses` (
  `id` int(11) NOT NULL COMMENT 'The primary key',
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The name of the lens',
  `created` datetime NOT NULL COMMENT 'Created timestamp',
  `modified` datetime NOT NULL COMMENT 'Modified timestamp',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `lenses` (`id`, `name`, `created`, `modified`) VALUES
(0, 'walimex Pro 8mm f/3.5 Fish-Eye', '2012-09-03 21:11:58', '2012-09-03 21:11:58'),
(29, 'Canon EF 50mm 1.8 II', '2012-09-03 21:11:58', '2012-09-03 21:11:58'),
(153, 'Tamron 18-200mm f/3,5-6,3 XR Di ', '2012-09-03 21:11:58', '2012-09-03 21:11:58'),
(156, 'Tamron 70-300mm f/4-5.6 Di VC US', '2012-09-03 21:11:58', '2012-09-03 21:11:58');

DROP TABLE IF EXISTS `meteringmodes`;
CREATE TABLE `meteringmodes` (
  `id` int(11) NOT NULL COMMENT 'The primary key',
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The name of the Metering Mode',
  `created` datetime NOT NULL COMMENT 'Created timestamp',
  `modified` datetime NOT NULL COMMENT 'Modified timestamp',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `meteringmodes` (`id`, `name`, `created`, `modified`) VALUES
(0, 'Unknown', '2012-09-03 21:11:58', '2012-09-03 21:11:58'),
(1, 'Average', '2012-09-03 21:11:58', '2012-09-03 21:11:58'),
(2, 'Center-weighted average', '2012-09-03 21:11:58', '2012-09-03 21:11:58'),
(3, 'Spot', '2012-09-03 21:11:58', '2012-09-03 21:11:58'),
(4, 'Multi-spot', '2012-09-03 21:11:58', '2012-09-03 21:11:58'),
(5, 'Pattern', '2012-09-03 21:11:58', '2012-09-03 21:11:58'),
(6, 'Partial', '2012-09-03 21:11:58', '2012-09-03 21:11:58'),
(255, 'Other', '2012-09-03 21:11:58', '2012-09-03 21:11:58');

DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The primary key',
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The key',
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The value',
  `created` int(11) NOT NULL COMMENT 'Created timestamp',
  `modified` int(11) NOT NULL COMMENT 'Modified timestamp',
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `photos`;
CREATE TABLE `photos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The primary key',
  `category_id` int(11) unsigned NOT NULL COMMENT 'The category of the photo',
  `cameramodelname_id` int(11) unsigned DEFAULT NULL COMMENT 'EXIF for Camera Model Name',
  `flash_id` int(11) unsigned DEFAULT NULL COMMENT 'EXIF for the Flash',
  `lens_id` int(11) unsigned DEFAULT NULL COMMENT 'EXIF fot the Lens',
  `exposureprogram_id` int(11) unsigned DEFAULT NULL COMMENT 'EXIF for the Exposure Program',
  `meteringmode_id` int(11) unsigned DEFAULT NULL COMMENT 'EXIF for Metering Mode',
  `title` varchar(80) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The title of the photo',
  `description` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'The description of the photo',
  `datecreated` datetime NOT NULL COMMENT 'EXIF for Date Created',
  `focallength` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'EXIF for Focal Length',
  `aperturevalue` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'EXIF for Aperture Value',
  `shutterspeedvalue` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'EXIF for Shutter Speed Value',
  `iso` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'EXIF for ISO',
  `gpslatituderef` enum('N','S') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'EXIF for GPS Latitude Ref',
  `gpslatitude` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'EXIF for GPS Latitude',
  `gpslongituderef` enum('E','W') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'EXIF for GPS Longitude Ref',
  `gpslongitude` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'EXIF for GPS Longitude',
  `status` enum('Draft','Published') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Draft' COMMENT 'Status of the Photo',
  `created` datetime NOT NULL COMMENT 'Created timestamp',
  `modified` datetime NOT NULL COMMENT 'Modified timestamp',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `photos_tags`;
CREATE TABLE `photos_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The primary key',
  `photo_id` int(10) unsigned NOT NULL COMMENT 'The id of the photo',
  `tag_id` int(10) unsigned NOT NULL COMMENT 'The id of the tag',
  `created` datetime NOT NULL COMMENT 'Created timestamp',
  `modified` datetime NOT NULL COMMENT 'Modified timestamp',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The primary key',
  `name` varchar(16) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Name of the Tag',
  `slug` varchar(16) COLLATE utf8_unicode_ci NOT NULL COMMENT 'URL-Slug of the Tag',
  `created` datetime NOT NULL COMMENT 'Created timestamp',
  `modified` datetime NOT NULL COMMENT 'Modified timestamp',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

