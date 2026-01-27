@extends('Template.layout')

@section('title', 'Nova Prescrição')

@section('content')

<style>
    /* Estilos Específicos da Prescrição - CARD MENOR */
    .medication-entry {
        border: 1px solid #e0e0e0 !important;
        border-radius: 10px !important;
        padding: 15px !important;
        background: #ffffff !important;
        margin-bottom: 20px !important;
        position: relative !important;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05) !important;
        transition: all 0.3s ease !important;
        height: 100% !important;
    }
    .medication-entry:hover {
        box-shadow: 0 4px 10px rgba(0,0,0,0.1) !important;
        transform: translateY(-2px) !important;
    }
    .medication-title {
        font-size: 0.95rem !important;
        font-weight: 600 !important;
        color: #2c3e50 !important;
        border-bottom: 1px solid #f0f0f0 !important;
        padding-bottom: 8px !important;
        margin-bottom: 12px !important;
        line-height: 1.3 !important;
    }
    .action-buttons {
        position: absolute !important; 
        top: 10px !important; 
        right: 10px !important; 
        display: flex !important; 
        gap: 5px !important;
        z-index: 10 !important;
    }
    .btn-float {
        border: none !important; 
        background: transparent !important; 
        width: 28px !important; 
        height: 28px !important;
        border-radius: 50% !important; 
        display: flex !important; 
        align-items: center !important; 
        justify-content: center !important;
        cursor: pointer !important; 
        transition: 0.2s !important;
        font-size: 0.85rem !important;
    }
    .btn-remove-med { 
        color: #e74c3c !important; 
        background: rgba(231,76,60,0.1) !important; 
    }
    .btn-remove-med:hover { 
        background: #e74c3c !important; 
        color: white !important; 
        transform: scale(1.05) !important;
    }
    
    .btn-edit-med { 
        color: #f1c40f !important; 
        background: rgba(241,196,15,0.1) !important; 
    }
    .btn-edit-med:hover { 
        background: #f1c40f !important; 
        color: white !important;
        transform: scale(1.05) !important;
    }

    /* Inputs Sketchy Style - TAMANHO REDUZIDO */
    .input-sketch {
        border: 1px solid #ced4da !important;
        border-radius: 5px !important;
        padding: 6px 10px !important;
        font-size: 0.875rem !important;
        height: 36px !important;
    }
    .input-quantidade { 
        width: 70px !important; 
        text-align: center !important; 
    }
    .input-unidade { 
        width: 110px !important; 
    }
    .input-numerico { 
        width: 100% !important;
        font-size: 0.875rem !important;
        height: 36px !important;
    }
    
    /* Grid para 2 cards por linha */
    #medications-container {
        display: grid !important;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)) !important;
        gap: 15px !important;
    }
    
    /* Ajustes para responsividade */
    @media (max-width: 768px) {
        #medications-container {
            grid-template-columns: 1fr !important;
        }
        .medication-entry {
            padding: 12px !important;
        }
    }
    
    /* Labels menores */
    .medication-entry label {
        font-size: 0.8rem !important;
        margin-bottom: 3px !important;
    }
    
    /* Input groups menores */
    .input-group-text {
        font-size: 0.8rem !important;
        padding: 6px 10px !important;
    }
    
    /* Espaçamento interno reduzido */
    .medication-entry .row {
        margin-left: -5px !important;
        margin-right: -5px !important;
    }
    
    .medication-entry .col-md-4 {
        padding-left: 5px !important;
        padding-right: 5px !important;
    }
</style>

<div class="main-content">
    
    {{-- Cabeçalho --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-primary fw-bold"><i class="fas fa-file-medical-alt"></i> Nova Prescrição</h2>
            <p class="text-muted mb-0">
                Paciente: <strong class="text-dark">{{ $paciente->nome }}</strong> 
                <span class="mx-2">|</span> 
                CPF: {{ $paciente->cpf }}
            </p>
        </div>
        {{-- Botão para voltar para a rota index do médico --}}
        {{-- Ajuste 'medico.index' para o nome correto da sua rota de lista --}}
        <a href="{{ route('medico.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Voltar para Lista
        </a>
    </div>

    {{-- Card Principal --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            
            <form action="{{ route('criar.prescricao') }}" method="POST" id="prescription-form">
                @csrf
                
                {{-- ID do Paciente vindo do Controller --}}
                <input type="hidden" name="id_paciente" value="{{ $paciente->id }}">

                {{-- Área de Adicionar Medicamento --}}
                <div class="mb-4 text-center p-4 bg-light rounded border border-dashed">
                    <button type="button" id="add-posologia-btn" class="btn btn-dark btn-lg px-5">
                        <i class="fas fa-plus-circle me-2"></i> Adicionar Medicamento
                    </button>
                    <div class="mt-2 text-muted small">Clique para buscar e adicionar medicamentos da farmácia</div>
                </div>

                {{-- Container onde os cards serão inseridos - AGORA COM GRID --}}
                <div id="medications-container"></div>

                <hr class="my-5">

                {{-- Observações --}}
                <div class="form-group mb-4">
                    <label class="fw-bold mb-2 h5"><i class="fas fa-comment-medical text-secondary"></i> Observações Clínicas / Recomendações:</label>
                    <textarea name="observacao" class="form-control bg-light" rows="4" placeholder="Descreva aqui recomendações adicionais, orientações de dieta, retorno, etc..."></textarea>
                </div>

                {{-- Botões de Ação --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('medico.index') }}" class="btn btn-light border btn-lg px-4">Cancelar</a>
                    <button type="submit" class="btn btn-success btn-lg px-5 shadow-sm">
                        <i class="fas fa-check-circle me-2"></i> Finalizar Prescrição
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- TEMPLATE DO CARD (Oculto - usado pelo JS) - AJUSTADO PARA TAMANHO MENOR --}}
<div id="medication-template" style="display: none;">
    <div class="medication-entry">
        <div class="action-buttons">
            <button type="button" class="btn-float btn-edit-med" title="Editar Medicamento"><i class="fas fa-pen"></i></button>
            <button type="button" class="btn-float btn-remove-med" title="Remover Medicamento"><i class="fas fa-trash-alt"></i></button>
        </div>

        <div class="medication-title">
             <i class="fas fa-pills me-2 text-primary"></i> <span class="med-name-display">Nome do Medicamento</span>
             <input type="hidden" name="medicamentos[0][id]" class="med-id-input">
        </div>

        <div class="row gy-2">
            {{-- Linha 1: Posologia Básica --}}
            <div class="col-12 mb-2">
                <div class="d-flex flex-wrap gap-2 align-items-center">
                    <div class="d-flex align-items-center bg-light p-1 rounded flex-grow-1" style="min-width: 120px;">
                        <span class="me-2 fw-bold text-secondary small">Tomar:</span>
                        <input type="number" name="medicamentos[0][qtd_tomar]" class="input-sketch input-quantidade form-control border-0 bg-transparent p-1" placeholder="0" step="0.1" required style="flex: 1;">
                    </div>
                    <div class="d-flex align-items-center bg-light p-1 rounded flex-grow-1" style="min-width: 120px;">
                        <span class="me-2 fw-bold text-secondary small">Forma:</span>
                        <select name="medicamentos[0][unidade]" class="input-sketch input-unidade form-select border-0 bg-transparent p-1" required style="flex: 1;">
                            <option value="comprimido">Comprimido(s)</option>
                            <option value="gotas">Gota(s)</option>
                            <option value="ml">ml</option>
                            <option value="sache">Sachê</option>
                            <option value="ampola">Ampola</option>
                            <option value="colher">Colher</option>
                            <option value="aplicacao">Aplicação</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Linha 2: Dados Numéricos --}}
            <div class="col-12">
                <div class="row g-2">
                    <div class="col-4">
                        <label class="small text-muted fw-bold">Retirada</label>
                        <div class="input-group input-group-sm">
                            <input type="number" name="medicamentos[0][quantidade]" class="form-control input-numerico" placeholder="Ex: 30" required>
                            <span class="input-group-text bg-white py-1 px-2"><i class="fas fa-box-open fa-xs"></i></span>
                        </div>
                    </div>
                    <div class="col-4">
                        <label class="small text-muted fw-bold">Intervalo</label>
                        <div class="input-group input-group-sm">
                            <input type="number" name="medicamentos[0][intervalo]" class="form-control input-numerico" placeholder="Ex: 8" required>
                            <span class="input-group-text bg-white py-1 px-2">h</span>
                        </div>
                    </div>
                    <div class="col-4">
                        <label class="small text-muted fw-bold">Duração</label>
                        <div class="input-group input-group-sm">
                            <input type="number" name="medicamentos[0][duracao]" class="form-control input-numerico" placeholder="Ex: 7" required>
                            <span class="input-group-text bg-white py-1 px-2"><i class="fas fa-calendar-alt fa-xs"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Pequena legenda --}}
            <div class="col-12 mt-2">
                <small class="text-muted d-block text-center">
                    <i class="fas fa-info-circle fa-xs"></i> 
                    Dados para farmácia
                </small>
            </div>
        </div>
    </div>
</div>

{{-- FONTE DE DADOS PARA O SELECT2 (Filtrado no Controller) --}}
<select id="source-medications" style="display: none;">
    @foreach($remedios as $remedio)
        <option value="{{ $remedio->id }}">{{ $remedio->nome }} (Estoque: {{ $remedio->estoques_sum_quantidade }})</option>
    @endforeach
</select>

{{-- SCRIPTS --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    let selectedMedications = [];

    // --- FUNÇÕES AUXILIARES ---
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

    // Renomeia os inputs para o formato de array do Laravel: medicamentos[0], medicamentos[1]...
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

    function updateAddButtonState() {
        let btn = $('#add-posologia-btn');
        if (!hasAvailableMedications()) {
            btn.prop('disabled', true).removeClass('btn-dark').addClass('btn-secondary');
            btn.html('<i class="fas fa-check"></i> Todos medicamentos adicionados');
        } else {
            btn.prop('disabled', false).removeClass('btn-secondary').addClass('btn-dark');
            btn.html('<i class="fas fa-plus-circle"></i> Adicionar Medicamento');
        }
    }

    // --- SELETOR DE REMÉDIO COM SWEETALERT + SELECT2 ---
    function openMedicationSelector(currentId = null, callback = null) {
        let options = getAvailableMedications();
        
        // Se estiver editando, recoloca o item atual na lista de opções
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
                    placeholder: "Selecione um medicamento",
                    allowClear: true,
                    language: { noResults: () => "Nenhum medicamento encontrado no estoque" }
                });
            },
            preConfirm: () => {
                let id = $('#swal-med-select').val();
                let text = $('#swal-med-select option:selected').text();
                if (!id) {
                    Swal.showValidationMessage('Por favor, selecione um medicamento!');
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

    // --- EVENTOS DE CLIQUE ---

    // 1. Adicionar Medicamento
    $('#add-posologia-btn').click(function() {
        if (!hasAvailableMedications()) {
            Swal.fire('Estoque Esgotado', 'Todos os medicamentos disponíveis já foram adicionados à lista.', 'info');
            return;
        }
        openMedicationSelector(null, function(dados) {
            addMedicationCard(dados.id, dados.nome);
        });
    });

    function addMedicationCard(id, nome) {
        selectedMedications.push(id);
        let template = $('#medication-template .medication-entry').clone();
        
        // Limpa o nome para tirar a info de estoque visualmente no card, se quiser
        let nomeLimpo = nome.split(' (Estoque:')[0]; 
        
        template.find('.med-name-display').text(nomeLimpo);
        template.find('.med-id-input').val(id);
        
        template.hide().appendTo('#medications-container').fadeIn(300);
        reindexMedications();
        updateAddButtonState();
    }

    // 2. Editar Medicamento
    $(document).on('click', '.btn-edit-med', function() {
        let card = $(this).closest('.medication-entry');
        let currentId = card.find('.med-id-input').val();
        
        openMedicationSelector(currentId, function(dados) {
            // Se o usuário trocou o medicamento
            if(dados.id !== currentId) {
                selectedMedications = selectedMedications.filter(id => id !== currentId);
                selectedMedications.push(dados.id);
            }
            let nomeLimpo = dados.nome.split(' (Estoque:')[0];
            card.find('.med-name-display').text(nomeLimpo);
            card.find('.med-id-input').val(dados.id);
            // Pisca o input de quantidade para indicar que pode editar
            card.find('.input-quantidade').focus().addClass('bg-warning').delay(200).queue(function(next){
                $(this).removeClass('bg-warning'); next();
            });
        });
    });

    // 3. Remover Medicamento
    $(document).on('click', '.btn-remove-med', function() {
        let card = $(this).closest('.medication-entry');
        let medicationId = card.find('.med-id-input').val();
        
        Swal.fire({
            title: 'Remover?',
            text: "Deseja retirar este medicamento da prescrição?",
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

    // 4. Validação ao Enviar Formulário
    $('#prescription-form').on('submit', function(e) {
        if ($('.medication-entry').length === 0) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Prescrição Vazia',
                text: 'Adicione pelo menos um medicamento antes de finalizar.',
                confirmButtonColor: '#e74c3c'
            });
            return;
        }
    });

    // Inicializa o estado do botão
    updateAddButtonState();
});
</script>

@endsection