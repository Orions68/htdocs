-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-06-2022 a las 15:07:47
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ticket.es`
--
CREATE DATABASE IF NOT EXISTS `ticket.es` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `ticket.es`;

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Busqueda_X_Lugar` (IN `my_place` VARCHAR(30), IN `kind` VARCHAR(30))   BEGIN
 SELECT details.id_event, details.title, details.description, details.path FROM details INNER JOIN events WHERE events.place LIKE CONCAT("%", my_place, "%") AND details.kind=kind AND events.id=details.id_event;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Busqueda_X_Tipo` (IN `type` VARCHAR(30))   BEGIN
 SELECT DISTINCT place FROM events INNER JOIN details WHERE details.id_event = events.id AND details.kind = type;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bday` date NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `path` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`id`, `name`, `phone`, `email`, `pass`, `bday`, `gender`, `path`, `active`) VALUES
(1, 'César Osvaldo Matelat Borneo', '664774821', 'orions@gmx.net', '$2y$10$ZWuRBftpiWkM5dRCCD7pn.RV4/cksMvLCRbUt2MilH6QgYCpHFaRS', '1968-04-05', 1, 'clients/1/Daiki and me.jpg', 1),
(2, 'César Matelat', '664774822', 'cesarmatelat@gmail.com', '$2y$10$tb/H4GWZyH.tluuYR76mf.XsE3x9YX/k1EX6Oi8Jt3F5XfAq8L5dm', '1968-04-05', 1, 'clients/2/Marilyn.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `company`
--

INSERT INTO `company` (`id`, `name`, `email`, `pass`, `active`) VALUES
(1, 'César Matelat SRL.', 'matelat@gmail.com', '$2y$10$naXUqPkLB8h4fZzS0.bAluqo4a7mFwuvudgpdrP1ftncgqgg4C7p2', 1),
(2, 'Google Corp.', 'google@gmail.com', '$2y$10$vDu6LMqYx5li53XJlqf2e./NNGyO9tvYFt.XxK6yaeaLSoQ5EZN42', 1),
(3, 'Otra Empresa S.A.', '2@2.com', '$2y$10$eM.qOdpOUG/3sGhFN.CAs.FnzxaPuj.j6CwIVZymO.4p3uUpqCs5u', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `details`
--

CREATE TABLE `details` (
  `id` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `kind` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `details`
--

INSERT INTO `details` (`id`, `id_event`, `kind`, `title`, `description`, `path`) VALUES
(1, 1, 'Concierto', 'The Beatles Alive', 'Concierto de The Beatles en vivo en el estadio La Mansanilla.', 'companies/emp-1/1/1.jpg¡companies/emp-1/1/2.jpg¡companies/emp-1/1/3.jpg'),
(2, 2, 'Teatro', 'Volar es Humano, Aterrizar es Divino', 'Obra de Teatro de Enrique Piñeyro con Fernando Margenet y Gran Elenco.', 'companies/emp-1/2/1.jpg¡companies/emp-1/2/2.jpg¡companies/emp-1/2/3.jpg'),
(3, 3, 'Concierto', 'Queen Espectacular!', 'Concierto de Queen en Vivo, en el Estadio de Adeje.', 'companies/emp-1/3/1.jpg¡companies/emp-1/3/2.jpg¡companies/emp-1/3/3.jpg'),
(4, 4, 'Deportes', 'Barça vs. Madrid', 'El Súper Clásico de España, Barça Madrid con todas las Estrellas en el Campo.', 'companies/emp-1/4/1.jpeg¡companies/emp-1/4/2.jpg¡companies/emp-1/4/3.jpg'),
(5, 5, 'Cine', 'Dr. Strange en el Multiverso de la Locura', 'La Última Súper Producción de Disney con unos Efectos Nunca Vistos y Gran Elenco', 'companies/emp-1/5/1.jpg¡companies/emp-1/5/2.jpg¡companies/emp-1/5/3.jpg'),
(6, 6, 'Concierto', 'Los Espaciales en Concierto', 'Los Espaciales dan su único concierto en la via lactea, y será en la luna de la Tierra, aprovecha esta oportunidad.', 'companies/emp-1/6/1.webp¡companies/emp-1/6/2.jpg¡companies/emp-1/6/3.jpg'),
(7, 7, 'Concierto', 'The Martians in Concert', 'La Banda más Importante del Sistema Solar, toca en su Planeta, Aprovecha esta oferta el viaje y la Criogenización Están Incluidas.', 'companies/emp-2/7/1.webp¡companies/emp-2/7/2.jpg¡companies/emp-2/7/3.jpg'),
(8, 8, 'Concierto', 'Pink Floyd en Venezia 2', 'The Wall y Otros Grandes Exitos, con Rogger Waters', 'companies/emp-1/8/1.jpg¡companies/emp-1/8/2.jpg¡companies/emp-1/8/3.jpg'),
(9, 9, 'Concierto', 'KISS en Concierto.', 'Concierto de Kiss en el Estadio Mundialista de Mar del Plata, lleva el bañador, las entradas incluyen vuelos, estadía y un día conociendo las playas Marplatenses.', 'companies/emp-2/9/1.jpg¡companies/emp-2/9/2.jpg¡companies/emp-2/9/3.jpg'),
(10, 10, 'Concierto', 'Las Mejores Bandas del Universo', 'Tocan las mejores bandas de Universo en Júpiter, el precio incluye el viaje y un chupito para tirar hasta que llegue la nave, te lo vas a perder?', 'companies/emp-3/10/1.jpg¡companies/emp-3/10/2.jpg¡companies/emp-3/10/3.jpg'),
(11, 11, 'Clásico', 'Exposición de Arte Clasico', 'A que no te lo crees, esta exposición incluye los traslados, solo para residentes en Canarias, te lo vas a perder?', 'companies/emp-2/11/1.jpg¡companies/emp-2/11/2.jpg¡companies/emp-2/11/3.JPG'),
(12, 12, 'Moderno', 'Arte Moderno, Expo', 'Exposición de arte moderno contemporaneo, fliparás con las cosas que se exiben..', 'companies/emp-3/12/1.jpg¡companies/emp-3/12/2.webp¡companies/emp-3/12/3.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discount`
--

CREATE TABLE `discount` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `discount` int(2) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `place` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `hour` time NOT NULL,
  `places` int(7) NOT NULL,
  `sold` int(11) NOT NULL,
  `position` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`position`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `events`
--

INSERT INTO `events` (`id`, `id_empresa`, `place`, `price`, `start`, `end`, `hour`, `places`, `sold`, `position`) VALUES
(1, 1, 'La Laguna', '150.00', '2022-06-28', '2022-06-29', '21:00:00', 60000, 51, '0'),
(2, 1, 'Santa Cruz de Tenerife', '60.00', '2022-06-17', '2022-06-18', '20:00:00', 2000, 1996, '0'),
(3, 1, 'Adeje', '150.00', '2022-06-11', '2022-06-12', '21:00:00', 50000, 44, '0'),
(4, 1, 'Barcelona', '200.00', '2022-07-03', '2022-07-03', '22:00:00', 85000, 41, '0'),
(5, 1, 'Las Canteras', '15.00', '2022-07-09', '2022-07-10', '21:00:00', 350, 36, '0'),
(6, 1, 'La Luna', '599.00', '2022-07-09', '2022-07-10', '01:00:00', 500000, 0, '0'),
(7, 2, 'Marte', '5999.00', '2022-07-02', '2022-07-03', '02:00:00', 1000000, 0, '0'),
(8, 1, 'Venezia', '200.00', '2022-07-09', '2022-07-10', '22:00:00', 100000, 34, '0'),
(9, 2, 'Mar del Plata', '150.00', '2022-07-09', '2022-07-10', '22:00:00', 60000, 12, '0'),
(10, 3, 'Júpiter', '5999.00', '2022-08-13', '2022-08-14', '23:30:00', 2500000, 0, '0'),
(11, 2, 'En el Louvre, en Paris', '60.00', '2022-07-09', '2022-07-10', '10:00:00', 500, 0, '0'),
(12, 3, 'Florencia, Italia', '60.00', '2022-07-02', '2022-07-03', '10:00:00', 400, 0, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_event` int(11) NOT NULL,
  `qtty` int(4) NOT NULL,
  `accumulated` int(11) NOT NULL,
  `payed` decimal(6,2) NOT NULL,
  `date` datetime NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `invoice`
--

INSERT INTO `invoice` (`id`, `id_cliente`, `id_event`, `qtty`, `accumulated`, `payed`, `date`, `path`) VALUES
(1, 1, 1, 2, 2, '300.00', '2022-06-11 20:14:44', 'https://chart.googleapis.com/chart?cht=qr&chl=http%3A%2F%2Fticketes.atspace.eu%2Fserver.php%3Fclient%3D1%26id%3D1%26title%3DThe+Beatles+Alive%26qtty%3D2%26seats%3D43%2C42%2C&chs=160x160&chld=L|0'),
(2, 1, 1, 2, 4, '300.00', '2022-06-11 20:33:23', 'https://chart.googleapis.com/chart?cht=qr&chl=http%3A%2F%2Fticketes.atspace.eu%2Fserver.php%3Fclient%3D1%26id%3D1%26title%3DThe+Beatles+Alive%26qtty%3D2%26seats%3D51%2C50%2C&chs=160x160&chld=L|0'),
(3, 1, 1, 2, 6, '300.00', '2022-06-11 20:35:51', 'https://chart.googleapis.com/chart?cht=qr&chl=http%3A%2F%2Fticketes.atspace.eu%2Fserver.php%3Fclient%3D1%26id%3D1%26title%3DThe+Beatles+Alive%26qtty%3D2%26seats%3D51%2C50%2C&chs=160x160&chld=L|0'),
(4, NULL, 8, 2, 0, '400.00', '2022-06-12 15:04:36', 'https://chart.googleapis.com/chart?cht=qr&chl=http%3A%2F%2Fticketes.atspace.eu%2Fserver.php%3Fclient%3D0%26id%3D8%26title%3DPink+Floyd+en+Venezia+2%26qtty%3D2%26seats%3D34%2C33%2C&chs=160x160&chld=L|0');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_event` (`id_event`);

--
-- Indices de la tabla `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_empresa` (`id_empresa`);

--
-- Indices de la tabla `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_event` (`id_event`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `details`
--
ALTER TABLE `details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `details`
--
ALTER TABLE `details`
  ADD CONSTRAINT `details_ibfk_1` FOREIGN KEY (`id_event`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `discount`
--
ALTER TABLE `discount`
  ADD CONSTRAINT `discount_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`id_event`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
