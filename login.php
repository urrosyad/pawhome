<?php
require_once __DIR__.'/app/config.php';
include __DIR__.'/views/layouts/header.php';
require_once __DIR__.'/controllers/AuthController.php';
require_once __DIR__.'/app/auth.php';

// Redirect jika sudah login
if (isLoggedIn()) {
    header("Location: " . BASE_URL);
    exit;
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = AuthController::login($pdo, $_POST);

    if (!empty($result['errors'])) {
        $errors = $result['errors'];
    } else {
        header("Location: " . BASE_URL);
        exit;
    }
}
?>

<section class="loginSection">
    <h2>Login Akun PawHome 🐾</h2>

    <?php if ($errors): ?>
        <div class="notif error">
            <?= implode('<br>', $errors); ?>
        </div>
    <?php endif; ?>

    <form method="POST" id="loginForm">
        <input type="email" name="email" placeholder="contoh@email.com" required>
        <input type="password" name="password" placeholder="password kamu" required>
        <button type="submit">Masuk</button>
    </form>
    <h1>belum punya akun? <a href="register.php">daftar disini</a> </h1>
</section>

