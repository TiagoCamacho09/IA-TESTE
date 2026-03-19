<?php
// includes/header.php
// Cabeçalho comum, inicializa sessão e define o menu principal.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar se o utilizador está "logado" (simulação sem base de dados)
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
$current = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') : 'IA Teste' ?></title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="site-header">
    <div class="brand">
      <a href="index.php">IA<span class="brand-highlight">TESTE</span></a>
    </div>

    <nav class="nav">
      <a href="index.php" class="<?= $current === 'index.php' ? 'active' : '' ?>">Início</a>
      <a href="teste.php" class="<?= $current === 'teste.php' ? 'active' : '' ?>">Teste</a>
      <?php if ($user): ?>
        <a href="dashboard.php" class="<?= $current === 'dashboard.php' ? 'active' : '' ?>">Dashboard</a>
        <?php if (($user['role'] ?? '') === 'tutor'): ?>
          <a href="tutor.php" class="<?= $current === 'tutor.php' ? 'active' : '' ?>">Tutor</a>
        <?php endif; ?>
      <?php endif; ?>
    </nav>

    <div class="header-actions">
      <?php if ($user): ?>
        <span class="user-badge" title="<?= htmlspecialchars($user['role'], ENT_QUOTES, 'UTF-8') ?>">
          <?= htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8') ?>
        </span>
        <a class="button small" href="logout.php">Sair</a>
      <?php else: ?>
        <a class="button small" href="login.php">Iniciar sessão</a>
        <a class="button small secondary" href="registo.php">Criar conta</a>
      <?php endif; ?>
    </div>
  </header>

  <main class="container">
