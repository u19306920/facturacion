<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

require('class/transportistas.php');
$objTransportistas = new Transportistas();
$transportistas = $objTransportistas->delete($_GET['id']);
?>