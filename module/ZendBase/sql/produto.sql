CREATE TABLE `produto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `quantidade` INT NOT NULL DEFAULT 0,
  `valor_unitario` DECIMAL(18,2) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;