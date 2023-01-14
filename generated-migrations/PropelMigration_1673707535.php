<?php
use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1673707535.
 * Generated on 2023-01-14 14:45:35 by root 
 */
class PropelMigration_1673707535 
{
    public $comment = '';

    public function preUp(MigrationManager $manager)
    {

        $pdo = $manager->getAdapterConnection('default');

        echo "Compactando string de Dependente...\n";
        // Troca os termos de Dependente Direto e Indireto para Dependente
        $sql = "UPDATE pacientes SET situacao_administ = 'Dependente' WHERE situacao_administ = 'Dependente Direto' OR situacao_administ = 'Dependente Indireto';";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        echo "Renomeando Militares da Reserva...\n";
        // Troca os termos de Militar Inativo para Militar da Reserva
        $sql = "UPDATE pacientes SET situacao_administ = 'Militar da Reserva' WHERE situacao_administ = 'Militar Inativo';";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }

    public function postUp(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    public function preDown(MigrationManager $manager)
    {
        // add the pre-migration code here
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

DROP TABLE IF EXISTS `tabela`;

DROP INDEX `IndexUniqueNome` ON `pacientes`;

CREATE UNIQUE INDEX `IndexUniqueNome` ON `pacientes` (`nome`(150));

DROP INDEX `registros_fi_00f1f7` ON `registros`;

ALTER TABLE `registros`

  CHANGE `data` `data` DATE;

CREATE UNIQUE INDEX `IndexUniqueDataRegistro` ON `registros` (`fisioterapeuta_id`, `paciente_id`, `data`, `turno`);

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

DROP INDEX `IndexUniqueNome` ON `pacientes`;

CREATE UNIQUE INDEX `IndexUniqueNome` ON `pacientes` (`nome`);

DROP INDEX `IndexUniqueDataRegistro` ON `registros`;

ALTER TABLE `registros`

  CHANGE `data` `data` DATE NOT NULL;

CREATE INDEX `registros_fi_00f1f7` ON `registros` (`fisioterapeuta_id`);

CREATE TABLE `tabela`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `data` DATE,
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
    `comparecimento` TINYINT(1),
    `tipo_falta` VARCHAR(40),
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

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
EOT;

        return array(
            'default' => $connection_default,
        );
    }

}