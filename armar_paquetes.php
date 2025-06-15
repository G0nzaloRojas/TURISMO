<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Resultados de Consulta</title>
  <link rel="stylesheet" href="armar_paquetes.css" />
</head>
<body>
        <?php
                include ("conexion.php");

                $tipo_hospedaje = $_POST['accommodation-type'];
                $calificacion_hotel = $_POST['hotel-rating'];
                $huespedes_max = $_POST['max-guests'];
                $pileta = $_POST['pileta'];
                $desayuno = $_POST['desayuno'];

                $calificacion_alquiler = $_POST['rental-rating'];
                $cantidad_dormitorios = $_POST['bedrooms'];
                $cantidad_baños = $_POST['bathrooms'];
                $metros_cuadrados = $_POST['metros2_minimos'];

                $tipo_comida = $_POST['food-type'];
                $calificacion_restaurante = $_POST['restaurant-rating'];

                $tipo_actividad = $_POST['activity-type'];
                
                
                if($_POST['accommodation-type'] == "hotel"){  
                    $consulta1 = mysqli_query($conexion, ("SELECT * FROM hoteles WHERE ((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) <= (SELECT MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) + (MAX((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) - MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2)) / 3 FROM hoteles) AND HUESPEDES >='$huespedes_max' AND CALIFICACION >= $calificacion_hotel  AND ('$pileta' = 'no' OR '$pileta' = 'si') AND ('$desayuno' = 'no' OR '$desayuno' = 'si') ORDER BY CALIFICACION DESC LIMIT 1"));
                    
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
                }else{
                    echo "<div class='error-message'>error</div>";
                }

                
                
            ?>

                <?php $hoteles1 = []; // Creamos un array vacío para guardar los resultados

                // Recorremos el resultado y lo guardamos en el array
                while ($fila1 = mysqli_fetch_assoc($consulta1)) 
                {
                    $hoteles1[] = $fila1; // Cada $fila es un hotel
                }
                ?>
                <?php $hoteles2 = []; 

                    
                    while ($fila2 = mysqli_fetch_assoc($consulta2)) 
                    {
                        $hoteles2[] = $fila2; 
                    }
                ?>

                <?php $hoteles3 = []; // Creamos un array vacío para guardar los resultados

                // Recorremos el resultado y lo guardamos en el array
                while ($fila3 = mysqli_fetch_assoc($consulta3)) 
                {
                    $hoteles3[] = $fila3; // Cada $fila es un hotel
                }
                ?>
        
        <?php //BUSQUEDA DE RESTAURANTES
            if($tipo_comida=="parrilla"){
              $tipo_comida = 1;
            }
              $limite = min(1 * 2, 14);
              $resultado = mysqli_query($conexion,"SELECT * FROM restaurantes WHERE ((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) <= (
                                SELECT MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) +
                                      ((MAX((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) - MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2)) / 3)
                                FROM restaurantes
                                WHERE ('$tipo_comida' = 'todos' OR ID_COMIDA = '$tipo_comida')
                                )
                                  AND ('$tipo_comida' = 'todos' OR ID_COMIDA = '$tipo_comida')
                                  ORDER BY CALIFICACION DESC
                                  
                            LIMIT 2");
          ?>
        
                        

  <h1>Resultados de Consulta</h1>

  <div class="container">

    <!-- BLOQUE -->
    <div class="block">
      <div class="title">Paquete Económico</div>

      <!-- Hoteles -->
      <div class="row">
        <h3>Hoteles</h3>
        <div class="hotel-content">
          <div class="image-box"></div>
          <div class="info">
            <div class="info-header">
              <p class="name"><?= $hoteles1[0]['NOMBRE'] ?></p>
              <p class="stars"><?= $hoteles1[0]['CALIFICACION'] ?> ⭐ ESTRELLAS</p>
            </div>
            <p class="type"><?= $hoteles1[0]['UBICACION'] ?></p>
            <p class="description">Ubicado en el centro, excelente para turismo de ciudad.</p>
            <p class="price">Precio: $<?= (($hoteles1[0]['PRECIO_MAXIMO']+$hoteles1[0]['PRECIO_MINIMO'])/2)?> </p>
          </div>
        </div>
        <!-- Hoteles2 -->
      <div class="row">
        <h3>Hoteles</h3>
        <div class="hotel-content">
          <div class="image-box"></div>
          <div class="info">
            <div class="info-header">
              <p class="name"><?= $hoteles2[0]['NOMBRE'] ?></p>
              <p class="stars"><?= $hoteles2[0]['CALIFICACION'] ?> ⭐ ESTRELLAS</p>
            </div>
            <p class="type"><?= $hoteles2[0]['UBICACION'] ?></p>
            <p class="description">Ubicado en el centro, excelente para turismo de ciudad.</p>
            <p class="price">Precio: $<?= (($hoteles2[0]['PRECIO_MAXIMO']+$hoteles2[0]['PRECIO_MINIMO'])/2)?> </p>
          </div>
        </div>
        <!-- Hoteles3 -->
      <div class="row">
        <h3>Hoteles</h3>
        <div class="hotel-content">
          <div class="image-box"></div>
          <div class="info">
            <div class="info-header">
              <p class="name"><?= $hoteles3[0]['NOMBRE'] ?></p>
              <p class="stars"><?= $hoteles3[0]['CALIFICACION'] ?> ⭐ ESTRELLAS</p>
            </div>
            <p class="type"><?= $hoteles3[0]['UBICACION'] ?></p>
            <p class="description">Ubicado en el centro, excelente para turismo de ciudad.</p>
            <p class="price">Precio: $<?= (($hoteles3[0]['PRECIO_MAXIMO']+$hoteles3[0]['PRECIO_MINIMO'])/2)?> </p>
          </div>
        </div>

      <!-- Restaurantes -->
      <div class="row">
        <h3>Restaurantes</h3>
        
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
            <p class="stars"><?=$restaurantes[$i]['CALIFICACION']?></p>
            </div>
            <p class="type"><?=$restaurantes[$i]['ID_COMIDA']?></p>
            <p class="description"><?=$restaurantes[$i]['DESCRIPCION']?></p>
            <p class="price"><?=$restaurantes[$i]['PRECIO_MAXIMO']?></p>
            </div>
            </div>
            </div>
      
            <?php endfor; ?>

      <!-- Puntos de Interés -->
      <div class="row">
        <h3>Puntos de Interés</h3>
        <div class="grid">
          <div class="grid-item">
            <div class="image-box"></div>
            <div class="info">
              <div class="info-header">
                <p class="name">Parque Central</p>
                <p class="stars">5 ⭐⭐⭐⭐⭐</p>
              </div>
              <p class="type">Espacio Verde</p>
              <p class="description">Lugar amplio para recreación y deportes.</p>
              <p class="price">Gratis</p>
            </div>
          </div>
          <div class="grid-item">
            <div class="image-box"></div>
            <div class="info">
              <div class="info-header">
                <p class="name">Plaza Histórica</p>
                <p class="stars">3 ⭐⭐⭐</p>
              </div>
              <p class="type">Patrimonio</p>
              <p class="description">Centro histórico para paseos y fotos.</p>
              <p class="price">Gratis</p>
            </div>
          </div>
          <div class="grid-item">
            <div class="image-box"></div>
            <div class="info">
              <div class="info-header">
                <p class="name">Museo de Arte</p>
                <p class="stars">4 ⭐⭐⭐⭐</p>
              </div>
              <p class="type">Cultura</p>
              <p class="description">Exhibiciones modernas e interactivas.</p>
              <p class="price">Entrada $5</p>
            </div>
          </div>
          <div class="grid-item">
            <div class="image-box"> <img src="C:\Users\Usuario\Downloads\foto200.png" alt="Texto alternativo"></div>
            <div class="info">
              <div class="info-header">
                <p class="name">Centro Cultural</p>
                <p class="stars">4 ⭐⭐⭐⭐</p>
              </div>
              <p class="type">Eventos</p>
              <p class="description">Muestras, conciertos y talleres ijsdhfdpouufh  osdfhdpfdh  odifhdofhjd d fhjdsoifhjsd d dsoifhsdoifhjds oo ihjfoidshfn.</p>
              <p class="price">Entrada $3</p>
            </div>
          </div>
          <div class="grid-item">
            <div class="image-box"></div>
            <div class="info">
              <div class="info-header">
                <p class="name">Mirador del Río</p>
                <p class="stars">5 ⭐⭐⭐⭐⭐</p>
              </div>
              <p class="type">Paisaje</p>
              <p class="description">Vistas únicas al atardecer.</p>
              <p class="price">Entrada $7</p>
            </div>
          </div>
          <div class="grid-item">
            <div class="image-box"></div>
            <div class="info">
              <div class="info-header">
                <p class="name">Reserva Natural</p>
                <p class="stars">3 ⭐⭐⭐</p>
              </div>
              <p class="type">Naturaleza</p>
              <p class="description">Senderos, fauna y flora autóctona.</p>
              <p class="price">Entrada $10</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</body>
</html>