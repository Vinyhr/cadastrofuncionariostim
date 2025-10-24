<?php
session_start();

// Se já estiver logado, vai para o sistema
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: funcionarios.php");
    exit;
}

// Processar login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Credenciais fixas
    if ($username === 'admin123' && $password === 'admin123') {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        header("Location: funcionarios.php");
        exit;
    } else {
        $erro = true;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistema TIM</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #2b3251 0%, #2e40cd 100%);
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: white;
            padding: 50px 40px;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 420px;
            text-align: center;
        }

        .logo {
            color: #2e40cd;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .subtitle {
            color: #666;
            font-size: 16px;
            margin-bottom: 35px;
            font-weight: normal;
        }

        .form-group {
            margin-bottom: 25px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: bold;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 14px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: #2e40cd;
            outline: none;
        }

        button {
            width: 100%;
            padding: 15px;
            background: #2e40cd;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 10px;
        }

        button:hover {
            background: #1f2c99;
        }

        .error-message {
            color: #e74c3c;
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background: #ffeaea;
            border-radius: 5px;
            display: <?= isset($erro) && $erro ? 'block' : 'none' ?>;
        }

        .footer {
            margin-top: 30px;
            color: #999;
            font-size: 12px;
        }
    </style>
</head>
<body>
<div class="login-container">
    <!-- Cabeçalho com logo -->
    <div class="logo">TIM</div>
    <div class="subtitle">Acesso ao Sistema</div>
    
    <!-- Formulário de login -->
    <form method="POST" action="">
        <div class="form-group">
            <label for="username">Usuário</label>
            <input type="text" id="username" name="username" placeholder="Digite seu usuário" required>
        </div>
        
        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" id="password" name="password" placeholder="Digite sua senha" required>
        </div>
        
        <button type="submit">Entrar</button>
    </form>
    
    <!-- Mensagem de erro -->
    <div class="error-message">Usuário ou senha incorretos!</div>
    
    <!-- Rodapé -->
    <div class="footer">
        Sistema de Gestão de Funcionários
    </div>
</div>
</body>
</html>