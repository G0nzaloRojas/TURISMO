<?php session_start();?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BA Tour</title>
        <link rel="icon" type="image/png" href="Imagenes/Logo2.png">    
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="icon" href="img/Logo2.ico" type="image/x-icon">
    
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
      <li><a href="index.php" class="active">Inicio</a></li>
      
      <?php if (isset($_SESSION['id_cargo'])): ?>
        <li><a href="packages.php">Afiliados</a></li>
      <?php else: ?>
        <li><a href="form_login.php">Afiliados</a></li>
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
    <section class="hero">
      <div class="hero-content">
        <h1>Descubre destinos increíbles</h1>
        <p>Las mejores experiencias de viaje al mejor precio</p>
        <a href="formulario_busqueda.php" class="btn btn-primary">Crea Tu Paquete Personalizado</a>
      </div>
    </section>

    <?php
    // Consultas para obtener contenido dinámico
    include ("conexion.php");
    
    $consulta_hoteles = mysqli_query($conexion, "SELECT * FROM hoteles ORDER BY RAND() LIMIT 2");
    $consulta_restaurantes = mysqli_query($conexion, "SELECT * FROM restaurantes ORDER BY RAND() LIMIT 1");
    $consulta_puntos = mysqli_query($conexion, "SELECT * FROM `puntos de interes` ORDER BY RAND() LIMIT 1");

    // Guardar resultados en arrays
    $hoteles = [];
    $restaurantes = [];
    $puntos_interes = [];

    if (mysqli_num_rows($consulta_hoteles) > 0) {
        while ($fila = mysqli_fetch_assoc($consulta_hoteles)) {
            $hoteles[] = $fila;
        }
    }

    if (mysqli_num_rows($consulta_restaurantes) > 0) {
        while ($fila = mysqli_fetch_assoc($consulta_restaurantes)) {
            $restaurantes[] = $fila;
        }
    }

    if (mysqli_num_rows($consulta_puntos) > 0) {
        while ($fila = mysqli_fetch_assoc($consulta_puntos)) {
            $puntos_interes[] = $fila;
        }
    }

    // Función para convertir ID_COMIDA a texto
    function getTipoComida($id_comida) {
        switch($id_comida) {
            case 1: return "Parrilla";
            case 2: return "Asiática";
            case 3: return "Pizzas y Empanadas";
            case 4: return "Pastas";
            case 5: return "Vegetariana";
            case 6: return "Vegana";
            default: return "Varios";
        }
    }

    // Función para convertir ID_ACTIVIDAD a texto
    function getTipoActividad($id_actividad) {
        switch($id_actividad) {
            case 1: return "Cultural";
            case 2: return "Entretenimiento";
            case 3: return "Naturaleza";
            case 4: return "Vida Nocturna";
            case 5: return "Shopping";
            case 6: return "Monumento";
            case 7: return "Religioso";
            default: return "Varios";
        }
    }
    ?>

    <!-- Packages Section -->
    <section id="packages" class="packages">
      <div class="container">
        <h2 class="section-title">Nuestros afiliados destacados</h2>
        <div class="package-container">
          
          <?php if (!empty($hoteles)): ?>
          <!-- Package 1 - Hotel -->
          <div class="package-card">
            <div class="package-image">
                <img src="<?= $hoteles[0]['FOTO_URL'] ? 'uploads/hoteles/' . $hoteles[0]['FOTO_URL'] : 'uploads/placeholder.jpg' ?>" 
                    alt="<?= $hoteles[0]['NOMBRE'] ?>" 
                    onerror="this.src='uploads/placeholder.jpg'" />
            </div>
            <div class="package-details">
              <h3><?= $hoteles[0]['NOMBRE'] ?></h3>
              <p class="location">
                <i class="fas fa-map-marker-alt"></i> <?= $hoteles[0]['UBICACION'] ?>
              </p>
              <p class="description">
                Hotel <?= $hoteles[0]['CALIFICACION'] ?> estrellas. 
                <?= $hoteles[0]['PILETA'] == 'si' ? 'Con piscina.' : '' ?>
                <?= $hoteles[0]['DESAYUNO'] == 'si' ? 'Desayuno incluido.' : '' ?>
              </p>
              <div class="package-footer">
                <p class="price">Desde $<?= number_format($hoteles[0]['PRECIO_MINIMO'], 0, ',', '.') ?></p>
                <?php if (isset($_SESSION['id_cargo'])): ?>
                  <a href="formulario_busqueda.php" class="btn btn-secondary">Crear Paquete</a>
                <?php else: ?>
                  <a href="form_login.php" class="btn btn-primary">Iniciá sesión para crear paquetes</a>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php endif; ?>

          <?php if (!empty($restaurantes)): ?>
          <!-- Package 2 - Restaurante -->
          <div class="package-card">
            <div class="package-image">
                <img src="<?= $restaurantes[0]['FOTO_URL'] ? 'uploads/restaurantes/' . $restaurantes[0]['FOTO_URL'] : 'uploads/placeholder.jpg' ?>" 
                    alt="<?= $restaurantes[0]['NOMBRE'] ?>" 
                    onerror="this.src='uploads/placeholder.jpg'" />
            </div>
            <div class="package-details">
              <h3><?= $restaurantes[0]['NOMBRE'] ?></h3>
              <p class="location">
                <i class="fas fa-map-marker-alt"></i> <?= $restaurantes[0]['UBICACION'] ?>
              </p>
              <p class="description">
                Restaurante de <?= getTipoComida($restaurantes[0]['ID_COMIDA']) ?>. 
                Calificación: <?= $restaurantes[0]['CALIFICACION'] ?> estrellas.
              </p>
              <div class="package-footer">
                <p class="price">Desde $<?= number_format($restaurantes[0]['PRECIO_MINIMO'], 0, ',', '.') ?></p>
                <?php if (isset($_SESSION['id_cargo'])): ?>
                  <a href="formulario_busqueda.php" class="btn btn-secondary">Crear Paquete</a>
                <?php else: ?>
                  <a href="form_login.php" class="btn btn-primary">Iniciá sesión para crear paquetes</a>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php endif; ?>

          <?php if (!empty($puntos_interes)): ?>
          <!-- Package 3 - Punto de Interés -->
          <div class="package-card">
            <div class="package-image">
                <img src="<?= $puntos_interes[0]['FOTO_URL'] ? 'uploads/puntos_interes/' . $puntos_interes[0]['FOTO_URL'] : 'uploads/placeholder.jpg' ?>" 
                    alt="<?= $puntos_interes[0]['NOMBRE'] ?>" 
                    onerror="this.src='uploads/placeholder.jpg'" />
            </div>
            <div class="package-details">
              <h3><?= $puntos_interes[0]['NOMBRE'] ?></h3>
              <p class="location">
                <i class="fas fa-map-marker-alt"></i> <?= $puntos_interes[0]['UBICACION'] ?>
              </p>
              <p class="description">
                <?= getTipoActividad($puntos_interes[0]['ID_ACTIVIDAD']) ?>. 
                <?= $puntos_interes[0]['DESCRIPCION'] ?>
              </p>
              <div class="package-footer">
                <p class="price">
                  <?php if ($puntos_interes[0]['PRECIO'] == 0): ?>
                    Gratuito
                  <?php else: ?>
                    $<?= number_format($puntos_interes[0]['PRECIO'], 0, ',', '.') ?>
                  <?php endif; ?>
                </p>
                <?php if (isset($_SESSION['id_cargo'])): ?>
                  <a href="formulario_busqueda.php" class="btn btn-secondary">Crear Paquete</a>
                <?php else: ?>
                  <a href="form_login.php" class="btn btn-primary">Iniciá sesión para crear paquetes</a>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php endif; ?>
        </div>
        

        <div class="cta-container">
           <!-- Botón Ver Paquetes -->
            <?php if (isset($_SESSION['id_cargo'])): ?>
              <a href="packages.php" class="btn btn-primary">Más afiliados</a>
            <?php else: ?>
              <a href="form_login.php" class="btn btn-primary">Iniciá sesión para ver los paquetes</a>
            <?php endif; ?>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
      <div class="container">
        <div class="about-content">
          <div class="about-text">
            <h2 class="section-title">Sobre Nosotros</h2>
            <p>
              En <strong>TurViajes</strong> nos dedicamos a crear experiencias
              de viaje inolvidables desde hace más de 15 años. Nuestro equipo de
              expertos selecciona cuidadosamente cada destino y alojamiento para
              garantizar la mejor experiencia.
            </p>
            <p>
              Contamos con guías locales experimentados y ofrecemos atención
              personalizada para que tu único trabajo sea disfrutar de tu viaje.
            </p>
            <a href="about.php" class="btn btn-secondary">Conocer más</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
      <div class="container">
        <div class="about-content">
          <div class="about-text">
        <h2 class="section-title">Contacto</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis optio, enim tempora eum magni perspiciatis. Veritatis consequuntur totam provident impedit, repudiandae labore culpa soluta at, nulla eaque iusto praesentium sint.</p>
        <a href="contact.php" class="btn btn-primary">Contactar</a>
      </div>
        </div>
      </div>
    </section>

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
              <li><a href="index.php" class="active" onclick="scrollToTop(event)">Inicio</a></li>
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