<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

require('class/conductores.php');
//print_r($_POST);
$objConductores = new Conductores();
$conductor = $objConductores->add($_POST['nombres'],$_POST['licencia'],$_POST['estado'],$_POST['idtransportistas']);
?>