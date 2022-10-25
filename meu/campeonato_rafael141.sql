-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Out-2022 às 04:06
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `campeonato_rafael141`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogadores`
--

CREATE TABLE `jogadores` (
  `codigo` int(11) NOT NULL,
  `nome` varchar(256) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `nascimento` varchar(256) NOT NULL,
  `time` varchar(256) NOT NULL,
  `funcao` varchar(256) NOT NULL,
  `vitorias` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `jogadores`
--

INSERT INTO `jogadores` (`codigo`, `nome`, `cpf`, `nascimento`, `time`, `funcao`, `vitorias`) VALUES
(0, 'Rafael', '180.512.520', '2005-12-15', 'LOUD', 'Controlador', 9999),
(1, 'Caio', '587.164.330', '2005-05-12', 'LOUD', 'Iniciador', 100),
(2, 'Lucas', '253.373.540', '2005-05-19', 'LOUD', 'Duelista', 0),
(3, 'Gian', '795.935.150', '2005-11-20', 'LOUD', 'Sentinela', 100),
(4, 'Marco Aurélio', '672.712.500', '2005-02-16', 'LOUD', 'Sentinela', 0),
(7, 'Zl né amor', '19029513758', '2005-08-24', 'Furia', 'Controlador', 12);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `jogadores`
--
ALTER TABLE `jogadores`
  ADD PRIMARY KEY (`codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
