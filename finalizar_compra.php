<?php
session_start();
include 'basedados.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $data_nascimento = $_POST['data_nascimento'];
    $morada = trim($_POST['morada']);
    
    if (!$nome || !$data_nascimento || !$morada) {
        echo "Todos os campos devem ser preenchidos.";
        exit;
    }

    $data_nascimentoDate = new DateTime($data_nascimento);
    $today = new DateTime();
    $age = $today->diff($data_nascimentoDate)->y;

    if ($age < 18) {
        echo "<script>alert('A idade deve ser igual ou superior a 18 anos.'); window.history.back();</script>";
        exit;
    }

    // Obter os produtos comprados da sessão
    $produtosComprados = isset($_SESSION['produtos_comprados']) ? $_SESSION['produtos_comprados'] : [];

    // Calcular o preço total
    $preco_total = 0;
    foreach ($produtosComprados as $produto) {
        $preco_total += $produto['preco'];
    }

    // Montar a consulta SQL
    $sql = "INSERT INTO encomendas (nome, data_nascimento, morada, produto, quantidade, preco_total) VALUES ";
    
    // Loop pelos produtos comprados para adicionar à consulta SQL
    foreach ($produtosComprados as $produto) {
        // Obter os valores de produto e quantidade
        $produto_nome = $produto['produto'];
        $quantidade = $produto['quantidade'];
        $sql .= "('$nome', '$data_nascimento', '$morada', '$produto_nome', '$quantidade', '$preco_total'), ";
    }
    $sql = rtrim($sql, ", ");
    
    // Executar a consulta SQL
    if ($conn->query($sql) === TRUE) {
        // Limpa a sessão
        unset($_SESSION['produtos_comprados']);
        // Exibe um alerta na página
        echo "<script>alert('Compra concluída com sucesso. Obrigado, $nome!'); window.location.href = 'paginaprincipal.php';</script>";
    } else {
        echo "Erro ao salvar a compra no banco de dados: " . $conn->error;
    }

} else {
    echo "Método de solicitação inválido.";
}
?>
