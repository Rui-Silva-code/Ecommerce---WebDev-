<?php
// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir o arquivo de conexão com o banco de dados
    include 'basedados.php';

    // Obter os dados do formulário
    $nome_produto = $_POST['nome'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];

    // Preparar a consulta SQL para inserir o novo produto
    $sql = "INSERT INTO produtos (nome, quantidade, preco) VALUES (?, ?, ?)";
    
    // Preparar a declaração SQL
    $stmt = $conn->prepare($sql);

    // Verificar se a preparação da declaração foi bem-sucedida
    if ($stmt) {
        // Vincular os parâmetros e executar a declaração
        $stmt->bind_param("sid", $nome_produto, $quantidade, $preco);
        if ($stmt->execute()) {
            // Produto inserido com sucesso
            echo "<script>alert('Produto inserido com sucesso'); window.history.back();</script>";
        } else {
            // Erro ao inserir o produto
            echo "<script>alert('Erro ao inserir o produto'); window.history.back();</script>" . $stmt->error;
        }
        // Fechar a declaração
        $stmt->close();
    } else {
        // Erro ao preparar a declaração SQL
        echo "Erro ao preparar a declaração: " . $conn->error;
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
}
?>
