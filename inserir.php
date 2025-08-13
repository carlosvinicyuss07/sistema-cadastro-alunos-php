<?php

require_once "verifica_login.php";
global $pdo;
require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $nota = $_POST['nota'];

    if (empty($nome)) {
        echo "<p>ERRO! O campo nome é obrigatório.</p>";
    } elseif (!(is_numeric($idade) && is_numeric($nota))) {
        echo "<p>ERRO! Valores numéricos inválidos.</p>";
    } elseif (!($nota >= 0 && $nota <= 10)) {
        echo "<p>ERRO! Valor da nota fora do limite permitido.</p>";
    } else {
        $stmt = $pdo->prepare("INSERT INTO alunos (nome, idade, nota) VALUES (:nome, :idade, :nota)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':idade', $idade);
        $stmt->bindParam(':nota', $nota);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            echo "<p>Aluno cadastrado com sucesso.</p>";
            echo "<p><a href='cadastro.php'><- Voltar para o cadastro</a></p>";
            echo "<p><a href='listar.php'>📋 Ver lista de alunos</a></p>";
        }
    }
}
