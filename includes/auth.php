<?php
// includes/auth.php
// Verifica se o utilizador está autenticado (tem sessão ativa)
// Se não estiver, redireciona para login.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar se existe utilizador na sessão
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    // Não está autenticado, redirecionar para login
    header('Location: login.php');
    exit;
}

// Se chegou aqui, o utilizador está autenticado
$user = $_SESSION['user'];
?>
