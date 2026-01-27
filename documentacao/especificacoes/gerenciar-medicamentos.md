
# Caso de Uso: Inserir medicamento

## 1. Atores

 - Farmacêutico
 
## 2. Pré-condições

 - Sistema funcional e operante.
 - Estar em uma sessão com o nível de acesso de farmacêutico
 
## 3. Fluxo Principal

### a) Acontecimento 1º - Inserção

1. O sistema apresenta as abas de acesso.
2. O ator seleciona a aba medicamentos
3. O sistema apresenta a lista de medicamentos do banco de dados
4. O ator pode adicionar um novo medicamento.
5. Ao pressionar um botão de adicionar medicamento, um modal deve aparecer para o ator preencher nome do medicamento e seu valor de alerta, para [Disparar Alerta](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/disparar-alerta-falta-medicamento.md#caso-de-uso-disparar-alerta-de-falta-de-medicamentos).
<img width="443" height="388" alt="image" src="https://github.com/user-attachments/assets/cb106bf3-b5ef-4690-b2fe-f5b422671da7" />

6. Ao confirmar o medicamento será inserido no banco de dados e aparecerá na lista.

### b) Acontecimento 2º - Edição e Exclusão
1. O sistema apresentará a lista de medicamentos, e o ator poderá alterar o valor de alerta apenas, não poderá ser alterado o nome do medicamento.
2. No card do medicamento terá uma opção de deletar aquele medicamento.
   
<img width="589" height="262" alt="image" src="https://github.com/user-attachments/assets/9b5c54c7-b12f-467c-8eb6-97ba74021cdb" />

3. Ao selecionar o botão de apagar, um modal para confirmação deve aparecer.
4. Ao confirmar, o medicamento deve desaparecer da lista e do banco de dados.

## 4. Fluxos Alternativos (Exceções)

### 4.1 Nome de medicamento repetido
- O nome de um medicamento deverá ser único, ao inserir um medicamento com o mesmo nome, o sistema deve bloquear a criação e informar: "Este medicamento já existe".

### 4.2 Valor de alerta não pode ser abaixo de 5
- O valor de alerta não pode ser abaixo de 5.

### 4.3 Deletar medicamento com estoque positivo
- O sistema deve proibir deletar um medicamento com estoque positivo, se o ator tentar a mensagem similar a seguinte deve ser informada: "Medicamento ainda tem unidades em estoque, remoção não autorizada".

### 4.4 Cancelar Modal
- Ao cancelar o modal, o medicamento não será inserido, e o sistema retornará a lista dos medicamentos.

## 5. Pós-condições
- **Sucesso:** O medicamento será inserido no banco de dados e aparecerá na lista.
- **Falha:** O medicamento não será inserido, e o sistema retornará a lista dos medicamentos.

## 6. Cenários de testes

| DADO | COMPORTAMENTO | RESULTADO | TIPO |
| :--- | :--- | :--- | :--- |
| Inserção de medicamento com nome já existente no banco | Tentar confirmar a criação do medicamento | O sistema deve bloquear a criação e exibir a mensagem: "Este medicamento já existe". | Unitário |
| Inserção/Edição com valor de alerta definido como 4 ou menos | Tentar salvar o medicamento | O sistema deve impedir a confirmação (validação de campo: valor mínimo 5). | Exploratório |
| Medicamento selecionado possui estoque positivo (> 0) | Tentar excluir o medicamento | O sistema deve proibir a exclusão e exibir a mensagem: "Medicamento ainda tem unidades em estoque, remoção não autorizada". | Unitário |
| Cancelar modal de cadastro de medicamento | Garantir que o medicamento não foi inserido | O modal deve fechar, nenhum dado deve ser salvo e o sistema deve retornar à lista de medicamentos. | Exploratório |
