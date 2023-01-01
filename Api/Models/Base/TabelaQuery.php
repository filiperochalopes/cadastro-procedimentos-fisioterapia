<?php

namespace Api\Models\Base;

use \Exception;
use \PDO;
use Api\Models\Tabela as ChildTabela;
use Api\Models\TabelaQuery as ChildTabelaQuery;
use Api\Models\Map\TabelaTableMap;
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
 * @method     ChildTabelaQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildTabelaQuery orderByData($order = Criteria::ASC) Order by the data column
 * @method     ChildTabelaQuery orderByTurno($order = Criteria::ASC) Order by the turno column
 * @method     ChildTabelaQuery orderByFisioterapeuta($order = Criteria::ASC) Order by the fisioterapeuta column
 * @method     ChildTabelaQuery orderByNomePaciente($order = Criteria::ASC) Order by the nome_paciente column
 * @method     ChildTabelaQuery orderByTipoAtendimento($order = Criteria::ASC) Order by the tipo_atendimento column
 * @method     ChildTabelaQuery orderBySituacaoAdministrativa($order = Criteria::ASC) Order by the situacao_administrativa column
 * @method     ChildTabelaQuery orderByNipPaciente($order = Criteria::ASC) Order by the nip_paciente column
 * @method     ChildTabelaQuery orderByNipTitular($order = Criteria::ASC) Order by the nip_titular column
 * @method     ChildTabelaQuery orderByCpfTitular($order = Criteria::ASC) Order by the cpf_titular column
 * @method     ChildTabelaQuery orderByOrigem($order = Criteria::ASC) Order by the origem column
 * @method     ChildTabelaQuery orderByCorpoQuadro($order = Criteria::ASC) Order by the corpo_quadro column
 * @method     ChildTabelaQuery orderByPostoGraduacao($order = Criteria::ASC) Order by the posto_graduacao column
 * @method     ChildTabelaQuery orderByAtleta($order = Criteria::ASC) Order by the atleta column
 * @method     ChildTabelaQuery orderByModalidade($order = Criteria::ASC) Order by the modalidade column
 * @method     ChildTabelaQuery orderByOutraModalidade($order = Criteria::ASC) Order by the outra_modalidade column
 * @method     ChildTabelaQuery orderByComparecimento($order = Criteria::ASC) Order by the comparecimento column
 * @method     ChildTabelaQuery orderByTipoFalta($order = Criteria::ASC) Order by the tipo_falta column
 * @method     ChildTabelaQuery orderByProcedimento1($order = Criteria::ASC) Order by the procedimento_1 column
 * @method     ChildTabelaQuery orderByProcedimento2($order = Criteria::ASC) Order by the procedimento_2 column
 * @method     ChildTabelaQuery orderByProcedimento3($order = Criteria::ASC) Order by the procedimento_3 column
 * @method     ChildTabelaQuery orderByProcedimento4($order = Criteria::ASC) Order by the procedimento_4 column
 * @method     ChildTabelaQuery orderByProcedimento5($order = Criteria::ASC) Order by the procedimento_5 column
 * @method     ChildTabelaQuery orderByProcedimento6($order = Criteria::ASC) Order by the procedimento_6 column
 * @method     ChildTabelaQuery orderByProcedimento7($order = Criteria::ASC) Order by the procedimento_7 column
 * @method     ChildTabelaQuery orderByProcedimento8($order = Criteria::ASC) Order by the procedimento_8 column
 * @method     ChildTabelaQuery orderByProcedimento9($order = Criteria::ASC) Order by the procedimento_9 column
 * @method     ChildTabelaQuery orderByProcedimento10($order = Criteria::ASC) Order by the procedimento_10 column
 * @method     ChildTabelaQuery orderByProcedimento11($order = Criteria::ASC) Order by the procedimento_11 column
 * @method     ChildTabelaQuery orderByProcedimento12($order = Criteria::ASC) Order by the procedimento_12 column
 * @method     ChildTabelaQuery orderByProcedimento13($order = Criteria::ASC) Order by the procedimento_13 column
 * @method     ChildTabelaQuery orderByProcedimento14($order = Criteria::ASC) Order by the procedimento_14 column
 * @method     ChildTabelaQuery orderByProcedimento15($order = Criteria::ASC) Order by the procedimento_15 column
 * @method     ChildTabelaQuery orderByProcedimento16($order = Criteria::ASC) Order by the procedimento_16 column
 * @method     ChildTabelaQuery orderByProcedimento17($order = Criteria::ASC) Order by the procedimento_17 column
 * @method     ChildTabelaQuery orderByProcedimento18($order = Criteria::ASC) Order by the procedimento_18 column
 * @method     ChildTabelaQuery orderByProcedimento19($order = Criteria::ASC) Order by the procedimento_19 column
 * @method     ChildTabelaQuery orderByProcedimento20($order = Criteria::ASC) Order by the procedimento_20 column
 * @method     ChildTabelaQuery orderByTotalProcedimentos($order = Criteria::ASC) Order by the total_procedimentos column
 *
 * @method     ChildTabelaQuery groupById() Group by the id column
 * @method     ChildTabelaQuery groupByData() Group by the data column
 * @method     ChildTabelaQuery groupByTurno() Group by the turno column
 * @method     ChildTabelaQuery groupByFisioterapeuta() Group by the fisioterapeuta column
 * @method     ChildTabelaQuery groupByNomePaciente() Group by the nome_paciente column
 * @method     ChildTabelaQuery groupByTipoAtendimento() Group by the tipo_atendimento column
 * @method     ChildTabelaQuery groupBySituacaoAdministrativa() Group by the situacao_administrativa column
 * @method     ChildTabelaQuery groupByNipPaciente() Group by the nip_paciente column
 * @method     ChildTabelaQuery groupByNipTitular() Group by the nip_titular column
 * @method     ChildTabelaQuery groupByCpfTitular() Group by the cpf_titular column
 * @method     ChildTabelaQuery groupByOrigem() Group by the origem column
 * @method     ChildTabelaQuery groupByCorpoQuadro() Group by the corpo_quadro column
 * @method     ChildTabelaQuery groupByPostoGraduacao() Group by the posto_graduacao column
 * @method     ChildTabelaQuery groupByAtleta() Group by the atleta column
 * @method     ChildTabelaQuery groupByModalidade() Group by the modalidade column
 * @method     ChildTabelaQuery groupByOutraModalidade() Group by the outra_modalidade column
 * @method     ChildTabelaQuery groupByComparecimento() Group by the comparecimento column
 * @method     ChildTabelaQuery groupByTipoFalta() Group by the tipo_falta column
 * @method     ChildTabelaQuery groupByProcedimento1() Group by the procedimento_1 column
 * @method     ChildTabelaQuery groupByProcedimento2() Group by the procedimento_2 column
 * @method     ChildTabelaQuery groupByProcedimento3() Group by the procedimento_3 column
 * @method     ChildTabelaQuery groupByProcedimento4() Group by the procedimento_4 column
 * @method     ChildTabelaQuery groupByProcedimento5() Group by the procedimento_5 column
 * @method     ChildTabelaQuery groupByProcedimento6() Group by the procedimento_6 column
 * @method     ChildTabelaQuery groupByProcedimento7() Group by the procedimento_7 column
 * @method     ChildTabelaQuery groupByProcedimento8() Group by the procedimento_8 column
 * @method     ChildTabelaQuery groupByProcedimento9() Group by the procedimento_9 column
 * @method     ChildTabelaQuery groupByProcedimento10() Group by the procedimento_10 column
 * @method     ChildTabelaQuery groupByProcedimento11() Group by the procedimento_11 column
 * @method     ChildTabelaQuery groupByProcedimento12() Group by the procedimento_12 column
 * @method     ChildTabelaQuery groupByProcedimento13() Group by the procedimento_13 column
 * @method     ChildTabelaQuery groupByProcedimento14() Group by the procedimento_14 column
 * @method     ChildTabelaQuery groupByProcedimento15() Group by the procedimento_15 column
 * @method     ChildTabelaQuery groupByProcedimento16() Group by the procedimento_16 column
 * @method     ChildTabelaQuery groupByProcedimento17() Group by the procedimento_17 column
 * @method     ChildTabelaQuery groupByProcedimento18() Group by the procedimento_18 column
 * @method     ChildTabelaQuery groupByProcedimento19() Group by the procedimento_19 column
 * @method     ChildTabelaQuery groupByProcedimento20() Group by the procedimento_20 column
 * @method     ChildTabelaQuery groupByTotalProcedimentos() Group by the total_procedimentos column
 *
 * @method     ChildTabelaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTabelaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTabelaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTabelaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTabelaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTabelaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTabela|null findOne(?ConnectionInterface $con = null) Return the first ChildTabela matching the query
 * @method     ChildTabela findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildTabela matching the query, or a new ChildTabela object populated from the query conditions when no match is found
 *
 * @method     ChildTabela|null findOneById(int $id) Return the first ChildTabela filtered by the id column
 * @method     ChildTabela|null findOneByData(string $data) Return the first ChildTabela filtered by the data column
 * @method     ChildTabela|null findOneByTurno(string $turno) Return the first ChildTabela filtered by the turno column
 * @method     ChildTabela|null findOneByFisioterapeuta(string $fisioterapeuta) Return the first ChildTabela filtered by the fisioterapeuta column
 * @method     ChildTabela|null findOneByNomePaciente(string $nome_paciente) Return the first ChildTabela filtered by the nome_paciente column
 * @method     ChildTabela|null findOneByTipoAtendimento(string $tipo_atendimento) Return the first ChildTabela filtered by the tipo_atendimento column
 * @method     ChildTabela|null findOneBySituacaoAdministrativa(string $situacao_administrativa) Return the first ChildTabela filtered by the situacao_administrativa column
 * @method     ChildTabela|null findOneByNipPaciente(string $nip_paciente) Return the first ChildTabela filtered by the nip_paciente column
 * @method     ChildTabela|null findOneByNipTitular(string $nip_titular) Return the first ChildTabela filtered by the nip_titular column
 * @method     ChildTabela|null findOneByCpfTitular(string $cpf_titular) Return the first ChildTabela filtered by the cpf_titular column
 * @method     ChildTabela|null findOneByOrigem(string $origem) Return the first ChildTabela filtered by the origem column
 * @method     ChildTabela|null findOneByCorpoQuadro(string $corpo_quadro) Return the first ChildTabela filtered by the corpo_quadro column
 * @method     ChildTabela|null findOneByPostoGraduacao(string $posto_graduacao) Return the first ChildTabela filtered by the posto_graduacao column
 * @method     ChildTabela|null findOneByAtleta(string $atleta) Return the first ChildTabela filtered by the atleta column
 * @method     ChildTabela|null findOneByModalidade(string $modalidade) Return the first ChildTabela filtered by the modalidade column
 * @method     ChildTabela|null findOneByOutraModalidade(string $outra_modalidade) Return the first ChildTabela filtered by the outra_modalidade column
 * @method     ChildTabela|null findOneByComparecimento(boolean $comparecimento) Return the first ChildTabela filtered by the comparecimento column
 * @method     ChildTabela|null findOneByTipoFalta(string $tipo_falta) Return the first ChildTabela filtered by the tipo_falta column
 * @method     ChildTabela|null findOneByProcedimento1(string $procedimento_1) Return the first ChildTabela filtered by the procedimento_1 column
 * @method     ChildTabela|null findOneByProcedimento2(string $procedimento_2) Return the first ChildTabela filtered by the procedimento_2 column
 * @method     ChildTabela|null findOneByProcedimento3(string $procedimento_3) Return the first ChildTabela filtered by the procedimento_3 column
 * @method     ChildTabela|null findOneByProcedimento4(string $procedimento_4) Return the first ChildTabela filtered by the procedimento_4 column
 * @method     ChildTabela|null findOneByProcedimento5(string $procedimento_5) Return the first ChildTabela filtered by the procedimento_5 column
 * @method     ChildTabela|null findOneByProcedimento6(string $procedimento_6) Return the first ChildTabela filtered by the procedimento_6 column
 * @method     ChildTabela|null findOneByProcedimento7(string $procedimento_7) Return the first ChildTabela filtered by the procedimento_7 column
 * @method     ChildTabela|null findOneByProcedimento8(string $procedimento_8) Return the first ChildTabela filtered by the procedimento_8 column
 * @method     ChildTabela|null findOneByProcedimento9(string $procedimento_9) Return the first ChildTabela filtered by the procedimento_9 column
 * @method     ChildTabela|null findOneByProcedimento10(string $procedimento_10) Return the first ChildTabela filtered by the procedimento_10 column
 * @method     ChildTabela|null findOneByProcedimento11(string $procedimento_11) Return the first ChildTabela filtered by the procedimento_11 column
 * @method     ChildTabela|null findOneByProcedimento12(string $procedimento_12) Return the first ChildTabela filtered by the procedimento_12 column
 * @method     ChildTabela|null findOneByProcedimento13(string $procedimento_13) Return the first ChildTabela filtered by the procedimento_13 column
 * @method     ChildTabela|null findOneByProcedimento14(string $procedimento_14) Return the first ChildTabela filtered by the procedimento_14 column
 * @method     ChildTabela|null findOneByProcedimento15(string $procedimento_15) Return the first ChildTabela filtered by the procedimento_15 column
 * @method     ChildTabela|null findOneByProcedimento16(string $procedimento_16) Return the first ChildTabela filtered by the procedimento_16 column
 * @method     ChildTabela|null findOneByProcedimento17(string $procedimento_17) Return the first ChildTabela filtered by the procedimento_17 column
 * @method     ChildTabela|null findOneByProcedimento18(string $procedimento_18) Return the first ChildTabela filtered by the procedimento_18 column
 * @method     ChildTabela|null findOneByProcedimento19(string $procedimento_19) Return the first ChildTabela filtered by the procedimento_19 column
 * @method     ChildTabela|null findOneByProcedimento20(string $procedimento_20) Return the first ChildTabela filtered by the procedimento_20 column
 * @method     ChildTabela|null findOneByTotalProcedimentos(int $total_procedimentos) Return the first ChildTabela filtered by the total_procedimentos column *

 * @method     ChildTabela requirePk($key, ?ConnectionInterface $con = null) Return the ChildTabela by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOne(?ConnectionInterface $con = null) Return the first ChildTabela matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTabela requireOneById(int $id) Return the first ChildTabela filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByData(string $data) Return the first ChildTabela filtered by the data column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByTurno(string $turno) Return the first ChildTabela filtered by the turno column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByFisioterapeuta(string $fisioterapeuta) Return the first ChildTabela filtered by the fisioterapeuta column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByNomePaciente(string $nome_paciente) Return the first ChildTabela filtered by the nome_paciente column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByTipoAtendimento(string $tipo_atendimento) Return the first ChildTabela filtered by the tipo_atendimento column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneBySituacaoAdministrativa(string $situacao_administrativa) Return the first ChildTabela filtered by the situacao_administrativa column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByNipPaciente(string $nip_paciente) Return the first ChildTabela filtered by the nip_paciente column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByNipTitular(string $nip_titular) Return the first ChildTabela filtered by the nip_titular column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByCpfTitular(string $cpf_titular) Return the first ChildTabela filtered by the cpf_titular column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByOrigem(string $origem) Return the first ChildTabela filtered by the origem column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByCorpoQuadro(string $corpo_quadro) Return the first ChildTabela filtered by the corpo_quadro column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByPostoGraduacao(string $posto_graduacao) Return the first ChildTabela filtered by the posto_graduacao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByAtleta(string $atleta) Return the first ChildTabela filtered by the atleta column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByModalidade(string $modalidade) Return the first ChildTabela filtered by the modalidade column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByOutraModalidade(string $outra_modalidade) Return the first ChildTabela filtered by the outra_modalidade column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByComparecimento(boolean $comparecimento) Return the first ChildTabela filtered by the comparecimento column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByTipoFalta(string $tipo_falta) Return the first ChildTabela filtered by the tipo_falta column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByProcedimento1(string $procedimento_1) Return the first ChildTabela filtered by the procedimento_1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByProcedimento2(string $procedimento_2) Return the first ChildTabela filtered by the procedimento_2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByProcedimento3(string $procedimento_3) Return the first ChildTabela filtered by the procedimento_3 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByProcedimento4(string $procedimento_4) Return the first ChildTabela filtered by the procedimento_4 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByProcedimento5(string $procedimento_5) Return the first ChildTabela filtered by the procedimento_5 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByProcedimento6(string $procedimento_6) Return the first ChildTabela filtered by the procedimento_6 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByProcedimento7(string $procedimento_7) Return the first ChildTabela filtered by the procedimento_7 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByProcedimento8(string $procedimento_8) Return the first ChildTabela filtered by the procedimento_8 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByProcedimento9(string $procedimento_9) Return the first ChildTabela filtered by the procedimento_9 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByProcedimento10(string $procedimento_10) Return the first ChildTabela filtered by the procedimento_10 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByProcedimento11(string $procedimento_11) Return the first ChildTabela filtered by the procedimento_11 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByProcedimento12(string $procedimento_12) Return the first ChildTabela filtered by the procedimento_12 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByProcedimento13(string $procedimento_13) Return the first ChildTabela filtered by the procedimento_13 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByProcedimento14(string $procedimento_14) Return the first ChildTabela filtered by the procedimento_14 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByProcedimento15(string $procedimento_15) Return the first ChildTabela filtered by the procedimento_15 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByProcedimento16(string $procedimento_16) Return the first ChildTabela filtered by the procedimento_16 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByProcedimento17(string $procedimento_17) Return the first ChildTabela filtered by the procedimento_17 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByProcedimento18(string $procedimento_18) Return the first ChildTabela filtered by the procedimento_18 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByProcedimento19(string $procedimento_19) Return the first ChildTabela filtered by the procedimento_19 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByProcedimento20(string $procedimento_20) Return the first ChildTabela filtered by the procedimento_20 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTabela requireOneByTotalProcedimentos(int $total_procedimentos) Return the first ChildTabela filtered by the total_procedimentos column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTabela[]|Collection find(?ConnectionInterface $con = null) Return ChildTabela objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildTabela> find(?ConnectionInterface $con = null) Return ChildTabela objects based on current ModelCriteria
 * @method     ChildTabela[]|Collection findById(int $id) Return ChildTabela objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildTabela> findById(int $id) Return ChildTabela objects filtered by the id column
 * @method     ChildTabela[]|Collection findByData(string $data) Return ChildTabela objects filtered by the data column
 * @psalm-method Collection&\Traversable<ChildTabela> findByData(string $data) Return ChildTabela objects filtered by the data column
 * @method     ChildTabela[]|Collection findByTurno(string $turno) Return ChildTabela objects filtered by the turno column
 * @psalm-method Collection&\Traversable<ChildTabela> findByTurno(string $turno) Return ChildTabela objects filtered by the turno column
 * @method     ChildTabela[]|Collection findByFisioterapeuta(string $fisioterapeuta) Return ChildTabela objects filtered by the fisioterapeuta column
 * @psalm-method Collection&\Traversable<ChildTabela> findByFisioterapeuta(string $fisioterapeuta) Return ChildTabela objects filtered by the fisioterapeuta column
 * @method     ChildTabela[]|Collection findByNomePaciente(string $nome_paciente) Return ChildTabela objects filtered by the nome_paciente column
 * @psalm-method Collection&\Traversable<ChildTabela> findByNomePaciente(string $nome_paciente) Return ChildTabela objects filtered by the nome_paciente column
 * @method     ChildTabela[]|Collection findByTipoAtendimento(string $tipo_atendimento) Return ChildTabela objects filtered by the tipo_atendimento column
 * @psalm-method Collection&\Traversable<ChildTabela> findByTipoAtendimento(string $tipo_atendimento) Return ChildTabela objects filtered by the tipo_atendimento column
 * @method     ChildTabela[]|Collection findBySituacaoAdministrativa(string $situacao_administrativa) Return ChildTabela objects filtered by the situacao_administrativa column
 * @psalm-method Collection&\Traversable<ChildTabela> findBySituacaoAdministrativa(string $situacao_administrativa) Return ChildTabela objects filtered by the situacao_administrativa column
 * @method     ChildTabela[]|Collection findByNipPaciente(string $nip_paciente) Return ChildTabela objects filtered by the nip_paciente column
 * @psalm-method Collection&\Traversable<ChildTabela> findByNipPaciente(string $nip_paciente) Return ChildTabela objects filtered by the nip_paciente column
 * @method     ChildTabela[]|Collection findByNipTitular(string $nip_titular) Return ChildTabela objects filtered by the nip_titular column
 * @psalm-method Collection&\Traversable<ChildTabela> findByNipTitular(string $nip_titular) Return ChildTabela objects filtered by the nip_titular column
 * @method     ChildTabela[]|Collection findByCpfTitular(string $cpf_titular) Return ChildTabela objects filtered by the cpf_titular column
 * @psalm-method Collection&\Traversable<ChildTabela> findByCpfTitular(string $cpf_titular) Return ChildTabela objects filtered by the cpf_titular column
 * @method     ChildTabela[]|Collection findByOrigem(string $origem) Return ChildTabela objects filtered by the origem column
 * @psalm-method Collection&\Traversable<ChildTabela> findByOrigem(string $origem) Return ChildTabela objects filtered by the origem column
 * @method     ChildTabela[]|Collection findByCorpoQuadro(string $corpo_quadro) Return ChildTabela objects filtered by the corpo_quadro column
 * @psalm-method Collection&\Traversable<ChildTabela> findByCorpoQuadro(string $corpo_quadro) Return ChildTabela objects filtered by the corpo_quadro column
 * @method     ChildTabela[]|Collection findByPostoGraduacao(string $posto_graduacao) Return ChildTabela objects filtered by the posto_graduacao column
 * @psalm-method Collection&\Traversable<ChildTabela> findByPostoGraduacao(string $posto_graduacao) Return ChildTabela objects filtered by the posto_graduacao column
 * @method     ChildTabela[]|Collection findByAtleta(string $atleta) Return ChildTabela objects filtered by the atleta column
 * @psalm-method Collection&\Traversable<ChildTabela> findByAtleta(string $atleta) Return ChildTabela objects filtered by the atleta column
 * @method     ChildTabela[]|Collection findByModalidade(string $modalidade) Return ChildTabela objects filtered by the modalidade column
 * @psalm-method Collection&\Traversable<ChildTabela> findByModalidade(string $modalidade) Return ChildTabela objects filtered by the modalidade column
 * @method     ChildTabela[]|Collection findByOutraModalidade(string $outra_modalidade) Return ChildTabela objects filtered by the outra_modalidade column
 * @psalm-method Collection&\Traversable<ChildTabela> findByOutraModalidade(string $outra_modalidade) Return ChildTabela objects filtered by the outra_modalidade column
 * @method     ChildTabela[]|Collection findByComparecimento(boolean $comparecimento) Return ChildTabela objects filtered by the comparecimento column
 * @psalm-method Collection&\Traversable<ChildTabela> findByComparecimento(boolean $comparecimento) Return ChildTabela objects filtered by the comparecimento column
 * @method     ChildTabela[]|Collection findByTipoFalta(string $tipo_falta) Return ChildTabela objects filtered by the tipo_falta column
 * @psalm-method Collection&\Traversable<ChildTabela> findByTipoFalta(string $tipo_falta) Return ChildTabela objects filtered by the tipo_falta column
 * @method     ChildTabela[]|Collection findByProcedimento1(string $procedimento_1) Return ChildTabela objects filtered by the procedimento_1 column
 * @psalm-method Collection&\Traversable<ChildTabela> findByProcedimento1(string $procedimento_1) Return ChildTabela objects filtered by the procedimento_1 column
 * @method     ChildTabela[]|Collection findByProcedimento2(string $procedimento_2) Return ChildTabela objects filtered by the procedimento_2 column
 * @psalm-method Collection&\Traversable<ChildTabela> findByProcedimento2(string $procedimento_2) Return ChildTabela objects filtered by the procedimento_2 column
 * @method     ChildTabela[]|Collection findByProcedimento3(string $procedimento_3) Return ChildTabela objects filtered by the procedimento_3 column
 * @psalm-method Collection&\Traversable<ChildTabela> findByProcedimento3(string $procedimento_3) Return ChildTabela objects filtered by the procedimento_3 column
 * @method     ChildTabela[]|Collection findByProcedimento4(string $procedimento_4) Return ChildTabela objects filtered by the procedimento_4 column
 * @psalm-method Collection&\Traversable<ChildTabela> findByProcedimento4(string $procedimento_4) Return ChildTabela objects filtered by the procedimento_4 column
 * @method     ChildTabela[]|Collection findByProcedimento5(string $procedimento_5) Return ChildTabela objects filtered by the procedimento_5 column
 * @psalm-method Collection&\Traversable<ChildTabela> findByProcedimento5(string $procedimento_5) Return ChildTabela objects filtered by the procedimento_5 column
 * @method     ChildTabela[]|Collection findByProcedimento6(string $procedimento_6) Return ChildTabela objects filtered by the procedimento_6 column
 * @psalm-method Collection&\Traversable<ChildTabela> findByProcedimento6(string $procedimento_6) Return ChildTabela objects filtered by the procedimento_6 column
 * @method     ChildTabela[]|Collection findByProcedimento7(string $procedimento_7) Return ChildTabela objects filtered by the procedimento_7 column
 * @psalm-method Collection&\Traversable<ChildTabela> findByProcedimento7(string $procedimento_7) Return ChildTabela objects filtered by the procedimento_7 column
 * @method     ChildTabela[]|Collection findByProcedimento8(string $procedimento_8) Return ChildTabela objects filtered by the procedimento_8 column
 * @psalm-method Collection&\Traversable<ChildTabela> findByProcedimento8(string $procedimento_8) Return ChildTabela objects filtered by the procedimento_8 column
 * @method     ChildTabela[]|Collection findByProcedimento9(string $procedimento_9) Return ChildTabela objects filtered by the procedimento_9 column
 * @psalm-method Collection&\Traversable<ChildTabela> findByProcedimento9(string $procedimento_9) Return ChildTabela objects filtered by the procedimento_9 column
 * @method     ChildTabela[]|Collection findByProcedimento10(string $procedimento_10) Return ChildTabela objects filtered by the procedimento_10 column
 * @psalm-method Collection&\Traversable<ChildTabela> findByProcedimento10(string $procedimento_10) Return ChildTabela objects filtered by the procedimento_10 column
 * @method     ChildTabela[]|Collection findByProcedimento11(string $procedimento_11) Return ChildTabela objects filtered by the procedimento_11 column
 * @psalm-method Collection&\Traversable<ChildTabela> findByProcedimento11(string $procedimento_11) Return ChildTabela objects filtered by the procedimento_11 column
 * @method     ChildTabela[]|Collection findByProcedimento12(string $procedimento_12) Return ChildTabela objects filtered by the procedimento_12 column
 * @psalm-method Collection&\Traversable<ChildTabela> findByProcedimento12(string $procedimento_12) Return ChildTabela objects filtered by the procedimento_12 column
 * @method     ChildTabela[]|Collection findByProcedimento13(string $procedimento_13) Return ChildTabela objects filtered by the procedimento_13 column
 * @psalm-method Collection&\Traversable<ChildTabela> findByProcedimento13(string $procedimento_13) Return ChildTabela objects filtered by the procedimento_13 column
 * @method     ChildTabela[]|Collection findByProcedimento14(string $procedimento_14) Return ChildTabela objects filtered by the procedimento_14 column
 * @psalm-method Collection&\Traversable<ChildTabela> findByProcedimento14(string $procedimento_14) Return ChildTabela objects filtered by the procedimento_14 column
 * @method     ChildTabela[]|Collection findByProcedimento15(string $procedimento_15) Return ChildTabela objects filtered by the procedimento_15 column
 * @psalm-method Collection&\Traversable<ChildTabela> findByProcedimento15(string $procedimento_15) Return ChildTabela objects filtered by the procedimento_15 column
 * @method     ChildTabela[]|Collection findByProcedimento16(string $procedimento_16) Return ChildTabela objects filtered by the procedimento_16 column
 * @psalm-method Collection&\Traversable<ChildTabela> findByProcedimento16(string $procedimento_16) Return ChildTabela objects filtered by the procedimento_16 column
 * @method     ChildTabela[]|Collection findByProcedimento17(string $procedimento_17) Return ChildTabela objects filtered by the procedimento_17 column
 * @psalm-method Collection&\Traversable<ChildTabela> findByProcedimento17(string $procedimento_17) Return ChildTabela objects filtered by the procedimento_17 column
 * @method     ChildTabela[]|Collection findByProcedimento18(string $procedimento_18) Return ChildTabela objects filtered by the procedimento_18 column
 * @psalm-method Collection&\Traversable<ChildTabela> findByProcedimento18(string $procedimento_18) Return ChildTabela objects filtered by the procedimento_18 column
 * @method     ChildTabela[]|Collection findByProcedimento19(string $procedimento_19) Return ChildTabela objects filtered by the procedimento_19 column
 * @psalm-method Collection&\Traversable<ChildTabela> findByProcedimento19(string $procedimento_19) Return ChildTabela objects filtered by the procedimento_19 column
 * @method     ChildTabela[]|Collection findByProcedimento20(string $procedimento_20) Return ChildTabela objects filtered by the procedimento_20 column
 * @psalm-method Collection&\Traversable<ChildTabela> findByProcedimento20(string $procedimento_20) Return ChildTabela objects filtered by the procedimento_20 column
 * @method     ChildTabela[]|Collection findByTotalProcedimentos(int $total_procedimentos) Return ChildTabela objects filtered by the total_procedimentos column
 * @psalm-method Collection&\Traversable<ChildTabela> findByTotalProcedimentos(int $total_procedimentos) Return ChildTabela objects filtered by the total_procedimentos column
 * @method     ChildTabela[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildTabela> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TabelaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Api\Models\Base\TabelaQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Api\\Models\\Tabela', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTabelaQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTabelaQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildTabelaQuery) {
            return $criteria;
        }
        $query = new ChildTabelaQuery();
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
     * @return ChildTabela|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TabelaTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TabelaTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildTabela A model object, or null if the key is not found
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
            /** @var ChildTabela $obj */
            $obj = new ChildTabela();
            $obj->hydrate($row);
            TabelaTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildTabela|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(TabelaTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(TabelaTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(TabelaTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(TabelaTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the data column
     *
     * Example usage:
     * <code>
     * $query->filterByData('fooValue');   // WHERE data = 'fooValue'
     * $query->filterByData('%fooValue%', Criteria::LIKE); // WHERE data LIKE '%fooValue%'
     * $query->filterByData(['foo', 'bar']); // WHERE data IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $data The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByData($data = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($data)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaTableMap::COL_DATA, $data, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_TURNO, $turno, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_FISIOTERAPEUTA, $fisioterapeuta, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_NOME_PACIENTE, $nomePaciente, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_TIPO_ATENDIMENTO, $tipoAtendimento, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_SITUACAO_ADMINISTRATIVA, $situacaoAdministrativa, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_NIP_PACIENTE, $nipPaciente, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_NIP_TITULAR, $nipTitular, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_CPF_TITULAR, $cpfTitular, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_ORIGEM, $origem, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_CORPO_QUADRO, $corpoQuadro, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_POSTO_GRADUACAO, $postoGraduacao, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_ATLETA, $atleta, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_MODALIDADE, $modalidade, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_OUTRA_MODALIDADE, $outraModalidade, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_COMPARECIMENTO, $comparecimento, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_TIPO_FALTA, $tipoFalta, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_PROCEDIMENTO_1, $procedimento1, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_PROCEDIMENTO_2, $procedimento2, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_PROCEDIMENTO_3, $procedimento3, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_PROCEDIMENTO_4, $procedimento4, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_PROCEDIMENTO_5, $procedimento5, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_PROCEDIMENTO_6, $procedimento6, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_PROCEDIMENTO_7, $procedimento7, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_PROCEDIMENTO_8, $procedimento8, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_PROCEDIMENTO_9, $procedimento9, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_PROCEDIMENTO_10, $procedimento10, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_PROCEDIMENTO_11, $procedimento11, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_PROCEDIMENTO_12, $procedimento12, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_PROCEDIMENTO_13, $procedimento13, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_PROCEDIMENTO_14, $procedimento14, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_PROCEDIMENTO_15, $procedimento15, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_PROCEDIMENTO_16, $procedimento16, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_PROCEDIMENTO_17, $procedimento17, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_PROCEDIMENTO_18, $procedimento18, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_PROCEDIMENTO_19, $procedimento19, $comparison);

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

        $this->addUsingAlias(TabelaTableMap::COL_PROCEDIMENTO_20, $procedimento20, $comparison);

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
                $this->addUsingAlias(TabelaTableMap::COL_TOTAL_PROCEDIMENTOS, $totalProcedimentos['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalProcedimentos['max'])) {
                $this->addUsingAlias(TabelaTableMap::COL_TOTAL_PROCEDIMENTOS, $totalProcedimentos['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TabelaTableMap::COL_TOTAL_PROCEDIMENTOS, $totalProcedimentos, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildTabela $tabela Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($tabela = null)
    {
        if ($tabela) {
            $this->addUsingAlias(TabelaTableMap::COL_ID, $tabela->getId(), Criteria::NOT_EQUAL);
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
            $con = Propel::getServiceContainer()->getWriteConnection(TabelaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TabelaTableMap::clearInstancePool();
            TabelaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TabelaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TabelaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TabelaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TabelaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
