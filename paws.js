const cats = [
  {
    name: "Michi",
    type: "Sphynk",
    img: "./images/Mici.png",
    color: "#ffe4e1",
    owner: "Kak Rani",
    gender: "Jantan",
    description: "Michi adalah kucing tanpa bulu yang ramah dan penuh rasa ingin tahu. Ia sangat suka bermain di tempat hangat dan suka dielus di kepala.",
    favoriteFood: "Ikan salmon kukus",
    favoriteToy: "Bola wol merah"
  },
  {
    name: "Oyen",
    type: "Domestic Shorthair",
    img: "./images/Oyen.png",
    color: "#fff7d1",
    owner: "Mas Dimas",
    gender: "Jantan",
    description: "Kucing oranye yang super aktif dan manja. Oyen suka berlarian di rumah dan selalu mendekati siapa pun yang membawa makanan.",
    favoriteFood: "Whiskas rasa tuna",
    favoriteToy: "Tali rafia"
  },
  {
    name: "Luna",
    type: "Domestic Shorthair",
    img: "./images/Luna.png",
    color: "#e5f7ff",
    owner: "Mbak Nia",
    gender: "Betina",
    description: "Luna adalah kucing tenang dan penyayang, cocok untuk keluarga yang ingin peliharaan yang kalem dan mudah dirawat.",
    favoriteFood: "Ayam rebus tanpa bumbu",
    favoriteToy: "Boneka kecil berbentuk tikus"
  },
  {
    name: "Mochi",
    type: "Exotic Shorthair",
    img: "./images/Mochi.png",
    color: "#f9eaff",
    owner: "Kak Rafi",
    gender: "Betina",
    description: "Mochi suka tidur siang dan punya wajah bulat menggemaskan. Dia gampang akrab dengan orang baru dan kucing lainnya.",
    favoriteFood: "Dry food premium",
    favoriteToy: "Mainan berbulu"
  },
  {
    name: "Moko",
    type: "American Shorthair",
    img: "./images/Moko.png",
    color: "#eafff1",
    owner: "Bu Lilis",
    gender: "Jantan",
    description: "Moko punya kepribadian yang lembut dan sangat pintar. Ia suka bermain puzzle treat dan mudah dilatih.",
    favoriteFood: "Daging ayam cincang",
    favoriteToy: "Laser pointer"
  },
  {
    name: "Neko",
    type: "Tuxedo Cat",
    img: "./images/Neko.png",
    color: "#fff0d9",
    owner: "Kak Arga",
    gender: "Jantan",
    description: "Kucing dengan bulu hitam putih ini suka tampil elegan. Ia memiliki kebiasaan unik: tidur di dekat laptop yang hangat.",
    favoriteFood: "Sarden kaleng",
    favoriteToy: "Karet gelang"
  },
  {
    name: "Pumpkin",
    type: "Persia",
    img: "./images/Pumpkin.png",
    color: "#f7e1e1",
    owner: "Mbak Vina",
    gender: "Betina",
    description: "Pumpkin adalah kucing Persia manja yang suka disisir dan dimanja setiap pagi. Ia tidak suka suara keras tapi sangat lembut terhadap anak-anak.",
    favoriteFood: "Wet food rasa salmon",
    favoriteToy: "Feather wand"
  },
  {
    name: "Smokey",
    type: "British Shorthair",
    img: "./images/Smokey.png",
    color: "#e1f0ff",
    owner: "Mas Edo",
    gender: "Jantan",
    description: "Smokey berkarakter tenang dan suka duduk di jendela sambil melihat burung. Bulunya tebal dan lembut seperti awan.",
    favoriteFood: "Kibble rasa ayam",
    favoriteToy: "Mainan tikus berbunyi"
  },
  {
    name: "Roro",
    type: "Ragdoll",
    img: "./images/Roro.png",
    color: "#e1f0ff",
    owner: "Bu Rika",
    gender: "Betina",
    description: "Roro adalah kucing dengan sifat lembut dan suka dipeluk. Ia sering mengikuti pemiliknya ke mana pun.",
    favoriteFood: "Daging sapi rebus",
    favoriteToy: "Gantungan kunci berbulu"
  },
  {
    name: "Cimo",
    type: "Calico Shorthair",
    img: "./images/Cimo.png",
    color: "#e1f0ff",
    owner: "Mas Farel",
    gender: "Betina",
    description: "Cimo memiliki corak bulu tiga warna yang cantik dan suka duduk di pangkuan orang. Ia sangat bersih dan suka menjilati kakinya.",
    favoriteFood: "Snack kucing rasa keju",
    favoriteToy: "Bola kecil berlonceng"
  }
];


// HALAMAN ADOPTPAW 
const container = document.getElementById("petContainer");
const loadMoreBtn = document.getElementById("loadMoreBtn");

let visiblePets = 6; // tampilkan 8 awal

function renderPets() {
  container.innerHTML = "";
  cats.slice(0, visiblePets).forEach((pet) => {
    const card = document.createElement("div");
    card.classList.add("pet-card");
    card.style.setProperty("--card-color", pet.color);

    card.innerHTML = `
      <img src="${pet.img}" alt="${pet.name}">
      <div class="pet-info">
        <h3 class="pet-name">${pet.name}</h3>
        <p class="pet-type">${pet.type}</p>
        <button class="detailBtn">Lihat Detail</button>
      </div>
    `;

    const btn = card.querySelector(".detailBtn");
    btn.addEventListener("click", () => {
        localStorage.setItem("selectedCat", JSON.stringify(pet));
        window.location.href = "detailPaw.html";
    });

    container.appendChild(card);
    // document.body.appendChild(ca rd);
    
    // card.querySelector(".btn").addEventListener("click", () => {
        // localStorage.setItem("selectedCat", JSON.stringify(cat));
        // window.location.href = "detailPaw.html";
    //   });
  });

  if (visiblePets >= cats.length) {
    loadMoreBtn.style.display = "none";
  }
}

renderPets();

loadMoreBtn.addEventListener("click", () => {
  visiblePets += 4;
  renderPets();
});
