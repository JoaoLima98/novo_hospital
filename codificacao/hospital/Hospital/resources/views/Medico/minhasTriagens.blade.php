@extends('Template.layout')

@section('title', 'Atendimento Médico')

@section('content')

<style>
    /* --- ESTILOS DA TRIAGEM (Novos) --- */
    .bg-manchester-emergencia { background-color: #e74c3c; color: white; }
    .bg-manchester-muito-urgente { background-color: #e67e22; color: white; }
    .bg-manchester-urgente { background-color: #f1c40f; color: black; }
    .bg-manchester-pouco-urgente { background-color: #27ae60; color: white; }
    .bg-manchester-nao-urgente { background-color: #3498db; color: white; }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
        cursor: pointer; /* Indica que é clicável */
    }

    /* --- ESTILOS DOS CARDS DE REMÉDIO (Antigos - Mantidos) --- */
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
        font-size: 1.2rem !important;
        font-weight: 600 !important;
        color: #2c3e50 !important;
        border-bottom: 2px solid #f0f0f0 !important;
        padding-bottom: 12px !important;
        margin-bottom: 15px !important;
    }
    .input-sketch {
        border: 1px solid #d0d0d0 !important;
        border-radius: 8px !important;
        padding: 8px 12px !important;
        height: 40px !important;
    }
    .label-sketch { font-weight: 600; margin-right: 5px; color: #555; }
    
    /* Botões flutuantes do card */
    .action-buttons {
        position: absolute; top: 15px; right: 15px; display: flex; gap: 8px;
    }
    .btn-float {
        border: none; background: transparent; width: 32px; height: 32px;
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: 0.2s;
    }
    .btn-remove-med { color: #e74c3c; background: rgba(231,76,60,0.1); }
    .btn-remove-med:hover { background: #e74c3c; color: white; transform: scale(1.1); }
    .btn-edit-med { color: #f1c40f; background: rgba(241,196,15,0.1); }
    .btn-edit-med:hover { background: #f1c40f; color: white; transform: scale(1.1); }

    /* Inputs específicos */
    .input-quantidade { width: 90px !important; text-align: center; }
    .input-unidade { width: 140px !important; }
    .input-numerico { width: 100% !important; }

    /* Utilitários */
    .hidden-section { display: none; }
</style>

<div class="main-content">
    
    {{-- =================================================================== --}}
    {{-- SEÇÃO 1: LISTA DE PRIORIDADE (TRIAGEM) --}}
    {{-- =================================================================== --}}
    <div id="section-lista-espera">
        <div class="content-header mb-4">
            <h2 class="content-title text-primary"><i class="fas fa-list-ol"></i> Minhas Triagens</h2>
            <p class="text-muted">Ordem: Manchester > Glasgow > Chegada</p>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Paciente</th>
                                <th>Manchester</th>
                                <th class="text-center">Glasgow</th>
                                <th>Chegada</th>
                                <th class="text-center">Detalhes</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pacientes as $paciente)
                                @php
                                    // Proteção contra nulos caso alguma triagem esteja incompleta
                                    $manchester = $paciente->triagem->manchester_classificacao ?? 'Não Urgente';
                                    $glasgow = $paciente->triagem->glasgow ?? '-';
                                    $dataChegada = $paciente->triagem->created_at ?? now();

                                    $classeCor = match($manchester) {
                                        'Emergência' => 'bg-manchester-emergencia',
                                        'Muito Urgente' => 'bg-manchester-muito-urgente',
                                        'Urgente' => 'bg-manchester-urgente',
                                        'Pouco Urgente' => 'bg-manchester-pouco-urgente',
                                        default => 'bg-manchester-nao-urgente',
                                    };
                                @endphp
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold">{{ $paciente->nome }}</div>
                                        <small class="text-muted">{{ $paciente->cpf }}</small>
                                    </td>
                                    <td><span class="badge {{ $classeCor }} rounded-pill px-3 py-2">{{ $manchester }}</span></td>
                                    <td class="text-center fw-bold">{{ $glasgow }}</td>
                                    <td>{{ \Carbon\Carbon::parse($dataChegada)->format('H:i') }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-info btn-ver-detalhes" 
                                                data-nome="{{ $paciente->nome }}"
                                                {{-- Dados Vitais --}}
                                                data-pressao="{{ $paciente->triagem->pressao_sistolica ?? '-' }}x{{ $paciente->triagem->pressao_diastolica ?? '-' }}"
                                                data-temperatura="{{ $paciente->triagem->temperatura ?? '-' }}"
                                                data-bpm="{{ $paciente->triagem->frequencia_cardiaca ?? '-' }}"
                                                data-spo2="{{ $paciente->triagem->spo2 ?? '-' }}"
                                                data-glicemia="{{ $paciente->triagem->glicemia ?? '-' }}"
                                                data-dor="{{ $paciente->triagem->escore_dor ?? '-' }}"
                                                
                                                {{-- Classificações --}}
                                                data-manchester="{{ $manchester }}" {{-- Já calculado no seu PHP --}}
                                                data-glasgow="{{ $glasgow }}"
                                                
                                                {{-- Antropometria --}}
                                                data-peso="{{ $paciente->triagem->peso ?? '-' }}"
                                                data-altura="{{ $paciente->triagem->altura_cm ?? '-' }}"

                                                {{-- Histórico --}}
                                                data-queixa="{{ $paciente->triagem->queixa_principal ?? '---' }}"
                                                data-alergias="{{ $paciente->triagem->alergias ?? 'Nega' }}"
                                                data-medicacao="{{ $paciente->triagem->medicacao_uso ?? 'Nega' }}"
                                                data-sintomas-gripais="{{ $paciente->triagem->sintomas_gripais ? 'Sim' : 'Não' }}"

                                                {{-- Contexto / Acidentes --}}
                                                data-chegada-tipo="{{ $paciente->triagem->tipo_chegada ?? 'Espontânea' }}"
                                                data-acidente-trabalho="{{ $paciente->triagem->acidente_trabalho ? 'Sim' : 'Não' }}"
                                                data-acidente-veiculo="{{ $paciente->triagem->acidente_veiculo ? 'Sim' : 'Não' }}"
                                                
                                                {{-- Meta --}}
                                                data-chegada="{{ \Carbon\Carbon::parse($dataChegada)->format('H:i') }}"
                                                data-enfermeiro="{{ $paciente->triagem->enfermeiro->nome ?? '---' }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="text-center py-5">Nenhum paciente na fila.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- =================================================================== --}}
    {{-- SEÇÃO 2: FORMULÁRIO DE PRESCRIÇÃO --}}
    {{-- =================================================================== --}}
    <div id="section-prescricao" class="hidden-section">
        <div class="content-header mb-4 d-flex justify-content-between align-items-center">
            <h2 class="content-title text-success"><i class="fas fa-user-md"></i> Prescrição: <span id="lbl-paciente-nome">---</span></h2>
            <button class="btn btn-outline-secondary" id="btn-voltar-lista">
                <i class="fas fa-arrow-left"></i> Voltar
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('criar.prescricao') }}" method="POST" id="prescription-form">
                    @csrf
                    <input type="hidden" name="id_paciente" id="id_paciente_hidden">

                    {{-- Botão Principal (Abre o SweetAlert) --}}
                    <div class="mb-4 text-center p-4 bg-light rounded border border-dashed">
                        <button type="button" id="add-posologia-btn" class="btn btn-dark btn-lg">
                            <i class="fas fa-plus-circle me-2"></i> Adicionar Medicamento
                        </button>
                    </div>

                    <div id="medications-container">
                        {{-- Cards serão inseridos aqui --}}
                    </div>

                    <hr class="mt-5">

                    <div class="form-group mb-4">
                        <label class="fw-bold">Observações:</label>
                        <textarea name="observacao" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success btn-lg px-5">Finalizar Prescrição</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

{{-- TEMPLATE DO CARD DE MEDICAMENTO (Oculto) --}}
<div id="medication-template" style="display: none;">
    <div class="medication-entry">
        <div class="action-buttons">
            <button type="button" class="btn-float btn-edit-med" title="Editar"><i class="fas fa-pen"></i></button>
            <button type="button" class="btn-float btn-remove-med" title="Remover"><i class="fas fa-trash-alt"></i></button>
        </div>

        <div class="medication-title">
             <i class="fas fa-pills me-2 text-primary"></i> <span class="med-name-display">Nome</span>
             <input type="hidden" name="medicamentos[0][id]" class="med-id-input">
        </div>

        <div class="row mb-3">
            <div class="col-12 d-flex align-items-center gap-3">
                <div class="d-flex align-items-center">
                    <span class="label-sketch">Qtd:</span>
                    <input type="number" name="medicamentos[0][qtd_tomar]" class="input-sketch input-quantidade" step="0.1" required>
                </div>
                <div class="d-flex align-items-center">
                    <span class="label-sketch">Unidade:</span>
                    <select name="medicamentos[0][unidade]" class="input-sketch input-unidade" required>
                        <option value="comprimido">Comprimido</option>
                        <option value="gotas">Gotas</option>
                        <option value="sache">Sachê</option>
                        <option value="ml">ml</option>
                        <option value="ampola">Ampola</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
             <div class="col-12 d-flex gap-3 flex-wrap">
                <div class="flex-grow-1">
                    <input type="number" name="medicamentos[0][quantidade]" class="input-sketch input-numerico" placeholder="Retirada (un)" required>
                </div>
                <div class="flex-grow-1">
                    <input type="number" name="medicamentos[0][intervalo]" class="input-sketch input-numerico" placeholder="Intervalo (h)" required>
                </div>
                <div class="flex-grow-1">
                    <input type="number" name="medicamentos[0][duracao]" class="input-sketch input-numerico" placeholder="Duração (h)" required>
                </div>
             </div>
        </div>
    </div>
</div>

{{-- SCRIPTS --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    
    // =========================================================
    // PARTE 1: NAVEGAÇÃO E LISTA DE ESPERA
    // =========================================================

    // Abrir Modal de Detalhes com SweetAlert
    $('.btn-ver-detalhes').click(function() {
    let btn = $(this);
    
    // Cores do Manchester (Mantido sua lógica)
    let manchester = btn.data('manchester');
    let badgeClass = '';
    switch(manchester) {
        case 'Emergência': badgeClass = 'bg-manchester-emergencia'; break;
        case 'Muito Urgente': badgeClass = 'bg-manchester-muito-urgente'; break;
        case 'Urgente': badgeClass = 'bg-manchester-urgente'; break;
        case 'Pouco Urgente': badgeClass = 'bg-manchester-pouco-urgente'; break;
        default: badgeClass = 'bg-manchester-nao-urgente';
    }
    
    // Lógica visual para Alergias (Vermelho se tiver alergia)
    let alergias = btn.data('alergias');
    let alergiaClass = (alergias !== 'Nega' && alergias !== '') ? 'alert-danger' : 'alert-light';

    Swal.fire({
        title: `<strong>${btn.data('nome')}</strong>`,
        html: `
            <div class="text-start" style="font-size: 0.9rem;">
                
                <div class="d-flex justify-content-between align-items-center mb-3 p-2 rounded bg-light border">
                    <span class="badge ${badgeClass} rounded-pill px-3 py-2 fs-6">${manchester}</span>
                    <div class="d-flex gap-2">
                        <span class="badge bg-secondary" title="Escala de Coma de Glasgow">Glasgow: ${btn.data('glasgow')}</span>
                        <span class="badge bg-dark" title="Escala de Dor (0-10)">Dor: ${btn.data('dor')}</span>
                    </div>
                </div>

                <h6 class="text-primary border-bottom pb-1 mb-2"><i class="fas fa-heartbeat me-1"></i> Sinais Vitais & Biometria</h6>
                <div class="row g-2 mb-3 text-center">
                    <div class="col-4">
                        <div class="p-2 border rounded bg-white h-100">
                            <small class="text-muted d-block">Pressão</small>
                            <span class="fw-bold text-dark">${btn.data('pressao')}</span> <small>mmHg</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-2 border rounded bg-white h-100">
                            <small class="text-muted d-block">Temp.</small>
                            <span class="fw-bold text-danger">${btn.data('temperatura')}</span> <small>°C</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-2 border rounded bg-white h-100">
                            <small class="text-muted d-block">BPM</small>
                            <span class="fw-bold text-dark">${btn.data('bpm')}</span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-2 border rounded bg-white h-100">
                            <small class="text-muted d-block">SpO2</small>
                            <span class="fw-bold text-primary">${btn.data('spo2')}%</span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-2 border rounded bg-white h-100">
                            <small class="text-muted d-block">Glicemia</small>
                            <span class="fw-bold text-warning">${btn.data('glicemia')}</span> <small>mg/dl</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-2 border rounded bg-white h-100">
                            <small class="text-muted d-block">Peso / Altura</small>
                            <span class="fw-bold">${btn.data('peso')}kg</span> / ${btn.data('altura')}cm
                        </div>
                    </div>
                </div>

                <h6 class="text-primary border-bottom pb-1 mb-2"><i class="fas fa-file-medical me-1"></i> Anamnese</h6>
                
                <div class="mb-2">
                    <label class="fw-bold text-muted small">Queixa Principal:</label>
                    <div class="p-2 border rounded bg-light text-dark">
                        ${btn.data('queixa')}
                    </div>
                </div>

                <div class="row g-2 mb-2">
                    <div class="col-md-6">
                        <div class="alert ${alergiaClass} mb-0 p-2 small">
                            <strong><i class="fas fa-exclamation-circle"></i> Alergias:</strong><br>
                            ${alergias}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-light border mb-0 p-2 small">
                            <strong><i class="fas fa-pills"></i> Medicamentos:</strong><br>
                            ${btn.data('medicacao')}
                        </div>
                    </div>
                </div>

                <div class="accordion accordion-flush border rounded mt-3" id="accordionContexto">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed py-2 bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInfo" aria-expanded="false">
                                <i class="fas fa-info-circle me-2"></i> Informações Adicionais
                            </button>
                        </h2>
                        <div id="collapseInfo" class="accordion-collapse collapse" data-bs-parent="#accordionContexto">
                            <div class="accordion-body p-2 small">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between px-0">
                                        <span>Sintomas Gripais:</span>
                                        <span class="fw-bold">${btn.data('sintomas-gripais')}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between px-0">
                                        <span>Tipo Chegada:</span>
                                        <span class="fw-bold">${btn.data('chegada-tipo')}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between px-0">
                                        <span>Acidente Trabalho:</span>
                                        <span class="fw-bold text-danger">${btn.data('acidente-trabalho')}</span>
                                    </li>
                                     <li class="list-group-item d-flex justify-content-between px-0">
                                        <span>Acidente Veículo:</span>
                                        <span class="fw-bold text-danger">${btn.data('acidente-veiculo')}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-end text-muted mt-3 pt-2 border-top">
                    <small style="font-size: 0.75rem;">
                        <i class="fas fa-user-nurse"></i> Enf. ${btn.data('enfermeiro')} &bull; 
                        <i class="fas fa-clock"></i> Chegada: ${btn.data('chegada')}
                    </small>
                </div>
            </div>
        `,
        width: '650px',
        showCloseButton: true,
        showConfirmButton: false, // Removemos o OK para limpar a tela, o X fecha
        focusConfirm: false,
        background: '#ffffff'
    });
});

    // Clicar em "Atender" - Vai para o formulário
    $('.btn-atender').click(function() {
        let id = $(this).data('id');
        let nome = $(this).data('nome');

        $('#id_paciente_hidden').val(id);
        $('#lbl-paciente-nome').text(nome);

        $('#section-lista-espera').fadeOut(300, function() {
            $('#section-prescricao').fadeIn(300);
        });
    });

    // Clicar em "Voltar" - Limpa e volta para a lista
    $('#btn-voltar-lista').click(function(e) {
        e.preventDefault();
        $('#section-prescricao').fadeOut(300, function() {
            $('#section-lista-espera').fadeIn(300);
            
            // Limpa o form para o próximo paciente
            $('#medications-container').empty(); 
            selectedMedications = [];
            $('#prescription-form')[0].reset();
            updateAddButtonState();
        });
    });

    // =========================================================
    // PARTE 2: LÓGICA DE PRESCRIÇÃO (Código Antigo Adaptado)
    // =========================================================
    let selectedMedications = [];

    // Retorna opções do Select (filtrando o que já foi escolhido)
    function getAvailableMedications() {
        let options = '';
        $('#source-medications option').each(function() {
            let id = $(this).val();
            if (!selectedMedications.includes(id)) {
                options += `<option value="${id}">${$(this).text()}</option>`;
            }
        });
        return options;
    }

    function hasAvailableMedications() {
        return $('#source-medications option').length > selectedMedications.length;
    }

    // Reorganiza índices do array para o Laravel entender (medicamentos[0], [1]...)
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

    // Abre o SweetAlert com Select2 dentro
    function openMedicationSelector(currentId = null, callback = null) {
        let options = getAvailableMedications();
        
        // Se for edição, injeta o atual de volta na lista temporariamente
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
                // Inicializa o Select2 DENTRO do modal do Swal
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

    // --- CLICK: Adicionar Nova Posologia ---
    $('#add-posologia-btn').click(function() {
        if (!hasAvailableMedications()) {
            Swal.fire({
                icon: 'info',
                title: 'Aviso',
                text: 'Todos os medicamentos disponíveis já foram adicionados.',
                confirmButtonColor: '#3085d6'
            });
            return;
        }
        openMedicationSelector(null, function(dados) {
            addMedicationCard(dados.id, dados.nome);
        });
    });

    // Cria o HTML do card
    function addMedicationCard(id, nome) {
        selectedMedications.push(id);
        let template = $('#medication-template .medication-entry').clone();

        template.find('.med-name-display').text(nome);
        template.find('.med-id-input').val(id);

        template.hide().appendTo('#medications-container').fadeIn(300);
        reindexMedications();
        updateAddButtonState();
    }

    // --- CLICK: Editar Medicamento ---
    $(document).on('click', '.btn-edit-med', function() {
        let card = $(this).closest('.medication-entry');
        let currentId = card.find('.med-id-input').val();
        
        openMedicationSelector(currentId, function(dados) {
            // Se trocou de remédio
            if(dados.id !== currentId) {
                selectedMedications = selectedMedications.filter(id => id !== currentId);
                selectedMedications.push(dados.id);
            }
            
            card.find('.med-name-display').text(dados.nome);
            card.find('.med-id-input').val(dados.id);
            card.find('.input-quantidade').focus();
        });
    });

    // --- CLICK: Remover Medicamento ---
    $(document).on('click', '.btn-remove-med', function() {
        let card = $(this).closest('.medication-entry');
        let medicationId = card.find('.med-id-input').val();
        
        Swal.fire({
            title: 'Remover Medicamento?',
            text: "Este item será excluído da prescrição.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74c3c',
            confirmButtonText: 'Sim, remover',
            cancelButtonText: 'Cancelar'
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

    // Atualiza estado do botão "Adicionar" (desabilita se acabar os remédios)
    function updateAddButtonState() {
        let btn = $('#add-posologia-btn');
        if (!hasAvailableMedications()) {
            btn.prop('disabled', true).addClass('btn-secondary').removeClass('btn-dark');
            btn.html('<i class="fas fa-check"></i> Todos medicamentos adicionados');
        } else {
            btn.prop('disabled', false).addClass('btn-dark').removeClass('btn-secondary');
            btn.html('<i class="fas fa-plus-circle"></i> Adicionar Medicamento');
        }
    }

    // Validação antes do Submit
    $('#prescription-form').on('submit', function(e) {
        if ($('.medication-entry').length === 0) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'Adicione pelo menos um medicamento antes de salvar.',
                confirmButtonColor: '#e74c3c'
            });
            return;
        }
    });

    updateAddButtonState();
});
</script>

@endsection