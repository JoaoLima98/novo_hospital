
# Caso de Uso: Iniciar Sessão

## 1. Atores   
-   **Administrador**

-   **Recepcionista**

-   **Enfermeira**

-   **Médico**

-   **Farmacêutico**


## 2. Pré-condições
    
-   O sistema deve estar operacional e disponível.
    

## 3. Fluxo Principal

### a)  Acontecimento 1º: Login/Iniciar sessão

1.  O Ator insere o email e senha.
    
2.  O Sistema verifica se as informações estão corretas.
    
3.  Se estiver correto, o sistema autentica o usuário.

4. O sistema redireciona o usuário para sua devida página no sistema.

### b) Acontecimento 2º: Controle de acesso

1.  O Ator autenticado, acessa o sistema através do inicio de sessão.
    
2.  O Sistema apresenta somente a área que convém com o perfil do ator.
    

## 4. Fluxos Alternativos (Exceções)

### 4.1. Credencias inválidas.

-   Se o email ou senha não forem válidos, o sistema retorna uma mensagem de erro, exemplo: "Credenciais inválidas"

### 4.2 Controle de acesso.

-   Se o ator tentar inserir uma rota de acesso de outro perfil o sistema retorna um erro: "Acesso negado"    

## 5. Pós-condições

-   **Sucesso:** O ator pode acessar e utilizar sua página no sistema.
    
-   **Falha:** O Ator permanece fora do sistema.

## 6. Cenários de teste
| DADO | COMPORTAMENTO | RESULTADO  | TIPO |
| :--- | :--- | :--- | :--- |
| Inserir email ou senha incorreto | Verificar presença do ator no sistema | Exceção com mensagem: "Email ou senha inválidos" ou "Credencias inválidas" | Unitário |
| Inserir email e senha corretamente | Verificar presença do ator no sistema | Usuário deve ter acesso ao sistema | Exploratório baseado em cenário |
| Tentar acessar uma rota que o ator não deve ter acesso | Verificação privacidade e segurança | Mensagem de erro: "Acesso negado" |  Exploratórios baseado em cenário |
