<?php 
require_once 'app/config.php';
include 'views/layouts/header.php';
include 'views/layouts/navbar.php';
?>

    <div class="detailContainer" id="catDetail"></div>

    <script>
      const cat = JSON.parse(localStorage.getItem("selectedCat"));
      const container = document.getElementById("catDetail");

      if (!cat) {
        container.innerHTML = "<p>😿 Data kucing tidak ditemukan.</p>";
      } else {
        container.innerHTML = `
        <div class="detailPaw">
          <h2>${cat.name}</h2>
          <p><b>Jenis:</b> ${cat.type}</p>
          <p><b>Pemilik:</b> ${cat.owner}</p>
          <p><b>Jenis Kelamin:</b> ${cat.gender}</p>
          <p><b>Deskripsi:</b> ${cat.description}</p>
          <p><b>Makanan Kesukaan:</b> ${cat.favoriteFood}</p>
          <p><b>Mainan Favorit:</b> ${cat.favoriteToy}</p>
          <button class="adoptBtn">Adopsi Sekarang</button>
        </div>
        <div class="catImg">
          <img src="${cat.img}" alt="${cat.name}">
        </div>
      `;
      }
      
      document.querySelector(".adoptBtn").addEventListener("click", () => {
      alert(`Selamat! Kamu telah mengadopsi ${cat.name} 🐾`);
      window.location.href = "index.html"; // kembali ke halaman home
      });
    </script>
    <script src="paws.js"></script>
    <script src="main.js"></script>
  </body>
</html>
