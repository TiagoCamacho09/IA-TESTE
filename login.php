<?php
// login.php - simula um processo de login sem base de dados.
// Se o utilizador enviar o formulário, guardamos os dados na sessão e redirecionamos para o dashboard.

$pageTitle = 'Iniciar Sessão';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Incluir configuração da base de dados e helpers comuns
require __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/redirect.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if ($email === '' || $password === '') {
        $error = 'Por favor, preenche o email e a palavra-passe.';
    } else {
        // Procurar utilizador na base de dados
        $stmt = $conn->prepare('SELECT id, name, email, password, role, pontos FROM users WHERE email = ? LIMIT 1');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $userRow = $result->fetch_assoc();

        if (!$userRow || !password_verify($password, $userRow['password'])) {
            $error = 'Email ou palavra-passe inválidos.';
        } else {
            // Guardar dados do utilizador na sessão
            $_SESSION['user'] = [
                'id' => (int) $userRow['id'],
                'name' => $userRow['name'],
                'email' => $userRow['email'],
                'role' => $userRow['role'],
                'pontos' => (int) $userRow['pontos'],
            ];

            // Redirecionar de acordo com o tipo de utilizador
            if ($userRow['role'] === 'tutor') {
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

    <div class="actions">
      <button class="button" type="submit">Entrar</button>
      <a class="button secondary" href="registo.php">Criar conta</a>
    </div>
  </form>
</section>

<?php require __DIR__ . '/includes/footer.php';
