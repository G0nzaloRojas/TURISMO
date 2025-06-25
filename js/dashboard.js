// Variables globales
let currentCategory = "restaurantes";
let editingId = null;
let businesses = [];
let users = [];

// Inicializar la aplicación
document.addEventListener("DOMContentLoaded", function () {
  loadComboData();
  loadBusinesses();
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

function updateBusinessCount() {
  document.getElementById("businessCount").textContent = businesses.length;
  document.getElementById("countLabel").textContent = "Negocios Registrados";
}

function updateUserCount() {
  document.getElementById("businessCount").textContent = users.length;
  document.getElementById("countLabel").textContent = "Usuarios Registrados";
}

// Cargar negocios o usuarios
async function loadBusinesses() {
  try {
    showLoading(true);

    if (currentCategory === "usuarios") {
      await loadUsers();
    } else {
      const response = await fetch(
        `api/business.php?action=getAll&category=${currentCategory}`
      );
      const data = await response.json();

      if (data.success) {
        businesses = data.data;
        renderBusinesses();
        updateBusinessCount();
      } else {
        showError("Error al cargar los datos: " + data.message);
      }
    }
  } catch (error) {
    console.error("Error loading data:", error);
    showError("Error al cargar los datos");
  } finally {
    showLoading(false);
  }
}

// Cargar usuarios
async function loadUsers() {
  try {
    const response = await fetch("api/business.php?action=getUsers");
    const data = await response.json();

    if (data.success) {
      users = data.data;
      renderUsers();
      updateUserCount();
    } else {
      showError("Error al cargar usuarios: " + data.message);
    }
  } catch (error) {
    console.error("Error loading users:", error);
    showError("Error al cargar usuarios");
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
      usuarios: "Usuarios",
    };

    document.getElementById("projectTitle").textContent =
      currentCategory === "usuarios"
        ? `Gestión de: ${categoryNames[currentCategory]}`
        : `Categoría: ${categoryNames[currentCategory]}`;

    // Actualizar textos de botones
    updateButtonTexts();

    // Actualizar placeholder de búsqueda
    updateSearchPlaceholder();

    loadBusinesses();
  }
});

// Actualizar textos de botones según la categoría
function updateButtonTexts() {
  const addButtonText = document.getElementById("addButtonText");
  const addButtonText2 = document.getElementById("addButtonText2");

  if (currentCategory === "usuarios") {
    addButtonText.textContent = "Nuevo Usuario";
    addButtonText2.textContent = "Agregar Usuario";
  } else {
    addButtonText.textContent = "Nuevo Negocio";
    addButtonText2.textContent = "Agregar Negocio";
  }
}

// Actualizar placeholder de búsqueda
function updateSearchPlaceholder() {
  const searchInput = document.getElementById("searchInput");

  if (currentCategory === "usuarios") {
    searchInput.placeholder = "Buscar usuario...";
  } else {
    searchInput.placeholder = "Buscar negocio...";
  }
}

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

// Renderizar usuarios
function renderUsers() {
  const grid = document.getElementById("businessGrid");

  if (users.length === 0) {
    grid.innerHTML = `
      <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: #666;">
        <i class="fas fa-users" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;"></i>
        <p>No hay usuarios registrados</p>
        <button class="add-task-btn" onclick="openBusinessModal()" style="margin-top: 1rem;">
          <i class="fas fa-plus"></i> Agregar Primer Usuario
        </button>
      </div>
    `;
    return;
  }

  grid.innerHTML = users.map((user) => createUserCard(user)).join("");
}

// Crear tarjeta de usuario
function createUserCard(user) {
  const cargoText = user.ID_CARGO == 1 ? "Administrador" : "Dueño de Negocio";
  const cargoIcon = user.ID_CARGO == 1 ? "user-shield" : "user-tie";

  return `
    <div class="business-card">
      <h3 class="business-name">${user.NOMBRE} ${user.APELLIDO}</h3>
      <div class="business-type">
        <i class="fas fa-${cargoIcon}"></i>
        ${cargoText}
      </div>
      <div class="business-info">
        <div class="info-item">
          <i class="fas fa-envelope"></i> ${user.EMAIL}
        </div>
      </div>
      <div class="business-actions">
        <button class="action-btn btn-edit" onclick="editUser(${user.ID})">
          <i class="fas fa-edit"></i> Editar
        </button>
        <button class="action-btn btn-delete" onclick="deleteUser(${user.ID})">
          <i class="fas fa-trash"></i> Eliminar
        </button>
      </div>
    </div>
  `;
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
            business.PRECIO_MINIMO
              ? `<div class="info-item"><i class="fas fa-dollar-sign"></i> ${business.PRECIO_MINIMO} - ${business.PRECIO_MAXIMO}</div>`
              : ""
          }
          ${
            business.URL
              ? `<div class="info-item"><i class="fas fa-globe"></i> <a href="${business.URL}" target="_blank" rel="noopener">Sitio Web</a></div>`
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
          ${
            business.URL
              ? `<div class="info-item"><i class="fas fa-globe"></i> <a href="${business.URL}" target="_blank" rel="noopener">Sitio Web</a></div>`
              : ""
          }
        </div>
      `;
      break;

    case "alquiler":
      icon = "home";
      info = `
        <div class="business-info">
          <div class="info-item"><i class="fas fa-star"></i> ${
            business.CALIFICACION
          }/10</div>
          <div class="info-item"><i class="fas fa-bed"></i> ${
            business.DORMITORIOS
          } dorm, ${business.BANIOS} baños</div>
          <div class="info-item"><i class="fas fa-ruler-combined"></i> ${
            business.METROS
          }m²</div>
          <div class="info-item"><i class="fas fa-dollar-sign"></i> ${
            business.PRECIO_SEMANA
          }/semana</div>
          ${
            business.URL
              ? `<div class="info-item"><i class="fas fa-globe"></i> <a href="${business.URL}" target="_blank" rel="noopener">Sitio Web</a></div>`
              : ""
          }
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
          ${
            business.URL
              ? `<div class="info-item"><i class="fas fa-globe"></i> <a href="${business.URL}" target="_blank" rel="noopener">Sitio Web</a></div>`
              : ""
          }
        </div>
      `;
      break;
  }

  // Para hoteles, no mostrar descripción ya que no la tienen
  const description =
    currentCategory === "hoteles"
      ? ""
      : `<p class="business-description">${business.DESCRIPCION}</p>`;

  return `
    <div class="business-card">
      <h3 class="business-name">${business.NOMBRE}</h3>
      <div class="business-type">
        <i class="fas fa-${icon}"></i>
        ${business.UBICACION}
      </div>
      ${description}
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

  if (currentCategory === "usuarios") {
    showFieldsForCategory("usuarios");
    if (id) {
      const user = users.find((u) => u.ID == id);
      title.textContent = "Editar Usuario";
      fillFormWithUser(user);
    } else {
      title.textContent = "Agregar Nuevo Usuario";
      form.reset();
      document.getElementById("businessCategory").value = currentCategory;
    }
  } else {
    showFieldsForCategory(currentCategory);
    if (id) {
      const business = businesses.find((b) => b.ID == id);
      title.textContent = "Editar Negocio";
      fillFormWithBusiness(business);
    } else {
      title.textContent = "Agregar Nuevo Negocio";
      form.reset(); // Esto debería resetear todos los campos incluido URL
      document.getElementById("businessCategory").value = currentCategory;

      // IMPORTANTE: Limpiar específicamente estos campos para estar seguros
      document.getElementById("currentPhoto").style.display = "none";
      document.getElementById("businessPhoto").value = "";
      document.getElementById("businessUrl").value = ""; // ASEGURAR QUE SE LIMPIE

      // También limpiar otros campos comunes
      document.getElementById("businessName").value = "";
      document.getElementById("businessLocation").value = "";
      if (document.getElementById("businessDescription")) {
        document.getElementById("businessDescription").value = "";
      }
    }
  }

  clearMessages();
  modal.style.display = "block";
}

// Mostrar campos según categoría
function hideAllFields() {
  document.getElementById("restauranteFields").style.display = "none";
  document.getElementById("hotelFields").style.display = "none";
  document.getElementById("alquilerFields").style.display = "none";
  document.getElementById("puntosInteresFields").style.display = "none";
  document.getElementById("usuarioFields").style.display = "none";

  // Obtener elementos de campos comunes
  const businessNameGroup = document.querySelector(
    'label[for="businessName"]'
  ).parentElement;
  const businessLocationGroup = document.querySelector(
    'label[for="businessLocation"]'
  ).parentElement;
  const businessDescriptionGroup = document.querySelector(
    'label[for="businessDescription"]'
  ).parentElement;
  const businessUrlGroup = document.querySelector(
    'label[for="businessUrl"]'
  ).parentElement;
  const businessPhotoGroup = document.querySelector(
    'label[for="businessPhoto"]'
  ).parentElement;

  if (currentCategory === "usuarios") {
    businessNameGroup.style.display = "none";
    businessLocationGroup.style.display = "none";
    businessDescriptionGroup.style.display = "none";
    businessUrlGroup.style.display = "none"; // AGREGAR ESTA LÍNEA
    businessPhotoGroup.style.display = "none";
  } else {
    businessNameGroup.style.display = "block";
    businessLocationGroup.style.display = "block";
    businessUrlGroup.style.display = "block"; // AGREGAR ESTA LÍNEA
    // Para hoteles, ocultar descripción ya que no la tienen en la BD
    businessDescriptionGroup.style.display =
      currentCategory === "hoteles" ? "none" : "block";
    businessPhotoGroup.style.display = "block";
  }
}

function showFieldsForCategory(category) {
  const fieldMap = {
    restaurantes: "restauranteFields",
    hoteles: "hotelFields",
    alquiler: "alquilerFields",
    puntos_interes: "puntosInteresFields",
    usuarios: "usuarioFields",
  };

  if (fieldMap[category]) {
    document.getElementById(fieldMap[category]).style.display = "block";
  }
}

// Llenar formulario con datos del usuario
function fillFormWithUser(user) {
  document.getElementById("businessId").value = user.ID;
  document.getElementById("usuarioNombre").value = user.NOMBRE;
  document.getElementById("usuarioApellido").value = user.APELLIDO;
  document.getElementById("usuarioEmail").value = user.EMAIL;
  document.getElementById("usuarioCargo").value = user.ID_CARGO;
  document.getElementById("businessCategory").value = currentCategory;

  // No mostrar la contraseña por seguridad
  document.getElementById("usuarioPassword").value = "";
  document.getElementById("usuarioPassword").placeholder =
    "Dejar vacío para mantener la actual";
  document.getElementById("usuarioPassword").required = false;
}

// Editar usuario
function editUser(id) {
  openBusinessModal(id);
}

// Eliminar usuario
async function deleteUser(id) {
  if (!confirm("¿Estás seguro de que quieres eliminar este usuario?")) {
    return;
  }

  try {
    const formData = new FormData();
    formData.append("action", "delete");
    formData.append("category", "usuarios");
    formData.append("id", id);

    const response = await fetch("api/business.php", {
      method: "POST",
      body: formData,
    });

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const result = await response.json();

    if (result.success) {
      alert("Usuario eliminado correctamente");
      loadBusinesses(); // Esto va a recargar los usuarios porque currentCategory será 'usuarios'
    } else {
      alert("Error al eliminar: " + result.message);
    }
  } catch (error) {
    console.error("Error completo:", error);
    alert("Error al eliminar el usuario: " + error.message);
  }
}

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

    const response = await fetch("api/business.php", {
      method: "POST",
      body: formData,
    });

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const result = await response.json();

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

// Llenar formulario con datos del negocio
function fillFormWithBusiness(business) {
  document.getElementById("businessId").value = business.ID;
  document.getElementById("businessName").value = business.NOMBRE;
  document.getElementById("businessLocation").value = business.UBICACION;
  document.getElementById("businessUrl").value = business.URL || "";

  // Solo llenar descripción si no es hotel
  if (currentCategory !== "hoteles") {
    document.getElementById("businessDescription").value = business.DESCRIPCION;
  }

  document.getElementById("businessCategory").value = currentCategory;

  // IMPORTANTE: Limpiar siempre el input de foto
  document.getElementById("businessPhoto").value = "";

  switch (currentCategory) {
    case "restaurantes":
      if (business.ID_COMIDA)
        document.getElementById("tipoComida").value = business.ID_COMIDA;
      if (business.PRECIO_MINIMO)
        document.getElementById("precioMinimo").value = business.PRECIO_MINIMO;
      if (business.PRECIO_MAXIMO)
        document.getElementById("precioMaximo").value = business.PRECIO_MAXIMO;

      // Manejar foto actual
      if (business.FOTO_URL) {
        document.getElementById("currentPhoto").style.display = "block";
        document.getElementById(
          "currentPhotoImg"
        ).src = `uploads/${currentCategory}/${business.FOTO_URL}`;
      } else {
        document.getElementById("currentPhoto").style.display = "none";
      }
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

      // Manejar foto actual
      if (business.FOTO_URL) {
        document.getElementById("currentPhoto").style.display = "block";
        document.getElementById(
          "currentPhotoImg"
        ).src = `uploads/${currentCategory}/${business.FOTO_URL}`;
      } else {
        document.getElementById("currentPhoto").style.display = "none";
      }
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

      // Manejar foto actual - AGREGADO PARA ALQUILERES
      if (business.FOTO_URL) {
        document.getElementById("currentPhoto").style.display = "block";
        document.getElementById(
          "currentPhotoImg"
        ).src = `uploads/${currentCategory}/${business.FOTO_URL}`;
      } else {
        document.getElementById("currentPhoto").style.display = "none";
      }
      break;

    case "puntos_interes":
      if (business.ID_ACTIVIDAD)
        document.getElementById("actividad").value = business.ID_ACTIVIDAD;
      if (business.PRECIO)
        document.getElementById("precio").value = business.PRECIO;
      if (business.CALIFICACION)
        document.getElementById("calificacionPunto").value =
          business.CALIFICACION;

      // Manejar foto actual
      if (business.FOTO_URL) {
        document.getElementById("currentPhoto").style.display = "block";
        document.getElementById(
          "currentPhotoImg"
        ).src = `uploads/${currentCategory}/${business.FOTO_URL}`;
      } else {
        document.getElementById("currentPhoto").style.display = "none";
      }
      break;
  }
}

function closeBusinessModal() {
  document.getElementById("businessModal").style.display = "none";

  // IMPORTANTE: Limpiar todos los campos al cerrar el modal
  document.getElementById("businessPhoto").value = "";
  document.getElementById("businessUrl").value = "";
  document.getElementById("currentPhoto").style.display = "none";

  // Limpiar otros campos por seguridad
  document.getElementById("businessName").value = "";
  document.getElementById("businessLocation").value = "";
  if (document.getElementById("businessDescription")) {
    document.getElementById("businessDescription").value = "";
  }

  editingId = null;
  clearMessages();
}

// Event listener para el formulario
document
  .getElementById("businessForm")
  .addEventListener("submit", async function (e) {
    e.preventDefault();

    const formData = new FormData();
    const category =
      currentCategory === "usuarios" ? "usuarios" : currentCategory;

    // Determinar si es crear o actualizar
    const isEdit = editingId !== null;
    formData.append("action", isEdit ? "update" : "create");
    formData.append("category", category);

    if (isEdit) {
      formData.append("id", editingId);
    }

    if (category === "usuarios") {
      // Campos de usuario
      formData.append("nombre", document.getElementById("usuarioNombre").value);
      formData.append(
        "apellido",
        document.getElementById("usuarioApellido").value
      );
      formData.append("email", document.getElementById("usuarioEmail").value);
      formData.append(
        "id_cargo",
        document.getElementById("usuarioCargo").value
      );

      const password = document.getElementById("usuarioPassword").value;
      if (password) {
        formData.append("password", password);
      }
    } else {
      // Campos comunes de negocio
      formData.append("nombre", document.getElementById("businessName").value);
      formData.append(
        "ubicacion",
        document.getElementById("businessLocation").value
      );

      const url = document.getElementById("businessUrl").value;
      if (url) {
        formData.append("url", url);
      }

      // Para hoteles no enviar descripción
      if (category !== "hoteles") {
        formData.append(
          "descripcion",
          document.getElementById("businessDescription").value
        );
      }

      // Foto
      const photo = document.getElementById("businessPhoto").files[0];
      if (photo) {
        formData.append("foto", photo);
      }

      // Campos específicos por categoría
      switch (category) {
        case "restaurantes":
          const tipoComida = document.getElementById("tipoComida").value;
          if (tipoComida) formData.append("id_comida", tipoComida);

          const precioMin = document.getElementById("precioMinimo").value;
          if (precioMin) formData.append("precio_minimo", precioMin);

          const precioMax = document.getElementById("precioMaximo").value;
          if (precioMax) formData.append("precio_maximo", precioMax);
          break;

        case "hoteles":
          const precioMinHotel =
            document.getElementById("precioMinimoHotel").value;
          if (precioMinHotel) formData.append("precio_minimo", precioMinHotel);

          const precioMaxHotel =
            document.getElementById("precioMaximoHotel").value;
          if (precioMaxHotel) formData.append("precio_maximo", precioMaxHotel);

          const calificacion = document.getElementById("calificacion").value;
          if (calificacion) formData.append("calificacion", calificacion);

          const huespedes = document.getElementById("huespedes").value;
          if (huespedes) formData.append("huespedes", huespedes);

          formData.append("pileta", document.getElementById("pileta").value);
          formData.append(
            "desayuno",
            document.getElementById("desayuno").value
          );
          break;

        case "alquiler":
          const precioSemana = document.getElementById("precioSemana").value;
          if (precioSemana) formData.append("precio_semana", precioSemana);

          const calificacionAlq = document.getElementById(
            "calificacionAlquiler"
          ).value;
          if (calificacionAlq) formData.append("calificacion", calificacionAlq);

          const banios = document.getElementById("banios").value;
          if (banios) formData.append("banios", banios);

          const dormitorios = document.getElementById("dormitorios").value;
          if (dormitorios) formData.append("dormitorios", dormitorios);

          const camasDobles = document.getElementById("camasDobles").value;
          if (camasDobles) formData.append("camas_dobles", camasDobles);

          const camasSimples = document.getElementById("camasSimples").value;
          if (camasSimples) formData.append("camas_simples", camasSimples);

          const metros = document.getElementById("metros").value;
          if (metros) formData.append("metros", metros);
          break;

        case "puntos_interes":
          const actividad = document.getElementById("actividad").value;
          if (actividad) formData.append("id_actividad", actividad);

          const precio = document.getElementById("precio").value;
          if (precio) formData.append("precio", precio);

          const calificacionPunto =
            document.getElementById("calificacionPunto").value;
          if (calificacionPunto)
            formData.append("calificacion", calificacionPunto);
          break;
      }
    }

    try {
      const response = await fetch("api/business.php", {
        method: "POST",
        body: formData,
      });

      const result = await response.json();

      if (result.success) {
        showSuccess(result.message);
        setTimeout(() => {
          closeBusinessModal();
          loadBusinesses();
        }, 1500);
      } else {
        showError(result.message);
      }
    } catch (error) {
      console.error("Error:", error);
      showError("Error de conexión: " + error.message);
    }
  });

// Función de búsqueda
document.getElementById("searchInput").addEventListener("input", function (e) {
  const searchTerm = e.target.value.toLowerCase().trim();

  if (currentCategory === "usuarios") {
    // Búsqueda para usuarios
    if (searchTerm === "") {
      // Si no hay término de búsqueda, mostrar todos los usuarios
      renderUsers();
    } else {
      const filteredUsers = users.filter(
        (user) =>
          user.NOMBRE.toLowerCase().includes(searchTerm) ||
          user.APELLIDO.toLowerCase().includes(searchTerm) ||
          user.EMAIL.toLowerCase().includes(searchTerm)
      );

      const grid = document.getElementById("businessGrid");
      if (filteredUsers.length === 0) {
        grid.innerHTML = `
                    <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: #666;">
                        <i class="fas fa-search" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;"></i>
                        <p>No se encontraron usuarios que coincidan con "${searchTerm}"</p>
                        <button class="add-task-btn" onclick="openBusinessModal()" style="margin-top: 1rem;">
                            <i class="fas fa-plus"></i> Agregar Usuario
                        </button>
                    </div>
                `;
      } else {
        grid.innerHTML = filteredUsers
          .map((user) => createUserCard(user))
          .join("");
      }
    }
  } else {
    // Búsqueda para negocios
    if (searchTerm === "") {
      // Si no hay término de búsqueda, mostrar todos los negocios
      renderBusinesses();
    } else {
      const filteredBusinesses = businesses.filter((business) => {
        const nombre = business.NOMBRE ? business.NOMBRE.toLowerCase() : "";
        const ubicacion = business.UBICACION
          ? business.UBICACION.toLowerCase()
          : "";
        const descripcion = business.DESCRIPCION
          ? business.DESCRIPCION.toLowerCase()
          : "";

        return (
          nombre.includes(searchTerm) ||
          ubicacion.includes(searchTerm) ||
          descripcion.includes(searchTerm)
        );
      });

      const grid = document.getElementById("businessGrid");
      if (filteredBusinesses.length === 0) {
        grid.innerHTML = `
                    <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: #666;">
                        <i class="fas fa-search" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;"></i>
                        <p>No se encontraron negocios que coincidan con "${searchTerm}"</p>
                        <button class="add-task-btn" onclick="openBusinessModal()" style="margin-top: 1rem;">
                            <i class="fas fa-plus"></i> Agregar Negocio
                        </button>
                    </div>
                `;
      } else {
        grid.innerHTML = filteredBusinesses
          .map((business) => createBusinessCard(business))
          .join("");
      }
    }
  }
});
