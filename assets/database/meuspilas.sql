-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 12-Out-2015 às 02:05
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
-- Estrutura da tabela `conta`
--

CREATE TABLE IF NOT EXISTS `conta` (
  `id` int(10) NOT NULL,
  `familia_id` int(10) NOT NULL,
  `descricao` varchar(50) CHARACTER SET utf8 NOT NULL,
  `saldo` decimal(18,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `conta`
--

INSERT INTO `conta` (`id`, `familia_id`, `descricao`, `saldo`) VALUES
(1, 1, 'Conta Conrrente', '300.00'),
(3, 1, 'Carteira Diovane', '0.00'),
(4, 1, 'Carteira Jacque', '0.00'),
(7, 1, 'Refeisul', '0.00'),
(8, 1, 'Poupança', '0.00');

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
-- Estrutura da tabela `movimento`
--

CREATE TABLE IF NOT EXISTS `movimento` (
  `id` int(10) NOT NULL,
  `familia_id` int(10) NOT NULL,
  `usuario_id` int(10) NOT NULL,
  `conta_id` int(10) NOT NULL,
  `data` date NOT NULL,
  `entrada_saida` varchar(1) CHARACTER SET utf8 NOT NULL,
  `descricao` varchar(50) CHARACTER SET utf8 NOT NULL,
  `valor` decimal(18,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `movimento`
--

INSERT INTO `movimento` (`id`, `familia_id`, `usuario_id`, `conta_id`, `data`, `entrada_saida`, `descricao`, `valor`) VALUES
(2, 1, 2, 1, '2015-10-11', 'e', 'ajuste de caixa', '300.00');

--
-- Acionadores `movimento`
--
DELIMITER $$
CREATE TRIGGER `saldo_conta_delete_t` AFTER DELETE ON `movimento`
 FOR EACH ROW BEGIN
  --
  IF old.entrada_saida = 's' THEN
      UPDATE conta
		 SET saldo = COALESCE(saldo,0) + COALESCE(old.valor,0)
	   WHERE id = old.conta_id;
  ELSE
      UPDATE conta
		 SET saldo = COALESCE(saldo,0) - COALESCE(old.valor,0)
	   WHERE id = old.conta_id;
  END IF;
  --
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `saldo_conta_insert_t` AFTER INSERT ON `movimento`
 FOR EACH ROW BEGIN
  IF new.entrada_saida = 's' THEN
      UPDATE conta
		 SET saldo = COALESCE(saldo,0) - COALESCE(new.valor,0)
	   WHERE id = new.conta_id;
  ELSE
      UPDATE conta
		 SET saldo = COALESCE(saldo,0) + COALESCE(new.valor,0)
	   WHERE id = new.conta_id;
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `saldo_conta_update_t` AFTER UPDATE ON `movimento`
 FOR EACH ROW BEGIN
  --
  IF new.entrada_saida = 's' THEN
      UPDATE conta
		 SET saldo = (COALESCE(saldo,0) + COALESCE(old.valor,0)) - COALESCE(new.valor,0)
	   WHERE id = new.conta_id;
  ELSE
      UPDATE conta
		 SET saldo = (COALESCE(saldo,0) - COALESCE(old.valor,0)) + COALESCE(new.valor,0)
	   WHERE id = new.conta_id;
  END IF;
  --
END
$$
DELIMITER ;

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
-- Indexes for table `conta`
--
ALTER TABLE `conta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `familia`
--
ALTER TABLE `familia`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `movimento`
--
ALTER TABLE `movimento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conta`
--
ALTER TABLE `conta`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `familia`
--
ALTER TABLE `familia`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `movimento`
--
ALTER TABLE `movimento`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
