<?php session_start();?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nosotros - BA Tour</title>
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
        <li><a href="packages.php">Paquetes</a></li>
      <?php else: ?>
        <li><a href="form_login.php">Paquetes</a></li>
      <?php endif; ?>
      
      <li><a href="about.php" class="active">Nosotros</a></li>
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
    <section class="about-hero">
      <div class="hero-content">
        <h1>Sobre Nosotros</h1>
        <p>Más de 15 años creando experiencias inolvidables</p>
      </div>
    </section>

    <!-- About Main Content -->
    <section class="about-main">
      <div class="container">
        <div class="about-intro">
          <h2>Nuestra Historia</h2>
          <p>
            Buenos Aires Tour nació en 2010 con un sueño: hacer que cada viaje
            sea una experiencia transformadora. Desde entonces, hemos ayudado a
            más de 50,000 viajeros a descubrir los destinos más increíbles de
            Argentina, creando recuerdos que duran toda la vida.
          </p>
        </div>

        <!-- Timeline -->
        <div class="timeline">
          <div class="timeline-item">
            <div class="timeline-content">
              <h3>El Comienzo</h3>
              <p>
                Iniciamos operaciones con un pequeño equipo de 5 personas
                apasionadas por el turismo, ofreciendo tours por Buenos Aires.
              </p>
            </div>
            <div class="timeline-year">2010</div>
            <div style="width: 45%"></div>
          </div>

          <div class="timeline-item">
            <div style="width: 45%"></div>
            <div class="timeline-year">2013</div>
            <div class="timeline-content">
              <h3>Expansión Nacional</h3>
              <p>
                Ampliamos nuestros servicios para incluir los destinos más
                emblemáticos de Argentina: Bariloche, Mendoza y las Cataratas
                del Iguazú.
              </p>
            </div>
          </div>

          <div class="timeline-item">
            <div class="timeline-content">
              <h3>Reconocimiento Internacional</h3>
              <p>
                Recibimos el premio "Mejor Agencia de Turismo Regional" y
                comenzamos a recibir viajeros de todo el mundo.
              </p>
            </div>
            <div class="timeline-year">2017</div>
            <div style="width: 45%"></div>
          </div>

          <div class="timeline-item">
            <div style="width: 45%"></div>
            <div class="timeline-year">2020</div>
            <div class="timeline-content">
              <h3>Innovación Digital</h3>
              <p>
                Lanzamos nuestra plataforma digital y app móvil, permitiendo a
                nuestros clientes planificar y reservar sus viajes de forma más
                fácil.
              </p>
            </div>
          </div>

          <div class="timeline-item">
            <div class="timeline-content">
              <h3>Liderazgo en Turismo</h3>
              <p>
                Hoy somos líderes en turismo receptivo, con más de 100 empleados
                y presencia en los principales destinos turísticos del país.
              </p>
            </div>
            <div class="timeline-year">2025</div>
            <div style="width: 45%"></div>
          </div>
        </div>
      </div>
    </section>

    <!-- Values Section -->
    <section class="values-section">
      <div class="container">
        <h2 class="section-title">Nuestros Valores</h2>
        <div class="values-grid">
          <div class="value-card">
            <div class="value-icon">
              <i class="fas fa-heart"></i>
            </div>
            <h3>Pasión</h3>
            <p>
              Amamos lo que hacemos y eso se refleja en cada detalle de nuestros
              servicios.
            </p>
          </div>

          <div class="value-card">
            <div class="value-icon">
              <i class="fas fa-handshake"></i>
            </div>
            <h3>Compromiso</h3>
            <p>
              Nos comprometemos a superar las expectativas de nuestros clientes
              en cada viaje.
            </p>
          </div>

          <div class="value-card">
            <div class="value-icon">
              <i class="fas fa-globe-americas"></i>
            </div>
            <h3>Sostenibilidad</h3>
            <p>
              Promovemos el turismo responsable y la preservación de nuestros
              destinos.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
      <div class="container">
        <div class="stats-grid">
          <div class="stat-item">
            <div class="stat-number" data-count="50000">0</div>
            <div class="stat-label">Viajeros Felices</div>
          </div>
          <div class="stat-item">
            <div class="stat-number" data-count="250">0</div>
            <div class="stat-label">Destinos</div>
          </div>
          <div class="stat-item">
            <div class="stat-number" data-count="15">0</div>
            <div class="stat-label">Años de Experiencia</div>
          </div>
          <div class="stat-item">
            <div class="stat-number" data-count="98">0</div>
            <div class="stat-label">% Satisfacción</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Team Section -->
    <section class="team-section">
      <div class="container">
        <h2 class="section-title">Nuestro Equipo</h2>
        <div class="team-grid">
          <div class="team-member">
            <div class="member-photo">
              <img src="/api/placeholder/200/200" alt="María González" />
            </div>
            <h4 class="member-name">Jorge Argibay</h4>
            <p class="member-position">CEO & Fundadora</p>
            <div class="member-social">
              <a href="#"><i class="fab fa-linkedin"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
          </div>

          <div class="team-member">
            <div class="member-photo">
              <img src="/api/placeholder/200/200" alt="Carlos Rodríguez" />
            </div>
            <h4 class="member-name">Juan Ignacio Duran</h4>
            <p class="member-position">Director de Operaciones</p>
            <div class="member-social">
              <a href="#"><i class="fab fa-linkedin"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
          </div>

          <div class="team-member">
            <div class="member-photo">
              <img src="/api/placeholder/200/200" alt="Ana Martínez" />
            </div>
            <h4 class="member-name">Gonzalo Rojas</h4>
            <p class="member-position">Jefa de Marketing</p>
            <div class="member-social">
              <a href="#"><i class="fab fa-linkedin"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
          </div>

          <div class="team-member">
            <div class="member-photo">
              <img src="/api/placeholder/200/200" alt="Diego Silva" />
            </div>
            <h4 class="member-name">Matias Lema</h4>
            <p class="member-position">Coordinador de Guías</p>
            <div class="member-social">
              <a href="#"><i class="fab fa-linkedin"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Partners Section -->
    <section class="partners-section">
      <div class="container">
        <h2 class="section-title">Nuestros Aliados</h2>
        <div class="partners-grid">
          <div class="partner-logo">
            <img src="/api/placeholder/150/60" alt="Jorge Argibay" />
          </div>
          <div class="partner-logo">
            <img src="/api/placeholder/150/60" alt="Jorge Argibay" />
          </div>
          <div class="partner-logo">
            <img src="/api/placeholder/150/60" alt="Jorge Argibay" />
          </div>
          <div class="partner-logo">
            <img src="/api/placeholder/150/60" alt="Jorge Argibay" />
          </div>
          <div class="partner-logo">
            <img src="/api/placeholder/150/60" alt="Jorge Argibay" />
          </div>
          <div class="partner-logo">
            <img src="/api/placeholder/150/60" alt="Jorge Argibay" />
          </div>
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
                <li><a href="packages.php">Paquetes</a></li>
              <?php else: ?>
                <li><a href="form_login.php">Paquetes</a></li>
              <?php endif; ?>
              <li><a href="about.php" class="active" onclick="scrollToTop(event)">Nosotros</a></li>
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

