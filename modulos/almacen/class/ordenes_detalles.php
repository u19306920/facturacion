<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/conexion.php');
//echo $_SERVER['DOCUMENT_ROOT'];
class Ordenes_detalles extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // LISTADO DE ORDENES DETALLES
    //*****************************************************************
    public function ordenes_detalles(){
        $resultado = $this->mysqli->query("
            SELECT

            ordenes_detalles.idordenes_detalles,
            ordenes_detalles.cantidad_pedido,
            ordenes_detalles.cantidad_entregada,
            ordenes_detalles.valor_unitario,
            ordenes_detalles.idordenes,
            ordenes_detalles.iditems,
            ordenes_detalles.estado,
            ordenes_detalles.actualizado,

            ordenes.idordenes_tipos,
            ordenes.cat_currency_types_id,
            ordenes.orden,
            ordenes.orden_compra,
            ordenes.idordenes,

            items.iditems,
            items.codigo_interno,
            items.descripcion,
            items.um

            FROM ordenes_detalles

            INNER JOIN ordenes ON ordenes_detalles.idordenes = ordenes.idordenes
            INNER JOIN ordenes_tipos ON ordenes.idordenes_tipos = ordenes_tipos.idordenes_tipos
            INNER JOIN items ON ordenes_detalles.iditems = items.iditems

            ");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
    //*****************************************************************
    // AGREGAR ORDEN DETALLE
    //*****************************************************************
    public function add() {

        $consulta = sprintf(
            "INSERT INTO ordenes_detalles values(null, %s, '0', %s, %s, %s, '0', now());",
            parent::comillas_inteligentes($_POST['cantidad_pedido']),
            parent::comillas_inteligentes($_POST['valor_unitario']),
            parent::comillas_inteligentes($_POST['idordenes']),
            parent::comillas_inteligentes($_POST['iditems']),
        );
        $this->mysqli->query($consulta);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // MODIFICAR ORDEN DETALLE
    //*****************************************************************
    public function update() {

        $consulta = sprintf(
            "UPDATE ordenes_detalles SET
            cantidad_pedido     = %s,
            cantidad_entregada  = %s,
            valor_unitario     = %s,
            iditems             = %s,
            estado              = %s
            WHERE
            idordenes_detalles  = %s;",
            parent::comillas_inteligentes($_POST['cantidad_pedido']),
            parent::comillas_inteligentes($_POST['cantidad_entregada']),
            parent::comillas_inteligentes($_POST['valor_unitario']),
            parent::comillas_inteligentes($_POST['iditems']),
            parent::comillas_inteligentes($_POST['estado']),
            parent::comillas_inteligentes($_POST['idordenes_detalles'])
        );

        $this->mysqli->query($consulta);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    
    //*****************************************************************
    // ELIMINAR ORDEN DETALLE
    //*****************************************************************
    public function delete($id) {
        $query = sprintf(
            "DELETE FROM ordenes_detalles WHERE idordenes_detalles = %s;",
            parent::comillas_inteligentes($id)
            );
        $this->mysqli->query($query);
        //header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    //  ORDENES DETALLES POR IDORDEN_DETALLE
    //*****************************************************************
    public function ordenes_detallePorId($id){
        $consulta = sprintf("
           SELECT
            ordenes_detalles.idordenes_detalles,
            ordenes_detalles.cantidad_pedido,
            ordenes_detalles.cantidad_entregada,
            ordenes_detalles.valor_unitario,
            ordenes_detalles.idordenes,
            ordenes_detalles.iditems,
            ordenes_detalles.estado,
            ordenes_detalles.actualizado,

            ordenes.idordenes_tipos,
            ordenes.cat_currency_types_id,
            ordenes.orden,
            ordenes.orden_compra,
            ordenes.idordenes,

            items.iditems,
            items.codigo_interno,
            items.descripcion,
            items.um

            FROM ordenes_detalles

            INNER JOIN ordenes ON ordenes_detalles.idordenes = ordenes.idordenes
            INNER JOIN ordenes_tipos ON ordenes.idordenes_tipos = ordenes_tipos.idordenes_tipos
            INNER JOIN items ON ordenes_detalles.iditems = items.iditems

            WHERE
            ordenes_detalles.idordenes_detalles = %s",
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
    //  ORDENES DETALLES POR IDORDEN
    //*****************************************************************
    public function ordenes_detallePorIdOrden($id){
        $consulta = sprintf("
           SELECT

            ordenes_detalles.idordenes_detalles,
            ordenes_detalles.cantidad_pedido,
            ordenes_detalles.cantidad_entregada,
            ordenes_detalles.valor_unitario,
            ordenes_detalles.idordenes,
            ordenes_detalles.iditems,
            ordenes_detalles.estado,
            ordenes_detalles.actualizado,

            ordenes.idordenes_tipos,
            ordenes.cat_currency_types_id,
            ordenes.orden,
            ordenes.orden_compra,
            ordenes.idordenes,

            items.iditems,
            items.codigo_interno,
            items.descripcion,
            items.um

            FROM ordenes_detalles

            INNER JOIN ordenes ON ordenes_detalles.idordenes = ordenes.idordenes
            INNER JOIN ordenes_tipos ON ordenes.idordenes_tipos = ordenes_tipos.idordenes_tipos
            INNER JOIN items ON ordenes_detalles.iditems = items.iditems

            WHERE
            ordenes_detalles.idordenes = %s
            ORDER BY items.codigo_interno
            ",
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
    //  ORDEN DETALLE POR ESTADO (PENDIENTES DE ENTREGA)
    //*****************************************************************
    public function ordenes_detallePorEstado(){
        $consulta = sprintf("
           SELECT

            ordenes_detalles.idordenes_detalles,
            ordenes_detalles.cantidad_pedido,
            ordenes_detalles.cantidad_entregada,
            ordenes_detalles.valor_unitario,
            ordenes_detalles.idordenes,
            ordenes_detalles.iditems,
            ordenes_detalles.estado,
            ordenes_detalles.actualizado,

            ordenes.idordenes_tipos,
            ordenes.cat_currency_types_id,
            ordenes.orden,
            ordenes.orden_compra,
            ordenes.idordenes,
            ordenes.identidades,

            items.iditems,
            items.codigo_interno,
            items.descripcion,
            items.um,

            entidades.razon_social_nombres

            FROM ordenes_detalles

            INNER JOIN ordenes ON ordenes_detalles.idordenes = ordenes.idordenes
            INNER JOIN ordenes_tipos ON ordenes.idordenes_tipos = ordenes_tipos.idordenes_tipos
            INNER JOIN items ON ordenes_detalles.iditems = items.iditems
            INNER JOIN entidades ON ordenes.identidades = entidades.identidades

            WHERE
            ordenes_detalles.estado = 1;"
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
    //  ORDENES DETALLES POR CLIENTE (PENDIENTES DESPACHO POR CLIENTE).
    //*****************************************************************
    public function ot_detallePorCliente_Estado($id){
        $consulta = sprintf("
           SELECT

            ordenes_detalles.idordenes_detalles,
            ordenes_detalles.cantidad_pedido,
            ordenes_detalles.cantidad_entregada,
            ordenes_detalles.valor_unitario,
            ordenes_detalles.idordenes,
            ordenes_detalles.iditems,
            ordenes_detalles.estado,
            ordenes_detalles.actualizado,

            ordenes.idordenes_tipos,
            ordenes.cat_currency_types_id,
            ordenes.orden,
            ordenes.orden_compra,
            ordenes.idordenes,
            ordenes.identidades,

            items.iditems,
            items.codigo_interno,
            items.descripcion,
            items.um,

            entidades.razon_social_nombres

            FROM ordenes_detalles

            INNER JOIN ordenes ON ordenes_detalles.idordenes = ordenes.idordenes
            INNER JOIN ordenes_tipos ON ordenes.idordenes_tipos = ordenes_tipos.idordenes_tipos
            INNER JOIN items ON ordenes_detalles.iditems = items.iditems
            INNER JOIN entidades ON ordenes.identidades = entidades.identidades

            WHERE
            ordenes_detalles.estado = 1 and ordenes.identidades = %s",
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
    //  ORDENES DETALLES POR IDGUIA
    //*****************************************************************
    public function buscar_detalle_porIdguia($id){
        $consulta = sprintf("
           SELECT
            *
            FROM ordenes_detalles_guia_factura

            WHERE
            ordenes_detalles_guia_factura.idguia_remision = %s",
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