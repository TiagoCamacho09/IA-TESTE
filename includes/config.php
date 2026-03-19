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

// ===== VARIÁVEL GLOBAL =====
// Agora $conn está pronto para usar em qualquer página que faça include deste ficheiro.
?>
