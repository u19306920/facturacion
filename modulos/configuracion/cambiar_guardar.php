<?php
session_start();
//print_r($_POST);
//print_r($_SESSION);

require('class/usuarios.php');

$objUsuarios = new Usuarios();
$usuarios = $objUsuarios->usuarioPorId($_SESSION['idusuarios']);

$clave = md5($_POST['pwa']);
$clave2 = md5($_POST['pwd1']);

if ($clave == $usuarios[0]['password']) {
	$cambio = $objUsuarios->update3($clave2, $_SESSION['idusuarios']);
	//echo "ok";
}

?>