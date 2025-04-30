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
    $preco = $_POST['preco'];
    $peso = $_POST['peso'];
    $descricao = $_POST['descricao'];
    $categoria_id = $_POST['categoria'];

    // Verifica se é uma edição ou uma nova inserção
    if ($id) {
        // Edição - Atualiza o produto
        $sql = "UPDATE produtos SET Nome = '$nome', Preco = '$preco', Peso = '$peso', Descricao = '$descricao', CategoriaID = '$categoria_id' WHERE ProdutoID = $id";
    } else {
        // Inserção - Cria um novo produto
        $sql = "INSERT INTO produtos (Nome, Preco, Peso, Descricao, CategoriaID) VALUES ('$nome', '$preco', '$peso', '$descricao', '$categoria_id')";
    }

    // Executa a consulta
    if ($conn->query($sql)) {
        // Se a operação for bem-sucedida, redireciona para a lista de produtos
        header("Location: lista-produtos.php");
        exit();
    } else {
        echo "Erro ao salvar produto: " . $conn->error;
    }
}

// Se for para editar, recupera os dados do produto
if ($id) {
    $sql = "SELECT * FROM produtos WHERE ProdutoID = $id";
    $resultado = $conn->query($sql);
    $produto = $resultado->fetch_assoc();
}

// Recupera as categorias para preencher o select
$sql_categorias = "SELECT CategoriaID, Nome FROM categorias";
$resultado_categorias = $conn->query($sql_categorias);
?>

<main>
    <div id="produtos" class="tela">
        <form class="crud-form" action="" method="post">
          <h2><?php echo $id ? 'Editar Produto' : 'Cadastro de Produto'; ?></h2>

          <!-- Campo Nome do Produto -->
          <input type="text" name="nome" placeholder="Nome do Produto" value="<?php echo $id ? $produto['Nome'] : ''; ?>" required>

          <!-- Campo Preço -->
          <input type="number" name="preco" placeholder="Preço" value="<?php echo $id ? $produto['Preco'] : ''; ?>" required>

          <!-- Campo Peso -->
          <input type="number" name="peso" placeholder="Peso (g)" value="<?php echo $id ? $produto['Peso'] : ''; ?>" required>

          <!-- Campo Descrição -->
          <textarea name="descricao" placeholder="Descrição" required><?php echo $id ? $produto['Descricao'] : ''; ?></textarea>

          <!-- Campo Categoria -->
          <select name="categoria" required>
            <option value="">Categoria</option>
            <?php while ($categoria = $resultado_categorias->fetch_assoc()) { ?>
              <option value="<?php echo $categoria['CategoriaID']; ?>" <?php echo ($id && $produto['CategoriaID'] == $categoria['CategoriaID']) ? 'selected' : ''; ?>>
                <?php echo $categoria['Nome']; ?>
              </option>
            <?php } ?>
          </select>

          <button type="submit"><?php echo $id ? 'Atualizar' : 'Salvar'; ?></button>
        </form>
    </div>
</main>

<?php 
// include dos arquivos
include_once './include/footer.php';
?>
