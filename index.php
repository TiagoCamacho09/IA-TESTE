<?php
// index.php - Página inicial do sistema simulado de perguntas e respostas.

$pageTitle = 'IA Teste - Início';
require __DIR__ . '/includes/header.php';
?>

<section class="hero">
  <div class="hero-content">
    <h1>Aprende com um mini sistema de perguntas</h1>
    <p>Simula um fluxo de login, registo, testes e análise de respostas — tudo localmente no XAMPP, com suporte a base de dados MySQL.</p>

    <div class="hero-actions">
      <a class="button" href="login.php">Iniciar sessão</a>
      <a class="button secondary" href="registo.php">Criar conta</a>
      <a class="button" href="teste.php">Fazer teste</a>
    </div>
  </div>
</section>

<section class="card">
  <h2>Como funciona</h2>
  <ol>
    <li>Crias conta ou inicias sessão.</li>
    <li>Fazes um teste com perguntas simples.</li>
    <li>Vês o resultado e, se fores tutor, podes avaliar respostas.</li>
  </ol>
</section>

<?php require __DIR__ . '/includes/footer.php';
