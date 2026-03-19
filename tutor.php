<?php
// tutor.php - área exclusiva do tutor para avaliar respostas de alunos.
// Apenas tutores autenticados podem aceder.

$pageTitle = 'Área do Tutor';

// Verificar se é tutor autenticado (redireciona se não for)
require __DIR__ . '/includes/auth_tutor.php';

// Simulação de respostas de alunos (apenas para demonstração)
// Em produção, estes dados viriam de uma base de dados
$sampleAnswers = [
    [
        'nome' => 'João Silva',
        'pergunta' => 'O que é um commit?',
        'resposta' => 'Um snapshot de alterações no repositório',
        'comentario' => 'Respondeu corretamente. Compreende bem este conceito.',
    ],
    [
        'nome' => 'Maria Fernandes',
        'pergunta' => 'O que é push?',
        'resposta' => 'Um comando para criar uma branch',
        'comentario' => 'Resposta incorreta. Precisa rever este tópico.',
    ],
    [
        'nome' => 'Rúben Costa',
        'pergunta' => 'O que é uma branch?',
        'resposta' => 'Uma linha independente de desenvolvimento dentro do mesmo repositório',
        'comentario' => 'Excelente compreensão do conceito.',
    ],
];

require __DIR__ . '/includes/header.php';
?>

<section class="card">
  <h1>Área do Tutor</h1>
  <p>Bem-vindo, <?= htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8') ?>! Aqui podes avaliar as respostas dos alunos ao quiz de Git.</p>

  <div class="grid grid-2">
    <?php foreach ($sampleAnswers as $idx => $answer): ?>
      <div class="response-card" data-response="<?= $idx ?>">
        <div class="response-header">
          <div>
            <strong><?= htmlspecialchars($answer['nome'], ENT_QUOTES, 'UTF-8') ?></strong>
            <span class="muted">(Git)</span>
          </div>
          <span class="badge status">Pendente</span>
        </div>

        <div class="response-body">
          <p><strong>Pergunta:</strong></p>
          <p><?= htmlspecialchars($answer['pergunta'], ENT_QUOTES, 'UTF-8') ?></p>
          <p><strong>Resposta do aluno:</strong></p>
          <p><?= htmlspecialchars($answer['resposta'], ENT_QUOTES, 'UTF-8') ?></p>
        </div>

        <div class="response-actions">
          <button class="button small mark-button" type="button" data-status="certo">Certo</button>
          <button class="button small secondary mark-button" type="button" data-status="errado">Errado</button>
        </div>

        <div class="response-comment">
          <label for="comment-<?= $idx ?>">Comentário do tutor</label>
          <textarea id="comment-<?= $idx ?>" class="comment-input" rows="2" placeholder="Escreve um comentário..." ><?= htmlspecialchars($answer['comentario'], ENT_QUOTES, 'UTF-8') ?></textarea>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="note">
    <p><strong>Nota:</strong> As avaliações não são persistidas numa base de dados. Os dados são apenas visuais e locais.</p>
  </div>

  <div class="actions">
    <a class="button secondary" href="logout.php">Sair</a>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php';
