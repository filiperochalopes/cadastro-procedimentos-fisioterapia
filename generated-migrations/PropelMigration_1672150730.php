<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../generated-conf/config.php';

use Propel\Generator\Manager\MigrationManager;
use Api\Models\FisioterapeutaQuery;
use Api\Models\ProcedimentoQuery;
use Api\Models\Registro;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1672150730.
 * Generated on 2022-12-27 14:18:50 by root 
 */
class PropelMigration_1672150730
{
    public $comment = '';

    public function preUp(MigrationManager $manager)
    {

        $pdo = $manager->getAdapterConnection('default');

        echo "Corrigindo data da tabela...\n";
        // Alterando o formato de data
        $sql = "UPDATE tabela SET `data` = REGEXP_REPLACE(`data`, '(\\\d+)\\/(\\\d+)\\/(\\\d+)', '\\\\3-\\\\2-\\\\1') WHERE `data` IS NOT NULL;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        echo "Corrigindo atleta...\n";
        // Corrigindo campo atleta para boleano
        $sql = "UPDATE pacientes SET `atleta` = '1' WHERE `atleta` = 'Sim';
            UPDATE pacientes SET `atleta` = '0' WHERE `atleta` = 'Não' OR `atleta` = '';";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        echo "Corrigindo coluna de comparecimento em tabela...\n";
        // Corrigindo campo comparecimento para boleano
        $sql = "UPDATE tabela SET `comparecimento` = '1' WHERE `comparecimento` = 'Sim';
            UPDATE tabela SET `comparecimento` = '0' WHERE `comparecimento` = 'Não' OR `comparecimento` = '';";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        echo "Removendo patentes de fisioterapeutas (tabela)...\n";
        // Removendo patentes e títulos do nome do fisioterapeuta na lista de tabelas
        $sql = "UPDATE tabela SET fisioterapeuta=TRIM(REGEXP_REPLACE(fisioterapeuta, 'GM\\\s\\\(S\\\)\\\s|GM\\\s(\\\(S\\\)\\\s)?|Ten\\\.\\\s|\\\s\\\(Estagiári.\\\)|CC\\\s(\\\(S\\\)\\\s)?|SO\\\s|Dr.?\\\.\\\s', '')) WHERE fisioterapeuta IS NOT NULL;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        echo "Removendo patentes de fisioterapeutas (fisioterapeuta)...\n";
        // Removendo patentes e títulos do nome do fisioterapeuta na lista de fisioterapeutas
        $sql = "UPDATE fisioterapeutas SET fisioterapeuta=TRIM(REGEXP_REPLACE(fisioterapeuta, 'GM\\\s\\\(S\\\)\\\s|GM\\\s(\\\(S\\\)\\s)?|Ten\\\.\\\s|\\\s\\\(Estagiári.\\\)|CC\\\s(\\\(S\\\)\\\s)?|SO\\\s|Dr.?\\\.\\\s', '')) WHERE fisioterapeuta IS NOT NULL;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        echo "Preenchendo fisioterapeuta vazio...\n";
        // Substituindo registros vazios de fisioterapeutas por "Erro[Vazio]"
        $sql = "UPDATE tabela SET fisioterapeuta='Erro[Vazio]' WHERE fisioterapeuta = '';";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        
        echo "Esvaziando tabela de registros para uma nova estrutura...\n";
        $sql = "TRUNCATE TABLE registros;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        echo "Removendo pacientes duplicados...\n";
        // Armazenando ids que não serão excluídos
        $sql = "SELECT id, nome, nip_paciente, cpf_titular, nip_titular, COUNT(*) AS count
        FROM pacientes
        GROUP BY nome, nip_paciente, cpf_titular, nip_titular 
        HAVING COUNT(*) > 1;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $resultset = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $whitelist_ids_comma_separated = '';

        foreach ($resultset as $row) {
            if($whitelist_ids_comma_separated != ''){ 
                $whitelist_ids_comma_separated .= ','; 
            }
            $whitelist_ids_comma_separated .= strval($row['id']);
        }

        // Capturando todos os registros duplicados
        $sql = "SELECT p1.id, p1.nome FROM pacientes p1 
        INNER JOIN (SELECT id, nome, nip_paciente, cpf_titular, nip_titular, COUNT(*) AS count
        FROM pacientes
        GROUP BY nome, nip_paciente, cpf_titular, nip_titular
        HAVING COUNT(*) > 1) p2
        ON p1.nome = p2.nome;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $resultset = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultset as $row) {
            $pdo->prepare("DELETE FROM pacientes WHERE id=? AND id NOT IN (".$whitelist_ids_comma_separated.");")->execute([$row['id']]);
        }
    }

    public function postUp(MigrationManager $manager)
    {   
        $pdo = $manager->getAdapterConnection('default');

        echo "Adicionando fisioterapeutas excluídos...\n";
        // Obtendo lista de fisioterapeutas que estão em tabela, mas não estão em fisioterapeutas
        $sql = "SELECT DISTINCT fisioterapeuta FROM tabela t LEFT JOIN fisioterapeutas f ON t.fisioterapeuta = f.nome WHERE f.nome IS NULL;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $resultset = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultset as $row) {
            // Preenchendo tabela de fisioterapeutas com dados excluídos
            $sql = "INSERT INTO `fisioterapeutas` (nome, `disabled`) 
                VALUES (?, 1);";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $row['fisioterapeuta']);
            $stmt->execute();
        }

        echo "Adicionando pacientes excluídos...\n";
        $sql = "SELECT DISTINCT nome_paciente FROM tabela t LEFT JOIN pacientes p ON t.nome_paciente = p.nome WHERE p.nome IS NULL;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $resultset = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultset as $row) {
            $sql = "INSERT INTO `pacientes` (nome, `disabled`) 
                VALUES (?, 1);";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $row['nome_paciente']);
            $stmt->execute();
        }

        echo "Adicionando procedimentos excluídos...\n";
        // Itens obtidos em 6 de Janeiro por meio do recolhimento na lista de de `tabela`
        $procedimentos = ['Hidroterapia', 'Cinesioterapia','Avaliação','Termofototerapia', 'Eletroterapia', 'Acupuntura','Uroginecologia', 'Pilates', 'Terapia Manual','Alta','Neurologia','Crioterapia','Ultrassom','RPG','Laser','Massoterapia','Cinesioterapia Ativa','GLOBUS','Cinesioterapia','Passiva','TENS','Mecanoterapia','Infravermelho','Osteopatia']  ;
        
        foreach ($procedimentos as $procedimento) {
            if(ProcedimentoQuery::create()->filterByNome($procedimento)->count() <= 0){
                $sql = "INSERT INTO `procedimentos` (nome, `disabled`) 
                    VALUES (?, 1);";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(1, $procedimento);
                $stmt->execute();
            }
        }

        // Lista em memória de procedimentos
        echo "Criando registro em memória de procedimentos...\n";
        $procedimentos = ProcedimentoQuery::create()->find();
        $procedimentos_map_by_name = [];
        foreach ($procedimentos as $procedimento) {
            $procedimentos_map_by_name[$procedimento->getNome()] = $procedimento;
        }

        // Lista em memória de fisioterapeutas
        echo "Criando registro em memória de fisioterapeutas...\n";
        $fisioterapeutas = FisioterapeutaQuery::create()->find();
        $fisioterapeutas_map_by_name = [];
        foreach ($fisioterapeutas as $fisioterapeuta) {
            $fisioterapeutas_map_by_name[$fisioterapeuta->getNome()] = $fisioterapeuta;
        }

        echo "Unindo tabelas para análise JOIN tabela + registros...\n";
        // Verifico todos os registros que foram feitos
        $sql = "SELECT 
            t.id as tabela_id, 
            t.fisioterapeuta as nome_fisioterapeuta, 
            t.data, t.turno, t.nome_paciente, t.tipo_atendimento, t.comparecimento, t.tipo_falta, 
            t.procedimento_1, t.procedimento_2, t.procedimento_3, t.procedimento_4, t.procedimento_5, t.procedimento_6, t.procedimento_7, t.procedimento_8, t.procedimento_9, t.procedimento_10, t.procedimento_11, t.procedimento_12, t.procedimento_13, t.procedimento_14, t.procedimento_15, t.procedimento_16, t.procedimento_17, t.procedimento_18, t.procedimento_19, t.procedimento_20, t.total_procedimentos,
            p.id as paciente_id,
            f.id as fisioterapeuta_id 
        FROM `tabela` as t
        LEFT JOIN pacientes as p
        ON p.nome = t.nome_paciente 
        LEFT JOIN fisioterapeutas f 
        ON f.nome = t.fisioterapeuta;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $resultset = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "Inserindo ".count($resultset)." linhas da antiga tabela em `Registro`...\n";
        foreach ($resultset as $row) {
            print("❚");
            $registro = new Registro;
            $registro->setData($row['data']);
            $registro->setTurno($row['turno']);
            $registro->setPacienteId($row['paciente_id']);
            $registro->setFisioterapeutaId($row['fisioterapeuta_id']);
            $registro->setComparecimento($row['comparecimento']);
            $registro->setTipoFalta($row['tipo_falta']);
            $registro->setTipoAtendimento($row['tipo_atendimento']);

            // Criando procedimentos
            for ($i = 1; $i <= 20; $i++) {
                if (trim($row["procedimento_{$i}"]) !== '' && $row["procedimento_{$i}"] !== null) {
                    $registro->addProcedimento($procedimentos_map_by_name[$row["procedimento_{$i}"]]);
                }
            }

            $registro->save();
        }

        // Deixando o log mais apresentável
        print("\n\n");
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
    CHANGE `fisioterapeuta` `nome` VARCHAR(150) NOT NULL,
    ADD `disabled` TINYINT(1) DEFAULT 0 NOT NULL AFTER `nome`;
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
    CHANGE `modalidade` `atleta_modalidade` VARCHAR(50),
    ADD `disabled` TINYINT(1) DEFAULT 0 NOT NULL AFTER `outra_modalidade`;
CREATE UNIQUE INDEX `IndexUniqueNome` ON `pacientes` (`nome`(150));
ALTER TABLE `procedimentos`
    CHANGE `procedimento` `nome` VARCHAR(100) NOT NULL,
    ADD `disabled` TINYINT(1) DEFAULT 0 NOT NULL AFTER `nome`;
ALTER TABLE `registros`
    DROP `paciente`,
    DROP `procedimentos`,
    ADD `fisioterapeuta_id` INTEGER AFTER `id`,
    ADD `paciente_id` INTEGER AFTER `fisioterapeuta_id`,
    ADD `tipo_atendimento` VARCHAR(25) AFTER `paciente_id`,
    ADD `comparecimento` TINYINT(1) AFTER `tipo_atendimento`,
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
CHANGE `comparecimento` `comparecimento` TINYINT(1),
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

DROP VIEW IF EXISTS powerbi;
CREATE VIEW powerbi AS
	SELECT r.id AS id, r.data, r.turno, pa.nome as paciente_nome, pa.situacao_administ, pa.posto_graduacao, pa.nip_paciente, pa.nip_titular, pa.cpf_titular, pa.origem, pa.corpo_quadro, IF(pa.atleta=1, 'Sim', 'Não') as atleta, pa.atleta_modalidade, pa.outra_modalidade, f.nome as fisioterapeuta_nome, r.tipo_atendimento, IF(r.comparecimento=1, 'Sim', 'Não') as comparecimento, r.tipo_falta, rpjoin.procedimentos, rpjoin.total_procedimentos
    FROM registros r  
	LEFT JOIN
 		(SELECT GROUP_CONCAT(DISTINCT p.nome SEPARATOR ',') AS procedimentos, COUNT(DISTINCT p.nome) as total_procedimentos, rp.registro_id 
		FROM procedimentos p 
		INNER JOIN registro_procedimento rp 
		ON rp.procedimento_id = p.id GROUP BY rp.registro_id) rpjoin
	ON r.id = rpjoin.registro_id
	JOIN pacientes pa
	ON pa.id = r.paciente_id 
	JOIN fisioterapeutas f 
	ON f.id = r.fisioterapeuta_id ORDER BY data DESC;

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
  CHANGE `nome` `fisioterapeuta` VARCHAR(150) NOT NULL,
  DROP `disabled`;
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
  CHANGE `atleta_modalidade` `modalidade` VARCHAR(50) NOT NULL,
  DROP `disabled`;
DROP INDEX `IndexUniqueNome` ON `pacientes`;
ALTER TABLE `procedimentos`
  CHANGE `nome` `procedimento` VARCHAR(100) NOT NULL,
  DROP `disabled`;
ALTER TABLE `registros` DROP FOREIGN KEY `registros_fk_00f1f7`;
ALTER TABLE `registros` DROP FOREIGN KEY `registros_fk_7c873f`;
DROP INDEX `registros_fi_00f1f7` ON `registros`;
DROP INDEX `registros_fi_7c873f` ON `registros`;
ALTER TABLE `registros`
  ADD `paciente` VARCHAR(150) NOT NULL AFTER `id`,
  ADD `procedimentos` TEXT AFTER `paciente`,
  DROP `fisioterapeuta_id`,
  DROP `paciente_id`,
  DROP `tipo_atendimento`,
  DROP `comparecimento`,
  DROP `tipo_falta`;
ALTER TABLE `tabela`
  CHANGE `comparecimento` `comparecimento` VARCHAR(3),
  CHANGE `data` `data` VARCHAR(10),
  CHANGE `tipo_falta` `tipo_falta` VARCHAR(40) NOT NULL;

DROP VIEW IF EXISTS powerbi;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
EOT;

        return array(
            'default' => $connection_default,
        );
    }
}
