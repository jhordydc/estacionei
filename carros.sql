-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Mar-2023 às 22:22
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `carros`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id` int(11) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `funcionario_entrada` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`id`, `usuario`, `senha`, `funcionario_entrada`) VALUES
(1, 'armando', 'e10adc3949ba59abbe56e057f20f883e', '2023-03-23 17:10:12'),
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2023-03-30 16:37:47'),
(3, 'luis', 'e10adc3949ba59abbe56e057f20f883e', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculo`
--

CREATE TABLE `veiculo` (
  `id` int(11) NOT NULL,
  `placa` varchar(8) NOT NULL,
  `data_cadastro` date NOT NULL,
  `horario_entrada` time NOT NULL,
  `horario_saida` time DEFAULT NULL,
  `estacionado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `veiculo`
--

INSERT INTO `veiculo` (`id`, `placa`, `data_cadastro`, `horario_entrada`, `horario_saida`, `estacionado`) VALUES
(2, 'BPG5992', '2023-03-23', '16:54:11', '14:54:12', 0),
(4, 'AWA1431', '2023-03-20', '15:50:17', '16:58:31', 0),
(5, 'BPG5993', '2023-03-20', '16:15:46', '14:56:19', 0),
(6, 'BPG5991', '2023-03-20', '16:15:56', '15:29:48', 0),
(7, 'DBF3349', '2023-03-20', '16:31:34', '15:30:57', 0),
(8, 'OMX8135', '2023-03-23', '14:10:15', '16:14:59', 0),
(11, 'ONX8135', '2023-03-23', '14:22:49', '16:17:04', 0),
(12, 'KNA2314', '2023-03-24', '02:24:13', '16:17:38', 0),
(13, 'TAB4521', '2023-03-24', '02:24:36', '16:22:23', 0),
(17, 'ETA9462', '2023-03-23', '14:36:52', '16:24:07', 0),
(18, 'JHK2538', '2023-03-24', '02:37:46', '16:25:13', 0),
(19, 'LMC6293', '2023-03-24', '02:38:24', '16:25:47', 0),
(20, 'GHT2145', '2023-03-24', '02:38:35', '16:28:21', 0),
(21, 'LMK9210', '2023-03-23', '14:38:55', '15:07:05', 0),
(22, 'GPI2723', '2023-03-23', '14:42:46', '16:58:22', 0),
(23, 'GPI2753', '2023-03-23', '14:42:51', '16:56:41', 0),
(24, 'GPI2756', '2023-03-24', '02:43:07', '16:35:08', 0),
(25, 'GPI7523', '2023-03-24', '02:43:14', '16:33:56', 0),
(26, 'GPI8654', '2023-03-23', '14:44:33', '16:33:28', 0),
(27, 'HRT1235', '2023-03-23', '15:54:35', NULL, 0),
(28, 'GTE2156', '2023-03-27', '14:53:56', '16:29:58', 0),
(29, 'TRF1725', '2023-03-27', '15:02:04', '16:30:08', 0),
(30, 'HTE2745', '2023-03-30', '15:25:01', '16:34:59', 0),
(31, 'PPP1400', '2023-03-30', '15:26:41', '15:26:59', 0),
(32, 'ABC1234', '2023-03-30', '15:28:45', '16:39:28', 0),
(33, 'PPP1234', '2023-03-30', '16:38:06', NULL, 1),
(34, 'GGG4321', '2023-03-30', '16:50:17', '16:49:00', 1),
(35, 'AFC1234', '2023-03-30', '17:01:33', NULL, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `veiculo`
--
ALTER TABLE `veiculo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `veiculo`
--
ALTER TABLE `veiculo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
