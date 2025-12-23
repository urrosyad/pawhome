<?php
// models/PenitipanModel.php
class PenitipanModel {
    public static function create(PDO $pdo, array $data) {
        $stmt = $pdo->prepare("INSERT INTO tb_penitipankucing (idUser, idKucing, alasanPenyerahan, makananfav, mainanfav, statusPenerimaan) VALUES (:idUser, :idKucing, :alasan, :makanan, :mainan, :statusPenerimaan)");
        $stmt->execute([
            ':idUser' => $data['idUser'],
            ':idKucing' => $data['idKucing'],
            ':alasan' => $data['alasanPenyerahan'] ?? null,
            ':makanan' => $data['makananfav'] ?? null,
            ':mainan' => $data['mainanfav'] ?? null,
            ':statusPenerimaan' => $data['statusPenerimaan'] ?? 'menunggu'
        ]);
        return (int)$pdo->lastInsertId();
    }
}
