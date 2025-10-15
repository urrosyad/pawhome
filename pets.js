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
];

// ambil container
const petsGrid = document.getElementById("petsGrid");

// generate otomatis isi card
pets.forEach((pet, index) => {
  const card = document.createElement("div");
  card.classList.add("petCard");
  card.setAttribute("data-number", String(index + 1).padStart(2, "0"));
  card.style.setProperty("--card-color", pet.color);

  card.innerHTML = `
    <div class="petCardImage">
      <img src="${pet.img}" alt="${pet.name}" />
    </div>
    <div class="petCardContent">
      <div class="petCardName">${pet.name}</div>
      <div class="petCardType">${pet.type}</div>
    </div>
  `;

  petsGrid.appendChild(card);
});
