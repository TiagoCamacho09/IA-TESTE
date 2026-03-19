<?php
// dashboard.php - área do aluno após o login.
// Apenas alunos autenticados podem ver esta página.

$pageTitle = 'Dashboard - Aluno';

// Verificar se é aluno autenticado (redireciona se não for)
require __DIR__ . '/includes/auth_aluno.php';

require __DIR__ . '/includes/header.php';
?>

<section class="card">
  <h1>Olá, <?= htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8') ?>!</h1>
  <p>Seleciona uma opção abaixo para continuar.</p>

  <div class="grid grid-3">
    <div class="card card-compact">
      <h2>Fazer teste</h2>
      <p>Responde às perguntas sobre Git e vê a tua performance.</p>
      <a class="button" href="teste.php">Ir para o teste</a>
    </div>

    <div class="card card-compact">
      <h2>Ver resultado</h2>
      <p>Ver o resumo das tuas respostas mais recentes.</p>
      <a class="button" href="resultado.php">Ver resultado</a>
    </div>

    <div class="card card-compact">
      <h2>Sair da sessão</h2>
      <p>Termina a tua sessão atual no sistema.</p>
      <a class="button secondary" href="logout.php">Sair</a>
    </div>
  </div>

  <div class="note">
    <p>Os teus dados estão guardados apenas na sessão do navegador.</p>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php';
