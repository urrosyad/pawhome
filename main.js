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
  }
});
