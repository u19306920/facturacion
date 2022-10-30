<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

require('class/guias.php');
//print_r($_POST);
$objGuias = new Guias();
$objGuias->update_ocs_ots_estado($_POST['ocs'],$_POST['ots'],$_POST['idguias']);
header('Location: ' . $_SERVER['HTTP_REFERER']);

?>