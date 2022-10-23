<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

require('class/items.php');
$objCategoria = new Items();
$categorias = $objCategoria->deleteCategoria($_GET['id']);
?>