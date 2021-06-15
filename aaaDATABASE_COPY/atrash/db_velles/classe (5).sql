-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-05-2021 a las 21:46:22
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
(5, 'Asix', 1),
(6, 'Artistic', 0),
(7, 'Idiomes', 0),
(8, 'Angles', 7),
(9, 'Castella', 7),
(10, 'Gramatica Anglesa', 8),
(11, 'Redaccions Angleses', 8);

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
(2, 'members', 'General User'),
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
  `grup_acces` int(11) NOT NULL DEFAULT 0,
  `perfil_acces` int(11) NOT NULL DEFAULT 0,
  `privadesa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `recursos`
--

INSERT INTO `recursos` (`id`, `titol`, `descripcio`, `autor`, `categoria`, `tipus_recurs`, `grup_acces`, `perfil_acces`, `privadesa`) VALUES
(25, 'titol recurs 1', '<p>erwgfergerg<strong>erg</strong>erg</p><p>er<a href=\"ererg.erg\">gerg</a>erg</p><p>erge<i>rgergergerg</i></p>', 2, 1, 'infografia', 0, 0, 'infografia'),
(26, 'titol recurs 2', '<p>re<strong>ergergrgeerg r</strong>g erg erg erg</p>', 2, 2, 'infografia', 0, 0, 'infografia'),
(27, 'Recurs numero 1 video', '<h2>rtg<i><strong>rtg rtg rt rtg&nbsp;</strong></i></h2>', 2, 1, 'video_arxiu', 0, 0, 'infografia'),
(30, 'erf', '<p>erf</p>', 2, 1, 'infografia', 0, 0, 'infografia'),
(31, 'erf', '<p>erf</p>', 2, 1, 'infografia', 0, 0, 'infografia'),
(50, 'wefwefwef', '<p>wefwef</p>', 2, 1, 'infografia', 0, 0, 'infografia'),
(51, 'wefwefwef', '<p>wefwef</p>', 2, 1, 'infografia', 0, 0, 'infografia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recurs_video_youtube`
--

CREATE TABLE `recurs_video_youtube` (
  `id` int(11) NOT NULL,
  `recurs_id` int(11) NOT NULL,
  `id_video_youtube` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(8, 'new tag prova 6'),
(9, 'new tag prova 7');

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
(1, 26, 2),
(2, 50, 1),
(3, 50, 2),
(4, 50, 3),
(5, 51, 1),
(6, 51, 2),
(7, 51, 3);

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
(1, '127.0.0.1', 'administrator', '$2y$10$wSzGTByP7bCsq1Mu3fcXl.HnhlAR32KnIm/RaSPsB0lX9ym7655Pa', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1620300814, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, '::1', 'artur', '$2y$10$nYnPCIFIXdDa4hWP2xJWqe8FnjwbfyWGzOIXnCzH8z0s0UPvhMbm2', 'artur@test.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1620240787, 1620928663, 1, NULL, NULL, NULL, NULL),
(3, '::1', 'artur2', '$2y$10$FtMJsjs05AU8vr0U03K1RORuQQQgeO1L2RJq1MbRgIuOR8Zd8qCiy', 'artur@test2.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1620240949, NULL, 1, NULL, NULL, NULL, NULL),
(4, '::1', 'test2', '$2y$10$IzExj71/AaDhSHsKfYnl8uLwdgRZoN6rzaCR1wO.p3ejp1EQAfuzu', 'erg@erg.erg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1620241053, 1620241053, 1, NULL, NULL, NULL, NULL),
(5, '::1', 'ergerg', '$2y$10$4WcBJ9AxHW6usvLtQbfgUuXE9ZxDfkY43yt22xUjjuWFyut2.OFmq', 'ergerg#@erg.erg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1620251033, 1620251033, 1, NULL, NULL, NULL, NULL),
(6, '::1', 'arbofa', '$2y$10$GiEntHBkMDSws7EXFRlnaeG2V8UFa7OchL7Sl3GFd6wSURw9uK47q', 'a@test.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1620411204, 1620411204, 1, 'Artur', 'Boladeres Fabregat', NULL, '644208509');

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
(2, 1, 2),
(3, 2, 2),
(4, 3, 2),
(5, 4, 2),
(6, 5, 2),
(7, 6, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
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
-- Indices de la tabla `recurs_video_youtube`
--
ALTER TABLE `recurs_video_youtube`
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
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `recursos`
--
ALTER TABLE `recursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `recurs_video_youtube`
--
ALTER TABLE `recurs_video_youtube`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tags_recursos`
--
ALTER TABLE `tags_recursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
