<?php

require_once ("config/conexao.php");

if (empty($alunos)) {
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

<div>
    <h1>Lista de Alunos</h1>
    <p>Bem-vindo, <?= $_SESSION['usuario'] ?> !</p>
</div>

<section>
    <form method="GET" action="<?= BASE_URL ?>alunos/listar">
        <input type="text" name="nome" value="<?= $_GET['nome'] ?? null?>" placeholder="Buscar por nome">
        <input type="number" name="idadeMin" value="<?= $_GET['idadeMin'] ?? null?>" placeholder="Idade mínima">
        <input type="number" name="idadeMax" value="<?= $_GET['idadeMax'] ?? null?>" placeholder="Idade máxima">
        <input type="number" step="0.01" name="notaMin" value="<?= $_GET['notaMin'] ?? null?>" placeholder="Nota mínima">
        <input type="number" step="0.01" name="notaMax" value="<?= $_GET['notaMax'] ?? null?>" placeholder="Nota máxima">
        <button type="submit">Filtrar</button>
    </form>
</section>

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
                <a href="editar/<?= $aluno['id'] ?>">Editar</a>
                <a href="excluir/<?= $aluno['id'] ?>"
                   onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div>
    <?php if (isset($paginaAtual)) {
        if ($paginaAtual > 1): ?>
            <a href="?pagina=<?= $paginaAtual - 1 ?>&<?= $queryFiltros ?? '' ?>">⬅ Anterior</a>
        <?php endif;
    } ?>

    <?php if (isset($totalPaginas)) {
        for ($i = 1; $i <= $totalPaginas; $i++): ?>
            <?php if ($i == $paginaAtual): ?>
                <strong>[<?= $i ?>]</strong>
            <?php else: ?>
                <a href="?pagina=<?= $i ?>&<?= $queryFiltros ?? '' ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor;
    } ?>

    <?php if ($paginaAtual < $totalPaginas): ?>
        <a href="?pagina=<?= $paginaAtual + 1 ?>&<?= $queryFiltros ?? '' ?>">Próxima ➡</a>
    <?php endif; ?>
</div>

<p><a href="<?=BASE_URL?>alunos/cadastrar">Cadastrar novo aluno</a></p>
<p><a href="<?=BASE_URL?>auth/logout">Sair</a></p>
</body>
</html>
