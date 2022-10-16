<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}
require('class/contactos.php');
$objContactos = new Contactos();
$contacto = $objContactos->delete($_GET['id']);
?>