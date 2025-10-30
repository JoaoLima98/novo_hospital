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
        <h2 class="content-title"><i class="fas fa-search"></i> Consultar guias Paciente</h2>

        <form id="formBuscar" action="{{ route('consultar.guias') }}" method="GET">
            @csrf
            <select name="id_paciente" id="paciente" class="form-select">
                <option value="" disabled selected>Selecione o paciente...</option>
                @foreach($pacientes as $paciente)
                    <option value="{{ $paciente->id }}">
                        {{ $paciente->cpf }} - {{ $paciente->nome }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    @if($ultimasGuias)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Guia</th>
                    <th>Data</th>
                    <th>Médico</th>
                    <th>Observação</th>
                    <th>Remédios</th>
                    <th>Atendida</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ultimasGuias as $guia)
                    <tr>
                        <td>{{ $guia->id }}</td>
                        <td>{{ $guia->data_prescricao }}</td>
                        <td>{{ $guia->medico->nome ?? 'Não informado' }}</td>
                        <td>{{ $guia->observacao }}</td>
                        <td>
                            <ul class="mb-0">
                                @foreach($guia->remedios as $remedio)
                                    <li>{{ $remedio->nome }} - {{ $remedio->pivot->quantidade ?? 1 }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            @if($guia->prescricao_atendida)
                                <span class="badge bg-success">Sim</span>
                            @else
                                <span class="badge bg-warning text-dark">Não</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif 
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
        $('#paciente').on('change', function() {
            $('#formBuscar').submit();
        });
    });

    
</script>
@endsection
