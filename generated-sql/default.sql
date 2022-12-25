
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- fisioterapeutas
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `fisioterapeutas`;

CREATE TABLE `fisioterapeutas`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `fisioterapeuta` VARCHAR(150) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- pacientes
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `pacientes`;

CREATE TABLE `pacientes`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(150) NOT NULL,
    `situacao_adm` VARCHAR(30) NOT NULL,
    `posto_graduacao` VARCHAR(10) NOT NULL,
    `nip_paciente` INTEGER(8) NOT NULL,
    `nip_titular` INTEGER(8) NOT NULL,
    `cpf_titular` BIGINT(11) NOT NULL,
    `origem` VARCHAR(20) NOT NULL,
    `corpoquadro` VARCHAR(5) NOT NULL,
    `atleta` VARCHAR(3) NOT NULL,
    `modalidade` VARCHAR(50) NOT NULL,
    `outra_modalidade` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- procedimentos
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `procedimentos`;

CREATE TABLE `procedimentos`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `procedimento` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- registros
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `registros`;

CREATE TABLE `registros`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `paciente` VARCHAR(150) NOT NULL,
    `procedimentos` TEXT NOT NULL,
    `data` DATE NOT NULL,
    `turno` VARCHAR(5),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tabela
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tabela`;

CREATE TABLE `tabela`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `data` VARCHAR(10),
    `turno` VARCHAR(5) NOT NULL,
    `fisioterapeuta` VARCHAR(100),
    `nome_paciente` VARCHAR(43),
    `tipo_atendimento` VARCHAR(21),
    `situacao_administrativa` VARCHAR(17),
    `nip_paciente` VARCHAR(8),
    `nip_titular` VARCHAR(8),
    `cpf_titular` VARCHAR(11),
    `origem` VARCHAR(7),
    `corpo_quadro` VARCHAR(4),
    `posto_graduacao` VARCHAR(2),
    `atleta` VARCHAR(3),
    `modalidade` VARCHAR(20),
    `outra_modalidade` VARCHAR(10),
    `comparecimento` VARCHAR(3),
    `tipo_falta` VARCHAR(40) NOT NULL,
    `procedimento_1` VARCHAR(50),
    `procedimento_2` VARCHAR(50),
    `procedimento_3` VARCHAR(50),
    `procedimento_4` VARCHAR(50),
    `procedimento_5` VARCHAR(50),
    `procedimento_6` VARCHAR(50),
    `procedimento_7` VARCHAR(50),
    `procedimento_8` VARCHAR(50),
    `procedimento_9` VARCHAR(50),
    `procedimento_10` VARCHAR(50),
    `procedimento_11` VARCHAR(50),
    `procedimento_12` VARCHAR(50),
    `procedimento_13` VARCHAR(50),
    `procedimento_14` VARCHAR(50),
    `procedimento_15` VARCHAR(50),
    `procedimento_16` VARCHAR(50),
    `procedimento_17` VARCHAR(50),
    `procedimento_18` VARCHAR(50),
    `procedimento_19` VARCHAR(50),
    `procedimento_20` VARCHAR(50),
    `total_procedimentos` INTEGER(1),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- usuarios
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `usuario` VARCHAR(50) NOT NULL,
    `senha` VARCHAR(32) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
