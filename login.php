<?php session_start();?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login de Usuarios</title>
</head>

<body>

<?php
$username=$_POST['username'];
$password=md5($_POST['password']);


include("conexion.php");

$consulta=mysqli_query($conexion, "SELECT nombre, apellido, email, id_cargo FROM usuarios WHERE username='$username' AND password='$password'");

$resultado=mysqli_num_rows($consulta);

if($resultado!=0){

	$respuesta=mysqli_fetch_assoc($consulta);
	
	$_SESSION['nombre']=$respuesta['nombre'];
	$_SESSION['apellido']=$respuesta['apellido'];
	$_SESSION['id_cargo']=$respuesta['id_cargo'];
		
		echo "Hola ".$_SESSION['nombre']." ".$_SESSION['apellido']." ".$_SESSION['id_cargo']."<br />";
		echo "Acceso al panel de usuarios.<br/>";
		echo "<a href='index.php'>INICIO PA</a>";	

}else{
	echo "No es un usuario registrado";
	include ("form_register.php");
}








?>

</body>
</html>