<?php session_start();?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login de Usuarios</title>
<style>
.error-message {
    background-color: #dc3545;
    color: white;
    font-weight: bold;
    font-size: 16px;
    padding: 15px 20px;
    border-radius: 8px;
    margin: 20px auto;
    display: table; 
	border: 1px solid #dc3545;
}
</style>
</head>

<body>

<?php
$email=$_POST['email'];
$password=md5($_POST['password']);

include("conexion.php");

$consulta=mysqli_query($conexion, "SELECT nombre, apellido, email, id_cargo, id FROM usuarios WHERE email='$email' AND password='$password'");

$resultado=mysqli_num_rows($consulta);

if($resultado!=0){

	$respuesta=mysqli_fetch_assoc($consulta);
	
	$_SESSION['nombre']=$respuesta['nombre'];
	$_SESSION['apellido']=$respuesta['apellido'];
	$_SESSION['id_cargo']=$respuesta['id_cargo'];
	$_SESSION['id']=$respuesta['id'];
	header("Location: index.php");
	exit(); //detener la ejecución

}else{
	echo "<div class='error-message'>Debes Iniciar Sesión</div>";
	include ("form_login.php");
}
?>

</body>
</html>