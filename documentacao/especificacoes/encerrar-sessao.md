# Caso de Uso: Encerrar Sessão

## 1. Atores   
-   **Administrador**

-   **Recepcionista**

-   **Enfermeira**

-   **Médico**

-   **Farmacêutico**


## 2. Pré-condições
    
-   Ator estar autenticado no sistema.
    

## 3. Fluxo Principal

### a)  Acontecimento 1º: Logout/Encerrar Sessão

1.  O ator clica no seu perfil no canto superior da página, disponível em qualquer página do sistema.

2. O sistema mostra o botão "Sair do sistema"

3. O Ator clica no botão "Sair do sistema"
4.  O sistema apresenta um modal para confirmar a saída ou cancelar.

5.  Ao confirmar a saída, um novo modal deve informar que o ator está tendo sua sessão finalizada.
6.  O sistema redireciona o Ator para a página de login.


    
## 4. Fluxos Alternativos (Exceções)

### 4.1 Cancelar modal
- Ao cancelar modal o ator deve manter-se ativo no sistema.

## 5. Pós-condições

-   **Sucesso:** O ator encerra sua sessão no sistema e é redirecionada para página de login.

## 6. Cenários de teste
| DADO | COMPORTAMENTO | RESULTADO  | TIPO |
| :--- | :--- | :--- | :--- |
| Cancelar modal de encerrar sessão | Verificar funcionalidade de saída | O ator deve retornar a sua página no sistema | Exploratório baseado em teste|
