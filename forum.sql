-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Sam 03 Février 2018 à 13:30
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `forum`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `cat_description` varchar(255) CHARACTER SET utf8 NOT NULL,
  `cat_writer` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`, `cat_description`, `cat_writer`) VALUES
(1, 'DEVELOPPEMENT WEB', 'Toutes les questions que se posent les developpeurs ...', '4'),
(2, 'FORMATION', 'Quel organisme pour quelle formation ?', '4'),
(3, 'HARDWARE', 'Monter son PC soit même.', '4');

-- --------------------------------------------------------

--
-- Structure de la table `grants`
--

CREATE TABLE `grants` (
  `grant_id` int(11) NOT NULL,
  `grant_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `grants`
--

INSERT INTO `grants` (`grant_id`, `grant_name`) VALUES
(1, 'CAN_CREATE_TOPIC'),
(2, 'CAN_DELETE_TOPIC'),
(3, 'CAN_CREATE_POST'),
(4, 'CAN_EDIT_OWN_POST'),
(5, 'CAN_DELETE_OWN_POSTS'),
(6, 'CAN_DELETE_ALL_POSTS');

-- --------------------------------------------------------

--
-- Structure de la table `link_role_grant`
--

CREATE TABLE `link_role_grant` (
  `id_role` int(11) NOT NULL,
  `id_grant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `link_role_grant`
--

INSERT INTO `link_role_grant` (`id_role`, `id_grant`) VALUES
(1, 1),
(2, 1),
(3, 1),
(1, 2),
(1, 3),
(2, 3),
(3, 3),
(1, 4),
(2, 4),
(3, 4),
(3, 5),
(1, 6),
(2, 6);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_topic` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_writer` varchar(255) NOT NULL,
  `post_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `posts`
--

INSERT INTO `posts` (`post_id`, `post_topic`, `post_title`, `post_date`, `post_writer`, `post_text`) VALUES
(65, 81, 'sujet 1 cat 3', '2018-01-30 15:03:51', 'David', 'sujet 1 cat 3 post 1'),
(66, 81, 'sujet 1 cat 3', '2018-01-30 15:04:00', 'David', 'sujet 1 cat 3 post 2'),
(67, 81, 'sujet 1 cat 3', '2018-01-30 15:04:09', 'David', 'sujet 1 cat 3 post 3'),
(70, 78, 'sujet 1 cat 1', '2018-01-30 15:05:03', 'tata', 'sujet 1 cat 1 post 5'),
(72, 82, 'sujet 1 cat 2', '2018-01-30 15:05:48', 'tata', 'sujet 1 cat 2 post 2'),
(73, 83, 'sujet 2 cat 3', '2018-01-31 08:18:14', 'David', 'sujet 2 cat 3 post 1'),
(74, 82, 'sujet 1 cat 2', '2018-01-31 13:56:36', 'David', 'sujet 1 cat 2 post 3sujet 1 cat 2 post 3'),
(78, 85, 'Sujet 2 cat 2', '2018-01-31 20:00:45', 'David', 'Sujet 2 cat 2 post 1'),
(79, 86, 'Sujet 3 cat 3', '2018-01-31 20:04:08', 'David', 'Sujet 3 cat 3 post 1'),
(80, 93, 'Sujet 4 cat 3', '2018-01-31 20:36:52', 'David', 'Sujet 4 cat 3 post 1'),
(81, 94, 'Sujet 3 cat 2', '2018-01-31 20:40:58', 'David', 'Sujet 3 cat 2 post1'),
(82, 95, 'Sujet 5 cat 1', '2018-01-31 20:45:51', 'David', 'Sujet 5 cat 1 post 1'),
(84, 96, 'Sujet 4 cat 2', '2018-01-31 20:51:32', 'David', 'Sujet 4 cat 2 post 1'),
(85, 78, 'sujet 1 cat 1', '2018-01-31 20:55:36', 'David', 'sujet 1 cat 1 post1'),
(86, 78, 'sujet 1 cat 1', '2018-01-31 22:20:14', 'David', 'sujet 1 cat 1 post 6'),
(87, 94, 'Sujet 3 cat 2', '2018-01-31 22:21:47', 'David', 'Sujet 3 cat 2 post 2'),
(88, 97, 'Sujet 6 cat 1', '2018-01-31 22:27:53', 'David', 'Sujet 6 cat 1 post 1'),
(90, 98, 'Sujet 7 cat 1', '2018-02-03 09:32:49', 'David', 'Sujet 7 cat 1 post 1'),
(91, 98, 'Sujet 7 cat 1', '2018-02-03 09:33:43', 'David', 'Sujet 7 cat 1 post 2'),
(92, 85, 'Sujet 2 cat 2', '2018-02-03 13:06:21', 'David', 'Sujet 2 cat 2 post 2'),
(93, 99, 'Sujet 4 cat 2', '2018-02-03 13:07:05', 'David', 'Sujet 4 cat 2 post 1');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'ADMIN'),
(2, 'MODERATOR'),
(3, 'USER');

-- --------------------------------------------------------

--
-- Structure de la table `topics`
--

CREATE TABLE `topics` (
  `topic_id` int(11) NOT NULL,
  `topic_label` varchar(255) CHARACTER SET utf8 NOT NULL,
  `topic_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `topic_cat` varchar(11) CHARACTER SET utf8 NOT NULL,
  `topic_writer` varchar(255) CHARACTER SET utf8 NOT NULL,
  `topic_closed` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_label`, `topic_date`, `topic_cat`, `topic_writer`, `topic_closed`) VALUES
(78, 'sujet 1 cat 1', '2018-01-30 15:02:31', '1', '4', 1),
(81, 'sujet 1 cat 3', '2018-01-30 15:03:42', '3', '4', 0),
(82, 'sujet 1 cat 2', '2018-01-30 15:05:28', '2', '14', 0),
(83, 'sujet 2 cat 3', '2018-01-31 08:18:05', '3', '4', 0),
(85, 'Sujet 2 cat 2', '2018-01-31 20:00:36', '2', '4', 1),
(86, 'Sujet 3 cat 3', '2018-01-31 20:03:41', '3', '4', 0),
(87, 'Sujet 3 cat 2', '2018-01-31 20:15:24', '2', '4', 0),
(88, 'Sujet 3 cat 2', '2018-01-31 20:19:10', '2', '4', 0),
(89, 'Sujet 3 cat 2', '2018-01-31 20:23:07', '2', '4', 0),
(90, 'Sujet 3 cat 2', '2018-01-31 20:24:28', '2', '4', 0),
(91, 'Sujet 3 cat 2', '2018-01-31 20:26:19', '2', '4', 0),
(92, 'Sujet 3 cat 2', '2018-01-31 20:33:33', '2', '4', 0),
(93, 'Sujet 4 cat 3', '2018-01-31 20:36:44', '3', '4', 0),
(94, 'Sujet 3 cat 2', '2018-01-31 20:40:50', '2', '4', 0),
(95, 'Sujet 5 cat 1', '2018-01-31 20:45:41', '1', '4', 0),
(96, 'Sujet 4 cat 2', '2018-01-31 20:51:25', '2', '4', 1),
(97, 'Sujet 6 cat 1', '2018-01-31 22:27:45', '1', '4', 0),
(98, 'Sujet 7 cat 1', '2018-02-03 09:32:38', '1', '4', 0),
(99, 'Sujet 4 cat 2', '2018-02-03 13:06:55', '2', '4', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_role` int(11) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `id_role`) VALUES
(1, 'Pierre', 'e4953807b90944c5eb46ddcf68470b3ee7e76502', 2),
(2, 'Paul', 'd7c42d00268ebbcec2226ab0d8a8b42c13b68af9', 2),
(3, 'bernard', '9e577e9ed4ab589f80cc2f0e692d673b1ebfb188', 3),
(4, 'David', 'd7cfa0f646fa6c540376cbe3fcd6ecbeb60da0e0', 1),
(14, 'tata', '3f0169bd2cc248adc4dc941acfe84df34b622dfa', 3),
(15, 'moderator', '5bfe9ef14dfe1e35f67d49687ca755a4133a8bfa', 2),
(17, 'toto', 'aa65ddb5757722d8037f4964017395b16b603e25', 3),
(18, 'titi', '3dd563d9361456974c039778de9706fdc4958ea5', 3),
(19, 'Magali', '0f88083875b63f2c39d71a2f9e75f716676748bb', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Index pour la table `grants`
--
ALTER TABLE `grants`
  ADD PRIMARY KEY (`grant_id`);

--
-- Index pour la table `link_role_grant`
--
ALTER TABLE `link_role_grant`
  ADD PRIMARY KEY (`id_role`,`id_grant`),
  ADD KEY `id_grant` (`id_grant`),
  ADD KEY `id_role_2` (`id_role`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `post_writer` (`post_writer`),
  ADD KEY `post_topic` (`post_topic`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Index pour la table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `topic_writer` (`topic_writer`),
  ADD KEY `topic_cat` (`topic_cat`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `grants`
--
ALTER TABLE `grants`
  MODIFY `grant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `link_role_grant`
--
ALTER TABLE `link_role_grant`
  ADD CONSTRAINT `link_role_grant_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`role_id`),
  ADD CONSTRAINT `link_role_grant_ibfk_2` FOREIGN KEY (`id_grant`) REFERENCES `grants` (`grant_id`);

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_topic`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`role_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
