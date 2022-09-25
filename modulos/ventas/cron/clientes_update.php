<?php
//consultar clientes
require($_SERVER['DOCUMENT_ROOT'].'/modulos/ventas/class/clientes.php');
$ObjClientes = new Entidades();
$clientes = $ObjClientes->entidades();

$ObjApi = new Entidades3;
//crear foreach con resultados

foreach ($clientes as $cliente) {
	//preguntar ultima actualizacion
	$date2 = new DateTime(date("Y-m-d"));
	$date1 = new DateTime($cliente['actualizado']);
	$diff = $date1->diff($date2);
	// will output 2 days
	$dias = $diff->days;
	if ($cliente['tipo_documento']==6 and $dias>=7) {
		//realizar busqueda de informacion actual en api
		$clienteApi = $ObjApi->entidadPorRuc($cliente['ruc_dni']);

		$rz = $clienteApi[0]['razon_social'];
		$ub = $clienteApi[0]['ubigeo'];
		
		$est = $clienteApi[0]['estado_contribuyente'];
		$cond = $clienteApi[0]['condicion_domicilio'];

		$direccion = "";
			if ($clienteApi[0]['tipo_via']!="-") {
				$direccion.=$clienteApi[0]['tipo_via']." ";
			}
			if ($clienteApi[0]['nombre_via']!="-") {
				$direccion.=$clienteApi[0]['nombre_via']." ";
			}
			if ($clienteApi[0]['kilometro_domicilio']!="-") {
				$direccion.="KM. ".$clienteApi[0]['kilometro_domicilio']." ";
			}
			if ($clienteApi[0]['numero_domicilio']!="-") {
				$direccion.=$clienteApi[0]['numero_domicilio']." ";
			}
			if ($clienteApi[0]['departamento_domicilio']!="-") {
				$direccion.="DPTO. ".$clienteApi[0]['departamento_domicilio']." ";
			}
			if ($clienteApi[0]['interior_domicilio']!="-") {
				$direccion.="INT. ".$clienteApi[0]['interior_domicilio']." ";
			}
			if ($clienteApi[0]['manzana_domicilio']!="-") {
				$direccion.="MZ. ".$clienteApi[0]['manzana_domicilio']." ";
			}
			if ($clienteApi[0]['lote_domicilio']!="-") {
				$direccion.="LT. ".$clienteApi[0]['lote_domicilio']." ";
			}
			if ($clienteApi[0]['codigo_zona']!="-") {
				$direccion.=$clienteApi[0]['codigo_zona']." ";
			}
			if ($clienteApi[0]['tipo_zona']!="-") {
				$direccion.=$clienteApi[0]['tipo_zona']." ";
			}
		//hacer actualizacion por ruc
		$update = $ObjClientes->updatecron($rz,$ub,$direccion,$est,$cond,$cliente['identidades']);

		echo $cliente['ruc_dni']."<br>";
		
	}	
}
?>