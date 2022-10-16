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
    public function comprobantes_detalles(){
        $resultado = $this->mysqli->query("
            SELECT
            *
            FROM comprobantes_detalles
            INNER JOIN comprobantes ON comprobantes.idcomprobantes = comprobantes_detalles.idcomprobantes
            INNER JOIN tipo_cambio ON tipo_cambio.idtipo_cambio = comprobantes.idtipo_cambio
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
    public function add($v1,$v2,$v3,$v4,$v5) {

        $consulta = sprintf(
            "INSERT INTO comprobantes_detalles values(null, %s, %s, %s, %s, %s);",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3),
            parent::comillas_inteligentes($v4),
            parent::comillas_inteligentes($v5)
        );
        $this->mysqli->query($consulta);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // MODIFICAR COMPROBANTE DETALLE
    //*****************************************************************
    public function update($v1,$v2,$v3,$v4,$v5) {

        $consulta = sprintf(
            "UPDATE comprobantes_detalles SET
            descripcion     = %s,
            cantidad     = %s,
            um  = %s,
            valor_unitario     = %s
            
            WHERE
            idordenes_detalles  = %s;",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3),
            parent::comillas_inteligentes($v4),
            parent::comillas_inteligentes($v5)
        );

        $this->mysqli->query($consulta);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    
    //*****************************************************************
    // ELIMINAR COMPROBANTE DETALLE
    //*****************************************************************
    public function delete($id) {
        $query = sprintf(
            "DELETE FROM comprobantes_detalles WHERE idcomprobantes_detalles = %s;",
            parent::comillas_inteligentes($id)
            );
        $this->mysqli->query($query);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    
    //*****************************************************************
    //  COMPROBANTE DETALLES POR IDCOMPROBANTE
    //*****************************************************************
    public function comprobantes_detallePorIdComprobante($id){
        $consulta = sprintf("
            SELECT
            *
            FROM comprobantes_detalles
            INNER JOIN comprobantes ON comprobantes.idcomprobantes = comprobantes_detalles.idcomprobantes
            INNER JOIN tipo_cambio ON tipo_cambio.idtipo_cambio = comprobantes.idtipo_cambio
            INNER JOIN entidades ON entidades.identidades = comprobantes.identidades
            WHERE
            comprobantes_detalles.idcomprobantes = %s",
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