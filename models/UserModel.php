<?php
// models/UserModel.php
class UserModel {
    public static function findByEmail(PDO $pdo, string $email) {
        $stmt = $pdo->prepare("SELECT * FROM tb_users WHERE emailUser = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    public static function findById(PDO $pdo, int $id) {
        $stmt = $pdo->prepare("SELECT * FROM tb_users WHERE idUser = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public static function create(PDO $pdo, array $data) {
        $stmt = $pdo->prepare("INSERT INTO tb_users (namaUser, emailUser, passwordUser, telpUser, alamatUser, roleUser) VALUES (:nama, :email, :password, :telp, :alamat, :role)");
        $stmt->execute([
            ':nama' => $data['nama'],
            ':email' => $data['email'],
            ':password' => $data['password'], // hashed
            ':telp' => $data['telp'] ?? null,
            ':alamat' => $data['alamat'] ?? null,
            ':role' => $data['role'] ?? 'user'
        ]);
        return (int)$pdo->lastInsertId();
    }
}
