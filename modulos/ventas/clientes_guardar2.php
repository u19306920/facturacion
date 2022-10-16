<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

require('class/clientes.php');

if (isset($_POST['ubigeo'])) {
  $iddepartamento = substr($_POST['ubigeo'], 0,2);
  $idprovincia = substr($_POST['ubigeo'], 0,4);
  $iddistrito = $_POST['ubigeo'];

  $Bubigeos = new Entidades3();
  $Bubigeo = $Bubigeos->ubigeo($iddistrito);
  //$direccion=$_POST['direccion_fiscal']." - ".$Bubigeo[0]['distrito']." - ".$Bubigeo[0]['provincia']." - ".$Bubigeo[0]['departamento'];
}

$direccion=$_POST['direccion_fiscal'];

$clientes = new Entidades();
if (isset($_POST['ubigeo'])) {
  $cliente = $clientes->add($_POST['tipo_documento'],$_POST['ruc_dni'],$_POST['nombres_apellidos'],'1','0',$_POST['codigo_pais'],$_POST['ubigeo'],$direccion,$_POST['correo'],$_POST['telefono'],$_POST['estado'],'HABIDO');
}
else{
  $cliente = $clientes->add2($_POST['tipo_documento'],$_POST['ruc_dni'],$_POST['nombres_apellidos'],'1','0',$_POST['codigo_pais'],$direccion,$_POST['correo'],$_POST['telefono'],$_POST['estado'],'HABIDO');
}
/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/
?>