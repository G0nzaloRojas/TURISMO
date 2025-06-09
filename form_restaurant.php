<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BA Tour - Registro</title>
    <link rel="icon" type="image/png" href="Imagenes/Logo2.png">    
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/register.css" />
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
          <li><a href="index.php">Inicio</a></li>
          <li><a href="packages.html">Paquetes</a></li>
          <li><a href="about.html">Nosotros</a></li>
          <li><a href="contact.html">Contacto</a></li>
          <li><a href="form_register.php" class="active">Registrarse</a></li>
          <li><a href="form_login.php">Iniciar Sesión</a></li>
        </ul>
      </div>
    </nav>

    <!-- Registro Section -->
    <section class="register-section">
      <div class="container">
        <div class="register-container">
          <h2 class="section-title">Registra tu Restaurant</h2>
          <form class="register-form" action="registro.php" method="POST">

            <div class="form-group">
              <label for="nombre"><i class="fas fa-hotel"></i> Nombre del Restaurant</label>
              <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
              <label for="ubicacion"><i class="fas fa-map-marker-alt"></i> Ubicación</label>
              <input type="text" id="ubicacion" name="ubicacion" required>
            </div>

            <div class="form-group">
              <label for="tipo_comida"><i class="fas fa-user"></i> Tipo de Comida</label>
              <select id="tipo_comida" name="tipo_comida" required>
                <option value="">Seleccione un tipo de Comida</option>
                <option value="parrilla">Parrilla</option>
                <option value="asiatica">Asiatica</option>
                <option value="pizas y empanadas">Pizas y empanadas</option>
                <option value="pastas">Pastas</option>
                <option value="vegetariana">Vegetariana</option>
                <option value="vegana">Vegana</option>
              </select>

            <div class="form-group">
              <label for="precio_minimo"><i class="fas fa-tag"></i> Precio Mínimo</label>
              <input type="number" id="precio_minimo" name="precio_minimo" required>
            </div>

            <div class="form-group">
              <label for="precio_maximo"><i class="fas fa-tags"></i> Precio Máximo</label>
              <input type="number" id="precio_maximo" name="precio_maximo" required>
            </div>

            <div class="form-group">
              <label for="calificacion"><i class="fas fa-star"></i> Calificación</label>
              <input type="number" id="calificacion" name="calificacion" required>
            </div>

            <div class="form-group">
              <label for="descripcion"><i class="fas fa-users"></i> Descripcion del Restaurant</label>
              <input type="text" id="descripcion" name="descripcion" required>
            </div>

            <div class="form-group">
              <label class="checkbox-container">
                <input type="checkbox" required>
                Acepto los términos y condiciones
              </label>
            </div>

            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save"></i> Registrar Restaurant
            </button>
          </form>
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
              <li><a href="packages.html">Paquetes</a></li>
              <li><a href="about.html">Nosotros</a></li>
              <li><a href="contact.html">Contacto</a></li>
              <li><a href="form_register.php">Registrarse</a></li>
              <li><a href="form_login.php">Iniciar Sesión</a></li>
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
  </body>
</html> 