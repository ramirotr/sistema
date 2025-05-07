<?php 
// includes dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

// Consulta ao banco de dados para trazer os setores
$sql = "SELECT * FROM setor"; // A consulta SQL
$resultado = $conn->query($sql);
?>
<main>
  <div class="container">
      <h1>Lista de Setores</h1>
      <a href="salvar-setores.php" class="btn btn-add">Incluir</a>
      
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th> 
            <th>Andar</th>
            <th>Cor</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Exibe os dados de cada setor do banco
          while ($dado = $resultado->fetch_assoc()){
          ?>
          <tr>
            <td><?php echo $dado['SetorID']; ?></td>
            <td><?php echo $dado['Nome']; ?></td>
            <td><?php echo $dado['Andar']; ?></td>
            <td><?php echo $dado['Cor']; ?></td>
            <td>
              <!-- Botão Editar -->
              <a href="salvar-setores.php?id=<?php echo $dado['SetorID']; ?>" class="btn btn-edit">Editar</a>
              <!-- Botão Excluir -->
              <a href="excluir-setores.php?id=<?php echo $dado['SetorID']; ?>" class="btn btn-delete">Excluir</a>
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
