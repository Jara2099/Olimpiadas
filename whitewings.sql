-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 17-06-2025 a las 01:31:51
-- Versión del servidor: 8.4.3
-- Versión de PHP: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `whitewings`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_viajes`
--

CREATE TABLE `compras_viajes` (
  `id` int NOT NULL,
  `usuario_id` int DEFAULT NULL,
  `destino` varchar(100) NOT NULL,
  `fecha_ida` date NOT NULL,
  `fecha_vuelta` date NOT NULL,
  `incluye_hotel` tinyint(1) NOT NULL DEFAULT '0',
  `incluye_auto` tinyint(1) NOT NULL DEFAULT '0',
  `incluye_actividades` tinyint(1) NOT NULL DEFAULT '0',
  `precio_total` decimal(10,2) NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `compras_viajes`
--

INSERT INTO `compras_viajes` (`id`, `usuario_id`, `destino`, `fecha_ida`, `fecha_vuelta`, `incluye_hotel`, `incluye_auto`, `incluye_actividades`, `precio_total`, `creado_en`) VALUES
(1, 1, 'Buenos Aires, Argentina', '2025-06-18', '2025-06-27', 0, 1, 0, 12500.00, '2025-06-16 23:30:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE `cuentas` (
  `id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `gmail` varchar(100) NOT NULL,
  `contrasenia` varchar(255) NOT NULL,
  `rol` enum('usuario','admin') NOT NULL DEFAULT 'usuario',
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `cuentas`
--

INSERT INTO `cuentas` (`id`, `nombre`, `gmail`, `contrasenia`, `rol`, `fecha_registro`) VALUES
(1, 'Jara', '', '$2y$10$XjOWtrqIeNQaYxzqRwtaFe4uSxZTxLGS2rb0YpPwBMZj7.yFYGOdm', 'admin', '2025-06-17 01:07:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opciones_extras`
--

CREATE TABLE `opciones_extras` (
  `id` int NOT NULL,
  `tipo` enum('hotel','auto','actividades','seguro','comida','guia','otros') DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `opciones_extras`
--

INSERT INTO `opciones_extras` (`id`, `tipo`, `nombre`, `descripcion`, `precio`, `activo`) VALUES
(7, 'auto', 'Auto MVW', 'Autos MVW de muy buena calidad en perfectas condiciones para moverse donde quiera', 12000.00, 1),
(8, 'comida', 'Comida', 'Comida de mas alta calidad donde sea que viajes', 10000.00, 1),
(9, 'comida', 'Comida', 'Comida de mas alta calidad donde sea que viajes', 10000.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajes`
--

CREATE TABLE `viajes` (
  `id` int NOT NULL,
  `destino` varchar(100) DEFAULT NULL,
  `precio_base` decimal(10,2) DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL,
  `hora_salida` time DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `viajes`
--

INSERT INTO `viajes` (`id`, `destino`, `precio_base`, `fecha_salida`, `hora_salida`, `creado_en`) VALUES
(9, 'Río de Janeiro, Brasil', 100.00, '2025-06-14', '16:24:00', '2025-06-13 19:23:50'),
(13, 'Bariloche, Argentina', 10000.00, '2025-06-28', '00:56:00', '2025-06-16 23:56:11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compras_viajes`
--
ALTER TABLE `compras_viajes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE` (`gmail`);

--
-- Indices de la tabla `opciones_extras`
--
ALTER TABLE `opciones_extras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compras_viajes`
--
ALTER TABLE `compras_viajes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `opciones_extras`
--
ALTER TABLE `opciones_extras`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `viajes`
--
ALTER TABLE `viajes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
