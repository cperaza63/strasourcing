-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-07-2021 a las 17:58:05
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `b_multiple`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `table_images`
--

CREATE TABLE `table_images` (
  `id` int(11) NOT NULL,
  `images` varchar(255) NOT NULL,
  `fregis` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `table_images`
--

INSERT INTO `table_images` (`id`, `images`, `fregis`) VALUES
(10, '1300936380.jpg', '2021-07-29 15:57:01'),
(11, '1779071970.jpg', '2021-07-29 15:57:19'),
(12, '1893039121.jpg', '2021-07-29 15:57:19'),
(13, '641042864.jpg', '2021-07-29 15:57:19'),
(14, '1087870570.png', '2021-07-29 15:57:19'),
(15, '410902717.jpg', '2021-07-29 15:57:36');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `table_images`
--
ALTER TABLE `table_images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `table_images`
--
ALTER TABLE `table_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
