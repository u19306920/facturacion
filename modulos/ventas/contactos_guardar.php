<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}
require('class/clientes.php');
require('class/contactos.php');
//print_r($_POST);

$objContactos = new Contactos();
$contacto = $objContactos->add($_POST['nombres_apellidos'],$_POST['correo'],$_POST['telefono'],$_POST['estado'],$_POST['identidades']);
?>