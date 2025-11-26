@extends('Template.layout')

@section('title', 'Prescrição de Medicamentos')

@section('content')

<style>
    /* --- ESTILOS VISUAIS (Mantidos conforme aprovado) --- */
    .medication-entry {
        border: 1px solid #e0e0e0 !important;
        border-radius: 12px !important;
        padding: 20px !important;
        background: #ffffff !important;
        margin-bottom: 20px !important;
        position: relative !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08) !important;
        transition: all 0.3s ease !important;
    }

    .medication-entry:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.12) !important;
        transform: translateY(-2px) !important;
    }

    .medication-title {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
        font-size: 1.3rem !important;
        font-weight: 600 !important;
        margin-bottom: 20px !important;
        color: #2c3e50 !important;
        border-bottom: 2px solid #f0f0f0 !important;
        padding-bottom: 12px !important;
        display: flex !important;
        align-items: center !important;
        padding-right: 90px !important; /* Espaço para botões */
    }

    .input-sketch {
        border: 1px solid #d0d0d0 !important;
        border-radius: 8px !important;
        padding: 10px 14px !important;
        background-color: #fff !important;
        transition: all 0.3s ease !important;
        font-size: 1rem !important;
        height: 45px !important;
    }

    .input-sketch:focus {
        border-color: #4a90e2 !important;
        box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.15) !important;
        outline: none !important;
    }

    .label-sketch {
        font-weight: 600 !important;
        margin-right: 8px !important;
        color: #444 !important;
        font-size: 1rem !important;
        white-space: nowrap !important;
    }

    /* --- BOTÕES DE AÇÃO (Fluxo 3.b) --- */
    .action-buttons {
        position: absolute !important;
        top: 15px !important;
        right: 15px !important;
        display: flex;
        gap: 8px;
    }

    .btn-float {
        border: none !important;
        background: transparent !important;
        font-size: 1.2rem !important;
        width: 35px !important;
        height: 35px !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 0 !important;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    /* Botão Vermelho (Remover) */
    .btn-remove-med {
        color: #e74c3c !important;
        background-color: rgba(231, 76, 60, 0.1);
    }
    .btn-remove-med:hover {
        background-color: #e74c3c !important;
        color: white !important;
        transform: scale(1.1);
    }

    /* Botão Amarelo (Editar) */
    .btn-edit-med {
        color: #f1c40f !important;
        background-color: rgba(241, 196, 15, 0.1);
    }
    .btn-edit-med:hover {
        background-color: #f1c40f !important;
        color: white !important;
        transform: scale(1.1);
    }

    /* Inputs Layout */
    .input-quantidade { width: 100px !important; text-align: center !important; }
    .input-unidade { width: 160px !important; }
    .input-retirada { width: 120px !important; }
    .input-intervalo { width: 120px !important; }
    .input-duracao { width: 120px !important; }

    .medication-entry .row { margin-bottom: 18px !important; }
    .medication-entry .row:last-child { margin-bottom: 0 !important; }

    .quantidade-unidade-group { display: flex !important; align-items: center !important; gap: 20px !important; }
    .intervalo-duracao-group { display: flex !important; align-items: center !important; gap: 25px !important; }
    .retirada-group { display: flex !important; align-items: center !important; gap: 15px !important; }

    /* Responsividade */
    @media (min-width: 1200px) {
        #medications-container {
            display: grid !important;
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 25px !important;
        }
    }
    @media (min-width: 992px) and (max-width: 1199px) {
        #medications-container {
            display: grid !important;
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 20px !important;
        }
    }
    @media (max-width: 768px) {
        .medication-entry { padding: 18px !important; }
        .quantidade-unidade-group, .intervalo-duracao-group, .retirada-group {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 12px !important;
        }
        .input-quantidade, .input-unidade, .input-retirada, .input-intervalo, .input-duracao {
            width: 100% !important; max-width: 100% !important;
        }
    }
</style>

<div class="main-content">
    <div class="content-header mb-4">
        <h2 class="content-title text-primary"><i class="fas fa-file-prescription"></i> Nova Prescrição</h2>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('criar.prescricao') }}" method="POST" id="prescription-form">
                @csrf
                
                <div class="row mb-4">
                    <div class="col-12">
                        <label for="paciente" class="form-label h5"><i class="fas fa-user-injured"></i> Paciente</label>
                        <select name="id_paciente" id="paciente" class="form-select form-select-lg" required>
                            <option value="" disabled selected>Pesquise por CPF ou Nome...</option>
                            @foreach($pacientes as $paciente)
                                <option value="{{ $paciente->id }}">
                                    {{ $paciente->cpf }} - {{ $paciente->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr class="my-4">

                <div class="mb-4">
                    <button type="button" id="add-posologia-btn" class="btn btn-outline-dark border-2 fw-bold">
                        <i class="fas fa-plus"></i> Adicionar posologia
                    </button>
                </div>

                <div id="medications-container">
                    {{-- Cards gerados via JS entrarão aqui --}}
                </div>

                <hr class="mt-5">

                <div class="form-group mb-4">
                    <label class="fw-bold">Observações:</label>
                    <textarea name="observacao" class="form-control input-sketch" rows="4" style="height: auto !important; min-height: 100px;"></textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancelar</button>
                    <button type="submit" class="btn btn-success px-4">Gerar Prescrição</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- 
    ================================================================
    TEMPLATE DO CARD (Escondido)
    ================================================================
--}}
<div id="medication-template" style="display: none;">
    <div class="medication-entry">
        <div class="action-buttons">
            <button type="button" class="btn-float btn-edit-med" title="Editar Medicamento">
                <i class="fas fa-pen"></i>
            </button>
            <button type="button" class="btn-float btn-remove-med" title="Remover Posologia">
                <i class="fas fa-trash-alt"></i>
            </button>
        </div>

        <div class="medication-title">
            <i class="fas fa-pills me-2 text-primary"></i>
            <span class="med-name-display">Nome do Remédio</span>
            <input type="hidden" name="medicamentos[0][id]" class="med-id-input">
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <div class="quantidade-unidade-group">
                    <div class="d-flex align-items-center">
                        <span class="label-sketch">Quantidade:</span>
                        <input type="number" name="medicamentos[0][qtd_tomar]" class="input-sketch input-quantidade" placeholder="1" min="0.1" step="0.1" required>
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="label-sketch">Unidade:</span>
                        <select name="medicamentos[0][unidade]" class="input-sketch input-unidade" required>
                            <option value="comprimido">Comprimido</option>
                            <option value="gotas">Gotas</option>
                            <option value="sache">Sachê</option>
                            <option value="ml">ml</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <div class="retirada-group">
                    <div class="d-flex align-items-center">
                        <span class="label-sketch">Retirada:</span>
                        <input type="number" name="medicamentos[0][quantidade]" class="input-sketch input-retirada" placeholder="30" min="1" required>
                        <small class="text-muted ms-2">unidades</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="intervalo-duracao-group">
                    <div class="d-flex align-items-center">
                        <span class="label-sketch">Intervalo (h):</span>
                        <input type="number" name="medicamentos[0][intervalo]" class="input-sketch input-intervalo" placeholder="8" min="1" required>
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="label-sketch">Duração (h):</span>
                        <input type="number" name="medicamentos[0][duracao]" class="input-sketch input-duracao" placeholder="72" min="1" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Lista fonte simplificada (Backend já filtrou estoque > 0) --}}
<select id="source-medications" style="display: none;">
    @foreach($remedios as $remedio)
        <option value="{{ $remedio->id }}">{{ $remedio->nome }}</option>
    @endforeach
</select>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    let selectedMedications = [];

    // Inicializa Select2 do Paciente
    $('#paciente').select2({ placeholder: 'Selecione o paciente', width: '100%' });

    // Pega medicamentos disponíveis (não repetidos)
    function getAvailableMedications() {
        let availableMedications = '';
        $('#source-medications option').each(function() {
            let medicationId = $(this).val();
            // Especificação 4.1: Não listar medicamentos já selecionados
            if (!selectedMedications.includes(medicationId)) {
                availableMedications += `<option value="${medicationId}">${$(this).text()}</option>`;
            }
        });
        return availableMedications;
    }

    function hasAvailableMedications() {
        return $('#source-medications option').length > selectedMedications.length;
    }

    // Reorganiza índices para o Laravel (array[0], array[1]...)
    function reindexMedications() {
        $('#medications-container .medication-entry').each(function(index) {
            let entry = $(this);
            entry.find('[name]').each(function() {
                let name = $(this).attr('name');
                if (name) {
                    let newName = name.replace(/medicamentos\[\d+\]/g, 'medicamentos[' + index + ']');
                    $(this).attr('name', newName);
                }
            });
        });
    }

    // Função genérica para abrir modal de seleção
    function openMedicationSelector(currentId = null, callback = null) {
        let options = getAvailableMedications();
        
        // Se for edição, precisamos adicionar o atual temporariamente na lista
        if(currentId) {
             let currentText = $('#source-medications option[value="'+currentId+'"]').text();
             options = `<option value="${currentId}" selected>${currentText}</option>` + options;
        }

        Swal.fire({
            title: currentId ? 'Alterar Medicamento' : 'Selecionar Medicamento',
            html: `
                <div class="text-start">
                    <label class="fw-bold mb-2">Busque o medicamento:</label>
                    <select id="swal-med-select" class="form-select w-100">
                        <option value="" disabled ${!currentId ? 'selected' : ''}>Digite para buscar...</option>
                        ${options}
                    </select>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#2c3e50',
            didOpen: () => {
                $('#swal-med-select').select2({
                    dropdownParent: $('.swal2-container'),
                    width: '100%',
                    language: { noResults: () => "Nenhum medicamento encontrado" }
                });
            },
            preConfirm: () => {
                let id = $('#swal-med-select').val();
                let text = $('#swal-med-select option:selected').text();
                
                if (!id) {
                    Swal.showValidationMessage('Selecione um medicamento!');
                    return false;
                }
                return { id: id, nome: text };
            }
        }).then((result) => {
            if (result.isConfirmed && callback) {
                callback(result.value);
            }
        });
    }

    // --- Ação: Adicionar Nova Posologia ---
    $('#add-posologia-btn').click(function() {
        if (!hasAvailableMedications()) {
            Swal.fire('Aviso', 'Todos os medicamentos disponíveis já foram adicionados.', 'info');
            return;
        }

        openMedicationSelector(null, function(dados) {
            addMedicationCard(dados.id, dados.nome);
        });
    });

    function addMedicationCard(id, nome) {
        selectedMedications.push(id);
        let template = $('#medication-template .medication-entry').clone();

        template.find('.med-name-display').text(nome);
        template.find('.med-id-input').val(id);

        template.hide().appendTo('#medications-container').fadeIn(300);
        reindexMedications();
        updateAddButtonState();
    }

    // --- Ação: Editar Medicamento (Botão Amarelo) ---
    $(document).on('click', '.btn-edit-med', function() {
        let card = $(this).closest('.medication-entry');
        let currentId = card.find('.med-id-input').val();
        
        openMedicationSelector(currentId, function(dados) {
            // Se o usuário trocou o remédio
            if(dados.id !== currentId) {
                selectedMedications = selectedMedications.filter(id => id !== currentId);
                selectedMedications.push(dados.id);
            }
            
            card.find('.med-name-display').text(dados.nome);
            card.find('.med-id-input').val(dados.id);
            // Foca na quantidade para facilitar a edição
            card.find('.input-quantidade').focus();
        });
    });

    // --- Ação: Remover (Botão Vermelho) ---
    $(document).on('click', '.btn-remove-med', function() {
        let card = $(this).closest('.medication-entry');
        let medicationId = card.find('.med-id-input').val();
        
        Swal.fire({
            title: 'Remover posologia?',
            text: "Este item será excluído da prescrição.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74c3c',
            confirmButtonText: 'Sim, remover'
        }).then((result) => {
            if (result.isConfirmed) {
                selectedMedications = selectedMedications.filter(id => id !== medicationId);
                card.fadeOut(300, function() {
                    $(this).remove();
                    reindexMedications();
                    updateAddButtonState();
                });
            }
        });
    });

    function updateAddButtonState() {
        let btn = $('#add-posologia-btn');
        if (!hasAvailableMedications()) {
            btn.prop('disabled', true).addClass('btn-outline-secondary').removeClass('btn-outline-dark');
            btn.html('<i class="fas fa-check"></i> Todos medicamentos adicionados');
        } else {
            btn.prop('disabled', false).addClass('btn-outline-dark').removeClass('btn-outline-secondary');
            btn.html('<i class="fas fa-plus"></i> Adicionar posologia');
        }
    }

    // Validação extra no submit (Garante Fluxo 4.3)
    $('#prescription-form').on('submit', function(e) {
        if ($('.medication-entry').length === 0) {
            e.preventDefault();
            Swal.fire('Erro', 'Adicione pelo menos uma posologia antes de salvar.', 'error');
            return;
        }
    });

    // Inicializa botão
    updateAddButtonState();
});
</script>

@endsection