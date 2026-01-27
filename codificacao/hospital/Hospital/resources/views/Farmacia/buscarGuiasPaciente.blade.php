@extends('Template.layout')

@section('title', 'Painel de Guias')

@section('nav')
<a href="{{ route('remedios') }}" class="nav-item"><i class="fas fa-pills"></i>Remédios</a>
<a href="{{ route('consultar.estoque') }}" class="nav-item"><i class="fas fa-pills"></i> Estoque de remédios</a>
<a href="{{ route('painel.guias') }}" class="nav-item"><i class="fas fa-calendar-check"></i> Entregar Medicamentos</a>

@endsection

@section('content')
<div class="main-content">
    <div class="content-header">
        <h2 class="content-title"><i class="fas fa-calendar-check"></i> Painel de Guias de Prescrição</h2>
        {{-- 
        <form id="formBuscar" action="{{ route('consultar.guias') }}" method="GET">
            @csrf
            <select name="id_paciente" id="paciente" class="form-select">
                <option value="" disabled {{ !$pacienteSelecionado ? 'selected' : '' }}>Filtrar por paciente...</option>
                @foreach($pacientes as $paciente)
                    <option value="{{ $paciente->id }}" {{ $pacienteSelecionado && $pacienteSelecionado->id == $paciente->id ? 'selected' : '' }}>
                        {{ $paciente->cpf }} - {{ $paciente->nome }}
                    </option>
                @endforeach
                 @if($pacienteSelecionado)
                    <option value="{{ route('painel.guias') }}">Limpar filtro</option>
                @endif
            </select>
        </form>
         --}}
    </div>

    @if($ultimasGuias && $ultimasGuias->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Guia</th>
                        <th>Paciente</th>
                        <th>Data</th>
                        <th>Médico</th>
                        <th>Remédios (Posologia)</th>
                        <th class="text-center">Atender</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ultimasGuias as $guia)
                        <tr>
                            <td>{{ $guia->id }}</td>
                            <td>{{ $guia->paciente->nome ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($guia->data_prescricao)->format('d/m/Y H:i') }}</td>
                            <td>{{ $guia->medico->nome ?? 'Não informado' }}</td>
                            <td>
                                <ul class="mb-0" style="padding-left: 1.2rem;">
                                    @forelse($guia->remedios as $remedio)
                                        @php
                                            // Lógica para verificar se este item já foi atendido
                                            $itemAtendido = $remedio->pivot->atendido;
                                        @endphp
                                        <li class_="{{ $itemAtendido ? 'text-decoration-line-through text-muted' : '' }}">
                                            <i class="fas {{ $itemAtendido ? 'fa-check-circle text-success' : 'fa-pills text-primary' }}"></i>
                                            {{ $remedio->nome }} - {{ $remedio->pivot->quantidade ?? 1 }}
                                            <br>
                                            medido em: {{ $remedio->pivot->unidade_medida ?? '' }}
                                        </li>
                                    @empty
                                        <li class="text-muted">Nenhum remédio listado.</li>
                                    @endforelse
                                </ul>
                            </td>
                            <td class="text-center">
                                @php
                                    // Prepara os dados para o JavaScript
                                    // Precisamos garantir que os estoques estão sendo carregados
                                    $remediosComEstoque = $guia->remedios->map(function ($remedio) {
                                        return [
                                            'id' => $remedio->id,
                                            'nome' => $remedio->nome,
                                            'pivot' => $remedio->pivot,
                                            'estoques' => $remedio->estoques, // Passa a coleção de estoques
                                            'total_disponivel' => $remedio->estoques->sum('quantidade') // Soma o estoque
                                        ];
                                    });
                                @endphp

                                @if($guia->prescricao_atendida == 'atendido')
                                    <button class="btn btn-sm btn-success" disabled>
                                        <i class="fas fa-check-double"></i> Atendido
                                    </button>
                                @else
                                    <button class="btn btn-sm btn-warning text-dark btn-atender"
                                            data-guia-id="{{ $guia->id }}"
                                            data-action-url="{{ route('marcar.prescricao.atendida', $guia->id) }}"
                                            data-remedios="{{ $remediosComEstoque->toJson() }}">
                                        
                                        @if($guia->prescricao_atendida == 'atendido_parcialmente')
                                            <i class="fas fa-exclamation-triangle"></i> Atender Restante
                                        @else
                                            <i class="fas fa-hand-holding-medical"></i> Atender
                                        @endif
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info mt-3">
            Nenhuma guia encontrada para os filtros selecionados.
        </div>
    @endif
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    $('#paciente').select2({
        placeholder: "Digite o CPF ou nome para filtrar...",
        allowClear: true
    });

    // Filtro de paciente
    $('#paciente').on('change', function() {
        var selectedValue = $(this).val();
        // Verifica se o valor é uma URL (para o "Limpar filtro")
        if (selectedValue.startsWith('http')) {
            window.location.href = selectedValue;
        } else {
            $('#formBuscar').submit();
        }
    });

    // --- LÓGICA DO MODAL DE ATENDIMENTO ---
    $(document).on('click', '.btn-atender', function (e) {
        e.preventDefault();

        const $button = $(this);
        const remedios = $button.data('remedios');
        const formActionUrl = $button.data('action-url');

        if (!remedios || remedios.length === 0) {
            Swal.fire('Erro', 'Não há remédios nesta guia.', 'error');
            return;
        }

        let html = '<form id="remediosForm" style="padding: 1rem; text-align: left;">';
        
        remedios.forEach(remedio => {
            let totalDisponivel = remedio.total_disponivel; // Usando o total calculado
            let quantidadeNecessaria = remedio.pivot.quantidade;
            let itemJaAtendido = remedio.pivot.atendido;

            let podeAtender = totalDisponivel >= quantidadeNecessaria;
            let isDisabled = itemJaAtendido || !podeAtender;
            
            let statusLabel = '';
            if (itemJaAtendido) {
                statusLabel = '<span class="badge bg-success">Entregue</span>';
            } else if (!podeAtender) {
                statusLabel = `<span class="badge bg-danger">Estoque Insuficiente (Nec: ${quantidadeNecessaria} / Disp: ${totalDisponivel})</span>`;
            } else {
                statusLabel = `<span class="badge bg-info">Disponível: ${totalDisponivel}</span>`;
            }

            html += `
                <div class="form-check" style="margin-bottom: 10px; padding: 10px; border: 1px solid #eee; border-radius: 5px;">
                    <input class="form-check-input" 
                           type="checkbox" 
                           name="remedios[]" 
                           value="${remedio.id}" 
                           id="remedio_${remedio.id}"
                           ${itemJaAtendido ? 'checked disabled' : ''}
                           ${!itemJaAtendido && !podeAtender ? 'disabled' : ''}>
                    
                    <label class="form-check-label" for="remedio_${remedio.id}" style="width: 100%;">
                        <strong>${remedio.nome}</strong> (Qtd: ${quantidadeNecessaria})<br>
                        ${statusLabel}
                    </label>
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
            width: '600px',
            preConfirm: () => {
                const selecionados = [];
                // Seleciona apenas os que estão marcados e NÃO estão desabilitados
                $('#remediosForm input[name="remedios[]"]:checked:not(:disabled)').each(function(){
                    selecionados.push($(this).val());
                });

                if (selecionados.length === 0) {
                    // Verifica se o usuário não selecionou nada, mas HAVIA itens para selecionar
                    let itensDisponiveis = $('#remediosForm input[name="remedios[]"]:not(:disabled)').length;
                    if(itensDisponiveis > 0) {
                         Swal.showValidationMessage('Selecione pelo menos um medicamento para entregar!');
                    } else {
                        // Não há nada a fazer, apenas fecha o modal
                        return false; 
                    }
                }
                return selecionados;
            }
        }).then((result) => {
            if (result.isConfirmed && result.value && result.value.length > 0) {
                // Cria form dinâmico e envia via POST com os IDs selecionados
                const form = $('<form>', {
                    action: formActionUrl,
                    method: 'POST',
                    style: 'display:none;' // Esconde o formulário
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
});
</script>
@if($remedios)
<script>
    let lista = `
        <ul style="text-align: center; list-style: none; padding: 0;">
            @foreach($remedios as $item)
                <li style="margin-bottom: 6px;">
                    <strong>{{ $item->remedio->nome }}</strong> — Restam: {{ $item->total }}
                </li>
            @endforeach
        </ul>
    `;

    Swal.fire({
        title: "Estoque Baixo!",
        html: lista,
        icon: "warning",
        confirmButtonText: "Ok",
        customClass: {
            popup: 'swal2-center-popup'
        }
    });
</script>

@endif 
@endsection