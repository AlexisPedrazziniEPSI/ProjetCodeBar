-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 14 fév. 2025 à 17:18
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
-- Base de données : `codebar`
--
CREATE DATABASE IF NOT EXISTS `codebar` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `codebar`;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `Titre` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Contenance` int(16) NOT NULL,
  `Matiere` varchar(255) NOT NULL,
  `DimensionsL` int(16) NOT NULL,
  `DimensionsH` int(16) NOT NULL,
  `DimensionsP` int(16) NOT NULL,
  `Accessoires` tinyint(1) NOT NULL,
  `Poids` int(16) NOT NULL,
  `Codebar` int(16) NOT NULL,
  `CodeBarreValide` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `Titre`, `Description`, `Contenance`, `Matiere`, `DimensionsL`, `DimensionsH`, `DimensionsP`, `Accessoires`, `Poids`, `Codebar`, `CodeBarreValide`) VALUES
(1, 'Aquarium', 'Un jolie aquarium de 20x50x20', 20, 'Verre', 20, 50, 20, 1, 30, 2147483647, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
