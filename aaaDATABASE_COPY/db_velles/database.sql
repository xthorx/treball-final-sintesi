-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2021 a las 14:37:58
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
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `classe_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alumnes_classes`
--

INSERT INTO `alumnes_classes` (`id`, `user_id`, `classe_id`) VALUES
(17, 15, 4),
(18, 15, 5),
(19, 16, 4),
(20, 16, 5),
(21, 16, 6),
(22, 16, 7);

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
  `id` mediumint(8) UNSIGNED NOT NULL,
  `nom` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `classes`
--

INSERT INTO `classes` (`id`, `nom`) VALUES
(4, 'Alumnes de Música'),
(5, 'Alumnes de DAW'),
(6, 'Alumnes de DAM'),
(7, 'Alumnes de Anglès');

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
(37, '2.154.234.148', 'administrator', 1621512760),
(40, '127.0.0.1', 'artur', 1621593002);

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
  `visites_img` int(11) NOT NULL DEFAULT 0,
  `privadesa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `recursos`
--

INSERT INTO `recursos` (`id`, `titol`, `descripcio`, `autor`, `categoria`, `tipus_recurs`, `arxiu_name`, `video_youtube`, `grup_acces`, `perfil_acces`, `visites_img`, `privadesa`) VALUES
(66, 'Recurs de prova infografia', '&lt;p&gt;Recurs de prova &lt;strong&gt;infografia&lt;/strong&gt;:&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Llista de prova&lt;/li&gt;&lt;li&gt;Llista de prova&lt;/li&gt;&lt;li&gt;Llista de prova&lt;/li&gt;&lt;li&gt;Llista de prova&lt;/li&gt;&lt;/ul&gt;&lt;blockquote&gt;&lt;p&gt;Hola això és un text de prova.&lt;/p&gt;&lt;/blockquote&gt;', 1, 1, 'infografia', 'infografia.jpg', NULL, 0, 0, 57, 'public'),
(67, 'Recurs de prova video', '&lt;p&gt;Recurs de prova &lt;strong&gt;infografia&lt;/strong&gt;:&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Llista de prova&lt;/li&gt;&lt;li&gt;Llista de prova&lt;/li&gt;&lt;li&gt;Llista de prova&lt;/li&gt;&lt;li&gt;Llista de prova&lt;/li&gt;&lt;/ul&gt;&lt;blockquote&gt;&lt;p&gt;Hola això és un text de prova.&lt;/p&gt;&lt;/blockquote&gt;', 1, 1, 'video_arxiu', 'video_arxiu.mp4', NULL, 0, 0, 0, 'public'),
(69, 'Recurs de prova pissarra digital', '&lt;p&gt;Recurs de prova &lt;strong&gt;pissarra digital&lt;/strong&gt;:&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Llista de prova&lt;/li&gt;&lt;li&gt;Llista de prova&lt;/li&gt;&lt;li&gt;Llista de prova&lt;/li&gt;&lt;li&gt;Llista de prova&lt;/li&gt;&lt;/ul&gt;&lt;blockquote&gt;&lt;p&gt;Hola això és un text de prova.&lt;/p&gt;&lt;/blockquote&gt;', 1, 1, 'pissarra', 'pissarra.png', NULL, 0, 0, 7, 'public'),
(70, 'Recurs de prova YouTube', '&lt;p&gt;Recurs de prova &lt;strong&gt;youtube&lt;/strong&gt;:&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Llista de prova&lt;/li&gt;&lt;li&gt;Llista de prova&lt;/li&gt;&lt;li&gt;Llista de prova&lt;/li&gt;&lt;li&gt;Llista de prova&lt;/li&gt;&lt;/ul&gt;&lt;blockquote&gt;&lt;p&gt;Hola això és un text de prova.&lt;/p&gt;&lt;/blockquote&gt;', 1, 1, 'video_youtube', NULL, 'LXb3EKWsInQ', 0, 0, 0, 'public');

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
(11, 'Programació'),
(12, 'Informàtica'),
(13, 'Art i disseny'),
(14, 'Dibuix'),
(15, 'YouTube'),
(16, 'Fotografia');

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
(48, 66, 11),
(49, 66, 12),
(50, 66, 16),
(51, 67, 11),
(52, 67, 12),
(53, 69, 13),
(54, 69, 14),
(55, 70, 11),
(56, 70, 12),
(57, 70, 15);

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
(1, '127.0.0.1', 'admin', '$2y$10$LdZ3SD3B75yvdkiEBwiiu..peAsQ2JmAOg5CrGP8irJT78sSnFaAy', 'admin@test.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1621598334, 1, 'Admin', 'Administrator', 'ADMIN', '666444555'),
(15, '2.154.234.148', 'profe', '$2y$10$9y/awInD/dYApArLLpI6VurDiwmPX3X8ucySaxEx.0Ykz/Xtk3vVS', 'profe@test.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1621468247, 1621597968, 1, 'Profe', 'Professor', NULL, '666555444'),
(16, '2.154.234.148', 'alum', '$2y$10$SufmKDal8bqVKTeqNpMSSO7J0tliAG.aO//tROXE/uEDc/B0cdKs6', 'alum@test.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1621468296, 1621598120, 1, 'Alum', 'Alumne', NULL, '666444555');

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
(15, 15, 3),
(16, 16, 2);

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `classes`
--
ALTER TABLE `classes`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `recursos`
--
ALTER TABLE `recursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tags_recursos`
--
ALTER TABLE `tags_recursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
