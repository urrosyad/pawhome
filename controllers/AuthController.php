<?php
// controllers/AuthController.php
require_once __DIR__ . '/../app/db.php';
require_once __DIR__ . '/../models/UserModel.php';
session_start();

class AuthController {
    public static function register(PDO $pdo, array $post, array $files = []) {
        // basic validation
        $errors = [];
        if (empty($post['nama'])) $errors[] = 'Nama wajib diisi';
        if (empty($post['email']) || !filter_var($post['email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'Email tidak valid';
        if (empty($post['password']) || strlen($post['password']) < 6) $errors[] = 'Password minimal 6 karakter';

        if (UserModel::findByEmail($pdo, $post['email'])) $errors[] = 'Email sudah terdaftar';

        if ($errors) return ['errors' => $errors];

        $hashed = password_hash($post['password'], PASSWORD_DEFAULT);

        $userId = UserModel::create($pdo, [
            'nama' => $post['nama'],
            'email' => $post['email'],
            'password' => $hashed
        ]);

        // auto-login after register (optional)
        $_SESSION['user_id'] = $userId;
        return ['success' => true, 'userId' => $userId];
    }

    public static function login(PDO $pdo, array $post) {
        $email = $post['email'] ?? '';
        $password = $post['password'] ?? '';

        if (!$email || !$password) return ['errors' => ['Email dan password wajib diisi']];

        $user = UserModel::findByEmail($pdo, $email);
        if (!$user || !password_verify($password, $user['passwordUser'])) {
            return ['errors' => ['Email atau password salah']];
        }

        // set session
        $_SESSION['user_id'] = (int)$user['idUser'];
        $_SESSION['user_role'] = $user['roleUser'];
        return ['success' => true];
    }

    public static function logout() {
        session_start();
        $_SESSION = [];
        session_destroy();
    }
}
