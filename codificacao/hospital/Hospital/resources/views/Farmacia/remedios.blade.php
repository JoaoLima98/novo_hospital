@extends('Template.layout')

@section('title', 'Remedios')

@section('nav')
<a href="{{ route('remedios') }}" class="nav-item check"><i class="fas fa-pills"></i>Remédios</a>
<a href="{{ route('consultar.estoque') }}" class="nav-item"><i class="fas fa-pills"></i> Estoque de remédios</a>
<a href="{{ route('painel.guias') }}" class="nav-item"><i class="fas fa-calendar-check"></i> Entregar Medicamentos</a>
@endsection

@section('content')
<div class="main-content">
    <div class="content-header">
        <h2 class="content-title"><i class="fas fa-calendar-check"></i> Remedios</h2>
    </div>

    <div class="row">
        @foreach($remedios as $remedio)
            <div class="col-md-3 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-start">
                            <h5 class="card-title">{{ $remedio->nome }}</h5>

                            <div class="text-end">
                                <label class="form-label" style="font-size: 12px; margin-bottom: 2px;">
                                    Alerta em: (qtds)
                                </label>
                                <input type="number"
                                    class="form-control form-control-sm text-end alerta-input"
                                    value="{{ $remedio->qtd_alerta }}"
                                    data-id="{{ $remedio->id }}"
                                    style="width: 70px;"
                                    min="0">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- Scripts e Estilos --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {

        $('.alerta-input').on('change', function () {
            let id = $(this).data('id');
            let valor = $(this).val();

            // --- VALIDAÇÃO: Bloqueia se for menor que 5 ---
            if (valor < 5) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Atenção',
                    text: 'A quantidade de alerta não foi salva! O valor mínimo deve ser maior ou igual a 5.',
                    confirmButtonColor: '#d33'
                });
                
                $(this).val(5); // Força o valor mínimo de 5 no campo

                return; 
            }

            
            $.ajax({
                url: "/remedios-atualizar-alerta/" + id ,
                type: "PUT",
                data: {
                    qtd_alerta: valor,
                    _token: "{{ csrf_token() }}"
                },
                success: function (resp) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Atualizado!',
                        text: 'Quantidade de alerta salva com sucesso.',
                        timer: 2500,
                        showConfirmButton: false
                    });
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: 'Erro ao conectar com o servidor.'
                    });
                }
            });
        });

    });
</script>

@endsection     