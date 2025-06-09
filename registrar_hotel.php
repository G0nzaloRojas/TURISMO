<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Alquiler</title>
</head>

<body>
    <?php
        include ("conexion.php");

        $nombre = $_POST['nombre'];
        $ubicacion = $_POST['ubicacion'];
        $precio_minimo = $_POST['precio_minimo'];
        $precio_maximo = $_POST['precio_maximo'];
        $calificacion = $_POST['calificacion'];
        $huespedes = $_POST['huespedes'];
        $pileta = $_POST['pileta'];
        $desayuno = $_POST['desayuno'];
        
        
        

        $consulta = mysqli_query($conexion, "INSERT INTO hoteles (nombre, ubicacion, precio_minimo,precio_maximo,calificacion,
          huespedes, pileta, desayuno) VALUES ('$nombre', '$ubicacion', '$precio_minimo', '$precio_maximo', '$calificacion', '$huespedes',
           '$pileta', '$desayuno')");
        echo "<h1>Registro de HOTEL Exitoso</h1>";

        
        
    ?>
</body>

</html>