<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Página Não Encontrada</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        .stars {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .star {
            position: absolute;
            width: 2px;
            height: 2px;
            background: white;
            border-radius: 50%;
            animation: twinkle 3s infinite;
        }

        @keyframes twinkle {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 1; }
        }

        .container {
            text-align: center;
            color: white;
            z-index: 1;
            padding: 20px;
            max-width: 600px;
        }

        .error-code {
            font-size: 180px;
            font-weight: bold;
            line-height: 1;
            margin-bottom: 20px;
            text-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .astronaut {
            font-size: 100px;
            animation: rotate 10s linear infinite;
            display: inline-block;
            margin: 20px 0;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg) translateX(50px) rotate(0deg); }
            100% { transform: rotate(360deg) translateX(50px) rotate(-360deg); }
        }

        h1 {
            font-size: 48px;
            margin-bottom: 20px;
            animation: slideIn 0.8s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        p {
            font-size: 20px;
            margin-bottom: 40px;
            opacity: 0.9;
            animation: slideIn 1s ease-out;
        }

        .btn {
            display: inline-block;
            padding: 15px 40px;
            background: white;
            color: #667eea;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            font-size: 18px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            animation: slideIn 1.2s ease-out;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
            background: #f0f0f0;
        }

        .planet {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
        }

        .planet1 {
            width: 100px;
            height: 100px;
            background: white;
            top: 10%;
            left: 10%;
            animation: drift 20s infinite;
        }

        .planet2 {
            width: 60px;
            height: 60px;
            background: white;
            bottom: 20%;
            right: 15%;
            animation: drift 15s infinite reverse;
        }

        @keyframes drift {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(30px, 30px); }
        }

        @media (max-width: 768px) {
            .error-code {
                font-size: 120px;
            }
            h1 {
                font-size: 32px;
            }
            p {
                font-size: 16px;
            }
            .astronaut {
                font-size: 60px;
            }
        }
    </style>
</head>
<body>
    <div class="stars" id="stars"></div>
    <div class="planet planet1"></div>
    <div class="planet planet2"></div>
    
    <div class="container">
        <div class="error-code">404</div>
        <div class="astronaut">🚀</div>
        <h1>Oops! Página Não Encontrada</h1>
        <p>Parece que você se perdeu no espaço. A página que você procura não existe ou foi movida para outra galáxia.</p>
        <a href="/" class="btn">Voltar para Casa</a>
    </div>

    <script>
        // Criar estrelas aleatórias
        const starsContainer = document.getElementById('stars');
        for (let i = 0; i < 100; i++) {
            const star = document.createElement('div');
            star.className = 'star';
            star.style.left = Math.random() * 100 + '%';
            star.style.top = Math.random() * 100 + '%';
            star.style.animationDelay = Math.random() * 3 + 's';
            starsContainer.appendChild(star);
        }
    </script>
</body>
</html>