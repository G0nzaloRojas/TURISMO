<?php session_start();
  if(isset($_SESSION["id_cargo"])){
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Paquetes - BA Tour</title>
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="icon" href="img/Logo2.ico" type="image/x-icon" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
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
      <li><a href="index.php" >Inicio</a></li>
      
      <?php if (isset($_SESSION['id_cargo'])): ?>
        <li><a href="packages.php" class="active">Paquetes</a></li>
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

    <!-- Hero Section -->
    <section class="packages-hero">
      <div class="hero-content">
        <h1>Nuestros Paquetes Turísticos</h1>
        <p>Encuentra la aventura perfecta para tus próximas vacaciones</p>
      </div>
    </section>

    <!-- Packages Main Section -->
    <section class="packages-main">
      <div class="container">
        <div class="results-info">
          <p class="results-count">
            Mostrando <span id="results-count">12</span> paquetes
          </p>
          <select class="sort-select" id="sort-by" onchange="sortPackages()">
            <option value="featured">Destacados</option>
            <option value="price-low">Precio: menor a mayor</option>
            <option value="price-high">Precio: mayor a menor</option>
            <option value="rating">Mejor valorados</option>
            <option value="duration">Duración</option>
          </select>
        </div>

        <div class="packages-grid" id="packages-grid">
          <!-- Package 1 -->
          <div
            class="package-card-extended"
            data-destination="buenos-aires"
            data-price="120000"
            data-stars="4"
            data-meal="media-pension"
            data-duration="7"
          >
            <div class="package-image">
              <img src="/api/placeholder/400/250" alt="Buenos Aires Clásico" />
              <span class="package-badge">Más vendido</span>
            </div>
            <div class="package-info">
              <div class="package-header">
                <div class="package-title">
                  <h3>Buenos Aires Clásico</h3>
                  <p class="location">
                    <i class="fas fa-map-marker-alt"></i> Buenos Aires
                  </p>
                </div>
                <div class="package-rating">
                  <span class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                  </span>
                  <span class="rating-number">(4.2)</span>
                </div>
              </div>
              <p class="description">
                Descubre la magia de Buenos Aires con visitas a sus barrios más
                emblemáticos, shows de tango y la mejor gastronomía porteña.
              </p>
              <div class="package-features">
                <div class="feature">
                  <i class="fas fa-calendar"></i>
                  <span>7 días / 6 noches</span>
                </div>
                <div class="feature">
                  <i class="fas fa-hotel"></i>
                  <span>Hotel 4 estrellas</span>
                </div>
                <div class="feature">
                  <i class="fas fa-utensils"></i>
                  <span>Media pensión</span>
                </div>
                <div class="feature">
                  <i class="fas fa-plane"></i>
                  <span>Vuelos incluidos</span>
                </div>
              </div>
              <div class="package-price-section">
                <div class="price-details">
                  <span class="old-price">$150,000</span>
                  <span class="current-price">$120,000</span>
                  <span class="price-note">Por persona</span>
                </div>
                <a href="contact.html" class="btn btn-secondary"
                  >Ver detalles</a
                >
              </div>
            </div>
          </div>

          <!-- Package 2 -->
          <div
            class="package-card-extended"
            data-destination="bariloche"
            data-price="185000"
            data-stars="5"
            data-meal="todo-incluido"
            data-duration="7"
          >
            <div class="package-image">
              <img src="/api/placeholder/400/250" alt="Bariloche Premium" />
              <span class="package-badge">Recomendado</span>
            </div>
            <div class="package-info">
              <div class="package-header">
                <div class="package-title">
                  <h3>Bariloche Premium</h3>
                  <p class="location">
                    <i class="fas fa-map-marker-alt"></i> San Carlos de
                    Bariloche
                  </p>
                </div>
                <div class="package-rating">
                  <span class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                  </span>
                  <span class="rating-number">(4.8)</span>
                </div>
              </div>
              <p class="description">
                Vive la experiencia completa en la Patagonia con excursiones
                exclusivas, ski en Cerro Catedral y gastronomía de montaña.
              </p>
              <div class="package-features">
                <div class="feature">
                  <i class="fas fa-calendar"></i>
                  <span>8 días / 7 noches</span>
                </div>
                <div class="feature">
                  <i class="fas fa-hotel"></i>
                  <span>Hotel 5 estrellas</span>
                </div>
                <div class="feature">
                  <i class="fas fa-utensils"></i>
                  <span>Todo incluido</span>
                </div>
                <div class="feature">
                  <i class="fas fa-skiing"></i>
                  <span>Actividades incluidas</span>
                </div>
              </div>
              <div class="package-price-section">
                <div class="price-details">
                  <span class="current-price">$185,000</span>
                  <span class="price-note">Por persona</span>
                </div>
                <a href="contact.html" class="btn btn-secondary"
                  >Ver detalles</a
                >
              </div>
            </div>
          </div>

          <!-- Package 3 -->
          <div
            class="package-card-extended"
            data-destination="iguazu"
            data-price="156000"
            data-stars="4"
            data-meal="pension-completa"
            data-duration="3"
          >
            <div class="package-image">
              <img src="/api/placeholder/400/250" alt="Cataratas del Iguazú" />
            </div>
            <div class="package-info">
              <div class="package-header">
                <div class="package-title">
                  <h3>Cataratas Majestuosas</h3>
                  <p class="location">
                    <i class="fas fa-map-marker-alt"></i> Puerto Iguazú
                  </p>
                </div>
                <div class="package-rating">
                  <span class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                  </span>
                  <span class="rating-number">(4.6)</span>
                </div>
              </div>
              <p class="description">
                Maravíllate con las Cataratas del Iguazú, una de las siete
                maravillas naturales del mundo. Incluye visita a ambos lados.
              </p>
              <div class="package-features">
                <div class="feature">
                  <i class="fas fa-calendar"></i>
                  <span>4 días / 3 noches</span>
                </div>
                <div class="feature">
                  <i class="fas fa-hotel"></i>
                  <span>Hotel 4 estrellas</span>
                </div>
                <div class="feature">
                  <i class="fas fa-utensils"></i>
                  <span>Pensión completa</span>
                </div>
                <div class="feature">
                  <i class="fas fa-camera"></i>
                  <span>Tours guiados</span>
                </div>
              </div>
              <div class="package-price-section">
                <div class="price-details">
                  <span class="old-price">$180,000</span>
                  <span class="current-price">$156,000</span>
                  <span class="price-note">Por persona</span>
                </div>
                <a href="contact.html" class="btn btn-secondary"
                  >Ver detalles</a
                >
              </div>
            </div>
          </div>

          <!-- Package 4 -->
          <div
            class="package-card-extended"
            data-destination="mendoza"
            data-price="142000"
            data-stars="4"
            data-meal="media-pension"
            data-duration="7"
          >
            <div class="package-image">
              <img src="/api/placeholder/400/250" alt="Mendoza Viñedos" />
            </div>
            <div class="package-info">
              <div class="package-header">
                <div class="package-title">
                  <h3>Mendoza y sus Viñedos</h3>
                  <p class="location">
                    <i class="fas fa-map-marker-alt"></i> Mendoza
                  </p>
                </div>
                <div class="package-rating">
                  <span class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                  </span>
                  <span class="rating-number">(4.3)</span>
                </div>
              </div>
              <p class="description">
                Tour enológico por las mejores bodegas de Mendoza, degustación
                de vinos premium y vista del Aconcagua.
              </p>
              <div class="package-features">
                <div class="feature">
                  <i class="fas fa-calendar"></i>
                  <span>6 días / 5 noches</span>
                </div>
                <div class="feature">
                  <i class="fas fa-hotel"></i>
                  <span>Hotel 4 estrellas</span>
                </div>
                <div class="feature">
                  <i class="fas fa-wine-glass-alt"></i>
                  <span>Catas incluidas</span>
                </div>
                <div class="feature">
                  <i class="fas fa-mountain"></i>
                  <span>Excursiones</span>
                </div>
              </div>
              <div class="package-price-section">
                <div class="price-details">
                  <span class="current-price">$142,000</span>
                  <span class="price-note">Por persona</span>
                </div>
                <a href="contact.html" class="btn btn-secondary"
                  >Ver detalles</a
                >
              </div>
            </div>
          </div>

          <!-- Package 5 -->
          <div
            class="package-card-extended"
            data-destination="calafate"
            data-price="225000"
            data-stars="5"
            data-meal="pension-completa"
            data-duration="10"
          >
            <div class="package-image">
              <img src="/api/placeholder/400/250" alt="El Calafate Glaciares" />
              <span class="package-badge">Aventura</span>
            </div>
            <div class="package-info">
              <div class="package-header">
                <div class="package-title">
                  <h3>Glaciares Patagónicos</h3>
                  <p class="location">
                    <i class="fas fa-map-marker-alt"></i> El Calafate
                  </p>
                </div>
                <div class="package-rating">
                  <span class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                  </span>
                  <span class="rating-number">(4.9)</span>
                </div>
              </div>
              <p class="description">
                Expedición única al Glaciar Perito Moreno, navegación por el
                Lago Argentino y trekking sobre hielo.
              </p>
              <div class="package-features">
                <div class="feature">
                  <i class="fas fa-calendar"></i>
                  <span>10 días / 9 noches</span>
                </div>
                <div class="feature">
                  <i class="fas fa-hotel"></i>
                  <span>Hotel 5 estrellas</span>
                </div>
                <div class="feature">
                  <i class="fas fa-utensils"></i>
                  <span>Pensión completa</span>
                </div>
                <div class="feature">
                  <i class="fas fa-hiking"></i>
                  <span>Trekking incluido</span>
                </div>
              </div>
              <div class="package-price-section">
                <div class="price-details">
                  <span class="current-price">$225,000</span>
                  <span class="price-note">Por persona</span>
                </div>
                <a href="contact.html" class="btn btn-secondary"
                  >Ver detalles</a
                >
              </div>
            </div>
          </div>

          <!-- Package 6 -->
          <div
            class="package-card-extended"
            data-destination="ushuaia"
            data-price="198000"
            data-stars="4"
            data-meal="todo-incluido"
            data-duration="7"
          >
            <div class="package-image">
              <img src="/api/placeholder/400/250" alt="Ushuaia Fin del Mundo" />
            </div>
            <div class="package-info">
              <div class="package-header">
                <div class="package-title">
                  <h3>Ushuaia Fin del Mundo</h3>
                  <p class="location">
                    <i class="fas fa-map-marker-alt"></i> Ushuaia
                  </p>
                </div>
                <div class="package-rating">
                  <span class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                  </span>
                  <span class="rating-number">(4.7)</span>
                </div>
              </div>
              <p class="description">
                Aventura en el fin del mundo: navegación por el Canal Beagle,
                Parque Nacional Tierra del Fuego y pingüinera.
              </p>
              <div class="package-features">
                <div class="feature">
                  <i class="fas fa-calendar"></i>
                  <span>7 días / 6 noches</span>
                </div>
                <div class="feature">
                  <i class="fas fa-hotel"></i>
                  <span>Hotel 4 estrellas</span>
                </div>
                <div class="feature">
                  <i class="fas fa-ship"></i>
                  <span>Navegación incluida</span>
                </div>
                <div class="feature">
                  <i class="fas fa-paw"></i>
                  <span>Avistaje fauna</span>
                </div>
              </div>
              <div class="package-price-section">
                <div class="price-details">
                  <span class="current-price">$198,000</span>
                  <span class="price-note">Por persona</span>
                </div>
                <a href="contact.html" class="btn btn-secondary"
                  >Ver detalles</a
                >
              </div>
            </div>
          </div>

          <!-- More packages can be added here -->
        </div>

        <!-- No results message (hidden by default) -->
        <div class="no-results" id="no-results" style="display: none">
          <i class="fas fa-search"></i>
          <h3>No encontramos paquetes con esos criterios</h3>
          <p>Intenta ajustar los filtros para ver más opciones</p>
        </div>
      </div>
    </section>

    <!-- Footer -->
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
              <?php if (isset($_SESSION['id_cargo'])): ?>
                <li><a href="packages.php" class="active" onclick="scrollToTop(event)">Paquetes</a></li>
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
