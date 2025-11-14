# Caso de Uso: Prescrever Medicamento

## 1. Atores
 - Médico
## 2. Pré-condições

 - Estar logado no sistema com o nível de acesso de médico
   
## 3. Fluxo Principal

### a) Nova posologia
1. O ator acessa o sistema a partir do login de nível médico;
2. O sistema apresenta a tela com a opção de buscar um paciente;
3. Ao escolher o paciente, o ator poderá adicionar uma posologia;
4. Ao selecionar adicionar posologia, o sistema irá apresentar um modal da posologia;
5. O modal para adicionar uma nova posologia deve apresentar os medicamentos disponíveis (ibuprofeno, amoxilina, etc...) , quantidade (1/2, 1, 2, 30 ...) , unidade (comprimido, gotas, sachê) em formato de select, intervalo entre o medicamento em horas (6, 8 , 12...) e a duração em horas (24, 48, 72, 120);
   como no esboço abaixo:
   <img width="1000" height="574" alt="image" src="https://github.com/user-attachments/assets/3a5116e8-a131-45ad-9308-3983e0ae85ef" />


### b) Edição e remoção de posologia
1. Depois de criado a posologia, o sistema irá apresentar um botão amarelo para edição e um vermelho para remoção da posologia, com ícones que representem estas ações;
2. Ao selecionar a edição, o modal deve apresentar as opções demonstradas acima já com as opções que foram selecionadas;
3. Ao selecionar a exclusão, apenas aquela posologia excluída deve desaparecer.

## 4. Fluxos Alternativos (Exceções)

### 4.1 Medicamento repetido
- O médico não deve poder cadastrar uma posologia de um medicamento repetido, o medicamento deve ficar não selecionável ou sumir da lista de posologia;

### 4.2 Medicamentos disponíveis
- Os medicamentos só devem aparecer na lista de posologia, se tiverem disponibilidade no estoque maior que 0;

## 5. Pós-condições
- **Sucesso:** Prescrição é criada e encaminhada para atendimento pelo farmacêutico.
- **Falha:** Prescrição não pode ser criada.

## 6. Cenários de testes

| DADO | COMPORTAMENTO | RESULTADO | TIPO |
| :--- | :--- | :--- | :--- |
| Inserir medicamento repetido | Verificar unicidade ao cadastrar uma posologia | O medicamento deve ficar não selecionável ou sumir da lista de posologia | Exploratório |
| Inserir medicamento único | Verificar unicidade ao cadastrar uma posologia | A posologia deve ser cadastrada | Unitário |
| Estoque menor que 1 de determinado medicamento | Verificar quantidade no estoque | Medicamento sem quantidade no estoque (menor que 1) não deverá aparecer na lista para cadastro | Exploratório |
