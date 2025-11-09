@extends('Template.layout')

@section('title', 'Prescrição de Medicamentos')

@section('content')
<div class="main-content">
    <div class="content-header">
        <h2 class="content-title"><i class="fas fa-file-prescription"></i>Prescrição de Medicamentos</h2>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{route('criar.prescricao') }}" method="POST" id="prescription-form">
                @csrf
                <div class="form-group mb-3">
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

                
                <label class="form-label">Medicamentos</label>
                <div id="medications-container">
                    <div class="input-group mb-2 medication-entry">
                        <select name="medicamentos[0][id]" class="form-select" required>
                            <option value="" disabled selected>Selecione um medicamento...</option>
                            @foreach($remedios as $remedio)
                                <option value="{{ $remedio->id }}">{{ $remedio->nome }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-danger btn-remove-med"><i class="fas fa-trash"></i></button>
                    </div>
                </div>

                
                <button type="button" id="add-medication-btn" class="btn btn-secondary mt-2 mb-3">
                    <i class="fas fa-plus"></i> Adicionar Outro Medicamento
                </button>

                
                <div class="form-group mb-4">
                    <label for="observacao" class="form-label">Observações Adicionais</label>
                    <textarea name="observacao" id="observacao" class="form-control" rows="5" placeholder="Instruções gerais, alertas ou outras informações importantes..."></textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Gerar Prescrição
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
            
            allowClear: true
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
    const addMedicationBtn = document.getElementById('add-medication-btn');
    const medicationsContainer = document.getElementById('medications-container');
    let medicationIndex = 1;

    addMedicationBtn.addEventListener('click', function () {
        const newMedicationEntry = document.createElement('div');
        newMedicationEntry.classList.add('input-group', 'mb-2', 'medication-entry');

        newMedicationEntry.innerHTML = `
            <select name="medicamentos[${medicationIndex}][id]" class="form-select" required>
                <option value="" disabled selected>Selecione um medicamento...</option>
                @foreach($remedios as $remedio)
                    <option value="{{ $remedio->id }}">{{ $remedio->nome }}</option>
                @endforeach
            </select>
            <button type="button" class="btn btn-danger btn-remove-med"><i class="fas fa-trash"></i></button>
        `;

        medicationsContainer.appendChild(newMedicationEntry);
        medicationIndex++; 
    });


    medicationsContainer.addEventListener('click', function (e) {

        const removeButton = e.target.closest('.btn-remove-med');
        if (removeButton) {

            const entryToRemove = removeButton.closest('.medication-entry');
            
            if (medicationsContainer.children.length > 1) {
                entryToRemove.remove();
            } else {
                alert('É necessário prescrever ao menos um medicamento.');
            }
        }
    });
});
</script>

@endsection


