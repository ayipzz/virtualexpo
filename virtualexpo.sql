-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 22, 2016 at 09:38 
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `virtualexpo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `a_id` int(11) NOT NULL,
  `a_email` varchar(50) NOT NULL,
  `a_name` varchar(50) NOT NULL,
  `a_password` text NOT NULL,
  `a_role` text NOT NULL,
  `a_block` enum('Y','N') NOT NULL DEFAULT 'N',
  `a_session` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`a_id`, `a_email`, `a_name`, `a_password`, `a_role`, `a_block`, `a_session`) VALUES
(1, 'amydin17@gmail.com', 'Amydin Syahira', 'd9fc1cd5e6008b07fi32f3ddd180a82e4048dnmc89badmin', 'Administrator', 'N', 'kuebqud20l39n4upc2djc335c7');

-- --------------------------------------------------------

--
-- Table structure for table `admins_master`
--

CREATE TABLE `admins_master` (
  `am_id` int(11) NOT NULL,
  `am_key` varchar(20) NOT NULL,
  `am_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins_master`
--

INSERT INTO `admins_master` (`am_id`, `am_key`, `am_value`) VALUES
(1, 'a_role', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `c_id` int(11) NOT NULL,
  `c_email` varchar(100) NOT NULL,
  `c_password` text NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_address` text NOT NULL,
  `c_telp` varchar(20) NOT NULL,
  `c_logo` text,
  `c_block` enum('Y','N') NOT NULL DEFAULT 'N',
  `c_session` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`c_id`, `c_email`, `c_password`, `c_name`, `c_address`, `c_telp`, `c_logo`, `c_block`, `c_session`) VALUES
(1, 'canon@yahoo.com', 'a9ed5986b6335d91ao5b6b8f1c8b7bfd4a82nn677ac', 'Canon', 'Jl. New York City', '089475643376', 'uploads/company_logo/Canon_Logo_350_tcm14-959888.jpg', 'N', NULL),
(3, 'bangke.kucing@yahoo.co.id', 'a713a642de86444bes26c3403874n14689ae0um3b6asg', 'Arif', 'Jl. Jalan', '089745463424', 'uploads/company_logo/moslemdaily.png', 'N', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_doc`
--

CREATE TABLE `company_doc` (
  `cd_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `e_id` int(11) NOT NULL,
  `cd_doc` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_doc`
--

INSERT INTO `company_doc` (`cd_id`, `c_id`, `e_id`, `cd_doc`) VALUES
(7, 1, 1, 'uploads/company_doc/Onepunch-Man_Chapter_107_-_Page_1.pdf'),
(10, 3, 1, 'uploads/company_doc/16sample-angularjs.pdf'),
(11, 3, 1, 'uploads/company_doc/smashing-ebook-19-mastering-css3.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `e_id` int(11) NOT NULL,
  `e_created` datetime NOT NULL,
  `e_modified` datetime NOT NULL,
  `e_startdatetime` datetime NOT NULL,
  `e_enddatetime` datetime NOT NULL,
  `e_name` varchar(50) NOT NULL,
  `e_location` text NOT NULL,
  `e_map` text NOT NULL,
  `e_description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`e_id`, `e_created`, `e_modified`, `e_startdatetime`, `e_enddatetime`, `e_name`, `e_location`, `e_map`, `e_description`) VALUES
(1, '2016-10-19 00:00:00', '2016-10-19 00:00:00', '2016-10-19 04:03:00', '2016-10-21 06:05:00', 'Audition indonesian Idol', 'JEC, Jogja Expo Center', '-7.7993373,110.4022917', 'Event ini diadakan 1 tahun sekali'),
(2, '2016-10-19 00:00:00', '2016-10-19 00:00:00', '2016-10-20 06:00:00', '2016-10-21 07:19:00', 'Exposed Fashion', 'JEC, Jogja Expo Center', '-7.7993373,110.4022917', 'Event fashion terbesar di jogja'),
(3, '2016-10-19 00:00:00', '2016-10-19 00:00:00', '2016-10-22 06:00:00', '2016-10-25 07:19:00', 'Go Batik Indonesia', 'Pogung Hall 1st floor', '-7.7695219,110.3438021', 'Memajukan batik indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `events_master`
--

CREATE TABLE `events_master` (
  `em_id` int(11) NOT NULL,
  `em_key` varchar(20) NOT NULL,
  `em_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events_master`
--

INSERT INTO `events_master` (`em_id`, `em_key`, `em_value`) VALUES
(1, 'cat_music', 'Music'),
(2, 'cat_fashion', 'Fashion');

-- --------------------------------------------------------

--
-- Table structure for table `events_relationship`
--

CREATE TABLE `events_relationship` (
  `er_id` bigint(20) NOT NULL,
  `e_id` int(11) NOT NULL,
  `em_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events_relationship`
--

INSERT INTO `events_relationship` (`er_id`, `e_id`, `em_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `events_resv`
--

CREATE TABLE `events_resv` (
  `erv_id` int(11) NOT NULL,
  `erv_created` datetime NOT NULL,
  `erv_modified` datetime NOT NULL,
  `e_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `stand_id` varchar(30) NOT NULL,
  `stand_price` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events_resv`
--

INSERT INTO `events_resv` (`erv_id`, `erv_created`, `erv_modified`, `e_id`, `c_id`, `stand_id`, `stand_price`) VALUES
(1, '2016-10-20 17:30:50', '2016-10-20 17:30:50', 1, 1, 'svg_7', 300000),
(4, '2016-10-22 11:52:21', '2016-10-22 11:52:21', 1, 3, 'svg_30', 300000),
(5, '2016-10-22 14:03:20', '2016-10-22 14:03:20', 1, 3, 'svg_15', 300000);

-- --------------------------------------------------------

--
-- Table structure for table `events_stands`
--

CREATE TABLE `events_stands` (
  `es_id` int(11) NOT NULL,
  `e_id` int(11) NOT NULL,
  `es_stands` text NOT NULL,
  `es_priceinfo` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events_stands`
--

INSERT INTO `events_stands` (`es_id`, `e_id`, `es_stands`, `es_priceinfo`) VALUES
(1, 1, 'uploads/stands_map/map_1.svg', '300000');

-- --------------------------------------------------------

--
-- Table structure for table `events_standsdetail`
--

CREATE TABLE `events_standsdetail` (
  `esd_id` bigint(20) NOT NULL,
  `es_id` int(11) NOT NULL,
  `stand_id` varchar(30) NOT NULL,
  `esd_image` text NOT NULL,
  `esd_price` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `admins_master`
--
ALTER TABLE `admins_master`
  ADD PRIMARY KEY (`am_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `company_doc`
--
ALTER TABLE `company_doc`
  ADD PRIMARY KEY (`cd_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `events_master`
--
ALTER TABLE `events_master`
  ADD PRIMARY KEY (`em_id`);

--
-- Indexes for table `events_relationship`
--
ALTER TABLE `events_relationship`
  ADD PRIMARY KEY (`er_id`),
  ADD KEY `e_id` (`e_id`),
  ADD KEY `em_id` (`em_id`);

--
-- Indexes for table `events_resv`
--
ALTER TABLE `events_resv`
  ADD PRIMARY KEY (`erv_id`);

--
-- Indexes for table `events_stands`
--
ALTER TABLE `events_stands`
  ADD PRIMARY KEY (`es_id`);

--
-- Indexes for table `events_standsdetail`
--
ALTER TABLE `events_standsdetail`
  ADD PRIMARY KEY (`esd_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `admins_master`
--
ALTER TABLE `admins_master`
  MODIFY `am_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `company_doc`
--
ALTER TABLE `company_doc`
  MODIFY `cd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `events_master`
--
ALTER TABLE `events_master`
  MODIFY `em_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `events_relationship`
--
ALTER TABLE `events_relationship`
  MODIFY `er_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `events_resv`
--
ALTER TABLE `events_resv`
  MODIFY `erv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `events_stands`
--
ALTER TABLE `events_stands`
  MODIFY `es_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `events_standsdetail`
--
ALTER TABLE `events_standsdetail`
  MODIFY `esd_id` bigint(20) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
