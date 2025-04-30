<?php
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';

// Verifica se o ID foi passado pela URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    // Consulta para excluir o funcionário do banco de dados
    $sql = "DELETE FROM funcionarios WHERE FuncionarioID = $id";
    
    // Executa a consulta
    if ($conn->query($sql)) {
        // Se a exclusão for bem-sucedida, redireciona para a lista de funcionários
        header("Location: lista-funcionarios.php");
        exit();
    } else {
        echo "Erro ao excluir o funcionário: " . $conn->error;
    }
} else {
    echo "ID não fornecido.";
}
?>
