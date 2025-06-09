<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>

<body>
    <?php
        include ("conexion.php");

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $cargo = $_POST['id_cargo'];
        
        
        if($_POST['id_cargo'] == "USUARIO NORMAL"){
            $cargo = 2;
        }elseif($_POST['id_cargo'] == "DUEÑO DE NEGOCIO"){
            $cargo = 3;
        }else{
            echo "Tipo de usuario no válido.";
        }

        $consulta = mysqli_query($conexion, "INSERT INTO usuarios (nombre, apellido, email, username, password, id_cargo) VALUES ('$nombre', '$apellido', '$email', '$username', '$password', '$cargo')");
        header("Location:form_login.php");
    ?>
</body>

</html>
