<?php
require_once __DIR__.'/../app/db.php';
require_once __DIR__.'/../models/CatModel.php';
require_once __DIR__.'/../models/PenitipanModel.php';

class PenitipanController{
            public static function submit(PDO $pdo, array $post, array $files) {

    try {
      $pdo->beginTransaction();

            // upload foto
            $fileName = time()."_".$files['foto']['name'];
            // move_uploaded_file($files['foto']['tmp_name'], "images/".$fileName);
            $uploadDir = __DIR__ . '/../images/uploads/';
            if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
            }

            move_uploaded_file(
            $files['foto']['tmp_name'],
            $uploadDir . $fileName
            );

            if (!move_uploaded_file(...)) {
            throw new Exception("Upload foto gagal");
            }

      // insert master kucing
            $catId = CatModel::create($pdo,[
            'idPemilik'       => $_SESSION['user_id'],
            'namaKucing'      => $post['namaKucing'],
            'jenisKucing'     => $post['ras'],
            'genderKucing'    => $post['gender'],
            'umurKucing'      => $post['usia'],
            'deskripsiKucing' => $post['deskripsi'],
            'makananFav'      => $post['makananFav'],
            'mainanFav'       => $post['mainanFav'],
            'fotoKucing'      => $fileName,
            'statusKucing'    => 'tersedia'
            ]);

      // insert penitipan
      PenitipanModel::create($pdo,[
        'idUser'    => $_SESSION['user_id'],
        'idKucing' => $catId,
        'alasanPenyerahan' => $post['alasanPenyerahan'],
        'makananFav' =>$post['makananFav'],
        'mainanFav' =>$post['mainanFav']
      ]);
      $pdo->commit();
      return true;

    } catch(Exception $e){
      $pdo->rollBack();
      
    }
  }
}

?>