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

```

## 3. Documento de Requisitos

O documento de requisitos que visa esclarecer funcionalidades, propósito e fluxo do sistema, a partir das Regras de Negócio, Requisitos funcionais e não funcionais e afins...

### Template


Disponível em: [**Documento de Requisitos - Modelo de Template**](https://docs.google.com/document/d/14_ZbOQq3aVavelnnB9D3wRqyQivDFaTPBvYiMCzllCE/edit?usp=sharing)

## 4. Produto (Software Executável)

O Produto é o artefato final e tangível de todo o processo. Representa o software funcional, testado e pronto para ser entregue aos usuários ou disponibilizado em um ambiente de produção/teste. É a manifestação concreta das Histórias de Usuário implementadas.


## 5. Plano de Testes

O documento que visa definir os testes do software a fim de manter a qualidade do sistema.

### Template

Este documento deve responder as seguintes perguntas, voltados para os testes:
- Qual o objetivo?
- Qual a estratégia?
- Quais as técnicas?
- Quais indicadores?
- Ferramentas e Ambiente

- Tabela com os Cenários de testes com as colunas

|  ESPECIFICAÇÃO | DADO | COMPORTAMENTO | RESULTADO |
| :--- | :--- | :--- | :--- |
|  **ESPECIFICAÇÃO DO TESTE, EX:** Gerenciar Estoque de Medicamentos | **DADO TESTADO, EX:** Inserir um contato com nome existente | **COMPORTAMENTO TESTADO, EX:** Verificar unicidade ao cadastrar um contato | **RESULTADO ESPERADO, EX:** Exceção com mensagem: "Já existe um contato cadastrado com este nome." |

---

## 6. Relatório de testes

O Relatórios de testes, como o nome já diz, visa relatar os testes que tiveram sucesso, fracassos e as suas ocorrências.

### Template


#### Total mínimo esperado de testes bem-sucedidos: 80%
#### Total máximo esperado de testes mal-sucedidos: 20%

#### Total de testes bem-sucedidos: x%
#### Total de testes mal-sucedidos: x%

| TOTAL BEM-SUCEDIDOS PLANEJADO | TOTAL BEM-SUCEDIDOS | TOTAL MAL-SUCEDIDOS PLANEJADO | TOTAL MAL-SUCEDIDOS | TOTAL DE TESTES |
| :---: | :---: | :---: | :---: | :---: |
| 10 | 8 | 0 | 2 | 10 |


---

## 7. Gráfico de Gantt

Artefato responsável por representar a estimativa de tempo de entrega.

### Template

{Preencher Template}

## 8. Diagrama de Atividades

Artefato que representa fluxo de trabalho de um processo de negócio ou de uma funcionalidade do sistema.

### Template

{Preencher Template}
