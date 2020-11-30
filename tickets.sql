-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-11-2020 a las 23:28:05
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ticketly`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compañia`
--

CREATE TABLE `compañia` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `nit` int(11) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compañia`
--

INSERT INTO `compañia` (`id`, `nombre`, `nit`, `telefono`, `direccion`, `email`) VALUES
(1, 'Fusepong', 123456789, '19278035', '', 'Cra 45 A #127-76'),
(2, 'Policia Nacional', 1234578, '3215847', 'Cra 1 A bis #36d 41 sur', 'policia@gmail.com'),
(3, 'Servimos LTDA', 898743221, '3148579665', 'Cra 87 #65-24', 'servimosltda@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia_usuario`
--

CREATE TABLE `historia_usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `prioridad` varchar(10) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `id_proyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `historia_usuario`
--

INSERT INTO `historia_usuario` (`id`, `nombre`, `prioridad`, `id_usuario`, `descripcion`, `id_proyecto`) VALUES
(5, 'Validar formulario PQRS', 'media', 2, 'Validar que el formulario se envié con la información completa', 6),
(6, 'Validar formulario PQRS', 'Alta', 2, 'Validar que el formulario se envié con la información completa', 4),
(7, 'prueba', 'media', 1, 'pruebaaaaa', 4),
(8, 'dasasdasd', 'media', 2, 'asddsaadsasd', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kind`
--

CREATE TABLE `kind` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `kind`
--

INSERT INTO `kind` (`id`, `name`) VALUES
(1, 'Ticket'),
(2, 'Bug'),
(3, 'Sugerencia'),
(4, 'Caracteristica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `priority`
--

CREATE TABLE `priority` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `priority`
--

INSERT INTO `priority` (`id`, `name`) VALUES
(1, 'Alta'),
(2, 'Media'),
(3, 'Baja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `id_compañia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id`, `nombre`, `descripcion`, `id_compañia`) VALUES
(4, 'pruebaa', 'esto es una prueba', 3),
(5, 'Pagina web', 'Crear una pagina webb', 1),
(6, 'Desarrollo CMR', 'crear un Cmr', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Pendiente'),
(2, 'En Desarrollo'),
(3, 'Terminado'),
(4, 'Cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `kind_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `asigned_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `priority_id` int(11) NOT NULL DEFAULT 1,
  `status_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`id`, `title`, `description`, `updated_at`, `created_at`, `kind_id`, `user_id`, `asigned_id`, `project_id`, `category_id`, `priority_id`, `status_id`) VALUES
(3, 'Error al enviar mensaje', 'Se están presentando errores en el envio de PQRS', NULL, '2020-11-30 17:06:57', 1, 1, NULL, 5, 5, 1, 1),
(4, 'Error al iniciar sesión', 'No se esta realizando la validación en el login ', NULL, '2020-11-30 17:08:10', 1, 1, NULL, 6, 7, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `profile_pic` varchar(250) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `kind` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `name`, `email`, `password`, `profile_pic`, `is_active`, `kind`, `created_at`) VALUES
(1, 'admin', 'Daniel Esteban Martinez', 'eragonicm@gmail.com', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', 'IMG_8920.jpg', 1, 1, '2017-07-15 12:05:45'),
(2, NULL, 'Juan Carlos Garzon Niño', 'carlos@gmail.com', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', 'default.png', 1, 1, '2020-11-30 03:58:07');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compañia`
--
ALTER TABLE `compañia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unico_nit` (`nit`);

--
-- Indices de la tabla `historia_usuario`
--
ALTER TABLE `historia_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Historia_usuario` (`id_usuario`),
  ADD KEY `fk_id_proyecto` (`id_proyecto`);

--
-- Indices de la tabla `kind`
--
ALTER TABLE `kind`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `priority`
--
ALTER TABLE `priority`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Compania_proyecto` (`id_compañia`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `priority_id` (`priority_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `kind_id` (`kind_id`),
  ADD KEY `fk_proyecto` (`project_id`),
  ADD KEY `fk_historia` (`category_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compañia`
--
ALTER TABLE `compañia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `historia_usuario`
--
ALTER TABLE `historia_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `kind`
--
ALTER TABLE `kind`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `priority`
--
ALTER TABLE `priority`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historia_usuario`
--
ALTER TABLE `historia_usuario`
  ADD CONSTRAINT `FK_Historia_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_id_proyecto` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`);

--
-- Filtros para la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD CONSTRAINT `fk_Compania_proyecto` FOREIGN KEY (`id_compañia`) REFERENCES `compañia` (`id`);

--
-- Filtros para la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `fk_historia` FOREIGN KEY (`category_id`) REFERENCES `historia_usuario` (`id`),
  ADD CONSTRAINT `fk_proyecto` FOREIGN KEY (`project_id`) REFERENCES `proyecto` (`id`),
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`priority_id`) REFERENCES `priority` (`id`),
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `ticket_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `ticket_ibfk_4` FOREIGN KEY (`kind_id`) REFERENCES `kind` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
