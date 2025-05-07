<?php 
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

// Verifica se o ID foi passado para edição
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Se o formulário for enviado, processa a inclusão ou edição
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura os dados do formulário
    $nome = $_POST['nome'];
    $teto_salarial = $_POST['teto_salarial'];

    // Verifica se é uma edição ou uma nova inserção
    if ($id) {
        // Edição 
        $sql = "UPDATE cargos SET Nome = '$nome', TetoSalarial = '$teto_salarial' WHERE CargoID = $id";
    } else {
        // Inserção 
        $sql = "INSERT INTO cargos (Nome, TetoSalarial) VALUES ('$nome', '$teto_salarial')";
    }

    // Executa a consulta
    if ($conn->query($sql)) {
        // Se deu bom, redireciona para a lista de cargos
        header("Location: lista-cargos.php");
        exit();
    } else {
        echo "Erro ao salvar cargo: " . $conn->error;
    }
}

// Se for para editar, recupera os dados do cargo
if ($id) {
    $sql = "SELECT * FROM cargos WHERE CargoID = $id";
    $resultado = $conn->query($sql);
    $cargo = $resultado->fetch_assoc();
}
?>

<main>
   <!-- Telas CRUD -->
   <div id="cargos" class="tela">
    <form class="crud-form" method="post" action="">
      <h2><?php echo $id ? 'Editar Cargo' : 'Cadastro de Cargo'; ?></h2>
      
      <!-- Campos do formulário -->
      <input type="text" name="nome" placeholder="Nome do Cargo" value="<?php echo $id ? $cargo['Nome'] : ''; ?>" required>
      <input type="number" name="teto_salarial" placeholder="Teto Salarial" value="<?php echo $id ? $cargo['TetoSalarial'] : ''; ?>" required>
      
      <button type="submit"><?php echo $id ? 'Atualizar' : 'Salvar'; ?></button>
    </form>
  </div>
</main>

<?php 
// include dos arquivos
include_once './include/footer.php';
?>
