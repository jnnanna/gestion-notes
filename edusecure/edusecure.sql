-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 30 déc. 2025 à 00:58
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `edusecure`

create database if not exists `edusecure` default character set utf8mb4 collate utf8mb4_unicode_ci;
USE `edusecure`;
--


-- --------------------------------------------------------

--
-- Structure de la table `annees_academiques`
--

CREATE TABLE `annees_academiques` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `annees_academiques`
--

INSERT INTO `annees_academiques` (`id`, `code`, `libelle`, `date_debut`, `date_fin`, `actif`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2022-2023', 'Année Académique 2022-2023', '2022-09-01', '2023-06-30', 0, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(2, '2023-2024', 'Année Académique 2023-2024', '2023-09-01', '2024-06-30', 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(3, '2024-2025', 'Année Académique 2024-2025', '2024-09-01', '2025-06-30', 0, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `archives`
--

CREATE TABLE `archives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `annee_academique_id` bigint(20) UNSIGNED NOT NULL,
  `feuille_note_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `chemin` varchar(255) NOT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `archive_par` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('edusecure-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:19:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:18:\"gerer_departements\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:14:\"gerer_filieres\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:13:\"gerer_modules\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:15:\"gerer_semestres\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:18:\"gerer_utilisateurs\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:14:\"assigner_roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:15:\"gerer_etudiants\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:14:\"voir_etudiants\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:6:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:6;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:14:\"importer_notes\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:5;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:17:\"voir_importations\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:6:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:6;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:13:\"valider_notes\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:14:\"modifier_notes\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:5;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:10:\"voir_notes\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:6:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:6;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:16:\"exporter_donnees\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:16:\"generer_rapports\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:18:\"archiver_documents\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:18:\"consulter_archives\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:6;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:9:\"voir_logs\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:18:\"configurer_systeme\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:6:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"super-admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:12:\"gestionnaire\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:16:\"chef-departement\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:12:\"chef-filiere\";s:1:\"c\";s:3:\"web\";}i:4;a:3:{s:1:\"a\";i:5;s:1:\"b\";s:10:\"enseignant\";s:1:\"c\";s:3:\"web\";}i:5;a:3:{s:1:\"a\";i:6;s:1:\"b\";s:10:\"consultant\";s:1:\"c\";s:3:\"web\";}}}', 1767137198);

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `departements`
--

CREATE TABLE `departements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `chef_id` bigint(20) UNSIGNED DEFAULT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `departements`
--

INSERT INTO `departements` (`id`, `code`, `nom`, `description`, `chef_id`, `actif`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'INFO', 'Département Informatique', 'Sciences du numérique et technologies de l\'information', 3, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(2, 'MATH', 'Département Mathématiques', 'Mathématiques pures et appliquées', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(3, 'PHYS', 'Département Physique', 'Physique fondamentale et sciences de la matière', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(4, 'CHIM', 'Département Chimie', 'Chimie organique, inorganique et analytique', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(5, 'BIO', 'Département Biologie', 'Sciences de la vie et biotechnologies', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

CREATE TABLE `etudiants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `matricule` varchar(50) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `lieu_naissance` varchar(255) DEFAULT NULL,
  `filiere_id` bigint(20) UNSIGNED NOT NULL,
  `niveau` varchar(50) DEFAULT NULL,
  `groupe` varchar(10) DEFAULT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etudiants`
--

INSERT INTO `etudiants` (`id`, `matricule`, `nom`, `prenom`, `email`, `telephone`, `date_naissance`, `lieu_naissance`, `filiere_id`, `niveau`, `groupe`, `photo_url`, `actif`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2023-4126', 'Wisoky', 'Osborne', 'leuschke.tony@example.org', '+14692054660', '2001-12-23', 'Lake Destin', 1, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(2, '2023-7111', 'Kiehn', 'Keenan', 'monserrat18@example.net', '+16142604734', '1978-02-27', 'Wisozkfurt', 1, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(3, '2023-7027', 'Douglas', 'Shayne', 'wade.haley@example.net', '(570) 731-7521', '1999-11-03', 'Dorotheastad', 1, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(4, '2023-6910', 'Collins', 'Johanna', 'phyllis95@example.com', '(619) 896-8933', '2006-09-27', 'Muellerburgh', 1, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(5, '2023-6794', 'Wehner', 'Joyce', 'madalyn.will@example.com', '541-358-2792', '2005-05-25', 'Kuvalisfurt', 1, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(6, '2023-9615', 'Sanford', 'Orrin', 'adan.schneider@example.org', '(260) 941-5112', '1996-10-24', 'East Eve', 1, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(7, '2023-4829', 'Medhurst', 'Cecilia', 'lmueller@example.com', '469-332-8109', '2004-09-30', 'Dillanhaven', 1, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(8, '2023-4908', 'Wilkinson', 'Joanny', 'jarret28@example.com', '+1.585.314.5615', '1970-07-31', 'Port Pietromouth', 1, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(9, '2023-1816', 'Schoen', 'Floy', 'gerson.lynch@example.net', '+1.281.769.2562', '1984-10-16', 'East Mosesmouth', 1, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(10, '2023-3276', 'Lowe', 'Mikel', 'heather97@example.com', '660.329.4614', '1995-11-05', 'West Reidport', 1, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(11, '2023-4795', 'Christiansen', 'Ronaldo', 'bhoeger@example.org', '(703) 751-2397', '1994-10-07', 'Lake Ludie', 1, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(12, '2023-0589', 'Schuppe', 'Marc', 'audra.zulauf@example.org', '1-409-859-2931', '1996-08-13', 'East Cletatown', 1, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(13, '2023-2730', 'Schmidt', 'Adrain', 'jonatan85@example.org', '681.825.4048', '1972-02-19', 'Florinehaven', 1, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(14, '2023-8382', 'Hayes', 'Giovanni', 'karolann38@example.net', '660.704.9029', '1990-09-26', 'West Jackiestad', 1, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(15, '2023-2150', 'Senger', 'Asia', 'gottlieb.chelsey@example.com', '253-270-0527', '1981-03-10', 'Treutelshire', 1, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(16, '2023-2930', 'Leuschke', 'Alexane', 'broderick87@example.org', '1-940-278-5864', '1976-11-21', 'Lake Pattiestad', 1, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(17, '2023-0026', 'Waters', 'Kayli', 'macejkovic.adrianna@example.net', '(385) 747-9396', '1999-11-24', 'Pfannerstillview', 1, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(18, '2023-4734', 'Hudson', 'Jedediah', 'schuyler.buckridge@example.org', '1-320-235-0415', '1992-12-25', 'Lake Dylanshire', 1, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(19, '2023-1281', 'Farrell', 'Darian', 'mack78@example.com', '909.507.4710', '1985-01-01', 'New Felipe', 1, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(20, '2023-4622', 'White', 'Carole', 'gregorio99@example.com', '+1 (405) 550-6355', '1985-09-13', 'Denesikhaven', 1, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(21, '2023-1508', 'Robel', 'Jacques', 'grimes.raegan@example.org', '434-863-2107', '1971-07-25', 'West Sandra', 1, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(22, '2023-9613', 'Smith', 'Bartholome', 'blanche.gerlach@example.org', '1-903-495-7024', '2007-03-07', 'Dorothytown', 1, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(23, '2023-6374', 'Wolff', 'Dax', 'kirlin.clifton@example.com', '1-727-953-2064', '1979-01-26', 'Ferryland', 1, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(24, '2023-3670', 'Moen', 'Selena', 'jess.reichert@example.net', '479-886-3030', '1977-07-18', 'Rogahntown', 1, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(25, '2023-5706', 'Lemke', 'Dorothea', 'johnpaul.skiles@example.org', '(602) 942-1425', '1996-05-06', 'Forrestfort', 1, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(26, '2023-7787', 'Parker', 'Ivy', 'herminio57@example.org', '+1 (347) 750-6739', '1984-12-09', 'South Nelsonberg', 1, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(27, '2023-1907', 'Connelly', 'Wade', 'zthompson@example.net', '+15632257907', '1995-12-31', 'West Elizabeth', 1, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(28, '2023-3156', 'Hettinger', 'Rae', 'brannon.satterfield@example.com', '380.923.2914', '1985-06-30', 'East Brodericktown', 1, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(29, '2023-0331', 'Jacobson', 'Flavie', 'orval81@example.org', '+1.248.302.2473', '2001-03-30', 'West Tristonmouth', 1, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(30, '2023-6106', 'Hoeger', 'Esperanza', 'kendra08@example.org', '+1-262-618-0468', '1984-03-24', 'North Sylvia', 1, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(31, '2023-2920', 'Roob', 'Onie', 'rbarton@example.net', '+1 (878) 541-1712', '1984-09-29', 'East Nataliaville', 1, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(32, '2023-2972', 'Farrell', 'Brandi', 'abby05@example.org', '1-678-325-7331', '1992-01-12', 'Lake Nikitahaven', 1, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(33, '2023-7154', 'Keebler', 'Clement', 'myrna26@example.net', '+1.406.525.5297', '1996-08-14', 'Johnstown', 1, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(34, '2023-2565', 'Ebert', 'Barney', 'lkonopelski@example.net', '283-692-6929', '2002-11-27', 'East Khalid', 1, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(35, '2023-6620', 'Schmidt', 'Rubye', 'weston86@example.org', '+1-858-677-3447', '1970-07-26', 'Port Merl', 1, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(36, '2023-0234', 'Heidenreich', 'Nya', 'mcdermott.anderson@example.org', '+1 (385) 792-2110', '1989-10-09', 'Tayachester', 1, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(37, '2023-2448', 'Torp', 'Kennedi', 'jackson.ward@example.org', '682.306.6470', '1980-05-22', 'Jacobsshire', 1, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(38, '2023-1351', 'Larkin', 'Leonel', 'kertzmann.carlee@example.net', '(865) 885-1797', '2004-05-17', 'Hartmannborough', 1, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(39, '2023-9624', 'Ernser', 'Vilma', 'cartwright.jakob@example.net', '+1.731.789.5324', '1979-08-30', 'Purdyfurt', 1, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(40, '2023-3768', 'Miller', 'Kaia', 'psanford@example.com', '(714) 768-1392', '1978-03-21', 'Lake Imani', 1, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(41, '2023-0730', 'Crist', 'Christ', 'bashirian.chesley@example.com', '(402) 585-6892', '1979-11-23', 'Port Daniellaberg', 1, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(42, '2023-8007', 'Gerhold', 'Destany', 'icasper@example.com', '(808) 290-9145', '1985-02-16', 'North Yesseniaview', 1, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(43, '2023-7671', 'Kuhn', 'Glennie', 'dudley.batz@example.com', '628.546.2797', '1980-07-30', 'Camrenburgh', 1, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(44, '2023-4422', 'Rippin', 'Garth', 'eladio51@example.org', '(878) 935-2966', '1985-04-10', 'Mackenzieport', 1, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(45, '2023-9696', 'Graham', 'Alyce', 'andre27@example.net', '+1.864.716.2112', '1997-01-19', 'Markushaven', 1, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(46, '2023-5088', 'Steuber', 'Gage', 'edare@example.org', '385.458.6747', '1981-11-17', 'Michelstad', 1, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(47, '2023-6118', 'Borer', 'Roberto', 'katlynn18@example.org', '970.571.3135', '2000-05-04', 'Port Brett', 1, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(48, '2023-1605', 'Welch', 'Ignatius', 'eveline.schmidt@example.com', '1-480-752-4931', '1972-03-31', 'New Shyanneton', 1, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(49, '2023-6999', 'Hamill', 'Erick', 'mante.frieda@example.net', '351.312.6458', '2002-06-24', 'Damienton', 2, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(50, '2023-8265', 'Boyle', 'Vella', 'csenger@example.net', '(828) 791-3107', '2004-05-10', 'Jakubowskifort', 2, 'Master 1', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(51, '2023-4515', 'Parisian', 'Susan', 'anita.waters@example.net', '+1.828.495.3352', '1970-12-29', 'Leathamouth', 2, 'Master 1', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(52, '2023-1034', 'Hyatt', 'Arvel', 'cyrus02@example.com', '+18438846884', '1995-01-26', 'North Jessborough', 2, 'Master 1', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(53, '2023-6367', 'Streich', 'Brisa', 'romaguera.craig@example.com', '785.436.3575', '1985-12-25', 'Shanahanport', 2, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(54, '2023-2633', 'Mayert', 'Jayce', 'boyle.craig@example.net', '1-520-858-5292', '1994-03-20', 'Goyetteview', 2, 'Master 1', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(55, '2023-9832', 'Harvey', 'Sharon', 'luettgen.adrianna@example.com', '551.640.6847', '1981-05-21', 'Koelpinbury', 2, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(56, '2023-9947', 'Satterfield', 'Pattie', 'ubotsford@example.net', '+1-831-796-8709', '2001-06-13', 'Leuschkeview', 2, 'Master 1', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(57, '2023-7712', 'Hoeger', 'Bethel', 'rodrigo.schulist@example.net', '+1.325.739.9911', '1992-12-18', 'North Brendonborough', 2, 'Master 1', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(58, '2023-2700', 'Marvin', 'Philip', 'cbauch@example.net', '(320) 401-9466', '1995-06-13', 'Parkerfurt', 2, 'Master 1', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(59, '2023-7325', 'Roberts', 'Vivian', 'cbeahan@example.net', '469.367.4651', '1989-06-12', 'Skilesshire', 2, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(60, '2023-4853', 'Crona', 'Jaunita', 'cgleason@example.org', '+1-332-687-4020', '1980-10-20', 'Dejahstad', 2, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(61, '2023-9753', 'Fisher', 'Isom', 'pschultz@example.com', '443.503.6556', '1985-08-31', 'North Rasheedbury', 2, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(62, '2023-4395', 'Connelly', 'Karina', 'ubashirian@example.net', '(734) 462-0705', '1979-03-23', 'Vaughnbury', 2, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(63, '2023-3082', 'Goldner', 'Emerald', 'schulist.giovanna@example.com', '+1.262.385.6049', '1997-08-12', 'Cronafurt', 2, 'Master 1', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(64, '2023-9547', 'Marks', 'Marianne', 'nicholas.johnston@example.org', '231.590.3782', '1971-03-13', 'Reingerstad', 2, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(65, '2023-1998', 'O\'Conner', 'Fleta', 'teagan44@example.net', '260.930.7695', '1970-01-21', 'East Dorcas', 2, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(66, '2023-0663', 'Witting', 'Cierra', 'darrick.schaefer@example.com', '(740) 850-2080', '1972-05-25', 'East Trinity', 2, 'Master 1', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(67, '2023-0653', 'Reilly', 'Catherine', 'cpredovic@example.org', '936.357.2363', '2000-12-20', 'New Blaise', 2, 'Master 1', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(68, '2023-7912', 'Skiles', 'Norene', 'torphy.alene@example.com', '+19187565775', '1998-06-02', 'North Isai', 2, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(69, '2023-0996', 'Toy', 'Esmeralda', 'mdooley@example.com', '938-806-0757', '1971-05-08', 'West Terrencemouth', 2, 'Master 1', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(70, '2023-1680', 'Labadie', 'Jeromy', 'waters.verona@example.com', '662-593-8740', '1974-09-11', 'Port Alanna', 2, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(71, '2023-9592', 'Kuhn', 'Jammie', 'glittel@example.net', '234.976.3253', '1977-10-21', 'Bauchton', 2, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(72, '2023-4785', 'Abbott', 'Carrie', 'maegan27@example.org', '+1.231.567.8551', '2006-12-24', 'East Loraine', 2, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(73, '2023-4590', 'Strosin', 'Abner', 'jennie57@example.net', '(380) 337-4247', '1996-05-07', 'East Lowellbury', 2, 'Master 1', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(74, '2023-6846', 'Reilly', 'Beatrice', 'effertz.kari@example.org', '(276) 931-0862', '2005-05-27', 'Schneiderland', 2, 'Master 1', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(75, '2023-4657', 'Kunde', 'Jarrett', 'jillian.mante@example.net', '+19864954218', '2003-12-21', 'Elbertborough', 2, 'Master 1', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(76, '2023-1871', 'Bauch', 'Tobin', 'timothy.bartell@example.net', '(424) 561-9596', '1996-09-29', 'Mayestad', 2, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(77, '2023-2197', 'McKenzie', 'Nedra', 'jacynthe23@example.net', '520.788.9897', '2007-06-25', 'Steuberborough', 2, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(78, '2023-2446', 'Baumbach', 'Harold', 'aliya.metz@example.net', '+1-762-210-6798', '1971-04-12', 'South Clay', 2, 'Master 1', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(79, '2023-5767', 'Beatty', 'Summer', 'swift.claire@example.com', '615-633-3708', '1972-08-01', 'Jeromyburgh', 2, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(80, '2023-7300', 'Bosco', 'Jayda', 'june.weber@example.org', '(234) 714-3481', '2002-03-30', 'Lynchbury', 2, 'Master 1', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(81, '2023-9043', 'McCullough', 'Donato', 'xhettinger@example.net', '239-553-6789', '1976-11-25', 'Tiannaborough', 2, 'Master 1', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(82, '2023-0384', 'Hickle', 'Pauline', 'ikilback@example.org', '304.690.4218', '1971-09-15', 'Kutchchester', 2, 'Master 1', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(83, '2023-3318', 'Moore', 'Edwina', 'hgusikowski@example.net', '1-458-913-9954', '1982-11-26', 'Gulgowskiberg', 2, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(84, '2023-3482', 'Schroeder', 'Sasha', 'cheyenne.hermiston@example.net', '828-787-8619', '1979-07-02', 'Ronstad', 2, 'Master 1', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(85, '2023-1759', 'Hagenes', 'Emmett', 'rgreen@example.org', '(435) 821-9880', '2007-10-18', 'Annamariestad', 2, 'Master 1', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(86, '2023-0673', 'Shanahan', 'Mathew', 'heidenreich.lurline@example.org', '361.498.0538', '1992-12-24', 'Gusikowskiland', 2, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(87, '2023-9185', 'Cronin', 'Jared', 'goyette.renee@example.com', '+1 (561) 902-5969', '1990-04-24', 'Krajcikbury', 3, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(88, '2023-8795', 'VonRueden', 'Macie', 'wsawayn@example.net', '+1 (385) 515-9342', '1996-02-15', 'Jaedenville', 3, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(89, '2023-4041', 'Fadel', 'Giuseppe', 'kling.rita@example.org', '+18604968666', '1982-01-31', 'East Jackelineside', 3, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(90, '2023-4236', 'Monahan', 'Maria', 'deckow.augusta@example.com', '361-868-0578', '1972-12-02', 'East Clinton', 3, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(91, '2023-2444', 'Cremin', 'Ashtyn', 'ward.keegan@example.com', '+12312689854', '1987-04-06', 'Rauchester', 3, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(92, '2023-6801', 'Flatley', 'Fae', 'omertz@example.com', '1-302-553-1225', '1990-07-03', 'Wehnershire', 3, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(93, '2023-8076', 'D\'Amore', 'Marlene', 'aric.ritchie@example.com', '1-458-761-2507', '2003-06-29', 'Dinoport', 3, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(94, '2023-8540', 'Schulist', 'Janae', 'ajacobson@example.net', '325-209-0623', '1995-08-11', 'New Deion', 3, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(95, '2023-7286', 'Yost', 'Bill', 'rippin.sheridan@example.org', '+1-380-210-9909', '1986-07-19', 'North Ayanaville', 3, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(96, '2023-4014', 'Casper', 'Emelie', 'orn.libby@example.net', '586.254.9195', '2007-03-06', 'Auerfurt', 3, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(97, '2023-5213', 'Labadie', 'Casimir', 'taltenwerth@example.org', '704.261.2761', '1970-01-24', 'Hattieberg', 3, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(98, '2023-1475', 'Hoeger', 'Carolanne', 'brain33@example.org', '(918) 633-7307', '1988-01-23', 'West Newell', 3, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(99, '2023-4183', 'Hirthe', 'Camille', 'tschroeder@example.net', '1-586-994-1506', '2003-06-06', 'Hermanfort', 3, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(100, '2023-9268', 'Pollich', 'Meta', 'brandt.luettgen@example.org', '(815) 532-1221', '1997-10-21', 'New Bulahberg', 3, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(101, '2023-0051', 'Shields', 'Dameon', 'theresia.ruecker@example.net', '+18783241557', '2002-04-16', 'East Ethanmouth', 3, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(102, '2023-6043', 'Bechtelar', 'Alexys', 'jada.hill@example.net', '534.620.5098', '1972-12-21', 'Gislasonbury', 3, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(103, '2023-5471', 'Kuhic', 'Lizeth', 'rleffler@example.org', '(406) 213-4835', '1975-05-05', 'West Nellie', 3, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(104, '2023-9572', 'Bernier', 'Aurelia', 'leonel.kshlerin@example.net', '1-970-891-8792', '1981-03-15', 'Nikolausville', 3, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(105, '2023-3114', 'Simonis', 'Loy', 'williamson.rhett@example.net', '757.998.5298', '1988-12-16', 'Nikolausbury', 3, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(106, '2023-3503', 'Gislason', 'Ervin', 'uharris@example.net', '+14589481950', '1985-09-11', 'Janetstad', 3, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(107, '2023-9424', 'Wyman', 'Deshawn', 'jerod.boyle@example.net', '(302) 339-1885', '1987-01-01', 'West Destineymouth', 3, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(108, '2023-7576', 'Macejkovic', 'Retta', 'joanie.beier@example.net', '1-435-437-7956', '1999-09-20', 'Port Garettside', 3, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(109, '2023-0532', 'Ferry', 'Lyda', 'ziemann.kenya@example.net', '1-680-850-0966', '1995-06-06', 'North Imeldaside', 3, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(110, '2023-7177', 'Kub', 'Mervin', 'laurine.schaefer@example.net', '+1-518-714-4305', '2005-03-30', 'Stephanmouth', 3, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(111, '2023-4775', 'Dooley', 'Cayla', 'wnitzsche@example.net', '(239) 429-9010', '1973-01-24', 'Ziemebury', 3, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(112, '2023-0083', 'Wehner', 'Melyssa', 'welch.carolyne@example.net', '346.448.5369', '2002-08-27', 'New Bradleybury', 3, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(113, '2023-6545', 'Roob', 'Magali', 'paucek.brandt@example.org', '(341) 349-3044', '1998-09-04', 'Lake Sylvia', 3, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(114, '2023-1660', 'Rempel', 'Ara', 'torphy.adrienne@example.org', '+1-402-981-4216', '1990-01-12', 'Halville', 3, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(115, '2023-0838', 'Ritchie', 'Guiseppe', 'itzel26@example.org', '(304) 782-5296', '1992-06-18', 'Lake Sage', 3, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(116, '2023-4942', 'Witting', 'Mona', 'benjamin.osinski@example.org', '765.578.5073', '2005-02-28', 'O\'Reillyberg', 3, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(117, '2023-2534', 'Zieme', 'Malinda', 'cynthia.gusikowski@example.org', '+1 (484) 375-9942', '1970-02-02', 'Aydenmouth', 3, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(118, '2023-4354', 'Baumbach', 'Erling', 'goyette.benton@example.org', '689.590.5747', '1978-02-18', 'Harberland', 3, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(119, '2023-0590', 'Lehner', 'Junius', 'hoyt.heathcote@example.com', '779-333-6982', '1989-07-15', 'Sabrinaville', 3, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(120, '2023-3987', 'McDermott', 'Mary', 'daniella97@example.net', '1-815-416-5665', '1994-08-16', 'East Ryan', 3, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(121, '2023-0693', 'Goodwin', 'Virgie', 'sylvan85@example.com', '+1 (214) 764-8707', '2003-02-01', 'Corbinport', 3, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(122, '2023-1409', 'Wuckert', 'Anya', 'genesis68@example.net', '1-937-597-4290', '1978-02-16', 'South Jermainview', 3, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(123, '2023-9116', 'McKenzie', 'Junius', 'jacky28@example.com', '678-955-2581', '1992-12-05', 'Garthburgh', 3, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(124, '2023-7240', 'Conn', 'Eleazar', 'mbartoletti@example.net', '205-351-2897', '2006-07-05', 'West Demarcus', 3, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(125, '2023-0748', 'Lesch', 'Reece', 'eulah.ondricka@example.net', '+16672130227', '2001-05-24', 'Thalialand', 3, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(126, '2023-3229', 'Hansen', 'Joanny', 'rutherford.christopher@example.org', '628.932.5320', '1977-10-07', 'Cathrynberg', 4, 'Master 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(127, '2023-7460', 'Franecki', 'Lisette', 'tyson.bradtke@example.org', '+1-660-771-8072', '1999-07-03', 'New Martin', 4, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(128, '2023-8587', 'Lakin', 'Shanel', 'kbode@example.com', '+1-630-223-3957', '1998-05-22', 'West Katelynbury', 4, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(129, '2023-3261', 'Kunze', 'Jovani', 'nichole06@example.org', '+18134831427', '1983-08-26', 'Bartonland', 4, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(130, '2023-0832', 'Steuber', 'Emily', 'vicenta93@example.com', '1-445-680-5113', '1977-06-18', 'South Meghan', 4, 'Master 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(131, '2023-9307', 'Moore', 'Garrett', 'deon32@example.com', '786.695.8109', '1990-06-12', 'West Velda', 4, 'Master 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(132, '2023-1248', 'Marvin', 'Mya', 'hane.hayley@example.net', '434-315-1152', '2007-01-15', 'Franciscamouth', 4, 'Master 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(133, '2023-3970', 'Hill', 'Wilfrid', 'leuschke.lilly@example.net', '408.513.8504', '1977-01-12', 'Quintonborough', 4, 'Master 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(134, '2023-8176', 'Harvey', 'Glennie', 'feest.tatum@example.org', '(773) 314-0439', '1989-09-25', 'Wardbury', 4, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(135, '2023-1099', 'Feil', 'Jacinthe', 'deonte.stamm@example.org', '+1.229.874.2992', '1999-08-08', 'North Adele', 4, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(136, '2023-6438', 'Mayer', 'Wilhelmine', 'pfeffer.stacey@example.com', '+1-775-977-1977', '2003-08-08', 'Lindsayfort', 4, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(137, '2023-4065', 'Champlin', 'Kristian', 'jordi15@example.net', '1-478-832-1553', '1981-03-01', 'Port Deliamouth', 4, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(138, '2023-6435', 'Kunde', 'Ashlee', 'waldo34@example.com', '(469) 470-5375', '1984-08-05', 'Port Katheryn', 4, 'Master 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(139, '2023-9091', 'Rau', 'Cora', 'moen.anjali@example.org', '812.884.5745', '2007-01-24', 'Lyricside', 4, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(140, '2023-7944', 'Hackett', 'Angus', 'ricky.dubuque@example.net', '+1.616.936.6308', '1979-05-14', 'Hagenesside', 4, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(141, '2023-4985', 'Labadie', 'Amaya', 'serenity58@example.org', '+1-760-417-4338', '1975-02-16', 'Gloverport', 4, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(142, '2023-1138', 'Bins', 'Rosa', 'keeley23@example.com', '+1.810.376.5225', '1973-10-12', 'North Winfieldburgh', 4, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(143, '2023-2559', 'Mitchell', 'Kaycee', 'zstroman@example.com', '352-985-4381', '1998-08-31', 'Port Britney', 4, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(144, '2023-5163', 'Quigley', 'Elroy', 'nasir57@example.com', '+16088300306', '1990-06-21', 'Lake Lexiland', 4, 'Master 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(145, '2023-7577', 'Ratke', 'Darby', 'amie38@example.com', '(423) 295-4187', '1984-04-24', 'Terryhaven', 4, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(146, '2023-1200', 'Botsford', 'Darren', 'cummings.jakayla@example.org', '(269) 241-7866', '2003-02-23', 'West Giovannaland', 4, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(147, '2023-9284', 'Ritchie', 'Kamren', 'odell.bahringer@example.org', '+1.229.255.6653', '1992-11-24', 'Port Fidel', 4, 'Master 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(148, '2023-5943', 'Schaefer', 'Emely', 'leatha.jaskolski@example.net', '954.823.9613', '1997-09-26', 'Lailamouth', 4, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(149, '2023-2484', 'Keeling', 'Taryn', 'rgoyette@example.net', '(364) 443-0100', '1984-08-05', 'South Freidachester', 4, 'Master 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(150, '2023-8415', 'Brekke', 'Mayra', 'yost.catharine@example.org', '240-491-9183', '1970-09-04', 'Gilbertoview', 4, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(151, '2023-6051', 'Mann', 'Arvel', 'denesik.pat@example.org', '+1-618-870-7369', '1993-09-01', 'New Alyson', 4, 'Master 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(152, '2023-8973', 'Upton', 'Joel', 'lemke.obie@example.com', '+1-223-945-9499', '1970-11-29', 'Hayesmouth', 4, 'Master 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(153, '2023-4671', 'Wuckert', 'Dalton', 'mattie83@example.net', '402.268.6689', '2000-10-03', 'Heavenhaven', 4, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(154, '2023-6580', 'Zulauf', 'Lafayette', 'alyce.leffler@example.com', '(458) 963-0332', '2005-10-11', 'Stantonberg', 4, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(155, '2023-1075', 'Rodriguez', 'Clarissa', 'langworth.kattie@example.com', '518.321.5732', '2005-07-09', 'Dagmarshire', 4, 'Master 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(156, '2023-1276', 'Denesik', 'Blanca', 'gavin17@example.com', '1-718-670-9185', '1999-10-22', 'Arnulfohaven', 4, 'Master 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(157, '2023-8918', 'Murray', 'Romaine', 'eliseo67@example.net', '+1.650.653.3511', '2001-09-13', 'Berniceland', 4, 'Master 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(158, '2023-8829', 'Becker', 'Jerrold', 'langosh.albert@example.net', '517-286-0208', '1977-03-18', 'Romagueraport', 4, 'Master 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(159, '2023-7523', 'Hintz', 'Tavares', 'jeffry07@example.net', '+1-951-995-2786', '1985-06-14', 'Taliamouth', 4, 'Master 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(160, '2023-6287', 'Gleason', 'Cora', 'molly.fisher@example.net', '+1-717-733-3543', '1981-06-18', 'North Kali', 4, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(161, '2023-3552', 'Dooley', 'Sterling', 'yhagenes@example.org', '(640) 690-2952', '1996-09-05', 'Ortizfurt', 4, 'Master 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(162, '2023-6754', 'Ondricka', 'Alejandrin', 'daugherty.britney@example.org', '+1-678-992-6985', '2006-10-07', 'Hansentown', 4, 'Master 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(163, '2023-8673', 'Smith', 'Lillian', 'kling.marta@example.org', '+1-863-826-3565', '1984-08-10', 'New Jermainebury', 4, 'Master 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(164, '2023-4817', 'Doyle', 'Fannie', 'solon.moore@example.org', '(646) 318-5132', '1979-06-08', 'South Hugh', 5, 'Licence 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(165, '2023-5882', 'Schimmel', 'Vernie', 'plindgren@example.com', '(814) 719-6715', '1984-09-04', 'Cordeliahaven', 5, 'Licence 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(166, '2023-3418', 'McGlynn', 'Alba', 'maia.hahn@example.org', '+1-678-799-8759', '1984-08-24', 'Candidoborough', 5, 'Licence 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(167, '2023-8494', 'Kirlin', 'Percival', 'stella92@example.com', '1-540-397-3204', '1981-07-05', 'Soledadfurt', 5, 'Licence 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(168, '2023-4047', 'Swift', 'Cary', 'marvin.dale@example.org', '(252) 203-3371', '1986-10-16', 'Lake Zander', 5, 'Licence 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(169, '2023-1566', 'Daugherty', 'Sierra', 'williamson.loma@example.org', '1-270-881-3281', '2002-02-10', 'Lake Jodiestad', 5, 'Licence 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(170, '2023-0493', 'Parker', 'Mekhi', 'mmills@example.org', '816-828-5827', '1973-10-23', 'New Marilouchester', 5, 'Licence 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(171, '2023-3626', 'Adams', 'Desiree', 'sroberts@example.org', '956-726-4613', '1972-07-08', 'Madonnaville', 5, 'Licence 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(172, '2023-4174', 'Donnelly', 'Nat', 'pconroy@example.com', '(586) 795-8243', '2003-04-08', 'East Dorothy', 5, 'Licence 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(173, '2023-3998', 'Moen', 'Karley', 'alia16@example.com', '(351) 664-0869', '2001-03-30', 'Caspermouth', 5, 'Licence 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(174, '2023-8665', 'Halvorson', 'Jayden', 'vida62@example.net', '1-816-389-6133', '1983-11-30', 'New Meggie', 5, 'Licence 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(175, '2023-7495', 'Grimes', 'Napoleon', 'glenna33@example.com', '+1-715-858-8842', '1982-03-30', 'Hamillbury', 5, 'Licence 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(176, '2023-3882', 'Ernser', 'Candace', 'kaela.keebler@example.net', '+1-309-301-0688', '1986-02-14', 'West Oleta', 5, 'Licence 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(177, '2023-4598', 'Padberg', 'Leo', 'hgottlieb@example.com', '+1 (978) 536-7675', '1975-07-09', 'Medhurstchester', 5, 'Licence 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(178, '2023-4281', 'Rippin', 'Jameson', 'eda96@example.org', '+18489561078', '1979-08-07', 'North Javierburgh', 5, 'Licence 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(179, '2023-7884', 'Bauch', 'Norberto', 'nikolas.osinski@example.com', '+14027958670', '1988-10-14', 'Rogahnmouth', 5, 'Licence 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(180, '2023-2883', 'Blanda', 'Genesis', 'mstroman@example.com', '+1-515-498-4343', '1978-11-21', 'West Lance', 5, 'Licence 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(181, '2023-7623', 'Williamson', 'Jefferey', 'hsawayn@example.org', '1-563-201-0595', '1975-12-25', 'West Maximo', 5, 'Licence 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(182, '2023-1897', 'Willms', 'Orlando', 'casey.reynolds@example.net', '(380) 205-3519', '1986-11-06', 'Alexandrineville', 5, 'Licence 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(183, '2023-7076', 'Hettinger', 'Jayme', 'mireille.bayer@example.com', '+12142124630', '1980-06-29', 'Lake Alexland', 5, 'Licence 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(184, '2023-2901', 'Luettgen', 'Larry', 'ashleigh.harris@example.org', '+1 (352) 910-2909', '1982-02-05', 'Lake Britneymouth', 5, 'Licence 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(185, '2023-5918', 'Fay', 'John', 'mavis.bosco@example.com', '(607) 666-5164', '2003-04-08', 'Blancaburgh', 5, 'Licence 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(186, '2023-4718', 'Becker', 'Birdie', 'barton.arden@example.net', '+1 (641) 940-5606', '1991-06-21', 'Port Verliemouth', 5, 'Licence 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(187, '2023-5118', 'Gulgowski', 'Cornell', 'emmerich.ettie@example.org', '864.480.1675', '2001-09-30', 'Alexandriaside', 5, 'Licence 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(188, '2023-8600', 'Anderson', 'Chanelle', 'satterfield.jonathan@example.org', '+1.419.700.1798', '1981-06-21', 'New Dylanton', 5, 'Licence 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(189, '2023-1011', 'Oberbrunner', 'Jennie', 'rodolfo71@example.net', '(424) 597-3312', '1983-10-09', 'East Osborne', 5, 'Licence 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(190, '2023-3611', 'Mertz', 'Johathan', 'qkemmer@example.net', '+1-561-471-8480', '2003-08-15', 'Nestorport', 5, 'Licence 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(191, '2023-1294', 'Nienow', 'Gail', 'wfarrell@example.com', '+1-585-886-5390', '1983-08-16', 'Sipesville', 5, 'Licence 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(192, '2023-9668', 'Heathcote', 'Michale', 'labadie.maye@example.org', '(325) 678-8683', '1970-05-04', 'Vladimirstad', 5, 'Licence 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(193, '2023-3659', 'Flatley', 'Kristin', 'prosacco.hazel@example.net', '838-433-5652', '1980-01-29', 'South Lavinachester', 5, 'Licence 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(194, '2023-9673', 'Pouros', 'Chelsie', 'lueilwitz.fausto@example.org', '+1-351-656-9832', '2006-08-15', 'South Adella', 5, 'Licence 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(195, '2023-5100', 'Bernhard', 'Sven', 'sarina.lesch@example.org', '1-209-908-9232', '1998-03-31', 'Geovanyhaven', 5, 'Licence 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(196, '2023-4597', 'Rau', 'Santino', 'leffler.hillard@example.org', '+1 (469) 482-8769', '1988-10-15', 'Jaceburgh', 5, 'Licence 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(197, '2023-6459', 'Becker', 'Zelda', 'blanda.natalia@example.com', '+1-323-373-2205', '2002-03-15', 'Dillonport', 5, 'Licence 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(198, '2023-3300', 'Marvin', 'Lane', 'sarai53@example.net', '+1-347-684-3713', '1983-03-28', 'Chrisberg', 5, 'Licence 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(199, '2023-2041', 'Wuckert', 'Carli', 'shayne.upton@example.net', '507.700.6033', '1995-07-12', 'Lake Shaniya', 5, 'Licence 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(200, '2023-4347', 'Strosin', 'Felicita', 'larue52@example.com', '573.287.7682', '1976-03-28', 'North Aurore', 5, 'Licence 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(201, '2023-5533', 'Berge', 'Conner', 'williamson.alena@example.org', '224-228-7178', '1976-04-09', 'Zacheryberg', 5, 'Licence 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(202, '2023-0471', 'Emmerich', 'Orin', 'friesen.tomas@example.org', '+16403427027', '1983-07-06', 'North John', 5, 'Licence 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(203, '2023-4986', 'Harvey', 'Tremayne', 'paucek.javon@example.com', '281.589.4898', '1982-04-21', 'South Bettie', 5, 'Licence 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(204, '2023-2073', 'Olson', 'Stewart', 'dawn19@example.org', '+1 (539) 361-8837', '1993-12-29', 'South Lucious', 5, 'Licence 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(205, '2023-4327', 'Langosh', 'Harley', 'qnitzsche@example.net', '+1 (269) 699-4503', '1991-06-16', 'Lake Saraibury', 5, 'Licence 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(206, '2023-7885', 'Hettinger', 'Hayley', 'jazmyne.bauch@example.net', '+1.985.585.6961', '1977-02-10', 'East Lonzo', 5, 'Licence 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(207, '2023-3058', 'Hermann', 'Kaci', 'allene.shields@example.net', '415-870-1339', '1979-09-04', 'Botsfordstad', 6, 'Master 1', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(208, '2023-2253', 'Purdy', 'Mollie', 'qgleichner@example.net', '219-919-4166', '1990-12-23', 'North Alenetown', 6, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(209, '2023-0008', 'Beahan', 'Heath', 'charlene68@example.net', '(507) 672-1532', '2004-04-24', 'Cullenfort', 6, 'Master 1', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(210, '2023-0059', 'Schoen', 'Joanne', 'verlie31@example.net', '(360) 994-1233', '1972-02-04', 'West Clementinemouth', 6, 'Master 1', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(211, '2023-2686', 'Corwin', 'Gerry', 'isidro.luettgen@example.com', '+1-239-634-0306', '1994-07-01', 'West Darwinchester', 6, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(212, '2023-2577', 'Leuschke', 'Bryon', 'mfarrell@example.com', '325.744.9295', '2007-03-22', 'South Johnson', 6, 'Master 1', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(213, '2023-2186', 'Bauch', 'Jake', 'wunsch.myrtis@example.com', '573-277-8401', '1970-11-05', 'Morissetteside', 6, 'Master 1', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(214, '2023-0765', 'Greenholt', 'Norma', 'arlie31@example.net', '+1-906-681-4139', '1981-05-10', 'D\'Amoreburgh', 6, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(215, '2023-7295', 'Kshlerin', 'Marcellus', 'johnson.berry@example.org', '+17433411289', '1992-01-22', 'Kristinfurt', 6, 'Master 1', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(216, '2023-8824', 'Maggio', 'Dortha', 'hoconnell@example.com', '+1.516.400.7814', '1973-02-05', 'West Ada', 6, 'Master 1', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(217, '2023-7760', 'Halvorson', 'Leola', 'talon.mccullough@example.org', '(818) 790-0688', '1981-11-04', 'East Kiramouth', 6, 'Master 1', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(218, '2023-5223', 'Pagac', 'Landen', 'madyson49@example.org', '1-918-786-4621', '1983-05-27', 'Zemlakstad', 6, 'Master 1', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(219, '2023-4317', 'Von', 'Rod', 'fritz17@example.com', '317-575-3933', '1977-08-28', 'Batzbury', 6, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(220, '2023-0301', 'King', 'Jovani', 'jbosco@example.org', '(667) 615-1798', '1997-03-10', 'East Hansfurt', 6, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(221, '2023-1232', 'Collins', 'Bennett', 'colleen54@example.net', '339.465.0381', '1996-06-26', 'East Alexa', 6, 'Master 1', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(222, '2023-2543', 'Hammes', 'Kara', 'wilderman.bernard@example.org', '1-830-750-5328', '1991-05-19', 'Kuhicfurt', 6, 'Master 1', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(223, '2023-3158', 'Steuber', 'Pasquale', 'oswald.bergstrom@example.com', '1-770-280-4637', '1995-07-01', 'East Napoleonfurt', 6, 'Master 1', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(224, '2023-4002', 'Feest', 'Nicola', 'thomas81@example.com', '1-914-390-3343', '1990-10-31', 'Rozellafurt', 6, 'Master 1', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(225, '2023-7512', 'Pacocha', 'Daron', 'kuphal.nella@example.org', '+16173297576', '1974-11-11', 'North Cleoratown', 6, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(226, '2023-5912', 'Spencer', 'Marisa', 'qmccullough@example.net', '+1.858.573.2760', '1986-09-06', 'Damonland', 6, 'Master 1', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(227, '2023-8089', 'Kuhic', 'Layla', 'mturner@example.com', '+1 (865) 774-2247', '1988-03-11', 'Masonview', 6, 'Master 1', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(228, '2023-9461', 'Rowe', 'Declan', 'qjast@example.com', '+19406929247', '1989-04-22', 'South Jaylonhaven', 6, 'Master 1', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(229, '2023-9880', 'Terry', 'Sam', 'kayden69@example.net', '+1 (361) 564-8459', '1985-03-07', 'West Naomibury', 6, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(230, '2023-8348', 'Bechtelar', 'Hilton', 'dietrich.eladio@example.net', '(757) 488-9781', '1995-03-07', 'West Angelicafurt', 6, 'Master 1', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(231, '2023-2823', 'Funk', 'Forrest', 'stevie66@example.net', '1-503-516-7528', '1995-09-18', 'Thielstad', 6, 'Master 1', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(232, '2023-6227', 'Feeney', 'Malcolm', 'ryan.gust@example.net', '737-976-1924', '2004-01-07', 'East Shaina', 6, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(233, '2023-5438', 'Heidenreich', 'Shemar', 'aron81@example.org', '+1-785-627-4030', '1974-11-24', 'Frederickstad', 6, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(234, '2023-1552', 'Bartoletti', 'Eino', 'welch.haven@example.com', '925.795.4133', '1978-10-20', 'Rennerview', 6, 'Master 1', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(235, '2023-0303', 'Quitzon', 'Brock', 'lafayette21@example.com', '+1.248.654.9051', '1977-06-02', 'South Llewellyn', 6, 'Master 1', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(236, '2023-1683', 'Ernser', 'Maxwell', 'htrantow@example.com', '281-230-7719', '1978-02-25', 'North Name', 6, 'Master 1', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(237, '2023-0031', 'Larson', 'Cleta', 'zula.wolf@example.com', '(970) 516-8421', '1989-01-23', 'Faheyport', 6, 'Master 1', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(238, '2023-7604', 'Hane', 'Hank', 'missouri14@example.org', '+1-832-262-1030', '1974-04-26', 'Heathcoteside', 6, 'Master 1', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(239, '2023-7961', 'Kreiger', 'Dejah', 'nleannon@example.net', '1-317-545-9242', '2001-02-25', 'Turcotteborough', 6, 'Master 1', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(240, '2023-5350', 'Johnson', 'Carroll', 'maeve74@example.org', '678-596-0199', '1972-10-01', 'Lake Darrelltown', 7, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(241, '2023-2212', 'Lowe', 'Bernadette', 'alice.lindgren@example.com', '+1 (954) 225-2912', '1998-12-09', 'Rueckermouth', 7, 'Master 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(242, '2023-2346', 'Moen', 'Abelardo', 'verla53@example.net', '785.721.6834', '1977-09-29', 'New Josiahview', 7, 'Master 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(243, '2023-8178', 'Effertz', 'Madilyn', 'andreane.armstrong@example.org', '+1 (831) 833-6284', '1978-08-18', 'North Constance', 7, 'Master 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(244, '2023-7212', 'Cruickshank', 'Alden', 'ydach@example.com', '+1 (612) 882-0334', '2006-08-13', 'Lubowitzland', 7, 'Master 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(245, '2023-4579', 'Tillman', 'Lance', 'nyah.mayer@example.com', '443.745.4632', '2007-04-13', 'Kertzmannchester', 7, 'Master 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(246, '2023-3942', 'Botsford', 'Garret', 'cbartell@example.com', '1-661-295-7410', '2004-10-25', 'Thompsonburgh', 7, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(247, '2023-6373', 'Lueilwitz', 'Allene', 'alex.schinner@example.com', '1-469-651-3224', '1990-07-21', 'Maudland', 7, 'Master 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(248, '2023-5991', 'Kautzer', 'Grover', 'okeefe.franz@example.org', '928.738.9174', '2000-09-05', 'Elizabethfort', 7, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(249, '2023-4713', 'Schneider', 'Ernesto', 'mekhi21@example.com', '(475) 504-3090', '1977-01-26', 'Lake Gerald', 7, 'Master 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(250, '2023-8731', 'Schulist', 'Madisyn', 'oconnell.elmore@example.org', '(463) 517-8312', '1975-03-26', 'Giovanifort', 7, 'Master 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(251, '2023-5859', 'Lindgren', 'Telly', 'buck34@example.com', '1-909-933-4668', '1970-01-16', 'Edmundport', 7, 'Master 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(252, '2023-6881', 'Bayer', 'Leatha', 'kub.ashtyn@example.org', '+1-458-922-3291', '1973-03-13', 'Lake Kamille', 7, 'Master 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(253, '2023-5673', 'Rutherford', 'Itzel', 'orion.olson@example.com', '(949) 931-3070', '1972-08-27', 'West Maribelberg', 7, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(254, '2023-1978', 'Hagenes', 'Jedidiah', 'rosina.wyman@example.net', '+1.419.473.1198', '1992-09-19', 'Malcolmborough', 7, 'Master 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(255, '2023-5649', 'Donnelly', 'Jane', 'cullen23@example.net', '+1-928-654-1538', '1978-01-25', 'New Jodyberg', 7, 'Master 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(256, '2023-4645', 'Willms', 'Bernadine', 'aaron.halvorson@example.net', '929-500-8531', '1973-05-10', 'Kingtown', 7, 'Master 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL);
INSERT INTO `etudiants` (`id`, `matricule`, `nom`, `prenom`, `email`, `telephone`, `date_naissance`, `lieu_naissance`, `filiere_id`, `niveau`, `groupe`, `photo_url`, `actif`, `created_at`, `updated_at`, `deleted_at`) VALUES
(257, '2023-8236', 'Goyette', 'Brian', 'botsford.forrest@example.net', '1-858-799-3663', '2001-07-08', 'Lake Gretchenhaven', 7, 'Master 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(258, '2023-0911', 'Toy', 'Agnes', 'cwilkinson@example.org', '+1 (970) 237-2076', '1976-05-28', 'Dietrichport', 7, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(259, '2023-9849', 'Hettinger', 'Amiya', 'hodkiewicz.emma@example.com', '(585) 846-5077', '1976-03-11', 'Lake Dorothymouth', 7, 'Master 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(260, '2023-2464', 'Metz', 'Emmet', 'tod.luettgen@example.net', '1-414-343-0884', '1980-02-04', 'Marquardttown', 7, 'Master 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(261, '2023-1260', 'Morar', 'Carley', 'arnold.thompson@example.org', '470-443-6792', '1979-11-12', 'West Sheila', 7, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(262, '2023-4118', 'Hessel', 'Gaetano', 'habshire@example.org', '938-920-3804', '1993-06-06', 'Port Ludieview', 7, 'Master 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(263, '2023-0011', 'Heidenreich', 'Perry', 'hettie.blanda@example.org', '+1.914.520.1354', '2007-03-09', 'North Lamar', 7, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(264, '2023-3262', 'O\'Kon', 'Cordelia', 'devin44@example.com', '(743) 776-1535', '1976-03-30', 'South Clevetown', 7, 'Master 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(265, '2023-6208', 'Schulist', 'Donna', 'angelica46@example.org', '+1-603-790-1293', '1994-01-25', 'Bashirianbury', 7, 'Master 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(266, '2023-5054', 'Lesch', 'Khalil', 'schaden.rosalyn@example.net', '+14636457403', '2007-02-19', 'Lake Emiliaville', 7, 'Master 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(267, '2023-6908', 'Reynolds', 'Zola', 'carmen50@example.net', '678-270-5427', '1999-08-29', 'Lake Muhammad', 7, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(268, '2023-6520', 'Boyle', 'Stephany', 'walter.alvina@example.com', '(458) 659-3961', '1998-02-16', 'New Dandremouth', 7, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(269, '2023-3885', 'Brown', 'Bradford', 'jaskolski.guadalupe@example.org', '+18325518947', '1991-12-01', 'Aimeeville', 7, 'Master 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(270, '2023-9925', 'Stoltenberg', 'Nico', 'amie.block@example.org', '+1.843.618.6662', '1997-09-19', 'Schmittbury', 7, 'Master 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(271, '2023-9428', 'Crooks', 'Tyler', 'condricka@example.org', '(480) 459-7086', '2004-11-04', 'Lillyborough', 7, 'Master 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(272, '2023-5758', 'Lemke', 'Darrell', 'jaskolski.jacey@example.com', '478-549-2347', '1979-08-10', 'Sedrickberg', 7, 'Master 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(273, '2023-1424', 'Koss', 'Ignacio', 'sienna05@example.net', '+1.650.840.5241', '1981-10-01', 'Port Alyce', 7, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(274, '2023-2899', 'McKenzie', 'Noelia', 'roberts.salma@example.org', '352.721.6563', '1990-09-11', 'Eloisaview', 7, 'Master 2', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(275, '2023-1323', 'Sanford', 'Arden', 'josefa44@example.com', '(269) 751-6359', '1973-03-10', 'Lake Kallie', 7, 'Master 2', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(276, '2023-4430', 'Mayert', 'Cydney', 'rafaela.gusikowski@example.org', '(773) 682-0740', '1989-08-26', 'South Lonzo', 7, 'Master 2', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(277, '2023-1192', 'Davis', 'Jackeline', 'flossie.emard@example.com', '+1-940-380-8692', '1985-02-19', 'Bernieceberg', 8, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(278, '2023-6537', 'Crooks', 'Melody', 'kendrick.emmerich@example.org', '+1-531-303-9970', '1976-12-15', 'Port Myah', 8, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(279, '2023-0671', 'Hudson', 'Citlalli', 'efren.cole@example.net', '803.593.0685', '1989-02-05', 'Derrickstad', 8, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(280, '2023-3833', 'Kreiger', 'Florida', 'schuppe.zoe@example.net', '+1-959-877-4720', '2006-09-22', 'Eulamouth', 8, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(281, '2023-9416', 'Ziemann', 'Claud', 'may86@example.com', '+1-321-293-7954', '2004-01-07', 'Martyhaven', 8, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(282, '2023-4778', 'Wunsch', 'Montana', 'valerie.bernier@example.com', '352.313.6807', '1983-12-12', 'Kailynhaven', 8, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(283, '2023-7089', 'Turner', 'Ari', 'shad87@example.com', '928.256.3503', '1986-12-19', 'Port Erniebury', 8, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(284, '2023-9536', 'Wolf', 'Nathanael', 'cfeest@example.net', '1-508-391-4397', '1998-04-20', 'Rigobertohaven', 8, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(285, '2023-2469', 'Hintz', 'Oran', 'sincere83@example.org', '(801) 529-4354', '1997-06-03', 'Port Triston', 8, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(286, '2023-5062', 'Toy', 'Clovis', 'kianna.zieme@example.org', '+1.913.631.6819', '2004-02-19', 'East Dalebury', 8, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(287, '2023-2708', 'Koepp', 'Percy', 'gblanda@example.org', '1-614-325-2499', '1998-06-03', 'Mohrborough', 8, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(288, '2023-5735', 'Stamm', 'Electa', 'addie.conroy@example.net', '(912) 439-5665', '1972-03-16', 'Hollisville', 8, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(289, '2023-1071', 'Fisher', 'Mason', 'svandervort@example.net', '+1.205.450.3797', '1977-08-09', 'Maggioville', 8, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(290, '2023-9383', 'Larkin', 'Adrianna', 'rfriesen@example.com', '1-916-215-8338', '2003-03-16', 'Wittingberg', 8, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(291, '2023-9297', 'Hamill', 'Bo', 'pearl.goldner@example.net', '251.847.3295', '1994-06-05', 'West Terrymouth', 8, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(292, '2023-6462', 'Brown', 'Dawn', 'nickolas18@example.net', '(562) 619-6113', '1995-02-25', 'Brannonbury', 8, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(293, '2023-4626', 'Turcotte', 'Shanelle', 'jtorp@example.com', '1-470-842-3006', '1973-12-25', 'New Dayna', 8, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(294, '2023-9088', 'Wisoky', 'Greg', 'kaia60@example.net', '281-243-7817', '1972-05-03', 'North Benjaminmouth', 8, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(295, '2023-6055', 'Cremin', 'Jazlyn', 'srenner@example.com', '985.889.4692', '1974-10-27', 'East Rahsaanmouth', 8, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(296, '2023-0329', 'Dietrich', 'Carter', 'arice@example.net', '443.601.8946', '2006-02-02', 'Mertzview', 8, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(297, '2023-4863', 'Friesen', 'Philip', 'zbode@example.com', '1-530-965-7748', '1999-04-21', 'Gleichnerstad', 8, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(298, '2023-5376', 'Miller', 'Emil', 'ahickle@example.com', '+1-518-607-5280', '1995-11-05', 'East Clemens', 8, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(299, '2023-6670', 'Will', 'Christina', 'boyle.lonnie@example.org', '1-484-521-7916', '1990-01-30', 'Bettyefurt', 8, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(300, '2023-1775', 'Mills', 'Aidan', 'thompson.tyree@example.com', '786.258.7958', '1995-12-05', 'Mitchelborough', 8, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(301, '2023-3851', 'Weissnat', 'Mervin', 'konopelski.elisa@example.com', '(325) 379-7038', '1991-04-12', 'Port Haylieberg', 8, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(302, '2023-3370', 'Rolfson', 'Alvena', 'afritsch@example.com', '+17749388011', '2001-11-06', 'Kiehnmouth', 8, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(303, '2023-2393', 'Prohaska', 'Olen', 'kshlerin.tanya@example.org', '+1-854-802-2724', '2007-07-09', 'Lourdesbury', 8, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(304, '2023-6482', 'Bartoletti', 'Neil', 'fhodkiewicz@example.net', '+17272154082', '1972-04-27', 'Halvorsontown', 8, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(305, '2023-4089', 'Denesik', 'Ricky', 'trevor.feil@example.com', '512.973.8779', '1972-09-04', 'Lake Columbus', 8, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(306, '2023-1965', 'Kovacek', 'Jeramy', 'wkuhic@example.org', '832.267.7512', '1995-11-05', 'South Brandymouth', 8, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(307, '2023-7297', 'Dibbert', 'Esther', 'vmarks@example.net', '517.627.2151', '1986-12-29', 'South Iliana', 8, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(308, '2023-1403', 'Beer', 'Karley', 'franecki.kellen@example.com', '(906) 858-7399', '2006-09-04', 'Willmsfort', 8, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(309, '2023-6463', 'Greenfelder', 'Arjun', 'watson.simonis@example.net', '+1-731-271-7122', '1983-12-16', 'New Wilma', 8, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(310, '2023-5691', 'Carter', 'Jett', 'crawford.marvin@example.org', '(380) 443-6315', '1996-06-10', 'South Daishaville', 8, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(311, '2023-6533', 'Grant', 'Domenick', 'zora.welch@example.net', '+1-574-487-5843', '2002-09-13', 'Auerport', 8, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(312, '2023-8216', 'Beer', 'Jermey', 'raheem.fadel@example.net', '1-850-755-7812', '1995-04-17', 'Jillianhaven', 8, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(313, '2023-7350', 'Carter', 'Bradley', 'laverna28@example.com', '+1.612.267.6914', '1988-11-20', 'New Neha', 8, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(314, '2023-9893', 'King', 'Grace', 'trudie.abbott@example.net', '570.753.9813', '2002-12-26', 'Tamaraside', 8, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(315, '2023-1620', 'Conroy', 'Marjolaine', 'adela.berge@example.org', '+1-347-687-4933', '1977-12-17', 'Hermanberg', 8, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(316, '2023-2240', 'Heathcote', 'Angeline', 'einar33@example.org', '+1-580-973-5921', '1985-08-18', 'East Mohammad', 8, 'Licence 3', 'B', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(317, '2023-2379', 'Mayer', 'Destini', 'makayla05@example.com', '318-501-1870', '1971-11-11', 'Kayleemouth', 8, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(318, '2023-8497', 'Turcotte', 'Abdiel', 'gibson.aglae@example.net', '(786) 250-2475', '2005-08-07', 'Heloiseshire', 8, 'Licence 3', 'A', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(319, '2023-0928', 'Koss', 'Dominic', 'robel.gregory@example.org', '(570) 566-1241', '1997-09-29', 'North Keegan', 8, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL),
(320, '2023-4178', 'Kilback', 'Christy', 'mikel.miller@example.org', '(513) 842-9614', '1973-02-08', 'Noemyfurt', 8, 'Licence 3', 'C', NULL, 1, '2025-12-29 17:35:21', '2025-12-29 17:35:21', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `exports`
--

CREATE TABLE `exports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type_document` varchar(255) NOT NULL,
  `format` varchar(255) NOT NULL,
  `nom_fichier` varchar(255) NOT NULL,
  `chemin` varchar(255) NOT NULL,
  `parametres` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`parametres`)),
  `taille` int(11) DEFAULT NULL,
  `nb_telechargementsƒ` int(11) NOT NULL DEFAULT 0,
  `expire_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `feuilles_notes`
--

CREATE TABLE `feuilles_notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `importation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fichier_importe_id` bigint(20) UNSIGNED DEFAULT NULL,
  `enseignant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `annee_academique_id` bigint(20) UNSIGNED DEFAULT NULL,
  `statut` varchar(255) NOT NULL DEFAULT 'brouillon',
  `date_examen` date DEFAULT NULL,
  `type_evaluation` varchar(255) DEFAULT NULL,
  `remarques` text DEFAULT NULL,
  `soumis_at` timestamp NULL DEFAULT NULL,
  `valide_at` timestamp NULL DEFAULT NULL,
  `validateur_id` bigint(20) UNSIGNED DEFAULT NULL,
  `verrouille_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fichiers_importes`
--

CREATE TABLE `fichiers_importes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `importation_id` bigint(20) UNSIGNED NOT NULL,
  `nom_original` varchar(255) NOT NULL,
  `nom_stockage` varchar(255) NOT NULL,
  `chemin` varchar(255) NOT NULL,
  `type_mime` varchar(255) NOT NULL,
  `taille` int(11) NOT NULL,
  `ocr_traite` tinyint(1) NOT NULL DEFAULT 0,
  `ocr_resultat` text DEFAULT NULL,
  `ocr_confiance` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `filieres`
--

CREATE TABLE `filieres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `niveau` varchar(50) NOT NULL,
  `departement_id` bigint(20) UNSIGNED NOT NULL,
  `chef_id` bigint(20) UNSIGNED DEFAULT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `filieres`
--

INSERT INTO `filieres` (`id`, `code`, `nom`, `description`, `niveau`, `departement_id`, `chef_id`, `actif`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'GL', 'Génie Logiciel', 'Formation en développement logiciel et ingénierie des systèmes', 'Licence 3', 1, 4, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(2, 'BD', 'Big Data & Intelligence Artificielle', 'Science des données et apprentissage automatique', 'Master 1', 1, NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(3, 'RT', 'Réseaux & Télécommunications', 'Infrastructure réseau et systèmes de communication', 'Licence 3', 1, NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(4, 'SE', 'Systèmes Embarqués', 'Informatique embarquée et IoT', 'Master 2', 1, NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(5, 'MA', 'Mathématiques Appliquées', 'Modélisation mathématique et calcul scientifique', 'Licence 2', 2, NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(6, 'STAT', 'Statistiques & Data Science', 'Analyse statistique et science des données', 'Master 1', 2, NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(7, 'PH', 'Physique Fondamentale', 'Mécanique quantique et physique des particules', 'Master 2', 3, NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(8, 'PM', 'Physique des Matériaux', 'Science des matériaux et nanotechnologies', 'Licence 3', 3, NULL, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `historique_validations`
--

CREATE TABLE `historique_validations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feuille_note_id` bigint(20) UNSIGNED DEFAULT NULL,
  `note_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `valeur_avant` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`valeur_avant`)),
  `valeur_apres` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`valeur_apres`)),
  `ip_address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `importations`
--

CREATE TABLE `importations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `annee_academique_id` bigint(20) UNSIGNED DEFAULT NULL,
  `module_id` bigint(20) UNSIGNED DEFAULT NULL,
  `filiere_id` bigint(20) UNSIGNED DEFAULT NULL,
  `semestre_id` bigint(20) UNSIGNED DEFAULT NULL,
  `statut` varchar(255) NOT NULL DEFAULT 'en_cours',
  `fichiers_total` int(11) NOT NULL DEFAULT 0,
  `fichiers_traites` int(11) NOT NULL DEFAULT 0,
  `fichiers_echoues` int(11) NOT NULL DEFAULT 0,
  `notes` text DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_01_01_000001_create_annees_academiques_table', 1),
(5, '2024_01_01_000002_create_departements_table', 1),
(6, '2024_01_01_000003_create_filieres_table', 1),
(7, '2024_01_01_000004_create_semestres_table', 1),
(8, '2024_01_01_000005_create_modules_table', 1),
(9, '2024_01_01_000006_create_etudiants_table', 1),
(10, '2024_01_01_000007_create_importations_table', 1),
(11, '2024_01_01_000008_create_fichiers_importes_table', 1),
(12, '2024_01_01_000009_create_feuilles_notes_table', 1),
(13, '2024_01_01_000010_create_notes_table', 1),
(14, '2024_01_01_000011_create_historique_validations_table', 1),
(15, '2024_01_01_000012_create_exports_table', 1),
(16, '2024_01_01_000013_create_archives_table', 1),
(17, '2024_01_01_000014_create_notifications_table', 1),
(18, '2024_01_01_000015_add_fields_to_users_table', 1),
(19, '2025_12_29_131851_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Structure de la table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 5),
(5, 'App\\Models\\User', 6),
(5, 'App\\Models\\User', 7),
(5, 'App\\Models\\User', 8),
(5, 'App\\Models\\User', 9);

-- --------------------------------------------------------

--
-- Structure de la table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `filiere_id` bigint(20) UNSIGNED NOT NULL,
  `semestre_id` bigint(20) UNSIGNED NOT NULL,
  `responsable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `coefficient` int(11) NOT NULL DEFAULT 1,
  `credit_ects` decimal(4,2) NOT NULL DEFAULT 0.00,
  `actif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `modules`
--

INSERT INTO `modules` (`id`, `code`, `nom`, `description`, `filiere_id`, `semestre_id`, `responsable_id`, `coefficient`, `credit_ects`, `actif`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'INF-301', 'Algorithmique Avancée', 'Structures de données complexes et algorithmes', 1, 5, 8, 4, 6.00, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(2, 'INF-302', 'Bases de Données Relationnelles', 'SQL, normalisation et optimisation', 1, 5, 8, 4, 6.00, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(3, 'INF-303', 'Génie Logiciel', 'UML, design patterns et méthodologies agiles', 1, 5, 6, 3, 5.00, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(4, 'INF-304', 'Développement Web', 'HTML, CSS, JavaScript, PHP et frameworks', 1, 5, 9, 3, 5.00, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(5, 'MAT-201', 'Probabilités et Statistiques', 'Théorie des probabilités et statistiques descriptives', 1, 5, 5, 2, 4.00, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(6, 'ANG-101', 'Anglais Technique', 'Communication professionnelle en anglais', 1, 5, 7, 2, 3.00, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(7, 'INF-401', 'Architecture Logicielle', 'Architectures distribuées et microservices', 1, 6, 7, 4, 6.00, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(8, 'INF-402', 'Développement Mobile', 'Applications Android et iOS', 1, 6, 7, 3, 5.00, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(9, 'INF-403', 'Sécurité Informatique', 'Cryptographie et sécurité des systèmes', 1, 6, 8, 3, 5.00, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(10, 'PROJ-301', 'Projet Tutoré', 'Projet de développement en équipe', 1, 6, 7, 5, 8.00, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(11, 'BD-501', 'Introduction au Big Data', 'Écosystème Hadoop et technologies NoSQL', 2, 1, 5, 4, 6.00, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL),
(12, 'BD-502', 'Machine Learning', 'Apprentissage supervisé et non supervisé', 2, 1, 9, 5, 7.00, 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `etudiant_id` bigint(20) UNSIGNED NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `feuille_note_id` bigint(20) UNSIGNED DEFAULT NULL,
  `note_examen` decimal(5,2) DEFAULT NULL,
  `note_cc` decimal(5,2) DEFAULT NULL,
  `note_tp` decimal(5,2) DEFAULT NULL,
  `moyenne` decimal(5,2) DEFAULT NULL,
  `statut` varchar(255) NOT NULL DEFAULT 'en_attente',
  `commentaire` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'gerer_departements', 'web', '2025-12-29 17:35:17', '2025-12-29 17:35:17'),
(2, 'gerer_filieres', 'web', '2025-12-29 17:35:17', '2025-12-29 17:35:17'),
(3, 'gerer_modules', 'web', '2025-12-29 17:35:17', '2025-12-29 17:35:17'),
(4, 'gerer_semestres', 'web', '2025-12-29 17:35:17', '2025-12-29 17:35:17'),
(5, 'gerer_utilisateurs', 'web', '2025-12-29 17:35:18', '2025-12-29 17:35:18'),
(6, 'assigner_roles', 'web', '2025-12-29 17:35:18', '2025-12-29 17:35:18'),
(7, 'gerer_etudiants', 'web', '2025-12-29 17:35:18', '2025-12-29 17:35:18'),
(8, 'voir_etudiants', 'web', '2025-12-29 17:35:18', '2025-12-29 17:35:18'),
(9, 'importer_notes', 'web', '2025-12-29 17:35:18', '2025-12-29 17:35:18'),
(10, 'voir_importations', 'web', '2025-12-29 17:35:18', '2025-12-29 17:35:18'),
(11, 'valider_notes', 'web', '2025-12-29 17:35:18', '2025-12-29 17:35:18'),
(12, 'modifier_notes', 'web', '2025-12-29 17:35:18', '2025-12-29 17:35:18'),
(13, 'voir_notes', 'web', '2025-12-29 17:35:18', '2025-12-29 17:35:18'),
(14, 'exporter_donnees', 'web', '2025-12-29 17:35:18', '2025-12-29 17:35:18'),
(15, 'generer_rapports', 'web', '2025-12-29 17:35:18', '2025-12-29 17:35:18'),
(16, 'archiver_documents', 'web', '2025-12-29 17:35:18', '2025-12-29 17:35:18'),
(17, 'consulter_archives', 'web', '2025-12-29 17:35:18', '2025-12-29 17:35:18'),
(18, 'voir_logs', 'web', '2025-12-29 17:35:18', '2025-12-29 17:35:18'),
(19, 'configurer_systeme', 'web', '2025-12-29 17:35:18', '2025-12-29 17:35:18');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', 'web', '2025-12-29 17:35:18', '2025-12-29 17:35:18'),
(2, 'gestionnaire', 'web', '2025-12-29 17:35:18', '2025-12-29 17:35:18'),
(3, 'chef-departement', 'web', '2025-12-29 17:35:18', '2025-12-29 17:35:18'),
(4, 'chef-filiere', 'web', '2025-12-29 17:35:18', '2025-12-29 17:35:18'),
(5, 'enseignant', 'web', '2025-12-29 17:35:18', '2025-12-29 17:35:18'),
(6, 'consultant', 'web', '2025-12-29 17:35:18', '2025-12-29 17:35:18');

-- --------------------------------------------------------

--
-- Structure de la table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(4, 1),
(4, 2),
(5, 1),
(6, 1),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(8, 3),
(8, 4),
(8, 5),
(8, 6),
(9, 1),
(9, 2),
(9, 5),
(10, 1),
(10, 2),
(10, 3),
(10, 4),
(10, 5),
(10, 6),
(11, 1),
(11, 2),
(11, 3),
(11, 4),
(12, 1),
(12, 2),
(12, 5),
(13, 1),
(13, 2),
(13, 3),
(13, 4),
(13, 5),
(13, 6),
(14, 1),
(14, 2),
(14, 3),
(14, 4),
(14, 5),
(15, 1),
(15, 2),
(15, 3),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(17, 3),
(17, 4),
(17, 6),
(18, 1),
(19, 1);

-- --------------------------------------------------------

--
-- Structure de la table `semestres`
--

CREATE TABLE `semestres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(10) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `ordre` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `semestres`
--

INSERT INTO `semestres` (`id`, `code`, `nom`, `ordre`, `created_at`, `updated_at`) VALUES
(1, 'S1', 'Semestre 1', 1, '2025-12-29 17:35:20', '2025-12-29 17:35:20'),
(2, 'S2', 'Semestre 2', 2, '2025-12-29 17:35:20', '2025-12-29 17:35:20'),
(3, 'S3', 'Semestre 3', 3, '2025-12-29 17:35:20', '2025-12-29 17:35:20'),
(4, 'S4', 'Semestre 4', 4, '2025-12-29 17:35:20', '2025-12-29 17:35:20'),
(5, 'S5', 'Semestre 5', 5, '2025-12-29 17:35:20', '2025-12-29 17:35:20'),
(6, 'S6', 'Semestre 6', 6, '2025-12-29 17:35:20', '2025-12-29 17:35:20');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Tx5uJBFXj0igE5nmzNORFeAonGiUXz3VeKt7tM7B', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOVUxcXpEQUtxUzd2N2Z2TVFGZm51dG1ad2RsY0t1TFpFSTAxUUR5RCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1767051494);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `departement_id` bigint(20) UNSIGNED DEFAULT NULL,
  `avatar_url` varchar(255) DEFAULT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT 1,
  `two_factor_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `telephone`, `departement_id`, `avatar_url`, `actif`, `two_factor_enabled`, `last_login_at`, `last_login_ip`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@edusecure.com', '+212 6 00 00 00 00', NULL, NULL, 1, 0, '2025-12-29 19:37:48', '127.0.0.1', '2025-12-29 17:35:18', '$2y$12$zwxkGYQ09WPsS/j2Ib2/ue2fNkQO6xslsaeSh41lKdewsFfLq6AMm', NULL, '2025-12-29 17:35:18', '2025-12-29 19:37:48'),
(2, 'Jean Dupont', 'gestionnaire@edusecure.com', '+212 6 11 11 11 11', NULL, NULL, 1, 0, NULL, NULL, '2025-12-29 17:35:18', '$2y$12$2gX0XE1FLC3DICplTCbC8.OOh01iUFZ9A3v4CcoIWjnsCiq3yE6tG', NULL, '2025-12-29 17:35:18', '2025-12-29 17:35:18'),
(3, 'Pr.  Ahmed Benali', 'a.benali@edusecure.com', '+212 6 22 22 22 22', NULL, NULL, 1, 0, NULL, NULL, '2025-12-29 17:35:19', '$2y$12$iiMpWbBOcYaEg0ejCcbUOOu7w6i4ecVe7rEhIiFpsOI0i0ly7E9wS', NULL, '2025-12-29 17:35:19', '2025-12-29 17:35:19'),
(4, 'Dr. Marie Dubois', 'm.dubois@edusecure.com', '+212 6 33 33 33 33', NULL, NULL, 1, 0, NULL, NULL, '2025-12-29 17:35:19', '$2y$12$27dKCjsGYbHcM/oJY4NYYO7DgZAbVX47mI.GhgL1oNuDBwEb13AK2', NULL, '2025-12-29 17:35:19', '2025-12-29 17:35:19'),
(5, 'Pr.  Mansouri Ahmed', 'mansouri@edusecure.com', '+212 6 38 45 10 52', NULL, NULL, 1, 0, NULL, NULL, '2025-12-29 17:35:19', '$2y$12$1B83evR/MNMMuE3//dLQdORGet0QaG2JqYgTbfVupKRVU3uxSYP1G', NULL, '2025-12-29 17:35:19', '2025-12-29 17:35:19'),
(6, 'Dr. Sarah Martin', 's.martin@edusecure. com', '+212 6 79 95 22 72', NULL, NULL, 1, 0, NULL, NULL, '2025-12-29 17:35:19', '$2y$12$.hTC/TQBwHEMDvsPoZdcU.npBkl5kLTBu.au8LhPTWvW4vYfA5w0u', NULL, '2025-12-29 17:35:19', '2025-12-29 17:35:19'),
(7, 'Pr. Karim El Amrani', 'k.amrani@edusecure.com', '+212 6 18 98 58 87', NULL, NULL, 1, 0, NULL, NULL, '2025-12-29 17:35:20', '$2y$12$OoSfDys.zUYKQo7NmDGFPezouN27GQk6tj.d4F/S1lpgsKAmJk4o6', NULL, '2025-12-29 17:35:20', '2025-12-29 17:35:20'),
(8, 'Dr.  Fatima Zahra', 'f.zahra@edusecure.com', '+212 6 91 10 45 45', NULL, NULL, 1, 0, NULL, NULL, '2025-12-29 17:35:20', '$2y$12$uCks.XKyyz/iamjPNMpxNuZ485Qtd2mF0IazWZrQyvGYmN5P/c43m', NULL, '2025-12-29 17:35:20', '2025-12-29 17:35:20'),
(9, 'Pr. Hassan Idrissi', 'h.idrissi@edusecure.com', '+212 6 82 87 25 31', NULL, NULL, 1, 0, NULL, NULL, '2025-12-29 17:35:20', '$2y$12$ByW5RYGr8V/HIgsH39.yuOox2gTII.6726RUgO4b.2hJQslgNhyku', NULL, '2025-12-29 17:35:20', '2025-12-29 17:35:20');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annees_academiques`
--
ALTER TABLE `annees_academiques`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `annees_academiques_code_unique` (`code`);

--
-- Index pour la table `archives`
--
ALTER TABLE `archives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `archives_feuille_note_id_foreign` (`feuille_note_id`),
  ADD KEY `archives_archive_par_foreign` (`archive_par`),
  ADD KEY `archives_annee_academique_id_type_index` (`annee_academique_id`,`type`);

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departements_code_unique` (`code`),
  ADD KEY `departements_chef_id_foreign` (`chef_id`);

--
-- Index pour la table `etudiants`
--
ALTER TABLE `etudiants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `etudiants_matricule_unique` (`matricule`),
  ADD UNIQUE KEY `etudiants_email_unique` (`email`),
  ADD KEY `etudiants_filiere_id_foreign` (`filiere_id`);

--
-- Index pour la table `exports`
--
ALTER TABLE `exports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exports_user_id_foreign` (`user_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `feuilles_notes`
--
ALTER TABLE `feuilles_notes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `feuilles_notes_code_unique` (`code`),
  ADD KEY `feuilles_notes_module_id_foreign` (`module_id`),
  ADD KEY `feuilles_notes_importation_id_foreign` (`importation_id`),
  ADD KEY `feuilles_notes_fichier_importe_id_foreign` (`fichier_importe_id`),
  ADD KEY `feuilles_notes_enseignant_id_foreign` (`enseignant_id`),
  ADD KEY `feuilles_notes_annee_academique_id_foreign` (`annee_academique_id`),
  ADD KEY `feuilles_notes_validateur_id_foreign` (`validateur_id`);

--
-- Index pour la table `fichiers_importes`
--
ALTER TABLE `fichiers_importes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fichiers_importes_importation_id_foreign` (`importation_id`);

--
-- Index pour la table `filieres`
--
ALTER TABLE `filieres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `filieres_code_unique` (`code`),
  ADD KEY `filieres_departement_id_foreign` (`departement_id`),
  ADD KEY `filieres_chef_id_foreign` (`chef_id`);

--
-- Index pour la table `historique_validations`
--
ALTER TABLE `historique_validations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `historique_validations_note_id_foreign` (`note_id`),
  ADD KEY `historique_validations_user_id_foreign` (`user_id`),
  ADD KEY `historique_validations_feuille_note_id_created_at_index` (`feuille_note_id`,`created_at`);

--
-- Index pour la table `importations`
--
ALTER TABLE `importations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `importations_user_id_foreign` (`user_id`),
  ADD KEY `importations_annee_academique_id_foreign` (`annee_academique_id`),
  ADD KEY `importations_module_id_foreign` (`module_id`),
  ADD KEY `importations_filiere_id_foreign` (`filiere_id`),
  ADD KEY `importations_semestre_id_foreign` (`semestre_id`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Index pour la table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Index pour la table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `modules_code_unique` (`code`),
  ADD KEY `modules_filiere_id_foreign` (`filiere_id`),
  ADD KEY `modules_semestre_id_foreign` (`semestre_id`),
  ADD KEY `modules_responsable_id_foreign` (`responsable_id`);

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notes_module_id_foreign` (`module_id`),
  ADD KEY `notes_feuille_note_id_foreign` (`feuille_note_id`),
  ADD KEY `notes_etudiant_id_module_id_index` (`etudiant_id`,`module_id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_read_at_index` (`notifiable_type`,`notifiable_id`,`read_at`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Index pour la table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Index pour la table `semestres`
--
ALTER TABLE `semestres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `semestres_code_unique` (`code`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_departement_id_foreign` (`departement_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annees_academiques`
--
ALTER TABLE `annees_academiques`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `archives`
--
ALTER TABLE `archives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `departements`
--
ALTER TABLE `departements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `etudiants`
--
ALTER TABLE `etudiants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321;

--
-- AUTO_INCREMENT pour la table `exports`
--
ALTER TABLE `exports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `feuilles_notes`
--
ALTER TABLE `feuilles_notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fichiers_importes`
--
ALTER TABLE `fichiers_importes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `filieres`
--
ALTER TABLE `filieres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `historique_validations`
--
ALTER TABLE `historique_validations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `importations`
--
ALTER TABLE `importations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `semestres`
--
ALTER TABLE `semestres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `archives`
--
ALTER TABLE `archives`
  ADD CONSTRAINT `archives_annee_academique_id_foreign` FOREIGN KEY (`annee_academique_id`) REFERENCES `annees_academiques` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `archives_archive_par_foreign` FOREIGN KEY (`archive_par`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `archives_feuille_note_id_foreign` FOREIGN KEY (`feuille_note_id`) REFERENCES `feuilles_notes` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `departements`
--
ALTER TABLE `departements`
  ADD CONSTRAINT `departements_chef_id_foreign` FOREIGN KEY (`chef_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `etudiants`
--
ALTER TABLE `etudiants`
  ADD CONSTRAINT `etudiants_filiere_id_foreign` FOREIGN KEY (`filiere_id`) REFERENCES `filieres` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `exports`
--
ALTER TABLE `exports`
  ADD CONSTRAINT `exports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `feuilles_notes`
--
ALTER TABLE `feuilles_notes`
  ADD CONSTRAINT `feuilles_notes_annee_academique_id_foreign` FOREIGN KEY (`annee_academique_id`) REFERENCES `annees_academiques` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `feuilles_notes_enseignant_id_foreign` FOREIGN KEY (`enseignant_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `feuilles_notes_fichier_importe_id_foreign` FOREIGN KEY (`fichier_importe_id`) REFERENCES `fichiers_importes` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `feuilles_notes_importation_id_foreign` FOREIGN KEY (`importation_id`) REFERENCES `importations` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `feuilles_notes_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `feuilles_notes_validateur_id_foreign` FOREIGN KEY (`validateur_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `fichiers_importes`
--
ALTER TABLE `fichiers_importes`
  ADD CONSTRAINT `fichiers_importes_importation_id_foreign` FOREIGN KEY (`importation_id`) REFERENCES `importations` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `filieres`
--
ALTER TABLE `filieres`
  ADD CONSTRAINT `filieres_chef_id_foreign` FOREIGN KEY (`chef_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `filieres_departement_id_foreign` FOREIGN KEY (`departement_id`) REFERENCES `departements` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `historique_validations`
--
ALTER TABLE `historique_validations`
  ADD CONSTRAINT `historique_validations_feuille_note_id_foreign` FOREIGN KEY (`feuille_note_id`) REFERENCES `feuilles_notes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `historique_validations_note_id_foreign` FOREIGN KEY (`note_id`) REFERENCES `notes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `historique_validations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `importations`
--
ALTER TABLE `importations`
  ADD CONSTRAINT `importations_annee_academique_id_foreign` FOREIGN KEY (`annee_academique_id`) REFERENCES `annees_academiques` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `importations_filiere_id_foreign` FOREIGN KEY (`filiere_id`) REFERENCES `filieres` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `importations_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `importations_semestre_id_foreign` FOREIGN KEY (`semestre_id`) REFERENCES `semestres` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `importations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `modules`
--
ALTER TABLE `modules`
  ADD CONSTRAINT `modules_filiere_id_foreign` FOREIGN KEY (`filiere_id`) REFERENCES `filieres` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `modules_responsable_id_foreign` FOREIGN KEY (`responsable_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `modules_semestre_id_foreign` FOREIGN KEY (`semestre_id`) REFERENCES `semestres` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_etudiant_id_foreign` FOREIGN KEY (`etudiant_id`) REFERENCES `etudiants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notes_feuille_note_id_foreign` FOREIGN KEY (`feuille_note_id`) REFERENCES `feuilles_notes` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `notes_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_departement_id_foreign` FOREIGN KEY (`departement_id`) REFERENCES `departements` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
