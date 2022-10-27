-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 22, 2022 at 05:52 PM
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
(36, '7TEnjbfu9d', NULL, '0', '0');

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
(36, '10', NULL, NULL, '1', '22', 'PO-ox1chrcwm3op', '', 36, '2022-10-22 17:11:44');

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
(22, 'PO-ox1chrcwm3op', '2022-10-22 17:11:39', '0', '', 'สั่งแล้ว');

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
(41, '22', '1', '10', NULL, NULL, '');

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
(29, 'สั่งซื้อ', '2022-10-22 17:11:44.000000', 'PO-ox1chrcwm3op');

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
(91, '2022-10-22 00:00:00', '2025-10-22 00:00:00', '2022-10-22 00:00:00', '10', '');

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
(10, '1', '', '10');

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
-- Table structure for table `suppiles`
--

CREATE TABLE `suppiles` (
  `suppiles_id` int(10) NOT NULL,
  `suppiles_name` varchar(300) NOT NULL,
  `suppiles_company` varchar(300) NOT NULL,
  `suppiles_phone` varchar(10) NOT NULL,
  `suppiles_email` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'ปวดหลัง');

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
(1, 'แผง');

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
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `goods`
--
ALTER TABLE `goods`
  MODIFY `good_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `goods_detailproduct`
--
ALTER TABLE `goods_detailproduct`
  MODIFY `goods_detailproid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `po`
--
ALTER TABLE `po`
  MODIFY `po_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสการสั่งซื้อ', AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `po_detailproduct`
--
ALTER TABLE `po_detailproduct`
  MODIFY `po_detailproid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `po_status`
--
ALTER TABLE `po_status`
  MODIFY `po_status_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `product_date`
--
ALTER TABLE `product_date`
  MODIFY `product_date_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
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
-- AUTO_INCREMENT for table `suppiles`
--
ALTER TABLE `suppiles`
  MODIFY `suppiles_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `symptons`
--
ALTER TABLE `symptons`
  MODIFY `symp_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `type_product`
--
ALTER TABLE `type_product`
  MODIFY `type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
