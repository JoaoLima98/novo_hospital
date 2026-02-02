@extends('Template.layout')

@section('title', 'Meus Pacientes')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        {{-- Cabeçalho --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary fw-bold"><i class="fas fa-users"></i> Lista de Pacientes</h2>
        </div>

        {{-- Filtros de Busca --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-3">
                <div class="row g-3">
                    {{-- Input Nome --}}
                    <div class="col-12 col-md-8">
                        <label for="filtro_nome" class="form-label small text-muted fw-bold">Buscar por Nome</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                            <input type="text" id="filtro_nome" class="form-control border-start-0" placeholder="Digite o nome do paciente...">
                        </div>
                    </div>

                    {{-- Input CPF --}}
                    <div class="col-12 col-md-4">
                        <label for="filtro_cpf" class="form-label small text-muted fw-bold">Buscar por CPF</label>
                        {{-- maxlength 14 para travar no tamanho do CPF --}}
                        <input type="text" id="filtro_cpf" class="form-control" placeholder="000.000.000-00" maxlength="14">
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabela de Pacientes --}}
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
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
                                {{-- 
                                    LÓGICA DE STATUS E CORES 
                                    Recupera a triagem mais recente pelo relacionamento definido no Model
                                --}}
                                @php
                                    $triagem = $paciente->triagem; // Pega a relação latestOfMany
                                    $statusRaw = $triagem ? $triagem->status : null;

                                    // Define cor e texto baseado no Enum
                                    $statusConfig = match($statusRaw) {
                                        'aguardando_atendimento'  => ['class' => 'bg-warning text-dark', 'label' => 'Aguardando atendimento médico'],
                                        'em_atendimento'          => ['class' => 'bg-info text-dark',    'label' => 'Em atendimento médico'],
                                        'aguardando_medicamentos' => ['class' => 'bg-primary',           'label' => 'Aguardando medicamentos'],
                                        'finalizado'              => ['class' => 'bg-success',           'label' => 'Finalizado'],
                                        'cancelado'               => ['class' => 'bg-danger',            'label' => 'Cancelado'],
                                        default                   => ['class' => 'bg-secondary bg-opacity-25 text-muted', 'label' => 'Sem triagem registrada'],
                                    };
                                @endphp

                                <tr class="linha-paciente">
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                                <i class="fas fa-user fa-lg"></i>
                                            </div>
                                            <div>
                                                {{-- CLASSE ALVO: td-nome --}}
                                                <h5 class="mb-0 fw-bold text-dark fs-5 text-uppercase td-nome">{{ $paciente->nome }}</h5>
                                                <small class="text-muted fs-6">ID: #{{ $paciente->id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td class="fs-6 td-cpf">{{ $paciente->cpf }}</td>
                                    <td class="fs-6">{{ $paciente->telefone }}</td>
                                    
                                    {{-- COLUNA STATUS --}}
                                    <td class="text-center">
                                        <span class="badge rounded-pill {{ $statusConfig['class'] }} px-3 py-2 fw-normal fs-7">
                                            <i class="fas fa-circle fa-xs me-1"></i> {{ $statusConfig['label'] }}
                                        </span>
                                    </td>
                                    
                                    <td class="text-end pe-4">
                                        <div class="btn-group">
                                            <a href="{{ route('pacientes.edit', $paciente->id) }}" class="btn btn-outline-primary btn-sm" title="Editar">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <span class="fs-5">Nenhum paciente cadastrado.</span>
                                    </td>
                                </tr>
                            @endforelse
                            
                            {{-- Mensagem de Não Encontrado --}}
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
            
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Selecionando elementos
    const inputNome = document.getElementById('filtro_nome');
    const inputCpf = document.getElementById('filtro_cpf');
    const linhas = document.querySelectorAll('.linha-paciente');
    const msgNaoEncontrado = document.getElementById('msg-nao-encontrado');

    // Função de Filtro Principal
    function filtrarTabela() {
        const termoNome = inputNome.value.toLowerCase().trim();
        const termoCpf = inputCpf.value.replace(/\D/g, ''); 

        let encontrouAlguem = false;

        linhas.forEach(function(linha) {
            const elNome = linha.querySelector('.td-nome');
            const elCpf = linha.querySelector('.td-cpf');

            if (elNome && elCpf) {
                const textoNome = elNome.textContent.toLowerCase();
                const textoCpf = elCpf.textContent.replace(/\D/g, '');

                const bateuNome = textoNome.includes(termoNome);
                const bateuCpf = (termoCpf === '') || textoCpf.includes(termoCpf);

                if (bateuNome && bateuCpf) {
                    linha.style.display = ''; 
                    encontrouAlguem = true;
                } else {
                    linha.style.display = 'none'; 
                }
            }
        });

        if (msgNaoEncontrado) {
            msgNaoEncontrado.style.display = encontrouAlguem ? 'none' : '';
        }
    }

    function mascaraCPF(valor) {
        return valor
            .replace(/\D/g, '')
            .replace(/(\d{3})(\d)/, '$1.$2')
            .replace(/(\d{3})(\d)/, '$1.$2')
            .replace(/(\d{3})(\d{1,2})/, '$1-$2')
            .replace(/(-\d{2})\d+?$/, '$1');
    }

    inputNome.addEventListener('input', filtrarTabela);
    inputCpf.addEventListener('input', function(e) {
        e.target.value = mascaraCPF(e.target.value);
        filtrarTabela();
    });
});
</script>
@endsection