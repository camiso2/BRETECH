-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-02-2022 a las 18:25:43
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `brewtech`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ordens`
--

CREATE TABLE `detalle_ordens` (
  `id` int(10) UNSIGNED NOT NULL,
  `numeroFactura` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cliente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detallesOrden` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `granSubtotal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `granIva` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `granTotal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_ordens`
--

INSERT INTO `detalle_ordens` (`id`, `numeroFactura`, `cliente`, `telefono`, `email`, `detallesOrden`, `granSubtotal`, `granIva`, `granTotal`, `user_id`, `created_at`, `updated_at`) VALUES
(413, '1645117328400-538', 'Jaiver OCampo', '3174885954', 'camiso2@gmail.com', ' producto : prueba, cantidad : 12, valorUnitario : 20000, iva : 33600, valorTotal : 240000,', '206399', '33601', '240000', 2, '2022-02-17 17:02:34', '2022-02-17 17:02:34'),
(414, '1645117406799-115', 'Jaiver OCampo', '3174885954', 'sofis@gmail.com', ' producto : prueba, cantidad : 12, valorUnitario : 20000, iva : 33600, valorTotal : 240000, producto : producto, cantidad : 12, valorUnitario : 50000, iva : 60000, valorTotal : 600000,', '746398', '93602', '840000', 2, '2022-02-17 17:03:31', '2022-02-17 17:03:31');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_ordens`
--
ALTER TABLE `detalle_ordens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_ordens_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_ordens`
--
ALTER TABLE `detalle_ordens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=415;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_ordens`
--
ALTER TABLE `detalle_ordens`
  ADD CONSTRAINT `detalle_ordens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
