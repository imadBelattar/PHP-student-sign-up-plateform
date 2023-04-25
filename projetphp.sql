-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2022 at 02:02 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projetphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nom` varchar(55) DEFAULT NULL,
  `prenom` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `email` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nom`, `prenom`, `password`, `email`) VALUES
(1, 'admin', 'admin', 'root', 'admin@uca.ma');

-- --------------------------------------------------------

--
-- Table structure for table `candidat`
--

CREATE TABLE `candidat` (
  `id` int(11) NOT NULL,
  `nom` varchar(55) DEFAULT NULL,
  `prenom` varchar(250) DEFAULT NULL,
  `password` varchar(55) NOT NULL,
  `email` varchar(250) NOT NULL,
  `date_N` varchar(30) DEFAULT NULL,
  `phone` varchar(55) DEFAULT NULL,
  `addresse` varchar(250) DEFAULT NULL,
  `cin` varchar(30) DEFAULT NULL,
  `sexe` varchar(5) DEFAULT NULL,
  `ville_id` int(11) DEFAULT NULL,
  `cne` varchar(55) DEFAULT NULL,
  `photo` varchar(450) DEFAULT NULL,
  `annee_bac` int(5) DEFAULT NULL,
  `filiere_bac_id` int(11) DEFAULT NULL,
  `regio_note` double DEFAULT NULL,
  `national_note` double DEFAULT NULL,
  `bac` varchar(450) DEFAULT NULL,
  `bac_releve` varchar(450) DEFAULT NULL,
  `choix1` int(11) DEFAULT NULL,
  `choix2` int(11) DEFAULT NULL,
  `first_login` varchar(10) DEFAULT 'yes',
  `promotion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `candidat`
--

INSERT INTO `candidat` (`id`, `nom`, `prenom`, `password`, `email`, `date_N`, `phone`, `addresse`, `cin`, `sexe`, `ville_id`, `cne`, `photo`, `annee_bac`, `filiere_bac_id`, `regio_note`, `national_note`, `bac`, `bac_releve`, `choix1`, `choix2`, `first_login`, `promotion_id`) VALUES
(6, 'hakimi', 'achraf', '2a38a4a9316c49e5a833517c45d31070', 'achraf.hakimi@gmail.com', '04 - 11 - 2002', '0622222222', 'france', 'y1247558', 'homme', 2, 'b457983216', 'uploads/639bab04171045.76376593.jpg', 2020, 1, 4, 4, 'uploads/638b9086a0c7c0.05332402.pdf', 'uploads/638b9086a108c8.45569681.pdf', 3, 1, 'No', 1),
(7, 'mojahid', 'amal', '2a38a4a9316c49e5a833517c45d31070', 'amal.mjh@gmail.com', '03 - 12 - 2022', '0658471475', 'inzegane', 'F47876', 'femme', 2, 'l4445099', 'uploads/639ba9aba58909.16463723.jpg', 2020, 1, 7, 18, 'uploads/638b9a50ca2bb3.07321615.pdf', 'uploads/638b9a50cacc51.67167074.pdf', 2, 1, 'No', 1),
(8, 'moulib', 'abd elatif', '2a38a4a9316c49e5a833517c45d31070', 'moulib.2001@gmail.com', '03 - 12 - 2001', '0655555555', 'hay nakhla 5', 'u48755', 'homme', 2, 'm48765054', 'uploads/639baa0045d5f9.19953612.jpg', 2020, 1, 4, 4, 'uploads/638ba73bbe19c0.39000903.pdf', 'uploads/638ba73bbe3bc5.39947534.pdf', 3, 1, 'No', 1),
(9, NULL, NULL, 'b2f5ff47436671b6e533d8dc3614845d', 'g@g', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'yes', 1),
(13, NULL, NULL, 'e1671797c52e15f763380b45e841ec32', 'e@e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'yes', 1),
(15, 'omari', 'mehdi', '2a38a4a9316c49e5a833517c45d31070', 'mehdi.omari@gmail.com', '02 - 01 - 2002', '0655647821', 'Raihanne N 293', 'y687411', 'homme', 1, 'G13224877', 'uploads/639b903aa262a6.99353987.jpg', 2022, 1, 14, 16, 'uploads/6398b3d11e5fa8.31702793.pdf', 'uploads/6398b3d11eb1e9.98532921.pdf', 3, 4, 'No', 2),
(16, 'najim', 'oussama', '2a38a4a9316c49e5a833517c45d31070', 'lo@lo', '05 - 02 - 2020', '0615442263', 'near the shcool', 'y4578', 'homme', 1, 'g135478985', 'uploads/6394e0b0407556.34931690.jpg', 2021, 2, 13, 18, 'uploads/6394e0b040c373.47155623.pdf', 'uploads/6394e0b040f2c6.82754208.pdf', 3, 1, 'No', 2),
(20, 'etd_nom1', 'etd_prenom1', '7ce8636c076f5f42316676f7ca5ccfbe', 'test@lo', '06 - 12 - 2003', '01111', 'tttt', 'uxxxx', 'femme', 2, '5', 'uploads/638b9086a07ed6.12980979.jpg', 2020, 1, 12, 10, 'uploads/638b9086a0c7c0.05332402.pdf', 'uploads/638b9086a108c8.45569681.pdf', 3, 1, 'No', 2),
(21, 'etd_nom5', 'etd_prenom5', '7ce8636c076f5f42316676f7ca5ccfbe', 'test@lo', '06 - 12 - 2003', '1111', '2222', 'yxxx', 'femme', 2, 'gxxx', 'uploads/638b9086a07ed6.12980979.jpg', 2020, 2, 12, 11, 'uploads/638b9086a0c7c0.05332402.pdf', 'uploads/638b9086a108c8.45569681.pdf', 3, 1, 'No', 2),
(22, 'etd_nom3', 'etd_prenom3', '7ce8636c076f5f42316676f7ca5ccfbe', 'test@lo', '06 - 12 - 2003', 'yxx3', 'gxx3', 'hxxxx', 'femme', 2, 'gxxx4', 'uploads/638b9086a07ed6.12980979.jpg', 2020, 2, 12, 12, 'uploads/638b9086a0c7c0.05332402.pdf', 'uploads/638b9086a108c8.45569681.pdf', 3, 1, 'No', 2),
(23, 'etd_nom4', 'etd_prenom4', '7ce8636c076f5f42316676f7ca5ccfbe', 'test@lo', '06 - 12 - 2003', '01111', 'tttt', 'oxxxx', 'femme', 2, 'y55555', 'uploads/638b9086a07ed6.12980979.jpg', 2020, 1, 12, 10, 'uploads/638b9086a0c7c0.05332402.pdf', 'uploads/638b9086a108c8.45569681.pdf', 3, 1, 'No', 2),
(24, 'etd_nom2', 'etd_prenom2', '7ce8636c076f5f42316676f7ca5ccfbe', 'test@lo', '06 - 12 - 2003', '1111', '2222', 'y5555', 'femme', 2, 'g5555', 'uploads/638b9086a07ed6.12980979.jpg', 2020, 1, 12, 11, 'uploads/638b9086a0c7c0.05332402.pdf', 'uploads/638b9086a108c8.45569681.pdf', 3, 1, 'No', 2),
(25, 'etd_nom6', 'etd_prenom6', '7ce8636c076f5f42316676f7ca5ccfbe', 'test@lo', '06 - 12 - 2003', '0654878', 'n 207', 'h66666', 'femme', 2, 'g6666', 'uploads/638b9086a07ed6.12980979.jpg', 2020, 2, 12, 12, 'uploads/638b9086a0c7c0.05332402.pdf', 'uploads/638b9086a108c8.45569681.pdf', 3, 1, 'No', 2),
(26, NULL, NULL, '098f6bcd4621d373cade4e832627b4f6', 'test@test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'yes', 0),
(27, NULL, NULL, 'e1bfd762321e409cee4ac0b6e841963c', 'rapport@rapport', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'yes', 0),
(28, 'abidi', 'younness', '42a6d2a1eb550c1fe4d1520d82372047', 'younness.abidi@gmail.com', '09 - 02 - 2000', '0724597853', 'raihane N° 322 ', 'y55482', 'homme', 2, 'g13598820', 'uploads/639b95cde5aad0.05650810.jpg', 2021, 1, 15, 16.22, 'uploads/639b95cde5d2b5.25703955.pdf', 'uploads/639b95cde5fa10.09495500.pdf', 3, 1, 'No', 2);

-- --------------------------------------------------------

--
-- Table structure for table `departements`
--

CREATE TABLE `departements` (
  `id` int(11) NOT NULL,
  `filiere` varchar(250) NOT NULL,
  `max_etudiants` int(10) DEFAULT 80,
  `adminId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departements`
--

INSERT INTO `departements` (`id`, `filiere`, `max_etudiants`, `adminId`) VALUES
(1, 'Génie Industriel et Maintenance', 60, 1),
(2, 'Techniques de management', 10, 1),
(3, 'Génie Informatique', 6, 1),
(4, 'Techniques de Management', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `filiere`
--

CREATE TABLE `filiere` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `adminId` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `filiere`
--

INSERT INTO `filiere` (`id`, `title`, `adminId`) VALUES
(1, 'science physique', 1),
(2, 'science math', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inscription`
--

CREATE TABLE `inscription` (
  `id` int(11) NOT NULL,
  `promotion` varchar(100) NOT NULL,
  `endDate` varchar(40) NOT NULL,
  `adminId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inscription`
--

INSERT INTO `inscription` (`id`, `promotion`, `endDate`, `adminId`) VALUES
(1, '2022/2023', '01-01-2023', 1),
(2, '2040/2041', '2022-12-31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `villes`
--

CREATE TABLE `villes` (
  `id` int(11) NOT NULL,
  `ville` varchar(250) NOT NULL,
  `adminId` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `villes`
--

INSERT INTO `villes` (`id`, `ville`, `adminId`) VALUES
(1, 'El Kelaa des Sraghna', 1),
(2, 'Agadir', 1),
(3, 'Al Hoceima', 1),
(4, 'Azilal', 1),
(5, 'Beni Mellal', 1),
(6, 'Ben Slimane', 1),
(7, 'Boulemane', 1),
(8, 'Casablanca', 1),
(9, 'Chaouen', 1),
(10, 'El Jadida', 1),
(11, 'Er Rachidia', 1),
(12, 'Essaouira', 1),
(13, 'Fes', 1),
(14, 'Figuig', 1),
(15, 'Guelmim', 1),
(16, 'Ifrane', 1),
(17, 'Kenitra', 1),
(18, 'Khemisset', 1),
(19, 'Khenifra', 1),
(20, 'Khouribga', 1),
(21, 'Laayoune', 1),
(22, 'Larache', 1),
(23, 'Marrakech', 1),
(24, 'Meknes', 1),
(25, 'Nador', 1),
(26, 'Ouarzazate', 1),
(27, 'Oujda', 1),
(28, 'Rabat-Sale', 1),
(29, 'Safi', 1),
(30, 'Settat', 1),
(31, 'Sidi Kacem', 1),
(32, 'Tangier', 1),
(33, 'Tan-Tan', 1),
(34, 'Taounate', 1),
(35, 'Taroudannt', 1),
(36, 'Tata', 1),
(37, 'Taza', 1),
(38, 'Tetouan', 1),
(39, 'Tiznit', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidat`
--
ALTER TABLE `candidat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cin` (`cin`),
  ADD UNIQUE KEY `cne` (`cne`),
  ADD KEY `ville_id` (`ville_id`),
  ADD KEY `filiere_bac_id` (`filiere_bac_id`),
  ADD KEY `choix1` (`choix1`),
  ADD KEY `choix2` (`choix2`);

--
-- Indexes for table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adminId` (`adminId`);

--
-- Indexes for table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adminId` (`adminId`);

--
-- Indexes for table `inscription`
--
ALTER TABLE `inscription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adminId` (`adminId`);

--
-- Indexes for table `villes`
--
ALTER TABLE `villes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ville` (`ville`),
  ADD KEY `adminId` (`adminId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `candidat`
--
ALTER TABLE `candidat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `departements`
--
ALTER TABLE `departements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inscription`
--
ALTER TABLE `inscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `villes`
--
ALTER TABLE `villes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidat`
--
ALTER TABLE `candidat`
  ADD CONSTRAINT `candidat_ibfk_1` FOREIGN KEY (`ville_id`) REFERENCES `villes` (`id`),
  ADD CONSTRAINT `candidat_ibfk_2` FOREIGN KEY (`filiere_bac_id`) REFERENCES `filiere` (`id`),
  ADD CONSTRAINT `candidat_ibfk_3` FOREIGN KEY (`choix1`) REFERENCES `departements` (`id`),
  ADD CONSTRAINT `candidat_ibfk_4` FOREIGN KEY (`choix2`) REFERENCES `departements` (`id`);

--
-- Constraints for table `departements`
--
ALTER TABLE `departements`
  ADD CONSTRAINT `departements_ibfk_1` FOREIGN KEY (`adminId`) REFERENCES `admin` (`id`);

--
-- Constraints for table `filiere`
--
ALTER TABLE `filiere`
  ADD CONSTRAINT `filiere_ibfk_1` FOREIGN KEY (`adminId`) REFERENCES `admin` (`id`);

--
-- Constraints for table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `inscription_ibfk_1` FOREIGN KEY (`adminId`) REFERENCES `admin` (`id`);

--
-- Constraints for table `villes`
--
ALTER TABLE `villes`
  ADD CONSTRAINT `villes_ibfk_1` FOREIGN KEY (`adminId`) REFERENCES `admin` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
