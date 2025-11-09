# Documento de Especificação de Requisitos

  

## Projeto: Sistema de Fluxo Hospitalar


  

### Registro de Alterações

  

| Versão | Responsável | Data | Alterações |
| :--- | :--- | :--- | :--- |
| 0.1 | João de Azevedo Lima Neto | 07/11/2025 | Criação do Documento |
| 1.0 | Jocian Douglas Souza Carneiro, João de Azevedo Lima Neto | 08/11/2025 | Adição da descrição de casos de uso e criação da primeira versão do diagrama de classes |
  

---


## 1. Introdução

  

Este documento apresenta a especificação dos requisitos do sistema **Sistema de Fluxo Hospitalar**.

A atividade de análise de requisitos foi conduzida aplicando-se técnicas de modelagem de casos de uso, modelagem de classes.


Os modelos apresentados foram elaborados usando a linguagem **UML**. Este documento está organizado da seguinte forma:

- A seção 2 apresenta o modelo de casos de uso, incluindo descrições de atores, diagramas de casos de uso e descrições de casos de uso. 
- A seção 3 apresenta o modelo de casos de classe. 

---

  

## 2. Modelo de Casos de Uso
  
Os atores identificados no contexto deste projeto estão descritos na tabela abaixo.

### 2.1 Tabela – Atores

| Ator | Descrição |
| :--- | :--- |
| **Recepcionista** | Funcionário responsável pela recepção do paciente, incumbido de registrar suas informações pessoais (CPF, CNS, etc.) e dados de entrada. |
| **Enfermeiro(a)** | Profissional de saúde responsável pela triagem inicial, incumbido de registrar informações como monitoramento dos sinais vitais, protocolo de Manchester, etc... |
| **Médico(a)** | Profissional de saúde responsável pelo diagnóstico e prescrição de medicamentos. |
| **Farmacêutico(a)** | Profissional responsável pela gestão, controle de estoque e dispensação de medicamentos para os pacientes. |
| **Administrador** | Usuário com privilégios elevados no sistema, responsável por gerenciar cadastros de funcionários.|


### 2.2 Diagrama de caso de uso

<img width="1352" height="1438" alt="Diagrama caso de uso Triagem Hospitalar - Diagrama de caso de uso" src="https://github.com/user-attachments/assets/9c4d17fe-05e4-4b2f-94b3-2eaa94cdcbb2" />


### 2.3 Descrições dos casos de uso:
- [Criar autenticação](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/criar-autenticacao.md#caso-de-uso-criar-autentica%C3%A7%C3%A3o)
- [Gerenciar Estoque de Medicamentos](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/gerenciar-estoque-medicamento.md#caso-de-uso-gerenciar-estoque-de-medicamentos)


## 3. Diagrama de Classes

<img width="1273" height="1108" alt="Classe UML - Hospital" src="https://github.com/user-attachments/assets/f8ac3ced-4c2b-4e41-b6d8-d3e4f1d3aeb6" />
