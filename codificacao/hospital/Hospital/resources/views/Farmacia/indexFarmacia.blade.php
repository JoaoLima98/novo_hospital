@extends('Template.layout')

@section('title', 'Buscar Guia')

@section('nav')
<a href="{{ route('consultar.estoque') }}" class="nav-item"><i class="fas fa-pills"></i> Estoque de remédios</a>
<a href="{{ route('painel.guias') }}" class="nav-item"><i class="fas fa-calendar-check"></i> Consultar Guia</a>
<a href="{{ route('entregar.medicamentos') }}" class="nav-item"><i class="fas fa-pills"></i> Entregar Medicamentos</a>

@endsection

@section('content')
<div class="main-content">
    <div class="content-header">
        <h2 class="content-title"><i class="fas fa-search"></i> Buscar Guia</h2>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('guia.buscar') }}" method="GET" id="search-form">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-md-6">
                        <label for="paciente" class="form-label">Paciente (CPF)</label>
                        <select name="id_paciente" id="paciente" class="form-select">
                            <option value="" disabled selected>Selecione o paciente...</option>
                            @foreach($pacientes as $paciente)
                                <option value="{{ $paciente->id }}">
                                    {{ $paciente->cpf }} - {{ $paciente->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="guia" class="form-label">Número da Guia</label>
                        <input type="text" name="guia" id="guia" class="form-control" placeholder="Ex: 12345">
                    </div>

                    <div class="col-md-2 d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Resultado da busca --}}
    @isset($prescricao)
    <div class="card mt-4 shadow-sm">
        <div class="card-body">
            <h4><i class="fas fa-file-prescription"></i> Resultado da Guia</h4>
            <p><strong>Paciente:</strong> {{ $prescricao->paciente->nome }}</p>
            <p><strong>CPF:</strong> {{ $prescricao->paciente->cpf }}</p>
            <p><strong>Número da Guia:</strong> {{ $prescricao->id }}</p>
            <p><strong>Médico:</strong> {{ $prescricao->medico->nome }}</p>
            <p><strong>Medicamentos:</strong></p>
            <ul>
                @foreach($prescricao->remedios as $remedio)
                    <li>{{ $remedio->nome }}</li>
                @endforeach
            </ul>
        </div>

        @if(!$prescricao->prescricao_atendida)

            <div class="card-footer text-end">
                <form id="formAtender" action="{{ route('marcar.prescricao.atendida',$prescricao->id) }}" method="POST">
                    @csrf
                    <button type="button" class="btn btn-success" id="btnAtender">
                        <i class="fas fa-check"></i> Marcar como atendida
                    </button>
                </form>
                
            </div>
        @else 
            <div class="card-footer text-end">
                <button class="btn btn-alert">
                    <i class="fas fa-check"></i> Guia já atendida
                </button>
            </div>
            <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Atenção!',
                    text: "Guia já atendida !",
                    confirmButtonColor: '#f0ad4e',
                    confirmButtonText: 'Entendi'
                });
            </script>

        @endif

    </div>
    @endisset
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#paciente').select2({
            placeholder: "Digite o CPF ou nome do paciente...",
            allowClear: true
        });
    });
    $(document).on('click', '#btnAtender', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Confirmar ação?',
            text: "Deseja marcar esta prescrição como atendida?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, confirmar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#formAtender').submit();
            }
        });
    });
</script>
@endsection
