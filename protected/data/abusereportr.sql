-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 20, 2014 at 05:43 PM
-- Server version: 5.5.37
-- PHP Version: 5.3.10-1ubuntu3.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `abusereportr`
--

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
CREATE TABLE IF NOT EXISTS `devices` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `mac_address` varchar(255) NOT NULL,
  `hostname` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `line_manager` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `hall` varchar(255) NOT NULL,
  `opt` varchar(256) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) unsigned NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `email_logs`
--

DROP TABLE IF EXISTS `email_logs`;
CREATE TABLE IF NOT EXISTS `email_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_id` int(11) NOT NULL,
  `email_to` varchar(255) NOT NULL,
  `email_cc` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `body` longtext NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) unsigned NOT NULL,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `body` longtext NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) unsigned NOT NULL,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(75) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `joining_date` date NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `location_pic` varchar(255) NOT NULL,
  `hall` varchar(255) DEFAULT NULL,
  `manager1_id` int(5) unsigned DEFAULT NULL,
  `manager2_id` int(5) unsigned DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) unsigned NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

DROP TABLE IF EXISTS `managers`;
CREATE TABLE IF NOT EXISTS `managers` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) unsigned NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(75) NOT NULL,
  `last_name` varchar(75) NOT NULL,
  `username` varchar(75) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(75) NOT NULL,
  `records_per_page` int(5) unsigned NOT NULL DEFAULT '25',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `last_login` datetime NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) unsigned NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
