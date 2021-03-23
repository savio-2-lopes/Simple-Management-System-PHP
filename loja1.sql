

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `loja1`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `concessionaria`
--

CREATE TABLE `concessionaria` (
  `id` int(11) NOT NULL,
  `concessionaria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `concessionaria`
--

INSERT INTO `concessionaria` (`id`, `concessionaria`) VALUES
(1, 'Green Car H1'),
(2, 'Green Car H2'),
(10, 'None');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `concessionaria_id` int(11) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`, `name`, `concessionaria_id`, `role`) VALUES
(1, 'savioaugulopes@gmail.com', '123456', 'Savio', 1, 1),
(3, 'test@gmail.com', '123456', 'Savio', 1, 1),
(4, 'pessoal@gmail.com', '1234566', 'pessoa', 3, 2),
(11, 'sa@gmail.com', '121212', 'sdsd', 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculos`
--

CREATE TABLE `veiculos` (
  `id` int(11) NOT NULL,
  `preco` int(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `concessionaria_id` int(11) NOT NULL,
  `avatar` longblob NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `veiculos`
--

INSERT INTO `veiculos` (`id`, `preco`, `nome`, `status`, `created_at`, `concessionaria_id`, `avatar`, `role`) VALUES
(29, 1212, 'None', 0, '2021-03-23 03:04:10', 9, 0x312e6a7067, 2),
(30, 1221212, 'NnNN', 0, '2021-03-23 03:04:24', 2, 0x342e6a7067, 2),
(32, 121212, 'PAA', 0, '2021-03-23 03:05:07', 2, 0x332e6a7067, 2),
(33, 123, 'GSS', 0, '2021-03-23 03:06:07', 2, 0x342e6a7067, 2),
(34, 121212, 'LKJJS', 0, '2021-03-23 03:06:33', 9, 0x352e6a7067, 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `concessionaria`
--
ALTER TABLE `concessionaria`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `veiculos`
--
ALTER TABLE `veiculos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `concessionaria`
--
ALTER TABLE `concessionaria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `veiculos`
--
ALTER TABLE `veiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
