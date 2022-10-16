<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/conexion.php');
//echo $_SERVER['DOCUMENT_ROOT'];

class Ordenes extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // LISTADO DE ORDENES
    //*****************************************************************
    public function ordenes(){
        $resultado = $this->mysqli->query("
            SELECT
            ordenes.idordenes,
            ordenes.fecha_emision,
            ordenes.fecha_entrega,
            ordenes.idordenes_tipos,
            ordenes.correlativo,
            ordenes.anio,
            ordenes.orden,
            ordenes.identidades,
            ordenes.cotizacion,
            ordenes.orden_compra,
            ordenes.vendedor,
            ordenes.payment_method_types_id AS tipo_metodo_pago,
            ordenes.cat_currency_types_id AS moneda,
            ordenes.descuento,
            ordenes.exportacion,
            ordenes.monto,
            ordenes.estado,
            ordenes.creado,
            ordenes.actualizado,
            entidades.razon_social_nombres
            FROM ordenes 
            INNER JOIN entidades ON entidades.identidades = ordenes.identidades
            ORDER BY ordenes.orden DESC");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
    // LISTADO DE ORDENES AJAX
    //*****************************************************************
    public function ordenesajax(){
        $resultado = $this->mysqli->query("
            SELECT ordenes.idordenes, ordenes.orden 
            FROM ordenes 
            WHERE ordenes.orden '%".$_GET['q']."%' AND ordenes.estado='1'
            ORDER BY ordenes.orden;");

        $json = [];
        while($row = $resultado->fetch_assoc()){
             $json[] = ['id'=>$row['idordenes'], 'text'=>$row['orden']];
        }
        echo json_encode($json);
    }

    //*****************************************************************
    // AGREGAR ORDEN
    //*****************************************************************
    public function add($v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$v12,$v13,$v14,$v15,$v16) {

        $consulta = sprintf(
            "INSERT INTO ordenes values(null, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, now(),now());",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3),
            parent::comillas_inteligentes($v4),
            parent::comillas_inteligentes($v5),
            parent::comillas_inteligentes($v6),
            parent::comillas_inteligentes($v7),
            parent::comillas_inteligentes($v8),
            parent::comillas_inteligentes($v9),
            parent::comillas_inteligentes($v10),
            parent::comillas_inteligentes($v11),
            parent::comillas_inteligentes($v12),
            parent::comillas_inteligentes($v13),
            parent::comillas_inteligentes($v14),
            parent::comillas_inteligentes($v15),
            parent::comillas_inteligentes($v16)
            );
        $this->mysqli->query($consulta);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // MODIFICAR ORDEN
    //*****************************************************************
    public function update() {

        $consulta = sprintf(
            "UPDATE ordenes SET
            fecha_emision = %s,
            fecha_entrega = %s,
            idordenes_tipos = %s,
            identidades = %s,
            cotizacion = %s,
            orden_compra = %s,
            vendedor = %s,
            payment_method_types_id = %s,
            cat_currency_types_id = %s,
            exportacion = %s,
            actualizado = now()
            WHERE
            idordenes = %s;",
            parent::comillas_inteligentes($_POST['fecha_emision']),
            parent::comillas_inteligentes($_POST['fecha_entrega']),
            parent::comillas_inteligentes($_POST['idordenes_tipos']),
            parent::comillas_inteligentes($_POST['identidades']),
            parent::comillas_inteligentes($_POST['cotizacion']),
            parent::comillas_inteligentes($_POST['orden_compra']),
            parent::comillas_inteligentes($_POST['vendedor']),
            parent::comillas_inteligentes($_POST['formapago']),
            parent::comillas_inteligentes($_POST['moneda']),
            parent::comillas_inteligentes($_POST['exportacion']),
            parent::comillas_inteligentes($_POST['idordenes'])
            );

        $this->mysqli->query($consulta);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // ELIMINAR ORDEN
    //*****************************************************************
    public function delete($id) {
        $query = sprintf(
            "DELETE FROM ordenes WHERE idordenes = %s;",
            parent::comillas_inteligentes($id)
            );
        $this->mysqli->query($query);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // CAMBIAR ESTADO ORDEN
    //*****************************************************************
    public function cambiar($estado,$id,$id2) {

        $consulta = sprintf(
            "UPDATE ordenes SET
            ordenes.estado = %s,
            ordenes.monto = (SELECT SUM(ordenes_detalles.cantidad_pedido * ordenes_detalles.valor_unitario) AS monto FROM ordenes_detalles WHERE ordenes_detalles.idordenes = %s),
            ordenes.actualizado = now()
            WHERE
            ordenes.idordenes = %s;",
            parent::comillas_inteligentes($estado),
            parent::comillas_inteligentes($id),
            parent::comillas_inteligentes($id2)
            );

        $this->mysqli->query($consulta);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    
    //*****************************************************************
    // CAMBIAR ESTADO ORDEN FACTURADA
    //*****************************************************************
    public function cambiarOrdenxFactura($id) {

        $consulta = sprintf(
            "UPDATE ordenes SET
            ordenes.estado = 7,
            ordenes.actualizado = now()
            WHERE
            ordenes.idordenes = %s;",
            parent::comillas_inteligentes($id)
            );

        $this->mysqli->query($consulta);

        //header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    //*****************************************************************
    // CAMBIAR ESTADO ORDEN FACTURADA
    //*****************************************************************
    public function cambiarOrdenCerrada($id) {

        $consulta = sprintf(
            "UPDATE ordenes SET
            ordenes.estado = 3,
            ordenes.actualizado = now()
            WHERE
            ordenes.idordenes = %s;",
            parent::comillas_inteligentes($id)
            );

        $this->mysqli->query($consulta);

        //header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // CONTAR ITEMS DE UNA ORDEN
    //*****************************************************************
    public function contar_items($id) {

        $consulta = sprintf("SELECT
            COUNT(iditems) AS nitems
            FROM ordenes_detalles
            WHERE ordenes_detalles.idordenes = %s;",
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
    // ORDEN POR IDORDEN
    //*****************************************************************
    public function ordenPorId($id){
        $consulta = sprintf("SELECT
            ordenes.idordenes,
            ordenes.fecha_emision,
            ordenes.fecha_entrega,
            ordenes.idordenes_tipos,
            ordenes.correlativo,
            ordenes.anio,
            ordenes.orden,
            ordenes.identidades,
            ordenes.cotizacion,
            ordenes.orden_compra,
            ordenes.vendedor,
            ordenes.payment_method_types_id AS tipo_metodo_pago,
            ordenes.cat_currency_types_id AS moneda,
            ordenes.descuento,
            ordenes.exportacion,
            ordenes.monto,
            ordenes.estado,
            ordenes.creado,
            ordenes.actualizado,

            ordenes_tipos.orden_tipo,
            ordenes_tipos.orden_serie,

            entidades.razon_social_nombres,
            entidades.ruc_dni

            FROM
            ordenes

            INNER JOIN entidades ON entidades.identidades = ordenes.identidades
            INNER JOIN ordenes_tipos ON ordenes_tipos.idordenes_tipos = ordenes.idordenes_tipos

            WHERE
            ordenes.idordenes = %s",
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
    // ORDEN POR ENTIDAD
    //*****************************************************************
    public function ordenPorEntidad($id){
        $consulta = sprintf("SELECT
            ordenes.idordenes,
            ordenes.fecha_emision,
            ordenes.fecha_entrega,
            ordenes.idordenes_tipos,
            ordenes.correlativo,
            ordenes.anio,
            ordenes.orden,
            ordenes.identidades,
            ordenes.cotizacion,
            ordenes.orden_compra,
            ordenes.vendedor,
            ordenes.payment_method_types_id AS tipo_metodo_pago,
            ordenes.cat_currency_types_id AS moneda,
            ordenes.descuento,
            ordenes.exportacion,
            ordenes.monto,
            ordenes.estado,
            ordenes.creado,
            ordenes.actualizado
            FROM
            ordenes
            WHERE
            ordenes.identidades = %s and ordenes.estado = 2",
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
    // ORDEN POR ENTIDAD
    //*****************************************************************
    public function ordenPorEntidadF($id){
        $consulta = sprintf("SELECT
            ordenes.idordenes,
            ordenes.fecha_emision,
            ordenes.fecha_entrega,
            ordenes.idordenes_tipos,
            ordenes.correlativo,
            ordenes.anio,
            ordenes.orden,
            ordenes.identidades,
            ordenes.cotizacion,
            ordenes.orden_compra,
            ordenes.vendedor,
            ordenes.payment_method_types_id AS tipo_metodo_pago,
            ordenes.cat_currency_types_id AS moneda,
            ordenes.descuento,
            ordenes.exportacion,
            ordenes.monto,
            ordenes.estado,
            ordenes.creado,
            ordenes.actualizado
            FROM
            ordenes
            WHERE
            ordenes.identidades = %s and ordenes.estado = 2 and ordenes.idordenes_tipos!='5'; ",
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
    // ORDEN POR ENTIDAD
    //*****************************************************************
    public function ordenPorEntidadnF($id){
        $consulta = sprintf("SELECT
            ordenes.idordenes,
            ordenes.fecha_emision,
            ordenes.fecha_entrega,
            ordenes.idordenes_tipos,
            ordenes.correlativo,
            ordenes.anio,
            ordenes.orden,
            ordenes.identidades,
            ordenes.cotizacion,
            ordenes.orden_compra,
            ordenes.vendedor,
            ordenes.payment_method_types_id AS tipo_metodo_pago,
            ordenes.cat_currency_types_id AS moneda,
            ordenes.descuento,
            ordenes.exportacion,
            ordenes.monto,
            ordenes.estado,
            ordenes.creado,
            ordenes.actualizado
            FROM
            ordenes
            WHERE
            ordenes.identidades = %s and ordenes.estado = 2 and ordenes.idordenes_tipos='5';",
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
    // ORDEN POR NUMERO
    //*****************************************************************
    public function ordenPorNumero($id){
        $consulta = sprintf("SELECT
            ordenes.idordenes,
            ordenes.fecha_emision,
            ordenes.fecha_entrega,
            ordenes.idordenes_tipos,
            ordenes.correlativo,
            ordenes.anio,
            ordenes.orden,
            ordenes.identidades,
            ordenes.cotizacion,
            ordenes.orden_compra,
            ordenes.vendedor,
            ordenes.payment_method_types_id AS tipo_metodo_pago,
            ordenes.cat_currency_types_id AS moneda,
            ordenes.descuento,
            ordenes.exportacion,
            ordenes.monto,
            ordenes.estado,
            ordenes.creado,
            ordenes.actualizado
            FROM
            ordenes
            WHERE
            ordenes.orden = %s",
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
    // ORDEN POR TIPO DE ORDEN
    //*****************************************************************
    public function ordenPorTipoOrden($id,$anio){
        $consulta = sprintf("SELECT
            ordenes.idordenes,
            ordenes.fecha_emision,
            ordenes.fecha_entrega,
            ordenes.idordenes_tipos,
            ordenes.correlativo,
            ordenes.anio,
            ordenes.orden,
            ordenes.identidades,
            ordenes.cotizacion,
            ordenes.orden_compra,
            ordenes.vendedor,
            ordenes.payment_method_types_id AS tipo_metodo_pago,
            ordenes.cat_currency_types_id AS moneda,
            ordenes.descuento,
            ordenes.exportacion,
            ordenes.monto,
            ordenes.estado,
            ordenes.creado,
            ordenes.actualizado
            FROM
            ordenes
            WHERE
            ordenes.idordenes_tipos = %s and ordenes.anio = %s ORDER BY ordenes.correlativo DESC LIMIT 1",
            parent::comillas_inteligentes($id),
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
    // LISTA DE TIPO ORDEN
    //*****************************************************************
    public function orden_tipo(){
        $consulta = sprintf("SELECT
            *
            FROM
            ordenes_tipos",
            
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
    // LISTA DE TIPO ORDEN POR ID
    //*****************************************************************
    public function orden_tipoPorId($id){
        $consulta = sprintf("SELECT
            *
            FROM
            ordenes_tipos
            WHERE
            idordenes_tipos = %s",
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
    // LISTADO DE MONEDAS
    //*****************************************************************
    public function monedas(){
        $resultado = $this->mysqli->query("SELECT * FROM monedas ORDER BY descripcion");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }

    //*****************************************************************
    // LISTADO DE MONEDA POR ID
    //*****************************************************************
    public function monedaPorId($id){
        $consulta = sprintf("SELECT * FROM monedas WHERE idmonedas = %s",
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
    // LISTADO DE METODOS DE PAGO
    //*****************************************************************
    public function metodos_de_pago(){
        $resultado = $this->mysqli->query("SELECT * FROM metodos_de_pago ORDER BY descripcion");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }

    //*****************************************************************
    // LISTADO DE METODOS DE PAGO POR ID
    //*****************************************************************
    public function metodos_de_pagoPorId($id){
        $consulta = sprintf("SELECT * FROM metodos_de_pago WHERE idmetodo_de_pago = %s ORDER BY descripcion",
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
    // LISTADO DE MOTIVO DE TRASLADO
    //*****************************************************************
    public function motivo_traslado(){
        $resultado = $this->mysqli->query("SELECT * FROM motivo_de_traslado ORDER BY idmotivo_de_traslado");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
    //*****************************************************************
    // LISTADO DE MOTIVO DE TRASLADO POR ID
    //*****************************************************************
    public function motivo_trasladoPorId($id){
        $consulta = sprintf("SELECT * FROM motivo_de_traslado WHERE idmotivo_de_traslado = %s ORDER BY idmotivo_de_traslado",
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
}

?>