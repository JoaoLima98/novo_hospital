# Atividades do Processo de Software:

Este documento detalha o fluxo do processo de software, definindo o propósito e as ações primárias de cada atividade no desenvolvimento do **Sistema de Triagem Hospitalar**.

----------

## 1. Analisar Negócio

### Propósito

A atividade **Analisar Negócio** é o ponto de partida. Seu objetivo é entender o contexto, objetivos, problemas e oportunidades diante de uma solicitação, conforme o escopo definido.

### Responsável Principal

**[Analista de Negócio (AN)](https://github.com/JoaoLima98/triagem_hospitalar/blob/main/documentacao/processos/papeis.md#analista-de-neg%C3%B3cio-an)**.

### Fluxo de Artefatos

**Entradas:** Demanda da funcionalidade descrita pelo cliente.

**Saídas:** Requisitos Funcionais, atualização do **[Documento de Visão]((https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/processos/artefatos.md#1-documento-de-vis%C3%A3o) )**.
### Principais Tarefas

1.  **Reunir com cliente:** Organizar reunião com o cliente a fim de compreender as novas demandas.
2.  **Análise de Viabilidade:** Analisar o impacto das novas funcionalidades na rotina de atendimento.
3.  **Definição de Escopo:** Formalizar os limites e as possíveis restrições.

---
## 2. Planejar
### Propósito
A atividade **Planejar** tem objetivo de transformar ideias/demandas iniciais em tarefas que encaminhem estas ideias para um produto final.

### Responsáveis

**[Analista de Negócio (AN)](https://github.com/JoaoLima98/triagem_hospitalar/blob/main/documentacao/processos/papeis.md#analista-de-neg%C3%B3cio-an)** | **[Gerente do Projeto](https://github.com/JoaoLima98/novo_hospital/edit/main/documentacao/processos/papeis.md#gerente-do-projeto)**

### Fluxo de Artefatos

**Entradas:** **[Documento de Visão]((https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/processos/artefatos.md#1-documento-de-vis%C3%A3o))**, Solicitação do cliente.

**Saídas:** Nova Iteração, [Plano de Gerenciamento do Projeto (PGP)](https://github.com/JoaoLima98/novo_hospital/edit/main/documentacao/processos/artefatos.md#7-plano-de-gerenciamento-do-projeto-pgp), [Documento de Especificação de Requisitos](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/processos/artefatos.md#8-documento-de-especifica%C3%A7%C3%A3o-de-requisitos).
### Principais Tarefas

1.  **Revisar demanada:** Rever a demanda exigida pelo cliente.
2.  **Definir métricas:** Responsável, prioridade, iteração/posição no backlog, tamanho e estimativa.

## 3. Especificar Funcionalidades

### Propósito

A atividade **Especificar Funcionalidades** transforma os casos de uso do diagrama em **requisitos funcionais detalhados**. O objetivo é criar especificações claras, não ambíguas e testáveis, descrevendo exatamente como cada ator interagirá com o sistema.

### Responsável Principal

**[Analista de QA](https://github.com/JoaoLima98/triagem_hospitalar/blob/main/documentacao/processos/papeis.md#analista-de-qa-quality-assurance)**.

### Fluxo de Artefatos

**Entradas**: **[Documento de Visão](https://github.com/JoaoLima98/triagem_hospitalar/blob/main/documentacao/processos/papeis.md#analista-de-neg%C3%B3cio-an)**, Diagrama de Caso de Uso.

**Saídas**: **[Especificação de Casos de uso](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/processos/artefatos.md#template-1)**

### Principais Tarefas

1.  **Interpretar Funcionamento:** Esta tarefa visa a melhor interpretação da funcionalidade descrita pelo cliente e debatida durante o planejamento.
2.  **Construir Especificação:** Construir a especificação baseada no modelo/template.
    
    -   **Exemplo disponível em: [Artefatos - Especificação de caso de uso](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/processos/artefatos.md#template-1)**
        
3.  **Definição de Critérios de Aceitação:** Descrever as regras de negócio para o sucesso de cada especificação.

---

## 4. Construir plano de testes

### Propósito

A atividade **Construir plano de testes** tem o objetivo de garantir a qualidade do produto final, servindo como um guia de todo o esforço de teste do início ao fim.

### Responsável Principal

**[Analista de QA](https://github.com/JoaoLima98/triagem_hospitalar/blob/main/documentacao/processos/papeis.md#analista-de-qa-quality-assurance)**.

### Fluxo de Artefatos

**Entradas**: **[Documento de Visão](https://github.com/JoaoLima98/triagem_hospitalar/blob/main/documentacao/processos/papeis.md#analista-de-neg%C3%B3cio-an)**, Diagrama de Caso de Uso, Especificação do caso de uso.

**Saídas**: **[Plano de testes](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/processos/artefatos.md#5-plano-de-testes)**

### Principais Tarefas

1.  **Interpretar Especificação:** Esta tarefa visa a melhor interpretação da funcionalidade a partir da Especificação do caso de uso.
2.  **Construir Plano de testes:** Construir o plano de testes descrevendo propósito, métricas e como serão alcançados os resultados.
    
    -   **Exemplo disponível em: [Artefatos - Plano de testes](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/processos/artefatos.md#5-plano-de-testes)**

## 5. Codificar e Testar Unitariamente

### Propósito

A atividade **Codificar** é a implementação técnica do Sistema de Triagem. O objetivo é transformar as especificações em um **[Produto](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/processos/artefatos.md#4-produto-software-execut%C3%A1vel)** funcional.

### Responsável Principal

**[Desenvolvedor](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/processos/papeis.md#desenvolvedor)**.

### Fluxo de Artefatos

**Entradas:** [Especificações de Casos de Uso](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/processos/artefatos.md#template-1), [Plano de testes](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/processos/artefatos.md#5-plano-de-testes).

**Saídas:**  [Produto Executável](https://github.com/JoaoLima98/triagem_hospitalar/blob/main/documentacao/processos/artefatos.md#4-produto-software-execut%C3%A1vel), Código-fonte, Testes Unitários, Relatório de Testes e Casos de testes detalhados.

### Principais Tarefas

1.  **Construir Design:** Planejar a estrutura do código, considerando a segurança dos dados do paciente e a comunicação entre os diferentes casos de uso.
    
2.  **Escrever Código:** Implementar a lógica de cada funcionalidade do sistema.
3.  **Escrever Testes Unitários**: Implementar testes unitários automatizando o fluxo de testes do sistema e garantindo funcionamento das funcionalidades.    
4.  **Escrever relatórios e casos de testes exploratórios**: Construir os relatos dos testes exploratórios e os resultados gerais dos testes.
---


## 6. Revisar demanda

### Propósito

A atividade de **Revisar** tem objetivo de avaliar e criticar de forma sistemática um artefato ou processo a fim de identificar e corrigir desvios ou erros.

### Responsável Principal

**[Analista de QA](https://github.com/JoaoLima98/triagem_hospitalar/blob/main/documentacao/processos/papeis.md#analista-de-qa-quality-assurance)** | **[Analista de Negócio (AN)](https://github.com/JoaoLima98/triagem_hospitalar/blob/main/documentacao/processos/papeis.md#analista-de-neg%C3%B3cio-an)**.

### Fluxo de Artefatos

**Entradas:** Software Executável, [Especificações de Casos de Uso](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/processos/artefatos.md#template-1).

**Saídas:** Correção do ou aceitação do requisito ou software executável.
