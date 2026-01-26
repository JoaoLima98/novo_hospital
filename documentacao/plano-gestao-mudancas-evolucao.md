
# Plano de Gestão de Mudanças e Evolução

**Projeto:** Sistema de Fluxo Hospitalar


Este documento formaliza a estratégia para gerenciar a evolução do projeto, garantindo que mudanças sejam tratadas de forma ágil, colaborativa e transparente, refletindo a natureza iterativa do desenvolvimento e utilizando as ferramentas Git e GitHub.

---

## 1. Abordagem de Controle de Mudanças

### 1.1. Priorização e Aprovação de Mudanças

* **Processo de Solicitação:**
    1.  Toda solicitação (seja correção de bug, melhoria ou nova funcionalidade) deve ser registrada como uma **Issue** no GitHub.
    2.  O **Analista de Negócio (AN)** realiza a **Análise de Viabilidade** (conforme definido na atividade *Analisar Negócio*), avaliando o impacto na rotina hospitalar e nos artefatos existentes.

* **Critério de Priorização:**

   As mudanças são ordenadas pelo **Cliente** durante a revisão da iteração e levam em conta o método **MoSCoW**:

   **Must Have (Deve ter):** Obrigatório para a iteração, sem isso a entrega não tem valor.

    **Should Have (Deveria ter):** Importante, mas pode esperar se necessário (tem prioridade secundária).

    **Could Have (Poderia ter):** Desejável se houver tempo/recurso sobrando, (para padrões estéticos apenas).

   **Won't Have (Não terá agora):** Acordado que ficará para um futuro distante.

* **Aprovação:**

    Devem ser consentido com o cliente durante a atividade de *Revisar* e devem ser acordadas as inseções baseado no critérido de priorização acima. Serão inseridas pelo Gerente de Projeto durante a atividade de *Planejar* apenas as selecionadas, como primeira tarefa da iteração.

### 1.2. Lidar com Mudanças Urgentes e Novas Funcionalidades

* **Mudanças Urgentes (Hotfixes):**
    * Caso surja um erro crítico em produção (ex: falha ao salvar uma triagem), o desenvolvimento da Sprint atual é momentaneamente pausado.
    * Uma **issue** é criada detalhando o problema e o que se espera da solução.
    * A correção é implementada e enviada para produção.

* **Novas Funcionalidades Inesperadas:**
    * Demandas do cliente e ajustes devem ser priorizadas.
    * Elas são cadastradas no **Backlog do Produto** no GitHub Projects.
    * No caso de um backlog muito longo e  a mudança seja imprescindível para a entrega atual, o Gerente de Projeto negociará o adiamento de alguma tarefa para não exceder a carga de trabalho da equipe.

---

## 2. Utilização de Ferramentas e Artefatos

### 2.1. Monitoramento e Rastreabilidade

O **GitHub Projects** é a ferramenta que utilizamos para rastrear o ciclo de vida das mudanças. As colunas do quadro refletem o status real do trabalho:

| Status (Coluna) | Descrição e Critérios de Uso | 
| :--- | :--- | 
| **Backlog** | **Fila de espera de onde o time seleciona o que será trabalhado a seguir.**<br>Deve ser utilizado quando o item ainda **não** tem as seguintes métricas definidas:<br>• Pontos estimados<br>• Prioridade<br>• Tamanho<br>• Iteração | 
| **Ready** | **Fila de espera de quando o item já foi analisado e já está pronto para ser iniciado.**<br>Deve ser utilizado quando o item **já possui** as seguintes métricas definidas:<br>• Pontos estimados<br>• Prioridade<br>• Tamanho<br>• Iteração | 
| **In progress** | **Cartão para quando o item está sendo ativamente trabalhado e ainda não concluído.**<br>Deve ser utilizado para itens já iniciados pelo seu responsável. | 
| **Review** | **Cartão para quando o item já foi finalizado e está esperando a revisão do cliente.**<br>• Deve ser utilizado para itens já finalizados.<br>• Após esta fase o item pode ser reiterado ou, caso seja aceito, vai para o próximo cartão. | 
| **Done** | **Cartão para quando o item já foi aceito pelo cliente.**<br>• Deve ser utilizado para itens aceitos.<br>• Itens desta fase não devem ser mexidos para qualquer outra fase.<br>• Em caso de alteração necessária, um novo item deve ser criado, não alterado deste cartão. |


### 2.2. Versionamento e Consistência (Git/GitHub)

Para garantir a organização do código, o rastreamento do histórico e o isolamento de novas funcionalidades sem comprometer a estabilidade do sistema, adotamos a seguinte estratégia:

-   **Estratégia de Branching:** No início, todas as alterações eram feitas diretamente na branch *develop*, contudo, visando a segurança nas atualizações, passamos a criar branches específicas: 
    
    -   `feature/nome-da-funcionalidade`: Para o desenvolvimento de novos recursos.
        
    -   `fix/nome-do-erro`: Para a correção de bugs.
        
    -   `main`: Branch de produção e documentação. Devido à ausência de ambiente de homologação, as branches de desenvolvimento são testadas localmente e mescladas na _main_ quando funcionais. (No caso da documentação, como não tem efeitos colaterais igual alterações no código, optamos por atualizar diretamente na branch _main_).

-   **Estratégia de Issue:** A issue deve informar exatamente o que deve ser realizada na tarefa com as informações mínimas para executá-la. O título das issue deve seguir o padrão *tipo/funcionalidade* como nos exemplos abaixo.
    
    -   `feature/nome-da-feature`        
    -   `fix/nome-do-ajuste`
        
-   **Estratégia de Milestone:** Os Milestones devem demonstrar a versão do produto e o objetivo da iteração de maneira objetiva como nos exemplos abaixo.
    -   `V1.0: Adição da funcionalidade x`        
    -   `V1.1: juste da funcionalidade x e adição da funcionalidade y`

        
-   **Versionamento de Documentos:** O GitHub garante o controle de versão dos artefatos. No entanto, documentos vivos como [Documento de Requisitos](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/documento-de-requisitos.md) e o [Documento de Especificação de Requisitos](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/documento-de-especificacao-de-requisitos.md) seguem regras manuais de registro:
    
    -   **Alterações de Conteúdo:** Incremento de **0.1** na versão (ex: de 1.0 para 1.1).
        
    -   **Ajustes Menores:** Incremento de **0.0.1** na versão (ex: de 1.1 para 1.1.1).
        
-   **Padrão de Commits:** Para manter a consistência e o entendimento da equipe:
    
    -   A mensagem deve **SEMPRE** descrever objetivamente o que a alteração realiza.
        
    -   O commit deve **SEMPRE** estar atribuído/vinculado a uma Issue correspondente.
        
    -   _Exceção:_ Alterações realizadas apenas em documentos de processo não exigem vínculo com Issues.
---

## 3. Comunicação e Adaptação

### 3.1. Documentação do Histórico de Decisões

* **Registro:** As discussões e decisões sobre mudanças ficam registradas nos **Comentários das Issues** no GitHub Projects. Decisões arquiteturais de grande impacto devem ser atualizadas na documentação.
* **Sincronização:** A documentação é tratada como parte do software. Uma mudança exige reavaliação dos artefatos relacionados (Diagramas, Especificações de Caso de Uso).

### 3.2. Comunicação e Adaptação da Equipe

* **Rituais de Comunicação:**
    * As mudanças planejadas são comunicadas no início de cada Sprint logo após a revisão.
    * Mudanças emergenciais são comunicadas não só através das **issues**, mas imediatamente via canais de mensagem da equipe.

* **Adaptação:**
    * A equipe revisa o fluxo de trabalho periodicamente. Se o processo de mudança estiver burocrático ou falho, ele será ajustado na documentação de *Processos* para garantir a melhoria contínua.
