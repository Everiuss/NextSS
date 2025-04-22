-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 22-04-2025 a las 21:55:55
-- Versión del servidor: 9.1.0
-- Versión de PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nextss_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

DROP TABLE IF EXISTS `alumno`;
CREATE TABLE IF NOT EXISTS `alumno` (
  `codigoAlumno` int NOT NULL,
  `nombreAlumno` varchar(50) NOT NULL,
  `curp` varchar(50) NOT NULL,
  `domicilio` varchar(50) NOT NULL,
  `fechaNac` date NOT NULL,
  `colonia` varchar(50) NOT NULL,
  `codigoPostal` int NOT NULL,
  `pais` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `correoAlumno` varchar(50) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `trabajoBool` tinyint(1) NOT NULL,
  `empresa` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'NA',
  `IdUsuario` int NOT NULL,
  PRIMARY KEY (`codigoAlumno`),
  KEY `fk_alumnos_usuarios` (`IdUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`codigoAlumno`, `nombreAlumno`, `curp`, `domicilio`, `fechaNac`, `colonia`, `codigoPostal`, `pais`, `estado`, `ciudad`, `correoAlumno`, `telefono`, `trabajoBool`, `empresa`, `IdUsuario`) VALUES
(22075694, 'Julian Martinez Heredia', 'MMGHNJSJU88JJ', 'Pino suarez #532', '2002-08-21', 'El Fresno', 44210, 'Mexico', 'Jalisco', 'Guadalajara', 'mmg@gmail.com', '2147483647', 1, 'UDG', 8),
(220771037, 'Pablo Perez', 'PAPE2257855MRZ', 'Mariano Otero #22079', '1998-12-22', 'Pitayito', 44209, 'Mexico', 'Jalisco', 'Guadalajara', 'pp@gmail.com', '2147455661', 1, 'UDG', 10),
(220721032, 'Jose Luis Rodriguez ', 'JOLR225842MZX', 'Mariano Otero #22079', '2001-03-20', 'Pitayito', 44209, 'Mexico', 'Jalisco', 'Guadalajara', 'joserod@gmail.com', '2147455698', 0, '0', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plazas`
--

DROP TABLE IF EXISTS `plazas`;
CREATE TABLE IF NOT EXISTS `plazas` (
  `id_plaza` int NOT NULL AUTO_INCREMENT,
  `id_alumno` int DEFAULT NULL,
  `numero_oficio` varchar(50) NOT NULL,
  `estatus` enum('ACTIVA','INACTIVA') NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `dependencia` varchar(255) NOT NULL,
  `programa` varchar(255) NOT NULL,
  PRIMARY KEY (`id_plaza`),
  KEY `id_alumno` (`id_alumno`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `plazas`
--

INSERT INTO `plazas` (`id_plaza`, `id_alumno`, `numero_oficio`, `estatus`, `fecha_inicio`, `fecha_fin`, `dependencia`, `programa`) VALUES
(1, 11, '821/CUCEI/2024B', 'ACTIVA', '2024-09-02', NULL, 'COMPUTO Y TELECOMUNICACIONES PARA EL APRENDIZAJE CUCEI', 'Soporte Técnico y Mantenimiento de Equipos de Cómputo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

DROP TABLE IF EXISTS `registro`;
CREATE TABLE IF NOT EXISTS `registro` (
  `idRegistro` int NOT NULL AUTO_INCREMENT,
  `Centro` varchar(100) NOT NULL,
  `Carrera` varchar(100) NOT NULL,
  `CreditosRequeridos` decimal(5,2) NOT NULL,
  `Sede` varchar(100) NOT NULL,
  `codigoAlumno` int NOT NULL,
  `Alumno` varchar(100) NOT NULL,
  `CicloAdmision` varchar(10) NOT NULL,
  `UltimoCicloCursado` varchar(10) NOT NULL,
  `Estatus` enum('Activo','Inactivo','Egresado') NOT NULL,
  `Promedio` decimal(4,2) NOT NULL,
  `Creditos` int NOT NULL,
  `Porcentaje` decimal(5,2) NOT NULL,
  `IdUsuario` int NOT NULL,
  `Registro` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idRegistro`),
  KEY `fk_registro_alumno` (`codigoAlumno`),
  KEY `fk_registro_usuario` (`IdUsuario`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`idRegistro`, `Centro`, `Carrera`, `CreditosRequeridos`, `Sede`, `codigoAlumno`, `Alumno`, `CicloAdmision`, `UltimoCicloCursado`, `Estatus`, `Promedio`, `Creditos`, `Porcentaje`, `IdUsuario`, `Registro`) VALUES
(1, 'CUCEI', 'INCO', 60.00, 'Campus Tecnológico', 22075694, 'Julian Martinez Heredia', '2020B', '2024B', 'Activo', 86.50, 320, 75.00, 8, 1),
(2, 'CUCEA', 'ANCEM', 60.00, 'CUCEA', 220721032, 'Jose Luis Rodríguez ', '2020B', '2025A', 'Activo', 80.00, 620, 80.00, 11, 0),
(5, 'CUCEI', 'INCO', 60.00, 'CUCEI', 220771037, 'Pablo Perez', '2021A', '2025B', 'Activo', 85.00, 552, 85.00, 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

DROP TABLE IF EXISTS `reportes`;
CREATE TABLE IF NOT EXISTS `reportes` (
  `id_reporte` int NOT NULL AUTO_INCREMENT,
  `IdUsuario` int DEFAULT NULL,
  `id_plaza` int DEFAULT NULL,
  `tipo_reporte` enum('BIMESTRAL','FINAL') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `consecutivo` int NOT NULL,
  `fecha_reporte` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `horas_reportadas` int NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `actividades_realizadas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `actividades_ajustadas` enum('SI','NO','EN PARTE') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nuevos_conocimientos` int DEFAULT NULL,
  `experiencias_formativas` int DEFAULT NULL,
  `experiencias_profesionales` int DEFAULT NULL,
  `adquisicion_habilidades` int DEFAULT NULL,
  `aportaciones_institucion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `cumplimiento_actividades` enum('SI','NO','EN PARTE') NOT NULL,
  `estatus` enum('EDICIÓN','APROBADO','RECHAZADO') NOT NULL DEFAULT 'EDICIÓN',
  `ruta_reporte` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_reporte`),
  KEY `id_alumno` (`IdUsuario`),
  KEY `id_plaza` (`id_plaza`)
) ;

--
-- Volcado de datos para la tabla `reportes`
--

INSERT INTO `reportes` (`id_reporte`, `IdUsuario`, `id_plaza`, `tipo_reporte`, `consecutivo`, `fecha_reporte`, `horas_reportadas`, `fecha_inicio`, `fecha_fin`, `actividades_realizadas`, `actividades_ajustadas`, `nuevos_conocimientos`, `experiencias_formativas`, `experiencias_profesionales`, `adquisicion_habilidades`, `aportaciones_institucion`, `cumplimiento_actividades`, `estatus`, `ruta_reporte`) VALUES
(1, 11, NULL, 'BIMESTRAL', 1, '2025-04-21 03:28:20', 120, '2025-04-24', '2025-04-23', 'Actividades de servicio.', 'SI', 8, 5, 4, 12, 'Aporté habilidades.', 'SI', 'EDICIÓN', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `IdUsuario` int NOT NULL AUTO_INCREMENT,
  `Correo` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Contrasena` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Usuario` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Rol` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Imagen` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`IdUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IdUsuario`, `Correo`, `Contrasena`, `Usuario`, `Nombre`, `Rol`, `Imagen`) VALUES
(8, '22075694', '827ccb0eea8a706c4c34a16891f84e7b', 'User1', 'Julian', 'Usuario', '1'),
(10, '220771037', '267f871dd7a510749222a62d52294410', 'Pablo', 'Pablo Perez', 'Usuario', ''),
(11, '220721032', '267f871dd7a510749222a62d52294410', 'JoseLuis', 'Jose Luis Rodríguez ', 'Usuario', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
