<?php
// includes/auth_tutor.php
// Verifica se o utilizador está autenticado E se é tutor
// Se não, redireciona apropriadamente

// Primeiro verificar se está autenticado
require __DIR__ . '/auth.php';

// Agora verificar se é tutor
if (($user['role'] ?? '') !== 'tutor') {
    // Não é tutor, redirecionar com base no tipo
    if (($user['role'] ?? '') === 'aluno') {
        header('Location: dashboard.php');
    } else {
        header('Location: login.php');
    }
    exit;
}

// Se chegou aqui, é tutor autenticado
?>
