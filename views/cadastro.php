<?php
    require_once "verifica_login.php";
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de Alunos</title>
</head>
<body>
    <section>
        <h1>Formulário de Cadastro</h1>
            <form method="POST" action="inserir.php">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required><br><br>

                <label for="idade">Idade:</label>
                <input type="number" id="idade" name="idade" required><br><br>

                <label for="nota">Nota:</label>
                <input type="number" id="nota" name="nota" step="0.1" min="0.0" max="10.0" required><br><br>

                <button type="submit">Cadastrar</button>
            </form>
            <p><a href='listar.php'>📋 Ver lista de alunos</a></p>
            <p><a href='logout.php'>🚪 Encerrar sessão</a></p>
    </section>
</body>
</html>
