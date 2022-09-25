<?php
if (isset($principal)) {
  require('modulos/tablero/right.php');
}
else{
  header('Location: ../../login.php');
}
?>