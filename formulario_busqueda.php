<?php session_start();
  if(isset($_SESSION["id_cargo"])){
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Búsqueda - BA Tour</title>
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
          <li><a href="packages.php">Paquetes</a></li>
          <li><a href="about.php">Nosotros</a></li>
          <li><a href="contact.php">Contacto</a></li>
          <li><a href="form_register.php">Registrarse</a></li>
          <li><a href="form_login.php">Iniciar Sesión</a></li>
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
              <li><a href="index.php">Inicio</a></li>
              <li><a href="packages.html">Paquetes</a></li>
              <li><a href="about.html">Nosotros</a></li>
              <li><a href="contact.html">Contacto</a></li>
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
    </script>
  </body>
</html>
<?php }else{
  header("Location:login.php "); // Redirige de vuelta a la página de registro
  exit();
}