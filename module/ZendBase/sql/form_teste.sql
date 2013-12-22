CREATE TABLE `form_teste` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `quantidade` int(11) NOT NULL DEFAULT '0',
  `valor_unitario` decimal(18,2) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `texto` text NOT NULL,
  `ativo` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome_UNIQUE` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=dec8;