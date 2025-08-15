<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Alunos</title>
</head>
<body>
<h1>Formulário de Login</h1>

<?php if (isset($erro)): ?>
    <p style="color: red;"><?= $erro ?></p>
<?php endif; ?>

<form method="POST" action="index.php?page=auth&action=login">
    <label>Usuário:</label>
    <input type="text" name="usuario" required><br><br>

    <label>Senha:</label>
    <input type="password" name="senha" required><br><br>

    <button type="submit">Entrar</button>
</form>
</body>
</html>