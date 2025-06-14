<?php
session_start();

// Verificar autenticación
if (!isset($_SESSION['id_cargo']) || ($_SESSION['id_cargo'] != 1 && $_SESSION['id_cargo'] != 3)) {
    echo json_encode(['success' => false, 'message' => 'No autorizado']);
    exit();
}

// Verificar que existe el id del usuario en la sesión
if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Sesión inválida - ID de usuario no encontrado']);
    exit();
}

include("../conexion.php");

$action = $_GET['action'] ?? $_POST['action'] ?? '';

try {
    switch($action) {
        case 'getAll':
            getBusinesses();
            break;
        case 'create':
            createBusiness();
            break;
        case 'update':
            updateBusiness();
            break;
        case 'delete':
            deleteBusiness();
            break;
        case 'getTiposComida':
            getTiposComida();
            break;
        case 'getActividades':
            getActividades();
            break;
        case 'getTotalCount':
            getTotalCount();
            break;
        default:
            echo json_encode(['success' => false, 'message' => 'Acción no válida']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

function getBusinesses() {
    global $conexion;
    
    $category = $_GET['category'] ?? 'restaurantes';
    $data = [];
    
    // Determinar si aplicar filtro por usuario
    $whereClause = '';
    if ($_SESSION['id_cargo'] == 3) {
        // Usuario regular: solo sus propios negocios
        $id_usuario = intval($_SESSION['id']);
        $whereClause = " WHERE ID_USUARIO = $id_usuario";
    }
    // Si es admin (id_cargo = 1): no se aplica filtro, ve todos los negocios
    
    switch($category) {
        case 'restaurantes':
            $query = "SELECT r.*, tc.DESCRIPCION as TIPO_COMIDA 
                     FROM restaurantes r 
                     LEFT JOIN `tipo de comida` tc ON r.ID_COMIDA = tc.ID" . 
                     $whereClause . " ORDER BY r.NOMBRE";
            break;
            
        case 'hoteles':
            $query = "SELECT * FROM hoteles" . $whereClause . " ORDER BY NOMBRE";
            break;
            
        case 'alquiler':
            $query = "SELECT * FROM alquiler" . $whereClause . " ORDER BY NOMBRE";
            break;
            
        case 'puntos_interes':
            $query = "SELECT pi.*, a.DESCRIPCION as ACTIVIDAD 
                     FROM `puntos de interes` pi 
                     LEFT JOIN actividad a ON pi.ID_ACTIVIDAD = a.ID" . 
                     $whereClause . " ORDER BY pi.NOMBRE";
            break;
            
        default:
            echo json_encode(['success' => false, 'message' => 'Categoría no válida']);
            return;
    }
    
    $result = mysqli_query($conexion, $query);
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode(['success' => true, 'data' => $data]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al obtener datos: ' . mysqli_error($conexion)]);
    }
}

function createBusiness() {
    global $conexion;
    
    $category = $_POST['category'];
    
    // Validar campos requeridos comunes
    $requiredFields = ['nombre', 'ubicacion', 'descripcion'];
    $missing = validateRequired($requiredFields, $_POST);
    
    if (!empty($missing)) {
        echo json_encode(['success' => false, 'message' => 'Campos requeridos faltantes: ' . implode(', ', $missing)]);
        return;
    }
    
    switch($category) {
        case 'restaurantes':
            createRestaurante();
            break;
        case 'hoteles':
            createHotel();
            break;
        case 'alquiler':
            createAlquiler();
            break;
        case 'puntos_interes':
            createPuntoInteres();
            break;
        default:
            echo json_encode(['success' => false, 'message' => 'Categoría no válida']);
    }
}

function createRestaurante() {
    global $conexion;
    
    $id_usuario = intval($_SESSION['id']); // Obtener ID del usuario de la sesión
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $ubicacion = mysqli_real_escape_string($conexion, $_POST['ubicacion']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
    $id_comida = !empty($_POST['id_comida']) ? intval($_POST['id_comida']) : 'NULL';
    $precio_minimo = !empty($_POST['precio_minimo']) ? intval($_POST['precio_minimo']) : 'NULL';
    $precio_maximo = !empty($_POST['precio_maximo']) ? intval($_POST['precio_maximo']) : 'NULL';
    
    $query = "INSERT INTO restaurantes (NOMBRE, UBICACION, DESCRIPCION, ID_COMIDA, `PRECIO MINIMO`, `PRECIO MAXIMO`, ID_USUARIO) 
              VALUES ('$nombre', '$ubicacion', '$descripcion', $id_comida, $precio_minimo, $precio_maximo, $id_usuario)";
    
    if (mysqli_query($conexion, $query)) {
        echo json_encode(['success' => true, 'message' => 'Restaurante creado correctamente', 'id' => mysqli_insert_id($conexion)]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al crear restaurante: ' . mysqli_error($conexion)]);
    }
}

function createHotel() {
    global $conexion;
    
    $id_usuario = intval($_SESSION['id']); // Obtener ID del usuario de la sesión
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $ubicacion = mysqli_real_escape_string($conexion, $_POST['ubicacion']);
    $precio_minimo = !empty($_POST['precio_minimo']) ? intval($_POST['precio_minimo']) : 0;
    $precio_maximo = !empty($_POST['precio_maximo']) ? intval($_POST['precio_maximo']) : 0;
    $calificacion = !empty($_POST['calificacion']) ? floatval($_POST['calificacion']) : 0;
    $huespedes = !empty($_POST['huespedes']) ? intval($_POST['huespedes']) : 1;
    $pileta = mysqli_real_escape_string($conexion, $_POST['pileta'] ?? 'no');
    $desayuno = mysqli_real_escape_string($conexion, $_POST['desayuno'] ?? 'no');
    
    $query = "INSERT INTO hoteles (NOMBRE, UBICACION, PRECIO_MINIMO, PRECIO_MAXIMO, CALIFICACION, HUESPEDES, PILETA, DESAYUNO, ID_USUARIO) 
              VALUES ('$nombre', '$ubicacion', $precio_minimo, $precio_maximo, $calificacion, $huespedes, '$pileta', '$desayuno', $id_usuario)";
    
    if (mysqli_query($conexion, $query)) {
        echo json_encode(['success' => true, 'message' => 'Hotel creado correctamente', 'id' => mysqli_insert_id($conexion)]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al crear hotel: ' . mysqli_error($conexion)]);
    }
}

function createAlquiler() {
    global $conexion;
    
    $id_usuario = intval($_SESSION['id']); // Obtener ID del usuario de la sesión
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $ubicacion = mysqli_real_escape_string($conexion, $_POST['ubicacion']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
    $precio_semana = !empty($_POST['precio_semana']) ? intval($_POST['precio_semana']) : 0;
    $calificacion = !empty($_POST['calificacion']) ? intval($_POST['calificacion']) : 1;
    $banios = !empty($_POST['banios']) ? intval($_POST['banios']) : 1;
    $dormitorios = !empty($_POST['dormitorios']) ? intval($_POST['dormitorios']) : 1;
    $camas_dobles = !empty($_POST['camas_dobles']) ? intval($_POST['camas_dobles']) : 0;
    $camas_simples = !empty($_POST['camas_simples']) ? intval($_POST['camas_simples']) : 0;
    $metros = !empty($_POST['metros']) ? intval($_POST['metros']) : 0;
    
    $query = "INSERT INTO alquiler (NOMBRE, UBICACION, PRECIO_SEMANA, CALIFICACION, BANIOS, DORMITORIOS, CAMAS_DOBLES, CAMAS_SIMPLES, METROS, DESCRIPCION, ID_USUARIO) 
              VALUES ('$nombre', '$ubicacion', $precio_semana, $calificacion, $banios, $dormitorios, $camas_dobles, $camas_simples, $metros, '$descripcion', $id_usuario)";
    
    if (mysqli_query($conexion, $query)) {
        echo json_encode(['success' => true, 'message' => 'Alquiler creado correctamente', 'id' => mysqli_insert_id($conexion)]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al crear alquiler: ' . mysqli_error($conexion)]);
    }
}

function createPuntoInteres() {
    global $conexion;
    
    $id_usuario = intval($_SESSION['id']); // Obtener ID del usuario de la sesión
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $ubicacion = mysqli_real_escape_string($conexion, $_POST['ubicacion']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
    $id_actividad = !empty($_POST['id_actividad']) ? intval($_POST['id_actividad']) : 1;
    $precio = !empty($_POST['precio']) ? intval($_POST['precio']) : 0;
    $calificacion = !empty($_POST['calificacion']) ? floatval($_POST['calificacion']) : 'NULL';
    
    $query = "INSERT INTO `puntos de interes` (NOMBRE, UBICACION, DESCRIPCION, ID_ACTIVIDAD, PRECIO, CALIFICACION, ID_USUARIO) 
              VALUES ('$nombre', '$ubicacion', '$descripcion', $id_actividad, $precio, $calificacion, $id_usuario)";
    
    if (mysqli_query($conexion, $query)) {
        echo json_encode(['success' => true, 'message' => 'Punto de interés creado correctamente', 'id' => mysqli_insert_id($conexion)]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al crear punto de interés: ' . mysqli_error($conexion)]);
    }
}

function updateBusiness() {
    global $conexion;
    
    $category = $_POST['category'];
    $id = intval($_POST['id']);
    
    if ($id <= 0) {
        echo json_encode(['success' => false, 'message' => 'ID no válido']);
        return;
    }
    
    // Verificar permisos: usuarios regulares solo pueden editar sus propios negocios
    if ($_SESSION['id_cargo'] == 3) {
        $table = '';
        switch($category) {
            case 'restaurantes':
                $table = 'restaurantes';
                break;
            case 'hoteles':
                $table = 'hoteles';
                break;
            case 'alquiler':
                $table = 'alquiler';
                break;
            case 'puntos_interes':
                $table = '`puntos de interes`';
                break;
            default:
                echo json_encode(['success' => false, 'message' => 'Categoría no válida']);
                return;
        }
        
        $id_usuario = intval($_SESSION['id']);
        $checkQuery = "SELECT ID FROM $table WHERE ID = $id AND ID_USUARIO = $id_usuario";
        $checkResult = mysqli_query($conexion, $checkQuery);
        
        if (!$checkResult || mysqli_num_rows($checkResult) == 0) {
            echo json_encode(['success' => false, 'message' => 'No tienes permisos para editar este negocio']);
            return;
        }
    }
    
    // Validar campos requeridos comunes
    $requiredFields = ['nombre', 'ubicacion', 'descripcion'];
    $missing = validateRequired($requiredFields, $_POST);
    
    if (!empty($missing)) {
        echo json_encode(['success' => false, 'message' => 'Campos requeridos faltantes: ' . implode(', ', $missing)]);
        return;
    }
    
    switch($category) {
        case 'restaurantes':
            updateRestaurante($id);
            break;
        case 'hoteles':
            updateHotel($id);
            break;
        case 'alquiler':
            updateAlquiler($id);
            break;
        case 'puntos_interes':
            updatePuntoInteres($id);
            break;
        default:
            echo json_encode(['success' => false, 'message' => 'Categoría no válida']);
    }
}

function updateRestaurante($id) {
    global $conexion;
    
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $ubicacion = mysqli_real_escape_string($conexion, $_POST['ubicacion']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
    $id_comida = !empty($_POST['id_comida']) ? intval($_POST['id_comida']) : 'NULL';
    $precio_minimo = !empty($_POST['precio_minimo']) ? intval($_POST['precio_minimo']) : 'NULL';
    $precio_maximo = !empty($_POST['precio_maximo']) ? intval($_POST['precio_maximo']) : 'NULL';
    
    $query = "UPDATE restaurantes SET 
              NOMBRE = '$nombre', 
              UBICACION = '$ubicacion', 
              DESCRIPCION = '$descripcion', 
              ID_COMIDA = $id_comida, 
              `PRECIO MINIMO` = $precio_minimo, 
              `PRECIO MAXIMO` = $precio_maximo 
              WHERE ID = $id";
    
    if (mysqli_query($conexion, $query)) {
        if (mysqli_affected_rows($conexion) > 0) {
            echo json_encode(['success' => true, 'message' => 'Restaurante actualizado correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se realizaron cambios o el restaurante no existe']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar restaurante: ' . mysqli_error($conexion)]);
    }
}

function updateHotel($id) {
    global $conexion;
    
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $ubicacion = mysqli_real_escape_string($conexion, $_POST['ubicacion']);
    $precio_minimo = !empty($_POST['precio_minimo']) ? intval($_POST['precio_minimo']) : 0;
    $precio_maximo = !empty($_POST['precio_maximo']) ? intval($_POST['precio_maximo']) : 0;
    $calificacion = !empty($_POST['calificacion']) ? floatval($_POST['calificacion']) : 0;
    $huespedes = !empty($_POST['huespedes']) ? intval($_POST['huespedes']) : 1;
    $pileta = mysqli_real_escape_string($conexion, $_POST['pileta'] ?? 'no');
    $desayuno = mysqli_real_escape_string($conexion, $_POST['desayuno'] ?? 'no');
    
    $query = "UPDATE hoteles SET 
              NOMBRE = '$nombre', 
              UBICACION = '$ubicacion', 
              PRECIO_MINIMO = $precio_minimo, 
              PRECIO_MAXIMO = $precio_maximo, 
              CALIFICACION = $calificacion, 
              HUESPEDES = $huespedes, 
              PILETA = '$pileta', 
              DESAYUNO = '$desayuno' 
              WHERE ID = $id";
    
    if (mysqli_query($conexion, $query)) {
        if (mysqli_affected_rows($conexion) > 0) {
            echo json_encode(['success' => true, 'message' => 'Hotel actualizado correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se realizaron cambios o el hotel no existe']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar hotel: ' . mysqli_error($conexion)]);
    }
}

function updateAlquiler($id) {
    global $conexion;
    
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $ubicacion = mysqli_real_escape_string($conexion, $_POST['ubicacion']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
    $precio_semana = !empty($_POST['precio_semana']) ? intval($_POST['precio_semana']) : 0;
    $calificacion = !empty($_POST['calificacion']) ? intval($_POST['calificacion']) : 1;
    $banios = !empty($_POST['banios']) ? intval($_POST['banios']) : 1;
    $dormitorios = !empty($_POST['dormitorios']) ? intval($_POST['dormitorios']) : 1;
    $camas_dobles = !empty($_POST['camas_dobles']) ? intval($_POST['camas_dobles']) : 0;
    $camas_simples = !empty($_POST['camas_simples']) ? intval($_POST['camas_simples']) : 0;
    $metros = !empty($_POST['metros']) ? intval($_POST['metros']) : 0;
    
    $query = "UPDATE alquiler SET 
              NOMBRE = '$nombre', 
              UBICACION = '$ubicacion', 
              PRECIO_SEMANA = $precio_semana, 
              CALIFICACION = $calificacion, 
              BANIOS = $banios, 
              DORMITORIOS = $dormitorios, 
              CAMAS_DOBLES = $camas_dobles, 
              CAMAS_SIMPLES = $camas_simples, 
              METROS = $metros, 
              DESCRIPCION = '$descripcion' 
              WHERE ID = $id";
    
    if (mysqli_query($conexion, $query)) {
        if (mysqli_affected_rows($conexion) > 0) {
            echo json_encode(['success' => true, 'message' => 'Alquiler actualizado correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se realizaron cambios o el alquiler no existe']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar alquiler: ' . mysqli_error($conexion)]);
    }
}

function updatePuntoInteres($id) {
    global $conexion;
    
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $ubicacion = mysqli_real_escape_string($conexion, $_POST['ubicacion']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
    $id_actividad = !empty($_POST['id_actividad']) ? intval($_POST['id_actividad']) : 1;
    $precio = !empty($_POST['precio']) ? intval($_POST['precio']) : 0;
    $calificacion = !empty($_POST['calificacion']) ? floatval($_POST['calificacion']) : 'NULL';
    
    $query = "UPDATE `puntos de interes` SET 
              NOMBRE = '$nombre', 
              UBICACION = '$ubicacion', 
              DESCRIPCION = '$descripcion', 
              ID_ACTIVIDAD = $id_actividad, 
              PRECIO = $precio, 
              CALIFICACION = $calificacion 
              WHERE ID = $id";
    
    if (mysqli_query($conexion, $query)) {
        if (mysqli_affected_rows($conexion) > 0) {
            echo json_encode(['success' => true, 'message' => 'Punto de interés actualizado correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se realizaron cambios o el punto de interés no existe']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar punto de interés: ' . mysqli_error($conexion)]);
    }
}

function deleteBusiness() {
    global $conexion;
    
    $category = $_POST['category'];
    $id = intval($_POST['id']);
    
    if ($id <= 0) {
        echo json_encode(['success' => false, 'message' => 'ID no válido']);
        return;
    }
    
    $table = '';
    switch($category) {
        case 'restaurantes':
            $table = 'restaurantes';
            break;
        case 'hoteles':
            $table = 'hoteles';
            break;
        case 'alquiler':
            $table = 'alquiler';
            break;
        case 'puntos_interes':
            $table = '`puntos de interes`';
            break;
        default:
            echo json_encode(['success' => false, 'message' => 'Categoría no válida']);
            return;
    }
    
    // Verificar permisos: usuarios regulares solo pueden eliminar sus propios negocios
    if ($_SESSION['id_cargo'] == 3) {
        $id_usuario = intval($_SESSION['id']);
        $checkQuery = "SELECT ID FROM $table WHERE ID = $id AND ID_USUARIO = $id_usuario";
        $checkResult = mysqli_query($conexion, $checkQuery);
        
        if (!$checkResult || mysqli_num_rows($checkResult) == 0) {
            echo json_encode(['success' => false, 'message' => 'No tienes permisos para eliminar este negocio']);
            return;
        }
    }
    
    $query = "DELETE FROM $table WHERE ID = $id";
    
    if (mysqli_query($conexion, $query)) {
        if (mysqli_affected_rows($conexion) > 0) {
            echo json_encode(['success' => true, 'message' => 'Negocio eliminado correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se encontró el negocio a eliminar']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar: ' . mysqli_error($conexion)]);
    }
}

function getTiposComida() {
    global $conexion;
    
    $query = "SELECT * FROM `tipo de comida` ORDER BY DESCRIPCION";
    $result = mysqli_query($conexion, $query);
    
    $data = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode(['success' => true, 'data' => $data]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al obtener tipos de comida: ' . mysqli_error($conexion)]);
    }
}

function getActividades() {
    global $conexion;
    
    $query = "SELECT * FROM actividad ORDER BY DESCRIPCION";
    $result = mysqli_query($conexion, $query);
    
    $data = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode(['success' => true, 'data' => $data]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al obtener actividades: ' . mysqli_error($conexion)]);
    }
}

function getTotalCount() {
    global $conexion;
    
    $total = 0;
    
    // Determinar si aplicar filtro por usuario
    $whereClause = '';
    if ($_SESSION['id_cargo'] == 3) {
        // Usuario regular: solo contar sus propios negocios
        $id_usuario = intval($_SESSION['id']);
        $whereClause = " WHERE ID_USUARIO = $id_usuario";
    }
    // Si es admin (id_cargo = 1): cuenta todos los negocios
    
    // Contar restaurantes
    $result = mysqli_query($conexion, "SELECT COUNT(*) as count FROM restaurantes" . $whereClause);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $total += $row['count'];
    }
    
    // Contar hoteles
    $result = mysqli_query($conexion, "SELECT COUNT(*) as count FROM hoteles" . $whereClause);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $total += $row['count'];
    }
    
    // Contar alquileres
    $result = mysqli_query($conexion, "SELECT COUNT(*) as count FROM alquiler" . $whereClause);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $total += $row['count'];
    }
    
    // Contar puntos de interés
    $result = mysqli_query($conexion, "SELECT COUNT(*) as count FROM `puntos de interes`" . $whereClause);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $total += $row['count'];
    }
    
    echo json_encode(['success' => true, 'total' => $total]);
}

// Función para validar datos requeridos
function validateRequired($fields, $data) {
    $missing = [];
    foreach ($fields as $field) {
        if (empty($data[$field])) {
            $missing[] = $field;
        }
    }
    return $missing;
}

// Función para limpiar entrada
function cleanInput($input) {
    global $conexion;
    return mysqli_real_escape_string($conexion, htmlspecialchars(strip_tags(trim($input))));
}

// Función para validar email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Función para validar números
function validateNumber($number, $min = null, $max = null) {
    if (!is_numeric($number)) {
        return false;
    }
    
    $num = floatval($number);
    
    if ($min !== null && $num < $min) {
        return false;
    }
    
    if ($max !== null && $num > $max) {
        return false;
    }
    
    return true;
}

// Función para logging de errores
function logError($message, $data = null) {
    $log = date('Y-m-d H:i:s') . " - " . $message;
    if ($data) {
        $log .= " - Data: " . json_encode($data);
    }
    error_log($log . "\n", 3, "../logs/api_errors.log");
}
?>