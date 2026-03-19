<?php
// registo.php - simula um processo de registo sem base de dados.
// Os dados são guardados na sessão e o utilizador é redirecionado para o dashboard.

$pageTitle = 'Criar Conta';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/includes/redirect.php';
require_once __DIR__ . '/includes/config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $role = isset($_POST['role']) ? trim($_POST['role']) : 'aluno';

    if ($name === '' || $email === '' || $password === '') {
        $error = 'Por favor, preenche todos os campos para criar a conta.';
    } else {
        // Verificar se já existe um utilizador com este email
        $stmt = $conn->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = 'Já existe uma conta com este email. Tenta outro email ou inicia sessão.';
        } else {
            // Criar nova conta
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare('INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)');
            $stmt->bind_param('ssss', $name, $email, $hash, $role);
            $stmt->execute();

            // Guardar dados do utilizador na sessão
            $_SESSION['user'] = [
                'id' => (int) $stmt->insert_id,
                'name' => $name,
                'email' => $email,
                'role' => $role,
                'pontos' => 0,
            ];

            // Redirecionar conforme tipo de utilizador
            if ($role === 'tutor') {
                safe_redirect('tutor.php');
            } else {
                safe_redirect('dashboard.php');
            }
        }
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
