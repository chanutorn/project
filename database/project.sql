-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2024 at 09:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brand_id` int(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'รหัสแบรนด์',
  `brand_name` varchar(100) NOT NULL COMMENT 'ชื่อแบรนด์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brand_id`, `brand_name`) VALUES
(01, 'PUMA'),
(02, 'LACOSTE'),
(03, 'ADIDAS'),
(04, 'CROCS'),
(05, 'NIKE'),
(06, 'FILA'),
(07, 'NEW BALANCE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `c_id` int(11) NOT NULL COMMENT 'รหัสตะกร้า',
  `m_id` int(11) NOT NULL COMMENT 'รหัสลูกค้า',
  `p_id` int(11) NOT NULL COMMENT 'รหัสสินค้า',
  `qty` int(11) NOT NULL COMMENT 'จำนวน',
  `total` int(11) NOT NULL COMMENT 'ราคา'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`c_id`, `m_id`, `p_id`, `qty`, `total`) VALUES
(98, 3, 3, 1, 7500),
(123, 28, 14, 1, 2080),
(389, 2, 15, 1, 5590);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_checkcoupon`
--

CREATE TABLE `tbl_checkcoupon` (
  `id_checkcoupon` int(11) NOT NULL COMMENT 'ID เช็คคูปอง',
  `m_id` int(11) NOT NULL COMMENT 'รหัสลูกค้า',
  `c_name` varchar(40) NOT NULL COMMENT 'ชื่อคูปอง',
  `datesave` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่ใส่คูปอง'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_checkcoupon`
--

INSERT INTO `tbl_checkcoupon` (`id_checkcoupon`, `m_id`, `c_name`, `datesave`) VALUES
(1, 2, 'test', '2024-01-17 12:25:21'),
(6, 2, 'test2', '2024-01-17 17:12:05'),
(17, 9, 'test', '2024-01-18 02:12:17'),
(18, 9, 'test2', '2024-01-18 02:12:53'),
(22, 2, 'test3', '2024-01-20 11:14:42'),
(28, 43, '', '2024-03-01 13:24:47'),
(29, 2, '', '2024-03-04 15:51:45'),
(30, 2, '', '2024-03-04 15:51:45'),
(31, 43, '', '2024-03-04 15:51:49'),
(32, 43, '', '2024-03-04 15:51:49'),
(33, 2, '', '2024-03-04 16:20:15'),
(34, 43, '', '2024-03-04 16:20:22'),
(35, 2, '', '2024-03-04 16:22:08'),
(36, 43, '', '2024-03-04 16:22:12'),
(37, 43, '', '2024-03-04 16:24:58'),
(38, 2, '', '2024-03-04 16:25:01'),
(39, 43, '', '2024-03-04 16:34:34'),
(40, 2, '', '2024-03-04 16:34:39'),
(41, 2, '', '2024-03-04 16:40:57'),
(42, 43, '', '2024-03-04 16:40:59'),
(43, 2, '', '2024-03-04 17:15:24'),
(44, 43, '', '2024-03-04 17:16:44'),
(45, 2, '', '2024-03-04 17:20:04'),
(46, 2, '', '2024-03-04 17:25:50'),
(47, 2, '', '2024-03-04 17:27:24'),
(48, 43, '', '2024-03-04 17:29:32'),
(49, 43, '', '2024-03-04 17:30:22'),
(50, 2, '', '2024-03-04 17:32:48'),
(51, 43, '', '2024-03-04 17:35:02'),
(52, 43, '', '2024-03-04 17:36:01'),
(53, 43, '', '2024-03-04 18:08:38'),
(54, 43, '', '2024-03-04 18:08:39'),
(55, 43, '', '2024-03-04 18:08:49'),
(56, 43, '', '2024-03-04 18:10:13'),
(57, 43, '', '2024-03-04 18:10:13'),
(58, 2, '', '2024-03-08 11:25:04'),
(59, 2, '', '2024-03-10 13:58:54'),
(60, 2, '', '2024-03-10 14:20:26'),
(61, 2, '', '2024-05-14 13:59:54'),
(62, 2, '', '2024-05-17 07:58:07'),
(63, 2, '', '2024-05-26 10:24:45'),
(64, 2, '', '2024-05-26 10:44:42'),
(65, 2, '', '2024-05-27 12:16:49'),
(66, 46, '', '2024-05-27 13:20:41'),
(67, 46, '', '2024-05-27 13:20:41'),
(68, 46, '', '2024-05-27 13:24:54'),
(69, 2, '', '2024-06-11 20:47:05'),
(70, 2, '', '2024-06-11 20:47:05'),
(71, 2, '', '2024-06-11 20:48:26'),
(72, 2, '', '2024-06-11 20:49:58'),
(73, 2, '', '2024-06-11 20:50:30'),
(74, 2, '', '2024-06-11 20:55:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_coupon`
--

CREATE TABLE `tbl_coupon` (
  `coupon_id` int(11) NOT NULL COMMENT 'IDคูปอง',
  `coupon_code` varchar(255) NOT NULL COMMENT 'รหัสคูปอง',
  `coupon_date` date NOT NULL COMMENT 'วันที่หมดอายุ',
  `coupon_discount` decimal(10,2) NOT NULL COMMENT 'ราคาที่ลด',
  `coupon_datesave` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่สร้าง',
  `coupon_status` enum('ใช้งานได้','ใช้งานแล้ว') DEFAULT 'ใช้งานได้' COMMENT 'สถานะคูปอง'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_coupon`
--

INSERT INTO `tbl_coupon` (`coupon_id`, `coupon_code`, `coupon_date`, `coupon_discount`, `coupon_datesave`, `coupon_status`) VALUES
(1, 'test', '2024-01-19', 100.00, '2024-01-15 12:33:05', 'ใช้งานแล้ว'),
(14, 'Welcome', '2024-12-31', 100.00, '2024-06-21 05:17:43', 'ใช้งานได้');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `member_id` int(10) NOT NULL COMMENT 'รหัสผู้ใช้',
  `m_user` varchar(20) NOT NULL COMMENT 'ชื่อUser',
  `m_pass` varchar(255) NOT NULL COMMENT 'รหัส',
  `m_level` varchar(50) NOT NULL COMMENT 'ระดับผู้ใช้งาน',
  `m_name` varchar(100) NOT NULL COMMENT 'ชื่อผู้ใช้',
  `m_email` varchar(100) NOT NULL COMMENT 'E-mail',
  `m_tel` varchar(10) NOT NULL COMMENT 'เบอร์โทร',
  `m_address` varchar(200) NOT NULL COMMENT 'ที่อยู่',
  `m_date_save` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่สมัคร'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`member_id`, `m_user`, `m_pass`, `m_level`, `m_name`, `m_email`, `m_tel`, `m_address`, `m_date_save`) VALUES
(1, 'admin', '$2y$10$jiFQORtz61Re5hN6dP9hj.IVHRKNtfqPRDWz8b2xQO0tVM/kiS0Te', 'super_admin', 'admin', 'admin@gmail.com', '0999999999', 'songkhla', '2022-02-04 16:26:57'),
(2, 'member', '$2y$10$/xjog/uyd2puiJpRYEgIPe3KGi2EsmSdhGC/EvrPqEVI/gzB5oq1q', 'member', 'chanutorn', 'chanutorn@gmail.com', '0888888888', 'songkhla', '2021-06-01 19:05:54'),
(3, 'admin1', '880c64425becf21d986c330708b28364e3179df376c774cf907da99684075707', 'admin', 'admin1', 'admin1@gmail.com', '0999999999', 'hatyai', '2021-06-01 19:04:28'),
(4, 'admin2', '880c64425becf21d986c330708b28364e3179df376c774cf907da99684075707', 'admin', 'admin2', 'admin2@gmail.com', '0999999999', 'hatyai', '2021-06-01 19:09:04'),
(5, 'admin3', '$2y$10$jiFQORtz61Re5hN6dP9hj.IVHRKNtfqPRDWz8b2xQO0tVM/kiS0Te', 'admin', 'admin3', 'admin3@gmail.com', '0878898456', 'songkhla', '2022-03-04 03:00:05'),
(6, 'admin4', '$2y$10$jiFQORtz61Re5hN6dP9hj.IVHRKNtfqPRDWz8b2xQO0tVM/kiS0Te', 'member', 'admin4', 'admin4@gmail.com', '0657487454', 'hatyai', '2022-03-04 03:00:47'),
(7, 'admin5', '$2y$10$jiFQORtz61Re5hN6dP9hj.IVHRKNtfqPRDWz8b2xQO0tVM/kiS0Te', 'member', 'admin5', 'admin5@gmail.com', '', 'hatyai', '2022-03-09 16:54:30'),
(9, 'member1', '$2y$10$sEQ2OUpzfhQEIFvayTCxpuoR67.YjAC5AQO.XoHv4A7RCdBfGw0Iq', 'member', 'member1', 'member1@gmail.com', '', 'หาดใหญ่\r\n', '2021-06-01 19:06:39'),
(10, 'member2', '880c64425becf21d986c330708b28364e3179df376c774cf907da99684075707', 'member', 'member2', 'member2@gmail.com', '0123456789', 'songkhla', '2022-02-13 17:37:50'),
(11, 'member3', '880c64425becf21d986c330708b28364e3179df376c774cf907da99684075707', 'member', 'member3', 'member3@gmail.com', '0123456789', 'songkhla', '2022-02-14 05:32:51'),
(12, 'tang', '$2y$10$jiFQORtz61Re5hN6dP9hj.IVHRKNtfqPRDWz8b2xQO0tVM/kiS0Te', 'member', 'ชาณุธร ไทยนุกูล', 'chanuorn@gmail.com', '0123456789', 'songkhla', '2022-02-26 20:13:10'),
(61, 'cat', '$2y$10$SH3099rNaxD48GI8qTrkgOuIVCwp2oF2vR9DnuikGk0tcyOhXdcVy', 'member', 'cat', 'cat@gmail.com', '0888888888', 'hatyai', '2024-06-15 12:22:43'),
(62, 'iloveyou', '$2y$10$n8p1V7VisHUcadc02CPs7ui6nJ.iNHrbeTKl.6iQl4XWBqUH6HIFi', 'member', 'love', 'love@gmail.com', '0888888888', 'hatyai', '2024-06-18 14:11:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `o_id` int(10) NOT NULL COMMENT 'ID order',
  `o_code` varchar(50) NOT NULL COMMENT 'รหัสorder',
  `m_id` int(11) NOT NULL COMMENT 'รหัสลูกค้า',
  `p_id` int(11) NOT NULL COMMENT 'รหัสสินค้า',
  `qty` int(11) NOT NULL COMMENT 'จำนวน',
  `total` int(11) NOT NULL COMMENT 'ราคา',
  `date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่',
  `status` enum('รอตรวจสอบ','กำลังเตรียมสินค้า','รอเลขพัสดุ','กำลังส่งสินค้า','ส่งสินค้าแล้ว','ยกเลิกออเดอร์') NOT NULL COMMENT 'สถานะ',
  `tracking` varchar(50) NOT NULL COMMENT 'เลขพัสดุ',
  `delivery` enum('','J&T Express','Kerry Express','FLASH Express','ไปรษณีย์ไทย','SCG Express','Grab Express','Lineman','TNT','Nim Express','DHL Express','Alpha Fast','Lalamove','Niko’s Logistics','Ninja Van','Skootar') NOT NULL COMMENT 'ชื่อขนส่ง',
  `slip` varchar(100) NOT NULL COMMENT 'รูปสลิป'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`o_id`, `o_code`, `m_id`, `p_id`, `qty`, `total`, `date`, `status`, `tracking`, `delivery`, `slip`) VALUES
(1, '22401141521', 2, 12, 1, 2140, '2024-01-14 08:21:14', 'ยกเลิกออเดอร์', '', '', ''),
(2, '342401152048', 34, 12, 1, 1940, '2024-01-15 13:48:30', 'ส่งสินค้าแล้ว', '', '', ''),
(3, '342401172325', 34, 12, 1, 2140, '2024-01-17 16:25:02', 'กำลังเตรียมสินค้า', '', '', ''),
(4, '22401172347', 2, 12, 1, 1940, '2024-01-17 16:47:43', 'ยกเลิกออเดอร์', '', '', ''),
(5, '22401172347', 2, 12, 1, 1940, '2024-01-17 16:47:55', 'ยกเลิกออเดอร์', '', '', ''),
(6, '22401172353', 2, 12, 1, 1940, '2024-01-17 16:53:16', 'ส่งสินค้าแล้ว', '12345678', '', ''),
(7, '22401172353', 2, 12, 1, 1940, '2024-01-17 16:53:33', 'ส่งสินค้าแล้ว', '12345678', '', ''),
(8, '2240118001822', 2, 12, 1, 2240, '2024-01-17 17:18:22', 'ยกเลิกออเดอร์', '', '', ''),
(9, '2240118001830', 2, 12, 1, 2240, '2024-01-17 17:18:30', 'ยกเลิกออเดอร์', '', '', ''),
(10, '9240118091611', 9, 12, 1, 2040, '2024-01-18 02:16:11', 'ยกเลิกออเดอร์', '', '', ''),
(11, '9240118092830', 9, 12, 1, 2240, '2024-01-18 02:28:30', 'ยกเลิกออเดอร์', '', '', ''),
(12, '2240120181442', 2, 12, 1, 2040, '2024-01-20 11:14:42', 'ยกเลิกออเดอร์', '', '', ''),
(13, '2240202003434', 2, 12, 1, 2240, '2024-02-01 17:34:34', 'ส่งสินค้าแล้ว', '1234', '', 'slip1.jpg'),
(14, '2240202003434', 2, 15, 1, 5590, '2024-02-01 17:34:34', 'ส่งสินค้าแล้ว', '1234', '', 'slip1.jpg'),
(15, '2240202003452', 2, 13, 1, 2399, '2024-02-01 17:34:52', 'กำลังเตรียมสินค้า', '', '', 'slip1.jpg'),
(16, '2240205214244', 2, 15, 1, 5390, '2024-02-05 14:42:44', 'ยกเลิกออเดอร์', '', '', 'slip.jpg'),
(17, '43240301202447', 43, 13, 1, 2399, '2024-03-01 13:24:47', 'ส่งสินค้าแล้ว', '1234', '', ''),
(45, '43240305011013', 43, 13, 2, 2399, '2024-03-04 18:10:13', 'ยกเลิกออเดอร์', '', '', ''),
(46, '43240305011013', 43, 14, 1, 2080, '2024-03-04 18:10:13', 'ยกเลิกออเดอร์', '', '', ''),
(47, '2240308182504', 2, 15, 1, 5590, '2024-03-08 11:25:04', 'ส่งสินค้าแล้ว', '0000', '', ''),
(48, '2240310205854', 2, 15, 1, 5590, '2024-03-10 13:58:54', 'ยกเลิกออเดอร์', '', '', ''),
(49, '2240310212026', 2, 13, 1, 2399, '2024-03-10 14:20:26', 'กำลังเตรียมสินค้า', '', '', ''),
(50, '2240514205954', 2, 12, 1, 2240, '2024-05-14 13:59:54', 'รอเลขพัสดุ', '', '', ''),
(53, '2240526174442', 2, 15, 1, 5590, '2024-05-26 10:44:42', 'ส่งสินค้าแล้ว', '', '', ''),
(54, '2240527191649', 2, 15, 1, 5590, '2024-05-27 12:16:49', 'ยกเลิกออเดอร์', '', '', ''),
(55, '46240527202041', 46, 10, 1, 5400, '2024-05-27 13:20:41', 'ส่งสินค้าแล้ว', '1234', '', ''),
(56, '46240527202041', 46, 13, 1, 2399, '2024-05-27 13:20:41', 'ส่งสินค้าแล้ว', '1234', '', ''),
(57, '46240527202454', 46, 13, 1, 2399, '2024-05-27 13:24:54', 'ยกเลิกออเดอร์', '', '', ''),
(58, '2240612034705', 2, 8, 1, 5830, '2024-06-11 20:47:05', 'ยกเลิกออเดอร์', '', '', ''),
(59, '2240612034705', 2, 7, 1, 5090, '2024-06-11 20:47:05', 'ยกเลิกออเดอร์', '', '', ''),
(60, '2240612034826', 2, 15, 1, 5590, '2024-06-11 20:48:26', 'ยกเลิกออเดอร์', '', '', ''),
(61, '2240612034958', 2, 15, 1, 5590, '2024-06-11 20:49:58', 'ยกเลิกออเดอร์', '', '', ''),
(62, '2240612035030', 2, 15, 1, 5590, '2024-06-11 20:50:30', 'ส่งสินค้าแล้ว', '1234', 'J&T Express', ''),
(63, '2240612035500', 2, 15, 1, 5590, '2024-06-11 20:55:00', 'ส่งสินค้าแล้ว', '1234', 'J&T Express', 'slip1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `p_id` int(5) NOT NULL COMMENT 'รหัสสินค้า',
  `p_name` varchar(200) NOT NULL COMMENT 'ชื่อสินค้า',
  `type_id` int(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'ประเภทสินค้า',
  `brand_id` int(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'ประเภทแบรนด์',
  `p_detail` text NOT NULL COMMENT 'รายละเอียด',
  `p_img` varchar(200) NOT NULL COMMENT 'รูปสินค้า',
  `p_size` varchar(20) NOT NULL COMMENT 'ขนาด',
  `p_price` int(11) NOT NULL COMMENT 'ราคา',
  `p_qty` varchar(11) NOT NULL COMMENT 'จำนวน',
  `p_sex` varchar(20) NOT NULL COMMENT 'เพศ',
  `p_view` int(10) NOT NULL DEFAULT 0 COMMENT 'การเข้าชม',
  `datesave` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`p_id`, `p_name`, `type_id`, `brand_id`, `p_detail`, `p_img`, `p_size`, `p_price`, `p_qty`, `p_sex`, `p_view`, `datesave`) VALUES
(1, 'PUMA LEADCAT FTR MONO', 02, 01, ' มีลักษณะเนื้อฉ่ำแน่น รสชาติเข้มข้น มีสัดส่วนของช็อกโกแลตสูงและสัดส่วนของแป้งจะน้อยกว่าแบบอื่น หน้ามีความกรอบ หรืออาจเรียกได้ว่า บราวนี่หน้ากรอบ ', '60977861620240120_163938.jpg', '42', 1122, '19', 'ชาย', 7, '2021-06-26 16:38:28'),
(2, 'NIKE Air Rival Fly 3', 04, 05, 'พร้อมซัพพอร์ตในทุกเส้นทาง รองเท้าวิ่ง NIKE Zoom Winflo 8 มาพร้อมโครงสร้างเบาสบายและพื้นรองเท้าที่สปริงเพื่อส่งคืนพลังในทุกการลงน้ำหนักเท้า', '210150627520240120_164253.png', '39', 3740, '23', 'ชาย', 8, '2021-06-26 16:46:13'),
(3, 'Fila Disruptor 2', 01, 06, 'มีลักษณะเนื้อฉ่ำแน่น รสชาติเข้มข้น มีสัดส่วนของช็อกโกแลตสูงและสัดส่วนของแป้งจะน้อยกว่าแบบอื่น หน้ามีความกรอบ หรืออาจเรียกได้ว่า บราวนี่หน้ากรอบ', '204226960720240120_164037.jpg', '39', 2790, '27', 'หญิง', 6, '2021-06-26 16:46:35'),
(4, 'LACOSTE Graduate Tri 1', 01, 02, 'รองเท้าสนีกเกอร์ลาคอสท์ รุ่น Graduate วัสดุสังเคราะห์ สำหรับคุณผู้ชาย \r\n\r\nใช้งานได้จริงอย่างมีสไตล์ไปกับรองเท้าสนีกเกอร์ลาคอสท์ รุ่น Graduate แรงบันดาลใจจากสไตล์สปอร์ตให้ผลลัพธ์เป็นรองเท้าที่โดดเด่นในซัมเมอร์นี้ ด้านบนของรองเท้าผลิตขึ้นจากหนังสีขาวล้วนเนื้อนิ่ม โดยส่วนส้นรองเท้ามีสีน้ำเงินเข้มและพื้นที่บุรองด้านในก็เช่นกัน ตัวอักษร Lacoste สีทองเพิ่มความหรูหรา และรวมถึงตราจระเข้ลาคอสท์สามสีที่ปักอยู่ด้านข้างของรองเท้า', '200506179620240120_163923.jpg', '36', 3490, '19', 'ชาย', 7, '2021-06-26 16:46:51'),
(5, 'Nike Court Vision Mid', 01, 05, 'หากหลงรักลุคสุดคลาสสิกของบาสเก็ตบอลเรโทร แต่ก็แอบชอบวัฒนธรรมการเล่นเร็วของเกมในยุคปัจจุบันเราก็ขอแนะนำ Nike Court Vision Midส่วนบนแบบมีเท็กซ์เจอร์และส่วนหุ้มชั้นนอกแบบเย็บได้แรงบันดาลใจจากท่าฮุกช็อตที่เป็นภาพจำของบาสเก็ตบอลรุ่นเก๋ามาพร้อมส่วนหุ้มข้อปานกลางนุ่มพิเศษที่คงความโฉบเฉี่ยวไว้และทำให้สวมใส่สบายเสมอ', '109912717720240120_152729.png', '36', 2940, '0', 'ชาย', 1, '2022-01-23 16:55:42'),
(6, 'ADIDAS Predator Edge', 03, 03, 'ให้ทุกๆครั้งที่คุณสัมผัสบอลได้เปรียบ รองเท้าฟุตบอลผู้ชาย ADIDAS Predator Edge.4 FG มาพร้อมอัปเปอร์วัสดุสังเคราะห์ที่ให้สัมผัสนุ่มและสวมใส่สบาย ขณะที่ใต้พื้นรองเท้ามีความทนทานจะช่วยยึดเกาะพื้นให้คุณควบคุมเกมได้ทั่วทั้งสนาม', '183801177020240120_163910.jpg', '44', 2290, '29', 'ชาย', 13, '2022-02-20 15:06:18'),
(7, 'Mizuno Neo III Beta Elite', 03, 07, 'รองเท้าฟุตบอลรุ่นท็อปสายความเร็ว ผลิตจากหนังจิงโจ้เกรดพรีเมี่ยม ให้สัมผัสที่นุ่ม กระชับ บางเบาเหมือนเท้าเปล่า ชุดพื้นเบาและแข็งแรง ตอบสนองการเคลื่อนที่ได้อย่างยอดเยี่ยม\r\n\r\nรุ่นนี้ทรงกว้างใส่สบายเหมาะสำหรับเท้าคนไทย หมดปัญหาคนเท้าบาน หญ้าจริงหรือหญ้าเทียมลุยได้สบายๆ ไม่มีปัญหา ตัวนี้กระแสมาแรงที่สุดและขายดีที่สุด อยากได้รองเท้ารุ่นท็อปที่ว่ากันว่าดีที่สุดในตอนนี้ ต้องรุ่นนี้เลย…', '102888865220240120_163859.jpg', '44', 5090, '23', 'ชาย', 12, '2022-02-21 19:30:00'),
(8, 'Adidas Predator Freak.1 Low FG', 03, 03, 'รองเท้าสายคอนโทรลที่ครบเครื่องที่สุด ผลิตจากหนังสังเคราะห์คุณภาพสูง ให้สัมผัสเหนียวนุ่มและมีหุ้มข้อเพิ่มความกระชับ มั่นคงแข็งแรง สามารถปกป้องได้เป็นอย่างดี เหมาะกับทุกสภาพแวดล้อมและทุกสภาพอากาศ สำหรับชุดพื้นและปุ่มออกแบบมาให้ใช้งานได้ทั้งหญ้าจริงและหญ้าเทียม เป็นรุ่นที่ได้รับความนิยมและขายดีที่สุดในตอนนี้', '163852092020240120_163848.jpg', '46', 5830, '17', 'ชาย', 14, '2022-02-22 13:59:05'),
(9, 'Adidas Nemeziz.3 FG', 03, 03, 'เป็นรองเท้าที่ออกแบบมาเพิ่มความคล่องตัว และเคลื่อนที่ได้อย่างมีประสิทธิภาพเพื่อชิงความได้เปรียบจากคู่ต่อสู้ และยังช่วยในการปกป้องในการเข้าปะทะได้อีกด้วย ผลิตจากหนังสังเคราะห์คุณภาพสูงที่มีความยืดหยุ่นสูงและมีน้ำหนักเบา ชุดพื้นและปุ่มแข็งแรงทนทาน สามารถใช้งานได้ทุกสภาพสนาม และเป็นรองเท้าฟุตบอลรุ่นเบสิค (รองบ๊วย) ที่ได้รับการตอบรับอย่างดีเยียมอีกหนึ่งรุ่น', '84123210120240120_163837.jpg', '46', 2440, '0', 'ชาย', 2, '2022-02-23 14:02:56'),
(10, 'Nike jordan 1 low OG', 01, 05, 'รองเท้าวิ่งผู้ชาย NIKE Air Zoom Rival Fly 3 ดีไซน์มาสำหรับการฝึกซ้อมและการแข่งขัน ช่วยให้คุณเคลื่อนไหวได้อย่างนุ่มสบายเท้าพร้อมการออกแบบที่ทนทานในจุดที่เสียดสีเป็นพิเศษ ในขณะที่พื้นโฟมนุ่มผสานเข้ากับส่วน Zoom Air ที่ใต้เท้าเพื่อการตอบสนองและเด้งตัวได้ดีในทุกๆก้าว', '158215883920240120_151619.jpg', '42', 5400, '14', 'ชาย', 19, '2022-02-23 17:00:00'),
(12, 'CROCS Crocband Clog', 02, 04, 'คอลเลคชั่นสุดคลาสสิค ผลิตจากวัสดุ Croslite เพื่อความเบาและนุ่มสบายแบบรอบทิศทาง ผสานเทคโนโลยี Iconic Crocs Comfort™ ช่วยซัพพอร์ตเท้าอย่างอย่างยืดหยุ่น ทำความสะอาดง่าย แห้งเร็วและไร้ปัญหาเรื่องกลิ่นอับแม้โดนน้ำ', '143301284820240120_163827.jpg', '38', 2240, '79', 'ได้ทั้งชายและหญิง', 255, '2022-02-27 19:44:50'),
(13, 'Adidas Grand Court', 01, 03, 'ไม่ต่างจากนักกีฬาที่ต้องพัฒนาตัวเองไม่มีวันหยุด Adidas ต้องการก้าวข้ามขีดจำกัดในการออกกำลังกาย ด้วยเป้าหมายที่ชัดเจนคือ \"การเป็นสปอร์ตแบรนด์ที่ดีที่สุดในโลก\" Adidas มุ่งมั่นตั้งใจผลิตสินค้ากีฬาเพื่อทุก ๆ คนที่รักการออกกำลังกาย', '107339141520240120_163805.jpg', '39', 2399, '2', 'ชาย', 236, '2022-02-28 19:56:41'),
(14, 'Adidas Advantage', 01, 03, 'ไม่ต่างจากนักกีฬาที่ต้องพัฒนาตัวเองไม่มีวันหยุด Adidas ต้องการก้าวข้ามขีดจำกัดในการออกกำลังกาย ด้วยเป้าหมายที่ชัดเจนคือ \"การเป็นสปอร์ตแบรนด์ที่ดีที่สุดในโลก\" Adidas มุ่งมั่นตั้งใจผลิตสินค้ากีฬาเพื่อทุก ๆ คนที่รักการออกกำลังกาย', '146943644020240120_163756.jpg', '39', 2080, '5', 'ชาย', 58, '2022-03-03 06:23:25'),
(15, 'NEW BALANCE Fresh Foam 1080v11 4E', 04, 07, 'ตอบสนองความเบาสบายไม่ว่าจะวิ่งระยะทางใกล้หรือไกลด้วยรองเท้าวิ่งผู้ชาย NEW BALANCE Fresh Foam 1080v11 4E นำเสนอความสบายแบบ 360 องศาด้วยเทคโนโลยีพื้นโฟม Fresh Foam ที่ตอบสนองใต้ฝ่าเท้าได้อย่างยอดเยี่ยม ผสานผสมอัปเปอร์แบบผ้าถักที่มีความยืดหยุ่นและนุ่มเป็นพิเศษจะช่วยโอบรับเท้าของคุณได้อย่างพอดีในทุกๆไมล์ที่คุณออกวิ่ง', '126134906820240120_153643.jpg', '42', 5590, '4', 'ชาย', 250, '2022-03-03 10:00:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productimg`
--

CREATE TABLE `tbl_productimg` (
  `id` int(11) NOT NULL,
  `p_id` int(10) NOT NULL,
  `p_img1` varchar(200) NOT NULL,
  `p_img2` varchar(200) NOT NULL,
  `p_img3` varchar(200) NOT NULL,
  `p_img4` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_productimg`
--

INSERT INTO `tbl_productimg` (`id`, `p_id`, `p_img1`, `p_img2`, `p_img3`, `p_img4`) VALUES
(1, 1, '', '', '', ''),
(2, 2, '', '', '', ''),
(3, 3, '', '', '', ''),
(4, 4, '', '', '', ''),
(5, 5, '', '', '', ''),
(6, 6, '', '', '', ''),
(7, 7, '', '', '', ''),
(8, 8, '', '', '', ''),
(9, 9, '', '', '', ''),
(10, 10, '', '', '', ''),
(11, 11, '', '', '', ''),
(12, 12, '220240120_162250.png', '', '', ''),
(13, 13, '', '', '', ''),
(14, 14, '220240120_144223.png', '', '', ''),
(15, 15, '220240120_153611.jpg', '420240120_153611.jpg', '820240120_153611.jpg', '1120240120_153611.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reviews`
--

CREATE TABLE `tbl_reviews` (
  `id` int(11) NOT NULL COMMENT 'ID รีวิว',
  `m_id` int(10) NOT NULL COMMENT 'ID คนรีวิว',
  `rating` int(11) DEFAULT NULL COMMENT 'คะแนน',
  `comment` text DEFAULT NULL COMMENT 'คอมเมนต์',
  `r_img` varchar(200) NOT NULL COMMENT 'รูปรีวิว',
  `review_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่คอมเมนต์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_reviews`
--

INSERT INTO `tbl_reviews` (`id`, `m_id`, `rating`, `comment`, `r_img`, `review_date`) VALUES
(3, 34, 2, '<p>ใส่สบาย</p>', '', '2024-01-18 15:45:31'),
(26, 2, 5, '<p>ใช้งานดี</p>', '', '2024-01-19 18:44:31'),
(30, 12, 2, '<p>มีคุณภาพ</p>', '', '2024-01-19 18:46:02'),
(32, 2, 3, '<p>ตรงปก</p>', '', '2024-01-19 18:46:44'),
(35, 2, 4, '<p>สวย</p>', '', '2024-01-20 04:59:50'),
(36, 2, 1, '<p>ไว้ใจได้</p>', '', '2024-02-15 12:58:08'),
(55, 2, 2, '<p>ธรรมดา</p>', '', '2024-03-04 17:55:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_type`
--

CREATE TABLE `tbl_type` (
  `type_id` int(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'รหัสประเภท',
  `type_name` varchar(100) NOT NULL COMMENT 'ชื่อประเภท'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_type`
--

INSERT INTO `tbl_type` (`type_id`, `type_name`) VALUES
(01, 'รองเท้าผ้าใบ'),
(02, 'รองเท้าแตะ'),
(03, 'รองเท้าฟุตบอล-สตั๊ด'),
(04, 'รองเท้าวิ่ง / เทรนนิ่ง'),
(05, 'รองเท้าบาสเก็ตบอล');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `tbl_checkcoupon`
--
ALTER TABLE `tbl_checkcoupon`
  ADD PRIMARY KEY (`id_checkcoupon`);

--
-- Indexes for table `tbl_coupon`
--
ALTER TABLE `tbl_coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`member_id`),
  ADD UNIQUE KEY `m_user` (`m_user`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `tbl_productimg`
--
ALTER TABLE `tbl_productimg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_type`
--
ALTER TABLE `tbl_type`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brand_id` int(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'รหัสแบรนด์', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสตะกร้า', AUTO_INCREMENT=390;

--
-- AUTO_INCREMENT for table `tbl_checkcoupon`
--
ALTER TABLE `tbl_checkcoupon`
  MODIFY `id_checkcoupon` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID เช็คคูปอง', AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `tbl_coupon`
--
ALTER TABLE `tbl_coupon`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'IDคูปอง', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `member_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสผู้ใช้', AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `o_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID order', AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `p_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสินค้า', AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_productimg`
--
ALTER TABLE `tbl_productimg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID รีวิว', AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tbl_type`
--
ALTER TABLE `tbl_type`
  MODIFY `type_id` int(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'รหัสประเภท', AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
