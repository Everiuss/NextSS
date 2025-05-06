-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 06-05-2025 a las 02:32:42
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
-- Estructura de tabla para la tabla `ofertas`
--

DROP TABLE IF EXISTS `ofertas`;
CREATE TABLE IF NOT EXISTS `ofertas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `centro` varchar(100) NOT NULL,
  `carrera` enum('INBI','INCO','INRO','IESI','INEA','INNI') NOT NULL,
  `dependencia` varchar(255) NOT NULL,
  `programa` text NOT NULL,
  `turno` enum('Matutino','Vespertino','Nocturno') NOT NULL,
  `hora_desde` time NOT NULL,
  `hora_hasta` time NOT NULL,
  `lugares` int NOT NULL,
  `lugares_restantes` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`id`, `centro`, `carrera`, `dependencia`, `programa`, `turno`, `hora_desde`, `hora_hasta`, `lugares`, `lugares_restantes`) VALUES
(1, 'CUCEI', 'INNI', 'Intel Guadalajara Design Center', 'Intel es una de las principales empresas de tecnología del mundo, especializada en la fabricación de microprocesadores, inteligencia artificial y computación en la nube.', 'Matutino', '08:00:00', '14:00:00', 11, 11),
(2, 'CUCEI', 'INNI', 'IBM México', 'Empresa global de tecnología y consultoría, líder en inteligencia artificial, computación en la nube y soluciones empresariales.', 'Vespertino', '14:00:00', '20:00:00', 9, 9),
(3, 'CUCEI', 'INNI', 'Oracle México', 'Multinacional especializada en bases de datos, software empresarial y soluciones en la nube.', 'Nocturno', '20:00:00', '02:00:00', 20, 20),
(4, 'CUCEI', 'INNI', 'Microsoft México', 'Empresa líder en software y servicios en la nube, incluyendo Office 365 y Azure.', 'Matutino', '09:00:00', '15:00:00', 10, 10),
(5, 'CUCEI', 'INNI', 'Google México', 'Compañía multinacional especializada en servicios de búsqueda en internet, publicidad online y soluciones de computación en la nube.', 'Vespertino', '15:00:00', '21:00:00', 8, 8),
(6, 'CUCEI', 'INCO', 'Tata Consultancy Services (TCS)', 'Multinacional de servicios de TI, consultoría y soluciones empresariales, con una fuerte presencia en México.', 'Matutino', '08:00:00', '03:00:00', 15, 15),
(7, 'CUCEI', 'INCO', 'Luxoft México', 'Empresa de desarrollo de software y soluciones digitales para sectores como la banca, la automoción y la salud.', 'Vespertino', '14:00:00', '21:00:00', 9, 9),
(8, 'CUCEI', 'INCO', 'HP Mexico', 'Empresa líder en hardware y software, conocida por sus computadoras, impresoras y soluciones tecnológicas.', 'Matutino', '08:00:00', '02:00:00', 22, 22),
(9, 'CUCEI', 'INCO', 'Accenture México', 'Multinacional de consultoría en estrategia, digital, tecnología y operaciones.', 'Vespertino', '13:00:00', '19:00:00', 5, 5),
(10, 'CUCEI', 'INCO', 'Softtek', 'Empresa de soluciones tecnológicas, con presencia en varios países ofreciendo servicios de TI, consultoría y desarrollo de software.', 'Matutino', '08:00:00', '04:00:00', 10, 10),
(11, 'CUCEI', 'INRO', 'FANUC México', 'Empresa líder en soluciones de automatización industrial y robótica, especializada en robots industriales y sistemas de manufactura inteligente.', 'Matutino', '06:00:00', '12:00:00', 10, 10),
(12, 'CUCEI', 'INRO', 'KUKA Robotics México', 'Compañía alemana líder en robótica industrial, con aplicaciones en manufactura avanzada y automatización de procesos.', 'Matutino', '08:00:00', '13:30:00', 21, 21),
(13, 'CUCEI', 'INRO', 'ABB México', 'Empresa multinacional suiza especializada en robótica, automatización y soluciones eléctricas industriales.', 'Vespertino', '14:00:00', '20:30:00', 8, 8),
(14, 'CUCEI', 'INRO', 'Universal Robots México', 'Fabricante líder de robots colaborativos que se integran fácilmente a cualquier línea de producción.', 'Matutino', '09:00:00', '15:00:00', 12, 12),
(15, 'CUCEI', 'INRO', 'Yaskawa México', 'Compañía global que desarrolla soluciones de robótica industrial y automatización.', 'Vespertino', '16:00:00', '22:00:00', 6, 6),
(16, 'CUCEI', 'INBI', 'Medtronic México', 'Líder mundial en tecnología médica, especializada en dispositivos para cardiología, neurocirugía y tratamientos de enfermedades crónicas.', 'Vespertino', '14:00:00', '21:30:00', 12, 12),
(17, 'CUCEI', 'INBI', 'Boston Scientific', 'Líder mundial en tecnología médica, especializada en dispositivos para cardiología, neurocirugía y tratamientos de enfermedades crónicas.', 'Nocturno', '22:00:00', '08:00:00', 25, 25),
(18, 'CUCEI', 'INBI', 'Philips Healthcare', 'División médica de Philips, enfocada en equipos de diagnóstico por imagen, monitoreo de pacientes y soluciones para hospitales.', 'Matutino', '08:00:00', '12:00:00', 9, 9),
(19, 'CUCEI', 'INBI', 'Siemens Healthineers', 'Empresa dedicada a la innovación y fabricación de tecnología médica, incluyendo equipos de diagnóstico por imagen y laboratorio.', 'Vespertino', '15:00:00', '21:00:00', 15, 15),
(20, 'CUCEI', 'INBI', 'GE Healthcare', 'Proveedor líder de tecnología médica y servicios, enfocado en imágenes de diagnóstico y dispositivos médicos.', 'Matutino', '07:30:00', '13:00:00', 11, 11),
(21, 'CUCEI', 'INEA', 'Mercedes-Benz México', 'Fabricante de automóviles de lujo, desarrollando soluciones en electromovilidad y tecnologías innovadoras para vehículos.', 'Matutino', '08:00:00', '15:00:00', 10, 10),
(22, 'CUCEI', 'INEA', 'BMW Group México', 'Empresa automotriz que trabaja en el desarrollo de vehículos eléctricos y sostenibles.', 'Vespertino', '14:00:00', '20:00:00', 8, 8),
(23, 'CUCEI', 'INEA', 'Volvo Cars México', 'Compañía líder en electromovilidad y fabricación de automóviles eléctricos.', 'Matutino', '09:00:00', '17:00:00', 5, 5),
(24, 'CUCEI', 'INEA', 'Ford México', 'Desarrollando vehículos híbridos y eléctricos, con un enfoque en la innovación tecnológica para la automotriz.', 'Vespertino', '15:00:00', '22:00:00', 12, 12),
(25, 'CUCEI', 'INEA', 'General Motors México', 'Fabricante de vehículos, incluyendo soluciones tecnológicas en electromovilidad y conducción autónoma.', 'Matutino', '08:00:00', '16:00:00', 7, 6);

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `plazas`
--

INSERT INTO `plazas` (`id_plaza`, `id_alumno`, `numero_oficio`, `estatus`, `fecha_inicio`, `fecha_fin`, `dependencia`, `programa`) VALUES
(6, 11, '826/CUCEI/2025B', 'ACTIVA', '2025-05-03', NULL, 'Softtek', 'Empresa de soluciones tecnológicas, con presencia en varios países ofreciendo servicios de TI, consultoría y desarrollo de software.'),
(5, 11, '825/CUCEI/2025B', 'INACTIVA', '2025-05-03', NULL, 'HP Mexico', 'Empresa líder en hardware y software, conocida por sus computadoras, impresoras y soluciones tecnológicas.');

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
(2, 'CUCEA', 'ANCEM', 60.00, 'CUCEA', 220721032, 'Jose Luis Rodríguez ', '2020B', '2025A', 'Activo', 80.00, 620, 80.00, 11, 1),
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
(1, 11, NULL, 'BIMESTRAL', 1, '2025-04-21 03:28:20', 120, '2025-04-24', '2025-04-23', 'Actividades de servicio.', 'SI', 8, 5, 4, 12, 'Aporté habilidades.', 'SI', 'EDICIÓN', NULL),
(2, 11, NULL, 'BIMESTRAL', 2, '2025-05-02 02:04:01', 160, '2011-02-04', '2016-06-29', 'sakjdfhnsdjnfasr', 'NO', 18, 19, 21, 19, 'dsfgsdfh', 'SI', 'EDICIÓN', NULL);

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
