-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 08 mars 2022 à 18:24
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `custombox`
--

-- --------------------------------------------------------

--
-- Structure de la table `boite`
--

CREATE TABLE `boite` (
  `id` int(11) NOT NULL,
  `taille` text NOT NULL,
  `poidsmax` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `boite`
--

INSERT INTO `boite` (`id`, `taille`, `poidsmax`) VALUES
(1, 'petite', 0.7),
(2, 'moyenne', 1.5),
(3, 'grande', 3.2);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1, 'Beauté'),
(2, 'Bijoux'),
(3, 'Décoration'),
(4, 'Produit ménager'),
(5, 'Upcycling');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `titre` text NOT NULL,
  `description` text NOT NULL,
  `categorie` int(11) NOT NULL,
  `poids` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `titre`, `description`, `categorie`, `poids`) VALUES
(1, 'Crème', 'Une crème hydratante et parfumée qui rend la peau douce', 1, 0.3),
(2, 'Savon', 'Un savon qui respecte la peau', 1, 0.2),
(3, 'Shampoing', 'Shampoing doux et démêlant', 1, 0.4),
(4, 'Bracelet', 'Un bracelet en tissu aux couleurs plaisantes', 2, 0.15),
(5, 'Tableau', 'Aquarelle ou peinture à l\'huile', 3, 0.6),
(6, 'Essuie-main', 'Utile au quotidien', 4, 0.45),
(7, 'Gel', 'Gel hydroalcoolique et Antibactérien', 4, 0.25),
(8, 'Masque', 'masque chirurgical jetable categorie 1', 4, 0.35),
(9, 'Gilet', 'Gilet décoré par nos couturières', 5, 0.55),
(10, 'Marque page', 'Joli marque page pour accompagner vos lectures favorites', 5, 0.1),
(11, 'Sac', 'Sac éco-responsable avec décorations variées', 5, 0.26),
(12, 'Surprise', 'Pochette surprise pour faire plaisir aux petits et grands', 5, 0.7),
(13, 'T-shirt', 'T-shirt peint à la main et avec pochoir', 5, 0.32);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `boite`
--
ALTER TABLE `boite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie` (`categorie`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `boite`
--
ALTER TABLE `boite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`categorie`) REFERENCES `categorie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
