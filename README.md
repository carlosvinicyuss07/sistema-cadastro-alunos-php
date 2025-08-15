# 📚 Sistema de Cadastro de Alunos (PHP + MySQL)

Um sistema simples de **cadastro e gerenciamento de alunos**, desenvolvido em **PHP puro** com **arquitetura MVC** e **camada de autenticação**.  
Permite **CRUD** completo (Create, Read, Update, Delete) para alunos, com autenticação de usuários para acesso às funcionalidades.

---

## 🚀 Funcionalidades

- 🔐 **Login e Logout** com autenticação de usuários.
- 📋 **Listagem de alunos** cadastrados.
- ➕ **Cadastro de novos alunos**.
- ✏ **Edição de informações** de alunos existentes.
- ❌ **Exclusão de alunos**.
- ✅ Proteção de páginas: apenas usuários logados podem acessar a área de gerenciamento.

---

## 🖥 Tecnologias Utilizadas

- **PHP 8.4** — Linguagem principal.
- **MySQL** — Banco de dados relacional.
- **HTML5** — Estrutura das páginas.
- **CSS3** — Estilização básica.
- **Arquitetura MVC** — Separação de responsabilidades em Models, Views e Controllers.
- **PDO** — Acesso seguro ao banco de dados.

---

## 📂 Estrutura de Pastas

```bash
sistema-cadastro-alunos/
│
├── index.php                  # Front Controller
│
├── config/
│   └── conexao.php             # Configuração de conexão com o banco de dados
│
├── controllers/
│   ├── AuthController.php      # Controle de autenticação
│   └── AlunoController.php     # Controle de alunos
│
├── models/
│   └── AlunoRepository.php     # Repositório de alunos
│
├── views/
│   ├── login.php               # Tela de login
│   ├── listar.php              # Lista de alunos
│   └── cadastro.php            # Formulário de cadastro/edição
│
├── auth/
    ├── verifica_login.php      # Middleware de proteção
    └── gera_hash.php           # Utilitário para gerar senhas com hash
```

## 👨‍💻 Autor

Carlos Vinícyus Silva Nascimento <br>
📌 Desenvolvedor em aprendizado, migrando de Java para PHP. <br>
📧 Contato: [LinkedIn](www.linkedin.com/in/carlosvinicyuss) | [GitHub](https://github.com/carlosvinicyuss07)
