<?php
session_start();

// Destruir variables de sesión
$_SESSION = array();

//borrar la cookie de sesión
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio
header("Location: index.php");
exit();
?>