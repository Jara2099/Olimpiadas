
document.addEventListener("DOMContentLoaded", () => {
    const menubtn = document.getElementById("menu-btn");
    const sidemenu = document.getElementById("sidemenu");

    menubtn.addEventListener("click", () => {
        sidemenu.classList.toggle("menu-collapsed");
        sidemenu.classList.toggle("menu-expanded");
        event.stopPropagation();
    });

    document.addEventListener("click", (event) => {
        const clickfueramenu = !sidemenu.contains(Event.Target) && !menubtn.contains(Event.Event);
        if (clickfueramenu && sidemenu.classList.contains("menu-expanded")) {
            sidemenu.classList.remove("menu-expanded");
            sidemenu.classList.add("menu-collapsed");
        };
    });
});

const cardsdata = {
  1: {
    titulo: "Bahía de Ha Long, Vietnam",
    descripcionDetallada: `La Bahía de Ha Long, ubicada en el norte de Vietnam, es reconocida mundialmente por su espectacular paisaje kárstico formado por miles de islotes de piedra caliza que emergen del mar color esmeralda...`,
    imagen: "img/BahíaVietnam.jpg",
    actividades: [
      "Navegación en barco tradicional",
      "Exploración de cuevas",
      "Kayak entre islotes",
      "Visita a pueblos flotantes"
    ],
    ubicacion: "Provincia de Quang Ninh, Vietnam",
    clima: "Subtropical húmedo, mejor época de octubre a abril",
    accesibilidad: "Desde Hanoi en 3-4 horas en auto o bus",
    consejos: [
      "Llevar ropa ligera y protección solar",
      "Reservar con anticipación",
      "Repelente de insectos"
    ],
    precioEntrada: "Costo de tour entre $50 y $150 USD"
  },
  2: {
    titulo: "Cataratas del Iguazú, Argentina y Brasil",
    descripcionDetallada: `Maravilla natural del mundo que cuenta con más de 250 saltos de agua, rodeados por una densa selva tropical...`,
    imagen: "img/CataratasArgentina.jpg",
    actividades: [
      "Paseos en lancha",
      "Senderos ecológicos",
      "Visitas a miradores",
      "Turismo de aventura"
    ],
    ubicacion: "Misiones, Argentina y Paraná, Brasil",
    clima: "Subtropical húmedo, ideal de marzo a septiembre",
    accesibilidad: "Desde Puerto Iguazú o Foz do Iguaçu",
    consejos: [
      "Llevar ropa impermeable",
      "Proteger dispositivos electrónicos",
      "Ir temprano para evitar multitudes"
    ],
    precioEntrada: "Desde $15 USD, tarifas diferenciales según nacionalidad"
  },
  3: {
    titulo: "Costa de Alabastro, Francia",
    descripcionDetallada: `Famosa por sus impresionantes acantilados blancos que contrastan con el azul del mar y el cielo normando...`,
    imagen: "img/CostaFrancia.jpg",
    actividades: [
      "Senderismo costero",
      "Fotografía",
      "Paseos en barco",
      "Visita a Étretat"
    ],
    ubicacion: "Normandía, Francia",
    clima: "Templado oceánico, mejor entre mayo y septiembre",
    accesibilidad: "Desde París en 2-3 horas en auto o tren",
    consejos: [
      "Llevar abrigo aunque sea verano",
      "Caminar con precaución en los acantilados",
      "Consultar marea antes de excursiones"
    ],
    precioEntrada: "Acceso gratuito a playas y acantilados"
  },
  4: {
    titulo: "Costa de Napali, Kauai - Hawái",
    descripcionDetallada: `Una de las costas más vírgenes y espectaculares del mundo, solo accesible por barco, helicóptero o largas caminatas...`,
    imagen: "img/CuevasPortugal.jpg",
    actividades: [
      "Senderismo por el Kalalau Trail",
      "Excursiones en barco",
      "Snorkel",
      "Sobrevuelo en helicóptero"
    ],
    ubicacion: "Isla de Kauai, Hawái",
    clima: "Tropical húmedo todo el año",
    accesibilidad: "Vía barco o caminatas largas",
    consejos: [
      "Planificar con anticipación, difícil acceso",
      "Llevar provisiones suficientes",
      "Evitar temporada de lluvias"
    ],
    precioEntrada: "Tour en barco desde $100 USD"
  },
  5: {
    titulo: "Cuevas de Benagil, Portugal",
    descripcionDetallada: `Un famoso sistema de grutas marinas con una cúpula natural abierta al cielo, ubicado en el Algarve...`,
    imagen: "img/Cuevas de Benagil, Portugal.jpg",
    actividades: [
      "Kayak",
      "Stand-up paddle",
      "Paseos en bote"
    ],
    ubicacion: "Algarve, Portugal",
    clima: "Mediterráneo cálido, ideal en verano",
    accesibilidad: "Desde Faro en coche en 1 hora",
    consejos: [
      "Evitar días con marea alta",
      "Llevar chaleco salvavidas",
      "Reservar tours con anticipación"
    ],
    precioEntrada: "Depende del tour ($20-$50 EUR)"
  },
  6: {
    titulo: "Delta del Okavango, Botswana - África",
    descripcionDetallada: `Uno de los deltas interiores más grandes del mundo, hogar de una rica biodiversidad africana...`,
    imagen: "img/Delta del Okavango, Botswana - África.jpg",
    actividades: [
      "Safaris en mokoro (canoa)",
      "Avistamiento de animales",
      "Caminatas guiadas"
    ],
    ubicacion: "Botswana",
    clima: "Semiárido, mejor entre mayo y octubre",
    accesibilidad: "Desde Maun en avioneta o vehículo 4x4",
    consejos: [
      "Llevar binoculares",
      "Reservar con guías certificados",
      "Vacunarse contra fiebre amarilla"
    ],
    precioEntrada: "Entrada al parque más costo del safari ($150+ USD)"
  },
  7: {
    titulo: "Desierto de Namib - Namibia, Angola y Sudáfrica",
    descripcionDetallada: `El desierto más antiguo del mundo, con dunas rojizas y paisajes surrealistas...`,
    imagen: "img/Desierto de Namib - Namibia, Angola y Sudáfrica.jpg",
    actividades: [
      "Exploración de dunas",
      "Fotografía",
      "Tours en 4x4"
    ],
    ubicacion: "Costa sudoeste de África",
    clima: "Árido, extremos térmicos",
    accesibilidad: "Desde Windhoek por carretera",
    consejos: [
      "Evitar horas de sol extremo",
      "Llevar agua y gorra",
      "Protección solar obligatoria"
    ],
    precioEntrada: "Desde $10 USD por persona"
  },
  8: {
    titulo: "Capadocia, Turquía",
    descripcionDetallada: `Paisajes lunares, ciudades subterráneas y famosos paseos en globo aerostático...`,
    imagen: "img/Capadocia, Turquía.jpg",
    actividades: [
      "Vuelos en globo",
      "Visita a valles y chimeneas de hadas",
      "Exploración de ciudades subterráneas"
    ],
    ubicacion: "Anatolia Central, Turquía",
    clima: "Continental seco, frío en invierno",
    accesibilidad: "Desde Estambul vía avión a Kayseri o Nevşehir",
    consejos: [
      "Reservar el globo con anticipación",
      "Llevar calzado cómodo",
      "Visitar fuera del verano si buscás tranquilidad"
    ],
    precioEntrada: "Tours desde $80 USD, globos desde $150 USD"
  }
};

function getParam(param) {
  const params = new URLSearchParams(window.location.search);
  return params.get(param);
}

function mostrardetalle(id) {
  const data = cardsdata[id];
  if (!data) {
    document.getElementById("titulo").textContent = "Destino no encontrado";
    return;
  }

  document.getElementById("titulo").textContent = data.titulo;
  document.getElementById("imagen").src = data.imagen;
  document.getElementById("imagen").alt = data.titulo;
  document.getElementById("imagen").style.display = "block";
  document.getElementById("descripciondetallada").textContent = data.descripcionDetallada;

  const lista = document.getElementById("listaactividades");
  lista.innerHTML = "";
  data.actividades.forEach(item => {
    const li = document.createElement("li");
    li.className = "list-group-item";
    li.textContent = item;
    lista.appendChild(li);
  });

  document.getElementById("ubicacion").textContent = data.ubicacion || "";
  document.getElementById("clima").textContent = data.clima || "";
  document.getElementById("accesibilidad").textContent = data.accesibilidad || "";

  const consejos = document.getElementById("consejos");
  consejos.innerHTML = "";
  (data.consejos || []).forEach(item => {
    const li = document.createElement("li");
    li.className = "list-group-item";
    li.textContent = item;
    consejos.appendChild(li);
  });

  document.getElementById("precioEntrada").textContent = data.precioEntrada || "";
}


window.onload = () => {
  const id = getParam("id");
  if (id && cardsdata[id]) {
    mostrardetalle(id);
  } else {
    document.getElementById("titulo").textContent = "No se encontró el destino";
  }
};