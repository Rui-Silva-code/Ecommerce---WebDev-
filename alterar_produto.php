<?php
// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir o arquivo de conexão com o banco de dados
    include 'basedados.php';

    // Obter os dados do formulário
    $produtoID = $_POST['produtoID'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];

    // Preparar a consulta SQL para atualizar o produto
    $sql = "UPDATE produtos SET preco = ?, quantidade = ? WHERE produtoID = ?";
    
    // Preparar a declaração SQL
    $stmt = $conn->prepare($sql);

    // Verificar se a preparação da declaração foi bem-sucedida
    if ($stmt) {
        // Vincular os parâmetros e executar a declaração
        $stmt->bind_param("dii", $preco, $quantidade, $produtoID);
        if ($stmt->execute()) {
            // Verificar se algum registro foi afetado
            if ($stmt->affected_rows > 0) {
                // Produto atualizado com sucesso
                echo "<script>alert('Produto atualizado com sucesso'); window.history.back();</script>";
            } else {
                // Produto não encontrado, exibir mensagem de erro
                echo "<script>alert('Erro: Produto não encontrado'); window.history.back();</script>";
            }
        } else {
            // Erro ao executar a declaração
            echo "Erro ao atualizar o produto: " . $stmt->error;
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
