<?php
// logout.php - Termina a sessão do utilizador e redireciona para a página inicial.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Limpar os dados da sessão (sem destruir sessão completamente para evitar problemas)
$_SESSION = [];

// Redirecionar para a página inicial
safe_redirect('index.php');
