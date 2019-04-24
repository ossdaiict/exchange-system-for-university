-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 24, 2019 at 09:00 AM
-- Server version: 10.3.14-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id9316805_campus_exchange`
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
('Household', 'all household like mattress, lamp,bucket etc.', 'name of thing'),
('Others', 'Anything that can\'t be included in all other categories.', 'name,type,price'),
('Sports', 'all sports items like basketball, cricket bat etc.', 'brand, name, type etc.'),
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
  `return_window` tinyint(4) NOT NULL DEFAULT 0,
  `is_negotiable` tinyint(4) NOT NULL,
  `product_status` tinyint(4) NOT NULL DEFAULT 0,
  `report_status` tinyint(4) NOT NULL DEFAULT 0,
  `category` varchar(50) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `expiry_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `seller_id`, `main_image`, `name`, `description`, `price`, `return_window`, `is_negotiable`, `product_status`, `report_status`, `category`, `date_added`, `expiry_date`) VALUES
(1, 201801210, 'sj7.jpg', 'Samsung J9', '1 year old Samsung J9. In excellent condition', 8000, 0, 0, 0, 1, 'Electronics', '2019-04-08 11:25:21', '0000-00-00 00:00:00'),
(2, 201812028, 'dm.jpg', 'Descrete Mathematics', 'math book for DM course', 200, 0, 0, 3, 1, 'Stationery', '2019-04-09 11:25:21', '2019-07-15 08:37:50'),
(3, 201812107, 'iphone.png', 'Apple Iphone 6', 'second hand Iphone 6', 10000, 0, 0, 3, 0, 'Electronics', '2019-04-09 09:45:23', '0000-00-00 00:00:00'),
(4, 201811054, 'dell.jpg', 'Dell Laptop', 'Dell Laptop', 20000, 0, 0, 2, 0, 'Electronics', '2019-04-09 09:51:43', '0000-00-00 00:00:00'),
(5, 201811075, 'gonegirl.jpg', 'Gone Girl', 'Novel at half price', 150, 0, 0, 3, 0, 'Stationery', '2019-04-09 09:58:41', '0000-00-00 00:00:00'),
(6, 201812005, 'calculator.jpg', 'Scientific Calculator', 'Casio Scientific Calculator', 0, 0, 0, 2, 1, 'Stationery', '2019-04-09 10:03:00', '0000-00-00 00:00:00'),
(7, 201812028, 'journal.jpg', 'Black Vintage Journal', 'Blank Journal with vintage type pages', 200, 0, 0, 0, 2, 'Stationery', '2019-04-09 18:54:16', '2019-07-15 13:37:50'),
(8, 201812028, 'brainwavz.jpg', 'BrainWavz Earphones', 'second-hand brainwavz earphone ', 500, 0, 0, 3, 0, 'Electronics', '2019-04-09 18:56:26', '2019-07-14 13:37:13'),
(9, 201812107, 'macbookpro.jpg', 'Macbook Pro', 'Second hand 9 months old Macbook Pro with Retina Display.', 60000, 4, 0, 0, 0, 'Electronics', '2019-04-15 23:33:09', '0000-00-00 00:00:00'),
(10, 201812028, 'bucket1.jpg', 'Bucket ', 'Bucket for free', 0, 0, 0, 2, 0, 'Household', '2019-03-21 06:04:26', '2019-07-15 08:37:02'),
(11, 201801210, 'mattress.jpg', 'Mattress', 'hard mattress for reasonable price', 1000, 1, 0, 3, 0, 'Household', '2019-04-02 07:00:13', '0000-00-00 00:00:00'),
(12, 201812112, 'badminton.jpg', 'Badminton Racquet', 'Yonex Muscle Power 22 Plus Badminton Racquet in excellent condition', 500, 1, 1, 1, 1, 'Sports ', '2019-03-23 04:22:15', '0000-00-00 00:00:00'),
(13, 201801210, 'nokia.jpg', 'Nokia 7 Plus', 'Nokia 7 plus \r\n11 month old', 11500, 3, 0, 1, 1, 'Elctronics', '2019-04-02 14:56:00', '0000-00-00 00:00:00'),
(14, 201812117, 'lamp.jpeg', 'Table Lamp', 'Fitcharge Led rechargable study table lamp', 100, 0, 1, 1, 0, 'Others', '2019-04-16 08:06:36', '2019-07-21 12:07:06'),
(15, 201812028, 'laptoptable.jpg', 'Laptop Table', '6 month old Laptop table ', 700, 1, 1, 1, 1, 'Others', '2019-02-15 10:49:38', '2019-07-15 08:37:04'),
(16, 201601054, 'cricketkit.jpg', 'Cricket Kit', '5 month old Puma Starter Set Cricket set', 2500, 1, 0, 2, 0, 'Sports', '2019-03-13 18:30:00', '0000-00-00 00:00:00'),
(17, 201812112, 'cycle.jpg', 'Hero Cycle', '2 year old Hero Sprint RX1 26T Single Speed Cycle(Black Color).\r\nIs in good condition', 3600, 1, 1, 3, 0, 'Sports', '2019-01-26 08:01:49', '0000-00-00 00:00:00'),
(18, 201812115, 'hppillow.jpg', 'Cushions', 'Harry Potter cushions', 0, 0, 0, 1, 0, 'Household', '2019-02-15 18:30:00', '2019-04-15 18:30:00'),
(19, 201812005, 'pillow.jpg', 'Pillows', '2 Bombay Dyeing', 0, 0, 0, 2, 0, 'Household', '2019-03-12 04:56:26', '2019-06-12 05:58:28'),
(20, 201812005, 'watch.jpg', 'Casio Watch', 'Casio Outdoor Digital Black Dial Men\'s Watch\r\n2 year old\r\nIn excellent condition with no scratch. ', 1000, 1, 1, 0, 0, 'Others', '2019-01-05 06:57:29', '2019-05-05 05:58:32'),
(21, 201801055, 'ita.jpg', 'Introduction to Algorithms', 'CLRS latest edition in best condition', 300, 0, 1, 3, 0, 'Stationery', '2019-04-17 07:30:00', '2019-07-16 18:30:00'),
(22, 201801210, 'notes.jpg', 'Discrete Math notes ', 'Handwritten note of Gagan Sir\'s DM class', 0, 0, 0, 0, 0, 'Stationery', '2019-03-13 10:52:30', '2019-07-13 01:53:21'),
(23, 201811054, 'football.jpg', 'Nivia Football', 'second hand Nivia Shining Star-2022 Football of size 5. ', 0, 0, 0, 2, 0, 'Sports', '2019-04-04 18:30:00', '2019-07-05 03:54:25'),
(25, 201801055, 'shoerack.jpg', 'Shoe Rack', 'PAffy 5-Layer Cloth Cabinet Shoe Rack Organiser.\r\nGrey color.\r\n6 months old', 100, 0, 0, 0, 0, 'Household', '2018-12-30 05:30:00', '2019-04-30 05:30:00'),
(28, 201812028, 'dumbbells.jpg', 'Dumbbells', 'Protoner Dumbbells Set of 2.\r\nNot used much.', 100, 0, 0, 0, 0, 'Sports', '2019-02-03 01:40:17', '2019-05-03 01:40:17'),
(34, 201812028, '022809b400079f1b632efdf55f7f4a6d.jpg', 'BAdmintON RACKET', 'Stylish Badminton Racket', 400, 0, 0, 1, 0, 'Sports', '2019-04-16 17:39:39', '2019-07-15 13:37:39'),
(35, 201812052, 'd4fb6205e492053e7736b9cf43035577.jpg', 'Earphone Case', 'A Fancy, Angry Birds earphones case', 1, 0, 0, 3, 0, 'Others', '2019-04-22 12:28:39', '2019-07-21 12:07:39'),
(36, 201812117, '0a156913597c3ee9d52230fd2c37c570.jpg', '40/40', 'A purple 2 months old bottle', 100, 3, 1, 3, 0, 'Others', '2019-04-22 12:39:11', '2019-07-21 12:07:11'),
(37, 201812090, '21cc2041741d0f87d73ba016bc24ac3d.png', 'Iphone x', '64 gb storage . Only 9months old.', 67000, 0, 0, 0, 0, 'Electronics', '2019-04-22 17:01:38', '2019-07-21 17:07:38'),
(38, 201812082, 'e421b64261dc380e3eeaaf28aba47664.jpg', 'pilot pen', 'green pen', 50, 3, 0, 0, 0, 'Stationery', '2019-04-23 12:16:38', '2019-07-22 12:07:38');

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
(1, 'sj71.jpg'),
(1, 'sj72.jpg'),
(2, 'dm1.jpg'),
(2, 'dm2.jpg'),
(3, 'iphone1.jpg'),
(3, 'iphone2.jpg'),
(3, 'iphone3.jpg'),
(4, 'dell1.jpg'),
(4, 'dell2.jpg'),
(5, 'gonegirl1.jpg'),
(5, 'gonegirl2.jpg'),
(6, 'calculator1.jpg'),
(6, 'calculator2.jpg'),
(7, 'journal1.jpg'),
(7, 'journal2.jpg'),
(7, 'journal3.jpg'),
(8, 'brainwavz1.jpg'),
(8, 'brainwavz2.jpg'),
(8, 'brainwavz3.jpg'),
(9, 'macbookpro1.png'),
(9, 'macbookpro2.jpg'),
(9, 'macbookpro3.jpg'),
(9, 'macbookpro4.jpg'),
(10, 'bucket2.jpg'),
(11, 'mattress1.jpg'),
(11, 'mattress2.jpg'),
(12, 'badminton1.jpg'),
(12, 'badminton2.jpg'),
(12, 'badminton3.jpg'),
(13, 'nokia1.jpg'),
(13, 'nokia2.jpg'),
(13, 'nokia3.jpg'),
(14, 'lamp1.jpeg'),
(14, 'lamp2.png'),
(14, 'nokia4.png'),
(15, 'laptoptable1.jpg'),
(15, 'laptoptable2.jpg'),
(15, 'laptoptable3.jpg'),
(16, 'cricketkit1.jpg'),
(16, 'cricketkit2.png'),
(16, 'cricketkit3.jpg'),
(16, 'cricketkit4.jpg'),
(17, 'cycle1.jpg'),
(17, 'cycle2.jpg'),
(18, 'hppillow1.jpg'),
(18, 'hppillow2.jpg'),
(18, 'hppillow3.jpg'),
(18, 'hppillow4.jpg'),
(19, 'pillow1.jpg'),
(19, 'pillow2.jpg'),
(20, 'watch1.jpg'),
(20, 'watch2.jpg'),
(20, 'watch3.jpg'),
(20, 'watch4.jpg'),
(21, 'ita1.jpg'),
(21, 'ita2.jpg'),
(21, 'ita3.jpg'),
(22, 'notes1.jpg'),
(22, 'notes2.jpg'),
(23, 'football1.jpg'),
(23, 'football2.jpg'),
(23, 'football3.jpg'),
(24, 'dumbbells1.jpg'),
(24, 'dumbbells2.jpg'),
(24, 'dumbbells3.jpg'),
(25, 'shoerack1.jpg'),
(25, 'shoerack2.jpg'),
(25, 'shoerack3.jpg'),
(29, '854c85bca95b98dfee7ff5626096fb2b.jpg'),
(30, 'e14dd945d39641f0f6d198c49e69eedd.jpg'),
(31, '07c8a6c35cf6dc42c00755e364338821.jpg'),
(32, '606cd8748a317f80d45a8f97f574734f.jpg'),
(33, '6c92a34daebdc9f766c778fdf899b319.jpg'),
(34, 'e161dca98330d8f27786aee3aa8872b2.jpg'),
(35, 'e3071dd364570dd655260d143c62d4a8.jpg'),
(37, 'b34130948bf64416938352b53f230c14.gif');

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
(201812028, 5, 'stolen'),
(201812028, 9, 'fake product'),
(201812090, 9, 'Fake product'),
(201812107, 1, 'bad product'),
(201812117, 9, 'stolen');

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
(3, 201812028, 10000, '2019-04-08 21:36:00'),
(5, 201812028, 100, '2019-04-16 17:45:23'),
(6, 201812028, 0, '2019-04-16 11:00:01'),
(8, 201812107, 500, '2019-04-03 08:03:16'),
(10, 201812112, 0, NULL),
(11, 201812028, 800, '2019-04-16 16:50:54'),
(12, 201812028, 400, NULL),
(14, 201812028, 100, NULL),
(15, 201812090, 600, NULL),
(17, 201812028, 3000, '2019-04-16 16:19:54'),
(21, 201812028, 300, '2019-04-16 16:26:06'),
(34, 201812090, 300, NULL),
(35, 201812117, 0, '2019-04-22 12:31:31'),
(36, 201812052, 50, '2019-04-22 14:00:56');

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
  `is_verified` tinyint(4) NOT NULL DEFAULT 0,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `expiry_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `contact_no`, `alternate_contact_no`, `photo`, `address`, `gender`, `verification_secret`, `is_verified`, `date_added`, `expiry_date`) VALUES
(201601054, 'Amar', '201601054@daiict.ac.in', 'qwerty123', '1234567890', NULL, 'a.svg', NULL, NULL, 'z7ds1Qg4B63P3RZj5yDfieCFMkvUTrKa', 1, '2019-04-03 05:03:47', '0000-00-00 00:00:00'),
(201701120, 'Amar', '201701120@daiict.ac.in', '7418520963', '7418527415', NULL, 'a.svg', NULL, NULL, 'OdILKlXxwq0czNWPiQ3pM7manZ6rDFsC', 1, '2019-04-09 09:22:51', '0000-00-00 00:00:00'),
(201801055, 'Queen', '201801055@daiict.ac.in', '7418520963', '8418520741', NULL, 'q.svg', NULL, NULL, 'b7ds1Qg4B20P3RZj5yDfiHCFMkvUTrKa', 1, '2019-04-09 09:26:47', '0000-00-00 00:00:00'),
(201801210, 'Akbar', '201701210@daiict.ac.in', '7418520963', '9638520741', NULL, 'a.svg', NULL, NULL, 'yRGzHcf8XPDSM9VtYLbC7usmdrEo6eW4', 1, '2019-04-09 09:23:25', '0000-00-00 00:00:00'),
(201811008, 'Shristi', '201811008@daiict.ac.in', 'qwerty1234', '1234567891', NULL, 's.svg', NULL, NULL, 'yRGzHcf8XPDSM9VtYLbC7awolpEo6eW4', 1, '2019-04-09 05:46:56', '0000-00-00 00:00:00'),
(201811009, 'John', '201811009@daiict.ac.in', '7418520963', '7418520963', NULL, 'j.svg', NULL, NULL, 'AUzIHFWog0EXdlC8LSYtnrvN9Dmk4Gxj', 1, '2019-04-09 09:47:46', '0000-00-00 00:00:00'),
(201811054, 'Wester', '201811055@daiict.ac.in', '7418520963', '7417418520', NULL, 'w.svg', NULL, NULL, 'e0ROLKQi7dfEuYAjXk8hyTt6Hv9w2bGl', 1, '2019-04-09 09:26:03', '0000-00-00 00:00:00'),
(201811075, 'Anthony', '201811075@daiict.ac.in', '7418520963', '7894561230', NULL, 'a.svg', NULL, NULL, 'Hq0sPo5cgdtGiRBLZmkQa74A1MS936uT', 1, '2019-04-09 09:24:01', '0000-00-00 00:00:00'),
(201812005, 'Karan', '201812005@daiict.ac.in', '7418520963', '7418520741', NULL, 's.svg', NULL, NULL, '8BTrVgNijvGRzpKO3A0te1EZPIsQduFl', 1, '2019-04-09 09:21:52', '0000-00-00 00:00:00'),
(201812028, 'Harsh', '201812028@daiict.ac.in', '7418520963', '9638520741', '', '27ab207207da1cc8ec57735ddd354f9b.jpg', '', 0, 'jAgpDQ7VexHiOqsRGyrCntTfM802wIJd', 1, '2019-04-09 09:16:05', '0000-00-00 00:00:00'),
(201812052, 'Dhwani', '201812052@daiict.ac.in', 'dhwani12', '9638520741', '', '2980d4fea4bbfc42eda9d44d6d242b55.jpg', '', 1, 'ep4GqX1lms6xY9vui7JRdjrkLZIBQOPE', 1, '2019-04-22 12:14:01', '0000-00-00 00:00:00'),
(201812058, 'Sneha Singh', '201812058@daiict.ac.in', 'ces12345', '9725789621', NULL, 's.svg', NULL, NULL, 'hl0R5IxwszMy4NEBoLZqdptrVmQ6vYfS', 0, '2019-04-22 14:38:12', '0000-00-00 00:00:00'),
(201812082, 'richa', '201812082@daiict.ac.in', '123456789', '1234567891', '', 'r.svg', '', 1, 'a3Tr6nhpm29yUkdlGqoCDML4bjxAzNfi', 1, '2019-04-23 03:30:56', '0000-00-00 00:00:00'),
(201812090, 'Chanchal singhal', '201812090@daiict.ac.in', '23456789', '1234567890', '', 'c.svg', '', 1, 'clNw7MZARI35rCt1BLdu8qj0kHp2PVhi', 1, '2019-04-22 16:49:07', '0000-00-00 00:00:00'),
(201812107, 'Harshi', '201812107@daiict.ac.in', 'qwerty1234', '7418520963', '', 'h.svg', '', 1, 'jAbpDQ7VexHwOqsRGyrCntTfM802wIJd', 1, '2019-04-09 19:07:46', '0000-00-00 00:00:00'),
(201812112, 'Vardhan', '201812112@daiict.ac.in', '7418520963', '7418520963', NULL, 'v.svg', NULL, NULL, '5GquKTxe2gJjEzIUmAiXbf019wvBOCon', 1, '2019-04-09 09:02:34', '0000-00-00 00:00:00'),
(201812115, 'team007', '201812115@daiict.ac.in', '7418520963', '7875856984', NULL, 't.svg', NULL, NULL, 'MEjwTq93F5h2uUtyS8kV4coa16JDsIHZ', 1, '2019-04-09 09:14:06', '0000-00-00 00:00:00'),
(201812117, 'Bhoomi', '201812117@daiict.ac.in', 'BHOOMICH', '9876543212', '', 'b.svg', '', 1, 'yhFiCrxKjt5ezUvaqXguI7oJc3bYAmEn', 1, '2019-04-22 12:26:01', '0000-00-00 00:00:00'),
(201814004, 'Mohit', '201814004@daiict.ac.in', 'qwerty123', '1234567890', NULL, 'm.svg', NULL, NULL, 'jAbpDQ7VexHwOqsRGyrCntTfM832weyu', 1, '2019-04-01 11:50:11', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_review`
--

CREATE TABLE `user_review` (
  `buyer_id` int(9) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `review` varchar(500) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_review`
--

INSERT INTO `user_review` (`buyer_id`, `product_id`, `rating`, `review`, `date_added`) VALUES
(201812028, 3, 5, '', '2019-04-16 10:38:35'),
(201812028, 17, 5, '', '2019-04-16 16:20:51'),
(201812028, 21, 5, '', '2019-04-16 16:38:58'),
(201812052, 36, 4, 'Trusted Seller', '2019-04-22 14:02:44'),
(201812107, 8, 5, 'Nice product', '2019-04-16 17:49:48'),
(201812107, 80, 4, 'great deal', '2019-04-12 08:33:10'),
(201812107, 81, 3, 'had a great deal', '2019-04-12 10:28:45'),
(201812117, 35, 5, 'MEOW', '2019-04-22 14:03:27');

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
(201812028, 6),
(201812028, 9),
(201812028, 11),
(201812028, 12),
(201812028, 14),
(201812028, 17),
(201812028, 20),
(201812028, 21),
(201812052, 4),
(201812052, 9),
(201812052, 34),
(201812052, 36),
(201812082, 10),
(201812082, 19),
(201812082, 25),
(201812082, 37),
(201812090, 15),
(201812090, 28),
(201812090, 34),
(201812107, 36),
(201812112, 5),
(201812112, 10),
(201812117, 35);

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
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
