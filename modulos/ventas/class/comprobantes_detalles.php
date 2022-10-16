<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/conexion.php');
//echo $_SERVER['DOCUMENT_ROOT'];
class Comprobantes_detalles extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // LISTADO DE ORDENES DETALLES
    //*****************************************************************
    public function ordenes_detalles_guia_factura(){
        $resultado = $this->mysqli->query("
            SELECT

            ordenes_detalles_guia_factura.idordenes_detalles,
            ordenes_detalles_guia_factura.idguias,
            ordenes_detalles_guia_factura.cantidad,
            ordenes_detalles_guia_factura.idcomprobantes,

            ordenes_detalles.cantidad_pedido,
            ordenes_detalles.cantidad_entregada,
            ordenes_detalles.valor_unitario,

            ordenes.idordenes_tipos,
            ordenes.cat_currency_types_id,
            ordenes.orden,
            ordenes.idordenes,

            items.iditems,
            items.codigo_interno,
            items.descripcion,
            items.um,

            comprobantes.estado

            FROM ordenes_detalles_guia_factura

            INNER JOIN ordenes_detalles ON ordenes_detalles_guia_factura.idordenes_detalles = ordenes_detalles.idordenes_detalles
            INNER JOIN ordenes ON ordenes_detalles.idordenes = ordenes.idordenes
            INNER JOIN ordenes_tipos ON ordenes.idordenes_tipos = ordenes_tipos.idordenes_tipos
            INNER JOIN items ON ordenes_detalles.iditems = items.iditems
            INNER JOIN comprobantes ON ordenes_detalles_guia_factura.idcomprobantes = comprobantes.idcomprobantes

            ");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
    //*****************************************************************
    // AGREGAR COMPROBANTE DETALLE
    //*****************************************************************
    public function add($v1,$v2,$v3) {

        $consulta = sprintf(
            "INSERT INTO ordenes_detalles_guia_factura values(%s, null, %s, %s);",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3)
        );
        $this->mysqli->query($consulta);
        //header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // MODIFICAR COMPROBANTE DETALLE
    //*****************************************************************
    public function update() {

        $consulta = sprintf(
            "UPDATE ordenes_detalles_guia_factura SET
            idordenes_detalles     = %s,
            idguias  = %s,
            cantidad     = %s,
            idcomprobantes             = %s
            WHERE
            idordenes_detalles  = %s and idcomprobantes = %s;",
            parent::comillas_inteligentes($_POST['idordenes_detalles']),
            parent::comillas_inteligentes($_POST['idguias']),
            parent::comillas_inteligentes($_POST['cantidad']),
            parent::comillas_inteligentes($_POST['idcomprobantes']),
            parent::comillas_inteligentes($_POST['idordenes_detalles']),
            parent::comillas_inteligentes($_POST['idcomprobantes'])
        );

        $this->mysqli->query($consulta);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // MODIFICAR CANTIDAD ORDENES DETALLE
    //*****************************************************************
    public function update_cantidad($v1,$v2) {

        $consulta = sprintf(
            "UPDATE ordenes_detalles SET
            cantidad_entregada = cantidad_entregada + %s
            
            WHERE
            idordenes_detalles = %s;",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2)
        );

        $this->mysqli->query($consulta);

        //header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // MODIFICAR CANTIDAD ORDENES DETALLE2
    //*****************************************************************
    public function update_cantidad_estado($v1,$v2) {

        $consulta = sprintf(
            "UPDATE ordenes_detalles SET
            cantidad_entregada = cantidad_entregada + %s,
            estado = '1'
            
            WHERE
            idordenes_detalles = %s;",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2)
        );

        $this->mysqli->query($consulta);

        //header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    
    //*****************************************************************
    // ELIMINAR COMPROBANTE DETALLE
    //*****************************************************************
    public function delete($id,$id2) {
        $query = sprintf(
            "DELETE FROM ordenes_detalles_guia_factura WHERE idordenes_detalles = %s AND idcomprobantes = %s;",
            parent::comillas_inteligentes($id),
            parent::comillas_inteligentes($id2)
            );
        $this->mysqli->query($query);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    //  COMPROBANTE DETALLES POR IDGUIA
    //*****************************************************************
    public function comprobante_detallePorIdComprobante($id){
        $consulta = sprintf("
           SELECT

            ordenes_detalles_guia_factura.idordenes_detalles,
            ordenes_detalles_guia_factura.idguias,
            ordenes_detalles_guia_factura.cantidad,
            ordenes_detalles_guia_factura.idcomprobantes,

            ordenes_detalles.cantidad_pedido,
            ordenes_detalles.cantidad_entregada,
            ordenes_detalles.valor_unitario,

            ordenes.idordenes_tipos,
            ordenes.cat_currency_types_id AS moneda,
            ordenes.orden,
            ordenes.orden_compra,
            ordenes.payment_method_types_id AS metodo_pago,
            ordenes.idordenes,

            items.iditems,
            items.codigo_interno,
            items.descripcion,
            items.um,

            comprobantes.idcomprobantes,
            comprobantes.comprobante,
            comprobantes.estado

            FROM ordenes_detalles_guia_factura

            INNER JOIN ordenes_detalles ON ordenes_detalles_guia_factura.idordenes_detalles = ordenes_detalles.idordenes_detalles
            INNER JOIN ordenes ON ordenes_detalles.idordenes = ordenes.idordenes
            INNER JOIN ordenes_tipos ON ordenes.idordenes_tipos = ordenes_tipos.idordenes_tipos
            INNER JOIN items ON ordenes_detalles.iditems = items.iditems
            INNER JOIN comprobantes ON ordenes_detalles_guia_factura.idcomprobantes = comprobantes.idcomprobantes

            WHERE
            ordenes_detalles_guia_factura.idcomprobantes = %s",
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
    //  COMPROBANTES DETALLES POR IDORDEN
    //*****************************************************************
    public function comprobantes_detallePorIdOrden($id){
        $consulta = sprintf("
           SELECT

            ordenes_detalles_guia_factura.idordenes_detalles,
            ordenes_detalles_guia_factura.idguias,
            ordenes_detalles_guia_factura.cantidad,
            ordenes_detalles_guia_factura.idcomprobantes,

            ordenes_detalles.cantidad_pedido,
            ordenes_detalles.cantidad_entregada,
            ordenes_detalles.valor_unitario,

            ordenes.idordenes_tipos,
            ordenes.cat_currency_types_id,
            ordenes.orden,
            ordenes.idordenes,

            items.iditems,
            items.codigo_interno,
            items.descripcion,
            items.um,

            comprobantes.estado

            FROM ordenes_detalles_guia_factura

            INNER JOIN ordenes_detalles ON ordenes_detalles_guia_factura.idordenes_detalles = ordenes_detalles.idordenes_detalles
            INNER JOIN ordenes ON ordenes_detalles.idordenes = ordenes.idordenes
            INNER JOIN ordenes_tipos ON ordenes.idordenes_tipos = ordenes_tipos.idordenes_tipos
            INNER JOIN items ON ordenes_detalles.iditems = items.iditems
            INNER JOIN comprobantes ON ordenes_detalles_guia_factura.idcomprobantes = comprobantes.idcomprobantes

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
    //  COMPROBANTE DETALLE POR ESTADO GUIA (PENDIENTES DE CONFIRMAR)
    //*****************************************************************
    public function comprobantes_detallePorEstado(){
        $consulta = sprintf("
           SELECT

            ordenes_detalles_guia_factura.idordenes_detalles,
            ordenes_detalles_guia_factura.idguias,
            ordenes_detalles_guia_factura.cantidad,
            ordenes_detalles_guia_factura.idcomprobantes,

            ordenes_detalles.cantidad_pedido,
            ordenes_detalles.cantidad_entregada,
            ordenes_detalles.valor_unitario,

            ordenes.idordenes_tipos,
            ordenes.cat_currency_types_id,
            ordenes.orden,
            ordenes.idordenes,

            items.iditems,
            items.codigo_interno,
            items.descripcion,
            items.um,

            comprobantes.estado

            FROM ordenes_detalles_guia_factura

            INNER JOIN ordenes_detalles ON ordenes_detalles_guia_factura.idordenes_detalles = ordenes_detalles.idordenes_detalles
            INNER JOIN ordenes ON ordenes_detalles.idordenes = ordenes.idordenes
            INNER JOIN ordenes_tipos ON ordenes.idordenes_tipos = ordenes_tipos.idordenes_tipos
            INNER JOIN items ON ordenes_detalles.iditems = items.iditems
            INNER JOIN comprobantes ON ordenes_detalles_guia_factura.idcomprobantes = comprobantes.idcomprobantes

            WHERE
            comprobantes.estado = 0;"
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