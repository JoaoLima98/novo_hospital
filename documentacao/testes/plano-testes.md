# Plano de Testes - Módulos de Farmácia e Médico

## Objetivo
Garantir que o fluxo de atendimento ao paciente — desde a prescrição médica até a entrega dos medicamentos — ocorra de forma correta, sem inconsistências ou falhas no controle de estoque e prescrições.

## Escopo
Os testes cobrem os módulos:
- **Farmácia:** gerenciamento de prescrições, guias, pacientes e controle de estoque.  
- **Médico:** emissão e atualização de prescrições e interação com o estoque.

## Estratégia
Serão utilizados testes **automatizados de feature** com PHPUnit, validando as interações entre controladores, modelos e views.  

---
## Técnica
- A técnica adotada será a **caixa-preta funcional**, verificando o comportamento do sistema com base em entradas e saídas esperadas.
---


## Casos de Teste - FarmaciaController
| DADO | COMPORTAMENTO | RESULTADO | ESPECIFICAÇÃO |
| :--- | :--- | :--- | :--- |
| Inserir um lote de remédio com quantidade negativa | Verificar integridade ao cadastrar lote | Exceção com mensagem: "Não é permitido cadastrar com número negativo." | Gerenciar Estoque de Medicamentos |
| Buscar guia médica com ID de paciente válido | Verificar retorno de prescrição existente | View guia.buscar é renderizada com prescrição correta associada ao paciente | Gerenciar Estoque de Medicamentos |
| Buscar guia médica com ID de paciente inexistente | Verificar tratamento de erro ao buscar guia | Exceção com mensagem: "Paciente não encontrado." | Gerenciar Estoque de Medicamentos |
| Marcar prescrição atendida com estoque suficiente | Verificar atualização de estoque e status da prescrição | Estoque reduzido corretamente e mensagem: "Prescrição atendida com sucesso!" | Gerenciar Estoque de Medicamentos |
| Marcar prescrição atendida com estoque insuficiente | Verificar integridade no controle de estoque | Mensagem de erro: "Estoque insuficiente para o remédio ID X" e guia não será atendida | Gerenciar Estoque de Medicamentos |
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
## Indicadores
- **Cobertura esperada:** mínimo de 80% das rotas e fluxos principais testados.  
- **Tempo médio de execução:** inferior a 5 segundos por suite.  
- **Falhas toleradas:** 0 falhas críticas (erros que comprometem prescrições ou estoque).  
- **Taxa de sucesso:** 100% dos testes unitários e de feature devem passar antes de cada deploy.
---

## Conclusão
Com esses testes, será possível validar o fluxo completo entre os módulos Médico e Farmácia, garantindo integridade dos dados, comportamento correto das views e mensagens adequadas de sucesso e erro.
