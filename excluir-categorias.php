<?php
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';

// Verifica se o ID foi passado pela URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    // Consulta para excluir a categoria do banco de dados
    $sql = "DELETE FROM categorias WHERE CategoriaID = $id";
    
    // Executa a consulta
    if ($conn->query($sql)) {
        // Se a exclusão for bem-sucedida, redireciona para a lista de categorias
        header("Location: lista-categorias.php");
        exit();
    } else {
        echo "Erro ao excluir a categoria: " . $conn->error;
    }
} else {
    echo "ID não fornecido.";
}
?>
