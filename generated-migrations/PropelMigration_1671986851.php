<?php
use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1671986851.
 * Generated on 2022-12-25 16:47:31 by root 
 */
class PropelMigration_1671986851 
{
    public $comment = '';

    public function preUp(MigrationManager $manager)
    {   
        $sql = "UPDATE pacientes SET `atleta` = '1' WHERE `atleta` = 'Sim';
        UPDATE pacientes SET `atleta` = '0' WHERE `atleta` = 'Não' OR `atleta` = '';";
        $pdo = $manager->getAdapterConnection('default');
        $stmt = $pdo->prepare($sql);
        $stmt = $stmt->execute();
        echo $stmt;
    }

    public function postUp(MigrationManager $manager)
    {
        $sql = "SELECT * FROM registros;";
        $pdo = $manager->getAdapterConnection('default');
        $stmt = $pdo->prepare($sql);
        $stmt = $stmt->execute();
        echo $stmt;
    }

    public function preDown(MigrationManager $manager)
    {
        $sql = "UPDATE pacientes SET atleta = 'Sim' WHERE atleta = 1,
        UPDATE pacientes SET atleta = 'Não' WHERE atleta = 0;";
        $pdo = $manager->getAdapterConnection('default');
        $stmt = $pdo->prepare($sql);
        $stmt = $stmt->execute();
        echo $stmt;
    }

    public function postDown(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        $connection_default = <<< 'EOT'

# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `fisioterapeutas`

  CHANGE `fisioterapeuta` `nome` VARCHAR(150) NOT NULL;

ALTER TABLE `pacientes`

  CHANGE `posto_graduacao` `posto_graduacao` VARCHAR(10),

  CHANGE `nip_paciente` `nip_paciente` INTEGER(8),

  CHANGE `nip_titular` `nip_titular` INTEGER(8),

  CHANGE `cpf_titular` `cpf_titular` BIGINT(11),

  CHANGE `origem` `origem` VARCHAR(20),

  CHANGE `atleta` `atleta` TINYINT(1),

  CHANGE `outra_modalidade` `outra_modalidade` VARCHAR(50),
  
  CHANGE `corpoquadro` `corpo_quadro` VARCHAR(5),
  
  CHANGE `modalidade` `atleta_modalidade` VARCHAR(50);

ALTER TABLE `procedimentos`

  CHANGE `procedimento` `nome` VARCHAR(100) NOT NULL;

ALTER TABLE `registros`

  CHANGE `paciente` `paciente` VARCHAR(150),

  CHANGE `procedimentos` `procedimentos` TEXT,

  ADD `fisioterapeuta_id` INTEGER AFTER `procedimentos`,

  ADD `paciente_id` INTEGER AFTER `fisioterapeuta_id`,

  ADD `tipo_atendimento` VARCHAR(21) AFTER `paciente_id`,

  ADD `comparecimento` VARCHAR(3) AFTER `tipo_atendimento`,

  ADD `tipo_falta` VARCHAR(40) AFTER `comparecimento`;

CREATE INDEX `registros_fi_00f1f7` ON `registros` (`fisioterapeuta_id`);

CREATE INDEX `registros_fi_7c873f` ON `registros` (`paciente_id`);

ALTER TABLE `registros` ADD CONSTRAINT `registros_fk_00f1f7`
    FOREIGN KEY (`fisioterapeuta_id`)
    REFERENCES `fisioterapeutas` (`id`);

ALTER TABLE `registros` ADD CONSTRAINT `registros_fk_7c873f`
    FOREIGN KEY (`paciente_id`)
    REFERENCES `pacientes` (`id`);

ALTER TABLE `tabela`

  CHANGE `tipo_falta` `tipo_falta` VARCHAR(40);

CREATE TABLE `registro_procedimento`
(
    `registro_id` INTEGER NOT NULL,
    `procedimento_id` INTEGER NOT NULL,
    PRIMARY KEY (`registro_id`,`procedimento_id`),
    INDEX `registro_procedimento_fi_a77fc3` (`procedimento_id`),
    CONSTRAINT `registro_procedimento_fk_7e89c0`
        FOREIGN KEY (`registro_id`)
        REFERENCES `registros` (`id`),
    CONSTRAINT `registro_procedimento_fk_a77fc3`
        FOREIGN KEY (`procedimento_id`)
        REFERENCES `procedimentos` (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
EOT;

        return array(
            'default' => $connection_default,
        );
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        $connection_default = <<< 'EOT'

# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `registro_procedimento`;

ALTER TABLE `fisioterapeutas`

  CHANGE `nome` `fisioterapeuta` VARCHAR(150) NOT NULL;

ALTER TABLE `pacientes`

  CHANGE `posto_graduacao` `posto_graduacao` VARCHAR(10) NOT NULL,

  CHANGE `nip_paciente` `nip_paciente` INTEGER(8) NOT NULL,

  CHANGE `nip_titular` `nip_titular` INTEGER(8) NOT NULL,

  CHANGE `cpf_titular` `cpf_titular` BIGINT(11) NOT NULL,

  CHANGE `origem` `origem` VARCHAR(20) NOT NULL,

  CHANGE `atleta` `atleta` VARCHAR(3) NOT NULL,

  CHANGE `outra_modalidade` `outra_modalidade` VARCHAR(50) NOT NULL,

  CHANGE `situacao_administ` `situacao_adm` VARCHAR(30),
  
  CHANGE `corpo_quadro` `corpoquadro` VARCHAR(5),
  
  CHANGE `atleta_modalidade` `modalidade` VARCHAR(50);

ALTER TABLE `procedimentos`

  CHANGE `nome` `procedimento` VARCHAR(100) NOT NULL;

ALTER TABLE `registros` DROP FOREIGN KEY `registros_fk_00f1f7`;

ALTER TABLE `registros` DROP FOREIGN KEY `registros_fk_7c873f`;

DROP INDEX `registros_fi_00f1f7` ON `registros`;

DROP INDEX `registros_fi_7c873f` ON `registros`;

ALTER TABLE `registros`

  CHANGE `paciente` `paciente` VARCHAR(150) NOT NULL,

  CHANGE `procedimentos` `procedimentos` TEXT NOT NULL,

  DROP `fisioterapeuta_id`,

  DROP `paciente_id`,

  DROP `tipo_atendimento`,

  DROP `comparecimento`,

  DROP `tipo_falta`;

ALTER TABLE `tabela`

  CHANGE `tipo_falta` `tipo_falta` VARCHAR(40) NOT NULL;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
EOT;

        return array(
            'default' => $connection_default,
        );
    }

}