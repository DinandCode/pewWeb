-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2024 at 05:57 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cafunge`
--

-- --------------------------------------------------------

--
-- Table structure for table `kedai`
--

CREATE TABLE `kedai` (
  `id` int(11) NOT NULL,
  `nama_kedai` varchar(255) NOT NULL,
  `pemilik` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kedai`
--

INSERT INTO `kedai` (`id`, `nama_kedai`, `pemilik`, `alamat`, `email`) VALUES
(1, 'Kedai Sederhana', 'Budi Santoso', 'Jl. Merdeka No. 12', 'budi@kedaisederhana.com'),
(2, 'Warung Makan Ayu', 'Ayu Kartini', 'Jl. Diponegoro No. 45', 'ayu@warungayu.com'),
(3, 'Kedai Kopi Hitam', 'Agus Prasetyo', 'Jl. Sudirman No. 22', 'agus@kedaihitam.com'),
(4, 'Resto Nusantara', 'Sari Dewi', 'Jl. Ahmad Yani No. 78', 'sari@restonusantara.com'),
(5, 'Depot Makmur', 'Iwan Kurniawan', 'Jl. Gatot Subroto No. 89', 'iwan@depotmakmur.com'),
(6, 'Kedai Papandayan', 'Bu papa', 'Cafe ungu no 5', 'papandayan@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `kedai_id` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kedai_id`, `nama_produk`, `harga`, `stok`, `deskripsi`, `gambar`) VALUES
(1, 1, 'Nasi Goreng', 20000, 50, 'Nasi goreng spesial pedas', ''),
(2, 2, 'Ayam Bakar', 25000, 30, 'Ayam bakar dengan bumbu kecap', ''),
(3, 3, 'Kopi Hitam', 10000, 100, 'Kopi hitam pekat khas kedai', ''),
(4, 4, 'Soto Ayam', 15000, 40, 'Soto ayam kuah bening segar', ''),
(5, 5, 'Bakso Spesial', 18000, 60, 'Bakso daging sapi asli', ''),
(10, 1, 'Ketoprak', 12000, 23, 'ketoprak manis ', ''),
(13, 1, 'Ketoprak', 12000, 23, 'ketoprak manis ', ''),
(14, 2, 'mie yamin', 10000, 2, 'mie yamin enak', ''),
(15, 2, 'mie yamin', 10000, 2, 'mie yamin enak', ''),
(16, 2, 'pempek', 5000, 3, 'pempek kapal selam', ''),
(17, 2, 'ayam geprek gobyos', 1000, 2, 'nasi ayam ', ''),
(18, 3, 'Sate panggang', 2000, 20, 'acrsdtfyguhijopkl[', ''),
(19, 3, 'Nasi Gila', 10000, 2, 'nasi campur terlor ', ''),
(20, 3, 'nasi bakar', 5000, 2, 'fghjnkml', ''),
(21, 5, 'bakso mercon', 10000, 20, 'agdfywqdfqwuif', ''),
(22, 5, 'cireng', 10000, 12, 'dfggfgj', 'Capture.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','seller','admin') NOT NULL,
  `redirect` varchar(255) NOT NULL,
  `kedai_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `redirect`, `kedai_id`) VALUES
(1, 'user@coba.com', '$2y$10$99c6IZo8pVqZ5bJTH.zHY.2Utma3Vks4/6QXoVSxkip3pq4w/OyHS', 'user', '/CafungE/public/user/index.php', 1),
(2, 'seller@coba.com', '$2y$10$iI4JzHpPj7ien4fISiIfs..FtxuesAlkh1AedVvotUKmguP.3prDW', 'seller', '/CafungE/public/penjual/kelola.php', 3),
(3, 'kedai@coba.com', '$2y$10$JSSmpTfaLnG7QK3ODECE7.7kaGH2pv8mhW0gX2C1v/fJJKjS6HBRu', 'seller', '/CafungE/public/penjual/kelola.php', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kedai`
--
ALTER TABLE `kedai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kedai_id` (`kedai_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `kedai_id` (`kedai_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kedai`
--
ALTER TABLE `kedai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`kedai_id`) REFERENCES `kedai` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`kedai_id`) REFERENCES `kedai` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
