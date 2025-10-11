-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Tempo de geração: 05-Jun-2024 às 09:53
-- Versão do servidor: 5.7.24
-- versão do PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lojaonline`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `encomendas`
--

CREATE TABLE `encomendas` (
  `encomendaID` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `morada` varchar(255) DEFAULT NULL,
  `produto` varchar(255) DEFAULT NULL,
  `quantidade` int(11) NOT NULL,
  `preco_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `encomendas`
--

INSERT INTO `encomendas` (`encomendaID`, `nome`, `data_nascimento`, `morada`, `produto`, `quantidade`, `preco_total`) VALUES
(1, '1', '1111-11-11', '1', 'Televisão', 2, 50),
(2, '1', '1111-11-11', '1', 'Internet', 2, 50),
(3, '2', '1111-02-22', '12', 'Televisão', 2, 50),
(4, '2', '1111-02-22', '12', 'Internet', 2, 50),
(5, '3', '1111-02-22', '323', 'Televisão', 2, 50),
(6, '3', '1111-02-22', '323', 'Internet', 2, 50),
(7, 'weqewqe', '1991-05-14', '21312312', 'Internet', 1, 50),
(8, 'weqewqe', '1991-05-14', '21312312', 'Televisão', 1, 50),
(9, '1', '1997-05-01', '1', 'Televisão', 1, 70),
(10, '1', '1997-05-01', '1', 'Internet', 1, 70),
(11, '1', '1997-05-01', '1', 'Telemóvel', 1, 70),
(12, '1', '2004-05-27', '1', 'Telemóvel', 5, 70),
(13, '1', '2004-05-27', '1', 'Televisão', 5, 70),
(14, '1', '2004-05-27', '1', 'Internet', 7, 70),
(15, 'Joao', '1996-06-10', 'Rua D.Joao', '454', 1, 398),
(16, 'Joao', '1996-06-10', 'Rua D.Joao', 'Televisão', 1, 398),
(17, 'Joao', '1996-06-10', 'Rua D.Joao', 'Internet', 1, 398),
(18, 'Joao', '1996-06-10', 'Rua D.Joao', 'telemovel', 1, 398);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `produtoID` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`produtoID`, `nome`, `quantidade`, `preco`) VALUES
(1, 'Televisão', 25, 25),
(2, 'Internet', 20, 20),
(3, 'telefone', 0, 5),
(4, 'telemovel', 50, 20),
(10, '454', 333, 333),
(11, 'Lápis', 21, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `userID` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `apelido` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `utilizadores`
--

INSERT INTO `utilizadores` (`userID`, `nome`, `password`, `apelido`, `user_type`, `email`) VALUES
(1, 'Rui', 'ruisilva1234', 'Silva', 'administrador', 'rui21silva@hotmail.com'),
(2, 'Pedro', 'pedrohenrique1234', 'Henrique', 'utilizador', 'pedrohenrique@hotmail.com');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `encomendas`
--
ALTER TABLE `encomendas`
  ADD PRIMARY KEY (`encomendaID`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`produtoID`);

--
-- Índices para tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `encomendas`
--
ALTER TABLE `encomendas`
  MODIFY `encomendaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `produtoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
