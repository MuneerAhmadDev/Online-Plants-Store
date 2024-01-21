-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2024 at 12:44 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_plants_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `ops_admin`
--

CREATE TABLE `ops_admin` (
  `AdminID` int(20) NOT NULL,
  `AdminImage` varchar(255) NOT NULL,
  `AdminName` varchar(80) NOT NULL,
  `AdminEmail` varchar(100) NOT NULL,
  `AdminMobile` varchar(15) NOT NULL,
  `AdminAddress` text NOT NULL,
  `AdminPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ops_admin`
--

INSERT INTO `ops_admin` (`AdminID`, `AdminImage`, `AdminName`, `AdminEmail`, `AdminMobile`, `AdminAddress`, `AdminPassword`) VALUES
(1, '', 'Admin', 'admin@gmail.com', '', '', '$2y$10$Zr1rOe0Rpenxxz358u.hd.t8vBZkYzUiwy3ka9Gu5UOUDcvz/3Qw2');

-- --------------------------------------------------------

--
-- Table structure for table `ops_cartitems`
--

CREATE TABLE `ops_cartitems` (
  `CartItemID` int(11) NOT NULL,
  `CartID` int(11) NOT NULL,
  `ProductID` varchar(80) NOT NULL,
  `ProductPrice` decimal(10,0) NOT NULL,
  `ProductQuantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ops_category`
--

CREATE TABLE `ops_category` (
  `CategoryID` varchar(80) NOT NULL,
  `CategoryName` varchar(80) NOT NULL,
  `CategoryDescription` varchar(300) NOT NULL,
  `InsertedDate` datetime NOT NULL,
  `ModifiedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ops_category`
--

INSERT INTO `ops_category` (`CategoryID`, `CategoryName`, `CategoryDescription`, `InsertedDate`, `ModifiedDate`) VALUES
('prtcat174230', 'Indoor', 'Store all kinds of indoor plants and flowers.', '2023-06-14 19:18:32', '2023-07-02 07:44:18'),
('prtcat642492', 'Outdoor', 'Store all kinds of outdoor plants and flowers.', '2023-06-14 19:18:53', '0000-00-00 00:00:00'),
('prtcat810315', 'Gardening Tools', 'Store all kinds of tools uses in gardening work.', '2023-06-14 19:20:21', '2023-06-14 19:24:49'),
('prtcat846057', 'Winter Plants', 'this is winter plants.', '2023-09-25 11:51:17', '0000-00-00 00:00:00'),
('prtcat894307', 'Seeds/Bulbs', 'Store all kinds of indoor and outdoor plants seeds. Also store all kinds of indoor and outdoor flower bulbs.', '2023-06-16 17:47:28', '0000-00-00 00:00:00'),
('prtcat899287', 'Trees', 'Store all small and large trees.', '2023-06-14 19:20:42', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ops_orderitems`
--

CREATE TABLE `ops_orderitems` (
  `OrderItemsID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `ProductID` varchar(80) NOT NULL,
  `ProductQuantity` int(11) NOT NULL,
  `ProductPrice` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ops_orderitems`
--

INSERT INTO `ops_orderitems` (`OrderItemsID`, `OrderID`, `ProductID`, `ProductQuantity`, `ProductPrice`) VALUES
(82, 47, 'prd487112', 1, '382'),
(83, 48, 'prd487112', 4, '1528');

-- --------------------------------------------------------

--
-- Table structure for table `ops_product`
--

CREATE TABLE `ops_product` (
  `ProductID` varchar(80) NOT NULL,
  `ProductName` varchar(80) NOT NULL,
  `ProductCategory` varchar(80) NOT NULL,
  `ProductDescription` varchar(300) NOT NULL,
  `ProductPrice` decimal(10,0) NOT NULL,
  `ProductStock` int(11) NOT NULL,
  `InsertedDate` datetime NOT NULL,
  `ModifiedDate` datetime NOT NULL,
  `ProductPic` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ops_product`
--

INSERT INTO `ops_product` (`ProductID`, `ProductName`, `ProductCategory`, `ProductDescription`, `ProductPrice`, `ProductStock`, `InsertedDate`, `ModifiedDate`, `ProductPic`) VALUES
('prd443637', 'Gladiolus Bulbs', 'Bulbs', 'This is Gladiolus Bulbs', '3839', 493, '2023-08-06 23:59:00', '0000-00-00 00:00:00', 'assets/images/products/891533410.jpg'),
('prd466161', 'Sunflower Seeds', 'Seeds', 'Large seeds that grow into tall and cheerful sunflower plants, featuring vibrant yellow petals and a dark center.', '4332', 22, '2023-09-25 09:12:36', '0000-00-00 00:00:00', 'assets/images/products/2091299677.jpg'),
('prd487112', 'Pothos', 'Indoor Plants', 'Vining plant with heart-shaped leaves that come in various colors; easy to care for and suitable for hanging baskets or trailing on shelves.', '382', 188, '2023-08-07 00:04:55', '2023-09-25 09:17:57', 'assets/images/products/677599466.jpg'),
('prd526382', 'Gerbera', 'Outdoor Flowers', 'This is gerbera outdoor flower.', '22', -2, '2023-08-07 00:03:38', '2023-09-24 20:28:20', 'assets/images/products/1385322560.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ops_sitebanner`
--

CREATE TABLE `ops_sitebanner` (
  `BannerID` int(11) NOT NULL,
  `BannerTitle` varchar(100) NOT NULL,
  `BannerDescription` text NOT NULL,
  `BannerImages` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ops_sitebanner`
--

INSERT INTO `ops_sitebanner` (`BannerID`, `BannerTitle`, `BannerDescription`, `BannerImages`) VALUES
(5, 'Whispering Blooms', '\"Whispering Blooms\" is a captivating floral marvel that enchants with its delicate petals and gentle hues. Each blossom seems to carry secrets of nature\'s beauty, inviting you to immerse yourself in a world of serenity and wonder.', 'assets/images/banners/2008784418.jpg'),
(6, 'Eternal Iris Embrace', '\"Eternal Iris Embrace\" unveils a mesmerizing dance of irises in a spectrum of regal purples and blues, evoking an eternal embrace of elegance and grace. With petals that seem to ripple like silk in the breeze, this flower captures the essence of timeless beauty and fascination.', 'assets/images/banners/1751829472.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ops_sitesetting`
--

CREATE TABLE `ops_sitesetting` (
  `id` int(11) NOT NULL,
  `facebook` varchar(300) NOT NULL,
  `whatsapp` varchar(300) NOT NULL,
  `instagram` varchar(300) NOT NULL,
  `twitter` varchar(300) NOT NULL,
  `youtube` varchar(300) NOT NULL,
  `aboutus` text NOT NULL,
  `sitePic` varchar(300) NOT NULL,
  `siteName` varchar(40) NOT NULL,
  `PassRecoveryEmail` varchar(100) NOT NULL,
  `PassRecoveryEmailPass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ops_sitesetting`
--

INSERT INTO `ops_sitesetting` (`id`, `facebook`, `whatsapp`, `instagram`, `twitter`, `youtube`, `aboutus`, `sitePic`, `siteName`, `PassRecoveryEmail`, `PassRecoveryEmailPass`) VALUES
(1, 'https://www.facebook.com', 'https://web.whatsapp.com', 'https://www.instagram.com', 'https://twitter.com/i/flow/login?redirect_after_login=%2F', 'https://www.youtube.com', 'Online Plants Store is a vibrant and user-friendly ecommerce platform that caters to plant enthusiasts, gardening enthusiasts, and nature lovers alike. With a diverse and carefully curated selection of premium indoor and outdoor plants, our store offers a convenient and accessible way to bring the beauty of nature into homes and gardens.', 'assets/images/siteLogo/960187869.png', 'Online Plants Store', 'expandnetwork0@gmail.com', 'ipxcoaakifvlemai');

-- --------------------------------------------------------

--
-- Table structure for table `ops_subcategory`
--

CREATE TABLE `ops_subcategory` (
  `SubCategoryID` varchar(80) NOT NULL,
  `SubCategoryName` varchar(80) NOT NULL,
  `ParentCategory` varchar(80) NOT NULL,
  `SubCategoryDescription` varchar(300) NOT NULL,
  `InsertedDate` datetime NOT NULL,
  `ModifiedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ops_subcategory`
--

INSERT INTO `ops_subcategory` (`SubCategoryID`, `SubCategoryName`, `ParentCategory`, `SubCategoryDescription`, `InsertedDate`, `ModifiedDate`) VALUES
('chdcat103131', 'Hand Trowel', 'Gardening Tools', 'Store all kinds of trowel.', '2023-06-16 17:50:45', '2023-07-02 07:55:33'),
('chdcat312279', 'Bulbs', 'Seeds/Bulbs', 'This is flower bulbs.', '2023-06-26 15:01:51', '0000-00-00 00:00:00'),
('chdcat353534', 'Seeds', 'Seeds/Bulbs', 'Store Seeds.', '2023-06-24 09:29:21', '2023-06-25 10:03:42'),
('chdcat557201', 'Indoor Plants', 'Indoor', 'Store all indoor plants.', '2023-06-16 17:46:19', '0000-00-00 00:00:00'),
('chdcat596635', 'Outdoor Flowers', 'Outdoor', 'Store all Kinds of outdoor flowers.', '2023-06-16 17:49:21', '0000-00-00 00:00:00'),
('chdcat664290', 'Indoor Flowers', 'Indoor', 'Store all kinds of indoor flowers.', '2023-06-16 17:49:06', '0000-00-00 00:00:00'),
('chdcat669072', 'Outdoor Plants', 'Outdoor', 'Store all outdoor plants.', '2023-06-16 17:46:36', '2023-06-16 17:48:45'),
('chdcat694413', 'Pruning Shears', 'Gardening Tools', 'Store all kinds of shears.', '2023-06-16 17:51:03', '0000-00-00 00:00:00'),
('chdcat737114', 'Artificial Tree', 'Trees', 'Store all artificial trees small', '2023-06-26 15:15:47', '0000-00-00 00:00:00'),
('chdcat784731', 'Garden Fork', 'Gardening Tools', 'Store all kinds of Garden Fork.', '2023-06-16 17:50:27', '0000-00-00 00:00:00'),
('chdcat933757', 'Spade', 'Gardening Tools', 'Store all kinds of spade.', '2023-06-16 17:50:02', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ops_usercart`
--

CREATE TABLE `ops_usercart` (
  `CartID` int(20) NOT NULL,
  `UserID` varchar(80) NOT NULL,
  `CreatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ops_usercart`
--

INSERT INTO `ops_usercart` (`CartID`, `UserID`, `CreatedAt`) VALUES
(76, 'usr458800', '2023-09-24 14:59:08');

-- --------------------------------------------------------

--
-- Table structure for table `ops_userorders`
--

CREATE TABLE `ops_userorders` (
  `OrderID` int(11) NOT NULL,
  `UserID` varchar(80) NOT NULL,
  `OrderStatus` varchar(40) NOT NULL,
  `ShippingAddress` varchar(40) NOT NULL,
  `TotalPrice` decimal(10,0) NOT NULL,
  `CreatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ops_userorders`
--

INSERT INTO `ops_userorders` (`OrderID`, `UserID`, `OrderStatus`, `ShippingAddress`, `TotalPrice`, `CreatedAt`) VALUES
(47, 'usr458800', 'Pending', 'Lahore.', '382', '2023-09-24 14:44:05'),
(48, 'usr219365', 'Complete', 'Lahore.', '1528', '2023-09-25 12:04:02');

-- --------------------------------------------------------

--
-- Table structure for table `ops_users`
--

CREATE TABLE `ops_users` (
  `UserID` varchar(80) NOT NULL,
  `UserName` varchar(80) NOT NULL,
  `UserEmail` varchar(100) NOT NULL,
  `UserAddress` varchar(200) NOT NULL,
  `UserImage` varchar(100) NOT NULL,
  `UserPassword` varchar(255) NOT NULL,
  `UserMobile` varchar(20) NOT NULL,
  `RegisterDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ops_users`
--

INSERT INTO `ops_users` (`UserID`, `UserName`, `UserEmail`, `UserAddress`, `UserImage`, `UserPassword`, `UserMobile`, `RegisterDate`) VALUES
('usr882964', 'Munir', 'munirahmed4friends@gmail.com', '', '', '$2y$10$lsoSA28ithI05.fWWwBrAeIKqwee3RfAu3eod60LpT4qZb75UvaRK', '39383', '2023-09-25 05:54:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ops_admin`
--
ALTER TABLE `ops_admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `ops_cartitems`
--
ALTER TABLE `ops_cartitems`
  ADD PRIMARY KEY (`CartItemID`),
  ADD KEY `ops_cartitems_ibfk_1` (`CartID`);

--
-- Indexes for table `ops_category`
--
ALTER TABLE `ops_category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `ops_orderitems`
--
ALTER TABLE `ops_orderitems`
  ADD PRIMARY KEY (`OrderItemsID`),
  ADD KEY `OrderID` (`OrderID`);

--
-- Indexes for table `ops_product`
--
ALTER TABLE `ops_product`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `ops_sitebanner`
--
ALTER TABLE `ops_sitebanner`
  ADD PRIMARY KEY (`BannerID`);

--
-- Indexes for table `ops_sitesetting`
--
ALTER TABLE `ops_sitesetting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ops_subcategory`
--
ALTER TABLE `ops_subcategory`
  ADD PRIMARY KEY (`SubCategoryID`);

--
-- Indexes for table `ops_usercart`
--
ALTER TABLE `ops_usercart`
  ADD PRIMARY KEY (`CartID`);

--
-- Indexes for table `ops_userorders`
--
ALTER TABLE `ops_userorders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `ops_users`
--
ALTER TABLE `ops_users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ops_admin`
--
ALTER TABLE `ops_admin`
  MODIFY `AdminID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ops_cartitems`
--
ALTER TABLE `ops_cartitems`
  MODIFY `CartItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `ops_orderitems`
--
ALTER TABLE `ops_orderitems`
  MODIFY `OrderItemsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `ops_sitebanner`
--
ALTER TABLE `ops_sitebanner`
  MODIFY `BannerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ops_sitesetting`
--
ALTER TABLE `ops_sitesetting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ops_usercart`
--
ALTER TABLE `ops_usercart`
  MODIFY `CartID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `ops_userorders`
--
ALTER TABLE `ops_userorders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ops_cartitems`
--
ALTER TABLE `ops_cartitems`
  ADD CONSTRAINT `ops_cartitems_ibfk_1` FOREIGN KEY (`CartID`) REFERENCES `ops_usercart` (`CartID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ops_orderitems`
--
ALTER TABLE `ops_orderitems`
  ADD CONSTRAINT `ops_orderitems_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `ops_userorders` (`OrderID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
