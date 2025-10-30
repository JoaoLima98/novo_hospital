# Plano de Testes - Módulos de Farmácia e Médico

## Objetivo
Garantir que o fluxo de atendimento ao paciente — desde a prescrição médica até a entrega dos medicamentos — ocorra de forma correta, sem inconsistências ou falhas no controle de estoque e prescrições.

## Escopo
Os testes cobrem os módulos:
- **Farmácia:** gerenciamento de prescrições, guias, pacientes e controle de estoque.
- **Médico:** emissão e atualização de prescrições e interação com o estoque.

## Estratégia
Serão utilizados testes **automatizados de feature** com PHPUnit, validando as interações entre controladores, modelos e views.  
A técnica adotada será a **caixa-preta funcional**, verificando o comportamento do sistema com base em entradas e saídas esperadas.

## Técnicas Utilizadas
- **Testes de Integração:** validação da comunicação entre controladores, modelos e views.  
- **Testes Funcionais:** simulação de requisições HTTP (GET/POST) para verificar o fluxo real do sistema.  
- **Testes de Banco de Dados:** uso do `RefreshDatabase` para garantir isolamento entre os testes.

## Indicadores
- Cobertura de testes: definir meta (ex: 80%).  
- Taxa de sucesso: quantidade de testes que passam / total de testes executados.  
- Taxa de falha: quantidade de testes que não passam / total de testes executados.  
- Execução do Caminho Feliz: validação do fluxo completo sem erros.

---

## Casos de Teste - FarmaciaController

### 1. `test_index_returns_view_with_pacientes`
**Objetivo:** garantir que a página inicial da farmácia exibe a lista de pacientes.  
**Entrada:** requisição GET para `farmacia`.  
**Saída esperada:** status 200, view `Farmacia.indexFarmacia` e variável `pacientes`.

---

### 2. `test_entregar_medicamentos_returns_view_with_pacientes`
**Objetivo:** validar o carregamento da tela de entrega de medicamentos.  
**Entrada:** GET `entregar.medicamentos`.  
**Saída esperada:** status 200, view `Farmacia.indexFarmacia` e variável `pacientes`.

---

### 3. `test_buscarGuia_with_valid_id_paciente_returns_prescricao`
**Objetivo:** buscar prescrições por ID do paciente.  
**Entrada:** GET `guia.buscar` com `id_paciente`.  
**Saída esperada:** view contém `prescricao`.

---

### 4. `test_buscarGuia_with_valid_guia_returns_prescricao`
**Objetivo:** buscar guia por número da prescrição.  
**Entrada:** GET `guia.buscar` com `guia`.  
**Saída esperada:** view contém `prescricao`.

---

### 5. `test_buscarGuia_with_invalid_data_returns_warning`
**Objetivo:** verificar comportamento quando o paciente ou guia não existem.  
**Entrada:** GET `guia.buscar` com IDs inválidos.  
**Saída esperada:** view contém `prescricao = null`.

---

### 6. `test_painelGuias_returns_initial_view`
**Objetivo:** abrir painel inicial de guias sem filtros.  
**Entrada:** GET `painel.guias`.  
**Saída esperada:** view `Farmacia.buscarGuiasPaciente`, com `ultimasGuias` e `pacienteSelecionado` nulos.

---

### 7. `test_consultarGuias_with_valid_patient_returns_ultimas_guias`
**Objetivo:** listar prescrições de um paciente existente.  
**Entrada:** GET `consultar.guias` com `id_paciente` válido.  
**Saída esperada:** view contém `ultimasGuias` e `pacienteSelecionado`.

---

### 8. `test_consultarGuias_with_invalid_patient_returns_error`
**Objetivo:** validar mensagem de erro para paciente inexistente.  
**Entrada:** GET `consultar.guias` com ID inválido.  
**Saída esperada:** redirecionamento e sessão `error`.

---

### 9. `test_consultarEstoque_returns_estoque_data`
**Objetivo:** verificar exibição dos dados de estoque.  
**Entrada:** GET `consultar.estoque`.  
**Saída esperada:** view `Farmacia.checarEstoque` com variável `estoques`.

---

### 10. `test_criarLote_returns_remedios`
**Objetivo:** garantir que a tela de criação de lote lista os remédios disponíveis.  
**Entrada:** GET `criar.lote`.  
**Saída esperada:** view `Estoque.criarLote` com `remedios`.

---

### 11. `test_storeLote_creates_new_estoque`
**Objetivo:** validar o cadastro de novos lotes no estoque.  
**Entrada:** POST `lote.store` com `id_remedio` e `quantidade`.  
**Saída esperada:** redirecionamento, sessão `success` e registro salvo na tabela `estoques`.

---

## Casos de Teste - MedicoController

### 1. `test_index_returns_view_with_pacientes_and_remedios`
**Objetivo:** verificar se a página inicial do médico carrega pacientes e remédios.  
**Entrada:** GET `medico`.  
**Saída esperada:** status 200, view `welcome`, com `pacientes` e `remedios`.

---

### 2. `test_marcarPrescricaoAtendida_with_valid_prescricao_and_stock_updates_estoque`
**Objetivo:** validar a marcação de prescrição como atendida e atualização do estoque.  
**Entrada:** POST `marcar.prescricao.atendida` com ID válido.  
**Saída esperada:**  
- Prescrição marcada como atendida.  
- Estoque decrementado corretamente.  
- Sessão `success` com mensagem.

---

### 3. `test_marcarPrescricaoAtendida_with_insufficient_stock_returns_error`
**Objetivo:** verificar erro quando o estoque é insuficiente.  
**Entrada:** POST `marcar.prescricao.atendida` com estoque zerado.  
**Saída esperada:** sessão `error` informando falta de estoque e prescrição não atendida.

---

### 4. `test_marcarPrescricaoAtendida_with_nonexistent_prescricao_returns_error`
**Objetivo:** verificar erro para prescrição inexistente.  
**Entrada:** POST `marcar.prescricao.atendida` com ID inválido.  
**Saída esperada:** redirecionamento e sessão `error` informando “Prescrição não encontrada”.

---

## Critérios de Aceitação
- Todos os testes devem retornar **status HTTP esperado (200 ou redirect)**.  
- As **views e variáveis de sessão** devem estar corretas conforme cada cenário.  
- Nenhum teste deve alterar o banco fora do contexto isolado de teste.  
- O sistema deve manter consistência entre **prescrições, pacientes e estoque**.

---

## Ferramentas e Ambiente
- **Framework:** Laravel 11  
- **Test Runner:** PHPUnit  
- **Banco de Teste:** SQLite in-memory  
- **Isolamento:** `use RefreshDatabase`  
- **Execução:** `php artisan test`  

---

## Conclusão
Com esses testes, será possível validar o fluxo completo entre os módulos Médico e Farmácia, garantindo integridade dos dados, comportamento correto das views e mensagens adequadas de sucesso e erro.
