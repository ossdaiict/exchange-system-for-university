-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2019 at 07:08 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `campus_exchange`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category` varchar(50) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `product_specification` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category`, `description`, `product_specification`) VALUES
('Electronics', 'All elecric/tronic related items like laptop, mobile etc', 'brand, purchase data, model etc'),
('Stationery', 'All items related to books, notes etc', 'Subject, author etc');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `seller_id` int(9) NOT NULL,
  `main_image` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `price` int(11) NOT NULL,
  `return_window` tinyint(4) NOT NULL DEFAULT '0',
  `is_negotiable` tinyint(4) NOT NULL,
  `product_status` tinyint(4) NOT NULL DEFAULT '0',
  `report_status` tinyint(4) NOT NULL DEFAULT '0',
  `category` varchar(50) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expiry_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `seller_id`, `main_image`, `name`, `description`, `price`, `return_window`, `is_negotiable`, `product_status`, `report_status`, `category`, `date_added`, `expiry_date`) VALUES
(1, 201800210, 'sj7.jpg', 'Mobile', 'SamShit J9', 2, 0, 0, 0, 1, 'Electronics', '2019-04-08 11:25:21', '0000-00-00 00:00:00'),
(2, 201801120, 'dm.jpg', 'Descrete Mathematics', 'math notes for DM course', 200, 0, 0, 0, 0, 'Stationery', '2019-04-09 11:25:21', '0000-00-00 00:00:00'),
(3, 201810055, 'iphone.png', 'Apple Iphone', 'IShit on discounted price', 1000, 0, 0, 1, 0, 'Electronics', '2019-04-09 09:45:23', '0000-00-00 00:00:00'),
(4, 201811054, 'dell.jpg', 'Dell Laptop', 'Dell Laptop', 20000, 0, 0, 1, 0, 'Electronics', '2019-04-09 09:51:43', '0000-00-00 00:00:00'),
(5, 201811075, 'gonegirl.jpg', 'Gone Girl', 'Novel at half price', 150, 0, 0, 2, 0, 'Stationery', '2019-04-09 09:58:41', '0000-00-00 00:00:00'),
(6, 201812005, 'calculator.jpg', 'Scientific Calculator', 'Scientific Shit', 900, 0, 0, 2, 2, 'Stationery', '2019-04-09 10:03:00', '0000-00-00 00:00:00'),
(7, 201812009, 'notebook1.jpg', 'Blank Notebook', 'blank notebooks of 250 pages', 200, 0, 0, 3, 0, 'Stationery', '2019-04-09 18:54:16', '0000-00-00 00:00:00'),
(8, 201812028, 'earphone.jpg', 'BrainWavz Earphones', 'second-hand brainwavz earphone ', 500, 0, 0, 0, 1, 'Stationery', '2019-04-09 18:56:26', '2019-07-14 13:37:13');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `product_id` int(11) NOT NULL,
  `other_image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`product_id`, `other_image`) VALUES
(0, ''),
(3, 'iphone1.jpg'),
(3, 'iphone2.jpg'),
(3, 'iphone3.jpg'),
(4, 'dell1.jpg'),
(4, 'dell2.jpg'),
(5, 'gonegirl1.jpg'),
(5, 'gonegirl2.jpg'),
(6, 'calculator1.jpg'),
(6, 'calculator2.jpg'),
(6, 'calculator3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_report`
--

CREATE TABLE `product_report` (
  `reporter_id` int(9) NOT NULL,
  `product_id` int(11) NOT NULL,
  `reason` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_report`
--

INSERT INTO `product_report` (`reporter_id`, `product_id`, `reason`) VALUES
(201812107, 1, 'bad product');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `product_id` int(11) NOT NULL,
  `buyer_id` int(9) NOT NULL,
  `final_price` int(11) DEFAULT NULL,
  `date_sold` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`product_id`, `buyer_id`, `final_price`, `date_sold`) VALUES
(3, 201812112, 1000, NULL),
(6, 201812117, 900, NULL),
(8, 201812107, 500, '2019-04-08 21:36:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(9) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `contact_no` varchar(12) NOT NULL,
  `alternate_contact_no` varchar(12) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `verification_secret` varchar(50) NOT NULL,
  `is_verified` tinyint(4) NOT NULL DEFAULT '0',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expiry_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `contact_no`, `alternate_contact_no`, `photo`, `address`, `gender`, `verification_secret`, `is_verified`, `date_added`, `expiry_date`) VALUES
(201800210, 'Akbar', '201800210@daiict.ac.in', '7418520963', '9638520741', NULL, 'a.svg', NULL, NULL, 'yRGzHcf8XPDSM9VtYLbC7usmdrEo6eW4', 1, '2019-04-09 09:23:25', '0000-00-00 00:00:00'),
(201801120, 'Amar', '201801120@daiict.ac.in', '7418520963', '7418527415', NULL, 'a.svg', NULL, NULL, 'OdILKlXxwq0czNWPiQ3pM7manZ6rDFsC', 1, '2019-04-09 09:22:51', '0000-00-00 00:00:00'),
(201810055, 'Queen', '201810055@daiict.ac.in', '7418520963', '8418520741', NULL, 'q.svg', NULL, NULL, 'b7ds1Qg4B20P3RZj5yDfiHCFMkvUTrKa', 1, '2019-04-09 09:26:47', '0000-00-00 00:00:00'),
(201811054, 'Wester', '201811055@daiict.ac.in', '7418520963', '7417418520', NULL, 'w.svg', NULL, NULL, 'e0ROLKQi7dfEuYAjXk8hyTt6Hv9w2bGl', 1, '2019-04-09 09:26:03', '0000-00-00 00:00:00'),
(201811075, 'Anthony', '201811075@daiict.ac.in', '7418520963', '7894561230', NULL, 'a.svg', NULL, NULL, 'Hq0sPo5cgdtGiRBLZmkQa74A1MS936uT', 1, '2019-04-09 09:24:01', '0000-00-00 00:00:00'),
(201812005, 'SDFFFCCS', '201812005@daiict.ac.in', '7418520963', '7418520741', NULL, 's.svg', NULL, NULL, '8BTrVgNijvGRzpKO3A0te1EZPIsQduFl', 1, '2019-04-09 09:21:52', '0000-00-00 00:00:00'),
(201812009, 'John', '201812009@daiict.ac.in', '7418520963', '7418520963', NULL, 'j.svg', NULL, NULL, 'AUzIHFWog0EXdlC8LSYtnrvN9Dmk4Gxj', 1, '2019-04-09 09:47:46', '0000-00-00 00:00:00'),
(201812028, 'Harsh22', '201812028@daiict.ac.in', '7418520963', '9638520741', '', NULL, '', 1, 'jAgpDQ7VexHiOqsRGyrCntTfM802wIJd', 1, '2019-04-09 09:16:05', '0000-00-00 00:00:00'),
(201812107, 'Harshi', '201812107@daiict.ac.in', '7418520963', '7418520963', NULL, 'h.svg', NULL, NULL, 'jAbpDQ7VexHwOqsRGyrCntTfM802wIJd', 1, '2019-04-09 19:07:46', '0000-00-00 00:00:00'),
(201812112, 'Vardhan', '201812112@daiict.ac.in', '7418520963', '7418520963', NULL, 'v.svg', NULL, NULL, '5GquKTxe2gJjEzIUmAiXbf019wvBOCon', 1, '2019-04-09 09:02:34', '0000-00-00 00:00:00'),
(201812115, 'team007', '201812115@daiict.ac.in', '7418520963', '7875856984', NULL, 't.svg', NULL, NULL, 'MEjwTq93F5h2uUtyS8kV4coa16JDsIHZ', 1, '2019-04-09 09:14:06', '0000-00-00 00:00:00'),
(201812117, 'Bhoomi', '201812117@daiict.ac.in', '7418520963', '7418520963', NULL, 'b.svg', NULL, NULL, 'lZeYJ1Mya3BTQzn5vSF0huI2xdbwC6t4', 1, '2019-04-09 09:16:37', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_review`
--

CREATE TABLE `user_review` (
  `buyer_id` int(9) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `review` varchar(500) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_review`
--

INSERT INTO `user_review` (`buyer_id`, `product_id`, `rating`, `review`, `date_added`) VALUES
(201812107, 80, 4, 'great deal', '2019-04-12 08:33:10'),
(201812107, 81, 3, 'had a great deal', '2019-04-12 10:28:45');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_user_id` int(9) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlist_user_id`, `product_id`) VALUES
(201801120, 4),
(201812028, 1),
(201812028, 3),
(201812028, 4),
(201812028, 5),
(201812112, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`product_id`,`other_image`);

--
-- Indexes for table `product_report`
--
ALTER TABLE `product_report`
  ADD PRIMARY KEY (`reporter_id`,`product_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`product_id`,`buyer_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_review`
--
ALTER TABLE `user_review`
  ADD PRIMARY KEY (`buyer_id`,`product_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_user_id`,`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
