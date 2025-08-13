<?php

namespace models;

use PDO;

class Aluno {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listarTodos() {
        $sql = "SELECT * FROM alunos ORDER BY nome";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM alunos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserir($nome, $idade, $nota) {
        $sql = "INSERT INTO alunos (nome, idade, nota) VALUES (:nome, :idade, :nota)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nome' => $nome,
            ':idade' => $idade,
            ':nota' => $nota
        ]);
    }

    public function atualizar($id, $nome, $idade, $nota) {
        $sql = "UPDATE alunos SET nome = :nome, idade = :idade, nota = :nota";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':nome' => $nome,
            ':idade' => $idade,
            ':nota' => $nota
        ]);
    }

    public function excluir($id) {
        $sql = "DELETE FROM alunos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }
}