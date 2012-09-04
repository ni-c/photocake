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
(0, 'Not defined', now(), now()),
(1, 'Manual', now(), now()),
(2, 'Normal program', now(), now()),
(3, 'Aperture priority', now(), now()),
(4, 'Shutter priority', now(), now()),
(5, 'Creative program', now(), now()),
(6, 'Action program', now(), now()),
(7, 'Portrait mode', now(), now()),
(8, 'Landscape mode', now(), now());

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
(0, 'Flash did not fire', now(), now()),
(1, 'Flash fired', now(), now()),
(5, 'Strobe return light not detected', now(), now()),
(7, 'Strobe return light detected', now(), now()),
(9, 'Flash fired, compulsory flash mode', now(), now()),
(13, 'Flash fired, compulsory flash mode, return light not detected', now(), now()),
(15, 'Flash fired, compulsory flash mode, return light detected', now(), now()),
(16, 'Flash did not fire, compulsory flash mode', now(), now()),
(24, 'Flash did not fire, auto mode', now(), now()),
(25, 'Flash fired, auto mode', now(), now()),
(29, 'Flash fired, auto mode, return light not detected', now(), now()),
(31, 'Flash fired, auto mode, return light detected', now(), now()),
(32, 'No flash function', now(), now()),
(65, 'Flash fired, red-eye reduction mode', now(), now()),
(69, 'Flash fired, red-eye reduction mode, return light not detected', now(), now()),
(71, 'Flash fired, red-eye reduction mode, return light detected', now(), now()),
(73, 'Flash fired, compulsory flash mode, red-eye reduction mode', now(), now()),
(77, 'Flash fired, compulsory flash mode, red-eye reduction mode, return light not detected', now(), now()),
(79, 'Flash fired, compulsory flash mode, red-eye reduction mode, return light detected', now(), now()),
(89, 'Flash fired, auto mode, red-eye reduction mode', now(), now()),
(93, 'Flash fired, auto mode, return light not detected, red-eye reduction mode', now(), now()),
(95, 'Flash fired, auto mode, return light detected, red-eye reduction mode ', now(), now());

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
(0, 'walimex Pro 8mm f/3.5 Fish-Eye', now(), now()),
(29, 'Canon EF 50mm 1.8 II', now(), now()),
(153, 'Tamron 18-200mm f/3,5-6,3 XR Di ', now(), now()),
(156, 'Tamron 70-300mm f/4-5.6 Di VC US', now(), now());

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
(0, 'Unknown', now(), now()),
(1, 'Average', now(), now()),
(2, 'Center-weighted average', now(), now()),
(3, 'Spot', now(), now()),
(4, 'Multi-spot', now(), now()),
(5, 'Pattern', now(), now()),
(6, 'Partial', now(), now()),
(255, 'Other', now(), now());

DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The primary key',
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The key',
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The value',
  `created` int(11) NOT NULL COMMENT 'Created timestamp',
  `modified` int(11) NOT NULL COMMENT 'Modified timestamp',
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

INSERT INTO `options` (`id`, `key`, `value`, `created`, `modified`) VALUES
(1, 'photo_dir', 'Images/', 2012, 2012);

DROP TABLE IF EXISTS `photos`;
CREATE TABLE `photos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The primary key',
  `category_id` int(11) unsigned NOT NULL COMMENT 'The category of the photo',
  `cameramodelname_id` int(11) unsigned DEFAULT NULL COMMENT 'EXIF for Camera Model Name',
  `flash_id` int(11) unsigned DEFAULT NULL COMMENT 'EXIF for the Flash',
  `lens_id` int(11) unsigned DEFAULT NULL COMMENT 'EXIF fot the Lens',
  `exposureprogram_id` int(11) unsigned DEFAULT NULL COMMENT 'EXIF for the Exposure Program',
  `meteringmode_id` int(11) unsigned DEFAULT NULL COMMENT 'EXIF for Metering Mode',
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The filename of the photo',
  `title` varchar(80) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The title of the photo',
  `description` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'The description of the photo',
  `datecreated` datetime NOT NULL COMMENT 'EXIF for Date Created',
  `focallength` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'EXIF for Focal Length',
  `fnumber` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'EXIF for Aperture Value',
  `exposuretime` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'EXIF for Shutter Speed Value',
  `iso` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'EXIF for ISO',
  `gpslatituderef` enum('N','S') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'EXIF for GPS Latitude Ref',
  `gpslatitude` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'EXIF for GPS Latitude',
  `gpslongituderef` enum('E','W') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'EXIF for GPS Longitude Ref',
  `gpslongitude` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'EXIF for GPS Longitude',
  `status` enum('Draft','Published') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Draft' COMMENT 'Status of the Photo',
  `created` datetime NOT NULL COMMENT 'Created timestamp',
  `modified` datetime NOT NULL COMMENT 'Modified timestamp',
  PRIMARY KEY (`id`),
  UNIQUE KEY `filename` (`filename`)
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

