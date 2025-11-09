# Caso de Uso: Gerenciar Estoque de Medicamentos
## 1. Atores

- Farmacêutico.

## 2. Pré-condições

- Encaminhamento da prescrição médica.

## 3. Fluxo Principal (Caminho Feliz)

### a) Acontecimento 1º

1. O farmacêutico consulta a guia do paciente.
2. O farmacêutico seleciona os medicamentos que serão entregues.
3. O  farmacêutico confirma a entrega dos medicamentos.
4. O sistema informa que os medicamentos foram entregues e atualiza o estoque.
5. O sistema informa a quantidade de medicamentos dos mesmos que foram entregues e quantos ainda sobram.

## 4. Fluxos Alternativos (Exceções)

### 4.1 Falta de medicamento

- O sistema entregará somente os medicamentos que tem na guia. Os que estiverem em falta, não serão entregues e a guia será atualizada (guia_atendida = True).
  

### 4.2 Se a guia já foi atendida

- Se a guia já foi atendida, uma mensagem é informado "Esta guia já foi atendida!" e não será possível entregar medicamentos.

  

## 5. Pós-condições

-  **Sucesso:** O farmacêutico repassa os medicamentos e uma mensagem de sucesso é apresentada.

-  **Falha:** O sistema permanece no estado anterior. A guia se mantém para ser atualizada.