<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/conexion.php');
//echo $_SERVER['DOCUMENT_ROOT'];
class Guias_detalles extends Conexion {

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

            guias.estado

            FROM ordenes_detalles_guia_factura

            INNER JOIN ordenes_detalles ON ordenes_detalles_guia_factura.idordenes_detalles = ordenes_detalles.idordenes_detalles
            INNER JOIN ordenes ON ordenes_detalles.idordenes = ordenes.idordenes
            INNER JOIN ordenes_tipos ON ordenes.idordenes_tipos = ordenes_tipos.idordenes_tipos
            INNER JOIN items ON ordenes_detalles.iditems = items.iditems
            INNER JOIN guias ON ordenes_detalles_guia_factura.idguias = guias.idguias

            ");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
    //*****************************************************************
    // AGREGAR GUIA DETALLE
    //*****************************************************************
    public function add($v1,$v2,$v3) {

        $consulta = sprintf(
            "INSERT INTO ordenes_detalles_guia_factura values(%s, %s, %s,null);",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3)
        );
        $this->mysqli->query($consulta);
        //header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // MODIFICAR GUIA DETALLE
    //*****************************************************************
    public function update() {

        $consulta = sprintf(
            "UPDATE ordenes_detalles_guia_factura SET
            idordenes_detalles     = %s,
            idguias  = %s,
            cantidad     = %s,
            idcomprobantes             = %s
            WHERE
            idordenes_detalles  = %s and idguias = %s;",
            parent::comillas_inteligentes($_POST['idordenes_detalles']),
            parent::comillas_inteligentes($_POST['idguias']),
            parent::comillas_inteligentes($_POST['cantidad']),
            parent::comillas_inteligentes($_POST['idcomprobantes']),
            parent::comillas_inteligentes($_POST['idordenes_detalles']),
            parent::comillas_inteligentes($_POST['idguias'])
        );

        $this->mysqli->query($consulta);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    //*****************************************************************
    // MODIFICAR GUIA DETALLE FACTURADA
    //*****************************************************************
    public function updateGF($id1,$id2) {

        $consulta = sprintf(
            "UPDATE ordenes_detalles_guia_factura SET
            idguias  = %s
            WHERE
            idcomprobantes  = %s;",
            parent::comillas_inteligentes($id1),
            parent::comillas_inteligentes($id2)
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
    // ELIMINAR GUIA DETALLE
    //*****************************************************************
    public function delete($id,$id2) {
        $query = sprintf(
            "DELETE FROM ordenes_detalles_guia_factura WHERE idordenes_detalles = %s AND idguias = %s;",
            parent::comillas_inteligentes($id),
            parent::comillas_inteligentes($id2)
            );
        $this->mysqli->query($query);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    //  GUIA DETALLES POR IDGUIA
    //*****************************************************************
    public function guia_detallePorIdGuia($id){
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

            guias.idguias,
            guias.guia,
            guias.estado

            FROM ordenes_detalles_guia_factura

            INNER JOIN ordenes_detalles ON ordenes_detalles_guia_factura.idordenes_detalles = ordenes_detalles.idordenes_detalles
            INNER JOIN ordenes ON ordenes_detalles.idordenes = ordenes.idordenes
            INNER JOIN ordenes_tipos ON ordenes.idordenes_tipos = ordenes_tipos.idordenes_tipos
            INNER JOIN items ON ordenes_detalles.iditems = items.iditems
            INNER JOIN guias ON ordenes_detalles_guia_factura.idguias = guias.idguias

            WHERE
            ordenes_detalles_guia_factura.idguias = %s",
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
    //  GUIAS DETALLES POR IDORDEN
    //*****************************************************************
    public function guias_detallePorIdOrden($id){
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

            guias.estado

            FROM ordenes_detalles_guia_factura

            INNER JOIN ordenes_detalles ON ordenes_detalles_guia_factura.idordenes_detalles = ordenes_detalles.idordenes_detalles
            INNER JOIN ordenes ON ordenes_detalles.idordenes = ordenes.idordenes
            INNER JOIN ordenes_tipos ON ordenes.idordenes_tipos = ordenes_tipos.idordenes_tipos
            INNER JOIN items ON ordenes_detalles.iditems = items.iditems
            INNER JOIN guias ON ordenes_detalles_guia_factura.idguias = guias.idguias

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
    //  GUIA DETALLE POR ESTADO GUIA (PENDIENTES DE CONFIRMAR)
    //*****************************************************************
    public function guias_detallePorEstado(){
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

            guias.estado

            FROM ordenes_detalles_guia_factura

            INNER JOIN ordenes_detalles ON ordenes_detalles_guia_factura.idordenes_detalles = ordenes_detalles.idordenes_detalles
            INNER JOIN ordenes ON ordenes_detalles.idordenes = ordenes.idordenes
            INNER JOIN ordenes_tipos ON ordenes.idordenes_tipos = ordenes_tipos.idordenes_tipos
            INNER JOIN items ON ordenes_detalles.iditems = items.iditems
            INNER JOIN guias ON ordenes_detalles_guia_factura.idguias = guias.idguias

            WHERE
            guias.estado = 0;"
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