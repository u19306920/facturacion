<?php
if (isset($principal)) {
  require('modulos/tablero/left.php');
}
else{
  header('Location: ../../login.php');
}
?>