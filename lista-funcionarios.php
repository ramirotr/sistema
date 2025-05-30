<?php 
// includes dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

// Consulta ao banco de dados para trazer os funcionários com o nome do cargo e setor
$sql = "SELECT f.FuncionarioID, f.Nome, c.Nome AS Cargo, s.Nome AS Setor 
        FROM funcionarios f
        JOIN cargos c ON f.CargoID = c.CargoID
        JOIN setor s ON f.SetorID = s.SetorID";

// Execução da consulta
$resultado = $conn->query($sql);
?>

<main>
  <div class="container">
      <h1>Lista de Funcionários</h1>
      <a href="salvar-funcionarios.php" class="btn btn-add">Incluir</a> 
      
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Cargo</th>
            <th>Setor</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Exibe os dados de cada funcionário do banco
          while ($dado = $resultado->fetch_assoc()) {
          ?>
          <tr>
            <td><?php echo $dado['FuncionarioID']; ?></td>
            <td><?php echo $dado['Nome']; ?></td>
            <td><?php echo $dado['Cargo']; ?></td> <!-- Mostra o nome do cargo -->
            <td><?php echo $dado['Setor']; ?></td> <!-- Mostra o nome do setor -->
            <td>
              <!-- Botão Editar -->
              <a href="salvar-funcionarios.php?id=<?php echo $dado['FuncionarioID']; ?>" class="btn btn-edit">Editar</a>
              
              <!-- Botão Excluir -->
              <a href="excluir-funcionarios.php?id=<?php echo $dado['FuncionarioID']; ?>" class="btn btn-delete">Excluir</a>
            </td>
          </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
</main>

<?php 
// include dos arquivos
include_once './include/footer.php';
?>
