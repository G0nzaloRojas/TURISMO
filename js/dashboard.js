// Variables globales
let currentCategory = "restaurantes";
let editingId = null;
let businesses = [];

// Inicializar la aplicación
document.addEventListener("DOMContentLoaded", function () {
  loadComboData();
  loadBusinesses();
});

// Cargar datos para combos
async function loadComboData() {
  try {
    // Cargar tipos de comida
    const responseTipos = await fetch("api/business.php?action=getTiposComida");
    const dataTipos = await responseTipos.json();

    if (dataTipos.success) {
      const selectComida = document.getElementById("tipoComida");
      selectComida.innerHTML = '<option value="">Seleccionar tipo</option>';
      dataTipos.data.forEach((tipo) => {
        selectComida.innerHTML += `<option value="${tipo.ID}">${tipo.DESCRIPCION}</option>`;
      });
    }

    // Cargar actividades
    const responseActividades = await fetch(
      "api/business.php?action=getActividades"
    );
    const dataActividades = await responseActividades.json();

    if (dataActividades.success) {
      const selectActividad = document.getElementById("actividad");
      selectActividad.innerHTML =
        '<option value="">Seleccionar actividad</option>';
      dataActividades.data.forEach((actividad) => {
        selectActividad.innerHTML += `<option value="${actividad.ID}">${actividad.DESCRIPCION}</option>`;
      });
    }
  } catch (error) {
    console.error("Error loading combo data:", error);
  }
}

// Cargar negocios
async function loadBusinesses() {
  try {
    showLoading(true);
    const response = await fetch(
      `api/business.php?action=getAll&category=${currentCategory}`
    );
    const data = await response.json();

    if (data.success) {
      businesses = data.data;
      renderBusinesses();
      updateBusinessCount();
    } else {
      showError("Error al cargar los negocios: " + data.message);
    }
  } catch (error) {
    console.error("Error loading businesses:", error);
    showError("Error al cargar los negocios");
  } finally {
    showLoading(false);
  }
}

// Mostrar/ocultar loading
function showLoading(show) {
  document.getElementById("loading").style.display = show ? "block" : "none";
  document.getElementById("businessGrid").style.display = show
    ? "none"
    : "grid";
}

// Alternar sidebar en móvil
function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  sidebar.classList.toggle("open");
}

// Cambiar categoría
document.getElementById("projectList").addEventListener("click", function (e) {
  const item = e.target.closest(".project-item");
  if (item) {
    // Remover active de todos los items
    document
      .querySelectorAll(".project-item")
      .forEach((i) => i.classList.remove("active"));
    // Agregar active al item clickeado
    item.classList.add("active");

    currentCategory = item.dataset.project;
    const categoryNames = {
      restaurantes: "Restaurantes",
      hoteles: "Hoteles",
      alquiler: "Alquileres",
      puntos_interes: "Puntos de Interés",
    };
    document.getElementById(
      "projectTitle"
    ).textContent = `Categoría: ${categoryNames[currentCategory]}`;
    loadBusinesses();
  }
});

// Renderizar negocios
function renderBusinesses() {
  const grid = document.getElementById("businessGrid");

  if (businesses.length === 0) {
    grid.innerHTML = `
                    <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: #666;">
                        <i class="fas fa-store" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;"></i>
                        <p>No hay negocios en esta categoría</p>
                        <button class="add-task-btn" onclick="openBusinessModal()" style="margin-top: 1rem;">
                            <i class="fas fa-plus"></i> Agregar Primer Negocio
                        </button>
                    </div>
                `;
    return;
  }

  grid.innerHTML = businesses
    .map((business) => createBusinessCard(business))
    .join("");
}

// Crear tarjeta de negocio
function createBusinessCard(business) {
  let info = "";
  let icon = "";

  switch (currentCategory) {
    case "restaurantes":
      icon = "utensils";
      info = `
                        <div class="business-info">
                            ${
                              business.TIPO_COMIDA
                                ? `<div class="info-item"><i class="fas fa-tag"></i> ${business.TIPO_COMIDA}</div>`
                                : ""
                            }
                            ${
                              business["PRECIO MINIMO"]
                                ? `<div class="info-item"><i class="fas fa-dollar-sign"></i> ${business["PRECIO MINIMO"]} - ${business["PRECIO MAXIMO"]}</div>`
                                : ""
                            }
                        </div>
                    `;
      break;
    case "hoteles":
      icon = "bed";
      info = `
                        <div class="business-info">
                            <div class="info-item"><i class="fas fa-star"></i> ${
                              business.CALIFICACION
                            }/5</div>
                            <div class="info-item"><i class="fas fa-users"></i> ${
                              business.HUESPEDES
                            } huéspedes</div>
                            <div class="info-item"><i class="fas fa-dollar-sign"></i> ${
                              business.PRECIO_MINIMO
                            } - ${business.PRECIO_MAXIMO}</div>
                            ${
                              business.PILETA === "si"
                                ? '<div class="info-item"><i class="fas fa-swimming-pool"></i> Pileta</div>'
                                : ""
                            }
                            ${
                              business.DESAYUNO === "si"
                                ? '<div class="info-item"><i class="fas fa-coffee"></i> Desayuno</div>'
                                : ""
                            }
                        </div>
                    `;
      break;
    case "alquiler":
      icon = "home";
      info = `
                        <div class="business-info">
                            <div class="info-item"><i class="fas fa-star"></i> ${business.CALIFICACION}/10</div>
                            <div class="info-item"><i class="fas fa-bed"></i> ${business.DORMITORIOS} dorm, ${business.BANIOS} baños</div>
                            <div class="info-item"><i class="fas fa-ruler-combined"></i> ${business.METROS}m²</div>
                            <div class="info-item"><i class="fas fa-dollar-sign"></i> ${business.PRECIO_SEMANA}/semana</div>
                        </div>
                    `;
      break;
    case "puntos_interes":
      icon = "map-marked-alt";
      info = `
                        <div class="business-info">
                            ${
                              business.CALIFICACION
                                ? `<div class="info-item"><i class="fas fa-star"></i> ${business.CALIFICACION}/5</div>`
                                : ""
                            }
                            <div class="info-item"><i class="fas fa-tag"></i> ${
                              business.ACTIVIDAD
                            }</div>
                           <div class="info-item"><i class="fas fa-dollar-sign"></i> ${
                             business.PRECIO > 0 ? business.PRECIO : "Gratis"
                           }</div>
                        </div>
                    `;
      break;
  }

  return `
                <div class="business-card">
                    <h3 class="business-name">${business.NOMBRE}</h3>
                    <div class="business-type">
                        <i class="fas fa-${icon}"></i>
                        ${business.UBICACION}
                    </div>
                    <p class="business-description">${business.DESCRIPCION}</p>
                    ${info}
                    <div class="business-actions">
                        <button class="action-btn btn-edit" onclick="editBusiness(${business.ID})">
                            <i class="fas fa-edit"></i> Editar
                        </button>
                        <button class="action-btn btn-delete" onclick="deleteBusiness(${business.ID})">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </div>
                </div>
            `;
}

// Modal functions
function openBusinessModal(id = null) {
  const modal = document.getElementById("businessModal");
  const form = document.getElementById("businessForm");
  const title = document.getElementById("modalTitle");

  editingId = id;
  hideAllFields();
  showFieldsForCategory(currentCategory);

  if (id) {
    const business = businesses.find((b) => b.ID == id);
    title.textContent = "Editar Negocio";
    fillFormWithBusiness(business);
  } else {
    title.textContent = "Agregar Nuevo Negocio";
    form.reset();
    document.getElementById("businessCategory").value = currentCategory;
  }

  clearMessages();
  modal.style.display = "block";
}

function closeBusinessModal() {
  document.getElementById("businessModal").style.display = "none";
  editingId = null;
  clearMessages();
}

// Mostrar campos según categoría
function hideAllFields() {
  document.getElementById("restauranteFields").style.display = "none";
  document.getElementById("hotelFields").style.display = "none";
  document.getElementById("alquilerFields").style.display = "none";
  document.getElementById("puntosInteresFields").style.display = "none";
}

function showFieldsForCategory(category) {
  const fieldMap = {
    restaurantes: "restauranteFields",
    hoteles: "hotelFields",
    alquiler: "alquilerFields",
    puntos_interes: "puntosInteresFields",
  };

  if (fieldMap[category]) {
    document.getElementById(fieldMap[category]).style.display = "block";
  }
}

// Llenar formulario con datos del negocio
function fillFormWithBusiness(business) {
  document.getElementById("businessId").value = business.ID;
  document.getElementById("businessName").value = business.NOMBRE;
  document.getElementById("businessLocation").value = business.UBICACION;
  document.getElementById("businessDescription").value = business.DESCRIPCION;
  document.getElementById("businessCategory").value = currentCategory;

  switch (currentCategory) {
    case "restaurantes":
      if (business.ID_COMIDA)
        document.getElementById("tipoComida").value = business.ID_COMIDA;
      if (business["PRECIO MINIMO"])
        document.getElementById("precioMinimo").value =
          business["PRECIO MINIMO"];
      if (business["PRECIO MAXIMO"])
        document.getElementById("precioMaximo").value =
          business["PRECIO MAXIMO"];
      break;
    case "hoteles":
      if (business.PRECIO_MINIMO)
        document.getElementById("precioMinimoHotel").value =
          business.PRECIO_MINIMO;
      if (business.PRECIO_MAXIMO)
        document.getElementById("precioMaximoHotel").value =
          business.PRECIO_MAXIMO;
      if (business.CALIFICACION)
        document.getElementById("calificacion").value = business.CALIFICACION;
      if (business.HUESPEDES)
        document.getElementById("huespedes").value = business.HUESPEDES;
      if (business.PILETA)
        document.getElementById("pileta").value = business.PILETA;
      if (business.DESAYUNO)
        document.getElementById("desayuno").value = business.DESAYUNO;
      break;
    case "alquiler":
      if (business.PRECIO_SEMANA)
        document.getElementById("precioSemana").value = business.PRECIO_SEMANA;
      if (business.CALIFICACION)
        document.getElementById("calificacionAlquiler").value =
          business.CALIFICACION;
      if (business.BANIOS)
        document.getElementById("banios").value = business.BANIOS;
      if (business.DORMITORIOS)
        document.getElementById("dormitorios").value = business.DORMITORIOS;
      if (business.CAMAS_DOBLES)
        document.getElementById("camasDobles").value = business.CAMAS_DOBLES;
      if (business.CAMAS_SIMPLES)
        document.getElementById("camasSimples").value = business.CAMAS_SIMPLES;
      if (business.METROS)
        document.getElementById("metros").value = business.METROS;
      break;
    case "puntos_interes":
      if (business.ID_ACTIVIDAD)
        document.getElementById("actividad").value = business.ID_ACTIVIDAD;
      if (business.PRECIO)
        document.getElementById("precio").value = business.PRECIO;
      if (business.CALIFICACION)
        document.getElementById("calificacionPunto").value =
          business.CALIFICACION;
      break;
  }
}

// Form submission
document
  .getElementById("businessForm")
  .addEventListener("submit", async function (e) {
    e.preventDefault();

    const formData = new FormData();
    formData.append("action", editingId ? "update" : "create");
    formData.append("category", currentCategory);

    if (editingId) {
      formData.append("id", editingId);
    }

    // Campos comunes
    formData.append("nombre", document.getElementById("businessName").value);
    formData.append(
      "ubicacion",
      document.getElementById("businessLocation").value
    );
    formData.append(
      "descripcion",
      document.getElementById("businessDescription").value
    );

    // Campos específicos por categoría
    switch (currentCategory) {
      case "restaurantes":
        const tipoComida = document.getElementById("tipoComida").value;
        if (tipoComida) formData.append("id_comida", tipoComida);
        const precioMin = document.getElementById("precioMinimo").value;
        if (precioMin) formData.append("precio_minimo", precioMin);
        const precioMax = document.getElementById("precioMaximo").value;
        if (precioMax) formData.append("precio_maximo", precioMax);
        break;

      case "hoteles":
        formData.append(
          "precio_minimo",
          document.getElementById("precioMinimoHotel").value
        );
        formData.append(
          "precio_maximo",
          document.getElementById("precioMaximoHotel").value
        );
        formData.append(
          "calificacion",
          document.getElementById("calificacion").value
        );
        formData.append(
          "huespedes",
          document.getElementById("huespedes").value
        );
        formData.append("pileta", document.getElementById("pileta").value);
        formData.append("desayuno", document.getElementById("desayuno").value);
        break;

      case "alquiler":
        formData.append(
          "precio_semana",
          document.getElementById("precioSemana").value
        );
        formData.append(
          "calificacion",
          document.getElementById("calificacionAlquiler").value
        );
        formData.append("banios", document.getElementById("banios").value);
        formData.append(
          "dormitorios",
          document.getElementById("dormitorios").value
        );
        formData.append(
          "camas_dobles",
          document.getElementById("camasDobles").value
        );
        formData.append(
          "camas_simples",
          document.getElementById("camasSimples").value
        );
        formData.append("metros", document.getElementById("metros").value);
        break;

      case "puntos_interes":
        formData.append(
          "id_actividad",
          document.getElementById("actividad").value
        );
        formData.append("precio", document.getElementById("precio").value);
        const calificacionPunto =
          document.getElementById("calificacionPunto").value;
        if (calificacionPunto)
          formData.append("calificacion", calificacionPunto);
        break;
    }

    try {
      const response = await fetch("api/business.php", {
        method: "POST",
        body: formData,
      });

      const result = await response.json();

      if (result.success) {
        showSuccess(
          editingId
            ? "Negocio actualizado correctamente"
            : "Negocio creado correctamente"
        );
        setTimeout(() => {
          closeBusinessModal();
          loadBusinesses();
        }, 1500);
      } else {
        showError("Error: " + result.message);
      }
    } catch (error) {
      console.error("Error:", error);
      showError("Error al guardar el negocio");
    }
  });

// Editar negocio
function editBusiness(id) {
  openBusinessModal(id);
}

// Eliminar negocio
async function deleteBusiness(id) {
  if (!confirm("¿Estás seguro de que quieres eliminar este negocio?")) {
    return;
  }

  try {
    const formData = new FormData();
    formData.append("action", "delete");
    formData.append("category", currentCategory);
    formData.append("id", id);

    console.log("Enviando datos:", {
      action: "delete",
      category: currentCategory,
      id: id,
    });

    const response = await fetch("api/business.php", {
      method: "POST",
      body: formData,
    });

    console.log("Response status:", response.status);

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const result = await response.json();
    console.log("Response data:", result);

    if (result.success) {
      alert("Negocio eliminado correctamente");
      loadBusinesses();
    } else {
      alert("Error al eliminar: " + result.message);
    }
  } catch (error) {
    console.error("Error completo:", error);
    alert("Error al eliminar el negocio: " + error.message);
  }
}

// Actualizar contador
function updateBusinessCount() {
  // Aquí deberías hacer una llamada para obtener el total de todos los negocios
  document.getElementById("businessCount").textContent = businesses.length;
}

// Búsqueda
document.getElementById("searchInput").addEventListener("input", function (e) {
  const searchTerm = e.target.value.toLowerCase();
  const filtered = businesses.filter(
    (b) =>
      b.NOMBRE.toLowerCase().includes(searchTerm) ||
      b.DESCRIPCION.toLowerCase().includes(searchTerm) ||
      b.UBICACION.toLowerCase().includes(searchTerm)
  );

  const grid = document.getElementById("businessGrid");
  if (filtered.length === 0 && searchTerm) {
    grid.innerHTML = `
                    <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: #666;">
                        <i class="fas fa-search" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;"></i>
                        <p>No se encontraron negocios que coincidan con "${searchTerm}"</p>
                    </div>
                `;
  } else if (searchTerm) {
    grid.innerHTML = filtered
      .map((business) => createBusinessCard(business))
      .join("");
  } else {
    renderBusinesses();
  }
});

// Funciones de mensajes
function showError(message) {
  const messageDiv = document.getElementById("modalMessage");
  messageDiv.innerHTML = `<div class="error-message">${message}</div>`;
}

function showSuccess(message) {
  const messageDiv = document.getElementById("modalMessage");
  messageDiv.innerHTML = `<div class="success-message">${message}</div>`;
}

function clearMessages() {
  document.getElementById("modalMessage").innerHTML = "";
}

// Cerrar modal al hacer click fuera
window.addEventListener("click", function (e) {
  const modal = document.getElementById("businessModal");
  if (e.target === modal) {
    closeBusinessModal();
  }
});
