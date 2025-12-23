<?php
require_once __DIR__ . '/../app/config.php';
require_once __DIR__ . '/../app/db.php';
require_once __DIR__ . '/../app/auth.php';

require_once __DIR__ . '/../models/CatModel.php';
require_once __DIR__ . '/../models/PenitipanModel.php';
require_once __DIR__ . '/../controllers/PenitipanController.php';

header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

try {
    switch ($action) {

        case 'auth.login':
            echo json_encode(AuthController::login($pdo, $_POST));
            break;

        case 'auth.register':
            echo json_encode(AuthController::register($pdo, $_POST));
            break;

        case 'openpaw.submit':
            if (!isLoggedIn()) {
                echo json_encode(['success'=>false,'message'=>'Harus login']);
                break;
            }

            $result = PenitipanController::submit($pdo, $_POST, $_FILES);
            echo json_encode([
                'success' => $result,
                'message' => $result
                    ? 'Pengajuan OpenPaw berhasil! Menunggu verifikasi admin.'
                    : 'Gagal menyimpan data.'
            ]);
            break;

        default:
            http_response_code(404);
            echo json_encode(['success'=>false,'message'=>'Endpoint tidak ditemukan']);
    }

} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'success'=>false,
        'message'=>'Server error',
        'debug'=>$e->getMessage() // hapus di production
    ]);
}
