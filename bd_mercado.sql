-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.14 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura do banco de dados para mercado
CREATE DATABASE IF NOT EXISTS `mercado` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `mercado`;


-- Copiando estrutura para tabela mercado.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela mercado.categoria: 11 rows
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` (`id`, `categoria`) VALUES
	(7, 'limpeza'),
	(3, 'eletronicos'),
	(4, 'moveis'),
	(5, 'ferramentas'),
	(8, 'imoveis'),
	(9, 'casa'),
	(10, 'musical'),
	(11, 'nova caregoria'),
	(19, 'escolar'),
	(16, 'xray_4'),
	(18, 'cozinha');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;


-- Copiando estrutura para tabela mercado.estoque
CREATE TABLE IF NOT EXISTS `estoque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto` int(11) DEFAULT NULL,
  `qtd` int(11) DEFAULT NULL,
  `status` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela mercado.estoque: 3 rows
/*!40000 ALTER TABLE `estoque` DISABLE KEYS */;
INSERT INTO `estoque` (`id`, `produto`, `qtd`, `status`) VALUES
	(2, 4, 20, 'aquardando'),
	(3, 9, 200, 'aguardandoX'),
	(6, 12, 242, 'avaliado');
/*!40000 ALTER TABLE `estoque` ENABLE KEYS */;


-- Copiando estrutura para tabela mercado.fornecedor
CREATE TABLE IF NOT EXISTS `fornecedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fornecedor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela mercado.fornecedor: 5 rows
/*!40000 ALTER TABLE `fornecedor` DISABLE KEYS */;
INSERT INTO `fornecedor` (`id`, `fornecedor`) VALUES
	(1, 'dr dorivan'),
	(5, 'chico butico'),
	(3, 'josealdo'),
	(4, 'amancio'),
	(7, 'jamilson');
/*!40000 ALTER TABLE `fornecedor` ENABLE KEYS */;


-- Copiando estrutura para tabela mercado.produto
CREATE TABLE IF NOT EXISTS `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto` varchar(50) DEFAULT NULL,
  `valor` double(10,2) DEFAULT NULL,
  `descricao` text,
  `fk_categoria` int(11) DEFAULT NULL,
  `fk_fornecedor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_categoria` (`fk_categoria`),
  KEY `fk_fornecedor` (`fk_fornecedor`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela mercado.produto: 5 rows
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
INSERT INTO `produto` (`id`, `produto`, `valor`, `descricao`, `fk_categoria`, `fk_fornecedor`) VALUES
	(1, 'carrinhoX', 1.99, 'mÃ³vel de quatro rodas', 5, 3),
	(2, 'vasoura', 12.67, 'descrição 2', 3, 3),
	(4, 'cabide', 5.29, 'descrição 3', 3, 3),
	(9, 'lapizeira', 342.51, 'haste de madeira com grafitte', 5, 5),
	(12, 'manta', 453.98, 'cobertor', 4, 4);
/*!40000 ALTER TABLE `produto` ENABLE KEYS */;


-- Copiando estrutura para tabela mercado.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) DEFAULT NULL,
  `senha` char(32) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='pagina de acesso ao usuario';

-- Copiando dados para a tabela mercado.usuario: 3 rows
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `usuario`, `senha`, `nome`) VALUES
	(1, 'fernando@email.com', '202cb962ac59075b964b07152d234b70', 'fernando'),
	(2, 'fernandoprolancer@gmail.com', '202cb962ac59075b964b07152d234b70', 'Fernando R'),
	(3, 'novodev', '202cb962ac59075b964b07152d234b70', 'novoDev');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
