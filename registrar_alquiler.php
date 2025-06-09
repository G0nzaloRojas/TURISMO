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
        $precio_semana = $_POST['precio_semana'];
        $descripcion = $_POST['descripcion'];
        $calificacion = $_POST['calificacion'];
        $dormitorios = $_POST['dormitorios'];
        $banios = $_POST['banios'];
        $metros = $_POST['metros'];
        $camas_dobles = $_POST['camas_dobles'];
        $camas_simples = $_POST['camas_simples'];
        
        

        $consulta = mysqli_query($conexion, "INSERT INTO alquiler (nombre, ubicacion, precio_semana, descripcion,calificacion,dormitorios,banios,metros,camas_dobles,camas_simples) VALUES ('$nombre', '$ubicacion', '$precio_semana', '$descripcion', '$calificacion', '$dormitorios', '$banios', '$metros','$camas_dobles', '$camas_simples')");
        echo "<h1>Registro de Alquiler Exitoso</h1>";

        
        
    ?>
</body>

</html>