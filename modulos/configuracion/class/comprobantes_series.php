<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/conexion.php');
//echo $_SERVER['DOCUMENT_ROOT'];

class Comprobantes_series extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // LISTADO DE COMPROBANTES SERIES
    //*****************************************************************
    public function comprobantes_series(){
        $resultado = $this->mysqli->query("SELECT * FROM comprobantes_series");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }

    //*****************************************************************
    // AGREGAR SERIE DE COMPROBANTES
    //*****************************************************************
    public function add($v1,$v2,$v3,$v4,$v5) {

        $consulta = sprintf(
            "INSERT INTO comprobantes_series values(null, %s, %s, %s, %s, %s);",
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
    // MODIFICAR COMPROBANTES SERIES
    //*****************************************************************
    public function update($v1,$v2,$v3,$v4) {

        $consulta = sprintf(
            "UPDATE comprobantes_series SET
            numero_actual = %s,
            exportacion = %s,
            estado = %s
            WHERE
            idcomprobantes_series = %s;",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3),
            parent::comillas_inteligentes($v4)
        	);

        $this->mysqli->query($consulta);

        header('Location: index.php?module=configuracion&page=comprobantes_series');
    }

    //*****************************************************************
    // MODIFICAR COMPROBANTES SERIES
    //*****************************************************************
    public function update2($v1,$v2,$v3) {

        $consulta = sprintf(
            "UPDATE comprobantes_series SET
            numero_actual = %s,
            estado = %s
            WHERE
            idcomprobantes_series = %s;",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3)
            );

        $this->mysqli->query($consulta);

        header('Location: ../../index.php?module=configuracion&page=series_correlativo');
    }
    
    //*****************************************************************
    // COMPROBANTE SERIES POR ID
    //*****************************************************************
    public function comprobantes_seriesPorId($id){
        $consulta = sprintf("
            SELECT
            *
            FROM
            comprobantes_series
            WHERE
            comprobantes_series.idcomprobantes_series = %s",
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
    // COMPROBANTE SERIES POR SERIE
    //*****************************************************************
    public function comprobantes_seriesPorSerie($serie){
        $consulta = sprintf("
            SELECT
            *
            FROM
            comprobantes_series
            WHERE
            comprobantes_series.serie_documento = %s",
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
    // CAMBIAR ESTADO SERIE COMPROBANTES
    //*****************************************************************
    public function cambiar_estado($estado,$id) {

        $consulta = sprintf(
            "UPDATE comprobantes_series SET
            comprobantes_series.estado = %s
            WHERE
            comprobantes_series.idcomprobantes_series = %s;",
            parent::comillas_inteligentes($estado),
            parent::comillas_inteligentes($id)
            );

        $this->mysqli->query($consulta);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    
}
?>