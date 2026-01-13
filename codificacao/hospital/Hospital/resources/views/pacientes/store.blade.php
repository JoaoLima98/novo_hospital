@extends('Template.layout')

@section('title', isset($paciente) ? 'Editar Paciente' : 'Novo Paciente')

@section('content')

{{-- RECURSOS CSS/JS --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<div class="container py-4"> 
    <div class="card border-0 shadow-sm" style="border-top: 4px solid #0f172a !important;"> 
        
        <div class="card-header bg-white py-3 border-bottom">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="mb-0 fw-bold text-dark">
                    <i class="{{ isset($paciente) ? 'fas fa-user-edit' : 'fas fa-user-plus' }} text-secondary me-2"></i> 
                    {{ isset($paciente) ? 'Editar Paciente' : 'Cadastro de Paciente' }}
                </h4>
                <span class="badge bg-light text-secondary border">
                    <i class="fas fa-hospital-user me-1"></i> Administrativo
                </span>
            </div>
        </div>
        
        <div class="card-body p-4">
            <form action="{{ isset($paciente) ? route('pacientes.update', $paciente->id) : route('pacientes.store') }}" method="POST" id="formPaciente">
                @csrf
                @if(isset($paciente))
                    @method('PUT')
                @endif
                
                {{-- SEÇÃO 1: DADOS PESSOAIS --}}
                <div class="section-block mb-4">
                    <h6 class="section-title text-uppercase text-secondary fw-bold border-bottom pb-2 mb-3">
                        <i class="fas fa-id-card me-2"></i>Dados Pessoais
                    </h6>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-secondary small fw-bold">Nome Completo <span class="text-danger">*</span></label>
                            <input type="text" name="nome" class="form-control text-uppercase" required value="{{ old('nome', $paciente->nome ?? '') }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label text-secondary small fw-bold">CPF <span class="text-danger">*</span></label>
                            <input type="text" name="cpf" id="cpf" class="form-control" required placeholder="000.000.000-00" value="{{ old('cpf', $paciente->cpf ?? '') }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label text-secondary small fw-bold">RG</label>
                            {{-- ID para máscara --}}
                            <input type="text" name="rg" id="rg" class="form-control" placeholder="000000000" value="{{ old('rg', $paciente->rg ?? '') }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label text-secondary small fw-bold">Data de Nascimento <span class="text-danger">*</span></label>
                            <input type="date" name="data_nascimento" class="form-control" required value="{{ old('data_nascimento', isset($paciente) && $paciente->data_nascimento ? $paciente->data_nascimento->format('Y-m-d') : '') }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label text-secondary small fw-bold">Estado Civil</label>
                            <select name="estado_civil" class="form-select select2-simples">
                                <option value="">Selecione...</option>
                                @foreach(['Solteiro', 'Casado', 'Divorciado', 'Viúvo', 'Separado'] as $ec)
                                    <option value="{{ $ec }}" {{ old('estado_civil', $paciente->estado_civil ?? '') == $ec ? 'selected' : '' }}>{{ $ec }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label text-secondary small fw-bold">Raça/Cor</label>
                            <select name="raca_cor" class="form-select select2-simples">
                                <option value="">Selecione...</option>
                                @foreach(['Branco', 'Preto', 'Pardo', 'Amarelo', 'Indígena'] as $cor)
                                    <option value="{{ $cor }}" {{ old('raca_cor', $paciente->raca_cor ?? '') == $cor ? 'selected' : '' }}>{{ $cor }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label text-secondary small fw-bold">Naturalidade</label>
                            <input type="text" name="naturalidade" class="form-control" value="{{ old('naturalidade', $paciente->naturalidade ?? '') }}">
                        </div>
                    </div>
                </div>

                {{-- SEÇÃO 2: CONTATO E COMPLEMENTAR --}}
                <div class="section-block mb-4">
                    <h6 class="section-title text-uppercase text-secondary fw-bold border-bottom pb-2 mb-3">
                        <i class="fas fa-address-book me-2"></i>Contato e Complementar
                    </h6>

                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label text-secondary small fw-bold">Telefone/Celular <span class="text-danger">*</span></label>
                            <input type="text" name="telefone" id="telefone" class="form-control" required placeholder="(00) 00000-0000" value="{{ old('telefone', $paciente->telefone ?? '') }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label text-secondary small fw-bold">Cartão SUS</label>
                            {{-- ID para máscara --}}
                            <input type="text" name="cartao_sus" id="cartao_sus" class="form-control" placeholder="000 0000 0000 0000" value="{{ old('cartao_sus', $paciente->cartao_sus ?? '') }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label text-secondary small fw-bold">Profissão</label>
                            <input type="text" name="profissao" class="form-control" value="{{ old('profissao', $paciente->profissao ?? '') }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label text-secondary small fw-bold">Escolaridade</label>
                            <select name="escolaridade" class="form-select select2-simples">
                                <option value="">Selecione...</option>
                                @foreach(['Analfabeto', 'Fundamental', 'Médio', 'Superior'] as $esc)
                                    <option value="{{ $esc }}" {{ old('escolaridade', $paciente->escolaridade ?? '') == $esc ? 'selected' : '' }}>{{ $esc }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- SEÇÃO 3: FILIAÇÃO --}}
                <div class="section-block mb-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-secondary small fw-bold">Nome da Mãe</label>
                            <input type="text" name="nome_mae" class="form-control text-uppercase" value="{{ old('nome_mae', $paciente->nome_mae ?? '') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-secondary small fw-bold">Nome do Pai</label>
                            <input type="text" name="nome_pai" class="form-control text-uppercase" value="{{ old('nome_pai', $paciente->nome_pai ?? '') }}">
                        </div>
                    </div>
                </div>

                {{-- SEÇÃO 4: ENDEREÇO --}}
                <div class="section-block mb-4">
                    <h6 class="section-title text-uppercase text-secondary fw-bold border-bottom pb-2 mb-3">
                        <i class="fas fa-map-marker-alt me-2"></i>Endereço
                    </h6>
                    <div class="row g-3">
                        <div class="col-md-2">
                            <label class="form-label text-secondary small fw-bold">UF</label>
                            <input type="text" name="estado" class="form-control text-uppercase" maxlength="2" value="{{ old('estado', $paciente->estado ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-secondary small fw-bold">Cidade</label>
                            <input type="text" name="cidade_atual" class="form-control" value="{{ old('cidade_atual', $paciente->cidade_atual ?? '') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-secondary small fw-bold">Bairro</label>
                            <input type="text" name="bairro" class="form-control" value="{{ old('bairro', $paciente->bairro ?? '') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-secondary small fw-bold">Rua/Logradouro</label>
                            <input type="text" name="rua" class="form-control" value="{{ old('rua', $paciente->rua ?? '') }}">
                        </div>
                        <div class="col-md-1">
                            <label class="form-label text-secondary small fw-bold">Nº</label>
                            <input type="text" name="numero_casa" class="form-control" value="{{ old('numero_casa', $paciente->numero_casa ?? '') }}">
                        </div>
                    </div>
                </div>

                {{-- SEÇÃO 5: OUTROS (MUDANÇA AQUI: SELECT AO INVÉS DE SWITCH) --}}
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <label class="form-label text-dark fw-bold mb-1">Paciente Regulado (CROSS/SISREG)?</label>
                            <select name="regulado" class="form-select select2-simples">
                                {{-- Lógica: Verifica se é 1 (Sim) ou 0 (Não) --}}
                                <option value="0" {{ old('regulado', $paciente->regulado ?? 0) == 0 ? 'selected' : '' }}>NÃO</option>
                                <option value="1" {{ old('regulado', $paciente->regulado ?? 0) == 1 ? 'selected' : '' }}>SIM</option>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <small class="text-muted"><i class="fas fa-info-circle me-1"></i> Informe se o paciente possui regulação ativa no sistema de saúde.</small>
                        </div>
                    </div>
                </div>

                

                <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                    <a href="{{ route('pacientes.index') }}" class="btn btn-light border px-4">Cancelar</a>
                    <button type="button" class="btn btn-primary px-4" id="btnConfirmar" style="background-color: #0f172a; border-color: #0f172a;">
                        <i class="fas fa-save me-2"></i> {{ isset($paciente) ? 'Atualizar Dados' : 'Salvar Cadastro' }}
                    </button>
                </div>
            </form>
        </div> 
    </div> 
</div>

<style>
    body { background-color: #f8f9fa; color: #334155; }
    .form-control, .form-select { border-color: #dee2e6; border-radius: 4px; font-size: 0.9rem; }
    .form-control:focus, .form-select:focus { border-color: #64748b; box-shadow: 0 0 0 0.2rem rgba(100, 116, 139, 0.15); }
    .form-label { font-size: 0.8rem; letter-spacing: 0.02em; }
    .select2-container--bootstrap-5 .select2-selection { border-color: #dee2e6; border-radius: 4px; min-height: 38px; }
</style>

<script>
    $(document).ready(function() {
        $('.select2-simples').select2({
            theme: 'bootstrap-5',
            width: '100%'
        });

        // Aplicando Máscaras
        $('#cpf').mask('000.000.000-00', {reverse: true});
        $('#telefone').mask('(00) 00000-0000');
        
        // MÁSCARAS ADICIONADAS
        $('#cartao_sus').mask('000 0000 0000 0000');
        $('#rg').mask('000000000'); 
    });

    document.getElementById('btnConfirmar').addEventListener('click', function() {
        const form = document.getElementById('formPaciente');
        if(!form.checkValidity()){
            form.reportValidity();
            return;
        }

        const nomePaciente = document.querySelector('input[name="nome"]').value;

        Swal.fire({
            title: 'Confirmar Cadastro',
            html: `Confirma os dados do paciente:<br><strong>${nomePaciente}</strong>?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#0f172a',
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Sim, Salvar',
            cancelButtonText: 'Revisar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });
</script>

@endsection