# Formulário de cadastro de procedimentos de fisioterapia para o CEFAN

Projeto de baixo custo para o serviço da Marinha do Brasil no Centro de Educação Física Almirante Adalberto Nunes (CEFAN) com fim de realizar coleta para posterior análise de dados do setor de fisioterapia. Solicitado por iniciativa interna de um dos integrantes. O sistema se propõe a cadastrar:

- Pacientes
- Profissionais de Fisioterapia
- Procedimentos Disponíveis
- Registro de Procedimentos

Passou por uma refatoração de dados e de estrutura em código em 2023, adequando-se aos padrões mais atuais, todavia algumas implementações de banco de dados e regras normais não foram implementadas por combinado mútuo.

### Ambiente de produção

É neccessário editar as credenciais de acesso ao banco de dados diretamente em `propel.yml` e executar:
```sh
propel config:convert
```

### Rodando docker em ambiente de desenvolvimento com banco de dados inicial

1. Cole o backup do banco de dados em `/static/db/`
2. Não esqueça de adicionar no arquivo de backup 

```sql
-- Nome do banco de dados
USE `fisiocefan`;
```

3. Inicializar conexão

```sh
docker exec -it fisiocefan_app bash -c "propel init"
```

### Calculando dados iniciados em 2021

Avaliando registro em `tabela` igual ou superiores a 2021 antes da migração

```sql
-- 14655 registros totalizados na busca
SELECT COUNT(id) FROM tabela WHERE `data` LIKE "%/2021" OR `data` LIKE "%/2022" OR `data` LIKE "%/2023";
```

```sql
-- 14659 registros totalizados na busca
SELECT COUNT(id) FROM registros WHERE `data` >= "2021-01-01";
```

### Alterando limite de uso de memória do container

Necessário para realizar uso da migration:

```sh
php -r "echo ini_get('memory_limit').PHP_EOL;"
echo 'memory_limit = -1' >> /usr/local/etc/php/conf.d/docker-php-ram-limit.ini
php -r "echo ini_get('memory_limit').PHP_EOL;"
```