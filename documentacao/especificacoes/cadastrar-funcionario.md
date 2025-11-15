# Caso de Uso: "Cadastrar funcionário"

## 1. Atores
   
-   **Administrador**


## 2. Pré-condições
    
-   O ator deve ter o nível de acesso de administrador.
    

## 3. Fluxo Principal

### a) Criação de perfil

1.  O sistema apresenta a aba "Cadastrar Funcionário"
2. O Ator insere o nome, email, senha, telefone e perfil _(Médico, Recepcionista, etc...)_ do novo funcionário
3. 3.1 Se o perfil selecionado for o perfil de médico, o campo **"CRM"** _(CRM médico é a sigla para Conselho Regional de Medicina e, mais especificamente, refere-se ao registro profissional obrigatório que um médico obtém ao se inscrever em um conselho estadual para poder exercer a profissão legalmente no Brasil. O CRM deve conter até 6 dígitos)_ e o campo **"Especialidade"** devem ser apresentados, pois são campos exclusivos de médico.
	3.2 Se o perfil selecionado for o perfil de enfermeiro, o campo **"COREN"** _(COREN significa  Conselho Regional de Enfermagem, uma autarquia federal que atua em cada estado para fiscalizar e regulamentar o exercício da profissão de enfermagem. O COREN deve conter até 6 dígitos)_ deve ser apresentado, pois é um campo exclusivo de enfermeiro.

4.  O Ator seleciona o botão salvar.

5. Um modal de confirmação de cadastro deve aparecer para o ator aceitar ou cancelar.
    
6.  O Sistema retorna uma mensagem de sucesso.
    

## 4. Fluxos Alternativos (Exceções)

### 4.1. Credencias já cadastradas.

-   Se o email, Coren ou CRM já estiverem cadastrados, o sistema retorna uma mensagem de erro, exemplo: "CRM já cadastrado".

### 4.2. Credenciais inválidas.
- Se o email, coren ou CRM não seguirem seus determinados padrões, o sistema deve retornar mensagem de erro, exemplo: "O email deve ser no padrão joao@email.com"

### 4.3. Campos vazios
- O sistema não deve permitir o cadastro com os campos, nome, email e senha vazios.

### 4.4. Cancelar o modal
- O ator pode selecionar "Cancelar" no modal, e o sistema não deverá registrar o novo funcionário e o sistema retornará a tela do cadastro.

## 5. Pós-condições

-   **Sucesso:** O novo Perfil é criado com sucesso e é apresentada uma mensagem de sucesso.
    
-   **Falha:** O Perfil não é criado, permanecendo fora do sistema.

## 6. Cenários de teste
| DADO | COMPORTAMENTO | RESULTADO  | TIPO |
| :--- | :--- | :--- | :--- |
| Inserir um email repetido ao cadastrar novo funcionário | Verificar unicidade | Exceção com mensagem: "Email já está sendo utilizado" | Unitário |
| Inserir um CRM repetido ao cadastrar novo médico | Verificar unicidade | Exceção com mensagem: "CRM já está sendo utilizado" |  Unitário |
| Inserir um email fora do padrão de email, exemplo: joaoemailcom | Verificação de padrões | Exceção com mensagem: "email deve seguir o padrão joao@email.com" |  Unitário |
| Inserir um email dentro do padrão de email, exemplo: joao@email.com | Verificação de padrões | Permitido o cadastro |  Unitário |
| Cancelar o modal de cadastro | Verificação de integridade ao cadastar funcionário | O sistema deve retornar a tela de cadastro |  Exploratório baseado em cenário |
