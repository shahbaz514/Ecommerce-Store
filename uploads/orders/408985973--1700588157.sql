-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2023 at 07:55 AM
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
(9, 'EasyPaisa', 'Shahbaz Akhtar Javed', '03463806125', 'VIA88 814', 'admin@gmail.com.962140888.jpeg', '2023-11-18 12:16:52'),
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
(1, 'Site Demo', '1551398385.png', 'test_EKm3aFddHE2wwdgnpiRzJ6W_On-99t5UfqdnggfH-tLst4atGq', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.', '2023-11-21 05:52:15');

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
(1, 'user@gmail.com', '1001', 200, 'EasyPaisa', '19-11-2023', 'Bank Transfer', 'Verified', 'payment.jpeg', '2023-11-19 14:42:45'),
(2, 'user@gmail.com', '1002', 8830, 'Meezan Bank - Liberty Roundabout Branch, Lahore', '2023-11-16', 'Bank Transfer', 'UnVerified', 'user@gmail.com.2031713225.jpeg', '2023-11-19 16:11:41'),
(3, 'user@gmail.com', '1003', 8830, 'Meezan Bank - Liberty Roundabout Branch, Lahore', '2023-11-16', 'Bank Transfer', 'UnVerified', 'user@gmail.com.1069463735.jpeg', '2023-11-19 16:17:31');

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

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orderid`, `status`, `service`, `pro_id`, `qty`, `price`, `totalprice`, `email`, `date`) VALUES
(31, '1001', 'Completed', '105', '12', '1', 10, 10, 'user@gmail.com', '2023-11-21 06:45:17'),
(32, '1002', 'Completed', '105', '12', '2', 10, 20, 'user@gmail.com', '2023-11-21 06:45:34'),
(33, '1003', 'Completed', '107', '11', '1', 25, 25, 'user@gmail.com', '2023-11-21 06:48:10');

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
(11, 'Test03', 'Test 03', 25, 3, 107, '2023-11-21 06:48:10'),
(12, 'Test01', 'Test 01', 10, 1, 105, '2023-11-21 06:45:34');

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
(13, '1833346398-11-1700543092.jpg', 11, 'user@gmail.com', '1003', '2023-11-21 06:48:10'),
(14, '252608864-11-1700543092.jpg', 11, '', '', '2023-11-21 05:04:52'),
(15, '488942748-11-1700543093.jpg', 11, '', '', '2023-11-21 05:04:53'),
(16, '1802033325-11-1700543093.jpg', 11, '', '', '2023-11-21 05:04:53'),
(17, '1336489395-12-1700543383.jpg', 12, 'user@gmail.com', '1001', '2023-11-21 06:45:18'),
(18, '400011267-12-1700543383.jpg', 12, 'user@gmail.com', '1002', '2023-11-21 06:45:34'),
(19, '1413062204-12-1700543383.jpg', 12, 'user@gmail.com', '1002', '2023-11-21 06:45:34'),
(20, '1353797426-12-1700543383.jpg', 12, '', '', '2023-11-21 06:41:16');

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
(107, 'VIA 902', 'admin@gmail.com.1490066166.png', 'Active', '2023-11-18 10:24:03');

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
(36, 'Shahbaz Akhtar', 'admin@gmail.com', '123456', 'admin@gmail.com.297879434.jpg', '3463806125', 'Admin', 'Active', 100, '2023-11-18 06:02:39'),
(37, 'Shahbaz Akhtar', 'user@gmail.com', '123456', '', '', 'User', 'Active', 15, '2023-11-21 06:48:10'),
(39, 'New Admin', 'newadmin@gmail.com', '123456', '', '', 'Admin', 'Active', 0, '2023-11-18 07:01:22'),
(40, 'Abbas', 'abbas@gmail.com', '123456', '', '', 'User', 'UnVerified', 150, '2023-11-20 16:32:53'),
(41, 'Shahbaz Akhtar', 'shahbaz@gmail.com', '123456', '', '', 'User', 'Active', 0, '2023-11-20 16:38:56'),
(42, 'abbas', 'ali@gmail.com', '123456', '', '', 'Admin', 'Active', 0, '2023-11-20 16:39:23');

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
-- AUTO_INCREMENT for table `credits`
--
ALTER TABLE `credits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_uploads`
--
ALTER TABLE `product_uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
