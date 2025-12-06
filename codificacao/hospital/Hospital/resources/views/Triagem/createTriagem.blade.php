@extends('Template.layout')

@section('title', 'Registro de Triagem')

@section('content')

{{-- RECURSOS CSS/JS (Mantidos) --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container py-4"> {{-- CARD PRINCIPAL --}}
    <div class="card border-0 shadow-sm" style="border-top: 4px solid #0f172a !important;"> {{-- CABEÇALHO SÓBRIO --}}
        <div class="card-header bg-white py-3 border-bottom">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="mb-0 fw-bold text-dark">
                    <i class="fas fa-file-medical text-secondary me-2"></i> Registro de Triagem
                </h4>
                <span class="badge bg-light text-secondary border">
                    <i class="fas fa-user-nurse me-1"></i> Enfermeiro: {{ auth()->user()->name ?? 'Usuário' }}
                </span>
            </div>
        </div>
        
        <div class="card-body p-4">
            <form action="{{ route('triagem.store') }}" method="POST" id="formTriagem">
                @csrf
                
                {{-- CAMPO PACIENTE E ESPECIALIDADES --}}
                <div class="row mb-4 g-3">
                    {{-- Seleção de Paciente --}}
                    <div class="col-md-6">
                        <label for="paciente" class="form-label fw-bold text-secondary text-uppercase small">Paciente</label>
                        <select name="paciente_id" id="paciente" class="form-select" required>
                            <option value=""></option> 
                            @foreach($pacientes as $paciente)
                                <option value="{{ $paciente->id }}">
                                    {{ $paciente->cpf }} - {{ $paciente->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- NOVO CAMPO: Especialidades (Select2 Múltiplo) --}}
                    <div class="col-md-6">
                        <label for="especialidades" class="form-label fw-bold text-secondary text-uppercase small">Especialidades (Encaminhamento)</label>
                        <select name="especialidades[]" id="especialidades" class="form-select" multiple="multiple">
                            @foreach($especialidades as $especialidade)
                                <option value="{{ $especialidade->id }}">
                                    {{ $especialidade->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- ================= SEÇÃO 1: SINAIS VITAIS ================= --}}
                <div class="section-block mb-4">
                    <h6 class="section-title text-uppercase text-secondary fw-bold border-bottom pb-2 mb-3">
                        <i class="fas fa-heartbeat me-2"></i>Sinais Vitais & Avaliação
                    </h6>
                    
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label text-secondary small fw-bold">Classificação Manchester <span class="text-danger">*</span></label>
                            <select name="manchester_classificacao" class="form-select" required id="selectManchester">
                                <option value="" selected disabled>Selecione...</option>
                                <option value="Emergencia" class="fw-bold text-danger">🔴 Emergência (0 min)</option>
                                <option value="Muito Urgente" class="fw-bold" style="color: #e67e22;">🟠 Muito Urgente (10 min)</option>
                                <option value="Urgente" class="fw-bold text-warning">🟡 Urgente (60 min)</option>
                                <option value="Pouco Urgente" class="fw-bold text-success">🟢 Pouco Urgente (120 min)</option>
                                <option value="Nao Urgente" class="fw-bold text-primary">🔵 Não Urgente (240 min)</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label text-secondary small fw-bold">Pressão Arterial (mmHg) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" name="pressao_sistolica" class="form-control" placeholder="120" required>
                                <span class="input-group-text bg-light text-muted">/</span>
                                <input type="number" name="pressao_diastolica" class="form-control" placeholder="80" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label text-secondary small fw-bold">Temperatura (°C) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" step="0.1" name="temperatura" class="form-control" placeholder="37.5" required>
                                <span class="input-group-text bg-light text-muted"><i class="fas fa-temperature-high"></i></span>
                            </div>
                        </div>

                        {{-- LINHA 2 --}}
                        <div class="col-md-4">
                            <label class="form-label text-secondary small fw-bold">SpO2 (Saturação) <span class="text-danger">*</span></label>
                            <select name="spo2" class="form-select" required>
                                <option value="95-100" class="text-success fw-bold" selected>95% - 100% (Normal)</option>
                                <option value="90-94" class="text-warning fw-bold">90% - 94% (Leve)</option>
                                <option value="85-89" style="color: #e67e22;" class="fw-bold">85% - 89% (Moderada)</option>
                                <option value="<85" class="text-danger fw-bold">< 85% (Grave)</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label text-secondary small fw-bold">Freq. Cardíaca (BPM) <span class="text-danger">*</span></label>
                             <div class="input-group">
                                <input type="number" name="frequencia_cardiaca" class="form-control" placeholder="80" required>
                                <span class="input-group-text bg-light text-muted"><i class="fas fa-heart-pulse"></i></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label text-secondary small fw-bold">Glicemia (mg/dL) <span class="text-danger">*</span></label>
                            <select name="glicemia" class="form-select" required>
                                <option value="70-100" selected>Normal (70-100)</option>
                                <option value="<70">Hipoglicemia (<70)</option>
                                <option value="101-126">Pré-diabetes (101-126)</option>
                                <option value=">126">Hiperglicemia (>126)</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- ================= SEÇÃO 2: DADOS FÍSICOS ================= --}}
                <div class="section-block mb-4">
                    <div class="row g-3 align-items-end">
                        
                        <div class="col-md-4">
                            <label class="form-label text-secondary small fw-bold">Tipo de Chegada <span class="text-danger">*</span></label>
                            <select name="tipo_chegada" class="form-select" required>
                                <option value="Espontanea" selected>Espontânea</option>
                                <option value="SAMU">SAMU 192</option>
                                <option value="Bombeiros">Bombeiros 193</option>
                                <option value="Policia">Polícia 190</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label text-secondary small fw-bold">Escala Glasgow (3-15) <span class="text-danger">*</span></label>
                            <input type="number" name="glasgow" min="3" max="15" class="form-control" value="15" required>
                        </div>

                        <div class="col-md-2">
                             <label class="form-label text-secondary small fw-bold">Peso (kg)</label>
                            <input type="number" step="0.1" name="peso" class="form-control" placeholder="00.0">
                        </div>

                        <div class="col-md-2">
                            <label class="form-label text-secondary small fw-bold">Altura (cm)</label>
                             <input type="number" name="altura_cm" class="form-control" placeholder="000">
                        </div>
                        
                        {{-- ESCALA DE DOR --}}
                        <div class="col-md-8 mt-4">
                             <div class="p-3 bg-light border rounded">
                                 <label class="form-label fw-bold d-flex justify-content-between align-items-center mb-1">
                                    <span class="text-secondary text-uppercase small">Escala de Dor (EVA)</span>
                                    <span class="badge bg-secondary" id="val_dor_badge">0 - Sem Dor</span>
                                </label>
                                <input type="range" name="escore_dor" class="form-range" min="0" max="10" value="0" id="rangeDor">
                                <div class="d-flex justify-content-between text-muted" style="font-size: 0.75rem;">
                                    <span>0</span><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span><span>10</span>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>

                {{-- ================= SEÇÃO 3: ANAMNESE ================= --}}
                <div class="section-block mb-4">
                    <h6 class="section-title text-uppercase text-secondary fw-bold border-bottom pb-2 mb-3">
                        <i class="fas fa-clipboard-list me-2"></i>Anamnese
                    </h6>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-secondary small fw-bold">Queixa Principal</label>
                            <textarea name="queixa_principal" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-6">
                             <label class="form-label text-secondary small fw-bold">Medicação em Uso</label>
                            <textarea name="medicacao_uso" class="form-control" rows="3"></textarea>
                        </div>
                         <div class="col-md-6">
                             <label class="form-label text-danger small fw-bold"><i class="fas fa-exclamation-circle me-1"></i>Alergias</label>
                            <textarea name="alergias" class="form-control border-danger-subtle text-danger" rows="2"></textarea>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label text-secondary small fw-bold">Sintomas Respiratórios</label>
                             <div class="card card-body bg-light border-0 py-2">
                                <div class="row g-2">
                                    @php $sintomas = ['Febre', 'Tosse', 'Dispnéia', 'Coriza', 'Obstrução Nasal', 'Dor Garganta', 'Mialgia', 'Espirro']; @endphp
                                    @foreach($sintomas as $k => $sintoma)
                                        <div class="col-6 col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="sintomas_gripais[]" value="{{ $sintoma }}" id="sin_{{$k}}">
                                                <label class="form-check-label small" for="sin_{{$k}}">{{ $sintoma }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ================= SEÇÃO 4: CIRCUNSTÂNCIAS ================= --}}
                <div class="alert alert-light border border-warning border-start-4 rounded-0 mb-4">
                    <div class="row align-items-center">
                        <div class="col-md-4 mb-2 mb-md-0">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" name="acidente_trabalho" id="switchTrabalho">
                                <label class="form-check-label fw-bold text-dark" for="switchTrabalho">Acidente de Trabalho</label>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="d-flex align-items-center flex-wrap gap-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" name="acidente_veiculo" value="1" id="toggleVeiculo">
                                    <label class="form-check-label fw-bold text-dark" for="toggleVeiculo">Acidente de Veículo</label>
                                </div>
                                
                                <div class="d-none" id="boxVeiculo">
                                     <div class="btn-group btn-group-sm" role="group">
                                        <input type="radio" class="btn-check" name="tipo_envolvimento_veiculo" value="Condutor" id="condutor" autocomplete="off">
                                        <label class="btn btn-outline-secondary" for="condutor">Condutor</label>

                                        <input type="radio" class="btn-check" name="tipo_envolvimento_veiculo" value="Passageiro" id="passageiro" autocomplete="off">
                                        <label class="btn btn-outline-secondary" for="passageiro">Passageiro</label>

                                        <input type="radio" class="btn-check" name="tipo_envolvimento_veiculo" value="Pedestre" id="pedestre" autocomplete="off">
                                        <label class="btn btn-outline-secondary" for="pedestre">Pedestre</label>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BOTÕES DE AÇÃO --}}
                <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                    <button type="button" class="btn btn-light border px-4" onclick="history.back()">
                        Cancelar
                    </button>
                    <button type="button" class="btn btn-primary px-4" id="btnConfirmar" style="background-color: #0f172a; border-color: #0f172a;">
                        <i class="fas fa-save me-2"></i> Finalizar Triagem
                    </button>
                </div>

            </form>
        </div> 
    </div> 
</div>


{{-- CSS SÉRIO/CORPORATIVO --}}
<style>
    /* Fundo Neutro */
    body {
        background-color: #f8f9fa; /* Cinza bem claro */
        color: #334155; /* Cinza escuro para texto (não preto puro) */
    }

    /* Inputs Limpos */
    .form-control, .form-select, .input-group-text {
        border-color: #dee2e6;
        border-radius: 4px; /* Menos arredondado */
        font-size: 0.9rem;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #64748b;
        box-shadow: 0 0 0 0.2rem rgba(100, 116, 139, 0.15); /* Foco cinza azulado */
    }

    /* Labels Profissionais */
    .form-label {
        font-size: 0.8rem;
        letter-spacing: 0.02em;
    }

    /* Checkbox & Switch */
    .form-check-input:checked {
        background-color: #0f172a;
        border-color: #0f172a;
    }

    /* Select2 Ajuste para tema Clean */
    .select2-container--bootstrap-5 .select2-selection {
        border-color: #dee2e6;
        border-radius: 4px;
        min-height: 38px;
    }
    
    /* Ajuste específico para Select2 Multiple */
    .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__rendered .select2-selection__choice {
        background-color: #e2e8f0;
        border: 1px solid #cbd5e1;
        color: #334155;
    }
</style>


{{-- SCRIPTS (Lógica Mantida) --}}
<script>
    // INICIALIZAÇÃO DOS SELECT2
    $(document).ready(function() {
        // Campo Paciente (Mantido)
        $('#paciente').select2({
            theme: 'bootstrap-5',
            placeholder: 'Pesquisar paciente...',
            allowClear: true,
            width: '100%'
        });

        // NOVO: Campo Especialidades (Múltiplo)
        $('#especialidades').select2({
            theme: 'bootstrap-5',
            placeholder: 'Selecione as especialidades...',
            closeOnSelect: false, // Opcional: mantêm aberto para selecionar vários
            allowClear: true,
            width: '100%'
        });
    });

    // Toggle de Veículo
    document.getElementById('toggleVeiculo').addEventListener('change', function() {
        const box = document.getElementById('boxVeiculo');
        if(this.checked) {
            box.classList.remove('d-none');
            box.classList.add('animate__animated', 'animate__fadeIn');
        } else {
            box.classList.add('d-none');
            box.classList.remove('animate__animated', 'animate__fadeIn');
            document.querySelectorAll('input[name="tipo_envolvimento_veiculo"]').forEach(el => el.checked = false);
        }
    });

    // Range de Dor
    const rangeDor = document.getElementById('rangeDor');
    const badgeDor = document.getElementById('val_dor_badge');

    rangeDor.addEventListener('input', function() {
        let val = this.value;
        let texto = val + ' - ';
        let classeCor = 'bg-secondary';

        if (val == 0) { texto += 'Sem Dor'; classeCor = 'bg-secondary'; }
        else if (val <= 3) { texto += 'Leve'; classeCor = 'bg-success'; }
        else if (val <= 7) { texto += 'Moderada'; classeCor = 'bg-warning text-dark'; }
        else { texto += 'Intensa'; classeCor = 'bg-danger'; }

        badgeDor.innerText = texto;
        badgeDor.className = 'badge ' + classeCor;
    });

    // SweetAlert Confirmar (Estilo mais sério)
    document.getElementById('btnConfirmar').addEventListener('click', function() {
        const form = document.getElementById('formTriagem');
        if(!form.checkValidity()){
            form.reportValidity();
            return;
        }

        const manchesterSelect = document.getElementById('selectManchester');
        const manchesterText = manchesterSelect.options[manchesterSelect.selectedIndex].text;

        Swal.fire({
            title: 'Confirmar Triagem',
            html: `O paciente será classificado como:<br><strong>${manchesterText}</strong>`,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#0f172a', // Azul escuro corporativo
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Voltar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });

    // Alerts de Erro/Sucesso (PHP)
    document.addEventListener("DOMContentLoaded", function() {
        @if(session('swal_success'))
            Swal.fire({
                icon: 'success',
                title: 'Salvo',
                text: "{{ session('swal_success') }}",
                confirmButtonColor: '#0f172a'
            });
        @endif

        @if(session('swal_error'))
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: "{{ session('swal_error') }}",
                confirmButtonColor: '#ef4444'
            });
        @endif

        @if ($errors->any())
            let errorMsg = '';
            @foreach ($errors->all() as $error)
                errorMsg += '• {{ $error }}<br>';
            @endforeach
            
            Swal.fire({
                icon: 'warning',
                title: 'Atenção',
                html: errorMsg,
                confirmButtonColor: '#eab308'
            });
        @endif
    });
</script>

@endsection