-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2025 at 09:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mini_framework_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `guest_name` varchar(255) NOT NULL,
  `guest_phone` int(255) NOT NULL,
  `guest_address` varchar(255) NOT NULL,
  `total` int(50) NOT NULL,
  `created_at` datetime(5) NOT NULL,
  `updated_at` datetime(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `guest_name`, `guest_phone`, `guest_address`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, '', 0, '', 200000, '2025-05-25 02:03:55.00000', '2025-05-25 02:03:55.00000');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `subtotal` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `product_id`, `order_id`, `quantity`, `price`, `subtotal`) VALUES
(1, 4, 1, 1, 200000, 200000);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `price` float NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` datetime(5) NOT NULL,
  `updated_at` datetime(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `slug`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cheesecake', 'Pagkaon ni siya, klaro man. Suman', 200, 'cheesecake', 'uploads/cheesecake-1-22-500x500.jpg', '2025-05-22 02:43:18.00000', '2025-05-21 20:43:18.00000'),
(2, 2, 'Coke', 'Coke is a carbonated, sweetened soft drink widely known as a classic beverage. It\'s a globally recognized brand, manufactured by The Coca-Cola Company, and a popular term for Coca-Cola. The drink was originally marketed as a temperance drink and patent medicine, with its name derived from two of its original ingredients: coca leaves and kola nuts. ', 70, 'coke', 'uploads/CokeinCan.webp', '2025-05-22 04:10:22.00000', '2025-05-21 22:10:22.00000'),
(3, 3, 'Luxe Organix Niacinamide + Alpha Arbutin Whitening Serum Lotion', 'Luxe Organix Niacinamide + Arbutin Healthy Light Whitening Serum Lotion features a lightweight, non-sticky, and moisturizing formula that helps brighten the skin to restore a naturally radiant complexion. Infused with Niacinamide and Alpha Arbutin to help lighten and improve the appearance of skin for a smooth and flawless glow. With added benefits from Vitamin C, Hyaluronic Acid, and Vitamin E to revitalize dull-looking skin while strengthening the skin barrier. Indulge your skin with this concentrated serum-lotion hybrid that helps provide long lasting moisture by penetrating deeply into the skin, leaving you with brighter, softer and smoother skin.', 410, 'luxe-organix-niacinamide-+-alpha-arbutin-whitening-serum-lotion', 'uploads/LONiacinamideArbutinSerumLotion_50044682 _ (1)-QPsgbe5q-zoom.avif', '2025-05-22 04:14:03.00000', '2025-05-21 22:14:03.00000'),
(4, 4, 'Emmanuel', 'Issue: Igbabaligya kay ambot wa nako kasabot ani niya', 200000, 'emmanuel', 'uploads/495829201_2121776758248556_3919064968685248821_n.jpg', '2025-05-23 20:40:13.00000', '2025-05-23 14:40:13.00000');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime(5) NOT NULL,
  `updated_at` datetime(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Food', '2025-05-22 04:01:07.00000', '2025-05-22 04:01:07.00000'),
(2, 'Beverages', '2025-05-22 04:09:02.00000', '2025-05-22 04:09:02.00000'),
(3, 'Beauty and Personal Care', '2025-05-22 04:11:43.00000', '2025-05-22 04:14:51.00000'),
(4, 'Bas Category', '0000-00-00 00:00:00.00000', '0000-00-00 00:00:00.00000'),
(5, 'Bas Category', '2025-05-23 20:39:28.00000', '2025-05-23 20:39:28.00000');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` int(12) NOT NULL,
  `birthdate` varchar(50) NOT NULL,
  `created_at` datetime(5) NOT NULL,
  `updated_at` datetime(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `address`, `phone`, `birthdate`, `created_at`, `updated_at`) VALUES
(1, 'Rica Mae Patenio', 'rcmpatenio@gmail.com', '$2y$10$hHXlIizBPkBmKL3J6G6FKeNq4XRbJCktGzmB3FsHKiFip86d89jZO', 'Sangi, Calajo-an Minglanilla', 2147483647, '2004-11-15', '2025-05-21 20:02:54.00000', '2025-05-21 20:02:54.00000'),
(2, 'Rica Mae Patenio', 'rcmpatenio@gmail.com', '$2y$10$Fb3jVrxgqM/MaUd5vyRK2O6k1KLmvBGzScIgy1b0X3ShbkHMMzIoe', '', 0, '', '2025-05-21 20:16:55.00000', '2025-05-21 20:16:55.00000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer` (`customer_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product` (`product_id`),
  ADD KEY `order` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `customer` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `category` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
