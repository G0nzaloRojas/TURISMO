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
    <link rel="stylesheet" href="armar_paquetes.css" />
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
            <li><a href="packages.php">Paquetes</a></li>
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

    <!-- Contenido principal -->
    <div style="margin-top: 100px;">
        <?php
                include ("conexion.php");

                $tipo_hospedaje = $_POST['accommodation-type']?? null;

                $calificacion_hotel = $_POST['hotel-rating']?? null;
                $huespedes_max = $_POST['max-guests']?? null;
                $pileta = $_POST['pileta']?? null;
                $desayuno = $_POST['desayuno']?? null;
                $dias_hotel = $_POST['dias_hotel']?? null;

                $calificacion_alquiler = $_POST['rental-rating']?? null;
                $cantidad_camas_simples = $_POST['single_bed']?? null;
                $cantidad_camas_dobles = $_POST['double_bed']?? null;
                $cantidad_baños = $_POST['bathrooms']?? null;
                $metros_cuadrados = $_POST['metros2_minimos']?? null;
                $semanas_alquiler = $_POST['semanas_alquiler']?? null;

                $tipo_comida = $_POST['food-type']?? null;
                $calificacion_restaurante = $_POST['restaurant-rating']?? null;

                $tipo_actividad = $_POST['activity-type']?? null;
                
                
                //HOTELES BARATOS
                if($_POST['accommodation-type'] == "hotel"){  
                    $consulta1 = mysqli_query($conexion, ("SELECT * FROM hoteles WHERE ((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) <= (SELECT MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) + (MAX((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) - MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2)) / 3 FROM hoteles) AND HUESPEDES >='$huespedes_max' AND CALIFICACION >= $calificacion_hotel  AND ('$pileta' = 'no' OR '$pileta' = 'si') AND ('$desayuno' = 'no' OR '$desayuno' = 'si') ORDER BY CALIFICACION DESC LIMIT 1"));
                
                
                    //HOTELES INTERMEDIOS    
                    $consulta2= mysqli_query($conexion,("SELECT * FROM hoteles
                    WHERE ((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) > (
                        SELECT MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) + 
                               (MAX((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) - MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2)) / 3
                        FROM hoteles
                    )
                    AND ((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) <= (
                        SELECT MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) + 
                               2 * (MAX((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) - MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2)) / 3
                        FROM hoteles
                    )
                    AND HUESPEDES >= '$huespedes_max'
                    AND CALIFICACION >= '$calificacion_hotel'
                    AND ('$pileta' = 'no' OR '$pileta' = 'si')
                    AND ('$desayuno' = 'no' OR '$desayuno' = 'si')
                    ORDER BY CALIFICACION DESC
                    LIMIT 1"));

                
                  //HOTELES CAROS
                    $consulta3=mysqli_query($conexion, ("SELECT * FROM hoteles
                    WHERE ((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) > (
                        SELECT MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) + 
                               2 * (MAX((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) - MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2)) / 3
                        FROM hoteles
                    )
                    AND HUESPEDES >= '$huespedes_max'
                    AND CALIFICACION >= '$calificacion_hotel'
                    AND ('$pileta' = 'no' OR '$pileta' = 'si')
                    AND ('$desayuno' = 'no' OR '$desayuno' = 'si')
                    ORDER BY CALIFICACION DESC
                    LIMIT 1"));
                    
                }

                
                
                if($_POST['accommodation-type'] == "alquiler"){
                  //BUSQUEDA ALQUILERES BARATOS

                  $alquiler1=mysqli_query($conexion, "SELECT * FROM alquiler
                  WHERE PRECIO_SEMANA <= (
                      SELECT MIN(PRECIO_SEMANA) + 
                            (MAX(PRECIO_SEMANA) - MIN(PRECIO_SEMANA)) / 3
                      FROM alquiler
                  )
                  AND CALIFICACION >= $calificacion_alquiler
                  AND BANIOS >= $cantidad_baños
                  AND CAMAS_DOBLES >= $cantidad_camas_dobles
                  AND CAMAS_SIMPLES >= $cantidad_camas_simples
                  AND METROS >= $metros_cuadrados
                  ORDER BY CALIFICACION DESC, METROS DESC
                  LIMIT 1
                  ");
                  //BUSQUEDA ALQUILERES INTERMEDIOS
                  $alquiler2=mysqli_query($conexion,"SELECT * FROM alquiler
                    WHERE PRECIO_SEMANA > (
                        SELECT MIN(PRECIO_SEMANA) + 
                              (MAX(PRECIO_SEMANA) - MIN(PRECIO_SEMANA)) / 3
                        FROM alquiler
                    )
                    AND PRECIO_SEMANA <= (
                        SELECT MIN(PRECIO_SEMANA) + 
                              2 * (MAX(PRECIO_SEMANA) - MIN(PRECIO_SEMANA)) / 3
                        FROM alquiler
                    )
                    AND CALIFICACION >= $calificacion_alquiler
                    AND BANIOS >= $cantidad_baños
                    AND CAMAS_DOBLES >= $cantidad_camas_dobles
                    AND CAMAS_SIMPLES >= $cantidad_camas_simples
                    AND METROS >= $metros_cuadrados
                    ORDER BY CALIFICACION DESC, METROS DESC
                    LIMIT 1
                    ");
                  //BUSQUEDA ALQUILERES CAROS
                  $alquiler3=mysqli_query($conexion,"SELECT * FROM alquiler
                  WHERE PRECIO_SEMANA > (
                      SELECT MIN(PRECIO_SEMANA) + 
                             2 * (MAX(PRECIO_SEMANA) - MIN(PRECIO_SEMANA)) / 3
                      FROM alquiler
                  )
                  AND CALIFICACION >= $calificacion_alquiler
                  AND BANIOS >= $cantidad_baños
                  AND CAMAS_DOBLES >= $cantidad_camas_dobles
                  AND CAMAS_SIMPLES >= $cantidad_camas_simples
                  AND METROS >= $metros_cuadrados
                  ORDER BY CALIFICACION DESC, METROS DESC
                  LIMIT 1");
                }

                
                
            ?>
           

            <?php if($tipo_hospedaje == "hotel"): ?>
              <?php $hoteles1 = []; ?>
              <?php while ($fila1 = mysqli_fetch_assoc($consulta1)) {
                  $hoteles1[] = $fila1;
              } ?>
              <?php $hoteles2 = []; ?>
              <?php while ($fila2 = mysqli_fetch_assoc($consulta2)) {
                  $hoteles2[] = $fila2;
              } ?>
              <?php $hoteles3 = []; ?>
              <?php while ($fila3 = mysqli_fetch_assoc($consulta3)) {
                  $hoteles3[] = $fila3;
              } ?>
            <?php elseif($tipo_hospedaje == "alquiler"): ?>
              <?php $alquileres1 = []; ?>
              <?php while ($fila1 = mysqli_fetch_assoc($alquiler1)) {
                  $alquileres1[] = $fila1;
              } ?>
              <?php $alquileres2 = []; ?>
              <?php while ($fila2 = mysqli_fetch_assoc($alquiler2)) {
                  $alquileres2[] = $fila2;
              } ?>

              <?php $alquileres3 = []; ?>
              <?php while ($fila3 = mysqli_fetch_assoc($alquiler3)) {
                  $alquileres3[] = $fila3;
              } ?>
            <?php endif; ?>

                
                
        
        <?php //BUSQUEDA DE RESTAURANTES BARATOS
              $limite = min(1 * 2, 14);
              $resultado = mysqli_query($conexion,"SELECT * FROM restaurantes WHERE ((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) <= (
                                SELECT MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) +
                                      ((MAX((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) - MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2)) / 3)
                                FROM restaurantes
                                WHERE ($tipo_comida = 7 OR ID_COMIDA = $tipo_comida)
                                )
                                  AND ($tipo_comida = 7 OR ID_COMIDA = $tipo_comida)
                                  ORDER BY CALIFICACION DESC LIMIT 2");
        ?>
        <?php  //BUSQUEDA DE RESTAURANTES INTERMEDIOS

            $resultado2 = mysqli_query($conexion, "SELECT * FROM restaurantes
            WHERE ID_COMIDA = $tipo_comida
              AND ((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) > (
                SELECT MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) +
                       ((MAX((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) - MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2)) / 3)
                FROM restaurantes
                WHERE ID_COMIDA = $tipo_comida
              )
              AND ((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) <= (
                SELECT MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) +
                       (2 * ((MAX((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) - MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2)) / 3))
                FROM restaurantes
                WHERE ID_COMIDA = $tipo_comida
              )
            ORDER BY CALIFICACION DESC
            LIMIT 2
          ");
          ?> 
        
        <?php  //BUSQUEDA DE RESTAURANTES CAROS
            $resultado3 = mysqli_query($conexion, "SELECT * FROM restaurantes
            WHERE ((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) > (
                SELECT MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) +
                       (2 * ((MAX((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) - MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2)) / 3))
                FROM restaurantes
                WHERE ($tipo_comida = 7 OR ID_COMIDA = $tipo_comida)
            )
            AND ($tipo_comida = 7 OR ID_COMIDA = $tipo_comida)
            ORDER BY calificacion DESC
            LIMIT 2
          ");
        ?> 
        <?php
        // Consulta de puntos de interés
        $consulta_puntos = mysqli_query($conexion, "SELECT * FROM `puntos de interes`
        WHERE ID_ACTIVIDAD = 1
        ORDER BY RAND()
        LIMIT 4");
        ?>

        
                   

  <h1>Resultados de Consulta</h1>

  <div class="container">

    <!-- BLOQUE -->
    <div class="block">
  <div class="title">Paquete Económico</div>

  <!-- Hospedajes -->
  <?php if ($tipo_hospedaje == "hotel"): ?>
    <!-- Hotel Económico -->
    <div class="row">
      <h3>Hotel Económico</h3>
      <?php if (!empty($hoteles1)): ?>
      <div class="hotel-content">
        <div class="image-box"></div>
        <div class="info">
          <div class="info-header">
            <p class="name"><?= $hoteles1[0]['NOMBRE'] ?></p>
            <p class="stars"><?= $hoteles1[0]['CALIFICACION'] ?> ⭐ ESTRELLAS</p>
          </div>
          <p class="type"><?= $hoteles1[0]['UBICACION'] ?></p>
          <p class="description">Ubicado en el centro, excelente para turismo de ciudad.</p>
          <p class="price">Precio Promedio Por Noche: $<?= (($hoteles1[0]['PRECIO_MAXIMO']+$hoteles1[0]['PRECIO_MINIMO'])/2)?> </p>
          <p class="price2">Precio Promedio Total con dias: $<?= ((($hoteles1[0]['PRECIO_MAXIMO']+$hoteles1[0]['PRECIO_MINIMO'])/2)*$dias_hotel)?> </p>
        </div>
      </div>
      <?php else: ?>
          <div class="error-message">No se encontró hotel económico.</div>
        <?php endif; ?>
    </div>

    <!-- Hotel Intermedio -->
    <div class="row">
      <h3>Hotel Intermedio</h3>
      <?php if (!empty($hoteles2)): ?>
      <div class="hotel-content">
        <div class="image-box"></div>
        <div class="info">
          <div class="info-header">
            <p class="name"><?= $hoteles2[0]['NOMBRE'] ?></p>
            <p class="stars"><?= $hoteles2[0]['CALIFICACION'] ?> ⭐ ESTRELLAS</p>
          </div>
          <p class="type"><?= $hoteles2[0]['UBICACION'] ?></p>
          <p class="description">Ubicado en el centro, excelente para turismo de ciudad.</p>
          <p class="price">Precio Promedio Por Noche: $<?= (($hoteles2[0]['PRECIO_MAXIMO']+$hoteles2[0]['PRECIO_MINIMO'])/2)?> </p>
          <p class="price2">Precio Promedio Total con dias: $<?= ((($hoteles2[0]['PRECIO_MAXIMO']+$hoteles2[0]['PRECIO_MINIMO'])/2)*$dias_hotel)?> </p>
        </div>
      </div>
      <?php else: ?>
          <div class="error-message">No se encontró hotel intermedio.</div>
        <?php endif; ?>
    </div>

    <!-- Hotel Caro -->
    <div class="row">
      <h3>Hotel Premium</h3>
       <?php if (!empty($hoteles3)): ?>
      <div class="hotel-content">
        <div class="image-box"></div>
        <div class="info">
          <div class="info-header">
            <p class="name"><?= $hoteles3[0]['NOMBRE'] ?></p>
            <p class="stars"><?= $hoteles3[0]['CALIFICACION'] ?> ⭐ ESTRELLAS</p>
          </div>
          <p class="type"><?= $hoteles3[0]['UBICACION'] ?></p>
          <p class="description">Ubicado en el centro, excelente para turismo de ciudad.</p>
          <p class="price">Precio Promedio Por Noche: $<?= $hoteles3[0]['PRECIO_MINIMO']?> - $<?= $hoteles3[0]['PRECIO_MAXIMO']?> </p>
          <p class="price2">Precio Promedio Total con dias: $<?= ((($hoteles3[0]['PRECIO_MAXIMO']+$hoteles3[0]['PRECIO_MINIMO'])/2)*$dias_hotel)?> </p>
        </div>
      
      </div>
        <?php else: ?>
          <div class="error-message">No se encontró hotel caro.</div>
        <?php endif; ?>
    </div>
      
  <?php elseif ($tipo_hospedaje == "alquiler"): ?>
          
    <!-- Alquiler Económico -->
  <div class="row">
    <h3>Alquiler Económico</h3>
    <?php if (!empty($alquileres1)): ?>
      <div class="hotel-content">
        <div class="image-box"></div>
        <div class="info">
          <div class="info-header">
            <p class="name"><?= $alquileres1[0]['NOMBRE'] ?></p>
            <p class="stars"><?= $alquileres1[0]['CALIFICACION'] ?> ⭐ reseñas</p>
          </div>
          <p class="type"><?= $alquileres1[0]['UBICACION'] ?></p>
          <p class="description"><?= $alquileres1[0]['DESCRIPCION'] ?></p>
          <p class="price">Precio por semana: $<?= $alquileres1[0]['PRECIO_SEMANA'] ?></p>
          <p class="price2">Precio total x cantidad de semanas: $<?= ($alquileres1[0]['PRECIO_SEMANA']*$semanas_alquiler) ?></p>
        </div>
      </div>
    <?php else: ?>
      <div class="error-message">No se encontró alquiler económico.</div>
    <?php endif; ?>
  </div>

  <!-- Alquiler Intermedio -->
  
  <div class="row">
    <h3>Alquiler intermedio</h3>
    <?php if (!empty($alquileres2)): ?>
      <div class="hotel-content">
        <div class="image-box"></div>
        <div class="info">
          <div class="info-header">
            <p class="name"><?= $alquileres2[0]['NOMBRE'] ?></p>
            <p class="stars"><?= $alquileres2[0]['CALIFICACION'] ?> ⭐ reseñas</p>
          </div>
          <p class="type"><?= $alquileres2[0]['UBICACION'] ?></p>
          <p class="description"><?= $alquileres2[0]['DESCRIPCION'] ?></p>
          <p class="price">Precio por semana: $<?= $alquileres2[0]['PRECIO_SEMANA'] ?></p>
          <p class="price2">Precio total x cantidad de semanas: $<?= ($alquileres2[0]['PRECIO_SEMANA']*$semanas_alquiler) ?></p>
        </div>
      </div>
    <?php else: ?>
      <div class="error-message">No se encontró alquiler intermedio.</div>
    <?php endif; ?>
  </div>

  <!-- Alquiler Caro -->
  
  <div class="row">
    <h3>Alquiler Premium</h3>
    <?php if (!empty($alquileres3)): ?>
      <div class="hotel-content">
        <div class="image-box"></div>
        <div class="info">
          <div class="info-header">
            <p class="name"><?= $alquileres3[0]['NOMBRE'] ?></p>
            <p class="stars"><?= $alquileres3[0]['CALIFICACION'] ?> ⭐ reseñas</p>
          </div>
          <p class="type"><?= $alquileres3[0]['UBICACION'] ?></p>
          <p class="description"><?= $alquileres3[0]['DESCRIPCION'] ?></p>
          <p class="price">Precio por semana: $<?= $alquileres3[0]['PRECIO_SEMANA'] ?></p>
          <p class="price2">Precio total x cantidad de semanas: $<?= ($alquileres3[0]['PRECIO_SEMANA']*$semanas_alquiler) ?></p>
        </div>
      </div>
    <?php else: ?>
      <div class="error-message">No se encontró alquiler intermedio.</div>
    <?php endif; ?>
  </div>
      
  <?php endif; ?>

  <!-- Restaurantes Baratos -->
  <div class="row">
        <h3>Restaurantes Baratos</h3>
        
        <?php 
          // Guardar resultados en un array
          $restaurantes = [];

          if (mysqli_num_rows($resultado) > 0) {
              while ($fila = mysqli_fetch_assoc($resultado)) {
                  $restaurantes[] = $fila;
              }
              
          }else{
              echo "<div class='error-message'>No se encontraron resultados</div>";
          }
          
          
                
                    
                
          // Mostrar resultados con un for
          $total = count($restaurantes);
          for ($i = 0; $i < $total; $i++): ?> 
                        
            <div class="grid">
              <div class="grid-item">
                <div class="image-box"></div>
                  <div class="info">
                    <div class="info-header">
                      <p class="name"><?=$restaurantes[$i]['NOMBRE']?></p>
            
                     <p class="stars"><?=$restaurantes[$i]['CALIFICACION']?> ⭐ ESTRELLAS</p>
                    </div>
            <p class="type"><?=$restaurantes[$i]['ID_COMIDA']?></p>
            <p class="description"><?=$restaurantes[$i]['DESCRIPCION']?></p>
            <p class="price">Precio promedio: $<?=$restaurantes[$i]['PRECIO_MAXIMO']?></p>
            </div>
            </div>
            </div>
      
            <?php endfor; ?>

            <!-- Restaurantes INTERMEDIOS -->
      <div class="row">
        <h3>Restaurantes Intermedios</h3>
        
        <?php 
          // Guardar resultados en un array
          $restaurantes2 = [];

          if (mysqli_num_rows($resultado2) > 0) {
              while ($fila = mysqli_fetch_assoc($resultado2)) {
                  $restaurantes2[] = $fila;
              }
              
          }else{
              echo "<div class='error-message'>No se encontraron resultados</div>";
          }

          // Mostrar resultados con un for
  
          $total2 = count($restaurantes2);
          for ($j = 0; $j < $total2; $j++): ?>   
            <div class="grid">
            <div class="grid-item">
            <div class="image-box"></div>
            <div class="info">
            <div class="info-header">
            <p class="name"><?=$restaurantes2[$j]['NOMBRE']?></p>
            <p class="stars"><?=$restaurantes2[$j]['CALIFICACION']?> ⭐ ESTRELLAS</p>
            </div>
            <p class="type"><?=$restaurantes2[$j]['ID_COMIDA']?></p>
            <p class="description"><?=$restaurantes2[$j]['DESCRIPCION']?></p>
            <p class="price">Precio promedio: $<?=$restaurantes2[$j]['PRECIO_MAXIMO']?></p>
            </div>
            </div>
            </div>
      
            <?php endfor; ?>

            <!-- Restaurantes CAROS -->
      <div class="row">
        <h3>Restaurantes Caros</h3>
        
        <?php 
          // Guardar resultados en un array
          $restaurantes3 = [];

          if (mysqli_num_rows($resultado3) > 0) {
              while ($fila = mysqli_fetch_assoc($resultado3)) {
                  $restaurantes3[] = $fila;
              }
              
          }else{
              echo "<div class='error-message'>No se encontraron resultados</div>";
          }

          // Mostrar resultados con un for
          
          $total2 = count($restaurantes3);
          for ($j = 0; $j < $total2; $j++): ?>   
            <div class="grid">
            <div class="grid-item">
            <div class="image-box"></div>
            <div class="info">
            <div class="info-header">
            <p class="name"><?=$restaurantes3[$j]['NOMBRE']?></p>
            <p class="stars"><?=$restaurantes3[$j]['CALIFICACION']?> ⭐ ESTRELLAS</p>
            </div>
            <p class="type"><?=$restaurantes3[$j]['ID_COMIDA']?></p>
            <p class="description"><?=$restaurantes3[$j]['DESCRIPCION']?></p>
            <p class="price">Precio promedio: $<?=$restaurantes3[$j]['PRECIO_MAXIMO']?></p>
            </div>
            </div>
            </div>
      
            <?php endfor; ?>

  <!-- Puntos de Interés -->
 
  <div class="row">
        <h3>Puntos de interes</h3>
        
        <?php 
          // Guardar resultados en un array
          $puntos_interes= [];

          if (mysqli_num_rows($consulta_puntos) > 0) {
              while ($fila = mysqli_fetch_assoc($consulta_puntos)) {
                $puntos_interes[] = $fila;
              }
              
          }else{
              echo "<div class='error-message'>No se encontraron resultados</div>";
          }   
                
          // Mostrar resultados con un for
          $total = count($puntos_interes);
          for ($i = 0; $i < $total; $i++): ?> 
                        
            <div class="grid">
              <div class="grid-item">
                <div class="image-box"></div>
                  <div class="info">
                    <div class="info-header">
                      <p class="name"><?=$puntos_interes[$i]['NOMBRE']?></p>
            
                     <p class="stars">5 ⭐ ESTRELLAS</p>
                    </div>
            <p class="type"><?=$puntos_interes[$i]['ID_ACTIVIDAD']?></p>
            <p class="description"><?=$puntos_interes[$i]['DESCRIPCION']?></p>
            <p class="price">$<?=$puntos_interes[$i]['PRECIO']?></p>
            </div>
            </div>
            </div>
      
            <?php endfor; ?>

  </div>
  </div>
  </div>

  <!-- Botón para volver -->
  <div style="text-align: center; margin: 2rem 0;">
    <a href="formulario_busqueda.php" class="btn-search" style="text-decoration: none;">
      <i class="fas fa-arrow-left"></i> Nueva Búsqueda
    </a>
  </div>

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
              <li><a href="index.php" onclick="scrollToTop(event)">Inicio</a></li>
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
<?php } else {
    header("Location:login.php "); // Redirige si no hay sesión
    exit();
  } 
?>