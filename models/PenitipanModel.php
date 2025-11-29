<?php
// models/PenitipanModel.php
class PenitipanModel {
    public static function create(PDO $pdo, array $data) {
        $stmt = $pdo->prepare("INSERT INTO tb_penitipankucing (idUser, idKucing, alasanPenyerahan, makananfav, mainanfav, statusPenerimaan, statusPembayaran, totalBayar) VALUES (:idUser, :idKucing, :alasan, :makanan, :mainan, :statusPenerimaan, :statusPembayaran, :totalBayar)");
        $stmt->execute([
            ':idUser' => $data['idUser'],
            ':idKucing' => $data['idKucing'],
            ':alasan' => $data['alasanPenyerahan'] ?? null,
            ':makanan' => $data['makananfav'] ?? null,
            ':mainan' => $data['mainanfav'] ?? null,
            ':statusPenerimaan' => $data['statusPenerimaan'] ?? 'menunggu',
            ':statusPembayaran' => $data['statusPembayaran'] ?? 'gratis',
            ':totalBayar' => $data['totalBayar'] ?? 0.00
        ]);
        return (int)$pdo->lastInsertId();
    }
}
