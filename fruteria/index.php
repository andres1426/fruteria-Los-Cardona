<?php
declare(strict_types=1);

session_start();

$authError = '';
$defaultUser = [
    'username' => 'admin',
    'password' => '1234', // demo only
];

if (!empty($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === $defaultUser['username'] && $password === $defaultUser['password']) {
        $_SESSION['user'] = $username;
        header('Location: dashboard.php');
        exit;
    }

    $authError = 'Credenciales inválidas. Intenta nuevamente.';
}

require __DIR__ . '/includes/header.php';
?>

<section class="auth-card">
    <h2>Iniciar sesión</h2>
    <?php if ($authError): ?>
        <p class="alert alert-error"><?php echo htmlspecialchars($authError); ?></p>
    <?php endif; ?>
    <form method="post" class="form">
        <label>
            Usuario
            <input type="text" name="username" required>
        </label>
        <label>
            Contraseña
            <input type="password" name="password" required>
        </label>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
    <p class="helper-text">Usuario demo: admin / 1234</p>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>

