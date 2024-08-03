-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2024 at 04:40 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eshopup`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `bank` text NOT NULL,
  `title` text NOT NULL,
  `ac_num` text NOT NULL,
  `transfer_content` text NOT NULL,
  `img` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `bank`, `title`, `ac_num`, `transfer_content`, `img`, `date`) VALUES
(10, 'Meezan Bank - Liberty Roundabout Branch, Lahore', 'SHAHBAZ AKHTAR JAVED', 'IBAN: PK29 MEZN 0011 5401 0563 3577', 'VIA88 814', 'admin@gmail.com.580017156.jpeg', '2023-11-18 12:35:44');

-- --------------------------------------------------------

--
-- Table structure for table `athentication`
--

CREATE TABLE `athentication` (
  `id` int(11) NOT NULL,
  `site_name` text NOT NULL,
  `site_logo` text NOT NULL,
  `usdt_address` text NOT NULL,
  `site_notice` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `athentication`
--

INSERT INTO `athentication` (`id`, `site_name`, `site_logo`, `usdt_address`, `site_notice`, `date`) VALUES
(1, 'Site Demo', '534794676.png', 'test_EKm3aFddHE2wwdgnpiRzJ6W_On-99t5UfqdnggfH-tLst4atGq', '👉 Product on the website are for ADVERTISING purposes only. Customers have acts of violating the law of Vietnamese, we do not take any responsibility!.\r\n<br>\r\n🔥 If you have not used similar goods or pure white, please do not buy them directly！！！Contact the customer service for consultation before placing an order.\r\n<br>\r\n🔥 The commodity details page has a detailed description of the account number and after-sales rules. Please read （ click on info button [i] and automatically jump to the commodity details page ）\r\n<br>\r\n⭐ Accounts purchased on the website are absolutely confidential. However, for safety purposes, You Should Change Your Account Password and Email Password After the Warranty Expires.\r\n<br>\r\n❗ Do not use the Forgot Password feature to recover your Facebook account when you cannot log in because it will make the account locked for 30 days (Have problem login please contact support).\r\n<br>\r\n❗ Do not use virtual cards, cards of unknown origin. Adding shoddy cards to an account carries a high risk of account being disabled.\r\n<br>\r\n👉  Can use www.easyme.pro/hotmail to read hotmailbox and take code (easyme.pro is product of maxvia88 so all your data safe here)!!\r\n<br>\r\n👉 24 hours after purchasing the account, You Can Change Your Account Password Here. without worrying about being locked for 30 days.\r\n<br>\r\n👉⁇ After-sales process：Provide the order number + question interception + complete account information （ with the latest password information ）or BM ！！\r\n<br>\r\n👉 We often use Telegram t.me/benjamin8809 for customer support. Any problem will be solved when we are online. If we haven\'t replied yet, don\'t worry, as soon as we\'re online we\'ll take care of it for you.\r\n<br>\r\n👤 𝐇𝐨𝐭𝐥𝐢𝐧𝐞/𝐙𝐚𝐥𝐨 𝐀𝐝𝐦𝐢𝐧 (Handling recharge and warranty): 093.222.0202 (Call directly if the message is not receive).\r\n<br>\r\n⏱  Our working time is from 10AM - 1AM the next day. Time zone GMT+7 Bangkok. In addition to the above working time, you can still recharge automatically and make purchases 24/7.', '2023-11-25 02:51:24');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `img` text NOT NULL,
  `email` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `name`, `description`, `img`, `email`, `date`) VALUES
(2, ' What is VIA 902 Greentick 3 lines - VIA XMDT Greentick 2 lines', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.2.Clone = New Facebook profile create by computer 1-30 day ago, it not real and only use for create BM, Ads, Page', '', 'admin@gmail.com', '2023-11-24 02:22:51'),
(3, ' How To Create Identity_Card For Facebook ??', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.', 'admin@gmail.com.1068463416.jpg', 'admin@gmail.com', '2023-11-24 02:20:39');

-- --------------------------------------------------------

--
-- Table structure for table `credits`
--

CREATE TABLE `credits` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `total_amount` double NOT NULL,
  `bank` text NOT NULL,
  `payment_date` text NOT NULL,
  `payment_method` text NOT NULL,
  `status` text NOT NULL,
  `prof` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `credits`
--

INSERT INTO `credits` (`id`, `email`, `invoice_no`, `total_amount`, `bank`, `payment_date`, `payment_method`, `status`, `prof`, `date`) VALUES
(4, 'user@gmail.com', '1001', 8830, 'Meezan Bank - Liberty Roundabout Branch, Lahore', '2023-11-24', 'Bank Transfer', 'UnVerified', 'user@gmail.com.1290886061.jpeg', '2023-11-24 02:21:58');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `orderid` varchar(255) NOT NULL,
  `status` text NOT NULL,
  `service` text NOT NULL,
  `pro_id` text NOT NULL,
  `qty` text NOT NULL,
  `price` double NOT NULL,
  `totalprice` double NOT NULL,
  `email` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `stack_qty` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stack_qty`, `service_id`, `date`) VALUES
(17, 'Via Foreign Co Random XMDT V1 (Argentina, Colombia, Australia, Ecuador...)', 'The Listed below are included in the Product', 5, 3, 105, '2023-11-23 12:34:10'),
(18, 'Via Ngoại New Random XMDT V1 (Argentina, Colombia, Australia, Ecuador...)', 'The Listed below are included in the Product\r\n', 15, 4, 105, '2023-11-23 06:42:37'),
(19, 'Via Hide XMDT (Hide Greentick 2 lines) [New]', 'The Listed below are included in the Product:', 20, 4, 105, '2023-11-23 06:42:45'),
(20, 'Via Philippines 902 (Greentick 3 lines Philippines)', 'The Listed below are included in the Product\r\n', 10, 4, 107, '2023-11-23 06:42:45');

-- --------------------------------------------------------

--
-- Table structure for table `products_features`
--

CREATE TABLE `products_features` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `pro_id` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_features`
--

INSERT INTO `products_features` (`id`, `name`, `pro_id`, `date`) VALUES
(1, 'Test 01', '13', '2023-11-21 17:18:56'),
(2, 'Test 02', '13', '2023-11-21 17:18:56'),
(3, 'Test 03', '13', '2023-11-21 17:18:56'),
(4, 'Test 04', '13', '2023-11-21 17:18:56'),
(5, 'Test 01', '14', '2023-11-21 17:51:42'),
(6, 'Test 02', '14', '2023-11-21 17:51:43'),
(7, '', '15', '2023-11-22 02:25:51'),
(8, 'Via Hide XMDT (Hide Greentick 2 lines) [New] ', '15', '2023-11-22 02:25:51'),
(9, 'Via Hide XMDT (Hide Greentick 2 lines) [New] ', '15', '2023-11-22 02:25:51'),
(10, 'Via Hide XMDT (Hide Greentick 2 lines) [New] ', '15', '2023-11-22 02:25:51'),
(11, 'Via Hide XMDT (Hide Greentick 2 lines) [New] ', '15', '2023-11-22 02:25:51'),
(12, 'Via Hide XMDT (Hide Greentick 2 lines) [Old]', '16', '2023-11-22 02:26:36'),
(13, 'Via Hide XMDT (Hide Greentick 2 lines) [Old]', '16', '2023-11-22 02:26:36'),
(14, 'Via Hide XMDT (Hide Greentick 2 lines) [Old]', '16', '2023-11-22 02:26:36'),
(15, 'Via Hide XMDT (Hide Greentick 2 lines) [Old]', '16', '2023-11-22 02:26:36'),
(16, 'Via Hide XMDT (Hide Greentick 2 lines) [Old]', '16', '2023-11-22 02:26:36'),
(17, ' Checkpoint Mail', '17', '2023-11-22 02:41:32'),
(18, ' Advertising Access Reinstated', '17', '2023-11-22 02:41:32'),
(19, ' Country Argentina, Colombia, Australia...', '17', '2023-11-22 02:41:32'),
(20, ' Can change currency,country, timezone', '17', '2023-11-22 02:41:32'),
(21, ' Created 2008-2020', '17', '2023-11-22 02:41:32'),
(22, ' Checkpoint Mail', '18', '2023-11-22 02:43:28'),
(23, ' Advertising Access Reinstated', '18', '2023-11-22 02:43:28'),
(24, ' Country Argentina, Colombia, Australia...', '18', '2023-11-22 02:43:28'),
(25, ' Can change currency,country, timezone', '18', '2023-11-22 02:43:28'),
(26, ' Created 2021-2022', '18', '2023-11-22 02:43:28'),
(27, ' Identity verification successful', '19', '2023-11-22 02:45:10'),
(28, ' Use pending review Page, BM, Ads', '19', '2023-11-22 02:45:10'),
(29, ' 100% can accept share ads', '19', '2023-11-22 02:45:10'),
(30, ' Checkpoit Mail', '19', '2023-11-22 02:45:10'),
(31, ' Created 2020-2022', '19', '2023-11-22 02:45:10'),
(32, ' Hide Greentick (Hide Greentick)', '19', '2023-11-22 02:45:10'),
(33, ' Checkpoint mail', '20', '2023-11-22 02:47:04'),
(34, ' 2008-2022', '20', '2023-11-22 02:47:05'),
(35, ' Advertising access reinstated', '20', '2023-11-22 02:47:05'),
(36, ' Country Philippines', '20', '2023-11-22 02:47:05'),
(37, ' Bao check tích 902', '20', '2023-11-22 02:47:05'),
(38, ' LIVE ads', '20', '2023-11-22 02:47:05'),
(39, ' Full format', '20', '2023-11-22 02:47:05');

-- --------------------------------------------------------

--
-- Table structure for table `product_uploads`
--

CREATE TABLE `product_uploads` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `pro_id` int(11) NOT NULL,
  `email` text NOT NULL,
  `orderid` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_uploads`
--

INSERT INTO `product_uploads` (`id`, `name`, `pro_id`, `email`, `orderid`, `date`) VALUES
(32, '1576322030-15-1700619959.png', 15, '', '', '2023-11-22 02:25:59'),
(33, '874253224-15-1700619959.png', 15, '', '', '2023-11-22 02:25:59'),
(34, '2054634895-15-1700619959.jpg', 15, '', '', '2023-11-22 02:25:59'),
(35, '353737960-16-1700620009.jpeg', 16, '', '', '2023-11-22 02:26:49'),
(36, '679513982-16-1700620009.jpeg', 16, '', '', '2023-11-22 02:26:49'),
(37, '285681915-17-1700620937.jpg', 17, '', '', '2023-11-23 13:02:17'),
(38, '1399915066-17-1700620937.jpg', 17, '', '', '2023-11-23 06:42:23'),
(39, '903412658-18-1700621016.jfif', 18, '', '', '2023-11-23 06:42:23'),
(40, '1717694435-18-1700621016.jfif', 18, '', '', '2023-11-23 06:42:23'),
(41, '1529764496-19-1700621117.jfif', 19, '', '', '2023-11-23 06:42:23'),
(42, '688071896-19-1700621117.jfif', 19, '', '', '2023-11-23 06:42:23'),
(44, '1538513314-20-1700621232.jpg', 20, '', '', '2023-11-23 06:42:23'),
(45, '907495236--1700716667.jpg', 20, '', '', '2023-11-23 05:17:47'),
(48, '670496875-18-1700718610.jpg', 18, '', '', '2023-11-23 06:42:23');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `img` text NOT NULL,
  `status` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `img`, `status`, `date`) VALUES
(105, 'VIA XMDT', 'admin@gmail.com.1755955525.png', 'Active', '2023-11-19 05:28:23'),
(107, 'VIA 902', 'admin@gmail.com.1490066166.png', 'Active', '2023-11-23 05:53:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `img` text NOT NULL,
  `phone` text NOT NULL,
  `role` text NOT NULL,
  `status` text NOT NULL,
  `wallet` double NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `img`, `phone`, `role`, `status`, `wallet`, `date`) VALUES
(36, 'Shahbaz Akhtar', 'admin@gmail.com', '123456', 'admin@gmail.com.297879434.jpg', '3463806125', 'Admin', 'Active', 100, '2023-11-23 04:37:29'),
(37, 'Shahbaz Akhtar', 'user@gmail.com', '123456', 'user@gmail.com.1620146031.jpg', '03463806125', 'User', 'Active', 195, '2023-11-24 02:21:58'),
(39, 'New Admin', 'newadmin@gmail.com', '123456', '', '', 'Admin', 'Active', 0, '2023-11-18 07:01:22'),
(40, 'Abbas', 'abbas@gmail.com', '123456', '', '', 'User', 'UnVerified', 150, '2023-11-20 16:32:53'),
(41, 'Shahbaz Akhtar', 'shahbaz@gmail.com', '123456', '', '', 'User', 'Active', 0, '2023-11-23 05:54:39'),
(42, 'abbas', 'ali@gmail.com', '123456', '', '', 'Admin', 'Active', 0, '2023-11-20 16:39:23'),
(43, 'test', 'test@gmail.com', '123456', '', '', 'User', 'UnVerified', 0, '2023-11-24 07:38:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `athentication`
--
ALTER TABLE `athentication`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credits`
--
ALTER TABLE `credits`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_no` (`invoice_no`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orderid` (`orderid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_features`
--
ALTER TABLE `products_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_uploads`
--
ALTER TABLE `product_uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `athentication`
--
ALTER TABLE `athentication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `credits`
--
ALTER TABLE `credits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products_features`
--
ALTER TABLE `products_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `product_uploads`
--
ALTER TABLE `product_uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
