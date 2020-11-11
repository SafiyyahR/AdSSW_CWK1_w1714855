-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 11, 2020 at 11:57 AM
-- Server version: 10.1.38-MariaDB
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
-- Database: `w1714855_0`
--

-- --------------------------------------------------------

--
-- Table structure for table `combo_meals`
--

CREATE TABLE `combo_meals` (
  `cm_id` int(5) UNSIGNED NOT NULL,
  `cm_name` varchar(350) NOT NULL,
  `cm_description` varchar(350) NOT NULL,
  `cm_no_small_pizza` int(11) NOT NULL DEFAULT '0',
  `cm_no_medium_pizza` int(11) NOT NULL DEFAULT '0',
  `cm_no_large_pizza` int(11) NOT NULL DEFAULT '0',
  `cm_no_side` int(11) NOT NULL DEFAULT '0',
  `cm_no_drink` int(11) NOT NULL DEFAULT '0',
  `cm_price` decimal(10,2) NOT NULL DEFAULT '2.50'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `combo_meals`
--

INSERT INTO `combo_meals` (`cm_id`, `cm_name`, `cm_description`, `cm_no_small_pizza`, `cm_no_medium_pizza`, `cm_no_large_pizza`, `cm_no_side`, `cm_no_drink`, `cm_price`) VALUES
(1, 'Family Deal', '2 large pizzas, 2 sides and a 2 1l drinks', 0, 0, 2, 2, 1, '30.00'),
(2, 'Couples Deal', '1 large pizza, 1 side and a 1l drink', 0, 0, 1, 1, 1, '15.75'),
(3, 'Game Night Deal', '3 large pizzas, 4 sides and 3 1l drinks', 0, 0, 3, 4, 3, '49.00'),
(4, 'Feast for 1', '1 medium pizza, 1 side and a 1l drink', 0, 1, 0, 1, 1, '12.00'),
(5, 'Favourite Deal', '3 small pizzas, 2 sides and a 1l drink', 3, 0, 0, 2, 1, '22.00'),
(6, 'Feast for 2', '2 medium pizzas, 2 sides and a 1l drink', 0, 2, 0, 2, 1, '23.40');

-- --------------------------------------------------------

--
-- Table structure for table `drinks`
--

CREATE TABLE `drinks` (
  `drink_id` int(5) UNSIGNED NOT NULL,
  `drink_name` varchar(100) NOT NULL,
  `drink_price` decimal(10,2) NOT NULL DEFAULT '1.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drinks`
--

INSERT INTO `drinks` (`drink_id`, `drink_name`, `drink_price`) VALUES
(1, 'Pepsi', '1.75'),
(2, 'Pepsi Max', '1.50'),
(3, 'Pepsi Diet', '1.25'),
(4, 'Tango', '1.50'),
(5, '7up Sugar Free', '0.75'),
(6, 'Bottled Water', '0.65');

-- --------------------------------------------------------

--
-- Table structure for table `pizza`
--

CREATE TABLE `pizza` (
  `pizza_id` int(5) UNSIGNED NOT NULL,
  `pizza_name` varchar(100) NOT NULL,
  `pizza_description` varchar(350) NOT NULL,
  `pizza_pr_small` decimal(10,2) NOT NULL DEFAULT '3.00',
  `pizza_pr_medium` decimal(10,2) NOT NULL DEFAULT '6.00',
  `pizza_pr_large` decimal(10,2) NOT NULL DEFAULT '10.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pizza`
--

INSERT INTO `pizza` (`pizza_id`, `pizza_name`, `pizza_description`, `pizza_pr_small`, `pizza_pr_medium`, `pizza_pr_large`) VALUES
(1, 'Margherita', 'Mozzarella Cheese and Tomato Sauce', '3.00', '6.00', '10.00'),
(2, 'Veggie Delight', 'Mushrooms, Mixed Peppers, Red Onions, Tomato, Mozzarella Cheese and Tomato Sauce', '3.00', '6.00', '10.00'),
(3, 'Pepperoni', 'Pepperoni, Mozzarella Cheese and Tomato Sauce', '4.00', '7.00', '11.00'),
(4, 'Meat Delight', 'Spicy Chicken, Pepperoni, Seasoned Minced Beef, Mozzarella Cheese and Tomato Sauce', '4.50', '8.00', '11.50'),
(5, 'BBQ Chicken', 'BBQ Sauce, Chicken,  Red Onions, Tomato and Mozzarella Cheese', '4.00', '7.50', '10.50'),
(6, 'Breakfast Special', 'Baked Beans, Cherry Tomatoes, Scrambled Eggs, Cheddar Cheese, Mushroom and Potato Tots', '4.50', '8.00', '11.50');

-- --------------------------------------------------------

--
-- Table structure for table `sides`
--

CREATE TABLE `sides` (
  `side_id` int(5) UNSIGNED NOT NULL,
  `side_name` varchar(100) NOT NULL,
  `side_price` decimal(10,2) NOT NULL DEFAULT '1.50'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sides`
--

INSERT INTO `sides` (`side_id`, `side_name`, `side_price`) VALUES
(1, 'Coleslaw', '2.50'),
(2, 'Bread Sticks', '3.20'),
(3, 'Garlic Bread', '1.50'),
(4, 'Onion Rings', '2.50'),
(5, 'Potato Wedges', '2.00'),
(6, 'Mozzarella Sticks', '4.50');

-- --------------------------------------------------------

--
-- Table structure for table `toppings`
--

CREATE TABLE `toppings` (
  `topping_id` int(5) UNSIGNED NOT NULL,
  `topping_name` varchar(100) NOT NULL,
  `topping_pr_small` decimal(10,2) NOT NULL DEFAULT '0.50',
  `topping_pr_medium` decimal(10,2) NOT NULL DEFAULT '1.00',
  `topping_pr_large` decimal(10,2) NOT NULL DEFAULT '1.50'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `toppings`
--

INSERT INTO `toppings` (`topping_id`, `topping_name`, `topping_pr_small`, `topping_pr_medium`, `topping_pr_large`) VALUES
(1, 'Triple Cheese', '0.50', '1.00', '1.50'),
(2, 'Olives', '0.50', '1.00', '1.50'),
(3, 'Pepperoni', '0.55', '1.10', '1.65'),
(4, 'Prawn', '0.80', '1.60', '2.40'),
(5, 'Anchovies', '0.70', '1.40', '2.10'),
(6, 'Tomatoes', '0.60', '1.20', '1.80');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `combo_meals`
--
ALTER TABLE `combo_meals`
  ADD PRIMARY KEY (`cm_id`),
  ADD KEY `cm_name` (`cm_name`(255));

--
-- Indexes for table `drinks`
--
ALTER TABLE `drinks`
  ADD PRIMARY KEY (`drink_id`),
  ADD KEY `drink_name` (`drink_name`);

--
-- Indexes for table `pizza`
--
ALTER TABLE `pizza`
  ADD PRIMARY KEY (`pizza_id`),
  ADD KEY `pizza_name` (`pizza_name`);

--
-- Indexes for table `sides`
--
ALTER TABLE `sides`
  ADD PRIMARY KEY (`side_id`),
  ADD KEY `side_name` (`side_name`);

--
-- Indexes for table `toppings`
--
ALTER TABLE `toppings`
  ADD PRIMARY KEY (`topping_id`),
  ADD KEY `topping_name` (`topping_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `combo_meals`
--
ALTER TABLE `combo_meals`
  MODIFY `cm_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `drinks`
--
ALTER TABLE `drinks`
  MODIFY `drink_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pizza`
--
ALTER TABLE `pizza`
  MODIFY `pizza_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sides`
--
ALTER TABLE `sides`
  MODIFY `side_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `toppings`
--
ALTER TABLE `toppings`
  MODIFY `topping_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
