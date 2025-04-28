-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-04-2025 a las 02:08:11
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
-- Base de datos: `sistema_citas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `numeroControl` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cancelar_cita`
--

CREATE TABLE `cancelar_cita` (
  `id` int(11) NOT NULL,
  `motivo` text NOT NULL,
  `id_cita` int(11) NOT NULL,
  `fecha_cancelacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `asunto` text NOT NULL,
  `numeroControl` varchar(50) NOT NULL,
  `cancelada` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coordinador`
--

CREATE TABLE `coordinador` (
  `numeroControl` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario_coordinador`
--

CREATE TABLE `horario_coordinador` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL,
  `disponible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horario_coordinador`
--

INSERT INTO `horario_coordinador` (`id`, `fecha`, `horaInicio`, `horaFin`, `disponible`) VALUES
(1, '0000-00-00', '10:00:00', '11:30:00', 0),
(2, '0000-00-00', '10:30:00', '10:00:00', 0),
(3, '0000-00-00', '11:00:00', '12:30:00', 0),
(4, '0000-00-00', '11:30:00', '11:00:00', 0),
(5, '0000-00-00', '09:30:00', '09:00:00', 0),
(6, '0000-00-00', '11:30:00', '11:00:00', 0),
(7, '2025-03-31', '09:00:00', '19:00:00', 0),
(8, '2025-04-03', '09:30:00', '10:00:00', 0),
(9, '2025-04-04', '09:00:00', '15:30:00', 0),
(10, '2025-04-06', '09:00:00', '19:00:00', 0),
(11, '2025-04-06', '13:30:00', '17:50:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestro`
--

CREATE TABLE `maestro` (
  `numeroControl` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_cambio_horario`
--

CREATE TABLE `solicitud_cambio_horario` (
  `id` int(11) NOT NULL,
  `materiaAgregar` varchar(100) DEFAULT NULL,
  `materiaEliminar` varchar(100) DEFAULT NULL,
  `nombreAlumno` varchar(100) DEFAULT NULL,
  `noControl` varchar(50) DEFAULT NULL,
  `motivo` text DEFAULT NULL,
  `estado` enum('espera','aceptada','cancelada') DEFAULT 'espera'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_materia_verano`
--

CREATE TABLE `solicitud_materia_verano` (
  `id` int(11) NOT NULL,
  `materia` varchar(100) NOT NULL,
  `numSolicitudes` int(11) NOT NULL,
  `periodo` varchar(50) NOT NULL,
  `estado` enum('espera','aceptada','rechazada') NOT NULL DEFAULT 'espera'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `numeroControl` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `rol` enum('Coordinador','Alumno','Maestro') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `numeroControl`, `correo`, `contraseña`, `rol`) VALUES
(1, 'DeXAM', 'IS21110372', 'omardlc999@gmail.com', 'red', 'Alumno'),
(2, 'DeXAM', 'IS21110378', 'jolu@gmail.com', '$2y$10$7btdw/vA/YmywLbc30rwvu3xmC5EfGf1aGF.Aw2bTXF1kmHGc1ZPG', 'Coordinador'),
(3, 'DeXAM', 'IS21110379', 'Omar@jim.com', '$2y$10$7btdw/vA/YmywLbc30rwvu3xmC5EfGf1aGF.Aw2bTXF1kmHGc1ZPG', 'Alumno');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`numeroControl`);

--
-- Indices de la tabla `cancelar_cita`
--
ALTER TABLE `cancelar_cita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cita` (`id_cita`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `numeroControl` (`numeroControl`);

--
-- Indices de la tabla `coordinador`
--
ALTER TABLE `coordinador`
  ADD PRIMARY KEY (`numeroControl`);

--
-- Indices de la tabla `horario_coordinador`
--
ALTER TABLE `horario_coordinador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `maestro`
--
ALTER TABLE `maestro`
  ADD PRIMARY KEY (`numeroControl`);

--
-- Indices de la tabla `solicitud_cambio_horario`
--
ALTER TABLE `solicitud_cambio_horario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `noControl` (`noControl`);

--
-- Indices de la tabla `solicitud_materia_verano`
--
ALTER TABLE `solicitud_materia_verano`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numeroControl` (`numeroControl`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cancelar_cita`
--
ALTER TABLE `cancelar_cita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horario_coordinador`
--
ALTER TABLE `horario_coordinador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `solicitud_cambio_horario`
--
ALTER TABLE `solicitud_cambio_horario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud_materia_verano`
--
ALTER TABLE `solicitud_materia_verano`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`numeroControl`) REFERENCES `usuario` (`numeroControl`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cancelar_cita`
--
ALTER TABLE `cancelar_cita`
  ADD CONSTRAINT `cancelar_cita_ibfk_1` FOREIGN KEY (`id_cita`) REFERENCES `cita` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`numeroControl`) REFERENCES `usuario` (`numeroControl`) ON DELETE CASCADE;

--
-- Filtros para la tabla `coordinador`
--
ALTER TABLE `coordinador`
  ADD CONSTRAINT `coordinador_ibfk_1` FOREIGN KEY (`numeroControl`) REFERENCES `usuario` (`numeroControl`) ON DELETE CASCADE;

--
-- Filtros para la tabla `maestro`
--
ALTER TABLE `maestro`
  ADD CONSTRAINT `maestro_ibfk_1` FOREIGN KEY (`numeroControl`) REFERENCES `usuario` (`numeroControl`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitud_cambio_horario`
--
ALTER TABLE `solicitud_cambio_horario`
  ADD CONSTRAINT `solicitud_cambio_horario_ibfk_1` FOREIGN KEY (`noControl`) REFERENCES `alumno` (`numeroControl`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
