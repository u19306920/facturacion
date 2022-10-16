<?php
session_start();
if ($_SESSION['sesion']==1) {
    require($_SERVER['DOCUMENT_ROOT'].'/config/config.php');
    $conexion=mysqli_connect($host,$user,$pass,$bd);

    $transportista=$_POST['transportista'];

    $sql="
    	SELECT
        *
        FROM vehiculos
        WHERE
        vehiculos.idtransportistas = '$transportista'";

    $result=mysqli_query($conexion,$sql);

    $vehiculos="";

    while ($ver=mysqli_fetch_row($result)) {
    	$vehiculos=$vehiculos.'<option value='.$ver[0].'>'.utf8_encode($ver[1]).'-'.utf8_encode($ver[2]).'</option>';
    }

    echo  $vehiculos;
}

?>