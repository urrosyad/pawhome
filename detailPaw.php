<?php
require_once  __DIR__ . "/app/config.php";
require_once __DIR__ . "/app/db.php";
include __DIR__ . "/views/layouts/header.php";
include __DIR__ . "/views/layouts/navbar.php";
require_once __DIR__ . '/controllers/CatsController.php';
require_once __DIR__ . '/controllers/AdoptionController.php';
require_once __DIR__ . '/app/auth.php';
validateSession($pdo);

// Validasi parameter ID
if (!isset($_GET['id'])) {
  echo "<p>😿 ID kucing tidak ditemukan.</p>";
  exit;
}

// Ambil Idkucing dari halaman sebleumnya
$id = $_GET['id'];
$cat = CatsController::detail($pdo, $id);

// Validasi kucing 
if (!$cat) {
  echo "<p>😿 Kucing dengan ID tersebut tidak ditemukan.</p>";
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $result = AdoptionController::submit($pdo, $_POST);

  if ($result) {
    $_SESSION['flash_success'] = 'Berhasil mengajukan adopsi. Menunggu verifikasi admin.';
    header('Location: index.php');
    exit;
  } else {
    $_SESSION['flash_error'] = 'Gagal mengajukan adopsi. Silakan coba lagi.';
    header('Location: detailPaw.php?id=' . $_POST['idKucing']);
    exit;
  }
}
?>

<div class="detailContainer">
  <dadoptForm.phpiv class="detailPaw">
    <h2><?= htmlspecialchars($cat['namaKucing']) ?></h2>
    <p><b>Jenis:</b> <?= htmlspecialchars($cat['jenisKucing']) ?></p>
    <p><b>Nama Pemilik:</b> <?= htmlspecialchars($cat['namaPemilik']) ?></p>
    <p><b>Jenis Kelamin:</b> <?= htmlspecialchars($cat['genderKucing']) ?></p>
    <p><b>Makanan Favorit:</b> <?= htmlspecialchars($cat['makananFav']) ?></p>
    <p><b>Mainan Favorit:</b> <?= htmlspecialchars($cat['mainanFav']) ?></p>
    <p><b>Deskripsi:</b> <?= htmlspecialchars($cat['deskripsiKucing']) ?></p>
    <form method="POST">
      <input type="hidden" name="idKucing" value="<?= htmlspecialchars($cat['idKucing']) ?>">
      <div class="form-group">
        <label for="alasanAdopsi">Alasan Adopsi</label>
        <textarea
          id="alasanAdopsi"
          name="alasanAdopsi"
          placeholder="Kenapa kamu ingin mengadopsi kucing ini?"
          required></textarea>
      </div>
      <button type="submit" class="adoptBtn">
        Adopsi Sekarang
      </button>
    </form>
  </dadoptForm.phpiv>

  <div class="catImg">
    <img src="<?= BASE_URL ?>images/uploads/<?= htmlspecialchars($cat['fotoKucing']) ?>"
      alt="<?= htmlspecialchars($cat['namaKucing']) ?>">
  </div>
</div>


<?php
include __DIR__ . "/views/layouts/footer.php"
?>