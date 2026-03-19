<?php
// teste.php - quiz de Git para alunos
// Apenas alunos autenticados podem fazer o teste.

$pageTitle = 'Quiz de Git';

// Verificar se é aluno autenticado (redireciona se não for)
require __DIR__ . '/includes/auth_aluno.php';

$error = '';

// Definição das perguntas e opções
$quiz = [
    [
        'key' => 'commit',
        'question' => 'O que é um commit?',
        'options' => [
            'Um snapshot de alterações no repositório',
            'Um servidor remoto para guardar código',
            'Um ficheiro de configuração do Git',
            'Um comando para criar uma branch',
        ],
    ],
    [
        'key' => 'push',
        'question' => 'O que é push?',
        'options' => [
            'Enviar alterações locais para o repositório remoto',
            'Descarregar alterações do remoto para local',
            'Apagar uma branch',
            'Criar um novo repositório',
        ],
    ],
    [
        'key' => 'pull',
        'question' => 'O que é pull?',
        'options' => [
            'Trazer alterações do repositório remoto para a tua cópia local',
            'Enviar alterações locais para o remoto',
            'Apagar ficheiros que não são usados',
            'Reverter o último commit',
        ],
    ],
    [
        'key' => 'branch',
        'question' => 'O que é uma branch?',
        'options' => [
            'Uma linha independente de desenvolvimento dentro do mesmo repositório',
            'Um comando para gerir permissões',
            'Um ficheiro onde se guarda o histórico',
            'Um serviço para fazer deployment',
        ],
    ],
    [
        'key' => 'github',
        'question' => 'Para que serve o GitHub?',
        'options' => [
            'Hospedar repositórios Git online e colaborar',
            'Fazer backups automáticos do Windows',
            'Servir páginas web apenas',
            'Gerir bases de dados',
        ],
    ],
];

// Definição das respostas corretas para calcular pontos
$correct = [
    'commit' => 'Um snapshot de alterações no repositório',
    'push' => 'Enviar alterações locais para o repositório remoto',
    'pull' => 'Trazer alterações do repositório remoto para a tua cópia local',
    'branch' => 'Uma linha independente de desenvolvimento dentro do mesmo repositório',
    'github' => 'Hospedar repositórios Git online e colaborar',
];

// Se o formulário foi submetido, validar e guardar as respostas na sessão
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $answers = [];
    foreach ($quiz as $item) {
        $key = $item['key'];
        $answers[$key] = isset($_POST[$key]) ? trim($_POST[$key]) : '';
    }

    $missing = array_filter($answers, fn($value) => $value === '');

    if (!empty($missing)) {
        $error = 'Por favor, responde a todas as perguntas antes de ver o resultado.';
    } else {
        // Guardar as respostas na base de dados (por aluno e pergunta)
        $stmt = $conn->prepare(
            'INSERT INTO quiz_answers (user_id, question_key, student_answer) VALUES (?, ?, ?) '
            . 'ON DUPLICATE KEY UPDATE student_answer = VALUES(student_answer), status = "pendente", comment = NULL'
        );

        foreach ($answers as $key => $value) {
            $userId = $user['id'];
            $stmt->bind_param('iss', $userId, $key, $value);
            $stmt->execute();
        }

        // Calcular pontos: 10 pontos por resposta correta
        $score = 0;
        foreach ($correct as $key => $expected) {
            if (isset($answers[$key]) && $answers[$key] === $expected) {
                $score++;
            }
        }
        $pontos = $score * 10;

        // Atualizar pontos do utilizador na base de dados
        $stmt = $conn->prepare('UPDATE users SET pontos = ? WHERE id = ?');
        $stmt->bind_param('ii', $pontos, $userId);
        $stmt->execute();

        safe_redirect('resultado.php');
    }
}

require __DIR__ . '/includes/header.php';
?>

<section class="card">
  <h1>Quiz de Git</h1>
  <p>Responde às perguntas abaixo para testar os teus conhecimentos básicos sobre Git.</p>
  <?php if (!$user): ?>
    <p class="note"><strong>Nota:</strong> Os resultados ficam guardados apenas enquanto a sessão estiver ativa.</p>
  <?php endif; ?>

  <?php if ($error !== ''): ?>
    <div class="alert alert-error" role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
  <?php endif; ?>

  <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8') ?>">
    <?php foreach ($quiz as $index => $item): ?>
      <div class="card quiz-card">
        <h2>Pergunta <?= $index + 1 ?> de <?= count($quiz) ?></h2>
        <p><?= htmlspecialchars($item['question'], ENT_QUOTES, 'UTF-8') ?></p>

        <div class="form-group">
          <select name="<?= htmlspecialchars($item['key'], ENT_QUOTES, 'UTF-8') ?>" required>
            <option value="" disabled selected>Seleciona uma opção</option>
            <?php foreach ($item['options'] as $option): ?>
              <option value="<?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>"
                <?= (isset($_POST[$item['key']]) && $_POST[$item['key']] === $option) ? 'selected' : '' ?>>
                <?= htmlspecialchars($option, ENT_QUOTES, 'UTF-8') ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
    <?php endforeach; ?>

    <div class="actions">
      <button class="button" type="submit">Ver resultado</button>
      <a class="button secondary" href="dashboard.php">Voltar ao dashboard</a>
    </div>
  </form>
</section>

<?php require __DIR__ . '/includes/footer.php';
