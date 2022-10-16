<?php
session_start();
if ($_SESSION['sesion']==1) {
    require($_SERVER['DOCUMENT_ROOT'].'/config/config.php');
    $conexion=mysqli_connect($host,$user,$pass,$bd);

    $tipo_documento=$_POST['tipo_documento'];

    $sql="
    	SELECT
        *
        FROM comprobantes_series
        WHERE
        comprobantes_series.tipo_documento = '$tipo_documento' and comprobantes_series.estado=1";

    $result=mysqli_query($conexion,$sql);

    $series="";

    while ($ver=mysqli_fetch_row($result)) {
    	$series=$series.'<option value='.$ver[2].'>'.utf8_encode($ver[2]).'</option>';
    }

    echo  $series;
}
?>