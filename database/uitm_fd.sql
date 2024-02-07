-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2024 at 02:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uitm_fd`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'food@123'),
(2, 'admin2', 'FoodOrder123@');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `menu_price` decimal(10,2) NOT NULL,
  `menu_description` text NOT NULL,
  `menu_image` varchar(255) NOT NULL,
  `menu_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `res_id`, `c_id`, `menu_name`, `menu_price`, `menu_description`, `menu_image`, `menu_date`) VALUES
(1, 1, 1, 'Ayam KFC (Seketul)', 1.50, 'Fried chicken is a popular dish made by coating pieces of chicken with seasoned flour or batter and frying them until golden and crispy. The outer layer is often crunchy while the meat remains juicy and tender inside. It\'s a beloved comfort food enjoyed worldwide for its savory flavor and satisfying texture.', 'r1_ayamkfc.jpg', '2024-02-05'),
(2, 2, 1, 'Bihun Sup', 5.00, 'Bihun sup is a traditional Malaysian dish consisting of rice vermicelli noodles served in a flavorful broth, typically made with chicken or beef stock. The soup is often infused with aromatic spices such as ginger, garlic, and lemongrass, creating a fragrant and comforting bowl. It\'s commonly garnished with shredded chicken, vegetables, fried shallots, and fresh herbs for added depth of flavor and texture.', '../menu_images/r2_bihun.jpg', '2024-01-24'),
(3, 3, 1, 'Nasi kukus', 5.00, 'Nasi kukus is a Malaysian dish where steamed rice is the star, typically served with a variety of side dishes such as fried chicken, beef rendang, or curried vegetables. The rice is steamed to perfection, resulting in a fluffy texture and distinct aroma. It\'s often enjoyed with a drizzle of spicy sambal sauce for an extra kick of flavor.', '../menu_images/r3_nasikukus.jpeg', '2024-01-25'),
(4, 4, 1, 'Croissant', 8.90, 'A croissant is a flaky, buttery pastry that originated in France and has become a beloved breakfast item worldwide. Its distinctive crescent shape and layers of dough give it a light and crispy texture that pairs perfectly with a cup of coffee or tea.', 'r4_Croissant_.jpg', '2024-02-05'),
(5, 1, 1, 'Burger', 5.00, 'A burger is a classic American dish consisting of a seasoned ground meat patty, typically beef, grilled or fried and served between two slices of a bun. It\'s often accompanied by various toppings such as lettuce, tomato, cheese, onions, and condiments like ketchup and mustard, making it a customizable and satisfying meal option for many.', '../menu_images/r1_burger.jpg', '2024-01-17'),
(6, 1, 1, 'Ayam korea (3 ketul)', 5.00, 'Ayam Korea, or Korean fried chicken, is a popular dish known for its crispy exterior and flavorful glazes. It\'s often seasoned with spices, coated in batter, and double-fried to achieve its signature crunchiness. The chicken is then typically served with a variety of sauces, ranging from sweet and spicy to savory, creating a delicious fusion of flavors that\'s enjoyed by many.', '../menu_images/r1_ayamkorea.jpg', '2024-01-17'),
(7, 1, 1, 'Chicken Chop', 8.00, 'Chicken chop is a dish featuring a tender, grilled or fried chicken breast, often served with sides like fries, coleslaw, and vegetables. It\'s commonly seasoned with herbs and spices, then grilled to perfection, creating a juicy and flavorful main course that\'s popular in various culinary traditions.', '../menu_images/r1_chickenchop.jpg', '2024-01-17'),
(8, 1, 1, 'Meatball', 6.00, 'Meatballs are savory spheres of ground meat, often beef, or a combination, mixed with breadcrumbs, herbs, and spices, then shaped into small balls and cooked by frying, baking, or simmering in sauce. They are a versatile dish enjoyed as appetizers, served with pasta, in sandwiches, or as a standalone meal, offering a comforting and flavorful dining experience.', '../menu_images/r1_meatball.jpg', '2024-01-18'),
(9, 3, 1, 'Nasi lemak', 5.00, 'Nasi lemak is a beloved Malaysian dish featuring fragrant rice cooked in coconut milk and pandan leaves, served with various accompaniments such as spicy sambal, crispy anchovies, roasted peanuts, cucumber slices, and hard-boiled or fried egg. It\'s a flavorful and satisfying meal enjoyed for breakfast, lunch, or dinner, reflecting Malaysia\'s rich culinary heritage and diverse flavors.', '../menu_images/r3_nasilemak.jpeg', '2024-01-18'),
(10, 3, 1, 'Nasi Ayam', 5.00, 'Nasi ayam is a popular Malaysian dish consisting of fragrant rice served with succulent slices of chicken, often poached or roasted, and accompanied by flavorful condiments such as chili sauce, soy sauce, and sometimes a bowl of clear chicken broth. It\'s a comforting and satisfying meal enjoyed throughout Malaysia, reflecting the country\'s diverse culinary influences and vibrant street food culture.', '../menu_images/r3_nasiayam.jpeg', '0000-00-00'),
(11, 1, 1, 'Spaghetti', 7.00, 'Spaghetti is a type of pasta made from durum wheat semolina, typically served with various sauces such as marinara, bolognese, or carbonara. It\'s long, thin, and cylindrical in shape, making it versatile and easy to pair with a wide range of ingredients, herbs, and cheeses, creating a comforting and satisfying meal enjoyed by people worldwide.', '../menu_images/r1_Spaghetti.jpg', '2024-01-18'),
(12, 2, 1, 'Kuey Teow Sup', 5.00, 'Kuey Teow Sup is a Malaysian dish featuring flat rice noodles served in a flavorful broth, often made with beef or chicken, and infused with spices such as ginger, garlic, and lemongrass. It\'s typically garnished with bean sprouts, cilantro, and sometimes a squeeze of lime, creating a comforting and aromatic soup enjoyed throughout Malaysia for its rich flavors and satisfying texture.', '../menu_images/r2_kueyteow.jpeg', '2024-01-25');

-- --------------------------------------------------------

--
-- Table structure for table `menu_category`
--

CREATE TABLE `menu_category` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_category`
--

INSERT INTO `menu_category` (`c_id`, `c_name`) VALUES
(1, 'Foods'),
(2, 'Drinks');

-- --------------------------------------------------------

--
-- Table structure for table `new_order`
--

CREATE TABLE `new_order` (
  `order_id` int(11) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `menu_id` varchar(255) DEFAULT NULL,
  `res_id` varchar(255) NOT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','completed','cancelled') DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `menu_id`, `res_id`, `quantity`, `price`, `status`, `date`) VALUES
(88, 'sa', '11', '1', '2', 14.00, 'pending', '2024-02-07'),
(89, 'sa', '8', '1', '2', 12.00, 'pending', '2024-02-07'),
(90, 'sa', '11', '1', '1', 7.00, 'pending', '2024-02-07'),
(91, 'sa', '10', '3', '1', 5.00, 'pending', '2024-02-07'),
(92, 'sa', '11, 8', '1, 1', '1, 1', 13.00, 'pending', '2024-02-07');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_itemid` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `remark`
--

CREATE TABLE `remark` (
  `id` int(11) NOT NULL,
  `frm_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remark` mediumtext NOT NULL,
  `remarkDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `res_id` int(11) NOT NULL,
  `res_username` varchar(255) DEFAULT NULL,
  `res_password` varchar(255) NOT NULL,
  `res_name` varchar(255) NOT NULL,
  `res_email` varchar(255) NOT NULL,
  `res_phone` varchar(20) NOT NULL,
  `res_address` varchar(255) NOT NULL,
  `open_hours` time NOT NULL,
  `close_hours` time NOT NULL,
  `open_days` varchar(255) NOT NULL,
  `res_image` varchar(255) DEFAULT NULL,
  `res_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`res_id`, `res_username`, `res_password`, `res_name`, `res_email`, `res_phone`, `res_address`, `open_hours`, `close_hours`, `open_days`, `res_image`, `res_date`) VALUES
(1, 'k6cafe11', 'k6cafe@77', 'K6 CAFE', 'k6cafe@gmail.com', '018-9814140', 'Food Court E Kolej THO', '10:30:00', '22:30:00', 'Monday,Tuesday,Wednesday,Thursday,Sunday', 'r1.jpg', '2024-02-05'),
(2, 'CafeHuda4', 'cafeHuda@11', 'Cafe Kita By Huda', 'cafehuda@gmail.com', '019-9210903', 'Food Court UiTM Kelantan (Machang)', '10:30:00', '23:00:00', 'Monday,Tuesday,Wednesday,Thursday,Sunday', 'r2.jpg', '2024-02-05'),
(3, 'mamawawa@45', 'MamaWawa_56', 'Mama Wawa Cafe', 'Mamawawa@gmail.com', '019-9094662', 'Food Court UiTM Kelantan (Machang)', '10:30:00', '00:00:00', 'Monday,Tuesday,Wednesday,Thursday,Friday,Sunday', 'r4.jpg', '2024-02-03'),
(4, 'henshe90', '$2y$10$4Wz8YPex6zElQXECrSBA4O5L1dDZEZnagIXj9lVFJJT/px61k1M4.', 'He & She Coffee', 'heandshemachang@gmail.com', '019-6578690', 'Uitm, He & She Coffee, Dataran MASMED, 18500 Machang, Kelantan', '10:00:00', '20:30:00', 'Monday,Tuesday,Wednesday,Thursday,Sunday', 'r3.jpg', '2024-02-05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `code` mediumint(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `name`, `email`, `address`, `phone`, `code`) VALUES
(1, 'sa', 'c20ad4d76fe97759aa27a0c99bff6710', 'Aishah', 'aishah@gmail.com', 'Asrama Tuan Haji', '0193063620', 0),
(2, '', '237922b3d03c24e2f178e522180c167c', 'fathiah ', 'fathiah0212@gmail.com', 'Asrama Puteri Tuan Haji', '0189459697', 792703),
(3, 'teyyah', '930221269a5dfd920e648e3c0daf5f04', 'fathiah fadzli', 'fathiah0212@gmail.com', 'Asrama Puteri Tuan Haji', '0189459697', 792703),
(4, 'abc', '202cb962ac59075b964b07152d234b70', 'abc', 'abc@gmail.com', 'abc', '123', NULL),
(5, 'Fida', '827ccb0eea8a706c4c34a16891f84e7b', 'Fida', 'lananruu@gmail.com', 'asrama tuan haji , kelantan', '0192093898', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `res_id` (`res_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `menu_category`
--
ALTER TABLE `menu_category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `new_order`
--
ALTER TABLE `new_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_itemid`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`res_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `new_order`
--
ALTER TABLE `new_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_itemid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`res_id`) REFERENCES `restaurants` (`res_id`),
  ADD CONSTRAINT `menu_ibfk_2` FOREIGN KEY (`c_id`) REFERENCES `menu_category` (`c_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
