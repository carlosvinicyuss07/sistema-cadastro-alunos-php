<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Alunos</title>
</head>
<body>
    <h1>Alunos Cadastrados</h1>
    <?php
        require_once "conexao.php";
        global $pdo;

        // realiza a consulta sql
        $sql = $pdo->query("SELECT * FROM alunos ORDER BY nome ASC");
        // armazena todos os dados obtidos na query em um array associativo
        $alunos = $sql->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <?php if (count($alunos) > 0): ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Idade</th>
                <th>Nota</th>
            </tr>

            <?php foreach ($alunos as $aluno): ?>
                <tr>
                    <td><?= htmlspecialchars($aluno['id']) ?></td>
                    <td><?= htmlspecialchars($aluno['nome']) ?></td>
                    <td><?= htmlspecialchars($aluno['idade']) ?></td>
                    <td><?= htmlspecialchars($aluno['nota']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Nenhum aluno cadastrado.</p>
    <?php endif; ?>

    <p><a href="index.php"><- Voltar para cadastro</a></p>
</body>
</html>
