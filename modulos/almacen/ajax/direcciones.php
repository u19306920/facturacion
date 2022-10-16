<?php
session_start();
if ($_SESSION['sesion']==1) {
    require($_SERVER['DOCUMENT_ROOT'].'/config/config.php');
    $conexion=mysqli_connect($host,$user,$pass,$bd);

    $cliente=$_POST['cliente'];

    $sql="
    	SELECT
        *
        FROM direcciones
        WHERE
        direcciones.identidades = '$cliente'";

    $result=mysqli_query($conexion,$sql);

    $direcciones="";

    while ($ver=mysqli_fetch_row($result)) {
    	$direcciones=$direcciones.'<option value='.$ver[0].'>'.utf8_encode($ver[1]).'</option>';
    }

    echo  $direcciones;
}
?>