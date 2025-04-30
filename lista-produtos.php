<?php 
// includes dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

// Consulta ao banco de dados para trazer os produtos com os dados relacionados de Categoria
$sql = "SELECT p.ProdutoID, p.Nome AS Produto, c.Nome AS Categoria, p.Preco 
        FROM produtos p
        LEFT JOIN categorias c ON p.CategoriaID = c.CategoriaID"; // Consulta SQL com JOIN
$resultado = $conn->query($sql);
?>

<main>
  <div class="container">
      <h1>Lista de Produtos</h1>
      <a href="salvar-produtos.php" class="btn btn-add">Incluir</a> 
      
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Preço</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Exibe os dados de cada produto do banco
          while ($dado = $resultado->fetch_assoc()) {
          ?>
          <tr>
            <td><?php echo $dado['ProdutoID']; ?></td>
            <td><?php echo $dado['Produto']; ?></td>
            <td><?php echo $dado['Categoria']; ?></td>
            <td>R$ <?php echo number_format($dado['Preco'], 2, ',', '.'); ?></td>
            <td>
              <!-- Botão Editar - passa o ID do produto para editar -->
              <a href="salvar-produtos.php?id=<?php echo $dado['ProdutoID']; ?>" class="btn btn-edit">Editar</a>
              
              <!-- Botão Excluir - passa o ID do produto para excluir -->
              <a href="excluir-produtos.php?id=<?php echo $dado['ProdutoID']; ?>" class="btn btn-delete">Excluir</a>
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
