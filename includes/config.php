<?php
// config.php - ficheiro de configuração da ligação à base de dados MySQL
// Este ficheiro define os parâmetros de ligação ao XAMPP MySQL e cria a conexão.

// ===== VARIÁVEIS DE LIGAÇÃO À BASE DE DADOS =====
$host = 'localhost';      // servidor MySQL (localhost para XAMPP local)
$user = 'root';           // utilizador MySQL (por defeito é 'root' no XAMPP)
$password = '';           // palavra-passe (vazia por defeito no XAMPP)
$database = 'ia_teste';   // nome da base de dados que queremos usar

// ===== CRIAR LIGAÇÃO COM MYSQLI =====
// mysqli() cria uma nova ligação. Usamos try/catch para capturar erros.
$conn = new mysqli($host, $user, $password, $database);

// ===== VERIFICAR SE A LIGAÇÃO FOI BEM-SUCEDIDA =====
// Se houver erro na ligação, a propriedade 'connect_error' conterá a mensagem de erro.
if ($conn->connect_error) {
    // Mostrar mensagem de erro simples
    die("Erro na ligação à base de dados: " . htmlspecialchars($conn->connect_error, ENT_QUOTES, 'UTF-8'));
}

// ===== DEFINIR CHARSET =====
// UTF-8 é o charset padrão para trabalhar com acentos e caracteres especiais em português
$conn->set_charset('utf8mb4');

// ===== CRIAR TABELAS OBRIGATÓRIAS =====
// Estes comandos são executados apenas se as tabelas ainda não existirem.
$conn->query(
    "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role ENUM('aluno','tutor') NOT NULL DEFAULT 'aluno',
        pontos INT NOT NULL DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
);

// Se o utilizador já existia antes de termos a coluna 'pontos', adiciona-a agora.
// Verificamos primeiro se a coluna existe para manter compatibilidade com MySQL mais antigos.
$checkColumn = $conn->prepare(
    "SELECT COUNT(*) AS coluna_existe
     FROM information_schema.columns
     WHERE table_schema = ?
       AND table_name = 'users'
       AND column_name = 'pontos'"
);
$checkColumn->bind_param('s', $database);
$checkColumn->execute();
$colResult = $checkColumn->get_result();
$colRow = $colResult ? $colResult->fetch_assoc() : null;

if (!$colRow || (int) $colRow['coluna_existe'] === 0) {
    $conn->query("ALTER TABLE users ADD COLUMN pontos INT NOT NULL DEFAULT 0");
}

$conn->query(
    "CREATE TABLE IF NOT EXISTS quiz_answers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        question_key VARCHAR(50) NOT NULL,
        student_answer TEXT NOT NULL,
        status ENUM('pendente','certo','errado') NOT NULL DEFAULT 'pendente',
        comment TEXT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        UNIQUE KEY (user_id, question_key),
        INDEX (user_id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
);

// ===== VARIÁVEL GLOBAL =====
// Agora $conn está pronto para usar em qualquer página que faça include deste ficheiro.
?>
