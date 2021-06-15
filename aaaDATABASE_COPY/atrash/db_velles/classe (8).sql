-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2021 a las 01:34:59
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `classe`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnes_classes`
--

CREATE TABLE `alumnes_classes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `classe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnes_classes`
--

INSERT INTO `alumnes_classes` (`id`, `user_id`, `classe_id`) VALUES
(28, 10, 3),
(29, 10, 4),
(38, 7, 3),
(39, 7, 4),
(40, 7, 1),
(41, 7, 7),
(42, 13, 2),
(43, 2, 1),
(47, 2, 2),
(48, 2, 3),
(49, 13, 4),
(50, 8, 1),
(51, 8, 3),
(52, 8, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `categoria_pare` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `nom`, `categoria_pare`) VALUES
(1, 'Informatica', 0),
(2, 'Programacio', 1),
(3, 'DAW', 2),
(4, 'DAM', 2),
(6, 'Artistic', 0),
(7, 'Idiomes', 0),
(8, 'Angles', 7),
(9, 'Castella', 7),
(10, 'Gramatica Anglesa', 8),
(11, 'Redaccions Angleses', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `classes`
--

INSERT INTO `classes` (`id`, `nom`) VALUES
(1, 'Alumnes de DAM'),
(2, 'Alumnes de DAW'),
(3, 'Alumnes de Anglès'),
(4, 'Alumnes de Música');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'alumne', 'Alumne'),
(3, 'professor', 'Professor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(34, '127.0.0.1', 'art1', 1621443676),
(35, '::1', 'adminstrator', 1621463585);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE `recursos` (
  `id` int(11) NOT NULL,
  `titol` varchar(200) NOT NULL,
  `descripcio` text NOT NULL,
  `autor` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `tipus_recurs` varchar(20) NOT NULL,
  `arxiu_name` varchar(100) DEFAULT NULL,
  `video_youtube` varchar(100) DEFAULT NULL,
  `grup_acces` int(11) NOT NULL DEFAULT 0,
  `perfil_acces` int(11) NOT NULL DEFAULT 0,
  `privadesa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `recursos`
--

INSERT INTO `recursos` (`id`, `titol`, `descripcio`, `autor`, `categoria`, `tipus_recurs`, `arxiu_name`, `video_youtube`, `grup_acces`, `perfil_acces`, `privadesa`) VALUES
(57, 'recurs numero 1 infografia', '&lt;p&gt;recurs numero 1 infografia&lt;/p&gt;', 13, 1, 'infografia', 'infografia.jpg', NULL, 0, 0, 'privat'),
(58, 'recurs numero 2 video', '&lt;p&gt;recurs numero 2 video&lt;/p&gt;', 13, 1, 'video_arxiu', 'video_arxiu.mp4', NULL, 0, 0, '2'),
(59, 'recurs numero 3 youtube', '&lt;p&gt;recurs numero 3 youtube&lt;/p&gt;', 13, 1, 'video_youtube', NULL, 'LXb3EKWsInQ', 0, 0, 'public'),
(62, 'Hola', '<p>Tinc son&nbsp;</p>', 14, 2, 'pissarra', 'pissarra.png', NULL, 0, 0, 'public');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `tag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tags`
--

INSERT INTO `tags` (`id`, `tag`) VALUES
(1, 'tag de prova'),
(2, 'tag de prova 2'),
(3, 'new tag prova 1'),
(4, 'new tag prova 2'),
(5, 'new tag prova 3'),
(6, 'new tag prova 4'),
(7, 'new tag prova 5'),
(8, 'new tag prova 6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags_recursos`
--

CREATE TABLE `tags_recursos` (
  `id` int(11) NOT NULL,
  `id_recurs` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tags_recursos`
--

INSERT INTO `tags_recursos` (`id`, `id_recurs`, `id_tag`) VALUES
(22, 57, 1),
(23, 58, 1),
(24, 59, 5),
(25, 59, 6),
(27, 57, 4),
(28, 57, 7),
(31, 62, 1),
(32, 62, 2),
(33, 62, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tokens`
--

CREATE TABLE `tokens` (
  `tokenid` varchar(36) NOT NULL,
  `subject` varchar(36) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tokens`
--

INSERT INTO `tokens` (`tokenid`, `subject`, `expiration`) VALUES
('4f62c98a-271b-5a31-8780-92549fdf90d7', 'secure.jwt.daw.local', 1620139952),
('e62e5443-c3a3-5e5c-84f8-c286a89f7399', 'secure.jwt.daw.local', 1620139925);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$10$wSzGTByP7bCsq1Mu3fcXl.HnhlAR32KnIm/RaSPsB0lX9ym7655Pa', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1621467172, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, '::1', 'artur', '$2y$10$11YC6yUJ9.AVFGWFX41CKOc11PfxRac9fS/bfm5qmSBUYzb2CQouC', 'artur@test.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1620240787, 1621465021, 1, 'Artur', 'Boladeres', NULL, '644208509'),
(8, '127.0.0.1', 'artur2', '$2y$10$jZR9r13XAVe5gYaPlDkSfOsIxzPbHwcAKaNiYCRnSLADVdgPrmBk2', 'at@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1621386755, NULL, 1, 'Artur4', 'wef', NULL, '644208509'),
(13, '127.0.0.1', 'alumne', '$2y$10$S7xotTJCS1nWUPZylCI5z.D9s3MUMIhw2hqK1rRglLkytJvkG.raO', 'alumne@a.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1621442858, 1621449496, 1, 'Artur', 'Boladeres Fabregat', NULL, '644208509'),
(14, '2.154.230.249', 'littlcarla', '$2y$10$8jrKXb16GLAjnhZWIt.mnuW2tMrIsBwhuQQWhCoB/di6ZRBYeuZIK', 'carlamunso@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1621466182, 1621466242, 1, 'Carla', 'Munsó', NULL, '629251950');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(3, 2, 2),
(9, 8, 2),
(13, 13, 2),
(14, 14, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnes_classes`
--
ALTER TABLE `alumnes_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tags_recursos`
--
ALTER TABLE `tags_recursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`tokenid`,`subject`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indices de la tabla `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnes_classes`
--
ALTER TABLE `alumnes_classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `recursos`
--
ALTER TABLE `recursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tags_recursos`
--
ALTER TABLE `tags_recursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
