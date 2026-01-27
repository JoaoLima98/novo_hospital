# Plano de Gerenciamento do Projeto (PGP)

**Projeto:** Sistema de Fluxo Hospitalar

**Discentes:** João de Azevedo Lima Neto, Jocian Douglas Sousa Carneiro

**Data:** [04/11/2025]

---

### Registro de Alterações:

| Versão | Responsável | Data | Alterações |
| :--- | :--- | :--- | :--- |
| 0.1 | João de Azevedo Lima Neto | 04/11/2025 | Criação do documento |
| 0.2 | João de Azevedo Lima Neto, Jocian Douglas Sousa Carneiro | 06/11/2025 | Adicionados Gantt e esboço EAP |
| 1.0 | João de Azevedo Lima Neto, Jocian Douglas Sousa Carneiro | 08/11/2025 | Adicionadas estimativas de esforços e custo |
| 1.1 | João de Azevedo Lima Neto, Jocian Douglas Sousa Carneiro | 09/11/2025 | Atualizado diagrama de atividade do projeto para refletir melhor o processo atual |
| 1.2 | João de Azevedo Lima Neto | 14/11/2025 | Adicionado novo milestone (Marco) |
| 1.3 | João de Azevedo Lima Neto | 28/11/2025 | Adicionado Burndown |
| 1.4 | João de Azevedo Lima Neto | 09/12/2025 | Ajuste no EAP e nas descrições do documento segundo orientações do Cliente/Professor Maurício |


## 1. EAP - Estrutura Analítica do Projeto

#### Ferramenta de gerenciamento que quebra o projeto em partes menores e gerenciáveis para planejamento e controle.

<img width="4109" height="1217" alt="Diagrama caso de uso Triagem Hospitalar - EAP (1)" src="https://github.com/user-attachments/assets/1173b951-c804-44df-8976-e5d45c060029" />


## Descrição do EAP

### 1. Gestão

-   **Mudança:** Previsão de fatores que interferem positivamente para o crescimento do projeto

    -   **Evolução:** Trata-se do crescimento do produto. Inclui a adição de novas funcionalidades que desenvolvem o produto.
        
    -   **Adaptação:** Trata-se da manutenção e ajuste do produto para incluir novas funcionalidades que forem solicitados e não faziam parte no escopo inicial.

-   **Risco:** Previsão de possíveis complicações associadas a execução do projeto e ao produto.

-   **Estimativas:** Previsão dos recursos necessários.
    
    -   **Esforço:** O volume de trabalho necessário.
        
    -   **Custos:** O valor financeiro total do projeto.

### 2. Planejamento

Esta fase define a estrutura, o escopo e os recursos necessários para o projeto.

-   **Definição de Processos:** Mapeamento de como o trabalho será executado.
    
    -   **Processo:** O fluxo de trabalho principal.
        
    -   **Atividades:** Tarefas específicas que compõem o processo.
        
    -   **Artefatos:** Produtos ou documentos gerados.
        
    -   **Papéis:** Responsabilidades da equipe no projeto.
        
-   **Documento de Requisitos:** Definição das funcionalidades e especificações técnicas que o sistema deve ter.
        

----------

### 3. Desenvolvimento

A fase de construção e codificação do sistema.

-   **Frontend:** A interface visual do sistema com a qual o usuário interage.
    
-   **Backend:** A lógica de negócios e o processamento de dados do sistema, executado no servidor.
    
-   **Banco de Dados:** O sistema de armazenamento e gerenciamento de todas as informações do hospital.
    

----------

### 4. Testes

A fase de garantia de qualidade para verificar o funcionamento do sistema e corrigir falhas.

-   **Unitários:** Verificação isolada das menores partes do código.
    
-   **Caixa Branca:** Testes baseados no conhecimento da estrutura interna do código.
    
-   **Documentos:** Criação da documentação formal de teste.
    
    -   **Plano de Teste:** Documento que define a estratégia de teste.
        
    -   **Cenário de Testes:** Descrição das situações específicas a serem testadas.
        
    -   **Relatório de Teste:** Documento final que resume os resultados dos testes.

---

## 2. Cronograma - (Gantt)

#### Ferramenta de visualização do projeto ao longo do tempo.

[Gráfico GANTT](https://app.clickup.com/90132624030/v/g/2ky55cmy-613)

| Marco (Milestone) | Data Prevista |
| :--- | :--- |
| Primeira entrega avaliativa | 12/11/2025 |
| Prévia da 2ª etapa | 17/12/2025 - Adiantado para dia 10/12/2025 |

## 3. Diagrama de Atividades do Projeto

#### Representação visual do fluxo de trabalho, mostrando a sequência lógica e as decisões necessárias para a execução da iteração.

<img width="1810" height="1691" alt="Diagrama de atividade do projeto" src="https://github.com/user-attachments/assets/04012608-8680-41c1-97e0-3334ed4a92c4" />


---

## 4. Estimativas de Esforço e Custo

#### Previsão detalhada do volume de trabalho e do valor financeiro (R$) total necessário.

### 4.1. Estimativa de Esforço
| Pacote de Trabalho (EAP) | Estimativa (Horas) | Recursos Alocados |
| :--- | :--- | :--- |
| Definição dos processos (Papéis, Artefatos e Atividades) | 8h | Gerente de Projeto|
| Levantamento de Requisitos | 8h | Analista de Negócio |
| Estimar esforço e custo | 8h | Gerente de Projeto |
| Desenvolvimento Backend e Banco de Dados | 60h | Desenvolvedor|
| Desenvolvimento Frontend | 50h | Desenvolvedor |
| Testes Unitários | 6h | Desenvolvedor|
| Testes Caixa Branca| 6h | Analista de Negócio|
| Documentação dos Testes | 4h | Analista de Negócio |
| Total Estimado | 150h | |

### 4.2. Estimativa de Custo
| Categoria de Custo                       | Estimativa (R$) | Justificativa / Descrição                                                                 |
|------------------------------------------|-----------------|--------------------------------------------------------------------------------------------|
| Desenvolvedor (R$ 50/h × 116h)           | R$ 5.800,00     | Custo total das horas de backend, frontend e testes unitários                              |
| Gerente de Projeto (R$ 80/h × 16h)       | R$ 1.280,00     | Custo total das horas de definição de processos e estimativa de esforço/custo              |
| Analista de Negócio (R$ 65/h × 18h)      | R$ 1.170,00     | Custo total das horas de levantamento, testes caixa branca e documentação                  |
| Hospedagem                               | R$ 350,00       | Hostinger (plano anual compartilhado)                                                      |
| Domínio                                  | R$ 50,00        | Registro de domínio anual (.com ou .com.br)                                                |
| Ferramentas e Licenças                   | R$ 200,00       | Softwares de apoio (Clickup, VS Code extensões pagas)                            |
| **Total Estimado**                       | **R$ 8.850,00** | **Soma das estimativas de custo acima**   

## 5. Gráfico de burndown

#### Gráfico utilizado para acompanhar o trabalho restante versus o tempo, permitindo visualizar o progresso e a capacidade de entrega.

**[Gráfico de burndown](https://docs.google.com/spreadsheets/d/19c3hjhCZ2GJSnl3DyycGhQG0LLYjL1Az5o6ZRBHQJzI/edit?usp=sharing)**


## 6. Gerenciamento de risco

#### Processo de identificação, análise, e planejamento de respostas para eventos incertos que podem afetar negativamente os objetivos do projeto.

| Risco Identificado | Probabilidade | Impacto | Prevenção | Plano de Ação |
|--------------------|--------------|---------|-------------------------|---------------------------------------|
| **1. Resistência à Adoção** (Atores recusam o sistema por costume com trabalho manual em papel) | Alta | Alto | • Treinamento prático focado em como o sistema facilita o trabalho. <br> • Telas simples e intuitivas (prescrição e estoque). <br> • Usuários-padrinhos como multiplicadores. | • Período híbrido (papel + sistema). <br> • Suporte de TI intensificado nas primeiras semanas. <br> • Coleta diária de feedback e ajustes rápidos na interface. |
| **2. Divergência de Estoque** (Estoque físico ≠ sistema) | Média | Alto | • Conferência dupla na entrada de notas/lotes. <br> • Inventário rotativo frequente. <br> • Validação automática para impedir baixa maior que o saldo. | • Bloqueio do lote divergente. <br> • Inventário emergencial da área afetada. <br> • Ajuste de saldo com auditoria obrigatória. |
| **3. Falha na Conectividade/Servidor** (Sistema fora do ar no hospital) | Média | Alto | • Monitoramento proativo de desempenho e quedas. <br> • Hospedagem robusta + backup diário. <br> • Revisão periódica do desempenho do banco (MySQL). | • Ativar plano de contingência em papel. <br> • Comunicar imediatamente os setores afetados. <br> • Sincronizar dados pendentes após o retorno. |
| **4. Erro de Dispensa de Medicação** (Medicamento incorreto entregue) | Baixa | Crítico | • Trava lógica conferindo se a prescrição foi atendida. <br> • Tela de confirmação dupla. <br> • Alertas visuais para medicamentos de alta vigilância. | • Ativar protocolo de risco hospitalar. <br> • Rastrear logs e notificar o farmacêutico. <br> • Reverter a baixa de estoque imediatamente. |

