-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 07 déc. 2020 à 14:11
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `classes`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`, `email`, `firstname`, `lastname`) VALUES
(1, 'bapt', 'mdp', 'baptiste.gauthier@laplateforme.io', 'Baptiste', 'GAUTHIER'),
(2, 'bapt', 'mdp', 'baptiste.gauthier@laplateforme.io', 'Baptiste', 'GAUTHIER'),
(3, 'bapt', 'mdp', 'baptiste.gauthier@laplateforme.io', 'Baptiste', 'GAUTHIER'),
(4, 'bapt', 'mdp', 'baptiste.gauthier@laplateforme.io', 'Baptiste', 'GAUTHIER'),
(5, 'bapt', 'mdp', 'baptiste.gauthier@laplateforme.io', 'Baptiste', 'GAUTHIER'),
(6, 'bapt', 'mdp', 'baptiste.gauthier@laplateforme.io', 'Baptiste', 'GAUTHIER'),
(7, 'bapt', 'mdp', 'baptiste.gauthier@laplateforme.io', 'Baptiste', 'GAUTHIER'),
(8, 'bapt', 'mdp', 'baptiste.gauthier@laplateforme.io', 'Baptiste', 'GAUTHIER'),
(9, 'JOJO', 'pass', 'jojo@gmail.com', 'Giorno', 'GIOVANNA'),
(10, 'JOJO', 'pass', 'jojo@gmail.com', 'Giorno', 'GIOVANNA'),
(11, 'JOJO', 'pass', 'jojo@gmail.com', 'Giorno', 'GIOVANNA'),
(12, 'JOJO', 'pass', 'jojo@gmail.com', 'Giorno', 'GIOVANNA'),
(13, 'JOJO', 'pass', 'jojo@gmail.com', 'Giorno', 'GIOVANNA'),
(14, 'JOJO', 'pass', 'jojo@gmail.com', 'Giorno', 'GIOVANNA'),
(15, 'JOJO', 'pass', 'jojo@gmail.com', 'Giorno', 'GIOVANNA'),
(16, 'JOJO', 'pass', 'jojo@gmail.com', 'Giorno', 'GIOVANNA'),
(17, 'JOJO', 'pass', 'jojo@gmail.com', 'Giorno', 'GIOVANNA'),
(18, 'JOJO', 'pass', 'jojo@gmail.com', 'Giorno', 'GIOVANNA'),
(19, 'JOJO', 'pass', 'jojo@gmail.com', 'Giorno', 'GIOVANNA'),
(20, 'JOJO', 'pass', 'jojo@gmail.com', 'Giorno', 'GIOVANNA'),
(21, 'test', 'test', 'test@gmail.com', 'test', 'test'),
(22, 'JOJO', 'pass', 'jojo@gmail.com', 'Giorno', 'GIOVANNA'),
(23, 'JOJO', 'pass', 'jojo@gmail.com', 'Giorno', 'GIOVANNA'),
(24, 'JOJO', 'pass', 'jojo@gmail.com', 'Giorno', 'GIOVANNA'),
(25, 'JOJO', 'pass', 'jojo@gmail.com', 'Giorno', 'GIOVANNA'),
(26, 'JOJO', 'pass', 'jojo@gmail.com', 'Giorno', 'GIOVANNA'),
(27, 'JOJO', 'pass', 'jojo@gmail.com', 'Giorno', 'GIOVANNA'),
(28, 'JOJO', 'pass', 'jojo@gmail.com', 'Giorno', 'GIOVANNA'),
(29, 'JOJO', 'pass', 'jojo@gmail.com', 'Giorno', 'GIOVANNA'),
(30, 'JOJO', 'pass', 'jojo@gmail.com', 'Giorno', 'GIOVANNA'),
(31, 'JOJO', 'pass', 'jojo@gmail.com', 'Giorno', 'GIOVANNA');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
