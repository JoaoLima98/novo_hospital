
# Documento de Requisitos

**Projeto:** Sistema de Fluxo Hospitalar

**Discentes:** João de Azevedo Lima Neto, Jocian Douglas Sousa Carneiro

---

### Registro de Alterações:

| Versão | Responsável | Data | Alterações |
| :--- | :--- | :--- | :--- |
| 0.1 | Johnny Reberty Alves Oliveira | 06/10/2025 | Criação do Documento |
| 0.5 | João de Azevedo Lima Neto, Jocian Douglas Sousa Carneiro | 01/11/2025 | Reorganização e reestruturação do documento, incluindo ajustes nas seções 3 e 4 |
| 0.6 | João de Azevedo Lima Neto| 09/11/2025 | Ajuste nos requisitos funcionais |
| 1.0 | João de Azevedo Lima Neto| 09/11/2025 | Ajustado a seção 3 para conter o minimundo descrito e em forma de diagrama. O diagrama contém apenas o que nosso sistema engloba até o momento |

---

## 1. Introdução

Este documento apresenta os requisitos de usuário da ferramenta Sistema de Fluxo Hospitalar e está organizado da seguinte forma: a seção 2 contém uma descrição do propósito do sistema; a seção 3 contém uma descrição do minimundo apresentando o problema; e a seção 4 apresenta a lista de requisitos de usuário levantados junto ao cliente.

## 2. Descrição do Propósito do Sistema

O presente projeto tem como objetivo o desenvolvimento de um **Sistema de Triagem Hospitalar** destinado a modernizar e otimizar o processo de atendimento de pacientes no hospital municipal da cidade de **São Paulo do Potengi**.

Atualmente, o hospital realiza seus atendimentos de forma manual, exigindo que, a cada nova consulta, seja criada uma ficha física do zero, o que ocasiona lentidão no atendimento, redundância de informações e dificuldade no acompanhamento do histórico clínico dos pacientes.

O sistema proposto visa **centralizar e informatizar o fluxo de triagem hospitalar**, permitindo que todas as etapas — recepção, triagem de enfermagem, atendimento médico e dispensação farmacêutica — sejam integradas em um único registro eletrônico. Dessa forma, cada setor poderá acessar e complementar os dados do paciente de forma sequencial, segura e eficiente, reduzindo o tempo de espera e melhorando a qualidade do atendimento prestado.

Além de informatizar o processo de triagem, o sistema também proporcionará **controle de acesso por perfil profissional**, **acompanhamento do status do paciente em tempo real** e **armazenamento histórico de atendimentos**, garantindo integridade, rastreabilidade e conformidade com as normas de proteção de dados (LGPD).

## 3. Descrição do Minimundo

### 3.1 Minimundo - Descrito

O **Hospital Regional de São Paulo do Potengi** possui um setor de triagem que funciona como a porta de entrada para todos os atendimentos realizados. O processo de atendimento é dividido em **quatro fases distintas**, cada uma executada por profissionais diferentes e interligadas por meio de um único sistema de informação.

Na **Fase 1 – Recepção**, o paciente chega ao hospital e apresenta seu **Cartão SUS** ou **CPF** para o recepcionista poder verificar se já há registro do paciente no sistema, se já houver, ele já pode ser encaminhado para etapa de triagem/enfermagem. Caso não haja registro do paciente, o atendente realiza o **cadastro dos dados pessoais e de contato**, criando um **registro único** no sistema. Esses dados são persistidos no banco de dados e ficam disponíveis para as etapas seguintes do atendimento.

Na **Fase 2 – Enfermagem/Triagem**, o paciente é encaminhado à enfermeira responsável, que acessa o mesmo registro e adiciona **informações clínicas iniciais**, como sintomas relatados, sinais vitais e possíveis alergias. Essas informações complementam o cadastro inicial e são utilizadas na avaliação médica posterior.

Na **Fase 3 – Atendimento Médico**, o médico acessa o registro consolidado do paciente e adiciona **informações do exame clínico**, **diagnóstico** e **prescrição médica**. Após o atendimento, o sistema atualiza o status do paciente e armazena o registro como parte do **histórico de atendimentos**, que poderá ser consultado em visitas futuras.

Por fim, na **Fase 4 – Farmácia**, o farmacêutico visualiza as **prescrições médicas associadas** e realiza o **registro da dispensação de medicamentos**. Ao concluir essa etapa, o atendimento é encerrado e o sistema marca o registro como **finalizado**, mantendo todas as informações armazenadas de forma permanente.

O sistema deve permitir o **acompanhamento em tempo real do status de cada paciente**, desde o momento da chegada até a finalização do atendimento, além de disponibilizar funcionalidades de **consulta de histórico, controle de acesso por função, geração de relatórios gerenciais.** Com sua implantação, o hospital passará a contar com um processo digital e integrado, eliminando as fichas manuais, garantindo maior **agilidade**, **segurança da informação** e **continuidade no acompanhamento médico dos pacientes**, trazendo benefícios tanto para os profissionais de saúde quanto para a população atendida.

Quanto a cada funcionário **(recepcionista, enfermeira, médico e farmacêutico)** cada um terá acesso apenas as suas determinadas fatias do sistema. Ao cadastrar um novo funcionário, o admnistrador deverá selecionar o perfil do profissional que, ao utilizar o sistema, não terá acesso as partes que não os dizem respeito.

---

### 3.2 Minimundo - Diagrama de domínio

<img width="1631" height="1234" alt="Diagrama de dominio-hospital" src="https://github.com/user-attachments/assets/f1d7c6e9-4c85-4277-8885-2a447d5c6675" />

---

## 4. Requisitos de Usuário

Tomando por base o contexto do sistema, foram identificados os seguintes requisitos de usuário


### Requisitos Funcionais

| Identificador | Descrição | Prioridade | Depende de |
| :--- | :--- | :--- | :--- |
| **RF01 - Gerenciar Paciente** | O sistema deve permitir o **cadastro de pacientes** na recepção, incluindo: Cartão SUS, CPF, Endereço, Telefone, Outras informações básicas. | Alta | |
| **RF02 - Acompanhar e Atualizar Registro do Paciente** | Cada setor deve **acessar e complementar** o mesmo registro do paciente:<br>Recepção: dados pessoais e administrativos;<br>Enfermagem: sintomas e informações iniciais da triagem;<br>Médico: exame clínico, diagnóstico e prescrição;<br>Farmacêutico: atende guia do paciente. | Alta | |
| **RF03 - Atualizar Status do Paciente** | O sistema deve **atualizar automaticamente o status** do paciente conforme ele avança nas etapas:<br>Exemplo: “Aguardando atendimento médico → Em atendimento médico → Aguardando medicamentos → Finalizado”. | Alta | RF01 |
| **RF04 - Verificar Histórico do Paciente** | Os atores recepcionista, médico e enfermeira devem poder **consultar todo o histórico de atendimentos anteriores** de um paciente. | Médio | |
| **RF05 - Criar Autenticação** | O sistema deve possibilitar a criação de **diferentes tipos de funcionários** e restringir funcionalidades:<br>Recepcionista;<br>Enfermeira;<br>Médico;<br>Farmacêutico;<br>Administrador; | Alta | |
| **RF06 - Diagnosticar Paciente e Prescrever Medicamento** | O médico deve poder **inserir prescrições** no sistema após realizar o diagnóstico, visíveis apenas ao setor farmacêutico e recepção. | Alta | RF02 |
| **RF07 - Gerar Relatórios** | O sistema deve gerar **relatórios de atendimentos, triagens e diagnósticos** para fins administrativos e estatísticos. | Médio | RF01, RF04 |
| **RF08 - Fazer Triagem** | O sistema deve permitir à enfermeira conduzir a triagem pelo sistema, inserindo informações como:<br>Protocolo Manchester, Total Glasgow, Frequência Cardíaca, Peso, Outras informações importantes para o atendimento. | Alta | RF01 |
| **RF09 - Gerenciar Estoque de Medicamentos** | O sistema deve permitir o farmacêutico consultar a guia dos pacientes e entregar os medicamentos disponíveis necessários | Alta | RF06 |


### Regras de Negócio

| Identificador | Descrição | Prioridade | Depende de |
| :--- | :--- | :--- | :--- |
| RN01 | Cada paciente deve possuir **apenas um registro ativo por atendimento**.<br>Caso o paciente retorne posteriormente, deve ser **iniciado um novo atendimento vinculado ao seu cadastro existente**. | Alta | |
| RN02 | O fluxo deve respeitar a ordem: Recepção → Enfermagem → Médico → Farmácia.<br>Nenhum setor pode acessar o paciente **antes que a etapa anterior esteja concluída,** exceto em casos de urgência médica. | Alta | |
| RN03 | Acesso restrito por perfil profissional:<br>Recepcionista: pode cadastrar e editar apenas dados pessoais.<br>Enfermeiro(a): pode registrar apenas dados clínicos de triagem.<br>Médico(a): pode registrar diagnóstico e prescrição.<br>Farmacêutico(a): pode visualizar prescrição e encerrar atendimento.<br>Administrador: pode gerenciar usuários, relatórios. | Alta | |
| RN04 | Cada módulo deve conter campos obrigatórios antes de prosseguir para a próxima fase.<br>Exemplo:<br>Recepção: CPF ou Cartão SUS obrigatório.<br>Enfermagem: pelo menos um sintoma registrado.<br>Médico: diagnóstico obrigatório para gerar prescrição. | Alta | |
| RN05 | Após finalizado o atendimento, o registro não pode mais ser alterado, apenas consultado. Alterações posteriores devem gerar um novo atendimento vinculado ao paciente. | Alta | |
| RN06 | Cada alteração no registro deve ser **vinculada ao usuário logado** (recepcionista, enfermeira, médico, farmacêutico) com **data e hora da ação**. | Alta | |
| RN07 | Somente **médicos autenticados** podem registrar prescrições. | Alta | |
| RN08 | A farmácia só pode liberar medicamentos se:<br><ul><li>houver prescrição médica válida;</li><li>o medicamento constar no estoque do hospital;</li><li>a dispensação for registrada e confirmada pelo farmacêutico.</li></ul> | Alta | |
| RN09 | O sistema deve gerar **relatórios e códigos compatíveis com o Sistema Único de Saúde**, possibilitando integração futura com bancos de dados públicos. | Baixo | |
| RN10 | O CPF e o CNS devem seguir o padrão brasileiro estabelecido por seus determinados ministérios; | Alta | |


### Requisitos Não Funcionais

| Identificador | Descrição | Categoria | Escopo | Prioridade | Depende de |
| :--- | :--- | :--- | :--- | :--- | :--- |
| RNF01 | A interface deve ser simples, intuitiva e responsiva, adequada ao ambiente hospitalar, com fácil navegação entre módulos. | Portabilidade | Sistema | Alta | |
| RNF02 | O sistema deve responder às ações do usuário em menos de 3 segundos em condições normais de operação. | Agilidade | Sistema | Alta | |
| RNF03 | O sistema deve estar **disponível 24 horas por dia**, com períodos mínimos de manutenção. | Disponibilidade | Sistema | Alta | |
| RNF04 | O sistema deve ser **acessível via navegador web** em computadores e tablets, sem dependência de instalação local. | Disponibilidade | Sistema | Alta | |
| RNF05 | O sistema deve seguir as normas de **proteção de dados pessoais (LGPD)** e padrões do **SUS**. | Segurança | Sistema | Alta | |


## 5. Protótipos

- 1
<img width="1919" height="920" alt="image" src="https://github.com/user-attachments/assets/0e2b570c-ee51-4e26-b5e5-9410a994fb47" />

- 2

<img width="1905" height="910" alt="image" src="https://github.com/user-attachments/assets/238fc576-5e8f-456d-a20a-551d3a2acfcf" />

- 3

<img width="1906" height="919" alt="image" src="https://github.com/user-attachments/assets/5ad97f0e-a2ee-467b-aaa8-489180d17017" />

## 6. Diagrama de Atividades do Produto:

<img width="1760" height="1140" alt="Diagrama de atividade hospital" src="https://github.com/user-attachments/assets/210a1c39-5e79-4303-8668-076210719fa4" />

---
