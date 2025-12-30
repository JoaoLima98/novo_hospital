@extends('Template.layout')

@section('title', 'Meus Pacientes')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        {{-- Cabeçalho --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary fw-bold"><i class="fas fa-users"></i> Lista de Pacientes</h2>
            {{-- Se o médico puder cadastrar, descomente o botão abaixo --}}
            {{-- <a href="{{ route('pacientes.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Novo Paciente</a> --}}
        </div>

        {{-- Filtros de Busca (Opcional - Layout Visual) --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-3">
               
            </div>
        </div>

        {{-- Tabela de Pacientes --}}
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Nome do Paciente</th>
                                <th>CPF</th>
                                <th>Telefone</th>
                                <th>Cidade</th>
                                <th class="text-end pe-4">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pacientes as $paciente)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold text-dark">{{ $paciente->nome }}</h6>
                                                <small class="text-muted">ID: #{{ $paciente->id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $paciente->cpf }}</td>
                                    <td>{{ $paciente->telefone }}</td>
                                    <td>{{ $paciente->cidade_atual }}</td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group">
                                            
                                            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                                <span class="visually-hidden">Mais opções</span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-history me-2 text-secondary"></i> Histórico</a></li> 
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="fas fa-user-slash fa-2x mb-3 d-block"></i>
                                        Nenhum paciente encontrado.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white d-flex justify-content-end py-3">
                {{-- Paginação do Laravel --}}
                {{ $pacientes->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection