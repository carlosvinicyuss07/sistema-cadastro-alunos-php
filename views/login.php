<?php
session_start();

global $pdo;
require_once("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1");
    $stmt->bindParam(":usuario", $usuario);
    $stmt->execute();
    $usuarioEncontrado = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($usuarioEncontrado) {
        if (password_verify($senha, $usuarioEncontrado['senha'])) {
            $_SESSION['usuario'] = $usuarioEncontrado['usuario'];
            header('Location: cadastro.php');
            exit;
        }
    }
    echo "<p>Usuário ou senha incorretos.</p>";
}
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Usuário</title>
</head>
<body>
    <section>
        <h1>Formulário de Login</h1>
            <form action="login.php" method="POST">
                <label for="usuario">Usuário</label>
                <input type="text" id="usuario" name="usuario" required><br><br>

                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required><br><br>

                <button type="submit">Entrar</button>
            </form>
    </section>
</body>
</html>