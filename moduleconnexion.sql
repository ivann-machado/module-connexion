-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 06 août 2025 à 13:16
-- Version du serveur : 8.4.3
-- Version de PHP : 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `moduleconnexion`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id_utilisateur` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id_utilisateur`) VALUES
(11);

-- --------------------------------------------------------

--
-- Structure de la table `date_inscription`
--

CREATE TABLE `date_inscription` (
  `id` int NOT NULL,
  `date` timestamp NOT NULL,
  `id_utilisateur` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `date_inscription`
--

INSERT INTO `date_inscription` (`id`, `date`, `id_utilisateur`) VALUES
(5, '2025-08-05 13:44:26', 10),
(6, '2025-08-05 14:08:11', 11),
(7, '2025-08-06 10:49:02', 12);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`, `prenom`, `nom`) VALUES
(10, 'testuser', '$2y$10$9EkwXE.PZYte0YdSVxH1a.OIwYc0hlbVpbqWQq4EyGSoy/eG5.k1u', 'Johny', 'Doeyy'),
(11, 'admin', '$2y$10$4eLXSVj7mquoCOc37he50eM3a31KCUY8jHkINxyZM6GNxHys5vMrW', 'admin', 'admin'),
(12, 'salt', '$2y$10$7XPW8EFIe/qaxYRWCXynPecq2vCt3IH/dlSKaIBd9yM9TV13fW2Eq', 'Salty', 'Smoker');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `date_inscription`
--
ALTER TABLE `date_inscription`
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `date_inscription`
--
ALTER TABLE `date_inscription`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
