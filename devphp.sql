-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 18/09/2019 às 18:33
-- Versão do servidor: 5.7.26
-- Versão do PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `devphp`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `routes`
--

DROP TABLE IF EXISTS `routes`;
CREATE TABLE IF NOT EXISTS `routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `origin_route` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `destiny_route` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `autonomy_route` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `routes`
--

INSERT INTO `routes` (`id`, `origin_route`, `destiny_route`, `autonomy_route`, `created`, `modified`) VALUES
(1, 'A', 'B', 10, '2019-09-18 05:23:41', '2019-09-18 05:23:41'),
(2, 'B', 'D', 15, '2019-09-18 05:24:09', '2019-09-18 05:24:09'),
(3, 'A', 'C', 20, '2019-09-18 05:24:19', '2019-09-18 05:24:19'),
(4, 'C', 'D', 30, '2019-09-18 05:24:37', '2019-09-18 05:24:37'),
(5, 'B', 'E', 50, '2019-09-18 05:24:45', '2019-09-18 05:24:45'),
(6, 'D', 'E', 30, '2019-09-18 05:24:53', '2019-09-18 05:24:53');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `created`, `modified`) VALUES
(3, 'Arthur', 'arthur@contele.com', '2019-09-18 00:00:00', NULL),
(2, 'Amarildo', 'amarildo@contele.com', '2019-09-18 00:00:00', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
