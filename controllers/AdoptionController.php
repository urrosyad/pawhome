<?php
require_once __DIR__ . '/../models/AdoptionModel.php';
require_once __DIR__ . '/../models/CatModel.php';

class AdoptionController {

    public static function submit(PDO $pdo, array $post) {
        try {
            $pdo->beginTransaction();

            // 1. Ambil data kucing
            $cat = CatModel::findById($pdo, $post['idKucing']);
            if (!$cat) {
                throw new Exception('Data kucing tidak ditemukan');
            }

            // 2. Simpan data adopsi
            AdoptionModel::create($pdo, [
                'idKucing'      => $post['idKucing'],
                'idAdopter'     => $_SESSION['user_id'],
                'alasanAdopsi'  => $post['alasanAdopsi'] ?? null,
                'totalBayar'    => $cat['biayaAdopsi'], 
                'statusAdopsi'  => 'menunggu'
            ]);

            // 3. Update status kucing
            CatModel::updateStatus($pdo, $post['idKucing'], 'dalam proses');

            $pdo->commit();
            return true;

        } catch (Exception $e) {
            $pdo->rollBack();
            return false;
        }
    }
}
