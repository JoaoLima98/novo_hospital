<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hospital Management System')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @stack('styles')
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="header fade-in">
            <div class="header-content">
                <div class="logo">
                    <i class="fas fa-hospital"></i>
                    <h1>@yield('app-name', 'HospitalSys')</h1>
                </div>
                <div class="user-info">
                    <div class="avatar">
                        @if(auth()->check())
                            {{ strtoupper(substr(auth()->user()->name ?? 'Dr', 0, 2)) }}
                        @else
                            Dr
                        @endif
                    </div>
                    <div>
                        <div style="font-weight: 600; color: #1e293b;">
                            @if(auth()->check())
                                {{ auth()->user()->name ?? 'Usuário' }}
                            @else
                                Dr. João Silva
                            @endif
                        </div>
                        <div style="font-size: 0.85rem; color: #64748b;">
                            @if(auth()->check())
                                {{ auth()->user()->role ?? 'Administrador' }}
                            @else
                                Administrador
                            @endif
                        </div>
                    </div>
                    <i class="fas fa-chevron-down" style="color: #9ca3af;"></i>
                </div>
            </div>
        </header>

        <!-- Navigation -->
        
        <nav class="nav fade-in">
            
            
            <div class="nav-items">
                @yield('nav')
                
            </div>
        </nav>
        <!-- Flash Messages -->
        

        <!-- Main Content -->
        <main class="main-content fade-in">
            @yield('content')
        </main>
    </div>

    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            })
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#d33',
                confirmButtonText: 'Fechar'
            })
        @endif

        @if(session('warning'))
            Swal.fire({
                icon: 'warning',
                title: 'Atenção!',
                text: "{{ session('warning') }}",
                confirmButtonColor: '#f0ad4e',
                confirmButtonText: 'Entendi'
            })
        @endif

        @if(session('info'))
            Swal.fire({
                icon: 'info',
                title: 'Informação',
                text: "{{ session('info') }}",
                confirmButtonColor: '#17a2b8',
                confirmButtonText: 'Beleza'
            })
        @endif
    </script>

    <script>
        // Funcionalidades básicas do template
        document.addEventListener('DOMContentLoaded', function() {
            // Efeito hover nos cards de estatísticas
            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Funcionalidade de busca genérica
            const searchInputs = document.querySelectorAll('.search-box input');
            searchInputs.forEach(searchInput => {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const table = this.closest('.search-filter').nextElementSibling;
                    if (table && table.classList.contains('table-container')) {
                        const tableRows = table.querySelectorAll('tbody tr');
                        
                        tableRows.forEach(row => {
                            const rowText = row.textContent.toLowerCase();
                            if (rowText.includes(searchTerm)) {
                                row.style.display = '';
                            } else {
                                row.style.display = 'none';
                            }
                        });
                    }
                });
            });

            // Auto-hide alerts após 5 segundos
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-20px)';
                    setTimeout(() => {
                        alert.remove();
                    }, 300);
                }, 5000);
            });

            // Adicionar animação ao carregar
            const elements = document.querySelectorAll('.fade-in');
            elements.forEach((element, index) => {
                setTimeout(() => {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }, index * 100);
            });