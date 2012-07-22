-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 22, 2012 at 06:21 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `custormer`
--

CREATE TABLE IF NOT EXISTS `custormer` (
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'PK',
  `cus_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `province` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `postcode` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `address_2` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `province_2` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `postcode_2` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `validate` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'F',
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `custormer`
--

INSERT INTO `custormer` (`email`, `cus_name`, `lastname`, `phone`, `password`, `address`, `province`, `postcode`, `address_2`, `province_2`, `postcode_2`, `validate`) VALUES
('darkman@hotmail.com', 'mumoo', 'lastname', '084-973-17', '12345', 'ที่อยู่', 'A', '10160', 'fds', 'C', '12345', 'T'),
('darkman15710@hotmail.com', 'mumoo2', 'han', '028-391-92', '15710804', 'The cat was playing in the garden.\r\n', 'C', '12334', 'The cat was playing in the garden.\r\n', 'C', '12321', 'F'),
('darkmanmumoonaja@gmail.com', 'mockup', 'mockup', 'mockup', '15710804', 'mockup', 'mockup', 'mocku', 'mockup', 'mockup', 'mocku', 'T'),
('def', 'mockup', 'mockup', 'mockup', 'mockup', 'mockup', 'mockup', 'mocku', 'mockup', 'mockup', 'mocku', 'F'),
('huns@hotmail.com', 'dsf', 'dsaf', '348-237-42', '12345', 'The cat was playing in the garden.\r\n', 'C', '1234', 'The cat was playing in the garden.\r\n', 'C', '1234', 'T');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `empno` int(10) NOT NULL AUTO_INCREMENT,
  `emp_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`empno`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`empno`, `emp_name`, `lastname`, `password`, `email`, `phone`, `position`) VALUES
(1, 'bla1', 'blabla', 'Amm', 'bla', '0000', 'des'),
(2, 'bla2', 'blabla', 'nan', 'bla', '0000', 'des'),
(3, 'bla3', 'blabla', 'mung', 'bla', '0000', 'des'),
(4, 'mumoo', 'blabla', 'mumoo', 'bla', '0000', 'Boss');

-- --------------------------------------------------------

--
-- Table structure for table `option_type`
--

CREATE TABLE IF NOT EXISTS `option_type` (
  `option_type_no` int(11) NOT NULL AUTO_INCREMENT,
  `type_no` int(11) NOT NULL,
  `optionno` int(11) NOT NULL,
  PRIMARY KEY (`option_type_no`),
  KEY `type` (`type_no`),
  KEY `option` (`optionno`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `option_type`
--

INSERT INTO `option_type` (`option_type_no`, `type_no`, `optionno`) VALUES
(1, 7, 1),
(2, 8, 2),
(3, 9, 1),
(4, 10, 0),
(5, 11, 0),
(6, 12, 0),
(7, 13, 0),
(8, 14, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ord`
--

CREATE TABLE IF NOT EXISTS `ord` (
  `ord_status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `total_price` double NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `province` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postcode` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `orderdate` date NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'FK',
  `paymethod` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `sendmethod` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `orderno` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK',
  PRIMARY KEY (`orderno`),
  KEY `custormer_email` (`email`),
  KEY `Ord_ordstatus` (`ord_status`),
  KEY `Ord_ordpay` (`paymethod`),
  KEY `Ord_ordsend` (`sendmethod`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ord`
--

INSERT INTO `ord` (`ord_status`, `total_price`, `address`, `province`, `postcode`, `orderdate`, `email`, `paymethod`, `sendmethod`, `orderno`) VALUES
('30', 6000, 'mockup', 'mockup', 'mocku', '2012-07-19', 'darkmanmumoonaja@gmail.com', 'pay 1 time', 'A', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderline`
--

CREATE TABLE IF NOT EXISTS `orderline` (
  `price` double NOT NULL,
  `qty` int(11) NOT NULL,
  `orderno` int(11) NOT NULL COMMENT 'FK',
  `paperno` int(11) NOT NULL COMMENT 'FK',
  `tempno` int(11) NOT NULL COMMENT 'FK',
  `optionno` int(11) DEFAULT NULL COMMENT 'FK',
  `ordlineno` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `filepath` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ordlineno`),
  KEY `paper_FK` (`paperno`),
  KEY `template_FK` (`tempno`),
  KEY `option_FK` (`optionno`),
  KEY `ord_FK` (`orderno`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `orderline`
--

INSERT INTO `orderline` (`price`, `qty`, `orderno`, `paperno`, `tempno`, `optionno`, `ordlineno`, `filepath`) VALUES
(6000, 100, 1, 18, 12, 0, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `ordoption`
--

CREATE TABLE IF NOT EXISTS `ordoption` (
  `option_description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `option_price` double NOT NULL,
  `optionno` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK',
  PRIMARY KEY (`optionno`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ordoption`
--

INSERT INTO `ordoption` (`option_description`, `option_price`, `optionno`) VALUES
('no option', 0, 0),
('option2', 100, 1),
('option1', 10, 2),
('option3', 60, 3);

-- --------------------------------------------------------

--
-- Table structure for table `ordpay`
--

CREATE TABLE IF NOT EXISTS `ordpay` (
  `paymethod` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pay_description` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`paymethod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ordpay`
--

INSERT INTO `ordpay` (`paymethod`, `pay_description`) VALUES
('pay 1 time', 'pay 1 time'),
('pay 2 time', 'pay 2 time');

-- --------------------------------------------------------

--
-- Table structure for table `ordsend`
--

CREATE TABLE IF NOT EXISTS `ordsend` (
  `sendmethod` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `send_description` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`sendmethod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ordsend`
--

INSERT INTO `ordsend` (`sendmethod`, `send_description`) VALUES
('A', 'A'),
('B', 'B'),
('C', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `ordstatus`
--

CREATE TABLE IF NOT EXISTS `ordstatus` (
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status_description` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ordstatus`
--

INSERT INTO `ordstatus` (`status`, `status_description`) VALUES
('10', 'waitupload'),
('20', 'waitforvalidate'),
('30', 'waitforpay'),
('40', 'reject'),
('50', 'ontransfer'),
('60', 'onproduct'),
('70', 'complete');

-- --------------------------------------------------------

--
-- Table structure for table `paper`
--

CREATE TABLE IF NOT EXISTS `paper` (
  `paperno` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `paper_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `gram` int(11) NOT NULL,
  PRIMARY KEY (`paperno`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `paper`
--

INSERT INTO `paper` (`paperno`, `paper_name`, `gram`) VALUES
(1, 'อาร์ต', 160),
(3, 'ปอนด์', 160),
(8, 'อาร์ต', 130),
(11, 'ปอนด์', 80),
(12, 'อาร์ต', 100),
(14, 'ปอนด์', 100),
(16, 'อาร์ต', 250),
(18, 'อาร์ต', 210),
(21, 'อาร์ต', 300);

-- --------------------------------------------------------

--
-- Table structure for table `paper_type`
--

CREATE TABLE IF NOT EXISTS `paper_type` (
  `paper_type` int(11) NOT NULL AUTO_INCREMENT,
  `paperno` int(11) NOT NULL,
  `type_no` int(11) NOT NULL,
  PRIMARY KEY (`paper_type`),
  KEY `paper` (`paperno`),
  KEY `template` (`type_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Dumping data for table `paper_type`
--

INSERT INTO `paper_type` (`paper_type`, `paperno`, `type_no`) VALUES
(2, 1, 12),
(3, 8, 12),
(12, 18, 12),
(14, 12, 13),
(15, 14, 13),
(16, 1, 11),
(17, 8, 11),
(18, 16, 10),
(19, 21, 10),
(20, 11, 9),
(21, 18, 8),
(22, 16, 7),
(23, 16, 14),
(24, 11, 13),
(25, 16, 11),
(26, 18, 11),
(27, 16, 8),
(28, 18, 7),
(29, 21, 7),
(30, 18, 14),
(31, 21, 14);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `payno` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `period` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชำระครั้งที่1,ชำระครั้งที่2,ชำระครั้งเดียว',
  `amount` int(11) NOT NULL,
  `paymentdate` date NOT NULL,
  `orderno` int(11) NOT NULL COMMENT 'FK',
  PRIMARY KEY (`payno`),
  KEY `Relation_3` (`orderno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE IF NOT EXISTS `position` (
  `position` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pos_description` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`position`, `pos_description`) VALUES
('Boss', 'Boss'),
('des', 'designer');

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE IF NOT EXISTS `price` (
  `price_no` int(11) NOT NULL AUTO_INCREMENT,
  `paperno` int(11) NOT NULL,
  `tempno` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`price_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=85 ;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`price_no`, `paperno`, `tempno`, `qty`, `price`) VALUES
(1, 12, 13, 100, 6000),
(2, 1, 4, 100, 5800),
(3, 1, 4, 200, 6800),
(4, 1, 4, 300, 7800),
(6, 1, 4, 500, 9300),
(7, 1, 12, 200, 6300),
(8, 1, 12, 500, 8300),
(9, 11, 6, 200, 8000),
(10, 11, 6, 400, 10000),
(11, 11, 6, 500, 11000),
(12, 11, 16, 200, 9000),
(13, 11, 16, 500, 12000),
(14, 12, 7, 300, 5400),
(16, 12, 7, 500, 6000),
(17, 12, 18, 1000, 7500),
(18, 16, 8, 300, 4800),
(19, 18, 10, 200, 32000),
(20, 18, 10, 300, 36000),
(21, 18, 10, 500, 40000),
(22, 18, 4, 100, 6500),
(23, 18, 4, 300, 8500),
(24, 18, 12, 200, 7000),
(25, 18, 12, 500, 9500),
(26, 16, 11, 300, 13000),
(27, 16, 11, 500, 16000),
(28, 21, 11, 300, 14000),
(29, 21, 11, 500, 18000),
(30, 8, 4, 100, 5800),
(31, 8, 4, 200, 6800),
(32, 8, 4, 300, 7800),
(33, 8, 4, 300, 7800),
(34, 8, 4, 500, 9300),
(35, 1, 12, 100, 5800),
(36, 8, 12, 100, 5800),
(37, 8, 12, 200, 6300),
(38, 1, 12, 300, 6800),
(41, 8, 12, 300, 6800),
(43, 1, 12, 200, 6300),
(44, 8, 12, 500, 8300),
(45, 1, 4, 200, 5800),
(46, 8, 4, 200, 5800),
(47, 1, 4, 400, 6300),
(48, 8, 4, 400, 6300),
(49, 1, 4, 600, 6800),
(50, 8, 4, 600, 6800),
(51, 1, 5, 300, 5800),
(52, 8, 5, 300, 5800),
(53, 1, 5, 500, 6800),
(54, 8, 5, 500, 6800),
(55, 1, 5, 1000, 7800),
(56, 8, 5, 1000, 7800),
(57, 11, 16, 400, 11000),
(58, 14, 7, 300, 5400),
(59, 14, 7, 500, 6000),
(60, 12, 7, 1000, 8000),
(61, 14, 7, 1000, 8000),
(62, 12, 18, 300, 5000),
(63, 14, 18, 300, 5000),
(64, 12, 18, 500, 6000),
(65, 14, 18, 500, 6000),
(66, 14, 18, 1000, 7500),
(67, 16, 8, 500, 6000),
(68, 16, 9, 300, 5000),
(69, 16, 9, 500, 6300),
(70, 18, 4, 200, 7500),
(71, 18, 4, 500, 10000),
(72, 18, 12, 100, 6000),
(73, 18, 12, 300, 8000),
(74, 18, 12, 200, 6000),
(75, 18, 12, 400, 7000),
(76, 18, 12, 600, 8000),
(77, 1, 20, 300, 5800),
(78, 8, 20, 300, 5800),
(79, 1, 20, 500, 6800),
(80, 8, 20, 500, 6800),
(81, 1, 20, 1000, 7800),
(82, 8, 20, 1000, 7800),
(83, 16, 11, 200, 10000),
(84, 21, 11, 200, 12000);

-- --------------------------------------------------------

--
-- Table structure for table `process`
--

CREATE TABLE IF NOT EXISTS `process` (
  `processno` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `description` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `empno` int(20) NOT NULL COMMENT 'FK,PK',
  `workno` int(11) NOT NULL COMMENT 'FK,PK',
  PRIMARY KEY (`processno`),
  KEY `Relation_17` (`empno`),
  KEY `Relation_19` (`workno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE IF NOT EXISTS `template` (
  `tempno` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `type_no` int(11) NOT NULL,
  `size` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tmp_name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`tempno`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`tempno`, `type_no`, `size`, `url`, `tmp_name`) VALUES
(4, 12, 'A2', '', 'โปสเตอร์A2'),
(5, 11, 'A4', '', 'โบชัวร์ 2 หน้า แผ่นพับ'),
(6, 9, 'A5', '', 'สมุดโน๊ต32หน้า'),
(7, 13, 'A4', '', 'ใบปลิว1หน้า'),
(8, 14, '2.5*7', '', 'bookmark2.5*7'),
(9, 7, '5*7', '', 'การ์ดเชิญ5*7'),
(10, 8, 'A5', '', 'ปฏิทินตั้งโต๊ะA5'),
(11, 10, 'A4', '', 'แฟ้มA4'),
(12, 12, 'A3', '', 'โปสเตอร์A3'),
(14, 12, 'A4', '', 'โปสเตอร์A4'),
(16, 9, 'A4', '', 'สมุดโน๊ต32หน้า'),
(18, 13, 'A5', '', 'ใบปลิว1หน้า'),
(20, 11, 'A5', '', 'โบชัวร์ 2 หน้า แผ่นพับ');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `type_no` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `type_description` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `pic_url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`type_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_no`, `type`, `type_description`, `pic_url`) VALUES
(7, 'การ์ดเชิญ', 'การ์ดเชิญ', 'asset/Sys_img/type_img/EE.png'),
(8, 'ปฏิทินตั้งโต๊ะ', 'ปฏิทินตั้งโต๊ะ', 'asset/Sys_img/type_img/EE.png'),
(9, 'สมุดโน๊ต', 'สมุดโน๊ต', 'asset/Sys_img/type_img/EE.png'),
(10, 'แฟ้ม', 'แฟ้ม', 'asset/Sys_img/type_img/EE.png'),
(11, 'โบชัวร์', 'โบชัวร์', 'asset/Sys_img/type_img/EE.png'),
(12, 'โปสเตอร์', 'โปสเตอร์', 'asset/Sys_img/type_img/EE.png'),
(13, 'ใบปลิว', 'ใบปลิว', 'asset/Sys_img/type_img/EE.png'),
(14, 'Bookmark', 'Bookmark', 'asset/Sys_img/type_img/EE.png');

-- --------------------------------------------------------

--
-- Table structure for table `work`
--

CREATE TABLE IF NOT EXISTS `work` (
  `workno` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date DEFAULT NULL,
  `empno` int(20) NOT NULL COMMENT 'FK',
  `ordlineno` int(11) DEFAULT NULL COMMENT 'FK',
  `work_description` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`workno`),
  KEY `Relation_16` (`empno`),
  KEY `work_orderline_FK` (`ordlineno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `option_type`
--
ALTER TABLE `option_type`
  ADD CONSTRAINT `option` FOREIGN KEY (`optionno`) REFERENCES `ordoption` (`optionno`);

--
-- Constraints for table `ord`
--
ALTER TABLE `ord`
  ADD CONSTRAINT `Order_Custormer` FOREIGN KEY (`email`) REFERENCES `custormer` (`email`),
  ADD CONSTRAINT `Ord_ordpay` FOREIGN KEY (`paymethod`) REFERENCES `ordpay` (`paymethod`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Ord_ordsend` FOREIGN KEY (`sendmethod`) REFERENCES `ordsend` (`sendmethod`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Ord_ordstatus` FOREIGN KEY (`ord_status`) REFERENCES `ordstatus` (`status`) ON UPDATE CASCADE;

--
-- Constraints for table `orderline`
--
ALTER TABLE `orderline`
  ADD CONSTRAINT `option_FK` FOREIGN KEY (`optionno`) REFERENCES `ordoption` (`optionno`),
  ADD CONSTRAINT `ord_FK` FOREIGN KEY (`orderno`) REFERENCES `ord` (`orderno`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`orderno`) REFERENCES `ord` (`orderno`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
