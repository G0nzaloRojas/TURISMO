<?php session_start();
  if(isset($_SESSION["id_cargo"])){
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Búsqueda - BA Tour</title>
    <link rel="icon" type="image/png" href="Imagenes/Logo2.png">
    <link rel="stylesheet" href="CSS/styles.css" />
    <link rel="icon" href="img/Logo2.ico" type="image/x-icon" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <style>
      .search-form {
        max-width: 1200px;
        margin: 120px auto 40px;
        padding: 30px;
        background-color: white;
        border-radius: 10px;
        box-shadow: var(--shadow);
      }

      .form-section {
        margin-bottom: 30px;
        padding: 20px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
      }

      .form-section h2 {
        color: var(--primary-color);
        margin-bottom: 20px;
        font-size: 1.8rem;
      }

      .form-section h2 i {
        margin-right: 10px;
        color: var(--accent-color);
      }

      .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
      }

      .form-group {
        flex: 1;
      }

      .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--text-color);
      }

      .form-group select,
      .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid var(--border-color);
        border-radius: 5px;
        font-size: 1rem;
      }

      .form-group select:focus,
      .form-group input:focus {
        outline: none;
        border-color: var(--primary-color);
      }

      .form-buttons {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 30px;
      }

      .btn-search {
        background-color: var(--primary-color);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 30px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
      }

      .btn-search:hover {
        background-color: var(--primary-color-hover);
      }

      .btn-clear {
        background-color: var(--secondary-color);
        color: var(--text-color);
        border: none;
        padding: 12px 30px;
        border-radius: 30px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
      }

      .btn-clear:hover {
        background-color: var(--accent-color);
        color: white;
      }

      @media (max-width: 768px) {
        .form-row {
          flex-direction: column;
          gap: 15px;
        }
      }
    </style>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar">
      <div class="container">
        <div class="logo">
          <a href="index.php">
            <img src="img/LOGO_BA.png" alt="Logo BA Tour" height="65" />
          </a>
        </div>
        <div class="menu-toggle">
          <i class="fas fa-bars"></i>
        </div>
        <ul class="nav-menu">
          <li><a href="index.php">Inicio</a></li>
          
          <?php if (isset($_SESSION['id_cargo'])): ?>
            <li><a href="packages.php">Paquetes</a></li>
          <?php else: ?>
            <li><a href="form_login.php">Paquetes</a></li>
          <?php endif; ?>
          
          <li><a href="about.php">Nosotros</a></li>
          <li><a href="contact.php">Contacto</a></li>
          <?php if (isset($_SESSION['id_cargo'])): ?>
            <?php if($_SESSION['id_cargo'] == 1 || $_SESSION['id_cargo'] == 3): ?>
              <li><a href="admin_dashboard.php">Mis Negocios</a></li>
            <?php endif; ?>
            <li><a href="logout.php">
              <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </a></li>
            <li class="user-greeting">
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#618c78"><path d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q53 0 100-15.5t86-44.5q-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160Zm0-360q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm0-60Zm0 360Z"/></svg>
              <span>Hola, <?php echo htmlspecialchars($_SESSION['nombre']); ?></span>
            </li>
          <?php else: ?>
            <li><a href="form_login.php">Iniciar Sesión</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>

    <!-- Formulario de Búsqueda -->
    <div class="search-form">
      <form id="searchForm" method="post" action="armar_paquetes.php">
        <!-- Selección de Tipo de Hospedaje -->
        <div class="form-section">
          <h2><i class="fas fa-bed"></i> Tipo de Hospedaje</h2>
          <div class="form-row">
            <div class="form-group">
              <label for="accommodation-type"
                >Seleccione el tipo de Hospedaje</label
              >
              <select
                id="accommodation-type"
                name="accommodation-type" required
                onchange="toggleAccommodationForm()"
              >
                <option value="">Seleccionar tipo</option>
                <option value="hotel">Hotel</option>
                <option value="alquiler">Alquiler</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Formulario de Hotel -->
        <div id="hotel-form" class="form-section" style="display: none">
          <h2><i class="fas fa-hotel"></i> Hoteles</h2>
          <div class="form-row">
            <div class="form-group">
              <label for="hotel-rating">Calificación</label>
              <select id="hotel-rating" name="hotel-rating" >
                <option value="">Seleccionar calificación</option>
                <option value="3">3 estrellas</option>
                <option value="4">4 estrellas</option>
                <option value="5">5 estrellas</option>
              </select>
            </div>

            <div class="form-group">
              <label for="max-guests">Huéspedes máximos</label>
              <input
                type="number"
                id="max-guests"
                name="max-guests" 
                min="1"
                max="6"
                placeholder="Número de huéspedes"
              />
            </div>
            <div class="form-group">
              <label for="dias_hotel">Días de estadía</label>
              <input
                type="number"
                id="dias_hotel"
                name="dias_hotel" 
                min="1"
                max="30"
                placeholder="Cantidad de días"
              />
            </div>

            <div class="form-group">
              <label for="pileta">Incluye Pileta</label>
              <select id="pileta" name="pileta" >
                <option value="">Seleccionar pileta</option>
                <option value="si">Sí</option>
                <option value="no">No</option>
              </select>
            </div>

            <div class="form-group">
              <label for="desayuno">Incluye Desayuno</label>
              <select id="desayuno" name="desayuno" >
                <option value="">Seleccionar Desayuno</option>
                <option value="si">Sí</option>
                <option value="no">No</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Formulario de Alquiler -->
        <div id="rental-form" class="form-section" style="display: none">
          <h2><i class="fas fa-home"></i> Alquiler</h2>
          <div class="form-row">
            <div class="form-group">
              <label for="rental-rating">Calificacion</label>
              <select id="rental-rating" name="rental-rating" >
                <option value="">Seleccionar Calificacion (puntaje)</option>
                <option value="7">7 o más</option>
                <option value="8">8 o más</option>
                <option value="9">9 o más</option>
              </select>
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group">
              <label for="double_bed">Cantidad de camas dobles</label>
              <input
                type="number"
                id="double_bed"
                name="double_bed" 
                min="1"
                max="4"
                placeholder="Número de camas dobles"
              />
            </div>
          </div>
          <div class="form-group">
              <label for="semanas_alquiler">Semanas de estadía</label>
              <input
                type="number"
                id="semanas_alquiler"
                name="semanas_alquiler" 
                min="1"
                max="5"
                placeholder="Cantidad de Semanas"
              />
            </div>
          <div class="form-row">
            <div class="form-group">
              <label for="single_bed">Cantidad de camas simples</label>
              <input
                type="number"
                id="single_bed"
                name="single_bed" 
                min="1"
                max="6"
                placeholder="Número de camas simples"
              />
            </div>
            <div class="form-group">
              <label for="bathrooms">Cantidad de baños</label>
              <input
                type="number"
                id="bathrooms"
                name="bathrooms" 
                min="1"
                max="3"
                placeholder="Número de baños"
              />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="metros2_minimos">Metros Cuadrados Mínimos</label>
              <select id="metros2_minimos" name="metros2_minimos" >
                <option value="">Seleccionar Metros Cuadrados Mínimos</option>
                <option value="20">20 m2 o más</option>
                <option value="40">40 m2 o más</option>
                <option value="60">60 m2 o más</option>
                <option value="100">100 m2 o más</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Sección Restaurantes -->
        <div class="form-section">
          <h2><i class="fas fa-utensils"></i> Restaurantes</h2>
          <div class="form-row">
            <div class="form-group">
              <label for="food-type">Tipo de comida</label>
              <select id="food-type" name="food-type" >
                <option value="">Seleccione un tipo de Comida</option>
                <option value= 1 >Parrilla</option>
                <option value= 2 >Asiatica</option>
                <option value= 3 >Pizzas y empanadas</option>
                <option value= 4 >Pastas</option>
                <option value= 5 >Vegetariana</option>
                <option value= 6 >Vegana</option>
                <option value= 7 >Todos</option>
              </select>
            </div>
            <div class="form-group">
              <label for="restaurant-rating">Calificación</label>
              <select id="restaurant-rating" name="restaurant-rating" >
                <option value="">Seleccionar calificación</option>
                <option value="3">3 estrellas</option>
                <option value="4">4 estrellas</option>
                <option value="5">5 estrellas</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Sección Puntos de Interés -->
        <div class="form-section">
          <h2><i class="fas fa-map-marker-alt"></i> Puntos de Interés</h2>
          <div class="form-row">
            <div class="form-group">
              <label for="activity-type">Tipo de actividad</label>
              <select id="activity-type" name="activity-type" >
                <option value="">Seleccionar tipo de actividad</option>
                <option value=1>Cultural</option>
                <option value=2>Entretenimiento</option>
                <option value=3>Naturaleza</option>
                <option value=4>Vida Nocturna</option>
                <option value=5>Shopping</option>
                <option value=6>Monumento</option>
                <option value=7>Centros Religioso</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Botones -->
        <div class="form-buttons">
          <button type="submit" class="btn-search">
            <i class="fas fa-search"></i> Buscar
          </button>
          <button type="reset" class="btn-clear">
            <i class="fas fa-times"></i> Limpiar
          </button>
        </div>
      </form>
    </div>

    <!-- Footer -->
    <footer class="footer">
      <div class="container">
        <div class="footer-content">
          <div class="footer-logo">
            <h2>Buenos Aires Tour</h2>
            <p>Tu compañero de aventuras</p>
          </div>
          <div class="footer-links">
            <h3>Enlaces rápidos</h3>
            <ul>
              <li><a href="index.php" onclick="scrollToTop(event)">Inicio</a></li>
              <?php if (isset($_SESSION['id_cargo'])): ?>
                <li><a href="packages.php">Paquetes</a></li>
              <?php else: ?>
                <li><a href="form_login.php">Paquetes</a></li>
              <?php endif; ?>
              <li><a href="about.php">Nosotros</a></li>
              <li><a href="contact.php">Contacto</a></li>
              <?php if (isset($_SESSION['id_cargo'])): ?>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
              <?php else: ?>
                <li><a href="form_login.php">Iniciar Sesión</a></li>
              <?php endif; ?>
            </ul>
          </div>
          <div class="footer-social">
            <h3>Síguenos</h3>
            <div class="social-icons">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
          </div>
        </div>
        <div class="footer-bottom">
          <p>&copy; 2025 Buenos Aires Tour. Todos los derechos reservados.</p>
        </div>
      </div>
    </footer>

    <script src="js/functions.js"></script>
    <script>
      function toggleAccommodationForm() {
        const accommodationType =
          document.getElementById("accommodation-type").value;
        const hotelForm = document.getElementById("hotel-form");
        const rentalForm = document.getElementById("rental-form");

        // Ocultar ambos formularios primero
        hotelForm.style.display = "none";
        rentalForm.style.display = "none";

        // Mostrar el formulario correspondiente
        if (accommodationType === "hotel") {
          hotelForm.style.display = "block";
        } else if (accommodationType === "alquiler") {
          rentalForm.style.display = "block";
        }
      }

      function scrollToTop(event) {
          event.preventDefault(); // Evita que la página salte
          window.scrollTo({
              top: 0,
              behavior: 'smooth'
          });
      }
    </script>
  </body>
</html>
<?php }else{
  header("Location:login.php "); // Redirige de vuelta a la página de registro
  exit();
}