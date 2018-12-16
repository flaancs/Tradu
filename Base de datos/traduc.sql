-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 16-12-2018 a las 22:57:46
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `traduc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alternativas`
--

CREATE TABLE `alternativas` (
  `idAlternativa` int(11) NOT NULL,
  `alternativa` varchar(100) NOT NULL,
  `alternativa_correcta` tinyint(1) NOT NULL,
  `idPregunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idCategoria` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `icono` varchar(25) NOT NULL,
  `nivel_necesario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `nombre`, `icono`, `nivel_necesario`) VALUES
(1, 'Vocales', 'translate', 1),
(2, 'Formas de saludar', 'accessibility_new', 2),
(3, 'Alfabeto', 'assignment', 3),
(4, 'Frases escenciales', 'stars', 4),
(5, 'Objetos', 'shopping_basket', 5),
(6, 'Expresiones', 'insert_emoticon', 6),
(7, 'Fluidez', 'show_chart', 7),
(8, 'Diálogos', 'insert_comment', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_completadas`
--

CREATE TABLE `categorias_completadas` (
  `idCategoria_completada` int(11) NOT NULL,
  `idPerfil` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conexiones`
--

CREATE TABLE `conexiones` (
  `idConexion` int(11) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `fecha` datetime NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles`
--

CREATE TABLE `niveles` (
  `idNivel` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `exp_necesaria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `niveles`
--

INSERT INTO `niveles` (`idNivel`, `nombre`, `exp_necesaria`) VALUES
(1, 'Novato', 0),
(2, 'Aspirante', 100),
(3, 'Conocedor', 200),
(4, 'Fabuloso', 300),
(5, 'Experto', 400),
(6, 'Casi leyenda', 500),
(7, 'Leyenda', 600),
(8, 'Supremo', 700),
(9, 'Dios', 800);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles_lenguaje_señas`
--

CREATE TABLE `niveles_lenguaje_señas` (
  `idNivel_lenguaje_señas` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `exp_extra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `niveles_lenguaje_señas`
--

INSERT INTO `niveles_lenguaje_señas` (`idNivel_lenguaje_señas`, `nombre`, `exp_extra`) VALUES
(1, 'No', 0),
(2, 'Básico', 50),
(3, 'Intermedio', 150),
(4, 'Avanzado', 200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `idPerfil` int(11) NOT NULL,
  `nombre_usuario` varchar(20) NOT NULL,
  `nombres` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `exp` int(11) NOT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `idUsuario` int(11) NOT NULL,
  `idNivel_lenguaje_señas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `idPregunta` int(11) NOT NULL,
  `pregunta` varchar(100) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntajes`
--

CREATE TABLE `puntajes` (
  `idPuntaje` int(11) NOT NULL,
  `puntuacion` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `idPerfil` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `email` varchar(40) NOT NULL,
  `discapacidad_auditiva` tinyint(1) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `tipo_usuario` int(1) NOT NULL DEFAULT '1',
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alternativas`
--
ALTER TABLE `alternativas`
  ADD PRIMARY KEY (`idAlternativa`),
  ADD KEY `fk_Alternativas_Preguntas1_idx` (`idPregunta`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCategoria`),
  ADD KEY `fk_Categorias_Niveles1_idx` (`nivel_necesario`);

--
-- Indices de la tabla `categorias_completadas`
--
ALTER TABLE `categorias_completadas`
  ADD PRIMARY KEY (`idCategoria_completada`),
  ADD KEY `fk_Categorias_completadas_Perfiles1_idx` (`idPerfil`),
  ADD KEY `fk_Categorias_completadas_Categorias1_idx` (`idCategoria`);

--
-- Indices de la tabla `conexiones`
--
ALTER TABLE `conexiones`
  ADD PRIMARY KEY (`idConexion`),
  ADD KEY `fk_Conexiones_Usuarios_idx` (`idUsuario`);

--
-- Indices de la tabla `niveles`
--
ALTER TABLE `niveles`
  ADD PRIMARY KEY (`idNivel`);

--
-- Indices de la tabla `niveles_lenguaje_señas`
--
ALTER TABLE `niveles_lenguaje_señas`
  ADD PRIMARY KEY (`idNivel_lenguaje_señas`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`idPerfil`),
  ADD KEY `fk_Perfiles_Usuarios1_idx` (`idUsuario`),
  ADD KEY `fk_Perfiles_Niveles_lenguaje_señas1_idx` (`idNivel_lenguaje_señas`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`idPregunta`),
  ADD KEY `fk_Preguntas_Categorias1_idx` (`idCategoria`);

--
-- Indices de la tabla `puntajes`
--
ALTER TABLE `puntajes`
  ADD PRIMARY KEY (`idPuntaje`),
  ADD KEY `fk_Puntajes_Perfiles1_idx` (`idPerfil`),
  ADD KEY `fk_Puntajes_Categorias1_idx` (`idCategoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alternativas`
--
ALTER TABLE `alternativas`
  MODIFY `idAlternativa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `categorias_completadas`
--
ALTER TABLE `categorias_completadas`
  MODIFY `idCategoria_completada` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `conexiones`
--
ALTER TABLE `conexiones`
  MODIFY `idConexion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `niveles`
--
ALTER TABLE `niveles`
  MODIFY `idNivel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `niveles_lenguaje_señas`
--
ALTER TABLE `niveles_lenguaje_señas`
  MODIFY `idNivel_lenguaje_señas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `idPerfil` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `idPregunta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `puntajes`
--
ALTER TABLE `puntajes`
  MODIFY `idPuntaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alternativas`
--
ALTER TABLE `alternativas`
  ADD CONSTRAINT `fk_Alternativas_Preguntas1` FOREIGN KEY (`idPregunta`) REFERENCES `preguntas` (`idPregunta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `fk_Categorias_Niveles1` FOREIGN KEY (`nivel_necesario`) REFERENCES `niveles` (`idNivel`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `categorias_completadas`
--
ALTER TABLE `categorias_completadas`
  ADD CONSTRAINT `fk_Categorias_completadas_Categorias1` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Categorias_completadas_Perfiles1` FOREIGN KEY (`idPerfil`) REFERENCES `perfiles` (`idPerfil`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `conexiones`
--
ALTER TABLE `conexiones`
  ADD CONSTRAINT `fk_Conexiones_Usuarios` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD CONSTRAINT `fk_Perfiles_Niveles_lenguaje_señas1` FOREIGN KEY (`idNivel_lenguaje_señas`) REFERENCES `niveles_lenguaje_señas` (`idNivel_lenguaje_señas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Perfiles_Usuarios1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `fk_Preguntas_Categorias1` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `puntajes`
--
ALTER TABLE `puntajes`
  ADD CONSTRAINT `fk_Puntajes_Categorias1` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Puntajes_Perfiles1` FOREIGN KEY (`idPerfil`) REFERENCES `perfiles` (`idPerfil`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
