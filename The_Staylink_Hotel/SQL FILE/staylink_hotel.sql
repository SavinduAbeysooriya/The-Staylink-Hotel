-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2025 at 02:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `staylink_hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `car_model` varchar(100) NOT NULL,
  `license_plate` varchar(20) NOT NULL,
  `price_per_day` decimal(10,2) NOT NULL,
  `availability_status` enum('available','rented','maintenance') DEFAULT 'available',
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `car_model`, `license_plate`, `price_per_day`, `availability_status`, `image_path`, `created_at`) VALUES
(1, 'Toyota Corolla', 'ABC1234', 5000.00, 'rented', 'assets/images/toyota_corolla.jpg', '2025-03-06 15:22:15'),
(2, 'Honda Civic', 'XYZ5678', 6000.00, 'rented', 'assets/images/honda_civic.jpg', '2025-03-06 15:22:15'),
(3, 'Suzuki Swift', 'LMN8765', 4000.00, 'rented', 'assets/images/suzuki_swift.jpg', '2025-03-06 15:22:15'),
(4, 'Toyota Prius', 'PQR4567', 7000.00, 'rented', 'assets/images/toyota_prius.jpg', '2025-03-06 15:22:15'),
(5, 'Nissan X-Trail', 'JKL1357', 8000.00, 'available', 'assets/images/nissan_xtrail.jpg', '2025-03-06 15:22:15');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `menu_item_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `menu_item_id`, `quantity`, `created_at`) VALUES
(62, 16, 3, 10, '2025-03-10 01:05:13');

-- --------------------------------------------------------

--
-- Table structure for table `car_rentals`
--

CREATE TABLE `car_rentals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `rental_start_date` date NOT NULL,
  `rental_end_date` date NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','confirmed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_rentals`
--

INSERT INTO `car_rentals` (`id`, `user_id`, `car_id`, `rental_start_date`, `rental_end_date`, `total_price`, `status`, `created_at`) VALUES
(23, 15, 1, '2025-03-10', '2025-03-13', 15000.00, 'pending', '2025-03-06 19:44:22'),
(24, 15, 2, '2025-06-02', '2025-06-04', 12000.00, 'pending', '2025-03-07 05:35:57'),
(25, 16, 3, '2025-03-24', '2025-03-25', 4000.00, 'pending', '2025-03-08 07:27:06'),
(26, 17, 4, '2025-03-10', '2025-03-11', 7000.00, 'pending', '2025-03-10 01:19:13');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Sri Lankan'),
(2, 'Chinese'),
(3, 'Italian'),
(4, 'Indian'),
(5, 'Mexican');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_type` varchar(100) NOT NULL,
  `event_date` date NOT NULL,
  `event_location` varchar(100) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `event_status` enum('pending','confirmed','cancelled') DEFAULT 'pending',
  `event_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `event_type`, `event_date`, `event_location`, `total_price`, `event_status`, `event_image`) VALUES
(1, 'Live Music Night', 'Concert', '2025-04-15', 'The Staylink Hotel, Colombo', 5000.00, 'confirmed', 'assets/images/live_music_night.jpg'),
(4, 'Fashion Show Gala', 'Fashion Show', '2025-07-01', 'The Staylink Hotel, Colombo', 10000.00, 'confirmed', 'assets/images/fashion_show_gala.jpg'),
(5, 'New Year Eve Party', 'Party', '2025-12-31', 'The Staylink Hotel, Colombo', 8000.00, 'confirmed', 'assets/images/new_year_eve_party.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `event_bookings`
--

CREATE TABLE `event_bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `booking_status` enum('pending','confirmed','cancelled') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_bookings`
--

INSERT INTO `event_bookings` (`id`, `user_id`, `event_id`, `booking_status`) VALUES
(34, 16, 1, 'pending'),
(36, 16, 4, 'pending'),
(38, 16, 5, 'confirmed'),
(41, 17, 1, 'confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `name`, `description`, `price`, `image`, `created_at`, `category_id`) VALUES
(1, 'Rice and Curry', 'The symphony of flavours', 800.00, 'assets/images/Rice and Curry.jpg', '2024-09-04 12:24:34', 1),
(2, 'Hoppers (Appam)', 'Pancakes For Breakfast', 20.00, 'assets/images/Hoppers (Appam).jpg', '2024-09-04 12:26:35', 1),
(3, 'Indiappa', 'A dance of textures & flavours', 10.00, 'assets/images/Indiappa.jpg', '2024-09-04 12:27:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('Pending','Processing','Completed','Cancelled') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `status`, `created_at`) VALUES
(25, 12, 800.00, 'Pending', '2025-03-05 11:54:09'),
(28, 15, 800.00, 'Pending', '2025-03-06 20:07:06'),
(29, 15, 10.00, 'Pending', '2025-03-07 05:34:42'),
(30, 16, 10.00, 'Pending', '2025-03-08 07:25:31'),
(31, 17, 800.00, 'Processing', '2025-03-10 01:13:27');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `menu_item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `menu_item_id`, `quantity`, `price`) VALUES
(29, 25, 1, 1, 800.00),
(32, 28, 1, 1, 800.00),
(33, 29, 3, 1, 10.00),
(34, 30, 3, 1, 10.00),
(35, 31, 1, 1, 800.00);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('credit_card','debit_card','paypal') NOT NULL,
  `payment_status` enum('pending','completed','failed') DEFAULT 'pending',
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `card_number` varchar(255) NOT NULL,
  `cvv` varchar(255) NOT NULL,
  `expiry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `table_number` int(11) DEFAULT NULL,
  `reservation_time` datetime DEFAULT NULL,
  `status` enum('pending','confirmed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_number` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `price_per_night` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `capacity`, `type`, `price_per_night`, `created_at`) VALUES
(1, 101, 2, 'Single', 5000.00, '2025-03-05 15:01:00'),
(2, 102, 4, 'Double', 7500.00, '2025-03-05 15:01:00'),
(3, 103, 2, 'Suite', 12000.00, '2025-03-05 15:01:00');

-- --------------------------------------------------------

--
-- Table structure for table `room_bookings`
--

CREATE TABLE `room_bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `status` enum('pending','confirmed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_bookings`
--

INSERT INTO `room_bookings` (`id`, `user_id`, `room_id`, `check_in_date`, `check_out_date`, `status`, `created_at`) VALUES
(1, 12, 1, '2024-09-20', '2024-09-22', 'confirmed', '2025-03-05 15:01:00'),
(2, 13, 1, '2025-03-07', '2025-03-20', 'pending', '2025-03-05 15:14:48'),
(3, 13, 1, '2025-03-05', '2025-03-06', 'pending', '2025-03-05 15:16:40'),
(4, 13, 2, '2025-03-05', '2025-03-06', 'pending', '2025-03-05 15:17:41'),
(5, 13, 2, '2025-03-05', '2025-03-06', 'pending', '2025-03-05 15:46:48'),
(6, 13, 3, '2025-03-05', '2025-03-26', 'pending', '2025-03-05 16:03:17'),
(7, 13, 1, '2025-03-07', '2025-03-14', 'pending', '2025-03-05 16:04:08'),
(8, 13, 1, '2025-03-07', '2025-03-14', 'pending', '2025-03-05 16:04:12'),
(9, 13, 1, '2025-03-14', '2025-03-17', 'pending', '2025-03-05 16:04:48'),
(10, 13, 1, '2025-03-05', '2025-03-21', 'confirmed', '2025-03-05 16:06:40'),
(11, 13, 1, '2025-03-06', '2025-03-20', 'confirmed', '2025-03-05 16:11:57'),
(12, 13, 3, '2025-03-06', '2025-03-07', 'confirmed', '2025-03-05 16:25:31'),
(13, 15, 1, '2025-09-08', '2025-09-09', 'pending', '2025-03-06 11:15:39'),
(14, 15, 1, '2025-09-08', '2025-09-09', 'confirmed', '2025-03-06 11:16:03'),
(15, 15, 2, '2025-03-13', '2025-03-22', 'confirmed', '2025-03-06 11:16:52'),
(16, 15, 2, '2025-03-18', '2025-03-19', 'confirmed', '2025-03-06 11:24:54'),
(17, 15, 1, '2025-03-30', '2025-03-31', 'confirmed', '2025-03-06 11:41:48'),
(18, 15, 1, '2026-01-01', '2026-01-02', 'confirmed', '2025-03-07 05:35:15'),
(19, 16, 1, '2027-01-01', '2027-01-02', 'confirmed', '2025-03-08 07:26:31'),
(20, 17, 1, '2027-01-12', '2027-01-13', 'confirmed', '2025-03-10 01:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `table_number` int(11) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `table_number`, `capacity`) VALUES
(1, 1, 4),
(2, 2, 6),
(3, 3, 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','staff','customer') DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `address`, `telephone`, `password`, `role`, `created_at`) VALUES
(1, 'Admin', 'admin1@gmail.com', '', '', '$2y$10$bpoOkxed1B2rZBGad.JCj.Ib95X0SodVb5phxK01D79BfIrQvdCg2', 'admin', '2024-09-04 12:18:54'),
(8, 'admin0', 'admin@gmail.com', '', '', '$2y$10$xTSCksj8A25V4Aq4zeifwODHQAhsY/M486k.jCUtBVmklTm6.RNUa', 'customer', '2024-09-09 16:24:56'),
(9, 'Staff1', 'Staff1@gmail.com', '', '', '$2y$10$Dbr/D9ZrUeb0/GiFUFeALuM4nKRS0tU//w5ZiJHk3oPIP89L6X1RK', 'staff', '2024-09-10 17:19:58'),
(12, 'Eren', 'erenyeag@gmail.com', 'Kurunegala', '0111234568', '$2y$10$i2HoZuC.M0MhOrWp9I5wM.MoU829XYLFLmILnHTson737eHuwTeV.', 'admin', '2025-03-05 11:52:03'),
(13, 'User1', 'user69@gmail.com', 'Kurunegala', '0741234567', '$2y$10$Z.dQuyqbnGPToM5oRwx3juSQkdJPMhZEP0JYIm8m2pYVEiaQf67yy', 'customer', '2025-03-05 13:40:07'),
(14, 'Akira', 'akira22@gmail.com', '', '', '$2y$10$6BE2zru835v0TA7Dcc7/JOUpdCzFNG3T5hoM4ytMhPm2/EREAiUX.', 'customer', '2025-03-06 11:14:00'),
(15, 'Vinod', 'vinod@gmail.com', '', '', '$2y$10$cpDbwEqcwgCZsC3GW3RkievF1yxMl//rLG6LGoAdRqjeSjteEf.Ha', 'admin', '2025-03-06 11:15:10'),
(16, 'Mohamed Shabri', 'shabrishabrishabri44@gmail.com', '', '', '$2y$10$oi1KV/LgCrcF9YcqppkSju.pRDYYoCog0XpdUNgnDYBq0fhKomz4S', 'customer', '2025-03-07 22:06:48'),
(17, 'Sample User', 'SUuser@gmail.com', '', '', '$2y$10$ZNg0io.IDxqN9/u4thTpBuID7eNt3oLz/QBpMp6y9ijFuh9MHfx.q', 'customer', '2025-03-10 01:11:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `menu_item_id` (`menu_item_id`);

--
-- Indexes for table `car_rentals`
--
ALTER TABLE `car_rentals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_bookings`
--
ALTER TABLE `event_bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`event_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `menu_item_id` (`menu_item_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_table_number` (`table_number`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_bookings`
--
ALTER TABLE `room_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `table_number` (`table_number`);

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
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `car_rentals`
--
ALTER TABLE `car_rentals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `event_bookings`
--
ALTER TABLE `event_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `room_bookings`
--
ALTER TABLE `room_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`);

--
-- Constraints for table `car_rentals`
--
ALTER TABLE `car_rentals`
  ADD CONSTRAINT `car_rentals_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_bookings`
--
ALTER TABLE `event_bookings`
  ADD CONSTRAINT `event_bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_bookings_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_table_number` FOREIGN KEY (`table_number`) REFERENCES `tables` (`table_number`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `room_bookings`
--
ALTER TABLE `room_bookings`
  ADD CONSTRAINT `room_bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `room_bookings_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
