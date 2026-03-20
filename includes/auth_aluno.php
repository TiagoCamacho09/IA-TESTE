<?php
// includes/auth_aluno.php
// Verifica se o utilizador está autenticado E se é aluno
// Se não, redireciona apropriadamente

// Primeiro verificar se está autenticado
require __DIR__ . '/auth.php';

// Agora verificar se é aluno
if (($user['role'] ?? '') !== 'aluno') {
    // Não é aluno, redirecionar com base no tipo
    if (($user['role'] ?? '') === 'tutor') {
        safe_redirect('resultados-tutor.php');
    } else {
        safe_redirect('login.php');
    }
}

// Se chegou aqui, é aluno autenticado
?>
