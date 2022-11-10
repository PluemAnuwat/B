-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 05, 2022 at 11:30 AM
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
(4, 'อนุวัฒน์ ', '0641318526', 'pluem@gmail.com', 'ei', '12345', 'เภสัชกร'),
(5, 'รัตนพร แดงวัน', '0846379821', 'rattanaporn@gmail.com', 'manager', '12345', 'เจ้าของกิจการ'),
(6, 'ธนาพร เรื่อนก้อน', '0688894217', 'kawe@gmail.com', 'admin', '12345', 'ผู้ดูแลระบบ');

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
(20, 'GO-eISkVIHedx', NULL, 'เภสัชกร', '0'),
(21, 'GO-eISkVIHedx', NULL, 'เภสัชกร', '0'),
(22, 'GO-eISkVIHedx', NULL, 'เภสัชกร', '0'),
(23, 'GO-eISkVIHedx', NULL, 'เภสัชกร', '0'),
(24, 'GO-eISkVIHedx', NULL, 'เภสัชกร', '0'),
(25, 'GO-eISkVIHedx', NULL, 'เภสัชกร', '0'),
(26, 'GO-eISkVIHedx', NULL, 'เภสัชกร', '0');

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
(20, '54', NULL, NULL, '2', '14', 'PO-noks0zf8blv7', '', 20, '2022-11-05 04:27:46'),
(21, '57', NULL, NULL, '1', '14', 'PO-noks0zf8blv7', '', 21, '2022-11-05 04:27:46'),
(22, '61', NULL, NULL, '4', '14', 'PO-noks0zf8blv7', '', 22, '2022-11-05 04:27:46'),
(23, '59', NULL, NULL, '1', '14', 'PO-noks0zf8blv7', '', 23, '2022-11-05 04:27:46'),
(24, '49', NULL, NULL, '2', '14', 'PO-noks0zf8blv7', '', 24, '2022-11-05 04:27:46'),
(25, '65', NULL, NULL, '2', '14', 'PO-noks0zf8blv7', '', 25, '2022-11-05 04:27:46'),
(26, '55', NULL, NULL, '1', '14', 'PO-noks0zf8blv7', '', 26, '2022-11-05 04:27:46');

-- --------------------------------------------------------

--
-- Table structure for table `po`
--

CREATE TABLE `po` (
  `po_id` int(10) NOT NULL COMMENT 'รหัสการสั่งซื้อ',
  `po_RefNo` varchar(300) NOT NULL COMMENT 'หมายเลขใบสั่งซื้อ',
  `po_create` date NOT NULL COMMENT 'วันที่สั่งซื้อ',
  `po_buyer` varchar(300) NOT NULL COMMENT 'ผู้ขาย',
  `po_saler` varchar(300) NOT NULL COMMENT 'ผู้ซื้อ',
  `po_status` varchar(300) NOT NULL COMMENT 'สถานะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `po`
--

INSERT INTO `po` (`po_id`, `po_RefNo`, `po_create`, `po_buyer`, `po_saler`, `po_status`) VALUES
(14, 'PO-noks0zf8blv7', '2022-11-05', 'เภสัชกร', '2', 'สั่งแล้ว');

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
(23, '14', '2', '54', NULL, NULL, '440'),
(24, '14', '1', '57', NULL, NULL, '10'),
(25, '14', '4', '61', NULL, NULL, '2200'),
(26, '14', '1', '59', NULL, NULL, '230'),
(27, '14', '2', '49', NULL, NULL, '840'),
(28, '14', '2', '65', NULL, NULL, '240'),
(29, '14', '1', '55', NULL, NULL, '320');

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
(20, 'สั่งซื้อ', '2022-11-05 04:27:46.000000', 'PO-noks0zf8blv7'),
(21, 'สั่งซื้อ', '2022-11-05 04:27:46.000000', 'PO-noks0zf8blv7'),
(22, 'สั่งซื้อ', '2022-11-05 04:27:46.000000', 'PO-noks0zf8blv7'),
(23, 'สั่งซื้อ', '2022-11-05 04:27:46.000000', 'PO-noks0zf8blv7'),
(24, 'สั่งซื้อ', '2022-11-05 04:27:46.000000', 'PO-noks0zf8blv7'),
(25, 'สั่งซื้อ', '2022-11-05 04:27:46.000000', 'PO-noks0zf8blv7'),
(26, 'สั่งซื้อ', '2022-11-05 04:27:46.000000', 'PO-noks0zf8blv7');

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
  `product_barcode` varchar(10) NOT NULL,
  `product_quantity` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_common`, `product_unit`, `product_type`, `product_category`, `product_symp`, `product_img`, `product_barcode`, `product_quantity`) VALUES
(45, 'ยาพาราเซตามอล', '', '8', '4', '9', '2', '1667559381parasetamol.jpg', '', '0'),
(46, 'Medigrip ผ้ายืดรัดข้อเท้า Ankle Support size L', '', '8', '4', '22', '2', '200166-1_2.png', '', '0'),
(47, 'PREG-T แผ่นตรวจตั้งครรภ์ STRIP (จุ่ม)', '', '8', '4', '2', '2', '148059_1.jpg', '', '0'),
(48, 'Q LINE เก้าอี้นั่งถ่ายถังพลาสติก PL-901 สีขาว', '', '14', '4', '21', '2', '254541_1.jpg', '', '0'),
(49, 'Certainty เซอร์เทนตี้ ผ้าอ้อมเทปผู้ใหญ่', '', '14', '4', '2', '2', '222338_3.jpg', '', '0'),
(50, 'Blackmores แบลคมอร์ส LECITHIN 1200MG 100 เม็ด', '', '6', '4', '2', '2', '063568_1.jpeg', '', '0'),
(51, 'Nestle Boost Care เครื่องดื่มเสริมเวย์โปรตีน ขนาด 800 กรัม', '', '15', '4', '2', '2', '257192-1 (1).jpg', '', '0'),
(52, 'tynor รองเท้า D32 Walker Boot Long Size CH', '', '14', '4', '20', '2', '250082-1.png', '', '0'),
(53, 'Mobility Wheel Chair รถเข็นสำหรับผู้ป่วย ขนาดใหญ่พิเศษ', '', '14', '4', '21', '2', '240737_1.jpg', '', '0'),
(54, 'Bio-Oil Dry Skin Gel ออยล์ทาผิว ขนาด 50 ml.', '', '15', '4', '6', '2', '273498_1.jpg', '', '0'),
(55, 'Bio-Oil Dry Skin Gel ออยล์ทาผิว ขนาด 100 ml.', '', '15', '4', '6', '2', '1667559746273498_1.jpg', '', '0'),
(56, 'อ้วยอัน ยาแคปซูลฟ้าทะลายโจร 100 แคปซูล', '', '6', '4', '2', '2', '000507-1.jpg', '', '0'),
(57, 'Bakamol บาคามอล พาราเซตามอล', '', '1', '4', '9', '2', '295736_1.jpg', '', '0'),
(58, 'วังพรม ฟ้าทะลายโจร ขนาด 100 แคปซูล', '', '8', '4', '19', '2', '268550-1.jpg', '', '0'),
(59, 'I-Kids Mouthspray for Kids สเปรย์เพื่อช่องปาก', '', '8', '4', '20', '2', '240036_1.jpg', '', '0'),
(60, 'tynor ลูกยางไม้เท้า ขนาด 22 mm L10 POD Crutch', '', '14', '4', '22', '2', '260665-1.png', '', '0'),
(61, 'APY น้ำมันรำข้าว 500mg ตราอภัยภูเบศร', '', '8', '4', '20', '2', '301469_1.jpg', '', '0'),
(62, 'Vistra B-Complex Plus Ginseng 30 เม็ด', '', '15', '4', '2', '2', '183687-1.jpg', '', '0'),
(63, 'POLAR SPRAY สเปรย์ปรับอากาศ 280 มล.', '', '1', '4', '5', '2', '225452-1.jpg', '', '0'),
(64, 'SPA CLEAN HM ผลิตภัณฑ์ฆ่าเชื้อ กลิ่นไฮจีนิค ซอฟท์ 350 มล.', '', '6', '4', '5', '2', '267449-1.jpg', '', '0'),
(65, 'MAGNATE ชามรูปไต S/L ขนาด 8 นิ้ว', '', '14', '4', '21', '2', '016268_1.jpg', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `product_date`
--

CREATE TABLE `product_date` (
  `product_date_id` int(10) NOT NULL,
  `product_start_date` date NOT NULL,
  `product_end_date` date NOT NULL,
  `product_create_date` date NOT NULL,
  `product_id` varchar(300) NOT NULL,
  `good_RefNo` varchar(20) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(45, '120', '0', 45),
(46, '450', '0', 46),
(47, '50', '0', 47),
(48, '1000', '0', 48),
(49, '420', '0', 49),
(50, '340', '0', 50),
(51, '760', '0', 51),
(52, '2400', '0', 52),
(53, '7800', '0', 53),
(54, '220', '0', 54),
(55, '320', '0', 55),
(56, '100', '0', 56),
(57, '10', '0', 57),
(58, '120', '0', 58),
(59, '230', '0', 59),
(60, '70', '0', 60),
(61, '550', '600', 61),
(62, '285', '0', 62),
(63, '230', '0', 63),
(64, '80', '0', 64),
(65, '120', '0', 65);

-- --------------------------------------------------------

--
-- Table structure for table `product_quantity`
--

CREATE TABLE `product_quantity` (
  `product_quantity_id` int(10) NOT NULL,
  `product_quantity` varchar(300) NOT NULL,
  `good_RefNo` varchar(300) NOT NULL,
  `product_id` varchar(300) NOT NULL,
  `po_RefNo` varchar(300) NOT NULL,
  `status` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_quantity`
--

INSERT INTO `product_quantity` (`product_quantity_id`, `product_quantity`, `good_RefNo`, `product_id`, `po_RefNo`, `status`) VALUES
(81, '', '', '54', 'PO-noks0zf8blv7', ''),
(82, '', '', '57', 'PO-noks0zf8blv7', ''),
(83, '', '', '61', 'PO-noks0zf8blv7', ''),
(84, '', '', '59', 'PO-noks0zf8blv7', ''),
(85, '', '', '49', 'PO-noks0zf8blv7', ''),
(86, '', '', '65', 'PO-noks0zf8blv7', ''),
(87, '', '', '55', 'PO-noks0zf8blv7', '');

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
(40, '45', '100'),
(41, '46', '20'),
(42, '47', '30'),
(43, '48', '5'),
(44, '49', '20'),
(45, '50', '30'),
(46, '51', '20'),
(47, '52', '20'),
(48, '53', '5'),
(49, '54', '20'),
(50, '55', '20'),
(51, '56', '60'),
(52, '57', '100'),
(53, '58', '30'),
(54, '59', '30'),
(55, '60', '30'),
(56, '61', '20'),
(57, '62', '20'),
(58, '63', '30'),
(59, '64', '30'),
(60, '65', '20');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `sales_RefNo` varchar(300) NOT NULL,
  `sales_date` date NOT NULL,
  `sales_get` varchar(300) NOT NULL,
  `sales_change` varchar(300) NOT NULL,
  `product_total` varchar(300) NOT NULL,
  `product_id` varchar(300) NOT NULL,
  `customer_id` varchar(300) NOT NULL,
  `product_quantity` varchar(300) NOT NULL,
  `user_login` varchar(300) NOT NULL
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
(2, 'บริษัท ยา จำกัด', 'บริษัท ยา จำกัด', '0641318885', 'ya.ha@gmail.co.th');

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
(14, 'ชื้น'),
(15, 'กระปุก');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_stock`
-- (See below for the actual view)
--
CREATE TABLE `view_stock` (
`product_id` int(10)
,`product_name` varchar(300)
,`product_start_date` date
,`product_end_date` date
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
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

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
  MODIFY `employee_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `goods`
--
ALTER TABLE `goods`
  MODIFY `good_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `goods_detailproduct`
--
ALTER TABLE `goods_detailproduct`
  MODIFY `goods_detailproid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `po`
--
ALTER TABLE `po`
  MODIFY `po_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสการสั่งซื้อ', AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `po_detailproduct`
--
ALTER TABLE `po_detailproduct`
  MODIFY `po_detailproid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `po_status`
--
ALTER TABLE `po_status`
  MODIFY `po_status_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `product_date`
--
ALTER TABLE `product_date`
  MODIFY `product_date_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `product_price`
--
ALTER TABLE `product_price`
  MODIFY `product_price_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `product_quantity`
--
ALTER TABLE `product_quantity`
  MODIFY `product_quantity_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT for table `product_reorder`
--
ALTER TABLE `product_reorder`
  MODIFY `product_reorder_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
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
  MODIFY `unit_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
