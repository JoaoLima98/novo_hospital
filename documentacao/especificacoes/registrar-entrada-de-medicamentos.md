# Caso de Uso: Registrar Entrada de medicamentos
## 1. Atores

- Farmacêutico.

## 2. Pré-condições

- O ator deve estar autenticado com o nível de acesso de farmacêutico

## 3. Fluxo Principal (Caminho Feliz)

### a) Acontecimento 1º

1. O Ator entra na aba de Estoque de remédios.
2. O Ator visualiza os lotes (lote é uma quantidade específica de um produto fabricado em um único ciclo de produção) de remédios disponíveis.
3. O Ator pressiona o botão "Cadastrar novo lote"
4. O Ator seleciona o medicamento e a quantidade.
5. O Ator pressiona um botão de "Cadastrar Lote" ou "Confirmar"
6. Um modal de confirmação é apresentado com o nome do medicamento e a quantidade que o ator descreveu, para  que possa confirmar ou cancelar.
7. O ator confirma e o lote é cadastrado.

## 4. Fluxos Alternativos (Exceções)

### 4.1 Lote com quantidade negativa

- O ator não deve poder inserir um número menor que 1.

### 4.2 Cancelamento da operação

- No momento da confirmação o ator cancela, o modal é fechado e o sistema reapresenta o cadastro do lote.

### 4.3 Campo medicamento obrigatório

- O ator tenta cadastrar um lote sem nome. O sistema informa que o campo de medicamento é obrigatório


### 4.4 Campo quantidade obrigatório

- O ator tenta cadastrar um lote sem uma quantidade. O sistema informa que a quantidade é inválida.
  
## 5. Pós-condições

-  **Sucesso:** O novo lote é cadastrado no banco de dados e apresentado na lista de estoque.

-  **Falha:** O estoque se mantém no estado anterior, não é adicionado nenhum lote de medicamentos.

## 6. Cenários de Teste
| DADO | COMPORTAMENTO | RESULTADO  | TIPO |
| :--- | :--- | :--- | :--- |
| Inserir um lote de remédio com quantidade negativa ou campo quantidade vazio | Verificar integridade ao cadastrar lote | Exceção com mensagem: "Quantidade inválida." | Unitário |
| Inserir lote sem medicamento | Verificar integridade ao cadastrar lote | o sistema deve apresentar uma mensagem informando que o campo é obrigatório. | Unitário |
| Cancelar operação de cadastro de lotes | Verificar integridade ao cadastrar lote | O estoque se mantém no estado anterior, não é adicionado nenhum lote de medicamentos. | Exploratório baseado em cenário |
