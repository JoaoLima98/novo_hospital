# Documento de Especificação de Requisitos

  

## Projeto: Sistema de Fluxo Hospitalar


  

### Registro de Alterações

  

| Versão | Responsável | Data | Alterações |
| :--- | :--- | :--- | :--- |
| 0.1 | João de Azevedo Lima Neto | 07/11/2025 | Criação do Documento |
| 1.0 | Jocian Douglas Souza Carneiro, João de Azevedo Lima Neto | 08/11/2025 | Adição da descrição de casos de uso e criação da primeira versão do diagrama de classes |
| 1.1 | João de Azevedo Lima Neto | 08/11/2025 | Atualização no diagrama de casos de uso |
| 1.2 | João de Azevedo Lima Neto | 14/11/2025 | Adicionado descrição/especificação do caso de uso prescrever medicamento |
| 1.3 | João de Azevedo Lima Neto | 14/11/2025 | Atualização no diagrama de caso de uso para ajustar o caso prescrever medicamento e em adição ajustado as cores para ficar mais legível a pedido do Cliente/Professor Maurício |
| 1.4 | João de Azevedo Lima Neto | 15/11/2025 | Atualização no diagrama de caso de uso para separar o caso de gerenciamento de medicamentos em Entregar Medicamento ao Paciente e Registrar Entrada de medicamentos |
| 1.5 | João de Azevedo Lima Neto | 15/11/2025 | Atualização no diagrama de caso de uso para separar o caso criar autenticação, agora sendo Cadastrar Funcionário e Iniciar Sessão, além da adição do Encerra Sessão, seus equivalentes acrécimos na descrição de caso de uso |
| 1.6 | João de Azevedo Lima Neto | 20/11/2025 | Atualização no diagrama de caso de uso para adicionar os casos Disparar alerta de falta de medicamentos e Gerenciar medicamentos bem como suas inserções nas descrições de caso de uso, além do acréscimo da reorganização em ordem alfabética |
| 1.7 | João de Azevedo Lima Neto | 24/11/2025 | Inserção nas descrições de caso de uso de Fazer Triagem |
| 1.8 | João de Azevedo Lima Neto | 04/12/2025 | Atualização no diagrama de caso de uso a adição dos novos casos de uso, bem como sua inserção na descrição de casos |
| 1.9 | João de Azevedo Lima Neto | 08/12/2025 | Atualização na tabela de atores para informar sobre o uso geral do sistema |

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
| **Geral/Todos os atores** | Demarca funcionalidades  todos os os atores utilizam, foi criado para manter organização do diagrama. |


### 2.2 Diagrama de caso de uso

<img width="1612" height="1840" alt="Diagrama caso de uso Triagem Hospitalar - Diagrama de caso de uso" src="https://github.com/user-attachments/assets/f73857b5-8b73-4df6-b606-ded0727af866" />




### 2.3 Descrições dos casos de uso:
- [Cadastrar Funcionario](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/cadastrar-funcionario.md)
- [Disparar alerta de falta de medicamentos](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/disparar-alerta-falta-medicamento.md)
- [Encerra Sessão](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/encerrar-sessao.md)
- [Entregar Medicamento ao Paciente](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/entregar-medicamento-ao-paciente.md)
- [Fazer Triagem](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/fazer-triagem.md)
- [Gerenciar Medicamentos](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/gerenciar-medicamentos.md)
- [Iniciar Sessão](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/iniciar-sessao.md)
- [Prescrever Medicamento](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/prescrever-medicamento.md)
- [Registrar Entrada de Medicamentos](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/registrar-entrada-de-medicamentos.md)
- [Visualiza fila de atendimento](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/visualizar-fila-atendimento.md#caso-de-uso-visualizar-fila-de-atendimento)
- [Visualizar histórico de atendimento](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/visualizar-historico-atendimento.md#caso-de-uso-visualizar-historico-de-atendimento)

## 3. Diagrama de Classes

<img width="1273" height="1108" alt="Classe UML - Hospital" src="https://github.com/user-attachments/assets/f8ac3ced-4c2b-4e41-b6d8-d3e4f1d3aeb6" />
