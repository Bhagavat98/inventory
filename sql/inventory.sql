-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2019 at 12:03 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `imei` varchar(25) NOT NULL,
  `vehicleName` varchar(150) DEFAULT NULL,
  `cost` float NOT NULL,
  `device_type` varchar(50) DEFAULT NULL,
  `renewal_charges` float DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `selling_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `billing_frequency` varchar(15) DEFAULT NULL,
  `unique_serial` varchar(50) DEFAULT NULL,
  `ICCD` varchar(255) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active',
  `features_allowed` bigint(20) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`id`, `email`, `imei`, `vehicleName`, `cost`, `device_type`, `renewal_charges`, `purchase_date`, `selling_date`, `expiry_date`, `billing_frequency`, `unique_serial`, `ICCD`, `status`, `features_allowed`, `updated_at`, `created_at`) VALUES
(1, 'keshav1@gmail.com', '11111111111111111', 'MH 12 2532', 2500, 'DM D', NULL, '2019-09-15', '2019-09-15', '2019-10-15', 'monthly', NULL, '1452222', 'InActive', NULL, '2019-12-07 06:17:10', '2019-11-03 16:20:38'),
(2, 'testdd@gmail.com', '2222222222222', 'MH 23 1046', 2000, 'TEst', NULL, '2019-07-15', '2019-06-17', '2020-07-15', 'yearly', NULL, NULL, 'Active', NULL, '2019-12-03 11:04:49', '2019-11-03 16:20:38'),
(3, 'keshav1@gmail.com', '11111111111111113', 'MH 14 2532', 2501, 'DM Y', 700, '2019-09-15', '2019-09-15', '2020-12-07', 'monthly', NULL, NULL, 'Active', 2, '2019-12-07 07:07:47', '2019-11-03 16:20:38');

-- --------------------------------------------------------

--
-- Table structure for table `recentactivity`
--

CREATE TABLE `recentactivity` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `recentactivityday` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recentactivity`
--

INSERT INTO `recentactivity` (`id`, `type`, `recentactivityday`, `created_at`) VALUES
(1, 'device', 8, '2019-11-05 11:36:23'),
(2, 'sim', 8, '2019-11-05 13:02:06');

-- --------------------------------------------------------

--
-- Table structure for table `sim`
--

CREATE TABLE `sim` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sim_no` bigint(20) NOT NULL,
  `sim_provider` varchar(255) DEFAULT NULL,
  `mobile_no` bigint(20) NOT NULL,
  `price` float DEFAULT NULL,
  `renewal_charges` float DEFAULT NULL,
  `billing_frequency` varchar(100) NOT NULL,
  `sale_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `features_allowed` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sim`
--

INSERT INTO `sim` (`id`, `email`, `sim_no`, `sim_provider`, `mobile_no`, `price`, `renewal_charges`, `billing_frequency`, `sale_date`, `expiry_date`, `status`, `features_allowed`, `created_at`, `updated_at`) VALUES
(1, 'bsolanke1@gmail.com', 1111111111, 'vodafone', 9890319605, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-11-06 04:22:33', '2019-11-06 04:22:33'),
(2, 'bsolanke1@gmail.com', 222222222, 'vodafone', 9890319605, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'closed', NULL, '2019-11-06 04:22:33', '2019-11-06 04:22:33'),
(3, 'bsolanke1@gmail.com', 333333333, 'vodafone', 9890319606, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-11-06 04:22:33', '2019-11-06 04:22:33'),
(4, 'bsolanke1@gmail.com', 444444444, 'vodafone', 9890319607, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-11-06 04:22:33', '2019-11-06 04:22:33'),
(5, 'rgleave0@phoca.cz', 5865065416, 'vodafone', 5865065416, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(6, 'mtooby1@theatlantic.com', 9276411607, 'vodafone', 9276411607, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(7, 'horeagan2@a8.net', 8185811350, 'vodafone', 8185811350, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(8, 'gshave3@mediafire.com', 8528443450, 'vodafone', 8528443450, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(9, 'egudgion4@vk.com', 4360021259, 'vodafone', 4360021259, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(10, 'tlargen5@miibeian.gov.cn', 9890319607, 'vodafone', 9890319607, 16, 16, 'monthly', '2018-09-15', '2020-12-06', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-06 11:46:48'),
(11, 'bbatt6@about.com', 8311701962, 'vodafone', 8311701962, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(12, 'cwhiteman7@businessinsider.com', 8632558978, 'vodafone', 8632558978, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(13, 'awycliffe8@storify.com', 7780354253, 'vodafone', 7780354253, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(14, 'psara9@barnesandnoble.com', 5719055592, 'vodafone', 5719055592, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(15, 'jmaccooka@multiply.com', 8796453966, 'vodafone', 8796453966, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(16, 'lellwellb@census.gov', 6068838099, 'vodafone', 6068838099, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(17, 'nsummertonc@nhs.uk', 199657602, 'vodafone', 199657602, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(18, 'lsollemed@wikipedia.org', 6871306021, 'vodafone', 6871306021, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(19, 'astonhame@about.com', 8309741766, 'vodafone', 8309741766, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(20, 'jgilpillanf@dailymail.co.uk', 7511440789, 'vodafone', 7511440789, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(21, 'rminigog@spotify.com', 3204478130, 'vodafone', 3204478130, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(22, 'jpetrish@state.gov', 8644367595, 'vodafone', 8644367595, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(23, 'vnottlei@digg.com', 3300613914, 'vodafone', 3300613914, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(24, 'lsyrattj@elpais.com', 576136832, 'vodafone', 576136832, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(25, 'nfarragherk@cam.ac.uk', 5956929170, 'vodafone', 5956929170, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(26, 'jbraghinil@homestead.com', 6351709326, 'vodafone', 6351709326, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(27, 'cluesleym@uiuc.edu', 2166336507, 'vodafone', 2166336507, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(28, 'sburrellsn@businesswire.com', 8549301418, 'vodafone', 8549301418, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(29, 'hhucko@youtube.com', 4289948006, 'vodafone', 4289948006, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(30, 'dmennearp@archive.org', 3040463934, 'vodafone', 3040463934, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(31, 'elinsteadq@123-reg.co.uk', 7090983099, 'vodafone', 7090983099, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(32, 'silyinykhr@npr.org', 9564665515, 'vodafone', 9564665515, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(33, 'ndiruggieros@ucsd.edu', 7375906521, 'vodafone', 7375906521, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(34, 'chaugert@seattletimes.com', 6623666443, 'vodafone', 6623666443, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(35, 'cgowryu@examiner.com', 334296323, 'vodafone', 334296323, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(36, 'ggirodierv@unc.edu', 1991411790, 'vodafone', 1991411790, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(37, 'cstilingw@mashable.com', 8940444620, 'vodafone', 8940444620, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(38, 'mjakucewiczx@vinaora.com', 4394433029, 'vodafone', 4394433029, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(39, 'ibeamondy@flickr.com', 7836810062, 'vodafone', 7836810062, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(40, 'kvendittoz@nasa.gov', 1446394948, 'vodafone', 1446394948, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(41, 'bclench10@china.com.cn', 4845724081, 'vodafone', 4845724081, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(42, 'jfaireclough11@toplist.cz', 8167086682, 'vodafone', 8167086682, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(43, 'emuselli12@usda.gov', 8944828199, 'vodafone', 8944828199, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(44, 'jdudhill13@amazon.com', 7090580261, 'vodafone', 7090580261, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(45, 'lspiller14@mediafire.com', 8699618565, 'vodafone', 8699618565, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(46, 'salejo15@harvard.edu', 7410610905, 'vodafone', 7410610905, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(47, 'byegorov16@moonfruit.com', 5820424255, 'vodafone', 5820424255, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(48, 'rweildish17@hibu.com', 3315306974, 'vodafone', 3315306974, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(49, 'lbanks18@dot.gov', 9713569636, 'vodafone', 9713569636, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(50, 'wjeanneau19@si.edu', 9152873889, 'vodafone', 9152873889, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(51, 'hmacklin1a@exblog.jp', 129906425, 'vodafone', 129906425, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(52, 'dspinozzi1b@epa.gov', 8819100347, 'vodafone', 8819100347, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(53, 'plansberry1c@sogou.com', 5565873290, 'vodafone', 5565873290, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(54, 'fgrewar1d@freewebs.com', 5099139833, 'vodafone', 5099139833, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(55, 'rdivine1e@eventbrite.com', 5590892414, 'vodafone', 5590892414, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(56, 'avenediktov1f@hostgator.com', 1216152586, 'vodafone', 1216152586, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(57, 'wlabbati1g@sfgate.com', 4932118929, 'vodafone', 4932118929, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(58, 'esmithers1h@japanpost.jp', 8610115542, 'vodafone', 8610115542, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(59, 'jkettlestringes1i@cloudflare.com', 9151984172, 'vodafone', 9151984172, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(60, 'abuddle1j@youtube.com', 7421759514, 'vodafone', 7421759514, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(61, 'edumphrey1k@angelfire.com', 5797358832, 'vodafone', 5797358832, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(62, 'lfossick1l@google.es', 8740222241, 'vodafone', 8740222241, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(63, 'fcamacke1m@uol.com.br', 1817848011, 'vodafone', 1817848011, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(64, 'dtownsend1n@baidu.com', 2897525509, 'vodafone', 2897525509, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(65, 'imorbey1o@hao123.com', 111401038, 'vodafone', 111401038, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(66, 'hdebney1p@admin.ch', 4136365942, 'vodafone', 4136365942, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(67, 'hdur1q@washington.edu', 7287012979, 'vodafone', 7287012979, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(68, 'bgallop1r@themeforest.net', 8070861185, 'vodafone', 8070861185, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(69, 'lmoresby1s@blogger.com', 429058462, 'vodafone', 429058462, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(70, 'jshepherdson1t@sohu.com', 8371648073, 'vodafone', 8371648073, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(71, 'lcasini1u@vkontakte.ru', 8228900384, 'vodafone', 8228900384, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(72, 'efaley1v@wired.com', 5218066567, 'vodafone', 5218066567, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(73, 'zmarzello1w@icq.com', 1235443779, 'vodafone', 1235443779, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(74, 'jmorcomb1x@oakley.com', 4585978461, 'vodafone', 4585978461, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(75, 'clongshaw1y@photobucket.com', 1348260793, 'vodafone', 1348260793, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(76, 'aneighbour1z@vistaprint.com', 2932238868, 'vodafone', 2932238868, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(77, 'ccromer20@google.com.au', 3348757339, 'vodafone', 3348757339, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(78, 'dcragell21@thetimes.co.uk', 3228432084, 'vodafone', 3228432084, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(79, 'hkeely22@123-reg.co.uk', 5669554191, 'vodafone', 5669554191, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(80, 'mbaumler23@delicious.com', 4584010382, 'vodafone', 4584010382, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(81, 'edielhenn24@forbes.com', 2966988916, 'vodafone', 2966988916, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(82, 'bmaccollom25@wp.com', 9384501646, 'vodafone', 9384501646, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(83, 'nmoseley26@ox.ac.uk', 7530461176, 'vodafone', 7530461176, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(84, 'iverbeek27@cam.ac.uk', 8899673829, 'vodafone', 8899673829, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(85, 'tdeath28@about.com', 7128614419, 'vodafone', 7128614419, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(86, 'clegalle29@comcast.net', 6231079562, 'vodafone', 6231079562, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(87, 'jwinders2a@cmu.edu', 4316701819, 'vodafone', 4316701819, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(88, 'rscutter2b@sakura.ne.jp', 65110986, 'vodafone', 65110986, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(89, 'ckermitt2c@geocities.jp', 6067553104, 'vodafone', 6067553104, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(90, 'rmandrake2d@cargocollective.com', 6002208488, 'vodafone', 6002208488, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(91, 'rhundall2e@ezinearticles.com', 88721531, 'vodafone', 88721531, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(92, 'slahive2f@artisteer.com', 429527004, 'vodafone', 429527004, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(93, 'cdumper2g@geocities.jp', 2788724284, 'vodafone', 2788724284, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(94, 'mjanata2h@multiply.com', 6388503004, 'vodafone', 6388503004, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(95, 'oscopyn2i@blinklist.com', 7211901330, 'vodafone', 7211901330, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(96, 'tsmeuin2j@dagondesign.com', 24617113, 'vodafone', 24617113, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(97, 'dhathorn2k@privacy.gov.au', 3099116890, 'vodafone', 3099116890, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(98, 'mrothery2l@chicagotribune.com', 3849702383, 'vodafone', 3849702383, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(99, 'wpercifull2m@guardian.co.uk', 1421503581, 'vodafone', 1421503581, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(100, 'dmacwhirter2n@linkedin.com', 7823387034, 'vodafone', 7823387034, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(101, 'samey2o@cnn.com', 8949190060, 'vodafone', 8949190060, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(102, 'elyles2p@cam.ac.uk', 9875488542, 'vodafone', 9875488542, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(103, 'fdooher2q@w3.org', 6388184480, 'vodafone', 6388184480, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(104, 'irubinowitsch2r@shutterfly.com', 5898746722, 'vodafone', 5898746722, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(105, 'tmarmon2s@disqus.com', 1068764880, 'vodafone', 1068764880, 16, NULL, 'year', '2019-09-15', '2020-09-15', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(107, 'keaklee2u@squidoo.com', 1002498279, 'vodafone', 1002498279, 16, NULL, 'year', '2019-12-02', '2020-12-02', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(108, 'jgadaud2v@tumblr.com', 5301701479, 'vodafone', 5301701479, 16, NULL, 'year', '2019-11-01', '2020-11-01', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(109, 'jlouche2w@ted.com', 5564734181, 'vodafone', 5564734181, 16, NULL, 'year', '2019-12-02', '2020-12-02', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(110, 'drapier2x@microsoft.com', 4230611439, 'vodafone', 4230611439, 16, NULL, 'year', '2018-04-12', '2019-04-12', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(111, 'apenhaligon2y@army.mil', 4112244037, 'vodafone', 4112244037, 16, NULL, 'year', '2019-02-08', '2020-02-08', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(112, 'jhullins2z@pcworld.com', 9804390523, 'vodafone', 9804390523, 16, NULL, 'year', '2019-06-06', '2020-06-06', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(113, 'fheaven30@pen.io', 4996628928, 'vodafone', 4996628928, 16, NULL, 'year', '2019-11-09', '2020-11-09', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(115, 'vtorns32@zdnet.com', 4353462946, 'vodafone', 4353462946, 16, NULL, 'year', '2019-06-01', '2020-06-01', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(116, 'pdangl33@sphinn.com', 726492574, 'vodafone', 726492574, 16, NULL, 'year', '2019-08-01', '2020-08-01', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(130, 'blinck3h@live.com', 7563622187, 'vodafone', 7563622187, 16, NULL, 'year', '2019-05-06', '2020-05-06', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(131, 'acadman3i@psu.edu', 7634028134, 'vodafone', 7634028134, 16, NULL, 'year', '2019-07-05', '2020-07-05', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(133, 'bsalzberger3k@europa.eu', 1512611360, 'vodafone', 1512611360, 16, NULL, 'year', '2019-12-09', '2020-12-09', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(135, 'rlehenmann3m@reverbnation.com', 6229668971, 'vodafone', 6229668971, 16, NULL, 'year', '2019-01-03', '2020-01-03', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(137, 'pdigg3o@who.int', 8391201171, 'vodafone', 8391201171, 16, NULL, 'year', '2019-01-08', '2020-01-08', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(140, 'rmccuish3r@blogspot.com', 4145507312, 'vodafone', 4145507312, 16, NULL, 'year', '2018-09-12', '2019-09-12', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(144, 'aguillotin3v@360.cn', 7164740267, 'vodafone', 7164740267, 16, NULL, 'year', '2019-05-08', '2020-05-08', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(149, 'tblair40@senate.gov', 5396979976, 'vodafone', 5396979976, 16, NULL, 'year', '2019-08-08', '2020-08-08', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(153, 'mlowres44@i2i.jp', 4456909498, 'vodafone', 4456909498, 16, NULL, 'year', '2019-03-10', '2020-03-10', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(159, 'aclimo4a@oakley.com', 4842283491, 'vodafone', 4842283491, 16, NULL, 'year', '2019-07-06', '2020-07-06', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(161, 'ckibbee4c@123-reg.co.uk', 6001406871, 'vodafone', 6001406871, 16, NULL, 'year', '2019-01-05', '2020-01-05', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(163, 'cboag4e@guardian.co.uk', 6545784528, 'vodafone', 6545784528, 16, NULL, 'year', '2019-03-10', '2020-03-10', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(164, 'yell4f@liveinternet.ru', 1238858813, 'vodafone', 1238858813, 16, NULL, 'year', '2019-10-02', '2020-10-02', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(165, 'gscone4g@sciencedaily.com', 2678856240, 'vodafone', 2678856240, 16, NULL, 'year', '2019-09-02', '2020-09-02', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(171, 'rtincombe4m@google.ru', 6167145407, 'vodafone', 6167145407, 16, NULL, 'year', '2019-01-10', '2020-01-10', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(172, 'thrishanok4n@oakley.com', 477474438, 'vodafone', 477474438, 16, NULL, 'year', '2019-02-03', '2020-02-03', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(174, 'dghidotti4p@zimbio.com', 4742385977, 'vodafone', 4742385977, 16, NULL, 'year', '2019-11-02', '2020-11-02', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(175, 'ddillicate4q@taobao.com', 8503205289, 'vodafone', 8503205289, 16, NULL, 'year', '2019-02-03', '2020-02-03', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(181, 'ndraycott4w@sun.com', 1940455936, 'vodafone', 1940455936, 16, NULL, 'year', '2019-12-09', '2020-12-09', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(182, 'ikenningham4x@telegraph.co.uk', 8632952609, 'vodafone', 8632952609, 16, NULL, 'year', '2019-12-03', '2020-12-03', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(183, 'lzamorrano4y@disqus.com', 6154562713, 'vodafone', 6154562713, 16, NULL, 'year', '2019-10-11', '2020-10-11', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(186, 'vundy51@dell.com', 8645469, 'vodafone', 8645469, 16, NULL, 'year', '2019-10-06', '2020-10-06', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(188, 'bcozby53@blogtalkradio.com', 6647932690, 'vodafone', 6647932690, 16, NULL, 'year', '2019-07-05', '2020-07-05', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(189, 'fgambles54@odnoklassniki.ru', 2084285550, 'vodafone', 2084285550, 16, NULL, 'year', '2019-11-08', '2020-11-08', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(198, 'lmajury5d@netvibes.com', 6840389162, 'vodafone', 6840389162, 16, NULL, 'year', '2019-10-04', '2020-10-04', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(199, 'kreen5e@myspace.com', 4805253339, 'vodafone', 4805253339, 16, NULL, 'year', '2018-07-12', '2019-07-12', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(202, 'ahatz5h@facebook.com', 1732406251, 'vodafone', 1732406251, 16, NULL, 'year', '2019-09-04', '2020-09-04', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(205, 'pdevaan5k@1688.com', 6283378749, 'vodafone', 6283378749, 16, NULL, 'year', '2019-12-04', '2020-12-04', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(208, 'cdevil5n@cafepress.com', 7048325992, 'vodafone', 7048325992, 16, NULL, 'year', '2019-08-05', '2020-08-05', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(210, 'nspata5p@redcross.org', 9454196804, 'vodafone', 9454196804, 16, NULL, 'year', '2019-11-02', '2020-11-02', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(212, 'eguitte5r@livejournal.com', 4605104348, 'vodafone', 4605104348, 16, NULL, 'year', '2019-10-04', '2020-10-04', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(213, 'mglewe5s@wikispaces.com', 3294264550, 'vodafone', 3294264550, 16, NULL, 'year', '2018-05-12', '2019-05-12', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(215, 'rchurn5u@ameblo.jp', 7167460966, 'vodafone', 7167460966, 16, NULL, 'year', '2019-02-05', '2020-02-05', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(216, 'ositford5v@sitemeter.com', 3041387883, 'vodafone', 3041387883, 16, NULL, 'year', '2019-01-01', '2020-01-01', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(219, 'amathewson5y@gnu.org', 2128953898, 'vodafone', 2128953898, 16, NULL, 'year', '2019-09-02', '2020-09-02', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(220, 'cchrismas5z@sina.com.cn', 1268266515, 'vodafone', 1268266515, 16, NULL, 'year', '2019-07-04', '2020-07-04', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(221, 'scanero60@sciencedirect.com', 6850667157, 'vodafone', 6850667157, 16, NULL, 'year', '2019-04-09', '2020-04-09', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(222, 'nponton61@amazonaws.com', 8531083885, 'vodafone', 8531083885, 16, NULL, 'year', '2019-05-01', '2020-05-01', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(224, 'dblaver63@mashable.com', 4224745038, 'vodafone', 4224745038, 16, NULL, 'year', '2019-12-01', '2020-12-01', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(225, 'lluten64@hc360.com', 5558793821, 'vodafone', 5558793821, 16, NULL, 'year', '2019-02-10', '2020-02-10', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(229, 'llithcow68@jugem.jp', 980235286, 'vodafone', 980235286, 16, NULL, 'year', '2019-02-11', '2020-02-11', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(230, 'kcraft69@pbs.org', 686658639, 'vodafone', 686658639, 16, NULL, 'year', '2019-05-07', '2020-05-07', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(237, 'iwadley6g@sciencedirect.com', 6356129883, 'vodafone', 6356129883, 16, NULL, 'year', '2019-10-02', '2020-10-02', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(238, 'mtraynor6h@webnode.com', 7723033303, 'vodafone', 7723033303, 16, NULL, 'year', '2019-04-08', '2020-04-08', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(240, 'jkeetley6j@virginia.edu', 7791384027, 'vodafone', 7791384027, 16, NULL, 'year', '2019-04-05', '2020-04-05', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(241, 'lflippen6k@youtube.com', 484813854, 'vodafone', 484813854, 16, NULL, 'year', '2019-06-05', '2020-06-05', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(244, 'sbeaconsall6n@nps.gov', 853916349, 'vodafone', 853916349, 16, NULL, 'year', '2018-04-12', '2019-04-12', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(245, 'ftooting6o@theguardian.com', 9663584459, 'vodafone', 9663584459, 16, NULL, 'year', '2019-03-04', '2020-03-04', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(247, 'lmoscrop6q@businesswire.com', 5015842090, 'vodafone', 5015842090, 16, NULL, 'year', '2019-11-09', '2020-11-09', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(250, 'bgandy6t@google.com.au', 2942296267, 'vodafone', 2942296267, 16, NULL, 'year', '2019-03-02', '2020-03-02', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(253, 'jharman6w@wordpress.org', 5871385036, 'vodafone', 5871385036, 16, NULL, 'year', '2019-03-09', '2020-03-09', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(257, 'fshrubb70@shareasale.com', 9782574449, 'vodafone', 9782574449, 16, NULL, 'year', '2019-05-09', '2020-05-09', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(259, 'wmoorman72@tumblr.com', 4261576422, 'vodafone', 4261576422, 16, NULL, 'year', '2019-05-09', '2020-05-09', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(263, 'rgwyer76@oracle.com', 8293745010, 'vodafone', 8293745010, 16, NULL, 'year', '2019-03-10', '2020-03-10', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(264, 'ejerschke77@umich.edu', 1967795398, 'vodafone', 1967795398, 16, NULL, 'year', '2019-04-03', '2020-04-03', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(267, 'lhordell7a@alexa.com', 9849385812, 'vodafone', 9849385812, 16, NULL, 'year', '2019-06-03', '2020-06-03', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(269, 'mbeevis7c@vistaprint.com', 2142874940, 'vodafone', 2142874940, 16, NULL, 'year', '2019-10-05', '2020-10-05', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(270, 'ealenikov7d@1688.com', 6071907403, 'vodafone', 6071907403, 16, NULL, 'year', '2018-02-12', '2019-02-12', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(271, 'rleftly7e@imdb.com', 7297560561, 'vodafone', 7297560561, 16, NULL, 'year', '2019-01-05', '2020-01-05', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(274, 'cbode7h@squidoo.com', 514184787, 'vodafone', 514184787, 16, NULL, 'year', '2019-12-03', '2020-12-03', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(278, 'ceckart7l@amazon.co.jp', 9004741011, 'vodafone', 9004741011, 16, NULL, 'year', '2019-01-03', '2020-01-03', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(282, 'eselvester7p@hexun.com', 51400022, 'vodafone', 51400022, 16, NULL, 'year', '2019-03-01', '2020-03-01', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(286, 'jlukesch7t@i2i.jp', 2743433019, 'vodafone', 2743433019, 16, NULL, 'year', '2019-02-03', '2020-02-03', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(290, 'hcordingly7x@ning.com', 1407378333, 'vodafone', 1407378333, 16, NULL, 'year', '2019-09-01', '2020-09-01', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(291, 'sdabes7y@slideshare.net', 987791729, 'vodafone', 987791729, 16, NULL, 'year', '2018-03-12', '2019-03-12', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(293, 'eragbourn80@wikimedia.org', 4746733716, 'vodafone', 4746733716, 16, NULL, 'year', '2019-12-05', '2020-12-05', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(298, 'wpape85@elegantthemes.com', 9470265556, 'vodafone', 9470265556, 16, NULL, 'year', '2019-11-05', '2020-11-05', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(300, 'pmcmennum87@furl.net', 8353605228, 'vodafone', 8353605228, 16, NULL, 'year', '2019-12-04', '2020-12-04', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(306, 'tewbanke8d@reddit.com', 9082113899, 'vodafone', 9082113899, 16, NULL, 'year', '2019-10-02', '2020-10-02', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(309, 'ayanshinov8g@icq.com', 4513796103, 'vodafone', 4513796103, 16, NULL, 'year', '2019-01-10', '2020-01-10', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(311, 'gmccarney8i@ucoz.com', 6199233999, 'vodafone', 6199233999, 16, NULL, 'year', '2019-03-10', '2020-03-10', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(316, 'alamshead8n@1und1.de', 9886865784, 'vodafone', 9886865784, 16, NULL, 'year', '2019-11-01', '2020-11-01', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(319, 'abaird8q@arizona.edu', 6936753159, 'vodafone', 6936753159, 16, NULL, 'year', '2019-03-08', '2020-03-08', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(320, 'cmolesworth8r@zimbio.com', 9805818454, 'vodafone', 9805818454, 16, NULL, 'year', '2018-07-12', '2019-07-12', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(322, 'ajephcote8t@sciencedaily.com', 1350325325, 'vodafone', 1350325325, 16, NULL, 'year', '2019-11-09', '2020-11-09', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(323, 'emaulden8u@aol.com', 6851800756, 'vodafone', 6851800756, 16, NULL, 'year', '2019-09-01', '2020-09-01', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(326, 'cbatey8x@slate.com', 5033480588, 'vodafone', 5033480588, 16, NULL, 'year', '2019-01-10', '2020-01-10', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(329, 'jlindenbluth90@wikipedia.org', 9956904732, 'vodafone', 9956904732, 16, NULL, 'year', '2019-03-03', '2020-03-03', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(333, 'fcursons94@is.gd', 632192682, 'vodafone', 632192682, 16, NULL, 'year', '2019-11-11', '2020-11-11', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(336, 'rmedling97@symantec.com', 2592302557, 'vodafone', 2592302557, 16, NULL, 'year', '2019-01-05', '2020-01-05', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(339, 'rjenicke9a@webmd.com', 4039326415, 'vodafone', 4039326415, 16, NULL, 'year', '2019-08-10', '2020-08-10', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(340, 'cowenson9b@businesswire.com', 6082911229, 'vodafone', 6082911229, 16, NULL, 'year', '2019-09-03', '2020-09-03', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(343, 'olauritzen9e@lulu.com', 8041001033, 'vodafone', 8041001033, 16, NULL, 'year', '2019-03-02', '2020-03-02', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(345, 'bianizzi9g@alibaba.com', 8765817516, 'vodafone', 8765817516, 16, NULL, 'year', '2019-04-09', '2020-04-09', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(347, 'kmil9i@fc2.com', 7082554958, 'vodafone', 7082554958, 16, NULL, 'year', '2019-01-10', '2020-01-10', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(348, 'cpunyer9j@blog.com', 2031830732, 'vodafone', 2031830732, 16, NULL, 'year', '2019-04-05', '2020-04-05', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(350, 'clohde9l@chicagotribune.com', 1004572611, 'vodafone', 1004572611, 16, NULL, 'year', '2019-03-10', '2020-03-10', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(352, 'ldewar9n@gizmodo.com', 8162231072, 'vodafone', 8162231072, 16, NULL, 'year', '2019-06-08', '2020-06-08', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(354, 'jdureden9p@senate.gov', 5784255959, 'vodafone', 5784255959, 16, NULL, 'year', '2019-03-11', '2020-03-11', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(355, 'acatley9q@mozilla.com', 4382261481, 'vodafone', 4382261481, 16, NULL, 'year', '2019-08-10', '2020-08-10', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(357, 'tmorratt9s@alexa.com', 9186779516, 'vodafone', 9186779516, 16, NULL, 'year', '2019-09-11', '2020-09-11', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(359, 'ufawks9u@list-manage.com', 5682469755, 'vodafone', 5682469755, 16, NULL, 'year', '2019-11-11', '2020-11-11', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(362, 'hhull9x@elegantthemes.com', 6196563173, 'vodafone', 6196563173, 16, NULL, 'year', '2019-11-11', '2020-11-11', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(363, 'slevi9y@wikipedia.org', 3848343037, 'vodafone', 3848343037, 16, NULL, 'year', '2019-03-05', '2020-03-05', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(368, 'lrapea3@virginia.edu', 1990165079, 'vodafone', 1990165079, 16, NULL, 'year', '2019-08-11', '2020-08-11', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(370, 'rpiotra5@usa.gov', 4767891345, 'vodafone', 4767891345, 16, NULL, 'year', '2019-07-06', '2020-07-06', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(371, 'mjosefovica6@ucoz.com', 1226775187, 'vodafone', 1226775187, 16, NULL, 'year', '2019-02-02', '2020-02-02', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(372, 'anapthinea7@kickstarter.com', 1585107700, 'vodafone', 1585107700, 16, NULL, 'year', '2018-09-12', '2019-09-12', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(373, 'mosbourna8@discovery.com', 7959625050, 'vodafone', 7959625050, 16, NULL, 'year', '2019-02-09', '2020-02-09', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(378, 'poatsad@mashable.com', 6833495424, 'vodafone', 6833495424, 16, NULL, 'year', '2019-11-04', '2020-11-04', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(380, 'msweedlandaf@pcworld.com', 1882922611, 'vodafone', 1882922611, 16, NULL, 'year', '2018-09-12', '2019-09-12', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(382, 'gstoffersenah@vimeo.com', 4845293579, 'vodafone', 4845293579, 16, NULL, 'year', '2019-06-02', '2020-06-02', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(384, 'wclayhillaj@apple.com', 5259913493, 'vodafone', 5259913493, 16, NULL, 'year', '2019-06-11', '2020-06-11', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(388, 'emorsheadan@altervista.org', 174764626, 'vodafone', 174764626, 16, NULL, 'year', '2019-02-02', '2020-02-02', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(389, 'rhealeyao@merriam-webster.com', 753788756, 'vodafone', 753788756, 16, NULL, 'year', '2019-11-02', '2020-11-02', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(390, 'bbondesenap@sakura.ne.jp', 4587499080, 'vodafone', 4587499080, 16, NULL, 'year', '2019-03-08', '2020-03-08', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(393, 'mthirskas@wufoo.com', 954621425, 'vodafone', 954621425, 16, NULL, 'year', '2019-02-04', '2020-02-04', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(397, 'gaskawaw@canalblog.com', 1351509802, 'vodafone', 1351509802, 16, NULL, 'year', '2019-02-09', '2020-02-09', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(398, 'bbussyax@sakura.ne.jp', 1513354310, 'vodafone', 1513354310, 16, NULL, 'year', '2019-06-07', '2020-06-07', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(400, 'tdorroaz@oakley.com', 9367043775, 'vodafone', 9367043775, 16, NULL, 'year', '2019-09-03', '2020-09-03', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(402, 'cfronzekb1@usgs.gov', 4940421589, 'vodafone', 4940421589, 16, NULL, 'year', '2019-09-10', '2020-09-10', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(405, 'rdanaherb4@imageshack.us', 9158368477, 'vodafone', 9158368477, 16, NULL, 'year', '2019-04-11', '2020-04-11', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(407, 'egrowdenb6@blogspot.com', 2955594512, 'vodafone', 2955594512, 16, NULL, 'year', '2018-05-12', '2019-05-12', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(410, 'bpertb9@skype.com', 6253421603, 'vodafone', 6253421603, 16, NULL, 'year', '2019-07-03', '2020-07-03', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(413, 'aastillbc@chronoengine.com', 9132213603, 'vodafone', 9132213603, 16, NULL, 'year', '2019-08-04', '2020-08-04', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(414, 'pdodameadbd@privacy.gov.au', 9554407548, 'vodafone', 9554407548, 16, NULL, 'year', '2019-12-01', '2020-12-01', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(423, 'bsummerrellbm@wp.com', 5299707525, 'vodafone', 5299707525, 16, NULL, 'year', '2019-04-03', '2020-04-03', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(426, 'epeersbp@blogger.com', 4341466437, 'vodafone', 4341466437, 16, NULL, 'year', '2019-12-09', '2020-12-09', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(428, 'mdoogbr@networkadvertising.org', 6240872725, 'vodafone', 6240872725, 16, NULL, 'year', '2019-04-11', '2020-04-11', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(431, 'lmularkeybu@tripadvisor.com', 5143639565, 'vodafone', 5143639565, 16, NULL, 'year', '2019-02-04', '2020-02-04', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(432, 'rkienlbv@marriott.com', 1735308218, 'vodafone', 1735308218, 16, NULL, 'year', '2019-02-11', '2020-02-11', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(435, 'cdonisoby@bloomberg.com', 3640085833, 'vodafone', 3640085833, 16, NULL, 'year', '2019-06-10', '2020-06-10', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(436, 'sclatworthybz@paginegialle.it', 3909847889, 'vodafone', 3909847889, 16, NULL, 'year', '2019-03-10', '2020-03-10', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(444, 'cgraddonc7@ted.com', 6943910981, 'vodafone', 6943910981, 16, NULL, 'year', '2019-11-03', '2020-11-03', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(446, 'dsammesc9@mlb.com', 2887279033, 'vodafone', 2887279033, 16, NULL, 'year', '2019-05-04', '2020-05-04', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(450, 'agaenorcd@delicious.com', 194780074, 'vodafone', 194780074, 16, NULL, 'year', '2019-08-11', '2020-08-11', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(454, 'lcotheych@printfriendly.com', 9385761587, 'vodafone', 9385761587, 16, NULL, 'year', '2019-11-08', '2020-11-08', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(459, 'pdoddridgecm@list-manage.com', 4832822276, 'vodafone', 4832822276, 16, NULL, 'year', '2019-07-09', '2020-07-09', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(461, 'jfredyco@imageshack.us', 9659361998, 'vodafone', 9659361998, 16, NULL, 'year', '2018-12-12', '2019-12-12', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(464, 'ikohlermancr@jigsy.com', 8112034346, 'vodafone', 8112034346, 16, NULL, 'year', '2019-03-09', '2020-03-09', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(465, 'etarboxcs@ifeng.com', 7323874955, 'vodafone', 7323874955, 16, NULL, 'year', '2019-09-05', '2020-09-05', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(467, 'dpocklingtoncu@fastcompany.com', 1793057672, 'vodafone', 1793057672, 16, NULL, 'year', '2018-02-12', '2019-02-12', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(472, 'ktrumpercz@unicef.org', 5479191829, 'vodafone', 5479191829, 16, NULL, 'year', '2019-02-05', '2020-02-05', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(473, 'fbletsord0@soundcloud.com', 9657684935, 'vodafone', 9657684935, 16, NULL, 'year', '2019-03-11', '2020-03-11', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(480, 'pmullettd7@sogou.com', 3326030630, 'vodafone', 3326030630, 16, NULL, 'year', '2019-10-09', '2020-10-09', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(481, 'zguerreaud8@yandex.ru', 6694357540, 'vodafone', 6694357540, 16, NULL, 'year', '2019-02-02', '2020-02-02', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(487, 'hbowditchde@bloomberg.com', 2571589350, 'vodafone', 2571589350, 16, NULL, 'year', '2019-12-07', '2020-12-07', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(498, 'fblondindp@yolasite.com', 5557850147, 'vodafone', 5557850147, 16, NULL, 'year', '2018-10-12', '2019-10-12', 'InActive', NULL, '2019-12-02 12:21:24', '2019-12-06 11:58:25'),
(499, 'rolliffdq@webeden.co.uk', 163290318, 'vodafone', 163290318, 16, NULL, 'year', '2018-11-12', '2019-11-12', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(500, 'jhargittdr@yale.edu', 2012276237, 'vodafone', 2012276237, 16, NULL, 'year', '2019-03-01', '2020-03-01', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(503, 'zwilmutdu@e-recht24.de', 1003474381, 'vodafone', 1003474381, 16, NULL, 'year', '2019-12-01', '2020-12-01', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(506, 'alegiondx@howstuffworks.com', 8621660598, 'vodafone', 8621660598, 16, NULL, 'year', '2019-02-05', '2020-02-05', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(507, 'mnewcomdy@cargocollective.com', 7546640989, 'vodafone', 7546640989, 16, NULL, 'year', '2018-04-12', '2019-04-12', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(508, 'jidiensdz@bluehost.com', 6754361719, 'vodafone', 6754361719, 16, NULL, 'year', '2019-04-01', '2020-04-01', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(509, 'sdiesse0@constantcontact.com', 7195526801, 'vodafone', 7195526801, 16, NULL, 'year', '2019-10-02', '2020-10-02', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(510, 'clabese1@cnbc.com', 4732486630, 'vodafone', 4732486630, 16, NULL, 'year', '2019-07-09', '2020-07-09', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(511, 'phennigere2@e-recht24.de', 2928184236, 'vodafone', 2928184236, 16, NULL, 'year', '2019-10-11', '2020-10-11', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(513, 'bcavillae4@un.org', 9576133769, 'vodafone', 9576133769, 16, NULL, 'year', '2019-07-04', '2020-07-04', 'in_used', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24'),
(514, 'kleinthalle5@ucoz.com', 8271453459, 'vodafone', 8271453459, 16, NULL, 'year', '2019-04-01', '2020-04-01', 'closed', NULL, '2019-12-02 12:21:24', '2019-12-02 12:21:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `longitude` varchar(50) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_super_admin` tinyint(4) DEFAULT '0',
  `is_admin` tinyint(4) DEFAULT '0',
  `is_user` int(11) NOT NULL DEFAULT '0',
  `manager_id` int(11) NOT NULL,
  `profile_img` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `features_allowed` bigint(20) DEFAULT NULL,
  `status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_zone` varchar(150) DEFAULT 'Asia/Kolkata',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `address`, `longitude`, `latitude`, `email_verified_at`, `password`, `is_super_admin`, `is_admin`, `is_user`, `manager_id`, `profile_img`, `features_allowed`, `status`, `remember_token`, `time_zone`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@gmail.com', 1234567890, NULL, NULL, NULL, NULL, '$2y$10$2D///wLwMQ0lwj3b47khh.1Fu6LEXkV3s4zKr5OjQhqkTAtVhenTO', 1, 0, 0, 0, 'images/user_img.jpg', NULL, 'active', NULL, 'Asia/Kolkata', '2019-06-18 12:58:42', '2019-06-18 12:58:42'),
(2, 'Opal', 'opal@gmail.com', NULL, 'Baner Pune', NULL, NULL, NULL, '$2y$10$gwWXywOzz0MQYicJUIEk6OctxhXv8WmddtnUGdJTez/D/zAKskkiG', 0, 1, 0, 1, 'images/user_img.jpg', NULL, 'active', NULL, 'Asia/Kolkata', '2019-06-18 13:42:41', '2019-06-18 13:42:41'),
(3, 'Ganesh', 'ganesh@gmail.com', NULL, 'Shivaji Nagar Pune', NULL, NULL, NULL, '$2y$10$ug1Q5C6oWg4p9qBRPJb1degqQRaX2D5phzd2uoxg9Iiq5KYVDefU6', 0, 1, 0, 1, 'images/user_img.jpg', NULL, 'active', NULL, 'Asia/Kolkata', '2019-06-18 13:44:09', '2019-06-18 13:44:09'),
(4, 'Test User', 'user@gmail.com', 1234567891, 'Pune', NULL, NULL, NULL, '$2y$10$f1h1qRvQaW3WLULiHLDg9e0BVkkAg264MIxYwiwJJFiZBVnWDh6v6', 0, 0, 1, 1, NULL, NULL, 'active', NULL, 'Asia/Kolkata', '2019-10-18 17:01:12', '2019-10-18 17:01:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `imei` (`imei`);

--
-- Indexes for table `recentactivity`
--
ALTER TABLE `recentactivity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sim`
--
ALTER TABLE `sim`
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
-- AUTO_INCREMENT for table `device`
--
ALTER TABLE `device`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `recentactivity`
--
ALTER TABLE `recentactivity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sim`
--
ALTER TABLE `sim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=626;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE `other_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `price` bigint(20) NOT NULL,
  `description` longtext NULL DEFAULT NULL,
  `sale_date` date DEFAULT NULL,
  `billing_frequency` int(11) NULL DEFAULT NULL,
  `sold_stock` int(11) NULL DEFAULT NULL,
  `manager_id` int(11) NOT  NULL,
  `last_update_by` varchar(222) NOT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `delivery_challan` ADD `quantity` BIGINT NULL DEFAULT NULL AFTER `price`;

ALTER TABLE `delivery_challan` ADD `other_stock_id` VARCHAR(222) NULL DEFAULT NULL AFTER `items`;