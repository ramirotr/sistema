<?php
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';

// Verifica se o ID foi passado pela URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    // Consulta para excluir a produção do banco de dados
    $sql = "DELETE FROM producao WHERE ProducaoID = $id";
    
    // Executa a consulta
    if ($conn->query($sql)) {
        // Se excluiu, redireciona para a lista de produções
        header("Location: lista-producao.php");
        exit();
    } else {
        echo "Erro ao excluir a produção: " . $conn->error;
    }
} else {
    echo "ID não fornecido.";
}
?>
