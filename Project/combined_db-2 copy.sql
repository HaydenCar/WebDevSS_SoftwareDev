-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 29, 2024 at 01:16 AM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `combined_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `card_number` varchar(16) NOT NULL,
  `cardholder_name` varchar(100) NOT NULL,
  `expiration_date` date DEFAULT NULL,
  `cvv` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`user_id`, `event_id`, `quantity`, `email`, `phone_number`, `card_number`, `cardholder_name`, `expiration_date`, `cvv`) VALUES
(1, 2, 2, 'example@example.com', '123-456-7890', '', '', NULL, ''),
(1, 2, 2, 'example@example.com', '123-456-7890', '', '', NULL, ''),
(1, 2, 2, 'example@example.com', '123-456-7890', '', '', NULL, ''),
(1, 2, 2, 'example@example.com', '123-456-7890', '', '', NULL, ''),
(7827, 2, 1, 'Ibrahimcamara35@gmail.com', '0830239550', '', '', NULL, ''),
(7827, 1, 1, 'example@example.com', '123-456-7890', '1234123412341234', 'ibrah xamara', '2024-12-22', '44'),
(7827, 1, 2, 'example@example.com', '123-456-7890', '1', '1', '2222-12-22', '1'),
(7827, 1, 1, 'example@example.com', '123-456-7890', '1234567890', 'ibra', '2025-02-07', '989'),
(7827, 2, 2, 'example@example.com', '123-456-7890', '1234122331231', 'iiiiii', '2024-04-02', '333'),
(7827, 1, 1, 'example@example.com', '123-456-7890', '1111', 'ed', '2024-04-06', '3'),
(7827, 1, 1, 'example@example.com', '123-456-7890', '1111', 'ed', '2024-04-06', '3'),
(7827, 1, 1, 'example@example.com', '123-456-7890', '1111', 'ed', '2024-04-06', '3'),
(7827, 1, 1, 'example@example.com', '123-456-7890', '1111', 'ed', '2024-04-06', '3'),
(7827, 1, 1, 'hu@events.ie', '0830239550', '1234567890123456', 'hi ev', '2024-04-29', '111'),
(7827, 1, 1, 'hu@events.ie', '0830239550', '1234567890123456', 'hi ev', '2024-04-29', '111'),
(7827, 1, 1, 'hu@events.ie', '0830239550', '1234567890123456', 'hi ev', '2024-04-29', '111'),
(7827, 1, 1, 'hu@events.ie', '0830239550', '1234567890123456', 'hi ev', '2024-04-29', '111'),
(7827, 1, 1, 'hu@events.ie', '0830239550', '1234567890123456', 'hi ev', '2024-04-29', '111'),
(7827, 3, 1, 'hi@gmail.com', '1111111', '1234567890123456', 'hh', '2024-04-29', '111'),
(7827, 3, 1, 'hi@gmail.com', '1111111', '1234567890123456', 'hh', '2024-04-29', '111'),
(72128, 1, 1, 'g@gm.vo', '0000000000', '1234567890123456', 'gg', '2024-04-03', '444');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_type` varchar(50) NOT NULL,
  `event_date` date NOT NULL,
  `venue` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_type`, `event_date`, `venue`, `price`, `description`) VALUES
(1, 'Electrifying Nights with DJ Ben', 'Nightclub', '2024-04-21', 'Vibe Nightclub', '30.00', 'Prepare for a night of heart-pounding beats with DJ Ben at Vibe Nightclub. Known for his electrifying performances and masterful mixes, DJ Ben will take you on a musical journey you won’t forget. Grab your tickets now and join us for an unforgettable night!'),
(2, 'An Evening with Drake', 'Concert', '2024-04-22', 'Croke Park', '100.00', 'Experience the lyrical genius of Drake live at Croke Park this Saturday. With chart-topping hits and mesmerizing performances, this is one concert you can’t afford to miss. Secure your spot today and witness music history in the making!'),
(3, 'DISTRICT X ', 'Concert', '2024-09-17', 'Palmerstown House & Estate in Kildare', '100.00', 'Your District X line-up has arrived. Irelands biggest one day dance event takes place on Saturday the 21st of September at Palmerstown House & Estate in Kildare. 20 minutes from Dublin. Brought to you by the teams behind Index and District 8.\r\n\r\n20000 people. The biggest names in the game. World class stage production. Many more names to be announced. Don’t sleep on it.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `date`) VALUES
(1, 'Hayden', '123', '2024-04-19 11:18:47'),
(1, 'Hayden', '123', '2024-04-19 11:18:52'),
(7827, 'Ibrahim', '1234', '2024-04-22 11:40:07'),
(99715088735946323, 'Ibrahi', '1233', '2024-04-22 15:29:45'),
(58726626818, 'Ibrahim', '1234', '2024-04-28 21:22:40'),
(5, 'user', 'password', '2024-04-28 21:45:33'),
(5, 'user', 'password', '2024-04-28 21:45:37'),
(72128, 'hiiii', '0000', '2024-04-29 00:57:51');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
