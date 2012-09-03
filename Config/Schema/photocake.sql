-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 30, 2012 at 10:58 PM
-- Server version: 5.5.24
-- PHP Version: 5.3.10-1ubuntu3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `photocake`
--

-- --------------------------------------------------------

--
-- Table structure for table `cameramodelnames`
--

CREATE TABLE IF NOT EXISTS `cameramodelnames` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The primary key',
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The name of the camera',
  `created` datetime NOT NULL COMMENT 'Created timestamp',
  `modified` datetime NOT NULL COMMENT 'Modified timestamp',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The primary key',
  `name` varchar(16) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Name of the Category',
  `slug` varchar(16) COLLATE utf8_unicode_ci NOT NULL COMMENT 'URL-Slug of the Category',
  `created` datetime NOT NULL COMMENT 'Created timestamp',
  `modified` datetime NOT NULL COMMENT 'Modified timestamp',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
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

-- --------------------------------------------------------

--
-- Table structure for table `exposureprograms`
--

CREATE TABLE IF NOT EXISTS `exposureprograms` (
  `id` int(11) NOT NULL COMMENT 'The primary key',
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The name of the Exposure Program',
  `created` datetime NOT NULL COMMENT 'Created timestamp',
  `modified` datetime NOT NULL COMMENT 'Modified timestamp',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `exposureprograms` VALUES (0, 'Not defined', NOW(), NOW());
INSERT INTO `exposureprograms` VALUES (1, 'Manual', NOW(), NOW());
INSERT INTO `exposureprograms` VALUES (2, 'Normal program', NOW(), NOW());
INSERT INTO `exposureprograms` VALUES (3, 'Aperture priority', NOW(), NOW());
INSERT INTO `exposureprograms` VALUES (4, 'Shutter priority', NOW(), NOW());
INSERT INTO `exposureprograms` VALUES (5, 'Creative program', NOW(), NOW());
INSERT INTO `exposureprograms` VALUES (6, 'Action program', NOW(), NOW());
INSERT INTO `exposureprograms` VALUES (7, 'Portrait mode', NOW(), NOW());
INSERT INTO `exposureprograms` VALUES (8, 'Landscape mode', NOW(), NOW());

-- --------------------------------------------------------

--
-- Table structure for table `flashes`
--

CREATE TABLE IF NOT EXISTS `flashes` (
  `id` int(11) NOT NULL COMMENT 'The primary key',
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The type of flash',
  `created` datetime NOT NULL COMMENT 'Created timestamp',
  `modified` datetime NOT NULL COMMENT 'Modified timestamp',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `flashes` VALUES (0, 'Flash did not fire', NOW(), NOW());
INSERT INTO `flashes` VALUES (1, 'Flash fired', NOW(), NOW());
INSERT INTO `flashes` VALUES (5, 'Strobe return light not detected', NOW(), NOW());
INSERT INTO `flashes` VALUES (7, 'Strobe return light detected', NOW(), NOW());
INSERT INTO `flashes` VALUES (9, 'Flash fired, compulsory flash mode', NOW(), NOW());
INSERT INTO `flashes` VALUES (13, 'Flash fired, compulsory flash mode, return light not detected', NOW(), NOW());
INSERT INTO `flashes` VALUES (15, 'Flash fired, compulsory flash mode, return light detected', NOW(), NOW());
INSERT INTO `flashes` VALUES (16, 'Flash did not fire, compulsory flash mode', NOW(), NOW());
INSERT INTO `flashes` VALUES (24, 'Flash did not fire, auto mode', NOW(), NOW());
INSERT INTO `flashes` VALUES (25, 'Flash fired, auto mode', NOW(), NOW());
INSERT INTO `flashes` VALUES (29, 'Flash fired, auto mode, return light not detected', NOW(), NOW());
INSERT INTO `flashes` VALUES (31, 'Flash fired, auto mode, return light detected', NOW(), NOW());
INSERT INTO `flashes` VALUES (32, 'No flash function', NOW(), NOW());
INSERT INTO `flashes` VALUES (65, 'Flash fired, red-eye reduction mode', NOW(), NOW());
INSERT INTO `flashes` VALUES (69, 'Flash fired, red-eye reduction mode, return light not detected', NOW(), NOW());
INSERT INTO `flashes` VALUES (71, 'Flash fired, red-eye reduction mode, return light detected', NOW(), NOW());
INSERT INTO `flashes` VALUES (73, 'Flash fired, compulsory flash mode, red-eye reduction mode', NOW(), NOW());
INSERT INTO `flashes` VALUES (77, 'Flash fired, compulsory flash mode, red-eye reduction mode, return light not detected', NOW(), NOW());
INSERT INTO `flashes` VALUES (79, 'Flash fired, compulsory flash mode, red-eye reduction mode, return light detected', NOW(), NOW());
INSERT INTO `flashes` VALUES (89, 'Flash fired, auto mode, red-eye reduction mode', NOW(), NOW());
INSERT INTO `flashes` VALUES (93, 'Flash fired, auto mode, return light not detected, red-eye reduction mode', NOW(), NOW());
INSERT INTO `flashes` VALUES (95, 'Flash fired, auto mode, return light detected, red-eye reduction mode ', NOW(), NOW());

-- --------------------------------------------------------

--
-- Table structure for table `lenses`
--

CREATE TABLE IF NOT EXISTS `lenses` (
  `id` int(11) NOT NULL COMMENT 'The primary key',
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The name of the lens',
  `created` datetime NOT NULL COMMENT 'Created timestamp',
  `modified` datetime NOT NULL COMMENT 'Modified timestamp',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `lenses` VALUE (0, 'walimex Pro 8mm f/3.5 Fish-Eye', NOW(), NOW());
INSERT INTO `lenses` VALUE (29, 'Canon EF 50mm 1.8 II', NOW(), NOW());
INSERT INTO `lenses` VALUE (153, 'Tamron 18-200mm f/3,5-6,3 XR Di II', NOW(), NOW());
INSERT INTO `lenses` VALUE (156, 'Tamron 70-300mm f/4-5.6 Di VC USD', NOW(), NOW());

-- --------------------------------------------------------

--
-- Table structure for table `meteringmodes`
--

CREATE TABLE IF NOT EXISTS `meteringmodes` (
  `id` int(11) NOT NULLCOMMENT 'The primary key',
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The name of the Metering Mode',
  `created` datetime NOT NULL COMMENT 'Created timestamp',
  `modified` datetime NOT NULL COMMENT 'Modified timestamp',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `meteringmodes` VALUES (0, 'Unknown', NOW(), NOW());
INSERT INTO `meteringmodes` VALUES (1, 'Average', NOW(), NOW());
INSERT INTO `meteringmodes` VALUES (2, 'Center-weighted average', NOW(), NOW());
INSERT INTO `meteringmodes` VALUES (3, 'Spot', NOW(), NOW());
INSERT INTO `meteringmodes` VALUES (4, 'Multi-spot', NOW(), NOW());
INSERT INTO `meteringmodes` VALUES (5, 'Pattern', NOW(), NOW());
INSERT INTO `meteringmodes` VALUES (6, 'Partial', NOW(), NOW());
INSERT INTO `meteringmodes` VALUES (255, 'Other', NOW(), NOW());

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The primary key',
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The key',
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The value',
  `created` int(11) NOT NULL COMMENT 'Created timestamp',
  `modified` int(11) NOT NULL COMMENT 'Modified timestamp',
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
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

-- --------------------------------------------------------

--
-- Table structure for table `photos_tags`
--

CREATE TABLE IF NOT EXISTS `photos_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The primary key',
  `photo_id` int(10) unsigned NOT NULL COMMENT 'The id of the photo',
  `tag_id` int(10) unsigned NOT NULL COMMENT 'The id of the tag',
  `created` datetime NOT NULL COMMENT 'Created timestamp',
  `modified` datetime NOT NULL COMMENT 'Modified timestamp',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The primary key',
  `name` varchar(16) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Name of the Tag',
  `slug` varchar(16) COLLATE utf8_unicode_ci NOT NULL COMMENT 'URL-Slug of the Tag',
  `created` datetime NOT NULL COMMENT 'Created timestamp',
  `modified` datetime NOT NULL COMMENT 'Modified timestamp',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

