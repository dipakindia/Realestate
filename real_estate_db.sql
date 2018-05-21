-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2018 at 04:09 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `real_estate_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_users`
--

CREATE TABLE IF NOT EXISTS `tbl_admin_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `avatar` varchar(255) DEFAULT 'default.jpg',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_admin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_confirmed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_admin_users`
--

INSERT INTO `tbl_admin_users` (`id`, `username`, `email`, `password`, `avatar`, `created_at`, `updated_at`, `is_admin`, `is_confirmed`, `is_deleted`) VALUES
(1, 'admin', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'default.jpg', '2017-04-04 00:00:00', '2017-04-04 00:00:00', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blog_records`
--

CREATE TABLE IF NOT EXISTS `tbl_blog_records` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_title` varchar(50) NOT NULL,
  `blog_photo` varchar(220) NOT NULL,
  `blog_description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `added_date` date NOT NULL,
  `updated_date` date NOT NULL,
  PRIMARY KEY (`blog_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_blog_records`
--

INSERT INTO `tbl_blog_records` (`blog_id`, `blog_title`, `blog_photo`, `blog_description`, `status`, `added_date`, `updated_date`) VALUES
(2, 'test', '1200-x-1200-1358535249243-1358524149530-coconut-palm-pavilion-tent@3x.png', 'xvbxcbcvb', 1, '2017-03-16', '0000-00-00'),
(3, 'Lorem ipsum dolor sit amet, consectetur adipisicin', 'padlock-closed.png', 'vcbcvbc', 1, '2017-03-19', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_records`
--

CREATE TABLE IF NOT EXISTS `tbl_category_records` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `category_image` varchar(220) NOT NULL,
  `category_description` text NOT NULL,
  `status` int(11) NOT NULL,
  `added_date` date NOT NULL,
  `updated_date` date NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `sort_by` int(11) NOT NULL,
  `show` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_category_records`
--

INSERT INTO `tbl_category_records` (`category_id`, `category_name`, `parent_id`, `category_image`, `category_description`, `status`, `added_date`, `updated_date`, `ip_address`, `sort_by`, `show`) VALUES
(1, 'test', 0, 'change_password-128.png', 'dfg fdgfdgf h fgh fgh', 1, '2017-03-16', '2017-03-16', '', 0, 1),
(2, 'test Sub Cat', 1, 'change_password-128.png', '', 0, '2017-03-16', '2017-03-16', '', 0, 1),
(4, 'Demonetization op as the quantity', 0, '1200-x-1200-1358535249243-1358524149530-coconut-palm-pavilion-tent@2x_1491354652.png', 'Demonetization op as the quantity', 1, '0000-00-00', '0000-00-00', '', 0, 1),
(5, 'test data 11', 2, 'WIN_20170408_11_45_32_Pro_1491901459.jpg', 'asdfghb gr h ghhg', 1, '0000-00-00', '0000-00-00', '', 0, 1),
(6, 'test data', 0, 'sd_1498636021.jpeg', '', 1, '0000-00-00', '0000-00-00', '', 0, 1),
(7, 'Shoes', 6, 'nexcom_1500197283.jpg', '', 1, '0000-00-00', '0000-00-00', '', 0, 1),
(8, 'Shoes', 2, 'chat_1500196934.jpg', '', 1, '0000-00-00', '0000-00-00', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_content_records`
--

CREATE TABLE IF NOT EXISTS `tbl_content_records` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `content_title` varchar(250) NOT NULL,
  `content_description` text NOT NULL,
  `status` int(11) NOT NULL,
  `added_date` date NOT NULL,
  `updated_date` date NOT NULL,
  `ip_address` int(11) NOT NULL,
  `action` varchar(150) NOT NULL,
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_content_records`
--

INSERT INTO `tbl_content_records` (`content_id`, `content_title`, `content_description`, `status`, `added_date`, `updated_date`, `ip_address`, `action`) VALUES
(1, 'Privacy Policy', 'Lorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicing', 1, '2017-03-20', '2017-03-20', 0, 'privacy_policy'),
(2, 'Terms and Condition', 'Lorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicingLorem ipsum dolor sit amet, consectetur adipisicing', 1, '2017-03-20', '2017-03-20', 0, 'terms'),
(3, 'first data1', '<p>&nbsp;&nbsp;&nbsp; Hire a Website Designer&nbsp;&nbsp;&nbsp;&nbsp; Hi, Its a small school recognized by state Govt. having strength of around 180 students. My sister ( [url removed, login to view], [url removed, login to view] &amp; MA ) runs this school and struggles a lot to attract students admissions because it is in the premises of &nbsp;&nbsp;&nbsp; Hire a Website Designer&nbsp;&nbsp;&nbsp;&nbsp; Hi, Its a small school recognized by state Govt. having strength of around 180 students. My sister ( [url removed, login to view], [url removed, login to view] &amp; MA ) runs this school and struggles a lot to attract students admissions because it is in the premises of &nbsp;&nbsp;&nbsp; Hire a Website Designer&nbsp;&nbsp;&nbsp;&nbsp; Hi, Its a small school recognized by state Govt. having strength of around 180 students. My sister ( [url removed, login to view], [url removed, login to view] &amp; MA ) runs this school and struggles a lot to attract students admissions because it is in the premises of &nbsp;&nbsp;&nbsp; Hire a Website Designer&nbsp;&nbsp;&nbsp;&nbsp; Hi, Its a small school recognized by state Govt. having strength of around 180 students. My sister ( [url removed, login to view], [url removed, login to view] &amp; MA ) runs this school and struggles a lot to attract students admissions because it is in the premises of &nbsp;&nbsp;&nbsp; Hire a Website Designer&nbsp;&nbsp;&nbsp;&nbsp; Hi, Its a small school recognized by state Govt. having strength of around 180 students. My sister ( [url removed, login to view], [url removed, login to view] &amp; MA ) runs this school and struggles a lot to attract students admissions because it is in the premises of &nbsp;&nbsp;&nbsp; Hire a Website Designer&nbsp;&nbsp;&nbsp;&nbsp; Hi, Its a small school recognized by state Govt. having strength of around 180 students. My sister ( [url removed, login to view], [url removed, login to view] &amp; MA ) runs this school and struggles a lot to attract students admissions because it is in the premises of &nbsp;&nbsp;&nbsp; Hire a Website Designer&nbsp;&nbsp;&nbsp;&nbsp; Hi, Its a small school recognized by state Govt. having strength of around 180 students. My sister ( [url removed, login to view], [url removed, login to view] &amp; MA ) runs this school and struggles a lot to attract students admissions because it is in the premises of &nbsp;&nbsp;&nbsp; Hire a Website Designer&nbsp;&nbsp;&nbsp;&nbsp; Hi, Its a small school recognized by state Govt. having strength of around 180 students. My sister ( [url removed, login to view], [url removed, login to view] &amp; MA ) runs this school and struggles a lot to attract students admissions because it is in the premises of &nbsp;&nbsp;&nbsp; Hire a Website Designer&nbsp;&nbsp;&nbsp;&nbsp; Hi, Its a small school recognized by state Govt. having strength of around 180 students. My sister ( [url removed, login to view], [url removed, login to view] &amp; MA ) runs this school and struggles a lot to attract students admissions because it is in the premises of &nbsp;&nbsp;&nbsp; Hire a Website Designer&nbsp;&nbsp;&nbsp;&nbsp; Hi, Its a small school recognized by state Govt. having strength of around 180 students. My sister ( [url removed, login to view], [url removed, login to view] &amp; MA ) runs this school and struggles a lot to attract students admissions because it is in the premises of &nbsp;&nbsp;&nbsp; Hire a Website Designer&nbsp;&nbsp;&nbsp;&nbsp; Hi, Its a small school recognized by state Govt. having strength of around 180 students. My sister ( [url removed, login to view], [url removed, login to view] &amp; MA ) runs this school and struggles a lot to attract students admissions because it is in the premises of &nbsp;&nbsp;&nbsp; Hire a Website Designer&nbsp;&nbsp;&nbsp;&nbsp; Hi, Its a small school recognized by state Govt. having strength of around 180 students. My sister ( [url removed, login to view], [url removed, login to view] &amp; MA ) runs this school and struggles a lot to attract students admissions because it is in the premises of &nbsp;&nbsp;&nbsp; Hire a Website Designer&nbsp;&nbsp;&nbsp;&nbsp; Hi, Its a small school recognized by state Govt. having strength of around 180 students. My sister ( [url removed, login to view], [url removed, login to view] &amp; MA ) runs this school and struggles a lot to attract students admissions because it is in the premises of</p>\r\n', 1, '2017-04-08', '2017-04-08', 0, 'sdcdds');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_enquiry_records`
--

CREATE TABLE IF NOT EXISTS `tbl_enquiry_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `added_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feature_records`
--

CREATE TABLE IF NOT EXISTS `tbl_feature_records` (
  `feature_id` int(11) NOT NULL AUTO_INCREMENT,
  `feature_name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `added_date` date NOT NULL,
  `updated_date` date NOT NULL,
  PRIMARY KEY (`feature_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_feature_records`
--

INSERT INTO `tbl_feature_records` (`feature_id`, `feature_name`, `status`, `added_date`, `updated_date`) VALUES
(1, 'Free Parking', 1, '2017-03-16', '2017-03-16'),
(2, 'Air Condition', 1, '2017-03-16', '2017-03-16'),
(4, 'Places to seat', 1, '0000-00-00', '0000-00-00'),
(5, 'Swimming Pool', 1, '0000-00-00', '0000-00-00'),
(6, 'Laundry Room', 1, '0000-00-00', '0000-00-00'),
(7, 'Window Covering', 1, '0000-00-00', '0000-00-00'),
(3, 'Alarm', 1, '0000-00-00', '0000-00-00'),
(8, 'Central Heating', 1, '2018-05-08', '2018-05-08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_locality`
--

CREATE TABLE IF NOT EXISTS `tbl_locality` (
  `city_id` int(100) NOT NULL,
  `name` varchar(256) NOT NULL,
  `latitude` varchar(250) NOT NULL,
  `longitude` varchar(250) NOT NULL,
  `postal_code` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_locality`
--

INSERT INTO `tbl_locality` (`city_id`, `name`, `latitude`, `longitude`, `postal_code`, `status`, `id`) VALUES
(1, 'Naraina', '28.6321', '77.1389', '', 1, 1),
(1, 'Badarpur Border', '28.4932', '77.3030', '', 1, 2),
(2, 'Sec 31, Faridabad', '28.4538', '77.0493', '', 1, 3),
(2, 'Ballabhgarh', '28.3422', '77.3256', '', 1, 4),
(3, 'sec 47', '28.4264', '77.0478', '', 1, 5),
(1, 'test 1', '', '', '', 1, 6),
(1, 'test 1', '', '', '', 1, 7),
(1, 'test 1', '', '', '', 0, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offers_records`
--

CREATE TABLE IF NOT EXISTS `tbl_offers_records` (
  `offer_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `offer_title` varchar(250) NOT NULL,
  `offer_desc` text NOT NULL,
  `offer_image` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `added_date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `sponsered` int(11) NOT NULL,
  `location` text NOT NULL,
  `recomonded` int(11) NOT NULL,
  `rec_start_date` date NOT NULL,
  `rec_end_date` date NOT NULL,
  PRIMARY KEY (`offer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `tbl_offers_records`
--

INSERT INTO `tbl_offers_records` (`offer_id`, `product_id`, `offer_title`, `offer_desc`, `offer_image`, `start_date`, `end_date`, `added_date`, `status`, `sponsered`, `location`, `recomonded`, `rec_start_date`, `rec_end_date`) VALUES
(1, 15, 'abc', '', '', '2017-03-27', '2017-03-23', '2017-03-09 00:00:00', 1, 1, '', 0, '0000-00-00', '0000-00-00'),
(3, 15, 'qwerty', '', '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(4, 15, 'qwerty', '', '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(5, 15, 'qwerty', '', '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(6, 15, 'qwerty', '', '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(7, 15, 'offer title', '', '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(8, 15, 'offer title', '', '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(9, 15, 'offer title', '', '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(10, 15, 'offer title', '', '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(11, 15, 'offer title', '', '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(12, 15, 'offer title', '', '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(13, 15, 'offer title', '', '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(14, 15, 'offer title', '', '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(15, 15, 'offer title', '', '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(16, 15, 'offer title', '', '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(17, 15, 'offer title', '', '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(18, 15, 'offer title', '', '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(19, 15, 'offer title', '', '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(20, 15, 'offerytitle', '', '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(30, 15, 'offer title', '', '_1490765299.', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(29, 15, 'offer title', '', '_1490765273.', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(28, 15, 'offer title', 'hhdhdhdhrt ghf fgh', '_1490765266.', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(27, 15, 'offer title', '', '_1490765205.', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(26, 15, 'qwerty', 'sr ghfghfh', 'karlstorz_1490657257.png', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(31, 15, 'offer title', '', '_1490765306.', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(32, 15, 'offer title', '', '_1490765311.', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(33, 15, 'offer title', '', '_1490765342.', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(34, 15, 'ffssyy', '', '_1490768425.', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(35, 15, 'ffssyy', '', '_1490768435.', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(36, 15, 'offer ', '', '_1490914995.', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, 0, '', 0, '0000-00-00', '0000-00-00'),
(37, 2, 'qwerty', 'acvxcbvnbm', '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 1, 0, '', 0, '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offer_comments`
--

CREATE TABLE IF NOT EXISTS `tbl_offer_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `offer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `added_date` datetime NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_offer_comments`
--

INSERT INTO `tbl_offer_comments` (`comment_id`, `offer_id`, `user_id`, `comment_text`, `added_date`) VALUES
(1, 1, 25, 'Nice Offer', '2017-04-02 08:00:00'),
(2, 1, 35, 'Lovely Product..', '0000-00-00 00:00:00'),
(3, 2, 1, 'dfgdfgfghfhfg', '2017-04-02 16:13:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_places_records`
--

CREATE TABLE IF NOT EXISTS `tbl_places_records` (
  `id` int(115) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(100) NOT NULL,
  `place_image` varchar(255) NOT NULL,
  `latitude` varchar(20) NOT NULL,
  `longitude` varchar(20) NOT NULL,
  `country` varchar(255) NOT NULL DEFAULT 'India',
  `state` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `added_date` date NOT NULL,
  UNIQUE KEY `Unique` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_places_records`
--

INSERT INTO `tbl_places_records` (`id`, `city_name`, `place_image`, `latitude`, `longitude`, `country`, `state`, `status`, `added_date`) VALUES
(1, 'Delhi', 'change_password-128.png', '28.7041', '77.1025', 'India', 1, 1, '0000-00-00'),
(2, 'Faridabad', 'change_password-128.png', '28.4089', '77.3178', 'India', 2, 1, '0000-00-00'),
(3, 'test', 'WIN_20170306_11_16_20_Pro_1491888926.jpg', '1234', '35467', 'India', 1, 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_images`
--

CREATE TABLE IF NOT EXISTS `tbl_product_images` (
  `product_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `image_url` varchar(225) NOT NULL,
  `status` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  PRIMARY KEY (`product_image_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `tbl_product_images`
--

INSERT INTO `tbl_product_images` (`product_image_id`, `product_id`, `image_url`, `status`, `added_date`) VALUES
(2, 25, 'Untitled_1490821574.png', 1, '2017-03-30 14:36:14'),
(3, 25, 'Untitled_1490821619.png', 1, '2017-03-30 14:36:59'),
(4, 25, 'Untitled_1490821627.png', 1, '2017-03-30 14:37:07'),
(5, 25, 'Untitled_1490822319.png', 1, '2017-03-30 14:48:39'),
(6, 26, 'Untitled_1490822341.png', 1, '2017-03-30 14:49:01'),
(7, 26, 'Untitled_1490823221.png', 1, '2017-03-30 15:03:41'),
(8, 28, 'property_1490824043.png', 1, '2017-03-30 15:17:23'),
(9, 29, 'property_1490824354.png', 1, '2017-03-30 15:22:34'),
(10, 29, 'property_1490824395.png', 1, '2017-03-30 15:23:15'),
(11, 29, 'property_1490824400.png', 1, '2017-03-30 15:23:20'),
(12, 29, 'property_1490824406.png', 1, '2017-03-30 15:23:26'),
(13, 30, 'property_1490824868.png', 1, '2017-03-30 15:31:08'),
(14, 30, 'property_1490824872.png', 1, '2017-03-30 15:31:12'),
(15, 30, 'property_1490824875.png', 1, '2017-03-30 15:31:15'),
(16, 33, 'app_store_1500274394.png', 0, '2017-07-17 20:53:14'),
(17, 33, 'app-stores_1500274394.png', 0, '2017-07-17 20:53:14'),
(18, 33, 'bg_1500274394.jpg', 0, '2017-07-17 20:53:14'),
(19, 33, 'center_1500274394.jpg', 0, '2017-07-17 20:53:14'),
(20, 33, 'fb_1500274394.jpg', 0, '2017-07-17 20:53:14'),
(21, 34, 'app_store_1500274450.png', 1, '2017-07-17 20:54:10'),
(22, 34, 'app-stores_1500274450.png', 1, '2017-07-17 20:54:10'),
(26, 0, 'tw_1500278448.jpg', 1, '2017-07-17 22:00:48'),
(24, 34, 'center_1500274450.jpg', 1, '2017-07-17 20:54:10'),
(25, 34, 'fb_1500274450.jpg', 1, '2017-07-17 20:54:10'),
(27, 0, 'inst_1500278622.jpg', 1, '2017-07-17 22:03:42'),
(28, 0, 'inst_1500278631.jpg', 1, '2017-07-17 22:03:51'),
(29, 0, '_1500278647.', 1, '2017-07-17 22:04:07'),
(30, 0, '_1500278653.', 1, '2017-07-17 22:04:13'),
(31, 0, 'inst_1500278714.jpg', 1, '2017-07-17 22:05:14'),
(32, 34, 'inst_1500278805.jpg', 1, '2017-07-17 22:06:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_records`
--

CREATE TABLE IF NOT EXISTS `tbl_product_records` (
  `product_id` int(115) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(225) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `price` varchar(20) NOT NULL,
  `location` varchar(255) NOT NULL,
  `latitude` varchar(80) NOT NULL,
  `longitude` varchar(80) NOT NULL,
  `product_description` text NOT NULL,
  `features_ids` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `added_date` datetime NOT NULL,
  `property_type` int(11) NOT NULL,
  `property_status` varchar(200) NOT NULL,
  `area` varchar(200) NOT NULL,
  `area_unit` varchar(225) NOT NULL,
  `rooms` int(11) NOT NULL,
  `bathrooms` int(11) NOT NULL,
  `parking` int(11) NOT NULL,
  `balcony` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `postal_code` varchar(200) NOT NULL,
  `building_age` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` bigint(25) NOT NULL,
  `room_optional` int(11) NOT NULL,
  `bathroom_optional` int(11) NOT NULL,
  UNIQUE KEY `unique` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_product_records`
--

INSERT INTO `tbl_product_records` (`product_id`, `user_id`, `product_title`, `price`, `location`, `latitude`, `longitude`, `product_description`, `features_ids`, `status`, `added_date`, `property_type`, `property_status`, `area`, `area_unit`, `rooms`, `bathrooms`, `parking`, `balcony`, `address`, `city_id`, `state_id`, `postal_code`, `building_age`, `name`, `email`, `phone`, `room_optional`, `bathroom_optional`) VALUES
(1, '5', 'Integrated Gateway NC-MG930-X', '123', '', '', '', 'aefgrhttjyuk uyiuy', 'Free Parking,Air Condition,Swimming Pool,Laundry Room,Alarm', 1, '2018-05-08 09:14:34', 2, 'For Sale', '50000', '', 4, 5, 1, 2, '550 DDa Flats Badarpur', 0, 0, '110044', '0-5 Years', '', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_property_type_records`
--

CREATE TABLE IF NOT EXISTS `tbl_property_type_records` (
  `property_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_type_name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `added_date` date NOT NULL,
  `updated_date` date NOT NULL,
  PRIMARY KEY (`property_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_property_type_records`
--

INSERT INTO `tbl_property_type_records` (`property_type_id`, `property_type_name`, `status`, `added_date`, `updated_date`) VALUES
(1, 'House', 1, '2017-03-16', '2017-03-16'),
(2, 'Residential', 1, '2017-03-16', '2017-03-16'),
(4, 'Apartment', 1, '0000-00-00', '0000-00-00'),
(5, 'Co-Space', 1, '0000-00-00', '0000-00-00'),
(6, 'Student Space', 1, '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state_records`
--

CREATE TABLE IF NOT EXISTS `tbl_state_records` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(50) NOT NULL,
  `country` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `added_date` date NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_state_records`
--

INSERT INTO `tbl_state_records` (`state_id`, `state_name`, `country`, `status`, `added_date`) VALUES
(1, 'New Delhi', 1, 1, '2017-04-11'),
(2, 'Haryana', 1, 1, '2017-04-11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_records`
--

CREATE TABLE IF NOT EXISTS `tbl_user_records` (
  `id` int(115) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(15) DEFAULT NULL,
  `about` text,
  `latitude` varchar(10) DEFAULT NULL,
  `longitude` varchar(10) DEFAULT NULL,
  `country_code` int(20) NOT NULL,
  `email_id` varchar(100) DEFAULT NULL,
  `mobile` varchar(16) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_verified` tinyint(1) DEFAULT '0',
  `email_verified` tinyint(1) DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_of_birth` varchar(255) NOT NULL,
  `updated_on` datetime NOT NULL,
  `status` varchar(180) DEFAULT '0',
  `profile_pic` varchar(255) DEFAULT NULL,
  `cover_pic` varchar(255) DEFAULT NULL,
  `is_customer` tinyint(1) DEFAULT '1',
  `is_merchant` tinyint(1) DEFAULT '0',
  `business_name` varchar(255) NOT NULL,
  `office_address` varchar(180) DEFAULT NULL,
  `peryear_sale` varchar(120) DEFAULT NULL,
  `office_email` varchar(100) DEFAULT NULL,
  `office_phone` int(15) DEFAULT NULL,
  `device_type` varchar(50) NOT NULL,
  `device_token` varchar(80) NOT NULL,
  `registered_via` varchar(25) NOT NULL,
  `verify_merchant` int(11) NOT NULL,
  `fb_id` varchar(50) NOT NULL,
  `gplus_id` varchar(50) NOT NULL,
  `token_id` varchar(255) NOT NULL,
  `city_ids` text NOT NULL,
  `category_ids` text NOT NULL,
  `Locality_ids` text NOT NULL,
  `Filter_ids` text NOT NULL,
  `offer_limit` bigint(20) NOT NULL,
  PRIMARY KEY (`mobile`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=129 ;

--
-- Dumping data for table `tbl_user_records`
--

INSERT INTO `tbl_user_records` (`id`, `first_name`, `last_name`, `about`, `latitude`, `longitude`, `country_code`, `email_id`, `mobile`, `password`, `phone_verified`, `email_verified`, `date`, `date_of_birth`, `updated_on`, `status`, `profile_pic`, `cover_pic`, `is_customer`, `is_merchant`, `business_name`, `office_address`, `peryear_sale`, `office_email`, `office_phone`, `device_type`, `device_token`, `registered_via`, `verify_merchant`, `fb_id`, `gplus_id`, `token_id`, `city_ids`, `category_ids`, `Locality_ids`, `Filter_ids`, `offer_limit`) VALUES
(128, 'dipak kumar', 'Nimawat', NULL, NULL, NULL, 0, 'john@queen.com', '', 'john', 0, 0, '2018-05-06 03:25:52', '', '0000-00-00 00:00:00', '0', NULL, NULL, 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '', '', '', '', 0),
(5, 'Dipak Kumar', 'Nimawat', '550 DDa Flat Badarpur New Delhi, 110044', '846532851', '8645321', 0, 'dipak.nimawat@gmail.com', '+919899739226', 'qwerty', 1, 1, '2018-05-06 09:24:31', '30 March 1990', '2018-05-06 11:24:31', '1', NULL, NULL, 1, 1, 'India Infosystem pvt Ltd', '550 DDa Flat Badarpur New Delhi, 110044', '5,00,000', 'info@indiainfosystem.com', 963258741, '', '', '', 0, '', '', '', '5,7,9', '4', '5', '4, 4, 4, 1, 1, ', 25),
(76, 'jitu', 'kumar', NULL, NULL, NULL, 0, 'jkg@gmail.com', '1213456789', '123456', 0, 0, '2017-06-07 07:22:50', '14 Apr 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 1, '', 'address', 'sales', 'email', 0, '', '', '', 0, '', '', '', '5,7,9', '3,2,7', '', '', 0),
(20, 'jiten', NULL, NULL, NULL, NULL, 0, 'jkg@jk.com', '1223545655', '123456', 0, 0, '2017-05-31 18:36:18', '02 Jan 2010', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '5,7,9', '3,2,7', '', '', 0),
(78, 'taera', '', NULL, NULL, NULL, 0, 'tk@gm.co', '123455567890', '123456', 0, 0, '2017-05-31 18:36:18', '20 Apr 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(8, 'ani', NULL, NULL, NULL, NULL, 0, 'ani@gm.com', '123456', '1234567', 0, 0, '2017-05-31 18:36:18', '01-02-1992', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, 'ios', 'haskfgj3r43', '', 0, '', '', '', '5,7,9', '3,2,7', '', '', 0),
(9, 'ani', NULL, NULL, NULL, NULL, 0, 'ani@gmail.com', '12345678', '123456', 0, 0, '2017-05-31 18:36:18', '01-02-1992', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '5,7,9', '3,2,7', '', '', 0),
(124, 'abc', '', NULL, NULL, NULL, 0, 'def@gyt.com', '12345678568', 'technical', 0, 0, '2017-06-08 02:05:58', '08 Jun, 2000', '0000-00-00 00:00:00', '0', '', NULL, 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '', '', '', '', 0),
(2, 'dfgh', NULL, NULL, NULL, NULL, 0, 'mohit@pp.com', '1234567890', '123456', 0, 0, '2017-05-31 18:36:18', '15-3-2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '1c79e244267280bb2f7a4f76cea3c26c', '5,7,9', '3,2,7', '', '', 0),
(16, 'jio', NULL, NULL, NULL, NULL, 0, 'jio@jio.com', '12345678902', '12345678', 0, 0, '2017-05-31 18:36:18', '15 08 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '5,7,9', '3,2,7', '', '', 0),
(79, 'jk', '', NULL, NULL, NULL, 0, 'jk@gm.co', '1234567980', '123456', 0, 0, '2017-06-12 19:27:53', '15 Apr 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 1, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(90, 'jitender', '', NULL, NULL, NULL, 0, 'mysol@gmail.com', '1234568698855', '123456', 0, 0, '2017-06-02 20:51:47', '03 May 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 1, '', 'address', 'sales', 'email', 0, '', '', '', 1, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(83, 'jitu', '', NULL, NULL, NULL, 0, 'jitu@gmail.com', '123546522245', '123456', 0, 0, '2017-06-02 20:51:47', '20 Apr 1990', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 1, '', 'address', 'sales', 'email', 0, '', '', '', 1, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(94, 'gggggg', '', NULL, NULL, NULL, 0, 'qwerty@qwerty.com', '1236547890', 'qwertyuiop', 0, 0, '2017-06-02 20:51:47', '17 May 2003', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(120, 'jao', '', NULL, NULL, NULL, 0, 'tata@tata.co.op', '1236547899', 'qwertyuiop', 0, 0, '2017-06-02 20:51:47', '01 Jun, 1984', '0000-00-00 00:00:00', '1', '', NULL, 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '', '', '', '', 0),
(100, 'jitender', '', NULL, NULL, NULL, 0, 'ytera@gh.com', '1465845621', '123456', 0, 0, '2017-06-02 20:51:47', '03 May, 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(47, 'jitender', '', NULL, NULL, NULL, 0, 'jkm@gm.com', '15454228945', '123456', 0, 0, '2017-05-31 18:36:18', '01-02-1995', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(80, 'yogi', '', NULL, NULL, NULL, 0, 'yogi@gmail.com', '156481567890', '123456', 0, 0, '2017-05-31 18:36:18', '17 Apr 1997', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 1, '', 'address', 'sales', 'email', 0, '', '', '', 1, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(3, '234232', NULL, NULL, NULL, NULL, 0, '232323232@ergerg.rt', '2323232232', 'ererer', 0, 0, '2017-05-31 18:36:18', '23-3-2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '5,7,9', '3,2,7', '', '', 0),
(46, 'jitender', '', NULL, NULL, NULL, 0, 'jhyg@jhg.com', '2354564', '123456', 0, 0, '2017-05-31 18:36:18', '01-02-1995', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(125, 'sud', '', NULL, NULL, NULL, 0, 'amit@gmail.com', '2454864645', 'qwerty', 0, 0, '2017-06-08 03:38:14', '15 Jun, 2017', '0000-00-00 00:00:00', '0', '', NULL, 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '', '', '', '', 0),
(54, 'jitender', '', NULL, NULL, NULL, 0, 'kumar@gm.com', '2456458465', '5454545', 0, 0, '2017-05-31 18:36:18', '01 Mar 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '1,1', '1,3', 0),
(95, 'uhhhhh', '', NULL, NULL, NULL, 0, 'qwerty@qwerty.co.in', '25588888888', 'ppooiiuu', 0, 0, '2017-06-02 20:51:47', '12 May 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(126, 'sudhir kumar', '', NULL, NULL, NULL, 0, 'rahul@gmail.com', '2583698741', 'qwerty', 0, 0, '2017-06-08 03:57:54', '04 Jun, 2017', '0000-00-00 00:00:00', '0', '', NULL, 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '', '', '', '', 0),
(119, 'vasu', '', NULL, NULL, NULL, 0, 'hello@tata.com', '2588522580', 'qwertyuiop', 0, 0, '2017-06-02 21:00:45', '01 Jun, 1990', '0000-00-00 00:00:00', '1', '', NULL, 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '07e1cd7dca89a1678042477183b7ac3f', '', '', '', '', 0),
(72, 'jhgfu', '', NULL, NULL, NULL, 0, 'czsdx@zxdc.com', '3541564542', '1234564655', 0, 0, '2017-05-31 18:36:18', '04 Apr 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(97, 'jijrek', '', NULL, NULL, NULL, 0, 'jhgj@khji.com', '3546346652', '123456', 0, 0, '2017-06-02 20:51:47', '04 May 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 1, '', 'address', 'sales', 'email', 0, '', '', '', 1, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(22, 'jitu', NULL, NULL, NULL, NULL, 0, 'gauk@gmail.com', '3546876954654', '12345678', 0, 0, '2017-05-31 18:36:18', '18 Mar 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '5,7,9', '3,2,7', '', '', 0),
(58, 'jhi', '', NULL, NULL, NULL, 0, 'juhju@hu.bvyuhbn', '3651465464645', '2313532122132', 0, 0, '2017-05-31 18:36:18', '03 Mar 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(73, 'FDVBDFV', '', NULL, NULL, NULL, 0, 'dfbh@sdfs.vo', '3654654674772', '465465', 0, 0, '2017-05-31 18:36:18', '18 Apr 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(101, 'rtuytr', '', NULL, NULL, NULL, 0, 'fghnfg@vgnhv.fgh', '4524524524', '123456', 0, 0, '2017-06-02 20:51:47', '03 May, 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(48, 'jitender', '', NULL, NULL, NULL, 0, 'jkmfg@gm.com', '45325452', '123456', 0, 0, '2017-05-31 18:36:18', '01-02-1995', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(7, 'jitu', NULL, NULL, NULL, NULL, 0, 'jk@gm.com', '4545464215', '123456789', 0, 0, '2017-06-11 13:44:02', '7-3-2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 1, 'Startup Data', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '5,7,9', '3,2,7', '', '', 0),
(112, 'Rt', '', NULL, NULL, NULL, 0, 'arti@gmail.com', '4553588665', '123456', 0, 0, '2017-06-02 20:51:47', '17 May, 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(71, 'sumit', '', NULL, NULL, NULL, 0, 'sum@gm.com', '4567891234', '123456', 0, 0, '2017-05-31 18:36:18', '11 Apr 1990', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(17, 'jjkkjkjk', NULL, NULL, NULL, NULL, 0, 'jkjkjkj@gvhf.vgh', '456846656666', '44454545', 0, 0, '2017-05-31 18:36:18', '04 Jan 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '5,7,9', '3,2,7', '', '', 0),
(6, 'panshulv', NULL, NULL, NULL, NULL, 0, 'vxhvsbx@gmail.com', '4994877654', 'zvgsjsbx', 0, 0, '2017-05-31 18:36:18', '6-3-1979', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '5,7,9', '3,2,7', '', '', 0),
(123, 'Estate ', '', NULL, NULL, NULL, 0, 'abc@def.com', '5252525252', 'qwerty', 0, 0, '2017-06-08 01:28:51', '08 Jun, 1990', '0000-00-00 00:00:00', '0', '', NULL, 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '', '', '', '', 0),
(113, 'jfik', '', NULL, NULL, NULL, 0, 'hfr@urkr.com', '53456985386', '123456', 0, 0, '2017-06-02 20:51:47', '03 May, 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(27, 'jitender', NULL, NULL, NULL, NULL, 0, 'jkg@gm.com', '53752785895', '123456', 0, 0, '2017-05-31 18:36:18', '01-02-1990', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 1, '', 'address', 'sales', 'email', 0, '', '', '', 0, '', '', '7bc1ec1d9c3426357e69acd5bf320061', '5,7,9', '3,2,7', '', '', 0),
(106, 'jkhh', '', NULL, NULL, NULL, 0, 'hc@ucu.com', '53883868866', 'ycucivjh', 0, 0, '2017-06-02 20:51:47', '17 May, 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(99, 'jitender', '', NULL, NULL, NULL, 0, 'jkgh@gmail.com', '5434864349', '123456', 0, 0, '2017-06-02 20:51:47', '05 May, 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(49, 'abcd', '', NULL, NULL, NULL, 0, 'jkjg@jgjh.com', '5454', '123456', 0, 0, '2017-06-12 19:23:03', '01-02-1995', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 1, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(24, 'hsjs', NULL, NULL, NULL, NULL, 0, 'dhdj@hdjd.dkdk', '5454845466', 'ghshshsj', 0, 0, '2017-05-31 18:36:18', '31 Mar 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '5,7,9', '3,2,7', '', '', 0),
(53, 'abcd', 'efgh', NULL, NULL, NULL, 0, 'jrefg@jgjh.com', '545742474', '123456', 0, 0, '2017-05-31 18:36:18', '01-02-1995', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(52, 'abcd', 'efgh', NULL, NULL, NULL, 0, 'jkjthtgg@jgjh.com', '54574247474', '123456', 0, 0, '2017-05-31 18:36:18', '01-02-1995', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(51, 'abcd', 'efgh', NULL, NULL, NULL, 0, 'jkjthgg@jgjh.com', '5457424774', '123456', 0, 0, '2017-05-31 18:36:18', '01-02-1995', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(116, 'ufufi', '', NULL, NULL, NULL, 0, 'ifig@igig.com', '54648494656', 'fqyquqga', 0, 0, '2017-06-02 20:51:47', '09 May, 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(13, 'jkituy', NULL, NULL, NULL, NULL, 0, 'jkji@hguj.cvhvh', '56635465555', '45454544555', 0, 0, '2017-05-31 18:36:18', '03 02 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '5,7,9', '3,2,7', '', '', 0),
(68, 'sudhir', '', NULL, NULL, NULL, 0, 'su@gmail.com', '5784949945', 'qwerty', 0, 0, '2017-05-31 18:36:18', '20 Apr 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(115, 'hdkd', '', NULL, NULL, NULL, 0, 'hdhdujd@hdjd.com', '64348449956556', 'geheuehd', 0, 0, '2017-06-02 20:51:47', '09 May, 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '5,7,9', '3,2,7', '', '', 0),
(96, 'test', '', NULL, NULL, NULL, 0, 'test@gmail.co', '6434846698', '123456', 0, 0, '2017-06-02 20:51:47', '26 May 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(98, 'jitenm', '', NULL, NULL, NULL, 0, 'jkom@gmail.com', '6464338493', '123456', 0, 0, '2017-06-02 20:51:47', '05 May, 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(110, 'hsjs', '', NULL, NULL, NULL, 0, 'hshsh@hdhd.com', '64648495668', 'hdjdkdkdk', 0, 0, '2017-06-02 20:51:47', '18 May, 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(74, 'pragati sarin', '', NULL, NULL, NULL, 0, 'pragatisarin56@yahoo', '7028050990', 'qwertyuiop', 0, 0, '2017-05-31 18:36:18', '05 Jun 1992', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(10, 'abc', NULL, NULL, NULL, NULL, 0, 'canavb@gmail.com', '7897897897', 'qwerty', 0, 0, '2017-05-31 18:36:18', '15-3-1991', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '5,7,9', '3,2,7', '', '', 0),
(19, 'jiten', NULL, NULL, NULL, NULL, 0, 'jk@gmail.com', '789894565414', '123456mm', 0, 0, '2017-05-31 18:36:18', '08 Jan 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '5,7,9', '3,2,7', '', '', 0),
(18, 'jiten', NULL, NULL, NULL, NULL, 0, 'jiten@gmail.com', '78989456546', '123456', 0, 0, '2017-05-31 18:36:18', '16 Jan 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '5,7,9', '3,2,7', '', '', 0),
(69, 'sudhir', '', NULL, NULL, NULL, 0, 'sudhir@gmail.com', '79646464664', 'qwerty', 0, 0, '2017-05-31 18:36:18', '11 Apr 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(67, 'Panshul', 'Dua', NULL, NULL, NULL, 0, 'bricktohome27@gmail.', '8146469866', 'qwerty', 0, 0, '2017-05-31 18:36:18', '05 Jun 1992', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(64, 'abc', '', NULL, NULL, NULL, 0, 'cabavba@gmail.com', '8285065889', 'qwerty', 0, 0, '2017-06-06 12:59:08', '27 Dec 1992', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(88, 'jitend', '', NULL, NULL, NULL, 0, 'jite@gmail.co', '84546948688', '123456', 0, 0, '2017-06-02 20:51:47', '19 May 1997', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(111, 'hdhhd', '', NULL, NULL, NULL, 0, 'hdhdh@hdh.com', '84664684946', 'hssushgsj', 0, 0, '2017-06-02 20:51:47', '10 May, 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(59, 'swati', '', NULL, NULL, NULL, 0, 'swatisikka05@gmail.c', '8527325555', 'hrutvi', 0, 0, '2017-05-31 18:36:18', '22 Jan 1988', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(60, 'swati', '', NULL, NULL, NULL, 0, 'swatsikka05@gmail.co', '8527325556', 'hrutvi', 0, 0, '2017-05-31 18:36:18', '22 Jan 1988', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(91, 'Vasudev', '', NULL, NULL, NULL, 0, 'ecevasu90@gmail.com', '8571038062', 'qwertyuiop', 0, 0, '2017-06-02 20:51:47', '13 May 1990', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(85, 'vasudev', '', NULL, NULL, NULL, 0, 'info@mysolutions4u.i', '8571038063', 'qwertyuiop', 0, 0, '2017-06-02 20:51:47', '01 Jan 1990', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 1, '', 'address', 'sales', 'email', 0, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(118, 'Vasudev', '', NULL, NULL, NULL, 0, 'ecevasu90@gmail.co.i', '8571038064', 'qwertyuiop', 0, 0, '2017-06-02 20:51:47', '09 Jan, 1990', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '', '', '', '', 0),
(62, 'shivam', '', NULL, NULL, NULL, 0, 'shivamkkreja123@gmai', '8765250800', 'qwerty', 0, 0, '2017-05-31 18:36:18', '02 Sep 1995', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(61, 'shivam', '', NULL, NULL, NULL, 0, 'shivamkukreja123@gma', '8765250809', 'qwerty', 0, 0, '2017-05-31 18:36:18', '02 Sep 1995', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(114, 'jishsk', '', NULL, NULL, NULL, 0, 'hs@bsnd.com', '94646484643', 'wtwteue', 0, 0, '2017-06-02 20:51:47', '15 May, 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(107, 'jieh', '', NULL, NULL, NULL, 0, 'ns@ndj.com', '9464846348', 'wteyeuu', 0, 0, '2017-06-02 20:51:47', '05 May, 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(108, 'jdjdh', '', NULL, NULL, NULL, 0, 'hehe@hee.com', '94649446665', 'heheguu', 0, 0, '2017-06-02 20:51:47', '18 May, 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(102, 'jsjsj', '', NULL, NULL, NULL, 0, 'hed@hd.com', '9464946469', 'hddjdjh', 0, 0, '2017-06-02 20:51:47', '19 May, 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(109, 'hshsh', '', NULL, NULL, NULL, 0, 'shshs@hdj.com', '94673787676', 'hdddkdbdk', 0, 0, '2017-06-02 20:51:47', '25 May, 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(104, 'nitenn', '', NULL, NULL, NULL, 0, 'ndjdn@hdn.com', '94674496456', 'eyeudgdi', 0, 0, '2017-06-02 20:51:47', '19 May, 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(103, 'hshjd', '', NULL, NULL, NULL, 0, 'hdjd@hdjd.com', '9467876769', 'hdhdjdk', 0, 0, '2017-06-02 20:51:47', '19 May, 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(84, 'aarti', '', NULL, NULL, NULL, 0, 'aarti@mysol.com', '9535428766', '123456', 0, 0, '2017-06-02 20:51:47', '06 Apr 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 1, '', 'address', 'sales', 'email', 0, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(105, 'hssn', '', NULL, NULL, NULL, 0, 'hdhd@hdn.com', '9567976985', 'gshsheht', 0, 0, '2017-06-02 20:51:47', '03 May, 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(93, 'vasudev', '', NULL, NULL, NULL, 0, 'yo@yoyo.com', '9632587410', 'qwerty', 0, 0, '2017-06-02 20:51:47', '17 May 1994', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(127, 'deepak kumar', 'Nimawat', NULL, NULL, NULL, 0, 'dipak.yts@gmail.com', '9643604211', '', 1, 1, '2017-07-08 10:33:52', '', '0000-00-00 00:00:00', '1', NULL, NULL, 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '', '', '', '', 0),
(77, 'kiran', '', NULL, NULL, NULL, 0, 'kiransikka30@gmail.c', '9717000000', 'accessdenied', 0, 0, '2017-05-31 18:36:18', '30 Sep 1960', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, 'null', NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(12, 'kiran sikka', NULL, NULL, NULL, NULL, 0, 'kiransikka30@gmail.c', '9717455155', 'qwerty', 0, 0, '2017-05-31 18:36:18', '16-3-1984', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '5,7,9', '3,2,7', '', '', 0),
(75, 'panshul dua', '', NULL, NULL, NULL, 0, 'rentlersindia@gmail.', '9718225555', 'accessdenied', 0, 0, '2017-05-31 18:36:18', '27 Dec 1992', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(86, 'sudhir', '', NULL, NULL, NULL, 0, 'sudh12345@gmail.com', '9718858539', 'qwerty', 0, 0, '2017-06-02 20:51:47', '01 May 1996', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 1, '', 'address', 'sales', 'email', 0, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(14, 'abc', NULL, NULL, NULL, NULL, 0, 'abc@gmail.com', '9718858541', 'qwerty', 0, 0, '2017-05-31 18:36:18', '16 02 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '5,7,9', '3,2,7', '', '', 0),
(15, 'abc', NULL, NULL, NULL, NULL, 0, 'abc1@gmail.com', '9718858542', 'qwerty', 0, 0, '2017-05-31 18:36:18', '16 January 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '5,7,9', '3,2,7', '', '', 0),
(63, 'sudhir', '', NULL, NULL, NULL, 0, 'sudhir12@gmail.com', '9718858543', '123456', 0, 0, '2017-05-31 18:36:18', '28 Mar 2001', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(23, 'abcd', NULL, NULL, NULL, NULL, 0, 'abcd1@gmail.com', '9718858545', 'qwerty', 0, 0, '2017-05-31 18:36:18', '18 Mar 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '5,7,9', '3,2,7', '', '', 0),
(70, 'sudhir', '', NULL, NULL, NULL, 0, 'sudhir1234@gmail.com', '9718858548', 'qwerty', 0, 0, '2017-05-31 18:36:18', '11 Apr 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(87, 'abc', '', NULL, NULL, NULL, 0, 'abcd@gmaio.com', '9718858550', 'qwerty', 0, 0, '2017-06-02 20:51:47', '25 May 1996', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 1, '', 'address', 'sales', 'email', 0, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(122, 'sudhir', '', NULL, NULL, NULL, 0, 'sudhirqwerty@gmail.c', '9718858558', 'qwerty', 0, 0, '2017-06-07 23:35:22', '08 Jun, 2017', '0000-00-00 00:00:00', '0', '', NULL, 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '', '', '', '', 0),
(117, 'sudhir kumar', '', NULL, NULL, NULL, 0, 'sudhirkumar689@gmail', '9718858585', 'qwerty', 0, 0, '2017-06-02 20:51:47', '06 Aug, 1992', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', '', 0),
(21, 'panshul', NULL, NULL, NULL, NULL, 0, 'abcd@gmail.com', '9718899951', 'technicalerror', 0, 0, '2017-05-31 18:36:18', '25 Mar 1970', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '5,7,9', '3,2,7', '', '', 0),
(66, 'sudhir', 'kumar', NULL, NULL, NULL, 0, 'sudhir123@gmail.com', '97812487997', 'qwerty', 0, 0, '2017-05-31 18:36:18', '01 Apr 1978', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 1, '', 'address', 'sales', 'email', 0, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(50, 'dfbgf', 'dfgdfg', NULL, NULL, NULL, 0, 'dsd3fd1s@hjih.ffh', '9824516', '123456', 0, 0, '2017-05-31 18:36:18', 'vcb', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(45, 'dfbgf', '', NULL, NULL, NULL, 0, 'dsd3fds@hjih.ffh', '982456', '123456', 0, 0, '2017-05-31 18:36:18', 'vcb', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(29, 'dfbgf', '', NULL, NULL, NULL, 0, 'dsdfds@hjih.fkgew', '9824564323', '123456', 0, 0, '2017-05-31 18:36:18', 'vcb', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(34, 'dfbgf', '', NULL, NULL, NULL, 0, 'dsd3fds@hjih.fkgew', '982456436623', '123456', 0, 0, '2017-05-31 18:36:18', 'vcb', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(65, 'dipak', 'kumar', NULL, NULL, NULL, 0, 'raj.dpk@gmail.com', '9874563210', '123456', 0, 0, '2017-05-31 18:36:18', '33/03/2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(26, 'dhcg', NULL, NULL, NULL, NULL, 0, 'shchfjnb@gmail.com', '9875888555', 'dgjcjb', 0, 0, '2017-05-31 18:36:18', '20 Mar 1990', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '5,7,9', '3,2,7', '', '', 0),
(55, 'asdfg', '', NULL, NULL, NULL, 0, 'qwetuvb@gmail.com', '9889898335', 'qqqaaasdrt', 0, 0, '2017-05-31 18:36:18', '23 Mar 1972', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(57, 'asdfg', '', NULL, NULL, NULL, 0, 'qwetupb@gmail.com', '9889898390', 'qqqaaasdrt', 0, 0, '2017-05-31 18:36:18', '23 Mar 1923', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(56, 'asdfg', '', NULL, NULL, NULL, 0, 'qwetubb@gmail.com', '9889898399', 'qqqaaasdrt', 0, 0, '2017-06-02 20:51:47', '19 Mar 2017', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(11, 'ashima', NULL, NULL, NULL, NULL, 0, 'ashima.honestexpress', '9891063997', 'qwerty', 0, 0, '2017-06-02 20:51:47', '16-3-1992', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '5,7,9', '3,2,7', '', '', 0),
(1, 'Shashank', NULL, NULL, NULL, NULL, 0, 'abe@gmail.com', '989765767', 'hello', 0, 0, '2017-06-21 18:35:04', '24-02-2017', '0000-00-00 00:00:00', '1', '_1498026904.', 'WIN_20170408_09_22_38_Pro_1498026904.jpg', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '5,7,9', '3,2,7', '', '', 0),
(28, 'Panshul ', NULL, NULL, NULL, NULL, 0, 'capriconpanshul@gmai', '9958022155', 'qwerty', 0, 0, '2017-06-02 20:51:47', '27 Dec 1992', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', '', '5,7,9', '3,2,7', '', '', 0),
(82, 'panshul01', '', NULL, NULL, NULL, 0, '01@gmail.com', '9999999901', 'asdfghjkl', 0, 0, '2017-06-02 20:51:47', '19 Apr 1992', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 1, '', 'address', 'sales', 'email', 0, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(89, 'abc', '', NULL, NULL, NULL, 0, 'abcdef@gmail.com', '9999999990', 'zxcvbnm', 0, 0, '2017-06-02 20:51:47', '07 May 2003', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(92, 'Panshul', '', NULL, NULL, NULL, 0, 'bestoffersstop@gmail', '99999999901', 'zxcvbnm', 0, 0, '2017-06-02 20:51:47', '14 May 1999', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 0, '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '5,7,9', '3,2,7', '', '', 0),
(121, 'ABC', '', NULL, NULL, NULL, 0, 'abc123@gmail.com', '9999999991', 'zxcvbnm', 0, 0, '2017-05-31 22:55:23', '08 Jun, 2000', '0000-00-00 00:00:00', '1', '', 'property_1496890980.png', 1, 1, '', 'address', 'sales', 'email', 0, '', '', '', 0, '', '', '', '', '', '', '', 0),
(81, 'abcdefghi', 'asgjkj', NULL, NULL, NULL, 0, 'abcdefghi@gmail.com', '9999999999', 'zxcvbnm', 0, 0, '2017-06-08 11:39:07', '18 Apr 1994', '0000-00-00 00:00:00', '1', 'bt_1495606356.jpg', 'property_1495865692.png', 1, 1, '', 'address', 'sales', 'email', 0, '', '', '', 0, '', '', '43ec517d68b6edd3015b3edc9a11367b', '5,7,9', '3,2,7', '', '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
