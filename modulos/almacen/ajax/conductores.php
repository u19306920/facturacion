<?php
session_start();
if ($_SESSION['sesion']==1) {
    require($_SERVER['DOCUMENT_ROOT'].'/config/config.php');
    $conexion=mysqli_connect($host,$user,$pass,$bd);

    $transportista=$_POST['transportista'];

    $sql="
    	SELECT
        *
        FROM conductores
        WHERE
        conductores.idtransportistas = '$transportista'";

    $result=mysqli_query($conexion,$sql);

    $conductores="";

    while ($ver=mysqli_fetch_row($result)) {
    	$conductores=$conductores.'<option value='.$ver[0].'>'.utf8_encode($ver[2]).'-'.utf8_encode($ver[1]).'</option>';
    }

    echo  $conductores;
}
?>