# Caso de Uso: Gerenciar Estoque de Medicamentos

## 1. Atores
 - Farmacêutico.
## 2. Pré-condições
 - Encaminhamento da prescrição médica.
## 3. Fluxo Principal (Caminho Feliz)
### a) Acontecimento 1º
1. O farmacêutico consulta a guia do paciente e vê se já foi atendido.
2. O farmacêutico repassa os medicamentos, se a guia não tiver sido atendida.
3. O quantidade estoque é atualizado.

## 4. Fluxos Alternativos (Exceções)

### 4.1 Falta de medicamento
- Se faltar medicamento, a guia não é atualizada e não repassa os medicamentos.

### 4.2 Se a guia já foi atendida
- Se a guia já foi atendida, uma mensagem é informado "Esta guia já foi atendida!".

## 5. Pós-condições
- **Sucesso:** O farmacêutico repassa os medicamentos e uma mensagem de sucesso é apresentada.
- **Falha:** O sistema permanece no estado anterior. A guia se mantém para ser atualizada.
