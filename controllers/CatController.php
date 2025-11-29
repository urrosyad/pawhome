<?php
require_once __DIR__.'/../app/db.php';
require_once __DIR__.'/../models/CatModel.php';

class CatController {
    public static function list(PDO $pdo, $limit = 8, $offset = 0) {
        return CatModel::allAvailable($pdo, $limit, $offset);
    }

    public static function detail(PDO $pdo, $id) {
        return CatModel::findById($pdo, (int)$id);
    }

    public static function add(PDO $pdo, array $data) {
        // validate, process image upload, call CatModel::create
    }
}
