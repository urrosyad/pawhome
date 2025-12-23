<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL); 

// file_put_contents(
//   __DIR__.'/debug_openpaw.log',
//   "FILE DIPANGGIL\n",
//   FILE_APPEND
// );
            
require_once __DIR__ . "/app/config.php";
require_once __DIR__ . "/app/db.php";
require_once __DIR__ . "/app/auth.php";
require_once __DIR__ . "/models/CatModel.php";
require_once __DIR__ . "/models/PenitipanModel.php";
require_once __DIR__ . "/controllers/PenitipanController.php";
header('Content-Type: application/json');

if (!isLoggedIn()) {
  echo json_encode(['success'=>false,'message'=>'Harus login']);
  exit;
}
$result = PenitipanController::submit($pdo, $_POST, $_FILES);
if ($result === true) {
  echo json_encode([
    'success' => true,
    'message' => 'Pengajuan OpenPaw berhasil! Menunggu verifikasi admin.'
  ]);
} else {
  echo json_encode([
    'success' => false,
    'message' => 'Gagal menyimpan data. Coba lagi.'
  ]);
}
exit;
?>
