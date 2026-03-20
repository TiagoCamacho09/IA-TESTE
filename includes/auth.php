<?php
// includes/auth.php
// Verifica se o utilizador está autenticado (tem sessão ativa)
// Se não estiver, redireciona para login.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Importa helper de redirecionamento e configuração de base de dados
require_once __DIR__ . '/redirect.php';
require_once __DIR__ . '/config.php';

// Verificar se existe utilizador na sessão
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    // Não está autenticado, redirecionar para login
    safe_redirect('login.php');
}

// Verifica se o utilizador ainda existe na base de dados
$userId = $_SESSION['user']['id'] ?? null;
if ($userId !== null) {
    $stmt = $conn->prepare('SELECT id, name, email, role, pontos FROM users WHERE id = ? LIMIT 1');
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $dbUser = $result->fetch_assoc();

    if ($dbUser) {
        // Atualiza dados em sessão para manter a informação sincronizada
        $_SESSION['user'] = $dbUser;
        $user = $dbUser;
    } else {
        // Utilizador não encontrado: limpar sessão e redirecionar
        $_SESSION = [];
        safe_redirect('login.php');
    }
} else {
    // Sem ID de utilizador, forçar login novamente
    $_SESSION = [];
    safe_redirect('login.php');
}
?>
