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
    
    .select2-container--open {
        z-index: 999999 !important;
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
                    </div>

                <div class="text-center mb-4">
                    <button type="button" id="add-posologia-btn" class="btn btn-outline-primary">
                        <i class="fas fa-plus-circle"></i> Adicionar Posologia
                    </button>
                </div>

                <hr class="my-4">

                <div class="form-group mb-4">
                    <label for="observacao" class="form-label">
                        <i class="fas fa-sticky-note"></i> Observações Adicionais
                    </label>
                    <textarea name="observacao" id="observacao" class="form-control" rows="4" 
                              placeholder="Instruções gerais, alertas, contraindicações ou outras informações importantes..."></textarea>
                </div>

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

<div id="medication-template" style="display: none;">
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

            <div class="dosage-group">
                <h6 class="text-muted mb-3">
                    <i class="fas fa-syringe"></i> Dosagem e Posologia
                </h6>
                
                <div class="row g-3">
                    <div class="col-12 col-sm-6 col-md-3">
                        <label class="form-label">Quantidade</label>
                        <div class="input-group">
                            <input type="number" name="medicamentos[0][quantidade]" class="form-control" placeholder="30" min="1" required>
                            <span class="input-group-text">
                                <i class="fas fa-hashtag"></i>
                            </span>
                        </div>
                        <small class="form-text text-muted">Qtd. por dose</small>
                    </div>

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

                    <div class="col-12 col-sm-6 col-md-3">
                        <label class="form-label">Intervalo</label>
                        <div class="input-group">
                            <input type="number" name="medicamentos[0][intervalo]" class="form-control" placeholder="8" min="1" required>
                            <span class="input-group-text">horas</span>
                        </div>
                        <small class="form-text text-muted">De 8 em 8 horas</small>
                    </div>

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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
$(document).ready(function() {

    $('#paciente').select2({
        placeholder: 'Digite o CPF do paciente...',
        allowClear: true,
        width: '100%'
    });

    function reindexMedications() {
        // Itera apenas sobre os medicamentos DENTRO do container
        $('#medications-container .medication-entry').each(function(index) {
            let entry = $(this);
            
            // Atualiza o número (Medicamento #1, #2, etc)
            entry.find('.medication-number').text(index + 1);
            
            // Atualiza os índices dos nomes (medicamentos[0], medicamentos[1], etc)
            entry.find('[name]').each(function() {
                let name = $(this).attr('name');
                if (name) {
                    let newName = name.replace(/medicamentos\[\d+\]/g, 'medicamentos[' + index + ']');
                    $(this).attr('name', newName);
                }
            });

            // MODIFICADO: Agora o botão de remover sempre aparece
            entry.find('.btn-remove-med').show();
        });
    }

    // --- SCRIPT MODIFICADO ---
    $('#add-posologia-btn').click(function() {
        
        // 1. Pega o HTML dos selects do template ESCONDIDO
        let remediosOptions = $('#medication-template') // Busca no template
                                .find('select[name*="[id]"]')
                                .html();
        
        let unidadeOptions = $('#medication-template') // Busca no template
                               .find('select[name*="[unidade]"]')
                               .html();

        // 2. Define o HTML que aparecerá no SweetAlert
        const swalHtml = `
            <form id="swal-posologia-form" class="text-start p-3">
                <div class="mb-3">
                    <label for="swal-medicamento" class="form-label fw-semibold">Medicamento</label>
                    <select id="swal-medicamento" class="form-select" required>${remediosOptions}</select>
                </div>
                <div class="row g-3">
                    <div class="col-12 col-sm-6">
                        <label for="swal-quantidade" class="form-label fw-semibold">Quantidade</label>
                        <input type="number" id="swal-quantidade" class="form-control" placeholder="ex: 30" min="1" required>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="swal-unidade" class="form-label fw-semibold">Unidade</label>
                        <select id="swal-unidade" class="form-select" required>${unidadeOptions}</select>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-12 col-sm-6">
                        <label for="swal-intervalo" class="form-label fw-semibold">Intervalo</label>
                        <div class="input-group">
                            <input type="number" id="swal-intervalo" class="form-control" placeholder="ex: 8" min="1" required>
                            <span class="input-group-text">horas</span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="swal-duracao" class="form-label fw-semibold">Duração</label>
                        <div class="input-group">
                            <input type="number" id="swal-duracao" class="form-control" placeholder="ex: 72" min="1" required>
                            <span class="input-group-text">horas</span>
                        </div>
                    </div>
                </div>
            </form>
        `;

        // 3. Abre o SweetAlert
        Swal.fire({
            title: 'Adicionar Posologia',
            html: swalHtml,
            width: '800px',
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-plus"></i> Adicionar',
            cancelButtonText: '<i class="fas fa-times"></i> Cancelar',
            confirmButtonColor: '#198754', 
            cancelButtonColor: '#6c757d',
            didOpen: () => {
                $('#swal-medicamento').select2({
                    placeholder: 'Selecione um medicamento...',
                    allowClear: true,
                    width: '100%',
                    dropdownParent: $('.swal2-modal') 
                });
                
                 $('#swal-medicamento').val(null).trigger('change');
                 $('#swal-unidade').val(null);
            },
            preConfirm: () => {
                const med = $('#swal-medicamento').val();
                const qtd = $('#swal-quantidade').val();
                const und = $('#swal-unidade').val();
                const interv = $('#swal-intervalo').val();
                const dur = $('#swal-duracao').val();

                if (!med || !qtd || !und || !interv || !dur) {
                    Swal.showValidationMessage('Por favor, preencha todos os campos.');
                    return false; 
                }
                
                return {
                    id: med,
                    quantidade: qtd,
                    unidade: und,
                    intervalo: interv,
                    duracao: dur
                };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const data = result.value;
                
                // 5. Clona o template de medicamento ESCONDIDO
                let newIndex = $('#medications-container .medication-entry').length;
                let newEntry = $('#medication-template .medication-entry').first().clone(); // Clona do template

                // 6. Preenche os valores no clone com os dados do Swal
                newEntry.find('select[name*="[id]"]').val(data.id);
                newEntry.find('input[name*="[quantidade]"]').val(data.quantidade);
                newEntry.find('select[name*="[unidade]"]').val(data.unidade);
                newEntry.find('input[name*="[intervalo]"]').val(data.intervalo);
                newEntry.find('input[name*="[duracao]"]').val(data.duracao);

                // 7. Re-indexa os nomes dos campos (o newIndex será 0 para o primeiro item)
                newEntry.find('[name]').each(function() {
                    let name = $(this).attr('name');
                    if (name) {
                        let newName = name.replace(/medicamentos\[\d+\]/g, 'medicamentos[' + newIndex + ']');
                        $(this).attr('name', newName);
                    }
                });

                // 8. Adiciona o novo bloco na tela
                newEntry.hide().appendTo('#medications-container').fadeIn(300);
                
                // 9. Re-indexa todos os blocos (para números e botões de remover)
                reindexMedications();
                
                // 10. Rola a tela suavemente para o novo item
                $('html, body').animate({
                    scrollTop: newEntry.offset().top - 100
                }, 500);
            }
        });
    });
    // --- FIM DO SCRIPT MODIFICADO ---


    $('#medications-container').on('click', '.btn-remove-med', function() {
        // Remove o item clicado
        $(this).closest('.medication-entry').fadeOut(300, function() {
            $(this).remove();
            // Re-indexa os itens restantes
            reindexMedications();
        });
    });

    // Roda a reindexação no início (não fará nada, pois o container está vazio)
    reindexMedications();
});
</script>



@endsection