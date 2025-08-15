<?php

use models\AlunoRepository;
require_once "models/AlunoRepository.php";

class AlunoController {
    private PDO $pdo;
    private AlunoRepository $alunoRepository;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->alunoRepository = new AlunoRepository($pdo);
    }

    public function listar() {
        $alunos = $this->alunoRepository->listarTodos();
        include 'views/listar.php';
    }

    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $idade = $_POST['idade'] ?? '';
            $nota = $_POST['nota'] ?? '';

            if ($this->alunoRepository->inserir($nome, $idade, $nota)) {
                header('Location: index.php?page=alunos&action=listar');
                exit;
            } else {
                $erro = "Erro ao cadastrar aluno";
            }
        }

        include 'views/cadastro.php';
    }

    public function editar($id) {
        $aluno = $this->alunoRepository->buscarPorId($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $idade = $_POST['idade'] ?? '';
            $nota = $_POST['nota'] ?? '';

            if ($this->alunoRepository->atualizar($id, $nome, $idade, $nota)) {
                header('Location: index.php?page=alunos&action=listar');
                exit;
            } else {
                $erro = "Erro ao atualizar aluno";
            }
        }

        include 'views/cadastro.php';
    }

    public function excluir($id) {
        if ($this->alunoRepository->excluir($id)) {
            header('Location: index.php?page=alunos&action=listar');
        } else {
            // Tratar erro
            header('Location: index.php?page=alunos&action=listar');
        }
        exit;
    }
}
