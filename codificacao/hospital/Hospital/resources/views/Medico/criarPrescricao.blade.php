@extends('Template.layout')

@section('title', 'Prescrição de Medicamentos')

@section('content')

<style>
    .medication-entry {
        transition: all 0.3s ease;
    }

    .medication-entry:hover {
        box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.1);
    }

    .dosage-group {
        background-color: #f8f9fa;
        padding: 1.25rem;
        border-radius: 0.5rem;
        border-left: 4px solid #0d6efd;
    }

    .btn-remove-med {
        transition: all 0.3s ease;
    }

    .form-text {
        font-size: 0.75rem;
    }

    .input-group-text {
        background-color: #e9ecef;
        border: 1px solid #ced4da;
    }
</style>

<div class="main-content">
    <div class="content-header">
        <h2 class="content-title"><i class="fas fa-file-prescription"></i> Prescrição de Medicamentos</h2>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('criar.prescricao') }}" method="POST" id="prescription-form">
                @csrf

                <div class="form-group mb-4">
                    <label for="paciente" class="form-label">Paciente (pesquisa por CPF)</label>
                    <select name="id_paciente" id="paciente" class="form-select" required>
                        <option value="" disabled selected>Digite o CPF do paciente...</option>
                        @foreach($pacientes as $paciente)
                            <option value="{{ $paciente->id }}">
                                {{ $paciente->cpf }} - {{ $paciente->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <hr class="my-4">

                <label class="form-label h5 mb-3">
                    <i class="fas fa-pills"></i> Medicamentos Prescritos
                </label>

                <div id="medications-container">
                    <!-- Template de entrada de medicamento -->
                    <div class="medication-entry card border mb-3">
                        <div class="card-body">
                            <div class="row align-items-center mb-3">
                                <div class="col">
                                    <h6 class="card-title mb-0 text-primary">Medicamento #<span class="medication-number">1</span></h6>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-outline-danger btn-sm btn-remove-med">
                                        <i class="fas fa-trash"></i>
                                        <span class="d-none d-md-inline ms-1">Remover</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Seleção do Medicamento -->
                            <div class="row g-3 mb-3">
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Medicamento</label>
                                    <select name="medicamentos[0][id]" class="form-select" required>
                                        <option value="" disabled selected>Selecione um medicamento...</option>
                                        @foreach($remedios as $remedio)
                                            <option value="{{ $remedio->id }}">{{ $remedio->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Grupo de Dosagem -->
                            <div class="dosage-group">
                                <h6 class="text-muted mb-3">
                                    <i class="fas fa-syringe"></i> Dosagem e Posologia
                                </h6>
                                
                                <div class="row g-3">
                                    <!-- Quantidade -->
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <label class="form-label">Quantidade</label>
                                        <div class="input-group">
                                            <input type="number" name="medicamentos[0][quantidade]" class="form-control" placeholder="30" min="1" required>
                                            <span class="input-group-text">
                                                <i class="fas fa-hashtag"></i>
                                            </span>
                                        </div>
                                        <small class="form-text text-muted">Qtd. total</small>
                                    </div>

                                    <!-- Unidade -->
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <label class="form-label">Unidade</label>
                                        <select name="medicamentos[0][unidade]" class="form-select" required>
                                            <option value="" disabled selected>Selecione...</option>
                                            <option value="gotas">Gotas</option>
                                            <option value="comprimido">Comprimido</option>
                                            <option value="sache">Sachê</option>
                                            <option value="ml">ML</option>
                                            <option value="aplicacao">Aplicação</option>
                                        </select>
                                        <small class="form-text text-muted">Unidade medida</small>
                                    </div>

                                    <!-- Intervalo -->
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <label class="form-label">Intervalo</label>
                                        <div class="input-group">
                                            <input type="number" name="medicamentos[0][intervalo]" class="form-control" placeholder="8" min="1" required>
                                            <span class="input-group-text">horas</span>
                                        </div>
                                        <small class="form-text text-muted">De 8 em 8 horas</small>
                                    </div>

                                    <!-- Duração -->
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <label class="form-label">Duração</label>
                                        <div class="input-group">
                                            <input type="number" name="medicamentos[0][duracao]" class="form-control" placeholder="72" min="1" required>
                                            <span class="input-group-text">horas</span>
                                        </div>
                                        <small class="form-text text-muted">Total em horas</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botão para adicionar mais medicamentos -->
                <div class="text-center mb-4">
                    <button type="button" id="add-medication-btn" class="btn btn-outline-primary">
                        <i class="fas fa-plus-circle"></i> Adicionar Outro Medicamento
                    </button>
                </div>

                <hr class="my-4">

                <!-- Observações -->
                <div class="form-group mb-4">
                    <label for="observacao" class="form-label">
                        <i class="fas fa-sticky-note"></i> Observações Adicionais
                    </label>
                    <textarea name="observacao" id="observacao" class="form-control" rows="4" 
                              placeholder="Instruções gerais, alertas, contraindicações ou outras informações importantes..."></textarea>
                </div>

                <!-- Botões de ação -->
                <div class="form-actions d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Gerar Prescrição
                    </button>
                    <button type="button" class="btn btn-outline-secondary" onclick="window.history.back()">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {

    $('#paciente').select2({
        placeholder: 'Digite o CPF do paciente...',
        allowClear: true,
        width: '100%'
    });

    function reindexMedications() {
        $('#medications-container .medication-entry').each(function(index) {
            let entry = $(this);
            
            entry.find('.medication-number').text(index + 1);
            
            entry.find('[name]').each(function() {
                let name = $(this).attr('name');
                if (name) {
                    let newName = name.replace(/medicamentos\[\d+\]/g, 'medicamentos[' + index + ']');
                    $(this).attr('name', newName);
                }
            });

            // Mostra/oculta botão de remover
            if (index === 0 && $('#medications-container .medication-entry').length === 1) {
                entry.find('.btn-remove-med').hide();
            } else {
                entry.find('.btn-remove-med').show();
            }
        });
    }

    $('#add-medication-btn').click(function() {
        let newIndex = $('#medications-container .medication-entry').length;
        let newEntry = $('#medications-container .medication-entry').first().clone();

        newEntry.find('input').val('');
        newEntry.find('select').prop('selectedIndex', 0);
        
        newEntry.find('[name]').each(function() {
            let name = $(this).attr('name');
            if (name) {
                let newName = name.replace(/medicamentos\[\d+\]/g, 'medicamentos[' + newIndex + ']');
                $(this).attr('name', newName);
            }
        });

        $('#medications-container').append(newEntry);
        reindexMedications();
        
        $('html, body').animate({
            scrollTop: newEntry.offset().top - 100
        }, 500);
    });

    $('#medications-container').on('click', '.btn-remove-med', function() {
        $(this).closest('.medication-entry').fadeOut(300, function() {
            $(this).remove();
            reindexMedications();
        });
    });

    reindexMedications();
});
</script>



@endsection