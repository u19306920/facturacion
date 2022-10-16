<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

require('class/clientes.php');
$objClientes = new Entidades();
$clientes = $objClientes->delete($_GET['id']);
?>