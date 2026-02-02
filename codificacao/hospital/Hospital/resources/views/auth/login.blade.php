<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <!-- Se você estiver usando Vite (padrão do Laravel), use isso: -->
    
    
    <!-- Se não, use o link direto do Tailwind para testar: -->
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
      body {
        font-family: 'Inter', sans-serif;
      }
    </style>
</head>
<!-- Fundo verde simples -->
<body class="bg-green-100 flex items-center justify-center h-screen">

    <!-- Card de login centralizado -->
    <div class="w-full max-w-sm bg-white p-8 rounded-2xl shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Acessar Conta</h2>

        <!-- Mensagem de Status (ex: reset de senha) -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <!-- Formulário de login com a lógica Blade correta -->
        <form method="POST" action="{{ route('login') }}">
            <!-- Token de Segurança CSRF (Obrigatório) -->
            @csrf
            
            <!-- Campo de Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <!-- :value="old('email')" preenche o email se o login falhar -->
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full border border-gray-300 rounded-lg p-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                <!-- Mostra erros de validação do Laravel -->
                @error('email')
                    <p class="text-red-500 text-sm mt-1">Email ou senha inválidos</p>
                @enderror
            </div>

            <!-- Campo de Senha -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
                <input type="password" id="password" name="password" required
                       class="w-full border border-gray-300 rounded-lg p-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Opções "Lembrar-me" e "Esqueceu a senha?" -->
            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center text-sm text-gray-600">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                    <span class="ml-2">Lembrar-me</span>
                </label>

                <!-- Link para resetar senha (se a rota existir) -->

            </div>

            <!-- Botão de Entrar -->
            <button type="submit"
                    class="w-full bg-green-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition">
                Entrar
            </button>
        </form>
    </div>

</body>
</html>