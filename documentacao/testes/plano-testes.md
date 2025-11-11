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
