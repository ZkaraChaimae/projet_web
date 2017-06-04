-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Dim 04 Juin 2017 à 04:46
-- Version du serveur :  5.7.18-0ubuntu0.17.04.1
-- Version de PHP :  7.0.18-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestionVentes`
--

-- --------------------------------------------------------

--
-- Structure de la table `addresse`
--

CREATE TABLE `addresse` (
  `id_addr` int(11) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `id_ville` int(11) NOT NULL,
  `id_pers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `caissier`
--

CREATE TABLE `caissier` (
  `id_caissier` int(11) NOT NULL,
  `id_emp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `catégorie produit`
--

CREATE TABLE `catégorie produit` (
  `id_categorie` int(11) NOT NULL,
  `intitulé` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `catégorie produit`
--

INSERT INTO `catégorie produit` (`id_categorie`, `intitulé`) VALUES
(1, 'electro-ménagers');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `id_pers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commande client`
--

CREATE TABLE `commande client` (
  `id_cmdClient` int(11) NOT NULL,
  `num_cmd` varchar(25) NOT NULL,
  `date_cmd` date NOT NULL,
  `id_vendeur` int(11) NOT NULL,
  `id_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commande fournisseur`
--

CREATE TABLE `commande fournisseur` (
  `id_cf` int(11) NOT NULL,
  `date_cmd` date NOT NULL,
  `id_magasinier` int(11) NOT NULL,
  `id_fournisseur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `echeance`
--

CREATE TABLE `echeance` (
  `id_echeance` int(11) NOT NULL,
  `date_echeance` date NOT NULL,
  `montant_echeance` int(11) NOT NULL,
  `payé` tinyint(1) NOT NULL,
  `id_type_paiement` int(11) NOT NULL,
  `id_paiement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `employé`
--

CREATE TABLE `employé` (
  `id_emp` int(11) NOT NULL,
  `salaire_emp` float NOT NULL,
  `date_recrutement` date NOT NULL,
  `type` char(1) NOT NULL,
  `login` varchar(30) NOT NULL,
  `passwd` text NOT NULL,
  `id_Pers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `employé`
--

INSERT INTO `employé` (`id_emp`, `salaire_emp`, `date_recrutement`, `type`, `login`, `passwd`, `id_Pers`) VALUES
(1, 2300, '2017-06-01', 'c', 'admin_caissier', 'admin_caissier', 1),
(4, 4000, '2017-06-01', 'v', 'admin_vendeur', 'admin_vendeur', 2),
(5, 3500, '2017-06-01', 'm', 'admin_magasinier', 'admin_magasinier', 3);

-- --------------------------------------------------------

--
-- Structure de la table `etat cmd`
--

CREATE TABLE `etat cmd` (
  `id_etat` int(11) NOT NULL,
  `libellé` varchar(20) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etre d'etat`
--

CREATE TABLE `etre d'etat` (
  `id_etat` int(11) NOT NULL,
  `id_cmdclient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `id_facture` int(11) NOT NULL,
  `num_facture` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `total_a_payer` float NOT NULL,
  `id_cmdclient` int(11) NOT NULL,
  `id_caissier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id_fournisseur` int(11) NOT NULL,
  `nom` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tele` varchar(13) NOT NULL,
  `commentaires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id_fournisseur`, `nom`, `email`, `tele`, `commentaires`) VALUES
(1, 'Ikea', 'ikea@gmail.com', '06439823', '');

-- --------------------------------------------------------

--
-- Structure de la table `ligne cmd client`
--

CREATE TABLE `ligne cmd client` (
  `id_lc` int(11) NOT NULL,
  `qte_commandé` int(11) NOT NULL,
  `prix_vente_produit` float NOT NULL,
  `id_cmdClient` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ligne cmd fournisseur`
--

CREATE TABLE `ligne cmd fournisseur` (
  `id_lcf` int(11) NOT NULL,
  `qte` int(11) NOT NULL,
  `prix_achat` float NOT NULL,
  `id_cf` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `magasinier`
--

CREATE TABLE `magasinier` (
  `id_magasinier` int(11) NOT NULL,
  `id_emp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `id_paiement` int(11) NOT NULL,
  `date` date NOT NULL,
  `montant_paiement` float NOT NULL,
  `commentaires` text,
  `num_cheque` varchar(50) DEFAULT NULL,
  `banque` varchar(30) DEFAULT NULL,
  `id_type_echeance` int(11) DEFAULT NULL,
  `id_type_paiement` int(11) NOT NULL,
  `id_facture` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE `personne` (
  `id_Pers` int(11) NOT NULL,
  `nom_pers` varchar(40) NOT NULL,
  `prenom_pers` varchar(40) NOT NULL,
  `cin_pers` varchar(10) NOT NULL,
  `email_pers` varchar(100) NOT NULL,
  `tele_pers` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `personne`
--

INSERT INTO `personne` (`id_Pers`, `nom_pers`, `prenom_pers`, `cin_pers`, `email_pers`, `tele_pers`) VALUES
(1, 'admin1', 'prenom1', 'T262507', 'admin_caissier@magasin.com', '0627891128'),
(2, 'admin2', 'prenom2', 'T29297', 'admin_vendeur@magasin.com', '0672783659'),
(3, 'admin3', 'prenom3', 'T82828', 'admin_magasinier@magasin.com', '0627387289');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(11) NOT NULL,
  `code_produit` varchar(30) NOT NULL,
  `désignation` varchar(40) NOT NULL,
  `prix_achat` float NOT NULL,
  `prix_vente` float NOT NULL,
  `qte_stock` int(11) NOT NULL,
  `seuil` int(11) NOT NULL,
  `id_categ` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `code_produit`, `désignation`, `prix_achat`, `prix_vente`, `qte_stock`, `seuil`, `id_categ`) VALUES
(1, 'rf232', 'congélateur', 1500, 2000, 1, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `type echeance`
--

CREATE TABLE `type echeance` (
  `id_type_echeance` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `taux` float NOT NULL,
  `commentaires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `type paiement`
--

CREATE TABLE `type paiement` (
  `id_type_paiement` int(11) NOT NULL,
  `libellé` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

CREATE TABLE `vendeur` (
  `id_vendeur` int(11) NOT NULL,
  `id_emp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE `ville` (
  `id_ville` int(11) NOT NULL,
  `laville` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `addresse`
--
ALTER TABLE `addresse`
  ADD PRIMARY KEY (`id_addr`),
  ADD KEY `id_ville` (`id_ville`),
  ADD KEY `id_pers` (`id_pers`);

--
-- Index pour la table `caissier`
--
ALTER TABLE `caissier`
  ADD PRIMARY KEY (`id_caissier`),
  ADD KEY `id_emp` (`id_emp`);

--
-- Index pour la table `catégorie produit`
--
ALTER TABLE `catégorie produit`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`),
  ADD KEY `id_pers` (`id_pers`);

--
-- Index pour la table `commande client`
--
ALTER TABLE `commande client`
  ADD PRIMARY KEY (`id_cmdClient`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_vendeur` (`id_vendeur`);

--
-- Index pour la table `commande fournisseur`
--
ALTER TABLE `commande fournisseur`
  ADD PRIMARY KEY (`id_cf`),
  ADD KEY `id_magasinier` (`id_magasinier`),
  ADD KEY `id_fournisseur` (`id_fournisseur`);

--
-- Index pour la table `echeance`
--
ALTER TABLE `echeance`
  ADD PRIMARY KEY (`id_echeance`),
  ADD KEY `id_type_paiement` (`id_type_paiement`),
  ADD KEY `id_paiement` (`id_paiement`);

--
-- Index pour la table `employé`
--
ALTER TABLE `employé`
  ADD PRIMARY KEY (`id_emp`),
  ADD KEY `id_Pers` (`id_Pers`),
  ADD KEY `id_Pers_2` (`id_Pers`);

--
-- Index pour la table `etat cmd`
--
ALTER TABLE `etat cmd`
  ADD PRIMARY KEY (`id_etat`);

--
-- Index pour la table `etre d'etat`
--
ALTER TABLE `etre d'etat`
  ADD PRIMARY KEY (`id_etat`,`id_cmdclient`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id_facture`),
  ADD KEY `id_cmdclient` (`id_cmdclient`),
  ADD KEY `id_caissier` (`id_caissier`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id_fournisseur`);

--
-- Index pour la table `ligne cmd client`
--
ALTER TABLE `ligne cmd client`
  ADD PRIMARY KEY (`id_lc`),
  ADD KEY `id_cmdClient` (`id_cmdClient`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Index pour la table `ligne cmd fournisseur`
--
ALTER TABLE `ligne cmd fournisseur`
  ADD PRIMARY KEY (`id_lcf`),
  ADD KEY `id_cf` (`id_cf`);

--
-- Index pour la table `magasinier`
--
ALTER TABLE `magasinier`
  ADD PRIMARY KEY (`id_magasinier`),
  ADD KEY `id_emp` (`id_emp`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`id_paiement`),
  ADD KEY `id_type_echeance` (`id_type_echeance`),
  ADD KEY `id_facture` (`id_facture`),
  ADD KEY `id_type_paiement` (`id_type_paiement`);

--
-- Index pour la table `personne`
--
ALTER TABLE `personne`
  ADD PRIMARY KEY (`id_Pers`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`),
  ADD KEY `id_categ` (`id_categ`);

--
-- Index pour la table `type echeance`
--
ALTER TABLE `type echeance`
  ADD PRIMARY KEY (`id_type_echeance`);

--
-- Index pour la table `type paiement`
--
ALTER TABLE `type paiement`
  ADD PRIMARY KEY (`id_type_paiement`);

--
-- Index pour la table `vendeur`
--
ALTER TABLE `vendeur`
  ADD PRIMARY KEY (`id_vendeur`),
  ADD KEY `id_emp` (`id_emp`);

--
-- Index pour la table `ville`
--
ALTER TABLE `ville`
  ADD PRIMARY KEY (`id_ville`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `addresse`
--
ALTER TABLE `addresse`
  MODIFY `id_addr` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `caissier`
--
ALTER TABLE `caissier`
  MODIFY `id_caissier` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `catégorie produit`
--
ALTER TABLE `catégorie produit`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `commande client`
--
ALTER TABLE `commande client`
  MODIFY `id_cmdClient` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `commande fournisseur`
--
ALTER TABLE `commande fournisseur`
  MODIFY `id_cf` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `echeance`
--
ALTER TABLE `echeance`
  MODIFY `id_echeance` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `employé`
--
ALTER TABLE `employé`
  MODIFY `id_emp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `etat cmd`
--
ALTER TABLE `etat cmd`
  MODIFY `id_etat` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `id_facture` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id_fournisseur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `ligne cmd client`
--
ALTER TABLE `ligne cmd client`
  MODIFY `id_lc` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `ligne cmd fournisseur`
--
ALTER TABLE `ligne cmd fournisseur`
  MODIFY `id_lcf` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `magasinier`
--
ALTER TABLE `magasinier`
  MODIFY `id_magasinier` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `id_paiement` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `personne`
--
ALTER TABLE `personne`
  MODIFY `id_Pers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `type echeance`
--
ALTER TABLE `type echeance`
  MODIFY `id_type_echeance` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `type paiement`
--
ALTER TABLE `type paiement`
  MODIFY `id_type_paiement` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `vendeur`
--
ALTER TABLE `vendeur`
  MODIFY `id_vendeur` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `ville`
--
ALTER TABLE `ville`
  MODIFY `id_ville` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
