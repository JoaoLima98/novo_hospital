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

## 6. Cenários de Teste
| DADO | COMPORTAMENTO | RESULTADO  | TIPO |
| :--- | :--- | :--- | :--- |
| Inserir um lote de remédio com quantidade negativa | Verificar integridade ao cadastrar lote | Exceção com mensagem: "Não é permitido cadastrar com número negativo." | Unitário |
| Buscar guia médica com ID de paciente válido | Verificar retorno de prescrição existente | Apresentada prescrição correta associada ao paciente |  Unitário |
| Buscar guia médica com ID de paciente inexistente | Verificar tratamento de erro ao buscar guia | Exceção com mensagem: "Paciente não encontrado." |  Unitário |
| Marcar prescrição atendida com estoque suficiente | Verificar atualização de estoque e status da prescrição | Estoque reduzido corretamente e mensagem: "Prescrição atendida com sucesso!" |  Unitário |
| Marcar prescrição atendida com estoque insuficiente | Verificar integridade no controle de estoque | A checkbox dos medicamentos em falta ficarão indisponíveis para marcar | Exploratório baseado em cenários |
| Atender guia já atendida | Verificar retorno de prescrição existente | Mensagem de erro: "Esta guia já foi atendida!" | Exploratório baseado em cenários| retorno de prescrição existente | Mensagem de erro: "Esta guia já foi atendida!" | Gerenciar Estoque de Medicamentos | Exploratório baseado em cenários|
