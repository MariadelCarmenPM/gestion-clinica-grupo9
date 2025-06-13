-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-06-2025 a las 08:47:46
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestion_clinica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id_cita` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `fecha_cita` date NOT NULL,
  `hora_cita` time NOT NULL,
  `estado` enum('pendiente','atendida','cancelada') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuraciones`
--

CREATE TABLE `configuraciones` (
  `clave` varchar(50) NOT NULL,
  `valor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disponibilidad_medica`
--

CREATE TABLE `disponibilidad_medica` (
  `id_disponibilidad` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `dia_semana` enum('Lunes','Martes','Miércoles','Jueves','Viernes','Sábado') NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

CREATE TABLE `especialidades` (
  `id_especialidad` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`id_especialidad`, `nombre`) VALUES
(17, 'Ginecología'),
(18, 'Medicina general'),
(19, 'Dermatología');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historias_clinicas`
--

CREATE TABLE `historias_clinicas` (
  `id_historia` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `fecha_registro` date NOT NULL,
  `motivo_consulta` text NOT NULL,
  `diagnostico` text NOT NULL,
  `tratamiento` text NOT NULL,
  `id_medico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs_consultas`
--

CREATE TABLE `logs_consultas` (
  `id_log` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tipo_accion` enum('consulta','registro','edicion','eliminacion') NOT NULL,
  `tabla_afectada` varchar(50) NOT NULL,
  `id_afectado` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE `medicos` (
  `id_medico` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `cmp` varchar(20) NOT NULL,
  `id_especialidad` int(11) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `correo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`id_medico`, `id_usuario`, `nombres`, `apellidos`, `cmp`, `id_especialidad`, `telefono`, `direccion`, `correo`) VALUES
(8, 1, 'María', 'Prado', '1212', 17, '957589039', 'A.v Los Claveles, MzD3, Lote 03 , AAHH ANCIETA ALTA', 'amyabigail1522@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id_paciente` int(11) NOT NULL,
  `dni` varchar(10) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `sexo` enum('M','F') NOT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `id_reporte` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `contenido` text NOT NULL,
  `fecha_generado` datetime NOT NULL,
  `generado_por` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `rol` enum('admin','recepcionista','medico') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `contraseña`, `rol`) VALUES
(1, 'admin', '1234', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_medico` (`id_medico`);

--
-- Indices de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  ADD PRIMARY KEY (`clave`);

--
-- Indices de la tabla `disponibilidad_medica`
--
ALTER TABLE `disponibilidad_medica`
  ADD PRIMARY KEY (`id_disponibilidad`),
  ADD KEY `id_medico` (`id_medico`);

--
-- Indices de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`id_especialidad`);

--
-- Indices de la tabla `historias_clinicas`
--
ALTER TABLE `historias_clinicas`
  ADD PRIMARY KEY (`id_historia`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_medico` (`id_medico`);

--
-- Indices de la tabla `logs_consultas`
--
ALTER TABLE `logs_consultas`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`id_medico`),
  ADD UNIQUE KEY `cmp` (`cmp`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_especialidad` (`id_especialidad`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD PRIMARY KEY (`id_reporte`),
  ADD KEY `generado_por` (`generado_por`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `disponibilidad_medica`
--
ALTER TABLE `disponibilidad_medica`
  MODIFY `id_disponibilidad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `id_especialidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `historias_clinicas`
--
ALTER TABLE `historias_clinicas`
  MODIFY `id_historia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `logs_consultas`
--
ALTER TABLE `logs_consultas`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medicos`
--
ALTER TABLE `medicos`
  MODIFY `id_medico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id_reporte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`),
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`id_medico`) REFERENCES `medicos` (`id_medico`);

--
-- Filtros para la tabla `disponibilidad_medica`
--
ALTER TABLE `disponibilidad_medica`
  ADD CONSTRAINT `disponibilidad_medica_ibfk_1` FOREIGN KEY (`id_medico`) REFERENCES `medicos` (`id_medico`);

--
-- Filtros para la tabla `historias_clinicas`
--
ALTER TABLE `historias_clinicas`
  ADD CONSTRAINT `historias_clinicas_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`),
  ADD CONSTRAINT `historias_clinicas_ibfk_2` FOREIGN KEY (`id_medico`) REFERENCES `medicos` (`id_medico`);

--
-- Filtros para la tabla `logs_consultas`
--
ALTER TABLE `logs_consultas`
  ADD CONSTRAINT `logs_consultas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD CONSTRAINT `medicos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `medicos_ibfk_2` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidades` (`id_especialidad`);

--
-- Filtros para la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD CONSTRAINT `reportes_ibfk_1` FOREIGN KEY (`generado_por`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
