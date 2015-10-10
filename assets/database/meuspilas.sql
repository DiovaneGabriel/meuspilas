-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 10-Out-2015 às 02:01
-- Versão do servidor: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meuspilas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `familia`
--

CREATE TABLE IF NOT EXISTS `familia` (
  `ID` int(10) NOT NULL,
  `NOME` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `familia`
--

INSERT INTO `familia` (`ID`, `NOME`) VALUES
(1, 'Barbieri Gabriel');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(10) NOT NULL,
  `familia_id` int(10) NOT NULL,
  `nome` varchar(30) CHARACTER SET utf8 NOT NULL,
  `sobrenome` varchar(30) CHARACTER SET utf8 NOT NULL,
  `senha_md5` varchar(32) CHARACTER SET utf16 NOT NULL,
  `email` varchar(30) CHARACTER SET ucs2 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `familia_id`, `nome`, `sobrenome`, `senha_md5`, `email`) VALUES
(2, 1, 'Diovane', 'Barbieri Gabriel', 'c97feedb66e944ed74b40d26e76a5f06', 'diovane.gabriel@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `familia`
--
ALTER TABLE `familia`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `familia`
--
ALTER TABLE `familia`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
