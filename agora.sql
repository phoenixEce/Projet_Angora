-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 15 déc. 2024 à 22:39
-- Version du serveur : 9.0.1
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `agora`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id_article` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` text,
  `categorie` enum('Articles rares','Articles haut de gamme','Articles reguliers') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `type_vente` enum('Achat immediat','Negotiation','Meilleure offre') NOT NULL,
  `statut` enum('Disponible','Vendu','En negociation') NOT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `id_vendeur` int NOT NULL,
  PRIMARY KEY (`id_article`),
  KEY `id_vendeur` (`id_vendeur`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id_article`, `nom`, `description`, `categorie`, `prix`, `type_vente`, `statut`, `photo_url`, `video_url`, `id_vendeur`) VALUES
(1, 'Montre en diamant', 'Montre de la période Edo de la dynastie Ming', 'Articles haut de gamme', 7800.00, 'Achat immediat', 'Disponible', 'C:\\fakepath\\SM Ghomsi Décor Logo (1).png', NULL, 1),
(5, 'Montre en diamant', 'Montre de la période Edo de la dynastie Ming', 'Articles haut de gamme', 5500.00, 'Meilleure offre', 'Disponible', 'C:\\fakepath\\montre 1.png', NULL, 1),
(6, 'Montre en bois Camerounais', 'Montre en Argent fond noir ', 'Articles haut de gamme', 25000.00, 'Negotiation', 'Disponible', '../../uploads/SM Ghomsi Décor Logo (1).png', NULL, 1),
(7, 'Montre en bois D\'ebene Camerounais', 'Montre en Argent fond noir ', 'Articles reguliers', 250000.00, 'Meilleure offre', 'Disponible', '../../uploads/montre 1.png', NULL, 1),
(8, 'Montre en Cuivre', 'Montre de la période Edo de la dynastie Ming', 'Articles reguliers', 7800.00, 'Meilleure offre', 'Disponible', '../../uploads/SM Ghomsi Décor Logo (1).png', NULL, 2),
(9, 'Montre en Vermail', 'Montre de la période Edo de la dynastie Ming', 'Articles rares', 9800.00, 'Meilleure offre', 'Disponible', '../../uploads/Payer.jpg', NULL, 2),
(10, 'Montre en Vermail', 'Montre de la période Edo de la dynastie Ming', 'Articles rares', 9800.00, 'Meilleure offre', 'Disponible', '../../uploads/Payer.jpg', NULL, 2),
(11, 'Montre en Vermail', 'Montre de la période Edo de la dynastie Ming', 'Articles rares', 9900.00, 'Meilleure offre', 'Disponible', '../../uploads/image.jpeg', NULL, 2),
(12, 'Montre en Vermail2', 'Montre de la période Edo de la dynastie Ming', 'Articles rares', 9900.00, 'Achat immediat', 'Disponible', '', NULL, 2),
(13, 'Montre en Verma', 'Montre de la période Edo de la dynastie Ming', 'Articles rares', 9900.00, 'Achat immediat', 'Disponible', '../../uploads/Payer.jpg', NULL, 2),
(14, 'Montre en Verma', 'Montre de la période Edo de la dynastie Ming', 'Articles haut de gamme', 1900.00, 'Meilleure offre', 'Disponible', '', NULL, 2);

-- --------------------------------------------------------

--
-- Structure de la table `enchere`
--

DROP TABLE IF EXISTS `enchere`;
CREATE TABLE IF NOT EXISTS `enchere` (
  `id_enchere` int NOT NULL AUTO_INCREMENT,
  `id_article` int NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `prix_initial` decimal(10,2) NOT NULL,
  `prix_final` decimal(10,2) DEFAULT NULL,
  `gagnant` int DEFAULT NULL,
  PRIMARY KEY (`id_enchere`),
  KEY `id_article` (`id_article`),
  KEY `gagnant` (`gagnant`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `enchere`
--

INSERT INTO `enchere` (`id_enchere`, `id_article`, `date_debut`, `date_fin`, `prix_initial`, `prix_final`, `gagnant`) VALUES
(1, 9, '2024-12-01', '2024-12-02', 9900.00, 0.00, NULL),
(2, 13, '2024-12-01', '2024-12-01', 1900.00, 0.00, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `negotiation`
--

DROP TABLE IF EXISTS `negotiation`;
CREATE TABLE IF NOT EXISTS `negotiation` (
  `id_negotiation` int NOT NULL AUTO_INCREMENT,
  `id_article` int NOT NULL,
  `id_vendeur` int NOT NULL,
  `id_acheteur` int NOT NULL,
  `offre_acheteur` decimal(10,2) NOT NULL,
  `contre_offre_vendeur` decimal(10,2) DEFAULT '0.00',
  `statut_negotiation` enum('En cours','Conclue','Echouee') NOT NULL,
  PRIMARY KEY (`id_negotiation`),
  KEY `id_article` (`id_article`),
  KEY `id_vendeur` (`id_vendeur`),
  KEY `id_acheteur` (`id_acheteur`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `negotiation`
--

INSERT INTO `negotiation` (`id_negotiation`, `id_article`, `id_vendeur`, `id_acheteur`, `offre_acheteur`, `contre_offre_vendeur`, `statut_negotiation`) VALUES
(1, 1, 1, 1, 19900.00, 2500.00, 'Conclue'),
(4, 1, 1, 1, 9600.00, 5800.00, 'Conclue'),
(5, 1, 1, 1, 9000.00, 9100.00, 'Conclue'),
(6, 1, 1, 1, 9000.00, 0.00, 'En cours'),
(7, 5, 1, 3, 5400.00, 700.00, 'En cours'),
(8, 8, 2, 3, 7900.00, 0.00, 'En cours');

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id_notification` int NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int NOT NULL,
  `message` text NOT NULL,
  `date_envoi` datetime NOT NULL,
  `statut` enum('Lue','Non lue') NOT NULL,
  PRIMARY KEY (`id_notification`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`id_notification`, `id_utilisateur`, `message`, `date_envoi`, `statut`) VALUES
(1, 1, 'Offre mise à jour par le client', '2024-12-14 03:25:10', 'Lue'),
(2, 1, 'Offre mise à jour par le client à hauteur de97800$', '2024-12-14 03:43:12', 'Lue'),
(3, 1, 'Offre mise à jour par le client à hauteur de900$', '2024-12-14 03:48:20', 'Lue'),
(4, 1, 'Offre mise à jour par le client à hauteur de9000$', '2024-12-14 03:50:48', 'Lue'),
(5, 1, 'Nouvelle Contre Offre mise à jour par le vendeur à hauteur de 5800$', '2024-12-14 03:57:41', 'Lue'),
(6, 1, 'Offre mise à jour par le client à hauteur de 9600$', '2024-12-14 03:58:28', 'Lue'),
(7, 1, 'Offre acceptée par le vendeur', '2024-12-14 03:59:15', 'Lue'),
(8, 1, 'Nouvelle Offre mise à jour par le client à hauteur de 9000$', '2024-12-14 11:11:37', 'Lue'),
(9, 1, 'Nouvelle Contre Offre mise à jour par le vendeur à hauteur de 9100$', '2024-12-14 11:14:36', 'Non lue'),
(10, 1, 'Offre refusée par le vendeur', '2024-12-14 11:15:58', 'Non lue'),
(11, 1, 'Offre refusée par le vendeur', '2024-12-14 11:15:59', 'Non lue'),
(12, 1, 'Offre acceptée par le vendeur', '2024-12-14 15:57:54', 'Non lue'),
(13, 1, 'Nouvelle Offre mise à jour par le client à hauteur de 9000$', '2024-12-14 16:02:21', 'Non lue'),
(14, 1, 'Nouvelle Offre mise à jour par le client à hauteur de 300$', '2024-12-15 22:01:51', 'Non lue'),
(15, 1, 'Offre mise à jour par le client à hauteur de 300$', '2024-12-15 22:02:51', 'Non lue'),
(16, 1, 'Nouvelle Contre Offre mise à jour par le vendeur à hauteur de 700$', '2024-12-15 22:07:36', 'Non lue'),
(17, 1, 'Offre mise à jour par le client à hauteur de 5400$', '2024-12-15 22:34:34', 'Non lue'),
(18, 1, 'Nouvelle Offre mise à jour par le client à hauteur de 7900$', '2024-12-15 22:36:09', 'Non lue'),
(19, 3, 'Offre mise à jour par le client à hauteur de 5400$', '2024-12-15 22:41:53', 'Lue');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id_panier` int NOT NULL AUTO_INCREMENT,
  `id_acheteur` int NOT NULL,
  `id_article` int NOT NULL,
  `quantite` int NOT NULL,
  `date_creation` datetime NOT NULL,
  PRIMARY KEY (`id_panier`),
  KEY `id_acheteur` (`id_acheteur`),
  KEY `id_article` (`id_article`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id_panier`, `id_acheteur`, `id_article`, `quantite`, `date_creation`) VALUES
(2, 2, 5, 1, '2024-12-15 19:56:59');

-- --------------------------------------------------------

--
-- Structure de la table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `id_transaction` int NOT NULL AUTO_INCREMENT,
  `id_acheteur` int NOT NULL,
  `id_article` int NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `date_transaction` datetime NOT NULL,
  `mode_paiement` enum('Carte','Cheque-cadeau') NOT NULL,
  `statut_transaction` enum('Reussie','Echouee') NOT NULL,
  PRIMARY KEY (`id_transaction`),
  KEY `id_acheteur` (`id_acheteur`),
  KEY `id_article` (`id_article`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `transaction`
--

INSERT INTO `transaction` (`id_transaction`, `id_acheteur`, `id_article`, `montant`, `date_transaction`, `mode_paiement`, `statut_transaction`) VALUES
(1, 2, 5, 5500.00, '2024-12-15 19:54:28', 'Carte', 'Reussie'),
(2, 3, 5, 5500.00, '2024-12-15 20:05:50', 'Carte', 'Reussie'),
(3, 3, 1, 7800.00, '2024-12-15 20:05:50', 'Carte', 'Reussie');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `adresse_ligne1` varchar(255) DEFAULT NULL,
  `adresse_ligne2` varchar(255) DEFAULT NULL,
  `ville` varchar(100) DEFAULT NULL,
  `code_postal` varchar(20) DEFAULT NULL,
  `pays` varchar(100) DEFAULT NULL,
  `numero_telephone` varchar(20) DEFAULT NULL,
  `type_utilisateur` enum('Administrateur','Vendeur','Client') NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom`, `prenom`, `email`, `mot_de_passe`, `adresse_ligne1`, `adresse_ligne2`, `ville`, `code_postal`, `pays`, `numero_telephone`, `type_utilisateur`) VALUES
(1, 'Tiechou', 'Sandrine', 'njeunsan@gmail.com', '1234', '19 Rue du clouseau', NULL, 'Villiers', '75695', 'France', '+3365987456122', 'Vendeur'),
(2, 'Abba BARKA', 'Saleh Abou', 'sabba@acerfi.net', '$2y$10$9.z.lpBZejOgJkNT8Sfw7.oCYAlBEm2eMKSo1EknVF4PM8NSUh296', 'Ozoir la ferriere', NULL, 'Yaoundé', '77330', 'Cameroun', '0759515113', 'Vendeur'),
(3, 'Kanga', 'Jules Dareen', 'jkanga@edu.ece.fr', '$2y$10$QnWizRNF30iR.IneZCC45.bGIzGpSIsIlgUi.wUJbkDiRxY5fkR32', '12 Rue de Gagny', NULL, 'Gagny', '77330', 'France', '0759515113', 'Client');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`id_vendeur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `enchere`
--
ALTER TABLE `enchere`
  ADD CONSTRAINT `enchere_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`),
  ADD CONSTRAINT `enchere_ibfk_2` FOREIGN KEY (`gagnant`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `negotiation`
--
ALTER TABLE `negotiation`
  ADD CONSTRAINT `negotiation_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`),
  ADD CONSTRAINT `negotiation_ibfk_2` FOREIGN KEY (`id_vendeur`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `negotiation_ibfk_3` FOREIGN KEY (`id_acheteur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`id_acheteur`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`);

--
-- Contraintes pour la table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`id_acheteur`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
