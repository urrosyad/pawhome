<?php
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../app/config.php';
// memastikan session aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn(): bool {
    return isset($_SESSION['user_id']);
}

function currentUser(PDO $pdo) {
    if (!isLoggedIn()) return null;
    return UserModel::findById($pdo, $_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()){
        header("Location: " . BASE_URL . "login.php");
        exit;
    }
}


//   Proteksi Level Admin
function requireAdmin(PDO $pdo) {
    requireLogin();

    $user = currentUser($pdo);

    if (!$user || $user['roleUser'] !== 'admin') {
        http_response_code(403);
        exit('403 Forbidden - Akses khusus admin');
    }
}


//  Hardening session
function validateSession(PDO $pdo) {
    if (!isLoggedIn()) return;
    // Refresh user from DB
    $user = currentUser($pdo);
    if (!$user){
        logout();
        exit;
    }

    // Role integrity check
    if ($_SESSION['user_role'] !== $user['roleUser']) {
        logout();
        exit;
    }

    // Timeout session 30 menit
    if (isset($_SESSION['last_activity'])) {
        if (time() - $_SESSION['last_activity'] > 2600) {
            logout();
            exit;
        }
    }

    $_SESSION['last_activity'] = time();

    // User agent check
    if (!isset($_SESSION['agent'])){
        $_SESSION['agent'] = $_SERVER['HTTP_USER_AGENT'];
    }

    if ($_SESSION['agent'] !== $_SERVER['HTTP_USER_AGENT']) {
        logout();
        exit;
    }
}

function logout() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    session_unset();
    session_destroy();
    header("Location: " . BASE_URL . "login.php");
    exit;
}
