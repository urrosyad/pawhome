<?php
require_once  __DIR__ . "/app/config.php";
require_once __DIR__ . "/app/db.php";
include __DIR__ . "/views/layouts/header.php";
include __DIR__ . "/views/layouts/navbar.php";
require_once __DIR__ . '/controllers/CatsController.php';
require_once __DIR__ . '/app/auth.php';
validateSession($pdo);

$limit = 6; // jumlah card per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$cats = CatsController::list($pdo, $limit, $offset);
$totalCats = CatsController::count($pdo);
$totalPages = ceil($totalCats / $limit);

function pastelColor()
{
  $r = rand(180, 255);
  $g = rand(180, 255);
  $b = rand(180, 255);
  return "rgb($r,$g,$b)";
}

$successMessage = '';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $result = PenitipanController::submit($pdo, $_POST, $_FILES);

  if ($result === true) {
    $_SESSION['flash_success'] = 'Pengajuan OpenPaw berhasil! Menunggu verifikasi admin.';
    header('Location: index.php');
    exit;
  } else {
    $_SESSION['flash_error'] = 'Gagal mengirim data. Silakan coba lagi.';
    header('Location: openPaw.php');
    exit;
  }
}
?>

<section class="adoptPaw-section">
  <h1 class="adoptPaw-title">Temukan Sahabat Barumu 🐾</h1>
  <div id="petContainer" class="pet-container">
    <?php foreach ($cats as $cat): ?>
      <div
        class="pet-card"
        style="--card-color: <?= pastelColor() ?>">
        <img
          src="<?= BASE_URL ?>images/uploads/<?= htmlspecialchars($cat['fotoKucing']) ?>"
          alt="<?= htmlspecialchars($cat['namaKucing']) ?>">
        <div class="pet-info">
          <h3 class="pet-name"><?= htmlspecialchars($cat['namaKucing']) ?></h3>
          <p class="pet-type"><?= htmlspecialchars($cat['jenisKucing']) ?></p>
          <button class="adoptBtn" onclick="goToDetail(<?= $cat['idKucing'] ?>)">Lihat Detail</button>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <?php if ($page < $totalPages): ?>
    <a href="?page=<?= $page + 1 ?>" class="load-more">
      Lihat Semua
    </a>
  <?php endif; ?>
</section>
<script>
  const BASE_URL = "<?= BASE_URL ?>";

  function goToDetail(id) {
    window.location.href = BASE_URL + "detailPaw.php?id=" + id;
  }
</script>

<?php
include __DIR__ . "/views/layouts/footer.php";
?>