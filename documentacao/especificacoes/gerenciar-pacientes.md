
# Caso de Uso: Gerenciar Pacientes

## 1. Atores

- **Recepcionista**

## 2. Pré-condições

- O sistema deve estar operacional e disponível.
- O ator deve estar autenticado com o nível de acesso de **recepcionista**.

## 3. Fluxo Principal

### a) Acontecimento 1º: Cadastro de Paciente

1. O Ator acessa a aba "Pacientes" no menu principal.
2. O sistema apresenta a lista de pacientes já cadastrados e o botão "Cadastrar Novo Paciente".
3. O Ator clica no botão "Cadastrar Novo Paciente".
4. O sistema exibe um página com formulário para preenchimento dos seguintes campos:
    * **Nome Completo**: Campo de texto para inserir o nome do paciente.
    * **CPF**: CPF significa Cadastro de Pessoas Físicas, um registro essencial da Receita Federal do Brasil, um número único de 11 dígitos que identifica cada cidadão
    * **RG**: RG, a Carteira de Identidade Nacional do paciente com 9 dígitos
    * **Telefone**: Telefone do paciente ou responsável com 11 dígitos já incluindo DDD.
    * **Cartão SUS**: Cartão Nacional de Saúde - CNS é o documento de identificação do cidadão no Sistema Único de Saúde com 15 dígitos.
    * **Naturalidade**: Cidade que o paciente nasceu.
    * **Estado Civil**: Botão **Select**: Solteiro, Casado, Divorciado, Viúvo, Outros
    * **Profissão**: Campo de texto com a profissão do paciente.
    * **Data de Nascimento**: Data de nascimento do paciente.
    * **Raça/Cor**: Botão **Select**: Branco, Preto, Pardo, Amarelo, Indígena.
    * **Nome da Mãe**: Nome da mãe do paciente.
    * **Nome do Pai**: Nome do pai do paciente.
    * **Escolaridade**: Botão **Select**: Analfabeto, Fundamental, Médio, Superior
    * **Regulado**: **Boolean - Toggle/Switch** para indicar se o paciente vem de regulação
    * **Cidade Atual**: Cidade que o paciente reside atualmente.
    * **Estado**: Botão **Select** com a abreviação do estado buscando do banco de dados
    * **Rua**: Rua que reside o paciente
    * **Bairro**: Bairro que reside o paciente
    * **Número da Casa**: Número da casa que reside o paciente
    Esboço:
    <img width="1024" height="559" alt="image" src="https://github.com/user-attachments/assets/9900c852-1a95-42ac-85a4-6f8015daf382" />

    
5. O Ator preenche as informações e clica no botão "Salvar".
6. Um **modal** de confirmação é exibido com o resumo dos dados.
7. O Ator confirma e o sistema registra o paciente no banco de dados.

### b) Acontecimento 2º: Edição de Paciente

1. Na lista de pacientes, o Ator utiliza a barra de busca para encontrar um paciente pelo nome ou CPF.
2. O sistema apresenta o **card** ou linha do paciente com a opção "Editar".
3. O Ator seleciona "Editar" e o sistema abre o formulário **preenchido** com os dados atuais.
4. O Ator realiza as alterações necessárias.
5. O Ator clica em "Salvar" e confirma no **modal**.

## 4. Fluxos Alternativos (Exceções)

### 4.1. CPF já cadastrado
- Se o Ator tentar cadastrar um CPF que já existe no banco de dados, o sistema bloqueia a operação e informa: "Paciente já cadastrado com este CPF".

### 4.2. Campos Obrigatórios
- O sistema deve proibir o cadastro se os campos **Nome**, **CPF**, **Data de Nascimento** e **Telefone** estiverem vazios. O sistema deve destacar os campos em vermelho.

### 4.3. Cancelar Operação
- A qualquer momento, se o Ator clicar em "Cancelar" ou fechar o **modal**, os dados inseridos são descartados e o sistema retorna à tela de listagem.

## 5. Pós-condições

- **Sucesso:** O paciente é inserido ou atualizado no banco de dados e fica disponível para triagem.
- **Falha:** Nenhuma alteração é salva no banco de dados.

## 6. Cenários de teste

| DADO | COMPORTAMENTO | RESULTADO | TIPO |
| :--- | :--- | :--- | :--- |
| Inserir CPF já existente no sistema | Verificar unicidade do CPF | Exceção com mensagem: "Paciente já cadastrado com este CPF" | Unitário |
| Deixar campo "Nome", "CPF", "Telefone", e/ou "Data de Nascimento" vazio | Verificar obrigatoriedade de campos críticos | O sistema impede o salvamento e solicita o preenchimento | Unitário |
| Preencher todos os campos corretamente e confirmar | Verificar fluxo de criação | Mensagem de sucesso e paciente aparece na listagem | Exploratório baseado em cenário |
| Clicar em "Cancelar" durante a edição | Verificar integridade dos dados | O sistema fecha o formulário e mantém os dados originais do paciente | Exploratório baseado em cenário |
