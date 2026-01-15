
# Caso de Uso: Atualizar Status do Paciente

## 1. Atores

- **Sistema**

## 2. Pré-condições

- O sistema deve estar operacional.
- O paciente deve ter passado pela [Triagem](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/fazer-triagem.md#especifica%C3%A7%C3%A3o-do-caso-de-uso-fazer-triagem).

## 3. Fluxo Principal

### a) Acontecimento 1º: Atualização Automática de Estados

1. O Sistema monitora as ações realizadas nos outros módulos e atualiza o status do paciente conforme a seguinte lógica:
    * **"Aguardando atendimento médico":** Definido automaticamente assim que a enfermeira confirma o cadastro da triagem.
    * **"Em atendimento médico":** Definido automaticamente quando o médico seleciona o botão de "Atender" na [Fila de Atendimento](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/visualizar-fila-atendimento.md).
    * **"Aguardando medicamentos":** Definido automaticamente quando o médico gerar prescrição e encaminhar para o farmacêutico.
    * **"Finalizado":** Definido automaticamente quando o farmacêutico conclui a entrega e a guia torna-se "Totalmente Atendida".

## 4. Fluxos Alternativos (Exceções)

### 4.1. Cancelamento de atendimento
- Se o atendimento for cancelado em qualquer etapa (por desistência ou erro de cadastro), o sistema deve atualizar o status para **"Cancelado"** e remover o paciente das filas de prioridade ativa.


### 4.2. Fechar Modal de Detalhes
- Ao visualizar o histórico de status (Acontecimento 2º, passo 6), o ator pode selecionar "Fechar" ou clicar fora do modal. O modal será fechado e o sistema retornará à lista de pacientes.

## 5. Pós-condições

- **Sucesso:** O status do paciente reflete exatamente sua localização atual no fluxo de trabalho do hospital (Triagem -> Médico -> Farmácia).
- **Falha:** O status permanece desatualizado, causando inconsistência entre a recepção e a equipe clínica.

## 6. Cenários de Teste

| DADO | COMPORTAMENTO | RESULTADO | TIPO |
| :--- | :--- | :--- | :--- |
| Enfermeiro finaliza a triagem | Verificar atualização automática na lista da recepção | O status do paciente deve mudar para **"Aguardando atendimento médico"** | Integração |
| Médico clica em "Gerar Prescrição" | Verificar gatilho de mudança de estado | O status do paciente deve mudar para **"Aguardando medicamentos"** | Integração |
| Farmacêutico entrega todos os remédios (Totalmente Atendido) | Verificar conclusão do fluxo | O status do paciente deve mudar para **"Finalizado"** | Integração |
