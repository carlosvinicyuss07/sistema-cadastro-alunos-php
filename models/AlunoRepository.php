<?php

namespace models;

require_once __DIR__ . '/Aluno.php';

use PDO;
use PDOException;

class AlunoRepository {
    private PDO $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listarTodos(): array {
        $stmt = $this->pdo->query("SELECT * FROM alunos ORDER BY nome");
        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($dados)) {
            return [];
        }
        return $dados;
    }

    public function buscarPorId($id): ?Aluno {
        $stmt = $this->pdo->prepare("SELECT * FROM alunos WHERE id = ?");
        $stmt->execute([$id]);
        $dado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dado) {
            return new Aluno($dado['nome'], $dado['idade'], $dado['nota'], $dado['id']);
        }
        return null;
    }

    public function inserir(Aluno $aluno): bool {
        try {
            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare("INSERT INTO alunos (nome, idade, nota) VALUES (?, ?, ?)");
            $stmt->execute([
                $aluno->getNome(),
                $aluno->getIdade(),
                $aluno->getNota()
            ]);

            $this->pdo->commit();
            return true;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function atualizar(Aluno $aluno): bool {
        try {
            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare("UPDATE alunos SET nome=?, idade=?, nota=? WHERE id=?");
            $stmt->execute([
                $aluno->getNome(),
                $aluno->getIdade(),
                $aluno->getNota(),
                $aluno->getId()
            ]);

            $this->pdo->commit();
            return true;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function excluir($id): bool
    {
        try {
            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare("DELETE FROM alunos WHERE id = ?");
            $stmt->execute([$id]);

            $this->pdo->commit();
            return true;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function listarPaginado(int $limite, int $offset, array $filtros = []): array {
        $sql = "SELECT * FROM alunos WHERE 1=1";
        $params = [];

        if (!empty($filtros['nome'])) {
            $sql .= " AND nome LIKE ?";
            $params[] = "%" . $filtros['nome'] . "%";
        }
        if (!empty($filtros['idadeMin'])) {
            $sql .= " AND idade >= ?";
            $params[] = (int)$filtros['idadeMin'];
        }
        if (!empty($filtros['idadeMax'])) {
            $sql .= " AND idade <= ?";
            $params[] = (int)$filtros['idadeMax'];
        }
        if (!empty($filtros['notaMin'])) {
            $sql .= " AND nota >= ?";
            $params[] = (float)$filtros['notaMin'];
        }
        if (!empty($filtros['notaMax'])) {
            $sql .= " AND nota <= ?";
            $params[] = (float)$filtros['notaMax'];
        }

        $sql .= " ORDER BY nome ASC LIMIT $limite OFFSET $offset";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function contarAlunos(array $filtros = []): int {
        $sql = "SELECT COUNT(*) as total FROM alunos WHERE 1=1";
        $params = [];

        if (!empty($filtros['nome'])) {
            $sql .= " AND nome LIKE ?";
            $params[] = "%" . $filtros['nome'] . "%";
        }
        if (!empty($filtros['idadeMin'])) {
            $sql .= " AND idade >= ?";
            $params[] = (int)$filtros['idadeMin'];
        }
        if (!empty($filtros['idadeMax'])) {
            $sql .= " AND idade <= ?";
            $params[] = (int)$filtros['idadeMax'];
        }
        if (!empty($filtros['notaMin'])) {
            $sql .= " AND nota >= ?";
            $params[] = (float)$filtros['notaMin'];
        }
        if (!empty($filtros['notaMax'])) {
            $sql .= " AND nota <= ?";
            $params[] = (float)$filtros['notaMax'];
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return (int) $stmt->fetchColumn();
    }
}