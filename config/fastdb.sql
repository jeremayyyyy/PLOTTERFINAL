-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2025 at 10:19 PM
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
-- Database: `control_piezas`
--
CREATE DATABASE IF NOT EXISTS `control_piezas` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `control_piezas`;

-- --------------------------------------------------------

--
-- Table structure for table `piezas`
--

CREATE TABLE `piezas` (
  `id` int(11) NOT NULL,
  `articulo` varchar(100) DEFAULT NULL,
  `prenda` varchar(100) DEFAULT NULL,
  `parte` varchar(100) DEFAULT NULL,
  `talle` varchar(20) DEFAULT NULL,
  `valor` decimal(5,2) DEFAULT NULL,
  `curva` varchar(100) DEFAULT NULL,
  `tipo_curva` varchar(20) DEFAULT NULL,
  `fila` int(11) DEFAULT NULL,
  `columna` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `piezas`
--

INSERT INTO `piezas` (`id`, `articulo`, `prenda`, `parte`, `talle`, `valor`, `curva`, `tipo_curva`, `fila`, `columna`, `fecha`) VALUES
(157, 'i25 1000v', 'Remera', 'Delantero', '2', 1.00, '2-4-6-8-10-12-14-16', '1-2', 0, 1, '2025-09-24 19:24:45'),
(158, 'i25 1000v', 'Remera', 'Delantero', '4', 1.00, '2-4-6-8-10-12-14-16', '1-2', 0, 2, '2025-09-24 19:24:45'),
(159, 'i25 1000v', 'Remera', 'Delantero', '6', 1.00, '2-4-6-8-10-12-14-16', '1-2', 0, 3, '2025-09-24 19:24:45'),
(160, 'i25 1000v', 'Remera', 'Delantero', '8', 1.00, '2-4-6-8-10-12-14-16', '1-2', 0, 4, '2025-09-24 19:24:45'),
(161, 'i25 1000v', 'Remera', 'Delantero', '10', 1.00, '2-4-6-8-10-12-14-16', '1-2', 0, 5, '2025-09-24 19:24:45'),
(162, 'i25 1000v', 'Remera', 'Delantero', '12', 1.00, '2-4-6-8-10-12-14-16', '1-2', 0, 6, '2025-09-24 19:24:45'),
(163, 'i25 1000v', 'Remera', 'Delantero', '14', 1.00, '2-4-6-8-10-12-14-16', '1-2', 0, 7, '2025-09-24 19:24:45'),
(164, 'i25 1000v', 'Remera', 'Delantero', '16', 1.00, '2-4-6-8-10-12-14-16', '1-2', 0, 8, '2025-09-24 19:24:45'),
(165, 'i25 1000v', 'Remera', 'Espalda', '2', 0.00, '2-4-6-8-10-12-14-16', '1-2', 1, 1, '2025-09-24 19:24:45'),
(166, 'i25 1000v', 'Remera', 'Espalda', '4', 0.00, '2-4-6-8-10-12-14-16', '1-2', 1, 2, '2025-09-24 19:24:45'),
(167, 'i25 1000v', 'Remera', 'Espalda', '6', 0.00, '2-4-6-8-10-12-14-16', '1-2', 1, 3, '2025-09-24 19:24:45'),
(168, 'i25 1000v', 'Remera', 'Espalda', '8', 0.00, '2-4-6-8-10-12-14-16', '1-2', 1, 4, '2025-09-24 19:24:45'),
(169, 'i25 1000v', 'Remera', 'Espalda', '10', 0.00, '2-4-6-8-10-12-14-16', '1-2', 1, 5, '2025-09-24 19:24:45'),
(170, 'i25 1000v', 'Remera', 'Espalda', '12', 0.00, '2-4-6-8-10-12-14-16', '1-2', 1, 6, '2025-09-24 19:24:45'),
(171, 'i25 1000v', 'Remera', 'Espalda', '14', 0.00, '2-4-6-8-10-12-14-16', '1-2', 1, 7, '2025-09-24 19:24:45'),
(172, 'i25 1000v', 'Remera', 'Espalda', '16', 0.00, '2-4-6-8-10-12-14-16', '1-2', 1, 8, '2025-09-24 19:24:45'),
(173, 'i25 1000v', 'Remera', 'Manga', '2', 0.00, '2-4-6-8-10-12-14-16', '1-2', 2, 1, '2025-09-24 19:24:45'),
(174, 'i25 1000v', 'Remera', 'Manga', '4', 0.00, '2-4-6-8-10-12-14-16', '1-2', 2, 2, '2025-09-24 19:24:45'),
(175, 'i25 1000v', 'Remera', 'Manga', '6', 0.00, '2-4-6-8-10-12-14-16', '1-2', 2, 3, '2025-09-24 19:24:45'),
(176, 'i25 1000v', 'Remera', 'Manga', '8', 0.00, '2-4-6-8-10-12-14-16', '1-2', 2, 4, '2025-09-24 19:24:45'),
(177, 'i25 1000v', 'Remera', 'Manga', '10', 0.00, '2-4-6-8-10-12-14-16', '1-2', 2, 5, '2025-09-24 19:24:45'),
(178, 'i25 1000v', 'Remera', 'Manga', '12', 0.00, '2-4-6-8-10-12-14-16', '1-2', 2, 6, '2025-09-24 19:24:45'),
(179, 'i25 1000v', 'Remera', 'Manga', '14', 0.00, '2-4-6-8-10-12-14-16', '1-2', 2, 7, '2025-09-24 19:24:45'),
(180, 'i25 1000v', 'Remera', 'Manga', '16', 0.00, '2-4-6-8-10-12-14-16', '1-2', 2, 8, '2025-09-24 19:24:45'),
(261, 'i25 1000v', 'Remera', 'Delantero', '2', 0.00, '2-4-6-8-10-12-14-16', '1-2', 1, 1, '2025-09-24 19:23:46'),
(262, 'i25 1000v', 'Remera', 'Delantero', '4', 0.00, '2-4-6-8-10-12-14-16', '1-2', 1, 2, '2025-09-24 19:23:46'),
(263, 'i25 1000v', 'Remera', 'Delantero', '6', 0.00, '2-4-6-8-10-12-14-16', '1-2', 1, 3, '2025-09-24 19:23:46'),
(264, 'i25 1000v', 'Remera', 'Delantero', '8', 0.00, '2-4-6-8-10-12-14-16', '1-2', 1, 4, '2025-09-24 19:23:46'),
(265, 'i25 1000v', 'Remera', 'Delantero', '10', 0.00, '2-4-6-8-10-12-14-16', '1-2', 1, 5, '2025-09-24 19:23:46'),
(266, 'i25 1000v', 'Remera', 'Delantero', '12', 0.00, '2-4-6-8-10-12-14-16', '1-2', 1, 6, '2025-09-24 19:23:46'),
(267, 'i25 1000v', 'Remera', 'Delantero', '14', 0.00, '2-4-6-8-10-12-14-16', '1-2', 1, 7, '2025-09-24 19:23:46'),
(268, 'i25 1000v', 'Remera', 'Delantero', '16', 0.00, '2-4-6-8-10-12-14-16', '1-2', 1, 8, '2025-09-24 19:23:46'),
(269, 'i25 1000v', 'Remera', 'Delantero', '2', 0.00, '2-4-6-8-10-12-14-16', '1-2', 2, 1, '2025-09-24 19:23:46'),
(270, 'i25 1000v', 'Remera', 'Delantero', '4', 0.00, '2-4-6-8-10-12-14-16', '1-2', 2, 2, '2025-09-24 19:23:46'),
(271, 'i25 1000v', 'Remera', 'Delantero', '6', 0.00, '2-4-6-8-10-12-14-16', '1-2', 2, 3, '2025-09-24 19:23:46'),
(272, 'i25 1000v', 'Remera', 'Delantero', '8', 0.00, '2-4-6-8-10-12-14-16', '1-2', 2, 4, '2025-09-24 19:23:46'),
(273, 'i25 1000v', 'Remera', 'Delantero', '10', 0.00, '2-4-6-8-10-12-14-16', '1-2', 2, 5, '2025-09-24 19:23:46'),
(274, 'i25 1000v', 'Remera', 'Delantero', '12', 0.00, '2-4-6-8-10-12-14-16', '1-2', 2, 6, '2025-09-24 19:23:46'),
(275, 'i25 1000v', 'Remera', 'Delantero', '14', 0.00, '2-4-6-8-10-12-14-16', '1-2', 2, 7, '2025-09-24 19:23:46'),
(276, 'i25 1000v', 'Remera', 'Delantero', '16', 0.00, '2-4-6-8-10-12-14-16', '1-2', 2, 8, '2025-09-24 19:23:46'),
(349, 'i25 3031v', 'Pantalon', 'Delantero', '4', 2.00, '4-6-8-10-12-14', '2-3', 0, 1, '2025-09-24 19:28:46'),
(350, 'i25 3031v', 'Pantalon', 'Delantero', '6', 3.00, '4-6-8-10-12-14', '2-3', 0, 2, '2025-09-24 19:28:46'),
(351, 'i25 3031v', 'Pantalon', 'Delantero', '8', 3.00, '4-6-8-10-12-14', '2-3', 0, 3, '2025-09-24 19:28:46'),
(352, 'i25 3031v', 'Pantalon', 'Delantero', '10', 3.00, '4-6-8-10-12-14', '2-3', 0, 4, '2025-09-24 19:28:46'),
(353, 'i25 3031v', 'Pantalon', 'Delantero', '12', 2.00, '4-6-8-10-12-14', '2-3', 0, 5, '2025-09-24 19:28:46'),
(354, 'i25 3031v', 'Pantalon', 'Delantero', '14', 2.00, '4-6-8-10-12-14', '2-3', 0, 6, '2025-09-24 19:28:46'),
(355, 'i25 3031v', 'Pantalon', 'Espalda', '4', 2.00, '4-6-8-10-12-14', '2-3', 1, 1, '2025-09-24 19:28:46'),
(356, 'i25 3031v', 'Pantalon', 'Espalda', '6', 3.00, '4-6-8-10-12-14', '2-3', 1, 2, '2025-09-24 19:28:46'),
(357, 'i25 3031v', 'Pantalon', 'Espalda', '8', 3.00, '4-6-8-10-12-14', '2-3', 1, 3, '2025-09-24 19:28:46'),
(358, 'i25 3031v', 'Pantalon', 'Espalda', '10', 3.00, '4-6-8-10-12-14', '2-3', 1, 4, '2025-09-24 19:28:46'),
(359, 'i25 3031v', 'Pantalon', 'Espalda', '12', 2.00, '4-6-8-10-12-14', '2-3', 1, 5, '2025-09-24 19:28:46'),
(360, 'i25 3031v', 'Pantalon', 'Espalda', '14', 2.00, '4-6-8-10-12-14', '2-3', 1, 6, '2025-09-24 19:28:46'),
(361, 'i25 3031v', 'Pantalon', 'Manga', '4', 2.00, '4-6-8-10-12-14', '2-3', 2, 1, '2025-09-24 19:28:46'),
(362, 'i25 3031v', 'Pantalon', 'Manga', '6', 3.00, '4-6-8-10-12-14', '2-3', 2, 2, '2025-09-24 19:28:46'),
(363, 'i25 3031v', 'Pantalon', 'Manga', '8', 3.00, '4-6-8-10-12-14', '2-3', 2, 3, '2025-09-24 19:28:46'),
(364, 'i25 3031v', 'Pantalon', 'Manga', '10', 3.00, '4-6-8-10-12-14', '2-3', 2, 4, '2025-09-24 19:28:46'),
(365, 'i25 3031v', 'Pantalon', 'Manga', '12', 3.00, '4-6-8-10-12-14', '2-3', 2, 5, '2025-09-24 19:28:46'),
(366, 'i25 3031v', 'Pantalon', 'Manga', '14', 2.00, '4-6-8-10-12-14', '2-3', 2, 6, '2025-09-24 19:28:46'),
(367, 'i25 3031v', 'Pantalon', 'Cuello', '4', 2.00, '4-6-8-10-12-14', '2-3', 3, 1, '2025-09-24 19:28:46'),
(368, 'i25 3031v', 'Pantalon', 'Cuello', '6', 3.00, '4-6-8-10-12-14', '2-3', 3, 2, '2025-09-24 19:28:46'),
(369, 'i25 3031v', 'Pantalon', 'Cuello', '8', 3.00, '4-6-8-10-12-14', '2-3', 3, 3, '2025-09-24 19:28:46'),
(370, 'i25 3031v', 'Pantalon', 'Cuello', '10', 3.00, '4-6-8-10-12-14', '2-3', 3, 4, '2025-09-24 19:28:46'),
(371, 'i25 3031v', 'Pantalon', 'Cuello', '12', 3.00, '4-6-8-10-12-14', '2-3', 3, 5, '2025-09-24 19:28:46'),
(372, 'i25 3031v', 'Pantalon', 'Cuello', '14', 2.00, '4-6-8-10-12-14', '2-3', 3, 6, '2025-09-24 19:28:46'),
(373, 'i25 3031v', '3', 'Delantero', '4', 0.00, '4-6-8-10-12-14', '2-3', 0, 1, '2025-09-24 19:55:15'),
(374, 'i25 3031v', '3', 'Delantero', '6', 0.00, '4-6-8-10-12-14', '2-3', 0, 2, '2025-09-24 19:55:15'),
(375, 'i25 3031v', '3', 'Delantero', '8', 0.00, '4-6-8-10-12-14', '2-3', 0, 3, '2025-09-24 19:55:15'),
(376, 'i25 3031v', '3', 'Delantero', '10', 0.00, '4-6-8-10-12-14', '2-3', 0, 4, '2025-09-24 19:55:15'),
(377, 'i25 3031v', '3', 'Delantero', '12', 0.00, '4-6-8-10-12-14', '2-3', 0, 5, '2025-09-24 19:55:15'),
(378, 'i25 3031v', '3', 'Delantero', '14', 0.00, '4-6-8-10-12-14', '2-3', 0, 6, '2025-09-24 19:55:15'),
(379, 'i25 3031v', '3', 'Delantero', '4', 0.00, '4-6-8-10-12-14', '2-3', 1, 1, '2025-09-24 19:55:15'),
(380, 'i25 3031v', '3', 'Delantero', '6', 0.00, '4-6-8-10-12-14', '2-3', 1, 2, '2025-09-24 19:55:15'),
(381, 'i25 3031v', '3', 'Delantero', '8', 0.00, '4-6-8-10-12-14', '2-3', 1, 3, '2025-09-24 19:55:15'),
(382, 'i25 3031v', '3', 'Delantero', '10', 0.00, '4-6-8-10-12-14', '2-3', 1, 4, '2025-09-24 19:55:15'),
(383, 'i25 3031v', '3', 'Delantero', '12', 0.00, '4-6-8-10-12-14', '2-3', 1, 5, '2025-09-24 19:55:15'),
(384, 'i25 3031v', '3', 'Delantero', '14', 0.00, '4-6-8-10-12-14', '2-3', 1, 6, '2025-09-24 19:55:15'),
(385, 'i25 3031v', '3', 'Delantero', '4', 0.00, '4-6-8-10-12-14', '2-3', 2, 1, '2025-09-24 19:55:15'),
(386, 'i25 3031v', '3', 'Delantero', '6', 0.00, '4-6-8-10-12-14', '2-3', 2, 2, '2025-09-24 19:55:15'),
(387, 'i25 3031v', '3', 'Delantero', '8', 0.00, '4-6-8-10-12-14', '2-3', 2, 3, '2025-09-24 19:55:15'),
(388, 'i25 3031v', '3', 'Delantero', '10', 0.00, '4-6-8-10-12-14', '2-3', 2, 4, '2025-09-24 19:55:15'),
(389, 'i25 3031v', '3', 'Delantero', '12', 0.00, '4-6-8-10-12-14', '2-3', 2, 5, '2025-09-24 19:55:15'),
(390, 'i25 3031v', '3', 'Delantero', '14', 0.00, '4-6-8-10-12-14', '2-3', 2, 6, '2025-09-24 19:55:15'),
(391, 'i25 1005v', 'Remera', 'Delantero', '4', 0.50, '4-6-8-10-12-14', '1-2', 0, 1, '2025-10-01 20:50:30'),
(392, 'i25 1005v', 'Remera', 'Delantero', '6', 0.50, '4-6-8-10-12-14', '1-2', 0, 2, '2025-10-01 20:50:30'),
(393, 'i25 1005v', 'Remera', 'Delantero', '8', 2.00, '4-6-8-10-12-14', '1-2', 0, 3, '2025-10-01 20:50:30'),
(394, 'i25 1005v', 'Remera', 'Delantero', '10', 2.00, '4-6-8-10-12-14', '1-2', 0, 4, '2025-10-01 20:50:30'),
(395, 'i25 1005v', 'Remera', 'Delantero', '12', 2.00, '4-6-8-10-12-14', '1-2', 0, 5, '2025-10-01 20:50:30'),
(396, 'i25 1005v', 'Remera', 'Delantero', '14', 1.00, '4-6-8-10-12-14', '1-2', 0, 6, '2025-10-01 20:50:30'),
(397, 'i25 1005v', 'Remera', 'Espalda', '4', 0.50, '4-6-8-10-12-14', '1-2', 1, 1, '2025-10-01 20:50:30'),
(398, 'i25 1005v', 'Remera', 'Espalda', '6', 0.50, '4-6-8-10-12-14', '1-2', 1, 2, '2025-10-01 20:50:30'),
(399, 'i25 1005v', 'Remera', 'Espalda', '8', 2.00, '4-6-8-10-12-14', '1-2', 1, 3, '2025-10-01 20:50:30'),
(400, 'i25 1005v', 'Remera', 'Espalda', '10', 2.00, '4-6-8-10-12-14', '1-2', 1, 4, '2025-10-01 20:50:30'),
(401, 'i25 1005v', 'Remera', 'Espalda', '12', 2.00, '4-6-8-10-12-14', '1-2', 1, 5, '2025-10-01 20:50:30'),
(402, 'i25 1005v', 'Remera', 'Espalda', '14', 1.00, '4-6-8-10-12-14', '1-2', 1, 6, '2025-10-01 20:50:30'),
(403, 'i25 1005v', 'Remera', 'Manga', '4', 0.50, '4-6-8-10-12-14', '1-2', 2, 1, '2025-10-01 20:50:30'),
(404, 'i25 1005v', 'Remera', 'Manga', '6', 0.50, '4-6-8-10-12-14', '1-2', 2, 2, '2025-10-01 20:50:30'),
(405, 'i25 1005v', 'Remera', 'Manga', '8', 2.00, '4-6-8-10-12-14', '1-2', 2, 3, '2025-10-01 20:50:30'),
(406, 'i25 1005v', 'Remera', 'Manga', '10', 2.00, '4-6-8-10-12-14', '1-2', 2, 4, '2025-10-01 20:50:30'),
(407, 'i25 1005v', 'Remera', 'Manga', '12', 2.00, '4-6-8-10-12-14', '1-2', 2, 5, '2025-10-01 20:50:30'),
(408, 'i25 1005v', 'Remera', 'Manga', '14', 1.00, '4-6-8-10-12-14', '1-2', 2, 6, '2025-10-01 20:50:30'),
(409, 'v26 1007v', 'Remera', 'Delantero', 'XS', 1.00, 'XS-S-M-L-XL', '1-2', 0, 1, '2025-10-02 19:07:51'),
(410, 'v26 1007v', 'Remera', 'Delantero', 'S', 2.00, 'XS-S-M-L-XL', '1-2', 0, 2, '2025-10-02 19:07:51'),
(411, 'v26 1007v', 'Remera', 'Delantero', 'M', 2.00, 'XS-S-M-L-XL', '1-2', 0, 3, '2025-10-02 19:07:51'),
(412, 'v26 1007v', 'Remera', 'Delantero', 'L', 2.00, 'XS-S-M-L-XL', '1-2', 0, 4, '2025-10-02 19:07:51'),
(413, 'v26 1007v', 'Remera', 'Delantero', 'XL', 1.00, 'XS-S-M-L-XL', '1-2', 0, 5, '2025-10-02 19:07:51'),
(414, 'v26 1007v', 'Remera', 'Espalda', 'XS', 1.00, 'XS-S-M-L-XL', '1-2', 1, 1, '2025-10-02 19:07:51'),
(415, 'v26 1007v', 'Remera', 'Espalda', 'S', 2.00, 'XS-S-M-L-XL', '1-2', 1, 2, '2025-10-02 19:07:51'),
(416, 'v26 1007v', 'Remera', 'Espalda', 'M', 2.00, 'XS-S-M-L-XL', '1-2', 1, 3, '2025-10-02 19:07:51'),
(417, 'v26 1007v', 'Remera', 'Espalda', 'L', 2.00, 'XS-S-M-L-XL', '1-2', 1, 4, '2025-10-02 19:07:51'),
(418, 'v26 1007v', 'Remera', 'Espalda', 'XL', 1.00, 'XS-S-M-L-XL', '1-2', 1, 5, '2025-10-02 19:07:51'),
(419, 'v26 1007v', 'Remera', 'Manga', 'XS', 1.00, 'XS-S-M-L-XL', '1-2', 2, 1, '2025-10-02 19:07:51'),
(420, 'v26 1007v', 'Remera', 'Manga', 'S', 2.00, 'XS-S-M-L-XL', '1-2', 2, 2, '2025-10-02 19:07:51'),
(421, 'v26 1007v', 'Remera', 'Manga', 'M', 2.00, 'XS-S-M-L-XL', '1-2', 2, 3, '2025-10-02 19:07:51'),
(422, 'v26 1007v', 'Remera', 'Manga', 'L', 2.00, 'XS-S-M-L-XL', '1-2', 2, 4, '2025-10-02 19:07:51'),
(423, 'v26 1007v', 'Remera', 'Manga', 'XL', 1.00, 'XS-S-M-L-XL', '1-2', 2, 5, '2025-10-02 19:07:51'),
(424, 'i25 1001v', 'Remera', 'Delantero', 'XS', 0.00, 'XS-S-M-L-XL', '2-3', 0, 1, '2025-10-17 18:45:34'),
(425, 'i25 1001v', 'Remera', 'Delantero', 'S', 0.00, 'XS-S-M-L-XL', '2-3', 0, 2, '2025-10-17 18:45:34'),
(426, 'i25 1001v', 'Remera', 'Delantero', 'M', 0.00, 'XS-S-M-L-XL', '2-3', 0, 3, '2025-10-17 18:45:34'),
(427, 'i25 1001v', 'Remera', 'Delantero', 'L', 0.00, 'XS-S-M-L-XL', '2-3', 0, 4, '2025-10-17 18:45:34'),
(428, 'i25 1001v', 'Remera', 'Delantero', 'XL', 0.00, 'XS-S-M-L-XL', '2-3', 0, 5, '2025-10-17 18:45:34'),
(429, 'i25 1001v', 'Remera', 'Espalda', 'XS', 0.00, 'XS-S-M-L-XL', '2-3', 1, 1, '2025-10-17 18:45:34'),
(430, 'i25 1001v', 'Remera', 'Espalda', 'S', 0.00, 'XS-S-M-L-XL', '2-3', 1, 2, '2025-10-17 18:45:34'),
(431, 'i25 1001v', 'Remera', 'Espalda', 'M', 0.00, 'XS-S-M-L-XL', '2-3', 1, 3, '2025-10-17 18:45:34'),
(432, 'i25 1001v', 'Remera', 'Espalda', 'L', 0.00, 'XS-S-M-L-XL', '2-3', 1, 4, '2025-10-17 18:45:34'),
(433, 'i25 1001v', 'Remera', 'Espalda', 'XL', 0.00, 'XS-S-M-L-XL', '2-3', 1, 5, '2025-10-17 18:45:34'),
(434, 'i25 1001v', 'Remera', 'Manga', 'XS', 0.00, 'XS-S-M-L-XL', '2-3', 2, 1, '2025-10-17 18:45:34'),
(435, 'i25 1001v', 'Remera', 'Manga', 'S', 0.00, 'XS-S-M-L-XL', '2-3', 2, 2, '2025-10-17 18:45:34'),
(436, 'i25 1001v', 'Remera', 'Manga', 'M', 0.00, 'XS-S-M-L-XL', '2-3', 2, 3, '2025-10-17 18:45:34'),
(437, 'i25 1001v', 'Remera', 'Manga', 'L', 0.00, 'XS-S-M-L-XL', '2-3', 2, 4, '2025-10-17 18:45:34'),
(438, 'i25 1001v', 'Remera', 'Manga', 'XL', 0.00, 'XS-S-M-L-XL', '2-3', 2, 5, '2025-10-17 18:45:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `piezas`
--
ALTER TABLE `piezas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_pieza` (`articulo`,`prenda`,`parte`,`talle`,`curva`,`tipo_curva`,`fila`,`columna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `piezas`
--
ALTER TABLE `piezas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=439;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

--
-- Dumping data for table `pma__export_templates`
--

INSERT INTO `pma__export_templates` (`id`, `username`, `export_type`, `template_name`, `template_data`) VALUES
(1, 'root', 'database', 'database.sql', '{\"quick_or_custom\":\"quick\",\"what\":\"sql\",\"structure_or_data_forced\":\"0\",\"table_select[]\":\"piezas\",\"table_structure[]\":\"piezas\",\"table_data[]\":\"piezas\",\"aliases_new\":\"\",\"output_format\":\"sendit\",\"filename_template\":\"@DATABASE@\",\"remember_template\":\"on\",\"charset\":\"utf-8\",\"compression\":\"none\",\"maxsize\":\"\",\"codegen_structure_or_data\":\"data\",\"codegen_format\":\"0\",\"csv_separator\":\",\",\"csv_enclosed\":\"\\\"\",\"csv_escaped\":\"\\\"\",\"csv_terminated\":\"AUTO\",\"csv_null\":\"NULL\",\"csv_columns\":\"something\",\"csv_structure_or_data\":\"data\",\"excel_null\":\"NULL\",\"excel_columns\":\"something\",\"excel_edition\":\"win\",\"excel_structure_or_data\":\"data\",\"json_structure_or_data\":\"data\",\"json_unicode\":\"something\",\"latex_caption\":\"something\",\"latex_structure_or_data\":\"structure_and_data\",\"latex_structure_caption\":\"Structure of table @TABLE@\",\"latex_structure_continued_caption\":\"Structure of table @TABLE@ (continued)\",\"latex_structure_label\":\"tab:@TABLE@-structure\",\"latex_relation\":\"something\",\"latex_comments\":\"something\",\"latex_mime\":\"something\",\"latex_columns\":\"something\",\"latex_data_caption\":\"Content of table @TABLE@\",\"latex_data_continued_caption\":\"Content of table @TABLE@ (continued)\",\"latex_data_label\":\"tab:@TABLE@-data\",\"latex_null\":\"\\\\textit{NULL}\",\"mediawiki_structure_or_data\":\"structure_and_data\",\"mediawiki_caption\":\"something\",\"mediawiki_headers\":\"something\",\"htmlword_structure_or_data\":\"structure_and_data\",\"htmlword_null\":\"NULL\",\"ods_null\":\"NULL\",\"ods_structure_or_data\":\"data\",\"odt_structure_or_data\":\"structure_and_data\",\"odt_relation\":\"something\",\"odt_comments\":\"something\",\"odt_mime\":\"something\",\"odt_columns\":\"something\",\"odt_null\":\"NULL\",\"pdf_report_title\":\"\",\"pdf_structure_or_data\":\"structure_and_data\",\"phparray_structure_or_data\":\"data\",\"sql_include_comments\":\"something\",\"sql_header_comment\":\"\",\"sql_use_transaction\":\"something\",\"sql_compatibility\":\"NONE\",\"sql_structure_or_data\":\"structure_and_data\",\"sql_create_table\":\"something\",\"sql_auto_increment\":\"something\",\"sql_create_view\":\"something\",\"sql_procedure_function\":\"something\",\"sql_create_trigger\":\"something\",\"sql_backquotes\":\"something\",\"sql_type\":\"INSERT\",\"sql_insert_syntax\":\"both\",\"sql_max_query_size\":\"50000\",\"sql_hex_for_binary\":\"something\",\"sql_utc_time\":\"something\",\"texytext_structure_or_data\":\"structure_and_data\",\"texytext_null\":\"NULL\",\"xml_structure_or_data\":\"data\",\"xml_export_events\":\"something\",\"xml_export_functions\":\"something\",\"xml_export_procedures\":\"something\",\"xml_export_tables\":\"something\",\"xml_export_triggers\":\"something\",\"xml_export_views\":\"something\",\"xml_export_contents\":\"something\",\"yaml_structure_or_data\":\"data\",\"\":null,\"lock_tables\":null,\"as_separate_files\":null,\"csv_removeCRLF\":null,\"excel_removeCRLF\":null,\"json_pretty_print\":null,\"htmlword_columns\":null,\"ods_columns\":null,\"sql_dates\":null,\"sql_relation\":null,\"sql_mime\":null,\"sql_disable_fk\":null,\"sql_views_as_tables\":null,\"sql_metadata\":null,\"sql_create_database\":null,\"sql_drop_table\":null,\"sql_if_not_exists\":null,\"sql_simple_view_export\":null,\"sql_view_current_user\":null,\"sql_or_replace_view\":null,\"sql_truncate\":null,\"sql_delayed\":null,\"sql_ignore\":null,\"texytext_columns\":null}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"plotter_textil\",\"table\":\"usuarios\"},{\"db\":\"plotter_textil\",\"table\":\"recupero_password\"},{\"db\":\"\",\"table\":\"usuarios\"},{\"db\":\"plotter_db\",\"table\":\"registro_stock\"},{\"db\":\"plotter_db\",\"table\":\"notificaciones\"},{\"db\":\"control_piezas\",\"table\":\"piezas\"},{\"db\":\"plotter_db\",\"table\":\"notificaciones_backup\"},{\"db\":\"plotter_db\",\"table\":\"vista_resumen_stock\"},{\"db\":\"plotter_textil\",\"table\":\"sesiones\"},{\"db\":\"plotter_db\",\"table\":\"logs_actividad\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Dumping data for table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'control_piezas', 'piezas', '{\"sorted_col\":\"`articulo` DESC\"}', '2025-09-24 19:20:16');

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2025-10-17 20:19:07', '{\"Console\\/Mode\":\"collapse\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `plotter_db`
--
CREATE DATABASE IF NOT EXISTS `plotter_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `plotter_db`;

-- --------------------------------------------------------

--
-- Table structure for table `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id` int(11) NOT NULL,
  `mensaje` varchar(255) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `vistas` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notificaciones`
--

INSERT INTO `notificaciones` (`id`, `mensaje`, `fecha`, `vistas`) VALUES
(1, 'Se ha cargado un nuevo artículo (V26 1005v) en la base de datos.', '2025-10-01 19:58:32', 0),
(2, 'Se ha actualizado el artículo (i25 1002v).', '2025-10-01 19:58:38', 0),
(3, 'Se ha actualizado el artículo (i25 1002v).', '2025-10-01 19:58:43', 0),
(8, 'Se ha actualizado el artículo (V26 1005v).', '2025-10-01 20:47:12', 0),
(9, 'Se ha eliminado el artículo (i25 1000v) de la base de datos.', '2025-10-01 20:47:33', 0),
(10, 'Se ha actualizado el artículo (i25 1001v).', '2025-10-02 14:45:04', 0),
(11, 'Se ha actualizado el artículo (v26 1007v).', '2025-10-02 19:02:57', 0),
(12, 'Se ha actualizado el artículo (v26 1007v).', '2025-10-02 19:03:25', 0),
(13, 'Se ha actualizado el artículo (v26 1007v).', '2025-10-02 19:03:36', 0),
(14, 'Se ha actualizado el artículo (v26 1007v).', '2025-10-02 19:03:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notificaciones_backup`
--

CREATE TABLE `notificaciones_backup` (
  `id` int(11) NOT NULL DEFAULT 0,
  `mensaje` varchar(255) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `vistas` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notificaciones_backup`
--

INSERT INTO `notificaciones_backup` (`id`, `mensaje`, `fecha`, `vistas`) VALUES
(1, 'Se ha actualizado el artículo (i25 1001v).', '2025-09-25 13:45:37', 0),
(2, 'Se ha cargado un nuevo artículo (i25 1002v) en la base de datos.', '2025-09-25 13:47:07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `registro_stock`
--

CREATE TABLE `registro_stock` (
  `id` int(11) NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `articulo` varchar(255) NOT NULL,
  `bolsas_del` varchar(50) DEFAULT NULL,
  `bolsas_corte` varchar(50) DEFAULT NULL,
  `cuello_morley` varchar(255) DEFAULT NULL,
  `estamperia_salida` varchar(20) DEFAULT NULL,
  `estamperia_entrada` varchar(20) DEFAULT NULL,
  `taller` varchar(20) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_modificacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `registro_stock`
--

INSERT INTO `registro_stock` (`id`, `fecha`, `articulo`, `bolsas_del`, `bolsas_corte`, `cuello_morley`, `estamperia_salida`, `estamperia_entrada`, `taller`, `fecha_creacion`, `fecha_modificacion`) VALUES
(3, '09/07/2025', 'i25 1001v', '2', '3', '1', '2/10/2025', '', '', '2025-09-25 13:13:11', '2025-10-02 14:45:04'),
(4, '26/09/2025', 'i25 1002v', '3', '5', '1', '1/10/2025', '', '', '2025-09-25 13:47:07', '2025-10-01 19:39:10'),
(5, '2/10/2025', 'v26 1007v', '2', '4', '1', 'Hernan 3/10/25', 'Hernan 4/10/25', 'Marcela 4/10/25', '2025-10-01 19:57:30', '2025-10-02 19:03:48');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vista_resumen_stock`
-- (See below for the actual view)
--
CREATE TABLE `vista_resumen_stock` (
`fecha_registro` date
,`total_registros` bigint(21)
,`enviados_estamperia` bigint(21)
,`recibidos_estamperia` bigint(21)
,`despachados_taller` bigint(21)
);

-- --------------------------------------------------------

--
-- Structure for view `vista_resumen_stock`
--
DROP TABLE IF EXISTS `vista_resumen_stock`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_resumen_stock`  AS SELECT cast(`registro_stock`.`fecha_creacion` as date) AS `fecha_registro`, count(0) AS `total_registros`, count(case when `registro_stock`.`estamperia_salida` is not null and `registro_stock`.`estamperia_salida` <> '' then 1 end) AS `enviados_estamperia`, count(case when `registro_stock`.`estamperia_entrada` is not null and `registro_stock`.`estamperia_entrada` <> '' then 1 end) AS `recibidos_estamperia`, count(case when `registro_stock`.`taller` is not null and `registro_stock`.`taller` <> '' then 1 end) AS `despachados_taller` FROM `registro_stock` GROUP BY cast(`registro_stock`.`fecha_creacion` as date) ORDER BY cast(`registro_stock`.`fecha_creacion` as date) DESC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registro_stock`
--
ALTER TABLE `registro_stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_fecha` (`fecha`),
  ADD KEY `idx_articulo` (`articulo`),
  ADD KEY `idx_fecha_creacion` (`fecha_creacion`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `registro_stock`
--
ALTER TABLE `registro_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Database: `plotter_textil`
--
CREATE DATABASE IF NOT EXISTS `plotter_textil` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `plotter_textil`;

-- --------------------------------------------------------

--
-- Table structure for table `logs_actividad`
--

CREATE TABLE `logs_actividad` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `accion` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs_actividad`
--

INSERT INTO `logs_actividad` (`id`, `usuario_id`, `accion`, `descripcion`, `fecha_hora`, `ip_address`) VALUES
(1, 1, 'logout', 'Usuario cerró sesión', '2025-10-13 22:30:47', '::1'),
(2, 2, 'logout', 'Usuario cerró sesión', '2025-10-13 22:31:11', '::1'),
(3, 1, 'logout', 'Usuario cerró sesión', '2025-10-13 22:46:20', '::1'),
(4, 3, 'logout', 'Usuario cerró sesión', '2025-10-17 00:14:51', '::1'),
(5, 1, 'logout', 'Usuario cerró sesión', '2025-10-17 19:31:53', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `recupero_password`
--

CREATE TABLE `recupero_password` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `usado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recupero_password`
--

INSERT INTO `recupero_password` (`id`, `usuario_id`, `token`, `fecha_creacion`, `usado`) VALUES
(1, 1, '11e8a83d068ec3f583bb633c3078b5f3e6cae3e783f06f8af450bf9fd22011f0', '2025-10-13 22:08:32', 0),
(2, 1, '451cbf48d6d22e0403a69394362715fc1b481e04bfecc50571bf16199149c968', '2025-10-13 22:09:03', 0),
(3, 1, '9ab8f41c7461635c9294865e8ccd6227215cc712520568ac352118eb9bda9fbe', '2025-10-13 22:13:48', 0),
(4, 1, '8a8b7ff34167e72227794ab57a84bab8edbde1179b2c0214e0dcbf114e4b1474', '2025-10-13 22:16:44', 0),
(5, 1, '9a6a1d1c9d303cf3cba3e4bd1954f9fedc531b1d3b779aca87b11e8c0d70650d', '2025-10-13 22:17:24', 1),
(6, 2, '18a23142748a1d147851d7ba58dae7848967d8c52b14846c8cceed6ef17fd4ca', '2025-10-13 22:38:52', 0),
(7, 1, '43a19aee9999868a38a9f1b540d4fb95f24a74e46e9580009e49991bfa72a17a', '2025-10-13 22:39:13', 1),
(8, 1, '8061b949c052ecec95aa7205101803f37f8907be8b52f78209abfa184ee4d8f6', '2025-10-17 00:13:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sesiones`
--

CREATE TABLE `sesiones` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fecha_inicio` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_fin` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `rol` varchar(50) DEFAULT 'usuario',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `ultimo_acceso` timestamp NULL DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `nombre`, `email`, `rol`, `fecha_creacion`, `ultimo_acceso`, `activo`) VALUES
(1, 'admin_plotter', '$2y$10$jFaeD1xX.Wuv4uFnJkjksOKcU1lZfr3NmKDhBu8cp2LSPpInB/so6', 'Administrador del Sistema', 'nahuzinho0800@gmail.com', 'administrador', '2025-10-13 22:01:09', '2025-10-17 19:31:53', 1),
(2, 'usuario1', '$2y$10$bGSQzyTbb8QK8L6m9o09SuW/GwhskgLXn9Sxar2RXhdshIo6tbLY6', 'Usuario de Prueba 1', 'headshotsupremo@gmail.com', 'usuario', '2025-10-13 22:01:09', '2025-10-13 22:31:11', 1),
(3, 'operador1', '$2y$10$6e5TK1XX56P7/QetphNDSelQu5TnGc1XjR8GA5qaQGJwRn.f66gBS', 'Operador de Tizadas', 'candeperez.denisse@gmail.com', 'operador', '2025-10-13 22:01:09', '2025-10-17 00:14:51', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logs_actividad`
--
ALTER TABLE `logs_actividad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indexes for table `recupero_password`
--
ALTER TABLE `recupero_password`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indexes for table `sesiones`
--
ALTER TABLE `sesiones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logs_actividad`
--
ALTER TABLE `logs_actividad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `recupero_password`
--
ALTER TABLE `recupero_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sesiones`
--
ALTER TABLE `sesiones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `logs_actividad`
--
ALTER TABLE `logs_actividad`
  ADD CONSTRAINT `logs_actividad_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `recupero_password`
--
ALTER TABLE `recupero_password`
  ADD CONSTRAINT `recupero_password_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `sesiones`
--
ALTER TABLE `sesiones`
  ADD CONSTRAINT `sesiones_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
