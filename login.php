<?php
// login.php - simula um processo de login sem base de dados.
// Se o utilizador enviar o formulário, guardamos os dados na sessão e redirecionamos para o dashboard.

$pageTitle = 'Iniciar Sessão';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $role = isset($_POST['role']) ? trim($_POST['role']) : 'aluno';

    // Validação simples (sem autenticação real)
    if ($email === '' || $password === '') {
        $error = 'Por favor, preenche o email e a palavra-passe.';
    } else {
        // Guardamos os dados do utilizador na sessão
        $_SESSION['user'] = [
            'name' => preg_replace('/@.+$/', '', $email), // usar parte do email como nome
            'email' => $email,
            'role' => $role,
        ];

        // Redirecionar de acordo com o tipo de utilizador
        if ($role === 'tutor') {
            header('Location: resultados-tutor.php');
        } else {
            header('Location: dashboard.php');
        }
        exit;
    }
}

require __DIR__ . '/includes/header.php';
?>

<section class="card">
  <h1>Iniciar Sessão</h1>
  <p>Introduce o teu email e palavra-passe para aceder ao sistema.</p>

  <?php if ($error !== ''): ?>
    <div class="alert alert-error" role="alert"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
  <?php endif; ?>

  <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8') ?>">
    <div class="form-group">
      <label for="email">Email</label>
      <input id="email" name="email" type="email" placeholder="exemplo@dominio.com" required>
    </div>

    <div class="form-group">
      <label for="password">Palavra-passe</label>
      <input id="password" name="password" type="password" placeholder="••••••••" required>
    </div>

    <div class="form-group">
      <label for="role">Entrar como</label>
      <select id="role" name="role" required>
        <option value="aluno">Aluno</option>
        <option value="tutor">Tutor</option>
      </select>
    </div>

    <div class="actions">
      <button class="button" type="submit">Entrar</button>
      <a class="button secondary" href="registo.php">Criar conta</a>
    </div>
  </form>
</section>

<?php require __DIR__ . '/includes/footer.php';
