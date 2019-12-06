-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 13 nov. 2019 à 13:20
-- Version du serveur :  10.1.35-MariaDB
-- Version de PHP :  7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bd_stock`
--

-- --------------------------------------------------------

--
-- Structure de la table `liste_etat_groupe`
--

CREATE TABLE `liste_etat_groupe` (
  `id` int(11) NOT NULL,
  `etat` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `couleur` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `couleur_css` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `liste_etat_groupe`
--

INSERT INTO `liste_etat_groupe` (`id`, `etat`, `couleur`, `couleur_css`) VALUES
(1, 'En attente', 'warning', NULL),
(2, 'Disponible', 'success', NULL),
(3, 'Indisponible', 'danger', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `liste_etat_groupe`
--
ALTER TABLE `liste_etat_groupe`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `liste_etat_groupe`
--
ALTER TABLE `liste_etat_groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
