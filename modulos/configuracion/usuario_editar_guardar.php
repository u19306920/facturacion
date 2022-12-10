<?php
session_start();
if ($_SESSION['sesion']!=1 and $_SESSION['sesion']!=2) {
  header('Location: ../../login.php');
}

require('class/usuarios.php');
/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/
$objUsuarios = new Usuarios();

if ($_POST['perfil']<=4 and $_POST['perfil']>0) {
  $token="gSrXVdDzYAfNZiajWsohZkebGKtmfBuQ635MwUdbUzByh2wHNG";
}
else{
  $token=0;
}

if (isset($_POST['clave'])) {
  $clave = $_POST['clave'];
  //echo "con clave";
  $clave = md5($_POST['clave']);
  $usuario = $objUsuarios->update($_POST['usuario'],$clave,$token,$_POST['perfil'],$_POST['idusuarios']);
}

else{
  
  //echo "sin clave";
  $usuario = $objUsuarios->update2($_POST['usuario'],$token,$_POST['perfil'],$_POST['idusuarios']);
  
}
?>