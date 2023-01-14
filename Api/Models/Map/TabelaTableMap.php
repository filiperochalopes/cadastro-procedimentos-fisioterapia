<?php

namespace Api\Models\Map;

use Api\Models\Tabela;
use Api\Models\TabelaQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'tabela' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class TabelaTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'Api.Models.Map.TabelaTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'tabela';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Api\\Models\\Tabela';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'Api.Models.Tabela';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 39;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 39;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'tabela.id';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'tabela.data';

    /**
     * the column name for the turno field
     */
    public const COL_TURNO = 'tabela.turno';

    /**
     * the column name for the fisioterapeuta field
     */
    public const COL_FISIOTERAPEUTA = 'tabela.fisioterapeuta';

    /**
     * the column name for the nome_paciente field
     */
    public const COL_NOME_PACIENTE = 'tabela.nome_paciente';

    /**
     * the column name for the tipo_atendimento field
     */
    public const COL_TIPO_ATENDIMENTO = 'tabela.tipo_atendimento';

    /**
     * the column name for the situacao_administrativa field
     */
    public const COL_SITUACAO_ADMINISTRATIVA = 'tabela.situacao_administrativa';

    /**
     * the column name for the nip_paciente field
     */
    public const COL_NIP_PACIENTE = 'tabela.nip_paciente';

    /**
     * the column name for the nip_titular field
     */
    public const COL_NIP_TITULAR = 'tabela.nip_titular';

    /**
     * the column name for the cpf_titular field
     */
    public const COL_CPF_TITULAR = 'tabela.cpf_titular';

    /**
     * the column name for the origem field
     */
    public const COL_ORIGEM = 'tabela.origem';

    /**
     * the column name for the corpo_quadro field
     */
    public const COL_CORPO_QUADRO = 'tabela.corpo_quadro';

    /**
     * the column name for the posto_graduacao field
     */
    public const COL_POSTO_GRADUACAO = 'tabela.posto_graduacao';

    /**
     * the column name for the atleta field
     */
    public const COL_ATLETA = 'tabela.atleta';

    /**
     * the column name for the modalidade field
     */
    public const COL_MODALIDADE = 'tabela.modalidade';

    /**
     * the column name for the outra_modalidade field
     */
    public const COL_OUTRA_MODALIDADE = 'tabela.outra_modalidade';

    /**
     * the column name for the comparecimento field
     */
    public const COL_COMPARECIMENTO = 'tabela.comparecimento';

    /**
     * the column name for the tipo_falta field
     */
    public const COL_TIPO_FALTA = 'tabela.tipo_falta';

    /**
     * the column name for the procedimento_1 field
     */
    public const COL_PROCEDIMENTO_1 = 'tabela.procedimento_1';

    /**
     * the column name for the procedimento_2 field
     */
    public const COL_PROCEDIMENTO_2 = 'tabela.procedimento_2';

    /**
     * the column name for the procedimento_3 field
     */
    public const COL_PROCEDIMENTO_3 = 'tabela.procedimento_3';

    /**
     * the column name for the procedimento_4 field
     */
    public const COL_PROCEDIMENTO_4 = 'tabela.procedimento_4';

    /**
     * the column name for the procedimento_5 field
     */
    public const COL_PROCEDIMENTO_5 = 'tabela.procedimento_5';

    /**
     * the column name for the procedimento_6 field
     */
    public const COL_PROCEDIMENTO_6 = 'tabela.procedimento_6';

    /**
     * the column name for the procedimento_7 field
     */
    public const COL_PROCEDIMENTO_7 = 'tabela.procedimento_7';

    /**
     * the column name for the procedimento_8 field
     */
    public const COL_PROCEDIMENTO_8 = 'tabela.procedimento_8';

    /**
     * the column name for the procedimento_9 field
     */
    public const COL_PROCEDIMENTO_9 = 'tabela.procedimento_9';

    /**
     * the column name for the procedimento_10 field
     */
    public const COL_PROCEDIMENTO_10 = 'tabela.procedimento_10';

    /**
     * the column name for the procedimento_11 field
     */
    public const COL_PROCEDIMENTO_11 = 'tabela.procedimento_11';

    /**
     * the column name for the procedimento_12 field
     */
    public const COL_PROCEDIMENTO_12 = 'tabela.procedimento_12';

    /**
     * the column name for the procedimento_13 field
     */
    public const COL_PROCEDIMENTO_13 = 'tabela.procedimento_13';

    /**
     * the column name for the procedimento_14 field
     */
    public const COL_PROCEDIMENTO_14 = 'tabela.procedimento_14';

    /**
     * the column name for the procedimento_15 field
     */
    public const COL_PROCEDIMENTO_15 = 'tabela.procedimento_15';

    /**
     * the column name for the procedimento_16 field
     */
    public const COL_PROCEDIMENTO_16 = 'tabela.procedimento_16';

    /**
     * the column name for the procedimento_17 field
     */
    public const COL_PROCEDIMENTO_17 = 'tabela.procedimento_17';

    /**
     * the column name for the procedimento_18 field
     */
    public const COL_PROCEDIMENTO_18 = 'tabela.procedimento_18';

    /**
     * the column name for the procedimento_19 field
     */
    public const COL_PROCEDIMENTO_19 = 'tabela.procedimento_19';

    /**
     * the column name for the procedimento_20 field
     */
    public const COL_PROCEDIMENTO_20 = 'tabela.procedimento_20';

    /**
     * the column name for the total_procedimentos field
     */
    public const COL_TOTAL_PROCEDIMENTOS = 'tabela.total_procedimentos';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['Id', 'Data', 'Turno', 'Fisioterapeuta', 'NomePaciente', 'TipoAtendimento', 'SituacaoAdministrativa', 'NipPaciente', 'NipTitular', 'CpfTitular', 'Origem', 'CorpoQuadro', 'PostoGraduacao', 'Atleta', 'Modalidade', 'OutraModalidade', 'Comparecimento', 'TipoFalta', 'Procedimento1', 'Procedimento2', 'Procedimento3', 'Procedimento4', 'Procedimento5', 'Procedimento6', 'Procedimento7', 'Procedimento8', 'Procedimento9', 'Procedimento10', 'Procedimento11', 'Procedimento12', 'Procedimento13', 'Procedimento14', 'Procedimento15', 'Procedimento16', 'Procedimento17', 'Procedimento18', 'Procedimento19', 'Procedimento20', 'TotalProcedimentos', ],
        self::TYPE_CAMELNAME     => ['id', 'data', 'turno', 'fisioterapeuta', 'nomePaciente', 'tipoAtendimento', 'situacaoAdministrativa', 'nipPaciente', 'nipTitular', 'cpfTitular', 'origem', 'corpoQuadro', 'postoGraduacao', 'atleta', 'modalidade', 'outraModalidade', 'comparecimento', 'tipoFalta', 'procedimento1', 'procedimento2', 'procedimento3', 'procedimento4', 'procedimento5', 'procedimento6', 'procedimento7', 'procedimento8', 'procedimento9', 'procedimento10', 'procedimento11', 'procedimento12', 'procedimento13', 'procedimento14', 'procedimento15', 'procedimento16', 'procedimento17', 'procedimento18', 'procedimento19', 'procedimento20', 'totalProcedimentos', ],
        self::TYPE_COLNAME       => [TabelaTableMap::COL_ID, TabelaTableMap::COL_DATA, TabelaTableMap::COL_TURNO, TabelaTableMap::COL_FISIOTERAPEUTA, TabelaTableMap::COL_NOME_PACIENTE, TabelaTableMap::COL_TIPO_ATENDIMENTO, TabelaTableMap::COL_SITUACAO_ADMINISTRATIVA, TabelaTableMap::COL_NIP_PACIENTE, TabelaTableMap::COL_NIP_TITULAR, TabelaTableMap::COL_CPF_TITULAR, TabelaTableMap::COL_ORIGEM, TabelaTableMap::COL_CORPO_QUADRO, TabelaTableMap::COL_POSTO_GRADUACAO, TabelaTableMap::COL_ATLETA, TabelaTableMap::COL_MODALIDADE, TabelaTableMap::COL_OUTRA_MODALIDADE, TabelaTableMap::COL_COMPARECIMENTO, TabelaTableMap::COL_TIPO_FALTA, TabelaTableMap::COL_PROCEDIMENTO_1, TabelaTableMap::COL_PROCEDIMENTO_2, TabelaTableMap::COL_PROCEDIMENTO_3, TabelaTableMap::COL_PROCEDIMENTO_4, TabelaTableMap::COL_PROCEDIMENTO_5, TabelaTableMap::COL_PROCEDIMENTO_6, TabelaTableMap::COL_PROCEDIMENTO_7, TabelaTableMap::COL_PROCEDIMENTO_8, TabelaTableMap::COL_PROCEDIMENTO_9, TabelaTableMap::COL_PROCEDIMENTO_10, TabelaTableMap::COL_PROCEDIMENTO_11, TabelaTableMap::COL_PROCEDIMENTO_12, TabelaTableMap::COL_PROCEDIMENTO_13, TabelaTableMap::COL_PROCEDIMENTO_14, TabelaTableMap::COL_PROCEDIMENTO_15, TabelaTableMap::COL_PROCEDIMENTO_16, TabelaTableMap::COL_PROCEDIMENTO_17, TabelaTableMap::COL_PROCEDIMENTO_18, TabelaTableMap::COL_PROCEDIMENTO_19, TabelaTableMap::COL_PROCEDIMENTO_20, TabelaTableMap::COL_TOTAL_PROCEDIMENTOS, ],
        self::TYPE_FIELDNAME     => ['id', 'data', 'turno', 'fisioterapeuta', 'nome_paciente', 'tipo_atendimento', 'situacao_administrativa', 'nip_paciente', 'nip_titular', 'cpf_titular', 'origem', 'corpo_quadro', 'posto_graduacao', 'atleta', 'modalidade', 'outra_modalidade', 'comparecimento', 'tipo_falta', 'procedimento_1', 'procedimento_2', 'procedimento_3', 'procedimento_4', 'procedimento_5', 'procedimento_6', 'procedimento_7', 'procedimento_8', 'procedimento_9', 'procedimento_10', 'procedimento_11', 'procedimento_12', 'procedimento_13', 'procedimento_14', 'procedimento_15', 'procedimento_16', 'procedimento_17', 'procedimento_18', 'procedimento_19', 'procedimento_20', 'total_procedimentos', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['Id' => 0, 'Data' => 1, 'Turno' => 2, 'Fisioterapeuta' => 3, 'NomePaciente' => 4, 'TipoAtendimento' => 5, 'SituacaoAdministrativa' => 6, 'NipPaciente' => 7, 'NipTitular' => 8, 'CpfTitular' => 9, 'Origem' => 10, 'CorpoQuadro' => 11, 'PostoGraduacao' => 12, 'Atleta' => 13, 'Modalidade' => 14, 'OutraModalidade' => 15, 'Comparecimento' => 16, 'TipoFalta' => 17, 'Procedimento1' => 18, 'Procedimento2' => 19, 'Procedimento3' => 20, 'Procedimento4' => 21, 'Procedimento5' => 22, 'Procedimento6' => 23, 'Procedimento7' => 24, 'Procedimento8' => 25, 'Procedimento9' => 26, 'Procedimento10' => 27, 'Procedimento11' => 28, 'Procedimento12' => 29, 'Procedimento13' => 30, 'Procedimento14' => 31, 'Procedimento15' => 32, 'Procedimento16' => 33, 'Procedimento17' => 34, 'Procedimento18' => 35, 'Procedimento19' => 36, 'Procedimento20' => 37, 'TotalProcedimentos' => 38, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'data' => 1, 'turno' => 2, 'fisioterapeuta' => 3, 'nomePaciente' => 4, 'tipoAtendimento' => 5, 'situacaoAdministrativa' => 6, 'nipPaciente' => 7, 'nipTitular' => 8, 'cpfTitular' => 9, 'origem' => 10, 'corpoQuadro' => 11, 'postoGraduacao' => 12, 'atleta' => 13, 'modalidade' => 14, 'outraModalidade' => 15, 'comparecimento' => 16, 'tipoFalta' => 17, 'procedimento1' => 18, 'procedimento2' => 19, 'procedimento3' => 20, 'procedimento4' => 21, 'procedimento5' => 22, 'procedimento6' => 23, 'procedimento7' => 24, 'procedimento8' => 25, 'procedimento9' => 26, 'procedimento10' => 27, 'procedimento11' => 28, 'procedimento12' => 29, 'procedimento13' => 30, 'procedimento14' => 31, 'procedimento15' => 32, 'procedimento16' => 33, 'procedimento17' => 34, 'procedimento18' => 35, 'procedimento19' => 36, 'procedimento20' => 37, 'totalProcedimentos' => 38, ],
        self::TYPE_COLNAME       => [TabelaTableMap::COL_ID => 0, TabelaTableMap::COL_DATA => 1, TabelaTableMap::COL_TURNO => 2, TabelaTableMap::COL_FISIOTERAPEUTA => 3, TabelaTableMap::COL_NOME_PACIENTE => 4, TabelaTableMap::COL_TIPO_ATENDIMENTO => 5, TabelaTableMap::COL_SITUACAO_ADMINISTRATIVA => 6, TabelaTableMap::COL_NIP_PACIENTE => 7, TabelaTableMap::COL_NIP_TITULAR => 8, TabelaTableMap::COL_CPF_TITULAR => 9, TabelaTableMap::COL_ORIGEM => 10, TabelaTableMap::COL_CORPO_QUADRO => 11, TabelaTableMap::COL_POSTO_GRADUACAO => 12, TabelaTableMap::COL_ATLETA => 13, TabelaTableMap::COL_MODALIDADE => 14, TabelaTableMap::COL_OUTRA_MODALIDADE => 15, TabelaTableMap::COL_COMPARECIMENTO => 16, TabelaTableMap::COL_TIPO_FALTA => 17, TabelaTableMap::COL_PROCEDIMENTO_1 => 18, TabelaTableMap::COL_PROCEDIMENTO_2 => 19, TabelaTableMap::COL_PROCEDIMENTO_3 => 20, TabelaTableMap::COL_PROCEDIMENTO_4 => 21, TabelaTableMap::COL_PROCEDIMENTO_5 => 22, TabelaTableMap::COL_PROCEDIMENTO_6 => 23, TabelaTableMap::COL_PROCEDIMENTO_7 => 24, TabelaTableMap::COL_PROCEDIMENTO_8 => 25, TabelaTableMap::COL_PROCEDIMENTO_9 => 26, TabelaTableMap::COL_PROCEDIMENTO_10 => 27, TabelaTableMap::COL_PROCEDIMENTO_11 => 28, TabelaTableMap::COL_PROCEDIMENTO_12 => 29, TabelaTableMap::COL_PROCEDIMENTO_13 => 30, TabelaTableMap::COL_PROCEDIMENTO_14 => 31, TabelaTableMap::COL_PROCEDIMENTO_15 => 32, TabelaTableMap::COL_PROCEDIMENTO_16 => 33, TabelaTableMap::COL_PROCEDIMENTO_17 => 34, TabelaTableMap::COL_PROCEDIMENTO_18 => 35, TabelaTableMap::COL_PROCEDIMENTO_19 => 36, TabelaTableMap::COL_PROCEDIMENTO_20 => 37, TabelaTableMap::COL_TOTAL_PROCEDIMENTOS => 38, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'data' => 1, 'turno' => 2, 'fisioterapeuta' => 3, 'nome_paciente' => 4, 'tipo_atendimento' => 5, 'situacao_administrativa' => 6, 'nip_paciente' => 7, 'nip_titular' => 8, 'cpf_titular' => 9, 'origem' => 10, 'corpo_quadro' => 11, 'posto_graduacao' => 12, 'atleta' => 13, 'modalidade' => 14, 'outra_modalidade' => 15, 'comparecimento' => 16, 'tipo_falta' => 17, 'procedimento_1' => 18, 'procedimento_2' => 19, 'procedimento_3' => 20, 'procedimento_4' => 21, 'procedimento_5' => 22, 'procedimento_6' => 23, 'procedimento_7' => 24, 'procedimento_8' => 25, 'procedimento_9' => 26, 'procedimento_10' => 27, 'procedimento_11' => 28, 'procedimento_12' => 29, 'procedimento_13' => 30, 'procedimento_14' => 31, 'procedimento_15' => 32, 'procedimento_16' => 33, 'procedimento_17' => 34, 'procedimento_18' => 35, 'procedimento_19' => 36, 'procedimento_20' => 37, 'total_procedimentos' => 38, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Tabela.Id' => 'ID',
        'id' => 'ID',
        'tabela.id' => 'ID',
        'TabelaTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'Data' => 'DATA',
        'Tabela.Data' => 'DATA',
        'data' => 'DATA',
        'tabela.data' => 'DATA',
        'TabelaTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'Turno' => 'TURNO',
        'Tabela.Turno' => 'TURNO',
        'turno' => 'TURNO',
        'tabela.turno' => 'TURNO',
        'TabelaTableMap::COL_TURNO' => 'TURNO',
        'COL_TURNO' => 'TURNO',
        'Fisioterapeuta' => 'FISIOTERAPEUTA',
        'Tabela.Fisioterapeuta' => 'FISIOTERAPEUTA',
        'fisioterapeuta' => 'FISIOTERAPEUTA',
        'tabela.fisioterapeuta' => 'FISIOTERAPEUTA',
        'TabelaTableMap::COL_FISIOTERAPEUTA' => 'FISIOTERAPEUTA',
        'COL_FISIOTERAPEUTA' => 'FISIOTERAPEUTA',
        'NomePaciente' => 'NOME_PACIENTE',
        'Tabela.NomePaciente' => 'NOME_PACIENTE',
        'nomePaciente' => 'NOME_PACIENTE',
        'tabela.nomePaciente' => 'NOME_PACIENTE',
        'TabelaTableMap::COL_NOME_PACIENTE' => 'NOME_PACIENTE',
        'COL_NOME_PACIENTE' => 'NOME_PACIENTE',
        'nome_paciente' => 'NOME_PACIENTE',
        'tabela.nome_paciente' => 'NOME_PACIENTE',
        'TipoAtendimento' => 'TIPO_ATENDIMENTO',
        'Tabela.TipoAtendimento' => 'TIPO_ATENDIMENTO',
        'tipoAtendimento' => 'TIPO_ATENDIMENTO',
        'tabela.tipoAtendimento' => 'TIPO_ATENDIMENTO',
        'TabelaTableMap::COL_TIPO_ATENDIMENTO' => 'TIPO_ATENDIMENTO',
        'COL_TIPO_ATENDIMENTO' => 'TIPO_ATENDIMENTO',
        'tipo_atendimento' => 'TIPO_ATENDIMENTO',
        'tabela.tipo_atendimento' => 'TIPO_ATENDIMENTO',
        'SituacaoAdministrativa' => 'SITUACAO_ADMINISTRATIVA',
        'Tabela.SituacaoAdministrativa' => 'SITUACAO_ADMINISTRATIVA',
        'situacaoAdministrativa' => 'SITUACAO_ADMINISTRATIVA',
        'tabela.situacaoAdministrativa' => 'SITUACAO_ADMINISTRATIVA',
        'TabelaTableMap::COL_SITUACAO_ADMINISTRATIVA' => 'SITUACAO_ADMINISTRATIVA',
        'COL_SITUACAO_ADMINISTRATIVA' => 'SITUACAO_ADMINISTRATIVA',
        'situacao_administrativa' => 'SITUACAO_ADMINISTRATIVA',
        'tabela.situacao_administrativa' => 'SITUACAO_ADMINISTRATIVA',
        'NipPaciente' => 'NIP_PACIENTE',
        'Tabela.NipPaciente' => 'NIP_PACIENTE',
        'nipPaciente' => 'NIP_PACIENTE',
        'tabela.nipPaciente' => 'NIP_PACIENTE',
        'TabelaTableMap::COL_NIP_PACIENTE' => 'NIP_PACIENTE',
        'COL_NIP_PACIENTE' => 'NIP_PACIENTE',
        'nip_paciente' => 'NIP_PACIENTE',
        'tabela.nip_paciente' => 'NIP_PACIENTE',
        'NipTitular' => 'NIP_TITULAR',
        'Tabela.NipTitular' => 'NIP_TITULAR',
        'nipTitular' => 'NIP_TITULAR',
        'tabela.nipTitular' => 'NIP_TITULAR',
        'TabelaTableMap::COL_NIP_TITULAR' => 'NIP_TITULAR',
        'COL_NIP_TITULAR' => 'NIP_TITULAR',
        'nip_titular' => 'NIP_TITULAR',
        'tabela.nip_titular' => 'NIP_TITULAR',
        'CpfTitular' => 'CPF_TITULAR',
        'Tabela.CpfTitular' => 'CPF_TITULAR',
        'cpfTitular' => 'CPF_TITULAR',
        'tabela.cpfTitular' => 'CPF_TITULAR',
        'TabelaTableMap::COL_CPF_TITULAR' => 'CPF_TITULAR',
        'COL_CPF_TITULAR' => 'CPF_TITULAR',
        'cpf_titular' => 'CPF_TITULAR',
        'tabela.cpf_titular' => 'CPF_TITULAR',
        'Origem' => 'ORIGEM',
        'Tabela.Origem' => 'ORIGEM',
        'origem' => 'ORIGEM',
        'tabela.origem' => 'ORIGEM',
        'TabelaTableMap::COL_ORIGEM' => 'ORIGEM',
        'COL_ORIGEM' => 'ORIGEM',
        'CorpoQuadro' => 'CORPO_QUADRO',
        'Tabela.CorpoQuadro' => 'CORPO_QUADRO',
        'corpoQuadro' => 'CORPO_QUADRO',
        'tabela.corpoQuadro' => 'CORPO_QUADRO',
        'TabelaTableMap::COL_CORPO_QUADRO' => 'CORPO_QUADRO',
        'COL_CORPO_QUADRO' => 'CORPO_QUADRO',
        'corpo_quadro' => 'CORPO_QUADRO',
        'tabela.corpo_quadro' => 'CORPO_QUADRO',
        'PostoGraduacao' => 'POSTO_GRADUACAO',
        'Tabela.PostoGraduacao' => 'POSTO_GRADUACAO',
        'postoGraduacao' => 'POSTO_GRADUACAO',
        'tabela.postoGraduacao' => 'POSTO_GRADUACAO',
        'TabelaTableMap::COL_POSTO_GRADUACAO' => 'POSTO_GRADUACAO',
        'COL_POSTO_GRADUACAO' => 'POSTO_GRADUACAO',
        'posto_graduacao' => 'POSTO_GRADUACAO',
        'tabela.posto_graduacao' => 'POSTO_GRADUACAO',
        'Atleta' => 'ATLETA',
        'Tabela.Atleta' => 'ATLETA',
        'atleta' => 'ATLETA',
        'tabela.atleta' => 'ATLETA',
        'TabelaTableMap::COL_ATLETA' => 'ATLETA',
        'COL_ATLETA' => 'ATLETA',
        'Modalidade' => 'MODALIDADE',
        'Tabela.Modalidade' => 'MODALIDADE',
        'modalidade' => 'MODALIDADE',
        'tabela.modalidade' => 'MODALIDADE',
        'TabelaTableMap::COL_MODALIDADE' => 'MODALIDADE',
        'COL_MODALIDADE' => 'MODALIDADE',
        'OutraModalidade' => 'OUTRA_MODALIDADE',
        'Tabela.OutraModalidade' => 'OUTRA_MODALIDADE',
        'outraModalidade' => 'OUTRA_MODALIDADE',
        'tabela.outraModalidade' => 'OUTRA_MODALIDADE',
        'TabelaTableMap::COL_OUTRA_MODALIDADE' => 'OUTRA_MODALIDADE',
        'COL_OUTRA_MODALIDADE' => 'OUTRA_MODALIDADE',
        'outra_modalidade' => 'OUTRA_MODALIDADE',
        'tabela.outra_modalidade' => 'OUTRA_MODALIDADE',
        'Comparecimento' => 'COMPARECIMENTO',
        'Tabela.Comparecimento' => 'COMPARECIMENTO',
        'comparecimento' => 'COMPARECIMENTO',
        'tabela.comparecimento' => 'COMPARECIMENTO',
        'TabelaTableMap::COL_COMPARECIMENTO' => 'COMPARECIMENTO',
        'COL_COMPARECIMENTO' => 'COMPARECIMENTO',
        'TipoFalta' => 'TIPO_FALTA',
        'Tabela.TipoFalta' => 'TIPO_FALTA',
        'tipoFalta' => 'TIPO_FALTA',
        'tabela.tipoFalta' => 'TIPO_FALTA',
        'TabelaTableMap::COL_TIPO_FALTA' => 'TIPO_FALTA',
        'COL_TIPO_FALTA' => 'TIPO_FALTA',
        'tipo_falta' => 'TIPO_FALTA',
        'tabela.tipo_falta' => 'TIPO_FALTA',
        'Procedimento1' => 'PROCEDIMENTO_1',
        'Tabela.Procedimento1' => 'PROCEDIMENTO_1',
        'procedimento1' => 'PROCEDIMENTO_1',
        'tabela.procedimento1' => 'PROCEDIMENTO_1',
        'TabelaTableMap::COL_PROCEDIMENTO_1' => 'PROCEDIMENTO_1',
        'COL_PROCEDIMENTO_1' => 'PROCEDIMENTO_1',
        'procedimento_1' => 'PROCEDIMENTO_1',
        'tabela.procedimento_1' => 'PROCEDIMENTO_1',
        'Procedimento2' => 'PROCEDIMENTO_2',
        'Tabela.Procedimento2' => 'PROCEDIMENTO_2',
        'procedimento2' => 'PROCEDIMENTO_2',
        'tabela.procedimento2' => 'PROCEDIMENTO_2',
        'TabelaTableMap::COL_PROCEDIMENTO_2' => 'PROCEDIMENTO_2',
        'COL_PROCEDIMENTO_2' => 'PROCEDIMENTO_2',
        'procedimento_2' => 'PROCEDIMENTO_2',
        'tabela.procedimento_2' => 'PROCEDIMENTO_2',
        'Procedimento3' => 'PROCEDIMENTO_3',
        'Tabela.Procedimento3' => 'PROCEDIMENTO_3',
        'procedimento3' => 'PROCEDIMENTO_3',
        'tabela.procedimento3' => 'PROCEDIMENTO_3',
        'TabelaTableMap::COL_PROCEDIMENTO_3' => 'PROCEDIMENTO_3',
        'COL_PROCEDIMENTO_3' => 'PROCEDIMENTO_3',
        'procedimento_3' => 'PROCEDIMENTO_3',
        'tabela.procedimento_3' => 'PROCEDIMENTO_3',
        'Procedimento4' => 'PROCEDIMENTO_4',
        'Tabela.Procedimento4' => 'PROCEDIMENTO_4',
        'procedimento4' => 'PROCEDIMENTO_4',
        'tabela.procedimento4' => 'PROCEDIMENTO_4',
        'TabelaTableMap::COL_PROCEDIMENTO_4' => 'PROCEDIMENTO_4',
        'COL_PROCEDIMENTO_4' => 'PROCEDIMENTO_4',
        'procedimento_4' => 'PROCEDIMENTO_4',
        'tabela.procedimento_4' => 'PROCEDIMENTO_4',
        'Procedimento5' => 'PROCEDIMENTO_5',
        'Tabela.Procedimento5' => 'PROCEDIMENTO_5',
        'procedimento5' => 'PROCEDIMENTO_5',
        'tabela.procedimento5' => 'PROCEDIMENTO_5',
        'TabelaTableMap::COL_PROCEDIMENTO_5' => 'PROCEDIMENTO_5',
        'COL_PROCEDIMENTO_5' => 'PROCEDIMENTO_5',
        'procedimento_5' => 'PROCEDIMENTO_5',
        'tabela.procedimento_5' => 'PROCEDIMENTO_5',
        'Procedimento6' => 'PROCEDIMENTO_6',
        'Tabela.Procedimento6' => 'PROCEDIMENTO_6',
        'procedimento6' => 'PROCEDIMENTO_6',
        'tabela.procedimento6' => 'PROCEDIMENTO_6',
        'TabelaTableMap::COL_PROCEDIMENTO_6' => 'PROCEDIMENTO_6',
        'COL_PROCEDIMENTO_6' => 'PROCEDIMENTO_6',
        'procedimento_6' => 'PROCEDIMENTO_6',
        'tabela.procedimento_6' => 'PROCEDIMENTO_6',
        'Procedimento7' => 'PROCEDIMENTO_7',
        'Tabela.Procedimento7' => 'PROCEDIMENTO_7',
        'procedimento7' => 'PROCEDIMENTO_7',
        'tabela.procedimento7' => 'PROCEDIMENTO_7',
        'TabelaTableMap::COL_PROCEDIMENTO_7' => 'PROCEDIMENTO_7',
        'COL_PROCEDIMENTO_7' => 'PROCEDIMENTO_7',
        'procedimento_7' => 'PROCEDIMENTO_7',
        'tabela.procedimento_7' => 'PROCEDIMENTO_7',
        'Procedimento8' => 'PROCEDIMENTO_8',
        'Tabela.Procedimento8' => 'PROCEDIMENTO_8',
        'procedimento8' => 'PROCEDIMENTO_8',
        'tabela.procedimento8' => 'PROCEDIMENTO_8',
        'TabelaTableMap::COL_PROCEDIMENTO_8' => 'PROCEDIMENTO_8',
        'COL_PROCEDIMENTO_8' => 'PROCEDIMENTO_8',
        'procedimento_8' => 'PROCEDIMENTO_8',
        'tabela.procedimento_8' => 'PROCEDIMENTO_8',
        'Procedimento9' => 'PROCEDIMENTO_9',
        'Tabela.Procedimento9' => 'PROCEDIMENTO_9',
        'procedimento9' => 'PROCEDIMENTO_9',
        'tabela.procedimento9' => 'PROCEDIMENTO_9',
        'TabelaTableMap::COL_PROCEDIMENTO_9' => 'PROCEDIMENTO_9',
        'COL_PROCEDIMENTO_9' => 'PROCEDIMENTO_9',
        'procedimento_9' => 'PROCEDIMENTO_9',
        'tabela.procedimento_9' => 'PROCEDIMENTO_9',
        'Procedimento10' => 'PROCEDIMENTO_10',
        'Tabela.Procedimento10' => 'PROCEDIMENTO_10',
        'procedimento10' => 'PROCEDIMENTO_10',
        'tabela.procedimento10' => 'PROCEDIMENTO_10',
        'TabelaTableMap::COL_PROCEDIMENTO_10' => 'PROCEDIMENTO_10',
        'COL_PROCEDIMENTO_10' => 'PROCEDIMENTO_10',
        'procedimento_10' => 'PROCEDIMENTO_10',
        'tabela.procedimento_10' => 'PROCEDIMENTO_10',
        'Procedimento11' => 'PROCEDIMENTO_11',
        'Tabela.Procedimento11' => 'PROCEDIMENTO_11',
        'procedimento11' => 'PROCEDIMENTO_11',
        'tabela.procedimento11' => 'PROCEDIMENTO_11',
        'TabelaTableMap::COL_PROCEDIMENTO_11' => 'PROCEDIMENTO_11',
        'COL_PROCEDIMENTO_11' => 'PROCEDIMENTO_11',
        'procedimento_11' => 'PROCEDIMENTO_11',
        'tabela.procedimento_11' => 'PROCEDIMENTO_11',
        'Procedimento12' => 'PROCEDIMENTO_12',
        'Tabela.Procedimento12' => 'PROCEDIMENTO_12',
        'procedimento12' => 'PROCEDIMENTO_12',
        'tabela.procedimento12' => 'PROCEDIMENTO_12',
        'TabelaTableMap::COL_PROCEDIMENTO_12' => 'PROCEDIMENTO_12',
        'COL_PROCEDIMENTO_12' => 'PROCEDIMENTO_12',
        'procedimento_12' => 'PROCEDIMENTO_12',
        'tabela.procedimento_12' => 'PROCEDIMENTO_12',
        'Procedimento13' => 'PROCEDIMENTO_13',
        'Tabela.Procedimento13' => 'PROCEDIMENTO_13',
        'procedimento13' => 'PROCEDIMENTO_13',
        'tabela.procedimento13' => 'PROCEDIMENTO_13',
        'TabelaTableMap::COL_PROCEDIMENTO_13' => 'PROCEDIMENTO_13',
        'COL_PROCEDIMENTO_13' => 'PROCEDIMENTO_13',
        'procedimento_13' => 'PROCEDIMENTO_13',
        'tabela.procedimento_13' => 'PROCEDIMENTO_13',
        'Procedimento14' => 'PROCEDIMENTO_14',
        'Tabela.Procedimento14' => 'PROCEDIMENTO_14',
        'procedimento14' => 'PROCEDIMENTO_14',
        'tabela.procedimento14' => 'PROCEDIMENTO_14',
        'TabelaTableMap::COL_PROCEDIMENTO_14' => 'PROCEDIMENTO_14',
        'COL_PROCEDIMENTO_14' => 'PROCEDIMENTO_14',
        'procedimento_14' => 'PROCEDIMENTO_14',
        'tabela.procedimento_14' => 'PROCEDIMENTO_14',
        'Procedimento15' => 'PROCEDIMENTO_15',
        'Tabela.Procedimento15' => 'PROCEDIMENTO_15',
        'procedimento15' => 'PROCEDIMENTO_15',
        'tabela.procedimento15' => 'PROCEDIMENTO_15',
        'TabelaTableMap::COL_PROCEDIMENTO_15' => 'PROCEDIMENTO_15',
        'COL_PROCEDIMENTO_15' => 'PROCEDIMENTO_15',
        'procedimento_15' => 'PROCEDIMENTO_15',
        'tabela.procedimento_15' => 'PROCEDIMENTO_15',
        'Procedimento16' => 'PROCEDIMENTO_16',
        'Tabela.Procedimento16' => 'PROCEDIMENTO_16',
        'procedimento16' => 'PROCEDIMENTO_16',
        'tabela.procedimento16' => 'PROCEDIMENTO_16',
        'TabelaTableMap::COL_PROCEDIMENTO_16' => 'PROCEDIMENTO_16',
        'COL_PROCEDIMENTO_16' => 'PROCEDIMENTO_16',
        'procedimento_16' => 'PROCEDIMENTO_16',
        'tabela.procedimento_16' => 'PROCEDIMENTO_16',
        'Procedimento17' => 'PROCEDIMENTO_17',
        'Tabela.Procedimento17' => 'PROCEDIMENTO_17',
        'procedimento17' => 'PROCEDIMENTO_17',
        'tabela.procedimento17' => 'PROCEDIMENTO_17',
        'TabelaTableMap::COL_PROCEDIMENTO_17' => 'PROCEDIMENTO_17',
        'COL_PROCEDIMENTO_17' => 'PROCEDIMENTO_17',
        'procedimento_17' => 'PROCEDIMENTO_17',
        'tabela.procedimento_17' => 'PROCEDIMENTO_17',
        'Procedimento18' => 'PROCEDIMENTO_18',
        'Tabela.Procedimento18' => 'PROCEDIMENTO_18',
        'procedimento18' => 'PROCEDIMENTO_18',
        'tabela.procedimento18' => 'PROCEDIMENTO_18',
        'TabelaTableMap::COL_PROCEDIMENTO_18' => 'PROCEDIMENTO_18',
        'COL_PROCEDIMENTO_18' => 'PROCEDIMENTO_18',
        'procedimento_18' => 'PROCEDIMENTO_18',
        'tabela.procedimento_18' => 'PROCEDIMENTO_18',
        'Procedimento19' => 'PROCEDIMENTO_19',
        'Tabela.Procedimento19' => 'PROCEDIMENTO_19',
        'procedimento19' => 'PROCEDIMENTO_19',
        'tabela.procedimento19' => 'PROCEDIMENTO_19',
        'TabelaTableMap::COL_PROCEDIMENTO_19' => 'PROCEDIMENTO_19',
        'COL_PROCEDIMENTO_19' => 'PROCEDIMENTO_19',
        'procedimento_19' => 'PROCEDIMENTO_19',
        'tabela.procedimento_19' => 'PROCEDIMENTO_19',
        'Procedimento20' => 'PROCEDIMENTO_20',
        'Tabela.Procedimento20' => 'PROCEDIMENTO_20',
        'procedimento20' => 'PROCEDIMENTO_20',
        'tabela.procedimento20' => 'PROCEDIMENTO_20',
        'TabelaTableMap::COL_PROCEDIMENTO_20' => 'PROCEDIMENTO_20',
        'COL_PROCEDIMENTO_20' => 'PROCEDIMENTO_20',
        'procedimento_20' => 'PROCEDIMENTO_20',
        'tabela.procedimento_20' => 'PROCEDIMENTO_20',
        'TotalProcedimentos' => 'TOTAL_PROCEDIMENTOS',
        'Tabela.TotalProcedimentos' => 'TOTAL_PROCEDIMENTOS',
        'totalProcedimentos' => 'TOTAL_PROCEDIMENTOS',
        'tabela.totalProcedimentos' => 'TOTAL_PROCEDIMENTOS',
        'TabelaTableMap::COL_TOTAL_PROCEDIMENTOS' => 'TOTAL_PROCEDIMENTOS',
        'COL_TOTAL_PROCEDIMENTOS' => 'TOTAL_PROCEDIMENTOS',
        'total_procedimentos' => 'TOTAL_PROCEDIMENTOS',
        'tabela.total_procedimentos' => 'TOTAL_PROCEDIMENTOS',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('tabela');
        $this->setPhpName('Tabela');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Api\\Models\\Tabela');
        $this->setPackage('Api.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('data', 'Data', 'VARCHAR', false, 10, null);
        $this->addColumn('turno', 'Turno', 'VARCHAR', true, 5, null);
        $this->addColumn('fisioterapeuta', 'Fisioterapeuta', 'VARCHAR', false, 100, null);
        $this->addColumn('nome_paciente', 'NomePaciente', 'VARCHAR', false, 43, null);
        $this->addColumn('tipo_atendimento', 'TipoAtendimento', 'VARCHAR', false, 21, null);
        $this->addColumn('situacao_administrativa', 'SituacaoAdministrativa', 'VARCHAR', false, 17, null);
        $this->addColumn('nip_paciente', 'NipPaciente', 'VARCHAR', false, 8, null);
        $this->addColumn('nip_titular', 'NipTitular', 'VARCHAR', false, 8, null);
        $this->addColumn('cpf_titular', 'CpfTitular', 'VARCHAR', false, 11, null);
        $this->addColumn('origem', 'Origem', 'VARCHAR', false, 7, null);
        $this->addColumn('corpo_quadro', 'CorpoQuadro', 'VARCHAR', false, 4, null);
        $this->addColumn('posto_graduacao', 'PostoGraduacao', 'VARCHAR', false, 2, null);
        $this->addColumn('atleta', 'Atleta', 'VARCHAR', false, 3, null);
        $this->addColumn('modalidade', 'Modalidade', 'VARCHAR', false, 20, null);
        $this->addColumn('outra_modalidade', 'OutraModalidade', 'VARCHAR', false, 10, null);
        $this->addColumn('comparecimento', 'Comparecimento', 'BOOLEAN', false, 1, null);
        $this->addColumn('tipo_falta', 'TipoFalta', 'VARCHAR', true, 40, null);
        $this->addColumn('procedimento_1', 'Procedimento1', 'VARCHAR', false, 50, null);
        $this->addColumn('procedimento_2', 'Procedimento2', 'VARCHAR', false, 50, null);
        $this->addColumn('procedimento_3', 'Procedimento3', 'VARCHAR', false, 50, null);
        $this->addColumn('procedimento_4', 'Procedimento4', 'VARCHAR', false, 50, null);
        $this->addColumn('procedimento_5', 'Procedimento5', 'VARCHAR', false, 50, null);
        $this->addColumn('procedimento_6', 'Procedimento6', 'VARCHAR', false, 50, null);
        $this->addColumn('procedimento_7', 'Procedimento7', 'VARCHAR', false, 50, null);
        $this->addColumn('procedimento_8', 'Procedimento8', 'VARCHAR', false, 50, null);
        $this->addColumn('procedimento_9', 'Procedimento9', 'VARCHAR', false, 50, null);
        $this->addColumn('procedimento_10', 'Procedimento10', 'VARCHAR', false, 50, null);
        $this->addColumn('procedimento_11', 'Procedimento11', 'VARCHAR', false, 50, null);
        $this->addColumn('procedimento_12', 'Procedimento12', 'VARCHAR', false, 50, null);
        $this->addColumn('procedimento_13', 'Procedimento13', 'VARCHAR', false, 50, null);
        $this->addColumn('procedimento_14', 'Procedimento14', 'VARCHAR', false, 50, null);
        $this->addColumn('procedimento_15', 'Procedimento15', 'VARCHAR', false, 50, null);
        $this->addColumn('procedimento_16', 'Procedimento16', 'VARCHAR', false, 50, null);
        $this->addColumn('procedimento_17', 'Procedimento17', 'VARCHAR', false, 50, null);
        $this->addColumn('procedimento_18', 'Procedimento18', 'VARCHAR', false, 50, null);
        $this->addColumn('procedimento_19', 'Procedimento19', 'VARCHAR', false, 50, null);
        $this->addColumn('procedimento_20', 'Procedimento20', 'VARCHAR', false, 50, null);
        $this->addColumn('total_procedimentos', 'TotalProcedimentos', 'INTEGER', false, 1, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? TabelaTableMap::CLASS_DEFAULT : TabelaTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array (Tabela object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = TabelaTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = TabelaTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + TabelaTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TabelaTableMap::OM_CLASS;
            /** @var Tabela $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            TabelaTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = TabelaTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = TabelaTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Tabela $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TabelaTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(TabelaTableMap::COL_ID);
            $criteria->addSelectColumn(TabelaTableMap::COL_DATA);
            $criteria->addSelectColumn(TabelaTableMap::COL_TURNO);
            $criteria->addSelectColumn(TabelaTableMap::COL_FISIOTERAPEUTA);
            $criteria->addSelectColumn(TabelaTableMap::COL_NOME_PACIENTE);
            $criteria->addSelectColumn(TabelaTableMap::COL_TIPO_ATENDIMENTO);
            $criteria->addSelectColumn(TabelaTableMap::COL_SITUACAO_ADMINISTRATIVA);
            $criteria->addSelectColumn(TabelaTableMap::COL_NIP_PACIENTE);
            $criteria->addSelectColumn(TabelaTableMap::COL_NIP_TITULAR);
            $criteria->addSelectColumn(TabelaTableMap::COL_CPF_TITULAR);
            $criteria->addSelectColumn(TabelaTableMap::COL_ORIGEM);
            $criteria->addSelectColumn(TabelaTableMap::COL_CORPO_QUADRO);
            $criteria->addSelectColumn(TabelaTableMap::COL_POSTO_GRADUACAO);
            $criteria->addSelectColumn(TabelaTableMap::COL_ATLETA);
            $criteria->addSelectColumn(TabelaTableMap::COL_MODALIDADE);
            $criteria->addSelectColumn(TabelaTableMap::COL_OUTRA_MODALIDADE);
            $criteria->addSelectColumn(TabelaTableMap::COL_COMPARECIMENTO);
            $criteria->addSelectColumn(TabelaTableMap::COL_TIPO_FALTA);
            $criteria->addSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_1);
            $criteria->addSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_2);
            $criteria->addSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_3);
            $criteria->addSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_4);
            $criteria->addSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_5);
            $criteria->addSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_6);
            $criteria->addSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_7);
            $criteria->addSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_8);
            $criteria->addSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_9);
            $criteria->addSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_10);
            $criteria->addSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_11);
            $criteria->addSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_12);
            $criteria->addSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_13);
            $criteria->addSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_14);
            $criteria->addSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_15);
            $criteria->addSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_16);
            $criteria->addSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_17);
            $criteria->addSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_18);
            $criteria->addSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_19);
            $criteria->addSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_20);
            $criteria->addSelectColumn(TabelaTableMap::COL_TOTAL_PROCEDIMENTOS);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.data');
            $criteria->addSelectColumn($alias . '.turno');
            $criteria->addSelectColumn($alias . '.fisioterapeuta');
            $criteria->addSelectColumn($alias . '.nome_paciente');
            $criteria->addSelectColumn($alias . '.tipo_atendimento');
            $criteria->addSelectColumn($alias . '.situacao_administrativa');
            $criteria->addSelectColumn($alias . '.nip_paciente');
            $criteria->addSelectColumn($alias . '.nip_titular');
            $criteria->addSelectColumn($alias . '.cpf_titular');
            $criteria->addSelectColumn($alias . '.origem');
            $criteria->addSelectColumn($alias . '.corpo_quadro');
            $criteria->addSelectColumn($alias . '.posto_graduacao');
            $criteria->addSelectColumn($alias . '.atleta');
            $criteria->addSelectColumn($alias . '.modalidade');
            $criteria->addSelectColumn($alias . '.outra_modalidade');
            $criteria->addSelectColumn($alias . '.comparecimento');
            $criteria->addSelectColumn($alias . '.tipo_falta');
            $criteria->addSelectColumn($alias . '.procedimento_1');
            $criteria->addSelectColumn($alias . '.procedimento_2');
            $criteria->addSelectColumn($alias . '.procedimento_3');
            $criteria->addSelectColumn($alias . '.procedimento_4');
            $criteria->addSelectColumn($alias . '.procedimento_5');
            $criteria->addSelectColumn($alias . '.procedimento_6');
            $criteria->addSelectColumn($alias . '.procedimento_7');
            $criteria->addSelectColumn($alias . '.procedimento_8');
            $criteria->addSelectColumn($alias . '.procedimento_9');
            $criteria->addSelectColumn($alias . '.procedimento_10');
            $criteria->addSelectColumn($alias . '.procedimento_11');
            $criteria->addSelectColumn($alias . '.procedimento_12');
            $criteria->addSelectColumn($alias . '.procedimento_13');
            $criteria->addSelectColumn($alias . '.procedimento_14');
            $criteria->addSelectColumn($alias . '.procedimento_15');
            $criteria->addSelectColumn($alias . '.procedimento_16');
            $criteria->addSelectColumn($alias . '.procedimento_17');
            $criteria->addSelectColumn($alias . '.procedimento_18');
            $criteria->addSelectColumn($alias . '.procedimento_19');
            $criteria->addSelectColumn($alias . '.procedimento_20');
            $criteria->addSelectColumn($alias . '.total_procedimentos');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(TabelaTableMap::COL_ID);
            $criteria->removeSelectColumn(TabelaTableMap::COL_DATA);
            $criteria->removeSelectColumn(TabelaTableMap::COL_TURNO);
            $criteria->removeSelectColumn(TabelaTableMap::COL_FISIOTERAPEUTA);
            $criteria->removeSelectColumn(TabelaTableMap::COL_NOME_PACIENTE);
            $criteria->removeSelectColumn(TabelaTableMap::COL_TIPO_ATENDIMENTO);
            $criteria->removeSelectColumn(TabelaTableMap::COL_SITUACAO_ADMINISTRATIVA);
            $criteria->removeSelectColumn(TabelaTableMap::COL_NIP_PACIENTE);
            $criteria->removeSelectColumn(TabelaTableMap::COL_NIP_TITULAR);
            $criteria->removeSelectColumn(TabelaTableMap::COL_CPF_TITULAR);
            $criteria->removeSelectColumn(TabelaTableMap::COL_ORIGEM);
            $criteria->removeSelectColumn(TabelaTableMap::COL_CORPO_QUADRO);
            $criteria->removeSelectColumn(TabelaTableMap::COL_POSTO_GRADUACAO);
            $criteria->removeSelectColumn(TabelaTableMap::COL_ATLETA);
            $criteria->removeSelectColumn(TabelaTableMap::COL_MODALIDADE);
            $criteria->removeSelectColumn(TabelaTableMap::COL_OUTRA_MODALIDADE);
            $criteria->removeSelectColumn(TabelaTableMap::COL_COMPARECIMENTO);
            $criteria->removeSelectColumn(TabelaTableMap::COL_TIPO_FALTA);
            $criteria->removeSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_1);
            $criteria->removeSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_2);
            $criteria->removeSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_3);
            $criteria->removeSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_4);
            $criteria->removeSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_5);
            $criteria->removeSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_6);
            $criteria->removeSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_7);
            $criteria->removeSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_8);
            $criteria->removeSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_9);
            $criteria->removeSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_10);
            $criteria->removeSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_11);
            $criteria->removeSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_12);
            $criteria->removeSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_13);
            $criteria->removeSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_14);
            $criteria->removeSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_15);
            $criteria->removeSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_16);
            $criteria->removeSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_17);
            $criteria->removeSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_18);
            $criteria->removeSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_19);
            $criteria->removeSelectColumn(TabelaTableMap::COL_PROCEDIMENTO_20);
            $criteria->removeSelectColumn(TabelaTableMap::COL_TOTAL_PROCEDIMENTOS);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.data');
            $criteria->removeSelectColumn($alias . '.turno');
            $criteria->removeSelectColumn($alias . '.fisioterapeuta');
            $criteria->removeSelectColumn($alias . '.nome_paciente');
            $criteria->removeSelectColumn($alias . '.tipo_atendimento');
            $criteria->removeSelectColumn($alias . '.situacao_administrativa');
            $criteria->removeSelectColumn($alias . '.nip_paciente');
            $criteria->removeSelectColumn($alias . '.nip_titular');
            $criteria->removeSelectColumn($alias . '.cpf_titular');
            $criteria->removeSelectColumn($alias . '.origem');
            $criteria->removeSelectColumn($alias . '.corpo_quadro');
            $criteria->removeSelectColumn($alias . '.posto_graduacao');
            $criteria->removeSelectColumn($alias . '.atleta');
            $criteria->removeSelectColumn($alias . '.modalidade');
            $criteria->removeSelectColumn($alias . '.outra_modalidade');
            $criteria->removeSelectColumn($alias . '.comparecimento');
            $criteria->removeSelectColumn($alias . '.tipo_falta');
            $criteria->removeSelectColumn($alias . '.procedimento_1');
            $criteria->removeSelectColumn($alias . '.procedimento_2');
            $criteria->removeSelectColumn($alias . '.procedimento_3');
            $criteria->removeSelectColumn($alias . '.procedimento_4');
            $criteria->removeSelectColumn($alias . '.procedimento_5');
            $criteria->removeSelectColumn($alias . '.procedimento_6');
            $criteria->removeSelectColumn($alias . '.procedimento_7');
            $criteria->removeSelectColumn($alias . '.procedimento_8');
            $criteria->removeSelectColumn($alias . '.procedimento_9');
            $criteria->removeSelectColumn($alias . '.procedimento_10');
            $criteria->removeSelectColumn($alias . '.procedimento_11');
            $criteria->removeSelectColumn($alias . '.procedimento_12');
            $criteria->removeSelectColumn($alias . '.procedimento_13');
            $criteria->removeSelectColumn($alias . '.procedimento_14');
            $criteria->removeSelectColumn($alias . '.procedimento_15');
            $criteria->removeSelectColumn($alias . '.procedimento_16');
            $criteria->removeSelectColumn($alias . '.procedimento_17');
            $criteria->removeSelectColumn($alias . '.procedimento_18');
            $criteria->removeSelectColumn($alias . '.procedimento_19');
            $criteria->removeSelectColumn($alias . '.procedimento_20');
            $criteria->removeSelectColumn($alias . '.total_procedimentos');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(TabelaTableMap::DATABASE_NAME)->getTable(TabelaTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Tabela or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Tabela object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TabelaTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Api\Models\Tabela) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(TabelaTableMap::DATABASE_NAME);
            $criteria->add(TabelaTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = TabelaQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            TabelaTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                TabelaTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tabela table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return TabelaQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Tabela or Criteria object.
     *
     * @param mixed $criteria Criteria or Tabela object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TabelaTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Tabela object
        }

        if ($criteria->containsKey(TabelaTableMap::COL_ID) && $criteria->keyContainsValue(TabelaTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.TabelaTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = TabelaQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
