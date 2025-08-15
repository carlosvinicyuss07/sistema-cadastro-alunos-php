<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($aluno) ? 'Editar' : 'Cadastrar' ?> Aluno</title>
</head>
<body>
<h1><?= isset($aluno) ? 'Editar' : 'Cadastrar' ?> Aluno</h1>

<?php if (isset($erro)): ?>
    <p style="color: red;"><?= $erro ?></p>
<?php endif; ?>

<form method="POST">
    <label>Nome:</label>
    <input type="text" name="nome" value="<?= $aluno['nome'] ?? '' ?>" required><br><br>

    <label>Idade:</label>
    <input type="number" name="idade" value="<?= $aluno['idade'] ?? '' ?>" required><br><br>

    <label>Nota:</label>
    <input type="number" step="0.1" name="nota" value="<?= $aluno['nota'] ?? '' ?>" required><br><br>

    <button type="submit"><?= isset($aluno) ? 'Atualizar' : 'Cadastrar' ?></button>
</form>

<p><a href="index.php?page=alunos&action=listar">Ver lista de alunos</a></p>
<p><a href="index.php?page=auth&action=logout">Sair</a></p>
</body>
</html>