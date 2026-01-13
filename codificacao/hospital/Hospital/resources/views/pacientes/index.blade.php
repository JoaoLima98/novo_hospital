@extends('Template.layout')

@section('title', 'Meus Pacientes')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        {{-- Cabeçalho --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary fw-bold"><i class="fas fa-users"></i> Lista de Pacientes</h2>
        </div>

        {{-- Filtros de Busca (Client-Side / Instantâneo) --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-3">
                {{-- Removemos o FORM pois a busca é via JS na tela --}}
                <div class="row g-2 align-items-center">
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                            {{-- ID adicionado para o jQuery --}}
                            <input type="text" id="filtro_nome" class="form-control border-start-0" placeholder="Comece a digitar o nome...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{-- ID adicionado para o jQuery --}}
                        <input type="text" id="filtro_cpf" class="form-control" placeholder="Buscar por CPF">
                    </div>
                    <div class="col-md-4 text-end text-muted small">
                        <i class="fas fa-bolt text-warning me-1"></i> Busca Instantânea
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabela de Pacientes --}}
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    {{-- ID na tabela para o script encontrar --}}
                    <table class="table table-hover align-middle mb-0" id="tabela_pacientes">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3">Nome do Paciente</th>
                                <th>CPF</th>
                                <th>Telefone</th>
                                <th>Cidade</th>
                                <th class="text-end pe-4">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pacientes as $paciente)
                                <tr class="linha-paciente"> {{-- Classe para identificar linhas --}}
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                                <i class="fas fa-user fa-lg"></i>
                                            </div>
                                            <div>
                                                {{-- CLASSE td-nome ADICIONADA PARA BUSCA --}}
                                                <h5 class="mb-0 fw-bold text-dark fs-5 text-uppercase td-nome">{{ $paciente->nome }}</h5>
                                                <small class="text-muted fs-6">ID: #{{ $paciente->id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    {{-- CLASSE td-cpf ADICIONADA PARA BUSCA --}}
                                    <td class="fs-6 td-cpf">{{ $paciente->cpf }}</td>
                                    
                                    <td class="fs-6">{{ $paciente->telefone }}</td>
                                    <td class="fs-6">{{ $paciente->cidade_atual }}</td>
                                    
                                    <td class="text-end pe-4">
                                        <div class="btn-group">
                                            <a href="{{ route('pacientes.edit', $paciente->id) }}" class="btn btn-outline-primary" title="Editar">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                                <span class="visually-hidden">Mais opções</span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                                <li><a class="dropdown-item fs-6" href="#"><i class="fas fa-history me-2 text-secondary"></i> Histórico</a></li> 
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="fas fa-user-slash fa-3x mb-3 d-block opacity-50"></i>
                                        <span class="fs-5">Nenhum paciente cadastrado.</span>
                                    </td>
                                </tr>
                            @endforelse
                            
                            {{-- Linha oculta que aparece quando a busca não acha nada --}}
                            <tr id="msg-nao-encontrado" style="display: none;">
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-search fa-2x mb-3 d-block opacity-50"></i>
                                    <span class="fs-5">Nenhum paciente encontrado na busca.</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white d-flex justify-content-end py-3">
                {{ $pacientes->links() }}
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT DE BUSCA INSTANTÂNEA --}}
<script>
    $(document).ready(function(){
        // Máscara no input de filtro
        $('#filtro_cpf').mask('000.000.000-00', {reverse: true});

        // Evento 'keyup': Dispara sempre que uma tecla sobe
        $('#filtro_nome, #filtro_cpf').on('keyup', function() {
            var termoNome = $('#filtro_nome').val().toLowerCase();
            // Remove pontos e traços do CPF digitado para comparar apenas números
            var termoCpf = $('#filtro_cpf').val().replace(/\D/g, ''); 

            var encontrou = false;

            // Varre cada linha da tabela
            $('#tabela_pacientes tbody tr.linha-paciente').each(function() {
                var linha = $(this);
                
                // Pega o texto do nome e do CPF dentro da linha
                var nomeNaTabela = linha.find('.td-nome').text().toLowerCase();
                var cpfNaTabela = linha.find('.td-cpf').text().replace(/\D/g, '');

                // Verifica se o termo digitado existe na tabela
                var bateuNome = nomeNaTabela.indexOf(termoNome) > -1;
                var bateuCpf = cpfNaTabela.indexOf(termoCpf) > -1;

                // Se bater Nome E CPF (ou se o campo estiver vazio)
                if(bateuNome && bateuCpf) {
                    linha.show();
                    encontrou = true;
                } else {
                    linha.hide();
                }
            });

            // Controle da mensagem "Nenhum resultado"
            if(!encontrou) {
                $('#msg-nao-encontrado').show();
            } else {
                $('#msg-nao-encontrado').hide();
            }
        });
    });
</script>
@endsection