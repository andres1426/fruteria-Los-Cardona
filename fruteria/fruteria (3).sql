-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2025 a las 17:14:48
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fruteria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` bigint(20) NOT NULL,
  `nom_prod` varchar(20) NOT NULL,
  `precio` int(11) NOT NULL,
  `fk_tprod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nom_prod`, `precio`, `fk_tprod`) VALUES
(1, 'naranja', 2000, 1),
(2, 'ciruela', 1000, 2),
(3, 'coco', 5000, 3),
(11, 'manzana roja', 8000, 2),
(12, 'pera', 3500, 2),
(13, 'maracuya', 9000, 1),
(14, 'piña', 4500, 1),
(15, 'mani', 6600, 3),
(16, 'pepino', 3300, 3),
(17, 'uva roja', 6600, 2),
(18, 'lulo', 5500, 1),
(19, 'guanabana', 5000, 9),
(21, 'mor', 90000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_prod`
--

CREATE TABLE `tipo_prod` (
  `id_tipo_prod` int(11) NOT NULL,
  `nom_tprod` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_prod`
--

INSERT INTO `tipo_prod` (`id_tipo_prod`, `nom_tprod`) VALUES
(1, 'acidas'),
(2, 'semiacidas'),
(3, 'neutras'),
(9, 'dulce'),
(10, 'jajajaj'),
(12, 'con sabor');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `fk_prod_tipos` (`fk_tprod`);

--
-- Indices de la tabla `tipo_prod`
--
ALTER TABLE `tipo_prod`
  ADD PRIMARY KEY (`id_tipo_prod`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `tipo_prod`
--
ALTER TABLE `tipo_prod`
  MODIFY `id_tipo_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_prod_tipos` FOREIGN KEY (`fk_tprod`) REFERENCES `tipo_prod` (`id_tipo_prod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
