<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleção de Profissão</title>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #2E8B57; /* Verde */
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            text-align: center;
            max-width: 600px;
            width: 100%;
        }

        .titulo {
            color: white;
            font-size: 3rem;
            margin-bottom: 50px;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .quadrados-container {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
        }

        .quadrado {
            background-color: white;
            border-radius: 15px;
            padding: 30px;
            width: 200px;
            height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            text-decoration: none;
            color: #333;
        }

        .quadrado:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.3);
        }

        .icone {
            font-size: 4rem;
            margin-bottom: 20px;
        }

        .medico {
            color: #2E8B57; /* Verde */
        }

        .farmaceutico {
            color: #228B22; /* Verde mais escuro */
        }

        .texto-profissao {
            font-size: 1.5rem;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .quadrados-container {
                flex-direction: column;
                align-items: center;
            }
            
            .titulo {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="titulo">Quem Sou</h1>
        
        <div class="quadrados-container">
            <!-- Quadrado do Médico -->
            <a href="{{ url('medico') }}" class="quadrado">
                <div class="icone medico">
                    <i class="bi bi-heart-pulse-fill"></i>
                </div>
                <div class="texto-profissao">Médico</div>
            </a>
            
            <!-- Quadrado do Farmacêutico -->
            <a href="{{ url('farmacia') }}" class="quadrado">
                <div class="icone farmaceutico">
                    <i class="bi bi-capsule-pill"></i>
                </div>
                <div class="texto-profissao">Farmacêutico</div>
            </a>
        </div>
    </div>

    <script>
        // Adicionando efeitos extras de interação
        document.addEventListener('DOMContentLoaded', function() {
            const quadrados = document.querySelectorAll('.quadrado');
            
            quadrados.forEach(quadrado => {
                quadrado.addEventListener('mouseenter', function() {
                    this.style.backgroundColor = '#f8f8f8';
                });
                
                quadrado.addEventListener('mouseleave', function() {
                    this.style.backgroundColor = 'white';
                });
                
                quadrado.addEventListener('click', function(e) {
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                });
            });
        });
    </script>
</body>
</html>