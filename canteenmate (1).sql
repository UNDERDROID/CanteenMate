-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2024 at 05:40 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `canteenmate`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin Name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin Name`, `password`) VALUES
('admin', '$2y$10$bMO/M4HuRrYegut1U84bD.njHsJMTRtMfITtBwwdUNuCw.yqcRqCW');

-- --------------------------------------------------------

--
-- Table structure for table `esewa`
--

CREATE TABLE `esewa` (
  `Username` varchar(50) NOT NULL,
  `payment_id` varchar(100) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `esewa`
--

INSERT INTO `esewa` (`Username`, `payment_id`, `amount`, `Time`) VALUES
('UNZIP', 'UNZIP1720153007', '680', '2024-07-05 04:16:47');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `Name` varchar(30) NOT NULL,
  `Price` int(30) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`Name`, `Price`, `image`) VALUES
('7up', 50, 'img/7up.jfif'),
('Alfredo Pasta', 400, 'img/Alfredo Sauce - Love and Lemons.jfif'),
('Aloo Paratha', 150, 'img/Aloo Paratha _ Dhaba Style Aloo Paratha - Cooking From Heart.jfif'),
('Bagel Sandwich', 250, 'img/27 Bagel Breakfast Sandwich Ideas.jfif'),
('BBQ Chicken Pizza', 400, 'img/Cheesy BBQ Chicken Pizza.jfif'),
('Black Coffee', 30, 'img/BlackCoffee.png'),
('Buff Momo', 120, 'img/steamMOMO.png'),
('Chicken Biriyani', 250, 'img/Chicken Biriyani.jfif'),
('Chicken Chow Mein', 120, 'img/Chow Mein (Chinese Fried Noodles, 炒面).jfif'),
('Chicken Club Sandwich', 200, 'img/Het recept voor de allerlekkerste club sandwich.jfif'),
('Chicken Fried Rice', 110, 'img/ChickenFriedRice.jfif'),
('Chicken Quessadilla', 150, 'img/Spicy Chicken Quesadillas - Simply Delicious.jfif'),
('Chocolate Glazed Doughnut', 50, 'img/ChocolateGlazedDonut.jfif'),
('Coca Cola', 50, 'img/Coca Cola.png'),
('Crispy Chicken Burger', 250, 'img/Crispy Chicken Burger with Honey Mustard Coleslaw.png'),
('Croissant', 50, 'img/Croissants and strawberries featuring bake, bakery, and berry.jfif'),
('Jhol Momo', 200, 'img/[homemade] jhol momo.jfif'),
('Lemon Tea', 20, 'img/LemonTea.jfif'),
('Milk Tea', 30, 'img/MilkTea.jfif'),
('Mutton Biriyani', 350, 'img/Mutton Biriyani.jfif'),
('Samosa', 25, 'img/Samosa.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `khalti`
--

CREATE TABLE `khalti` (
  `Username` varchar(100) NOT NULL,
  `Amount` varchar(100) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Token` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `khalti`
--

INSERT INTO `khalti` (`Username`, `Amount`, `Time`, `Token`) VALUES
('UNZIP', '5000', '2024-05-29 06:17:45', '9pykZhM3AYGrC7tjrUzN3U'),
('UNZIP', '12000', '2024-05-29 06:20:56', 'wvELQvdM3FXHzxNVQLPzAG'),
('UNZIP', '12000', '2024-05-29 06:37:02', 'PMChbq5fMMB7g7N5jb9Bh3'),
('UNZIP', '5000', '2024-06-04 14:37:25', 'ecmUYzQaKDQcbPpByYZ95g'),
('UNZIP', '5000', '2024-06-04 15:39:21', 'Y94GwH6kackSKe9WnLNkJc'),
('UNZIP', '5000', '2024-06-04 15:45:34', 'ri8mteN4f3Lqr4cZjAg7r8'),
('UNZIP', '5000', '2024-06-04 16:01:49', 'dxM9pJGB47hSmwzxUTtYkn'),
('UNZIP', '5000', '2024-06-05 02:38:54', 'kvV2GGKFPMZCzteGsunkTT'),
('UNZIP', '5000', '2024-06-05 02:42:11', 'xFSQufMuuhKx5wDtRRHWJM'),
('UNZIP', '3000', '2024-06-05 02:46:42', 'aAsCyvipocYC4TDTDnCfoD'),
('UNZIP', '5000', '2024-06-05 02:51:28', 'nW5dbYrVvN5BGxPN5hps2P'),
('UNZIP', '5000', '2024-06-05 02:53:56', 'QQFdnYKgqdJfije5A6RCDM'),
('UNZIP', '5000', '2024-06-05 02:55:22', 'KdJuZtvtaKDbe557nZEJ9Q'),
('UNZIP', '5000', '2024-06-05 02:57:44', 'wAXChocrvZr6979UzoKSdc'),
('UNZIP', '5000', '2024-06-05 03:02:22', 'GAsmKvorUM7XoC9yFrsXY3'),
('UNZIP', '5000', '2024-06-05 03:09:58', 'd9ECuKzdUth7i8g8uwPbq8'),
('UNZIP', '5000', '2024-06-05 03:12:35', 'faGMg5UoCeHA4kuReCxbn5'),
('UNZIP', '5000', '2024-06-05 03:38:09', '4vjf42cCoZDXRpUmMFU9UR'),
('UNZIP', '5000', '2024-06-05 03:53:15', 'gw69tyXyrXfjLrbRdfUqB5'),
('UNZIP', '2000', '2024-06-05 04:01:41', 'B7qgtU57uQXfBftn5YetBD');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Item Name` varchar(50) NOT NULL,
  `Item Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Total Price` int(11) NOT NULL,
  `Ordered Time` time NOT NULL DEFAULT current_timestamp(),
  `User` varchar(50) NOT NULL,
  `Status` varchar(50) NOT NULL DEFAULT 'PENDING',
  `Payment` varchar(100) NOT NULL DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `date`) VALUES
(3, 'ROSHAN', '$2y$10$ilB0JA02r94BoxcyRuCeCukF1I7uFP.M9ehKLylU08GQxY5i14o3y', '2023-07-16 09:42:11'),
(4, 'UNZIP', '$2y$10$iA8deIsFeYcdq6FsIxILuO0AtjhufKvvEPgUJMMLVWtLeVO5XMp8.', '2023-10-21 14:35:59'),
(5, 'Cbum', '$2y$10$nlx7Oz4ryjBL//dPUt8SpOqH2YkUaLhNf3MCle/M7E1I5lU2ebsUS', '2023-10-22 14:34:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `esewa`
--
ALTER TABLE `esewa`
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD UNIQUE KEY `image` (`Name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
