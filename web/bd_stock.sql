-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 22 nov. 2019 à 13:32
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
-- Structure de la table `alternateur`
--

CREATE TABLE `alternateur` (
  `id` int(11) NOT NULL,
  `marque` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modele` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numeroSerie` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `annee` double NOT NULL,
  `puissance` double NOT NULL,
  `dateDebutService` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `alternateur`
--

INSERT INTO `alternateur` (`id`, `marque`, `modele`, `numeroSerie`, `annee`, `puissance`, `dateDebutService`) VALUES
(1, '-', '-', '-', 0, 0, NULL),
(2, '-', '-', '-', 0, 0, NULL),
(3, '-', '-', '-', 0, 0, NULL),
(4, '-', '-', '-', 0, 0, NULL),
(5, '-', '-', '-', 0, 0, NULL),
(6, '-', '-', '-', 0, 0, NULL),
(7, '-', '-', '-', 0, 0, NULL),
(8, '-', '-', '-', 0, 0, NULL),
(9, '-', '-', '-', 0, 0, NULL),
(10, '-', '-', '-', 0, 0, NULL),
(11, '-', '-', '-', 0, 0, NULL),
(12, '-', '-', '-', 0, 0, NULL),
(13, '-', '-', '-', 0, 0, NULL),
(14, '-', '-', '-', 0, 0, NULL),
(15, '-', '-', '-', 0, 0, NULL),
(16, '-', '-', '-', 0, 0, NULL),
(17, '-', '-', '-', 0, 0, NULL),
(18, '-', '-', '-', 0, 0, NULL),
(19, '-', '-', '-', 0, 0, NULL),
(20, '-', '-', '-', 0, 0, NULL),
(21, '-', '-', '-', 0, 0, NULL),
(22, '-', '-', '-', 0, 0, NULL),
(23, '-', '-', '-', 0, 0, NULL),
(24, '-', '-', '-', 0, 0, NULL),
(25, '-', '-', '-', 0, 0, NULL),
(26, '-', '-', '-', 0, 0, NULL),
(27, '-', '-', '-', 0, 0, NULL),
(28, '-', '-', '-', 0, 0, NULL),
(29, '-', '-', '-', 0, 0, NULL),
(30, '-', '-', '-', 0, 0, NULL),
(31, '-', '-', '-', 0, 0, NULL),
(32, '-', '-', '-', 0, 0, NULL),
(33, '-', '-', '-', 0, 0, NULL),
(34, '-', '-', '-', 0, 0, NULL),
(35, '-', '-', '-', 0, 0, NULL),
(36, '-', '-', '-', 0, 0, NULL),
(37, '-', '-', '-', 0, 0, NULL),
(38, '-', '-', '-', 0, 0, NULL),
(39, '-', '-', '-', 0, 0, NULL),
(40, '-', '-', '-', 0, 0, NULL),
(41, '-', '-', '-', 0, 0, NULL),
(42, '-', '-', '-', 0, 0, NULL),
(43, '-', '-', '-', 0, 0, NULL),
(44, '-', '-', '-', 0, 0, NULL),
(45, '-', '-', '-', 0, 0, NULL),
(46, '-', '-', '-', 0, 0, NULL),
(47, '-', '-', '-', 0, 0, NULL),
(48, '-', '-', '-', 0, 0, NULL),
(49, '-', '-', '-', 0, 0, NULL),
(50, '-', '-', '-', 0, 0, NULL),
(51, '-', '-', '-', 0, 0, NULL),
(52, '-', '-', '-', 0, 0, NULL),
(53, '-', '-', '-', 0, 0, NULL),
(54, '-', '-', '-', 0, 0, NULL),
(55, '-', '-', '-', 0, 0, NULL),
(56, '-', '-', '-', 0, 0, NULL),
(57, '-', '-', '-', 0, 0, NULL),
(58, '-', '-', '-', 0, 0, NULL),
(59, '-', '-', '-', 0, 0, NULL),
(60, '-', '-', '-', 0, 0, NULL),
(61, '-', '-', '-', 0, 0, NULL),
(62, '-', '-', '-', 0, 0, NULL),
(63, '-', '-', '-', 0, 0, NULL),
(64, '-', '-', '-', 0, 0, NULL),
(65, '-', '-', '-', 0, 0, NULL),
(66, '-', '-', '-', 0, 0, NULL),
(67, '-', '-', '-', 0, 0, NULL),
(68, '-', '-', '-', 0, 0, NULL),
(69, '-', '-', '-', 0, 0, NULL),
(70, '-', '-', '-', 0, 0, NULL),
(71, '-', '-', '-', 0, 0, NULL),
(72, '-', '-', '-', 0, 0, NULL),
(73, '-', '-', '-', 0, 0, NULL),
(74, '-', '-', '-', 0, 0, NULL),
(75, '-', '-', '-', 0, 0, NULL),
(76, '-', '-', '-', 0, 0, NULL),
(77, '-', '-', '-', 0, 0, NULL),
(78, '-', '-', '-', 0, 0, NULL),
(79, '-', '-', '-', 0, 0, NULL),
(80, '-', '-', '-', 0, 0, NULL),
(81, '-', '-', '-', 0, 0, NULL),
(82, '-', '-', '-', 0, 0, NULL),
(83, '-', '-', '-', 0, 0, NULL),
(84, '-', '-', '-', 0, 0, NULL),
(85, '-', '-', '-', 0, 0, NULL),
(86, '-', '-', '-', 0, 0, NULL),
(87, '-', '-', '-', 0, 0, NULL),
(88, '-', '-', '-', 0, 0, NULL),
(89, '-', '-', '-', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `catalogue`
--

CREATE TABLE `catalogue` (
  `id` int(11) NOT NULL,
  `titre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `text` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `depense`
--

CREATE TABLE `depense` (
  `id` int(11) NOT NULL,
  `groupe_id` int(11) NOT NULL,
  `probleme_id` int(11) NOT NULL,
  `idDepense` int(11) NOT NULL,
  `montant` double NOT NULL,
  `lien` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numero` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `depense`
--

INSERT INTO `depense` (`id`, `groupe_id`, `probleme_id`, `idDepense`, `montant`, `lien`, `numero`) VALUES
(1, 3, 1, 912, 2000, 'http://127.0.0.1/FATEMI/web/demande/912', 'N° G-1041/19');

-- --------------------------------------------------------

--
-- Structure de la table `deplacement`
--

CREATE TABLE `deplacement` (
  `id` int(11) NOT NULL,
  `user_creer_id` int(11) NOT NULL,
  `sourcedepot_id` int(11) NOT NULL,
  `destinationdepot_id` int(11) NOT NULL,
  `user_refuser_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `numero` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `etat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modifiable` tinyint(1) NOT NULL,
  `motif` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `texte` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `deplacement_groupe`
--

CREATE TABLE `deplacement_groupe` (
  `id` int(11) NOT NULL,
  `site_depart_id` int(11) NOT NULL,
  `site_destination_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `deplacement_user`
--

CREATE TABLE `deplacement_user` (
  `deplacement_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `depot`
--

CREATE TABLE `depot` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `abrv` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `etat` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `depot`
--

INSERT INTO `depot` (`id`, `nom`, `abrv`, `etat`) VALUES
(1, 'Anosizato', 'ANO', 1),
(2, 'Ankaraobato', 'ANK', 1);

-- --------------------------------------------------------

--
-- Structure de la table `doc`
--

CREATE TABLE `doc` (
  `id` int(11) NOT NULL,
  `num` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lien` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `employe_mission`
--

CREATE TABLE `employe_mission` (
  `id` int(11) NOT NULL,
  `mission_id` int(11) NOT NULL,
  `id_employe` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `poste` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lien` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `entre`
--

CREATE TABLE `entre` (
  `id` int(11) NOT NULL,
  `user_creer_id` int(11) NOT NULL,
  `depot_id` int(11) NOT NULL,
  `fournisseur_id` int(11) DEFAULT NULL,
  `user_refuser_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `numero` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `etat` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `modifiable` tinyint(1) NOT NULL,
  `motif` longtext COLLATE utf8_unicode_ci,
  `texte` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `entre`
--

INSERT INTO `entre` (`id`, `user_creer_id`, `depot_id`, `fournisseur_id`, `user_refuser_id`, `date`, `numero`, `etat`, `modifiable`, `motif`, `texte`) VALUES
(1, 3, 1, 1, NULL, '2019-10-29 09:47:16', 'ENT-001/2019', 'Demande confirmée', 0, 'MISE A JOUR DE STOCK INTERNE - ce 29-10-2019', NULL),
(2, 3, 1, 2, NULL, '2019-10-29 10:23:45', 'ENT-002/2019', 'Demande confirmée', 0, 'MISE A JOUR STOCK au 29-10-2019', NULL),
(3, 3, 1, 1, NULL, '2019-10-28 10:59:33', 'ENT-003/2019', 'Demande confirmée', 0, 'BL-212/19 suivant BC-LP-011/19', NULL),
(4, 3, 1, 1, NULL, '2019-10-29 11:15:07', 'ENT-004/2019', 'Demande confirmée', 0, 'MISE A JOUR STOCK au 29-10-2019', NULL),
(5, 3, 1, NULL, NULL, '2019-11-09 15:42:21', 'ENT-005/2019', 'Demande confirmée', 0, 'Venant d\'Ankaraobatoce 09/11/2019', NULL),
(6, 3, 1, NULL, NULL, '2019-11-09 15:42:59', 'ENT-006/2019', 'Demande confirmée', 0, 'Venant d\'Ankaraobato', NULL),
(7, 3, 1, NULL, NULL, '2019-11-11 15:57:38', 'ENT-007/2019', 'Demande confirmée', 0, 'MISE A JOUR STOCK AU 11/11/2019', NULL),
(8, 3, 1, NULL, NULL, '2019-11-11 16:04:09', 'ENT-008/2019', 'Demande confirmée', 0, 'MISE A JOUR STOCK AU 11/11/2019', NULL),
(9, 3, 1, NULL, NULL, '2019-11-11 16:05:41', 'ENT-009/2019', 'Demande confirmée', 0, 'MISE A JOUR STOCK AU 11/11/2019', NULL),
(10, 3, 1, NULL, NULL, '2019-11-11 16:07:26', 'ENT-010/2019', 'Demande confirmée', 0, 'Mise a jour stock au 11/11/2019', NULL),
(11, 3, 1, NULL, NULL, '2019-11-11 16:08:12', 'ENT-011/2019', 'Demande confirmée', 0, 'Mise a jour stock au 11/11/2019', NULL),
(12, 3, 1, NULL, NULL, '2019-11-11 16:25:48', 'ENT-012/2019', 'Demande confirmée', 0, 'Mise a jour stock au 11/11/2019', NULL),
(13, 3, 1, NULL, NULL, '2019-11-11 16:29:26', 'ENT-013/2019', 'Demande confirmée', 0, 'Mise a jour stock au 11/11/2019', NULL),
(14, 3, 1, NULL, NULL, '2019-11-11 16:30:33', 'ENT-014/2019', 'Demande confirmée', 0, 'Mise a jour stock au 11/11/2019', NULL),
(15, 3, 1, NULL, NULL, '2019-11-11 16:37:18', 'ENT-015/2019', 'Demande confirmée', 0, 'mise a jour stock ce 11/11/2019', NULL),
(16, 3, 1, NULL, NULL, '2019-11-19 16:22:27', 'ENT-016/2019', 'En attente de confirmation', 0, 'MISE A JOUR STOCK AU 19-11-2019 ( deja en stock depuis son achat mais aujourd\'hui j\'ai pu compter un par un les baguettes', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `entre_user`
--

CREATE TABLE `entre_user` (
  `entre_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `entre_user`
--

INSERT INTO `entre_user` (`entre_id`, `user_id`) VALUES
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2);

-- --------------------------------------------------------

--
-- Structure de la table `famille_client`
--

CREATE TABLE `famille_client` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `champ1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `champ2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `famille_produit`
--

CREATE TABLE `famille_produit` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tva` double NOT NULL,
  `champ1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `champ2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nif` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `nom`, `adresse`, `nif`, `stat`, `contact`) VALUES
(1, 'Tranombarotra FATEMI', '6 rue Karijà Tsaralalana', '5000 3479 67', '46 101 11 1974 0 00098', '+261340740652'),
(2, 'ID MOTORS', 'LOT 01 A AMBOHIBAO TANA 105', '400 17 360 60', '46 101 11 2014 010 744', '020 22 583 73'),
(3, 'SODIREX', 'ZONE ZITAL ROUTE DES HYDROCARBURES - ANKORONDRANO', '000 000 4109', '45 101 11 1990 000 109', '020 22 274 29'),
(4, 'OCEANTRADE', 'ANDRAHARO TANA', '2000 004 050', '45 109 11 1984 0 10001', '+261 34 11 303 05'),
(5, 'MADAUTO', 'RUE DR RASETA ANDRAHARO', '100 001 0233', '45 101 11 1950 01 00 04', '020 23 254 54 - 020 23 226 83'),
(6, 'DISCODIN', 'ANDRAHARO TANA 101', '300 009 2522', '46 101 11 2005 00 0537', '020 23 356 36'),
(7, 'SANIFER', 'TANJOMBATO', '20 000 36 135', '46 900 11 1993 01 0053', '020 22 464 81 - 020 22 464 82'),
(8, 'DIESEL STAR', 'III V 105 TER DB ANOSIZATO EST', '300 03 800 60', '45 201 11 2011 00 0451', '+261 33 11 063 73 - +261 33 08 249 37'),
(9, 'BRICOFER', 'RUE LIEUTENANT CHANARON TOLIARA', '300 15 124 65', '46 633 51 2014 0000 53', '+261 34 14 623 03'),
(10, 'BATPRO', 'BOULEVARD JENERALY RATSIMANDRAVA - TANA 101 - BP757', '20 000 127 12', '46 623 11 1962 100 002', '020 22 227 82'),
(11, 'RAPIDE SERVICE', 'ANKADIFOTSY BEFELATANANA - ANTANANARIVO', '64 102 11 2012 0 10789', '300 101 9064', '+261 32 11 456 22 - +261 32 11 456 23'),
(12, 'Quincaillerie MAHAFA-PO', 'LOT III U 134 B ANOSIZATO', '300 22 323 76', '46 101 11 2016 0 01725', '+261 34 05 230 62 - +261 34 02 230 70'),
(13, 'Société SAMBATEX SARL', 'BP 58 , SAMBAVA (208) MADAGASCAR', '4000 127 498', '51 367 72 1990 0000 46', '+261 20 88 920 16'),
(14, 'Société IBC SARL', 'Enceinte Record TV, Anosizato, - 101 Antananarivo - Madagascar )', '2000 33 007 00', '45 302 31 2019 0 00 213', '+261 34 02 279 23');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `etat_groupe_id` int(11) DEFAULT NULL,
  `catalogue_id` int(11) DEFAULT NULL,
  `numero` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `marque` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `heuretotale` double DEFAULT NULL,
  `puissanceConsommer` double DEFAULT NULL,
  `moteur_id` int(11) DEFAULT NULL,
  `alternateur_id` int(11) DEFAULT NULL,
  `modele` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero_serie` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `annee` double DEFAULT NULL,
  `puissance` double DEFAULT NULL,
  `date_debut_service` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id`, `site_id`, `etat_groupe_id`, `catalogue_id`, `numero`, `marque`, `url`, `heuretotale`, `puissanceConsommer`, `moteur_id`, `alternateur_id`, `modele`, `numero_serie`, `annee`, `puissance`, `date_debut_service`) VALUES
(1, 5, 4, NULL, 'AG001', 'AGO', NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL),
(2, 4, 2, NULL, 'AG003', 'AGO', NULL, NULL, NULL, 2, 2, NULL, NULL, NULL, NULL, NULL),
(3, 15, 3, NULL, 'AC001', 'KOMATSU', NULL, NULL, NULL, 3, 3, NULL, NULL, NULL, NULL, NULL),
(4, 11, 2, NULL, 'BD001', 'BAUDOIN', NULL, NULL, NULL, 4, 4, NULL, NULL, NULL, NULL, NULL),
(5, 7, 3, NULL, 'CU001', 'CUMMINS', NULL, NULL, NULL, 5, 5, NULL, NULL, NULL, NULL, NULL),
(6, 12, 3, NULL, 'CU002', 'CUMMINS', NULL, NULL, NULL, 6, 6, NULL, NULL, NULL, NULL, NULL),
(7, 21, 3, NULL, 'CU003', 'CUMMINS', NULL, NULL, NULL, 7, 7, NULL, NULL, NULL, NULL, NULL),
(8, 17, 3, NULL, 'CU004', 'CUMMINS', NULL, NULL, NULL, 8, 8, NULL, NULL, NULL, NULL, NULL),
(9, 15, 3, NULL, 'CU005', 'CUMMINS', NULL, NULL, NULL, 9, 9, NULL, NULL, NULL, NULL, NULL),
(10, 10, 2, NULL, 'CU007', 'CUMMINS', NULL, NULL, NULL, 10, 10, NULL, NULL, NULL, NULL, NULL),
(11, 4, 2, NULL, 'CU008', 'CUMMINS', NULL, NULL, NULL, 11, 11, NULL, NULL, NULL, NULL, NULL),
(12, 4, 2, NULL, 'CU009', 'CUMMINS', NULL, NULL, NULL, 12, 12, NULL, NULL, NULL, NULL, NULL),
(13, 4, 2, NULL, 'CU010', 'CUMMINS', NULL, NULL, NULL, 13, 13, NULL, NULL, NULL, NULL, NULL),
(14, 4, 2, NULL, 'CU011', 'CUMMINS', NULL, NULL, NULL, 14, 14, NULL, NULL, NULL, NULL, NULL),
(15, 5, 4, NULL, 'CU012', 'CUMMINS', NULL, NULL, NULL, 15, 15, NULL, NULL, NULL, NULL, NULL),
(16, 13, 5, NULL, 'PO001', 'POYAUD', NULL, NULL, NULL, 16, 16, NULL, NULL, NULL, NULL, NULL),
(17, 9, 3, NULL, 'PO002', 'POYAUD', NULL, NULL, NULL, 17, 17, NULL, NULL, NULL, NULL, NULL),
(18, 25, 5, NULL, 'PO005', 'POYAUD', NULL, NULL, NULL, 18, 18, NULL, NULL, NULL, NULL, NULL),
(19, 24, 5, NULL, 'PO006', 'POYAUD', NULL, NULL, NULL, 19, 19, NULL, NULL, NULL, NULL, NULL),
(20, 8, 2, NULL, 'PO007', 'POYAUD', NULL, NULL, NULL, 20, 20, NULL, NULL, NULL, NULL, NULL),
(21, 6, 2, NULL, 'PO008', 'POYAUD', NULL, NULL, NULL, 21, 21, NULL, NULL, NULL, NULL, NULL),
(22, 2, 1, NULL, 'PO009', 'POYAUD', NULL, NULL, NULL, 22, 22, NULL, NULL, NULL, NULL, NULL),
(23, 14, 1, NULL, 'PO010', 'POYAUD', NULL, NULL, NULL, 23, 23, NULL, NULL, NULL, NULL, NULL),
(24, 26, 3, NULL, 'PO011', 'POYAUD', NULL, NULL, NULL, 24, 24, NULL, NULL, NULL, NULL, NULL),
(25, 19, 3, NULL, 'PO012', 'POYAUD', NULL, NULL, NULL, 25, 25, NULL, NULL, NULL, NULL, NULL),
(26, 1, 2, NULL, 'PO013', 'POYAUD', NULL, NULL, NULL, 26, 26, NULL, NULL, NULL, NULL, NULL),
(28, 2, 2, NULL, 'PO014', 'POYAUD', NULL, NULL, NULL, 27, 27, NULL, NULL, NULL, NULL, NULL),
(29, 7, 3, NULL, 'PO015', 'POYAUD', NULL, NULL, NULL, 28, 28, NULL, NULL, NULL, NULL, NULL),
(30, 7, 3, NULL, 'MWM001', 'MWM', NULL, NULL, NULL, 29, 29, NULL, NULL, NULL, NULL, NULL),
(31, 21, 3, NULL, 'MWM002', 'MWM', NULL, NULL, NULL, 30, 30, NULL, NULL, NULL, NULL, NULL),
(32, 3, 2, NULL, 'PE001', 'PERKINS', NULL, NULL, NULL, 31, 31, NULL, NULL, NULL, NULL, NULL),
(33, 3, 2, NULL, 'PE002', 'PERKINS', NULL, NULL, NULL, 32, 32, NULL, NULL, NULL, NULL, NULL),
(34, 3, 2, NULL, 'PE003', 'PERKINS', NULL, NULL, NULL, 33, 33, NULL, NULL, NULL, NULL, NULL),
(35, 5, 2, NULL, 'PE004', 'PERKINS', NULL, NULL, NULL, 34, 34, NULL, NULL, NULL, NULL, NULL),
(36, 5, 2, NULL, 'PE005', 'PERKINS', NULL, NULL, NULL, 35, 35, NULL, NULL, NULL, NULL, NULL),
(37, 18, 5, NULL, 'VO001', 'VOLVO', NULL, NULL, NULL, 36, 36, NULL, NULL, NULL, NULL, NULL),
(38, 17, 5, NULL, 'VO002', 'VOLVO', NULL, NULL, NULL, 37, 37, NULL, NULL, NULL, NULL, NULL),
(39, 16, 2, NULL, 'VO004', 'VOLVO', NULL, NULL, NULL, 38, 38, NULL, NULL, NULL, NULL, NULL),
(40, 8, 2, NULL, 'VO005', 'VOLVO', NULL, NULL, NULL, 39, 39, NULL, NULL, NULL, NULL, NULL),
(41, 8, 2, NULL, 'VO007', 'VOLVO', NULL, NULL, NULL, 40, 40, NULL, NULL, NULL, NULL, NULL),
(42, 6, 2, NULL, 'VO008', 'VOLVO', NULL, NULL, NULL, 41, 41, NULL, NULL, NULL, NULL, NULL),
(43, 13, 4, NULL, 'VO009', 'VOLVO', NULL, NULL, NULL, 42, 42, NULL, NULL, NULL, NULL, NULL),
(44, 13, 4, NULL, 'IV001', 'IVECO', NULL, NULL, NULL, 43, 43, NULL, NULL, NULL, NULL, NULL),
(45, 26, 1, NULL, 'PE006', 'PERKINS', NULL, NULL, NULL, 44, 44, NULL, NULL, NULL, NULL, NULL),
(46, 26, 1, NULL, 'CAT001', 'CATERPILLAR', NULL, NULL, NULL, 45, 45, NULL, NULL, NULL, NULL, NULL),
(47, 26, 1, NULL, 'CAT002', 'CATERPILLAR', NULL, NULL, NULL, 46, 46, NULL, NULL, NULL, NULL, NULL),
(48, 26, 1, NULL, 'CAT003', 'CATERPILLAR', NULL, NULL, NULL, 47, 47, NULL, NULL, NULL, NULL, NULL),
(49, 26, 1, NULL, 'CAT004', 'CATERPILLAER', NULL, NULL, NULL, 48, 48, NULL, NULL, NULL, NULL, NULL),
(50, 26, 1, NULL, 'CAT005', 'CATERPILLAR', NULL, NULL, NULL, 49, 49, NULL, NULL, NULL, NULL, NULL),
(51, 26, 1, NULL, 'PO016', 'POYAUD', NULL, NULL, NULL, 50, 50, NULL, NULL, NULL, NULL, NULL),
(52, 26, 1, NULL, 'PO017', 'POYAUD', NULL, NULL, NULL, 51, 51, NULL, NULL, NULL, NULL, NULL),
(53, 26, 1, NULL, 'VO010', 'VOLVO', NULL, NULL, NULL, 52, 52, NULL, NULL, NULL, NULL, NULL),
(54, 26, 1, NULL, 'VO011', 'VOLVO', NULL, NULL, NULL, 53, 53, NULL, NULL, NULL, NULL, NULL),
(55, 26, 1, NULL, 'VO012', 'VOLVO', NULL, NULL, NULL, 54, 54, NULL, NULL, NULL, NULL, NULL),
(56, 26, 1, NULL, 'VO013', 'VOLVO', NULL, NULL, NULL, 55, 55, NULL, NULL, NULL, NULL, NULL),
(57, 26, 1, NULL, 'VO014', 'VOLVO', NULL, NULL, NULL, 56, 56, NULL, NULL, NULL, NULL, NULL),
(58, 26, 1, NULL, 'VO014', 'VOLVO', NULL, NULL, NULL, 57, 57, NULL, NULL, NULL, NULL, NULL),
(59, 26, 1, NULL, 'VO015', 'VOLVO', NULL, NULL, NULL, 58, 58, NULL, NULL, NULL, NULL, NULL),
(60, 26, 1, NULL, 'VO016', 'VOLVO', NULL, NULL, NULL, 59, 59, NULL, NULL, NULL, NULL, NULL),
(61, 3, 2, NULL, 'FT003', 'FIAT', NULL, NULL, NULL, 60, 60, NULL, NULL, NULL, NULL, NULL),
(62, 3, 2, NULL, 'VO006', 'VOLVO', NULL, NULL, NULL, 61, 61, NULL, NULL, NULL, NULL, NULL),
(63, 23, 3, NULL, 'DA001', 'DAF', NULL, NULL, NULL, 62, 62, NULL, NULL, NULL, NULL, NULL),
(64, 21, 1, NULL, 'FT001', 'FIAT', NULL, NULL, NULL, 63, 63, NULL, NULL, NULL, NULL, NULL),
(65, 23, 3, NULL, 'FT002', 'FIAT', NULL, NULL, NULL, 64, 64, NULL, NULL, NULL, NULL, NULL),
(66, 22, 3, NULL, 'RL001', 'Renault', NULL, NULL, NULL, 65, 65, NULL, NULL, NULL, NULL, NULL),
(67, 20, 3, NULL, 'DW001', 'DAEWOO', NULL, NULL, NULL, 66, 66, NULL, NULL, NULL, NULL, NULL),
(68, 26, 3, NULL, 'DZ001', 'DEUTZ', NULL, NULL, NULL, 67, 67, NULL, NULL, NULL, NULL, NULL),
(69, 26, 3, NULL, 'PO003', 'POYAUD', NULL, NULL, NULL, 68, 68, NULL, NULL, NULL, NULL, NULL),
(70, 26, 3, NULL, 'PO004', 'POYAUD', NULL, NULL, NULL, 69, 69, NULL, NULL, NULL, NULL, NULL),
(71, 26, 1, NULL, 'CU013', 'CUMMINS', NULL, NULL, NULL, 70, 70, NULL, NULL, NULL, NULL, NULL),
(72, 26, 1, NULL, 'CU014', 'CUMMINS', NULL, NULL, NULL, 71, 71, NULL, NULL, NULL, NULL, NULL),
(73, 26, 1, NULL, 'CU015', 'CUMMINS', NULL, NULL, NULL, 72, 72, NULL, NULL, NULL, NULL, NULL),
(74, 26, 1, NULL, 'CU016', 'CUMMINS', NULL, NULL, NULL, 73, 73, NULL, NULL, NULL, NULL, NULL),
(75, 26, 1, NULL, 'CU017', 'CUMMINS', NULL, NULL, NULL, 74, 74, NULL, NULL, NULL, NULL, NULL),
(76, 26, 1, NULL, 'CU018', 'CUMMINS', NULL, NULL, NULL, 75, 75, NULL, NULL, NULL, NULL, NULL),
(77, 26, 1, NULL, 'CU019', 'CUMMINS', NULL, NULL, NULL, 76, 76, NULL, NULL, NULL, NULL, NULL),
(78, 26, 1, NULL, 'CU020', 'CUMMINS', NULL, NULL, NULL, 77, 77, NULL, NULL, NULL, NULL, NULL),
(79, 27, 1, NULL, 'DE002', 'DETROIT', NULL, NULL, NULL, 78, 78, NULL, NULL, NULL, NULL, NULL),
(80, 26, 1, NULL, 'DE001', 'DETROIT', NULL, NULL, NULL, 79, 79, NULL, NULL, NULL, NULL, NULL),
(81, 26, 1, NULL, 'DE003', 'DETROIT', NULL, NULL, NULL, 80, 80, NULL, NULL, NULL, NULL, NULL),
(82, 26, 1, NULL, 'CU006', 'CUMMINS', NULL, NULL, NULL, 81, 81, NULL, NULL, NULL, NULL, NULL),
(83, 6, 3, NULL, 'JD001', 'JIN DONG', NULL, NULL, NULL, 82, 82, NULL, NULL, NULL, NULL, NULL),
(84, 26, 3, NULL, 'MT001', 'MTU001', NULL, NULL, NULL, 83, 83, NULL, NULL, NULL, NULL, NULL),
(85, 26, 3, NULL, 'MG001', 'MGO', NULL, NULL, NULL, 84, 84, NULL, NULL, NULL, NULL, NULL),
(86, 14, 3, NULL, 'DM001', 'DORMAN', NULL, NULL, NULL, 85, 85, NULL, NULL, NULL, NULL, NULL),
(87, 6, 1, NULL, 'DM002', 'DORMAN', NULL, NULL, NULL, 86, 86, NULL, NULL, NULL, NULL, NULL),
(88, 26, 3, NULL, 'VO003', 'VOLVO', NULL, NULL, NULL, 87, 87, NULL, NULL, NULL, NULL, NULL),
(89, 26, 3, NULL, 'AGO002', 'AGO', NULL, NULL, NULL, 88, 88, NULL, NULL, NULL, NULL, NULL),
(90, 21, 3, NULL, 'BL001', 'BERLIET', NULL, NULL, NULL, 89, 89, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `heure_marche`
--

CREATE TABLE `heure_marche` (
  `id` int(11) NOT NULL,
  `groupe_id` int(11) DEFAULT NULL,
  `datedebut` datetime NOT NULL,
  `datefin` datetime NOT NULL,
  `heure` double NOT NULL,
  `puissance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `historique_etat`
--

CREATE TABLE `historique_etat` (
  `id` int(11) NOT NULL,
  `groupe_id` int(11) NOT NULL,
  `probleme_arret_id` int(11) DEFAULT NULL,
  `probleme_demarrer_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `statut` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `detail` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `historique_groupe`
--

CREATE TABLE `historique_groupe` (
  `id` int(11) NOT NULL,
  `groupe_id` int(11) NOT NULL,
  `historique_etat_id` int(11) DEFAULT NULL,
  `suivi_piece_id` int(11) DEFAULT NULL,
  `deplacement_id` int(11) DEFAULT NULL,
  `vidange_id` int(11) DEFAULT NULL,
  `probleme_signale_id` int(11) DEFAULT NULL,
  `probleme_resolu_id` int(11) DEFAULT NULL,
  `heure_marche_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `historique_groupe`
--

INSERT INTO `historique_groupe` (`id`, `groupe_id`, `historique_etat_id`, `suivi_piece_id`, `deplacement_id`, `vidange_id`, `probleme_signale_id`, `probleme_resolu_id`, `heure_marche_id`, `date`) VALUES
(1, 3, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2019-11-21 15:23:46');

-- --------------------------------------------------------

--
-- Structure de la table `historique_produit`
--

CREATE TABLE `historique_produit` (
  `id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `entre_id` int(11) DEFAULT NULL,
  `sortie_id` int(11) DEFAULT NULL,
  `deplacement_id` int(11) DEFAULT NULL,
  `depot_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `type` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `quantite` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `historique_produit`
--

INSERT INTO `historique_produit` (`id`, `produit_id`, `entre_id`, `sortie_id`, `deplacement_id`, `depot_id`, `date`, `type`, `quantite`) VALUES
(1, 1, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 4),
(2, 2, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 30),
(3, 8, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 7),
(4, 9, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 2),
(5, 11, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 5),
(6, 12, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 17),
(7, 13, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 10),
(8, 14, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 2),
(9, 17, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 37),
(10, 18, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 16),
(11, 20, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 20),
(12, 21, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 12),
(13, 22, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 8),
(14, 23, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 1),
(15, 24, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 5),
(16, 27, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 2),
(17, 28, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 6),
(18, 30, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 46),
(19, 31, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 1),
(20, 32, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 5),
(21, 33, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 175),
(22, 34, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 8),
(23, 35, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 79),
(24, 36, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 12),
(25, 38, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 84),
(26, 39, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 42),
(27, 40, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 4),
(28, 41, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 12),
(29, 42, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 4),
(30, 43, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 4),
(31, 44, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 89),
(32, 45, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 2),
(33, 46, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 39),
(34, 47, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 38),
(35, 48, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 8),
(36, 49, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 26),
(37, 50, 1, NULL, NULL, 1, '2019-10-29 09:47:16', 'credit', 16),
(38, 25, 2, NULL, NULL, 1, '2019-10-29 10:23:45', 'credit', 6),
(39, 23, 3, NULL, NULL, 1, '2019-10-28 10:59:33', 'credit', 11),
(40, 26, 3, NULL, NULL, 1, '2019-10-28 10:59:33', 'credit', 54),
(41, 48, 3, NULL, NULL, 1, '2019-10-28 10:59:33', 'credit', 50),
(42, 51, 3, NULL, NULL, 1, '2019-10-28 10:59:33', 'credit', 4),
(43, 3, 3, NULL, NULL, 1, '2019-10-28 10:59:33', 'credit', 4),
(44, 74, 4, NULL, NULL, 1, '2019-10-29 11:15:07', 'credit', 10),
(45, 75, 4, NULL, NULL, 1, '2019-10-29 11:15:07', 'credit', 7),
(46, 66, 4, NULL, NULL, 1, '2019-10-29 11:15:07', 'credit', 20),
(47, 69, 4, NULL, NULL, 1, '2019-10-29 11:15:07', 'credit', 1),
(48, 70, 4, NULL, NULL, 1, '2019-10-29 11:15:07', 'credit', 1),
(49, 53, 4, NULL, NULL, 1, '2019-10-29 11:15:07', 'credit', 5),
(50, 54, 4, NULL, NULL, 1, '2019-10-29 11:15:07', 'credit', 4),
(51, 55, 4, NULL, NULL, 1, '2019-10-29 11:15:07', 'credit', 5),
(52, 56, 4, NULL, NULL, 1, '2019-10-29 11:15:07', 'credit', 5),
(53, 57, 4, NULL, NULL, 1, '2019-10-29 11:15:07', 'credit', 3),
(54, 60, 4, NULL, NULL, 1, '2019-10-29 11:15:07', 'credit', 2),
(55, 61, 4, NULL, NULL, 1, '2019-10-29 11:15:07', 'credit', 4),
(56, 62, 4, NULL, NULL, 1, '2019-10-29 11:15:07', 'credit', 8),
(57, 63, 4, NULL, NULL, 1, '2019-10-29 11:15:07', 'credit', 11),
(58, 68, 4, NULL, NULL, 1, '2019-10-29 11:15:07', 'credit', 3),
(59, 73, 4, NULL, NULL, 1, '2019-10-29 11:15:07', 'credit', 2),
(60, 72, 4, NULL, NULL, 1, '2019-10-29 11:15:07', 'credit', 2),
(61, 68, NULL, 1, NULL, 1, '2019-10-26 14:05:31', 'debit', 1),
(62, 60, NULL, 2, NULL, 1, '2019-10-31 09:00:19', 'debit', 1),
(63, 62, NULL, 2, NULL, 1, '2019-10-31 09:00:19', 'debit', 1),
(64, 44, NULL, 3, NULL, 1, '2019-10-31 09:05:00', 'debit', 2),
(65, 26, NULL, 3, NULL, 1, '2019-10-31 09:05:00', 'debit', 1),
(66, 17, NULL, 3, NULL, 1, '2019-10-31 09:05:00', 'debit', 1),
(67, 13, NULL, 3, NULL, 1, '2019-10-31 09:05:00', 'debit', 1),
(68, 44, NULL, 4, NULL, 1, '2019-10-31 09:17:16', 'debit', 2),
(69, 26, NULL, 4, NULL, 1, '2019-10-31 09:17:16', 'debit', 1),
(70, 17, NULL, 4, NULL, 1, '2019-10-31 09:17:16', 'debit', 1),
(71, 44, NULL, 5, NULL, 1, '2019-10-31 09:23:34', 'debit', 2),
(72, 26, NULL, 5, NULL, 1, '2019-10-31 09:23:34', 'debit', 1),
(73, 17, NULL, 5, NULL, 1, '2019-10-31 09:23:34', 'debit', 1),
(74, 44, NULL, 6, NULL, 1, '2019-10-31 09:34:48', 'debit', 2),
(75, 25, NULL, 6, NULL, 1, '2019-10-31 09:34:48', 'debit', 1),
(76, 44, NULL, 7, NULL, 1, '2019-10-31 09:39:00', 'debit', 2),
(77, 25, NULL, 7, NULL, 1, '2019-10-31 09:39:00', 'debit', 1),
(78, 44, NULL, 8, NULL, 1, '2019-10-31 09:43:49', 'debit', 1),
(79, 13, NULL, 8, NULL, 1, '2019-10-31 09:43:49', 'debit', 1),
(80, 26, NULL, 8, NULL, 1, '2019-10-31 09:43:49', 'debit', 1),
(81, 17, NULL, 8, NULL, 1, '2019-10-31 09:43:49', 'debit', 1),
(82, 34, NULL, 9, NULL, 1, '2019-10-31 09:50:19', 'debit', 1),
(83, 38, NULL, 9, NULL, 1, '2019-10-31 09:50:19', 'debit', 1),
(84, 18, NULL, 9, NULL, 1, '2019-10-31 09:50:19', 'debit', 1),
(85, 32, NULL, 10, NULL, 1, '2019-10-31 10:07:25', 'debit', 1),
(86, 23, NULL, 10, NULL, 1, '2019-10-31 10:07:25', 'debit', 1),
(87, 33, NULL, 11, NULL, 1, '2019-10-31 10:14:22', 'debit', 4),
(88, 35, NULL, 11, NULL, 1, '2019-10-31 10:14:22', 'debit', 2),
(89, 2, NULL, 11, NULL, 1, '2019-10-31 10:14:22', 'debit', 1),
(90, 48, NULL, 11, NULL, 1, '2019-10-31 10:14:22', 'debit', 1),
(91, 49, NULL, 11, NULL, 1, '2019-10-31 10:14:22', 'debit', 4),
(92, 47, NULL, 11, NULL, 1, '2019-10-31 10:14:22', 'debit', 2),
(93, 46, NULL, 12, NULL, 1, '2019-10-31 10:25:11', 'debit', 2),
(94, 12, NULL, 12, NULL, 1, '2019-10-31 10:25:11', 'debit', 2),
(95, 30, NULL, 12, NULL, 1, '2019-10-31 10:25:11', 'debit', 2),
(96, 48, NULL, 12, NULL, 1, '2019-10-31 10:25:11', 'debit', 1),
(97, 46, NULL, 13, NULL, 1, '2019-10-31 10:27:41', 'debit', 2),
(98, 12, NULL, 13, NULL, 1, '2019-10-31 10:27:41', 'debit', 2),
(99, 30, NULL, 13, NULL, 1, '2019-10-31 10:27:41', 'debit', 2),
(100, 48, NULL, 13, NULL, 1, '2019-10-31 10:27:41', 'debit', 1),
(101, 46, NULL, 14, NULL, 1, '2019-10-31 10:38:12', 'debit', 2),
(102, 12, NULL, 14, NULL, 1, '2019-10-31 10:38:12', 'debit', 2),
(103, 30, NULL, 14, NULL, 1, '2019-10-31 10:38:12', 'debit', 2),
(104, 48, NULL, 14, NULL, 1, '2019-10-31 10:38:12', 'debit', 1),
(105, 13, NULL, 15, NULL, 1, '2019-10-31 13:22:58', 'debit', 1),
(106, 3, NULL, 16, NULL, 1, '2019-10-31 13:24:50', 'debit', 4),
(107, 13, NULL, 17, NULL, 1, '2019-10-31 13:26:55', 'debit', 2),
(108, 13, NULL, 18, NULL, 1, '2019-10-31 13:29:55', 'debit', 2),
(109, 2, NULL, 20, NULL, 1, '2019-10-31 16:51:59', 'debit', 1),
(110, 60, NULL, 21, NULL, 1, '2019-10-31 15:36:47', 'debit', 1),
(111, 62, NULL, 21, NULL, 1, '2019-10-31 15:36:47', 'debit', 1),
(112, 68, NULL, 22, NULL, 1, '2019-11-08 15:38:56', 'debit', 2),
(113, 62, NULL, 22, NULL, 1, '2019-11-08 15:38:56', 'debit', 1),
(114, 54, NULL, 22, NULL, 1, '2019-11-08 15:38:56', 'debit', 1),
(115, 62, NULL, 23, NULL, 1, '2019-11-09 15:41:21', 'debit', 1),
(116, 62, 5, NULL, NULL, 1, '2019-11-09 15:42:21', 'credit', 5),
(117, 76, 6, NULL, NULL, 1, '2019-11-09 15:42:59', 'credit', 1),
(118, 77, 7, NULL, NULL, 1, '2019-11-11 15:57:38', 'credit', 9),
(119, 78, 8, NULL, NULL, 1, '2019-11-11 16:04:09', 'credit', 18),
(120, 79, 9, NULL, NULL, 1, '2019-11-11 16:05:41', 'credit', 1),
(121, 80, 11, NULL, NULL, 1, '2019-11-11 16:08:12', 'credit', 7),
(122, 81, 12, NULL, NULL, 1, '2019-11-11 16:25:48', 'credit', 1),
(123, 82, 12, NULL, NULL, 1, '2019-11-11 16:25:48', 'credit', 1),
(124, 85, 13, NULL, NULL, 1, '2019-11-11 16:29:26', 'credit', 1),
(125, 86, 14, NULL, NULL, 1, '2019-11-11 16:30:33', 'credit', 2),
(126, 87, 14, NULL, NULL, 1, '2019-11-11 16:30:33', 'credit', 1),
(127, 88, 14, NULL, NULL, 1, '2019-11-11 16:30:33', 'credit', 4),
(128, 89, 14, NULL, NULL, 1, '2019-11-11 16:30:33', 'credit', 4),
(129, 90, 14, NULL, NULL, 1, '2019-11-11 16:30:33', 'credit', 1),
(130, 91, 14, NULL, NULL, 1, '2019-11-11 16:30:33', 'credit', 1),
(131, 92, 15, NULL, NULL, 1, '2019-11-11 16:37:18', 'credit', 7),
(132, 62, NULL, 24, NULL, 1, '2019-10-10 08:33:21', 'debit', 2),
(133, 18, NULL, 25, NULL, 1, '2019-11-12 14:30:32', 'debit', 1);

-- --------------------------------------------------------

--
-- Structure de la table `ligne_deplacement`
--

CREATE TABLE `ligne_deplacement` (
  `id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `deplacement_id` int(11) NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ligne_entre`
--

CREATE TABLE `ligne_entre` (
  `id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `entre_id` int(11) NOT NULL,
  `quantite` double NOT NULL,
  `designation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prixAchat` double DEFAULT NULL,
  `utilite` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `ligne_entre`
--

INSERT INTO `ligne_entre` (`id`, `produit_id`, `entre_id`, `quantite`, `designation`, `prixAchat`, `utilite`) VALUES
(1, 1, 1, 4, 'Filtre à Air', 243960, NULL),
(2, 2, 1, 30, 'Filtre à Air', 343836, NULL),
(3, 8, 1, 7, 'Filtre à Air', 255092, NULL),
(4, 9, 1, 2, 'Filtre à Air', 197000, NULL),
(5, 11, 1, 5, 'Filtre à Air', 0, NULL),
(6, 12, 1, 17, 'Filtre à Air', 202721.64, NULL),
(7, 13, 1, 10, 'Filtre à Air', 212389.14, NULL),
(8, 14, 1, 2, 'Filtre à Air', 138867, NULL),
(9, 17, 1, 37, 'Filtre a Gasoil', 40997.55, NULL),
(10, 18, 1, 16, 'Filtre a Gasoil', 29464, NULL),
(11, 20, 1, 20, 'Filtre a Gasoil', 0, NULL),
(12, 21, 1, 12, 'Filtre a Gasoil', 0, NULL),
(13, 22, 1, 8, 'Filtre a Gasoil', 0, NULL),
(14, 23, 1, 1, 'Filtre a Gasoil', 39000.88, NULL),
(15, 24, 1, 5, 'Filtre a Gasoil', 0, NULL),
(16, 27, 1, 2, 'Filtre a Gasoil', 0, NULL),
(17, 28, 1, 6, 'Filtre a Gasoil', 0, NULL),
(18, 30, 1, 46, 'Filtre a Gasoil', 28137, NULL),
(19, 31, 1, 1, 'Filtre a Huile', 0, NULL),
(20, 32, 1, 5, 'Filtre a Huile', 0, NULL),
(21, 33, 1, 175, 'Filtre a Huile', 68388.07, NULL),
(22, 34, 1, 8, 'Filtre a Huile', 43952.4, NULL),
(23, 35, 1, 79, 'Filtre a Huile', 65680.9, NULL),
(24, 36, 1, 12, 'Filtre a Huile', 34032.8, NULL),
(25, 38, 1, 84, 'Filtre a Huile', 49679, NULL),
(26, 39, 1, 42, 'Filtre a Huile', 53184, NULL),
(27, 40, 1, 4, 'Filtre a Huile', 0, NULL),
(28, 41, 1, 12, 'Filtre a Huile', 427682, NULL),
(29, 42, 1, 4, 'Filtre a Huile', 53369, NULL),
(30, 43, 1, 4, 'Filtre a Huile', 0, NULL),
(31, 44, 1, 89, 'Filtre a Huile', 89668, NULL),
(32, 45, 1, 2, 'Filtre a Huile', 77142.74, NULL),
(33, 46, 1, 39, 'Filtre a Huile', 402752, NULL),
(34, 47, 1, 38, 'Filtre Séparateur Gasoil / Eau', 87558.08, NULL),
(35, 48, 1, 8, 'Filtre Séparateur Gasoil / Eau', 57380, NULL),
(36, 49, 1, 26, 'Filtre de Refroidissement', 89596, NULL),
(37, 50, 1, 16, 'Filtre de Refroidissement', 25840, NULL),
(38, 25, 2, 6, 'Filtre a Gasoil', 28086, NULL),
(39, 23, 3, 11, 'Filtre a Gasoil', 39000.88, NULL),
(40, 26, 3, 54, 'Filtre a Gasoil', 40520.4, NULL),
(41, 48, 3, 50, 'Filtre Séparateur Gasoil / Eau', 57375, NULL),
(42, 51, 3, 4, 'Filtre à Air', 160570.49, NULL),
(43, 3, 3, 4, 'Filtre à Air', 204121.52, NULL),
(44, 74, 4, 10, 'Diodes DIRECTE', 36000, NULL),
(45, 75, 4, 7, 'Diodes INVERSE', 36000, NULL),
(46, 66, 4, 20, 'Disque Tranconneuse', 3250, NULL),
(47, 69, 4, 1, 'GENSET', 3890000, NULL),
(48, 70, 4, 1, 'GENSET', 4390000, NULL),
(49, 53, 4, 5, 'Générateur AVR', 966000, NULL),
(50, 54, 4, 4, 'Générateur AVR', 578000, NULL),
(51, 55, 4, 5, 'Générateur AVR', 2201000, NULL),
(52, 56, 4, 5, 'Générateur AVR', 355000, NULL),
(53, 57, 4, 3, 'Générateur AVR', 294000, NULL),
(54, 60, 4, 2, 'Potentiomètre', 21000, NULL),
(55, 61, 4, 4, 'Potentiomètre', 21000, NULL),
(56, 62, 4, 8, 'Potentiomètre', 21000, NULL),
(57, 63, 4, 11, 'Potentiomètre', 21000, NULL),
(58, 68, 4, 3, 'T C', 50000, NULL),
(59, 73, 4, 2, 'Voltmetre', 400000, NULL),
(60, 72, 4, 2, 'Wattmetre 380V/5A', 400000, NULL),
(61, 62, 5, 5, 'Potentiomètre', 0, NULL),
(62, 76, 6, 1, 'Potentiomètre', 0, NULL),
(63, 77, 7, 9, 'Plot Elastique NOIR', 0, NULL),
(64, 78, 8, 18, 'Nickel Jaune', 0, NULL),
(65, 79, 9, 1, 'Peinture DULUX TRADE', 0, NULL),
(66, 80, 11, 7, 'PEINTURE DULUX TRADE', 0, NULL),
(67, 81, 12, 1, 'Pare Huile AV', 0, NULL),
(68, 82, 12, 1, 'Pare Huile AR', 0, NULL),
(69, 85, 13, 1, 'Joint pour Groupe Poyaud', 0, NULL),
(70, 86, 14, 2, 'Pare huile double', 0, NULL),
(71, 87, 14, 1, 'Cyntrip', 0, NULL),
(72, 88, 14, 4, 'Joint torique', 0, NULL),
(73, 89, 14, 4, 'Casque de Chantier', 0, NULL),
(74, 90, 14, 1, 'Casque de Chantier', 0, NULL),
(75, 91, 14, 1, 'Casque de Chantier', 0, NULL),
(76, 92, 15, 7, 'Domino', 0, NULL),
(77, 59, 16, 409, 'Baguettes WELDING ELECTRODES', 0, NULL),
(78, 58, 16, 582, 'Baguettes WELDING ELECTRODES', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ligne_sortie`
--

CREATE TABLE `ligne_sortie` (
  `id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `sortie_id` int(11) NOT NULL,
  `quantite` double NOT NULL,
  `designation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `utilite` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `ligne_sortie`
--

INSERT INTO `ligne_sortie` (`id`, `produit_id`, `sortie_id`, `quantite`, `designation`, `utilite`) VALUES
(1, 68, 1, 1, 'T C', NULL),
(2, 60, 2, 1, 'Potentiomètre', NULL),
(3, 62, 2, 1, 'Potentiomètre', NULL),
(4, 44, 3, 2, 'Filtre a Huile', NULL),
(5, 26, 3, 1, 'Filtre a Gasoil', NULL),
(6, 17, 3, 1, 'Filtre a Gasoil', NULL),
(7, 13, 3, 1, 'Filtre à Air', NULL),
(8, 44, 4, 2, 'Filtre a Huile', NULL),
(9, 26, 4, 1, 'Filtre a Gasoil', NULL),
(10, 17, 4, 1, 'Filtre a Gasoil', NULL),
(11, 44, 5, 2, 'Filtre a Huile', NULL),
(12, 26, 5, 1, 'Filtre a Gasoil', NULL),
(13, 17, 5, 1, 'Filtre a Gasoil', NULL),
(14, 44, 6, 2, 'Filtre a Huile', NULL),
(15, 25, 6, 1, 'Filtre a Gasoil', NULL),
(16, 44, 7, 2, 'Filtre a Huile', NULL),
(17, 25, 7, 1, 'Filtre a Gasoil', NULL),
(18, 44, 8, 1, 'Filtre a Huile', NULL),
(19, 13, 8, 1, 'Filtre à Air', NULL),
(20, 26, 8, 1, 'Filtre a Gasoil', NULL),
(21, 17, 8, 1, 'Filtre a Gasoil', NULL),
(22, 34, 9, 1, 'Filtre a Huile', NULL),
(23, 38, 9, 1, 'Filtre a Huile', NULL),
(24, 18, 9, 1, 'Filtre a Gasoil', NULL),
(25, 32, 10, 1, 'Filtre a Huile', NULL),
(26, 23, 10, 1, 'Filtre a Gasoil', NULL),
(27, 33, 11, 4, 'Filtre a Huile', NULL),
(28, 35, 11, 2, 'Filtre a Huile', NULL),
(29, 2, 11, 1, 'Filtre à Air', NULL),
(30, 48, 11, 1, 'Filtre Séparateur Gasoil / Eau', NULL),
(31, 49, 11, 4, 'Filtre de Refroidissement', NULL),
(32, 47, 11, 2, 'Filtre Séparateur Gasoil / Eau', NULL),
(33, 46, 12, 2, 'Filtre a Huile', NULL),
(34, 12, 12, 2, 'Filtre à Air', NULL),
(35, 30, 12, 2, 'Filtre a Gasoil', NULL),
(36, 48, 12, 1, 'Filtre Séparateur Gasoil / Eau', NULL),
(37, 46, 13, 2, 'Filtre a Huile', NULL),
(38, 12, 13, 2, 'Filtre à Air', NULL),
(39, 30, 13, 2, 'Filtre a Gasoil', NULL),
(40, 48, 13, 1, 'Filtre Séparateur Gasoil / Eau', NULL),
(41, 46, 14, 2, 'Filtre a Huile', NULL),
(42, 12, 14, 2, 'Filtre à Air', NULL),
(43, 30, 14, 2, 'Filtre a Gasoil', NULL),
(44, 48, 14, 1, 'Filtre Séparateur Gasoil / Eau', NULL),
(45, 13, 15, 1, 'Filtre à Air', NULL),
(46, 3, 16, 4, 'Filtre à Air', NULL),
(47, 13, 17, 2, 'Filtre à Air', NULL),
(48, 13, 18, 2, 'Filtre à Air', NULL),
(49, 2, 20, 1, 'Filtre à Air', NULL),
(50, 60, 21, 1, 'Potentiomètre', NULL),
(51, 62, 21, 1, 'Potentiomètre', NULL),
(52, 68, 22, 2, 'T C', NULL),
(53, 62, 22, 1, 'Potentiomètre', NULL),
(54, 54, 22, 1, 'Générateur AVR', NULL),
(55, 62, 23, 1, 'Potentiomètre', NULL),
(56, 62, 24, 2, 'Potentiomètre', NULL),
(57, 18, 25, 1, 'Filtre a Gasoil', NULL),
(58, 30, 26, 2, 'Filtre a Gasoil', ''),
(59, 39, 26, 3, 'Filtre a Huile', ''),
(60, 30, 27, 2, 'Filtre a Gasoil', ''),
(61, 39, 27, 3, 'Filtre a Huile', '');

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
(1, 'En cours de réparation', 'success', '#4cae4c'),
(2, 'Disponible', 'primary', '#337ab7'),
(3, 'Indisponible', 'danger', '#ac2925'),
(4, 'En cours d\'installation', 'info', '#d58512'),
(5, 'A rapatrier', NULL, '#ffff');

-- --------------------------------------------------------

--
-- Structure de la table `liste_piece`
--

CREATE TABLE `liste_piece` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mission`
--

CREATE TABLE `mission` (
  `id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `probleme_id` int(11) DEFAULT NULL,
  `dateDebut` datetime NOT NULL,
  `dateFin` datetime NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `note_fin` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `moteur`
--

CREATE TABLE `moteur` (
  `id` int(11) NOT NULL,
  `marque` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modele` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numeroSerie` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `annee` double NOT NULL,
  `puissance` double DEFAULT NULL,
  `dateDebutService` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `moteur`
--

INSERT INTO `moteur` (`id`, `marque`, `modele`, `numeroSerie`, `annee`, `puissance`, `dateDebutService`) VALUES
(1, '-', '-', '-', 0, 0, NULL),
(2, '-', '-', '-', 0, 0, NULL),
(3, '-', '-', '-', 0, 0, NULL),
(4, '-', '-', '-', 0, 0, NULL),
(5, '-', '-', '-', 0, 0, NULL),
(6, '-', '-', '-', 0, 0, NULL),
(7, '-', '-', '-', 0, 0, NULL),
(8, '-', '-', '-', 0, 0, NULL),
(9, '-', '-', '-', 0, 0, NULL),
(10, '-', '-', '-', 0, 0, NULL),
(11, '-', '-', '-', 0, 0, NULL),
(12, '-', '-', '-', 0, 0, NULL),
(13, '-', '-', '-', 0, 0, NULL),
(14, '-', '-', '-', 0, 0, NULL),
(15, '-', '-', '-', 0, 0, NULL),
(16, '-', '-', '-', 0, 0, NULL),
(17, '-', '-', '-', 0, 0, NULL),
(18, '-', '-', '-', 0, 0, NULL),
(19, '-', '-', '-', 0, 0, NULL),
(20, '-', '-', '-', 0, 0, NULL),
(21, '-', '-', '-', 0, 0, NULL),
(22, '-', '-', '-', 0, 0, NULL),
(23, '-', '-', '-', 0, 0, NULL),
(24, '-', '-', '-', 0, 0, NULL),
(25, '-', '-', '-', 0, 0, NULL),
(26, '-', '-', '-', 0, 0, NULL),
(27, '-', '-', '-', 0, 0, NULL),
(28, '-', '-', '-', 0, 0, NULL),
(29, '-', '-', '-', 0, 0, NULL),
(30, '-', '-', '-', 0, 0, NULL),
(31, '-', '-', '-', 0, 0, NULL),
(32, '-', '-', '-', 0, 0, NULL),
(33, '-', '-', '-', 0, 0, NULL),
(34, '-', '-', '-', 0, 0, NULL),
(35, '-', '-', '-', 0, 0, NULL),
(36, '-', '-', '-', 0, 0, NULL),
(37, '-', '-', '-', 0, 0, NULL),
(38, '-', '-', '-', 0, 0, NULL),
(39, '-', '-', '-', 0, 0, NULL),
(40, '-', '-', '-', 0, 0, NULL),
(41, '-', '-', '-', 0, 0, NULL),
(42, '-', '-', '-', 0, 0, NULL),
(43, '-', '-', '-', 0, 0, NULL),
(44, '-', '-', '-', 0, 0, NULL),
(45, '-', '-', '-', 0, 0, NULL),
(46, '-', '-', '-', 0, 0, NULL),
(47, '-', '-', '-', 0, 0, NULL),
(48, '-', '-', '-', 0, 0, NULL),
(49, '-', '-', '-', 0, 0, NULL),
(50, '-', '-', '-', 0, 0, NULL),
(51, '-', '-', '-', 0, 0, NULL),
(52, '-', '-', '-', 0, 0, NULL),
(53, '-', '-', '-', 0, 0, NULL),
(54, '-', '-', '-', 0, 0, NULL),
(55, '-', '-', '-', 0, 0, NULL),
(56, '-', '-', '-', 0, 0, NULL),
(57, '-', '-', '-', 0, 0, NULL),
(58, '-', '-', '-', 0, 0, NULL),
(59, '-', '-', '-', 0, 0, NULL),
(60, '-', '-', '-', 0, 0, NULL),
(61, '-', '-', '-', 0, 0, NULL),
(62, '-', '-', '-', 0, 0, NULL),
(63, '-', '-', '-', 0, 0, NULL),
(64, '-', '-', '-', 0, 0, NULL),
(65, '-', '-', '-', 0, 0, NULL),
(66, '-', '-', '-', 0, 0, NULL),
(67, '-', '-', '-', 0, 0, NULL),
(68, '-', '-', '-', 0, 0, NULL),
(69, '-', '-', '-', 0, 0, NULL),
(70, '-', '-', '-', 0, 0, NULL),
(71, '-', '-', '-', 0, 0, NULL),
(72, '-', '-', '-', 0, 0, NULL),
(73, '-', '-', '-', 0, 0, NULL),
(74, '-', '-', '-', 0, 0, NULL),
(75, '-', '-', '-', 0, 0, NULL),
(76, '-', '-', '-', 0, 0, NULL),
(77, '-', '-', '-', 0, 0, NULL),
(78, '-', '-', '-', 0, 0, NULL),
(79, '-', '-', '-', 0, 0, NULL),
(80, '-', '-', '-', 0, 0, NULL),
(81, '-', '-', '-', 0, 0, NULL),
(82, '-', '-', '-', 0, 0, NULL),
(83, '-', '-', '-', 0, 0, NULL),
(84, '-', '-', '-', 0, 0, NULL),
(85, '-', '-', '-', 0, 0, NULL),
(86, '-', '-', '-', 0, 0, NULL),
(87, '-', '-', '-', 0, 0, NULL),
(88, '-', '-', '-', 0, 0, NULL),
(89, '-', '-', '-', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `nombre_confirmation`
--

CREATE TABLE `nombre_confirmation` (
  `id` int(11) NOT NULL,
  `nomDemande` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `nombre_confirmation`
--

INSERT INTO `nombre_confirmation` (`id`, `nomDemande`, `nombre`) VALUES
(1, 'entre', 1),
(2, 'sortie', 1),
(3, 'transfert', 1);

-- --------------------------------------------------------

--
-- Structure de la table `num_doc`
--

CREATE TABLE `num_doc` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `numero` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `num_doc`
--

INSERT INTO `num_doc` (`id`, `nom`, `numero`) VALUES
(1, 'transfert', '001'),
(2, 'bon_sortie', '028'),
(3, 'bon_entrée', '017'),
(4, 'problème_groupe', '002');

-- --------------------------------------------------------

--
-- Structure de la table `pj_catalogue`
--

CREATE TABLE `pj_catalogue` (
  `id` int(11) NOT NULL,
  `catalogue_id` int(11) DEFAULT NULL,
  `lien` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ext` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `probleme`
--

CREATE TABLE `probleme` (
  `id` int(11) NOT NULL,
  `groupe_id` int(11) NOT NULL,
  `historique_arret_id` int(11) DEFAULT NULL,
  `historiquee_demarrer_id` int(11) DEFAULT NULL,
  `user_creer_id` int(11) NOT NULL,
  `user_solution_id` int(11) DEFAULT NULL,
  `numero` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date_signalement` datetime NOT NULL,
  `cause` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `etat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `solution` longtext COLLATE utf8_unicode_ci,
  `date_resolution` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `probleme`
--

INSERT INTO `probleme` (`id`, `groupe_id`, `historique_arret_id`, `historiquee_demarrer_id`, `user_creer_id`, `user_solution_id`, `numero`, `date_signalement`, `cause`, `description`, `etat`, `solution`, `date_resolution`) VALUES
(1, 3, NULL, NULL, 2, 2, 'PBM-001/2019', '2019-11-21 15:23:46', 'Sabssss', 'aucun', 'Résolution en cour', 'En voye d\'argent', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `designation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `refEqui` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prixAchat` double DEFAULT NULL,
  `prixVente` double DEFAULT NULL,
  `stock_total` int(11) DEFAULT NULL,
  `alert` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `designation`, `code`, `reference`, `refEqui`, `prixAchat`, `prixVente`, `stock_total`, `alert`) VALUES
(1, 'Filtre à Air', NULL, 'A-1840-S', NULL, 243960, NULL, 4, 1),
(2, 'Filtre à Air', NULL, 'A5409', 'AF872M - SA10822', 343836, NULL, 28, 10),
(3, 'Filtre à Air', NULL, 'A5714', 'AF928M', 424580.99, NULL, 0, 2),
(4, 'Filtre à Air', NULL, 'A5555-S', NULL, NULL, NULL, NULL, NULL),
(5, 'Filtre à Air', NULL, 'AF1902M', 'SA11852', 92324, NULL, NULL, 2),
(6, 'Filtre à Air', NULL, 'AF1903M', 'SA11853', 200613, NULL, NULL, 2),
(7, 'Filtre à Air', NULL, 'AF1903M', 'SA11853', 200613, NULL, NULL, 2),
(8, 'Filtre à Air', NULL, 'A8525', NULL, 255092, NULL, 7, 1),
(9, 'Filtre à Air', NULL, 'A5301', NULL, 197000, NULL, 2, 1),
(10, 'Filtre à Air', NULL, 'A5618', 'AF742M', 194535, NULL, NULL, 2),
(11, 'Filtre à Air', NULL, 'A71340', NULL, NULL, NULL, 5, 1),
(12, 'Filtre à Air', NULL, 'AF25437', NULL, 202721.64, NULL, 11, 10),
(13, 'Filtre à Air', NULL, 'AF335M', 'A5509 - SA10285', NULL, 212389.14, 3, 5),
(14, 'Filtre à Air', NULL, 'AF4060', 'A6303', 138867, NULL, 2, 2),
(15, 'Filtre à Air', NULL, 'SA16382', NULL, 384888, NULL, NULL, 6),
(16, 'Filtre a Gasoil', NULL, 'FC1805', NULL, 28137.1, NULL, NULL, NULL),
(17, 'Filtre a Gasoil', NULL, 'FC1806', NULL, 40997.55, NULL, 33, 5),
(18, 'Filtre a Gasoil', NULL, 'FC5704', 'FF5018 , SN5074', NULL, 29464, 14, 20),
(19, 'Filtre a Gasoil', NULL, 'FC6202', NULL, NULL, NULL, NULL, NULL),
(20, 'Filtre a Gasoil', NULL, 'FF5036', NULL, NULL, NULL, 20, NULL),
(21, 'Filtre a Gasoil', NULL, 'FF5105', NULL, NULL, NULL, 12, NULL),
(22, 'Filtre a Gasoil', NULL, 'FF5354', NULL, NULL, NULL, 8, NULL),
(23, 'Filtre a Gasoil', NULL, 'FS1212', 'SFC5705', 39000.88, NULL, 11, 4),
(24, 'Filtre a Gasoil', NULL, 'FS1235', NULL, NULL, NULL, 5, NULL),
(25, 'Filtre a Gasoil', NULL, 'SN99130', NULL, 28086, NULL, 4, 2),
(26, 'Filtre a Gasoil', NULL, 'FF4070', 'FC6204', 40520.4, NULL, 50, 8),
(27, 'Filtre a Gasoil', NULL, 'HFS/CO36', NULL, NULL, NULL, 2, NULL),
(28, 'Filtre a Gasoil', NULL, 'ELG5521', NULL, NULL, NULL, 6, NULL),
(29, 'Filtre a Gasoil', NULL, 'ELG5521', NULL, NULL, NULL, NULL, NULL),
(30, 'Filtre a Gasoil', NULL, 'FC5110', 'FF4036 , SN4036', 28137, NULL, 40, 10),
(31, 'Filtre a Huile', NULL, 'C5504', NULL, NULL, NULL, 1, NULL),
(32, 'Filtre a Huile', NULL, 'C5505', NULL, NULL, NULL, 4, 2),
(33, 'Filtre a Huile', NULL, 'C5701', 'FHU510 . LF3325', 68388.07, NULL, 171, 20),
(34, 'Filtre a Huile', NULL, 'C5717', 'LF17502', 43952.4, NULL, 7, 2),
(35, 'Filtre a Huile', NULL, 'C5718', 'FHU511 , LF777', 65680.9, NULL, 77, 10),
(36, 'Filtre a Huile', NULL, 'C6204', NULL, 34032.8, NULL, 12, NULL),
(37, 'Filtre a Huile', NULL, 'SO11029', NULL, 121568, NULL, NULL, 12),
(38, 'Filtre a Huile', NULL, 'SO3675', 'C71060', 49679, NULL, 83, NULL),
(39, 'Filtre a Huile', NULL, 'SO3356', 'C7905', 53184, NULL, 42, 6),
(40, 'Filtre a Huile', NULL, 'EO1101', NULL, NULL, NULL, 4, NULL),
(41, 'Filtre a Huile', NULL, 'LF16149', 'SO9129', 427682, NULL, 12, 6),
(42, 'Filtre a Huile', NULL, 'C7008', 'LF3346 , SO045', 53369, NULL, 4, 2),
(43, 'Filtre a Huile', NULL, 'LF3402', NULL, NULL, NULL, 4, NULL),
(44, 'Filtre a Huile', NULL, 'LF3463', 'SO9135', 89668, NULL, 78, 15),
(45, 'Filtre a Huile', NULL, 'LF4112', 'SO515', 77142.74, NULL, 2, 2),
(46, 'Filtre a Huile', NULL, 'SH84016', 'HY15028', 402752, NULL, 33, 6),
(47, 'Filtre Séparateur Gasoil / Eau', NULL, 'SFC5707', 'FF202 , FS1006', 87558.08, NULL, 36, 10),
(48, 'Filtre Séparateur Gasoil / Eau', NULL, 'SF1912-30', NULL, 57380, NULL, 54, 10),
(49, 'Filtre de Refroidissement', NULL, 'WC5712', 'WF2073 , FEA516', 89596, NULL, 22, 20),
(50, 'Filtre de Refroidissement', NULL, 'WC5705', 'WE2071 , FEA514', 25840, NULL, 16, 20),
(51, 'Filtre à Air', NULL, 'A5509', NULL, 160570.49, NULL, 4, 4),
(52, 'Filtre a Huile', NULL, 'SO045', 'LF3346', 53669, NULL, NULL, 8),
(53, 'Générateur AVR', NULL, 'VR6', NULL, 966000, NULL, 5, NULL),
(54, 'Générateur AVR', NULL, 'R448', NULL, 578000, NULL, 3, NULL),
(55, 'Générateur AVR', NULL, 'EA64-5', NULL, 2201000, NULL, 5, NULL),
(56, 'Générateur AVR', NULL, 'SX440', NULL, 355000, NULL, 5, NULL),
(57, 'Générateur AVR', NULL, 'SE350', NULL, 294000, NULL, 3, NULL),
(58, 'Baguettes WELDING ELECTRODES', NULL, '2.5mm', NULL, 22000, NULL, NULL, NULL),
(59, 'Baguettes WELDING ELECTRODES', NULL, '3.15mm', NULL, 22000, NULL, NULL, NULL),
(60, 'Potentiomètre', NULL, '1 kohm', NULL, 21000, NULL, 0, 5),
(61, 'Potentiomètre', NULL, '2 kohm', NULL, 21000, NULL, 4, 5),
(62, 'Potentiomètre', NULL, '5 kohm', NULL, 21000, NULL, 7, 5),
(63, 'Potentiomètre', NULL, '10 kohm', NULL, 21000, NULL, 11, 5),
(64, 'Collier cinturing NOIR', NULL, '9/360mm', NULL, 77875, NULL, NULL, NULL),
(65, 'Collier cablage Nature', NULL, '4.5/360mm', NULL, 33687.5, NULL, NULL, NULL),
(66, 'Disque Tranconneuse', NULL, 'D230mm', NULL, 3250, NULL, 20, NULL),
(67, 'Meule Ebarbeuse', NULL, '230*6mm', NULL, 6416.67, NULL, NULL, NULL),
(68, 'T C', NULL, '5/1A', NULL, 50000, NULL, 0, NULL),
(69, 'GENSET', NULL, '9320', NULL, 3890000, NULL, 1, NULL),
(70, 'GENSET', NULL, '9620', NULL, 4390000, NULL, 1, NULL),
(71, 'GENSET', NULL, '9310', NULL, 4987000, NULL, NULL, NULL),
(72, 'Wattmetre 380V/5A', NULL, '72*72', NULL, 400000, NULL, 2, NULL),
(73, 'Voltmetre', NULL, '16005', NULL, 400000, NULL, 2, NULL),
(74, 'Diodes DIRECTE', NULL, '85HF120', NULL, 36000, NULL, 10, NULL),
(75, 'Diodes INVERSE', NULL, '85HFR120', NULL, 36000, NULL, 7, NULL),
(76, 'Potentiomètre', NULL, '100 kohm', NULL, NULL, NULL, 1, NULL),
(77, 'Plot Elastique NOIR', NULL, NULL, NULL, NULL, NULL, 9, NULL),
(78, 'Nickel Jaune', NULL, '1 L', NULL, NULL, NULL, 18, NULL),
(79, 'Peinture DULUX TRADE', NULL, 'Rouge Truck and tractor Enamel 1 L', NULL, NULL, NULL, 1, NULL),
(80, 'PEINTURE DULUX TRADE', NULL, 'Jaune truck and tractor enamel 5 L', NULL, NULL, NULL, 7, NULL),
(81, 'Pare Huile AV', NULL, NULL, NULL, NULL, NULL, 1, NULL),
(82, 'Pare Huile AR', NULL, NULL, NULL, NULL, NULL, 1, NULL),
(83, 'Joint de chemise', NULL, 'FRONT SEAL', NULL, NULL, NULL, NULL, NULL),
(84, 'Seal Liner', NULL, '6.621.235', NULL, NULL, NULL, NULL, NULL),
(85, 'Joint pour Groupe Poyaud', NULL, NULL, NULL, NULL, NULL, 1, NULL),
(86, 'Pare huile double', NULL, NULL, NULL, NULL, NULL, 2, NULL),
(87, 'Cyntrip', NULL, NULL, NULL, NULL, NULL, 1, NULL),
(88, 'Joint torique', NULL, NULL, NULL, NULL, NULL, 4, NULL),
(89, 'Casque de Chantier', NULL, 'Jaune', NULL, NULL, NULL, 4, NULL),
(90, 'Casque de Chantier', NULL, 'Orange', NULL, NULL, NULL, 1, NULL),
(91, 'Casque de Chantier', NULL, 'Bleu', NULL, NULL, NULL, 1, NULL),
(92, 'Domino', NULL, NULL, NULL, NULL, NULL, 7, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `site`
--

CREATE TABLE `site` (
  `id` int(11) NOT NULL,
  `emplacement` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `couleur` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coords` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `site`
--

INSERT INTO `site` (`id`, `emplacement`, `couleur`, `coords`) VALUES
(1, 'Ambilobe', '#0080ff', 'a:2:{s:1:\"x\";s:6:\"797.75\";s:1:\"y\";s:17:\"152.9185028076172\";}'),
(2, 'Ambanja', '#0080ff', 'a:2:{s:1:\"x\";s:17:\"767.9749755859375\";s:1:\"y\";s:17:\"245.5518341064453\";}'),
(3, 'Andapa', '#0080ff', 'a:2:{s:1:\"x\";s:16:\"900.308349609375\";s:1:\"y\";s:18:\"371.26849365234375\";}'),
(4, 'Ambatondrazaka', '#0080ff', 'a:2:{s:1:\"x\";s:17:\"721.6583251953125\";s:1:\"y\";s:17:\"909.7916870117188\";}'),
(5, 'Ambositra', '#0080ff', 'a:2:{s:1:\"x\";s:17:\"625.7166748046875\";s:1:\"y\";s:18:\"1135.4935302734375\";}'),
(6, 'Vavatenina', '#0080ff', 'a:2:{s:1:\"x\";s:16:\"850.683349609375\";s:1:\"y\";s:17:\"748.4185180664062\";}'),
(7, 'Vatomandry', '#0080ff', 'a:2:{s:1:\"x\";s:17:\"787.8250122070312\";s:1:\"y\";s:18:\"1016.3934936523438\";}'),
(8, 'Mahanoro', '#0080ff', 'a:2:{s:1:\"x\";s:17:\"774.5916748046875\";s:1:\"y\";s:18:\"1089.1768798828125\";}'),
(9, 'Mananjary', '#0080ff', 'a:2:{s:1:\"x\";s:17:\"721.6583251953125\";s:1:\"y\";s:18:\"1238.0518798828125\";}'),
(10, 'Manakara', '#0080ff', 'a:2:{s:1:\"x\";s:17:\"668.7249755859375\";s:1:\"y\";s:16:\"1432.50830078125\";}'),
(11, 'Farafangana', '#0080ff', 'a:2:{s:1:\"x\";s:17:\"638.9500122070312\";s:1:\"y\";s:16:\"1506.02685546875\";}'),
(12, 'Morombe', '#ff0000', 'a:2:{s:1:\"x\";s:18:\"23.599998474121094\";s:1:\"y\";s:18:\"1415.9666748046875\";}'),
(13, 'Betioky Sud', '#0080ff', 'a:2:{s:1:\"x\";s:18:\"132.77499389648438\";s:1:\"y\";s:17:\"1697.175048828125\";}'),
(14, 'Mandritsara', '#0080ff', 'a:2:{s:1:\"x\";s:6:\"797.75\";s:1:\"y\";s:17:\"549.9185180664062\";}'),
(15, 'Betroka', '#0080ff', 'a:2:{s:1:\"x\";s:17:\"384.2083435058594\";s:1:\"y\";s:18:\"1611.1583251953125\";}'),
(16, 'Bezaha', '#0080ff', 'a:2:{s:1:\"x\";s:18:\"172.47500610351562\";s:1:\"y\";s:18:\"1611.1583251953125\";}'),
(17, 'Ambovombe', '#ff0000', 'a:2:{s:1:\"x\";s:17:\"404.0583190917969\";s:1:\"y\";s:18:\"1918.8333740234375\";}'),
(18, 'Maintirano', '#fc0c36', 'a:2:{s:1:\"x\";s:17:\"122.8499984741211\";s:1:\"y\";s:17:\"841.0518188476562\";}'),
(19, 'Marovoay', '#ff0000', 'a:2:{s:1:\"x\";s:18:\"437.14166259765625\";s:1:\"y\";s:17:\"569.7684936523438\";}'),
(20, 'Port Bergé', '#ff0000', 'a:2:{s:1:\"x\";s:17:\"569.4749755859375\";s:1:\"y\";s:17:\"555.7999877929688\";}'),
(21, 'Ankazobe', '#ff0000', 'a:2:{s:1:\"x\";s:17:\"572.7833251953125\";s:1:\"y\";s:17:\"870.8268432617188\";}'),
(22, 'Ambato Boeni', '#ff0000', 'a:2:{s:1:\"x\";s:17:\"519.8499755859375\";s:1:\"y\";s:17:\"629.3184814453125\";}'),
(23, 'Mananara Nord', '#ff0000', 'a:2:{s:1:\"x\";s:16:\"893.691650390625\";s:1:\"y\";s:12:\"606.16015625\";}'),
(24, 'Maevatanana', '#ff0000', 'a:2:{s:1:\"x\";s:17:\"582.7083129882812\";s:1:\"y\";s:17:\"718.6434936523438\";}'),
(25, 'Antsiranana', '#ff0000', 'a:2:{s:1:\"x\";s:17:\"830.8333129882812\";s:1:\"y\";s:18:\"47.051841735839844\";}'),
(26, 'GODAM', '#00ff80', 'a:2:{s:1:\"x\";s:17:\"526.4666748046875\";s:1:\"y\";s:15:\"985.88330078125\";}'),
(27, 'Vohémar', '#ff0000', 'a:2:{s:1:\"x\";s:17:\"923.4666748046875\";s:1:\"y\";s:17:\"195.9268341064453\";}');

-- --------------------------------------------------------

--
-- Structure de la table `sortie`
--

CREATE TABLE `sortie` (
  `id` int(11) NOT NULL,
  `user_creer_id` int(11) NOT NULL,
  `depot_id` int(11) NOT NULL,
  `user_refuser_id` int(11) DEFAULT NULL,
  `groupe_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `numero` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `etat` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `modifiable` tinyint(1) NOT NULL,
  `destination` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `motif` longtext COLLATE utf8_unicode_ci,
  `texte` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `sortie`
--

INSERT INTO `sortie` (`id`, `user_creer_id`, `depot_id`, `user_refuser_id`, `groupe_id`, `date`, `numero`, `etat`, `modifiable`, `destination`, `motif`, `texte`) VALUES
(1, 3, 1, NULL, NULL, '2019-10-26 14:05:31', 'SOT-001/2019', 'Demande confirmée', 0, 'Jirama Ambositra', 'Installation Groupe Cummins CU012 - suivant BE/LP/2019/031 du 26-10-2019 , Adressé a Monsieur NAIVO +261 34 83 669 68', NULL),
(2, 3, 1, NULL, NULL, '2019-10-31 09:00:19', 'SOT-002/2019', 'Demande confirmée', 0, 'Jirama AMBILOBE', 'BE/LP/2019/039 : Ambilobe - PO013 \r\nAdressé a Mr Soanabela 034 83 894 48  et a Mr Andry ELEC 034 93 858 76', NULL),
(3, 3, 1, NULL, NULL, '2019-10-31 09:05:00', 'SOT-003/2019', 'Demande confirmée', 0, 'Jirama AMBILOBE', 'BE/LP/2019/022 Ambilobe - PO013 au 31-10-2019\r\nAdressé a Mr Soanabela 034 83 894 48 et a Mr Andry ELEC 034 93 858 76', NULL),
(4, 3, 1, NULL, NULL, '2019-10-31 09:17:16', 'SOT-004/2019', 'Demande confirmée', 0, 'Jirama AMBANJA', 'BE/LP/2019/020 ', NULL),
(5, 3, 1, NULL, NULL, '2019-10-31 09:23:34', 'SOT-005/2019', 'Demande confirmée', 0, 'Jirama AMBANJA', 'BE/LP/2019/020 du 31/10/2019 pour PO014 , adressé a Mr Delphin 034 83 894 49 \r\nDerniere Vidange 23/10/2019\r\nHeure de Marche Journalière 14h\r\nPrévision de Vidange 10/11/2019\r\nDernière Expedition 01/10/2019', NULL),
(6, 3, 1, NULL, NULL, '2019-10-31 09:34:48', 'SOT-006/2019', 'Demande confirmée', 0, 'JIRAMA MAHANORO', 'BE/LP/2019/017 du 31/10/2019 pour PO007\r\nAdressé a Mr Christophe 034 83 662 03 \r\nDernière Vidange 25/10/2019\r\nHeure de marche Journalière 18h\r\nPrévision de Vidange 07/11/2019\r\nDernière Expédition 01/10/2019 ( SN99130=1)', NULL),
(7, 3, 1, NULL, NULL, '2019-10-31 09:39:00', 'SOT-007/2019', 'Demande confirmée', 0, 'JIRAMA MANDRITSARA', 'BE/LP/2019/021 du 31/10/2019 \r\nAdressé à Mr Dabisy 034 83 710 87\r\nDernière Vidange 15/10/2019\r\nHeure de marche Journalière 09h\r\nPrévision de Vidange 09/11/2019\r\nDerniere Expedition 01/10/2019 ( SN99130=1)', NULL),
(8, 3, 1, NULL, NULL, '2019-10-31 09:43:49', 'SOT-008/2019', 'Demande confirmée', 0, 'JIRAMA VAVATENINA', 'BE/LP/2019/027 du 31/10/2019\r\nAdressé a Mr Patrick 034 83 703 94\r\nPour POYAUD PO008\r\nDernière Vidange 23/10/2019\r\nHeure de marche Journalière 12h\r\nPrévision de Vidange 12/11/2019\r\nDernière Expedition 01/10/2019 ( FF4070=1, FC1806=1)', NULL),
(9, 3, 1, NULL, NULL, '2019-10-31 09:50:19', 'SOT-009/2019', 'Demande confirmée', 0, 'JIRAMA BEZAHA', 'BE/LP/2019/032 du 31/10/2019\r\nAdressé a Mr MANALAHY JEAN 034 83 702 58\r\nPour VOLVO VO004\r\nDernière Vidange 11/10/2019\r\nHeure de Marche Journalière 20h\r\nPrévision de vidange 04/11/2019\r\nDernière Expédition 01/10/2019 ( C5717=2 , FC5704=2)', NULL),
(10, 3, 1, NULL, NULL, '2019-10-31 10:07:25', 'SOT-010/2019', 'Demande confirmée', 0, 'JIRAMA BETROKA', 'BE/LP/2019/033 du 31/10/2019\r\nAdressé a Mr Manda 034 83 704 76\r\nPour ATLAS COPCO -  AC001\r\nDernière Vidange 23/09/2019\r\nHeure de Marche Journalière 04h\r\nPrévision de Vidange 17/11/2019\r\nDernière Expedition 01/10/2019 ( C5505=1 , FS1212=1)', NULL),
(11, 3, 1, NULL, NULL, '2019-10-31 10:14:22', 'SOT-011/2019', 'Demande confirmée', 0, 'JIRAMA MANAKARA', 'BE/LP/2019/035 du 31/10/2019\r\nAdressé a Mr Johnny 034 83 893 90\r\nPour CUMMINS CU007\r\nDernière Vidange 11/09/2019\r\nHeure de Marche Journalière 10h\r\nPrévision de Vidange 02/11/2019\r\nDernière Expedition 01/10/2019 ( C5718=2 , C5701=4 , SFC5707=2 , SF1912-30=1 )', NULL),
(12, 3, 1, NULL, NULL, '2019-10-31 10:25:11', 'SOT-012/2019', 'Demande confirmée', 0, 'JIRAMA ANDAPA', 'BE/LP/2019/036 du 31/10/2019\r\nAdressé a Mr Willy 034 83 701 49 et Mr Esperat 034 08 485 72\r\nPour PERKINS PE001\r\nDernière Vidange 14/10/2019\r\nHeure de Marche Journalière 10h\r\nPrévision de Vidange 06/11/2019', NULL),
(13, 3, 1, NULL, NULL, '2019-10-31 10:27:41', 'SOT-013/2019', 'Demande confirmée', 0, 'JIRAMA ANDAPA', 'BE/LP/2019/036 du 31/10/2019\r\nAdressé a Mr Willy 034 83 701 49 et Mr Esperat 034 08 485 72\r\nPour PERKINS PE002\r\nDernière Vidange 15/10/2019\r\nHeure de Marche Journalière 10h\r\nPrévision de Vidange 10/11/2019', NULL),
(14, 3, 1, NULL, NULL, '2019-10-31 10:38:12', 'SOT-014/2019', 'Demande confirmée', 0, 'JIRAMA ANDAPA', 'BE/LP/2019/036 du 31/10/2019\r\nAdressé a Mr Willy 034 83 701 49 et Mr Esperat 034 08 485 72\r\nPour PERKINS PE003\r\nDernière Vidange 14/10/2019\r\nHeure de Marche Journalière 09h\r\nPrévision de Vidange 10/11/2019\r\nDernière Expedition 23/09/2019', NULL),
(15, 3, 1, NULL, NULL, '2019-10-31 13:22:58', 'SOT-015/2019', 'Demande confirmée', 0, 'Jirama AMBILOBE', 'BE/LP/2019/041 du 31/10/2019\r\npour AMBILOBE ', NULL),
(16, 3, 1, NULL, NULL, '2019-10-31 13:24:50', 'SOT-016/2019', 'Demande confirmée', 0, 'Jirama AMBANJA', 'BE/LP/2019/038 du 31/10/2019\r\npour JIRAMA AMBANJA \r\n', NULL),
(17, 3, 1, NULL, NULL, '2019-10-31 13:26:55', 'SOT-017/2019', 'Demande confirmée', 0, 'JIRAMA MANDRITSARA', 'BE/LP/2019/021 du 31/10/2019\r\nAdressé a Mr Dabisy 034 83 710 87\r\nPour POYAUD PO010\r\nDerniere Vidange 15/10/2019\r\nHeure de Marche Journalière 09h\r\nPrevision de Vidange 09/11/2019', NULL),
(18, 3, 1, NULL, NULL, '2019-10-31 13:29:55', 'SOT-018/2019', 'Demande confirmée', 0, 'JIRAMA MAHANORO', 'BE/LP/2019/017 du 31/10/2019\r\npour JIRAMA MAHANORO\r\nAdressé a Mr Christophe\r\nDernière Vidange 25/10/2019\r\nHeure de Marche Journalière 18h\r\nPrevision de Vidange 07/11/2019', NULL),
(19, 3, 1, NULL, NULL, '2019-10-31 16:51:13', 'SOT-019/2019', 'Demande confirmée', 0, 'JIRAMA MANAKARA', 'BE/LP/2019/042 du 06/11/2019\r\npour JIRAMA MANAKARA\r\n', NULL),
(20, 3, 1, NULL, NULL, '2019-10-31 16:51:59', 'SOT-020/2019', 'Demande confirmée', 0, 'JIRAMA MANAKARA', 'BE/LP/2019/042', NULL),
(21, 3, 1, NULL, NULL, '2019-10-31 15:36:47', 'SOT-021/2019', 'Demande confirmée', 0, 'Jirama AMBILOBE', 'BE/LP/2019/039 du 31/10/2019', NULL),
(22, 3, 1, NULL, NULL, '2019-11-08 15:38:56', 'SOT-022/2019', 'Demande confirmée', 0, 'JIRAMA BETIOKY SUD', 'BE/LP/2019/046 pour JIRAMA BETIOKY SUD ', NULL),
(23, 3, 1, NULL, NULL, '2019-11-09 15:41:21', 'SOT-023/2019', 'Demande confirmée', 0, 'JIRAMA AMBOSITRA', 'BE/LP/2019/050 pour JIRAMA AMBOSITRA', NULL),
(24, 3, 1, NULL, NULL, '2019-10-10 08:33:21', 'SOT-024/2019', 'Demande confirmée', 0, '', 'Mise a jour stock ', NULL),
(25, 3, 1, NULL, NULL, '2019-11-12 14:30:32', 'SOT-025/2019', 'Demande confirmée', 0, 'JIRAMA BEZAHA', 'BE/LP/2019/053 du 12/11/2019 - omission lors de la derniere expeditions de filtres mensuelles', NULL),
(26, 3, 1, NULL, 35, '2019-11-19 17:09:59', 'SOT-026/2019', 'En attente de confirmation', 0, 'Jirama Ambositra', 'BE/LP/2019/061 expedition de filtres au 20-11-2019', NULL),
(27, 3, 1, NULL, 36, '2019-11-19 17:11:46', 'SOT-027/2019', 'En attente de confirmation', 0, 'Jirama Ambositra', 'BE/LP/2019/061 expedition filtres au 20-11-2019', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `sortie_user`
--

CREATE TABLE `sortie_user` (
  `sortie_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `sortie_user`
--

INSERT INTO `sortie_user` (`sortie_id`, `user_id`) VALUES
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2);

-- --------------------------------------------------------

--
-- Structure de la table `stock_`
--

CREATE TABLE `stock_` (
  `id` int(11) NOT NULL,
  `depot_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `stock_`
--

INSERT INTO `stock_` (`id`, `depot_id`, `produit_id`, `quantite`) VALUES
(1, 1, 1, 4),
(2, 1, 2, 28),
(3, 1, 8, 7),
(4, 1, 9, 2),
(5, 1, 11, 5),
(6, 1, 12, 11),
(7, 1, 13, 3),
(8, 1, 14, 2),
(9, 1, 17, 33),
(10, 1, 18, 14),
(11, 1, 20, 20),
(12, 1, 21, 12),
(13, 1, 22, 8),
(14, 1, 23, 11),
(15, 1, 24, 5),
(16, 1, 27, 2),
(17, 1, 28, 6),
(18, 1, 30, 40),
(19, 1, 31, 1),
(20, 1, 32, 4),
(21, 1, 33, 171),
(22, 1, 34, 7),
(23, 1, 35, 77),
(24, 1, 36, 12),
(25, 1, 38, 83),
(26, 1, 39, 42),
(27, 1, 40, 4),
(28, 1, 41, 12),
(29, 1, 42, 4),
(30, 1, 43, 4),
(31, 1, 44, 78),
(32, 1, 45, 2),
(33, 1, 46, 33),
(34, 1, 47, 36),
(35, 1, 48, 54),
(36, 1, 49, 22),
(37, 1, 50, 16),
(38, 1, 25, 4),
(39, 1, 26, 50),
(40, 1, 51, 4),
(41, 1, 3, 0),
(42, 1, 74, 10),
(43, 1, 75, 7),
(44, 1, 66, 20),
(45, 1, 69, 1),
(46, 1, 70, 1),
(47, 1, 53, 5),
(48, 1, 54, 3),
(49, 1, 55, 5),
(50, 1, 56, 5),
(51, 1, 57, 3),
(52, 1, 60, 0),
(53, 1, 61, 4),
(54, 1, 62, 7),
(55, 1, 63, 11),
(56, 1, 68, 0),
(57, 1, 73, 2),
(58, 1, 72, 2),
(59, 1, 76, 1),
(60, 1, 77, 9),
(61, 1, 78, 18),
(62, 1, 79, 1),
(63, 1, 80, 7),
(64, 1, 81, 1),
(65, 1, 82, 1),
(66, 1, 85, 1),
(67, 1, 86, 2),
(68, 1, 87, 1),
(69, 1, 88, 4),
(70, 1, 89, 4),
(71, 1, 90, 1),
(72, 1, 91, 1),
(73, 1, 92, 7);

-- --------------------------------------------------------

--
-- Structure de la table `suivi_piece`
--

CREATE TABLE `suivi_piece` (
  `id` int(11) NOT NULL,
  `type_piece_id` int(11) DEFAULT NULL,
  `groupe_id` int(11) NOT NULL,
  `vidange_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `nom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `nom`) VALUES
(1, 'admin', 'admin', 'admin@groupe-ibc.com', 'admin@groupe-ibc.com', 1, NULL, '$2y$13$fgd8Y1cDZP5ok/jsGZn2d.bAi0dsAVblmFND6oQ4CLCAz2Zm0A28a', '2019-10-28 11:11:52', NULL, NULL, 'a:1:{i:0;s:9:\"ROLE_RESP\";}', 'Admin'),
(2, 'allin', 'allin', 'allin13ramanampisoa@outlook.fr', 'allin13ramanampisoa@outlook.fr', 1, NULL, '$2y$13$Lo0eS9PTs4E4Ir5ZWa5.4u329XCwdhEfFWVGP/NkYYT09uXHiBjEK', '2019-11-22 15:26:33', NULL, NULL, 'a:3:{i:0;s:9:\"ROLE_RESP\";i:1;s:13:\"ROLE_RESP_GRP\";i:2;s:10:\"ROLE_ADMIN\";}', 'Allin RAMANAMPISOA'),
(3, 'grp2', 'grp2', 'logistique.locapro@groupe-ibc.com', 'logistique.locapro@groupe-ibc.com', 1, NULL, '$2y$13$EdXRqat5aGh9DbRk3eUrZukVElaPbPcP9TLn.82CWQv/k3cyzprva', '2019-11-19 16:18:46', NULL, NULL, 'a:5:{i:0;s:12:\"ROLE_PRODUIT\";i:1;s:18:\"ROLE_GESTION_ENTRE\";i:2;s:19:\"ROLE_GESTION_SORTIE\";i:3;s:24:\"ROLE_GESTION_DEPLACEMENT\";i:4;s:19:\"ROLE_GESTION_GROUPE\";}', 'Tiana'),
(4, 'grp3', 'grp3', 'raf.locapro@groupe-ibc.com', 'raf.locapro@groupe-ibc.com', 1, NULL, '$2y$13$Ex9BT6m42CSvy4KZB/WcRe4yfAf.R5GwVp0ADe0wmQ/t31MllXryO', '2019-11-13 16:34:58', NULL, NULL, 'a:14:{i:0;s:9:\"ROLE_RESP\";i:1;s:12:\"ROLE_PRODUIT\";i:2;s:18:\"ROLE_GESTION_ENTRE\";i:3;s:19:\"ROLE_GESTION_SORTIE\";i:4;s:24:\"ROLE_GESTION_DEPLACEMENT\";i:5;s:13:\"ROLE_RESP_GRP\";i:6;s:11:\"ROLE_COMPTA\";i:7;s:19:\"ROLE_GESTION_GROUPE\";i:8;s:14:\"ROLE_AJOUT_PBM\";i:9;s:17:\"ROLE_SOLUTION_PBM\";i:10;s:13:\"ROLE_FINI_PBM\";i:11;s:12:\"ROLE_VIDANGE\";i:12;s:10:\"ROLE_PIECE\";i:13;s:13:\"ROLE_ETAT_GRP\";}', 'Safy Moufazal'),
(5, 'grp4', 'grp4', 'personnel.locapro@groupe-ibc.com', 'personnel.locapro@groupe-ibc.com', 1, NULL, '$2y$13$sZEqfPGY5dTTz.cYJsNp2.ysU.KQ89vdBRbT2IC8VcDxf9wHKQqGO', '2019-11-18 08:59:26', NULL, NULL, 'a:5:{i:0;s:18:\"ROLE_GESTION_ENTRE\";i:1;s:19:\"ROLE_GESTION_SORTIE\";i:2;s:24:\"ROLE_GESTION_DEPLACEMENT\";i:3;s:11:\"ROLE_COMPTA\";i:4;s:19:\"ROLE_GESTION_GROUPE\";}', 'Olivia');

-- --------------------------------------------------------

--
-- Structure de la table `vidange`
--

CREATE TABLE `vidange` (
  `id` int(11) NOT NULL,
  `groupe_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `heure_marche` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `alternateur`
--
ALTER TABLE `alternateur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `catalogue`
--
ALTER TABLE `catalogue`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_59A699F5FF7747B4` (`titre`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `depense`
--
ALTER TABLE `depense`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_340597577A45358C` (`groupe_id`),
  ADD KEY `IDX_3405975796784F9E` (`probleme_id`);

--
-- Index pour la table `deplacement`
--
ALTER TABLE `deplacement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1296FAC2F1E14FD2` (`user_creer_id`),
  ADD KEY `IDX_1296FAC2B8878DCB` (`sourcedepot_id`),
  ADD KEY `IDX_1296FAC29F610ADB` (`destinationdepot_id`),
  ADD KEY `IDX_1296FAC28C239A03` (`user_refuser_id`);

--
-- Index pour la table `deplacement_groupe`
--
ALTER TABLE `deplacement_groupe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B65792DBC808883E` (`site_depart_id`),
  ADD KEY `IDX_B65792DBC03AB848` (`site_destination_id`);

--
-- Index pour la table `deplacement_user`
--
ALTER TABLE `deplacement_user`
  ADD PRIMARY KEY (`deplacement_id`,`user_id`),
  ADD KEY `IDX_2BD25FBB355B84A` (`deplacement_id`),
  ADD KEY `IDX_2BD25FBBA76ED395` (`user_id`);

--
-- Index pour la table `depot`
--
ALTER TABLE `depot`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_47948BBC6C6E55B5` (`nom`),
  ADD UNIQUE KEY `UNIQ_47948BBC4DE29F49` (`abrv`);

--
-- Index pour la table `doc`
--
ALTER TABLE `doc`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `employe_mission`
--
ALTER TABLE `employe_mission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_54689E9FBE6CAE90` (`mission_id`);

--
-- Index pour la table `entre`
--
ALTER TABLE `entre`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_3F20C13FF55AE19E` (`numero`),
  ADD KEY `IDX_3F20C13FF1E14FD2` (`user_creer_id`),
  ADD KEY `IDX_3F20C13F8510D4DE` (`depot_id`),
  ADD KEY `IDX_3F20C13F670C757F` (`fournisseur_id`),
  ADD KEY `IDX_3F20C13F8C239A03` (`user_refuser_id`);

--
-- Index pour la table `entre_user`
--
ALTER TABLE `entre_user`
  ADD PRIMARY KEY (`entre_id`,`user_id`),
  ADD KEY `IDX_5DA56CBAA0F9A165` (`entre_id`),
  ADD KEY `IDX_5DA56CBAA76ED395` (`user_id`);

--
-- Index pour la table `famille_client`
--
ALTER TABLE `famille_client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `famille_produit`
--
ALTER TABLE `famille_produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_4B98C216BF4B111` (`moteur_id`),
  ADD UNIQUE KEY `UNIQ_4B98C211A92A21` (`alternateur_id`),
  ADD KEY `IDX_4B98C21F6BD1646` (`site_id`),
  ADD KEY `IDX_4B98C218AD77360` (`etat_groupe_id`),
  ADD KEY `IDX_4B98C214A7843DC` (`catalogue_id`);

--
-- Index pour la table `heure_marche`
--
ALTER TABLE `heure_marche`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FCC85F827A45358C` (`groupe_id`);

--
-- Index pour la table `historique_etat`
--
ALTER TABLE `historique_etat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D193D080A6969866` (`probleme_arret_id`),
  ADD UNIQUE KEY `UNIQ_D193D080A199377E` (`probleme_demarrer_id`),
  ADD KEY `IDX_D193D0807A45358C` (`groupe_id`);

--
-- Index pour la table `historique_groupe`
--
ALTER TABLE `historique_groupe`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_CDFB2C7D6F4AD980` (`historique_etat_id`),
  ADD UNIQUE KEY `UNIQ_CDFB2C7D62365F3B` (`suivi_piece_id`),
  ADD UNIQUE KEY `UNIQ_CDFB2C7D355B84A` (`deplacement_id`),
  ADD UNIQUE KEY `UNIQ_CDFB2C7D1D699D22` (`vidange_id`),
  ADD UNIQUE KEY `UNIQ_CDFB2C7D9EAA14EA` (`probleme_signale_id`),
  ADD UNIQUE KEY `UNIQ_CDFB2C7DD222021B` (`probleme_resolu_id`),
  ADD UNIQUE KEY `UNIQ_CDFB2C7D2C6C013B` (`heure_marche_id`),
  ADD KEY `IDX_CDFB2C7D7A45358C` (`groupe_id`);

--
-- Index pour la table `historique_produit`
--
ALTER TABLE `historique_produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4BB1B358F347EFB` (`produit_id`),
  ADD KEY `IDX_4BB1B358A0F9A165` (`entre_id`),
  ADD KEY `IDX_4BB1B358CC72D953` (`sortie_id`),
  ADD KEY `IDX_4BB1B358355B84A` (`deplacement_id`),
  ADD KEY `IDX_4BB1B3588510D4DE` (`depot_id`);

--
-- Index pour la table `ligne_deplacement`
--
ALTER TABLE `ligne_deplacement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_71733AF5F347EFB` (`produit_id`),
  ADD KEY `IDX_71733AF5355B84A` (`deplacement_id`);

--
-- Index pour la table `ligne_entre`
--
ALTER TABLE `ligne_entre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3C8C2B0FF347EFB` (`produit_id`),
  ADD KEY `IDX_3C8C2B0FA0F9A165` (`entre_id`);

--
-- Index pour la table `ligne_sortie`
--
ALTER TABLE `ligne_sortie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1AE54FB4F347EFB` (`produit_id`),
  ADD KEY `IDX_1AE54FB4CC72D953` (`sortie_id`);

--
-- Index pour la table `liste_etat_groupe`
--
ALTER TABLE `liste_etat_groupe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `liste_piece`
--
ALTER TABLE `liste_piece`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mission`
--
ALTER TABLE `mission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9067F23CF6BD1646` (`site_id`),
  ADD KEY `IDX_9067F23C96784F9E` (`probleme_id`);

--
-- Index pour la table `moteur`
--
ALTER TABLE `moteur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `nombre_confirmation`
--
ALTER TABLE `nombre_confirmation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_5041C96B90D596ED` (`nomDemande`);

--
-- Index pour la table `num_doc`
--
ALTER TABLE `num_doc`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pj_catalogue`
--
ALTER TABLE `pj_catalogue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1A54D9B94A7843DC` (`catalogue_id`);

--
-- Index pour la table `probleme`
--
ALTER TABLE `probleme`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_7AB2D714F55AE19E` (`numero`),
  ADD UNIQUE KEY `UNIQ_7AB2D714A829B9A2` (`historique_arret_id`),
  ADD UNIQUE KEY `UNIQ_7AB2D714FE43EFE0` (`historiquee_demarrer_id`),
  ADD KEY `IDX_7AB2D7147A45358C` (`groupe_id`),
  ADD KEY `IDX_7AB2D714F1E14FD2` (`user_creer_id`),
  ADD KEY `IDX_7AB2D714B5102816` (`user_solution_id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sortie`
--
ALTER TABLE `sortie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_3C3FD3F2F55AE19E` (`numero`),
  ADD KEY `IDX_3C3FD3F2F1E14FD2` (`user_creer_id`),
  ADD KEY `IDX_3C3FD3F28510D4DE` (`depot_id`),
  ADD KEY `IDX_3C3FD3F28C239A03` (`user_refuser_id`),
  ADD KEY `IDX_3C3FD3F27A45358C` (`groupe_id`);

--
-- Index pour la table `sortie_user`
--
ALTER TABLE `sortie_user`
  ADD PRIMARY KEY (`sortie_id`,`user_id`),
  ADD KEY `IDX_8A67684ACC72D953` (`sortie_id`),
  ADD KEY `IDX_8A67684AA76ED395` (`user_id`);

--
-- Index pour la table `stock_`
--
ALTER TABLE `stock_`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_642FF4E68510D4DE` (`depot_id`),
  ADD KEY `IDX_642FF4E6F347EFB` (`produit_id`);

--
-- Index pour la table `suivi_piece`
--
ALTER TABLE `suivi_piece`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E7C62B009F0E854` (`type_piece_id`),
  ADD KEY `IDX_E7C62B007A45358C` (`groupe_id`),
  ADD KEY `IDX_E7C62B001D699D22` (`vidange_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`);

--
-- Index pour la table `vidange`
--
ALTER TABLE `vidange`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_872AAB8B7A45358C` (`groupe_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `alternateur`
--
ALTER TABLE `alternateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT pour la table `catalogue`
--
ALTER TABLE `catalogue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `depense`
--
ALTER TABLE `depense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `deplacement`
--
ALTER TABLE `deplacement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `deplacement_groupe`
--
ALTER TABLE `deplacement_groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `depot`
--
ALTER TABLE `depot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `doc`
--
ALTER TABLE `doc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `employe_mission`
--
ALTER TABLE `employe_mission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `entre`
--
ALTER TABLE `entre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `famille_client`
--
ALTER TABLE `famille_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `famille_produit`
--
ALTER TABLE `famille_produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT pour la table `heure_marche`
--
ALTER TABLE `heure_marche`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `historique_etat`
--
ALTER TABLE `historique_etat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `historique_groupe`
--
ALTER TABLE `historique_groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `historique_produit`
--
ALTER TABLE `historique_produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT pour la table `ligne_deplacement`
--
ALTER TABLE `ligne_deplacement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligne_entre`
--
ALTER TABLE `ligne_entre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT pour la table `ligne_sortie`
--
ALTER TABLE `ligne_sortie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT pour la table `liste_etat_groupe`
--
ALTER TABLE `liste_etat_groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `liste_piece`
--
ALTER TABLE `liste_piece`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `mission`
--
ALTER TABLE `mission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `moteur`
--
ALTER TABLE `moteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT pour la table `nombre_confirmation`
--
ALTER TABLE `nombre_confirmation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `num_doc`
--
ALTER TABLE `num_doc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `pj_catalogue`
--
ALTER TABLE `pj_catalogue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `probleme`
--
ALTER TABLE `probleme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT pour la table `site`
--
ALTER TABLE `site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `sortie`
--
ALTER TABLE `sortie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `stock_`
--
ALTER TABLE `stock_`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT pour la table `suivi_piece`
--
ALTER TABLE `suivi_piece`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `vidange`
--
ALTER TABLE `vidange`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `depense`
--
ALTER TABLE `depense`
  ADD CONSTRAINT `FK_340597577A45358C` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`id`),
  ADD CONSTRAINT `FK_3405975796784F9E` FOREIGN KEY (`probleme_id`) REFERENCES `probleme` (`id`);

--
-- Contraintes pour la table `deplacement`
--
ALTER TABLE `deplacement`
  ADD CONSTRAINT `FK_1296FAC28C239A03` FOREIGN KEY (`user_refuser_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_1296FAC29F610ADB` FOREIGN KEY (`destinationdepot_id`) REFERENCES `depot` (`id`),
  ADD CONSTRAINT `FK_1296FAC2B8878DCB` FOREIGN KEY (`sourcedepot_id`) REFERENCES `depot` (`id`),
  ADD CONSTRAINT `FK_1296FAC2F1E14FD2` FOREIGN KEY (`user_creer_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `deplacement_groupe`
--
ALTER TABLE `deplacement_groupe`
  ADD CONSTRAINT `FK_B65792DBC03AB848` FOREIGN KEY (`site_destination_id`) REFERENCES `site` (`id`),
  ADD CONSTRAINT `FK_B65792DBC808883E` FOREIGN KEY (`site_depart_id`) REFERENCES `site` (`id`);

--
-- Contraintes pour la table `deplacement_user`
--
ALTER TABLE `deplacement_user`
  ADD CONSTRAINT `FK_2BD25FBB355B84A` FOREIGN KEY (`deplacement_id`) REFERENCES `deplacement` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2BD25FBBA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `employe_mission`
--
ALTER TABLE `employe_mission`
  ADD CONSTRAINT `FK_54689E9FBE6CAE90` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`);

--
-- Contraintes pour la table `entre`
--
ALTER TABLE `entre`
  ADD CONSTRAINT `FK_3F20C13F670C757F` FOREIGN KEY (`fournisseur_id`) REFERENCES `fournisseur` (`id`),
  ADD CONSTRAINT `FK_3F20C13F8510D4DE` FOREIGN KEY (`depot_id`) REFERENCES `depot` (`id`),
  ADD CONSTRAINT `FK_3F20C13F8C239A03` FOREIGN KEY (`user_refuser_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_3F20C13FF1E14FD2` FOREIGN KEY (`user_creer_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `entre_user`
--
ALTER TABLE `entre_user`
  ADD CONSTRAINT `FK_5DA56CBAA0F9A165` FOREIGN KEY (`entre_id`) REFERENCES `entre` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_5DA56CBAA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD CONSTRAINT `FK_4B98C211A92A21` FOREIGN KEY (`alternateur_id`) REFERENCES `alternateur` (`id`),
  ADD CONSTRAINT `FK_4B98C214A7843DC` FOREIGN KEY (`catalogue_id`) REFERENCES `catalogue` (`id`),
  ADD CONSTRAINT `FK_4B98C216BF4B111` FOREIGN KEY (`moteur_id`) REFERENCES `moteur` (`id`),
  ADD CONSTRAINT `FK_4B98C218AD77360` FOREIGN KEY (`etat_groupe_id`) REFERENCES `liste_etat_groupe` (`id`),
  ADD CONSTRAINT `FK_4B98C21F6BD1646` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`);

--
-- Contraintes pour la table `heure_marche`
--
ALTER TABLE `heure_marche`
  ADD CONSTRAINT `FK_FCC85F827A45358C` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`id`);

--
-- Contraintes pour la table `historique_etat`
--
ALTER TABLE `historique_etat`
  ADD CONSTRAINT `FK_D193D0807A45358C` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D193D080A199377E` FOREIGN KEY (`probleme_demarrer_id`) REFERENCES `probleme` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D193D080A6969866` FOREIGN KEY (`probleme_arret_id`) REFERENCES `probleme` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `historique_groupe`
--
ALTER TABLE `historique_groupe`
  ADD CONSTRAINT `FK_CDFB2C7D1D699D22` FOREIGN KEY (`vidange_id`) REFERENCES `vidange` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CDFB2C7D2C6C013B` FOREIGN KEY (`heure_marche_id`) REFERENCES `heure_marche` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CDFB2C7D355B84A` FOREIGN KEY (`deplacement_id`) REFERENCES `deplacement_groupe` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CDFB2C7D62365F3B` FOREIGN KEY (`suivi_piece_id`) REFERENCES `suivi_piece` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CDFB2C7D6F4AD980` FOREIGN KEY (`historique_etat_id`) REFERENCES `historique_etat` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CDFB2C7D7A45358C` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CDFB2C7D9EAA14EA` FOREIGN KEY (`probleme_signale_id`) REFERENCES `probleme` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CDFB2C7DD222021B` FOREIGN KEY (`probleme_resolu_id`) REFERENCES `probleme` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `historique_produit`
--
ALTER TABLE `historique_produit`
  ADD CONSTRAINT `FK_4BB1B358355B84A` FOREIGN KEY (`deplacement_id`) REFERENCES `deplacement` (`id`),
  ADD CONSTRAINT `FK_4BB1B3588510D4DE` FOREIGN KEY (`depot_id`) REFERENCES `depot` (`id`),
  ADD CONSTRAINT `FK_4BB1B358A0F9A165` FOREIGN KEY (`entre_id`) REFERENCES `entre` (`id`),
  ADD CONSTRAINT `FK_4BB1B358CC72D953` FOREIGN KEY (`sortie_id`) REFERENCES `sortie` (`id`),
  ADD CONSTRAINT `FK_4BB1B358F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `ligne_deplacement`
--
ALTER TABLE `ligne_deplacement`
  ADD CONSTRAINT `FK_71733AF5355B84A` FOREIGN KEY (`deplacement_id`) REFERENCES `deplacement` (`id`),
  ADD CONSTRAINT `FK_71733AF5F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `ligne_entre`
--
ALTER TABLE `ligne_entre`
  ADD CONSTRAINT `FK_3C8C2B0FA0F9A165` FOREIGN KEY (`entre_id`) REFERENCES `entre` (`id`),
  ADD CONSTRAINT `FK_3C8C2B0FF347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `ligne_sortie`
--
ALTER TABLE `ligne_sortie`
  ADD CONSTRAINT `FK_1AE54FB4CC72D953` FOREIGN KEY (`sortie_id`) REFERENCES `sortie` (`id`),
  ADD CONSTRAINT `FK_1AE54FB4F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `mission`
--
ALTER TABLE `mission`
  ADD CONSTRAINT `FK_9067F23C96784F9E` FOREIGN KEY (`probleme_id`) REFERENCES `probleme` (`id`),
  ADD CONSTRAINT `FK_9067F23CF6BD1646` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`);

--
-- Contraintes pour la table `pj_catalogue`
--
ALTER TABLE `pj_catalogue`
  ADD CONSTRAINT `FK_1A54D9B94A7843DC` FOREIGN KEY (`catalogue_id`) REFERENCES `catalogue` (`id`);

--
-- Contraintes pour la table `probleme`
--
ALTER TABLE `probleme`
  ADD CONSTRAINT `FK_7AB2D7147A45358C` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_7AB2D714A829B9A2` FOREIGN KEY (`historique_arret_id`) REFERENCES `historique_etat` (`id`),
  ADD CONSTRAINT `FK_7AB2D714B5102816` FOREIGN KEY (`user_solution_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_7AB2D714F1E14FD2` FOREIGN KEY (`user_creer_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_7AB2D714FE43EFE0` FOREIGN KEY (`historiquee_demarrer_id`) REFERENCES `historique_etat` (`id`);

--
-- Contraintes pour la table `sortie`
--
ALTER TABLE `sortie`
  ADD CONSTRAINT `FK_3C3FD3F27A45358C` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`id`),
  ADD CONSTRAINT `FK_3C3FD3F28510D4DE` FOREIGN KEY (`depot_id`) REFERENCES `depot` (`id`),
  ADD CONSTRAINT `FK_3C3FD3F28C239A03` FOREIGN KEY (`user_refuser_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_3C3FD3F2F1E14FD2` FOREIGN KEY (`user_creer_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `sortie_user`
--
ALTER TABLE `sortie_user`
  ADD CONSTRAINT `FK_8A67684AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8A67684ACC72D953` FOREIGN KEY (`sortie_id`) REFERENCES `sortie` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `stock_`
--
ALTER TABLE `stock_`
  ADD CONSTRAINT `FK_642FF4E68510D4DE` FOREIGN KEY (`depot_id`) REFERENCES `depot` (`id`),
  ADD CONSTRAINT `FK_642FF4E6F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `suivi_piece`
--
ALTER TABLE `suivi_piece`
  ADD CONSTRAINT `FK_E7C62B001D699D22` FOREIGN KEY (`vidange_id`) REFERENCES `vidange` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_E7C62B007A45358C` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_E7C62B009F0E854` FOREIGN KEY (`type_piece_id`) REFERENCES `liste_piece` (`id`);

--
-- Contraintes pour la table `vidange`
--
ALTER TABLE `vidange`
  ADD CONSTRAINT `FK_872AAB8B7A45358C` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
