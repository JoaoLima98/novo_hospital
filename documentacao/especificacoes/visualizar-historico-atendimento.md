# Caso de Uso: Visualizar historico de atendimento

## 1. Atores

 - Médico
 
## 2. Pré-condições

 - O ator deve ter o nível de acesso de médico
 - Pacientes terem sido atendidos por este médico.
 
## 3. Fluxo Principal

### a) Acontecimento 1º
1. O ator acessar o sistema;
2. O sistema apresenta uma tabela com os pacientes que estão esperando atendimento/prescrição médico(a)
3. A tabela deve estar apresentar os pacientes em ordem de **HORÁRIO DE ATENDIMENTO** e os seguintes campos:
  - Nome do paciente;
  - Manchester (Definidor **primário de prioridade**, quanto mais urgente, mais acima aparece na tabela);
  - Glasgow (Definidor **secundário de prioridade**,  quanto menor o valor, mais acima aparece na tabela. Para o caso de **empate** no **manchester**);
  - Data de chegada (Definidor **terciário de prioridade**, quanto mais cedo chegou, mais acima aparece na tabela.  para o caso de **empate** no **manchester**);
  - Um **botão** para exibir mais detalhes da triagem de um paciente através de um **modal**, e exibir o **nome do(a) enfermeiro(a)** que atendeu o paciente;
  - **Data e hora** de atendimento, a data e hora que a prescrição foi enviada para o farmacêutico.
  - Esboço:
    


## 4. Fluxos Alternativos (Exceções)

## 5. Pós-condições
- **Sucesso:** Tabela exibindo as informações solicitadas.
- **Falha:**

## 6. Cenários de testes

| DADO | COMPORTAMENTO | RESULTADO | TIPO |
| :--- | :--- | :--- | :--- |
| **Realizar prescrição de um paciente** | Verificar população da tabela | A tabela deve mostrar os pacientes em ordem de prioridade | Exploratório baseado em cenário |
