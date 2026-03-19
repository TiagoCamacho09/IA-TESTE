<?php
// teste.php - quiz de Git para alunos
// Apenas alunos autenticados podem fazer o teste.

$pageTitle = 'Quiz de Git';

// Verificar se é aluno autenticado (redireciona se não for)
require __DIR__ . '/includes/auth_aluno.php';

$error = '';

// Definição do quiz em formato Verdadeiro ou Falso
$quiz = [
    [
        'key' => 'push',
        'question' => 'O push serve para enviar alterações para o repositório remoto.',
    ],
    [
        'key' => 'pull',
        'question' => 'O pull serve para apagar ficheiros locais.',
    ],
    [
        'key' => 'branch',
        'question' => 'Uma branch é um caminho separado de trabalho.',
    ],
    [
        'key' => 'commit',
        'question' => 'O commit guarda uma versão do projeto.',
    ],
    [
        'key' => 'github',
        'question' => 'O GitHub é uma base de dados MySQL.',
    ],
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
        $_SESSION['last_quiz'] = $answers;
        header('Location: resultado.php');
        exit;
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

        <div class="options-grid">
          <?php
            $trueChecked = (isset($_POST[$item['key']]) && $_POST[$item['key']] === 'Verdadeiro') ? 'checked' : '';
            $falseChecked = (isset($_POST[$item['key']]) && $_POST[$item['key']] === 'Falso') ? 'checked' : '';
          ?>
          <div class="option-card">
            <input
              type="radio"
              id="<?= htmlspecialchars($item['key'] . '-true', ENT_QUOTES, 'UTF-8') ?>"
              name="<?= htmlspecialchars($item['key'], ENT_QUOTES, 'UTF-8') ?>"
              value="Verdadeiro"
              <?= $trueChecked ?>
              required
            >
            <label for="<?= htmlspecialchars($item['key'] . '-true', ENT_QUOTES, 'UTF-8') ?>">Verdadeiro</label>
          </div>

          <div class="option-card">
            <input
              type="radio"
              id="<?= htmlspecialchars($item['key'] . '-false', ENT_QUOTES, 'UTF-8') ?>"
              name="<?= htmlspecialchars($item['key'], ENT_QUOTES, 'UTF-8') ?>"
              value="Falso"
              <?= $falseChecked ?>
              required
            >
            <label for="<?= htmlspecialchars($item['key'] . '-false', ENT_QUOTES, 'UTF-8') ?>">Falso</label>
          </div>
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
