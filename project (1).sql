-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 27, 2022 at 06:27 PM
-- Server version: 5.7.17-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cate_id` int(10) NOT NULL,
  `cate_name` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cate_id`, `cate_name`) VALUES
(2, 'ผลิตภัณฑ์เสริมอาหาร'),
(3, 'ยา'),
(4, 'ความงาม'),
(5, 'ของใช้ส่วนตัว'),
(6, 'ผลิตภัณฑ์ดูแลผิว'),
(7, 'ผลิตภัณฑ์ดูแลผู้ป่วย'),
(8, 'ผลิตภัณฑ์สุขภาพ'),
(9, 'ยาแก้ไข้หวัด'),
(10, 'ยาแก้ปวดข้อ กระดูก กล้ามเนื้อ'),
(11, 'ยาคุมกำเนิด'),
(12, 'ยาฆ่าเชื้อ'),
(13, 'ยาตา ยาเฉพาะที่'),
(14, 'ยาระบบต่อมไร้ท่อ'),
(15, 'ยาระบบทางเดินอาหาร'),
(16, 'ยาระบบประสาท และสมอง'),
(17, 'ยาระบบหลอดเลือดและทางเดินหัวใจ'),
(18, 'ยาระบบปัสสาวะ'),
(19, 'สมุนไพรไทย จีน'),
(20, 'อาหารเสริมสุขภาพ'),
(21, 'อุปกรณ์ทางการแพทย์'),
(22, 'อุปกรณ์ปฐมพยาบาล');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(10) NOT NULL,
  `customer_name` varchar(300) NOT NULL,
  `customer_last` varchar(300) NOT NULL,
  `customer_phone` varchar(10) NOT NULL,
  `customer_drug` varchar(300) NOT NULL,
  `create_date` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_last`, `customer_phone`, `customer_drug`, `create_date`) VALUES
(1, 'อนุวัฒน์', 'จันทร์รัสมี', '0641318526', '-', '2022-10-24 18:09:15.000000'),
(2, 'อธิกพัฒน์', 'ปิยะสราศาลทูล', '0646379821', '-', '2022-10-24 18:09:33.000000'),
(3, 'อภิวัฒน์', 'เจริญธรรม', '0611138527', '-', '2022-10-27 16:50:22.000000');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(10) NOT NULL,
  `employee_name` varchar(300) NOT NULL,
  `employee_phone` varchar(10) NOT NULL,
  `employee_email` varchar(300) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `employee_role` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_name`, `employee_phone`, `employee_email`, `username`, `password`, `employee_role`) VALUES
(4, 'อนุวัฒน์ ', '0641318526', 'pluem@gmail.com', 'ei', '12345', 'เภสัชกร');

-- --------------------------------------------------------

--
-- Table structure for table `goods`
--

CREATE TABLE `goods` (
  `good_id` int(10) NOT NULL,
  `good_RefNo` varchar(300) NOT NULL,
  `good_create` datetime DEFAULT NULL,
  `po_buyer` varchar(300) NOT NULL,
  `good_status` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `goods`
--

INSERT INTO `goods` (`good_id`, `good_RefNo`, `good_create`, `po_buyer`, `good_status`) VALUES
(36, '7TEnjbfu9d', '2022-10-27 14:50:12', '0', '1'),
(37, 'BsAa9rvIcS', NULL, '0', '0'),
(38, 'BsAa9rvIcS', NULL, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `goods_detailproduct`
--

CREATE TABLE `goods_detailproduct` (
  `goods_detailproid` int(10) NOT NULL,
  `product_id` varchar(300) NOT NULL,
  `product_start_date` date DEFAULT NULL,
  `product_end_date` date DEFAULT NULL,
  `product_quantity` varchar(300) NOT NULL,
  `po_id` varchar(300) NOT NULL,
  `po_RefNo` varchar(300) NOT NULL,
  `product_total` varchar(300) NOT NULL,
  `good_id` int(10) NOT NULL,
  `po_create` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `goods_detailproduct`
--

INSERT INTO `goods_detailproduct` (`goods_detailproid`, `product_id`, `product_start_date`, `product_end_date`, `product_quantity`, `po_id`, `po_RefNo`, `product_total`, `good_id`, `po_create`) VALUES
(36, '10', NULL, NULL, '1', '22', 'PO-ox1chrcwm3op', '', 36, '2022-10-22 17:11:44'),
(37, '8', NULL, NULL, '1', '25', 'PO-g4ejg7vbcp8m', '', 37, '2022-10-27 17:22:29'),
(38, '10', NULL, NULL, '3', '25', 'PO-g4ejg7vbcp8m', '', 38, '2022-10-27 17:22:29');

-- --------------------------------------------------------

--
-- Table structure for table `po`
--

CREATE TABLE `po` (
  `po_id` int(10) NOT NULL COMMENT 'รหัสการสั่งซื้อ',
  `po_RefNo` varchar(300) NOT NULL COMMENT 'หมายเลขใบสั่งซื้อ',
  `po_create` datetime NOT NULL COMMENT 'วันที่สั่งซื้อ',
  `po_buyer` varchar(300) NOT NULL COMMENT 'ผู้ขาย',
  `po_saler` varchar(300) NOT NULL COMMENT 'ผู้ซื้อ',
  `po_status` varchar(300) NOT NULL COMMENT 'สถานะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `po`
--

INSERT INTO `po` (`po_id`, `po_RefNo`, `po_create`, `po_buyer`, `po_saler`, `po_status`) VALUES
(22, 'PO-ox1chrcwm3op', '2022-10-22 17:11:39', '0', '1', 'รับสินค้าแล้ว'),
(24, 'PO-ucwqrjwubdn2', '2022-10-27 17:13:11', '0', '1', 'รอยืนยัน'),
(25, 'PO-g4ejg7vbcp8m', '2022-10-27 17:21:19', '0', '1', 'สั่งแล้ว');

-- --------------------------------------------------------

--
-- Table structure for table `po_detailproduct`
--

CREATE TABLE `po_detailproduct` (
  `po_detailproid` int(10) NOT NULL,
  `po_id` varchar(10) NOT NULL,
  `product_quantity` varchar(300) NOT NULL,
  `product_id` varchar(300) NOT NULL,
  `product_start_date` datetime(6) DEFAULT NULL,
  `product_end_date` datetime(6) DEFAULT NULL,
  `product_total` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `po_detailproduct`
--

INSERT INTO `po_detailproduct` (`po_detailproid`, `po_id`, `product_quantity`, `product_id`, `product_start_date`, `product_end_date`, `product_total`) VALUES
(41, '22', '1', '10', '2022-10-27 14:50:12.000000', '2025-10-27 00:00:00.000000', ''),
(45, '24', '1', '9', NULL, NULL, ''),
(46, '24', '1', '10', NULL, NULL, ''),
(47, '24', '2', '8', NULL, NULL, ''),
(48, '25', '1', '8', NULL, NULL, ''),
(49, '25', '3', '10', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `po_status`
--

CREATE TABLE `po_status` (
  `po_status_id` int(10) NOT NULL,
  `po_status` varchar(300) NOT NULL,
  `status_create` datetime(6) NOT NULL,
  `po_RefNo` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `po_status`
--

INSERT INTO `po_status` (`po_status_id`, `po_status`, `status_create`, `po_RefNo`) VALUES
(29, 'สั่งซื้อ', '2022-10-22 17:11:44.000000', 'PO-ox1chrcwm3op'),
(30, 'สั่งซื้อ', '2022-10-27 17:22:29.000000', 'PO-g4ejg7vbcp8m'),
(31, 'สั่งซื้อ', '2022-10-27 17:22:29.000000', 'PO-g4ejg7vbcp8m');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(10) NOT NULL,
  `product_name` varchar(300) NOT NULL,
  `product_common` varchar(300) NOT NULL,
  `product_unit` varchar(20) NOT NULL,
  `product_type` varchar(10) NOT NULL,
  `product_category` varchar(10) NOT NULL,
  `product_symp` varchar(10) NOT NULL,
  `product_img` varchar(300) NOT NULL,
  `product_barcode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_common`, `product_unit`, `product_type`, `product_category`, `product_symp`, `product_img`, `product_barcode`) VALUES
(8, 'เมโลเดีย', '', '1', '4', '11', '1', 'Melodia.jpg', ''),
(9, 'ยาคุมกำเนิดแบบชนิดฮอร์โมน', '', '1', '4', '11', '1', 'Yasmin.jpg', ''),
(10, 'ยาแก้ปวด พาราเซตามอล', '', '1', '4', '9', '1', 'parasetamol.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_date`
--

CREATE TABLE `product_date` (
  `product_date_id` int(10) NOT NULL,
  `product_start_date` datetime NOT NULL,
  `product_end_date` datetime NOT NULL,
  `product_create_date` datetime NOT NULL,
  `product_id` varchar(300) NOT NULL,
  `good_RefNo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_date`
--

INSERT INTO `product_date` (`product_date_id`, `product_start_date`, `product_end_date`, `product_create_date`, `product_id`, `good_RefNo`) VALUES
(91, '2022-10-22 00:00:00', '2025-10-22 00:00:00', '2022-10-22 00:00:00', '10', ''),
(92, '2022-10-27 00:00:00', '2025-10-27 00:00:00', '2022-10-27 00:00:00', '10', ''),
(93, '2022-10-27 00:00:00', '2025-10-27 00:00:00', '2022-10-27 00:00:00', '10', ''),
(94, '2022-10-27 00:00:00', '2025-10-27 00:00:00', '2022-10-27 00:00:00', '10', ''),
(95, '2022-10-27 00:00:00', '2025-10-27 00:00:00', '2022-10-27 00:00:00', '10', ''),
(96, '2022-10-27 00:00:00', '2025-10-27 00:00:00', '2022-10-27 00:00:00', '10', ''),
(97, '2022-10-27 00:00:00', '2025-10-27 00:00:00', '2022-10-27 00:00:00', '10', ''),
(98, '2022-10-27 00:00:00', '2025-10-27 00:00:00', '2022-10-27 00:00:00', '10', ''),
(99, '2022-10-27 00:00:00', '2025-10-27 00:00:00', '2022-10-27 00:00:00', '10', ''),
(100, '2022-10-27 00:00:00', '2025-10-27 00:00:00', '2022-10-27 00:00:00', '10', ''),
(101, '2022-10-27 00:00:00', '2025-10-27 00:00:00', '2022-10-27 00:00:00', '10', ''),
(102, '2022-10-27 00:00:00', '2025-10-27 00:00:00', '2022-10-27 00:00:00', '10', ''),
(103, '2022-10-27 00:00:00', '2025-10-27 00:00:00', '2022-10-27 00:00:00', '10', ''),
(104, '2022-10-27 00:00:00', '2025-10-27 00:00:00', '2022-10-27 00:00:00', '10', ''),
(105, '2022-10-27 00:00:00', '2025-10-27 00:00:00', '2022-10-27 00:00:00', '10', ''),
(106, '2022-10-27 00:00:00', '2025-10-27 00:00:00', '2022-10-27 00:00:00', '10', ''),
(107, '2022-10-27 00:00:00', '2025-10-27 00:00:00', '2022-10-27 00:00:00', '10', ''),
(108, '2022-10-27 00:00:00', '2025-10-27 00:00:00', '2022-10-27 00:00:00', '10', ''),
(109, '2022-10-27 00:00:00', '2025-10-27 00:00:00', '2022-10-27 00:00:00', '10', ''),
(110, '2022-10-27 00:00:00', '2025-10-27 00:00:00', '2022-10-27 00:00:00', '10', ''),
(111, '2022-10-27 00:00:00', '2025-10-27 00:00:00', '2022-10-27 00:00:00', '10', ''),
(112, '2022-10-27 00:00:00', '2025-10-27 00:00:00', '2022-10-27 00:00:00', '10', '7TEnjbfu9d'),
(113, '2022-10-27 00:00:00', '2025-10-27 00:00:00', '2022-10-27 00:00:00', '10', '7TEnjbfu9d'),
(114, '2022-10-27 00:00:00', '2025-10-27 00:00:00', '2022-10-27 00:00:00', '10', '7TEnjbfu9d'),
(115, '2022-10-27 00:00:00', '2025-10-27 00:00:00', '2022-10-27 00:00:00', '10', '7TEnjbfu9d'),
(116, '2022-10-27 13:55:31', '2025-10-27 00:00:00', '2022-10-27 13:55:31', '10', '7TEnjbfu9d'),
(117, '2022-10-27 13:55:46', '2025-10-27 00:00:00', '2022-10-27 13:55:46', '10', '7TEnjbfu9d'),
(118, '2022-10-27 13:56:13', '2025-10-27 00:00:00', '2022-10-27 13:56:13', '10', '7TEnjbfu9d'),
(119, '2022-10-27 13:56:21', '2025-10-27 00:00:00', '2022-10-27 13:56:21', '10', '7TEnjbfu9d'),
(120, '2022-10-27 13:56:50', '2025-10-27 00:00:00', '2022-10-27 13:56:50', '10', '7TEnjbfu9d'),
(121, '2022-10-27 14:00:46', '2025-10-27 00:00:00', '2022-10-27 14:00:46', '10', '7TEnjbfu9d'),
(122, '2022-10-27 14:01:11', '2025-10-27 00:00:00', '2022-10-27 14:01:11', '10', '7TEnjbfu9d'),
(123, '2022-10-27 14:01:19', '2025-10-27 00:00:00', '2022-10-27 14:01:19', '10', '7TEnjbfu9d'),
(124, '2022-10-27 14:02:05', '2025-10-27 00:00:00', '2022-10-27 14:02:05', '10', '7TEnjbfu9d'),
(125, '2022-10-27 14:02:17', '2025-10-27 00:00:00', '2022-10-27 14:02:17', '10', '7TEnjbfu9d'),
(126, '2022-10-27 14:02:32', '2025-10-27 00:00:00', '2022-10-27 14:02:32', '10', '7TEnjbfu9d'),
(127, '2022-10-27 14:02:44', '2025-10-27 00:00:00', '2022-10-27 14:02:44', '10', '7TEnjbfu9d'),
(128, '2022-10-27 14:02:47', '2025-10-27 00:00:00', '2022-10-27 14:02:47', '10', '7TEnjbfu9d'),
(129, '2022-10-27 14:16:08', '2025-10-27 00:00:00', '2022-10-27 14:16:08', '10', '7TEnjbfu9d'),
(130, '2022-10-27 14:16:34', '2025-10-27 00:00:00', '2022-10-27 14:16:34', '10', '7TEnjbfu9d'),
(131, '2022-10-27 14:16:40', '2025-10-27 00:00:00', '2022-10-27 14:16:40', '10', '7TEnjbfu9d'),
(132, '2022-10-27 14:16:48', '2025-10-27 00:00:00', '2022-10-27 14:16:48', '10', '7TEnjbfu9d'),
(133, '2022-10-27 14:20:47', '2025-10-27 00:00:00', '2022-10-27 14:20:47', '10', '7TEnjbfu9d'),
(134, '2022-10-27 14:22:41', '2025-10-27 00:00:00', '2022-10-27 14:22:41', '10', '7TEnjbfu9d'),
(135, '2022-10-27 14:23:33', '2025-10-27 00:00:00', '2022-10-27 14:23:33', '10', '7TEnjbfu9d'),
(136, '2022-10-27 14:23:36', '2025-10-27 00:00:00', '2022-10-27 14:23:36', '10', '7TEnjbfu9d'),
(137, '2022-10-27 14:23:40', '2025-10-27 00:00:00', '2022-10-27 14:23:40', '10', '7TEnjbfu9d'),
(138, '2022-10-27 14:24:11', '2025-10-27 00:00:00', '2022-10-27 14:24:11', '10', '7TEnjbfu9d'),
(139, '2022-10-27 14:25:23', '2025-10-27 00:00:00', '2022-10-27 14:25:23', '10', '7TEnjbfu9d'),
(140, '2022-10-27 14:27:18', '2025-10-27 00:00:00', '2022-10-27 14:27:18', '10', '7TEnjbfu9d'),
(141, '2022-10-27 14:28:25', '2025-10-27 00:00:00', '2022-10-27 14:28:25', '10', '7TEnjbfu9d'),
(142, '2022-10-27 14:28:29', '2025-10-27 00:00:00', '2022-10-27 14:28:29', '10', '7TEnjbfu9d'),
(143, '2022-10-27 14:28:40', '2025-10-27 00:00:00', '2022-10-27 14:28:40', '10', '7TEnjbfu9d'),
(144, '2022-10-27 14:28:44', '2025-10-27 00:00:00', '2022-10-27 14:28:44', '10', '7TEnjbfu9d'),
(145, '2022-10-27 14:29:20', '2025-10-27 00:00:00', '2022-10-27 14:29:20', '10', '7TEnjbfu9d'),
(146, '2022-10-27 14:29:24', '2025-10-27 00:00:00', '2022-10-27 14:29:24', '10', '7TEnjbfu9d'),
(147, '2022-10-27 14:29:31', '2025-10-27 00:00:00', '2022-10-27 14:29:31', '10', '7TEnjbfu9d'),
(148, '2022-10-27 14:29:57', '2025-10-27 00:00:00', '2022-10-27 14:29:57', '10', '7TEnjbfu9d'),
(149, '2022-10-27 14:32:06', '2025-10-27 00:00:00', '2022-10-27 14:32:06', '10', '7TEnjbfu9d'),
(150, '2022-10-27 14:32:12', '2025-10-27 00:00:00', '2022-10-27 14:32:12', '10', '7TEnjbfu9d'),
(151, '2022-10-27 14:33:01', '2025-10-27 00:00:00', '2022-10-27 14:33:01', '10', '7TEnjbfu9d'),
(152, '2022-10-27 14:33:10', '2025-10-27 00:00:00', '2022-10-27 14:33:10', '10', '7TEnjbfu9d'),
(153, '2022-10-27 14:35:48', '2025-10-27 00:00:00', '2022-10-27 14:35:48', '10', '7TEnjbfu9d'),
(154, '2022-10-27 14:36:13', '2025-10-27 00:00:00', '2022-10-27 14:36:13', '10', '7TEnjbfu9d'),
(155, '2022-10-27 14:36:38', '2025-10-27 00:00:00', '2022-10-27 14:36:38', '10', '7TEnjbfu9d'),
(156, '2022-10-27 14:37:06', '2025-10-27 00:00:00', '2022-10-27 14:37:06', '10', '7TEnjbfu9d'),
(157, '2022-10-27 14:37:13', '2025-10-27 00:00:00', '2022-10-27 14:37:13', '10', '7TEnjbfu9d'),
(158, '2022-10-27 14:37:56', '2025-10-27 00:00:00', '2022-10-27 14:37:56', '10', '7TEnjbfu9d'),
(159, '2022-10-27 14:38:02', '2025-10-27 00:00:00', '2022-10-27 14:38:02', '10', '7TEnjbfu9d'),
(160, '2022-10-27 14:38:21', '2025-10-27 00:00:00', '2022-10-27 14:38:21', '10', '7TEnjbfu9d'),
(161, '2022-10-27 14:50:12', '2025-10-27 00:00:00', '2022-10-27 14:50:12', '10', '7TEnjbfu9d');

-- --------------------------------------------------------

--
-- Table structure for table `product_price`
--

CREATE TABLE `product_price` (
  `product_price_id` int(10) NOT NULL,
  `product_price_cost` varchar(300) NOT NULL,
  `product_price_sell` varchar(300) NOT NULL,
  `product_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_price`
--

INSERT INTO `product_price` (`product_price_id`, `product_price_cost`, `product_price_sell`, `product_id`) VALUES
(8, '30', '0', 8),
(9, '40', '0', 9),
(10, '30', '0', 10);

-- --------------------------------------------------------

--
-- Table structure for table `product_quantity`
--

CREATE TABLE `product_quantity` (
  `product_quantity_id` int(10) NOT NULL,
  `product_quantity` varchar(300) NOT NULL,
  `good_RefNo` varchar(300) NOT NULL,
  `product_id` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_quantity`
--

INSERT INTO `product_quantity` (`product_quantity_id`, `product_quantity`, `good_RefNo`, `product_id`) VALUES
(8, '0', '', '8'),
(9, '0', '', '9'),
(10, '25', '7TEnjbfu9d', '10');

-- --------------------------------------------------------

--
-- Table structure for table `product_reorder`
--

CREATE TABLE `product_reorder` (
  `product_reorder_id` int(10) NOT NULL,
  `product_id` varchar(300) NOT NULL,
  `point` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_reorder`
--

INSERT INTO `product_reorder` (`product_reorder_id`, `product_id`, `point`) VALUES
(7, '8', '100'),
(8, '9', '50'),
(9, '10', '30');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(10) NOT NULL,
  `product_id` varchar(300) NOT NULL,
  `product_quantity` varchar(300) NOT NULL,
  `product_price_cost` varchar(300) NOT NULL,
  `product_price_sell` varchar(300) NOT NULL,
  `product_start_date` varchar(300) NOT NULL,
  `product_end_date` varchar(300) NOT NULL,
  `product_reorder` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `suppiles`
--

CREATE TABLE `suppiles` (
  `suppiles_id` int(10) NOT NULL,
  `suppiles_name` varchar(300) NOT NULL,
  `suppiles_company` varchar(300) NOT NULL,
  `suppiles_phone` varchar(10) NOT NULL,
  `suppiles_email` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suppiles`
--

INSERT INTO `suppiles` (`suppiles_id`, `suppiles_name`, `suppiles_company`, `suppiles_phone`, `suppiles_email`) VALUES
(1, 'รัตนพร แดงวัน', '-', '0846379821', 'rattanaporn@gmail.com'),
(2, '-', 'บริษัท ยา จำกัด', '0641318885', 'ya.ha@gmail.co.th');

-- --------------------------------------------------------

--
-- Table structure for table `symptons`
--

CREATE TABLE `symptons` (
  `symp_id` int(10) NOT NULL,
  `symp_name` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `symptons`
--

INSERT INTO `symptons` (`symp_id`, `symp_name`) VALUES
(2, 'โสต ศอ นาสิก');

-- --------------------------------------------------------

--
-- Table structure for table `type_product`
--

CREATE TABLE `type_product` (
  `type_id` int(10) NOT NULL,
  `type_name` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_product`
--

INSERT INTO `type_product` (`type_id`, `type_name`) VALUES
(4, 'อุปโภค บริโภค'),
(5, 'อุตสาหกรรม');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unit_id` int(10) NOT NULL,
  `unit_name` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `unit_name`) VALUES
(1, 'แผง'),
(2, 'พับ'),
(3, 'ม้วน'),
(4, 'ใบ'),
(5, 'อัน'),
(6, 'ขวด'),
(7, 'ตลับ'),
(8, 'กล่อง'),
(9, 'แกลลอน'),
(10, 'เส้น'),
(11, 'หลอด'),
(12, 'แผ่น'),
(13, 'เม็ด'),
(14, 'ชื้น');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_stock`
-- (See below for the actual view)
--
CREATE TABLE `view_stock` (
`product_id` int(10)
,`product_name` varchar(300)
,`product_start_date` datetime
,`product_end_date` datetime
,`product_price_cost` varchar(300)
,`product_price_sell` varchar(300)
,`product_quantity` varchar(300)
,`point` varchar(300)
);

-- --------------------------------------------------------

--
-- Structure for view `view_stock`
--
DROP TABLE IF EXISTS `view_stock`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_stock`  AS  select `a`.`product_id` AS `product_id`,`a`.`product_name` AS `product_name`,`b`.`product_start_date` AS `product_start_date`,`b`.`product_end_date` AS `product_end_date`,`c`.`product_price_cost` AS `product_price_cost`,`c`.`product_price_sell` AS `product_price_sell`,`d`.`product_quantity` AS `product_quantity`,`e`.`point` AS `point` from ((((`product` `a` join `product_date` `b` on((`a`.`product_id` = `b`.`product_id`))) join `product_price` `c` on((`a`.`product_id` = `c`.`product_id`))) join `product_quantity` `d` on((`a`.`product_id` = `d`.`product_id`))) join `product_reorder` `e` on((`a`.`product_id` = `e`.`product_id`))) where ((`b`.`product_start_date` <> '') and (`b`.`product_end_date` <> '') and (`c`.`product_price_cost` <> '') and (`b`.`good_RefNo` <> '')) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cate_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`good_id`);

--
-- Indexes for table `goods_detailproduct`
--
ALTER TABLE `goods_detailproduct`
  ADD PRIMARY KEY (`goods_detailproid`);

--
-- Indexes for table `po`
--
ALTER TABLE `po`
  ADD PRIMARY KEY (`po_id`);

--
-- Indexes for table `po_detailproduct`
--
ALTER TABLE `po_detailproduct`
  ADD PRIMARY KEY (`po_detailproid`);

--
-- Indexes for table `po_status`
--
ALTER TABLE `po_status`
  ADD PRIMARY KEY (`po_status_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_date`
--
ALTER TABLE `product_date`
  ADD PRIMARY KEY (`product_date_id`);

--
-- Indexes for table `product_price`
--
ALTER TABLE `product_price`
  ADD PRIMARY KEY (`product_price_id`);

--
-- Indexes for table `product_quantity`
--
ALTER TABLE `product_quantity`
  ADD PRIMARY KEY (`product_quantity_id`);

--
-- Indexes for table `product_reorder`
--
ALTER TABLE `product_reorder`
  ADD PRIMARY KEY (`product_reorder_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `suppiles`
--
ALTER TABLE `suppiles`
  ADD PRIMARY KEY (`suppiles_id`);

--
-- Indexes for table `symptons`
--
ALTER TABLE `symptons`
  ADD PRIMARY KEY (`symp_id`);

--
-- Indexes for table `type_product`
--
ALTER TABLE `type_product`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cate_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `goods`
--
ALTER TABLE `goods`
  MODIFY `good_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `goods_detailproduct`
--
ALTER TABLE `goods_detailproduct`
  MODIFY `goods_detailproid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `po`
--
ALTER TABLE `po`
  MODIFY `po_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสการสั่งซื้อ', AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `po_detailproduct`
--
ALTER TABLE `po_detailproduct`
  MODIFY `po_detailproid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `po_status`
--
ALTER TABLE `po_status`
  MODIFY `po_status_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `product_date`
--
ALTER TABLE `product_date`
  MODIFY `product_date_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;
--
-- AUTO_INCREMENT for table `product_price`
--
ALTER TABLE `product_price`
  MODIFY `product_price_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `product_quantity`
--
ALTER TABLE `product_quantity`
  MODIFY `product_quantity_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `product_reorder`
--
ALTER TABLE `product_reorder`
  MODIFY `product_reorder_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `suppiles`
--
ALTER TABLE `suppiles`
  MODIFY `suppiles_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `symptons`
--
ALTER TABLE `symptons`
  MODIFY `symp_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `type_product`
--
ALTER TABLE `type_product`
  MODIFY `type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
