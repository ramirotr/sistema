<?php
session_start();
include_once 'include/conexao.php'; // Inclusão do arquivo de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Receber o login e senha do formulário
    $usuario = $_POST['usuario'] ?? '';  // Usando operador de coalescência nula
    $senha = $_POST['senha'] ?? '';      // Usando operador de coalescência nula
    
    // Preparar a consulta SQL para buscar o usuário no banco de dados
    $sql = "SELECT * FROM usuarios WHERE Usuario = ? AND Senha = ?";
    $stmt = $conn->prepare($sql);
    
    // Verificar se o prepare foi bem-sucedido
    if ($stmt === false) {
        die('Erro na consulta: ' . $conn->error);
    }
    
    $stmt->bind_param("ss", $usuario, $senha); // Usamos "ss" para definir que tanto o usuário quanto a senha são do tipo string.
    
    // Executar a consulta
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Se encontrar o usuário e a senha no banco
    if ($result->num_rows > 0) {
        // Armazena as informações na sessão
        $row = $result->fetch_assoc();
        $_SESSION['usuario'] = $row['Usuario']; // Aqui, você pode salvar outras informações se necessário (como nome, id, etc.)
        
        // Redireciona para a página inicial ou a página desejada após o login
        header("Location: lista-setores.php");
        exit;
    } else {
        // Caso não encontre o usuário, exibe uma mensagem de erro
        $erro = "Usuário ou senha incorretos!";
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
    <div id="login" class="tela active">
      <form class="login-form" method="POST" action="login.php">
        <h2>Login</h2>
        <input type="text" name="usuario" placeholder="Usuário" required />
        <input type="password" name="senha" placeholder="Senha" required />
        <button type="submit">Entrar</button>
        <?php
            if (isset($erro)) {
                echo "<p style='color:red;'>$erro</p>";
            }
        ?>
      </form>
    </div>
  </main>

  <script src="./assets/script.js"></script>
</body>
</html>
