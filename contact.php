<?php session_start();?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contacto - BA Tour</title>
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
        <li><a href="packages.php">Afiliados</a></li>
      <?php else: ?>
        <li><a href="form_login.php">Afiliados</a></li>
      <?php endif; ?>
      
      <li><a href="about.php">Nosotros</a></li>
      <li><a href="contact.php" class="active">Contacto</a></li>
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
    <section class="contact-hero">
      <div class="hero-content">
        <h1>Contáctanos</h1>
        <p>Estamos aquí para ayudarte a planificar tu próxima aventura</p>
      </div>
    </section>

    <!-- Contact Main Section -->
    <section class="contact-main">
      <div class="container">
        <div class="contact-wrapper">
          <!-- Contact Sidebar -->
          <div class="contact-sidebar">
            <h2>Información de Contacto</h2>

            <div class="contact-item">
              <div class="contact-icon">
                <i class="fas fa-phone"></i>
              </div>
              <div class="contact-text">
                <h4>Teléfonos</h4>
                <p>+54 11 4567-8900</p>
                <p>+54 11 4567-8901</p>
                <p>WhatsApp: +54 9 11 3456-7890</p>
              </div>
            </div>

            <div class="contact-item">
              <div class="contact-icon">
                <i class="fas fa-envelope"></i>
              </div>
              <div class="contact-text">
                <h4>Email</h4>
                <p><a href="mailto:info@batour.com">info@batour.com</a></p>
                <p><a href="mailto:ventas@batour.com">ventas@batour.com</a></p>
              </div>
            </div>

            <div class="contact-item">
              <div class="contact-icon">
                <i class="fas fa-map-marker-alt"></i>
              </div>
              <div class="contact-text">
                <h4>Oficina Principal</h4>
                <p>Paris 532</p>
                <p>Haedo, Buenos Aires</p>
                <p>CP: B1706</p>
              </div>
            </div>

            <div class="contact-item">
              <div class="contact-icon">
                <i class="fas fa-clock"></i>
              </div>
              <div class="contact-text">
                <h4>Horario de Atención</h4>
                <p>Lunes a Viernes: 9:00 - 18:00</p>
                <p>Sábados: 10:00 - 14:00</p>
                <p>Domingos: Cerrado</p>
              </div>
            </div>

            <div class="social-links">
              <h4>Síguenos en redes sociales</h4>
              <div class="social-buttons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
              </div>
            </div>
          </div>

          <!-- Contact Form -->
          <div class="contact-form-wrapper">
            <h2>Envíanos un mensaje</h2>
            
            <!-- Mensajes de éxito y error -->
            <?php if (isset($_GET['exito']) && $_GET['exito'] == 1): ?>
              <div class="success-message show" id="success-message">
                <i class="fas fa-check-circle"></i> Tu mensaje ha sido enviado exitosamente. Te contactaremos pronto.
              </div>
            <?php elseif (isset($_GET['error']) && $_GET['error'] == 1): ?>
              <div class="error-message show" id="error-message">
                <i class="fas fa-exclamation-triangle"></i> Hubo un problema al enviar el mensaje. Por favor, intentá de nuevo más tarde.
              </div>
            <?php endif; ?>

            <form id="contact-form" action="backend/contactoBG.php" method="POST">
              <div class="form-row">
                <div class="form-group">
                  <label for="first-name">Nombre *</label>
                  <input
                    type="text"
                    id="first-name"
                    name="first-name"
                    required
                  />
                </div>
                <div class="form-group">
                  <label for="last-name">Apellido *</label>
                  <input type="text" id="last-name" name="last-name" required />
                </div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label for="email">Email *</label>
                  <input type="email" id="email" name="email" required />
                </div>
                <div class="form-group">
                  <label for="phone">Teléfono</label>
                  <input type="tel" id="phone" name="phone" />
                </div>
              </div>

              <div class="form-group full-width">
                <label for="destination">Destino de interés</label>
                <select id="destination" name="destination">
                  <option value="">Selecciona un destino</option>
                  <option value="buenos-aires">Buenos Aires</option>
                  <option value="bariloche">Bariloche</option>
                  <option value="mendoza">Mendoza</option>
                  <option value="iguazu">Cataratas del Iguazú</option>
                  <option value="calafate">El Calafate</option>
                  <option value="ushuaia">Ushuaia</option>
                  <option value="otros">Otros destinos</option>
                </select>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label for="travel-date">Fecha estimada de viaje</label>
                  <input type="date" id="travel-date" name="travel-date" />
                </div>
                <div class="form-group">
                  <label for="travelers">Número de viajeros</label>
                  <input
                    type="number"
                    id="travelers"
                    name="travelers"
                    min="1"
                    max="50"
                  />
                </div>
              </div>

              <div class="form-group full-width">
                <label for="message">Mensaje *</label>
                <textarea
                  id="message"
                  name="message"
                  rows="6"
                  required
                ></textarea>
              </div>

              <div class="form-checkbox">
                <input type="checkbox" id="newsletter" name="newsletter" />
                <label for="newsletter"
                  >Quiero recibir ofertas y novedades por email</label
                >
              </div>

              <div class="form-buttons">
                <button type="submit" class="btn-submit">
                  <i class="fas fa-paper-plane"></i> Enviar mensaje
                </button>
              </div>
            </form>
          </div>
        </div>

        <!-- Map Section -->
        <div class="map-section">
          <div class="map-container">
            <div class="map-header">
              <h3>Encuéntranos</h3>
              <p>Visítanos en nuestra oficina principal en Haedo</p>
            </div>
            <div class="map-frame">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3282.5591441865267!2d-58.60460592350203!3d-34.640579459447245!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bc951c0fe2d9f5%3A0x9f1c540898efecbe!2sUTN%20-%20Haedo%20Regional%20Faculty!5e0!3m2!1sen!2sar!4v1748544793666!5m2!1sen!2sar"
                width="1200"
                height="600"
                style="border: 0"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
              ></iframe>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Offices Section -->
    <section class="offices-section">
      <div class="container">
        <h2 class="section-title">Nuestras Oficinas</h2>
        <div class="offices-grid">
          <div class="office-card">
            <div class="office-icon">
              <i class="fas fa-building"></i>
            </div>
            <h4>Oficina Principal</h4>
            <div class="office-info">
              <p>
                <i class="fas fa-map-marker-alt"></i> París 532, Haedo,
                Provincia de Buenos Aires
              </p>
              <p><i class="fas fa-phone"></i> +54 11 4567-8900</p>
              <p><i class="fas fa-envelope"></i> info@batour.com</p>
            </div>
          </div>

          <div class="office-card">
            <div class="office-icon">
              <i class="fas fa-city"></i>
            </div>
            <h4>Sucursal Microcentro</h4>
            <div class="office-info">
              <p><i class="fas fa-map-marker-alt"></i> Florida 567, CABA</p>
              <p><i class="fas fa-phone"></i> +54 11 5555-1234</p>
              <p><i class="fas fa-envelope"></i> info@batour.com</p>
            </div>
          </div>

          <div class="office-card">
            <div class="office-icon">
              <i class="fas fa-plane"></i>
            </div>
            <h4>Aeropuerto Ezeiza</h4>
            <div class="office-info">
              <p><i class="fas fa-map-marker-alt"></i> Terminal A, Local 45</p>
              <p><i class="fas fa-phone"></i> +54 11 4480-5555</p>
              <p><i class="fas fa-envelope"></i> info@batour.com</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
      <div class="container">
        <h2 class="section-title">Preguntas Frecuentes</h2>
        <div class="faq-container">
          <div class="faq-item">
            <div class="faq-question">
              <span>¿Cómo puedo reservar un paquete turístico?</span>
              <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
              <p>
                Puedes reservar de varias formas: a través de nuestro formulario
                de contacto, llamando a nuestros teléfonos, visitando nuestras
                oficinas o enviándonos un email. Nuestros asesores te guiarán en
                todo el proceso.
              </p>
            </div>
          </div>

          <div class="faq-item">
            <div class="faq-question">
              <span>¿Qué incluyen los paquetes turísticos?</span>
              <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
              <p>
                Cada paquete incluye diferentes servicios que se detallan en la
                descripción. Generalmente incluyen: alojamiento, traslados,
                excursiones guiadas, y régimen de comidas especificado. Los
                vuelos pueden estar incluidos o cotizarse aparte según tu
                preferencia.
              </p>
            </div>
          </div>

          <div class="faq-item">
            <div class="faq-question">
              <span>¿Cuáles son las formas de pago disponibles?</span>
              <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
              <p>
                Aceptamos múltiples formas de pago: efectivo, transferencia
                bancaria, tarjetas de crédito y débito. Ofrecemos planes de
                financiación en cuotas sin interés con tarjetas seleccionadas.
                Consulta las promociones vigentes.
              </p>
            </div>
          </div>

          <div class="faq-item">
            <div class="faq-question">
              <span>¿Puedo modificar o cancelar mi reserva?</span>
              <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
              <p>
                Sí, puedes modificar o cancelar tu reserva según nuestras
                políticas. Las modificaciones están sujetas a disponibilidad y
                pueden tener costos adicionales. Las cancelaciones tienen
                diferentes penalidades según la anticipación. Te recomendamos
                contratar un seguro de viaje.
              </p>
            </div>
          </div>

          <div class="faq-item">
            <div class="faq-question">
              <span>¿Ofrecen paquetes personalizados?</span>
              <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
              <p>
                ¡Por supuesto! Podemos crear paquetes a medida según tus
                preferencias, presupuesto y fechas. Cuéntanos qué tipo de
                experiencia buscas y nuestros expertos diseñarán el viaje
                perfecto para ti.
              </p>
            </div>
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
              <li><a href="index.php" >Inicio</a></li>
              <?php if (isset($_SESSION['id_cargo'])): ?>
                <li><a href="packages.php">Paquetes</a></li>
              <?php else: ?>
                <li><a href="form_login.php">Paquetes</a></li>
              <?php endif; ?>
              <li><a href="about.php">Nosotros</a></li>
              <li><a href="contact.php" class="active" onclick="scrollToTop(event)">Contacto</a></li>
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

    <script>
      // Toggle mobile menu
      const menuToggle = document.querySelector(".menu-toggle");
      const navMenu = document.querySelector(".nav-menu");

      menuToggle.addEventListener("click", () => {
        navMenu.classList.toggle("active");
      });

      // FAQ Accordion
      const faqQuestions = document.querySelectorAll(".faq-question");

      faqQuestions.forEach((question) => {
        question.addEventListener("click", () => {
          const faqItem = question.parentElement;
          const answer = faqItem.querySelector(".faq-answer");
          const isActive = question.classList.contains("active");

          // Close all other FAQs
          faqQuestions.forEach((q) => {
            q.classList.remove("active");
            q.parentElement
              .querySelector(".faq-answer")
              .classList.remove("active");
          });

          // Toggle current FAQ
          if (!isActive) {
            question.classList.add("active");
            answer.classList.add("active");
          }
        });
      });

      // Set minimum date to today for travel date input
      const travelDateInput = document.getElementById("travel-date");
      const today = new Date().toISOString().split("T")[0];
      travelDateInput.setAttribute("min", today);

      function scrollToTop(event) {
          event.preventDefault();
          window.scrollTo({
              top: 0,
              behavior: 'smooth'
          });
      }

      // Auto-hide success/error messages after 5 seconds
      setTimeout(() => {
        const successMessage = document.getElementById("success-message");
        const errorMessage = document.getElementById("error-message");
        
        if (successMessage && successMessage.classList.contains("show")) {
          successMessage.classList.remove("show");
        }
        if (errorMessage && errorMessage.classList.contains("show")) {
          errorMessage.classList.remove("show");
        }
      }, 5000);
    </script>

    <style>
      /* Estilos para los mensajes de éxito y error */
      .success-message, .error-message {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        display: none;
        align-items: center;
        gap: 10px;
        font-weight: 500;
      }

      .success-message {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
      }

      .error-message {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
      }

      .success-message.show, .error-message.show {
        display: flex;
      }

      .success-message i, .error-message i {
        font-size: 1.2em;
      }
    </style>
  </body>
</html>