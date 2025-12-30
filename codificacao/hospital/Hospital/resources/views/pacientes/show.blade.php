@extends('Template.layout')

@section('title', 'Detalhes do Paciente')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        {{-- Cabeçalho --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary fw-bold"><i class="fas fa-id-card"></i> Detalhes do Paciente</h2>
            <div>
               
                <a href="{{ route('medico.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
            </div>
        </div>

        {{-- Card de Detalhes --}}
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="row">
                    {{-- Coluna da Esquerda: Info Principal --}}
                    <div class="col-md-4 text-center border-end">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px;">
                            <i class="fas fa-user fa-3x text-secondary"></i>
                        </div>
                        <h4 class="fw-bold text-dark">{{ $paciente->nome }}</h4>
                        <p class="text-muted mb-1">CPF: {{ $paciente->cpf }}</p>
                        <span class="badge bg-primary rounded-pill px-3">Paciente Ativo</span>
                    </div>

                    {{-- Coluna da Direita: Detalhes --}}
                    <div class="col-md-8 ps-md-4">
                        <h5 class="text-secondary mb-3 border-bottom pb-2">Informações Pessoais</h5>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold text-muted">Data de Nascimento:</div>
                            <div class="col-sm-8">{{ $paciente->data_nascimento ? $paciente->data_nascimento->format('d/m/Y') : 'Não informado' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold text-muted">RG:</div>
                            <div class="col-sm-8">{{ $paciente->rg ?? 'Não informado' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold text-muted">Cartão SUS:</div>
                            <div class="col-sm-8">{{ $paciente->cartao_sus ?? 'Não informado' }}</div>
                        </div>

                        <h5 class="text-secondary mt-4 mb-3 border-bottom pb-2">Contato e Endereço</h5>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold text-muted">Telefone:</div>
                            <div class="col-sm-8">{{ $paciente->telefone ?? 'Não informado' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold text-muted">Cidade/UF:</div>
                            <div class="col-sm-8">
                                {{ $paciente->cidade_atual ?? '-' }} / {{ $paciente->estado ?? '-' }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold text-muted">Endereço:</div>
                            <div class="col-sm-8">
                                {{ $paciente->rua ?? '' }}, {{ $paciente->numero_casa ?? '' }} - {{ $paciente->bairro ?? '' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light p-3 text-end">
            </div>
        </div>
    </div>
</div>
@endsection