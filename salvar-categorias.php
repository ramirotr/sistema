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
    $descricao = $_POST['descricao'];

    // Verifica se é uma edição ou uma nova inserção
    if ($id) {
        // Edição 
        $sql = "UPDATE categorias SET Nome = '$nome', Descricao = '$descricao' WHERE CategoriaID = $id";
    } else {
        // Inserção 
        $sql = "INSERT INTO categorias (Nome, Descricao) VALUES ('$nome', '$descricao')";
    }

    // Executa a consulta
    if ($conn->query($sql)) {
        // Se a operação deu bom, redireciona para a lista de categorias
        header("Location: lista-categorias.php");
        exit();
    } else {
        echo "Erro ao salvar categoria: " . $conn->error;
    }
}

// Se for para editar, recupera os dados da categoria
if ($id) {
    $sql = "SELECT * FROM categorias WHERE CategoriaID = $id";
    $resultado = $conn->query($sql);
    $categoria = $resultado->fetch_assoc();
}
?>

<main>
   <div id="categoriaID" class="tela">
      <form class="crud-form" method="POST" action="">
        <h2><?php echo $id ? 'Editar Categoria' : 'Cadastro de Categoria'; ?></h2>
        
        <!-- Campos do formulário -->
        <input type="text" name="nome" placeholder="Nome da Categoria" value="<?php echo $id ? $categoria['Nome'] : ''; ?>" required>
        <textarea name="descricao" placeholder="Descrição" required><?php echo $id ? $categoria['Descricao'] : ''; ?></textarea>
        
        <button type="submit"><?php echo $id ? 'Atualizar' : 'Salvar'; ?></button>
      </form>
   </div>
</main>

<?php 
// include dos arquivos
include_once './include/footer.php';
?>
