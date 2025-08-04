<?php
require_once 'conexao.php';
global $pdo;

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM alunos WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

header('Location: listar.php');
exit;