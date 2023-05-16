-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-01-2022 a las 20:44:36
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `turismo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(100) NOT NULL,
  `estado_categoria` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_categoria`, `estado_categoria`) VALUES
(1, 'A. ORGANIZACIÓN', 0),
(2, 'B. LIDERAZGO', 1),
(3, 'C. PLANIFICACION', 1),
(4, 'D. APOYO', 1),
(5, 'E. OPERACIÓN ', 1),
(6, 'F.  DESEMPEÑO', 1),
(7, 'G. MEJORA', 1),
(13, 'ffff', 1),
(14, 'kola', 1),
(15, 'fd', 1),
(16, 'w', 1),
(17, 'ttttt', 1),
(18, 'sd', 1),
(19, 'szxcxc', 1),
(20, 'swdesfd', 1),
(21, 'sdf', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `direccion` text NOT NULL,
  `correo` varchar(100) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `nombre`, `telefono`, `direccion`, `correo`, `foto`) VALUES
(1, 'Sistema  turismo', '09313131313131', 'Riobamba', 'deliflou@gmail.com', 'logo.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `criterio`
--

CREATE TABLE `criterio` (
  `id_criterio` int(11) NOT NULL,
  `valor_criterio` float NOT NULL,
  `nombre_criterio` varchar(200) NOT NULL,
  `identificacion_criterio` varchar(200) NOT NULL,
  `fase_criterio` varchar(200) DEFAULT NULL,
  `estado_criterio` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `criterio`
--

INSERT INTO `criterio` (`id_criterio`, `valor_criterio`, `nombre_criterio`, `identificacion_criterio`, `fase_criterio`, `estado_criterio`) VALUES
(1, 10, 'Se establece, se implementa y se mantiene', 'A. Cumple completamente con el criterio enunciado', '  Verificar y Actuar', 0),
(2, 5, 'Se establece, se implementa, no se mantiene; ', 'B. cumple parcialmente con el criterio enunciado', ' Hacer', 1),
(3, 3, 'Se establece, no se implementa, no se mantiene;', 'C. Cumple con el mínimo del criterio enunciado', ' Planeación', 1),
(4, 0, 'No se establece, no se implementa, no se mantiene N/S). ', 'D. No cumple con el criterio enunciado', 'N/S', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

CREATE TABLE `detalle` (
  `id_detalle` int(11) NOT NULL,
  `id_evaluacion` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL,
  `id_criterio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle`
--

INSERT INTO `detalle` (`id_detalle`, `id_evaluacion`, `id_pregunta`, `id_criterio`) VALUES
(21, 16, 1, 1),
(22, 60, 156, 2),
(23, 60, 158, 2),
(24, 60, 157, 2),
(25, 61, 154, 1),
(26, 61, 155, 2),
(27, 62, 10, 1),
(28, 62, 5, 2),
(29, 62, 6, 2),
(30, 62, 9, 2),
(31, 62, 8, 1),
(32, 62, 7, 1),
(33, 62, 3, 1),
(34, 62, 1, 2),
(35, 62, 4, 1),
(36, 62, 11, 1),
(37, 62, 13, 2),
(38, 63, 10, 2),
(39, 63, 5, 1),
(40, 63, 6, 2),
(41, 63, 9, 1),
(42, 63, 8, 2),
(43, 63, 7, 1),
(44, 63, 3, 2),
(45, 63, 1, 1),
(46, 63, 4, 2),
(47, 63, 11, 1),
(48, 63, 13, 2),
(49, 64, 156, 1),
(50, 64, 158, 1),
(51, 64, 157, 1),
(52, 65, 154, 1),
(53, 65, 155, 2),
(54, 66, 154, 1),
(55, 66, 155, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_permisos`
--

CREATE TABLE `detalle_permisos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_permisos`
--

INSERT INTO `detalle_permisos` (`id`, `id_usuario`, `id_permiso`) VALUES
(10, 1, 1),
(11, 1, 2),
(12, 1, 6),
(13, 1, 3),
(14, 1, 4),
(15, 1, 5),
(21, 6, 3),
(22, 6, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `establecimiento`
--

CREATE TABLE `establecimiento` (
  `id_establecimiento` int(11) NOT NULL,
  `nombre_establecimiento` varchar(200) NOT NULL,
  `direccion_establecimiento` varchar(200) NOT NULL,
  `propietario_establecimiento` varchar(100) NOT NULL,
  `estado_establecimiento` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `establecimiento`
--

INSERT INTO `establecimiento` (`id_establecimiento`, `nombre_establecimiento`, `direccion_establecimiento`, `propietario_establecimiento`, `estado_establecimiento`) VALUES
(1, 'Palacio Real', 'Calpi', 'Eiza Delgado', 1),
(2, 'Centro Turistico Q\'inti', 'San Juan Chimborazo', 'Nayib Delgado', 1),
(3, 'ccccc', 'ccccc', 'cccc', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion`
--

CREATE TABLE `evaluacion` (
  `id_evaluacion` int(11) NOT NULL,
  `id_formulario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_establecimiento` int(11) NOT NULL,
  `total` float DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `evaluacion`
--

INSERT INTO `evaluacion` (`id_evaluacion`, `id_formulario`, `id_usuario`, `id_establecimiento`, `total`, `fecha`) VALUES
(15, 1, 1, 1, 100, '0000-00-00'),
(16, 1, 1, 1, 100, '0000-00-00'),
(17, 1, 1, 1, 100, '0000-00-00'),
(18, 1, 1, 1, 100, '0000-00-00'),
(19, 1, 1, 1, 100, '0000-00-00'),
(20, 1, 1, 1, 100, '0000-00-00'),
(21, 334, 1, 2, 100, '0000-00-00'),
(22, 334, 1, 1, 100, '0000-00-00'),
(23, 334, 1, 1, 100, '0000-00-00'),
(24, 334, 1, 1, 100, '0000-00-00'),
(25, 24, 1, 154, 100, '0000-00-00'),
(26, 25, 1, 155, 100, '0000-00-00'),
(27, 334, 1, 1, 100, '2022-02-01'),
(28, 27, 1, 154, 100, '2022-02-01'),
(29, 27, 1, 155, 100, '2022-02-01'),
(30, 335, 1, 1, 100, '2022-02-01'),
(31, 335, 1, 1, 100, '2022-02-01'),
(32, 335, 1, 1, 100, '2022-02-01'),
(33, 335, 1, 1, 100, '2022-02-01'),
(34, 335, 1, 1, 100, '2022-02-01'),
(35, 334, 1, 1, 100, '2022-02-01'),
(36, 334, 1, 1, 100, '2022-02-01'),
(47, 2, 1, 2, NULL, NULL),
(48, 2, 1, 2, 100, NULL),
(49, 2, 1, 2, 100, '2022-02-01'),
(50, 335, 1, 1, 100, '2022-02-01'),
(51, 335, 1, 1, 100, '2022-02-01'),
(52, 335, 1, 1, 100, '2022-02-01'),
(53, 335, 1, 1, 100, '2022-02-01'),
(54, 335, 1, 1, 100, '2022-02-01'),
(55, 335, 1, 1, 100, '2022-02-01'),
(56, 335, 1, 1, 100, '2022-02-01'),
(57, 335, 1, 1, 100, '2022-02-01'),
(58, 335, 1, 1, 100, '2022-02-01'),
(59, 335, 1, 1, 100, '2022-02-01'),
(60, 335, 1, 1, 100, '2022-02-01'),
(61, 334, 1, 1, 100, '2022-02-01'),
(62, 1, 1, 1, 100, '2022-02-01'),
(63, 1, 1, 2, 100, '2022-02-01'),
(64, 335, 1, 2, 100, '2022-02-01'),
(65, 334, 1, 1, 100, '2022-02-01'),
(66, 334, 1, 1, 100, '2022-02-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulario`
--

CREATE TABLE `formulario` (
  `id_formulario` int(11) NOT NULL,
  `nombre_formulario` varchar(200) NOT NULL DEFAULT 'Formulario sin nombre',
  `descripcion_formulario` varchar(100) NOT NULL DEFAULT 'Sin descripcion',
  `fecha_formulario` date NOT NULL,
  `estado_formulario` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `formulario`
--

INSERT INTO `formulario` (`id_formulario`, `nombre_formulario`, `descripcion_formulario`, `fecha_formulario`, `estado_formulario`) VALUES
(1, 'Formulario 01: Evaluaxcion de sobre algo', 'Este formulario es una prueba', '0000-00-00', 1),
(2, 'Formulario de preguntas sobre calidad', 'formulario de prueba para el sistema', '0000-00-00', 1),
(333, 'nuevo', 'formulario prueba', '0000-00-00', 1),
(334, 'formilaro 3', 'firmin 444', '0000-00-00', 1),
(335, 'Formulario 22222', '2222ffff', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestion`
--

CREATE TABLE `gestion` (
  `id_gestion` int(11) NOT NULL,
  `nombre_gestion` varchar(100) NOT NULL,
  `id_proceso` int(11) NOT NULL,
  `estado_gestion` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gestion`
--

INSERT INTO `gestion` (`id_gestion`, `nombre_gestion`, `id_proceso`, `estado_gestion`) VALUES
(1, 'GESTION ADMINISTRATIVA', 2, 0),
(2, 'GESTION DE CALIDAD', 3, 0),
(3, 'ALOJAMINETO', 2, 0),
(4, 'A&Bh', 1, 0),
(5, 'OPERACIÓN TURISTICA', 1, 0),
(6, 'TRANSPORTE TURISTICOdwaaaaaaaaaaaaaaaaaaaaaaaaa', 4, 1),
(7, 'TALENTO HUMANO', 3, 1),
(8, 'ECONOMATO', 3, 1),
(9, 'SEGURIDA Y SALUD OCUPACIONAL', 3, 1),
(10, 'MANTENIMINETOs', 4, 1),
(11, 'fd', 4, 1),
(12, 'gggggggggggggg', 3, 1),
(13, 'uytt', 3, 0),
(26, 'jh', 1, 1),
(27, 'jh', 1, 1),
(28, 'klfdjkfgkj', 1, 1),
(29, 'oooooo', 1, 1),
(30, 'jjjjjjjjjjjjjjjjjjjjjj', 1, 1),
(31, 'nada ', 1, 1),
(32, 'heeeyy', 1, 1),
(33, 'heeeyy', 1, 1),
(34, 'heeeyy', 1, 1),
(35, 'ds', 1, 1),
(36, 'sa', 1, 1),
(37, 'sasd', 1, 1),
(38, 'yt', 2, 1),
(39, 'yt', 2, 1),
(40, 'lkmerf', 1, 1),
(41, 'adios', 1, 1),
(42, 'jjjjjjjjj', 2, 1),
(43, 'noooooooo', 3, 1),
(44, 'h', 1, 1),
(45, 'dfd', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `nombre`, `tipo`) VALUES
(1, 'Categoria', 1),
(2, 'Procesos', 2),
(3, 'Formulario', 3),
(4, 'Usuarios', 4),
(5, 'Configuracion', 5),
(6, 'Libros', 6),
(7, 'Materias', 7),
(8, 'Reportes', 8),
(9, 'Prestamos', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id_pregunta` int(11) NOT NULL,
  `nombre_pregunta` varchar(100) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_gestion` int(11) NOT NULL,
  `id_formulario` int(11) NOT NULL,
  `estado_pregunta` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id_pregunta`, `nombre_pregunta`, `id_categoria`, `id_gestion`, `id_formulario`, `estado_pregunta`) VALUES
(1, 'Se determinan las cuestiones externas e internas que son pertinentes para el propósito y dirección', 4, 1, 1, 1),
(3, 'Se determinan las cuestiones externas e internas que son pertinentes para el propósito y dirección', 3, 3, 1, 1),
(4, 'Se demuestra responsabilidad por parte de la alta dirección para la eficacia del SGC.', 4, 4, 1, 1),
(5, 'La gerencia garantiza que los requisitos de los clientes de determinan y se cumplen.', 1, 5, 1, 1),
(6, 'La política de calidad con la que cuenta actualmente la organización está acorde con los propósitos', 1, 3, 1, 1),
(7, 'Se han establecido los riesgos y oportunidades que deben ser abordados para asegurar que el SGC logr', 3, 1, 1, 1),
(8, 'La organización ha determinado y proporcionado los recursos necesarios para el establecimiento, impl', 1, 2, 1, 1),
(9, 'Se planifican, implementan y controlan los procesos necesarios para cumplir los requisitos para la p', 1, 2, 1, 1),
(10, 'La organización determina que necesita seguimiento y medición.', 1, 1, 1, 0),
(11, 'Determina los métodos de seguimiento, medición, análisis y evaluación para asegurar resultados valid', 7, 1, 1, 1),
(13, 'Se han establecido los riesgos y oportunidades que deben ser abordados para asegurar que el SGC logr', 7, 1, 1, 1),
(119, 'no', 2, 2, 2, 1),
(120, 'ssss', 5, 3, 2, 1),
(121, 'nods', 7, 5, 2, 1),
(122, 'nnnnnnnnnnnnnnnnnnnnnn', 4, 6, 2, 1),
(123, 'x', 6, 6, 2, 1),
(124, 'ootra vez que raro', 6, 4, 2, 1),
(125, 'dsd', 7, 5, 2, 1),
(126, 'otra', 4, 4, 2, 1),
(127, 'lkbjh', 1, 1, 2, 1),
(128, 'j', 3, 3, 2, 1),
(129, 'ya', 1, 1, 2, 1),
(130, 'pregunta 1', 2, 2, 333, 1),
(131, 'pregunta 222222', 3, 4, 333, 1),
(132, 'pregun3', 2, 5, 333, 1),
(133, 'nueva preguntaa', 1, 1, 333, 1),
(134, 'otra pregunta', 1, 1, 333, 1),
(135, 'dd', 1, 1, 333, 1),
(136, 'dd', 1, 1, 333, 1),
(137, 'siiiiiiiiiiiiii', 1, 1, 333, 1),
(138, 'siiiiiiiiiiiii', 1, 1, 333, 1),
(139, 'saaaaaaaa', 1, 1, 333, 1),
(140, 'otra vez', 1, 1, 333, 1),
(154, 'chevere', 1, 1, 334, 1),
(155, 'wwww', 1, 1, 334, 1),
(156, 'pregunta1', 1, 3, 335, 1),
(157, 'pregunta 2', 19, 1, 335, 1),
(158, 'pregunta 33', 3, 4, 335, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso`
--

CREATE TABLE `proceso` (
  `id_proceso` int(11) NOT NULL,
  `nombre_proceso` varchar(100) NOT NULL,
  `estado_proceso` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proceso`
--

INSERT INTO `proceso` (`id_proceso`, `nombre_proceso`, `estado_proceso`) VALUES
(1, 'PROCESO DE DIRECCIÓNes', 1),
(2, 'PROCESOS OPERATIVOS', 1),
(3, 'PROCESO DE APOYO', 1),
(4, 'hhjjjjjjh', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(200) NOT NULL,
  `apellido_usuario` varchar(200) DEFAULT NULL,
  `cedula_usuario` varchar(200) NOT NULL,
  `telefono_usuario` varchar(200) NOT NULL,
  `correo_usuario` varchar(200) NOT NULL,
  `rol_usuario` varchar(200) NOT NULL,
  `usuario_usuario` varchar(200) NOT NULL,
  `clave_usuario` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `apellido_usuario`, `cedula_usuario`, `telefono_usuario`, `correo_usuario`, `rol_usuario`, `usuario_usuario`, `clave_usuario`) VALUES
(1, 'Julio', 'Taday', '0604459497', '0985077788', 'ljdelgado.fis@unach.edu.ec', 'administrador', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `rol` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `nombre`, `clave`, `estado`, `rol`) VALUES
(1, 'admin', 'Luis', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 1, 'admin'),
(2, 'evaluador', 'Luis Delgado', '519ba91a5a5b4afb9dc66f8805ce8c442b6576316c19c6896af2fa9bda6aff71', 1, 'Evaluador'),
(3, 'user', 'user', 'fe675fe7aaee830b6fed09b64e034f84dcbdaeb429d9cccd4ebb90e15af8dd71', 1, 'Centro Turistico'),
(4, 'centro', 'Turistico', '1001', 1, 'Centro Turistico'),
(5, 'hola', 'hola', 'fe675fe7aaee830b6fed09b64e034f84dcbdaeb429d9cccd4ebb90e15af8dd71', 1, 'Evaluador'),
(6, 'yo', 'yo', 'e9058ab198f6908f702111b0c0fb5b36f99d00554521886c40e2891b349dc7a1', 1, '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `criterio`
--
ALTER TABLE `criterio`
  ADD PRIMARY KEY (`id_criterio`);

--
-- Indices de la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD PRIMARY KEY (`id_detalle`) USING BTREE,
  ADD KEY `FK_detalle_evaluacion` (`id_evaluacion`),
  ADD KEY `FK_detalle_pregunta` (`id_pregunta`),
  ADD KEY `FK_detalle_criterio` (`id_criterio`);

--
-- Indices de la tabla `detalle_permisos`
--
ALTER TABLE `detalle_permisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_permiso` (`id_permiso`);

--
-- Indices de la tabla `establecimiento`
--
ALTER TABLE `establecimiento`
  ADD PRIMARY KEY (`id_establecimiento`);

--
-- Indices de la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD PRIMARY KEY (`id_evaluacion`),
  ADD KEY `FK_evaluacion_formulario` (`id_formulario`),
  ADD KEY `FK_evaluacion_usuario` (`id_usuario`),
  ADD KEY `FK_evaluacion_establecimiento` (`id_establecimiento`);

--
-- Indices de la tabla `formulario`
--
ALTER TABLE `formulario`
  ADD PRIMARY KEY (`id_formulario`);

--
-- Indices de la tabla `gestion`
--
ALTER TABLE `gestion`
  ADD PRIMARY KEY (`id_gestion`),
  ADD KEY `FK_gestion_proceso` (`id_proceso`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id_pregunta`),
  ADD KEY `FK_pregunta_categoria` (`id_categoria`),
  ADD KEY `FK_pregunta_gestion` (`id_gestion`),
  ADD KEY `FK_pregunta_formulario` (`id_formulario`);

--
-- Indices de la tabla `proceso`
--
ALTER TABLE `proceso`
  ADD PRIMARY KEY (`id_proceso`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `criterio`
--
ALTER TABLE `criterio`
  MODIFY `id_criterio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `detalle`
--
ALTER TABLE `detalle`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `detalle_permisos`
--
ALTER TABLE `detalle_permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `establecimiento`
--
ALTER TABLE `establecimiento`
  MODIFY `id_establecimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  MODIFY `id_evaluacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `formulario`
--
ALTER TABLE `formulario`
  MODIFY `id_formulario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=336;

--
-- AUTO_INCREMENT de la tabla `gestion`
--
ALTER TABLE `gestion`
  MODIFY `id_gestion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT de la tabla `proceso`
--
ALTER TABLE `proceso`
  MODIFY `id_proceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD CONSTRAINT `FK_detalle_criterio` FOREIGN KEY (`id_criterio`) REFERENCES `criterio` (`id_criterio`),
  ADD CONSTRAINT `FK_detalle_evaluacion` FOREIGN KEY (`id_evaluacion`) REFERENCES `evaluacion` (`id_evaluacion`),
  ADD CONSTRAINT `FK_detalle_pregunta` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`id_pregunta`);

--
-- Filtros para la tabla `detalle_permisos`
--
ALTER TABLE `detalle_permisos`
  ADD CONSTRAINT `detalle_permisos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `detalle_permisos_ibfk_2` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id`);

--
-- Filtros para la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD CONSTRAINT `FK_evaluacion_criterio` FOREIGN KEY (`id_criterio`) REFERENCES `criterio` (`id_criterio`),
  ADD CONSTRAINT `FK_evaluacion_establecimiento` FOREIGN KEY (`id_establecimiento`) REFERENCES `establecimiento` (`id_establecimiento`),
  ADD CONSTRAINT `FK_evaluacion_formulario` FOREIGN KEY (`id_formulario`) REFERENCES `formulario` (`id_formulario`),
  ADD CONSTRAINT `FK_evaluacion_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `gestion`
--
ALTER TABLE `gestion`
  ADD CONSTRAINT `FK_gestion_proceso` FOREIGN KEY (`id_proceso`) REFERENCES `proceso` (`id_proceso`);

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `FK_pregunta_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`),
  ADD CONSTRAINT `FK_pregunta_formulario` FOREIGN KEY (`id_formulario`) REFERENCES `formulario` (`id_formulario`),
  ADD CONSTRAINT `FK_pregunta_gestion` FOREIGN KEY (`id_gestion`) REFERENCES `gestion` (`id_gestion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
