<?php
require_once __DIR__.'/app/config.php';
require_once __DIR__.'/controllers/AuthController.php';
require_once __DIR__.'/app/auth.php';
include __DIR__.'/views/layouts/header.php';

// Redirect jika sudah login
if (isLoggedIn()) {
    header("Location: " . BASE_URL);
    exit;
}
$errors = [];
$success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = AuthController::register($pdo, $_POST);

    if (!empty($result['errors'])) {
        $errors = $result['errors'];
    } else {
        $success = true;
        header("Location: " . BASE_URL . "login.php");
        exit;
    }
}
?>

<section class="registerSection">
    <h2>Daftar Akun PawHome 🐾</h2>

    <?php if ($errors): ?>
        <div class="notif error">
            <?= implode('<br>', $errors); ?>
        </div>
    <?php endif; ?>
    
<form method="POST" id="registerForm">
    <input 
        type="text" 
        name="nama" 
        placeholder="Nama Lengkap"
        required>

    <input 
        type="email" 
        name="email" 
        placeholder="contoh@email.com"
        required>

    <input 
        type="password" 
        name="password" 
        placeholder="Minimal 6 karakter"
        minlength="6"
        required>

    <input 
        type="tel" 
        name="telp"
        placeholder="Nomor Telepon"
        required>

    <textarea 
        name="alamat" 
        placeholder="Alamat Lengkap"
        rows="3"
        required></textarea>

    <button type="submit">Daftar`</button>
    <h1>sudah punya akun? <a href="login.php">segera masuk!</a> </h1>
    
</form>

</section>

