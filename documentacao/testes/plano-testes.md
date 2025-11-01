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

---

## Casos de Teste - FarmaciaController

### 1. `test_index_returns_view_with_pacientes`
**Objetivo:** garantir que a página inicial da farmácia exibe a lista de pacientes.  
**Entrada:** requisição GET para `farmacia`.  
**Saída esperada:** status 200, view `Farmacia.indexFarmacia` e variável `pacientes`.

---

### 2. `test_buscarGuia_with_valid_id_paciente_returns_prescricao`
**Objetivo:** buscar prescrições por ID do paciente.  
**Entrada:** GET `guia.buscar` com `id_paciente`.  
**Saída esperada:** view contém `prescricao`.

---

### 3. `test_storeLote_creates_new_estoque`
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
## Métricas e Eficiência dos Testes
- **Cobertura esperada:** mínimo de 80% das rotas e fluxos principais testados.  
- **Tempo médio de execução:** inferior a 5 segundos por suite.  
- **Falhas toleradas:** 0 falhas críticas (erros que comprometem prescrições ou estoque).  
- **Taxa de sucesso:** 100% dos testes unitários e de feature devem passar antes de cada deploy.
---

## Conclusão
Com esses testes, será possível validar o fluxo completo entre os módulos Médico e Farmácia, garantindo integridade dos dados, comportamento correto das views e mensagens adequadas de sucesso e erro.
