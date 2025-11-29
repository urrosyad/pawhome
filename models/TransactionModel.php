<?php
// models/TransactionModel.php
class TransactionModel {
    public static function create(PDO $pdo, array $data) {
        $stmt = $pdo->prepare("INSERT INTO tb_transaksi (idUser, tipeTransaksi, idReferensi, nominal, metodeBayar, statusTransaksi) VALUES (:idUser, :tipe, :idRef, :nominal, :metode, :status)");
        $stmt->execute([
            ':idUser' => $data['idUser'],
            ':tipe' => $data['tipeTransaksi'],
            ':idRef' => $data['idReferensi'],
            ':nominal' => $data['nominal'],
            ':metode' => $data['metodeBayar'] ?? 'transfer',
            ':status' => $data['statusTransaksi'] ?? 'menunggu'
        ]);
        return (int)$pdo->lastInsertId();
    }
}
