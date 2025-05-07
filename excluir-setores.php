<?php
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';

// Verifica se o ID foi passado pela URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    // Consulta para excluir o setor do banco de dados
    $sql = "DELETE FROM setor WHERE SetorID = $id";
    
    // Executa a consulta
    if ($conn->query($sql)) {
        // Se excluiu, redireciona para a lista de setores
        header("Location: lista-setores.php");
        exit();
    } else {
        echo "Erro ao excluir o setor: " . $conn->error;
    }
} else {
    echo "ID não fornecido.";
}
?>
