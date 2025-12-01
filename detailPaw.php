<?php
require_once  __DIR__ . "/app/config.php";
require_once __DIR__ . "/app/db.php";
include __DIR__ . "/views/layouts/header.php";
include __DIR__ . "/views/layouts/navbar.php";
require_once __DIR__ . '/controllers/CatsController.php';
require_once __DIR__ .'/app/auth.php';
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
?>

<div class="detailContainer">
  <div class="detailPaw">
    <h2><?= htmlspecialchars($cat['namaKucing']) ?></h2>
    <p><b>Jenis:</b> <?= htmlspecialchars($cat['jenisKucing']) ?></p>
    <p><b>Nama Pemilik:</b> <?= htmlspecialchars($cat['namaPemilik']) ?></p>
    <p><b>Jenis Kelamin:</b> <?= htmlspecialchars($cat['genderKucing']) ?></p>
    <p><b>Deskripsi:</b> <?= htmlspecialchars($cat['deskripsiKucing']) ?></p>
    <p><b>Makanan Favorit:</b> <?= htmlspecialchars($cat['makananFav']) ?></p>
    <p><b>Mainan Favorit:</b> <?= htmlspecialchars($cat['mainanFav']) ?></p>

    <button class="adoptBtn" onclick="adoptNow('<?= htmlspecialchars($cat['namaKucing']) ?>')">
      Adopsi Sekarang
    </button>
  </div>

  <div class="catImg">
    <img src="<?= BASE_URL ?>images/<?= htmlspecialchars($cat['fotoKucing']) ?>"
      alt="<?= htmlspecialchars($cat['namaKucing']) ?>">
  </div>

</div>

<script>
  function adoptNow(name) {
    window.location.href = "<?= BASE_URL ?>";
  }
</script>

<?php
include __DIR__ . "/views/layouts/footer.php"
?>