<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

require('class/clientes.php');
$ruc = $_REQUEST['ruc'];
$buscar = new Entidades();
$busqueda = $buscar->entidadPorRuc($ruc);

if ($busqueda>0) {
	echo "<div class='alert alert-danger'>".$busqueda[0]['razon_social_nombres']."<br>";
	echo "Cliente ya existe</div>";
	//header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else{
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://apiperu.dev/api/ruc/'.$ruc,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'GET',
	  CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
	  CURLOPT_HTTPHEADER => array(
	    'Content-Type: application/json',
	    'Authorization: Bearer b101e46b158878c8d1691fa3a51a1c358bfe6a3321dff219f5e218574cbfa815'
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	$resultado = json_decode($response,true);
	/*
	echo "<pre>";
	print_r($resultado);
	echo "</pre>";
	*/
	if ($resultado['success']==1) {
		$tipo_documento = 6;
		$razon_social = $resultado['data']['nombre_o_razon_social'];
		$cliente =1;
		$codigo_pais = "PE";
	
		if ($resultado['data']['ubigeo']['2']) {
			$ubigeo = $resultado['data']['ubigeo']['2'];
		}
		else {
			$ubigeo = "150101";
		}

		if ($resultado['data']['direccion']) {
			$direccion = $resultado['data']['direccion'];
		}
		else {
			$direccion = "-";
		}

		$estado = $resultado['data']['estado'];
		$condicion = $resultado['data']['condicion'];

		$AddCliente = $buscar->add3($tipo_documento,$ruc,$razon_social,$cliente,'0',$codigo_pais,$ubigeo,$direccion,'','',$estado,$condicion);
		//echo $ubigeo;
		echo "<div class='alert alert-success'>".$razon_social."<br>";
		echo "Guardado</div>";
	}
	else{
		echo "<div class='alert alert-danger'>".$resultado['message']."</div>";
	}
	
}
//echo $_SERVER['DOCUMENT_ROOT'];
?>