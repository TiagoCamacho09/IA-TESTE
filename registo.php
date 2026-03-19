<?php
// registo.php - simula um processo de registo sem base de dados.
// Os dados são guardados na sessão e o utilizador é redirecionado para o dashboard.

$pageTitle = 'Criar Conta';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $role = isset($_POST['role']) ? trim($_POST['role']) : 'aluno';

    if ($name === '' || $email === '' || $password === '') {
        $error = 'Por favor, preenche todos os campos para criar a conta.';
    } else {
        $_SESSION['user'] = [
            'name' => $name,
            'email' => $email,
            'role' => $role,
        ];

        header('Location: dashboard.php');
        exit;
    }
}

require __DIR__ . '/includes/header.php';
?>

<section class="card">
  <h1>Criar Conta</h1>
  <p>Regista-te como aluno ou tutor para acederes às funcionalidades do sistema.</p>

  <?php if ($error !== ''): ?>
    <div class="alert alert-error" role="alert"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
  <?php endif; ?>

  <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8') ?>">
    <div class="form-group">
      <label for="name">Nome completo</label>
      <input id="name" name="name" type="text" placeholder="Ex: Ana Silva" required>
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input id="email" name="email" type="email" placeholder="exemplo@dominio.com" required>
    </div>

    <div class="form-group">
      <label for="password">Palavra-passe</label>
      <input id="password" name="password" type="password" placeholder="••••••••" required>
    </div>

    <div class="form-group">
      <label for="role">Tipo de utilizador</label>
      <select id="role" name="role" required>
        <option value="aluno">Aluno</option>
        <option value="tutor">Tutor</option>
      </select>
    </div>

    <div class="actions">
      <button class="button" type="submit">Criar conta</button>
      <a class="button secondary" href="login.php">Já tenho conta</a>
    </div>
  </form>
</section>

<?php require __DIR__ . '/includes/footer.php';
