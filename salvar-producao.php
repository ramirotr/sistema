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
    $produto_id = $_POST['produto'];
    $funcionario_id = $_POST['funcionario'];
    $data_producao = $_POST['data_producao']; // Novo campo para Data de Produção
    $data_entrega = $_POST['data_entrega'];

    // Verifica se é uma edição ou uma nova inserção
    if ($id) {
        // Edição
        $sql = "UPDATE producao SET ProdutoID = '$produto_id', FuncionarioID = '$funcionario_id', DataProducao = '$data_producao', DataEntrega = '$data_entrega' WHERE ProducaoID = $id";
    } else {
        // Inserção 
        $sql = "INSERT INTO producao (ProdutoID, FuncionarioID, DataProducao, DataEntrega) VALUES ('$produto_id', '$funcionario_id', '$data_producao', '$data_entrega')";
    }

    // Executa a consulta
    if ($conn->query($sql)) {
        // Se deu bom, redireciona para a lista de produções
        header("Location: lista-producao.php");
        exit();
    } else {
        echo "Erro ao salvar produção: " . $conn->error;
    }
}

// Se for para editar, recupera os dados da produção
if ($id) {
    $sql = "SELECT * FROM producao WHERE ProducaoID = $id";
    $resultado = $conn->query($sql);
    $producao = $resultado->fetch_assoc();
}

// Recupera os funcionários e produtos para preencher os selects
$sql_funcionarios = "SELECT FuncionarioID, Nome FROM funcionarios";
$resultado_funcionarios = $conn->query($sql_funcionarios);

$sql_produtos = "SELECT ProdutoID, Nome FROM produtos";
$resultado_produtos = $conn->query($sql_produtos);
?>

<main>
    <div id="producao" class="tela">
        <form class="crud-form" method="POST" action="">
          <h2><?php echo $id ? 'Editar Produção' : 'Cadastro de Produção de Produtos'; ?></h2>

          <!-- Campo dos Funcionários -->
          <select name="funcionario">
            <option value="">Funcionário</option>
            <?php while ($funcionario = $resultado_funcionarios->fetch_assoc()) { ?>
              <option value="<?php echo $funcionario['FuncionarioID']; ?>" <?php echo ($id && $producao['FuncionarioID'] == $funcionario['FuncionarioID']) ? 'selected' : ''; ?>>
                <?php echo $funcionario['Nome']; ?>
              </option>
            <?php } ?>
          </select>

          <!-- Campo dos Produtos -->
          <select name="produto">
            <option value="">Produto</option>
            <?php while ($produto = $resultado_produtos->fetch_assoc()) { ?>
              <option value="<?php echo $produto['ProdutoID']; ?>" <?php echo ($id && $producao['ProdutoID'] == $produto['ProdutoID']) ? 'selected' : ''; ?>>
                <?php echo $produto['Nome']; ?>
              </option>
            <?php } ?>
          </select>

          <!-- Campo Datas de Produção -->
          <label for="data_producao">Data de Produção</label>
          <input type="date" name="data_producao" value="<?php echo $id ? $producao['DataProducao'] : ''; ?>">

          <!-- Campo Datas da Entrega -->
          <label for="data_entrega">Data da Entrega</label>
          <input type="date" name="data_entrega" value="<?php echo $id ? $producao['DataEntrega'] : ''; ?>">

          <button type="submit"><?php echo $id ? 'Atualizar' : 'Salvar'; ?></button>
        </form>
    </div>
</main>

<?php 
// include dos arquivos
include_once './include/footer.php';
?>
