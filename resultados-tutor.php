<?php
// resultados-tutor.php - Dashboard melhorado para tutores verem resultados dos alunos.
// Apenas tutores autenticados podem aceder.

$pageTitle = 'Resultados dos Alunos - Tutor';

// Verificar se é tutor autenticado
require __DIR__ . '/includes/auth_tutor.php';

// Obter alunos e respostas reais a partir da base de dados
$correctAnswers = [
    'commit' => 'Um snapshot de alterações no repositório',
    'push' => 'Enviar alterações locais para o repositório remoto',
    'pull' => 'Trazer alterações do repositório remoto para a tua cópia local',
    'branch' => 'Uma linha independente de desenvolvimento dentro do mesmo repositório',
    'github' => 'Hospedar repositórios Git online e colaborar',
];

$alunosRaw = [];
$stmt = $conn->prepare(
    'SELECT u.id, u.name, u.email, u.pontos, qa.question_key, qa.student_answer, qa.updated_at
     FROM users u
     LEFT JOIN quiz_answers qa ON u.id = qa.user_id
     WHERE u.role = ?
     ORDER BY u.name ASC, qa.updated_at DESC'
);
$role = 'aluno';
$stmt->bind_param('s', $role);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $userId = (int) $row['id'];
    if (!isset($alunosRaw[$userId])) {
        $alunosRaw[$userId] = [
            'id' => $userId,
            'nome' => $row['name'],
            'email' => $row['email'],
            'pontos' => (int) $row['pontos'],
            'respostas' => [],
            'last_at' => $row['updated_at'] ?? null,
        ];
    }

    if (!empty($row['question_key'])) {
        $alunosRaw[$userId]['respostas'][] = [
            'question_key' => $row['question_key'],
            'student_answer' => $row['student_answer'],
            'updated_at' => $row['updated_at'],
        ];
    }
}

$alunosResultados = [];
foreach ($alunosRaw as $aluno) {
    $certas = 0;
    $erradas = 0;
    $total = count($aluno['respostas']);

    foreach ($aluno['respostas'] as $resposta) {
        $key = $resposta['question_key'];
        if (isset($correctAnswers[$key])) {
            if ($resposta['student_answer'] === $correctAnswers[$key]) {
                $certas++;
            } else {
                $erradas++;
            }
        }
    }

    $pontuacao = $total > 0 ? round(($certas / $total) * 100) : 0;
    $status = $total === 0 ? 'Sem respostas' : ($pontuacao >= 80 ? 'Avançado' : ($pontuacao >= 60 ? 'Intermédio' : 'Iniciante'));

    $alunosResultados[] = [
        'id' => $aluno['id'],
        'nome' => $aluno['nome'],
        'email' => $aluno['email'],
        'certas' => $certas,
        'erradas' => $erradas,
        'pontuacao' => $pontuacao,
        'data' => $aluno['last_at'] ?? 'N/A',
        'status' => $status,
    ];
}

$totalAlunos = count($alunosResultados);
$mediaGeral = $totalAlunos > 0 ? round(array_sum(array_column($alunosResultados, 'pontuacao')) / $totalAlunos) : 0;
$melhorAluno = $totalAlunos > 0 ? array_reduce($alunosResultados, function($carry, $item) {
    return (!$carry || $item['pontuacao'] > $carry['pontuacao']) ? $item : $carry;
}) : ['nome' => 'N/A', 'pontuacao' => 0];

require __DIR__ . '/includes/header.php';
?>

<section class="hero">
  <div class="hero-content">
    <h1>📊 Resultados dos Alunos</h1>
    <p>Acompanha o desempenho da turma no teste de Git. Visualiza estatísticas gerais e detalhes individuais de cada aluno.</p>
  </div>
</section>

<!-- RESUMO ESTATÍSTICO -->
<section class="stats-container">
  <div class="stat-card">
    <div class="stat-icon">👥</div>
    <div class="stat-content">
      <h3><?= $totalAlunos ?></h3>
      <p>Total de Alunos</p>
    </div>
  </div>

  <div class="stat-card">
    <div class="stat-icon">📈</div>
    <div class="stat-content">
      <h3><?= round($mediaGeral) ?>%</h3>
      <p>Média Geral</p>
    </div>
  </div>

  <div class="stat-card">
    <div class="stat-icon">⭐</div>
    <div class="stat-content">
      <h3><?= htmlspecialchars($melhorAluno['nome'], ENT_QUOTES, 'UTF-8') ?></h3>
      <p>Melhor Desempenho (<?= $melhorAluno['pontuacao'] ?>%)</p>
    </div>
  </div>
</section>

<!-- TABELA DE RESULTADOS -->
<section class="card results-section">
  <h2>Detalhes por Aluno</h2>
  
  <div class="table-responsive">
    <table class="results-table">
      <thead>
        <tr>
          <th>Nome do Aluno</th>
          <th>Pontuação</th>
          <th>Certas</th>
          <th>Erradas</th>
          <th>Nível</th>
          <th>Data</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($alunosResultados as $aluno): ?>
          <tr class="result-row">
            <td class="student-name">
              <strong><?= htmlspecialchars($aluno['nome'], ENT_QUOTES, 'UTF-8') ?></strong>
              <span class="email"><?= htmlspecialchars($aluno['email'], ENT_QUOTES, 'UTF-8') ?></span>
            </td>
            <td class="score">
              <span class="score-badge" style="background-color: <?= $aluno['pontuacao'] >= 80 ? '#10b981' : ($aluno['pontuacao'] >= 60 ? '#f59e0b' : '#ef4444') ?>;">
                <?= $aluno['pontuacao'] ?>%
              </span>
            </td>
            <td class="correct">
              <span class="badge badge-correct">✓ <?= $aluno['certas'] ?></span>
            </td>
            <td class="incorrect">
              <span class="badge badge-incorrect">✗ <?= $aluno['erradas'] ?></span>
            </td>
            <td class="level">
              <span class="status-badge status-<?= strtolower($aluno['status']) ?>">
                <?= htmlspecialchars($aluno['status'], ENT_QUOTES, 'UTF-8') ?>
              </span>
            </td>
            <td class="date">
              <?= htmlspecialchars($aluno['data'], ENT_QUOTES, 'UTF-8') ?>
            </td>
            <td class="action">
              <button class="button-small view-detail" data-student="<?= $aluno['id'] ?>" type="button">Ver</button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</section>

<!-- FILTROS/NOTAS -->
<section class="card">
  <h2>📋 Notas Importantes</h2>
  
  <ul class="feature-list">
    <li><strong>Total de questões:</strong> 5 questões sobre Git e GitHub</li>
    <li><strong>Nível Iniciante:</strong> 0-40% (menos de 3 acertos)</li>
    <li><strong>Nível Intermédio:</strong> 40-80% (3-4 acertos)</li>
    <li><strong>Nível Avançado:</strong> 80-100% (4-5 acertos)</li>
    <li><strong>Dados:</strong> Os resultados são carregados da base de dados para tutores verem desempenho real dos alunos.</li>
  </ul>
</section>

<!-- EXPORTAR / AÇÕES -->
<section class="card">
  <h2>Opções de Tutor</h2>
  
  <div class="tutor-actions">
    <button class="button" id="export-btn" type="button">📥 Exportar Resultados</button>
    <a class="button secondary" href="dashboard.php">← Voltar ao Dashboard</a>
    <a class="button secondary" href="logout.php">🚪 Sair</a>
  </div>
</section>

<script>
// Interatividade simples
document.querySelectorAll('.view-detail').forEach(button => {
  button.addEventListener('click', function() {
    const studentId = this.getAttribute('data-student');
    alert('Detalhes do aluno ' + studentId + ' (funcionalidade de demonstração)');
  });
});

// Exportar resultados simulado
document.getElementById('export-btn').addEventListener('click', function() {
  alert('Função de exportação não está implementada nesta versão (dados de demonstração).');
});
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>
