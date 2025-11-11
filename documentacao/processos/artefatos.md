# Artefatos do Processo de Software

Este documento define a estrutura e o propósito dos principais artefatos utilizados em nosso processo de desenvolvimento de software.

---

## 1. Documento de Visão

### Propósito
O **Documento de Visão** estabelece o propósito do produto, seu escopo e a justificativa de negócio para sua criação. Ele serve como o principal guia e "contrato" inicial entre o negócio e a equipe técnica, definindo **o que** será construído e **por que**.

### Template

```markdown
# Documento de Visão: [Nome do Produto/Projeto]

## 1. Contexto de Negócio
*(Descreva a situação atual, o problema ou a oportunidade de mercado que motiva a criação deste software.)*

**Exemplo:** Atualmente, a gestão de estoque é manual, gerando erros de contagem e atrasos na reposição, impactando negativamente a satisfação do cliente.

## 2. Escopo do Produto
*(Defina claramente o que o produto fará e, mais importante, o que ele **não** fará (exclusões).)*

- **Funcionalidades Chave:**
    - [Exemplo: Cadastro de Fornecedores e Produtos]
    - [Exemplo: Rastreamento em tempo real do nível de estoque]
    - [Exemplo: Geração de relatórios de baixa de estoque]

- **Fora do Escopo:**
    - [Exemplo: Integração com o sistema de contabilidade externo]
    - [Exemplo: Aplicativo móvel para gerentes]

## 3. Diagrama de Casos de Uso (Simplificado)
*(Representação visual simples das principais funcionalidades e dos atores que as utilizam.)*

```

---

## 2. Especificação de caso de uso

### Propósito
A **História de Usuário** descreve uma funcionalidade do sistema a partir da perspectiva de quem a utiliza. Seu principal objetivo é focar no **valor** entregue ao usuário, detalhando o requisito de forma concisa e testável. É a principal unidade de trabalho para a equipe de desenvolvimento.

### Template

```markdown
# Caso de Uso: "Nome do caso de uso"

## 1. Atores
 - Atores que utilizam o sistema.
## 2. Pré-condições
 - Condições anteriores para poder seguir com a atual
## 3. Fluxo Principal
### a) Acontecimento 1º
1. O ator acessa a lista...
2. O ator busca tal coisa...
3. O ator insere tais informações...

### b) Acontecimento 2º
1. O ator acessa a lista...
2. O ator busca tal coisa...
3. O ator insere tais informações...

## 4. Fluxos Alternativos (Exceções)
### 4.1 Informação que deveria ser única, duplicada
- Se, no fluxo de criação, o a informação já existir, o sistema deve exibir uma mensagem de erro informando que a informação já está cadastrada.

### 4.2 Dados Inválidos
- Se qualquer campo obrigatório não for preenchido, o sistema deve indicar quais campos precisam de atenção antes de salvar.  

## 5. Pós-condições
- **Sucesso:** Fluxo principal atingido.
- **Falha:** Fluxo principal não atingido.

## 6. Cenários de testes

| DADO | COMPORTAMENTO | RESULTADO |
| :--- | :--- | :--- | :--- |
| **DADO TESTADO, EX:** Inserir um contato com nome existente | **COMPORTAMENTO TESTADO, EX:** Verificar unicidade ao cadastrar um contato | **RESULTADO ESPERADO, EX:** Exceção com mensagem: "Já existe um contato cadastrado com este nome." |

```

## 3. Documento de Requisitos

O documento de requisitos que visa esclarecer funcionalidades, propósito e fluxo do sistema, a partir das Regras de Negócio, Requisitos funcionais e não funcionais e afins...

### Template
```
# Documento de Requisitos - Modelo de Template

**Projeto:** [Nome do Projeto]

**Discentes:** [Nomes dos Discentes]

---

### Registro de Alterações:

| Versão | Responsável | Data | Alterações |
| :--- | :--- | :--- | :--- |
| 0.1 | [Nome] | [Data] | Criação do Documento |
| | | | |
| | | | |

---

## 1. Introdução

[Esta seção deve apresentar os requisitos de usuário da ferramenta, sua organização e o propósito do documento.]

## 2. Descrição do Propósito do Sistema

[Descreva o objetivo principal do sistema, o problema que ele visa resolver e como ele modernizará/otimizará o processo atual. Inclua informações sobre a centralização e informatização do fluxo, as etapas integradas e os benefícios esperados, como controle de acesso, acompanhamento em tempo real e armazenamento histórico.]

## 3. Descrição do Minimundo

[Detalhe o contexto operacional do sistema, incluindo o local de implementação (ex: Hospital Municipal de São Paulo do Potengi) e as fases do processo de atendimento. Descreva cada fase (Recepção, Enfermagem, Atendimento Médico, Farmácia), os profissionais envolvidos, as informações coletadas em cada etapa e como o sistema integra esses dados. Mencione as funcionalidades adicionais como acompanhamento de status, consulta de histórico, controle de acesso, relatórios gerenciais e backup de dados automáticos.]

## 4. Requisitos de Usuário

[Liste os requisitos de usuário identificados, divididos em Requisitos Funcionais, Regras de Negócio e Requisitos Não Funcionais. Para cada requisito, inclua um identificador, uma descrição detalhada, a prioridade e as dependências, se houver.]

### Requisitos Funcionais

| Identificador | Descrição | Prioridade | Depende de |
| :--- | :--- | :--- | :--- |
| RF01 | [Descrição do requisito funcional 1] | [Descrição da prioridade 1] | [Descrição da dependência 1] |
| RF02 | [Descrição do requisito funcional 2] | [Descrição da prioridade 2] | [Descrição da dependência 2] |
| ... | ... | ... | ... |

### Regras de Negócio

| Identificador | Descrição | Prioridade | Depende de |
| :--- | :--- | :--- | :--- |
| RN01 | [Descrição da regra de negócio 1] | [Descrição da prioridade 1] | [Descrição da dependência 1] |
| RN02 | [Descrição da regra de negócio 2] | [Descrição da prioridade 2] | [Descrição da dependência 2] |
| ... | ... | ... | ... |

### Requisitos Não Funcionais

| Identificador | Descrição | Categoria | Escopo | Prioridade | Depende de |
| :--- | :--- | :--- | :--- | :--- | :--- |
| RNF01 | [Descrição do requisito não funcional 1] | [Descrição da categoria 1] | [Descrição do escopo 1] | [Descrição da prioridade 1] | [Descrição da dependência 1] |
| RNF02 | [Descrição do requisito não funcional 2] | [Descrição da categoria 2] | [Descrição do escopo 2] | [Descrição da prioridade 2] | [Descrição da dependência 2] |
| ... | ... | ... | ... | ... | ... |

## 5. Modelo de Casos de Uso

[Esta seção deve conter o diagrama e a descrição dos casos de uso do sistema, detalhando as interações entre os atores e o sistema.]

## 6. Protótipos

[Esta seção deve apresentar imagens iniciais do produto]

## 7. Diagrama de atividades

[Esta seção deve apresentar Diagrama de atividades do produto]

```

## 4. Produto (Software Executável)

O Produto é o artefato final e tangível de todo o processo. Representa o software funcional, testado e pronto para ser entregue aos usuários ou disponibilizado em um ambiente de produção/teste. É a manifestação concreta das Histórias de Usuário implementadas.


## 5. Plano de Testes

O documento que visa definir os testes do software a fim de manter a qualidade do sistema.

### Template

Este documento deve responder as seguintes perguntas, voltados para os testes:
- Qual o objetivo?
- Escopo
- Critérios de Aceitação?
- Ferramentas e Ambientes utilizados?
- Qual a estratégia?
- Quais as técnicas?
- Quais indicadores?
- Ferramentas e Ambiente

---

## 6. Relatório de testes (Unitários)

O Relatórios de testes, como o nome já diz, visa relatar os testes que tiveram sucesso e fracassos.

Este documento será gerado pela ferramenta de Testes Unitários.


## 7. Plano de Gerenciamento do Projeto (PGP)

Este documento é o "Como" — o manual detalhado para executar, monitorar e controlar o projeto.

### Template

```


# Plano de Gerenciamento do Projeto (PGP)

**Projeto:** [Nome do Projeto]

**Equipe:** [Nomes dos Membros da Equipe]

**Data:** [Data de Início]

---

### Registro de Alterações:

| Versão | Responsável | Data | Alterações |
| :--- | :--- | :--- | :--- |
| 0.1 | [Nome] | [Data] | Criação do Documento |
| | | | |
| | | | |


## 1. EAP - Estrutura Analítica do Projeto

[A EAP (ou WBS - Work Breakdown Structure) decompõe o trabalho total do projeto em pacotes de trabalho menores e mais gerenciáveis.]

[Insira aqui o diagrama da EAP (imagem ou link) ou a lista estruturada.]

* **1. [Entrega Principal 1]**
    * 1.1. [Pacote de Trabalho 1.1]
    * 1.2. [Pacote de Trabalho 1.2]
* **2. [Entrega Principal 2]**
    * 2.1. [Pacote de Trabalho 2.1]
    * 2.2. [Pacote de Trabalho 2.2]
* **3. [Gerenciamento do Projeto]**
    * 3.1. [Planejamento]
    * 3.2. [Controle e Monitoramento]

---

## 2. Cronograma - (Gantt)

[O cronograma detalha a sequência de atividades, suas durações estimadas e as datas de início e término visualizado como um Gráfico de Gantt.]

[Insira aqui a imagem do Gráfico de Gantt ou um link para a ferramenta de gerenciamento.]

**Principais Marcos (Milestones):**

| Marco | Data Prevista |
| :--- | :--- |
| [Início do Projeto] | [Data] |
| [Conclusão da Fase 1] | [Data] |
| [Entrega do Protótipo] | [Data] |
| [Fim do Projeto] | [Data] |

---

## 3. Diagrama de Atividades do Projeto

[Esta seção apresenta o fluxo de trabalho e a sequência das atividades, mostrando as dependências entre elas.]

[Insira aqui o Diagrama de Atividades]

---

## 4. Estimativas de Esforço e Custo

### 4.1. Estimativa de Esforço
[Detalhe o esforço estimado (em horas ou dias) necessário para completar as atividades do projeto, muitas vezes baseado na EAP.]

| Pacote de Trabalho (EAP) | Estimativa (Horas) | Recursos Alocados |
| :--- | :--- | :--- |
| [1.1. Pacote de Trabalho] | [HH] | [Nome ou Perfil] |
| [1.2. Pacote de Trabalho] | [HH] | [Nome ou Perfil] |
| [2.1. Pacote de Trabalho] | [HH] | [Nome ou Perfil] |
| **Total Estimado** | **[Total HH]** | |

### 4.2. Estimativa de Custo
[Apresente o orçamento detalhado do projeto, dividindo os custos por categoria.]

| Categoria de Custo | Estimativa (R$) | Justificativa / Descrição |
| :--- | :--- | :--- |
| Recurso 1 | [R$ x,xx] | [Custo da equipe baseado no esforço estimado] |
| Software | [R$ x,xx] | [Nome das ferramentas ou licenças] |



```

## 8. Documento de Especificação de Requisitos

Documento suporte que contém melhor definição dos casos de uso.

### Template

```

# Documento de Especificação de Requisitos

  

## Projeto:


  

### Registro de Alterações

  

| Versão | Responsáveis | Data | Alterações |
|:--|:--|:--|:--|

  

---

  

## 1. Introdução

  

Este documento apresenta a especificação dos requisitos da ferramenta **AAAA**.

A atividade de análise de requisitos foi conduzida aplicando-se técnicas de modelagem de casos de uso, modelagem de classes e modelagem de comportamento dinâmico do sistema.

  

Os modelos apresentados foram elaborados usando a linguagem **UML**. Este documento está organizado da seguinte forma:

- A seção 2 apresenta o modelo de casos de uso, incluindo descrições de atores, diagramas de casos de uso e descrições de casos de uso.  

---

  

## 2. Modelo de Casos de Uso

  

O modelo de casos de uso visa capturar e descrever as funcionalidades que um sistema deve prover para os atores que interagem com o mesmo.

Os atores identificados no contexto deste projeto estão descritos na tabela abaixo.

  

**Tabela 2 – Atores**

  

| Ator | Descrição |
|:--|:--|
|:--|:--|
  

A seguir, são apresentados os diagramas de casos de uso e descrições associadas, organizados por subsistema.

## 3. Diagrama de classes

```

## 9. Casos de teste (Exploratórios)

Documento que detalha determinados casos de testes, sendo obrigatórios para os cenários exploratórios e opcionais para os unitários.

### Template

```

# Caso de Teste: [Inserir Nome]
**Resumo:** [Inserir o título ou objetivo resumido do teste]

---

- **Prioridade:** [Baixa / Média / Alta]
- **Status:** [Planejado / Aprovado / Falhou / Em Execução]
- **Executor:** [Nome do Responsável]
- **Data de criação:** DD/MM/AAAA

### Pré-condição
O que precisa estar pronto antes do teste começar.
* Ex: Estar logado no sistema com perfil administrativo.

### Passos
1. [Ação 1 - ex: Acessar a tela X]
2. [Ação 2 - ex: Clicar no botão Y]
3. [Ação 3 - ex: Preencher campo Z]

### Resultado Esperado
* [Descrever exatamente o que o sistema deve fazer após os passos acima]

---
**Observações:** [Inserir observações relevantes ou "sem observações"]

```
