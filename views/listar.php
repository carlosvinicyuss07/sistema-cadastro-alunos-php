<?php

require_once ("config/conexao.php");

if (!isset($alunos)) {
    $alunos = [];
    echo "Não há alunos cadastrados!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alunos</title>
</head>
<body>
<h1>Alunos Cadastrados</h1>

<table border="1">
    <thead>
    <tr>
        <th>Nome</th>
        <th>Idade</th>
        <th>Nota</th>
        <th>Ações</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($alunos as $aluno): ?>
        <tr>
            <td><?= htmlspecialchars($aluno['nome']) ?></td>
            <td><?= htmlspecialchars($aluno['idade']) ?></td>
            <td><?= htmlspecialchars($aluno['nota']) ?></td>
            <td>
                <a href="index.php?page=alunos&action=editar&id=<?= $aluno['id'] ?>">Editar</a>
                <a href="index.php?page=alunos&action=excluir&id=<?= $aluno['id'] ?>"
                   onclick="return confirm('Tem certeza?')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<p><a href="index.php?page=alunos&action=cadastrar">Cadastrar novo aluno</a></p>
<p><a href="index.php?page=auth&action=logout">Sair</a></p>
</body>
</html>