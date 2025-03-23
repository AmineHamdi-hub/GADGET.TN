-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 26 déc. 2024 à 15:26
-- Version du serveur : 8.3.0
-- Version de PHP : 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mon projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `adminID` int NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` varchar(50) DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`adminID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`adminID`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Admin One', 'admin1@example.com', '$2y$10$OBteIaVSg2nuvrOzWiuFHOUG7rlYuEojSi.X0yS2r0XNAFmFsjAAi', 'admin', '2024-12-12 16:25:45'),
(2, 'Admin Two', 'admin2@example.com', '$2y$10$r1Kn9.tipO1wEcgGKEMUA.ITDhOHtYMaFUxBfHo.joEtNzwcMjjgO', 'admin', '2024-12-12 16:25:45'),
(3, 'Admin Three', 'admin3@example.com', '$2y$10$FE/8gZhWrWp3P3gep//w.eA9kBzxrOn5DEePhOtkZu2TTOFrtO.A2', 'admin', '2024-12-12 16:25:45');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(1, 'homme', 'Produits pour hommes'),
(2, 'femme', 'Produits pour femmes'),
(3, 'electronics', 'Appareils électroniques'),
(4, 'sport', 'Produits pour le sport'),
(5, 'pour-maison', 'Produits pour la maison'),
(6, 'cosmetiques', 'Produits cosmétiques et de beauté');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `address` text NOT NULL,
  `status` enum('pending','completed','canceled') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `category_id` int NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `category_id`, `image_url`) VALUES
(1, 'Montre Homme', 'Montre en acier', 120.00, 50, 1, 'inc/images/1.jpg'),
(2, 'Télévision', 'Écran 4K 55 pouces', 500.00, 5, 3, 'inc/images/2.jpg'),
(3, 'Ballon de Foot', 'Ballon officiel', 25.00, 20, 4, 'inc/images/3.jpg'),
(4, 'Ordinateur Portable', 'PC portable 15 pouces', 800.00, 15, 3, 'inc/images/4.jpg'),
(5, 'Chaussures Femme', 'Chaussures en cuir pour femmes', 50.00, 25, 2, 'inc/images/5.jpeg'),
(6, 'Réfrigérateur', 'Réfrigérateur 300L', 600.00, 8, 5, 'inc/images/6.jpg'),
(7, 'Veste Sport', 'Veste de sport pour hommes', 40.00, 12, 4, 'inc/images/7.jpg'),
(8, 'Rouge à Lèvres', 'Rouge à lèvres hydratant', 15.00, 30, 6, 'inc/images/8.webp'),
(9, 'Casque Audio', 'Casque sans fil Bluetooth', 100.00, 18, 3, 'inc/images/9.webp'),
(10, 'Table Basse', 'Table basse en bois pour salon', 120.00, 10, 5, 'inc/images/10.jpg'),
(11, 'T-shirt Homme', 'T-shirt en coton', 25.00, 40, 1, 'inc/images/11.jpg'),
(12, 'Vélo de Course', 'Vélo de course avec cadre en aluminium', 350.00, 5, 4, 'inc/images/12.jpg'),
(13, 'Parfum Femme', 'Parfum floral', 45.00, 15, 2, 'inc/images/13.jpg'),
(14, 'Smartphone', 'Smartphone Android avec caméra 12 MP', 250.00, 50, 3, 'inc/images/14.webp'),
(15, 'Chaussures de Running', 'Chaussures de sport pour course', 60.00, 30, 4, 'inc/images/15.jpg'),
(16, 'Sac à Main', 'Sac à main en cuir pour femmes', 120.00, 25, 2, 'inc/images/16.jpg'),
(17, 'Cafetière', 'Cafetière à filtre, 1.2L', 40.00, 10, 5, 'inc/images/17.jpg'),
(18, 'Shampooing', 'Shampooing nourrissant', 12.00, 40, 6, 'inc/images/18.jpg'),
(19, 'Lampe de Bureau', 'Lampe LED pour bureau', 25.00, 15, 5, 'inc/images/19.jpg'),
(24, 'SAMSUNG A14', ' Smartphone SAMSUNG Galaxy A14- SM-A146UZKDXAA  / Ecran : FHD+ Infinity-V de 6,6P LCD PLS -  90Hz (1080 x 2408)pixels / Processeur : Mediatek MT6833 Hélio G80 - Dimension 7 nm Octa-cœur (2x2,4 GHz et 6x2,0 GHz) / Système d’exploitation : Android 13.0 / Mémoire RAM : 4Go / Stockage : 128 Go / Appareil photo arrière : Principal : 50Mpx, F1.8 + Macro 2MP, F2.4 + Profondeur 2MP, F2.4 Flash LED, panorama, HDR 1080p@30fps Avant : 13 Mpx, f/2.0 1080p@30fps / Capacité de Batterie : 5000 mAh avec Wifi 4G et Bluetooth 5.2, GPS / Capteur d’empreintes digitales / Garantie 1an.', 660.00, 10, 3, 'inc/images/samsung_smartphone_galaxy_a14_3__1.png');

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `reviewID` int NOT NULL AUTO_INCREMENT,
  `userID` int DEFAULT NULL,
  `productID` int DEFAULT NULL,
  `rating` float(2,1) DEFAULT NULL,
  `comment` text,
  `dateCreated` datetime DEFAULT NULL,
  PRIMARY KEY (`reviewID`),
  KEY `userID` (`userID`),
  KEY `productID` (`productID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'amine', 'aminee02@gmail.com', '$2y$10$feC4IjQJjUMJSQVfthqX2eqiZhYlBWPNeDFmAptZGKX6mHo.vziR6', '2024-12-22 21:04:51'),
(2, 'amine1', 'amine.hamdi@enis.tn', '$2y$10$Ib8cDMoKtZuVSF43TSI0F.9lphb0KN5ByIjpt6OGjRW6k/FI6lTlG', '2024-12-23 11:58:19'),
(3, 'amine1', 'aminee02@hotmail.fr', '$2y$10$M2rLVL1NwdYEMzePYxzA1eJHTonD2TlCPFk9f.fVXd5R5wwi2Cv86', '2024-12-23 21:04:00');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT;

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
