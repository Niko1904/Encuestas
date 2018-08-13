-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-07-2018 a las 05:01:33
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `poll`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$4a6ufTY590Wc5zU35OT3suYNrVF04AFeXwJLyOi0c.rrHLPjBkKTy', '1', NULL, '2018-07-04 06:23:19', NULL),
(2, 'Rodolfo', 'halconrod@gmail.com', '$2y$10$Z/yFpNtRF5Krr6/u1FtNOeoS.v0zDewfSluRbGW3tftmqrsAHqH9q', '1', NULL, '2018-07-04 06:23:19', NULL),
(3, 'Moises', 'moycs777@gmail.com', '$2y$10$Hy549n3Wy1giJM/LgiEj7O1uONiTYjN2UYwMovHfu4m98aswA1Mn6', '1', NULL, '2018-07-04 06:23:19', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `answers`
--

CREATE TABLE `answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `group_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `answers`
--

INSERT INTO `answers` (`id`, `name`, `value`, `question_id`, `poll_id`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'mas', 1, 1, 3, 'a', NULL, NULL),
(2, 'menos', 0, 1, 3, 'a', NULL, NULL),
(3, 'mas', 1, 2, 3, 'b', NULL, NULL),
(4, 'menos', 0, 2, 3, 'b', NULL, NULL),
(5, 'mas', 1, 3, 3, 'c', NULL, NULL),
(6, 'menos', 0, 3, 3, 'c', NULL, NULL),
(7, 'mas', 1, 4, 3, 'd', NULL, NULL),
(8, 'menos', 0, 4, 3, 'd', NULL, NULL),
(9, 'mas', 1, 5, 3, 'a', NULL, NULL),
(10, 'menos', 0, 5, 3, 'a', NULL, NULL),
(11, 'mas', 1, 6, 3, 'b', NULL, NULL),
(12, 'menos', 0, 6, 3, 'b', NULL, NULL),
(13, 'mas', 1, 7, 3, 'c', NULL, NULL),
(14, 'menos', 0, 7, 3, 'c', NULL, NULL),
(15, 'mas', 1, 8, 3, 'd', NULL, NULL),
(16, 'menos', 0, 8, 3, 'd', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aplication_polls`
--

CREATE TABLE `aplication_polls` (
  `id` int(10) UNSIGNED NOT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `value` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timer_type` int(11) DEFAULT NULL,
  `hour` int(11) DEFAULT NULL,
  `minutes` int(11) DEFAULT NULL,
  `seconds` int(11) DEFAULT NULL,
  `pausable` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `answer_required` tinyint(1) NOT NULL,
  `show_all_questions` tinyint(1) NOT NULL DEFAULT '1',
  `percentage_values` int(11) DEFAULT NULL,
  `answers_yes_or_not` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `timer_type`, `hour`, `minutes`, `seconds`, `pausable`, `status`, `answer_required`, `show_all_questions`, `percentage_values`, `answers_yes_or_not`, `created_at`, `updated_at`) VALUES
(1, 'Con tiempo general', 3, 0, 1, 0, 0, 0, 1, 1, NULL, NULL, '2018-07-04 06:23:20', NULL),
(2, 'Con tiempo por pregunta', 2, 0, 0, 30, 0, 0, 1, 1, NULL, NULL, '2018-07-04 06:23:20', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detail_aplications`
--

CREATE TABLE `detail_aplications` (
  `id` int(10) UNSIGNED NOT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `value` int(11) NOT NULL DEFAULT '0',
  `answer_id` int(11) NOT NULL,
  `master_aplication_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `general_definitions`
--

CREATE TABLE `general_definitions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_max_reanudacion` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `general_definitions`
--

INSERT INTO `general_definitions` (`id`, `name`, `description`, `fecha_max_reanudacion`, `created_at`, `updated_at`) VALUES
(1, 'mucha suerte al responder', 'esperamos tenags suerte en esta encuesta', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `master_aplications`
--

CREATE TABLE `master_aplications` (
  `id` int(10) UNSIGNED NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `master_aplications`
--

INSERT INTO `master_aplications` (`id`, `start_date`, `status`, `user_id`, `poll_id`, `created_at`, `updated_at`) VALUES
(1, '2017-11-17 06:23:19', 0, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(43, '2014_10_12_000000_create_users_table', 1),
(44, '2014_10_12_100000_create_password_resets_table', 1),
(45, '2017_09_22_152916_admins', 1),
(46, '2017_10_01_021337_create_categories_table', 1),
(47, '2017_10_01_021904_create_polls_table', 1),
(48, '2017_10_01_022159_create_questions_table', 1),
(49, '2017_10_01_023301_create_answers_table', 1),
(50, '2017_10_01_023522_create_ranges_table', 1),
(51, '2017_10_01_023803_create_aplication_polls_table', 1),
(52, '2017_11_13_011527_create_resumes_table', 1),
(53, '2017_11_18_233620_create_master_aplications_table', 1),
(54, '2017_11_18_233722_create_detail_aplications_table', 1),
(55, '2018_03_29_093556_create_poll__users_table', 1),
(56, '2018_03_30_152031_create_general_definitions_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `polls`
--

CREATE TABLE `polls` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `show_all_questions` tinyint(1) DEFAULT '1',
  `ready` tinyint(1) DEFAULT '0',
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `polls`
--

INSERT INTO `polls` (`id`, `name`, `status`, `show_all_questions`, `ready`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'preparando ajedres, con tiempo general', 1, 1, 0, 2, '2018-07-04 06:23:20', NULL),
(2, 'preparando personalida, con tiempo por pregunta', 1, 0, 0, 1, '2018-07-04 06:23:20', NULL),
(3, 'dominancia de caracter', 1, 1, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poll__users`
--

CREATE TABLE `poll__users` (
  `id` int(10) UNSIGNED NOT NULL,
  `poll_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `poll__users`
--

INSERT INTO `poll__users` (`id`, `poll_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 3, 2, '2018-07-04 06:38:08', '2018-07-04 06:38:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poll_id` int(11) NOT NULL,
  `multiple_answers` tinyint(1) NOT NULL,
  `group_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `questions`
--

INSERT INTO `questions` (`id`, `name`, `poll_id`, `multiple_answers`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'Las personas me respetan.', 3, 0, 'a', NULL, NULL),
(2, 'Tiendo a ser una persona amable.', 3, 0, 'b', NULL, NULL),
(3, 'Acepto a la vida como viene.', 3, 0, 'c', NULL, NULL),
(4, 'Las personas dicen que tengo una fuerte personalidad.', 3, 0, 'd', NULL, NULL),
(5, 'Encuentro difícil relajarme', 3, 0, 'a', NULL, NULL),
(6, 'Tengo un círculo muy amplio de amigos.', 3, 0, 'b', NULL, NULL),
(7, 'Siempre estoy listo para ayudar a otros', 3, 0, 'c', NULL, NULL),
(8, 'Me gusta comportarme correctamente.', 3, 0, 'd', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ranges`
--

CREATE TABLE `ranges` (
  `id` int(10) UNSIGNED NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `poll_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ranges`
--

INSERT INTO `ranges` (`id`, `from`, `to`, `text`, `poll_id`, `created_at`, `updated_at`) VALUES
(1, 0, 1000, 'prueba', 3, '2018-07-04 06:37:55', '2018-07-04 06:37:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resumes`
--

CREATE TABLE `resumes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `from` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codigo_confirmacion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci,
  `verificado` tinyint(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `password`, `gender`, `birth`, `provider`, `provider_id`, `codigo_confirmacion`, `avatar`, `verificado`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Rodolfo', NULL, 'halconrod@gmail.com', '$2y$10$kJInKeVNwxW0g2YXQSVikeLCFt/t5/3/.tB6zWU76eUjjLkcxO2WW', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2018-07-04 06:23:20', NULL),
(2, 'Moises', NULL, 'moycs777@gmail.com', '$2y$10$NI8pK3DdQQldf7k5FY3kCeQgt4aAYsBKCTbQvSf.QUfVvCmjf9FJS', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2018-07-04 06:23:20', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indices de la tabla `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `aplication_polls`
--
ALTER TABLE `aplication_polls`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detail_aplications`
--
ALTER TABLE `detail_aplications`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `general_definitions`
--
ALTER TABLE `general_definitions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `master_aplications`
--
ALTER TABLE `master_aplications`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `poll__users`
--
ALTER TABLE `poll__users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ranges`
--
ALTER TABLE `ranges`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `resumes`
--
ALTER TABLE `resumes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `aplication_polls`
--
ALTER TABLE `aplication_polls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detail_aplications`
--
ALTER TABLE `detail_aplications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `general_definitions`
--
ALTER TABLE `general_definitions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `master_aplications`
--
ALTER TABLE `master_aplications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `poll__users`
--
ALTER TABLE `poll__users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `ranges`
--
ALTER TABLE `ranges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `resumes`
--
ALTER TABLE `resumes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
