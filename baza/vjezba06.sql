-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2024 at 11:14 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vjezba06`
--

-- --------------------------------------------------------

--
-- Table structure for table `grad`
--

CREATE TABLE `grad` (
  `id` int(11) NOT NULL,
  `naziv` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grad`
--

INSERT INTO `grad` (`id`, `naziv`) VALUES
(1, 'Osijek'),
(8, 'Požega'),
(5, 'Rijeka'),
(6, 'Šibenik'),
(10, 'Slavonski Brod'),
(3, 'Split'),
(7, 'Varaždin'),
(9, 'Virovitica'),
(12, 'Vukovar'),
(4, 'Zadar'),
(2, 'Zagreb'),
(11, 'Đakovo');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(50) DEFAULT NULL,
  `prezime` varchar(75) DEFAULT NULL,
  `korisnicko_ime` varchar(75) NOT NULL,
  `password` varchar(100) NOT NULL,
  `uloga` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `korisnicko_ime`, `password`, `uloga`) VALUES
(28, 'Fran', 'Kroflin', 'fkroflin', '$2y$10$srZ.OWMFw6Mhj.u5kOJ2L.VGCL8PYoWMi9szxRH5XZ3y.T3i2E4sO', 'menađer'),
(30, 'Sven', 'Kroflin', 'skroflin', '$2y$10$pW8.rDrWLqCXR0OpLnF7b.pRp7/lPPhVb5ofrG9WWBpAJ6diog9sO', 'menađer'),
(32, 'Petar', 'Žiga', 'pziga', '$2y$10$CFet/8ses6XyJqEz3RBUXOacECQDsT1qw54xg8RdBlQfvYIBHxHsa', 'djelatnik'),
(34, 'Paula', 'Krznarić', 'pkrzna', '$2y$10$2rbou1VBUZ/eeprouFU0Le6y4EsSmrCxBwWzHYkZ996XVFrM6jnWC', 'menađer'),
(35, '', '', '', '$2y$10$y/M1DhvB6LusU6csCtSwxeEi78iIUOUG7lRHPJDHL170SRdXBa7D6', ''),
(36, 'Matea', 'Jukić', 'mjukic2', '$2y$10$5E7yV7RjOdapmzf7sEI6veCFv6mYkoGLwn6HPcbnbZB9OCuTUr6Oi', 'djelatnik'),
(38, 'Sven', 'Kroflin', 'kroflins', '$2y$10$2jUtZq34zh/zVtpcARwot.bmW879WzanZFdwTiqq2NZN23ysztjcO', 'menađer');

-- --------------------------------------------------------

--
-- Table structure for table `polaznik`
--

CREATE TABLE `polaznik` (
  `id` int(11) NOT NULL,
  `ime` varchar(30) NOT NULL,
  `prezime` varchar(60) DEFAULT NULL,
  `adresa` varchar(80) DEFAULT NULL,
  `grad_id` int(11) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `spol` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `polaznik`
--

INSERT INTO `polaznik` (`id`, `ime`, `prezime`, `adresa`, `grad_id`, `email`, `spol`) VALUES
(67, 'Sven', 'Kroflin', 'Sjenjak 48', 1, 'skroflin@ffos.hr', 'm'),
(109, 'Franka', 'Kroflin', 'Sjenjak 48', 1, 'fkroflin@etfos.hr', 'z'),
(111, 'Antonio', 'Milaković', 'Savska 11', 2, 'antoniomil@gmail.com', 'm'),
(113, 'Petar', 'Žiga', 'Tvrđa 1', 2, 'pziga@ffos.hr', 'm'),
(115, 'Paula', 'Krznarić', 'Dubrovačka 9', 2, 'pkrznaric@ffos.hr', 'z'),
(117, 'Vladimir', 'Kroflin', 'Jelačićeva 102', 8, 'krofna@gmail.com', 'm'),
(121, 'Boris', 'Bosančić', 'Matoševa 9', 10, 'bbosancic@ffos.hr', 'm'),
(123, 'Stjepan', 'Šokčević', 'Sjenjak 48', 10, 'sokcevisstjepan89@gmail.com', 'm'),
(125, 'Inga', 'Pemper', 'Arkanska 3', 12, 'ipemper', 'z');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grad`
--
ALTER TABLE `grad`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `naziv` (`naziv`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`);

--
-- Indexes for table `polaznik`
--
ALTER TABLE `polaznik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `grad_id` (`grad_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grad`
--
ALTER TABLE `grad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `polaznik`
--
ALTER TABLE `polaznik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `polaznik`
--
ALTER TABLE `polaznik`
  ADD CONSTRAINT `polaznik_ibfk_1` FOREIGN KEY (`grad_id`) REFERENCES `grad` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
