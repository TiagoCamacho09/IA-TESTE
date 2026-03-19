<?php
// resultado.php - mostra o resultado do quiz de Git para alunos.
// Apenas alunos autenticados podem ver esta página.

$pageTitle = 'Resultado do Quiz de Git';

// Verificar se é aluno autenticado (redireciona se não for)
require __DIR__ . '/includes/auth_aluno.php';

$answers = $_SESSION['last_quiz'] ?? null;

// Definição das respostas corretas
$correct = [
    'commit' => 'Um snapshot de alterações no repositório',
    'push' => 'Enviar alterações locais para o repositório remoto',
    'pull' => 'Trazer alterações do repositório remoto para a tua cópia local',
    'branch' => 'Uma linha independente de desenvolvimento dentro do mesmo repositório',
    'github' => 'Hospedar repositórios Git online e colaborar',
];

require __DIR__ . '/includes/header.php';
?>

<section class="card">
  <h1>Resultado do Quiz</h1>

  <?php if (!$answers): ?>
    <p>Não há resultados guardados. Faz o quiz primeiro.</p>
    <div class="actions">
      <a class="button" href="teste.php">Fazer quiz</a>
      <a class="button secondary" href="dashboard.php">Voltar ao dashboard</a>
    </div>
  <?php else: ?>
    <?php
      $total = count($correct);
      $score = 0;
      $feedback = [];

      foreach ($correct as $key => $expected) {
          $given = $answers[$key] ?? '';
          $isCorrect = ($given === $expected);

          if ($isCorrect) {
              $score++;
          }

          $feedback[$key] = [
              'given' => $given,
              'expected' => $expected,
              'correct' => $isCorrect,
          ];
      }

      // Texto de revisão automática estilo IA
      $review = "Acertaste {$score} em {$total}.";
      if ($score === $total) {
          $review .= ' Excelente! Já tens uma boa compreensão dos conceitos básicos de Git.';
      } elseif ($score >= 3) {
          $review .= ' Estás quase lá — revê os conceitos onde falhaste para consolidar o teu conhecimento.';
      } else {
          $review .= ' Recomendo rever os conceitos principais de Git e experimentar comandos básicos na prática.';
      }
    ?>

    <div class="result">
      <p><?= htmlspecialchars($review, ENT_QUOTES, 'UTF-8') ?></p>
    </div>

    <div class="quiz-feedback">
      <?php foreach ($feedback as $key => $info): ?>
        <div class="quiz-item <?= $info['correct'] ? 'correct' : 'incorrect' ?>">
          <p><strong><?= ucfirst($key) ?>:</strong> <?= $info['correct'] ? 'Correto' : 'Errado' ?></p>
          <p><strong>A tua resposta:</strong> <?= htmlspecialchars($info['given'], ENT_QUOTES, 'UTF-8') ?></p>
          <?php if (!$info['correct']): ?>
            <p><strong>Resposta certa:</strong> <?= htmlspecialchars($info['expected'], ENT_QUOTES, 'UTF-8') ?></p>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="actions">
      <a class="button" href="teste.php">Refazer quiz</a>
      <a class="button secondary" href="dashboard.php">Voltar ao dashboard</a>
    </div>
  <?php endif; ?>
</section>

<?php require __DIR__ . '/includes/footer.php';
