<?php
session_start();
// Verificação de autenticação
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['user_type'] !== 'administrador') {
    header("Location: loginadmin.php");
    exit;
}
include 'basedados.php';


// Consulta para recuperar informações das encomendas
$sql_encomendas = "SELECT * FROM Encomendas";
$result_encomendas = $conn->query($sql_encomendas);

// Consulta para recuperar informações dos produtos
$sql_produtos = "SELECT * FROM Produtos";
$result_produtos = $conn->query($sql_produtos);

// Verificar se o formulário foi submetido para inserir um novo produto
if ($_SERVER["REQUEST_METHOD"] == "POST") {
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <title>Página do Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
    .teste{ 
        
    } 
    .nav-link {
      margin-left: 30px;
    }
    .container-nav{
      border: 0.1px solid lightgrey;
      background-color: lightgrey; 
    }
    .container-top{
      margin: 0px 400px;
    }
    .container-valor{
      background-color: lightgrey; 
    }
    .navbar-brand{
             margin-left: auto;
            margin-right: auto;
            display: block;
            text-align: center;
            
    }
    #sessao{
        text-decoration: none;
        color: black;
        padding-right: 50px;
    }
    #sessao:hover{
        color: blue;
    }
    .container-header, .container-produtos{
        display:flex;
        margin-top: 100px;

    }
    .encomendas{
        width: 50%;
        text-align:center;
    }
    .produtos{
        width: 50%;
        text-align:center;
    }

    .inserir{
        margin-left: 50px;
        width:33%;
        border-right: 1px solid black;
    }
    .alterar{
        margin-left: 50px;
        width:33%;
        border-right: 1px solid black;

    }
    .excluir{
        margin-left: 50px;
        width:33%;
        

    }
    table{
       
        width:auto;
        height:auto;
        margin-left:25%;
    }
    table, tr, th, td{
        border: 1px solid black;
        padding: 3px 10px;
    }
    h2{
        text-align: center;
        margin-bottom: 30px;
    }
    input{
        margin-right:200px;
        float: right;
    }
    #excluirbotao{
        margin-top: 90px;
    }
    button{
        
        margin-left: 200px;
    }
    
    </style>
    
</head>
<body>
<div class="container-nav">
    <nav class=" teste navbar navbar-expand-lg ">
      <div class="container-fluid">
        <a class="navbar-brand">Loja Online Administração</a>
          <a id="sessao" href="logout.php">Terminar Sessão</a>
        </div>
      </div>
    </nav>
  </div>

<div class="container-header">
  <div class="encomendas">
    <h2>Encomendas Realizadas</h2>
    <?php if ($result_encomendas->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Numero da Encomenda</th>
                    <th>Nome</th>
                    <th>Morada</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result_encomendas->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['encomendaID']; ?></td>
                        <td><?php echo $row['nome']; ?></td>
                        <td><?php echo $row['morada']; ?></td>
                        <td><?php echo $row['produto']; ?></td>
                        <td><?php echo $row['quantidade']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhuma encomenda realizada.</p>
    <?php endif; ?>
    </div>


<div class="produtos">
    <h2>Produtos</h2>
    <?php if ($result_produtos->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID Produto</th>
                    <th>Nome</th>
                    <th>Quantidade Disponível</th>
                    <th>Preço por Unidade</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result_produtos->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['produtoID']; ?></td>
                        <td><?php echo $row['nome']; ?></td>
                        <td><?php echo $row['quantidade']; ?></td>
                        <td><?php echo $row['preco']; ?>,00€</td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum produto cadastrado.</p>
    <?php endif; ?>
    </div>
    </div>

<hr>
<div class="container-produtos">
    <div class="inserir">
    <h2>Inserir Novo Produto</h2>
    <form method="POST" action="inserir_produto.php">
    <label for="nome">Nome do Produto:</label>
    <input type="text" id="nome" name="nome" required><br><br>
    
    <label for="quantidade">Quantidade:</label>
    <input type="number" id="quantidade" name="quantidade" required><br><br>
    
    <label for="preco">Preço por Unidade:</label>
    <input type="number" id="preco" name="preco" step="0.01" required><br><br>
    
    <button type="submit">Inserir Produto</button>
    </form>
    </div>
<br>
<div class="alterar">
    <h2>Alterar Preço e Quantidade</h2>
    <form method="POST" action="alterar_produto.php">
    <label for="produtoID">ID do Produto:</label>
    <input type="number" id="produtoID" name="produtoID" required><br><br>
    
    <label for="preco">Novo Preço por Unidade:</label>
    <input type="number" id="preco" name="preco" step="0.01" ><br><br>
    
    <label for="quantidade">Nova Quantidade:</label>
    <input type="number" id="quantidade" name="quantidade" ><br><br>
    
    <button type="submit">Alterar Produto</button>
    </form>
    </div>
<br>
<div class="excluir">
    <h2>Excluir Produto</h2>
    <form method="POST" action="excluir_produto.php">
    <label for="produtoID">ID do Produto:</label>
    <input type="number" id="produtoID" name="produtoID" required><br><br>
    
    <button id="excluirbotao" type="submit">Excluir Produto</button>
    </form>
    </div>
    </div>
    <div>
        <hr>
    </div>
</body>
</html>
