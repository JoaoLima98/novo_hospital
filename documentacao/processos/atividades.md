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

**Saídas:** Requisitos Funcionais, **[Documento de Visão](https://github.com/JoaoLima98/triagem_hospitalar/blob/main/documentacao/documento-visao.md#documento-de-vis%C3%A3o-sistema-de-fluxo-hospitalar)**.
### Principais Tarefas

1.  **Levantamento de Requisitos:** Analisar a demanda e construir os...
    
2.  **Análise de Viabilidade:** Analisar o impacto das novas funcionalidades na rotina de atendimento.
    
3.  **Definição de Escopo:** Formalizar os limites do projeto com base no diagrama. **Escopo Incluído:** `Gerenciar Paciente`, `Fazer Triagem`, `Verificar Prontuário`, `Receber Triagem`, `Diagnosticar Paciente`, `Prescrever Medicamento` e `Gerenciar Estoque`. **Escopo Excluído:** Quaisquer outras funcionalidades, como faturamento, agendamento, ou gestão de leitos.
    
4.  **Documentação da Visão:** Criar o **[Documento de Visão](https://github.com/JoaoLima98/triagem_hospitalar/blob/main/documentacao/processos/papeis.md#analista-de-neg%C3%B3cio-an)** que formaliza os objetivos e o escopo do Sistema de Triagem Hospitalar.

---
## 2. Planejar
### Propósito
A atividade **Planejar** tem objetivo de transformar ideias/demandas iniciais em tarefas que encaminhem estas ideias para um produto final.

### Responsáveis

**[Analista de Negócio (AN)](https://github.com/JoaoLima98/triagem_hospitalar/blob/main/documentacao/processos/papeis.md#analista-de-neg%C3%B3cio-an)**.

**[Gerente do Projeto](https://github.com/JoaoLima98/novo_hospital/edit/main/documentacao/processos/papeis.md#gerente-do-projeto)**.

### Fluxo de Artefatos

**Entradas:** 

**Saídas:**

## 3. Especificar Funcionalidades

### Propósito

A atividade **Especificar** transforma os casos de uso do diagrama em **requisitos funcionais detalhados**. O objetivo é criar especificações claras, não ambíguas e testáveis, descrevendo exatamente como cada ator interagirá com o sistema.

### Responsável Principal

**[Analista de QA](https://github.com/JoaoLima98/triagem_hospitalar/blob/main/documentacao/processos/papeis.md#analista-de-qa-quality-assurance)**.

### Fluxo de Artefatos

**Entradas**: **[Documento de Visão](https://github.com/JoaoLima98/triagem_hospitalar/blob/main/documentacao/processos/papeis.md#analista-de-neg%C3%B3cio-an)**, Diagrama de Caso de Uso.

**Saídas**: **[Especificação de Casos de uso](https://github.com/JoaoLima98/triagem_hospitalar/tree/main/documentacao/especificacoes/caso-de-uso)**

### Principais Tarefas

1.  **Especificação de Casos de uso:** Detalhar cada funcionalidade do escopo.
    
    -   **Exemplo disponível em: [Artefatos](https://github.com/JoaoLima98/triagem_hospitalar/blob/main/documentacao/processos/artefatos.md#template-1)**
        
2.  **Definição de Critérios de Aceitação:** Descrever as regras de negócio para o sucesso de cada especificação.

---
## 3. Codificar e Testar Unitariamente

### Propósito

A atividade **Codificar** é a implementação técnica do Sistema de Triagem. O objetivo é transformar as especificações em um **[Produto](l)** funcional, seguro e confiável, que suporte o fluxo de atendimento definido no escopo.

### Responsável Principal

**[Analista de QA](https://github.com/JoaoLima98/triagem_hospitalar/blob/main/documentacao/processos/papeis.md#analista-de-qa-quality-assurance)**.

### Fluxo de Artefatos

**Entradas:** [Especificações de Casos de Uso]() detalhadas com Critérios de Aceitação.

**Saídas:**  [Produto Executável](https://github.com/JoaoLima98/triagem_hospitalar/blob/main/documentacao/processos/artefatos.md#4-produto-software-execut%C3%A1vel), Código-fonte, Testes Unitários.

### Principais Tarefas

1.  **Design:** Planejar a estrutura do código, considerando a segurança dos dados do paciente e a comunicação entre os diferentes casos de uso.
    
2.  **Escrita do Código:** Implementar a lógica de cada funcionalidade do sistema.
    
3.  **Integração Contínua:** Unir o código das diferentes funcionalidades, garantindo que a **Triagem** registrada pela **Enfermeira** seja corretamente exibida para o **Médico** que irá **Verificar o Prontuário**.

---
## 4. Construir Documento de requisitos

### Propósito

A atividade **Construir o documento de requisitos** é gerar um documento visível do funcionamento e dos atores do Sistema de Triagem. O objetivo é retirar o sistema do campo das ideias e transformar em um **[Produto]()** visual que sirva como guia para a equipe.

### Responsável Principal

**[Desenvolvedor](https://github.com/JoaoLima98/triagem_hospitalar/blob/main/documentacao/processos/papeis.md)**.

### Fluxo de Artefatos

**Entradas:** [Especificações de Casos de Uso](https://github.com/JoaoLima98/triagem_hospitalar/tree/main/documentacao/especificacoes), [Documento de Visão](https://github.com/JoaoLima98/triagem_hospitalar/blob/main/documentacao/documento_visao.md)
**Saídas:**  [Documento de Requisitos](https://github.com/JoaoLima98/triagem_hospitalar/blob/main/documentacao/Documento%20de%20Requisitos%20-%20Sistema%20de%20Fluxo%20Hospitalar.pdf), incluindo Minimundo, EAP, Propósito, Requisitos Funcionais, Requisitos não funcionais e Regras de negócios.

### Principais Tarefas

1.  **Construção**: Construir o documento preenchendo com base no modelo template exigido.


## 5. Garantir experiência do usuário

### Propósito

A atividade **Garantir experiência do usuário** tem como objetivo garantir que o usuário final tenha uma boa experiência ao utilizar o sistema

### Responsável Principal

**[Profissional UX](https://github.com/JoaoLima98/triagem_hospitalar/blob/main/documentacao/processos/papeis.md#profissional-ux)**.

### Fluxo de Artefatos

**Entradas:** [Especificações de Casos de Uso](https://github.com/JoaoLima98/triagem_hospitalar/tree/main/documentacao/especificacoes), [Documento de Visão](https://github.com/JoaoLima98/triagem_hospitalar/blob/main/documentacao/documento_visao.md)

**Saídas:**  Front-end limpo e fácil de manusear.

### Principais Tarefas

1.   **Design:** Planejar o Front-end do sistema de maneira que o usuário tenha facilidade de utilizar o sistema.


## 6. Revisar

### Propósito

A atividade de **Revisar** tem objetivo de avaliar e criticar de forma sistemática um artefato ou processo a fim de identificar e corrigir desvios ou erros.

### Responsável Principal

**[Analista de QA](https://github.com/JoaoLima98/triagem_hospitalar/blob/main/documentacao/processos/papeis.md#analista-de-qa-quality-assurance)**.

### Fluxo de Artefatos

**Entradas:** Software Executável.

**Saídas:** Correção do ou aceitação do requisito ou software executável.
