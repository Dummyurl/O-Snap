-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2017 at 09:41 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `admindemo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_contactus`
--

CREATE TABLE IF NOT EXISTS `admin_contactus` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_fname` varchar(50) NOT NULL,
  `contact_lname` varchar(50) NOT NULL,
  `contact_email` varchar(50) NOT NULL,
  `contact_phone` int(10) NOT NULL,
  `contact_msg` varchar(500) NOT NULL,
  `contact_file` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `admin_contactus`
--

INSERT INTO `admin_contactus` (`contact_id`, `contact_fname`, `contact_lname`, `contact_email`, `contact_phone`, `contact_msg`, `contact_file`, `status`) VALUES
(18, 'aaa', 'bbb', 'aaa@aa.com', 999999988, 'this is test demo', 'v8ee18cbaf6e1eeafbc44e968d815e13-Chrysanthemum.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE IF NOT EXISTS `admin_login` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(50) NOT NULL,
  `admin_password` varchar(32) NOT NULL,
  `admin_pro_pic` text NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`admin_id`, `admin_name`, `admin_password`, `admin_pro_pic`) VALUES
(4, 'admin', '21232f297a57a5a743894a0e4a801fc3', '93988Desert.jpg'),
(5, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', '');

-- --------------------------------------------------------

--
-- Table structure for table `cms_pages`
--

CREATE TABLE IF NOT EXISTS `cms_pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(100) NOT NULL,
  `page_description` text NOT NULL,
  `page_photo` varchar(100) NOT NULL,
  `page_position` enum('Left','Right','Bottom') NOT NULL,
  `page_parent` varchar(100) NOT NULL,
  `page_sort` varchar(100) NOT NULL,
  `slider_sort` varchar(50) NOT NULL,
  `page_slider` varchar(100) NOT NULL,
  `d_form` varchar(100) NOT NULL,
  `page_title` varchar(100) NOT NULL,
  `page_description_seo` text NOT NULL,
  `page_keywords` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `multi_language`
--

CREATE TABLE IF NOT EXISTS `multi_language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noti_key` varchar(100) DEFAULT NULL,
  `noti_eng` text,
  `noti_other` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `multi_language`
--

INSERT INTO `multi_language` (`id`, `noti_key`, `noti_eng`, `noti_other`) VALUES
(2, 'fffff', 'test', 'test'),
(3, 'a', 'admin', 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
