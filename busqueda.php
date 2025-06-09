<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Búsqueda - BA Tour</title>
    <link rel="stylesheet" href="CSS/styles.css">
    <link rel="icon" href="img/Logo2.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                    <h1>Buenos Aires Tour</h1>
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
                <li><a href="form_register.php">Registrarse</a></li>
                <li><a href="form_login.php">Iniciar Sesión</a></li>
            </ul>
        </div>
    </nav>

    <!-- Formulario de Búsqueda -->
    <div class="search-form">
        <form id="searchForm">
            <!-- Selección de Tipo de Hospedamiento -->
            <div class="form-section">
                <h2><i class="fas fa-bed"></i> Tipo de Hospedamiento</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label for="accommodation-type">Seleccione el tipo de hospedamiento</label>
                        <select id="accommodation-type" name="accommodation-type" onchange="toggleAccommodationForm()">
                            <option value="">Seleccionar tipo</option>
                            <option value="hotel">Hotel</option>
                            <option value="rental">Alquiler</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Formulario de Hotel -->
            <div id="hotel-form" class="form-section" style="display: none;">
                <h2><i class="fas fa-hotel"></i> Hoteles</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label for="hotel-rating">Calificación</label>
                        <select id="hotel-rating" name="hotel-rating">
                            <option value="">Seleccionar calificación</option>
                            <option value="3">3 estrellas</option>
                            <option value="4">4 estrellas</option>
                            <option value="5">5 estrellas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="max-guests">Huéspedes máximos</label>
                        <input type="number" id="max-guests" name="max-guests" min="1" max="10" placeholder="Número de huéspedes">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="hotel-services">Servicios incluidos</label>
                        <select id="hotel-services" name="hotel-services" multiple>
                            <option value="wifi">WiFi</option>
                            <option value="pool">Piscina</option>
                            <option value="spa">Spa</option>
                            <option value="gym">Gimnasio</option>
                            <option value="restaurant">Restaurante</option>
                            <option value="parking">Estacionamiento</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="room-type">Tipo de habitación</label>
                        <select id="room-type" name="room-type">
                            <option value="">Seleccionar tipo</option>
                            <option value="single">Individual</option>
                            <option value="double">Doble</option>
                            <option value="suite">Suite</option>
                            <option value="family">Familiar</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Formulario de Alquiler -->
            <div id="rental-form" class="form-section" style="display: none;">
                <h2><i class="fas fa-home"></i> Alquiler</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label for="property-type">Tipo de propiedad</label>
                        <select id="property-type" name="property-type">
                            <option value="">Seleccionar tipo</option>
                            <option value="apartment">Departamento</option>
                            <option value="house">Casa</option>
                            <option value="studio">Monoambiente</option>
                            <option value="villa">Villa</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="rental-rating">Calificación</label>
                        <select id="rental-rating" name="rental-rating">
                            <option value="">Seleccionar calificación</option>
                            <option value="3">3 estrellas</option>
                            <option value="4">4 estrellas</option>
                            <option value="5">5 estrellas</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="bedrooms">Cantidad de dormitorios</label>
                        <input type="number" id="bedrooms" name="bedrooms" min="1" max="10" placeholder="Número de dormitorios">
                    </div>
                    <div class="form-group">
                        <label for="bathrooms">Cantidad de baños</label>
                        <input type="number" id="bathrooms" name="bathrooms" min="1" max="5" placeholder="Número de baños">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="rental-services">Servicios incluidos</label>
                        <select id="rental-services" name="rental-services" multiple>
                            <option value="wifi">WiFi</option>
                            <option value="kitchen">Cocina equipada</option>
                            <option value="laundry">Lavandería</option>
                            <option value="parking">Estacionamiento</option>
                            <option value="air-conditioning">Aire acondicionado</option>
                            <option value="tv">TV</option>
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
                        <select id="food-type" name="food-type">
                            <option value="">Seleccionar tipo</option>
                            <option value="italiana">Italiana</option>
                            <option value="japonesa">Japonesa</option>
                            <option value="parrilla">Parrilla</option>
                            <option value="vegetariana">Vegetariana</option>
                            <option value="internacional">Internacional</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="restaurant-rating">Calificación</label>
                        <select id="restaurant-rating" name="restaurant-rating">
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
                        <select id="activity-type" name="activity-type">
                            <option value="">Seleccionar tipo de actividad</option>
                            <option value="cultural">Cultural</option>
                            <option value="deportiva">Deportiva</option>
                            <option value="gastronomica">Gastronómica</option>
                            <option value="naturaleza">Naturaleza</option>
                            <option value="entretenimiento">Entretenimiento</option>
                            <option value="shopping">Shopping</option>
                            <option value="nocturna">Vida Nocturna</option>
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
            const accommodationType = document.getElementById('accommodation-type').value;
            const hotelForm = document.getElementById('hotel-form');
            const rentalForm = document.getElementById('rental-form');

            // Ocultar ambos formularios primero
            hotelForm.style.display = 'none';
            rentalForm.style.display = 'none';

            // Mostrar el formulario correspondiente
            if (accommodationType === 'hotel') {
                hotelForm.style.display = 'block';
            } else if (accommodationType === 'rental') {
                rentalForm.style.display = 'block';
            }
        }
    </script>
</body>
</html> 