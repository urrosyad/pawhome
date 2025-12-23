<?php
require_once  __DIR__ . "/app/config.php";
require_once __DIR__ . "/app/db.php";
include __DIR__ . "/views/layouts/header.php";
include __DIR__ . "/views/layouts/navbar.php";
require_once __DIR__ . '/controllers/CatsController.php';
require_once __DIR__ . '/controllers/PenitipanController.php';
validateSession($pdo);

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
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
<section class="openPawContainer">
  <div class="openPawSection">
    <h2>🐾 Beri Rumah Baru untuk Kucing Kamu</h2>
    <p>
      Punya kucing yang ingin kamu titipkan untuk diadopsi? Isi form di bawah
      ini, dan biarkan kucingmu menemukan rumah barunya yang penuh kasih miaw~
    </p>

<?php if ($successMessage): ?>
<script>
    alert("<?= $successMessage ?>");
    window.location.href = "index.php";
</script>
<?php endif; ?>


    <form id="openPawForm"  method="POST" enctype="multipart/form-data">
<!-- <form action="openPaw_submit.php" method="POST" enctype="multipart/form-data"> -->
    <div class="form-group">
        <label for="pemilik">Nama Pemilik</label>
        <input type="text" id="pemilik" name="pemilik" placeholder="Contoh: Rosyad Al Fikri" />
      </div>

      <div class="form-group">
        <label for="email">Email / Kontak</label>
        <input type="email" id="email" name="email" placeholder="Contoh: rosyad@gmail.com" />
      </div>

      <div class="form-group">
        <label for="namaKucing">Nama Kucing</label>
        <input type="text" id="namaKucing" name="namaKucing" placeholder="Contoh: Miko" />
      </div>

      <div class="form-group">
        <label for="usia">Usia Kucing</label>
        <input type="text" id="usia" name="usia" placeholder="Contoh: 2 tahun" />
      </div>

      <div class="form-group">
        <label for="gender">Jenis Kelamin</label>
        <select id="gender" name="gender">
          <option value="">Pilih jenis kelamin</option>
          <option value="Jantan">Jantan</option>
          <option value="Betina">Betina</option>
        </select>
      </div>

      <div class="form-group">
        <label for="ras">Ras / Jenis Kucing</label>
        <input type="text" id="ras" name="ras" placeholder="Contoh: Persian" />
      </div>

      <div class="form-group">
        <label for="deskripsi">Deskripsi Singkat</label>
        <textarea
          id="deskripsi"
          name="deskripsi"
          placeholder="Ceritakan sedikit tentang kucingmu..."></textarea>
      </div>

      <div class="form-group">
        <label for="makananFav">Makanan Favorit</label>
        <input type="text" id="makananFav" name="makananFav" placeholder="Contoh: Whiskas" />
      </div>

      <div class="form-group">
        <label for="mainanFav">Mainan Favorit</label>
        <input type="text" id="mainanFav" name="mainanFav" placeholder="Contoh: Bola karet" />
      </div>

      <div class="form-group">
        <label for="alasanPenyerahan">Alasan Penyerahan</label>
        <textarea id="alasanPenyerahan" name="alasanPenyerahan" placeholder="Kenapa kamu ingin menitipkan kucing ini?"></textarea>
      </div>

      <div class="form-group">
        <label for="foto">Foto Kucing</label>
        <input type="file" id="foto" name="foto" accept="image/*" />
        <div id="previewContainer"></div>
      </div>

      <button type="submit">Kirim Formulir</button>
    </form>

  </div>

</section>

<?php
include __DIR__ . "/views/layouts/footer.php"
?>    
<script src="main.js"></script>
</body>

</html>