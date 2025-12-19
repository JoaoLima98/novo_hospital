
# Especificação do Caso de Uso: Fazer Triagem

## 1. Atores
* Enfermeiro

## 2. Pré-condições
* O usuário (Enfermeiro) deve estar logado no sistema.
* O paciente deve estar devidamente cadastrado no sistema.

## 3. Fluxo Principal
1.  O Enfermeiro acessa a opção de **Triagem** no menu principal.
2.  O sistema exibe a lista de pacientes aguardando triagem.
3.  O Enfermeiro seleciona um paciente da lista.
4.  O sistema exibe um modal, com o formulário para registro dos dados da triagem com os seguintes campos:
    * **Peso (kg):** (Valor númerico do peso do paciente em KG, ex: 57,0 ou 120,6);
    
    * **Altura (cm):** (Valor númerico da altura do paciente em CM, ex: 157 ou 200);
    * **Pressão Arterial:** (Devem ser 2 valores númericos que formam este valor, ex: 120x80 ou 140x90)
       * (Talvez seja mecessário guardar cada tipo de pressão separadamente no banco de dados, mas isto é opcional. 
         
         **Exemplo:** pressao_sistolica (120) e pressao_diastolica (80);
    * **Temperatura Axilar (°C)**: (Valor númerico da temperatura do paciente, ex: 35,0 ou 38,6);
    * **Queixa Principal:** (Caixa de texto com a descrição do que o paciente está sentindo);
    * **Classificação de Risco/Protocolo Manchester:** (Botão **Select** de prioridade: Emergência, Muito Urgente, Urgente, Pouco Urgente, Sem urgência);
    * **Total Glasgow:** (A **escala de coma de Glasgow** é uma **escala  neurológica** que intenciona constituir-se de um método para registrar o nível de consciência de uma pessoa) (Aqui deve ser possível colocar um número de **3 à 15**, 3 sendo o **valor mínimo** e 15 sendo o **valor máximo**);
    * **Escore de dor:** (Um valor de **0 à 10** da dor do paciente, sendo 0 o **valor mínimo** e 10 o **valor máximo**);
    * **Sintomas Gripais:** (Deve ser uma **checkbox de múltiplas escolhas** com as opções: Espirro, Otalgia, Febre, Obstrução Nasal, Coriza, Mialgia, Tosse e Dispnéia);
    * **Alergias:** (Caixa de texto para descrever possíveis alergias do paciente);
    * **Medicação em uso:** (Caixa de texto para descrever alguma medicação utilizada atualmente pelo paciente);
    * **Tipo de chegada:** (Botão **select** para selecionar se o paciente chegou de: Ambulância municipal, Espontânea, Samu, Corpo de bombeiros ou Polícia);
    * **Acidente de veículo:** (Sim ou não **(Boolean - Toggle/Switch)**
       *    *Se sim* deve aparecer um **Radio** para selecionar o **Tipo de envolvimento: Condutor, Passageiro ou Pedestre**; Se não, este radio não deve aparecer;
    * **Acidente de Trabalho:** (Sim ou não **(Boolean - Toggle/Switch)**)
    * **Frequencia Cardiaca (bpm):** (Valor númerico da frequencia cardiaca do paciente em BPM, ex: 186 ou 100);
    * **SpO2 (%):**  (Botão **select** para selecionar a porcentagem de oxigenação do paciente, opções: < 85% - **Hipoxia Severa**, 85% ~ 89% - **Hipoxia Moderada**, 90% ~ 94% - **Hipoxia Leve** ou 95% ~ 100% - **Normal**); 
    *  **Glicemia:**  (Botão **select** para selecionar a taxa glicêmica do paciente: < 70 - **Hipoglicemico**, 70 ~ 100 - **Normal**, 101 ~ 126 - **pré-diabético** ou > 126 - **Diabético**)
    *  **Especialistas**: (Botão para **escolher as especialidades**, apenas as especialidades de que foram vinculadas a médicos que estão cadastrados no **banco de dados** durante **cadastro de fucionários** devem aparecer para o enfermeiro. O enfermeiro vai poder selecionar **mais de um especialista**, e **apenas** estes especialistas poderão ver o caso da triagem determinada.)
  
    *  **Esboço**:
    <img width="4604" height="3001" alt="Sem título-2025-11-15-1149" src="https://github.com/user-attachments/assets/0342aad4-8812-4e25-a9c8-3d35f11e4812" />




5.  O Enfermeiro preenche as informações solicitadas.
6.  O Enfermeiro confirma o cadastro da triagem.
7.  O sistema exibe uma mensagem de sucesso ("Triagem realizada com sucesso") e encaminha o paciente para [prescrever-medicamento](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/prescrever-medicamento.md).

## 4. Fluxos Alternativos

### 4.1. Dados Faltantes

- O sistema não deve permitir a criação da triagem sem preencher obrigatoriamente os seguintes campos: Manchester, Pressão Arterial, Temperatura axilar, Total Glasgow, Tipo de Chegada, Acidente de veículo,  Acidente de trabalho, Frequência Cardiaca, SpO2 e Glicemia.

- Os demais campos podem ficar em branco. (Esta escolha de quais podem ficar vazios e quais não podem foi uma tomada de decisão pensada em um caso em que o paciente não consegue responder as perguntas, como em um acidente grave.

### 4.2. Cancelar Operação.

- A qualquer momento antes do passo 6 do fluxo principal, o ator deve poder cancelar o modal do formulário de triagem.

## 5. Pós-condições

* **Sucesso**: 
   *   O registro de triagem é realizado com sucesso e encaminhado para o médico.
   *   O paciente está visível na lista de atendimento dos médicos, ordenado por sua classificação de risco (Manchester).

* **Falha**: O registro de triagem não é realizado nem encaminhado para o médico.


## 6. Cenários de Teste:


| DADO | COMPORTAMENTO | RESULTADO | TIPO |
| :--- | :--- | :--- | :--- |
| Preencher todos os campos obrigatórios (Sinais vitais, Manchester, Glasgow, etc.) corretamente | Verificar fluxo principal de cadastro | Mensagem de sucesso: "Triagem realizada com sucesso" e paciente encaminhado à lista do médico | Unitário |
| Deixar o campo "Classificação de Risco (Manchester)" vazio | Verificar obrigatoriedade de campo | O sistema deve impedir o cadastro e destacar o campo obrigatório | Unitário |
| Deixar o campo "Total Glasgow" vazio | Verificar obrigatoriedade de campo | O sistema deve impedir o cadastro e destacar o campo obrigatório | Unitário |
| Inserir um valor inválido em "Total Glasgow" (ex: 2 ou 16) | Verificar validação de intervalo (Range) | Exceção/Erro informando que o valor deve estar entre 3 e 15 | Unitário |
| Inserir um valor inválido em "Escore de dor" (ex: 11) | Verificar validação de intervalo (Range) | Exceção/Erro informando que o valor deve estar entre 0 e 10 | Unitário |
| Deixar campos opcionais em branco (Peso, Altura, Alergias, Sintomas) | Verificar regra de campos opcionais | O cadastro deve ser realizado com sucesso (permitido valores nulos) | Exploratório baseado em Cenário |
| Selecionar "Sim" em Acidente de Veículo mas não informar o tipo (Condutor/Passageiro/Pedestre) | Verificar validação condicional | O sistema deve exigir a seleção do tipo de envolvimento | Exploratório baseado em Cenário |
| Clicar no botão "Cancelar" ou fechar o modal durante o preenchimento | Verificar cancelamento de operação | O modal deve fechar, os dados devem ser limpos e nenhum registro deve ser salvo | Exploratório baseado em cenário |
