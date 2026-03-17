-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-11-2024 a las 20:30:12
-- Versión del servidor: 8.0.30
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
-- Estructura de tabla para la tabla `people`
--

CREATE TABLE `people` (
  `idPerson` int NOT NULL,
  `Document` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `Names` varchar(50) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `Lastname` varchar(50) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `Email` varchar(100) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `Phone` varchar(15) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `Address` varchar(50) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `Gender` varchar(20) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
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
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idRol` int NOT NULL,
  `rolDescription` varchar(20) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
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
  `Description` varchar(20) COLLATE utf8mb3_spanish2_ci DEFAULT NULL
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
  `userName` varchar(15) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `PASSWORD` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `statusUser` tinyint DEFAULT NULL,
  `idPerson` int DEFAULT NULL,
  `idRol` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`idUser`, `userName`, `PASSWORD`, `statusUser`, `idPerson`, `idRol`) VALUES
(1, 'Juan0211', 'eaf3c978f6741fd07c7412ec61785cd6165f28b3', 1, 1, 1),
(2, 'kmigi0211', NULL, 1, 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`idPerson`);

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
-- AUTO_INCREMENT de la tabla `people`
--
ALTER TABLE `people`
  MODIFY `idPerson` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
