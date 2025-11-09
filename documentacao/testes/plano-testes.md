# Plano de Testes

## Objetivo
Garantir que o fluxo de atendimento ao paciente — desde sua recepção até a entrega dos medicamentos — ocorra de forma correta, sem inconsistências ou falhas, tornando o sistema conciso com sua idealização.

## Escopo
Os testes cobrem os módulos:
- **Autenticação:** Criação de perfis e controle de acesso.
- **Farmácia:** gerenciamento de prescrições, guias, pacientes e controle de estoque.  

## Estratégia
Serão utilizados testes **automatizados de feature** com PHPUnit, validando as interações entre controladores, modelos e views.  

---
## Técnica
- A técnica adotada serão as **caixa-preta**, através do prórpio sistema, e **caixa-branca** através de testes dentro do código (como os testes unitários) verificando o comportamento do sistema com base em entradas e saídas esperadas.
---


## Casos de Teste - Farmacia
| DADO | COMPORTAMENTO | RESULTADO | ESPECIFICAÇÃO | Tipo |
| :--- | :--- | :--- | :--- | :--- |
| Inserir um lote de remédio com quantidade negativa | Verificar integridade ao cadastrar lote | Exceção com mensagem: "Não é permitido cadastrar com número negativo." | Gerenciar Estoque de Medicamentos | Unitário |
| Buscar guia médica com ID de paciente válido | Verificar retorno de prescrição existente | Apresentada prescrição correta associada ao paciente | Gerenciar Estoque de Medicamentos | Unitário |
| Buscar guia médica com ID de paciente inexistente | Verificar tratamento de erro ao buscar guia | Exceção com mensagem: "Paciente não encontrado." | Gerenciar Estoque de Medicamentos | Unitário |
| Marcar prescrição atendida com estoque suficiente | Verificar atualização de estoque e status da prescrição | Estoque reduzido corretamente e mensagem: "Prescrição atendida com sucesso!" | Gerenciar Estoque de Medicamentos | Unitário |
| Marcar prescrição atendida com estoque insuficiente | Verificar integridade no controle de estoque | A checkbox dos medicamentos em falta ficarão indisponíveis para marcar | Gerenciar Estoque de Medicamentos | Exploratório baseado em cenários |
| Atender guia já atendida | Verificar retorno de prescrição existente | Mensagem de erro: "Esta guia já foi atendida!" | Gerenciar Estoque de Medicamentos | Exploratório baseado em cenários|
---

## Critérios de Aceitação
- Todos os testes devem retornar **status HTTP esperado (200 ou redirect)**.  
- As **views e variáveis de sessão** devem estar corretas conforme cada cenário.  
- Nenhum teste deve alterar o banco fora do contexto isolado de teste.  
- O sistema deve manter consistência entre **prescrições e estoque**.

---

## Ferramentas e Ambiente
- **Framework:** Laravel 11  
- **Test Runner:** PHPUnit  
- **Banco de Teste:** MySQL
- **Isolamento:** `use RefreshDatabase`  
- **Execução:** `php artisan test`  

---
## Indicadores
- **Cobertura esperada:** mínimo de 50% das rotas e fluxos principais testados.  
- **Tempo médio de execução:** inferior a 5 segundos por suite.  
- **Falhas toleradas:** 0 falhas críticas (erros que comprometem prescrições ou estoque).  
- **Taxa de sucesso:** 100% dos testes unitários e de feature devem passar antes de cada deploy.
---
