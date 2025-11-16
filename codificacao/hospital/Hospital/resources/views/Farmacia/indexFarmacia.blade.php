    @extends('Template.layout')

    @section('title', 'Buscar Guia')

    @section('nav')
    <a href="{{ route('consultar.estoque') }}" class="nav-item"><i class="fas fa-pills"></i> Estoque de remédios</a>
    <a href="{{ route('painel.guias') }}" class="nav-item"><i class="fas fa-calendar-check"></i> Entregar Medicamentos</a>

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
                            <div class="remedio-card" style="padding:10px; margin-bottom:8px; border:1px solid #ccc; border-radius:6px; background:#f9f9f9;">
                                <h5 style="margin:0 0 5px 0;">{{ $remedio->nome }}</h5>
                                <p style="margin:0; font-size:14px;">
                                    <strong>Qtd a ser entregue:</strong> {{ $remedio->pivot->quantidade }} <br>
                                    <strong>Tipo de dosagem: </strong> {{ $remedio->pivot->unidade_medida }}<br>
                                    <strong>Intervalo:</strong> de {{ $remedio->pivot->intervalo }} em {{ $remedio->pivot->intervalo }} h<br>
                                    <strong>Duração:</strong> {{ $remedio->pivot->duracao }} dias
                                </p>
                            </div>
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
    </script>
    @if(isset($prescricao) && !$prescricao->prescricao_atendida)
    <script>
        $(document).on('click', '#btnAtender', function (e) {
            e.preventDefault();

            const remedios = @json($prescricao->remedios ?? []);

            let html = '<form id="remediosForm">';
                remedios.forEach(remedio => {
                    let totalDisponivel = remedio.estoques.reduce((sum, e) => sum + e.quantidade, 0);
                    html += `
                        <div style="text-align:left; margin-bottom: 6px;">
                            <input type="checkbox" name="remedios[]" value="${remedio.id}" id="remedio_${remedio.id}" ${totalDisponivel <= 0 ? 'disabled' : ''}>
                            <label for="remedio_${remedio.id}"> ${remedio.nome} - Disponível: ${totalDisponivel}</label>
                        </div>
                    `;
                });
            html += '</form>';

            Swal.fire({
                title: 'Selecionar medicamentos entregues',
                html: html,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Confirmar Entrega',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                preConfirm: () => {
                    const selecionados = [];
                    $('#remediosForm input[name="remedios[]"]:checked').each(function(){
                        selecionados.push($(this).val());
                    });

                    if (selecionados.length === 0) {
                        Swal.showValidationMessage('Selecione pelo menos um medicamento!');
                    }
                    return selecionados;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = $('<form>', {
                        action: "{{ route('marcar.prescricao.atendida', $prescricao->id) }}",
                        method: 'POST'
                    });
                    form.append('@csrf');
                    result.value.forEach(id => {
                        form.append($('<input>', {
                            type: 'hidden',
                            name: 'remedios[]',
                            value: id
                        }));
                    });
                    $('body').append(form);
                    form.submit();
                }
            });
        });
    </script>
    @endif 
    @endsection
