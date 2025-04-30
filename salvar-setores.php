<?php 
// includes dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

// Verifica se o ID foi passado para edição
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Se o formulário for enviado, processa a inclusão ou edição
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura os dados do formulário
    $nome = $_POST['nome'];
    $andar = $_POST['andar'];
    $cor = $_POST['cor'];

    // Verifica se é uma edição ou uma nova inserção
    if ($id) {
        // Edição - Atualiza o setor
        $sql = "UPDATE setor SET Nome = '$nome', Andar = '$andar', Cor = '$cor' WHERE SetorID = $id";
    } else {
        // Inserção - Cria um novo setor
        $sql = "INSERT INTO setor (Nome, Andar, Cor) VALUES ('$nome', '$andar', '$cor')";
    }

    // Executa a consulta
    if ($conn->query($sql)) {
        // Se a operação for bem-sucedida, redireciona para a lista de setores
        header("Location: lista-setores.php");
        exit();
    } else {
        echo "Erro ao salvar setor: " . $conn->error;
    }
}

// Se for para editar, recupera os dados do setor
if ($id) {
    $sql = "SELECT * FROM setor WHERE SetorID = $id";
    $resultado = $conn->query($sql);
    $setor = $resultado->fetch_assoc();
}
?>
  
<main>
    <div id="setores" class="tela">
        <form class="crud-form" method="post" action="">
          <h2><?php echo $id ? 'Editar Setor' : 'Cadastro de Setor'; ?></h2>

          <!-- Campos do formulário -->
          <input type="text" name="nome" placeholder="Nome do Setor" value="<?php echo $id ? $setor['Nome'] : ''; ?>" required>
          <input type="text" name="andar" placeholder="Andar" value="<?php echo $id ? $setor['Andar'] : ''; ?>" required>
          <input type="text" name="cor" placeholder="Cor" value="<?php echo $id ? $setor['Cor'] : ''; ?>" required>

          <button type="submit"><?php echo $id ? 'Atualizar' : 'Salvar'; ?></button>
        </form>
    </div>
</main>

<?php 
// include dos arquivos
include_once './include/footer.php';
?>
