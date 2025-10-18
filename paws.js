const pets = [
  {
    name: "Michi",
    type: "Sphynk",
    img: "./images/Mici.png",
    color: "#ffe4e1",
  },
  {
    name: "Oyen",
    type: "Domestic Shorthair",
    img: "./images/Oyen.png",
    color: "#fff7d1",
  },
  {
    name: "Luna",
    type: "Domestic Shorthair",
    img: "./images/Luna .png",
    color: "#e5f7ff",
  },
  {
    name: "Mochi",
    type: "Exotic Shorthair",
    img: "./images/Mochi.png",
    color: "#f9eaff",
  },
  {
    name: "Moko",
    type: "American Shorthair",
    img: "./images/Moko.png",
    color: "#eafff1",
  },
  {
    name: "Neko",
    type: "Tuxedo Cat",
    img: "./images/Neko.png",
    color: "#fff0d9",
  },
  {
    name: "Pumpkin",
    type: "Persia",
    img: "./images/Pumpkin.png",
    color: "#f7e1e1",
  },
  {
    name: "Smokey",
    type: "Biritish Shorthair",
    img: "./images/Smokey.png",
    color: "#e1f0ff",
  },
  {
    name: "Roro",
    type: "Ragdoll",
    img: "./images/Roro.png",
    color: "#e1f0ff",
  },
  {
    name: "Cimo",
    type: "Callico Shorthair",
    img: "./images/Cimo.png",
    color: "#e1f0ff",
  },
];

// HALAMAN ADOPTPAW 
const container = document.getElementById("petContainer");
const loadMoreBtn = document.getElementById("loadMoreBtn");

let visiblePets = 6; // tampilkan 8 awal

function renderPets() {
  container.innerHTML = "";
  pets.slice(0, visiblePets).forEach((pet) => {
    const card = document.createElement("div");
    card.classList.add("pet-card");
    card.style.setProperty("--card-color", pet.color);

    card.innerHTML = `
      <img src="${pet.img}" alt="${pet.name}">
      <div class="pet-info">
        <h3 class="pet-name">${pet.name}</h3>
        <p class="pet-type">${pet.type}</p>
        <button class="adopt-btn">Mulai Adopsi</button>
      </div>
    `;

    const btn = card.querySelector(".adopt-btn");
    btn.addEventListener("click", () => {
      alert(`Kamu telah memilih ${pet.name} untuk diadopsi! 🐱`);
      btn.classList.add("adopted");
      btn.textContent = "Sudah Diadopsi";
    });

    container.appendChild(card);
  });

  if (visiblePets >= pets.length) {
    loadMoreBtn.style.display = "none";
  }
}

renderPets();

loadMoreBtn.addEventListener("click", () => {
  visiblePets += 4;
  renderPets();
});
