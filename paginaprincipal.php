<?php
session_start();
include 'basedados.php';

// Consulta SQL para obter a quantidade disponível de cada produto
$sqlQuantidade = "SELECT produtoID, quantidade FROM produtos";
$resultQuantidade = $conn->query($sqlQuantidade);

// Verifica se a consulta de quantidade foi executada com sucesso
if ($resultQuantidade === false) {
    echo "Erro na consulta SQL de quantidade: " . $conn->error;
    exit; // Encerra o script em caso de erro
}

// Array para armazenar as quantidades disponíveis de cada produto
$quantidades = array();

// Verifica se há linhas retornadas pela consulta de quantidade
if ($resultQuantidade->num_rows > 0) {
    // Loop através dos resultados da consulta e armazenar as quantidades disponíveis
    while ($row = $resultQuantidade->fetch_assoc()) {
        $quantidades[$row['produtoID']] = $row['quantidade'];
    }
} else {
    echo "Não foram encontrados resultados de quantidade.";
}

// Consulta SQL para obter todos os produtos
$sqlProdutos = "SELECT * FROM produtos";
$resultProdutos = $conn->query($sqlProdutos);

// Verifica se a consulta de produtos foi executada com sucesso
if ($resultProdutos === false) {
    echo "Erro na consulta SQL de produtos: " . $conn->error;
    exit; // Encerra o script em caso de erro
}

$conn->close();
?>

<!doctype html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/09a73467b8.js" crossorigin="anonymous"> </script>
  <title>Loja Online - Rui Silva</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .nav-link-custom:hover {
      color: blue;
    }
    .teste{ 
        margin: 0px 400px;
        margin-top: 10px;
    } 
    .nav-link {
      margin-left: 30px;
    }

    .valores {
      height: 350px;
      margin: 0px 400px;
    }
    .contactos {
      height: 100px;
      margin: 0px 400px;
      
    }
    .card {
      margin-left: 60px;
      margin-top: 30px;
      margin-bottom: 40px;
    }

    .quantidade-container {
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .quantidade {
      width: 50px;
      text-align: center;
      -moz-appearance: textfield; 
    }
    .quantidade::-webkit-outer-spin-button,
    .quantidade::-webkit-inner-spin-button {
      -webkit-appearance: none; 
      margin: 0;
    }
    .btn-quantidade {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 30px;
      height: 30px;
      border: 1px solid #ccc;
      background-color: #f8f9fa;
      cursor: pointer;
    }
    .btn-quantidade:hover {
      background-color: #e2e6ea;
    }
    .comprar{
        margin-top: 20px;
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
    .container-contacto{
      background-color: black;
    }
    #creditos{
    text-align: center;
    margin-top: 20px;
    padding: 10px 10px ;

}
.fa-brands{
    font-size: 20px;
    padding: 20px 10px;
}

.fa-solid{
   

}
#linkbilheteemail {
    text-decoration: none;
    color: #000000;
}
.container-contacto {
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100%;
        }

        .contactos {
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            margin-bottom: 20px;
        }

        p {
            margin: 5px 0;
        }
        .contactosfas{
          float: left;
          color:white;
        }
  </style>
</head>
<body>
  <div class="container-nav">
    <nav class=" teste navbar navbar-expand-lg ">
      <div class="container-fluid">
        <a class="navbar-brand">Loja Online</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link nav-link-custom" aria-current="page" href="#">Quem somos</a>
            </li>
            <li class="nav-item dropdown">
              <a class=" nav-link nav-link-custom dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
  <br> 
  <div class="header container-top">Loja Online, um espaço onde pode ter serviços de televisão, internet, telefone e telemovel.</div>
  <br>
  <div class="container d-flex justify-content-center align-items-center">
  </div>
  <div class="container mt-4 cards">
    <div class="row">
    <?php while ($produto = $resultProdutos->fetch_assoc()): ?>
      <div class="card col-sm-2">
        <?php
        $imagemCaminho = "imagem/produto{$produto['produtoID']}.png";
        $imagemExiste = file_exists($imagemCaminho);
        ?>
        <?php if ($imagemExiste): ?>
        <img src="<?= $imagemCaminho ?>" class="card-img-top" alt="<?= $produto['nome'] ?>">
        <?php else: ?>
        <img src="imagem/default.png" class="card-img-top" alt="Imagem não disponível">
        <?php endif; ?>
        <div class="card-body">
          <p class="card-text text-center"><?= htmlspecialchars($produto['nome']) ?></p>
          <p class="card-text text-center"><?= htmlspecialchars($produto['preco']) ?>€</p>
          <p class="card-text text-center">Disponíveis: <?= $produto['quantidade'] ?></p>
          <div class="quantidade-container">
            <div class="btn-quantidade" onclick="alterarQuantidade(this, -1)">-</div>
            <input type="number" class="quantidade" value="1" min="1" max="<?= $produto['quantidade'] ?>">
            <div class="btn-quantidade" onclick="alterarQuantidade(this, 1)">+</div>
          </div>
          <div class="d-flex justify-content-center">
            <button class="btn btn-primary comprar" data-produto-id="<?= $produto['produtoID'] ?>" data-produto="<?= htmlspecialchars($produto['nome']) ?>" data-preco="<?= htmlspecialchars($produto['preco']) ?>">Comprar</button>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
  <br>
  <div class="container-valor">
    <div class="valores p-3">
      <div>Produtos escolhidos:</div>
      <ul id="produtos-lista"></ul>
      <div>Valor total: <span id="valor-total">0</span>€</div>
      <div class="container d-flex justify-content-center align-items-center">
        <div class="row">
          <button class="btn btn-success" id="concluir-compra">Concluir Compra</button>
        </div>
      </div>
    </div>
  </div>
  <div class="container-contacto">
        <div class="contactos"><h3>Contactos<h3></div>
        <div class="contactosfas">
        <p><i class="fas fa-location-dot"></i> R. Cidade de Halle 7 / 9 Cave Direita, 3000-107 Coimbra</p>
        <p><i class="fas fa-phone"></i> TEL: 912387465 / TEF: 239019234</p>
        <br>
        <p><a target="_blank" href="https://outlook.live.com/owa/"><i class=" fa-solid fas fa-envelope"></i></a> Email: emailcontacto@gmail.com</p>
      <br>
      </div>
      </div>
  </div>
  <div class="container"  id="creditos">

<div class="final text-center ">
    <a target="_blank" id="linkbilheteemail" href="https://www.instagram.com/"><i
            class="fa-brands fa-instagram"></i></a>
    <a target="_blank" id="linkbilheteemail" href="https://www.facebook.com/"><i
            class="fa-brands fa-facebook"></i></a>
            <a target="_blank" id="linkbilheteemail" href="https://www.pinterest.pt/"><i class="fa-brands fa-pinterest"></i></a>
            
    <a target="_blank" id="linkbilheteemail" href="https://pt.linkedin.com/"><i
            class="fa-brands fa-linkedin"></i></a>
    <a target="_blank" id="linkbilheteemail" href="https://twitter.com"><i class="fa-brands fa-twitter"></i></a>
    <h4>Feito por Rui Silva</h4>

</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const botoesComprar = document.querySelectorAll('.comprar');
  const listaProdutos = document.getElementById('produtos-lista');
  const valorTotalElem = document.getElementById('valor-total');
  let valorTotal = 0;
  const quantidades = <?php echo json_encode($quantidades); ?>;

  // Evento de clique nos botões "Comprar"
  botoesComprar.forEach(botao => {
    botao.addEventListener('click', () => {
        // Obter informações do produto
        const produtoID = botao.getAttribute('data-produto-id');
        const produto = botao.getAttribute('data-produto');
        const preco = parseFloat(botao.getAttribute('data-preco'));
        const quantidadeInput = botao.closest('.card-body').querySelector('.quantidade');
        let quantidade = parseInt(quantidadeInput.value);

        // Verificar se a quantidade desejada está disponível
        if (quantidade > quantidades[produtoID]) {
            alert(`${produto} não disponível em stock.`);
            return;
        }

        // Calcular o preço total do produto
        const precoTotalProduto = preco * quantidade;

        // Criar item de produto na lista
        const item = document.createElement('li');
        item.textContent = `${produto} - ${quantidade} x ${preco}€ = ${precoTotalProduto}€`;

        // Botão de remover item
        const botaoRemover = document.createElement('button');
        botaoRemover.textContent = 'Remover';
        botaoRemover.className = 'btn btn-danger btn-sm ms-2';
        botaoRemover.addEventListener('click', () => {
            listaProdutos.removeChild(item);
            valorTotal -= precoTotalProduto;
            valorTotalElem.textContent = valorTotal.toFixed(2);
            // Ajustar a quantidade disponível do produto
            quantidades[produtoID] += quantidade;
        });

        item.appendChild(botaoRemover);
        listaProdutos.appendChild(item);

        // Atualizar o valor total da compra
        valorTotal += precoTotalProduto;
        valorTotalElem.textContent = valorTotal.toFixed(2);
        // Ajustar a quantidade disponível do produto
        quantidades[produtoID] -= quantidade;
    });
  });

  document.getElementById('concluir-compra').addEventListener('click', () => {
    const items = listaProdutos.querySelectorAll('li');
    if (items.length === 0) {
      alert('Nenhum produto foi selecionado para compra.');
      return;
    }

    let produtosComprados = [];
    items.forEach(item => {
      const itemText = item.textContent.split(' x ');
      const quantidade = parseInt(itemText[0].split(' - ')[1]);
      const produto = itemText[0].split(' - ')[0];
      const preco = parseFloat(itemText[1].split('€')[0]);
      produtosComprados.push({ produto, quantidade, preco });
    });

    fetch('salvar_compra.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ produtos: produtosComprados })
    }).then(response => {
      if (response.ok) {
        window.location.href = 'formulario_compra.php';
      } else {
        alert('Erro ao concluir a compra. Tente novamente.');
      }
    });
  });
});

function alterarQuantidade(elemento, delta) {
  const quantidadeInput = elemento.closest('.quantidade-container').querySelector('.quantidade');
  let quantidade = parseInt(quantidadeInput.value);
  quantidade = isNaN(quantidade) ? 0 : quantidade;
  quantidade += delta;
  if (quantidade < 1) quantidade = 1;
  quantidadeInput.value = quantidade;
}
</script>
</body>
</html>
