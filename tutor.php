<?php
// tutor.php - Dashboard simplificado do tutor (mantido para compatibilidade)
// Passa redirecionamento para a página atualizada de resultados do tutor.

require __DIR__ . '/includes/auth_tutor.php';

safe_redirect('resultados-tutor.php');


// Obter lista de alunos e as suas respostas
$students = [];
$stmt = $conn->prepare('SELECT id, name, email, pontos FROM users WHERE role = \'aluno\' ORDER BY name');
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $students[] = $row;
}

// Obter respostas de cada aluno individualmente
$answersByStudent = [];
foreach ($students as $student) {
    $stmt = $conn->prepare(
        'SELECT question_key, student_answer, status, comment FROM quiz_answers WHERE user_id = ?'
    );
    $stmt->bind_param('i', $student['id']);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $answersByStudent[$student['id']][$row['question_key']] = $row;
    }
}

require __DIR__ . '/includes/header.php';
?>

<section class="card">
  <h1>Área do Tutor</h1>
  <p>Bem-vindo, <?= htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8') ?>! Aqui podes avaliar as respostas dos alunos ao quiz de Git.</p>

  <?php if (empty($students)): ?>
    <p>Não há alunos registados ainda.</p>
  <?php else: ?>
    <?php foreach ($students as $student): ?>
      <section class="card">
        <h2><?= htmlspecialchars($student['name'], ENT_QUOTES, 'UTF-8') ?> (Pontos: <?= (int) $student['pontos'] ?>)</h2>
        <p class="muted"><?= htmlspecialchars($student['email'], ENT_QUOTES, 'UTF-8') ?></p>

        <?php if (empty($answersByStudent[$student['id']])): ?>
          <p class="note">Este aluno ainda não fez o quiz.</p>
        <?php else: ?>
          <?php foreach ($quizQuestions as $qKey => $qText):
            $answer = $answersByStudent[$student['id']][$qKey] ?? null;
            $studentAnswer = $answer['student_answer'] ?? '<em>Sem resposta</em>';
            $status = $answer['status'] ?? 'pendente';
            $comment = $answer['comment'] ?? '';
          ?>
            <div class="response-card">
              <div class="response-header">
                <div>
                  <strong><?= htmlspecialchars($qText, ENT_QUOTES, 'UTF-8') ?></strong>
                  <span class="muted">(<?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?>)</span>
                </div>
              </div>

              <div class="response-body">
                <p><strong>Resposta do aluno:</strong> <?= htmlspecialchars($studentAnswer, ENT_QUOTES, 'UTF-8') ?></p>
              </div>

              <form method="post" class="response-form">
                <input type="hidden" name="student_id" value="<?= (int) $student['id'] ?>">
                <input type="hidden" name="question_key" value="<?= htmlspecialchars($qKey, ENT_QUOTES, 'UTF-8') ?>">

                <div class="form-group">
                  <label>Status</label>
                  <select name="status" required>
                    <?php foreach (['pendente' => 'Pendente', 'certo' => 'Certo', 'errado' => 'Errado'] as $value => $label): ?>
                      <option value="<?= $value ?>" <?= ($value === $status) ? 'selected' : '' ?>><?= $label ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Comentário</label>
                  <textarea name="comment" rows="2" placeholder="Escreve um comentário..."><?= htmlspecialchars($comment, ENT_QUOTES, 'UTF-8') ?></textarea>
                </div>

                <div class="actions">
                  <button class="button" type="submit">Guardar avaliação</button>
                </div>
              </form>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </section>
    <?php endforeach; ?>
  <?php endif; ?>

  <div class="actions">
    <a class="button secondary" href="logout.php">Sair</a>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php';
