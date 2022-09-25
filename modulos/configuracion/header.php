<?php
if (isset($principal)) {
  require('modulos/tablero/header.php');
}
else{
  header('Location: ../../login.php');
}
?>