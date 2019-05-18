-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 28 mars 2018 à 17:41
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `idAdministrateur` char(3) NOT NULL,
  `nom` char(32) NOT NULL,
  `mdp` char(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`idAdministrateur`, `nom`, `mdp`) VALUES
('1', 'toto', 'toto'),
('2', 'titi', 'titi');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `idCategorie` char(32) NOT NULL,
  `libelle` char(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `libelle`) VALUES
('fem', 'Femme'),
('enf', 'Enfant'),
('hom', 'Homme');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `idCommande` char(32) NOT NULL,
  `dateCommande` date DEFAULT NULL,
  `nomPrenomClient` char(32) DEFAULT NULL,
  `adresseRueClient` char(32) DEFAULT NULL,
  `cpClient` char(5) DEFAULT NULL,
  `villeClient` char(32) DEFAULT NULL,
  `mailClient` char(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`idCommande`, `dateCommande`, `nomPrenomClient`, `adresseRueClient`, `cpClient`, `villeClient`, `mailClient`) VALUES
('1', '2011-01-12', 'turlututu', '7 rue de paris', '75014', 'PARIS', 'turlututu@laposte.fr'),
('2', '2018-03-15', 'castaing', 'de la pompe', '75116', 'PARIS', 'castaing@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

CREATE TABLE `contenir` (
  `idCommande` char(32) NOT NULL,
  `idProduit` char(32) NOT NULL,
  `quantite` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `contenir`
--

INSERT INTO `contenir` (`idCommande`, `idProduit`, `quantite`) VALUES
('1', '01', 0),
('1', '02', 0),
('2', '01', 11);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `idProduit` char(32) NOT NULL,
  `description` char(50) NOT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `image` char(32) DEFAULT NULL,
  `idCategorie` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`idProduit`, `description`, `prix`, `image`, `idCategorie`) VALUES
('01', 'Chemisier carreaux', '25.00', 'images/femme/chemisier.jpg', 'fem'),
('02', 'Pantalon fuseau', '50.00', 'images/femme/pantalon.jpg', 'fem'),
('03', 'Manteau hiver', '142.00', 'images/femme/manteau.jpg', 'fem'),
('04', 'Parka hiver', '43.00', 'images/enfant/parka.jpg', 'enf');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`idAdministrateur`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`idCommande`);

--
-- Index pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD PRIMARY KEY (`idCommande`,`idProduit`),
  ADD KEY `I_FK_CONTENIR_COMMANDE` (`idCommande`),
  ADD KEY `I_FK_CONTENIR_Produit` (`idProduit`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`idProduit`),
  ADD KEY `I_FK_Produit_CATEGORIE` (`idCategorie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
