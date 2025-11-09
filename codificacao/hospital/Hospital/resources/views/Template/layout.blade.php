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
    
    <style>
        /* Estilos para o dropdown do usuário */
        .user-container {
            position: relative;
            cursor: pointer;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .user-info:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 14px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        .user-info:hover .avatar {
            transform: scale(1.1);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }
        
        .fa-chevron-down {
            transition: transform 0.3s ease;
        }
        
        .user-container.active .fa-chevron-down {
            transform: rotate(180deg);
        }
        
        /* Dropdown menu */
        .user-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 8px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            min-width: 200px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
            border: 1px solid #e2e8f0;
        }
        
        .user-container.active .user-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #374151;
            text-decoration: none;
            transition: all 0.2s ease;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .dropdown-item:last-child {
            border-bottom: none;
        }
        
        .dropdown-item:hover {
            background: #f8fafc;
            color: #1e40af;
            padding-left: 20px;
        }
        
        .dropdown-item.logout {
            color: #dc2626;
        }
        
        .dropdown-item.logout:hover {
            background: #fef2f2;
            color: #b91c1c;
        }
        
        .dropdown-icon {
            width: 20px;
            text-align: center;
            color: #6b7280;
        }
        
        .dropdown-item:hover .dropdown-icon {
            color: inherit;
        }
        
        /* Overlay para fechar ao clicar fora */
        .dropdown-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: transparent;
            z-index: 999;
            display: none;
        }
        
        .user-container.active ~ .dropdown-overlay {
            display: block;
        }
        
        /* Animação de pulse no avatar quando há notificações */
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(102, 126, 234, 0); }
            100% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0); }
        }
        
        .avatar.has-notification {
            animation: pulse 2s infinite;
        }
    </style>
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
                
                <!-- User Info com Dropdown -->
                <div class="user-container" id="userContainer">
                    <div class="user-info">
                        <div class="avatar" id="userAvatar">
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
                                    Sem Nome
                                @endif
                            </div>
                            <div style="font-size: 12px; color: #6b7280; margin-top: 2px;">
                                @if(auth()->check())
                                    {{ ucfirst(auth()->user()->perfil ?? 'Usuário') }}
                                @else
                                    Visitante
                                @endif
                            </div>
                        </div>
                        <i class="fas fa-chevron-down" style="color: #9ca3af;"></i>
                    </div>
                    
                    <!-- Dropdown Menu -->
                    <div class="user-dropdown">
                        <a href="{{ route('logout') }}" 
                           class="dropdown-item logout"
                           onclick="event.preventDefault(); confirmLogout();">
                            <i class="fas fa-sign-out-alt dropdown-icon"></i>
                            <span>Sair do Sistema</span>
                        </a>
                        
                        <!-- Formulário de logout hidden -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
                
                <!-- Overlay para fechar dropdown -->
                <div class="dropdown-overlay" id="dropdownOverlay"></div>
            </div>
        </header>

        <!-- Navigation -->
        <nav class="nav fade-in">
            <div class="nav-items">
                @if(auth()->check() && auth()->user()->perfil === 'admin')
                    <a href="{{ route('criar.usuario') }}" class="nav-item"><i class="fas fa-user"></i>Criar Usuário</a>
                @elseif(auth()->check() && auth()->user()->perfil === 'medico')
                    <a href="{{ url('/medico') }}" class="nav-item"><i class="fas fa-tachometer-alt"></i>Fazer prescrição</a>
                @endif

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
        // Funcionalidade do dropdown do usuário
        document.addEventListener('DOMContentLoaded', function() {
            const userContainer = document.getElementById('userContainer');
            const dropdownOverlay = document.getElementById('dropdownOverlay');
            const userAvatar = document.getElementById('userAvatar');
            
            // Abrir/fechar dropdown
            userContainer.addEventListener('click', function(e) {
                e.stopPropagation();
                this.classList.toggle('active');
            });
            
            // Fechar dropdown ao clicar no overlay
            dropdownOverlay.addEventListener('click', function() {
                userContainer.classList.remove('active');
            });
            
            // Fechar dropdown ao clicar fora
            document.addEventListener('click', function(e) {
                if (!userContainer.contains(e.target)) {
                    userContainer.classList.remove('active');
                }
            });
            
            // Adicionar efeito de notificação no avatar (opcional)
            setTimeout(() => {
                userAvatar.classList.add('has-notification');
            }, 2000);
            
            // Remover efeito de notificação após 8 segundos
            setTimeout(() => {
                userAvatar.classList.remove('has-notification');
            }, 10000);
            
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
        });
        
        // Confirmação de logout com SweetAlert
        function confirmLogout() {
            Swal.fire({
                title: 'Deseja sair?',
                text: "Você será desconectado do sistema",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, sair',
                cancelButtonText: 'Cancelar',
                background: '#fff',
                backdrop: 'rgba(0,0,0,0.4)',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Fecha o dropdown
                    document.getElementById('userContainer').classList.remove('active');
                    
                    // Mostra loading
                    Swal.fire({
                        title: 'Saindo...',
                        text: 'Finalizando sua sessão',
                        icon: 'info',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });
                    
                    // Submete o formulário de logout após 1.5 segundos
                    setTimeout(() => {
                        document.getElementById('logout-form').submit();
                    }, 1500);
                }
            });
        }
        
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok',
                background: '#fff',
                showClass: {
                    popup: 'animate__animated animate__bounceIn'
                }
            })
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#d33',
                confirmButtonText: 'Fechar',
                background: '#fff',
                showClass: {
                    popup: 'animate__animated animate__shakeX'
                }
            })
        @endif

        @if(session('warning'))
            Swal.fire({
                icon: 'warning',
                title: 'Atenção!',
                text: "{{ session('warning') }}",
                confirmButtonColor: '#f0ad4e',
                confirmButtonText: 'Entendi',
                background: '#fff'
            })
        @endif

        @if(session('info'))
            Swal.fire({
                icon: 'info',
                title: 'Informação',
                text: "{{ session('info') }}",
                confirmButtonColor: '#17a2b8',
                confirmButtonText: 'Beleza',
                background: '#fff'
            })
        @endif
    </script>
</body>
</html>