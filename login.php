
<?php
session_start();

// Usuário e senha do administrador
$admin_user = 'admin'; // Nome do usuário de admin
$admin_pass = 'senhaadmin'; // Senha do admin (só um exemplo)

// Se já estiver logado, redireciona diretamente para a página desejada
if (isset($_SESSION['usuario'])) {
    header("Location: lista-setores.php"); // Pode ser qualquer página que você escolher
    exit();
}

// Verifica se o formulário foi enviado
if (isset($_POST['usuario']) && isset($_POST['senha'])) {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Verifica se o nome de usuário e senha são os do administrador
    if ($usuario === $admin_user && $senha === $admin_pass) {
        // Cria a sessão para o admin
        $_SESSION['usuario'] = $usuario;
        header("Location: lista-setores.php"); // Redireciona para qualquer página após o login
        exit();
    } else {
        $erro = "Usuário ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema Empresarial</title>
  <link rel="stylesheet" href="./assets/style.css">
  <style>
    /* Adicionei um estilo básico para o login */
    .login-form {
        width: 300px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
 
    .login-form input {
        width: 100%;
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
 
    .login-form button {
        width: 100%;
        padding: 10px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
 
    .login-form button:hover {
        background-color: #218838;
    }
 
    /* Para a mensagem de erro */
    .erro {
        color: red;
        font-size: 14px;
        text-align: center;
        margin-top: 10px;
    }
  </style>
</head>
<body>
  <header>
    <h1>Sistema de Gestão de Empresa</h1>
  </header>
 
  <main>
    <!-- Tela de login -->
    <div id="login" class="tela active">
      <!-- Formulário de login -->
      <form class="login-form" method="POST" action="login.php">
        <h2>Login</h2>
       
        <!-- Exibe a mensagem de erro se houver -->
        <?php if (isset($erro)) { echo "<div class='erro'>$erro</div>"; } ?>
 
        <input type="text" name="usuario" placeholder="Usuário" required />
        <input type="password" name="senha" placeholder="Senha" required />
        <button type="submit">Entrar</button>
      </form>
    </div>
  </main>
 
  <script src="./assets/script.js"></script>
</body>
</html>
 
