# Caso de Uso: Prescrever Medicamento

## 1. Atores
 - Médico
## 2. Pré-condições

 - Estar logado no sistema com o nível de acesso de médico.
 - Pacientes terem passado pela **[triagem](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/fazer-triagem.md#especifica%C3%A7%C3%A3o-do-caso-de-uso-fazer-triagem)** e disponíveis para prescrição/atendimento.
   
## 3. Fluxo Principal

### a) Nova posologia
1. O ator acessar o sistema a partir do login de nível médico;
2. O sistema apresenta uma tabela com os pacientes que estão esperando atendimento/prescrição médico(a)
3. A tabela deve estar apresentar os pacientes em ordem de prioridade e os seguintes campos:
  - Nome do paciente;
  - Manchester (Definidor **primário de prioridade**);
  - Glasgow (Definidor **secundário de prioridade**, para o caso de **empate** no **manchester**);
  - Data de chegada (Definidor **terciário de prioridade**, para o caso de **empate** no **manchester**);
  - Um **botão** para exibir mais detalhes da triagem de um paciente através de um **modal**, e exibir o **nome do(a) enfermeiro(a)** que atendeu o paciente;
  - **Botão** para atender o paciente, para prescrever seu medicamento.
  - Esboço:
    <img width="1585" height="434" alt="image" src="https://github.com/user-attachments/assets/42b513eb-cc8c-4748-952e-44b844fe3372" />

  
4. Ao escolher o paciente, o ator poderá adicionar uma posologia (Posologia é o estudo e a definição da forma correta de utilizar um medicamento);
5. Ao selecionar adicionar posologia, o sistema irá gerar um novo card de posologia na lista;
6. No card uma nova posologia deve apresentar os campos:
   - **Medicamentos** disponíveis (ibuprofeno, amoxilina, etc...)
   - **Quantidade** (1/2, 1, 2, 30 ...) referente ao valor de unidade
   - **Unidade** (comprimido, gotas, sachê) em formato de select
   - **Retirada** que é o valor referente a quanto do medicamento será entregue ao paciente.
   - **Intervalo** entre consumos do medicamento em **horas** (6, 8 , 12...)
   - **Duração em horas** (24, 48, 72, 120);
   como no esboço abaixo:
   
<img width="758" height="466" alt="image" src="https://github.com/user-attachments/assets/26dc78c3-1922-4198-a3d9-32bcbfea01b4" />





7. Se o médico precisar escrever mais alguma instrução ou observação, poderá escrever no campo de observações adicionais (Textarea).
8. Por fim ele ir pressionar o botão **"Gerar prescrição"** para finalizar a prescrição medica e o paciente **DEVE** sair da lista de prioridade e ser encaminhado para o farmacêutico.

### b) Edição e remoção de posologia
1. Depois de criado a posologia, o sistema irá apresentar um botão amarelo para edição e um vermelho para remoção da posologia, com ícones que representem estas ações;
2. Ao selecionar a edição, o modal deve apresentar as opções demonstradas acima já com as opções que foram selecionadas;
3. Ao selecionar a exclusão, apenas aquela posologia excluída deve desaparecer.

## 4. Fluxos Alternativos (Exceções)

### 4.1 Medicamento repetido
- O médico não deve poder cadastrar uma posologia de um medicamento repetido, o medicamento deve ficar não selecionável ou sumir da lista de posologia;

### 4.2 Medicamentos disponíveis
- Os medicamentos só devem aparecer na lista de posologia, se tiverem disponibilidade no estoque maior que 0;

### 4.3 Campos vazios
- O sistema deve proibir a prescrição se a posologia estiver com quaisquer campos vazios.

## 5. Pós-condições
- **Sucesso:** Prescrição é criada e encaminhada para atendimento pelo farmacêutico.
- **Falha:** Prescrição não pode ser criada.

## 6. Cenários de testes

| DADO | COMPORTAMENTO | RESULTADO | TIPO |
| :--- | :--- | :--- | :--- |
| Inserir medicamento repetido | Verificar unicidade ao cadastrar uma posologia | O medicamento deve ficar não selecionável ou sumir da lista de posologia | Exploratório |
| Inserir medicamento único | Verificar unicidade ao cadastrar uma posologia | A posologia deve ser cadastrada | Unitário |
| Estoque menor que 1 de determinado medicamento | Verificar quantidade no estoque | Medicamento sem quantidade no estoque (menor que 1) não deverá aparecer na lista para cadastro | Exploratório |
| Inserir medicamento com quaisquer campos vazios | Verificar integridade de cadastro | A posologia deve proibir a prescrição | Unitário |
