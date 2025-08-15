<?php

require_once "auth/verifica_login.php";
require_once "config/conexao.php";
global $pdo;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $nota = $_POST['nota'];

    $stmt = $pdo->prepare("UPDATE alunos SET nome = :nome, idade = :idade, nota = :nota WHERE id = :id");
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':idade', $idade, PDO::PARAM_INT);
    $stmt->bindValue(':nota', $nota);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: listar.php');
    exit;
}

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID do aluno não fornecido.";
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM alunos WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$aluno = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$aluno) {
    echo "Aluno não encontrado.";
    exit;
}

$nome = $aluno['nome'];
$idade = $aluno['idade'];
$nota = $aluno['nota'];
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Aluno</title>
</head>
<body>
    <h1>Editar Aluno</h1>

    <form method="POST" action="">
        <input type="hidden" name="id" value="<?= $id ?>">

        <label>Nome:</label>
        <input type="text" name="nome" value="<?= $nome ?>" required><br><br>

        <label>Idade:</label>
        <input type="number" name="idade" value="<?= $idade ?>" required><br><br>

        <label>Nota:</label>
        <input type="text" name="nota" value="<?= $nota ?>" required><br><br>

        <button type="submit">Atualizar</button>
    </form>

    <br>
    <a href="listar.php"><- Voltar para Listagem</a>
</body>
</html>