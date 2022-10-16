<?php
if (isset($principal)) {
  require('modulos/tablero/footer.php');
}
else{
  header('Location: ../../login.php');
}
?>