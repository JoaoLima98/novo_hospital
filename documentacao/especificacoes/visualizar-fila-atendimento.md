# Caso de Uso: Visualizar fila de atendimento

## 1. Atores

 - Médico
 
## 2. Pré-condições

 - O ator deve ter o nível de acesso de médico
 -   Pacientes terem passado pela  **[triagem](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/fazer-triagem.md#especifica%C3%A7%C3%A3o-do-caso-de-uso-fazer-triagem)**  e disponíveis para prescrição/atendimento.
 
## 3. Fluxo Principal

### a) Acontecimento 1º
1. O ator acessar o sistema;
2. O sistema apresenta uma tabela com os pacientes que estão esperando atendimento/prescrição médico(a), os pacientes aqui apresentados, são apenas aqueles que condizem com a especialidade do médico, que foi definido lá na **[triagem](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/fazer-triagem.md#especifica%C3%A7%C3%A3o-do-caso-de-uso-fazer-triagem)**.
3. A tabela deve estar apresentar os pacientes em ordem de prioridade e os seguintes campos:
  - Nome do paciente;
  - Manchester (Definidor **primário de prioridade**, quanto mais urgente, mais acima aparece na tabela);
  - Glasgow (Definidor **secundário de prioridade**,  quanto menor o valor, mais acima aparece na tabela. Para o caso de **empate** no **manchester**);
  - Data de chegada (Definidor **terciário de prioridade**, quanto mais cedo chegou, mais acima aparece na tabela.  para o caso de **empate** no **manchester**);
  - Um **botão** para exibir mais detalhes da triagem de um paciente através de um **modal**, e exibir o **nome do(a) enfermeiro(a)** que atendeu o paciente;
  - **Botão** para atender o paciente, e [prescrever seu medicamento.](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/prescrever-medicamento.md#caso-de-uso-prescrever-medicamento)
  - Esboço:
    <img width="1585" height="434" alt="image" src="https://github.com/user-attachments/assets/42b513eb-cc8c-4748-952e-44b844fe3372" />


## 4. Fluxos Alternativos (Exceções)

## 5. Pós-condições
- **Sucesso:** Tabela exibindo as informações solicitadas.
- **Falha:**

## 6. Cenários de testes

| DADO | COMPORTAMENTO | RESULTADO | TIPO |
| :--- | :--- | :--- | :--- |
| **Realizar triagem de pacientes com diferentes níveis de prioridade** | Verificar ordem de prioridade | A tabela deve mostrar os pacientes em ordem de prioridade | Exploratório baseado em cenário |
