<?php
require_once  __DIR__ ."/app/config.php";
require_once __DIR__ ."/app/db.php";
include __DIR__ ."/views/layouts/header.php";
include __DIR__ ."/views/layouts/navbar.php";
require_once __DIR__ .'/controllers/CatsController.php';
require_once __DIR__ .'/app/auth.php';
validateSession($pdo);
?>

<section class="hero reveal" id="home">
  <img src="<?= BASE_URL ?>images/kuning.svg" alt="decor top right" class="heroDecor heroDecorLeft" />
  <img src="<?= BASE_URL ?>images/merah.svg" alt="decor bottom left" class="heroDecor heroDecorRight" />
  <div class="heroContent">
    <h1 class="heroTitle" id="colorfulTitle">Find Your Perfect Pawtner</h1>
    <img src="<?= BASE_URL ?>images/pawPink.png" alt="paw pink" class="paw1" />
    <img src="<?= BASE_URL ?>images/pawBlue.png" alt="paw blue" class="paw2" />
    <h2 class="heroSubTitle">Temukan Pawtner terbaik yang akan selalu menyambutmu pulang dengan kehangatan meownya</h2>
    <a href="<?= BASE_URL ?>adoptPaw.php" class="heroButton">Adopt Now!</a>
  </div>
  <div class="heroImage">
    <img
      src="<?= BASE_URL ?>images/kittenCarousel.png"
      alt="Cute kitten" />
  </div>
  </div>
</section>

<!-- Category Section -->
<section class="category reveal">
  <div class="categoryGrid">
    <div class="categoryItem">
      <span class="material-symbols-outlined">pets</span>
      <p>120+ kucing diadopsi</p>
    </div>

    <div class="categoryItem">
      <span class="material-symbols-outlined">volunteer_activism</span>
      <p>90+ Adopter aktif di Indonesia</p>
    </div>

    <div class="categoryItem">
      <span class="material-symbols-outlined">home</span>
      <p>15 Shelter & Komunitas</p>
    </div>

    <div class="categoryItem">
      <span class="material-symbols-outlined">location_city</span>
      <p>Aktif di 7 Kota Besar</p>
    </div>

    <div class="categoryItem">
      <span class="material-symbols-outlined">pets</span>
      <p>Pawdogs segera datang</p>
    </div>
  </div>
  </div>
</section>

<section class="service-openPaw reveal" id="service">
  <div class="serviceContainer serviceContainerReverse">
    <div class="serviceImage openPaw">
      <img src="<?= BASE_URL ?>images/openPaw-img.png" alt="">
    </div>
    <div class="serviceContent">
      <h2 class="serviceTitle reverse">Untuk kamu yang ingin memberi mereka peluang hidup lebih baik</h2>
      <div class="serviceLinks">
        <a href="<?= BASE_URL ?>openPaw.php" class="serviceLink reverse"> Try OpenPaw →</a>
      </div>
    </div>
  </div>
</section>

<!-- Pet Cards Section -->
<section class="pets reveal" id="adopt">
  <h2 class="petsTitle">Kami Menyayangi Semua Jenis Kucing</h2>
  <p class="petsSubTitle">
    Temukan berbagai jenis hewan peliharaan yang siap diadopsi dan cintai mereka seperti keluarga.
  </p>
  <?php
  function pastelColor()
  {
    $r = rand(180, 255);
    $g = rand(180, 255);
    $b = rand(180, 255);
    return "rgb($r,$g,$b)";
  }
  $cats = CatsController::list($pdo, 8, 0);
  ?>

  <div class="petsGrid" id="petsGrid">
    <?php foreach ($cats as $index => $cat): ?>

      <div class="petCard"
        style="--card-color: <?= pastelColor() ?>;"
        data-number="<?= sprintf('%02d', $index + 1) ?>"
        data-id="<?= $cat['idKucing'] ?>"
        onclick="goToDetail(<?= $cat['idKucing'] ?>)">
        <div class="petCardImage">
          <img
            src="<?= BASE_URL ?>images/<?= htmlspecialchars($cat['fotoKucing']) ?>"
            alt="<?= htmlspecialchars($cat['namaKucing']) ?>">
        </div>
        <div class="petCardContent">
          <div class="petCardName">
            <?= htmlspecialchars($cat['namaKucing']) ?>
          </div>
          <div class="petCardType">
            <?= htmlspecialchars($cat['jenisKucing']) ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

</section>

<!-- Service Section -->
<section class="service-adoptPaw reveal" id="service">
  <div class="serviceContainer">
    <div class="serviceImage adoptPaw">
      <img src="<?= BASE_URL ?>images/adoptPaw-img.png" alt="">
    </div>
    <div class="serviceContent">
      <h2 class="serviceTitle">
        Temukan kucing impianmu dan biarkan kasih tumbuh dari tatapan pertama.
      </h2>
      <div class="serviceLinks">
        <a href="<?= BASE_URL ?>adoptPaw.php" class="serviceLink">Try AdoptPaw →</a>
      </div>
    </div>
  </div>
</section>

<!-- Care Section -->
<section class="care reveal">
  <h2 class="careTitle">Love, Feed, Play — The Art of Cat Care</h2>
  <div class="careGrid">
    <div class="careCard">
      <div class="careCardImage">
        <img src="<?= BASE_URL ?>images/feed.jpg" alt="">
      </div>
      <div class="careCardText">Beri Makan Tempat Waktu</div>
    </div>
    <div class="careCard">
      <div class="careCardImage">
        <img src="<?= BASE_URL ?>images/health.jpg" alt="">
      </div>
      <div class="careCardText">Cek Kesehatan Secara Rutin</div>
    </div>
    <div class="careCard">
      <div class="careCardImage">
        <img src="<?= BASE_URL ?>images/play.png" alt="">
      </div>
      <div class="careCardText">Ajak Bermain Tiap Hari</div>
    </div>
    <div class="careCard">
      <div class="careCardImage">
        <img src="<?= BASE_URL ?>images/clean.jpg" alt="">
      </div>
      <div class="careCardText">Rawat Bulu & Kesehatan Bulu</div>
    </div>
    <div class="careCard">
      <div class="careCardImage">
        <img src="<?= BASE_URL ?>images/shit.jpg" alt="">
      </div>
      <div class="careCardText">Latih Buang Air di Tempatnya</div>
    </div>
  </div>
</section>
<script>
  const BASE_URL = "<?= BASE_URL ?>";
  function goToDetail(id) {
    window.location.href = BASE_URL + "detailPaw.php?id=" + id;
  }
</script>

<?php
include __DIR__ . "/views/layouts/footer.php"
?>