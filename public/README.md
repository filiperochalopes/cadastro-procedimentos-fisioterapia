## Roadmap

- Continuidade no aprimoramento de estruturação de dados, para otimizar consistência de dados obedecendo regras normais: Pendente criação de relacionamento many-to-many para modalidades esportivas, e uso de ids para identificação de objetos de valor que hoje estão como strings
- Criar funcionalidade de adicionar Objetos de Valor: Situação administrativa, Posto/Graduação, Origem, Corpo/Quadro, Modalidades de Atletas, Tipo de Atendimento, Tipo de Falta e Procedimentos utilizando [jtable](https://www.jtable.org/) ou semelhante.
- Criar página para adicionar Procedimentos
- Segurança de Rotas da API, as APIs de dados sensíveis GET não estão disponíveis, todavia é uma boa prática mantê-las o mais seguro possível
- Criação de edição de paciente ao registrar novo registro

## Versão 1.2.0

Terceira atualização do sistema, porém o segundo registro
- Remoção de mesmo dado repetido em mais de uma tabela
- Reconstrução de tabela de análise por construção de `VIEW` mysql
- Limpeza de dados, removendo duplicidade de relacionamentos e adicionando dados perdidos
- Alteração de nomenclaturas mais pertinentes
- Reconstrução de templates das páginas usando [Twig](https://twig.symfony.com/)
- Reconstrução de buscas ao banco de dados. Agora com mais segurança e melhor manutenção com o uso do [Propel2](https://propelorm.org/)
- Criação de API para UPINSERT de dados utilizando [Slim](https://www.slimframework.com/)
- Adição de tela de alerta de inconsistências para avaliação e edição de tabela de registros e pacientes
- Criação de tela de versões para acompanhamento das mesmas
- Remoção de fisioterapeutas agora é lógica para poder manter retrocompatibilidade de registros com possibilidade de habilitar fisioterapeutas desabilitados (Pending)
- Aviso de campo pendente de preenchimento em formulário principal para `inputs` tipo `radio`

## Versão 1.1.0

Versão visando custo efetividade para resolução de problema de cadastro condicional de procedimentos em banco de dados de pacientes em tratamento por equipe de fisioterapeutas do Centro de Educação Física (CEFAN) com funcionalidades iniciais:
- Cadastro de pacientes



