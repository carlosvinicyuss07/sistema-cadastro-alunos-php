<?php

use models\Aluno;
use models\AlunoRepository;
require_once "models/AlunoRepository.php";
require_once "models/Aluno.php";

class AlunoController {
    private PDO $pdo;
    private AlunoRepository $alunoRepository;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->alunoRepository = new AlunoRepository($pdo);
    }

    public function listar(): void {
        $nome = $_GET['nome'] ?? null;
        $idadeMax = isset($_GET['idadeMax']) ? (int)$_GET['idadeMax'] : null;
        $notaMin = isset($_GET['notaMin']) ? (float)$_GET['notaMin'] : null;

        $alunos = $this->alunoRepository->listarComFiltro($nome, $idadeMax, $notaMin);

        include 'views/listar.php';
    }

    public function cadastrar(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $aluno = new Aluno($_POST['nome'], $_POST['idade'], $_POST['nota']);
                $this->alunoRepository->inserir($aluno);
                header("Location: " . BASE_URL . "alunos/listar");
                exit();
            } catch (PDOException $e) {
                echo "Erro ao inserir aluno: " . $e->getMessage();
            }
        }

        include 'views/cadastro.php';
    }

    public function editar($id): void {
        $aluno = $this->alunoRepository->buscarPorId($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $alunoAtualizado = new Aluno($_POST['nome'], $_POST['idade'], $_POST['nota']);
                $alunoAtualizado->setId($aluno->getId());
                if ($this->alunoRepository->atualizar($alunoAtualizado)) {
                    header("Location: " . BASE_URL . "alunos/listar");
                    exit();
                }
            } catch (PDOException $e) {
                echo "Erro ao atualizar aluno: " . $e->getMessage();
            }
        }

        include 'views/cadastro.php';
    }

    public function excluir($id): void {
        try {
            $this->alunoRepository->excluir($id);
            header("Location: " . BASE_URL . "alunos/listar");
            exit();
        } catch (PDOException $e) {
            echo "Erro ao excluir aluno: " . $e->getMessage();
        }
    }
}
