-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2022 a las 19:34:49
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nutraproject`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `client` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qtty` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` decimal(11,2) NOT NULL,
  `iva` decimal(11,2) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `invoice`
--

INSERT INTO `invoice` (`id`, `client`, `product_id`, `qtty`, `total`, `iva`, `date`, `time`) VALUES
(1, 'César Matelat', '1,2,', '1,2,', '193.66', '33.61', '2022-11-17', '15:47:31'),
(2, 'Felix González', '1,2,', '2,2,', '233.89', '40.59', '2022-11-17', '19:26:18'),
(3, 'Consumidor Final', '2,', '2,', '153.43', '26.63', '2022-11-17', '19:27:10'),
(4, 'Consumidor Final', '2,1,', '3,2,', '310.61', '53.91', '2022-11-17', '19:27:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `img` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `product`, `price`, `stock`, `img`) VALUES
(1, 'SKULL TRAIN - PSYCHO MODE 480G', '33.25', 20, 'img/PSYCHO-480G.jpg'),
(2, 'NAMEDSPORT SUPER 100% WHEY TIRAMISU - 2KG', '63.40', 20, 'img/WHEY-TIRAMISU-2KG.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
