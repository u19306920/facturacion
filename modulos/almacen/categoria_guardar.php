<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

require('class/items.php');
//print_r($_POST);
$objCategoria = new Items();
$Categoria = $objCategoria->addCategoria($_POST['descripcion'],$_POST['codigo_categoria']);

?>