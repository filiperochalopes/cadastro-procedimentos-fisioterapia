<?php

namespace Api\Models\Base;

use \Exception;
use \PDO;
use Api\Models\TabelaDeprecated as ChildTabelaDeprecated;
use Api\Models\TabelaDeprecatedQuery as ChildTabelaDeprecatedQuery;
use Api\Models\Map\TabelaDeprecatedTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'tabela' table.
 *
 *
 *
 * @method     ChildTabelaDeprecatedQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildTabelaDeprecatedQuery orderByData($order = Criteria::ASC) Order by the data column
 * @method     ChildTabelaDeprecatedQuery orderByTurno($order = Criteria::ASC) Order by the turno column
 * @method     ChildTabelaDeprecatedQuery orderByFisioterapeuta($order = Criteria::ASC) Order by the fisioterapeuta column
 * @method     ChildTabelaDeprecatedQuery orderByNomePaciente($order = Criteria::ASC) Order by the nome_paciente column
 * @method     ChildTabelaDeprecatedQuery orderByTipoAtendimento($order = Criteria::ASC) Order by the tipo_atendimento column
 * @method     ChildTabelaDeprecatedQuery orderBySituacaoAdministrativa($order = Criteria::ASC) Order by the situacao_administrativa column
 * @method     ChildTabelaDeprecatedQuery orderByNipPaciente($order = Criteria::ASC) Order by the nip_paciente column
 * @method     ChildTabelaDeprecatedQuery orderByNipTitular($order = Criteria::ASC) Order by the nip_titular column
 * @method     ChildTabelaDeprecatedQuery orderByCpfTitular($order = Criteria::ASC) Order by the cpf_titular column
 * @method     ChildTabelaDeprecatedQuery orderByOrigem($order = Criteria::ASC) Order by the origem column
 * @method     ChildTabelaDeprecatedQuery orderByCorpoQuadro($order = Criteria::ASC) Order by the corpo_quadro column
 * @method     ChildTabelaDeprecatedQuery orderByPostoGraduacao($order = Criteria::ASC) Order by the posto_graduacao column
 * @method     ChildTabelaDeprecatedQuery orderByAtleta($order = Criteria::ASC) Order by the atleta column
 * @method     ChildTabelaDeprecatedQuery orderByModalidade($order = Criteria::ASC) Order by the modalidade column
 * @method     ChildTabelaDeprecatedQuery orderByOutraModalidade($order = Criteria::ASC) Order by the outra_modalidade column
 * @method     ChildTabelaDeprecatedQuery orderByComparecimento($order = Criteria::ASC) Order by the comparecimento column
 * @method     ChildTabelaDeprecatedQuery orderByTipoFalta($order = Criteria::ASC) Order by the tipo_falta column
 * @method     ChildTabelaDeprecatedQuery orderByProcedimento1($order = Criteria::ASC) Order by the procedimento_1 column
 * @method     ChildTabelaDeprecatedQuery orderByProcedimento2($order = Criteria::ASC) Order by the procedimento_2 column
 * @method     ChildTabelaDeprecatedQuery orderByProcedimento3($order = Criteria::ASC) Order by the procedimento_3 column
 * @method     ChildTabelaDeprecatedQuery orderByProcedimento4($order = Criteria::ASC) Order by the procedimento_4 column
 * @method     ChildTabelaDeprecatedQuery orderByProcedimento5($order = Criteria::ASC) Order by the procedimento_5 column
 * @method     ChildTabelaDeprecatedQuery orderByProcedimento6($order = Criteria::ASC) Order by the procedimento_6 column
 * @method     ChildTabelaDeprecatedQuery orderByProcedimento7($order = Criteria::ASC) Order by the procedimento_7 column
 * @method     ChildTabelaDeprecatedQuery orderByProcedimento8($order = Criteria::ASC) Order by the procedimento_8 column
 * @method     ChildTabelaDeprecatedQuery orderByProcedimento9($order = Criteria::ASC) Order by the procedimento_9 column
 * @method     ChildTabelaDeprecatedQuery orderByProcedimento10($order = Criteria::ASC) Order by the procedimento_10 column
 * @method     ChildTabelaDeprecatedQuery orderByProcedimento11($order = Criteria::ASC) Order by the procedimento_11 column
 * @method     ChildTabelaDeprecatedQuery orderByProcedimento12($order = Criteria::ASC) Order by the procedimento_12 column
 * @method     ChildTabelaDeprecatedQuery orderByProcedimento13($order = Criteria::ASC) Order by the procedimento_13 column
 * @method     ChildTabelaDeprecatedQuery orderByProcedimento14($order = Criteria::ASC) Order by the procedimento_14 column
 * @method     ChildTabelaDeprecatedQuery orderByProcedimento15($order = Criteria::ASC) Order by the procedimento_15 column
 * @method     ChildTabelaDeprecatedQuery orderByProcedimento16($order = Criteria::ASC) Order by the procedimento_16 column
 * @method     ChildTabelaDeprecatedQuery orderByProcedimento17($order = Criteria::ASC) Order by the procedimento_17 column
 * @method     ChildTabelaDeprecatedQuery orderByProcedimento18($order = Criteria::ASC) Order by the procedimento_18 column
 * @method     ChildTabelaDeprecatedQuery orderByProcedimento19($order = Criteria::ASC) Order by the procedimento_19 column
 * @method     ChildTabelaDeprecatedQuery orderByProcedimento20($order = Criteria::ASC) Order by the procedimento_20 column
 * @method     ChildTabelaDeprecatedQuery orderByTotalProcedimentos($order = Criteria::ASC) Order by the total_procedimentos column
 *
 * @method     ChildTabelaDeprecatedQuery groupById() Group by the id column
 * @method     ChildTabelaDeprecatedQuery groupByData() Group by the data column
 * @method     ChildTabelaDeprecatedQuery groupByTurno() Group by the turno column
 * @method     ChildTabelaDeprecatedQuery groupByFisioterapeuta() Group by the fisioterapeuta column
 * @method     ChildTabelaDeprecatedQuery groupByNomePaciente() Group by the nome_paciente column
 * @method     ChildTabelaDeprecatedQuery groupByTipoAtendimento() Group by the tipo_atendimento column
 * @method     ChildTabelaDeprecatedQuery groupBySituacaoAdministrativa() Group by the situacao_administrativa column
 * @method     ChildTabelaDeprecatedQuery groupByNipPaciente() Group by the nip_paciente column
 * @method     ChildTabelaDeprecatedQuery groupByNipTitular() Group by the nip_titular column
 * @method     ChildTabelaDeprecatedQuery groupByCpfTitular() Group by the cpf_titular column
 * @method     ChildTabelaDeprecatedQuery groupByOrigem() Group by the origem column
 * @method     ChildTabelaDeprecatedQuery groupByCorpoQuadro() Group by the corpo_quadro column
 * @method     ChildTabelaDeprecatedQuery groupByPostoGraduacao() Group by the posto_graduacao column
 * @method     ChildTabelaDeprecatedQuery groupByAtleta() Group by the atleta column
 * @method     ChildTabelaDeprecatedQuery groupByModalidade() Group by the modalidade column
 * @method     ChildTabelaDeprecatedQuery groupByOutraModalidade() Group by the outra_modalidade column
 * @method     ChildTabelaDeprecatedQuery groupByComparecimento() Group by the comparecimento column
 * @method     ChildTabelaDeprecatedQuery groupByTipoFalta() Group by the tipo_falta column
 * @method     ChildTabelaDeprecatedQuery groupByProcedimento1() Group by the procedimento_1 column
 * @method     ChildTabelaDeprecatedQuery groupByProcedimento2() Group by the procedimento_2 column
 * @method     ChildTabelaDeprecatedQuery groupByProcedimento3() Group by the procedimento_3 column
 * @method     ChildTabelaDeprecatedQuery groupByProcedimento4() Group by the procedimento_4 column
 * @method     ChildTabelaDeprecatedQuery groupByProcedimento5() Group by the procedimento_5 column
 * @method     ChildTabelaDeprecatedQuery groupByProcedimento6() Group by the procedimento_6 column
 * @method     ChildTabelaDeprecatedQuery groupByProcedimento7() Group by the procedimento_7 column
 * @method     ChildTabelaDeprecatedQuery groupByProcedimento8() Group by the procedimento_8 column
 * @method     ChildTabelaDeprecatedQuery groupByProcedimento9() Group by the procedimento_9 column
 * @method     ChildTabelaDeprecatedQuery groupByProcedimento10() Group by the procedimento_10 column
 * @method     ChildTabelaDeprecatedQuery groupByProcedimento11() Group by the procedimento_11 column
 * @method     ChildTabelaDeprecatedQuery groupByProcedimento12() Group by the procedimento_12 column
 * @method     ChildTabelaDeprecatedQuery groupByProcedimento13() Group by the procedimento_13 column
 * @method     ChildTabelaDeprecatedQuery groupByProcedimento14() Group by the procedimento_14 column
 * @method     ChildTabelaDeprecatedQuery groupByProcedimento15() Group by the procedimento_15 column
 * @method     ChildTabelaDeprecatedQuery groupByProcedimento16() Group by the procedimento_16 column
 * @method     ChildTabelaDeprecatedQuery groupByProcedimento17() Group by the procedimento_17 column
 * @method     ChildTabelaDeprecatedQuery groupByProcedimento18() Group by the procedimento_18 column
 * @method     ChildTabelaDeprecatedQuery groupByProcedimento19() Group by the procedimento_19 column
 * @method     ChildTabelaDeprecatedQuery groupByProcedimento20() Group by the procedimento_20 column
 * @method     ChildTabelaDeprecatedQuery groupByTotalProcedimentos() Group by the total_procedimentos column
 *
 * @method     ChildTabelaDeprecatedQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTabelaDeprecatedQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTabelaDeprecatedQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTabelaDeprecatedQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTabelaDeprecatedQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTabelaDeprecatedQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTabelaDeprecated|null findOne(?ConnectionInterface $con = null) Return the first ChildTabelaDeprecated matching the query
 * @method     ChildTabelaDeprecated findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildTabelaDeprecated matching the query, or a new ChildTabelaDeprecated object populated from the query conditions when no match is found
 *
 * @method     ChildTabelaDeprecated|null findOneById(int $id) Return the first ChildTabelaDeprecated filtered by the id column
 * @method     ChildTabelaDeprecated|null findOneByData(string $data) Return the first ChildTabelaDeprecated filtered by the data column
 * @method     ChildTabelaDeprecated|null findOneByTurno(string $turno) Return the first ChildTabelaDeprecated filtered by the turno column
 * @method     ChildTabelaDeprecated|null findOneByFisioterapeuta(string $fisioterapeuta) Return the first ChildTabelaDeprecated filtered by the fisioterapeuta column
 * @method     ChildTabelaDeprecated|null findOneByNomePaciente(string $nome_paciente) Return the first ChildTabelaDeprecated filtered by the nome_paciente column
 * @method     ChildTabelaDeprecated|null findOneByTipoAtendimento(string $tipo_atendimento) Return the first ChildTabelaDeprecated filtered by the tipo_atendimento column
 * @method     ChildTabelaDeprecated|null findOneBySituacaoAdministrativa(string $situacao_administrativa) Return the first ChildTabelaDeprecated filtered by the situacao_administrativa column
 * @method     ChildTabelaDeprecated|null findOneByNipPaciente(string $nip_paciente) Return the first ChildTabelaDeprecated filtered by the nip_paciente column
 * @method     ChildTabelaDeprecated|null findOneByNipTitular(string $nip_titular) Return the first ChildTabelaDeprecated filtered by the nip_titular column
 * @method     ChildTabelaDeprecated|null findOneByCpfTitular(string $cpf_titular) Return the first ChildTabelaDeprecated filtered by the cpf_titular column
 * @method     ChildTabelaDeprecated|null findOneByOrigem(string $origem) Return the first ChildTabelaDeprecated filtered by the origem column
 * @method     ChildTabelaDeprecated|null findOneByCorpoQuadro(string $corpo_quadro) Return the first ChildTabelaDeprecated filtered by the corpo_quadro column
 * @method     ChildTabelaDeprecated|null findOneByPostoGraduacao(string $posto_graduacao) Return the first ChildTabelaDeprecated filtered by the posto_graduacao column
 * @method     ChildTabelaDeprecated|null findOneByAtleta(string $atleta) Return the first ChildTabelaDeprecated filtered by the atleta column
 * @method     ChildTabelaDeprecated|null findOneByModalidade(string $modalidade) Return the first ChildTabelaDeprecated filtered by the modalidade column
 * @method     ChildTabelaDeprecated|null findOneByOutraModalidade(string $outra_modalidade) Return the first ChildTabelaDeprecated filtered by the outra_modalidade column
 * @method     ChildTabelaDeprecated|null findOneByComparecimento(boolean $comparecimento) Return the first ChildTabelaDeprecated filtered by the comparecimento column
 * @method     ChildTabelaDeprecated|null findOneByTipoFalta(string $tipo_falta) Return the first ChildTabelaDeprecated filtered by the tipo_falta column
 * @method     ChildTabelaDeprecated|null findOneByProcedimento1(string $procedimento_1) Return the first ChildTabelaDeprecated filtered by the procedimento_1 column
 * @method     ChildTabelaDeprecated|null findOneByProcedimento2(string $procedimento_2) Return the first ChildTabelaDeprecated filtered by the procedimento_2 column
 * @method     ChildTabelaDeprecated|null findOneByProcedimento3(string $procedimento_3) Return the first ChildTabelaDeprecated filtered by the procedimento_3 column
 * @method     ChildTabelaDeprecated|null findOneByProcedimento4(string $procedimento_4) Return the first ChildTabelaDeprecated filtered by the procedimento_4 column
 * @method     ChildTabelaDeprecated|null findOneByProcedimento5(string $procedimento_5) Return the first ChildTabelaDeprecated filtered by the procedimento_5 column
 * @method     ChildTabelaDeprecated|null findOneByProcedimento6(string $procedimento_6) Return the first ChildTabelaDeprecated filtered by the procedimento_6 column
 * @method     ChildTabelaDeprecated|null findOneByProcedimento7(string $procedimento_7) Return the first ChildTabelaDeprecated filtered by the procedimento_7 column
 * @method     ChildTabelaDeprecated|null findOneByProcedimento8(string $procedimento_8) Return the first ChildTabelaDeprecated filtered by the procedimento_8 column
 * @method     ChildTabelaDeprecated|null findOneByProcedimento9(string $procedimento_9) Return the first ChildTabelaDeprecated filtered by the procedimento_9 column
 * @method     ChildTabelaDeprecated|null findOneByProcedimento10(string $procedimento_10) Return the first ChildTabelaDeprecated filtered by the procedimento_10 column
 * @method     ChildTabelaDeprecated|null findOneByProcedimento11(string $procedimento_11) Return the first ChildTabelaDeprecated filtered by the procedimento_11 column
 * @method     ChildTabelaDeprecated|null findOneByProcedimento12(string $procedimento_12) Return the first ChildTabelaDeprecated filtered by the procedimento_12 column
 * @method     ChildTabelaDeprecated|null findOneByProcedimento13(string $procedimento_13) Return the first ChildTabelaDeprecated filtered by the procedimento_13 column
 * @method     ChildTabelaDeprecated|null findOneByProcedimento14(string $procedimento_14) Return the first ChildTabelaDeprecated filtered by the procedimento_14 column
 * @method     ChildTabelaDeprecated|null findOneByProcedimento15(string $procedimento_15) Return the first ChildTabelaDeprecated filtered by the procedimento_15 column
 * @method     ChildTabelaDeprecated|null findOneByProcedimento16(string $procedimento_16) Return the first ChildTabelaDeprecated filtered by the procedimento_16 column
 * @method     ChildTabelaDeprecated|null findOneByProcedimento17(string $procedimento_17) Return the first ChildTabelaDeprecated filtered by the procedimento_17 column
 * @method     ChildTabelaDeprecated|null findOneByProcedimento18(string $procedimento_18) Return the first ChildTabelaDeprecated filtered by the procedimento_18 column
 * @method     ChildTabelaDeprecated|null findOneByProcedimento19(string $procedimento_19) Return the first ChildTabelaDeprecated filtered by the procedimento_19 column
 * @method     ChildTabelaDeprecated|null findOneByProcedimento20(string $procedimento_20) Return the first ChildTabelaDeprecated filtered by the procedimento_20 column
 * @method     ChildTabelaDeprecated|null findOneByTotalProcedimentos(int $total_procedimentos) Return the first ChildTabelaDeprecated filtered by the total_procedimentos column *

 * @method     ChildTabelaDeprecated requirePk($key, ?ConnectionInterface $con = null) Return the ChildTabelaDeprecated by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOne(?ConnectionInterface $con = null) Return the first ChildTabelaDeprecated matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTabelaDeprecated requireOneById(int $id) Return the first ChildTabelaDeprecated filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByData(string $data) Return the first ChildTabelaDeprecated filtered by the data column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByTurno(string $turno) Return the first ChildTabelaDeprecated filtered by the turno column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByFisioterapeuta(string $fisioterapeuta) Return the first ChildTabelaDeprecated filtered by the fisioterapeuta column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByNomePaciente(string $nome_paciente) Return the first ChildTabelaDeprecated filtered by the nome_paciente column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByTipoAtendimento(string $tipo_atendimento) Return the first ChildTabelaDeprecated filtered by the tipo_atendimento column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneBySituacaoAdministrativa(string $situacao_administrativa) Return the first ChildTabelaDeprecated filtered by the situacao_administrativa column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByNipPaciente(string $nip_paciente) Return the first ChildTabelaDeprecated filtered by the nip_paciente column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByNipTitular(string $nip_titular) Return the first ChildTabelaDeprecated filtered by the nip_titular column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByCpfTitular(string $cpf_titular) Return the first ChildTabelaDeprecated filtered by the cpf_titular column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByOrigem(string $origem) Return the first ChildTabelaDeprecated filtered by the origem column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByCorpoQuadro(string $corpo_quadro) Return the first ChildTabelaDeprecated filtered by the corpo_quadro column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByPostoGraduacao(string $posto_graduacao) Return the first ChildTabelaDeprecated filtered by the posto_graduacao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByAtleta(string $atleta) Return the first ChildTabelaDeprecated filtered by the atleta column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByModalidade(string $modalidade) Return the first ChildTabelaDeprecated filtered by the modalidade column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByOutraModalidade(string $outra_modalidade) Return the first ChildTabelaDeprecated filtered by the outra_modalidade column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByComparecimento(boolean $comparecimento) Return the first ChildTabelaDeprecated filtered by the comparecimento column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByTipoFalta(string $tipo_falta) Return the first ChildTabelaDeprecated filtered by the tipo_falta column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByProcedimento1(string $procedimento_1) Return the first ChildTabelaDeprecated filtered by the procedimento_1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByProcedimento2(string $procedimento_2) Return the first ChildTabelaDeprecated filtered by the procedimento_2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByProcedimento3(string $procedimento_3) Return the first ChildTabelaDeprecated filtered by the procedimento_3 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByProcedimento4(string $procedimento_4) Return the first ChildTabelaDeprecated filtered by the procedimento_4 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByProcedimento5(string $procedimento_5) Return the first ChildTabelaDeprecated filtered by the procedimento_5 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByProcedimento6(string $procedimento_6) Return the first ChildTabelaDeprecated filtered by the procedimento_6 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByProcedimento7(string $procedimento_7) Return the first ChildTabelaDeprecated filtered by the procedimento_7 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByProcedimento8(string $procedimento_8) Return the first ChildTabelaDeprecated filtered by the procedimento_8 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByProcedimento9(string $procedimento_9) Return the first ChildTabelaDeprecated filtered by the procedimento_9 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByProcedimento10(string $procedimento_10) Return the first ChildTabelaDeprecated filtered by the procedimento_10 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByProcedimento11(string $procedimento_11) Return the first ChildTabelaDeprecated filtered by the procedimento_11 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByProcedimento12(string $procedimento_12) Return the first ChildTabelaDeprecated filtered by the procedimento_12 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByProcedimento13(string $procedimento_13) Return the first ChildTabelaDeprecated filtered by the procedimento_13 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByProcedimento14(string $procedimento_14) Return the first ChildTabelaDeprecated filtered by the procedimento_14 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByProcedimento15(string $procedimento_15) Return the first ChildTabelaDeprecated filtered by the procedimento_15 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByProcedimento16(string $procedimento_16) Return the first ChildTabelaDeprecated filtered by the procedimento_16 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByProcedimento17(string $procedimento_17) Return the first ChildTabelaDeprecated filtered by the procedimento_17 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByProcedimento18(string $procedimento_18) Return the first ChildTabelaDeprecated filtered by the procedimento_18 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByProcedimento19(string $procedimento_19) Return the first ChildTabelaDeprecated filtered by the procedimento_19 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByProcedimento20(string $procedimento_20) Return the first ChildTabelaDeprecated filtered by the procedimento_20 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabelaDeprecated requireOneByTotalProcedimentos(int $total_procedimentos) Return the first ChildTabelaDeprecated filtered by the total_procedimentos column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTabelaDeprecated[]|Collection find(?ConnectionInterface $con = null) Return ChildTabelaDeprecated objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> find(?ConnectionInterface $con = null) Return ChildTabelaDeprecated objects based on current ModelCriteria
 * @method     ChildTabelaDeprecated[]|Collection findById(int $id) Return ChildTabelaDeprecated objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findById(int $id) Return ChildTabelaDeprecated objects filtered by the id column
 * @method     ChildTabelaDeprecated[]|Collection findByData(string $data) Return ChildTabelaDeprecated objects filtered by the data column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByData(string $data) Return ChildTabelaDeprecated objects filtered by the data column
 * @method     ChildTabelaDeprecated[]|Collection findByTurno(string $turno) Return ChildTabelaDeprecated objects filtered by the turno column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByTurno(string $turno) Return ChildTabelaDeprecated objects filtered by the turno column
 * @method     ChildTabelaDeprecated[]|Collection findByFisioterapeuta(string $fisioterapeuta) Return ChildTabelaDeprecated objects filtered by the fisioterapeuta column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByFisioterapeuta(string $fisioterapeuta) Return ChildTabelaDeprecated objects filtered by the fisioterapeuta column
 * @method     ChildTabelaDeprecated[]|Collection findByNomePaciente(string $nome_paciente) Return ChildTabelaDeprecated objects filtered by the nome_paciente column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByNomePaciente(string $nome_paciente) Return ChildTabelaDeprecated objects filtered by the nome_paciente column
 * @method     ChildTabelaDeprecated[]|Collection findByTipoAtendimento(string $tipo_atendimento) Return ChildTabelaDeprecated objects filtered by the tipo_atendimento column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByTipoAtendimento(string $tipo_atendimento) Return ChildTabelaDeprecated objects filtered by the tipo_atendimento column
 * @method     ChildTabelaDeprecated[]|Collection findBySituacaoAdministrativa(string $situacao_administrativa) Return ChildTabelaDeprecated objects filtered by the situacao_administrativa column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findBySituacaoAdministrativa(string $situacao_administrativa) Return ChildTabelaDeprecated objects filtered by the situacao_administrativa column
 * @method     ChildTabelaDeprecated[]|Collection findByNipPaciente(string $nip_paciente) Return ChildTabelaDeprecated objects filtered by the nip_paciente column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByNipPaciente(string $nip_paciente) Return ChildTabelaDeprecated objects filtered by the nip_paciente column
 * @method     ChildTabelaDeprecated[]|Collection findByNipTitular(string $nip_titular) Return ChildTabelaDeprecated objects filtered by the nip_titular column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByNipTitular(string $nip_titular) Return ChildTabelaDeprecated objects filtered by the nip_titular column
 * @method     ChildTabelaDeprecated[]|Collection findByCpfTitular(string $cpf_titular) Return ChildTabelaDeprecated objects filtered by the cpf_titular column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByCpfTitular(string $cpf_titular) Return ChildTabelaDeprecated objects filtered by the cpf_titular column
 * @method     ChildTabelaDeprecated[]|Collection findByOrigem(string $origem) Return ChildTabelaDeprecated objects filtered by the origem column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByOrigem(string $origem) Return ChildTabelaDeprecated objects filtered by the origem column
 * @method     ChildTabelaDeprecated[]|Collection findByCorpoQuadro(string $corpo_quadro) Return ChildTabelaDeprecated objects filtered by the corpo_quadro column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByCorpoQuadro(string $corpo_quadro) Return ChildTabelaDeprecated objects filtered by the corpo_quadro column
 * @method     ChildTabelaDeprecated[]|Collection findByPostoGraduacao(string $posto_graduacao) Return ChildTabelaDeprecated objects filtered by the posto_graduacao column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByPostoGraduacao(string $posto_graduacao) Return ChildTabelaDeprecated objects filtered by the posto_graduacao column
 * @method     ChildTabelaDeprecated[]|Collection findByAtleta(string $atleta) Return ChildTabelaDeprecated objects filtered by the atleta column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByAtleta(string $atleta) Return ChildTabelaDeprecated objects filtered by the atleta column
 * @method     ChildTabelaDeprecated[]|Collection findByModalidade(string $modalidade) Return ChildTabelaDeprecated objects filtered by the modalidade column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByModalidade(string $modalidade) Return ChildTabelaDeprecated objects filtered by the modalidade column
 * @method     ChildTabelaDeprecated[]|Collection findByOutraModalidade(string $outra_modalidade) Return ChildTabelaDeprecated objects filtered by the outra_modalidade column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByOutraModalidade(string $outra_modalidade) Return ChildTabelaDeprecated objects filtered by the outra_modalidade column
 * @method     ChildTabelaDeprecated[]|Collection findByComparecimento(boolean $comparecimento) Return ChildTabelaDeprecated objects filtered by the comparecimento column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByComparecimento(boolean $comparecimento) Return ChildTabelaDeprecated objects filtered by the comparecimento column
 * @method     ChildTabelaDeprecated[]|Collection findByTipoFalta(string $tipo_falta) Return ChildTabelaDeprecated objects filtered by the tipo_falta column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByTipoFalta(string $tipo_falta) Return ChildTabelaDeprecated objects filtered by the tipo_falta column
 * @method     ChildTabelaDeprecated[]|Collection findByProcedimento1(string $procedimento_1) Return ChildTabelaDeprecated objects filtered by the procedimento_1 column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByProcedimento1(string $procedimento_1) Return ChildTabelaDeprecated objects filtered by the procedimento_1 column
 * @method     ChildTabelaDeprecated[]|Collection findByProcedimento2(string $procedimento_2) Return ChildTabelaDeprecated objects filtered by the procedimento_2 column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByProcedimento2(string $procedimento_2) Return ChildTabelaDeprecated objects filtered by the procedimento_2 column
 * @method     ChildTabelaDeprecated[]|Collection findByProcedimento3(string $procedimento_3) Return ChildTabelaDeprecated objects filtered by the procedimento_3 column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByProcedimento3(string $procedimento_3) Return ChildTabelaDeprecated objects filtered by the procedimento_3 column
 * @method     ChildTabelaDeprecated[]|Collection findByProcedimento4(string $procedimento_4) Return ChildTabelaDeprecated objects filtered by the procedimento_4 column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByProcedimento4(string $procedimento_4) Return ChildTabelaDeprecated objects filtered by the procedimento_4 column
 * @method     ChildTabelaDeprecated[]|Collection findByProcedimento5(string $procedimento_5) Return ChildTabelaDeprecated objects filtered by the procedimento_5 column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByProcedimento5(string $procedimento_5) Return ChildTabelaDeprecated objects filtered by the procedimento_5 column
 * @method     ChildTabelaDeprecated[]|Collection findByProcedimento6(string $procedimento_6) Return ChildTabelaDeprecated objects filtered by the procedimento_6 column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByProcedimento6(string $procedimento_6) Return ChildTabelaDeprecated objects filtered by the procedimento_6 column
 * @method     ChildTabelaDeprecated[]|Collection findByProcedimento7(string $procedimento_7) Return ChildTabelaDeprecated objects filtered by the procedimento_7 column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByProcedimento7(string $procedimento_7) Return ChildTabelaDeprecated objects filtered by the procedimento_7 column
 * @method     ChildTabelaDeprecated[]|Collection findByProcedimento8(string $procedimento_8) Return ChildTabelaDeprecated objects filtered by the procedimento_8 column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByProcedimento8(string $procedimento_8) Return ChildTabelaDeprecated objects filtered by the procedimento_8 column
 * @method     ChildTabelaDeprecated[]|Collection findByProcedimento9(string $procedimento_9) Return ChildTabelaDeprecated objects filtered by the procedimento_9 column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByProcedimento9(string $procedimento_9) Return ChildTabelaDeprecated objects filtered by the procedimento_9 column
 * @method     ChildTabelaDeprecated[]|Collection findByProcedimento10(string $procedimento_10) Return ChildTabelaDeprecated objects filtered by the procedimento_10 column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByProcedimento10(string $procedimento_10) Return ChildTabelaDeprecated objects filtered by the procedimento_10 column
 * @method     ChildTabelaDeprecated[]|Collection findByProcedimento11(string $procedimento_11) Return ChildTabelaDeprecated objects filtered by the procedimento_11 column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByProcedimento11(string $procedimento_11) Return ChildTabelaDeprecated objects filtered by the procedimento_11 column
 * @method     ChildTabelaDeprecated[]|Collection findByProcedimento12(string $procedimento_12) Return ChildTabelaDeprecated objects filtered by the procedimento_12 column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByProcedimento12(string $procedimento_12) Return ChildTabelaDeprecated objects filtered by the procedimento_12 column
 * @method     ChildTabelaDeprecated[]|Collection findByProcedimento13(string $procedimento_13) Return ChildTabelaDeprecated objects filtered by the procedimento_13 column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByProcedimento13(string $procedimento_13) Return ChildTabelaDeprecated objects filtered by the procedimento_13 column
 * @method     ChildTabelaDeprecated[]|Collection findByProcedimento14(string $procedimento_14) Return ChildTabelaDeprecated objects filtered by the procedimento_14 column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByProcedimento14(string $procedimento_14) Return ChildTabelaDeprecated objects filtered by the procedimento_14 column
 * @method     ChildTabelaDeprecated[]|Collection findByProcedimento15(string $procedimento_15) Return ChildTabelaDeprecated objects filtered by the procedimento_15 column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByProcedimento15(string $procedimento_15) Return ChildTabelaDeprecated objects filtered by the procedimento_15 column
 * @method     ChildTabelaDeprecated[]|Collection findByProcedimento16(string $procedimento_16) Return ChildTabelaDeprecated objects filtered by the procedimento_16 column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByProcedimento16(string $procedimento_16) Return ChildTabelaDeprecated objects filtered by the procedimento_16 column
 * @method     ChildTabelaDeprecated[]|Collection findByProcedimento17(string $procedimento_17) Return ChildTabelaDeprecated objects filtered by the procedimento_17 column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByProcedimento17(string $procedimento_17) Return ChildTabelaDeprecated objects filtered by the procedimento_17 column
 * @method     ChildTabelaDeprecated[]|Collection findByProcedimento18(string $procedimento_18) Return ChildTabelaDeprecated objects filtered by the procedimento_18 column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByProcedimento18(string $procedimento_18) Return ChildTabelaDeprecated objects filtered by the procedimento_18 column
 * @method     ChildTabelaDeprecated[]|Collection findByProcedimento19(string $procedimento_19) Return ChildTabelaDeprecated objects filtered by the procedimento_19 column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByProcedimento19(string $procedimento_19) Return ChildTabelaDeprecated objects filtered by the procedimento_19 column
 * @method     ChildTabelaDeprecated[]|Collection findByProcedimento20(string $procedimento_20) Return ChildTabelaDeprecated objects filtered by the procedimento_20 column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByProcedimento20(string $procedimento_20) Return ChildTabelaDeprecated objects filtered by the procedimento_20 column
 * @method     ChildTabelaDeprecated[]|Collection findByTotalProcedimentos(int $total_procedimentos) Return ChildTabelaDeprecated objects filtered by the total_procedimentos column
 * @psalm-method Collection&\Traversable<ChildTabelaDeprecated> findByTotalProcedimentos(int $total_procedimentos) Return ChildTabelaDeprecated objects filtered by the total_procedimentos column
 * @method     ChildTabelaDeprecated[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildTabelaDeprecated> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TabelaDeprecatedQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Api\Models\Base\TabelaDeprecatedQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Api\\Models\\TabelaDeprecated', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTabelaDeprecatedQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTabelaDeprecatedQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildTabelaDeprecatedQuery) {
            return $criteria;
        }
        $query = new ChildTabelaDeprecatedQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildTabelaDeprecated|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TabelaDeprecatedTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TabelaDeprecatedTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildTabelaDeprecated A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, data, turno, fisioterapeuta, nome_paciente, tipo_atendimento, situacao_administrativa, nip_paciente, nip_titular, cpf_titular, origem, corpo_quadro, posto_graduacao, atleta, modalidade, outra_modalidade, comparecimento, tipo_falta, procedimento_1, procedimento_2, procedimento_3, procedimento_4, procedimento_5, procedimento_6, procedimento_7, procedimento_8, procedimento_9, procedimento_10, procedimento_11, procedimento_12, procedimento_13, procedimento_14, procedimento_15, procedimento_16, procedimento_17, procedimento_18, procedimento_19, procedimento_20, total_procedimentos FROM tabela WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildTabelaDeprecated $obj */
            $obj = new ChildTabelaDeprecated();
            $obj->hydrate($row);
            TabelaDeprecatedTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @return ChildTabelaDeprecated|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_ID, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterById($id = null, ?string $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(TabelaDeprecatedTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(TabelaDeprecatedTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the data column
     *
     * Example usage:
     * <code>
     * $query->filterByData('2011-03-14'); // WHERE data = '2011-03-14'
     * $query->filterByData('now'); // WHERE data = '2011-03-14'
     * $query->filterByData(array('max' => 'yesterday')); // WHERE data > '2011-03-13'
     * </code>
     *
     * @param mixed $data The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByData($data = null, ?string $comparison = null)
    {
        if (is_array($data)) {
            $useMinMax = false;
            if (isset($data['min'])) {
                $this->addUsingAlias(TabelaDeprecatedTableMap::COL_DATA, $data['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($data['max'])) {
                $this->addUsingAlias(TabelaDeprecatedTableMap::COL_DATA, $data['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_DATA, $data, $comparison);

        return $this;
    }

    /**
     * Filter the query on the turno column
     *
     * Example usage:
     * <code>
     * $query->filterByTurno('fooValue');   // WHERE turno = 'fooValue'
     * $query->filterByTurno('%fooValue%', Criteria::LIKE); // WHERE turno LIKE '%fooValue%'
     * $query->filterByTurno(['foo', 'bar']); // WHERE turno IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $turno The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTurno($turno = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($turno)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_TURNO, $turno, $comparison);

        return $this;
    }

    /**
     * Filter the query on the fisioterapeuta column
     *
     * Example usage:
     * <code>
     * $query->filterByFisioterapeuta('fooValue');   // WHERE fisioterapeuta = 'fooValue'
     * $query->filterByFisioterapeuta('%fooValue%', Criteria::LIKE); // WHERE fisioterapeuta LIKE '%fooValue%'
     * $query->filterByFisioterapeuta(['foo', 'bar']); // WHERE fisioterapeuta IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $fisioterapeuta The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFisioterapeuta($fisioterapeuta = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fisioterapeuta)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_FISIOTERAPEUTA, $fisioterapeuta, $comparison);

        return $this;
    }

    /**
     * Filter the query on the nome_paciente column
     *
     * Example usage:
     * <code>
     * $query->filterByNomePaciente('fooValue');   // WHERE nome_paciente = 'fooValue'
     * $query->filterByNomePaciente('%fooValue%', Criteria::LIKE); // WHERE nome_paciente LIKE '%fooValue%'
     * $query->filterByNomePaciente(['foo', 'bar']); // WHERE nome_paciente IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $nomePaciente The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNomePaciente($nomePaciente = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nomePaciente)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_NOME_PACIENTE, $nomePaciente, $comparison);

        return $this;
    }

    /**
     * Filter the query on the tipo_atendimento column
     *
     * Example usage:
     * <code>
     * $query->filterByTipoAtendimento('fooValue');   // WHERE tipo_atendimento = 'fooValue'
     * $query->filterByTipoAtendimento('%fooValue%', Criteria::LIKE); // WHERE tipo_atendimento LIKE '%fooValue%'
     * $query->filterByTipoAtendimento(['foo', 'bar']); // WHERE tipo_atendimento IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $tipoAtendimento The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTipoAtendimento($tipoAtendimento = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tipoAtendimento)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_TIPO_ATENDIMENTO, $tipoAtendimento, $comparison);

        return $this;
    }

    /**
     * Filter the query on the situacao_administrativa column
     *
     * Example usage:
     * <code>
     * $query->filterBySituacaoAdministrativa('fooValue');   // WHERE situacao_administrativa = 'fooValue'
     * $query->filterBySituacaoAdministrativa('%fooValue%', Criteria::LIKE); // WHERE situacao_administrativa LIKE '%fooValue%'
     * $query->filterBySituacaoAdministrativa(['foo', 'bar']); // WHERE situacao_administrativa IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $situacaoAdministrativa The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySituacaoAdministrativa($situacaoAdministrativa = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($situacaoAdministrativa)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_SITUACAO_ADMINISTRATIVA, $situacaoAdministrativa, $comparison);

        return $this;
    }

    /**
     * Filter the query on the nip_paciente column
     *
     * Example usage:
     * <code>
     * $query->filterByNipPaciente('fooValue');   // WHERE nip_paciente = 'fooValue'
     * $query->filterByNipPaciente('%fooValue%', Criteria::LIKE); // WHERE nip_paciente LIKE '%fooValue%'
     * $query->filterByNipPaciente(['foo', 'bar']); // WHERE nip_paciente IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $nipPaciente The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNipPaciente($nipPaciente = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nipPaciente)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_NIP_PACIENTE, $nipPaciente, $comparison);

        return $this;
    }

    /**
     * Filter the query on the nip_titular column
     *
     * Example usage:
     * <code>
     * $query->filterByNipTitular('fooValue');   // WHERE nip_titular = 'fooValue'
     * $query->filterByNipTitular('%fooValue%', Criteria::LIKE); // WHERE nip_titular LIKE '%fooValue%'
     * $query->filterByNipTitular(['foo', 'bar']); // WHERE nip_titular IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $nipTitular The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNipTitular($nipTitular = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nipTitular)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_NIP_TITULAR, $nipTitular, $comparison);

        return $this;
    }

    /**
     * Filter the query on the cpf_titular column
     *
     * Example usage:
     * <code>
     * $query->filterByCpfTitular('fooValue');   // WHERE cpf_titular = 'fooValue'
     * $query->filterByCpfTitular('%fooValue%', Criteria::LIKE); // WHERE cpf_titular LIKE '%fooValue%'
     * $query->filterByCpfTitular(['foo', 'bar']); // WHERE cpf_titular IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $cpfTitular The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCpfTitular($cpfTitular = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cpfTitular)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_CPF_TITULAR, $cpfTitular, $comparison);

        return $this;
    }

    /**
     * Filter the query on the origem column
     *
     * Example usage:
     * <code>
     * $query->filterByOrigem('fooValue');   // WHERE origem = 'fooValue'
     * $query->filterByOrigem('%fooValue%', Criteria::LIKE); // WHERE origem LIKE '%fooValue%'
     * $query->filterByOrigem(['foo', 'bar']); // WHERE origem IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $origem The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrigem($origem = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($origem)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_ORIGEM, $origem, $comparison);

        return $this;
    }

    /**
     * Filter the query on the corpo_quadro column
     *
     * Example usage:
     * <code>
     * $query->filterByCorpoQuadro('fooValue');   // WHERE corpo_quadro = 'fooValue'
     * $query->filterByCorpoQuadro('%fooValue%', Criteria::LIKE); // WHERE corpo_quadro LIKE '%fooValue%'
     * $query->filterByCorpoQuadro(['foo', 'bar']); // WHERE corpo_quadro IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $corpoQuadro The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCorpoQuadro($corpoQuadro = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($corpoQuadro)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_CORPO_QUADRO, $corpoQuadro, $comparison);

        return $this;
    }

    /**
     * Filter the query on the posto_graduacao column
     *
     * Example usage:
     * <code>
     * $query->filterByPostoGraduacao('fooValue');   // WHERE posto_graduacao = 'fooValue'
     * $query->filterByPostoGraduacao('%fooValue%', Criteria::LIKE); // WHERE posto_graduacao LIKE '%fooValue%'
     * $query->filterByPostoGraduacao(['foo', 'bar']); // WHERE posto_graduacao IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $postoGraduacao The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPostoGraduacao($postoGraduacao = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($postoGraduacao)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_POSTO_GRADUACAO, $postoGraduacao, $comparison);

        return $this;
    }

    /**
     * Filter the query on the atleta column
     *
     * Example usage:
     * <code>
     * $query->filterByAtleta('fooValue');   // WHERE atleta = 'fooValue'
     * $query->filterByAtleta('%fooValue%', Criteria::LIKE); // WHERE atleta LIKE '%fooValue%'
     * $query->filterByAtleta(['foo', 'bar']); // WHERE atleta IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $atleta The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAtleta($atleta = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($atleta)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_ATLETA, $atleta, $comparison);

        return $this;
    }

    /**
     * Filter the query on the modalidade column
     *
     * Example usage:
     * <code>
     * $query->filterByModalidade('fooValue');   // WHERE modalidade = 'fooValue'
     * $query->filterByModalidade('%fooValue%', Criteria::LIKE); // WHERE modalidade LIKE '%fooValue%'
     * $query->filterByModalidade(['foo', 'bar']); // WHERE modalidade IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $modalidade The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByModalidade($modalidade = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($modalidade)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_MODALIDADE, $modalidade, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outra_modalidade column
     *
     * Example usage:
     * <code>
     * $query->filterByOutraModalidade('fooValue');   // WHERE outra_modalidade = 'fooValue'
     * $query->filterByOutraModalidade('%fooValue%', Criteria::LIKE); // WHERE outra_modalidade LIKE '%fooValue%'
     * $query->filterByOutraModalidade(['foo', 'bar']); // WHERE outra_modalidade IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outraModalidade The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutraModalidade($outraModalidade = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outraModalidade)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_OUTRA_MODALIDADE, $outraModalidade, $comparison);

        return $this;
    }

    /**
     * Filter the query on the comparecimento column
     *
     * Example usage:
     * <code>
     * $query->filterByComparecimento(true); // WHERE comparecimento = true
     * $query->filterByComparecimento('yes'); // WHERE comparecimento = true
     * </code>
     *
     * @param bool|string $comparecimento The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByComparecimento($comparecimento = null, ?string $comparison = null)
    {
        if (is_string($comparecimento)) {
            $comparecimento = in_array(strtolower($comparecimento), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_COMPARECIMENTO, $comparecimento, $comparison);

        return $this;
    }

    /**
     * Filter the query on the tipo_falta column
     *
     * Example usage:
     * <code>
     * $query->filterByTipoFalta('fooValue');   // WHERE tipo_falta = 'fooValue'
     * $query->filterByTipoFalta('%fooValue%', Criteria::LIKE); // WHERE tipo_falta LIKE '%fooValue%'
     * $query->filterByTipoFalta(['foo', 'bar']); // WHERE tipo_falta IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $tipoFalta The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTipoFalta($tipoFalta = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tipoFalta)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_TIPO_FALTA, $tipoFalta, $comparison);

        return $this;
    }

    /**
     * Filter the query on the procedimento_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByProcedimento1('fooValue');   // WHERE procedimento_1 = 'fooValue'
     * $query->filterByProcedimento1('%fooValue%', Criteria::LIKE); // WHERE procedimento_1 LIKE '%fooValue%'
     * $query->filterByProcedimento1(['foo', 'bar']); // WHERE procedimento_1 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $procedimento1 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProcedimento1($procedimento1 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($procedimento1)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_PROCEDIMENTO_1, $procedimento1, $comparison);

        return $this;
    }

    /**
     * Filter the query on the procedimento_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByProcedimento2('fooValue');   // WHERE procedimento_2 = 'fooValue'
     * $query->filterByProcedimento2('%fooValue%', Criteria::LIKE); // WHERE procedimento_2 LIKE '%fooValue%'
     * $query->filterByProcedimento2(['foo', 'bar']); // WHERE procedimento_2 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $procedimento2 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProcedimento2($procedimento2 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($procedimento2)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_PROCEDIMENTO_2, $procedimento2, $comparison);

        return $this;
    }

    /**
     * Filter the query on the procedimento_3 column
     *
     * Example usage:
     * <code>
     * $query->filterByProcedimento3('fooValue');   // WHERE procedimento_3 = 'fooValue'
     * $query->filterByProcedimento3('%fooValue%', Criteria::LIKE); // WHERE procedimento_3 LIKE '%fooValue%'
     * $query->filterByProcedimento3(['foo', 'bar']); // WHERE procedimento_3 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $procedimento3 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProcedimento3($procedimento3 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($procedimento3)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_PROCEDIMENTO_3, $procedimento3, $comparison);

        return $this;
    }

    /**
     * Filter the query on the procedimento_4 column
     *
     * Example usage:
     * <code>
     * $query->filterByProcedimento4('fooValue');   // WHERE procedimento_4 = 'fooValue'
     * $query->filterByProcedimento4('%fooValue%', Criteria::LIKE); // WHERE procedimento_4 LIKE '%fooValue%'
     * $query->filterByProcedimento4(['foo', 'bar']); // WHERE procedimento_4 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $procedimento4 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProcedimento4($procedimento4 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($procedimento4)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_PROCEDIMENTO_4, $procedimento4, $comparison);

        return $this;
    }

    /**
     * Filter the query on the procedimento_5 column
     *
     * Example usage:
     * <code>
     * $query->filterByProcedimento5('fooValue');   // WHERE procedimento_5 = 'fooValue'
     * $query->filterByProcedimento5('%fooValue%', Criteria::LIKE); // WHERE procedimento_5 LIKE '%fooValue%'
     * $query->filterByProcedimento5(['foo', 'bar']); // WHERE procedimento_5 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $procedimento5 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProcedimento5($procedimento5 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($procedimento5)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_PROCEDIMENTO_5, $procedimento5, $comparison);

        return $this;
    }

    /**
     * Filter the query on the procedimento_6 column
     *
     * Example usage:
     * <code>
     * $query->filterByProcedimento6('fooValue');   // WHERE procedimento_6 = 'fooValue'
     * $query->filterByProcedimento6('%fooValue%', Criteria::LIKE); // WHERE procedimento_6 LIKE '%fooValue%'
     * $query->filterByProcedimento6(['foo', 'bar']); // WHERE procedimento_6 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $procedimento6 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProcedimento6($procedimento6 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($procedimento6)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_PROCEDIMENTO_6, $procedimento6, $comparison);

        return $this;
    }

    /**
     * Filter the query on the procedimento_7 column
     *
     * Example usage:
     * <code>
     * $query->filterByProcedimento7('fooValue');   // WHERE procedimento_7 = 'fooValue'
     * $query->filterByProcedimento7('%fooValue%', Criteria::LIKE); // WHERE procedimento_7 LIKE '%fooValue%'
     * $query->filterByProcedimento7(['foo', 'bar']); // WHERE procedimento_7 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $procedimento7 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProcedimento7($procedimento7 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($procedimento7)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_PROCEDIMENTO_7, $procedimento7, $comparison);

        return $this;
    }

    /**
     * Filter the query on the procedimento_8 column
     *
     * Example usage:
     * <code>
     * $query->filterByProcedimento8('fooValue');   // WHERE procedimento_8 = 'fooValue'
     * $query->filterByProcedimento8('%fooValue%', Criteria::LIKE); // WHERE procedimento_8 LIKE '%fooValue%'
     * $query->filterByProcedimento8(['foo', 'bar']); // WHERE procedimento_8 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $procedimento8 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProcedimento8($procedimento8 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($procedimento8)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_PROCEDIMENTO_8, $procedimento8, $comparison);

        return $this;
    }

    /**
     * Filter the query on the procedimento_9 column
     *
     * Example usage:
     * <code>
     * $query->filterByProcedimento9('fooValue');   // WHERE procedimento_9 = 'fooValue'
     * $query->filterByProcedimento9('%fooValue%', Criteria::LIKE); // WHERE procedimento_9 LIKE '%fooValue%'
     * $query->filterByProcedimento9(['foo', 'bar']); // WHERE procedimento_9 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $procedimento9 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProcedimento9($procedimento9 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($procedimento9)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_PROCEDIMENTO_9, $procedimento9, $comparison);

        return $this;
    }

    /**
     * Filter the query on the procedimento_10 column
     *
     * Example usage:
     * <code>
     * $query->filterByProcedimento10('fooValue');   // WHERE procedimento_10 = 'fooValue'
     * $query->filterByProcedimento10('%fooValue%', Criteria::LIKE); // WHERE procedimento_10 LIKE '%fooValue%'
     * $query->filterByProcedimento10(['foo', 'bar']); // WHERE procedimento_10 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $procedimento10 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProcedimento10($procedimento10 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($procedimento10)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_PROCEDIMENTO_10, $procedimento10, $comparison);

        return $this;
    }

    /**
     * Filter the query on the procedimento_11 column
     *
     * Example usage:
     * <code>
     * $query->filterByProcedimento11('fooValue');   // WHERE procedimento_11 = 'fooValue'
     * $query->filterByProcedimento11('%fooValue%', Criteria::LIKE); // WHERE procedimento_11 LIKE '%fooValue%'
     * $query->filterByProcedimento11(['foo', 'bar']); // WHERE procedimento_11 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $procedimento11 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProcedimento11($procedimento11 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($procedimento11)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_PROCEDIMENTO_11, $procedimento11, $comparison);

        return $this;
    }

    /**
     * Filter the query on the procedimento_12 column
     *
     * Example usage:
     * <code>
     * $query->filterByProcedimento12('fooValue');   // WHERE procedimento_12 = 'fooValue'
     * $query->filterByProcedimento12('%fooValue%', Criteria::LIKE); // WHERE procedimento_12 LIKE '%fooValue%'
     * $query->filterByProcedimento12(['foo', 'bar']); // WHERE procedimento_12 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $procedimento12 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProcedimento12($procedimento12 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($procedimento12)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_PROCEDIMENTO_12, $procedimento12, $comparison);

        return $this;
    }

    /**
     * Filter the query on the procedimento_13 column
     *
     * Example usage:
     * <code>
     * $query->filterByProcedimento13('fooValue');   // WHERE procedimento_13 = 'fooValue'
     * $query->filterByProcedimento13('%fooValue%', Criteria::LIKE); // WHERE procedimento_13 LIKE '%fooValue%'
     * $query->filterByProcedimento13(['foo', 'bar']); // WHERE procedimento_13 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $procedimento13 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProcedimento13($procedimento13 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($procedimento13)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_PROCEDIMENTO_13, $procedimento13, $comparison);

        return $this;
    }

    /**
     * Filter the query on the procedimento_14 column
     *
     * Example usage:
     * <code>
     * $query->filterByProcedimento14('fooValue');   // WHERE procedimento_14 = 'fooValue'
     * $query->filterByProcedimento14('%fooValue%', Criteria::LIKE); // WHERE procedimento_14 LIKE '%fooValue%'
     * $query->filterByProcedimento14(['foo', 'bar']); // WHERE procedimento_14 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $procedimento14 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProcedimento14($procedimento14 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($procedimento14)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_PROCEDIMENTO_14, $procedimento14, $comparison);

        return $this;
    }

    /**
     * Filter the query on the procedimento_15 column
     *
     * Example usage:
     * <code>
     * $query->filterByProcedimento15('fooValue');   // WHERE procedimento_15 = 'fooValue'
     * $query->filterByProcedimento15('%fooValue%', Criteria::LIKE); // WHERE procedimento_15 LIKE '%fooValue%'
     * $query->filterByProcedimento15(['foo', 'bar']); // WHERE procedimento_15 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $procedimento15 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProcedimento15($procedimento15 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($procedimento15)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_PROCEDIMENTO_15, $procedimento15, $comparison);

        return $this;
    }

    /**
     * Filter the query on the procedimento_16 column
     *
     * Example usage:
     * <code>
     * $query->filterByProcedimento16('fooValue');   // WHERE procedimento_16 = 'fooValue'
     * $query->filterByProcedimento16('%fooValue%', Criteria::LIKE); // WHERE procedimento_16 LIKE '%fooValue%'
     * $query->filterByProcedimento16(['foo', 'bar']); // WHERE procedimento_16 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $procedimento16 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProcedimento16($procedimento16 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($procedimento16)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_PROCEDIMENTO_16, $procedimento16, $comparison);

        return $this;
    }

    /**
     * Filter the query on the procedimento_17 column
     *
     * Example usage:
     * <code>
     * $query->filterByProcedimento17('fooValue');   // WHERE procedimento_17 = 'fooValue'
     * $query->filterByProcedimento17('%fooValue%', Criteria::LIKE); // WHERE procedimento_17 LIKE '%fooValue%'
     * $query->filterByProcedimento17(['foo', 'bar']); // WHERE procedimento_17 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $procedimento17 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProcedimento17($procedimento17 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($procedimento17)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_PROCEDIMENTO_17, $procedimento17, $comparison);

        return $this;
    }

    /**
     * Filter the query on the procedimento_18 column
     *
     * Example usage:
     * <code>
     * $query->filterByProcedimento18('fooValue');   // WHERE procedimento_18 = 'fooValue'
     * $query->filterByProcedimento18('%fooValue%', Criteria::LIKE); // WHERE procedimento_18 LIKE '%fooValue%'
     * $query->filterByProcedimento18(['foo', 'bar']); // WHERE procedimento_18 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $procedimento18 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProcedimento18($procedimento18 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($procedimento18)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_PROCEDIMENTO_18, $procedimento18, $comparison);

        return $this;
    }

    /**
     * Filter the query on the procedimento_19 column
     *
     * Example usage:
     * <code>
     * $query->filterByProcedimento19('fooValue');   // WHERE procedimento_19 = 'fooValue'
     * $query->filterByProcedimento19('%fooValue%', Criteria::LIKE); // WHERE procedimento_19 LIKE '%fooValue%'
     * $query->filterByProcedimento19(['foo', 'bar']); // WHERE procedimento_19 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $procedimento19 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProcedimento19($procedimento19 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($procedimento19)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_PROCEDIMENTO_19, $procedimento19, $comparison);

        return $this;
    }

    /**
     * Filter the query on the procedimento_20 column
     *
     * Example usage:
     * <code>
     * $query->filterByProcedimento20('fooValue');   // WHERE procedimento_20 = 'fooValue'
     * $query->filterByProcedimento20('%fooValue%', Criteria::LIKE); // WHERE procedimento_20 LIKE '%fooValue%'
     * $query->filterByProcedimento20(['foo', 'bar']); // WHERE procedimento_20 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $procedimento20 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProcedimento20($procedimento20 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($procedimento20)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_PROCEDIMENTO_20, $procedimento20, $comparison);

        return $this;
    }

    /**
     * Filter the query on the total_procedimentos column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalProcedimentos(1234); // WHERE total_procedimentos = 1234
     * $query->filterByTotalProcedimentos(array(12, 34)); // WHERE total_procedimentos IN (12, 34)
     * $query->filterByTotalProcedimentos(array('min' => 12)); // WHERE total_procedimentos > 12
     * </code>
     *
     * @param mixed $totalProcedimentos The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTotalProcedimentos($totalProcedimentos = null, ?string $comparison = null)
    {
        if (is_array($totalProcedimentos)) {
            $useMinMax = false;
            if (isset($totalProcedimentos['min'])) {
                $this->addUsingAlias(TabelaDeprecatedTableMap::COL_TOTAL_PROCEDIMENTOS, $totalProcedimentos['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalProcedimentos['max'])) {
                $this->addUsingAlias(TabelaDeprecatedTableMap::COL_TOTAL_PROCEDIMENTOS, $totalProcedimentos['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaDeprecatedTableMap::COL_TOTAL_PROCEDIMENTOS, $totalProcedimentos, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildTabelaDeprecated $tabelaDeprecated Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($tabelaDeprecated = null)
    {
        if ($tabelaDeprecated) {
            $this->addUsingAlias(TabelaDeprecatedTableMap::COL_ID, $tabelaDeprecated->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tabela table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TabelaDeprecatedTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TabelaDeprecatedTableMap::clearInstancePool();
            TabelaDeprecatedTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TabelaDeprecatedTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TabelaDeprecatedTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TabelaDeprecatedTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TabelaDeprecatedTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
