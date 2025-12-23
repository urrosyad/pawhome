<?php
require_once __DIR__.'/../app/db.php';
require_once __DIR__.'/../models/CatModel.php';
require_once __DIR__.'/../models/PenitipanModel.php';

class CatsController {
    // Ambil list kucing dengan limit + offset
    public static function list(PDO $pdo, $limit = 8, $offset = 0) {
        return CatModel::getAll($pdo, $limit, $offset);
    }

    // Ambil detail kucing berdasarkan ID
    public static function detail(PDO $pdo, $id) {
        return CatModel::findById($pdo, (int)$id);
    }

    // Hitung total kucing tersedia
    public static function count(PDO $pdo) {
        return CatModel::countAll($pdo);
    }

    public static function add(PDO $pdo, array $data) {
        // validate, process image upload, call CatModel::create
    }

    /**
     * Create master kucing and penitipan record in a single transaction.
     * Expects $catData to contain cat fields and $penitipanData to contain penitipan fields.
     * Returns array with 'success' and extra data or throws Exception on failure.
     */
    // public static function addWithPenitipan(PDO $pdo, array $catData, array $penitipanData) {
    //     try {
    //         $pdo->beginTransaction();

    //         // create cat (returns new id)
    //         $newCatId = CatModel::create($pdo, $catData);

    //         if (!$newCatId) {
    //             throw new Exception('Gagal membuat cat record');
    //         }

    //         // attach idKucing to penitipan data
    //         $penitipanData['idKucing'] = $newCatId;

    //         $newPenitipanId = PenitipanModel::create($pdo, $penitipanData);

    //         if (!$newPenitipanId) {
    //             throw new Exception('Gagal membuat penitipan record');
    //         }

    //         $pdo->commit();
    //         return ['success' => true, 'idKucing' => $newCatId, 'idPenitipan' => $newPenitipanId];
    //     } catch (Exception $e) {
    //         if ($pdo->inTransaction()) $pdo->rollBack();
    //         throw $e;
    //     }
    // }
}
