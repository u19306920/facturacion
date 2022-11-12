<?php
require('../class/guia_remision.php');
require('../class/clientes.php');
require('../class/items.php');
require('../class/ordenes_detalles.php');

require('../../../vendors/fpdf/fpdf.php');
require('cell.php');

$objGuia = new Guia();
$guia = $objGuia->guiaPorId($_GET['id']);

$objCliente = new Entidades();
$cliente = $objCliente->entidadPorId($guia[0]['identidades']);

//actualizamos el estado a impreso
$estado = $_GET['e'];
$cambio = $objGuia->cambiar($estado,$_GET['id']);

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();

//Asignamos variable borde
$borde=0;
$negrita='';
$fuente="RedHatText-Regular";

$pdf->AddFont('RedHatText-Regular','','RedHatText-Regular.php');

$y='-4';

//Si es Borrador
if($guia[0]['estado']==0){
	$pdf->Image('images/borrador.png',100,200,80);
}


//Agregamos las Fechas
$date = date_create($guia[0]['fecha_emision']);
$date = date_format($date,"d-m-Y");

$pdf->SetFont($fuente,$negrita,10);
$pdf->SetXY(20,$y+51);
$pdf->Cell(25,4,utf8_decode($date),$borde);

//$pdf->SetXY(95,$y+54);
//$pdf->Cell(25,4,utf8_decode($guia[0]['fecha_traslado']),$borde);

//numero de guia
$pdf->SetFont($fuente,$negrita,10);
//$pdf->SetXY(150,$y+45);
//$pdf->Cell(28,4,utf8_decode($guia[0]['guia_remision']),$borde);

//Punto de Partida
$pdf->SetFont($fuente,$negrita,10);
$pdf->SetXY(20,$y+59);
$pdf->Cell(85,4,utf8_decode('Av. Guillermo Dansey 1511 - Lima - Lima - Lima'),$borde);

//Datos de Cliente
$pdf->SetFont($fuente,$negrita,10);
//Razon Social
$pdf->SetXY(20,$y+67);
$pdf->Cell(92,4,utf8_decode($cliente[0]['razon_social_nombres']),$borde);
//RUC
$pdf->SetXY(20,$y+72);
$pdf->Cell(40,4,utf8_decode($cliente[0]['ruc_dni']),$borde);

$pdf->SetFont($fuente,$negrita,9);
//Direccion Fiscal
//$pdf->SetXY(20,$y+78);
//$pdf->Cell(93,4,ucwords(substr(strtolower(utf8_decode($cliente[0]['direccion_fiscal'])),0,90)),$borde);

//Punto de Llegada
$pdf->SetXY(20,$y+78);
//$pdf->Cell(85,4,ucwords(substr(strtolower(utf8_decode($guia[0]['destino'])),0,90)),$borde);
$pdf->MultiCell(108,4,ucwords(substr(strtolower(utf8_decode($guia[0]['destino'])),0,90)),'','L',$borde);

//Ordenes de Compra
$pdf->SetFont($fuente,$negrita,10);
$pdf->SetXY(20,$y+88);
$pdf->Cell(30,4,utf8_decode($guia[0]['ocs']),$borde);


//Datos Transportista
$pdf->SetFont($fuente,$negrita,10);
//Razon Social
$pdf->SetXY(130,$y+62);
$pdf->Cell(64,4,utf8_decode($guia[0]['razon_social']),$borde);
//Ruc transportista
$pdf->SetXY(130,$y+67.5);
$pdf->Cell(35,4,utf8_decode($guia[0]['ruc']),$borde);
//Domicilio Fiscal Transportista
$pdf->SetFont($fuente,$negrita,9);
$pdf->SetXY(130,$y+73.5);
//$pdf->Cell(61,4,ucwords(substr(strtolower(utf8_decode($guia[0]['direccion'])),0,40)),$borde);
$pdf->MultiCell(60,4,ucwords(substr(strtolower(utf8_decode($guia[0]['destino'])),0,90)),'','L',$borde);



//Datos de Transporte y Conductor
$pdf->SetFont($fuente,$negrita,9);
//Vehiculo Marca y Placa
$pdf->SetXY(130,$y+89);
$pdf->Cell(42,4,utf8_decode($guia[0]['marca'].' '.$guia[0]['placa']),$borde);
//Certificado de Inscripcion
$pdf->SetXY(130,$y+94.5);
$pdf->Cell(36,4,utf8_decode($guia[0]['inscripcion']),$borde);
//Licencia de Conducir
$pdf->SetXY(130,$y+100);
$pdf->Cell(36,4,utf8_decode($guia[0]['licencia'].' '.$guia[0]['nombres']),$borde);

//Datos de Comprobante
$pdf->SetFont($fuente,$negrita,10);

//Tipo de Comprobante
if($guia[0]['tipo_documento']=="01"){
	$pdf->SetXY(20,$y+94);
	$pdf->Cell(61,4,utf8_decode('FACTURA ELECTRONICA'),$borde);
}
elseif($guia[0]['tipo_documento']=="03"){
	$pdf->SetXY(20,$y+94);
	$pdf->Cell(61,4,utf8_decode('BOLETA ELECTRONICA'),$borde);
}
else{
	$pdf->SetXY(20,$y+94);
	$pdf->Cell(61,4,utf8_decode('-'),$borde);
}

//Numero de Comprobante
$pdf->SetXY(20,$y+98);
$pdf->Cell(61,4,utf8_decode($guia[0]['numero_documento']),$borde);
//Fecha Comprobante
$pdf->SetXY(60,$y+98);
$date_doc = date_create($guia[0]['fecha_documento']);
$date_doc = date_format($date_doc,"d-m-Y");
$pdf->Cell(61,4,utf8_decode($date_doc),$borde);


//Cargamos los Items consultando a la Base de Datos
$ots=array();
$ocs="";

$Items = $objGuia->guiadetallePorIdguia($guia[0]['idguias']);
$altura=5;
foreach ($Items as $key) {

	//Items en la Guia
	$pdf->SetFont($fuente,$negrita,10);
	//Cantidad
	$pdf->SetXY(20,$y+125+$altura);
	$pdf->Cell(8,4,utf8_decode(number_format($key['cantidad'])),$borde,0,'R');

	$objI = new Items();
	$Is = $objI->itemPorId($key['iditems']);

	//Unidad de Medida
	$pdf->SetXY(30,$y+125+$altura);
	$pdf->Cell(8,4,utf8_decode($Is[0]['um']),$borde,0,'C');
	//Descripcion de Item
	$pdf->SetXY(40,$y+125+$altura);
	//$pdf->Cell(125,4,utf8_decode($Is[0]['name']),$borde,0,'L');
	$pdf->MultiCell(135,4,utf8_decode($Is[0]['descripcion']),$borde,'L',0);
	$altura=$altura+5;
	array_push($ots,$key['orden']);
}
//Observacion
$pdf->SetFont($fuente,$negrita,11);
$pdf->SetXY(100,$y+249);
//$pdf->Cell(55,4,utf8_decode($guia[0]['ots']),$borde,0,'L');
$pdf->Cell(55,4,utf8_decode($guia[0]['observacion']),$borde,0,'L');

//Ots
$ot = array_unique($ots);
$resultado="";
foreach ($ot as $key2) {
	$resultado.=$key2." / ";
}
//Ots
$pdf->SetFont($fuente,$negrita,10);
$pdf->SetXY(100,$y+259);
//$pdf->Cell(55,4,utf8_decode($guia[0]['ots']),$borde,0,'L');
$pdf->Cell(55,4,substr(utf8_decode($resultado),0,-3),$borde,0,'L');


$pdf->Output('I','GR'.$guia[0]['guia'].'.pdf',1);
?>
