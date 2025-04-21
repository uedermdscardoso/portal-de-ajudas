-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11-Ago-2018 às 17:23
-- Versão do servidor: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "-03:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ajudas`
--
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
  
CREATE TABLE `ajuda` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pathAnexo` text COLLATE utf8mb4_unicode_ci,
  `dataCriacao` date NOT NULL,
  `dataTermino` date NOT NULL,
  `pessoa_id` int(10) UNSIGNED NOT NULL,
  `status_id` int(10) UNSIGNED NOT NULL,
  `notificacao_status` INT(10) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ajuda_categoria`
--

CREATE TABLE `ajuda_categoria` (
  `ajuda_id` int(10) UNSIGNED NOT NULL,
  `categoria_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categoria` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomeCategoria` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `generos`
--

CREATE TABLE `genero` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomeGenero` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--
-- Estrutura da tabela `pessoas`
--

CREATE TABLE `pessoa` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomeCompleto` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biografia` text COLLATE utf8mb4_unicode_ci,
  `dataNascimento` date NOT NULL,
  `pathFotoPerfil` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genero_id` int(10) UNSIGNED NOT NULL,
  `tel_ddd` int(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel_numero` BIGINT COLLATE utf8mb4_unicode_ci NOT NULL,
  `logradouro` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(191) COLLATE utf8mb4_unicode_ci NULL,
  `bairro` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NOT NULL,
  `estado` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pontoReferencia` text COLLATE utf8mb4_unicode_ci,
  `usuario` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenBloqueio` VARCHAR(255) COLLATE utf8mb4_unicode_ci NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `propostas`
--

CREATE TABLE `proposta` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dataCriacao` date NOT NULL,
  `pessoa_id` int(10) UNSIGNED NOT NULL,
  `ajuda_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `statuses`
--

CREATE TABLE `status` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomeStatus` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ajudas`
--
ALTER TABLE `ajuda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ajuda_pessoa_id_foreign` (`pessoa_id`),
  ADD KEY `ajuda_status_id_foreign` (`status_id`);

--
-- Indexes for table `ajuda_categoria`
--
ALTER TABLE `ajuda_categoria`
  ADD KEY `ajuda_categoria_ajuda_id_foreign` (`ajuda_id`),
  ADD KEY `ajuda_categoria_categoria_id_foreign` (`categoria_id`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `generos`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pessoas`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pessoa_email_unique` (`email`),
  ADD KEY `pessoa_genero_id_foreign` (`genero_id`);

--
-- Indexes for table `propostas`
--
ALTER TABLE `proposta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposta_pessoa_id_foreign` (`pessoa_id`),
  ADD KEY `proposta_ajuda_id_foreign` (`ajuda_id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ajudas`
--
ALTER TABLE `ajuda`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categoria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `generos`
--
ALTER TABLE `genero`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
  
--
-- AUTO_INCREMENT for table `pessoas`
--
ALTER TABLE `pessoa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `propostas`
--
ALTER TABLE `proposta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `ajudas`
--
ALTER TABLE `ajuda`
  ADD CONSTRAINT `ajuda_pessoa_id_foreign` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ajuda_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `ajuda_categoria`
--
ALTER TABLE `ajuda_categoria`
  ADD CONSTRAINT `ajuda_categoria_ajuda_id_foreign` FOREIGN KEY (`ajuda_id`) REFERENCES `ajuda` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ajuda_categoria_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `pessoas`
--
ALTER TABLE `pessoa`
  ADD CONSTRAINT `pessoa_genero_id_foreign` FOREIGN KEY (`genero_id`) REFERENCES `genero` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `propostas`
--
ALTER TABLE `proposta`
  ADD CONSTRAINT `proposta_ajuda_id_foreign` FOREIGN KEY (`ajuda_id`) REFERENCES `ajuda` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `proposta_pessoa_id_foreign` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

INSERT INTO status(nomeStatus) VALUES('Aberto');
INSERT INTO status(nomeStatus) VALUES('Fechado');
INSERT INTO status(nomeStatus) VALUES('Realizado');

INSERT INTO genero(nomeGenero) VALUES('Feminino');
INSERT INTO genero(nomeGenero) VALUES('Masculino');

INSERT INTO categoria(nomeCategoria) VALUES('Educação');
INSERT INTO categoria(nomeCategoria) VALUES('Saúde');
INSERT INTO categoria(nomeCategoria) VALUES('Música');
INSERT INTO categoria(nomeCategoria) VALUES('Outros');
