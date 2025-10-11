<?php
session_start();
include 'basedados.php';
$produtosComprados = isset($_SESSION['produtos_comprados']) ? $_SESSION['produtos_comprados'] : [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $morada = $_POST['morada'];
    $preco_total = 0;
    foreach ($produtosComprados as $produto) {
        $preco_total += $produto['preco'];
    }
    
    // Inicializar a consulta SQL
    $sql = "INSERT INTO encomendas (encomendaID, nome, data_nascimento, morada, produto, quantidade, preco_total) VALUES ";
    
    // Loop pelos produtos comprados para adicionar à consulta SQL
    foreach ($produtosComprados as $produto) {
        // Obter os valores de produto e quantidade
        $produto_nome = $produto['produto'];
        $quantidade = $produto['quantidade'];
        $sql .= "(NULL, '$nome', '$data_nascimento', '$morada', '$produto_nome', '$quantidade', '$preco_total'), ";
    }
    
    $sql = rtrim($sql, ", ");
    
    // Executar a consulta SQL
    if ($conn->query($sql) === TRUE) {
        echo "Encomenda realizada com sucesso!";
    } else {
        echo "Erro ao realizar a encomenda: " . $conn->error;
    }
}

// Fechar a conexão com o banco de dados
$conn->close();
?>




<!doctype html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Loja Online - Rui Silva</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .nav-link-custom:hover {
      color: blue;
    }
    .nav-link {
      margin-left: 30px;
    }
    .container-nav{
      border: 0.1px solid lightgrey;
      background-color: lightgrey; 
    }
    .teste{ 
        margin: 0px 400px;
        margin-top: 10px;
    } 
    .navbar-brand:hover{
        color: blue;
    }
    .alert-custom {
      display: none;
      margin-top: 10px;
    }

    #produtos-comprados {
        border: 1px solid lightgrey;
        padding: 10px;
        margin-bottom: 20px;
        margin: 0px 400px;
    }

    .produto {
        margin-bottom: 10px;
        text-align: center;
    }

    .produto strong {
        color: #333;
    }

    .produto span {
        font-weight: bold;
        color: #555;
    }
    h2{
        text-align:center;
    }
    .formulario{
        margin: 0px 250px;
    }
    .concluirtransicao{
        float: right;
    }
  </style>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const produtosCompradosContainer = document.getElementById('produtos-comprados');
      const produtosComprados = <?php echo json_encode($produtosComprados); ?>;


      document.querySelector('form').addEventListener('submit', function(event) {
        const alertBox = document.getElementById('alert-box');
        const nome = document.getElementById('nome').value.trim();
        const dob = document.getElementById('dob').value;
        const morada = document.getElementById('morada').value.trim();

        alertBox.style.display = 'none';

        if (!nome || !dob || !morada) {
          showAlert('Todos os campos devem ser preenchidos.');
          event.preventDefault();
          return;
        }

        const dobDate = new Date(dob);
        const today = new Date();
        const age = today.getFullYear() - dobDate.getFullYear();
        const month = today.getMonth() - dobDate.getMonth();
        if (month < 0 || (month === 0 && today.getDate() < dobDate.getDate())) {
          age--;
        }

        if (age < 18) {
          showAlert('A idade deve ser igual ou superior a 18 anos.');
          event.preventDefault();
        }
      });

      function showAlert(message) {
        const alertBox = document.getElementById('alert-box');
        alertBox.innerHTML = message;
        alertBox.style.display = 'block';
      }
    });
  </script>
</head>
<body>
  <div class="container-nav">
    <nav class="teste navbar navbar-expand-lg">
      <div class="container-fluid">
        <a class="navbar-brand" href="paginaprincipal.php">Loja Online</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link nav-link-custom" aria-current="page" href="#">Quem somos</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link nav-link-custom dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Produtos
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item nav-link-custom" href="#">Televisão</a></li>
                <li><a class="dropdown-item nav-link-custom" href="#">Internet</a></li>
                <li><a class="dropdown-item nav-link-custom" href="#">Telefone</a></li>
                <li><a class="dropdown-item nav-link-custom" href="#">Telemóvel</a></li>
              </ul>
            </li>
          </ul>
          <a class="btn btn-outline-dark" type="button" href="loginadmin.php">Página Administração</a>
        </div>
      </div>
    </nav>
  </div>
  <div class="container mt-5">
    <h2>Produtos Comprados</h2>
    <div id="produtos-comprados" class="mb-5">
        <?php 
        // Array para rastrear produtos já exibidos
        $produtos_exibidos = array(); 
        // Variável para armazenar o valor total
        $valor_total = 0;

        // Percorre a lista de produtos comprados
        foreach ($produtosComprados as $produto): 
            // Verifica se o produto já foi exibido
            if (!in_array($produto['produto'], $produtos_exibidos)) {
                // Adiciona o produto à lista de produtos exibidos
                $produtos_exibidos[] = $produto['produto']; 
                
                // Calcula a quantidade total para este produto
                $quantidade_total = 0;
                foreach ($produtosComprados as $p) {
                    if ($p['produto'] === $produto['produto']) {
                        $quantidade_total += (int)$p['quantidade'];
                    }
                }
                
                // Calcula o preço total para este produto
                $preco_total = $quantidade_total * $produto['preco'];
                // Soma o preço total ao valor total
                $valor_total += $preco_total;
        ?>
                <!-- Exibe o produto e a quantidade total -->
                <div class="produto">
                    <strong><?php echo htmlspecialchars($produto['produto']); ?></strong>: 
                    <?php echo $quantidade_total; ?> x 
                    <?php echo number_format((float)$produto['preco'], 2, ',', '.'); ?>€
                    = <?php echo number_format((float)$preco_total, 2, ',', '.'); ?>€
                </div>
        <?php 
            }
        endforeach; 
        ?>
        <hr>
         <!-- Exibe o valor total -->
    <h2>Valor Total: <?php echo number_format((float)$valor_total, 2, ',', '.'); ?>€</h2>
    </div>

    <div id="alert-box" class="alert alert-danger alert-custom"></div>

    <h2>Formulário da Compra</h2>
    <form action="finalizar_compra.php" method="post" class="formulario">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="mb-3">
            <label for="dob" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
        </div>
        <div class="mb-3">
            <label for="morada" class="form-label">Morada</label>
            <input type="text" class="form-control" id="morada" name="morada" required>
        </div>
        <button type="submit" class="btn btn-primary concluirtransicao">Concluir Compra</button>
    </form>
</div>


</body>
</html>
