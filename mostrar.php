<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Resultados de Consulta</title>
  <link rel="stylesheet" href="estilos.css" />
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
                    $consulta = mysqli_query($conexion, "SELECT * FROM hoteles WHERE ((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) <= (SELECT MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) + (MAX((PRECIO_MINIMO + PRECIO_MAXIMO) / 2) - MIN((PRECIO_MINIMO + PRECIO_MAXIMO) / 2)) / 3 FROM hoteles) AND HUESPEDES >='$huespedes_max' AND CALIFICACION >= $calificacion_hotel  AND ( PILETA = '$pileta') AND (DESAYUNO = '$desayuno') ORDER BY CALIFICACION DESC LIMIT 2");
                    echo "<div class='error-message'>exito</div>";
                    
                }else{
                    echo "<div class='error-message'>error</div>";
                }

                
            ?>

                <?php $hoteles = []; // Creamos un array vacío para guardar los resultados

                // Recorremos el resultado y lo guardamos en el array
                while ($fila = mysqli_fetch_assoc($consulta)) 
                {
                    $hoteles[] = $fila; // Cada $fila es un hotel
                }
                ?>

                <?php for ($i = 0; $i < 2; $i++): ?>
                        <div class="hotel">
                            <h3><?= $hoteles[$i]['NOMBRE'] ?></h3>
                            <p>Ubicación: <?= $hoteles[$i]['UBICACION'] ?></p>
                        </div> 
                <?php endfor; ?>

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
              <p class="name">Hotel Las Palmeras</p>
              <p class="stars">4 ⭐⭐⭐⭐</p>
            </div>
            <p class="type">Hotel Urbano</p>
            <p class="description">Ubicado en el centro, excelente para turismo de ciudad.</p>
            <p class="price">Precio: $150</p>
          </div>
        </div>
        <div class="hotel-content">
          <div class="image-box"></div>
          <div class="info">
            <div class="info-header">
              <p class="name">Hotel El Refugio</p>
              <p class="stars">5 ⭐⭐⭐⭐⭐</p>
            </div>
            <p class="type">Hotel Rural</p>
            <p class="description">Rodeado de naturaleza, ideal para relajarse.</p>
            <p class="price">Precio: $200</p>
          </div>
        </div>
      </div>

      <!-- Restaurantes -->
      <div class="row">
        <h3>Restaurantes</h3>
        <div class="grid">
          <div class="grid-item">
            <div class="image-box"></div>
            <div class="info">
              <div class="info-header">
                <p class="name">El Buen Sabor</p>
                <p class="stars">4 ⭐⭐⭐⭐</p>
              </div>
              <p class="type">Parrilla</p>
              <p class="description">Especialidades argentinas en ambiente familiar.</p>
              <p class="price">Desde $20</p>
            </div>
          </div>
          <div class="grid-item">
            <div class="image-box"></div>
            <div class="info">
              <div class="info-header">
                <p class="name">Café del Centro</p>
                <p class="stars">3 ⭐⭐⭐</p>
              </div>
              <p class="type">Cafetería</p>
              <p class="description">Café, tortas y un ambiente relajado.</p>
              <p class="price">Desde $15</p>
            </div>
          </div>
          <div class="grid-item">
            <div class="image-box"></div>
            <div class="info">
              <div class="info-header">
                <p class="name">Pizza Express</p>
                <p class="stars">3 ⭐⭐⭐</p>
              </div>
              <p class="type">Pizzería</p>
              <p class="description">Rápido, sabroso y económico.</p>
              <p class="price">Desde $10</p>
            </div>
          </div>
          <div class="grid-item">
            <div class="image-box"></div>
            <div class="info">
              <div class="info-header">
                <p class="name">Sushi Zen</p>
                <p class="stars">4 ⭐⭐⭐⭐</p>
              </div>
              <p class="type">Japonesa</p>
              <p class="description">Sushi fresco y excelente atención.</p>
              <p class="price">Desde $30</p>
            </div>
          </div>
          <div class="grid-item">
            <div class="image-box"></div>
            <div class="info">
              <div class="info-header">
                <p class="name">Burgers & Co.</p>
                <p class="stars">4 ⭐⭐⭐⭐</p>
              </div>
              <p class="type">Hamburguesas</p>
              <p class="description">Gourmet, caseras y sabrosas.</p>
              <p class="price">Desde $25</p>
            </div>
          </div>
          <div class="grid-item">
            <div class="image-box"></div>
            <div class="info">
              <div class="info-header">
                <p class="name">Veggie Life</p>
                <p class="stars">3 ⭐⭐⭐</p>
              </div>
              <p class="type">Vegetariana</p>
              <p class="description">Opciones saludables y naturales.</p>
              <p class="price">Desde $18</p>
            </div>
          </div>
        </div>
      </div>

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
