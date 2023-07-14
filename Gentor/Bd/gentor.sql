-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  lun. 23 jan. 2023 à 22:58
-- Version du serveur :  8.0.17
-- Version de PHP :  7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gentor`
--

-- --------------------------------------------------------

--
-- Structure de la table `project`
--

CREATE TABLE `project` (
  `projectId` int(255) NOT NULL,
  `projectName` varchar(500) NOT NULL,
  `userId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `project`
--

INSERT INTO `project` (`projectId`, `projectName`, `userId`) VALUES
(1, 'Workzone', 1),
(2, 'Gentor', 1),
(3, 'AnyChart', 1),
(5, 'Test', 1);

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `taskNbr` int(255) NOT NULL,
  `taskName` varchar(500) NOT NULL,
  `taskDuration` int(255) NOT NULL,
  `predecessor` varchar(255) NOT NULL,
  `projectId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `task`
--

INSERT INTO `task` (`id`, `taskNbr`, `taskName`, `taskDuration`, `predecessor`, `projectId`) VALUES
(1, 1, 'a', 4, '', 1),
(2, 2, 'b', 5, '1', 1),
(3, 3, 'c', 7, '12', 1),
(4, 4, 'd', 3, '3', 1),
(5, 5, 'e', 1, '4', 1),
(6, 1, 'a', 7, '2', 2),
(7, 2, 'b', 6, '', 2),
(8, 3, 'c', 4, '1', 2),
(9, 4, 'd', 2, '23', 2),
(10, 5, 'e', 1, '12', 2),
(11, 6, 'f', 5, '5', 2),
(13, 2, 'b', 4, '', 3),
(14, 3, 'c', 3, '', 3),
(15, 4, 'd', 1, '', 3),
(16, 5, 'e', 2, '14', 3),
(17, 6, 'f', 2, '23', 3),
(19, 1, 'a', 4, '', 5),
(20, 2, 'b', 4, '1', 5),
(21, 3, 'c', 8, '12', 5),
(22, 4, 'd', 2, '3', 5);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(30) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`) VALUES
(1, 'BouzianiSaid', 'Bouziani@email.com', '202cb962ac59075b964b07152d234b70'),
(2, 'BouzianeErrahmaniAkram', 'akram@email.com', '250cf8b51c773f3f8dc8b4be867a9a02'),
(3, 'BouzianeAmin', 'amin@email.com', '68053af2923e00204c3ca7c6a3150cf7');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`projectId`),
  ADD KEY `userId` (`userId`);

--
-- Index pour la table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projectId` (`projectId`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `project`
--
ALTER TABLE `project`
  MODIFY `projectId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `userId` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `projectId` FOREIGN KEY (`projectId`) REFERENCES `project` (`projectId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
