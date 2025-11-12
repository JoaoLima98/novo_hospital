# Caso de Uso: Gerenciar Estoque de Medicamentos
## 1. Atores

- Farmacêutico.

## 2. Pré-condições

- Encaminhamento da prescrição médica.

## 3. Fluxo Principal (Caminho Feliz)

### a) Acontecimento 1º
1. O Ator entra na aba de Estoque de remédios.
2. O Ator visualiza os remédios disponíveis.
3. O Ator pode lote inserindo medicamento disponível e informando a quantidade acrescentada ao lote.

### b) Acontecimento 2º

1. O Ator pode acessar a aba consultar guia.
2. O Ator seleciona um paciente.
3. O sistema apresenta as guias abertas e fechadas daquele determinado paciente.

### c) Acontecimento 3º

1. O ator acessa a aba Entregar Medicamentos.
2. O Ator procura a guia do paciente.
3. O Ator seleciona os medicamentos que serão entregues.
4. O Ator confirma a entrega dos medicamentos.
5. O sistema informa que os medicamentos foram entregues e atualiza o estoque.
6. O sistema informa a quantidade de medicamentos dos mesmos que foram entregues e quantos ainda sobram.

## 4. Fluxos Alternativos (Exceções)

### 4.1a Lote com quantidade negativa

- O ator não deve poder inserir um número menor que 1.

### 4.1b Paciente inexistente

- O ator não deve poder buscar um paciente que não está cadastrado no sistema.

### 4.1c Falta de medicamento

- O sistema entregará somente os medicamentos que tem na guia e estão disponíveis. Os que estiverem em falta, não serão entregues e a guia será atualizada (guia_atendida = True).
  

### 4.2c Se a guia já foi atendida

- Se a guia já foi atendida, uma mensagem é informado "Esta guia já foi atendida!" e não será possível entregar medicamentos para esta guia novamente.

  

## 5. Pós-condições

-  **Sucesso:** O farmacêutico repassa os medicamentos e uma mensagem de sucesso é apresentada.

-  **Falha:** O sistema permanece no estado anterior. A guia se mantém para ser atualizada.

## 6. Cenários de Teste
| DADO | COMPORTAMENTO | RESULTADO  | TIPO |
| :--- | :--- | :--- | :--- |
| Inserir um lote de remédio com quantidade negativa | Verificar integridade ao cadastrar lote | Exceção com mensagem: "Quantidade inválida." | Unitário |
| Buscar guia médica com ID de paciente válido | Verificar retorno de prescrição existente | Apresentada prescrição correta associada ao paciente |  Unitário |
| Buscar guia médica com ID de paciente inexistente | Verificar tratamento de erro ao buscar guia | Exceção com mensagem: "Paciente não encontrado." |  Unitário |
| Marcar prescrição atendida com estoque suficiente | Verificar atualização de estoque e status da prescrição | Estoque reduzido corretamente e mensagem: "Prescrição atendida com sucesso!" |  Unitário |
| Marcar prescrição atendida com estoque insuficiente | Verificar integridade no controle de estoque | A checkbox dos medicamentos em falta ficarão indisponíveis para marcar | Exploratório baseado em cenários |
| Atender guia já atendida | Verificar retorno de prescrição existente | Mensagem de erro: "Esta guia já foi atendida!" | Exploratório baseado em cenários| retorno de prescrição existente | Mensagem de erro: "Esta guia já foi atendida!" | Gerenciar Estoque de Medicamentos | Exploratório baseado em cenários|
