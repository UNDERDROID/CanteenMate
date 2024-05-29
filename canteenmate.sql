-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2024 at 08:28 AM
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
('UNZIP', '12000', '2024-05-29 06:20:56', 'wvELQvdM3FXHzxNVQLPzAG');

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

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Item Name`, `Item Price`, `Quantity`, `Total Price`, `Ordered Time`, `User`, `Status`, `Payment`) VALUES
('Chicken Chow Mein', 120, 1, 120, '12:05:28', 'UNZIP', 'PENDING', 'Paid');

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
