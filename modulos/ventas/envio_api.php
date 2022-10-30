<?php
session_start();
//echo $_SESSION['token'];
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

if (!isset($_GET['success'])) {
	
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
</head>
<body>
<?php
require('class/comprobantes.php');
$objComprobantes = new Comprobantes();
$comprobante = $objComprobantes->comprobantePorId($_GET['id']);
//echo $_GET['id'];
//print_r($comprobante);
?>
<script>
	var settings = {
	  "url": "<?=$_SESSION['url']?>/api/documents/send",
	  "method": "POST",
	  "timeout": 0,
	  "headers": {
	    "Authorization": "Bearer <?=$_SESSION['token']?>",
	    "Content-Type": "application/json"
	  },
	  "data": JSON.stringify({
	    "external_id": "<?=$comprobante[0]['observaciones']?>"
	  }),
	};

	$.ajax(settings).done(function (response) {
	  console.log(response);
	  var paramJson = JSON.stringify(response, null, 2);
	  var obj1 = jQuery.parseJSON(paramJson);
	  window.location.href = window.location.href + "&success=" + obj1.success + "&external_id=" + obj1.data['external_id'] + "&state_type_id=" + obj1.data['state_type_id'] + "&number=" + obj1.data['number'];
	});
</script>
<?php
}

if (isset($_GET['success'])) {
	require('class/comprobantes.php');
	$objComprobantes = new Comprobantes();
	
	    // asignar w1 y w2 a dos variables
	    $phpVar1 = $_GET["success"];
	    $phpVar2 = $_GET["external_id"];
	    $phpVar3 = $_GET["state_type_id"];
	    $phpVar4 = $_GET["number"];

	    $doc = explode("-", $phpVar4);

	    $objComprobantes->envio_sunat($phpVar2);
	    $objComprobantes->estado_respuesta($phpVar3,$doc[0],$doc[1]);
	    // mostrar
			/*
	    echo "<p>" . $phpVar1 . "</p>";
	    echo "<p>" . $phpVar2 . "</p>";
	    echo "<p>" . $phpVar3 . "</p>";
			*/
	header('Location: ' . "../../index.php?module=ventas&page=comprobantes");
}
?>
</body>
</html>