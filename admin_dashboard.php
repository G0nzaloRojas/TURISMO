<?php 
session_start();

// Verificar si el usuario está logueado y es admin o dueño de negocio
if (!isset($_SESSION['id_cargo']) || ($_SESSION['id_cargo'] != 1 && $_SESSION['id_cargo'] != 3)) {
    header("Location: form_login.php");
    exit();
}

include("conexion.php");

// Obtener datos del usuario
$user_name = $_SESSION['nombre'] ?? 'Usuario';
$user_role = $_SESSION['id_cargo'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BA Tour - Administrador de Negocios</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="logo">
                <a href="index.php">
                    <img src="img/LOGO_BA.png" alt="Logo BA Tour" height="65" />
                </a>
            </div>

            <button class="new-business-btn" onclick="openBusinessModal()">
                <i class="fas fa-plus"></i>
                <span id="addButtonText">Nuevo Negocio</span>
            </button>

            <div class="projects-section">
                <h2>Categorías</h2>
                <ul class="project-list" id="projectList">
                    <li class="project-item active" data-project="restaurantes">
                        <div class="project-icon"></div>
                        Restaurantes
                    </li>
                    <li class="project-item" data-project="hoteles">
                        <div class="project-icon"></div>
                        Hoteles
                    </li>
                    <li class="project-item" data-project="alquiler">
                        <div class="project-icon"></div>
                        Alquileres
                    </li>
                    <li class="project-item" data-project="puntos_interes">
                        <div class="project-icon"></div>
                        Puntos de Interés
                    </li>
                    <?php if ($user_role == 1): // Solo mostrar para administradores ?>
                    <li class="project-item" data-project="usuarios">
                        <div class="project-icon"></div>
                        Usuarios
                    </li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="stats-footer">
                <span id="businessCount">0</span> <span id="countLabel">Negocios Registrados</span>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <button class="mobile-menu-btn" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="user-greeting">Hola, <?php echo htmlspecialchars($user_name); ?></div>
                <a href="logout.php" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a>
            </header>

            <!-- Task Input Section -->
            <section class="task-input-section">
                <input type="text" class="task-input" placeholder="Buscar..." id="searchInput">
                <br>
                <button class="add-task-btn" onclick="openBusinessModal()">
                    <i class="fas fa-plus"></i> <span id="addButtonText2">Agregar Negocio</span>
                </button>
            </section>

            <!-- Project Section -->
            <section class="project-section">
                <div class="project-header">
                    <h1 class="project-title" id="projectTitle">Categoría: Restaurantes</h1>
                </div>

                <div class="loading" id="loading">
                    <i class="fas fa-spinner fa-spin"></i> Cargando...
                </div>

                <div class="business-grid" id="businessGrid">
                    <!-- Las tarjetas de negocios se generarán aquí dinámicamente -->
                </div>
            </section>
        </main>
    </div>

    <!-- Modal para agregar/editar negocio -->
    <div id="businessModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">Agregar Nuevo Negocio</h2>
                <span class="close" onclick="closeBusinessModal()">&times;</span>
            </div>
            <div id="modalMessage"></div>
            <form id="businessForm" enctype="multipart/form-data">
                <input type="hidden" id="businessId">
                <input type="hidden" id="businessCategory">
                
                <div class="form-group">
                    <label class="form-label" for="businessName">Nombre del Negocio *</label>
                    <input type="text" class="form-input" id="businessName" >
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="businessLocation">Ubicación *</label>
                    <input type="text" class="form-input" id="businessLocation" >
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="businessDescription">Descripción *</label>
                    <textarea class="form-textarea" id="businessDescription" placeholder="Describe tu negocio..." ></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label" for="businessPhoto">Foto del Negocio</label>
                    <input type="file" class="form-input" id="businessPhoto" accept="image/*">
                    <div id="currentPhoto" style="margin-top: 10px; display: none;">
                        <p>Foto actual:</p>
                        <img id="currentPhotoImg" src="" alt="Foto actual" style="max-width: 200px; max-height: 150px;">
                    </div>
                </div>

                <!-- Campos específicos por categoría -->
                <div id="restauranteFields" style="display: none;">
                    <div class="form-group">
                        <label class="form-label" for="tipoComida">Tipo de Comida</label>
                        <select class="form-select" id="tipoComida">
                            <option value="" selected disabled>Seleccionar tipo</option>
                            <option value="Parrilla">Parrilla</option>
                            <option value="Asiatica">Asiatica</option>
                            <option value="pizas y empanadas">Pizas y empanadas</option>
                            <option value="pastas">Pastas</option>
                            <option value="vegetariana">Vegetariana</option>
                            <option value="vegana">Vegana</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="precioMinimo">Precio Mínimo</label>
                            <input type="number" class="form-input" id="precioMinimo">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="precioMaximo">Precio Máximo</label>
                            <input type="number" class="form-input" id="precioMaximo">
                        </div>
                    </div>
                </div>

                <div id="hotelFields" style="display: none;">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="precioMinimoHotel">Precio Mínimo</label>
                            <input type="number" class="form-input" id="precioMinimoHotel">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="precioMaximoHotel">Precio Máximo</label>
                            <input type="number" class="form-input" id="precioMaximoHotel">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="calificacion">Calificación</label>
                            <input type="number" class="form-input" id="calificacion" min="1" max="5" step="0.1">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="huespedes">Huéspedes</label>
                            <input type="number" class="form-input" id="huespedes" min="1">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="pileta">¿Tiene Pileta?</label>
                            <select class="form-select" id="pileta">
                                <option value="no">No</option>
                                <option value="si">Sí</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="desayuno">¿Incluye Desayuno?</label>
                            <select class="form-select" id="desayuno">
                                <option value="no">No</option>
                                <option value="si">Sí</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="alquilerFields" style="display: none;">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="precioSemana">Precio por Semana</label>
                            <input type="number" class="form-input" id="precioSemana">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="calificacionAlquiler">Calificación</label>
                            <input type="number" class="form-input" id="calificacionAlquiler" min="1" max="10">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="banios">Baños</label>
                            <input type="number" class="form-input" id="banios" min="1">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="dormitorios">Dormitorios</label>
                            <input type="number" class="form-input" id="dormitorios" min="1">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="camasDobles">Camas Dobles</label>
                            <input type="number" class="form-input" id="camasDobles" min="0">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="camasSimples">Camas Simples</label>
                            <input type="number" class="form-input" id="camasSimples" min="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="metros">Metros Cuadrados</label>
                        <input type="number" class="form-input" id="metros" min="1">
                    </div>
                </div>

                <div id="puntosInteresFields" style="display: none;">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="actividad">Tipo de Actividad</label>
                            <select class="form-select" id="actividad">
                                <option value="" selected disabled>Seleccionar actividad</option>
                                <option value="Cultural">Cultural</option>
                                <option value="Entretenimiento">Entretenimiento</option>
                                <option value="Naturaleza">Naturaleza</option>
                                <option value="Vida Nocturna">Vida Nocturna</option>
                                <option value="Shopping">Shopping</option>
                                <option value="Monumento">Monumento</option>
                                <option value="Centros Religiosos">Centros Religiosos</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="precio">Precio</label>
                            <input type="number" class="form-input" id="precio" min="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="calificacionPunto">Calificación</label>
                        <input type="number" class="form-input" id="calificacionPunto" min="1" max="5" step="0.1">
                    </div>
                </div>

                <!-- Campos para usuarios -->
                <div id="usuarioFields" style="display: none;">
                    <div class="form-group">
                        <label class="form-label" for="usuarioNombre">Nombre *</label>
                        <input type="text" class="form-input" id="usuarioNombre" >
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="usuarioApellido">Apellido *</label>
                        <input type="text" class="form-input" id="usuarioApellido" >
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="usuarioEmail">Email *</label>
                        <input type="email" class="form-input" id="usuarioEmail" >
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="usuarioPassword">Contraseña *</label>
                        <input type="password" class="form-input" id="usuarioPassword" >
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="usuarioCargo">Cargo *</label>
                        <select class="form-select" id="usuarioCargo" >
                            <option value="">Seleccionar cargo</option>
                            <option value="1">Administrador</option>
                            <option value="3">Dueño de Negocio</option>
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn-cancel" onclick="closeBusinessModal()">Cancelar</button>
                    <button type="submit" class="btn-save">Guardar</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        // Pasar datos de PHP a JavaScript
        window.userRole = <?php echo $user_role; ?>;
    </script>
    <script src="js/dashboard.js"></script>
</body>
</html>