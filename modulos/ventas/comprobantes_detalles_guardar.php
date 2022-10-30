<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

if (!isset($_GET['succes']) and isset($_POST['forma_de_pago'])) {

//print_r($_POST);
require('class/ordenes.php');
require('class/guias.php');
require('class/comprobantes.php');

$objValor_porcentaje_igv = new Comprobantes();
$valor_porcentaje_igv = $objValor_porcentaje_igv->comprobantePorId($_POST['idcomprobantes']);

$pdetraccion = 0.10;

if ($valor_porcentaje_igv[0]['codigo_tipo_operacion']=='0200') {
  $porcentaje=0.0;
  $codigo_descuento = '04';
  $txt_codigo_descuento = 'Descuentos globales por anticipos gravados que afectan la base imponible del IGV/IVAP';
}
else{
  $porcentaje=0.18;
  $codigo_descuento = '04';
  $txt_codigo_descuento = 'Descuentos globales por anticipos gravados que afectan la base imponible del IGV/IVAP';
}


//jalamos los dias de la forma de pago para crear fecha de vencimiento
$objfp = new Ordenes();
$metodo = $objfp->metodos_de_pagoPorId($_POST['forma_de_pago']);

if ($metodo[0]['dias']) {
	$dias = "+ ".$metodo[0]['dias']." days";

	$fecha = DateTime::createFromFormat('d-M-Y', $_POST['fecha_emision']);
	//sumo 1 día
	$fecha = date("Y-m-d",strtotime($fecha.$dias)); 
	
}
else{
	$dias = "0 days";
	$fecha = $_POST['fecha_emision'];
	
}
//mostramos fecha de vencimiento
$fecha_vencimiento = $fecha;
//mostramos tipo de moneda
$codigo_tipo_moneda = $_POST['moneda'];
//echo $codigo_tipo_moneda;
//jalamos las ordenes de compra desde el input hidden que fue array
$ots = $_POST['ots'];
$ots = substr($ots,0,-1);
$ocs = $_POST['ocs'];
$ocs = substr($ocs,0,-1);
$gs = $_POST['gs'];

$idcomprobantes = $_POST['idcomprobantes'];
$objComprobantes = new Comprobantes();
$objGuias = new Guias();

//amarramos guias con factura.
$guias = explode("/", $gs);

//print_r($guias);
$guiasI='"guias": [ ';
$guiasC='';
$i=0;
foreach ($guias as $key) {
	//amarramos el idguia con el idcomprobante
  if ($key) {
    $cambio = $objComprobantes->amarreCG($idcomprobantes,$key);
    $estado_guia = $objGuias->cambiar('3',$key);

    $cguia = $objGuias->guiaPorId($key);

    $guiasC.='{"numero": "'.$cguia[0]["guia"].'", "codigo_tipo_documento": "09"},';
    $i++;
  }
	
}
$guiasC = substr($guiasC,0,-1);

$guiasF = $guiasI.$guiasC."],";


//Buscamos anticipos en carrito
$total_anticipos = 0;
$total_descuentos = 0;
$txt_anticipoF='';
if (isset($_SESSION['carro_anticipo'])) {
  $txt_anticipoI='"anticipos": [ ';
  $txt_anticipoC='';
  $p=0;
  
  foreach ($_SESSION['carro_anticipo'] as $fanticipo) {
    $total_anticipos = $total_anticipos + round($fanticipo['usar']*(1+$porcentaje),2,PHP_ROUND_HALF_UP);
    $total_descuentos = $total_descuentos + $fanticipo['usar'];
    $Ant_comprobante = $objComprobantes->comprobantePorId($fanticipo['idcomprobantes']);
    //print_r($Ant_comprobante);
    $txt_anticipoC.='{"numero":"'.$Ant_comprobante[0]["serie_documento"].'-'.$Ant_comprobante[0]["numero_documento"].'", "codigo_tipo_documento": "02", "monto": '.$fanticipo['usar'].', "total": '.round($fanticipo['usar']*(1+$porcentaje),2,PHP_ROUND_HALF_UP).'},';
  }
  $txt_anticipoC = substr($txt_anticipoC,0,-1);
  $txt_anticipoF = $txt_anticipoI.$txt_anticipoC."],";

}

//calculamos los montos subtotal, igv y totales.
$total_exportacion = 0;
$total_operaciones_gravadas = 0;
$total_operaciones_inafectas = 0;
$total_operaciones_exoneradas = 0;
$total_operaciones_gratuitas = 0;
$total_igv_operaciones_gratuitas = 0;
$total_impuestos_bolsa_plastica = 0;
$total_igv = 0;
$total_impuestos = 0;
$total_valor = 0;
$total_venta = 0;
$total_pendiente_de_pago = 0;

$comprobantes = $objComprobantes->comprobantePorId($idcomprobantes);

//buscamos los items en la factura y calculamos los totales
$calculos = $objComprobantes->calculo_totales($idcomprobantes);

//print_r($calculos);

//VENTA Y VENTAS NO DOM. NO CALIFICA COMO EXPORT.
if ($comprobantes[0]['codigo_tipo_operacion']=='0101' or $comprobantes[0]['codigo_tipo_operacion']=='0401') {
  foreach ($calculos as $calculo) {
  	$total_operaciones_gravadas = $total_operaciones_gravadas + round($calculo['cantidad']*$calculo['valor_unitario'],2,PHP_ROUND_HALF_UP);
    $total_igv = $total_igv + round($calculo['cantidad']*$calculo['valor_unitario']*$porcentaje,2,PHP_ROUND_HALF_UP);
    $total_venta = $total_venta + round($calculo['cantidad']*$calculo['valor_unitario']*(1+$porcentaje),2,PHP_ROUND_HALF_UP);
  }
  $total_operaciones_gravadas2 = $total_operaciones_gravadas - $total_descuentos;
  $total_igv2 = $total_igv - $total_descuentos*($porcentaje);
  $total_venta2 = $total_venta - $total_anticipos;
}
//EXPORTACION
elseif($comprobantes[0]['codigo_tipo_operacion']=='0200') {
  $porcentaje=0;
  foreach ($calculos as $calculo) {
  	$total_exportacion = $total_exportacion + round($calculo['cantidad']*$calculo['valor_unitario'],2,PHP_ROUND_HALF_UP);
    $total_igv = 0;
    $total_venta=$total_exportacion;
  }
  $total_operaciones_gravadas2 = $total_operaciones_gravadas - $total_descuentos;
  //$total_operaciones_gravadas2 = $total_operaciones_gravadas;
  //$total_exportacion = $total_exportacion - $total_descuentos;
  $total_igv2 = 0;
  $total_venta2 = $total_venta - $total_anticipos;
}
//OPERACION SUJETA A DETRACCION
elseif($comprobantes[0]['codigo_tipo_operacion']=='1001') {
  foreach ($calculos as $calculo) {
  	$total_operaciones_gravadas = $total_operaciones_gravadas + round($calculo['cantidad']*$calculo['valor_unitario'],2,PHP_ROUND_HALF_UP);
    $total_igv = $total_igv + round($calculo['cantidad']*$calculo['valor_unitario']*$porcentaje,2,PHP_ROUND_HALF_UP);
    $total_venta = $total_venta + round($calculo['cantidad']*$calculo['valor_unitario']*(1+$porcentaje),2,PHP_ROUND_HALF_UP);
  }
  $total_operaciones_gravadas2 = $total_operaciones_gravadas - $total_descuentos;
  $total_igv2 = $total_igv - $total_descuentos*($porcentaje);
  $total_venta2 = $total_venta - $total_anticipos;
}
$subtotal_venta = round($total_operaciones_gravadas2*(1+$porcentaje),2,PHP_ROUND_HALF_UP);
//Calculamos igv

//VENTA Y VENTAS NO DOM. NO CALIFICA COMO EXPORT.
if ($comprobantes[0]['codigo_tipo_operacion']=='0101' or $comprobantes[0]['codigo_tipo_operacion']=='0401') {
	$total_valor = round($total_operaciones_gravadas,2,PHP_ROUND_HALF_UP);
	$total_pendiente_de_pago = round($total_venta2,2,PHP_ROUND_HALF_UP);
}
//EXPORTACION
elseif($comprobantes[0]['codigo_tipo_operacion']=='0200') {
	$total_valor=$total_exportacion;
	$total_pendiente_de_pago = round($total_venta2,2,PHP_ROUND_HALF_UP);
}
//OPERACION SUJETA A DETRACCION
elseif($comprobantes[0]['codigo_tipo_operacion']=='1001') {
	$total_valor = round($total_operaciones_gravadas,2,PHP_ROUND_HALF_UP);
	//Preguntamos si pasan los 700 soles.
	if ($codigo_tipo_moneda == "USD") {
		$soles = $total_venta2*$comprobantes[0]['venta'];
	} else {
		$soles = $total_venta2;
	}
	
	if ($soles>=700) {
		/*********************************************************MODIFICAR*******************************************************************************/
		$detraccion = round($soles*$pdetraccion,0,PHP_ROUND_HALF_UP);
    $total_pendiente_de_pago = $total_venta2-round($detraccion/$comprobantes[0]['venta'],2,PHP_ROUND_HALF_UP);
	}
	else{
		$total_pendiente_de_pago = round($total_venta2,2,PHP_ROUND_HALF_UP);
	}
}
$txt_descuentos='';
if (isset($_SESSION['carro_anticipo'])) {
  $txt_descuentos = '"descuentos": [{ "codigo" : "'.$codigo_descuento.'", "descripcion" : "'.$txt_codigo_descuento.'","factor": 1,"monto": '.$total_descuentos.', "base": '.$total_descuentos.' }],';
}
//total impuestos
$total_impuestos = $total_impuestos + $total_igv2;

//mostramos condicion de pago credito 02, contado 01
$codigo_condicion_de_pago = $_POST['condicion_de_pago'];
if ($codigo_condicion_de_pago=="01") {
	$total_pendiente_de_pago = 0;
}

//todo es 1 cuota si es credito segun metodo de pago
$cuotas="";
$anticipo=0;
$saldo_anticipo=0;
if ($codigo_condicion_de_pago=="02") {
	$cuota = "";
}

//mostramos forma de pago
$forma_de_pago = $_POST['forma_de_pago'];

//observaciones
$observaciones ="";
//vendedor defecto
$vendedor="";
//caja por defecto
$caja="";
//informacion adicional aqui va las OTs o la leyenda de Exportacion
$informacion_adicional = "";
if ($comprobantes[0]['codigo_tipo_operacion']=='0200') {
  if (isset($ots)) {
    $informacion_adicional = "1) INCO TERMS: EX WORK 2) NOS ACOGEMOS AL RÉGIMEN DE RESTITUCIÓN DE DER. ARANCELARIOS DS.104-95-EF (COD.13) 3) ".$ocs;
  }
  else{
    $informacion_adicional = "1) INCO TERMS: EX WORK 2) NOS ACOGEMOS AL RÉGIMEN DE RESTITUCIÓN DE DER. ARANCELARIOS DS.104-95-EF (COD.13)";
  }

  $ocs = $ots;
	
} else {
	$informacion_adicional = $ots;
}

//leyenda codigo y contenido
$leyendas_valor = "";

//echo $total_valor;

//insertamos toda la info en la base de datos
//echo "<br>".$fecha_vencimiento."<br>";
$objComprobantes->update(
  $fecha_vencimiento,
  $codigo_tipo_moneda,
  $ocs,
  $total_exportacion,
  $total_operaciones_gravadas2,
  $total_operaciones_inafectas,
  $total_operaciones_exoneradas,
  $total_operaciones_gratuitas,
  $total_igv_operaciones_gratuitas,
  $total_impuestos_bolsa_plastica,
  $total_igv2,
  $total_impuestos,
  $total_valor,
  $total_venta2,
  $total_pendiente_de_pago,
  $codigo_condicion_de_pago,
  $anticipo,
  $saldo_anticipo,
  $forma_de_pago,
  $observaciones,
  $vendedor,
  $caja,
  $informacion_adicional,
  $leyendas_valor,
  $idcomprobantes);

//insertamos en la tabla alterna los valores de todas las facturas.****************************************************************************

//Enviar sin confirmar en Sunat

$json = "";
//modificar campos en tabla de comprobantes
//require('class/comprobantes.php');
$objComprobantes = new Comprobantes();
$comprobante = $objComprobantes->comprobantePorId2($comprobantes[0]['idcomprobantes']);
/*
echo "<pre>";
print_r($comprobante);
echo "</pre>";
*/
$texto='"items":[';
$texto_item = '';

//si tipo de documento es exportacion
if ($comprobante[0]['codigo_tipo_operacion']=='0200') {
  $codigo_tipo_afectacion_igv=40;
  foreach ($comprobante as $item) {
    //si es exportacion
    $total_base_igv=round($item["cantidad"]*$item['valor_unitario'],2,PHP_ROUND_HALF_UP);
    $total_igv = 0;
    $total_impuestos = 0;
    $total_item = $total_base_igv;
 
    $texto_item.="
    {
      'codigo_interno': '".$item['codigo_interno']."',
      'descripcion':'".$item['descripcion']."',
      
      'unidad_de_medida': '".$item['um']."',
      'cantidad': ".$item['cantidad'].",
      'valor_unitario': ".$item['valor_unitario'].",
      'codigo_tipo_precio': '01',
      'precio_unitario': ".$item['valor_unitario'].",
      'codigo_tipo_afectacion_igv': '".$codigo_tipo_afectacion_igv."',
      'total_base_igv': ".$total_base_igv.",
      'porcentaje_igv': ".round($porcentaje*100,0).",
      'total_igv': ".number_format($total_igv,2,'.','').",
      'total_impuestos': ".number_format($total_impuestos,2,'.','').",
      'total_valor_item': ".number_format($total_base_igv,2,'.','').",
      'total_item': ".number_format($total_item,2,'.','')."
    },";
  }
}
$servicio="";
//si tipo de documento es servicio
if ($comprobante[0]['codigo_tipo_operacion']=='1001') {
  $codigo_tipo_afectacion_igv=10;
  foreach ($comprobante as $item) {
    $total_base_igv=round($item["cantidad"]*$item['valor_unitario'],2,PHP_ROUND_HALF_UP);
    $total_igv = round($total_base_igv*$porcentaje,2,PHP_ROUND_HALF_UP);
    $total_impuestos = $total_igv;
    $total_item = $total_base_igv+$total_igv;
    
    $texto_item.="
    {
      'codigo_interno': '".$item['codigo_interno']."',
      'descripcion':'".$item['descripcion']."',
      
      'unidad_de_medida': '".$item['um']."',
      'cantidad': ".$item['cantidad'].",
      'valor_unitario': ".$item['valor_unitario'].",
      'codigo_tipo_precio': '01',
      'precio_unitario': ".number_format(round($item['valor_unitario']*(1+$porcentaje),2,PHP_ROUND_HALF_UP),2,'.','').",
      'codigo_tipo_afectacion_igv': '".$codigo_tipo_afectacion_igv."',
      'total_base_igv': ".$total_base_igv.",
      'porcentaje_igv': ".round($porcentaje*100,0).",
      'total_igv': ".number_format($total_igv,2,'.','').",
      'total_impuestos': ".number_format($total_impuestos,2,'.','').",
      'total_valor_item': ".number_format($total_base_igv,2,'.','').",
      'total_item': ".number_format($total_item,2,'.','')."
    },";
  }
  if ($comprobante[0]['codigo_tipo_moneda']=="USD") {
    $servicio='
      "leyendas":[
          {
              "codigo":"2006",
              "valor":"Operación sujeta a detracción"
          }
      ],
      "detraccion": {
          "codigo_tipo_detraccion": "025",
          "porcentaje": '.number_format($pdetraccion*100,2,".",",").',
          "monto": '.round($comprobante[0]['total_venta']*$comprobante[0]['venta']*$pdetraccion,0,PHP_ROUND_HALF_UP).',
          "codigo_metodo_pago": "001",
          "cuenta_bancaria": "212-165471578"
      },
    ';  
  }
  else {
    $servicio='
      "leyendas":[
          {
              "codigo":"2006",
              "valor":"Operación sujeta a detracción"
          }
      ],
      "detraccion": {
          "codigo_tipo_detraccion": "025",
          "porcentaje": '.number_format($pdetraccion*100,2,".",",").',
          "monto": '.round($comprobante[0]['total_venta']*$pdetraccion,0,PHP_ROUND_HALF_UP).',
          "codigo_metodo_pago": "001",
          "cuenta_bancaria": "212-165471578"
      },
    ';
  }
}
//si tipo de documento es venta
if ($comprobante[0]['codigo_tipo_operacion']=='0101' or $comprobante[0]['codigo_tipo_operacion']=='0401') {
  $codigo_tipo_afectacion_igv=10;
  foreach ($comprobante as $item) {
    $total_base_igv=round($item["cantidad"]*$item['valor_unitario'],2,PHP_ROUND_HALF_UP);
    $total_igv = round($total_base_igv*$porcentaje,2,PHP_ROUND_HALF_UP);
    $total_impuestos = $total_igv;
    $total_item = $total_base_igv+$total_igv;
    
    $texto_item.="
    {
      'codigo_interno': '".$item['codigo_interno']."',
      'descripcion':'".$item['descripcion']."',
      
      'unidad_de_medida': '".$item['um']."',
      'cantidad': ".$item['cantidad'].",
      'valor_unitario': ".$item['valor_unitario'].",
      'codigo_tipo_precio': '01',
      
      'precio_unitario': ".number_format(round($item['valor_unitario']*(1+$porcentaje),2,PHP_ROUND_HALF_UP),2,'.','').",
      'codigo_tipo_afectacion_igv': '".$codigo_tipo_afectacion_igv."',
      'total_base_igv': ".$total_base_igv.",
      'porcentaje_igv': ".round($porcentaje*100,0).",
      'total_igv': ".number_format($total_igv,2,'.','').",
      'total_impuestos': ".number_format($total_impuestos,2,'.','').",
      'total_valor_item': ".number_format($total_base_igv,2,'.','').",
      'total_item': ".number_format($total_item,2,'.','')."
    },";
  }
}

/**************************/

$texto.=$texto_item;
$cuotas = "";
if ($comprobante[0]['codigo_condicion_de_pago']=="02") {
  $cuotas ='
  "codigo_condicion_de_pago": "02",
    "cuotas": [
        {
            "fecha": "'.$comprobante[0]["fecha_de_vencimiento"].'",
            "codigo_tipo_moneda": "'.$comprobante[0]["codigo_tipo_moneda"].'",
            "monto": '.$comprobante[0]["total_pendiente_de_pago"].',
            "codigo_metodo_pago": "'.$comprobante[0]["forma_de_pago"].'"
        }
    ],
  ';
}
elseif($comprobante[0]['codigo_condicion_de_pago']=="01"){
  $cuotas ='
  "codigo_condicion_de_pago": "01",
    "pagos":[
      {
        "codigo_metodo_pago":"10",
        "codigo_destino_pago":"10",
        "referencia":"-",
        "monto": "'.$comprobante[0]["total_venta"].'"
      }

    ],
  ';
}

$acciones="";
$acciones='
"acciones": {
    "enviar_xml_firmado": false
  },
';

$json='{
  "serie_documento": "'.$comprobante[0]["serie_documento"].'",
  "numero_documento": "'.$comprobante[0]["numero_documento"].'",
  "fecha_de_emision": "'.$comprobante[0]["fecha_de_emision"].'",
  "hora_de_emision": "'.$comprobante[0]["hora_de_emision"].'",
  "codigo_tipo_operacion": "'.$comprobante[0]["codigo_tipo_operacion"].'",
  "codigo_tipo_documento":"'.$comprobante[0]["codigo_tipo_documento"].'",
  "codigo_tipo_moneda": "'.$comprobante[0]["codigo_tipo_moneda"].'",
  "factor_tipo_de_cambio":"'.$comprobante[0]["venta"].'",
  "fecha_de_vencimiento":"'.$comprobante[0]["fecha_de_vencimiento"].'",
  "numero_orden_de_compra": "'.$comprobante[0]["numero_orden_de_compra"].'", 
  "datos_del_cliente_o_receptor":{
    "codigo_tipo_documento_identidad": "'.$comprobante[0]["tipo_documento"].'",
    "numero_documento": "'.$comprobante[0]["ruc_dni"].'",
    "apellidos_y_nombres_o_razon_social": "'.$comprobante[0]["razon_social_nombres"].'",
    "codigo_pais": "'.$comprobante[0]["codigo_pais"].'",
    "ubigeo": "'.$comprobante[0]["ubigeo"].'",
    "direccion": "'.$comprobante[0]["direccion_fiscal"].'"
    
  },
  '.$servicio.' 
  '.$cuotas.'
  '.$guiasF.'
  "totales": {
    "total_anticipos": '.number_format($total_anticipos,2,".","").',
    "total_descuentos": '.number_format($total_descuentos,2,".","").',
    "total_exportacion": '.number_format($comprobante[0]["total_exportacion"],2,".","").',
    "total_operaciones_gravadas": '.number_format($comprobante[0]["total_operaciones_gravadas"],2,".","").',
    "total_operaciones_inafectas": '.number_format($comprobante[0]["total_operaciones_inafectas"],2,".","").',
    "total_operaciones_exoneradas": '.number_format($comprobante[0]["total_operaciones_exoneradas"],2,".","").',
    "total_operaciones_gratuitas": '.number_format($comprobante[0]["total_operaciones_gratuitas"],2,".","").',
    "total_igv": '.number_format($comprobante[0]["total_igv"],2,".","").',
    "total_impuestos": '.number_format($comprobante[0]["total_impuestos"],2,".","").',
    "total_valor": '.number_format($comprobante[0]["total_valor"],2,".","").',
    "subtotal_venta": '.number_format(round($comprobante[0]["total_valor"]*(1+$porcentaje),2,PHP_ROUND_HALF_UP),2,".","").',
    "total_venta": '.number_format($comprobante[0]["total_venta"],2,".","").'
  },
  '.$txt_anticipoF.'
  '.$txt_descuentos.'

  '.substr($texto, 0,-1).'
  ],
  '.$acciones.'
  "informacion_adicional": "'.$comprobante[0]["informacion_adicional"].'"
  
}';
/*
echo "<pre>";
echo $json;
echo "</pre>";
*/
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

<script type="text/javascript">
  var settings = {
  "url": "<?=$_SESSION['url']?>/api/documents",
  "method": "POST",
  "timeout": 0,
  "headers": {
    "Authorization": "Bearer <?=$_SESSION['token']?>",
    "Content-Type": "application/json"
  },
  "data": JSON.stringify(<?=$json?>),
};

$.ajax(settings).done(function (response) {
  //console.log(response);
  $(".respuesta").html("<pre>"+JSON.stringify(response, null, 2)+"</pre>");
  var paramJson = JSON.stringify(response, null, 2);
  var obj1 = jQuery.parseJSON(paramJson);
  //var obj2 = jQuery.parseJSON(obj1.data);
  window.location.href = window.location.href + "?success=" + obj1.success + "&external_id=" + obj1.data['external_id'] + "&state_type_id=" + obj1.data['state_type_id'] + "&number=" + obj1.data['number'];

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

    $objComprobantes->add_external_id($phpVar2,$doc[0],$doc[1]);
    $objComprobantes->estado_respuesta($phpVar3,$doc[0],$doc[1]);
    //guardar anticipos y cambiar saldos
    if (isset($_SESSION['carro_anticipo'])) {
      foreach ($_SESSION['carro_anticipo'] as $val) {
        $objComprobantes->add_anticipo($_SESSION['idcomprobantes'],$val['idcomprobantes'],$val['usar']);
        $objComprobantes->actualizar_anticipo($val['nuevo_saldo'],$val['idcomprobantes']);
      }
    }
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