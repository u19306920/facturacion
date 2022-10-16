<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/conexion.php');
//echo $_SERVER['DOCUMENT_ROOT'];

class Comprobantes extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // LISTADO DE COMPROBANTES
    //*****************************************************************
    public function comprobantes(){
        $resultado = $this->mysqli->query("
            SELECT
            comprobantes.idcomprobantes,
            comprobantes.serie_documento,
            comprobantes.numero_documento,
            comprobantes.comprobante,
            comprobantes.fecha_de_emision,
            comprobantes.hora_de_emision,
            comprobantes.codigo_tipo_operacion,
            comprobantes.codigo_tipo_documento,
            comprobantes.codigo_tipo_moneda,
            comprobantes.fecha_de_vencimiento,
            comprobantes.numero_orden_de_compra,
            comprobantes.idtipo_cambio,
            comprobantes.identidades,
            comprobantes.total_exportacion,
            comprobantes.total_operaciones_gravadas,
            comprobantes.total_operaciones_inafectas,
            comprobantes.total_operaciones_exoneradas,
            comprobantes.total_operaciones_gratuitas,
            comprobantes.total_igv_operaciones_gratuitas,
            comprobantes.total_impuestos_bolsa_plastica,
            comprobantes.total_igv,
            comprobantes.total_impuestos,
            comprobantes.total_valor,
            comprobantes.total_venta,
            comprobantes.total_pendiente_de_pago,
            comprobantes.codigo_condicion_de_pago,
            comprobantes.anticipo,
            comprobantes.saldo_anticipo,
            comprobantes.forma_de_pago,
            comprobantes.observaciones,
            comprobantes.vendedor,
            comprobantes.caja,
            comprobantes.informacion_adicional,
            comprobantes.leyendas_valor,
            comprobantes.estado,

            entidades.razon_social_nombres,
            tipo_cambio.venta

            FROM comprobantes
            INNER JOIN entidades ON entidades.identidades = comprobantes.identidades
            INNER JOIN tipo_cambio ON tipo_cambio.idtipo_cambio = comprobantes.idtipo_cambio
            ORDER BY comprobantes.creado DESC");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
    // LISTADO DE COMPROBANTES AJAX
    //*****************************************************************
    public function comprobantesajax(){
        $resultado = $this->mysqli->query("
            SELECT comprobantes.idcomprobantes, comprobantes.comprobante
            FROM comprobantes 
            WHERE comprobantes.comprobante '%".$_GET['q']."%' AND comprobantes.estado='1'
            ORDER BY comprobantes.orden;");

        $json = [];
        while($row = $resultado->fetch_assoc()){
             $json[] = ['id'=>$row['idcomprobantes'], 'text'=>$row['comprobante']];
        }
        echo json_encode($json);
    }

    //*****************************************************************
    // AGREGAR COMPROBANTE BORRADOR
    //*****************************************************************
    public function add($v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9) {

        $consulta = sprintf(
            "INSERT INTO comprobantes values(null, %s, %s, %s, %s, %s, null, %s, %s, null, null, %s, %s,'0','0','0','0','0','0','0','0','0','0','0','0', null, null, null, null, null, null, null, null, null, now(), null,'0');",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3),
            parent::comillas_inteligentes($v4),
            parent::comillas_inteligentes($v5),
            parent::comillas_inteligentes($v6),
            parent::comillas_inteligentes($v7),
            parent::comillas_inteligentes($v8),
            parent::comillas_inteligentes($v9)
            );
        $this->mysqli->query($consulta);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    //*****************************************************************
    // INSERTAR ANTICIPO Y REFERENCIA
    //*****************************************************************
    public function add_anticipo($v1,$v2,$v3) {

        $consulta = sprintf(
            "INSERT INTO anticipos_aplicados values(null, %s, %s, %s);",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3)
            );
        $this->mysqli->query($consulta);
        //header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    //*****************************************************************
    // ACTUALIZAR VALOR DE ANTICIPO
    //*****************************************************************
    public function actualizar_anticipo($v1,$v2) {

        $consulta = sprintf(
            "UPDATE comprobantes SET
            comprobantes.saldo_anticipo = %s,
            comprobantes.actualizado = now()
            WHERE
            comprobantes.idcomprobantes = %s;",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2)
            );

        $this->mysqli->query($consulta);
        //header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    //*****************************************************************
    // MODIFICAR BORRADOR A EMISION
    //*****************************************************************
    public function update(
        $fecha_vencimiento,
        $codigo_tipo_moneda,
        $ocs,
        $total_exportacion,
        $total_operaciones_gravadas,
        $total_operaciones_inafectas,
        $total_operaciones_exoneradas,
        $total_operaciones_gratuitas,
        $total_igv_operaciones_gratuitas,
        $total_impuestos_bolsa_plastica,
        $total_igv,
        $total_impuestos,
        $total_valor,
        $total_venta,
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
        $idcomprobantes) {

        $consulta = sprintf(
            "UPDATE comprobantes SET
            fecha_de_vencimiento = %s,
            codigo_tipo_moneda = %s,
            numero_orden_de_compra = %s,
            total_exportacion = %s,
            total_operaciones_gravadas = %s,
            total_operaciones_inafectas = %s,
            total_operaciones_exoneradas = %s,
            total_operaciones_gratuitas = %s,
            total_igv_operaciones_gratuitas = %s,
            total_impuestos_bolsa_plastica = %s,
            total_igv = %s,
            total_impuestos = %s,
            total_valor = %s,
            total_venta = %s,
            total_pendiente_de_pago = %s,
            codigo_condicion_de_pago = %s,
            anticipo = %s,
            saldo_anticipo = %s,
            forma_de_pago = %s,
            observaciones = %s,
            vendedor = %s,
            caja = %s,
            informacion_adicional = %s,
            leyendas_valor = %s,
            actualizado = now(),
            estado = '02'

            WHERE
            idcomprobantes = %s;",
            parent::comillas_inteligentes($fecha_vencimiento),
            parent::comillas_inteligentes($codigo_tipo_moneda),
            parent::comillas_inteligentes($ocs),
            parent::comillas_inteligentes($total_exportacion),
            parent::comillas_inteligentes($total_operaciones_gravadas),
            parent::comillas_inteligentes($total_operaciones_inafectas),
            parent::comillas_inteligentes($total_operaciones_exoneradas),
            parent::comillas_inteligentes($total_operaciones_gratuitas),
            parent::comillas_inteligentes($total_igv_operaciones_gratuitas),
            parent::comillas_inteligentes($total_impuestos_bolsa_plastica),
            parent::comillas_inteligentes($total_igv),
            parent::comillas_inteligentes($total_impuestos),
            parent::comillas_inteligentes($total_valor),
            parent::comillas_inteligentes($total_venta),
            parent::comillas_inteligentes($total_pendiente_de_pago),
            parent::comillas_inteligentes($codigo_condicion_de_pago),
            parent::comillas_inteligentes($anticipo),
            parent::comillas_inteligentes($saldo_anticipo),
            parent::comillas_inteligentes($forma_de_pago),
            parent::comillas_inteligentes($observaciones),
            parent::comillas_inteligentes($vendedor),
            parent::comillas_inteligentes($caja),
            parent::comillas_inteligentes($informacion_adicional),
            parent::comillas_inteligentes($leyendas_valor),
            parent::comillas_inteligentes($idcomprobantes)
            );

        $this->mysqli->query($consulta);

        //header('Location: ' . "../../index.php?module=ventas&page=comprobantes");
    }

    //*****************************************************************
    // ELIMINAR COMPROBANTE
    //*****************************************************************
    public function delete($id) {
        $query = sprintf(
            "DELETE FROM comprobantes WHERE idcomprobantes = %s;",
            parent::comillas_inteligentes($id)
            );
        $this->mysqli->query($query);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // CAMBIAR ESTADO COMPROBANTE
    //*****************************************************************
    public function cambiar($estado,$id) {

        $consulta = sprintf(
            "UPDATE comprobantes SET
            comprobantes.estado = %s,
            comprobantes.actualizado = now()
            WHERE
            comprobantes.idcomprobantes = %s;",
            parent::comillas_inteligentes($estado),
            parent::comillas_inteligentes($id)
            );

        $this->mysqli->query($consulta);

        //header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // ACTUALIZAR COMPROBANTE SEPARADO
    //*****************************************************************
    public function actualizar($v1,$v2,$v3,$v4,$v5,$v6) {

        $consulta = sprintf(
            "UPDATE comprobantes SET
            comprobantes.identidades = %s,
            comprobantes.fecha_de_emision = %s,
            comprobantes.hora_de_emision = %s,
            comprobantes.codigo_tipo_operacion = %s,
            comprobantes.idtipo_cambio = %s,
            comprobantes.actualizado = now()
            WHERE
            comprobantes.idcomprobantes = %s;",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3),
            parent::comillas_inteligentes($v4),
            parent::comillas_inteligentes($v5),
            parent::comillas_inteligentes($v6)
            );

        $this->mysqli->query($consulta);

        header('Location: ../../index.php?module=ventas&page=comprobantes');
    }
    //*****************************************************************
    // CONTAR ITEMS DE UN COMPROBANTE
    //*****************************************************************
    public function contar_items($id) {

        $consulta = sprintf("SELECT
            COUNT(idcomprobantes_detalles) AS nitems
            FROM comprobantes_detalles
            WHERE comprobantes_detalles.idcomprobantes = %s;",
            parent::comillas_inteligentes($id)
            );

        $resultado = $this->mysqli->query($consulta);

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
    //*****************************************************************
    // COMPROBANTE POR ID
    //*****************************************************************
    public function comprobantePorId($id){
        $consulta = sprintf("SELECT
            comprobantes.idcomprobantes,
            comprobantes.serie_documento,
            comprobantes.numero_documento,
            comprobantes.comprobante,
            comprobantes.fecha_de_emision,
            comprobantes.hora_de_emision,
            comprobantes.codigo_tipo_operacion,
            comprobantes.codigo_tipo_documento,
            comprobantes.codigo_tipo_moneda,
            comprobantes.fecha_de_vencimiento,
            comprobantes.numero_orden_de_compra,
            comprobantes.idtipo_cambio,
            comprobantes.identidades,
            comprobantes.total_exportacion,
            comprobantes.total_operaciones_gravadas,
            comprobantes.total_operaciones_inafectas,
            comprobantes.total_operaciones_exoneradas,
            comprobantes.total_operaciones_gratuitas,
            comprobantes.total_igv_operaciones_gratuitas,
            comprobantes.total_impuestos_bolsa_plastica,
            comprobantes.total_igv,
            comprobantes.total_impuestos,
            comprobantes.total_valor,
            comprobantes.total_venta,
            comprobantes.total_pendiente_de_pago,
            comprobantes.codigo_condicion_de_pago,
            comprobantes.anticipo,
            comprobantes.saldo_anticipo,
            comprobantes.forma_de_pago,
            comprobantes.observaciones,
            comprobantes.vendedor,
            comprobantes.caja,
            comprobantes.informacion_adicional,
            comprobantes.leyendas_valor,
            comprobantes.estado,

            entidades.razon_social_nombres,
            entidades.direccion_fiscal,
            entidades.ruc_dni,
            tipo_cambio.venta

            FROM comprobantes
            INNER JOIN entidades ON entidades.identidades = comprobantes.identidades
            INNER JOIN tipo_cambio ON tipo_cambio.idtipo_cambio = comprobantes.idtipo_cambio

            WHERE
            comprobantes.idcomprobantes = %s
            ORDER BY comprobantes.fecha_de_emision DESC, comprobantes.comprobante DESC",
            parent::comillas_inteligentes($id)
            );

        $resultado = $this->mysqli->query($consulta);

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }

    //*****************************************************************
    // COMPROBANTE POR ID
    //*****************************************************************
    public function comprobantePorId2($id){
        $consulta = sprintf("SELECT
            comprobantes.idcomprobantes,
            comprobantes.serie_documento,
            comprobantes.numero_documento,
            comprobantes.comprobante,
            comprobantes.fecha_de_emision,
            comprobantes.hora_de_emision,
            comprobantes.codigo_tipo_operacion,
            comprobantes.codigo_tipo_documento,
            comprobantes.codigo_tipo_moneda,
            comprobantes.fecha_de_vencimiento,
            comprobantes.numero_orden_de_compra,
            comprobantes.idtipo_cambio,
            comprobantes.identidades,
            comprobantes.total_exportacion,
            comprobantes.total_operaciones_gravadas,
            comprobantes.total_operaciones_inafectas,
            comprobantes.total_operaciones_exoneradas,
            comprobantes.total_operaciones_gratuitas,
            comprobantes.total_igv_operaciones_gratuitas,
            comprobantes.total_impuestos_bolsa_plastica,
            comprobantes.total_igv,
            comprobantes.total_impuestos,
            comprobantes.total_valor,
            comprobantes.total_venta,
            comprobantes.total_pendiente_de_pago,
            comprobantes.codigo_condicion_de_pago,
            comprobantes.anticipo,
            comprobantes.saldo_anticipo,
            comprobantes.forma_de_pago,
            comprobantes.observaciones,
            comprobantes.vendedor,
            comprobantes.caja,
            comprobantes.informacion_adicional,
            comprobantes.leyendas_valor,
            comprobantes.estado,

            entidades.tipo_documento,
            entidades.razon_social_nombres,
            entidades.ruc_dni,
            entidades.direccion_fiscal,
            entidades.codigo_pais,
            entidades.ubigeo,
            tipo_cambio.venta,          
            
            items.codigo_interno,
            items.codigo_sunat,
            items.descripcion,
            items.um,
            ordenes_detalles_guia_factura.cantidad,
            ordenes_detalles.valor_unitario
            

            FROM comprobantes
            
            INNER JOIN entidades ON entidades.identidades = comprobantes.identidades
            INNER JOIN tipo_cambio ON tipo_cambio.idtipo_cambio = comprobantes.idtipo_cambio
            INNER JOIN ordenes_detalles_guia_factura ON ordenes_detalles_guia_factura.idcomprobantes = comprobantes.idcomprobantes
                INNER JOIN ordenes_detalles ON ordenes_detalles.idordenes_detalles = ordenes_detalles_guia_factura.idordenes_detalles
                INNER JOIN items ON items.iditems = ordenes_detalles.iditems

            WHERE
            comprobantes.idcomprobantes = %s
            ORDER BY comprobantes.fecha_de_emision DESC, comprobantes.comprobante DESC",
            parent::comillas_inteligentes($id)
            );

        $resultado = $this->mysqli->query($consulta);

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }

    //*****************************************************************
    // COMPROBANTE POR AÑO
    //*****************************************************************
    public function comprobantePorAnio($anio){
        $consulta = sprintf("
            SELECT
            comprobantes.idcomprobantes,
            comprobantes.serie_documento,
            comprobantes.numero_documento,
            comprobantes.comprobante,
            comprobantes.fecha_de_emision,
            comprobantes.hora_de_emision,
            comprobantes.codigo_tipo_operacion,
            comprobantes.codigo_tipo_documento,
            comprobantes.codigo_tipo_moneda,
            comprobantes.fecha_de_vencimiento,
            comprobantes.numero_orden_de_compra,
            comprobantes.idtipo_cambio,
            comprobantes.identidades,
            comprobantes.total_exportacion,
            comprobantes.total_operaciones_gravadas,
            comprobantes.total_operaciones_inafectas,
            comprobantes.total_operaciones_exoneradas,
            comprobantes.total_operaciones_gratuitas,
            comprobantes.total_igv_operaciones_gratuitas,
            comprobantes.total_impuestos_bolsa_plastica,
            comprobantes.total_igv,
            comprobantes.total_impuestos,
            comprobantes.total_valor,
            comprobantes.total_venta,
            comprobantes.total_pendiente_de_pago,
            comprobantes.codigo_condicion_de_pago,
            comprobantes.anticipo,
            comprobantes.saldo_anticipo,
            comprobantes.forma_de_pago,
            comprobantes.observaciones,
            comprobantes.vendedor,
            comprobantes.caja,
            comprobantes.informacion_adicional,
            comprobantes.leyendas_valor,
            comprobantes.estado,

            entidades.razon_social_nombres,
            tipo_cambio.venta

            FROM comprobantes
            INNER JOIN entidades ON entidades.identidades = comprobantes.identidades
            INNER JOIN tipo_cambio ON tipo_cambio.idtipo_cambio = comprobantes.idtipo_cambio
            WHERE
            YEAR(comprobantes.fecha_de_emision) = %s

            ORDER BY comprobantes.creado DESC

            ",
            parent::comillas_inteligentes($anio)
            );

        $resultado = $this->mysqli->query($consulta);

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
    
    //*****************************************************************
    // COMPROBANTE EMITIR GUIA
    //*****************************************************************
    public function comprobanteSinGuia($id){
        $consulta = sprintf("SELECT DISTINCT

            ordenes.estado

            FROM ordenes_detalles_guia_factura

            INNER JOIN ordenes_detalles ON ordenes_detalles.idordenes_detalles = ordenes_detalles_guia_factura.idordenes_detalles
            INNER JOIN ordenes ON ordenes.idordenes = ordenes_detalles.idordenes

            WHERE ordenes.estado = 7 AND ordenes_detalles_guia_factura.idcomprobantes = %s",
            parent::comillas_inteligentes($id)
            );

        $resultado = $this->mysqli->query($consulta);

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }

    //*****************************************************************
    // COMPROBANTES POR ENTIDAD
    //*****************************************************************
    public function comprobantesPorEntidad($id){
        $consulta = sprintf("SELECT
            comprobantes.idcomprobantes,
            comprobantes.serie_documento,
            comprobantes.numero_documento,
            comprobantes.comprobante,
            comprobantes.fecha_de_emision,
            comprobantes.hora_de_emision,
            comprobantes.codigo_tipo_operacion,
            comprobantes.codigo_tipo_documento,
            comprobantes.codigo_tipo_moneda,
            comprobantes.fecha_de_vencimiento,
            comprobantes.numero_orden_de_compra,
            comprobantes.idtipo_cambio,
            comprobantes.identidades,
            comprobantes.total_exportacion,
            comprobantes.total_operaciones_gravadas,
            comprobantes.total_operaciones_inafectas,
            comprobantes.total_operaciones_exoneradas,
            comprobantes.total_operaciones_gratuitas,
            comprobantes.total_igv_operaciones_gratuitas,
            comprobantes.total_impuestos_bolsa_plastica,
            comprobantes.total_igv,
            comprobantes.total_impuestos,
            comprobantes.total_valor,
            comprobantes.total_venta,
            comprobantes.total_pendiente_de_pago,
            comprobantes.codigo_condicion_de_pago,
            comprobantes.anticipo,
            comprobantes.saldo_anticipo,
            comprobantes.forma_de_pago,
            comprobantes.observaciones,
            comprobantes.vendedor,
            comprobantes.caja,
            comprobantes.informacion_adicional,
            comprobantes.leyendas_valor,
            comprobantes.estado,

            entidades.razon_social_nombres,
            tipo_cambio.venta

            FROM comprobantes
            INNER JOIN entidades ON entidades.identidades = comprobantes.identidades
            INNER JOIN tipo_cambio ON tipo_cambio.idtipo_cambio = comprobantes.idtipo_cambio
            
            WHERE
            comprobantes.identidades = %s
            ORDER BY comprobantes.fecha_de_emision DESC, comprobantes.comprobante DESC;",
            parent::comillas_inteligentes($id)
            );

        $resultado = $this->mysqli->query($consulta);

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
    //*****************************************************************
    // COMPROBANTES POR ENTIDAD
    //*****************************************************************
    public function anticipoPorEntidad($id){
        $consulta = sprintf("SELECT
            comprobantes.idcomprobantes,
            comprobantes.serie_documento,
            comprobantes.numero_documento,
            comprobantes.comprobante,
            comprobantes.fecha_de_emision,
            comprobantes.hora_de_emision,
            comprobantes.codigo_tipo_operacion,
            comprobantes.codigo_tipo_documento,
            comprobantes.codigo_tipo_moneda,
            comprobantes.fecha_de_vencimiento,
            comprobantes.numero_orden_de_compra,
            comprobantes.idtipo_cambio,
            comprobantes.identidades,
            comprobantes.total_exportacion,
            comprobantes.total_operaciones_gravadas,
            comprobantes.total_operaciones_inafectas,
            comprobantes.total_operaciones_exoneradas,
            comprobantes.total_operaciones_gratuitas,
            comprobantes.total_igv_operaciones_gratuitas,
            comprobantes.total_impuestos_bolsa_plastica,
            comprobantes.total_igv,
            comprobantes.total_impuestos,
            comprobantes.total_valor,
            comprobantes.total_venta,
            comprobantes.total_pendiente_de_pago,
            comprobantes.codigo_condicion_de_pago,
            comprobantes.anticipo,
            comprobantes.saldo_anticipo,
            comprobantes.forma_de_pago,
            comprobantes.observaciones,
            comprobantes.vendedor,
            comprobantes.caja,
            comprobantes.informacion_adicional,
            comprobantes.leyendas_valor,
            comprobantes.estado,

            entidades.razon_social_nombres,
            tipo_cambio.venta

            FROM comprobantes
            INNER JOIN entidades ON entidades.identidades = comprobantes.identidades
            INNER JOIN tipo_cambio ON tipo_cambio.idtipo_cambio = comprobantes.idtipo_cambio
            
            WHERE
            comprobantes.anticipo = '1' AND comprobantes.saldo_anticipo>0 and comprobantes.estado = '05' AND comprobantes.identidades = %s
            ORDER BY comprobantes.fecha_de_emision DESC, comprobantes.comprobante DESC;",
            parent::comillas_inteligentes($id)
            );

        $resultado = $this->mysqli->query($consulta);

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
    //*****************************************************************
    // GUIA POR NUMERO
    //*****************************************************************
    public function comprobantePorNumero($num){
        $consulta = sprintf("SELECT
            comprobantes.idcomprobantes,
            comprobantes.serie_documento,
            comprobantes.numero_documento,
            comprobantes.comprobante,
            comprobantes.fecha_de_emision,
            comprobantes.hora_de_emision,
            comprobantes.codigo_tipo_operacion,
            comprobantes.codigo_tipo_documento,
            comprobantes.codigo_tipo_moneda,
            comprobantes.fecha_de_vencimiento,
            comprobantes.numero_orden_de_compra,
            comprobantes.idtipo_cambio,
            comprobantes.identidades,
            comprobantes.total_exportacion,
            comprobantes.total_operaciones_gravadas,
            comprobantes.total_operaciones_inafectas,
            comprobantes.total_operaciones_exoneradas,
            comprobantes.total_operaciones_gratuitas,
            comprobantes.total_igv_operaciones_gratuitas,
            comprobantes.total_impuestos_bolsa_plastica,
            comprobantes.total_igv,
            comprobantes.total_impuestos,
            comprobantes.total_valor,
            comprobantes.total_venta,
            comprobantes.total_pendiente_de_pago,
            comprobantes.codigo_condicion_de_pago,
            comprobantes.anticipo,
            comprobantes.saldo_anticipo,
            comprobantes.forma_de_pago,
            comprobantes.observaciones,
            comprobantes.vendedor,
            comprobantes.caja,
            comprobantes.informacion_adicional,
            comprobantes.leyendas_valor,
            comprobantes.estado,

            entidades.razon_social_nombres,
            tipo_cambio.venta

            FROM comprobantes
            INNER JOIN entidades ON entidades.identidades = comprobantes.identidades
            INNER JOIN tipo_cambio ON tipo_cambio.idtipo_cambio = comprobantes.idtipo_cambio
            ORDER BY comprobantes.fecha_de_emision DESC, comprobantes.comprobante DESC

            WHERE
            comprobantes.comprobante = %s",
            parent::comillas_inteligentes($num)
            );

        $resultado = $this->mysqli->query($consulta);

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
    //*****************************************************************
    // COMPROBANTE CORRELATIVO
    //*****************************************************************
    public function comprobanteCorrelativo($serie){
        $consulta = sprintf("SELECT
            comprobantes_series.tipo_documento,
            comprobantes_series.serie_documento,
            comprobantes_series.numero_actual,
            comprobantes_series.exportacion

            FROM comprobantes_series

            WHERE
            comprobantes_series.serie_documento = %s and comprobantes_series.estado =1
            
            LIMIT 1
            ",
            parent::comillas_inteligentes($serie)
            );

        $resultado = $this->mysqli->query($consulta);

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }


    //*****************************************************************
    // COMPROBANTE CORRELATIVO
    //*****************************************************************
    public function comprobanteAumCorrelativo($numero,$serie){
        $consulta = sprintf(
            "UPDATE comprobantes_series SET
            comprobantes_series.numero_actual = %s
            WHERE
            comprobantes_series.serie_documento = %s;",
            parent::comillas_inteligentes($numero),
            parent::comillas_inteligentes($serie)
            );

        $this->mysqli->query($consulta);    
    }

    //*****************************************************************
    // AMARRAR GUIAS CON COMPROBANTE
    //*****************************************************************
    public function amarreCG($idcomprobantes,$idguias) {
        $query = sprintf(
            "UPDATE ordenes_detalles_guia_factura SET idcomprobantes = %s WHERE idguias = %s;",
            parent::comillas_inteligentes($idcomprobantes),
            parent::comillas_inteligentes($idguias)
            );
        $this->mysqli->query($query);
        //header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    //*****************************************************************
    // COMPROBANTE MANUAL ENCABEZADO
    //*****************************************************************
    public function comprobanteEncabezado($v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8){
        $consulta = sprintf(
            "UPDATE comprobantes SET
            comprobantes.fecha_de_vencimiento = %s,
            comprobantes.codigo_tipo_moneda = %s,
            comprobantes.numero_orden_de_compra = %s,
            comprobantes.codigo_condicion_de_pago = %s,
            comprobantes.anticipo = %s,
            comprobantes.forma_de_pago = %s,
            comprobantes.informacion_adicional = %s,
            comprobantes.actualizado = now()
            WHERE
            comprobantes.idcomprobantes = %s;",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3),
            parent::comillas_inteligentes($v4),
            parent::comillas_inteligentes($v5),
            parent::comillas_inteligentes($v6),
            parent::comillas_inteligentes($v7),
            parent::comillas_inteligentes($v8)
            );

        $this->mysqli->query($consulta);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    //*****************************************************************
    // AGREGAR EXTERNAL ID A COMPROBANTE
    //*****************************************************************
    public function add_external_id($external_id,$serie,$numero) {
        $query = sprintf(
            "UPDATE comprobantes SET observaciones = %s, estado = '01' WHERE serie_documento = %s and numero_documento = %s ;",
            parent::comillas_inteligentes($external_id),
            parent::comillas_inteligentes($serie),
            parent::comillas_inteligentes($numero)
            );
        $this->mysqli->query($query);
        //header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    //*****************************************************************
    // AGREGAR ESTADO A RESPUESTA DE COMPROBANTE
    //*****************************************************************
    public function estado_respuesta($estado,$serie,$numero) {
        $query = sprintf(
            "UPDATE comprobantes SET estado = %s WHERE serie_documento = %s and numero_documento = %s ;",
            parent::comillas_inteligentes($estado),
            parent::comillas_inteligentes($serie),
            parent::comillas_inteligentes($numero)
            );
        $this->mysqli->query($query);
        //header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    
    //*****************************************************************
    // ENVIO DE COMPROBANTE
    //*****************************************************************
    public function envio_sunat($external_id) {
        $query = sprintf(
            "UPDATE comprobantes SET estado = '03' WHERE observaciones = %s;",
            parent::comillas_inteligentes($external_id)
            );
        $this->mysqli->query($query);
        //header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    //*****************************************************************
    // CAMBIO DE ESTADO DE COMPROBANTE
    //*****************************************************************
    public function cambiarEstadoBorrador($id) {
        $query = sprintf(
            "UPDATE comprobantes SET estado = '00' WHERE comprobantes.idcomprobantes = %s;",
            parent::comillas_inteligentes($id)
            );
        $this->mysqli->query($query);
        //header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    //*****************************************************************
    // TOTAL DE COMPROBANTE
    //*****************************************************************
    public function calculo_totales($idcomprobantes){
        $consulta = sprintf("SELECT
            ordenes_detalles_guia_factura.cantidad,
            ordenes_detalles.valor_unitario,
            ordenes.exportacion
            FROM
            ordenes_detalles_guia_factura

            INNER JOIN ordenes_detalles ON ordenes_detalles.idordenes_detalles = ordenes_detalles_guia_factura.idordenes_detalles
            INNER JOIN ordenes ON ordenes.idordenes = ordenes_detalles.idordenes

            WHERE
            ordenes_detalles_guia_factura.idcomprobantes = %s;
            ",
            parent::comillas_inteligentes($idcomprobantes)
            );

        $resultado = $this->mysqli->query($consulta);

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }

    //*****************************************************************
    // TOTAL DE COMPROBANTE EXTRAS
    //*****************************************************************
    public function calculo_totales2($idcomprobantes){
        $consulta = sprintf("SELECT
            *
            FROM
            comprobantes_detalles

            INNER JOIN comprobantes ON comprobantes.idcomprobantes = comprobantes_detalles.idcomprobantes
            WHERE
            comprobantes.idcomprobantes = %s;
            ",
            parent::comillas_inteligentes($idcomprobantes)
            );

        $resultado = $this->mysqli->query($consulta);

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
}

?>