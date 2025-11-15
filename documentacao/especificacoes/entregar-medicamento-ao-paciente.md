# Caso de Uso: Entregar Medicamento ao Paciente
## 1. Atores

- Farmacêutico.

## 2. Pré-condições

- O ator deve estar no sistema com o nível de acesso de farmacêutico
- Deve haver guia(s) do paciente encaminhada(s) da  **[prescrição médica](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/prescrever-medicamento.md#caso-de-uso-prescrever-medicamento)**.

## 3. Fluxo Principal (Caminho Feliz)

### b) Acontecimento 1º

1. O Ator pode acessar a aba Entregar Medicamentos.
2. O Ator seleciona um paciente pesquisando pelo CPF ou diretamente pela lista de pacientes em um select.
3. O sistema apresenta uma tabela com as guias vinculadas ao CPF daquele paciente.
4. A tabela apresenta as seguintes colunas: Guia, Data, Médico _(Nome e CRM, exemplo: Douglas - 000000RN)_, Posologia completa _(Posologia é o estudo e a definição da forma correta de utilizar um medicamento)_ , e uma coluna do **Status**;

Esboço:
<img width="1029" height="438" alt="image" src="https://github.com/user-attachments/assets/b479b354-c484-4ed3-ba3c-408ee9893f93" />

6. Ao selecionar atender, um modal com os medicamentos da posologia vão ser apresentados _(Medicamentos disponíveis no estoque tem que ter uma representação visual e indisponíveis outra)_, se estiver disponível no estoque, ele vai entregar todos, se não, vai entregar os disponíveis e o status se tornará **Parcialmente Atendido**. 
Exemplo no esboço abaixo:

<img width="784" height="364" alt="image" src="https://github.com/user-attachments/assets/d6cde219-7d90-4793-be81-49e10338dd01" />


6.1 No **status** deve conter o botão de **"Atender"** aquela guia se ainda não foi atendida.

6.2 Se já foi atendida, e todos os medicamentos foram entregues ao paciente, o botão deve ficar cinza com o texto **"Totalmente atendido".**

6.3 Se não tinha disponibilidade de entregar todos os medicamentos por falta no estoque, o botão deve ficar Laranja com o texto **Parcialmente Atendido** e poderá ser terminado atendimento quando tiver o medicamento restante disponível novamente no estoque.


## 4. Fluxos Alternativos (Exceções)


### 4.1 Paciente inexistente

- O ator não deve poder buscar um paciente que não está cadastrado no sistema.

### 4.2 Falta de medicamento

- O sistema entregará somente os medicamentos que tem na guia e estão disponíveis. Os que estiverem em falta, não serão entregues e a guia será atualizada para o status **"Parcialmente Atendido"**, podendo ser finalizado posteriormente quando o medicamento restante estiver disponível no estoque. **Observação**: Este fluxo vale também caso nenhum dos medicamentos da guia esteja disponível, o status da guia também vai para **Parcialmente Atendido**.
  

### 4.3 Se a guia já foi totalmente atendida

- Se a guia já foi atendida completamente, o botão deve ficar com o Status **"Totalmente Atendida"**.

### 4.4 Ator cancela o modal do atendimento

- Se o ator não confirmar o model ao atender, o sistema deve se manter como estava, voltando para a tabela das guias.
  

## 5. Pós-condições

-  **Sucesso:** O farmacêutico repassa os medicamentos, reduzindo corretamente a quantidade no estoque e o status da guia é atualizado na tabela.
-  **Falha:** O sistema permanece no estado anterior. A guia se mantém para ser atualizada.

## 6. Cenários de Teste
| DADO | COMPORTAMENTO | RESULTADO  | TIPO |
| :--- | :--- | :--- | :--- |
| Buscar guia médica com ID de paciente válido | Verificar retorno de prescrição existente | Apresentada prescrição correta associada ao paciente |  Unitário |
| Buscar guia médica com ID de paciente inexistente | Verificar tratamento de erro ao buscar guia | Exceção com mensagem: "Paciente não encontrado." |  Unitário |
| Marcar prescrição atendida com estoque suficiente | Verificar atualização de estoque e status da prescrição | Estoque reduzido corretamente e status atualizado para **"Totalmente Atendido"** |  Unitário |
| Marcar prescrição atendida com estoque insuficiente para 1 medicamento e outro não | Verificar integridade no controle de estoque | O sistema deve entregar o medicamento disponível, e o status deve se tornar **"Parcialmente Atendido"** | Exploratório baseado em cenários |
| Marcar prescrição atendida com estoque insuficiente para 2 medicamentos distintos | Verificar integridade no controle de estoque | O sistema não mudará nada no estoque e o status deve se tornar **"Parcialmente Atendido"** | Exploratório baseado em cenários |
| Atender guia já atendida | Verificar retorno de prescrição existente | O botão deve estar desabilitado (inativo) com o texto **"Totalmente Atendido"** e nenhuma ação deve ser disparada | Exploratório baseado em cenários|
| Atender cancela o modal de atender | Verificar integridade no controle de estoque | Se o ator não confirmar o modal ao atender, o sistema deve se manter como estava, voltando para a tabela das guias | Exploratório baseado em cenários| 
