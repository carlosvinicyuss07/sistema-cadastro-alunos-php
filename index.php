<?php
global $pdo;
session_start();

require_once 'config/conexao.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/AlunoController.php';

$page = $_GET['page'] ?? 'login';
$action = $_GET['action'] ?? 'index';

switch ($page) {
    case 'auth':
        $controller = new AuthController($pdo);
        if ($action === 'login') {
            $controller->login();
        } elseif ($action === 'logout') {
            $controller->logout();
        }
        break;

    case 'alunos':
        // Verificar se está logado
        require_once ("auth/verifica_login.php");

        if ($action === 'listar') {
            echo "<h1>Lista de Alunos</h1>";
            echo "<p>Bem-vindo, " . $_SESSION['usuario'] . "!</p>";
            $alunoController = new AlunoController($pdo);
            $alunoController->listar();
            break;
        } elseif ($action === 'cadastrar') {
            $controller = new AlunoController($pdo);
            $controller->cadastrar();
            break;
        } elseif ($action === 'editar') {
            $controller = new AlunoController($pdo);
            $controller->editar(intval($_GET['id']));
            break;
        } elseif ($action === 'excluir') {
            $controller = new AlunoController($pdo);
            $controller->excluir(intval($_GET['id']));
            break;
        }

    default:
        // Página de login
        if (isset($_SESSION['user_id'])) {
            header('Location: index.php?page=alunos&action=listar');
        } else {
            include 'views/login.php';
        }
        break;
}
