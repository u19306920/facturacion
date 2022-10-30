<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

if (!isset($_GET['succes']) and isset($_GET['id'])) {
require('class/comprobantes_detalles2.php');
//Enviar sin confirmar en Sunat
$idcomprobantes = $_GET['id'];
$porcentaje = 0.18;
$pdetraccion = 0.10;

$json = "";
//modificar campos en tabla de comprobantes
//require('class/comprobantes.php');
$objComprobantes = new Comprobantes_detalles();
$comprobante = $objComprobantes->comprobantes_detallePorIdComprobante($idcomprobantes);
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
 
    $texto_item.='
    {
      "codigo_interno": "",
      "descripcion":"'.$item["descripcion"].'",
      
      "unidad_de_medida": "'.$item["um"].'",
      "cantidad": '.$item["cantidad"].',
      "valor_unitario": '.$item["valor_unitario"].',
      "codigo_tipo_precio": "01",
      "precio_unitario": '.$item["valor_unitario"].',
      "codigo_tipo_afectacion_igv": "'.$codigo_tipo_afectacion_igv.'",
      "total_base_igv": '.$total_base_igv.',
      "porcentaje_igv": '.round($porcentaje*100,0).',
      "total_igv": '.number_format($total_igv,2,".","").',
      "total_impuestos": '.number_format($total_impuestos,2,".","").',
      "total_valor_item": '.number_format($total_base_igv,2,".","").',
      "total_item": '.number_format($total_item,2,".","").'
    },';
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
    
    $texto_item.='
    {
      "codigo_interno": "",
      "descripcion":"'.$item["descripcion"].'",
      
      "unidad_de_medida": "'.$item["um"].'",
      "cantidad": '.$item["cantidad"].',
      "valor_unitario": '.$item["valor_unitario"].',
      "codigo_tipo_precio": "01",
      "precio_unitario": '.number_format(round($item["valor_unitario"]*(1+$porcentaje),2,PHP_ROUND_HALF_UP),2,".","").',
      "codigo_tipo_afectacion_igv": "'.$codigo_tipo_afectacion_igv.'",
      "total_base_igv": '.$total_base_igv.',
      "porcentaje_igv": '.round($porcentaje*100,0).',
      "total_igv": '.number_format($total_igv,2,".","").',
      "total_impuestos": '.number_format($total_impuestos,2,".","").',
      "total_valor_item": '.number_format($total_base_igv,2,".","").',
      "total_item": '.number_format($total_item,2,".","").'
    },';
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
    
    $texto_item.='
    {
      "codigo_interno": "",
      "descripcion":"'.$item["descripcion"].'",
      
      "unidad_de_medida": "'.$item["um"].'",
      "cantidad": '.$item["cantidad"].',
      "valor_unitario": '.$item["valor_unitario"].',
      "codigo_tipo_precio": "01",
      "precio_unitario": '.number_format(round($item["valor_unitario"]*(1+$porcentaje),2,PHP_ROUND_HALF_UP),2,".","").',
      "codigo_tipo_afectacion_igv": "'.$codigo_tipo_afectacion_igv.'",
      "total_base_igv": '.$total_base_igv.',
      "porcentaje_igv": '.round($porcentaje*100,0).',
      "total_igv": '.number_format($total_igv,2,".","").',
      "total_impuestos": '.number_format($total_impuestos,2,".","").',
      "total_valor_item": '.number_format($total_base_igv,2,".","").',
      "total_item": '.number_format($total_item,2,".","").'
    },';
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
  "totales": {
    "total_exportacion": '.number_format($comprobante[0]["total_exportacion"],2,".","").',
    "total_operaciones_gravadas": '.number_format($comprobante[0]["total_operaciones_gravadas"],2,".","").',
    "total_operaciones_inafectas": '.number_format($comprobante[0]["total_operaciones_inafectas"],2,".","").',
    "total_operaciones_exoneradas": '.number_format($comprobante[0]["total_operaciones_exoneradas"],2,".","").',
    "total_operaciones_gratuitas": '.number_format($comprobante[0]["total_operaciones_gratuitas"],2,".","").',
    "total_igv": '.number_format($comprobante[0]["total_igv"],2,".","").',
    "total_impuestos": '.number_format($comprobante[0]["total_impuestos"],2,".","").',
    "total_valor": '.number_format($comprobante[0]["total_valor"],2,".","").',
    "total_venta": '.number_format($comprobante[0]["total_venta"],2,".","").'
  },


  '.substr($texto, 0,-1).'
  ],
  '.$acciones.'
  "informacion_adicional": "'.$comprobante[0]["informacion_adicional"].'",
  
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
	  
	  window.location.href = window.location.href + "&success=" + obj1.success + "&external_id=" + obj1.data['external_id'] + "&state_type_id=" + obj1.data['state_type_id'] + "&number=" + obj1.data['number'];

	});
	</script>
	</body>
	</html>
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
    // mostrar
	/*
    echo "<p>" . $phpVar1 . "</p>";
    echo "<p>" . $phpVar2 . "</p>";
    echo "<p>" . $phpVar3 . "</p>";
	*/
	header('Location: ' . "../../index.php?module=ventas&page=comprobantes");
}
?>