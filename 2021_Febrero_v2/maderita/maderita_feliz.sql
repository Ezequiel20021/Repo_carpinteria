-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-12-2020 a las 20:47:12
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `maderita_feliz`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `usuario` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `usuario`, `password`) VALUES
(1, 'gilberto', 'gil123berto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(144) DEFAULT NULL,
  `img` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `img`) VALUES
(27, 'dragon ball1', 'uploads/categorias/1606677956_logo.png'),
(28, 'dragon ball2', 'uploads/categorias/1606677956_logo.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `id` int(11) NOT NULL,
  `pregunta` varchar(500) DEFAULT NULL,
  `respuesta` varchar(500) NOT NULL,
  `idProducto` int(11) DEFAULT NULL,
  `fechaDeCarga` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `consultas`
--

INSERT INTO `consultas` (`id`, `pregunta`, `respuesta`, `idProducto`, `fechaDeCarga`) VALUES
(16, 'sadsadsa', 'esta', 65, '2020-12-08 07:58:33'),
(18, 'sadsdaasdsa', '324232', 65, '2020-12-08 07:58:46'),
(19, 'adsssad', 'gfdg', 65, '2020-12-08 08:01:53'),
(20, 'saddsadsa', 'dsada', 65, '2020-12-08 07:58:52'),
(21, 'dsadsa', '12eds', 65, '2020-12-08 07:58:54'),
(22, 'dfdsfds', '2wdqdwqd', 65, '2020-12-08 07:58:57'),
(23, 'dsdsa', '213esd', 65, '2020-12-08 07:59:00'),
(24, 'ssaddsa', 'sdasd21d1', 65, '2020-12-08 07:59:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `producto` varchar(500) DEFAULT NULL,
  `descripcion` varchar(500) NOT NULL,
  `acotacion` varchar(200) NOT NULL,
  `precio` float DEFAULT NULL,
  `idCategoria` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `img` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `producto`, `descripcion`, `acotacion`, `precio`, `idCategoria`, `stock`, `img`) VALUES
(4, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 28, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(6, 'mosquitrap', 'mosquito<div>facherito</div><div>no da cancer</div><div>bueno, un poco</div>', 'bueno... da un poquito de caner', 35.98, 28, 3, 'uploads/productos/1606676090_dengue.jpg'),
(7, 'mosquitrap', 'mosquito<div>facherito</div><div>no da cancer</div><div>bueno, un poco</div>', 'bueno... da un poquito de caner', 35.98, 28, 3, 'uploads/productos/1606676090_dengue.jpg'),
(8, 'mosquitrap', 'mosquito<div>facherito</div><div>no da cancer</div><div>bueno, un poco</div>', 'bueno... da un poquito de caner', 35.98, 28, 3, 'uploads/productos/1606676090_dengue.jpg'),
(9, 'mosquitrap', 'mosquito<div>facherito</div><div>no da cancer</div><div>bueno, un poco</div>', 'bueno... da un poquito de caner', 35.98, 28, 3, 'uploads/productos/1606676090_dengue.jpg'),
(10, 'mosquitrap', 'mosquito<div>facherito</div><div>no da cancer</div><div>bueno, un poco</div>', 'bueno... da un poquito de caner', 35.98, 28, 3, 'uploads/productos/1606676090_dengue.jpg'),
(11, 'mosquitrap', 'mosquito<div>facherito</div><div>no da cancer</div><div>bueno, un poco</div>', 'bueno... da un poquito de caner', 35.98, 28, 3, 'uploads/productos/1606676090_dengue.jpg'),
(12, 'mosquitrap', 'mosquito<div>facherito</div><div>no da cancer</div><div>bueno, un poco</div>', 'bueno... da un poquito de caner', 35.98, 28, 3, 'uploads/productos/1606676090_dengue.jpg'),
(13, 'mosquitrap', 'mosquito<div>facherito</div><div>no da cancer</div><div>bueno, un poco</div>', 'bueno... da un poquito de caner', 35.98, 28, 3, 'uploads/productos/1606676090_dengue.jpg'),
(14, 'mosquitrap', 'mosquito<div>facherito</div><div>no da cancer</div><div>bueno, un poco</div>', 'bueno... da un poquito de caner', 35.98, 28, 3, 'uploads/productos/1606676090_dengue.jpg'),
(15, 'mosquitrap', 'mosquito<div>facherito</div><div>no da cancer</div><div>bueno, un poco</div>', 'bueno... da un poquito de caner', 35.98, 28, 3, 'uploads/productos/1606676090_dengue.jpg'),
(16, 'mosquitrap', 'mosquito<div>facherito</div><div>no da cancer</div><div>bueno, un poco</div>', 'bueno... da un poquito de caner', 35.98, 28, 3, 'uploads/productos/1606676090_dengue.jpg'),
(17, 'mosquitrap', 'mosquito<div>facherito</div><div>no da cancer</div><div>bueno, un poco</div>', 'bueno... da un poquito de caner', 35.98, 28, 3, 'uploads/productos/1606676090_dengue.jpg'),
(18, 'mosquitrap', 'mosquito<div>facherito</div><div>no da cancer</div><div>bueno, un poco</div>', 'bueno... da un poquito de caner', 35.98, 28, 3, 'uploads/productos/1606676090_dengue.jpg'),
(19, 'mosquitrap', 'mosquito<div>facherito</div><div>no da cancer</div><div>bueno, un poco</div>', 'bueno... da un poquito de caner', 35.98, 27, 3, 'uploads/productos/1606676090_dengue.jpg'),
(20, 'mosquitrap', 'mosquito<div>facherito</div><div>no da cancer</div><div>bueno, un poco</div>', 'bueno... da un poquito de caner', 35.98, 27, 3, 'uploads/productos/1606676090_dengue.jpg'),
(21, 'mosquitrap', 'mosquito<div>facherito</div><div>no da cancer</div><div>bueno, un poco</div>', 'bueno... da un poquito de caner', 35.98, 27, 3, 'uploads/productos/1606676090_dengue.jpg'),
(22, 'mosquitrap', 'mosquito<div>facherito</div><div>no da cancer</div><div>bueno, un poco</div>', 'bueno... da un poquito de caner', 35.98, 27, 3, 'uploads/productos/1606676090_dengue.jpg'),
(23, 'mosquitrap', 'mosquito<div>facherito</div><div>no da cancer</div><div>bueno, un poco</div>', 'bueno... da un poquito de caner', 35.98, 28, 3, 'uploads/productos/1606676090_dengue.jpg'),
(24, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(25, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(26, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(27, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(28, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(29, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(30, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(31, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(32, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(33, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(34, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(35, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(36, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(37, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(38, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(39, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(40, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(41, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(42, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(43, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(44, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(45, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(46, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(47, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(48, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(49, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(50, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(51, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(52, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(53, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(54, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(55, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(56, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(57, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(58, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(59, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(60, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(61, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(62, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(63, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(64, 'nose eq', 'no tengo idea<div>que es esto</div><div>bueno no se</div>', 'la verdad no entiendo', 15, 27, 0, 'uploads/productos/1606626089_Captura de pantalla (2).png'),
(65, 'cde piolita', 'es ta bonito\r\nsd\r\nsad\r\ndsa\r\ndsa', 'muy bonito', 235, 28, 9, 'uploads/productos/1607379372_NEWLOGO.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consultas_ibfk_1` (`idProducto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`idCategoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD CONSTRAINT `consultas_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
