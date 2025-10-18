// SEMUA HALAMAN
// Untuk blur navbar scroll effect
window.addEventListener("scroll", () => {
  const navbar = document.querySelector(".navbar");
  if (window.scrollY > 50) {
    navbar.classList.add("scrolled");
  } else {
    navbar.classList.remove("scrolled");
  }
});

// Mengaktifkan link navbar sesuai halaman yang dikunjungi
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

// HAMBURGER NAVBAR 
const hamburger = document.getElementById('hamburger');
const navMenu = document.getElementById('navMenu');

hamburger.addEventListener('click', () => {
  hamburger.classList.toggle('active');
  navMenu.classList.toggle('active');
});


// SCROLL REVEAL ANIMATION
const reveals = document.querySelectorAll(".reveal, .reveal-left, .reveal-right");

const observer = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("active");
        observer.unobserve(entry.target); // biar tidak terus diamati
      }
    });
  },
  { threshold: 0.1 } // elemen aktif saat 10% terlihat
);

reveals.forEach((el) => observer.observe(el));


// HALAMAN HOME
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



// HALAMAN CONTACT
// Ambil elemen form dan area notifikasi
  const form = document.getElementById('contactForm');
  const notif = document.getElementById('notif');

  form.addEventListener('submit', function(event) {
    event.preventDefault(); // Mencegah reload halaman

    // Ambil nilai input
    const nama = document.getElementById('nama').value.trim();
    const email = document.getElementById('email').value.trim();
    const pesan = document.getElementById('pesan').value.trim();

    // Reset tampilan notifikasi
    notif.textContent = '';
    notif.className = ''; // hapus class lama

    // Validasi input kosong
    if (nama === '' || email === '' || pesan === '') {
      notif.textContent = '😿 Miaww~ sepertinya ada yang lupa diisi, nih!';
      notif.classList.add('notif', 'error');
    } else {
      notif.textContent = '🐾 Miaw~ Pesanmu sudah nyampe di pangkuan admin PawHome!';
      notif.classList.add('notif', 'success');
      form.reset(); // kosongkan form
    }

    // Tampilkan notifikasi dengan animasi muncul
    notif.style.opacity = '1';
    notif.style.transform = 'translateY(0)';

    // Hilangkan otomatis setelah 3 detik
    setTimeout(() => {
      notif.style.opacity = '0';
      notif.style.transform = 'translateY(10px)';
      setTimeout(() => {
        notif.textContent = '';
        notif.className = '';
      }, 400);
    }, 3000);
  });