
# Documento de Requisitos

**Projeto:** Sistema de Fluxo Hospitalar

**Discentes:** João de Azevedo Lima Neto, Jocian Douglas Sousa Carneiro

---

### Registro de Alterações:

| Versão | Responsável | Data | Alterações |
| :--- | :--- | :--- | :--- |
| 0.1 | João de Azevedo Lima Neto | 06/10/2025 | Criação do Documento |
| 0.5 | João de Azevedo Lima Neto, Jocian Douglas Sousa Carneiro | 01/11/2025 | Reorganização e reestruturação do documento, incluindo ajustes nas seções 3 e 4 |
| 0.6 | João de Azevedo Lima Neto| 09/11/2025 | Ajuste nos requisitos funcionais |
| 1.0 | João de Azevedo Lima Neto| 09/11/2025 | Ajustado a seção 3 para conter o minimundo descrito e em forma de diagrama. O diagrama contém apenas o que nosso sistema engloba até o momento |
| 1.1 | João de Azevedo Lima Neto| 09/11/2025 | Realocado diagrama de caso de uso para o documento de especificação de caso de uso |
| 1.2 | João de Azevedo Lima Neto| 12/11/2025 | Ajuste na descrição do caso de uso que descreve melhor a funcionalidade |
| 1.3 | João de Azevedo Lima Neto| 14/11/2025 | Correção no RF06 |
| 1.4 | João de Azevedo Lima Neto| 15/11/2025 | Correção no RF09 e adição do RF10 |
| 1.5 | João de Azevedo Lima Neto| 15/11/2025 | Correção no RF05 e adição do RF11 e RF12 |
| 1.6 | João de Azevedo Lima Neto| 15/11/2025 | Criação do RF13 e RF14 |
| 1.7 | João de Azevedo Lima Neto| 04/12/2025 | Criação do RF15 e RF16 |
| 1.8 | João de Azevedo Lima Neto| 07/12/2025 | Pequenos ajustes na seção 3.1, Reajuste completo nas regras de negócio para condizer com o sistema atual e adição de novas imagens do sistema na seção 5 |
| 1.9 | João de Azevedo Lima Neto| 08/12/2025 | Ajustes na seção 3.2 e atualização no commit |
| 1.9.1 | João de Azevedo Lima Neto| 26/01/2026 | Ajustes na seção 4, removido um RF que não fazia sentido estar como RF |
| 1.9.2 | João de Azevedo Lima Neto| 27/01/2026 | Ajustes no diagrama de domínio |
| 2.0 | João de Azevedo Lima Neto| 02/02/2026 | Atualizado RNs e Protótipos |

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

Na **Fase 3 – Atendimento Médico**, o médico, em sua própria área de especialidade, acessa o registro consolidado do paciente e adiciona **informações do exame clínico**, **diagnóstico** e **prescrição médica**, através de **posologias**. Após o atendimento, o sistema atualiza o status do paciente e armazena o registro como parte do **histórico de atendimentos**, que poderá ser consultado em visitas futuras, além de enviar para o farmacêutico para entrega de remédios.

Por fim, na **Fase 4 – Farmácia**, o farmacêutico visualiza as **prescrições médicas associadas** e realiza o **registro da dispensação de medicamentos**. Ao dar baixa em um medicamento, ele será diminuído no estoque, e se o valor deste mesmo medicamento, ficar abaixo do valor de alerta de medicamento, o sistema lembrará o farmacêutico de baixo nível de estoque. Ao concluir essa etapa, o atendimento é encerrado e o sistema marca o registro como **finalizado**, mantendo todas as informações armazenadas de forma permanente. 

O sistema deve permitir o **acompanhamento em tempo real do status de cada paciente**, desde o momento da chegada até a finalização do atendimento, além de disponibilizar funcionalidades de **consulta de histórico, controle de acesso por função, geração de relatórios gerenciais.** Com sua implantação, o hospital passará a contar com um processo digital e integrado, eliminando as fichas manuais, garantindo maior **agilidade**, **segurança da informação** e **continuidade no acompanhamento médico dos pacientes**, trazendo benefícios tanto para os profissionais de saúde quanto para a população atendida.

Quanto a cada funcionário **(recepcionista, enfermeira, médico e farmacêutico)** cada um terá acesso apenas as suas determinadas fatias do sistema. Ao cadastrar um novo funcionário, o admnistrador deverá selecionar o perfil do profissional que, ao utilizar o sistema, não terá acesso as partes que não os dizem respeito. A depende do tipo de funcionário ele também terá atributos específicos, como no caso de médico que terá suas especialidades, que serão determinantes para o tipo de paciente que ele receberá para atendimento.

---

### 3.2 Minimundo - Diagrama de domínio

<img width="2689" height="2211" alt="Diagrama de dominio-hospital-v3" src="https://github.com/user-attachments/assets/459c261d-b090-42cb-9ccb-9eccbcdbe830" />



---

## 4. Requisitos de Usuário

Tomando por base o contexto do sistema, foram identificados os seguintes requisitos de usuário


### Requisitos Funcionais

| Identificador | Descrição | Prioridade | Depende de |
| :--- | :--- | :--- | :--- |
| **RF01 - Gerenciar Paciente** | O sistema deve permitir o **cadastro de pacientes** na recepção, incluindo: Cartão SUS, CPF, Endereço, Telefone, Outras informações básicas. | Alta | - |
| **RF02 - Atualizar Status do Paciente** | O sistema deve **atualizar automaticamente o status** do paciente conforme ele avança nas etapas:<br>Exemplo: “Aguardando atendimento médico → Em atendimento médico → Aguardando medicamentos → Finalizado”. | Alta | RF01 |
| **RF03 - Verificar Histórico do Paciente** | Os atores recepcionista, médico e enfermeira devem poder **consultar todo o histórico de atendimentos anteriores** de um paciente. | Médio | - |
| **RF04 - Cadastrar Funcionário** | O sistema deve possibilitar a criação de **diferentes tipos de funcionários** e restringir funcionalidades:<br>Recepcionista;<br>Enfermeira;<br>Médico;<br>Farmacêutico;<br>Administrador; | Alta | - |
| **RF05 - Prescrever Medicamento** | O médico deve poder **inserir prescrições**, adicionando posologias, no sistema após realizar o diagnóstico, visíveis apenas ao setor farmacêutico e recepção. | Alta | RF01 |
| **RF06 - Gerar Relatórios** | O sistema deve gerar **relatórios de atendimentos, triagens e diagnósticos** para fins administrativos e estatísticos. | Médio | RF01, RF03 |
| **RF07 - Fazer Triagem** | O sistema deve permitir à enfermeira conduzir a triagem pelo sistema, inserindo informações como:<br>Protocolo Manchester, Total Glasgow, Frequência Cardíaca, Peso, Outras informações importantes para o atendimento. | Alta | RF01 |
| **RF08 - Registrar Entrada de medicamentos** | O sistema deve permitir o farmacêutico cadastrar novo lote de medicamentos | Alta | - |
| **RF09 - Entregar Medicamento ao Paciente** | O sistema deve permitir o farmacêutico consultar a guia dos pacientes e entregar os medicamentos disponíveis necessários | Alta | RF05, RF08 |
| **RF10 - Iniciar Sessão** | O sistema deve permitir o inicio de sessão no sistema | Alta | RF04 |
| **RF11 - Encerrar Sessão** | O sistema deve o encerramento de sessão no sistema | Alta | RF04, RF10 |
| **RF12 - Gerenciar medicamentos** | O sistema deve permitir ao farmacêutico o gerenciamento de novos medicamentos, inserindo nome e valor de alerta | Alta | - |
| **RF13 - Disparar alerta de falta de medicamentos** | O sistema deve enviar um alerta quando os medicamentos forem menor que o valor de alerta escolhido pelo farmacêutico | Alta | - |
| **RF14 - Visualizar fila de atendimento** | O sistema deve mostrar uma tabela dos pacientes em fila de atendimento, baseado na prioridade Manchester tendo critério de desempate Glasgow e Hora de chegada | Alta | - |
| **RF15 - Visualizar histórico de atendimento** | O sistema deve mostrar uma tabela para o médico dos pacientes que ele já atendeu | Média | - |

### Regras de Negócio

| ID   | Nome da Regra | Descrição do Comportamento (Fluxo Alternativo) | Especificação de Origem | Prioridade | Depende de |
|:-----|:----------------------|:-----------------------------------------------|:-------------------------|:-----------|:-----------|
| **RN01** | Dados de Acesso Inválidos | Se o email ou senha não forem válidos, o sistema retorna uma mensagem de erro, exemplo: "Credenciais inválidas" | [iniciar-sessao.md](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/iniciar-sessao.md#4-fluxos-alternativos-exce%C3%A7%C3%B5es) | ALTA | - |
| **RN02** | Controle de acesso. | Se o ator tentar inserir uma rota de acesso de outro perfil o sistema retorna um erro: "Acesso negado" | [iniciar-sessao.md](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/iniciar-sessao.md#4-fluxos-alternativos-exce%C3%A7%C3%B5es) | ALTA | - |
| **RN03** | Credencias já cadastradas. | Se o email, Coren ou CRM já estiverem cadastrados, o sistema retorna uma mensagem de erro, exemplo: "CRM já cadastrado". | [cadastrar-funcionario.md](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/cadastrar-funcionario.md#4-fluxos-alternativos-exce%C3%A7%C3%B5es) | ALTA | - |
| **RN04** | Credenciais inválidas. | Se o email, coren ou CRM não seguirem seus determinados padrões, o sistema deve retornar mensagem de erro, exemplo: "O email deve ser no padrão joao@email.com" | [cadastrar-funcionario.md](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/cadastrar-funcionario.md#4-fluxos-alternativos-exce%C3%A7%C3%B5es) | ALTA | - |
| **RN05** | Campos vazios | O sistema não deve permitir o cadastro com os campos, nome, email e senha vazios. | [cadastrar-funcionario.md](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/cadastrar-funcionario.md#4-fluxos-alternativos-exce%C3%A7%C3%B5es) | ALTA | - |
| **RN06** | Quantidade de medicamentos acima da quantidade do alerta | Se todos os medicamentos estiverem com quantidade acima do valor de alerta, a mensagem de alerta não deve aparecer | [disparar-alerta-falta-medicamento.md](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/disparar-alerta-falta-medicamento.md#4-fluxos-alternativos-exce%C3%A7%C3%B5es) | ALTA | - |
| **RN07** | Paciente inexistente | O ator não deve poder buscar um paciente que não está cadastrado no sistema. | [entregar-medicamento-ao-paciente.md](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/entregar-medicamento-ao-paciente.md#4-fluxos-alternativos-exce%C3%A7%C3%B5es) | ALTA | - |
| **RN08** | Falta de medicamento | O sistema entregará somente os medicamentos que tem na guia e estão disponíveis. Os que estiverem em falta, não serão entregues e a guia será atualizada para o status **"Parcialmente Atendido"**, podendo ser finalizado posteriormente quando o medicamento restante estiver disponível no estoque. **Observação**: Este fluxo vale também caso nenhum dos medicamentos da guia esteja disponível, o status da guia também vai para **Parcialmente Atendido**. | [entregar-medicamento-ao-paciente.md](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/entregar-medicamento-ao-paciente.md#4-fluxos-alternativos-exce%C3%A7%C3%B5es) | ALTA | - |
| **RN09** | Se a guia já foi totalmente atendida | Se a guia já foi atendida completamente, o botão deve ficar com o Status **"Totalmente Atendida"**. | [entregar-medicamento-ao-paciente.md](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/entregar-medicamento-ao-paciente.md#4-fluxos-alternativos-exce%C3%A7%C3%B5es) | ALTA | - |
| **RN10** | Dados de Triagem Incompletos | O sistema não deve permitir a criação da triagem sem preencher obrigatoriamente os seguintes campos: **Manchester, Pressão Arterial, Temperatura axilar, Total Glasgow, Tipo de Chegada, Acidente de veículo, Acidente de trabalho, Frequência Cardiaca, SpO2 e Glicemia.** Os demais campos podem ficar em branco. | [fazer-triagem.md](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/fazer-triagem.md#4-fluxos-alternativos) | ALTA | - |
| **RN11** | Medicamento Duplicado | Ao gerenciar medicamentos, se tentar inserir um medicamento com o mesmo nome de um já existente, o sistema deve impedir a duplicação. | [gerenciar-medicamentos.md](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/gerenciar-medicamentos.md#4-fluxos-alternativos-exce%C3%A7%C3%B5es) | ALTA | - |
| **RN12** | Valor de alerta não pode ser abaixo de 5 | O valor de alerta não pode ser abaixo de 5, pois é muito baixo. | [gerenciar-medicamentos.md](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/gerenciar-medicamentos.md#4-fluxos-alternativos-exce%C3%A7%C3%B5es) | ALTA | - |
| **RN13** | Deletar medicamento com estoque positivo | O sistema deve proibir deletar um medicamento com estoque positivo, se o ator tentar a mensagem similar a seguinte deve ser informada: "Medicamento ainda tem unidades em estoque, remoção não autorizada". | [gerenciar-medicamentos.md](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/gerenciar-medicamentos.md#4-fluxos-alternativos-exce%C3%A7%C3%B5es) | ALTA | - |
| **RN14** | Medicamento repetido | O médico não deve poder cadastrar uma posologia de um medicamento repetido, o medicamento deve ficar não selecionável ou sumir da lista de posologia; | [prescrever-medicamento.md](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/prescrever-medicamento.md#4-fluxos-alternativos-exce%C3%A7%C3%B5es) | ALTA | - |
| **RN15** | Medicamentos disponíveis | Os medicamentos só devem aparecer na lista de posologia, se tiverem disponibilidade no estoque maior que 0; | [prescrever-medicamento.md](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/prescrever-medicamento.md#4-fluxos-alternativos-exce%C3%A7%C3%B5es) | ALTA | - |
| **RN16** | Campos vazios | O sistema deve proibir a prescrição se a posologia estiver com quaisquer campos vazios | [prescrever-medicamento.md](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/prescrever-medicamento.md#4-fluxos-alternativos-exce%C3%A7%C3%B5es) | ALTA | - |
| **RN17** | Lote com quantidade negativa | O ator não deve poder inserir um número menor que 1 | [registrar-entrada-de-medicamentos.md](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/registrar-entrada-de-medicamentos.md#4-fluxos-alternativos-exce%C3%A7%C3%B5es) | ALTA | - |
| **RN18** | Campo medicamento obrigatório | O ator tenta cadastrar um lote sem nome. O sistema informa que o campo de medicamento é obrigatório | [registrar-entrada-de-medicamentos.md](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/registrar-entrada-de-medicamentos.md#4-fluxos-alternativos-exce%C3%A7%C3%B5es) | ALTA | - |
| **RN19** | Campo quantidade obrigatório | O ator tenta cadastrar um lote sem uma quantidade. O sistema informa que a quantidade é inválida. | [registrar-entrada-de-medicamentos.md](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/registrar-entrada-de-medicamentos.md#4-fluxos-alternativos-exce%C3%A7%C3%B5es)) | ALTA | - |
| **RN20** | CPF único no sistema | Se o Ator tentar cadastrar um CPF que já existe no banco de dados, o sistema bloqueia a operação e informa: "Paciente já cadastrado com este CPF. | [gerenciar-pacientes.md](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/gerenciar-pacientes.md#4-fluxos-alternativos-exce%C3%A7%C3%B5es) | ALTA | - |
| **RN21** | Campos Obrigatórios | O sistema deve proibir o cadastro se os campos Nome, CPF, Data de Nascimento e Telefone estiverem vazios. O sistema deve destacar os campos em vermelho. | [gerenciar-pacientes.md](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/gerenciar-pacientes.md#4-fluxos-alternativos-exce%C3%A7%C3%B5es) | ALTA | - |
| **RN22** | Cancelar Operação | A qualquer momento, se o Ator clicar em "Cancelar" ou fechar o modal, os dados inseridos são descartados e o sistema retorna à tela de listagem. | [gerenciar-pacientes.md](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/gerenciar-pacientes.md#4-fluxos-alternativos-exce%C3%A7%C3%B5es) | ALTA | - |
| **RN23** | Cancelamento de atendimento | Se o atendimento for cancelado em qualquer etapa (por desistência ou erro de cadastro), o sistema deve atualizar o status para "Cancelado" e remover o paciente das filas de prioridade ativa. | [atualizar-status-do-paciente.md](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/atualizar-status-do-paciente.md#4-fluxos-alternativos-exce%C3%A7%C3%B5es) | ALTA | - |
| **RN24** | Fechar Modal de Detalhes | Ao visualizar o histórico de status (Acontecimento 2º, passo 6), o ator pode selecionar "Fechar" ou clicar fora do modal. O modal será fechado e o sistema retornará à lista de pacientes. | [atualizar-status-do-paciente.md](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/atualizar-status-do-paciente.md#4-fluxos-alternativos-exce%C3%A7%C3%B5es) | ALTA | - |



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

- 4

<img width="1205" height="544" alt="image" src="https://github.com/user-attachments/assets/cbfa9ab0-9241-42a1-9a8d-743b2c8316fc" />

- 5

<img width="1134" height="539" alt="image" src="https://github.com/user-attachments/assets/538dfb89-a66e-4257-ace5-344f45754d20" />

- 6

<img width="1205" height="565" alt="image" src="https://github.com/user-attachments/assets/cdff8e8d-2e78-430f-8191-2df8deeb8a4c" />

- 7

<img width="1300" height="606" alt="image" src="https://github.com/user-attachments/assets/0d3b1e8b-f6fd-4dfc-b6d8-edbd48cfb7fe" />

-8

<img width="1267" height="600" alt="image" src="https://github.com/user-attachments/assets/70e34832-ec58-4226-a1ea-17c15c8e1b49" />

-9

<img width="1134" height="592" alt="image" src="https://github.com/user-attachments/assets/11049898-ca91-4b23-8c5e-e521fd44afa0" />

## 6. Diagrama de Atividades do Produto:

<img width="1760" height="1140" alt="Diagrama de atividade hospital" src="https://github.com/user-attachments/assets/210a1c39-5e79-4303-8668-076210719fa4" />

---
