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
    $data_nascimento = $_POST['data_nascimento'];
    $email = $_POST['email'];
    $salario = $_POST['salario'];
    $sexo = $_POST['sexo'];
    $altura = $_POST['altura'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $cargo = $_POST['cargo'];
    $setor = $_POST['setor'];

    // Verifica se é uma edição ou uma nova inserção
    if ($id) {
        // Edição - Atualiza o funcionário
        $sql = "UPDATE funcionarios SET Nome = '$nome', DataNascimento = '$data_nascimento', Email = '$email', Salario = '$salario', Sexo = '$sexo', Altura = '$altura', CPF = '$cpf', RG = '$rg', CargoID = '$cargo', SetorID = '$setor' WHERE FuncionarioID = $id";
    } else {
        // Inserção - Cria um novo funcionário
        $sql = "INSERT INTO funcionarios (Nome, DataNascimento, Email, Salario, Sexo, Altura, CPF, RG, CargoID, SetorID) VALUES ('$nome', '$data_nascimento', '$email', '$salario', '$sexo', '$altura', '$cpf', '$rg', '$cargo', '$setor')";
    }

    // Executa a consulta
    if ($conn->query($sql)) {
        // Se a operação for bem-sucedida, redireciona para a lista de funcionários
        header("Location: lista-funcionarios.php");
        exit();
    } else {
        echo "Erro ao salvar funcionário: " . $conn->error;
    }
}

// Se for para editar, recupera os dados do funcionário
if ($id) {
    $sql = "SELECT * FROM funcionarios WHERE FuncionarioID = $id";
    $resultado = $conn->query($sql);
    $funcionario = $resultado->fetch_assoc();
}
?>

<main>
    <div id="funcionarios" class="tela">
        <form class="crud-form" method="POST" action="">
          <h2><?php echo $id ? 'Editar Funcionário' : 'Cadastro de Funcionário'; ?></h2>

          <!-- Campos do formulário -->
          <input type="text" name="nome" placeholder="Nome" value="<?php echo $id ? $funcionario['Nome'] : ''; ?>" required>
          <input type="date" name="data_nascimento" placeholder="Data de Nascimento" value="<?php echo $id ? $funcionario['DataNascimento'] : ''; ?>" required>
          <input type="email" name="email" placeholder="Email" value="<?php echo $id ? $funcionario['Email'] : ''; ?>" required>
          <input type="number" name="salario" placeholder="Salário" value="<?php echo $id ? $funcionario['Salario'] : ''; ?>" required>
          
          <select name="sexo" required>
            <option value="">Sexo</option>
            <option value="M" <?php echo $id && $funcionario['Sexo'] == 'M' ? 'selected' : ''; ?>>Masculino</option>
            <option value="F" <?php echo $id && $funcionario['Sexo'] == 'F' ? 'selected' : ''; ?>>Feminino</option>
          </select>

          <input type="number" name="altura" placeholder="Altura (cm)" value="<?php echo $id ? $funcionario['Altura'] : ''; ?>" required>
          <input type="text" name="cpf" placeholder="CPF" value="<?php echo $id ? $funcionario['CPF'] : ''; ?>" required>
          <input type="text" name="rg" placeholder="RG" value="<?php echo $id ? $funcionario['RG'] : ''; ?>" required>

          <select name="cargo" required>
            <option value="">Cargo</option>
            <!-- Preencher com cargos do banco -->
            <option value="Cargo A" <?php echo $id && $funcionario['CargoID'] == 'Cargo A' ? 'selected' : ''; ?>>Cargo A</option>
            <option value="Cargo B" <?php echo $id && $funcionario['CargoID'] == 'Cargo B' ? 'selected' : ''; ?>>Cargo B</option>
          </select>

          <select name="setor" required>
            <option value="">Setor</option>
            <!-- Preencher com setores do banco -->
            <option value="Setor A" <?php echo $id && $funcionario['SetorID'] == 'Setor A' ? 'selected' : ''; ?>>Setor A</option>
            <option value="Setor B" <?php echo $id && $funcionario['SetorID'] == 'Setor B' ? 'selected' : ''; ?>>Setor B</option>
          </select>

          <button type="submit"><?php echo $id ? 'Atualizar' : 'Salvar'; ?></button>
        </form>
    </div>
</main>

<?php 
// include dos arquivos
include_once './include/footer.php';
?>
