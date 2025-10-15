
const form = document.getElementById('contactForm');
const notif = document.getElementById('notif');

form.addEventListener('submit', (event) => {
  event.preventDefault(); // Cegah reload halaman

  const name = document.getElementById('name').value.trim();
  const email = document.getElementById('email').value.trim();
  const message = document.getElementById('message').value.trim();

  // Reset notifikasi sebelumnya
  notif.textContent = '';
  notif.style.color = '';

  // Validasi input kosong
  if (name === '' || email === '' || message === '') {
    notif.textContent = 'Semua kolom wajib diisi!';
    notif.style.color = 'red';
  } else {
    notif.textContent = 'Pesan berhasil dikirim!';
    notif.style.color = 'green';
    form.reset(); // Kosongkan form setelah kirim
  }});

      // Untuk blur navbar scroll effect
      window.addEventListener("scroll", () => {
        const navbar = document.querySelector(".navbar");
        if (window.scrollY > 50) {
          navbar.classList.add("scrolled");
        } else {
          navbar.classList.remove("scrolled");
        }
      });
      
      // Smooth scrolling for navigation links
      document.querySelectorAll(".navLink").forEach((link) => {
        link.addEventListener("click", function (e) {
          e.preventDefault();
          const targetId = this.getAttribute("href");
          const targetSection = document.querySelector(targetId);

          if (targetSection) {
            targetSection.scrollIntoView({
              behavior: "smooth",
              block: "start",
            });
          }
        });
      });

      // Mengaktifkan link navbar sesuai halaman yang dikunjingi
      window.addEventListener("scroll", function () {
        const sections = document.querySelectorAll("section[id]");
        const navLinks = document.querySelectorAll(".navLink");

        let currentSection = "";

        sections.forEach((section) => {
          const sectionTop = section.offsetTop;
          const sectionHeight = section.clientHeight;

          if (pageYOffset >= sectionTop - 100) {
            currentSection = section.getAttribute("id");
          }
        });

        navLinks.forEach((link) => {
          link.style.color = "";
          if (link.getAttribute("href") === `#${currentSection}`) {
            link.style.color = "#ff6b6b";
          }
        });
      });

      // Tambah animasi setiap cards muncul
      const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px",
      };

const observer = new IntersectionObserver(function (entries) {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add("show");
    }
  });
}, observerOptions);

document.querySelectorAll(".petCard, .careCard, .categoryItem").forEach((card) => {
  card.classList.add("hidden");
  observer.observe(card);
});

// STYLING MOUSE ENTER TITLE CHANGE COLOUR
const title = document.getElementById("colorfulTitle");
const text = title.textContent;
title.textContent = ""; // Kosongkan dulu isi h1

// Pisahkan setiap huruf dan bungkus dalam <span>
text.split("").forEach((char) => {
  const span = document.createElement("span");

  // Jika karakter adalah spasi, tampilkan &nbsp; supaya tidak hilang
  span.innerHTML = char === " " ? "&nbsp;" : char;

  title.appendChild(span);

  // Warna acak setiap kali disentuh
  span.addEventListener("mouseenter", () => {
    const randomColor = `hsl(${Math.random() * 360}, 80%, 60%)`;
    span.style.color = randomColor;
  });

  // Kembalikan warna semula saat mouse keluar
  span.addEventListener("mouseleave", () => {
    span.style.color = "#901C41";
  });
});
