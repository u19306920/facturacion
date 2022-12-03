<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

require('class/usuarios.php');
print_r($_POST);
$objUsuarios = new Usuarios();
$usuario = $objUsuarios->add($_POST['usuario'],$_POST['clave'],$_POST['nombres'],$_POST['apellidos'],$_POST['dni'],$_POST['perfil']);

?>