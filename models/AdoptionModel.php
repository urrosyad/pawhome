<?php
// models/AdoptionModel.php
class AdoptionModel {
    public static function create(PDO $pdo, array $data) {
        $stmt = $pdo->prepare("INSERT INTO tb_adopsikucing (idKucing, idAdopter, alasanAdopsi, totalBayar, statusPembayaran, statusAdopsi) VALUES (:idKucing, :idAdopter, :alasan, :totalBayar, :statusPembayaran, :statusAdopsi)");
        $stmt->execute([
            ':idKucing' => $data['idKucing'],
            ':idAdopter' => $data['idAdopter'],
            ':alasan' => $data['alasanAdopsi'] ?? null,
            ':totalBayar' => $data['totalBayar'] ?? 0.00,
            ':statusPembayaran' => $data['statusPembayaran'] ?? 'menunggu',
            ':statusAdopsi' => $data['statusAdopsi'] ?? 'menunggu'
        ]);
        return (int)$pdo->lastInsertId();
    }

    public static function getById(PDO $pdo, int $id) {
        $stmt = $pdo->prepare("SELECT * FROM tb_adopsikucing WHERE idAdopsi = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
}
