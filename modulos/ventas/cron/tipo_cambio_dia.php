<?php
require($_SERVER['DOCUMENT_ROOT'].'/modulos/ventas/class/tipo_cambio.php');
$busqueda = date("Y-m-d");

//echo $busqueda;

$objTcDia = new Tipo_Cambio();
$TcDia = $objTcDia->tipo_cambioPorFecha($busqueda);

if (!$TcDia) {
	//extraer el tipo de cambio del dia desde web DSP o SUNAT
	$context = stream_context_create(array('http' => array('timeout' => 5)));

	// Definimos la URL, en este caso de ejemplo será example.com
	$url = "http://dataserver.pe/tipo_cambio/tipo_cambio.php";

	// Con la función file_get_contents() obtenemos en una cadena el contenido de la web
	$Tcodigo = file_get_contents($url, 0, $context);

	// Creamos un objeto de la clase DOMDocument al que le pasaremos la cadena que guarda todo el HTML
	// mediante el método loadHTML()
	$doc = new DOMDocument();
	$doc->loadHTML($Tcodigo);

	$p = $doc->getElementsByTagName('body');

	foreach($p as $texto){
	$valor = $texto->nodeValue;
	}

	// Ejemplo 1
	$datos = explode("|", $valor);
	$fecha1 = $datos[0];
	$compra = $datos[1];
	$venta = $datos[2];

	$fechador = explode("/",$fecha1);
	$fecha=$fechador[2]."-".$fechador[1]."-".$fechador[0];

	$ObjTc = new Tipo_cambio();
	$Tc = $ObjTc->addcron($busqueda,$compra,$venta);
}


?>