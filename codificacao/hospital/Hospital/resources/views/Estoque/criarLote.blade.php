@extends('Template.layout')

@section('title', 'Buscar Guia')

@section('nav')
<a href="{{ route('consultar.estoque') }}" class="nav-item"><i class="fas fa-pills"></i> Estoque de remédios</a>
<a href="{{ route('painel.guias') }}" class="nav-item"><i class="fas fa-calendar-check"></i> Consultar Guia</a>
@endsection
<style>
        /* Adicione seus estilos do select2-custom-style.css aqui se desejar */

        /* --- SOLUÇÃO PARA O ESPAÇAMENTO --- */
        .form-lote > * {
            /* Adiciona uma margem inferior a todos os elementos
               dentro do formulário (select, input, button) */
            margin-bottom: 1.25rem; /* ~20px. Ajuste este valor como preferir (ex: 1rem, 15px) */
        }

        .form-lote > *:last-child {
            /* Remove a margem do último elemento para não criar espaço extra */
            margin-bottom: 0;
        }
        /* --- FIM DA SOLUÇÃO --- */

        /* Estilos básicos para o layout do exemplo */
        body {
            background-color: #f3f4f6;
            font-family: 'Inter', sans-serif;
        }
        .main-content {
            max-width: 800px;
            margin: 2rem auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .content-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
        }
        .content-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #111827;
        }
        .content-title .fas {
            margin-right: 0.75rem;
            color: #10b981; /* Cor verde do seu CSS */
        }
        .container {
            padding: 2rem;
        }
        .form-control {
            width: 100%;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            height: 46px;
            padding: 8px 15px;
            font-size: 0.95rem;
            color: #374151;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }
        .btn-primary {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            width: 100%; /* Faz o botão ter largura total */
        }
        .btn-primary:hover {
            opacity: 0.9;
        }
    </style>
@section('content')
<div class="main-content">
    <div class="main-content">
        <div class="content-header">
            <h2 class="content-title"><i class="fas fa-boxes"></i> Criar Lote</h2>
        </div>

        <div class="container">
            <form action="{{ route('store.lote') }}" class="form-lote" method="POST">
                @csrf
                <select name="id_remedio" id="remedios-select" class="form-control">
                    <option value="">Selecione um medicamento</option>
                    @foreach($remedios as $remedio)
                        <option value="{{ $remedio->id }}">{{ $remedio->nome }}</option>
                    @endforeach 
                </select>
                <input type="number" class="form-control" name="quantidade" placeholder="Quantidade">
                <button type="button" class="btn btn-primary" onclick="confirmarCadastroLote(this)">Cadastrar Lote</button>
            </form>
        </div>
    </div>


</div>
<script>
function confirmarCadastroLote(button) {
    const form = button.closest('.form-lote');
    const remedioSelect = form.querySelector('#remedios-select');
    const quantidadeInput = form.querySelector('input[name="quantidade"]');
    
    if (!remedioSelect.value) {
        Swal.fire({
            title: 'Campo obrigatório',
            text: 'Por favor, selecione um medicamento.',
            icon: 'warning',
            confirmButtonColor: '#10b981'
        });
        return;
    }
    
    if (!quantidadeInput.value || quantidadeInput.value <= 0) {
        Swal.fire({
            title: 'Quantidade inválida',
            text: 'Por favor, informe uma quantidade válida.',
            icon: 'warning',
            confirmButtonColor: '#10b981'
        });
        return;
    }
    
    const medicamentoNome = remedioSelect.options[remedioSelect.selectedIndex].text;
    const quantidade = quantidadeInput.value;
    
    Swal.fire({
        title: 'Confirmar Cadastro',
        html: `
            <div style="text-align: left;">
                <p><strong>Quer mesmo cadastrar este lote?</strong></p>
                <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin: 10px 0;">
                    <p style="margin: 5px 0;"><strong>Medicamento:</strong> ${medicamentoNome}</p>
                    <p style="margin: 5px 0;"><strong>Quantidade:</strong> ${quantidade} unidades</p>
                </div>
            </div>
        `,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#10b981',
        cancelButtonColor: '#6b7280',
        confirmButtonText: '<i class="fas fa-check"></i> Sim, cadastrar!',
        cancelButtonText: '<i class="fas fa-times"></i> Cancelar',
        reverseButtons: true,
        customClass: {
            popup: 'sweet-alert-custom',
            confirmButton: 'btn-confirm',
            cancelButton: 'btn-cancel'
        },
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return new Promise((resolve) => {
                setTimeout(() => {
                    resolve();
                }, 1000);
            });
        }
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
            
            Swal.fire({
                title: 'Cadastrando...',
                text: 'Lote está sendo cadastrado no sistema.',
                icon: 'info',
                showConfirmButton: false,
                timer: 1500
            });
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    // Alternativa: usar event listener em vez de onclick
    const submitButton = document.querySelector('.form-lote .btn-primary');
    if (submitButton) {
        submitButton.addEventListener('click', function(e) {
            e.preventDefault();
            confirmarCadastroLote(this);
        });
    }
    
    const quantidadeInput = document.querySelector('input[name="quantidade"]');
    if (quantidadeInput) {
        quantidadeInput.addEventListener('input', function() {
            if (this.value < 0) {
                this.value = 0;
            }
        });
    }
});
</script>
@endsection
