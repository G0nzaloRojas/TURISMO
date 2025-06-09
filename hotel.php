<?php session_start();?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login de Usuarios</title>
</head>

<body>

<?php

$huespedes=2;
$calificacion_minima=3;
$pileta="si"; // "si" o "no"
$desayuno_incluido="si"; // "si" o "no"


include("conexion.php");

$consulta_hotel=mysqli_query($conexion, 
"SELECT * FROM hoteles
    WHERE ((`PRECIO_MINIMO` + `PRECIO_MAXIMO`) / 2) <= (
        SELECT MIN((`PRECIO_MINIMO` + `PRECIO_MAXIMO`) / 2) + 
               (MAX((`PRECIO_MINIMO` + `PRECIO_MAXIMO`) / 2) - MIN((`PRECIO_MINIMO` + `PRECIO_MAXIMO`) / 2)) / 3
        FROM hoteles
    )
    AND `HUESPEDES` >= 3
    AND `CALIFICACION` >= 3
    AND (`PILETA` = 'no' OR `PILETA` = 'si')
    AND (`DESAYUNO` = 'no' OR `DESAYUNO` = 'si')
    ORDER BY `CALIFICACION` DESC
    LIMIT 2
    
    UNION ALL
    
    (
    SELECT * FROM hoteles
    WHERE ((`PRECIO_MINIMO` + `PRECIO_MAXIMO`) / 2) > (
        SELECT MIN((`PRECIO_MINIMO` + `PRECIO_MAXIMO`) / 2) + 
               (MAX((`PRECIO_MINIMO` + `PRECIO_MAXIMO`) / 2) - MIN((`PRECIO_MINIMO` + `PRECIO_MAXIMO`) / 2)) / 3
        FROM hoteles
    )
    AND ((`PRECIO_MINIMO` + `PRECIO_MAXIMO`) / 2) <= (
        SELECT MIN((`PRECIO_MINIMO` + `PRECIO_MAXIMO`) / 2) + 
               2 * (MAX((`PRECIO_MINIMO` + `PRECIO_MAXIMO`) / 2) - MIN((`PRECIO_MINIMO` + `PRECIO_MAXIMO`) / 2)) / 3
        FROM hoteles
    )
    AND `HUESPEDES` >= 3
    AND `CALIFICACION` >= 3
    AND (`PILETA` = 'no' OR `PILETA` = 'si')
    AND (`DESAYUNO` = 'no' OR `DESAYUNO` = 'si')
    ORDER BY `CALIFICACION` DESC
    LIMIT 2
    )
    
    UNION ALL
    
    (
    SELECT * FROM hoteles
    WHERE ((`PRECIO_MINIMO` + `PRECIO_MAXIMO`) / 2) > (
        SELECT MIN((`PRECIO_MINIMO` + `PRECIO_MAXIMO`) / 2) + 
               2 * (MAX((`PRECIO_MINIMO` + `PRECIO_MAXIMO`) / 2) - MIN((`PRECIO_MINIMO` + `PRECIO_MAXIMO`) / 2)) / 3
        FROM hoteles
    )
    AND `HUESPEDES` >= 3
    AND `CALIFICACION` >= 3
    AND (`PILETA` = 'no' OR `PILETA` = 'si')
    AND (`DESAYUNO` = 'no' OR `DESAYUNO` = 'si')
    ORDER BY `CALIFICACION` DESC
    LIMIT 2
    );");

$resultado=mysqli_num_rows($consulta);

if($resultado!=0){

	//$respuesta=mysqli_fetch_assoc($consulta);
	
	//echo $respuesta[];
    while ($fila = mysqli_fetch_assoc($consulta)) {
        echo "<pre>";
        print_r($fila);
        echo "</pre>";
    }
    
    

}else{
	echo "error";
	
}








?>

</body>
</html>