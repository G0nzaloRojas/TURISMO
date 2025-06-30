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
          <li><a href="packages.php">Afiliados</a></li>
          <li><a href="about.php">Nosotros</a></li>
          <li><a href="contact.php">Contacto</a></li>
          <li><a href="form_register.php" class="active">Registrarse</a></li>
          <li><a href="form_login.php">Iniciar Sesión</a></li>
        </ul>
      </div>
    </nav>

    <!-- Registro Section -->
    <section class="register-section">
      <div class="container">
        <div class="register-container">
          <h2 class="section-title">Crear una cuenta</h2>
          <form class="register-form" action="registro.php" method="POST">

            <div class="form-group">
              <label for="nombre"><i class="fas fa-user"></i> Nombre </label>
              <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
              <label for="apellido"><i class="fas fa-user"></i> Apellido </label>
              <input type="text" id="apellido" name="apellido" required>
            </div>

            <div class="form-group">
              <label for="email"><i class="fas fa-envelope"></i> Correo electrónico</label>
              <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
              <label for="username"><i class="fas fa-user"></i> Nombre de usuario</label>
              <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
              <label for="id_cargo"><i class="fas fa-user"></i> Tipo de usuario</label>
              <select id="id_cargo" name="id_cargo" required>
                <option value="">Seleccione un tipo de usuario</option>
                <option value="USUARIO NORMAL">Usuario Normal</option>
                <option value="DUEÑO DE NEGOCIO">Dueño de Negocio</option>
              </select>
            </div>

            <div class="form-group">
              <label for="password"><i class="fas fa-lock"></i> Contraseña</label>
              <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
              <label class="checkbox-container">
                <input type="checkbox" required>
                Acepto los términos y condiciones
              </label>
            </div>

            <button type="submit" class="btn btn-primary">Registrarse</button>
          </form>
          <p class="login-link">
            ¿Ya tienes una cuenta? <a href="form_login.php">Iniciar sesión</a>
          </p>
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
              <li><a href="packages.php">Afiliados</a></li>
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