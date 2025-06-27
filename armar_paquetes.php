<?php session_start();
  if(isset($_SESSION["id_cargo"])){
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Resultados - BA Tour</title>
    <link rel="icon" type="image/png" href="Imagenes/Logo2.png">    
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="icon" href="img/Logo2.ico" type="image/x-icon">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <link rel="stylesheet" href="css/armar_paquetes.css">
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

    <!-- Contenido principal -->
<div style="margin-top: 100px;">
        <?php
                include ("conexion.php");

                // Obtener parámetros del formulario
                $tipo_hospedaje = $_POST['accommodation-type'] ?? null;
                $calificacion_hotel = $_POST['hotel-rating'] ?? null;
                $huespedes_max = $_POST['max-guests'] ?? null;
                $pileta = $_POST['pileta'] ?? null;
                $desayuno = $_POST['desayuno'] ?? null;
                $dias_hotel = $_POST['dias_hotel'] ?? null;
                $calificacion_alquiler = $_POST['rental-rating'] ?? null;
                $cantidad_camas_simples = $_POST['single_bed'] ?? null;
                $cantidad_camas_dobles = $_POST['double_bed'] ?? null;
                $cantidad_baños = $_POST['bathrooms'] ?? null;
                $metros_cuadrados = $_POST['metros2_minimos'] ?? null;
                $semanas_alquiler = $_POST['semanas_alquiler'] ?? null;
                $tipo_comida = $_POST['food-type'] ?? null;
                $calificacion_restaurante = $_POST['restaurant-rating'] ?? null;
                $tipo_actividad = $_POST['activity-type'] ?? null;

                // Arrays para almacenar los resultados
                $paquetes = array(
                    'economico' => array('hoteles' => [], 'alquileres' => [], 'restaurantes' => []),
                    'intermedio' => array('hoteles' => [], 'alquileres' => [], 'restaurantes' => []),
                    'premium' => array('hoteles' => [], 'alquileres' => [], 'restaurantes' => [])
                );

                // CONSULTAS PARA HOTELES
                if($tipo_hospedaje == "hotel") {
                    // Hotel Económico
                    $consulta_hotel_eco = mysqli_query($conexion, "SELECT * FROM hoteles WHERE ((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) <= (SELECT MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) + (MAX((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) - MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2)) / 3 FROM hoteles) AND HUESPEDES >= '$huespedes_max' AND CALIFICACION >= $calificacion_hotel ORDER BY CALIFICACION DESC LIMIT 1");
                    
                    // Hotel Intermedio
                    $consulta_hotel_inter = mysqli_query($conexion, "SELECT * FROM hoteles WHERE ((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) > (SELECT MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) + (MAX((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) - MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2)) / 3 FROM hoteles) AND ((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) <= (SELECT MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) + 2 * (MAX((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) - MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2)) / 3 FROM hoteles) AND HUESPEDES >= '$huespedes_max' AND CALIFICACION >= '$calificacion_hotel' ORDER BY CALIFICACION DESC LIMIT 1");
                    
                    // Hotel Caro
                    $consulta_hotel_caro = mysqli_query($conexion, "SELECT * FROM hoteles WHERE ((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) > (SELECT MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) + 2 * (MAX((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) - MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2)) / 3 FROM hoteles) AND HUESPEDES >= '$huespedes_max' AND CALIFICACION >= '$calificacion_hotel' ORDER BY CALIFICACION DESC LIMIT 1");

                    // Almacenar resultados
                    while ($fila = mysqli_fetch_assoc($consulta_hotel_eco)) {
                        $paquetes['economico']['hoteles'][] = $fila;
                    }
                    while ($fila = mysqli_fetch_assoc($consulta_hotel_inter)) {
                        $paquetes['intermedio']['hoteles'][] = $fila;
                    }
                    while ($fila = mysqli_fetch_assoc($consulta_hotel_caro)) {
                        $paquetes['premium']['hoteles'][] = $fila;
                    }
                }

                // CONSULTAS PARA ALQUILERES
                if($tipo_hospedaje == "alquiler") {
                    // Alquiler Económico
                    $consulta_alq_eco = mysqli_query($conexion, "SELECT * FROM alquiler WHERE PRECIO_SEMANA <= (SELECT MIN(PRECIO_SEMANA) + (MAX(PRECIO_SEMANA) - MIN(PRECIO_SEMANA)) / 3 FROM alquiler) AND CALIFICACION >= $calificacion_alquiler AND BANIOS >= $cantidad_baños AND CAMAS_DOBLES >= $cantidad_camas_dobles AND CAMAS_SIMPLES >= $cantidad_camas_simples AND METROS >= $metros_cuadrados ORDER BY CALIFICACION DESC, METROS DESC LIMIT 1");
                    
                    // Alquiler Intermedio
                    $consulta_alq_inter = mysqli_query($conexion, "SELECT * FROM alquiler WHERE PRECIO_SEMANA > (SELECT MIN(PRECIO_SEMANA) + (MAX(PRECIO_SEMANA) - MIN(PRECIO_SEMANA)) / 3 FROM alquiler) AND PRECIO_SEMANA <= (SELECT MIN(PRECIO_SEMANA) + 2 * (MAX(PRECIO_SEMANA) - MIN(PRECIO_SEMANA)) / 3 FROM alquiler) AND CALIFICACION >= $calificacion_alquiler AND BANIOS >= $cantidad_baños AND CAMAS_DOBLES >= $cantidad_camas_dobles AND CAMAS_SIMPLES >= $cantidad_camas_simples AND METROS >= $metros_cuadrados ORDER BY CALIFICACION DESC, METROS DESC LIMIT 1");
                    
                    // Alquiler Caro
                    $consulta_alq_caro = mysqli_query($conexion, "SELECT * FROM alquiler WHERE PRECIO_SEMANA > (SELECT MIN(PRECIO_SEMANA) + 2 * (MAX(PRECIO_SEMANA) - MIN(PRECIO_SEMANA)) / 3 FROM alquiler) AND CALIFICACION >= $calificacion_alquiler AND BANIOS >= $cantidad_baños AND CAMAS_DOBLES >= $cantidad_camas_dobles AND CAMAS_SIMPLES >= $cantidad_camas_simples AND METROS >= $metros_cuadrados ORDER BY CALIFICACION DESC, METROS DESC LIMIT 1");

                    // Almacenar resultados
                    while ($fila = mysqli_fetch_assoc($consulta_alq_eco)) {
                        $paquetes['economico']['alquileres'][] = $fila;
                    }
                    while ($fila = mysqli_fetch_assoc($consulta_alq_inter)) {
                        $paquetes['intermedio']['alquileres'][] = $fila;
                    }
                    while ($fila = mysqli_fetch_assoc($consulta_alq_caro)) {
                        $paquetes['premium']['alquileres'][] = $fila;
                    }
                }

                // CONSULTAS PARA RESTAURANTES
                // Restaurantes Económicos
                $consulta_rest_eco = mysqli_query($conexion, "
                                                                SELECT r.*, tc.DESCRIPCION as TIPO_COMIDA_DESC 
                                                                FROM restaurantes r 
                                                                INNER JOIN `tipo de comida` tc ON r.ID_COMIDA = tc.ID 
                                                                WHERE ((r.PRECIO_MINIMO + r.PRECIO_MAXIMO) / 2) <= 
                                                                (SELECT MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) + 
                                                                ((MAX((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) - MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2)) / 3) 
                                                                FROM restaurantes WHERE ($tipo_comida = 7 OR ID_COMIDA = $tipo_comida)) 
                                                                AND ($tipo_comida = 7 OR r.ID_COMIDA = $tipo_comida) 
                                                                ORDER BY r.CALIFICACION DESC LIMIT 2
                                                            ");
                $consulta_rest_inter = mysqli_query($conexion, "
                                                                    SELECT r.*, tc.DESCRIPCION as TIPO_COMIDA_DESC 
                                                                    FROM restaurantes r 
                                                                    INNER JOIN `tipo de comida` tc ON r.ID_COMIDA = tc.ID 
                                                                    WHERE ((r.PRECIO_MINIMO + r.PRECIO_MAXIMO) / 2) > 
                                                                    (SELECT MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) + 
                                                                    ((MAX((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) - MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2)) / 3) 
                                                                    FROM restaurantes WHERE ($tipo_comida = 7 OR ID_COMIDA = $tipo_comida)) 
                                                                    AND ((r.PRECIO_MINIMO + r.PRECIO_MAXIMO) / 2) <= 
                                                                    (SELECT MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) + 
                                                                    (2 * ((MAX((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) - MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2)) / 3)) 
                                                                    FROM restaurantes WHERE ($tipo_comida = 7 OR ID_COMIDA = $tipo_comida)) 
                                                                    AND ($tipo_comida = 7 OR r.ID_COMIDA = $tipo_comida) 
                                                                    ORDER BY r.CALIFICACION DESC LIMIT 2
                                                                ");

                // Restaurantes Caros
                $consulta_rest_caro = mysqli_query($conexion, "
                                                                SELECT r.*, tc.DESCRIPCION as TIPO_COMIDA_DESC 
                                                                FROM restaurantes r 
                                                                INNER JOIN `tipo de comida` tc ON r.ID_COMIDA = tc.ID 
                                                                WHERE ((r.PRECIO_MINIMO + r.PRECIO_MAXIMO) / 2) > 
                                                                (SELECT MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) + 
                                                                (2 * ((MAX((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) - MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2)) / 3)) 
                                                                FROM restaurantes WHERE ($tipo_comida = 7 OR ID_COMIDA = $tipo_comida)) 
                                                                AND ($tipo_comida = 7 OR r.ID_COMIDA = $tipo_comida) 
                                                                ORDER BY r.CALIFICACION DESC LIMIT 2
                                                            ");
                // Almacenar resultados de restaurantes
                while ($fila = mysqli_fetch_assoc($consulta_rest_eco)) {
                    $paquetes['economico']['restaurantes'][] = $fila;
                }
                while ($fila = mysqli_fetch_assoc($consulta_rest_inter)) {
                    $paquetes['intermedio']['restaurantes'][] = $fila;
                }
                while ($fila = mysqli_fetch_assoc($consulta_rest_caro)) {
                    $paquetes['premium']['restaurantes'][] = $fila;
                }

                // Puntos de interés (mismos para todos los paquetes)
                $consulta_puntos = mysqli_query($conexion, "
                                                                SELECT pi.*, a.DESCRIPCION as ACTIVIDAD_DESC 
                                                                FROM `puntos de interes` pi 
                                                                INNER JOIN actividad a ON pi.ID_ACTIVIDAD = a.ID 
                                                                WHERE pi.ID_ACTIVIDAD = $tipo_actividad 
                                                                ORDER BY RAND() LIMIT 4
                                                            ");
                $puntos_interes = [];
                while ($fila = mysqli_fetch_assoc($consulta_puntos)) {
                    $puntos_interes[] = $fila;
                }
        ?>

    <div class="paquetes-main-content">
        <h1 class="paquetes-title">Resultados de Busqueda</h1>
        
        <?php 
        $nombres_paquetes = array(
            'economico' => 'Paquete Económico',
            'intermedio' => 'Paquete Intermedio', 
            'premium' => 'Paquete Premium'
        );

        foreach($paquetes as $tipo_paquete => $contenido_paquete): 
        ?>
        <div class="paquetes-container">    
            <!-- BLOQUE DEL PAQUETE -->
            <div class="paquete-card paquete-<?= $tipo_paquete ?>">
                <div class="paquete-header"><?= $nombres_paquetes[$tipo_paquete] ?></div>
                <div class="paquete-content">
                    
                    <!-- HOSPEDAJES -->
                    <?php if ($tipo_hospedaje == "hotel"): ?>
                        <div class="paquete-section">
                            <h3 class="paquete-section-title">Hotel <?= ucfirst($tipo_paquete) ?></h3>
                            <?php if (!empty($contenido_paquete['hoteles'])): ?>
                                <div class="hospedaje-card">
                                    <!-- Contenido principal - imagen y datos -->
                                    <div class="card-main-content">
                                        <!-- Sección de imagen -->
                                        <div class="image-section">
                                            <img src="<?= $contenido_paquete['hoteles'][0]['FOTO_URL'] ? 'uploads/hoteles/' . $contenido_paquete['hoteles'][0]['FOTO_URL'] : 'uploads/placeholder.jpg' ?>" 
                                                alt="<?= htmlspecialchars($contenido_paquete['hoteles'][0]['NOMBRE']) ?>" 
                                                class="item-image"
                                                onerror="this.src='uploads/placeholder.jpg'">
                                        </div>
                                        
                                        <!-- Sección de contenido -->
                                        <div class="content-section">
                                            <div class="item-header">
                                                <h4 class="item-name"><?= htmlspecialchars($contenido_paquete['hoteles'][0]['NOMBRE']) ?></h4>
                                                <span class="item-rating"><?= $contenido_paquete['hoteles'][0]['CALIFICACION'] ?> ⭐</span>
                                            </div>
                                            <p class="item-description">🏊‍♀️ Pileta: <?= ucfirst($contenido_paquete['hoteles'][0]['PILETA']) ?></p>
                                            <p class="item-description">🍳 Desayuno: <?= ucfirst($contenido_paquete['hoteles'][0]['DESAYUNO']) ?></p>
                                            <p class="item-location"><?= htmlspecialchars($contenido_paquete['hoteles'][0]['UBICACION']) ?></p>
                                        </div>
                                    </div>
                                    
                                    <!-- Sección de precio -->
                                    <div class="price-section">
                                        <div class="price-content">
                                            <p class="item-price">Precio Por Noche: $<?= number_format((($contenido_paquete['hoteles'][0]['PRECIO_MAXIMO']+$contenido_paquete['hoteles'][0]['PRECIO_MINIMO'])/2), 2) ?></p>
                                            <p class="item-price-total">Total (<?= $dias_hotel ?> días): $<?= number_format(((($contenido_paquete['hoteles'][0]['PRECIO_MAXIMO']+$contenido_paquete['hoteles'][0]['PRECIO_MINIMO'])/2)*$dias_hotel), 2) ?></p>
                                        </div>
                                        
                                        <?php if (!empty($contenido_paquete['hoteles'][0]['URL'])): ?>
                                            <a href="<?= htmlspecialchars($contenido_paquete['hoteles'][0]['URL']) ?>" 
                                               target="_blank" 
                                               class="btn-consultar">
                                                <i class="fas fa-external-link-alt"></i> Consultar
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="error-message">No se encontró hotel <?= $tipo_paquete ?>.</div>
                            <?php endif; ?>
                        </div>

                    <?php elseif ($tipo_hospedaje == "alquiler"): ?>
                        <div class="paquete-section">
                            <h3 class="paquete-section-title">Alquiler <?= ucfirst($tipo_paquete) ?></h3>
                            <?php if (!empty($contenido_paquete['alquileres'])): ?>
                                <div class="hospedaje-card">
                                    <!-- Contenido principal - imagen y datos -->
                                    <div class="card-main-content">
                                        <!-- Sección de imagen -->
                                        <div class="image-section">
                                            <img src="<?= $contenido_paquete['alquileres'][0]['FOTO_URL'] ? 'uploads/alquiler/' . $contenido_paquete['alquileres'][0]['FOTO_URL'] : 'uploads/placeholder.jpg' ?>" 
                                                alt="<?= htmlspecialchars($contenido_paquete['alquileres'][0]['NOMBRE']) ?>" 
                                                class="item-image"
                                                onerror="this.src='uploads/placeholder.jpg'">
                                        </div>
                                        
                                        <!-- Sección de contenido -->
                                        <div class="content-section">
                                            <div class="item-header">
                                                <h4 class="item-name"><?= htmlspecialchars($contenido_paquete['alquileres'][0]['NOMBRE']) ?></h4>
                                                <span class="item-rating"><?= $contenido_paquete['alquileres'][0]['CALIFICACION'] ?> ⭐</span>
                                            </div>
                                            <p class="item-description">Habitaciones: <?= htmlspecialchars($contenido_paquete['alquileres'][0]['DORMITORIOS']) ?></p>
                                            <p class="item-description">Baños: <?= htmlspecialchars($contenido_paquete['alquileres'][0]['BANIOS']) ?></p>
                                            <p class="item-description">Metros: <?= htmlspecialchars($contenido_paquete['alquileres'][0]['METROS']) ?> m2</p>
                                            <p class="item-location"><?= htmlspecialchars($contenido_paquete['alquileres'][0]['UBICACION']) ?></p>
                                            <p class="item-description"><?= htmlspecialchars($contenido_paquete['alquileres'][0]['DESCRIPCION']) ?></p>
                                        </div>
                                    </div>
                                    
                                    <!-- Sección de precio -->
                                    <div class="price-section">
                                        <div class="price-content">
                                            <p class="item-price">Precio por semana: $<?= number_format($contenido_paquete['alquileres'][0]['PRECIO_SEMANA'], 2) ?></p>
                                            <p class="item-price-total">Total (<?= $semanas_alquiler ?> semanas): $<?= number_format(($contenido_paquete['alquileres'][0]['PRECIO_SEMANA']*$semanas_alquiler), 2) ?></p>
                                        </div>
                                        
                                        <?php if (!empty($contenido_paquete['alquileres'][0]['URL'])): ?>
                                            <a href="mailto:<?= htmlspecialchars($contenido_paquete['alquileres'][0]['URL']) ?>"
                                               target="_blank" 
                                               class="btn-consultar">
                                                <i class="fas fa-external-link-alt"></i> Consultar
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="error-message">No se encontró alquiler <?= $tipo_paquete ?>.</div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <!-- RESTAURANTES -->
                    <div class="paquete-section">
                        <h3 class="paquete-section-title">Restaurantes <?= ucfirst($tipo_paquete) ?></h3>
                        <?php if (!empty($contenido_paquete['restaurantes'])): ?>
                            <?php foreach($contenido_paquete['restaurantes'] as $restaurante): ?>
                                <div class="restaurante-card">
                                    <!-- Contenido principal - imagen y datos -->
                                    <div class="card-main-content">
                                        <!-- Sección de imagen -->
                                        <div class="image-section">
                                            <img src="<?= $restaurante['FOTO_URL'] ? 'uploads/restaurantes/' . $restaurante['FOTO_URL'] : 'uploads/placeholder.jpg' ?>" 
                                                alt="<?= htmlspecialchars($restaurante['NOMBRE']) ?>" 
                                                class="item-image"
                                                onerror="this.src='uploads/placeholder.jpg'">
                                        </div>
                                        
                                        <!-- Sección de contenido -->
                                        <div class="content-section">
                                            <div class="item-header">
                                                <h4 class="item-name"><?= htmlspecialchars($restaurante['NOMBRE']) ?></h4>
                                                <span class="item-rating"><?= $restaurante['CALIFICACION'] ?> ⭐</span>
                                            </div>
                                            <p class="item-location"> <?= htmlspecialchars($restaurante['TIPO_COMIDA_DESC']) ?></p>
                                            <p class="item-description"><?= htmlspecialchars($restaurante['DESCRIPCION']) ?></p>
                                        </div>
                                    </div>
                                    
                                    <!-- Sección de precio -->
                                    <div class="price-section">
                                        <div class="price-content">
                                            <p class="item-price">Precio promedio: $<?= number_format((($restaurante['PRECIO_MINIMO'] + $restaurante['PRECIO_MAXIMO'])/2), 2) ?></p>
                                        </div>
                                        
                                        <?php if (!empty($restaurante['URL'])): ?>
                                            <a href="<?= htmlspecialchars($restaurante['URL']) ?>" 
                                               target="_blank" 
                                               class="btn-consultar">
                                                <i class="fas fa-external-link-alt"></i> Consultar
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="error-message">No se encontraron restaurantes para este paquete.</div>
                        <?php endif; ?>
                    </div>

                    <!-- PUNTOS DE INTERÉS -->
                    <div class="paquete-section">
                        <h3 class="paquete-section-title">Puntos de Interés</h3>
                        <?php if (!empty($puntos_interes)): ?>
                            <?php foreach($puntos_interes as $punto): ?>
                                <div class="punto-interes-card">
                                    <!-- Contenido principal - imagen y datos -->
                                    <div class="card-main-content">
                                        <!-- Sección de imagen -->
                                        <div class="image-section">
                                            <img src="<?= $punto['FOTO_URL'] ? 'uploads/puntos_interes/' . $punto['FOTO_URL'] : 'uploads/placeholder.jpg' ?>" 
                                                alt="<?= htmlspecialchars($punto['NOMBRE']) ?>" 
                                                class="item-image"
                                                onerror="this.src='uploads/placeholder.jpg'">
                                        </div>
                                        
                                        <!-- Sección de contenido -->
                                        <div class="content-section">
                                            <div class="item-header">
                                                <h4 class="item-name"><?= htmlspecialchars($punto['NOMBRE']) ?></h4>
                                                <span class="item-rating">5 ⭐</span>
                                            </div>
                                            <p class="item-location"> <?= htmlspecialchars($punto['ACTIVIDAD_DESC']) ?></p>
                                            <p class="item-description"><?= htmlspecialchars($punto['DESCRIPCION']) ?></p>
                                        </div>
                                    </div>
                                    
                                    <!-- Sección de precio -->
                                    <div class="price-section">
                                        <div class="price-content">
                                            <p class="item-price">Precio: $<?= number_format($punto['PRECIO'], 2) ?></p>
                                        </div>
                                        
                                        <?php if (!empty($punto['URL'])): ?>
                                            <a href="<?= htmlspecialchars($punto['URL']) ?>" 
                                               target="_blank" 
                                               class="btn-consultar">
                                                <i class="fas fa-external-link-alt"></i> Consultar
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="error-message">No se encontraron puntos de interés.</div>
                        <?php endif; ?>
                    </div>

                    <!-- PRECIO TOTAL DEL PAQUETE -->
                    <div class="precio-total-section">
                        <h3 class="paquete-section-title">💰 Precio Total del Paquete</h3>
                        <div class="precio-breakdown">
                            <?php 
                            $precio_total = 0;
                            
                            // Calcular precio hospedaje
                            if ($tipo_hospedaje == "hotel" && !empty($contenido_paquete['hoteles'])) {
                                $precio_hospedaje = (($contenido_paquete['hoteles'][0]['PRECIO_MAXIMO']+$contenido_paquete['hoteles'][0]['PRECIO_MINIMO'])/2)*$dias_hotel;
                                $precio_total += $precio_hospedaje;
                                echo "<div class='precio-item'><span>🏨 Hospedaje:</span><span>$" . number_format($precio_hospedaje, 2) . "</span></div>";
                            } elseif ($tipo_hospedaje == "alquiler" && !empty($contenido_paquete['alquileres'])) {
                                $precio_hospedaje = $contenido_paquete['alquileres'][0]['PRECIO_SEMANA']*$semanas_alquiler;
                                $precio_total += $precio_hospedaje;
                                echo "<div class='precio-item'><span>🏠 Hospedaje:</span><span>$" . number_format($precio_hospedaje, 2) . "</span></div>";
                            }
                            
                            // Calcular precio restaurantes (estimado por persona por día)
                            $precio_restaurantes = 0;
                            foreach($contenido_paquete['restaurantes'] as $restaurante) {
                                $precio_restaurantes += ($restaurante['PRECIO_MINIMO'] + $restaurante['PRECIO_MAXIMO'])/2;
                            }
                            if ($tipo_hospedaje == "hotel") {
                                $precio_restaurantes = $precio_restaurantes * $dias_hotel;
                            } else {
                                $precio_restaurantes = $precio_restaurantes * ($semanas_alquiler * 7);
                            }
                            $precio_total += $precio_restaurantes;
                            echo "<div class='precio-item'><span>🍽️ Comidas estimadas:</span><span>$" . number_format($precio_restaurantes, 2) . "</span></div>";
                            
                            // Precio puntos de interés
                            $precio_actividades = 0;
                            foreach($puntos_interes as $punto) {
                                $precio_actividades += $punto['PRECIO'];
                            }
                            $precio_total += $precio_actividades;
                            echo "<div class='precio-item'><span>🎯 Actividades:</span><span>$" . number_format($precio_actividades, 2) . "</span></div>";
                            ?>
                        </div>
                        <div class="precio-final">
                             TOTAL: $<?= number_format($precio_total, 2) ?>
                        </div>
                    </div>
                </div> <!-- Fin contenido paquete -->
            </div> <!-- Fin card del paquete -->
        </div> <!-- Fin del container -->
        <?php endforeach; ?>

        <!-- Botón para volver -->
        <div style="text-align: center; margin: 2rem 0;">
            <a href="formulario_busqueda.php" class="btn-search" style="text-decoration: none;">
                <i class="fas fa-arrow-left"></i> Nueva Búsqueda
            </a>
        </div>
    </div> <!-- Fin del contenido principal -->
    
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
              <li><a href="index.php" onclick="scrollToTop(event)">Inicio</a></li>
              <?php if (isset($_SESSION['id_cargo'])): ?>
                <li><a href="packages.php">Afiliados</a></li>
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
          event.preventDefault();
          window.scrollTo({
              top: 0,
              behavior: 'smooth'
          });
      }
    </script>

    <style>
    .total-price {
        background-color: #f8f9fa;
        padding: 1rem;
        border-radius: 8px;
        margin-top: 1rem;
        border-left: 4px solid #618c78;
    }
    
    .total-final {
        font-size: 1.2em;
        color: #618c78;
        margin-top: 0.5rem;
        padding-top: 0.5rem;
        border-top: 2px solid #618c78;
    }
    
    .block {
        margin-bottom: 3rem;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        padding: 2rem;
        background-color: #fafafa;
    }
    
    .block .title {
        font-size: 1.8em;
        font-weight: bold;
        color: #618c78;
        text-align: center;
        margin-bottom: 2rem;
        padding: 1rem;
        background-color: #618c78;
        color: white;
        border-radius: 8px;
    }
    </style>

</body>
</html>
<?php } else {
    header("Location:login.php");
    exit();
} ?>