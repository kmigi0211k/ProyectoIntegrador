-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 16-03-2026 a las 21:38:43
-- Versión del servidor: 8.0.43
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `frame2pm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int NOT NULL,
  `articulo` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `articulo`, `cantidad`, `precio_unitario`, `total`) VALUES
(1, 'Smartphone', 98, 500.00, 500.00),
(2, 'Laptop', 1, 800.00, 800.00),
(3, 'Auriculares inalámbricos', 2, 50.00, 100.00),
(4, 'Smartwatch', 1, 120.00, 120.00),
(5, 'Cargador portátil', 1, 30.00, 30.00),
(6, 'Teclado mecánico', 1, 100.00, 100.00),
(7, 'Play 5', 5, 1200000.00, 12222.00),
(8, 'Mac book pro', 15, 25000000.00, 26000000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `people`
--

CREATE TABLE `people` (
  `idPerson` int NOT NULL,
  `Document` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `Names` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `Lastname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `Email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `Phone` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `Address` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `Gender` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `Birthdate` date DEFAULT NULL,
  `idTypeDocument` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `people`
--

INSERT INTO `people` (`idPerson`, `Document`, `Names`, `Lastname`, `Email`, `Phone`, `Address`, `Gender`, `Birthdate`, `idTypeDocument`) VALUES
(1, '287193871', 'Daniel', 'Morales', 'b@h.com', '673256325', 'Calle siempre viva', 'Masculino', '1987-09-29', 1),
(2, '1033257422', 'Juan Camilo', 'Giraldo Lizcano', 'juankamilo0211k@gmail.com', '3023850997', 'calle 48 E # 93-53', NULL, '2005-02-11', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int NOT NULL,
  `Nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `Descripcion` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci,
  `Precio` float DEFAULT NULL,
  `Stock` int DEFAULT '0',
  `FechaCreacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `Nombre`, `Descripcion`, `Precio`, `Stock`, `FechaCreacion`) VALUES
(1, 'Laptop Dell XPS 13', 'Laptop ultradelgada con procesador Intel i7, pantalla 13.4 pulgadas, 16GB de RAM', 1500000, 20, '2024-11-22'),
(8, 'Play 5', 'video Juego', 1500000, 65, '2024-11-20'),
(9, 'Mac Book Pro', 'computador', 200000, 20, '2024-11-20'),
(10, 'Smart Watch ', 'Reloj Huawei', 180000, 10, '2024-11-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idRol` int NOT NULL,
  `rolDescription` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `statusRol` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRol`, `rolDescription`, `statusRol`) VALUES
(1, 'Admin', 1),
(2, 'Secretary', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `typedocuments`
--

CREATE TABLE `typedocuments` (
  `idTypeDocument` int NOT NULL,
  `Description` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `typedocuments`
--

INSERT INTO `typedocuments` (`idTypeDocument`, `Description`) VALUES
(1, 'Cedula'),
(2, 'Pasaporte'),
(3, 'PEP');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `idUser` int NOT NULL,
  `userName` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `PASSWORD` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `statusUser` tinyint DEFAULT NULL,
  `idPerson` int DEFAULT NULL,
  `idRol` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`idUser`, `userName`, `PASSWORD`, `statusUser`, `idPerson`, `idRol`) VALUES
(1, 'Juan0211', '1234', 1, 1, 1),
(2, 'kmigi0211', '12', 1, 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`idPerson`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `typedocuments`
--
ALTER TABLE `typedocuments`
  ADD PRIMARY KEY (`idTypeDocument`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `people`
--
ALTER TABLE `people`
  MODIFY `idPerson` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idRol` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `typedocuments`
--
ALTER TABLE `typedocuments`
  MODIFY `idTypeDocument` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
