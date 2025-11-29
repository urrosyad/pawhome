<?php
require_once "app/config.php";      
include "views/layouts/header.php";
include "views/layouts/navbar.php";
// include "app/db.php"
?>
    <!-- Contact Form -->
    <section class="contactSection">
      <p>
        Punya ide, pertanyaan, atau sekadar ingin menyapa? Tinggalkan pesanmu di
        bawah miaw~
      </p>
      <div id="notif"></div>
      <form id="contactForm">
        <input type="text" id="nama" placeholder="Nama" />
        <input type="email" id="email" placeholder="Email Address" />
        <textarea id="pesan" placeholder="Pesan"></textarea>
        <button type="submit">Send Message</button>
      </form>
    </section>


    <script>
      const form = document.getElementById("contactForm");
      const notif = document.getElementById("notif");

      form.addEventListener("submit", function (event) {
        event.preventDefault(); // Mencegah reload halaman

        // Ambil nilai input
        const nama = document.getElementById("nama").value.trim();
        const email = document.getElementById("email").value.trim();
        const pesan = document.getElementById("pesan").value.trim();

        // Reset tampilan notifikasi
        notif.textContent = "";
        notif.className = ""; // hapus class lama

        // Validasi input kosong
        if (nama === "" || email === "" || pesan === "") {
          notif.textContent = "😿 Miaww~ sepertinya ada yang lupa diisi, nih!";
          notif.classList.add("notif", "error");
        } else {
          notif.textContent =
            "🐾 Miaw~ Pesanmu sudah nyampe di pangkuan admin PawHome!";
          notif.classList.add("notif", "success");
          form.reset(); // kosongkan form
        }

        // Tampilkan notifikasi dengan animasi muncul
        notif.style.opacity = "1";
        notif.style.transform = "translateY(0)";

        if (notif.classList.contains("success")) {
          setTimeout(() => {
          notif.style.opacity = "0";
          notif.style.transform = "translateY(10px)";
          setTimeout(() => {
            notif.textContent = "";
            notif.className = "";
          }, 400);
        }, 3000);
        }});
    </script>

<?php 
include "views/layouts/footer.php";
?>