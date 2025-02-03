-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 11-05-2023 a las 01:38:54
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clatyhouse_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agenda`
--

DROP TABLE IF EXISTS `agenda`;
CREATE TABLE IF NOT EXISTS `agenda` (
  `IdAgenda` int NOT NULL AUTO_INCREMENT,
  `Fecha` date NOT NULL,
  PRIMARY KEY (`IdAgenda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

DROP TABLE IF EXISTS `carrito`;
CREATE TABLE IF NOT EXISTS `carrito` (
  `IdCarrito` int NOT NULL AUTO_INCREMENT,
  `IdUsuario` int NOT NULL,
  `IdProducto` int NOT NULL,
  `Cantidad` int NOT NULL,
  `Costo` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`IdCarrito`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`IdCarrito`, `IdUsuario`, `IdProducto`, `Cantidad`, `Costo`) VALUES
(2, 7, 1, 1, '155');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

DROP TABLE IF EXISTS `compras`;
CREATE TABLE IF NOT EXISTS `compras` (
  `IdCompra` int NOT NULL AUTO_INCREMENT,
  `IdUsuario` int NOT NULL,
  `IdCarrito` int NOT NULL,
  `IdProducto` int NOT NULL,
  `IdAgenda` int NOT NULL,
  `Costo` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Nota` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Fecha` date NOT NULL,
  PRIMARY KEY (`IdCompra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredientes`
--

DROP TABLE IF EXISTS `ingredientes`;
CREATE TABLE IF NOT EXISTS `ingredientes` (
  `IdIngrediente` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `CantidadActual` int NOT NULL,
  `Imagen` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`IdIngrediente`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `ingredientes`
--

INSERT INTO `ingredientes` (`IdIngrediente`, `Nombre`, `CantidadActual`, `Imagen`) VALUES
(1, 'Harina', 10000, 'https://i.blogs.es/95d4c3/harina-trigo-tipos/1366_2000.jpg'),
(2, 'Crema pastelera', 5, 'https://imag.bonviveur.com/crema-pastelera-con-rama-de-canela.jpg'),
(3, 'Chocolate', 13, 'https://concepto.de/wp-content/uploads/2023/01/chocolate-alimento.jpg'),
(4, 'Vainilla', 15, 'https://elpoderdelconsumidor.org/wp-content/uploads/2019/06/vainilla.jpg'),
(5, 'Leche', 3199, 'https://statics-cuidateplus.marca.com/cms/styles/natural/azblob/lecheok_0.jpg.webp?itok=0XaoEZv0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

DROP TABLE IF EXISTS `inventario`;
CREATE TABLE IF NOT EXISTS `inventario` (
  `IdInventario` int NOT NULL AUTO_INCREMENT,
  `IdIngrediente` int NOT NULL,
  `CantidadActual` int NOT NULL,
  PRIMARY KEY (`IdInventario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `IdPedido` int NOT NULL AUTO_INCREMENT,
  `IdCompra` int NOT NULL,
  `Productos` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Cantidad` int NOT NULL,
  `Costo` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Nota` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`IdPedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `IdProducto` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Informacion` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `CantidadActual` int NOT NULL,
  `Costo` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Imagen` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`IdProducto`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`IdProducto`, `Nombre`, `Informacion`, `CantidadActual`, `Costo`, `Imagen`) VALUES
(1, 'Un verano sin ti', 'Pastel basado en el album \"Un verano sin ti\" del reggaetonero Bad Bunny.', 20, '155', 'https://scontent.fgdl9-1.fna.fbcdn.net/v/t39.30808-6/337124185_6260991850588401_3940712692292993071_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeGIXXJAfXLzM-nKdgMiWSCuoe9YBjq2X26h71gGOrZfbji0l36pXEuJ8kQIzs9ZeCodkX2-bH9PJYxqKxaxR5fb&_nc_ohc=qDI42pBR5CgAX_Lf3Hj&_nc_ht=scontent.fgdl9-1.fna&oh=00_AfCSq8FB6UYXHLKoMwE8Q-X_GTUFwE3cYavcLLPcK1Yzkw&oe=6424641F'),
(2, 'Años más tarde', 'Pastel basado en la icónica frase \"2000 años más tarde\" del show animado \"Bob Esponja ®\".', 27, '230', 'https://scontent.fgdl9-1.fna.fbcdn.net/v/t39.30808-6/337532675_3716046022009923_5263351703764502378_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeFITKBtE6zjdoczrMoUOG-XfVKtb0MFidx9Uq1vQwWJ3IMJ3bsFr09hslqDfQn2ceGSgzbTvRplu65--DmnJs1o&_nc_ohc=Jq6tf-RUu30AX_mYMBu&_nc_ht=scontent.fgdl9-1.fna&oh=00_AfD1eX_f23xCJkMLbDSWXacRP-FpB1_mT21ocTpvz-ZcPQ&oe=64244108'),
(3, 'Happy Birthday - Pastelito negro con colorcitos', 'Pastel de cumpleaños de color negro, letras blancas y estrellas de colores.', 31, '300', 'https://scontent.fgdl9-1.fna.fbcdn.net/v/t39.30808-6/337273839_1500472137145052_7759656736934607560_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeFX5i3kbPgm33GnPLJaNIGFQFDoNDIb4pVAUOg0MhvilXBi-72tTbJZhLXLZCBNYUy-ensLXgVNNVk5tKTJB8xn&_nc_ohc=jhNQhrST9OkAX-LbXVp&_nc_ht=scontent.fgdl9-1.fna&oh=00_AfBaT_JuUoyk3XdaF2YLBVmkHXE__HJe4e10YhXltUPGxg&oe=6424F882'),
(4, 'Pastelito de Suga BTS', 'Pastelito de tonalidades verdes con estampado de Suga del grupo BTS.', 35, '130', 'https://scontent.fgdl9-1.fna.fbcdn.net/v/t39.30808-6/336247015_233988782412772_6990289489936929030_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeE71NSCRWiC8rLeoWXOqpnlaVLYu_YLGLtpUti79gsYu-bMXYdendryaEVJTZOpPyXRBuALx2N5Cic4SviXDscj&_nc_ohc=e9Pd_4wHLQIAX-GGbVf&_nc_ht=scontent.fgdl9-1.fna&oh=00_AfAvuVNNH7GELG-veGe6ykbQ8ckjuGpTIRTaCeUMCMLh0w&oe=64243512'),
(5, 'Miercoles sin ti', 'Es un pastel enfocado a Miercoles sin ti.', 7, '50', 'https://ozgrozer.github.io/100k-faces/0/4/004455.jpg'),
(6, 'Dragon Ball', 'Pastel basado en el anime Dragon Ball.', 22, '340', 'https://scontent.fgdl3-1.fna.fbcdn.net/v/t39.30808-6/314604154_577409937718401_8222129029141585236_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeHhajxanUmfMmmE9si-WHDtwMxFL964zfHAzEUv3rjN8bQ4EW1RivcXLCf5dT_gUUwKNjk5RDE3fE9Xu1yy-i7u&_nc_ohc=hbIsWgvwCn0AX-WTm-a&_nc_ht=scontent.fgdl3-1.fna&oh=00_AfAign-RoamHQHWiN66AWEybcW1B9tzbXgRGpzZXTua_OQ&oe=642A7EF7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

DROP TABLE IF EXISTS `recetas`;
CREATE TABLE IF NOT EXISTS `recetas` (
  `IdReceta` int NOT NULL AUTO_INCREMENT,
  `IdProducto` int NOT NULL,
  `Nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Preparacion` varchar(5000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`IdReceta`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`IdReceta`, `IdProducto`, `Nombre`, `Preparacion`) VALUES
(11, 3, 'Pastel básico de chocolate', '   Para hacer un pastel de chocolate, primero precalienta el horno a 180 grados Celsius y prepara un molde para pastel engrasándolo y enharinándolo. En un recipiente, mezcla 2 tazas de harina, 2 tazas de azúcar, 3/4 taza de cacao en polvo, 2 cucharaditas de bicarbonato de sodio, 1 cucharadita de polvo de hornear y 1 cucharadita de sal. Añade 1 taza de leche, 1/2 taza de aceite vegetal, 2 huevos y 2 cucharaditas de extracto de vainilla a los ingredientes secos y mezcla todo hasta que esté bien combinado. Agrega 1 taza de agua caliente y mezcla hasta que la masa esté suave. Vierte la masa en el molde y hornea durante 35 a 40 minutos o hasta que un palillo insertado en el centro salga limpio. Deja que el pastel se enfríe antes de servir y, si lo deseas, decóralo con tu glaseado favorito.'),
(12, 1, 'Pastel básico de vainilla', '   Para hacer un pastel de vainilla, precalienta el horno a 180 grados Celsius y engrasa un molde para pastel. En un recipiente grande, mezcla 2 tazas de harina para todo uso, 2 cucharaditas de polvo de hornear y 1/2 cucharadita de sal. En otro recipiente, bate 1 taza de mantequilla ablandada con 1 1/2 tazas de azúcar granulada hasta que la mezcla esté suave y esponjosa. Agrega 4 huevos uno por uno, asegurándote de que cada uno esté bien incorporado antes de agregar el siguiente. Agrega 2 cucharaditas de extracto de vainilla y mezcla bien. Incorpora lentamente los ingredientes secos a la mezcla de mantequilla y huevos, alternando con 1 taza de leche. Mezcla bien, asegurándote de no sobrebatir la masa. Vierte la masa en el molde preparado y hornea durante 30-35 minutos o hasta que un palillo insertado en el centro salga limpio. Deja que el pastel se enfríe antes de desmoldar y servir con tu glaseado favorito.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receta_ingredientes`
--

DROP TABLE IF EXISTS `receta_ingredientes`;
CREATE TABLE IF NOT EXISTS `receta_ingredientes` (
  `Id_Receta` int NOT NULL,
  `Id_Ingrediente` int NOT NULL,
  `cantidad` int DEFAULT NULL,
  PRIMARY KEY (`Id_Receta`,`Id_Ingrediente`),
  KEY `Id_Ingrediente` (`Id_Ingrediente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `receta_ingredientes`
--

INSERT INTO `receta_ingredientes` (`Id_Receta`, `Id_Ingrediente`, `cantidad`) VALUES
(11, 1, 250),
(11, 3, 5),
(11, 5, 100),
(12, 1, 250),
(12, 4, 5),
(12, 5, 100);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IdUsuario`, `Correo`, `Contrasena`, `Usuario`, `Nombre`, `Rol`, `Imagen`) VALUES
(1, 'correoprueba@gmail.com', '267f871dd7a510749222a62d52294410', 'Ozdy', 'Edgar Omar Monreal', 'Usuario', 'https://ozgrozer.github.io/100k-faces/0/4/004455.jpg'),
(2, 'mm@gmail.com', 'e729c6c62987bca7cb16e494755ae522', 'Everius', 'Marlon Uriel Munguia Guizar', 'Usuario', 'https://100k-faces.glitch.me/random-image'),
(3, 'correoprueba2@gmail.com', '267f871dd7a510749222a62d52294410', 'Mofles', 'Efrain Rosales Rocha', 'Usuario', 'https://ozgrozer.github.io/100k-faces/0/8/008322.jpg'),
(5, 'correopruebaadmin@gmail.com', '267f871dd7a510749222a62d52294410', 'Ozdev', 'Edgar Monreal', 'Administrador', 'https://scontent.fgdl9-1.fna.fbcdn.net/v/t39.30808-6/337124185_6260991850588401_3940712692292993071_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeGIXXJAfXLzM-nKdgMiWSCuoe9YBjq2X26h71gGOrZfbji0l36pXEuJ8kQIzs9ZeCodkX2-bH9PJYxqKxaxR5fb&_nc_ohc=qDI42pBR5CgAX_Lf3Hj&_nc_ht=scontent.fgdl9-1.fna&oh=00_AfCSq8FB6UYXHLKoMwE8Q-X_GTUFwE3cYavcLLPcK1Yzkw&oe=6424641F'),
(6, 'CorreoFalso@gmail.com', '9c87400128d408cdcda0e4b3ff0e66fa', 'KNH', 'pepe', 'Usuario', 'https://i.redd.it/6350ye2uqlc61.jpg'),
(7, 'pancho@gmail.com', '442e66a58132a586bdae9e9cdc5a1ebf', 'Pancho', 'ALfonso', 'Usuario', 'asdads');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `receta_ingredientes`
--
ALTER TABLE `receta_ingredientes`
  ADD CONSTRAINT `receta_ingredientes_ibfk_1` FOREIGN KEY (`Id_Receta`) REFERENCES `recetas` (`IdReceta`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
