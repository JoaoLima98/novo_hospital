# Caso de Uso: Disparar alerta de falta de medicamentos

## 1. Atores

 - Sistema
 
## 2. Pré-condições

 - Sistema funcional e operante.
 
## 3. Fluxo Principal
### a) Acontecimento 1º

1. O sistema verifica o valor inserido para alerta em cada medicamento.
2. Compara se o valor no estoque (a soma de todos os lotes de determinado medicamento) é menor que o do valor de alerta.
3. Se for menor, sempre que o farmacêutico acessar a aba entregar medicamentos, um alerta é disparado.
4. O alerta vai informar que a quantidade de estoque está baixa para os medicamentos, e a quantidade disponível.
5. Ao confirmar o alerta, o farmacêutico pode seguir


## 4. Fluxos Alternativos (Exceções)

### 4.1 Quantidade de medicamentos acima da quantidade do alerta
- Se todos os medicamentos estiverem com quantidade acima do valor de alerta, a mensagem de alerta não deve aparecer

## 5. Pós-condições
- **Sucesso:** Alerta aparece informando baixa quantidade de medicamentos.
- **Falha:** A "falha" será o estoque estar acima do alerta, que é também uma boa notícia.

## 6. Cenários de testes

| DADO | COMPORTAMENTO | RESULTADO | TIPO |
| :--- | :--- | :--- | :--- |
| Quantidade de medicamentos acima do alerta | Verificar baixa quantidade de medicamentos | Nada deve acontecer, o alerta não deve ser executado. | Exploratóreo baseado em teste |
| Quantidade de medicamentos abaixo do alerta | Verificar baixa quantidade de medicamentos | Uma mensagem deve informar que a quantidade de estoque está baixa para os medicamentos, e a quantidade disponível.  | Exploratóreo baseado em teste |
