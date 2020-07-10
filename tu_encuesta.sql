-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 10-07-2020 a las 01:28:24
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tu_encuesta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta`
--

CREATE TABLE `encuesta` (
  `id_encuesta` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `encuesta`
--

INSERT INTO `encuesta` (`id_encuesta`, `titulo`) VALUES
(1, 'Esta encuesta es una prueba'),
(2, 'Esta es otra encuesta mas corta por comparar'),
(3, 'Esta funciona a juro'),
(4, 'Encuesta creada desde el baifon'),
(5, 'UD cree que Maduro es un cdm?'),
(6, 'Nueva Encuesta'),
(7, 'lorem lorem ipsum ipsum');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id_pregunta` int(10) UNSIGNED NOT NULL,
  `pregunta` varchar(100) NOT NULL,
  `id_enc_pregunta` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id_pregunta`, `pregunta`, `id_enc_pregunta`) VALUES
(1, 'Espero que funcione porque si no super F!', 1),
(2, 'Pregunta 2', 1),
(3, 'Pregunta 3', 1),
(4, 'Respondeme un par de cosas', 2),
(5, 'Segunda interrogante a responder', 2),
(6, 'Ok preparate que con esta ya lo que queda es facil', 3),
(7, 'Question 2', 3),
(8, 'Esta es la ultima pregunta y la mas dificil piensalo bien', 3),
(9, 'Pregunta de relleno', 4),
(10, 'Quiere que lo lleven preso a EEUU?', 5),
(11, 'Quiere una intervención extranjera?', 5),
(12, 'Pregunta nro 1', 6),
(13, 'Pregunta nro 2', 6),
(14, 'Encuesta desde la version del repositorio', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `id_respuesta` int(10) UNSIGNED NOT NULL,
  `respuesta` varchar(100) NOT NULL,
  `id_preg_respuesta` int(10) UNSIGNED NOT NULL,
  `conteo` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`id_respuesta`, `respuesta`, `id_preg_respuesta`, `conteo`) VALUES
(1, '1', 1, 0),
(2, '2', 1, 0),
(3, '3', 1, 2),
(4, '4', 1, 0),
(5, '1', 2, 0),
(6, '2', 2, 0),
(7, '3', 2, 1),
(8, '4', 2, 1),
(9, '1', 3, 1),
(10, '2', 3, 1),
(11, '3', 3, 0),
(12, '4', 3, 0),
(13, 'Esta es la opcion correcta', 4, 0),
(14, 'Esta no es, ¿o si?', 4, 0),
(15, 'Esta es la opcion correcta', 5, 0),
(16, 'Esta no es, ¿o si?', 5, 0),
(17, 'Si o que', 6, 0),
(18, 'Relajao como who says', 6, 1),
(19, 'ready', 6, 0),
(20, 'resp 1', 7, 0),
(21, 'resp 2', 7, 1),
(22, 'Mira abajo', 8, 0),
(23, 'Mira arriba', 8, 1),
(24, 'Activo', 9, 2),
(25, 'En la pista', 9, 2),
(26, 'Funcionan2', 9, 3),
(27, 'Si', 10, 0),
(28, 'No', 10, 0),
(29, 'Mejor muerto', 10, 1),
(30, 'No sé', 10, 0),
(31, 'Sí', 11, 1),
(32, 'Si', 11, 0),
(33, 'Si', 11, 0),
(34, 'x', 12, 0),
(35, 'x', 12, 0),
(36, 'x', 12, 0),
(37, 'y', 13, 0),
(38, 'y', 13, 0),
(39, 'Hola si funciona', 14, 0),
(40, 'Nada sigue revisando', 14, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `ip_usuario` varchar(15) NOT NULL,
  `id_enc_usuario` int(10) UNSIGNED NOT NULL,
  `accion` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `ip_usuario`, `id_enc_usuario`, `accion`) VALUES
(1, '127.0.0.1', 1, 'creador'),
(2, '127.0.0.1', 2, 'creador'),
(3, '127.0.0.1', 3, 'creador'),
(4, '192.168.1.102', 4, 'creador'),
(5, '192.168.1.103', 5, 'creador'),
(6, '192.168.1.103', 3, 'encuestado'),
(7, '192.168.1.103', 4, 'encuestado'),
(8, '192.168.1.103', 1, 'encuestado'),
(9, '127.0.0.1', 6, 'creador'),
(10, '127.0.0.1', 7, 'creador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD PRIMARY KEY (`id_encuesta`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id_pregunta`),
  ADD KEY `id_enc_pregunta` (`id_enc_pregunta`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`id_respuesta`),
  ADD KEY `id_preg_respuesta` (`id_preg_respuesta`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_enc_usuario` (`id_enc_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  MODIFY `id_encuesta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id_pregunta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `id_respuesta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `pregunta_ibfk_1` FOREIGN KEY (`id_enc_pregunta`) REFERENCES `encuesta` (`id_encuesta`);

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `respuesta_ibfk_1` FOREIGN KEY (`id_preg_respuesta`) REFERENCES `pregunta` (`id_pregunta`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_enc_usuario`) REFERENCES `encuesta` (`id_encuesta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
