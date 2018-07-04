-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 04 juil. 2018 à 08:35
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `usend`
--

-- --------------------------------------------------------

--
-- Structure de la table `fichiers`
--

DROP TABLE IF EXISTS `fichiers`;
CREATE TABLE IF NOT EXISTS `fichiers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_fichier` varchar(255) NOT NULL,
  `mail_user` varchar(255) NOT NULL,
  `mail_dest` varchar(255) NOT NULL,
  `msg_user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fichiers`
--

INSERT INTO `fichiers` (`id`, `nom_fichier`, `mail_user`, `mail_dest`, `msg_user`) VALUES
(1, '1530273764wverrors.jpg', 'efe@fofo.com', 'efe@fofo.com', ''),
(2, '1530274211wverrors.jpg', 'efe@fofo.com', 'efe@fofo.com', ''),
(3, '1530274231wverrors.jpg', 'fscc@dfjidfh.com', 'fscc@dfjidfh.com', ''),
(4, '1530274323wverrors.jpg', 'fscc@dfjidfh.com', 'fscc@dfjidfh.com', ''),
(5, '1530274391wverrors.jpg', 'fscc@dfjidfh.com', 'fscc@dfjidfh.com', ''),
(6, '1530274405wverrors.jpg', 'fscc@dfjidfh.com', 'fscc@dfjidfh.com', ''),
(7, '1530274526wverrors.jpg', 'fscc@dfjidfh.com', 'fscc@dfjidfh.com', ''),
(8, '1530274621wverrors.jpg', 'fscc@dfjidfh.com', 'fscc@dfjidfh.com', ''),
(9, '1530274686wverrors.jpg', 'fscc@dfjidfh.com', 'fscc@dfjidfh.com', ''),
(10, '1530274760wverrors.jpg', 'fscc@dfjidfh.com', 'fscc@dfjidfh.com', ''),
(11, '1530274787wverrors.jpg', 'fscc@dfjidfh.com', 'fscc@dfjidfh.com', ''),
(12, '1530275077wallpaper.jpg', 'ede@fofo.com', 'efe@fofo.com', ''),
(13, '1530279932wallpaper.jpg', 'ede@fofo.com', 'efe@fofo.com', ''),
(14, '1530279979wverrors.jpg', 'jerome.r@codeur.online', 'jerome.r@codeur.online', ''),
(15, '1530280169wverrors.jpg', 'jerome.r@codeur.online', 'jerome.r@codeur.online', ''),
(16, '1530280206wverrors.jpg', 'jerome.r@codeur.online', 'loan.p@codeur.online', ''),
(17, '1530282451wverrors.jpg', 'jerome.r@codeur.online', 'loan.p@codeur.online', ''),
(18, '1530602190img-placeholder.jpg', 'jerome.r@codeur.online', 'ines.b@codeur.online', ''),
(19, '1530602592img-placeholder.jpg', 'jerome.r@codeur.online', 'ines.b@codeur.online', ''),
(20, '1530602885img-placeholder.jpg', 'jerome.r@codeur.online', 'ines.b@codeur.online', ''),
(21, '1530602942img-placeholder.jpg', 'jerome.r@codeur.online', 'ines.b@codeur.online', ''),
(22, '1530603342img-placeholder.jpg', 'jerome.r@codeur.online', 'ines.b@codeur.online', ''),
(23, '1530603601img-placeholder.jpg', 'jerome.r@codeur.online', 'ines.b@codeur.online', ''),
(24, '1530603636img-placeholder.jpg', 'jerome.r@codeur.online', 'ines.b@codeur.online', ''),
(25, '1530603678img-placeholder.jpg', 'jerome.r@codeur.online', 'ines.b@codeur.online', ''),
(26, '1530603857img-placeholder.jpg', 'jerome.r@codeur.online', 'ines.b@codeur.online', ''),
(27, '1530604432barre-logo.png', 'jerome.r@codeur.online', 'ines.b@codeur.online', ''),
(28, '1530610446IMG_20180702_105745.jpg', 'jerome.r@codeur.online', 'ines.b@codeur.online', ''),
(29, '1530610515maxresdefault.jpg', 'jerome.r@codeur.online', 'ines.b@codeur.online', ''),
(30, '1530610964barre-logo.png', 'jerome.r@codeur.online', 'ines.b@codeur.online', ''),
(31, '1530611013barre-logo.png', 'jerome.r@codeur.online', 'ines.b@codeur.online', ''),
(32, '1530611063barre-logo.png', 'jerome.r@codeur.online', 'ines.b@codeur.online', ''),
(33, '1530611279barre-logo.png', 'jerome.r@codeur.online', 'ines.b@codeur.online', ''),
(34, '1530611332barre-logo.png', 'jerome.r@codeur.online', 'ines.b@codeur.online', ''),
(35, '1530611789bg_header.png', 'jerome.r@codeur.online', 'ines.b@codeur.online', ''),
(36, '1530611864barre-logo.png', 'jerome.r@codeur.online', 'ines.b@codeur.online', ''),
(37, '1530611892barre-logo.png', 'jerome.r@codeur.online', 'ines.b@codeur.online', ''),
(38, '1530612031barre-logo.png', 'jerome.r@codeur.online', 'ines.b@codeur.online', ''),
(39, '1530617873bg_header.png', 'jerome.r@codeur.online', 'ines.b@codeur.online', ''),
(40, '1530618117bg_header.png', 'ines.b@codeur.online', 'jerome.r@codeur.online', ''),
(41, '1530618139bg_header.png', 'ines.b@codeur.online', 'jerome.r@codeur.online', ''),
(42, '1530618149bg_header.png', 'ines.b@codeur.online', 'jerome.r@codeur.online', ''),
(43, '1530619117bg_header.png', 'ines.b@codeur.online', 'jerome.r@codeur.online', ''),
(44, '1530619267bg_header.png', 'usend@outlook.fr', 'jerome.r@codeur.online', ''),
(45, '1530619598bg_header.png', 'usend@outlook.fr', 'jerome.r@codeur.online', ''),
(46, '1530619633bg_header.png', 'usend@outlook.fr', 'jerome.r@codeur.online', ''),
(47, '1530619659bg_header.png', 'usend@outlook.fr', 'ines.b@codeur.online', ''),
(48, '1530619806img-placeholder.jpg', 'usend@outlook.fr', 'ines.b@codeur.online', ''),
(49, '1530620128img-placeholder.jpg', 'usend@outlook.fr', 'ines.b@codeur.online', ''),
(50, '1530620144bg_header.png', 'usend@outlook.fr', 'ines.b@codeur.online', ''),
(51, '1530620191bg_header.png', 'usend@outlook.fr', 'ines.b@codeur.online', ''),
(52, '1530620225bg_header.png', 'usend@outlook.fr', 'ines.b@codeur.online', ''),
(53, '1530620278bg_header.png', 'usend@outlook.fr', 'ines.b@codeur.online', ''),
(54, '1530620518bg_header.png', 'usend@outlook.fr', 'ines.b@codeur.online', ''),
(55, '1530620793bg_header.png', 'usend@outlook.fr', 'ines.b@codeur.online', ''),
(56, '1530620859bg_header.png', 'usend@outlook.fr', 'ines.b@codeur.online', ''),
(57, '1530620877bg_header.png', 'usend@outlook.fr', 'ines.b@codeur.online', ''),
(58, '1530621796bg_header.png', 'usend@outlook.fr', 'ines.b@codeur.online', ''),
(59, '1530621833bg_header.png', 'usend@outlook.fr', 'ines.b@codeur.online', ''),
(60, '1530626783bg_header.png', 'usend@outlook.fr', 'romain.w@codeur.online', ''),
(61, '1530627170bg_header.png', 'usend@outlook.fr', 'jerome.r@codeur.online', ''),
(62, '1530627447bg_header.png', 'usend@outlook.fr', 'jerome.r@codeur.online', ''),
(63, '1530627485barre-logo.png', 'jerome.r@codeur.online', 'romain.w@codeur.online', ''),
(64, '15306276255ab4c9226e275ee2ec91b81a85134440.gif', 'jerome.r@codeur.online', 'jerome.r@codeur.online', ''),
(65, '15306276915ab4c9226e275ee2ec91b81a85134440.gif', 'jerome.r@codeur.online', 'jerome.r@codeur.online', ''),
(66, '1530690325barre-logo.png', 'usend@outlook.fr', 'jerome.r@codeur.online', 'Bonjour'),
(67, '1530690386barre-logo.png', 'usend@outlook.fr', 'jerome.r@codeur.online', 'Bonjour'),
(68, '1530690610barre-logo.png', 'usend@outlook.fr', 'jerome.r@codeur.online', 'Bonjour'),
(69, '1530691114bg_header.png', 'usend@outlook.fr', 'jerome.r@codeur.online', 'Hey ca va ?'),
(70, '1530692554bg_header.png', 'usend@outlook.fr', 'jerome.r@codeur.online', 'Hey ca va ?'),
(71, '1530692758bg_header.png', 'usend@outlook.fr', 'jerome.r@codeur.online', 'Hey ca va ?');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
