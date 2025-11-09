
# Processos do Projeto 
Definição de Padrões e Processo de Desenvolvimento de Software

## Descrição de Status

### Backlog:
Fila de espera de onde o time seleciona o que será trabalhado a seguir.

**Deve ser utilizado quando o item ainda não tem as seguintes métricas definidas:**
- Pontos estimados
- Prioridade
- Tamanho
- Iteração

### Ready:
Fila de espera de quando o item já foi analisado e já está pronto para ser iniciado.

**Deve ser utilizado quando o item ainda já possui as seguintes métricas definidas:**
- Pontos estimados
- Prioridade
- Tamanho
- Iteração

### In progress:
Cartão para quando o item está sendo ativamente trabalhado e ainda não concluído.

**Deve ser utilizado para itens já iniciados pelo seu responsável.**

### Review:
Cartão para quando o item já foi finalizado e está esperando a revisão do cliente.

**Deve ser utilizado para itens já finalizados**

 - Após esta fase o item pode ser reiterado ou caso seja aceito, vai para o próximo cartão.

### Done
Cartão para quando o item já foi aceito pelo cliente.

**Deve ser utilizado para itens aceitos.**

- Itens desta fase não devem ser mexidos para qualquer outra fase.
- Em caso de alteração necessária, um novo item deve ser criado, não alterado deste cartão.

---
## Papeis
- [Analista de Negócio](https://github.com/JoaoLima98/triagem_hospitalar/blob/main/documentacao/processos/papeis.md#analista-de-neg%C3%B3cio-an) : Responsável por entender as necessidades do negócio para transpassar para o sistema, sem perder a essência do processo atual da instituição, e ajudar na criação da documentação.
- [Gerente do Projeto](https://github.com/JoaoLima98/novo_hospital/edit/main/documentacao/processos/papeis.md#gerente-do-projeto): Responsável por planejar e administrar o cronograma e orçamento de recursos.
- [Desenvolvedor](https://github.com/JoaoLima98/triagem_hospitalar/blob/main/documentacao/processos/papeis.md#desenvolvedor) : Responsável por projetar e construir o software, transformando os artefatos de requisitos detalhados em código.

## Artefatos
- [Plano de Gerenciamento do Projeto (PGP)](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/processos/artefatos.md#7-plano-de-gerenciamento-do-projeto-pgp): Artefato responsável por representar a estimativa de tempo de entrega.
- [Documento de Visão](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/processos/artefatos.md#1-documento-de-vis%C3%A3o) : Artefato responsável por compreender uma visão geral do produto que está sendo desenvolvido.
- [Especificações de caso de uso](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/processos/artefatos.md#2-especifica%C3%A7%C3%A3o-de-caso-de-uso): Artefato que descreverá uma funcionalidade do sistema.
- [Documento de requisitos](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/processos/artefatos.md#3-documento-de-requisitos): Artefato que visa esclarecer funcionalidades, propósito e fluxo do sistema.
- [Documento de Especificação de Requisitos](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/processos/artefatos.md#8-documento-de-especifica%C3%A7%C3%A3o-de-requisitos): Artefato suporte que contém melhor definição dos casos de uso.
- [Produto](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/processos/artefatos.md#4-produto-software-execut%C3%A1vel) : Artefato executável e entregável do que foi solicitado e desenvolvido.
- [Plano de Testes](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/processos/artefatos.md#5-plano-de-testes): Artefato que visa definir os testes do software a fim de manter a qualidade do sistema.
- [Relatorio de Testes](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/processos/artefatos.md#6-relat%C3%B3rio-de-testes): Artefato que visa relatar os testes que tiveram sucesso, fracassos e as suas ocorrências.
- [Caso de Teste](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/processos/artefatos.md#9-casos-de-teste): Artefato que detalha determinado caso de teste.

## Atividades
- [Analisar Negócio](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/processos/atividades.md#1-analisar-neg%C3%B3cio) : Entender o contexto, objetivos, problemas e oportunidades diante de uma solicitação. Resulta na definição de escopo e em uma visão geral de cada funcionalidade.
- [Planejar](https://github.com/JoaoLima98/novo_hospital/edit/main/documentacao/processos/atividades.md#2-planejar): Atividade que transforma ideias/demandas iniciais em tarefas que encaminhem estas ideias para um produto final.
- [Especificar Funcionalidades](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/processos/atividades.md#2-especificar-funcionalidades): Detalhar especificações claras, descrevendo exatamente como cada ator interagirá com o sistema.
- [Construir Plano de Testes](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/processos/atividades.md#4-construir-plano-de-testes): A atividade Construir plano de testes tem o objetivo de garantir a qualidade do produto final.
- [Codificar e Testar Unitariamente](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/processos/atividades.md#3-codificar-e-testar-unitariamente): Escrever, testar unitariamente e integrar o código-fonte para implementar as funcionalidades definidas nas Especificações de Funcionalidades.
- [Revisar demanda](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/processos/atividades.md#7-revisar-demanda): Avaliação crítica e sistemática de um artefato ou processo para identificar e corrigir desvios ou erros.

### Padrões Estabelecidos para o Desenvolvimento
- Construir Documento de requisitos: Gerar um documento visível do funcionamento e dos atores do Sistema de Triagem.

- Padrão de Diretórios - Artefatos só podem ser criados dentro dessa estrutura estabelecida.

````
    A estrutura de diretórios que armazenará esses artefatos de requisitos criados e mantidos no diretório Requisitos, deverá seguir esta classificação primária : 
    (a) para as necessidades do domínio do problema, os artefatos de requisitos deverão ser organizados no diretório Requisitos Funcionais; 
    (b) para os documentos que descrevem a especificação de cada caso de uso devem ficar no diretório "especificacoes"; 
    (c) para os documentos que dizem respeito ao proceso devem estar presente no diretório "processos".

    Padrão de nomenclatura
        Todos os arquivos arquivos utilizando os caractéres em minusculo e sempre separados por hífens (-), com o nome que descreve sua função, exemplo: caso-fazer-triagem.md
        Os arquivos de especificações de determinado caso de uso começam com "caso" seguido do caso que ele descreve, exemplo: caso-gerenciar-paciente.md
