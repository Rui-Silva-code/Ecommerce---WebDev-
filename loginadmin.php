<?php
session_start();
include 'basedados.php';

$error_message = '';

// Verifique se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['nome'];
    $password = $_POST['password'];

    // Preparar a consulta para autenticação
    $stmt = $conn->prepare("SELECT * FROM utilizadores WHERE nome = ? AND password = ?");
    if ($stmt) {
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc(); // Obter a linha correspondente da consulta
            if ($row['user_type'] === 'utilizador') {
                $error_message = "Não tem permissões!";
            } elseif ($row['user_type'] === 'administrador') {
                $_SESSION['logged_in'] = true;
                $_SESSION['user_type'] = 'administrador'; // Armazena o tipo de usuário na sessão
                header("Location: paginaadmin.php"); // Redireciona para a página de administração
                exit;
            }
        } else {
            $error_message = "Nome de utilizador ou palavra-passe incorretos.";
        }
        $stmt->close();
    } else {
        $error_message = "Erro ao preparar a declaração: " . $conn->error;
    }
}
?>



<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração - Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        html, body {
            height: 100%;
            font-family: Arial, sans-serif;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; 
            background-color: #f0f0f0; 
        }
        .login {
            padding: 50px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            padding: 20px 0px;
        }
        button {
            width: 80px;
            height: 40px;
         
        }
        input#password {
            margin: 0px 31px;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <div class="login">
            <h1>Login de Administração</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="nome">Nome de Utilizador:</label>
                <input type="text" id="nome" name="nome" required><br><br>
                <label for="password">Palavra-passe:</label>
                <input type="password" id="password" name="password" required><br><br>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
    <?php
    if (!empty($error_message)) {
        echo "<script>alert('$error_message');</script>";
    }
    ?>
</body>
</html>
