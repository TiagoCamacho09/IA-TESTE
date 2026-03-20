<?php
// resultados-tutor.php - Dashboard melhorado para tutores verem resultados dos alunos.
// Apenas tutores autenticados podem aceder.

$pageTitle = 'Resultados dos Alunos - Tutor';

// Verificar se é tutor autenticado
require __DIR__ . '/includes/auth_tutor.php';

// Simulação de dados dos alunos com respostas
// Em produção, estes dados viriam de uma base de dados
$alunosResultados = [
    [
        'id' => 1,
        'nome' => 'João Silva',
        'email' => 'joao@exemplo.com',
        'certas' => 4,
        'erradas' => 1,
        'pontuacao' => 80,
        'data' => '2026-03-20 14:30',
        'status' => 'Avançado',
    ],
    [
        'id' => 2,
        'nome' => 'Maria Fernandes',
        'email' => 'maria@exemplo.com',
        'certas' => 3,
        'erradas' => 2,
        'pontuacao' => 60,
        'data' => '2026-03-20 13:15',
        'status' => 'Intermédio',
    ],
    [
        'id' => 3,
        'nome' => 'Rúben Costa',
        'email' => 'ruben@exemplo.com',
        'certas' => 5,
        'erradas' => 0,
        'pontuacao' => 100,
        'data' => '2026-03-19 16:45',
        'status' => 'Avançado',
    ],
    [
        'id' => 4,
        'nome' => 'Sofia Oliveira',
        'email' => 'sofia@exemplo.com',
        'certas' => 2,
        'erradas' => 3,
        'pontuacao' => 40,
        'data' => '2026-03-19 10:20',
        'status' => 'Iniciante',
    ],
    [
        'id' => 5,
        'nome' => 'Pedro Martins',
        'email' => 'pedro@exemplo.com',
        'certas' => 4,
        'erradas' => 1,
        'pontuacao' => 80,
        'data' => '2026-03-18 15:00',
        'status' => 'Avançado',
    ],
];

// Calcular estatísticas
$totalAlunos = count($alunosResultados);
$mediaGeral = array_sum(array_column($alunosResultados, 'pontuacao')) / $totalAlunos;
$melhorAluno = array_reduce($alunosResultados, function($carry, $item) {
    return (!$carry || $item['pontuacao'] > $carry['pontuacao']) ? $item : $carry;
});

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
    <li><strong>Dados:</strong> Os resultados mostrados são dados de demonstração. Em produção, viriam da base de dados.</li>
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
