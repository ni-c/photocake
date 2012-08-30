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
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The name of the camera',
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
  `name` varchar(16) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The name of the commenter',
  `email` varchar(16) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The email of the commenter',
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
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The primary key',
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The name of the Exposure Program',
  `created` datetime NOT NULL COMMENT 'Created timestamp',
  `modified` datetime NOT NULL COMMENT 'Modified timestamp',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `flashes`
--

CREATE TABLE IF NOT EXISTS `flashes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The primary key',
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The type of flash',
  `created` datetime NOT NULL COMMENT 'Created timestamp',
  `modified` datetime NOT NULL COMMENT 'Modified timestamp',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lenses`
--

CREATE TABLE IF NOT EXISTS `lenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The primary key',
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The name of the lens',
  `created` datetime NOT NULL COMMENT 'Created timestamp',
  `modified` datetime NOT NULL COMMENT 'Modified timestamp',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `meteringmodes`
--

CREATE TABLE IF NOT EXISTS `meteringmodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The primary key',
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The name of the Metering Mode',
  `created` datetime NOT NULL COMMENT 'Created timestamp',
  `modified` datetime NOT NULL COMMENT 'Modified timestamp',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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

