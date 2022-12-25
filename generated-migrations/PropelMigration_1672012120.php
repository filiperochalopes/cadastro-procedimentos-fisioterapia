<?php

require_once __DIR__.'/../vendor/autoload.php';
set_include_path(__DIR__.'/../api/Models'. PATH_SEPARATOR. get_include_path());
include __DIR__.'/../generated-conf/config.php';

use Models\TabelaQuery;
use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1672008169.
 * Generated on 2022-12-25 22:42:49 by root 
 */
class PropelMigration_1672008169 
{
    public $comment = '';

    public function preUp(MigrationManager $manager)
    {   
      
      $tabela_records = TabelaQuery::create()->all();
      echo $tabela_records;
      foreach ($tabela_records as $up) {
          echo $up;
          echo $up['id'];
          echo $up['data'];
          $new_data = explode('/', $up['data']);
          $new_data = $new_data[2].'-'.$new_data[1].'-'.$new_data[0];
          echo $new_data;
          // Alterando formato da string de data
          $sql = "UPDATE tabela SET `data` = ? WHERE `id` = ?;";
          $stmt = $pdo->prepare($sql);
          $stmt = $stmt->execute();
        }
        
        // Corrigindo campo atleta para boleano
        $pdo = $manager->getAdapterConnection('default');
        $sql = "UPDATE pacientes SET `atleta` = '1' WHERE `atleta` = 'Sim';
        UPDATE pacientes SET `atleta` = '0' WHERE `atleta` = 'Não' OR `atleta` = '';";
        $stmt = $pdo->prepare($sql);
        $stmt = $stmt->execute();        
    }

    public function postUp(MigrationManager $manager)
    {
        // Verifico todos os registros que foram feitos
        $sql = "SELECT a.id as reg_id, a.paciente as reg_nome_paciente, a.procedimentos as reg_procedimentos_array, a.fisioterapeuta_id as reg_fisioterapeuta_id, a.paciente_id as reg_paciente_id, a.tipo_atendimento as reg_tipo_atendimento, a.comparecimento as reg_comparecimento, a.tipo_falta as reg_tipo_falta, a.data as reg_data, a.turno as reg_turno, b.id as tab_id, b.data as tab_data, b.turno as tab_turno, b.fisioterapeuta as tab_nome_fisioterapeuta, b.nome_paciente as tab_nome_paciente, b.tipo_atendimento as tab_tipo_atendimento, b.comparecimento as tab_comparecimento, b.tipo_falta as tab_tipo_falta, b.procedimento_1, b.procedimento_2, b.procedimento_3, b.procedimento_4, b.procedimento_5, b.procedimento_6, b.procedimento_7, b.procedimento_8, b.procedimento_9, b.procedimento_10, b.procedimento_11, b.procedimento_12, b.procedimento_13, b.procedimento_14, b.procedimento_15, b.procedimento_16, b.procedimento_17, b.procedimento_18, b.procedimento_19, b.procedimento_20, b.total_procedimentos FROM `registros` as a JOIN `tabela` as b ON UPPER(a.paciente) = UPPER(b.nome_paciente) AND a.turno = b.turno AND;";
        $pdo = $manager->getAdapterConnection('default');
        $stmt = $pdo->prepare($sql);
        $stmt = $stmt->execute();

        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $up) {
          // Buscando um por um capturo o nome do paciente no registro com busca na tabela `tabela, avaliando registros equivalentes
          echo $up;
          // Adiciono o id do fisioterapeuta e do paciente na tabela registros
          // Crio um registro, em caso de falha capturo o id com try catch e adiciono 
          // try {

          // } catch (PDOException $e) {
          //   echo $e->getMessage();
          // }
          // // Associo o id
          // $arr[$up['id']] = $up['name'];
        }
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

  CHANGE `nip_paciente` `nip_paciente` VARCHAR(8),

  CHANGE `nip_titular` `nip_titular` VARCHAR(8),

  CHANGE `cpf_titular` `cpf_titular` VARCHAR(11),

  CHANGE `origem` `origem` VARCHAR(20),

  CHANGE `atleta` `atleta` TINYINT(1),

  CHANGE `outra_modalidade` `outra_modalidade` VARCHAR(50),

  CHANGE `situacao_adm` `situacao_administ` VARCHAR(30),

  CHANGE `corpoquadro` `corpo_quadro` VARCHAR(5),

  CHANGE `modalidade` `atleta_modalidade` VARCHAR(50);

ALTER TABLE `procedimentos`

  CHANGE `procedimento` `nome` VARCHAR(100) NOT NULL;

ALTER TABLE `registros`

  CHANGE `paciente` `paciente` VARCHAR(150),

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

  CHANGE `data` `data` DATE,

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

  CHANGE `corpo_quadro` `corpoquadro` VARCHAR(5) NOT NULL,

  CHANGE `atleta_modalidade` `modalidade` VARCHAR(50) NOT NULL;

ALTER TABLE `procedimentos`

  CHANGE `nome` `procedimento` VARCHAR(100) NOT NULL;

ALTER TABLE `registros` DROP FOREIGN KEY `registros_fk_00f1f7`;

ALTER TABLE `registros` DROP FOREIGN KEY `registros_fk_7c873f`;

DROP INDEX `registros_fi_00f1f7` ON `registros`;

DROP INDEX `registros_fi_7c873f` ON `registros`;

ALTER TABLE `registros`

  CHANGE `paciente` `paciente` VARCHAR(150) NOT NULL,

  DROP `fisioterapeuta_id`,

  DROP `paciente_id`,

  DROP `tipo_atendimento`,

  DROP `comparecimento`,

  DROP `tipo_falta`;

ALTER TABLE `tabela`

  CHANGE `data` `data` VARCHAR(10),

  CHANGE `tipo_falta` `tipo_falta` VARCHAR(40) NOT NULL;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
EOT;

        return array(
            'default' => $connection_default,
        );
    }

}