<?php
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';

// Verifica se o ID foi passado pela URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    // Consulta para excluir o cargo do banco de dados
    $sql = "DELETE FROM cargos WHERE CargoID = $id";
    
    // Executa a consulta
    if ($conn->query($sql)) {
        // Se a exclusão for bem-sucedida, redireciona para a lista de cargos
        header("Location: lista-cargos.php");
        exit();
    } else {
        echo "Erro ao excluir o cargo: " . $conn->error;
    }
} else {
    echo "ID não fornecido.";
}
?>
