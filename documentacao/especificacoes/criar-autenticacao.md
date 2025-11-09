# Caso de Uso: "Criar Autenticação"

Este caso de uso abrange o processo de criação de perfil, login e controle de acesso dos diferentes atores do sistema.

## 1. Atores   
-   **Administrador**

-   **Recepcionista**

-   **Enfermeira**

-   **Médico**

-   **Farmacêutico**


## 2. Pré-condições
    
-   O sistema deve estar operacional e disponível.
    

## 3. Fluxo Principal

### a) Criação de perfil

1a.  O Ator insere o email, senha e perfil novo (Médico, Recepcionista, etc...) e as informações especfícicas de cada perfil (Coren, CRM).
    
2b.  O Sistema verifica se as informações estão disponíveis e corretas.
    
3c.  O Sistema retorna uma mensagem de sucesso.

### b) Login

1b.  O Ator insere o email e senha.
    
2b.  O Sistema verifica se as informações estão corretas.
    
3b.  O Sistema autentica o usuário.

### c) Controle de acesso

1c.  O Ator autenticado, acessa o sistema
    
2c.  O Sistema apresenta somente a área que convém com o perfil do ator.
    

## 4. Fluxos Alternativos (Exceções)

### 4.1.a. Credencias já cadastradas.

-   Se o email, Coren ou CRM já estiverem cadastrados, o sistema retorna uma mensagem de erro, exemplo: "CRM já cadastrado".

### 4.2.a Credenciais inválidas.
- Se o email, coren ou CRM não seguirem seus determinados padrões, o sistema deve retornar mensagem de erro, exemplo: "O email deve ser no padrão joao@email.com"










### 4.2.b. Credencias inválidas ou não encontradas.

-   Se o email ou senha não forem válidos, o sistema retorna uma mensagem de erro: "Credenciais inválidas"
-   Se o email ou senha estiverem errados, o sistema retorna uma mensagem de erro: "Credenciais incorretas"

### 4.2.b Credenciais inválidas.
- Se o email, coren ou CRM não seguirem seus determinados padrões, o sistema deve retornar mensagem de erro, exemplo: "O email deve ser no padrão joao@email.com"






### 4.3.c. Controle de acesso.

-   Se o ator tentar inserir uma rota de acesso de outro perfil o sistema retorna um erro: "Acesso negado"    

## 5. Pós-condições

-   **Sucesso:** O novo Perfil é criado com sucesso e é apresentada uma mensagem de sucesso.
    
-   **Falha:** O Perfil não é autenticado, permanecendo fora do sistema e a determinanda mensagem de erro é apresentada.
