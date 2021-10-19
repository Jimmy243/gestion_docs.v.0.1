-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 18, 2021 at 04:30 PM
-- Server version: 8.0.26-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion_docs`
--

-- --------------------------------------------------------

--
-- Table structure for table `facture`
--

CREATE TABLE `facture` (
  `IdF` int NOT NULL,
  `NameR` varchar(50) DEFAULT NULL,
  `Reference` varchar(50) DEFAULT NULL,
  `IdD` int DEFAULT NULL,
  `Id` int DEFAULT NULL,
  `Devise` varchar(50) DEFAULT NULL,
  `MontantF` int DEFAULT NULL,
  `DateEnreg` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Facture` varchar(256) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facture`
--

INSERT INTO `facture` (`IdF`, `NameR`, `Reference`, `IdD`, `Id`, `Devise`, `MontantF`, `DateEnreg`, `Facture`) VALUES
(5, 'jule', '45', 320, 3, 'FBU', 50000, '2021-10-18 10:58:27', 'file/factures/1634554707_modele-facture-fr-mono-noir-750px.png'),
(6, 'juniore', '231', 320, 3, 'FBU', 222222222, '2021-10-18 14:05:50', 'file/factures/1634565950_modele-de-facture.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`IdF`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `facture`
--
ALTER TABLE `facture`
  MODIFY `IdF` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
