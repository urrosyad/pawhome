<?php
require_once __DIR__.'/../app/db.php';
require_once __DIR__.'/../models/CatModel.php';

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
}
