<?php
// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir o arquivo de conexão com o banco de dados
    include 'basedados.php';

    // Obter o ID do produto a ser excluído
    $produtoID = $_POST['produtoID'];

    // Preparar a consulta SQL para excluir o produto
    $sql = "DELETE FROM produtos WHERE produtoID = ?";
    
    // Preparar a declaração SQL
    $stmt = $conn->prepare($sql);

    // Verificar se a preparação da declaração foi bem-sucedida
    if ($stmt) {
        // Vincular o parâmetro e executar a declaração
        $stmt->bind_param("i", $produtoID);
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                // Produto excluído com sucesso
                echo "<script>alert('Produto excluído com sucesso'); window.history.back();</script>";
            } else {
                // Nenhuma linha afetada, produto não encontrado
                echo "<script>alert('Produto não encontrado'); window.history.back();</script>";
            }
        } else {
            // Erro ao executar a declaração
            echo "<script>alert('Erro ao excluir o produto'); window.history.back();</script>";
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
