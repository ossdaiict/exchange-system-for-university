-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2019 at 10:15 AM
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
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `category` varchar(50) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expiry_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `seller_id`, `main_image`, `name`, `description`, `price`, `status`, `category`, `date_added`, `expiry_date`) VALUES
(1, 201812028, 'sj7.jpg', 'Mobile', 'SamShit J9', 2, 0, 'Electronics', '2019-04-08 11:25:21', '0000-00-00 00:00:00'),
(2, 201812066, 'dm.jpg', 'Descrete Mathematics', 'math notes for DM course', 200, 0, 'Stationery', '2019-04-09 11:25:21', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `product_id` int(11) NOT NULL,
  `other_image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_report`
--

CREATE TABLE `product_report` (
  `reporter_id` int(9) NOT NULL,
  `product_id` int(11) NOT NULL,
  `reason` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `product_id` int(11) NOT NULL,
  `buyer_id` int(9) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `dateSold` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(201812028, 'harsh', '201812028@daiict.ac.in', '7418520963', '7418520963', NULL, NULL, NULL, NULL, '', 1, '2019-04-08 08:27:30', '0000-00-00 00:00:00'),
(201812032, 'team007', '201812032@daiict.ac.in', 'team007', '7418520963', NULL, NULL, NULL, NULL, '', 0, '2019-04-08 08:28:15', '0000-00-00 00:00:00'),
(201812033, 'john', '', '7418520963', '7418520963', NULL, NULL, NULL, NULL, 'zikU93uwGJmdoADLtRN6fqF8741xZOvc', 0, '2019-04-08 10:57:24', '0000-00-00 00:00:00'),
(741741852, 'asd', '', '7418952963963', '8520741963', NULL, NULL, NULL, NULL, '9Rflu5qdoBM6jIZEgyxTb7mwHLkQrnF4', 0, '2019-04-08 10:58:51', '0000-00-00 00:00:00'),
(852963741, 'asd', '', '741852963', '8520963741', NULL, NULL, NULL, NULL, 'PTjhebRYs329qfQC4lMcr8a5guILAvXZ', 0, '2019-04-08 11:00:57', '0000-00-00 00:00:00');

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

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `user_id` int(9) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`user_id`, `product_id`) VALUES
(201812028, 1);

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
  ADD PRIMARY KEY (`user_id`,`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
