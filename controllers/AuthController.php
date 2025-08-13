<?php

namespace controllers;

use PDO;

class AuthController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = $_POST['usuario'] ?? '';
            $senha = $_POST['senha'] ?? '';

            $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['usuario' => $usuario]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if (password_verify($senha, $user['senha'])) {
                    session_start();
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['usuario'] = $user['usuario'];
                    header('Location: index.php?page=alunos&action=listar');
                    exit;
                }
            } else {
                $erro = "Usuário ou senha incorretos";
            }
        } else {
            include('views/login.php');
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit;
    }
}