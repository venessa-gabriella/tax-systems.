-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2026 at 12:34 PM
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
-- Database: `tax_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `tax_payments`
--

CREATE TABLE `tax_payments` (
  `id` int(11) NOT NULL,
  `taxpayer_name` varchar(100) NOT NULL,
  `kra_pin` varchar(20) NOT NULL,
  `tax_type` varchar(50) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `payment_method` varchar(30) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `receipt_number` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tax_payments`
--

INSERT INTO `tax_payments` (`id`, `taxpayer_name`, `kra_pin`, `tax_type`, `amount`, `payment_method`, `payment_date`, `receipt_number`) VALUES
(1, 'purity nyambura', '129002', 'PAYE', 1200.00, 'Bank', '2026-10-26 12:47:58', 'DEMO-7A5A08A048'),
(2, 'mercy nihan', '320954', 'Turnover Tax', 5000.00, 'Card', '2026-10-26 12:48:47', 'DEMO-AB74EE0997'),
(3, 'annabel clablie', '325477', 'VAT', 2000.00, 'M-Pesa', '2026-10-26 12:49:30', 'DEMO-53987BBA1D'),
(4, 'purity nyambura', '879', 'VAT', 1200.00, 'Bank', '2026-11-06 08:55:11', 'DEMO-6ED4123E38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tax_payments`
--
ALTER TABLE `tax_payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `receipt_number` (`receipt_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tax_payments`
--
ALTER TABLE `tax_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
