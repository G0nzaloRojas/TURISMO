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
        <li><a href="packages.php" class="active">Afiliados</a></li>
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
    <section class="packages-hero">
      <div class="hero-content">
        <h1>Nuestros mejores afiliados</h1>
        <p>Encuentra la aventura perfecta para tus próximas vacaciones</p>
      </div>
    </section>
    
    <?php
                include ("conexion.php");
                $consulta1 = mysqli_query($conexion, "SELECT * FROM hoteles
                ORDER BY (RAND())
                LIMIT 3;");

                $consulta2 = mysqli_query($conexion, "SELECT * FROM restaurantes
                ORDER BY (RAND())
                LIMIT 3;");

                $consulta3 = mysqli_query($conexion, "SELECT * FROM `puntos de interes`
                ORDER BY (RAND())
                LIMIT 3;");

                //$hotel = mysqli_fetch_assoc($consulta1);
                //$res mysqli_fetch_assoc($consulta2);
                //$punto_interes = mysqli_fetch_assoc($consulta3);

                // Guardar resultados en un array
                $hotel = [];

                if (mysqli_num_rows($consulta1) > 0) {
                    while ($fila =mysqli_fetch_assoc($consulta1)) {
                        $hotel[] = $fila;
                    }
                    
                }else{
                    echo "<div class='error-message'>No se encontraron resultados</div>";
                }


                // Guardar resultados en un array
                $restaurantes = [];

                if (mysqli_num_rows($consulta2) > 0) {
                    while ($fila2 =mysqli_fetch_assoc($consulta2)) {
                        $restaurantes[] = $fila2;
                    }
                    
                }else{
                    echo "<div class='error-message'>No se encontraron resultados</div>";
                }

                // Guardar resultados en un array
                $punto_interes = [];

                if (mysqli_num_rows($consulta3) > 0) {
                    while ($fila3 =mysqli_fetch_assoc($consulta3)) {
                      $punto_interes[] = $fila3;
                    }
                    
                }else{
                    echo "<div class='error-message'>No se encontraron resultados</div>";
                }



                for($i=0; $i<=$fila2; $i++)
                {
                    if($restaurantes[$i]['ID_COMIDA']==1){
                    $tipo_Comida="Parrilla";
                  }elseif($restaurantes[$i]['ID_COMIDA']==2){
                    $tipo_Comida="Asiática";
                  }elseif($restaurantes[$i]['ID_COMIDA']==3){
                    $tipo_Comida="Pizzas y Empanadas";
                  }elseif($restaurantes[$i]['ID_COMIDA']==4){
                    $tipo_Comida="Pastas";
                  }elseif($restaurantes[$i]['ID_COMIDA']==5){
                    $tipo_Comida="Vegetariana";
                  }else{
                    $tipo_Comida="Vegana";
                  }
                }
                  /*if($punto_interes['PRECIO']==0)
                    $precio ="Gratuito";

                    if($punto_interes['ID_ACTIVIDAD']==1){
                      $actividad="Cultural";
                    }elseif($punto_interes['ID_ACTIVIDAD']==2){
                      $actividad="Entretenimiento";
                    }elseif($punto_interes['ID_ACTIVIDAD']==3){
                      $actividad="Naturaleza";
                    }elseif($punto_interes['ID_ACTIVIDAD']==4){
                      $actividad="Vida Nocturna";
                    }elseif($punto_interes['ID_ACTIVIDAD']==5){
                      $actividad="Shopping";
                    }elseif($punto_interes['ID_ACTIVIDAD']==6){
                      $actividad="Monumento";
                    }else{
                      $actividad="Religioso";
                    }*/
                
                
             
    ?>
    <!-- Packages Main Section -->
    <section class="packages-main">
      <div class="container">
        <div class="results-info">
          <p class="results-count">
            Mostrando <span id="results-count">12</span> afiliados
          </p>
        </div>

        <div class="packages-grid" id="packages-grid">
          <!-- Package 1 -->
          <div
            class="package-card-extended"
            data-destination="buenos-aires"
            data-price="120"
            data-stars="4"
            data-meal="media-pension"
            data-duration="7"
          >
            <div class="package-image">
               <img src="<?= $hotel[0]['FOTO_URL'] ? 'uploads/hoteles/' . $hotel[0]['FOTO_URL'] : 'uploads/placeholder.jpg' ?>" 
                    alt="<?= $hotel[0]['NOMBRE'] ?>" 
                    onerror="this.src='uploads/placeholder.jpg'" />
              <span class="package-badge">Más vendido</span>
            </div>
            <div class="package-info">
              <div class="package-header">
                <div class="package-title">
                  <h3><?= $hotel[0]['NOMBRE']?></h3>
                  <p class="location">
                    <i class="fas fa-map-marker-alt"></i> <?= $hotel[0]['UBICACION']?>
                  </p>
                </div>
                <div class="package-rating">
                  <span class="stars">
                  <?php $calificacion = intval($hotel[0]['CALIFICACION']);
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $calificacion) {
                            echo '<i class="fas fa-star"></i>';
                        } else {
                            echo '<i class="far fa-star"></i>';
                        }
                    }
                  ?>
                  </span>
                  <span class="rating-number">(<?= $hotel[0]['CALIFICACION']?>)</span>
                </div>
              </div>
              <p class="description">
              <i class="fas fa-map-marker-alt"></i> <?= $hotel[0]['UBICACION']?>
              </p>
              <div class="package-features">
                <div class="feature">
                  <i class="fas fa-calendar"></i>
                  <span>Piscina: <?= $hotel[0]['PILETA']?></span>
                </div>
                <div class="feature">
                  <i class="fas fa-hotel"></i>
                  <span>Hotel <?= $hotel[0]['CALIFICACION']?> estrellas</span>
                </div>
                <div class="feature">
                  <i class="fas fa-utensils"></i>
                  <span>Desayuno: <?= $hotel[0]['DESAYUNO']?></span>
                </div>
                <div class="feature">
                  <i class="fas fa-plane"></i>
                  <span>Vuelos incluidos</span>
                </div>
              </div>
              <div class="package-price-section">
                <div class="price-details">
                  <!--<span class="old-price">Hasta $<?= $hotel[0]['PRECIO_MAXIMO']?></span>-->
                  <span class="current-price">Desde $<?= $hotel[0]['PRECIO_MINIMO']?></span>
                  <span class="price-note">Por persona</span>
                </div>
                <a href="formulario_busqueda.php" class="btn btn-secondary"
                  >Crea tu paquete</a
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
               <img src="<?= $restaurantes[0]['FOTO_URL'] ? 'uploads/restaurantes/' . $restaurantes[0]['FOTO_URL'] : 'uploads/placeholder.jpg' ?>" 
                    alt="<?= $restaurantes[0]['NOMBRE'] ?>" 
                    onerror="this.src='uploads/placeholder.jpg'" />
              <span class="package-badge">Recomendado</span>
            </div>
            <div class="package-info">
              <div class="package-header">
                <div class="package-title">
                  <h3><?= $restaurantes[0]['NOMBRE']?></h3>
                  <p class="location">
                    <i class="fas fa-map-marker-alt"></i> <?= $restaurantes[0]['UBICACION']?>
                  </p>
                </div>
                <div class="package-rating">
                  <span class="stars">
                  <?php $calificacion = intval($restaurantes[0]['CALIFICACION']);
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $calificacion) {
                            echo '<i class="fas fa-star"></i>';
                        } else {
                            echo '<i class="far fa-star"></i>';
                        }
                    }
                  ?>
                  </span>
                  <span class="rating-number">(<?= $restaurantes[0]['CALIFICACION']?>)</span>
                </div>
              </div>
              <p class="description">
              <?= $restaurantes[0]['DESCRIPCION']?>
              </p>
              <div class="package-features">
                <div class="feature">
                  <i class="fas fa-calendar"></i>
                  <span><?= $tipo_Comida?></span>
                </div>
                <div class="feature">
                  <i class="fas fa-hotel"></i>
                  <span><?= $restaurantes[0]['CALIFICACION']?> estrellas</span>
                </div>
                
              </div>
              <div class="package-price-section">
                <div class="price-details">
                  <!--<span class="old-price">Hasta $<?= $restaurantes[0]['PRECIO_MAXIMO']?></span>-->
                  <span class="current-price">Desde $<?= $restaurantes[0]['PRECIO_MINIMO']?></span>
                  <span class="price-note">Por persona</span>
                </div>
                <a href="formulario_busqueda.php" class="btn btn-secondary"
                  >Crea tu paquete</a
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
               <img src="<?= $punto_interes[0]['FOTO_URL'] ? 'uploads/puntos_interes/' . $punto_interes[0]['FOTO_URL'] : 'uploads/placeholder.jpg' ?>" 
                    alt="<?= $punto_interes[0]['NOMBRE'] ?>" 
                    onerror="this.src='uploads/placeholder.jpg'" />
              <span class="package-badge">Recomendado</span>
            </div>
            <div class="package-info">
              <div class="package-header">
                <div class="package-title">
                  <h3><?= $punto_interes[0]['NOMBRE']?></h3>
                  <p class="location">
                    <i class="fas fa-map-marker-alt"></i> <?= $punto_interes[0]['UBICACION']?>
                  </p>
                </div>
                <div class="package-rating">
                  <span class="stars">
                  <?php $calificacion = intval($punto_interes[0]['CALIFICACION']);
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $calificacion) {
                            echo '<i class="fas fa-star"></i>';
                        } else {
                            echo '<i class="far fa-star"></i>';
                        }
                    }
                  ?>
                  </span>
                  <span class="rating-number">(<?= $punto_interes[0]['CALIFICACION']?>)</span>
                </div>
              </div>
              <p class="description">
              <?= $punto_interes[0]['DESCRIPCION']?>
              </p>
              <div class="package-features">
                <div class="feature">
                  <i class="fas fa-calendar"></i>
                  <span>Centro Turístico</span>
                </div>
                <div class="feature">
                  <i class="fas fa-hotel"></i>
                  <span><?= $punto_interes[1]['CALIFICACION']?> estrellas</span>
                </div>
                
              </div>
              <div class="package-price-section">
                <div class="price-details">
                  <span class="current-price">$Gratuito</span>
                </div>
                <a href="formulario_busqueda.php" class="btn btn-secondary"
                  >Crea tu paquete</a
                >
              </div>
            </div>
          </div>

          

          <!-- Package 4 -->
          <div
            class="package-card-extended"
            data-destination="calafate"
            data-price="225000"
            data-stars="5"
            data-meal="pension-completa"
            data-duration="10"
          >
          <div class="package-image">
               <img src="<?= $hotel[1]['FOTO_URL'] ? 'uploads/hoteles/' . $hotel[1]['FOTO_URL'] : 'uploads/placeholder.jpg' ?>" 
                    alt="<?= $hotel[1]['NOMBRE'] ?>" 
                    onerror="this.src='uploads/placeholder.jpg'" />
              <span class="package-badge">Más vendido</span>
            </div>
            <div class="package-info">
              <div class="package-header">
                <div class="package-title">
                  <h3><?= $hotel[1]['NOMBRE']?></h3>
                  <p class="location">
                    <i class="fas fa-map-marker-alt"></i> <?= $hotel[1]['UBICACION']?>
                  </p>
                </div>
                <div class="package-rating">
                  <span class="stars">
                  <?php $calificacion = intval($hotel[1]['CALIFICACION']);
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $calificacion) {
                            echo '<i class="fas fa-star"></i>';
                        } else {
                            echo '<i class="far fa-star"></i>';
                        }
                    }
                  ?>
                  </span>
                  <span class="rating-number">(<?= $hotel[1]['CALIFICACION']?>)</span>
                </div>
              </div>
              <p class="description">
              <i class="fas fa-map-marker-alt"></i> <?= $hotel[1]['UBICACION']?>
              </p>
              <div class="package-features">
                <div class="feature">
                  <i class="fas fa-calendar"></i>
                  <span>Piscina: <?= $hotel[1]['PILETA']?></span>
                </div>
                <div class="feature">
                  <i class="fas fa-hotel"></i>
                  <span>Hotel <?= $hotel[1]['CALIFICACION']?> estrellas</span>
                </div>
                <div class="feature">
                  <i class="fas fa-utensils"></i>
                  <span>Desayuno: <?= $hotel[1]['DESAYUNO']?></span>
                </div>
                <div class="feature">
                  <i class="fas fa-plane"></i>
                  <span>Vuelos incluidos</span>
                </div>
              </div>
              <div class="package-price-section">
                <div class="price-details">
                  <!--<span class="old-price">Hasta $<?= $hotel[1]['PRECIO_MAXIMO']?></span>-->
                  <span class="current-price">Desde $<?= $hotel[1]['PRECIO_MINIMO']?></span>
                  <span class="price-note">Por persona</span>
                </div>
                <a href="formulario_busqueda.php" class="btn btn-secondary"
                  >Crea tu paquete</a
                >
              </div>
            </div>
          </div>

          <!-- Package 5 -->
          <div
            class="package-card-extended"
            data-destination="mendoza"
            data-price="142000"
            data-stars="4"
            data-meal="media-pension"
            data-duration="7"
          >
          <div class="package-image">
               <img src="<?= $restaurantes[1]['FOTO_URL'] ? 'uploads/restaurantes/' . $restaurantes[1]['FOTO_URL'] : 'uploads/placeholder.jpg' ?>" 
                    alt="<?= $restaurantes[1]['NOMBRE'] ?>" 
                    onerror="this.src='uploads/placeholder.jpg'" />
              <span class="package-badge">Recomendado</span>
            </div>
            <div class="package-info">
              <div class="package-header">
                <div class="package-title">
                  <h3><?= $restaurantes[1]['NOMBRE']?></h3>
                  <p class="location">
                    <i class="fas fa-map-marker-alt"></i> <?= $restaurantes[1]['UBICACION']?>
                  </p>
                </div>
                <div class="package-rating">
                  <span class="stars">
                  <?php $calificacion = intval($restaurantes[1]['CALIFICACION']);
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $calificacion) {
                            echo '<i class="fas fa-star"></i>';
                        } else {
                            echo '<i class="far fa-star"></i>';
                        }
                    }
                  ?>
                  </span>
                  <span class="rating-number">(<?= $restaurantes[1]['CALIFICACION']?>)</span>
                </div>
              </div>
              <p class="description">
              <?= $restaurantes[1]['DESCRIPCION']?>
              </p>
              <div class="package-features">
                <div class="feature">
                  <i class="fas fa-calendar"></i>
                  <span><?= $tipo_Comida?></span>
                </div>
                <div class="feature">
                  <i class="fas fa-hotel"></i>
                  <span><?= $restaurantes[1]['CALIFICACION']?> estrellas</span>
                </div>
                
              </div>
              <div class="package-price-section">
                <div class="price-details">
                  <!--<span class="old-price">Hasta $<?= $restaurantes[1]['PRECIO_MAXIMO']?></span>-->
                  <span class="current-price">Desde $<?= $restaurantes[1]['PRECIO_MINIMO']?></span>
                  <span class="price-note">Por persona</span>
                </div>
                <a href="formulario_busqueda.php" class="btn btn-secondary"
                  >Crea tu paquete</a
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
               <img src="<?= $punto_interes[1]['FOTO_URL'] ? 'uploads/puntos_interes/' . $punto_interes[1]['FOTO_URL'] : 'uploads/placeholder.jpg' ?>" 
                    alt="<?= $punto_interes[1]['NOMBRE'] ?>" 
                    onerror="this.src='uploads/placeholder.jpg'" />
              <span class="package-badge">Recomendado</span>
            </div>
            <div class="package-info">
              <div class="package-header">
                <div class="package-title">
                  <h3><?= $punto_interes[1]['NOMBRE']?></h3>
                  <p class="location">
                    <i class="fas fa-map-marker-alt"></i> <?= $punto_interes[1]['UBICACION']?>
                  </p>
                </div>
                <div class="package-rating">
                  <span class="stars">
                  <?php $calificacion = intval($punto_interes[1]['CALIFICACION']);
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $calificacion) {
                            echo '<i class="fas fa-star"></i>';
                        } else {
                            echo '<i class="far fa-star"></i>';
                        }
                    }
                  ?>
                  </span>
                  <span class="rating-number">(<?= $punto_interes[1]['CALIFICACION']?>)</span>
                </div>
              </div>
              <p class="description">
              <?= $punto_interes[1]['DESCRIPCION']?>
              </p>
              <div class="package-features">
                <div class="feature">
                  <i class="fas fa-calendar"></i>
                  <span>Centro Turístico</span>
                </div>
                <div class="feature">
                  <i class="fas fa-hotel"></i>
                  <span><?= $punto_interes[1]['CALIFICACION']?> estrellas</span>
                </div>
                
              </div>
              <div class="package-price-section">
                <div class="price-details">
                  
                  <span class="current-price">$Gratuito</span>
                  
                </div>
                <a href="formulario_busqueda.php" class="btn btn-secondary"
                  >Crea tu paquete</a
                >
              </div>
            </div>
          </div>

         
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
                <li><a href="packages.php" class="active" onclick="scrollToTop(event)">Afiliados</a></li>
              <?php else: ?>
                <li><a href="form_login.php">Afiliados</a></li>
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
              <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
              <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
              <a href="https://www.x.com/" target="_blank"><i class="fab fa-twitter"></i></a>
              <a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a>
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
