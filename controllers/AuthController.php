<?php
class AuthController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = $_POST['usuario'] ?? '';
            $senha = $_POST['senha'] ?? '';

            if (empty($usuario) || empty($senha)) {
                $erro = "Preencha todos os campos";
                include 'views/login.php';
                return;
            }

            try {
                // Buscar usuário pelo nome
                $sql = "SELECT id, usuario, senha FROM usuarios WHERE usuario = ?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$usuario]);

                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    // Verificar senha criptografada
                    if (password_verify($senha, $user['senha'])) {
                        // Login bem-sucedido
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['usuario'] = $user['usuario'];

                        // Redirecionar para lista de alunos
                        header('Location: index.php?page=alunos&action=listar');
                        exit;
                    } else {
                        $erro = "Usuário ou senha incorretos";
                        include 'views/login.php';
                    }
                } else {
                    $erro = "Usuário ou senha incorretos";
                    include 'views/login.php';
                }

            } catch (PDOException $e) {
                $erro = "Erro no sistema: " . $e->getMessage();
                include 'views/login.php';
            }
        } else {
            include 'views/login.php';
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit;
    }

    public function cadastrarUsuario($usuario, $senha) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (usuario, senha) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$usuario, $senhaHash]);
    }

    public function migrarSenhas() {
        try {
            // Buscar todos os usuários com senhas em texto
            $sql = "SELECT id, usuario, senha FROM usuarios";
            $stmt = $this->pdo->query($sql);
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($usuarios as $user) {
                // Verificar se a senha já está criptografada
                if (!password_get_info($user['senha'])['algo']) {
                    // Senha não está criptografada, criptografar
                    $senhaHash = password_hash($user['senha'], PASSWORD_DEFAULT);

                    // Atualizar no banco
                    $updateSql = "UPDATE usuarios SET senha = ? WHERE id = ?";
                    $updateStmt = $this->pdo->prepare($updateSql);
                    $updateStmt->execute([$senhaHash, $user['id']]);

                    echo "Senha do usuário {$user['usuario']} migrada com sucesso!<br>";
                }
            }

            echo "Migração concluída!";

        } catch (PDOException $e) {
            echo "Erro na migração: " . $e->getMessage();
        }
    }
}