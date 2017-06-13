-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mar 13 Juin 2017 à 04:11
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
  `adresse` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_ville` int(11) NOT NULL,
  `id_pers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `addresse`
--

INSERT INTO `addresse` (`id_addr`, `adresse`, `id_ville`, `id_pers`) VALUES
(1, '59 ouadi eddahab, Beni yakhlef', 6, 7);

-- --------------------------------------------------------

--
-- Structure de la table `caissier`
--

CREATE TABLE `caissier` (
  `id_caissier` int(11) NOT NULL,
  `id_emp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL,
  `intitule` varchar(40) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `intitule`) VALUES
(1, 'electro-ménagers');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `id_pers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`id_client`, `id_pers`) VALUES
(14, 4),
(15, 7),
(16, 10);

-- --------------------------------------------------------

--
-- Structure de la table `cmd_fournisseur`
--

CREATE TABLE `cmd_fournisseur` (
  `id_cf` int(11) NOT NULL,
  `date_cmd` date NOT NULL,
  `id_mag` int(11) NOT NULL,
  `id_fournisseur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `cmd_fournisseur`
--

INSERT INTO `cmd_fournisseur` (`id_cf`, `date_cmd`, `id_mag`, `id_fournisseur`) VALUES
(1, '2006-09-09', 5, 1),
(2, '2017-06-04', 5, 1),
(3, '2017-06-04', 5, 1),
(4, '2017-06-04', 5, 3),
(5, '2017-06-04', 5, 3),
(6, '2017-06-04', 5, 3),
(7, '2017-06-04', 5, 9),
(8, '2017-06-06', 5, 3),
(9, '2017-06-06', 5, 3);

-- --------------------------------------------------------

--
-- Structure de la table `commande_client`
--

CREATE TABLE `commande_client` (
  `id_cmdClient` int(11) NOT NULL,
  `date_cmd` date NOT NULL,
  `id_vendeur` int(11) NOT NULL,
  `id_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `commande_client`
--

INSERT INTO `commande_client` (`id_cmdClient`, `date_cmd`, `id_vendeur`, `id_client`) VALUES
(12, '2017-06-12', 1, 15),
(13, '2017-06-12', 1, 15);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
-- Structure de la table `etat_cmd`
--

CREATE TABLE `etat_cmd` (
  `id_etat` int(11) NOT NULL,
  `libelle` varchar(20) COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `etat_cmd`
--

INSERT INTO `etat_cmd` (`id_etat`, `libelle`, `date`) VALUES
(2, 'En cours', '2017-06-12'),
(3, 'En cours', '2017-06-12'),
(4, 'En cours', '2017-06-12'),
(5, 'En cours', '2017-06-12'),
(6, 'En cours', '2017-06-12'),
(7, 'En cours', '2017-06-12');

-- --------------------------------------------------------

--
-- Structure de la table `etre_detat`
--

CREATE TABLE `etre_detat` (
  `id_etat` int(11) NOT NULL,
  `id_cmdclient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `etre_detat`
--

INSERT INTO `etre_detat` (`id_etat`, `id_cmdclient`) VALUES
(6, 12),
(7, 13);

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `id_facture` int(11) NOT NULL,
  `num_facture` varchar(30) COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL,
  `total_a_payer` float NOT NULL,
  `id_cmdclient` int(11) NOT NULL,
  `id_caissier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id_fournisseur` int(11) NOT NULL,
  `nom` varchar(60) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `tele` varchar(13) COLLATE utf8_bin NOT NULL,
  `commentaires` mediumtext COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id_fournisseur`, `nom`, `email`, `tele`, `commentaires`) VALUES
(1, 'Ikea', 'ikea@gmail.com', '06439823', ''),
(2, 'f1', 'f1@gmail.com', '0626288338', 'this is a test comment'),
(3, 'Forlife cosmetics', 'forlife@gmail.com', '0624738783', 'bio cosmetics'),
(4, 'Forlife cosmetics', 'forlife@gmail.com', '0624738783', 'bio cosmetics'),
(5, 'test', 'test@gmail.com', '07272782', 'awiiili whdi'),
(6, 'new', 'test@query.com', '0666288889', 'test query'),
(7, 'new', 'test@query.com', '0666288889', 'test query'),
(8, 'new', 'test@query.com', '0666288889', 'test query'),
(9, 'we9t ftou', '3afak@gmail.com', '066272898', 'ila ma khdem');

-- --------------------------------------------------------

--
-- Structure de la table `lc_client`
--

CREATE TABLE `lc_client` (
  `id_lc` int(11) NOT NULL,
  `qte_commande` int(11) NOT NULL,
  `prix_vente_produit` float NOT NULL,
  `id_cmdClient` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `lc_client`
--

INSERT INTO `lc_client` (`id_lc`, `qte_commande`, `prix_vente_produit`, `id_cmdClient`, `id_produit`) VALUES
(1, 1, 2000, 9, 1),
(2, 3, 100, 9, 2),
(3, 1, 2000, 10, 1),
(4, 3, 100, 10, 2),
(5, 1, 100, 11, 2),
(6, 1, 100, 12, 2),
(7, 2, 90, 12, 4),
(8, 12, 100, 13, 2);

-- --------------------------------------------------------

--
-- Structure de la table `lc_fournisseur`
--

CREATE TABLE `lc_fournisseur` (
  `id_lcf` int(11) NOT NULL,
  `qte` int(11) NOT NULL,
  `prix_achat` float NOT NULL,
  `id_Prod` int(11) NOT NULL,
  `id_cf` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `lc_fournisseur`
--

INSERT INTO `lc_fournisseur` (`id_lcf`, `qte`, `prix_achat`, `id_Prod`, `id_cf`) VALUES
(3, 4, 123, 4, 6),
(4, 4, 200, 4, 7),
(5, 4, 123, 1, 8),
(6, 3, 123, 1, 9);

-- --------------------------------------------------------

--
-- Structure de la table `magasinier`
--

CREATE TABLE `magasinier` (
  `id_magasinier` int(11) NOT NULL,
  `id_emp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `id_paiement` int(11) NOT NULL,
  `date` date NOT NULL,
  `montant_paiement` float NOT NULL,
  `commentaires` mediumtext COLLATE utf8_bin,
  `num_cheque` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `banque` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `id_type_echeance` int(11) DEFAULT NULL,
  `id_type_paiement` int(11) NOT NULL,
  `id_facture` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE `personne` (
  `id_Pers` int(11) NOT NULL,
  `nom_pers` varchar(40) COLLATE utf8_bin NOT NULL,
  `prenom_pers` varchar(40) COLLATE utf8_bin NOT NULL,
  `cin_pers` varchar(10) COLLATE utf8_bin NOT NULL,
  `email_pers` varchar(100) COLLATE utf8_bin NOT NULL,
  `tele_pers` varchar(13) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `personne`
--

INSERT INTO `personne` (`id_Pers`, `nom_pers`, `prenom_pers`, `cin_pers`, `email_pers`, `tele_pers`) VALUES
(1, 'admin1', 'prenom1', 'T262507', 'admin_caissier@magasin.com', '0627891128'),
(2, 'admin2', 'prenom2', 'T29297', 'admin_vendeur@magasin.com', '0672783659'),
(3, 'admin3', 'prenom3', 'T82828', 'admin_magasinier@magasin.com', '0627387289'),
(4, 'salah eddine', 'zkara', 'T78233', 'salah@gmail.com', '063499212'),
(7, 'chaimae', 'zkara', 'T26902', 'z.ch@gmail.com', '07272782'),
(8, 'test', 'videos', '899002', 'vider@gmail.com', '06677678'),
(9, '', '', '', '', ''),
(10, 'hassania', 'belghaz', 'GH83982', 'hassania@gmail.com', '066272898'),
(11, 'zddzaq', 'aze', 'zs', 'az', 'za'),
(13, '', '', 'tytgjy', '', ''),
(14, '', '', 'hy', '', ''),
(15, '', '', 'cx', '', ''),
(16, 'test', 'test', 'K09208', 'lsqjkd@gmail.com', '063792992'),
(17, 'display', 'nome', 'lO92093', 'displ@jsj.fr', '06262883');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(11) NOT NULL,
  `code_produit` varchar(30) COLLATE utf8_bin NOT NULL,
  `designation` varchar(40) COLLATE utf8_bin NOT NULL,
  `prix_achat` float NOT NULL,
  `prix_vente` float NOT NULL,
  `qte_stock` int(11) NOT NULL,
  `seuil` int(11) NOT NULL,
  `id_categ` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `code_produit`, `designation`, `prix_achat`, `prix_vente`, `qte_stock`, `seuil`, `id_categ`) VALUES
(1, 'rf232', 'congélateur', 1500, 2000, 4, 2, 1),
(2, '90OP', 'argan', 80, 100, 43, 5, 1),
(3, '90OP', 'argan', 80, 100, 1, 5, 1),
(4, '000VGD', 'fia jou3', 34, 90, 3, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `type echeance`
--

CREATE TABLE `type echeance` (
  `id_type_echeance` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `taux` float NOT NULL,
  `commentaires` mediumtext COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `type paiement`
--

CREATE TABLE `type paiement` (
  `id_type_paiement` int(11) NOT NULL,
  `libellé` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

CREATE TABLE `vendeur` (
  `id_vendeur` int(11) NOT NULL,
  `id_emp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `vendeur`
--

INSERT INTO `vendeur` (`id_vendeur`, `id_emp`) VALUES
(1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE `ville` (
  `id_ville` int(11) NOT NULL,
  `laville` varchar(40) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `ville`
--

INSERT INTO `ville` (`id_ville`, `laville`) VALUES
(1, 'Aïn Harrouda'),
(2, 'Ben Yakhlef'),
(3, 'Bouskoura'),
(4, 'Casablanca'),
(5, 'Médiouna'),
(6, 'Mohammédia'),
(7, 'Tit Mellil'),
(8, 'Ben Yakhlef'),
(9, 'Bejaâd'),
(10, 'Ben Ahmed'),
(11, 'Benslimane'),
(12, 'Berrechid'),
(13, 'Boujniba'),
(14, 'Boulanouare'),
(15, 'Bouznika'),
(16, 'Deroua'),
(17, 'El Borouj'),
(18, 'El Gara'),
(19, 'Guisser'),
(20, 'Hattane'),
(21, 'Khouribga'),
(22, 'Loulad'),
(23, 'Oued Zem'),
(24, 'Oulad Abbou'),
(25, 'Oulad H\'Riz Sahel'),
(26, 'Oulad M\'rah'),
(27, 'Oulad Saïd'),
(28, 'Oulad Sidi Ben Daoud'),
(29, 'Ras El Aïn'),
(30, 'Settat'),
(31, 'Sidi Rahhal Chataï'),
(32, 'Soualem'),
(33, 'Azemmour'),
(34, 'Bir Jdid'),
(35, 'Bouguedra'),
(36, 'Echemmaia'),
(37, 'El Jadida'),
(38, 'Hrara'),
(39, 'Ighoud'),
(40, 'Jamâat Shaim'),
(41, 'Jorf Lasfar'),
(42, 'Khemis Zemamra'),
(43, 'Laaounate'),
(44, 'Moulay Abdallah'),
(45, 'Oualidia'),
(46, 'Oulad Amrane'),
(47, 'Oulad Frej'),
(48, 'Oulad Ghadbane'),
(49, 'Safi'),
(50, 'Sebt El Maârif'),
(51, 'Sebt Gzoula'),
(52, 'Sidi Ahmed'),
(53, 'Sidi Ali Ban Hamdouche'),
(54, 'Sidi Bennour'),
(55, 'Sidi Bouzid'),
(56, 'Sidi Smaïl'),
(57, 'Youssoufia'),
(58, 'Fès'),
(59, 'Aïn Cheggag'),
(60, 'Bhalil'),
(61, 'Boulemane'),
(62, 'El Menzel'),
(63, 'Guigou'),
(64, 'Imouzzer Kandar'),
(65, 'Imouzzer Marmoucha'),
(66, 'Missour'),
(67, 'Moulay Yaâcoub'),
(68, 'Ouled Tayeb'),
(69, 'Outat El Haj'),
(70, 'Ribate El Kheir'),
(71, 'Séfrou'),
(72, 'Skhinate'),
(73, 'Tafajight'),
(74, 'Arbaoua'),
(75, 'Aïn Dorij'),
(76, 'Dar Gueddari'),
(77, 'Had Kourt'),
(78, 'Jorf El Melha'),
(79, 'Kénitra'),
(80, 'Khenichet'),
(81, 'Lalla Mimouna'),
(82, 'Mechra Bel Ksiri'),
(83, 'Mehdia'),
(84, 'Moulay Bousselham'),
(85, 'Sidi Allal Tazi'),
(86, 'Sidi Kacem'),
(87, 'Sidi Slimane'),
(88, 'Sidi Taibi'),
(89, 'Sidi Yahya El Gharb'),
(90, 'Souk El Arbaa'),
(91, 'Akka'),
(92, 'Assa'),
(93, 'Bouizakarne'),
(94, 'El Ouatia'),
(95, 'Es-Semara'),
(96, 'Fam El Hisn'),
(97, 'Foum Zguid'),
(98, 'Guelmim'),
(99, 'Taghjijt'),
(100, 'Tan-Tan'),
(101, 'Tata'),
(102, 'Zag'),
(103, 'Marrakech'),
(104, 'Ait Daoud'),
(115, 'Amizmiz'),
(116, 'Assahrij'),
(117, 'Aït Ourir'),
(118, 'Ben Guerir'),
(119, 'Chichaoua'),
(120, 'El Hanchane'),
(121, 'El Kelaâ des Sraghna'),
(122, 'Essaouira'),
(123, 'Fraïta'),
(124, 'Ghmate'),
(125, 'Ighounane'),
(126, 'Imintanoute'),
(127, 'Kattara'),
(128, 'Lalla Takerkoust'),
(129, 'Loudaya'),
(130, 'Lâattaouia'),
(131, 'Moulay Brahim'),
(132, 'Mzouda'),
(133, 'Ounagha'),
(134, 'Sid L\'Mokhtar'),
(135, 'Sid Zouin'),
(136, 'Sidi Abdallah Ghiat'),
(137, 'Sidi Bou Othmane'),
(138, 'Sidi Rahhal'),
(139, 'Skhour Rehamna'),
(140, 'Smimou'),
(141, 'Tafetachte'),
(142, 'Tahannaout'),
(143, 'Talmest'),
(144, 'Tamallalt'),
(145, 'Tamanar'),
(146, 'Tamansourt'),
(147, 'Tameslouht'),
(148, 'Tanalt'),
(149, 'Zeubelemok'),
(150, 'Meknès'),
(151, 'Khénifra'),
(152, 'Agourai'),
(153, 'Ain Taoujdate'),
(154, 'MyAliCherif'),
(155, 'Rissani'),
(156, 'Amalou Ighriben'),
(157, 'Aoufous'),
(158, 'Arfoud'),
(159, 'Azrou'),
(160, 'Aïn Jemaa'),
(161, 'Aïn Karma'),
(162, 'Aïn Leuh'),
(163, 'Aït Boubidmane'),
(164, 'Aït Ishaq'),
(165, 'Boudnib'),
(166, 'Boufakrane'),
(167, 'Boumia'),
(168, 'El Hajeb'),
(169, 'Elkbab'),
(170, 'Er-Rich'),
(171, 'Errachidia'),
(172, 'Gardmit'),
(173, 'Goulmima'),
(174, 'Gourrama'),
(175, 'Had Bouhssoussen'),
(176, 'Haj Kaddour'),
(177, 'Ifrane'),
(178, 'Itzer'),
(179, 'Jorf'),
(180, 'Kehf Nsour'),
(181, 'Kerrouchen'),
(182, 'M\'haya'),
(183, 'M\'rirt'),
(184, 'Midelt'),
(185, 'Moulay Ali Cherif'),
(186, 'Moulay Bouazza'),
(187, 'Moulay Idriss Zerhoun'),
(188, 'Moussaoua'),
(189, 'N\'Zalat Bni Amar'),
(190, 'Ouaoumana'),
(191, 'Oued Ifrane'),
(192, 'Sabaa Aiyoun'),
(193, 'Sebt Jahjouh'),
(194, 'Sidi Addi'),
(195, 'Tichoute'),
(196, 'Tighassaline'),
(197, 'Tighza'),
(198, 'Timahdite'),
(199, 'Tinejdad'),
(200, 'Tizguite'),
(201, 'Toulal'),
(202, 'Tounfite'),
(203, 'Zaouia d\'Ifrane'),
(204, 'Zaïda'),
(205, 'Ahfir'),
(206, 'Aklim'),
(207, 'Al Aroui'),
(208, 'Aïn Bni Mathar'),
(209, 'Aïn Erreggada'),
(210, 'Ben Taïeb'),
(211, 'Berkane'),
(212, 'Bni Ansar'),
(213, 'Bni Chiker'),
(214, 'Bni Drar'),
(215, 'Bni Tadjite'),
(216, 'Bouanane'),
(217, 'Bouarfa'),
(218, 'Bouhdila'),
(219, 'Dar El Kebdani'),
(220, 'Debdou'),
(221, 'Douar Kannine'),
(222, 'Driouch'),
(223, 'El Aïoun Sidi Mellouk'),
(224, 'Farkhana'),
(225, 'Figuig'),
(226, 'Ihddaden'),
(227, 'Jaâdar'),
(228, 'Jerada'),
(229, 'Kariat Arekmane'),
(230, 'Kassita'),
(231, 'Kerouna'),
(232, 'Laâtamna'),
(233, 'Madagh'),
(234, 'Midar'),
(235, 'Nador'),
(236, 'Naima'),
(237, 'Oued Heimer'),
(238, 'Oujda'),
(239, 'Ras El Ma'),
(240, 'Saïdia'),
(241, 'Selouane'),
(242, 'Sidi Boubker'),
(243, 'Sidi Slimane Echcharaa'),
(244, 'Talsint'),
(245, 'Taourirt'),
(246, 'Tendrara'),
(247, 'Tiztoutine'),
(248, 'Touima'),
(249, 'Touissit'),
(250, 'Zaïo'),
(251, 'Zeghanghane'),
(252, 'Rabat'),
(253, 'Salé'),
(254, 'Ain El Aouda'),
(255, 'Harhoura'),
(256, 'Khémisset'),
(257, 'Oulmès'),
(258, 'Rommani'),
(259, 'Sidi Allal El Bahraoui'),
(260, 'Sidi Bouknadel'),
(261, 'Skhirat'),
(262, 'Tamesna'),
(263, 'Témara'),
(264, 'Tiddas'),
(265, 'Tiflet'),
(266, 'Touarga'),
(267, 'Agadir'),
(268, 'Agdz'),
(269, 'Agni Izimmer'),
(270, 'Aït Melloul'),
(271, 'Alnif'),
(272, 'Anzi'),
(273, 'Aoulouz'),
(274, 'Aourir'),
(275, 'Arazane'),
(276, 'Aït Baha'),
(277, 'Aït Iaâza'),
(278, 'Aït Yalla'),
(279, 'Ben Sergao'),
(280, 'Biougra'),
(281, 'Boumalne-Dadès'),
(282, 'Dcheira El Jihadia'),
(283, 'Drargua'),
(284, 'El Guerdane'),
(285, 'Harte Lyamine'),
(286, 'Ida Ougnidif'),
(287, 'Ifri'),
(288, 'Igdamen'),
(289, 'Ighil n\'Oumgoun'),
(290, 'Imassine'),
(291, 'Inezgane'),
(292, 'Irherm'),
(293, 'Kelaat-M\'Gouna'),
(294, 'Lakhsas'),
(295, 'Lakhsass'),
(296, 'Lqliâa'),
(297, 'M\'semrir'),
(298, 'Massa (Maroc)'),
(299, 'Megousse'),
(300, 'Ouarzazate'),
(301, 'Oulad Berhil'),
(302, 'Oulad Teïma'),
(303, 'Sarghine'),
(304, 'Sidi Ifni'),
(305, 'Skoura'),
(306, 'Tabounte'),
(307, 'Tafraout'),
(308, 'Taghzout'),
(309, 'Tagzen'),
(310, 'Taliouine'),
(311, 'Tamegroute'),
(312, 'Tamraght'),
(313, 'Tanoumrite Nkob Zagora'),
(314, 'Taourirt ait zaghar'),
(315, 'Taroudant'),
(316, 'Temsia'),
(317, 'Tifnit'),
(318, 'Tisgdal'),
(319, 'Tiznit'),
(320, 'Toundoute'),
(321, 'Zagora'),
(322, 'Afourar'),
(323, 'Aghbala'),
(324, 'Azilal'),
(325, 'Aït Majden'),
(326, 'Beni Ayat'),
(327, 'Béni Mellal'),
(328, 'Bin elouidane'),
(329, 'Bradia'),
(330, 'Bzou'),
(331, 'Dar Oulad Zidouh'),
(332, 'Demnate'),
(333, 'Dra\'a'),
(334, 'El Ksiba'),
(335, 'Foum Jamaa'),
(336, 'Fquih Ben Salah'),
(337, 'Kasba Tadla'),
(338, 'Ouaouizeght'),
(339, 'Oulad Ayad'),
(340, 'Oulad M\'Barek'),
(341, 'Oulad Yaich'),
(342, 'Sidi Jaber'),
(343, 'Souk Sebt Oulad Nemma'),
(344, 'Zaouïat Cheikh'),
(345, 'Tanger'),
(346, 'Tétouan'),
(347, 'Akchour'),
(348, 'Assilah'),
(349, 'Bab Berred'),
(350, 'Bab Taza'),
(351, 'Brikcha'),
(352, 'Chefchaouen'),
(353, 'Dar Bni Karrich'),
(354, 'Dar Chaoui'),
(355, 'Fnideq'),
(356, 'Gueznaia'),
(357, 'Jebha'),
(358, 'Karia'),
(359, 'Khémis Sahel'),
(360, 'KsarElKébir'),
(361, 'Larache'),
(362, 'M\'diq'),
(363, 'Martil'),
(364, 'Moqrisset'),
(365, 'Oued Laou'),
(366, 'Oued Rmel'),
(367, 'Ouezzane'),
(368, 'Point Cires'),
(369, 'Sidi Lyamani'),
(370, 'Sidi Mohamed ben Abdallah el-Raisuni'),
(371, 'Zinat'),
(372, 'Ajdir'),
(373, 'Aknoul'),
(374, 'Al Hoceïma'),
(375, 'Aït Hichem'),
(376, 'Bni Bouayach'),
(377, 'Bni Hadifa'),
(378, 'Ghafsai'),
(379, 'Guercif'),
(380, 'Imzouren'),
(381, 'Inahnahen'),
(382, 'Issaguen (Ketama)'),
(383, 'Karia (El Jadida)'),
(384, 'Karia Ba Mohamed'),
(385, 'Oued Amlil'),
(386, 'Oulad Zbair'),
(387, 'Tahla'),
(388, 'Tala Tazegwaght'),
(389, 'Tamassint'),
(390, 'Taounate'),
(391, 'Targuist'),
(392, 'Taza'),
(393, 'Taïnaste'),
(394, 'Thar Es-Souk'),
(395, 'Tissa'),
(396, 'Tizi Ouasli'),
(397, 'Laayoune'),
(398, 'El Marsa'),
(399, 'Tarfaya'),
(400, 'Boujdour'),
(401, 'Awsard'),
(402, 'Oued-Eddahab '),
(403, 'Stehat'),
(404, 'Aït Attab');

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
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`),
  ADD KEY `id_pers` (`id_pers`);

--
-- Index pour la table `cmd_fournisseur`
--
ALTER TABLE `cmd_fournisseur`
  ADD PRIMARY KEY (`id_cf`),
  ADD KEY `id_magasinier` (`id_mag`),
  ADD KEY `id_fournisseur` (`id_fournisseur`),
  ADD KEY `id_mag` (`id_mag`);

--
-- Index pour la table `commande_client`
--
ALTER TABLE `commande_client`
  ADD PRIMARY KEY (`id_cmdClient`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_vendeur` (`id_vendeur`);

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
-- Index pour la table `etat_cmd`
--
ALTER TABLE `etat_cmd`
  ADD PRIMARY KEY (`id_etat`);

--
-- Index pour la table `etre_detat`
--
ALTER TABLE `etre_detat`
  ADD PRIMARY KEY (`id_etat`,`id_cmdclient`),
  ADD KEY `id_cmdclient` (`id_cmdclient`);

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
-- Index pour la table `lc_client`
--
ALTER TABLE `lc_client`
  ADD PRIMARY KEY (`id_lc`),
  ADD KEY `id_cmdClient` (`id_cmdClient`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Index pour la table `lc_fournisseur`
--
ALTER TABLE `lc_fournisseur`
  ADD PRIMARY KEY (`id_lcf`),
  ADD KEY `id_cf` (`id_cf`),
  ADD KEY `id_Prod` (`id_Prod`);

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
  ADD PRIMARY KEY (`id_Pers`),
  ADD UNIQUE KEY `cin_pers` (`cin_pers`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`),
  ADD KEY `id_categorie` (`id_categ`),
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
  MODIFY `id_addr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `caissier`
--
ALTER TABLE `caissier`
  MODIFY `id_caissier` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `cmd_fournisseur`
--
ALTER TABLE `cmd_fournisseur`
  MODIFY `id_cf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `commande_client`
--
ALTER TABLE `commande_client`
  MODIFY `id_cmdClient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
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
-- AUTO_INCREMENT pour la table `etat_cmd`
--
ALTER TABLE `etat_cmd`
  MODIFY `id_etat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `id_facture` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id_fournisseur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `lc_client`
--
ALTER TABLE `lc_client`
  MODIFY `id_lc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `lc_fournisseur`
--
ALTER TABLE `lc_fournisseur`
  MODIFY `id_lcf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
  MODIFY `id_Pers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
  MODIFY `id_vendeur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `ville`
--
ALTER TABLE `ville`
  MODIFY `id_ville` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=405;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `addresse`
--
ALTER TABLE `addresse`
  ADD CONSTRAINT `addresse_ibfk_1` FOREIGN KEY (`id_pers`) REFERENCES `personne` (`id_Pers`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `addresse_ibfk_2` FOREIGN KEY (`id_ville`) REFERENCES `ville` (`id_ville`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`id_pers`) REFERENCES `personne` (`id_Pers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cmd_fournisseur`
--
ALTER TABLE `cmd_fournisseur`
  ADD CONSTRAINT `cmd_fournisseur_ibfk_1` FOREIGN KEY (`id_fournisseur`) REFERENCES `fournisseur` (`id_fournisseur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commande_client`
--
ALTER TABLE `commande_client`
  ADD CONSTRAINT `commande_client_ibfk_1` FOREIGN KEY (`id_vendeur`) REFERENCES `vendeur` (`id_vendeur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commande_client_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `etre_detat`
--
ALTER TABLE `etre_detat`
  ADD CONSTRAINT `etre_detat_ibfk_1` FOREIGN KEY (`id_etat`) REFERENCES `etat_cmd` (`id_etat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `etre_detat_ibfk_2` FOREIGN KEY (`id_cmdclient`) REFERENCES `commande_client` (`id_cmdClient`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `lc_fournisseur`
--
ALTER TABLE `lc_fournisseur`
  ADD CONSTRAINT `lc_fournisseur_ibfk_1` FOREIGN KEY (`id_cf`) REFERENCES `cmd_fournisseur` (`id_cf`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `cat` FOREIGN KEY (`id_categ`) REFERENCES `categorie` (`id_categorie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `vendeur`
--
ALTER TABLE `vendeur`
  ADD CONSTRAINT `vendeur_ibfk_1` FOREIGN KEY (`id_emp`) REFERENCES `employé` (`id_emp`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
