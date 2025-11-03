# Caso de Uso: "Criar Autenticação"

Este caso de uso abrange o processo de login e controle de acesso dos diferentes atores do sistema.

## 1. Atores
-   **Recepcionista**
    
-   **Enfermeira**
    
-   **Médico**
    
-   **Farmacêutico**
    
-   **Administrador**

## 2. Pré-condições
    
-   O sistema deve estar operacional e disponível.
    

## 3. Fluxo Principal

### a) Criação do acesso

1.  O Ator insere o email, senha e perfil novo (Médico, Recepcionista, etc...) e as informações especfícicas de cada perfil (Coren, CRM).
    
2.  O Sistema verifica se as informações estão disponíveis e corretas.
    
3.  O Sistema retorna uma mensagem de sucesso.

## 4. Fluxos Alternativos (Exceções)

### 4.1. Credencias já cadastradas.

-   Se o email, Coren ou CRM já estiverem cadastrados, o sistema retorna uma mensagem de erro, exemplo: "CRM já cadastrado".

### 4.2 Credenciais inválidas.
- Se o email, coren ou CRM não seguirem seus determinados padrões, o sistema deve retornar mensagem de erro, exemplo: "O email deve ser no padrão joao@email.com"
    

## 5. Pós-condições

-   **Sucesso:** O Ator é autenticado com sucesso e é apresentada uma mensagem de sucesso.
    
-   **Falha:** O Ator não é autenticado, permanecendo fora do sistema e a determinanda mensagem de erro é apresentada.
