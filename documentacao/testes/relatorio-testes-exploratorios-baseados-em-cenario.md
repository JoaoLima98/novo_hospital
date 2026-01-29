# Relatório de testes exploratórios baseado em cenários

## Especificação [cadastrar-funcionario](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/cadastrar-funcionario.md)

### Cenário: Cancelar o modal de cadastro

- **Link**: https://drive.google.com/drive/folders/1uGRFNsEVF8OSI5BUppF2-aK5aXO3DdyD?usp=drive_link
- **Resultado**: Resultado esperado alcançado, o sistema retornou para o cadastro e manteve o banco de dados inalterado.

## Especificação [disparar-alerta-falta-medicamentos](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/disparar-alerta-falta-medicamento.md)

### Cenários: Quantidade de medicamentos acima e abaixo do alerta

- **Link**: https://drive.google.com/drive/folders/1sJ9whSSs8tkJYNrGOVwhLh3wLy8o-wtj?usp=drive_link
- **Resultado**: Resultado desejado alcançado. Testado no medicamento Ibuprofeno que tinham 17 unidades disponíveis, quando o alerta foi definido em 15 o alerta não foi emitido. Quando o alerta foi definido em 19 o alerta de quantidade foi emitido.

## Especificação [encerrar-sessao](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/encerrar-sessao.md#caso-de-uso-encerrar-sess%C3%A3o)

### Cenário: Cancelar modal de encerrar sessão

- **Link**: https://drive.google.com/drive/folders/1FPNpJc_ELn3Bd48IJQhsBvadAXvHhPQC?usp=drive_link
- **Resultado**: Resultado desejado alcançado. Ao cancelar o modal o usuário continua logado no sistema.

## Especificação [entregar-medicamento-ao-paciente](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/entregar-medicamento-ao-paciente.md#caso-de-uso-entregar-medicamento-ao-paciente)

### Cenário 1: Marcar prescrição atendida com estoque insuficiente para 1 medicamento e outro não

- **Link**: https://drive.google.com/drive/folders/14jQyQJO3qevmMHccOWVi5xpfp5SQtlMy?usp=drive_link
- **Resultado**: Resultado esperado atingido. Os medicamentos disponíveis foram entregues e os indisponíveis ficaram pendentes atualizando o status para atendido parcialmente e permitindo a finalização do atendimento posterior.

### Cenário 2: Marcar prescrição atendida com estoque insuficiente para 2 medicamentos distintos

- **Link**: https://drive.google.com/drive/folders/14jQyQJO3qevmMHccOWVi5xpfp5SQtlMy?usp=drive_link
- **Resultado**: Bug inesperado encontrado. Ao logar para fazer uma prescrição com 2 medicamentos faltantes foi encontrado um bug de conflito do git

### Cenário 3: Atender guia já atendida

- **Link**: https://drive.google.com/drive/folders/14jQyQJO3qevmMHccOWVi5xpfp5SQtlMy?usp=drive_link
- **Resultado**: Resultado esperado atingido. O botão indica que já foi atendido e não é possível atender novamente, o botão fica impossibilitado de clicar.

### Cenário 4: Atender cancela o modal de atender

- **Link**: https://drive.google.com/drive/folders/14jQyQJO3qevmMHccOWVi5xpfp5SQtlMy?usp=drive_link
- **Resultado**: Resultado esperado atingido. O modal é cancelado e a guia não é atendida.

## Especificação [fazer-triagem](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/fazer-triagem.md#especifica%C3%A7%C3%A3o-do-caso-de-uso-fazer-triagem)

### Cenário 1: Deixar campos opcionais em branco (Peso, Altura, Alergias, Sintomas)

- **Link**: https://drive.google.com/drive/folders/1ElUFpg_XTxJ66ppqWkYUGDjeZcoR92e1?usp=drive_link
- **Resultado**: Resultado esperado atingido. A Triagem foi realizada com sucesso apesar dos campos em branco.

### Cenário 2: Selecionar "Sim" em Acidente de Veículo mas não informar o tipo (Condutor/Passageiro/Pedestre)

- **Link**: https://drive.google.com/drive/folders/1ElUFpg_XTxJ66ppqWkYUGDjeZcoR92e1?usp=drive_link
- **Resultado**: Incongruência detectada. A opção de Acidente de Veículo não está disponível na triagem.

### Cenário 3: Clicar no botão "Cancelar" ou fechar o modal durante o preenchimento

- **Link**: https://drive.google.com/drive/folders/1ElUFpg_XTxJ66ppqWkYUGDjeZcoR92e1?usp=drive_link
- **Resultado**: Resultado esperado atingido. O modal foi fechado e o formulário se manteve para criação.

## Especificação [gerenciar-medicamentos](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/gerenciar-medicamentos.md#caso-de-uso-inserir-medicamento)

### Cenário 1: Inserção/Edição com valor de alerta definido como 4 ou menos

- **Link**:  https://drive.google.com/drive/folders/1AYOQB3qyuO-u1Ao9olKrYOHDHotEnZvo?usp=drive_link
- **Resultado**: Incongruência detectada. O alerta está sendo permitido para valores menores que 5

### Cenário 2: Cancelar modal de cadastro de medicamento

- **Link**:  https://drive.google.com/drive/folders/1AYOQB3qyuO-u1Ao9olKrYOHDHotEnZvo?usp=drive_link
- **Resultado**:  Incongruência detectada. Não encontrei a página de inserir medicamento.

## Especificação [gerenciar-pacientes](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/gerenciar-pacientes.md#caso-de-uso-gerenciar-pacientes)

### Cenário 1: Preencher todos os campos corretamente e confirmar

- **Link**: https://drive.google.com/drive/folders/1F4IpVSEsCzVsr4MzsWgIQql4DlGnx9c1?usp=drive_link
- **Resultado**: Resultado esperado atingido. O paciente foi cadastrado com sucesso.

### Cenário 2: Clicar em "Cancelar" durante a edição

- **Link**: https://drive.google.com/drive/folders/1F4IpVSEsCzVsr4MzsWgIQql4DlGnx9c1?usp=drive_link
- **Resultado**:  Resultado esperado atingido. Os dados do paciente se permaneceram inalterados.

## Especificação [iniciar-sessao](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/iniciar-sessao.md#caso-de-uso-iniciar-sess%C3%A3o)

### Cenário 1: Inserir email e senha corretamente

- **Link**: https://drive.google.com/drive/folders/1es9S5u_IJu9uAUamw7EJtxGb5-DYy9JN?usp=drive_link
- **Resultado**: Resultado esperado atingido. Sessão iniciada com sucesso.

### Cenário 2: Tentar acessar uma rota que o ator não deve ter acesso

- **Link**: https://drive.google.com/drive/folders/1es9S5u_IJu9uAUamw7EJtxGb5-DYy9JN?usp=drive_link
- **Resultado**: Resultado indesejado. O usuário enfermeiro teve acesso ao consultar estoque que deveria ser visível apenas para os farmacêuticos


## Especificação [prescrever-medicamento](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/prescrever-medicamento.md#caso-de-uso-prescrever-medicamento)

### Cenário 1: Inserir medicamento repetido

- **Link**: *A fazer*
- **Resultado**: *A fazer*

### Cenário 2: Estoque menor que 1 de determinado medicamento

- **Link**: *A fazer*
- **Resultado**: *A fazer*

## Especificação [registrar-entrada-de-medicamentos](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/registrar-entrada-de-medicamentos.md#caso-de-uso-registrar-entrada-de-medicamentos)

### Cenário: Cancelar operação de cadastro de lotes

- **Link**: https://drive.google.com/drive/folders/1Br5NsaZr95ZS43FKRw_q6NqINN7PH9Oa?usp=drive_link
- **Resultado**: Resultado esperado atingido. Nenhum lote novo foi criado.

## Especificação [visualizar-fila-de-atendimento](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/visualizar-fila-atendimento.md#caso-de-uso-visualizar-fila-de-atendimento)

### Cenário: Realizar triagem de pacientes com diferentes níveis de prioridade

- **Link**: *A fazer*
- **Resultado**: *A fazer*

## Especificação [visualizar-historico-de-atendimento](https://github.com/JoaoLima98/novo_hospital/blob/main/documentacao/especificacoes/visualizar-historico-atendimento.md#caso-de-uso-visualizar-historico-de-atendimento)

### Cenário: Realizar prescrição de um paciente

- **Link**: *A fazer*
- **Resultado**: *A fazer*
