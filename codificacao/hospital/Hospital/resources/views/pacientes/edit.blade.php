@extends('Template.layout')

@section('title', 'Editar Paciente')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        {{-- Cabeçalho --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary fw-bold"><i class="fas fa-user-edit"></i> Editar Paciente</h2>
            <a href="{{ route('medico.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>

        {{-- Card de Edição --}}
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('pacientes.update', $paciente->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <h5 class="text-secondary mb-3 border-bottom pb-2">Dados Pessoais</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nome" class="form-label fw-bold small">Nome Completo</label>
                            <input type="text" class="form-control" id="nome" name="nome" value="{{ $paciente->nome }}" required>
                        </div>
                        <div class="col-md-3">
                            <label for="cpf" class="form-label fw-bold small">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" value="{{ $paciente->cpf }}" required>
                        </div>
                        <div class="col-md-3">
                            <label for="data_nascimento" class="form-label fw-bold small">Data de Nascimento</label>
                            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="{{ $paciente->data_nascimento ? $paciente->data_nascimento->format('Y-m-d') : '' }}">
                        </div>
                    </div>

                    <h5 class="text-secondary mt-4 mb-3 border-bottom pb-2">Contato e Endereço</h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="telefone" class="form-label fw-bold small">Telefone</label>
                            <input type="text" class="form-control" id="telefone" name="telefone" value="{{ $paciente->telefone }}">
                        </div>
                        <div class="col-md-4">
                            <label for="cidade_atual" class="form-label fw-bold small">Cidade</label>
                            <input type="text" class="form-control" id="cidade_atual" name="cidade_atual" value="{{ $paciente->cidade_atual }}">
                        </div>
                        <div class="col-md-4">
                            <label for="estado" class="form-label fw-bold small">Estado</label>
                            <input type="text" class="form-control" id="estado" name="estado" value="{{ $paciente->estado }}" maxlength="2">
                        </div>
                    </div>

                    {{-- Botões de Ação --}}
                    <div class="d-flex justify-content-end gap-2 mt-5">
                        <a href="{{ route('medico.index') }}" class="btn btn-light border px-4">Cancelar</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i> Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection