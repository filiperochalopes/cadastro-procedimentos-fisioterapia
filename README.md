# Formulário de cadastro de procedimentos de fisioterapia para o CEFAN

Projeto de baixo custo para o serviço da Marinha do Brasil no Centro de Educação Física Almirante Adalberto Nunes (CEFAN) com fim de realizar coleta para posterior análise de dados do setor de fisioterapia. Solicitado por iniciativa interna de um dos integrantes. O sistema se propõe a cadastrar:

- Pacientes
- Profissionais de Fisioterapia
- Procedimentos Disponíveis
- Registro de Procedimentos

Passou por uma refatoração de dados e de estrutura em código em 2023, adequando-se aos padrões mais atuais, todavia algumas implementações de banco de dados e regras normais não foram implementadas por combinado mútuo.

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

Pending: https://opis.io/database/4.x/