<?php
// models/CatModel.php
class CatModel {
    public static function getAll(PDO $pdo, int $limit = 20, int $offset = 0) {
        $stmt = $pdo->prepare("SELECT * FROM tb_masterkucing WHERE statusKucing = 'tersedia' ORDER BY createdDate DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function findById(PDO $pdo, int $id) {
        $stmt = $pdo->prepare("
        SELECT 
            k.*,
            u.namaUser AS namaPemilik
        FROM tb_masterkucing k
        LEFT JOIN tb_users u 
            ON k.idPemilik = u.idUser
        WHERE k.idKucing = :id
        LIMIT 1
    ");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public static function create(PDO $pdo, array $data) {
        $stmt = $pdo->prepare("INSERT INTO tb_masterkucing (idPemilik, namaKucing, jenisKucing, genderKucing, umurKucing, deskripsiKucing, makananFav, mainanFav, fotoKucing, biayaAdopsi, statusKucing) VALUES (:pemilik, :nama, :jenis, :gender, :umur, :deskripsi, :makanan, :mainan, :foto, :biaya, :status)");
        $stmt->execute([
            ':pemilik' => $data['idPemilik'] ?? null,
            ':nama' => $data['namaKucing'],
            ':jenis' => $data['jenisKucing'] ?? null,
            ':gender' => $data['genderKucing'],
            ':umur' => $data['umurKucing'] ?? null,
            ':deskripsi' => $data['deskripsiKucing'] ?? null,
            ':makanan' => $data['makananFav'] ?? null,
            ':mainan' => $data['mainanFav'] ?? null,
            ':foto' => $data['fotoKucing'] ?? null,
            ':biaya' => $data['biayaAdopsi'] ?? 0,
            ':status' => $data['statusKucing'] ?? 'tersedia'
        ]);
        return (int)$pdo->lastInsertId();
    }

    public static function updateStatus(PDO $pdo, int $id, string $status) {
        $stmt = $pdo->prepare("UPDATE tb_masterkucing SET statusKucing = :status WHERE idKucing = :id");
        return $stmt->execute([':status' => $status, ':id' => $id]);
    }
    
    public static function countAll(PDO $pdo) {
        $stmt = $pdo->query("SELECT COUNT(*) FROM tb_masterkucing WHERE statusKucing = 'tersedia'");
        return (int)$stmt->fetchColumn();}
}
