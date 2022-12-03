<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/conexion.php');
//echo $_SERVER['DOCUMENT_ROOT'];

class Ordenes_tipos extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // LISTADO DE ORDENES TIPOS
    //*****************************************************************
    public function ordenes_tipos(){
        $resultado = $this->mysqli->query("SELECT * FROM ordenes_tipos");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
    
    //*****************************************************************
    // MODIFICAR ORDENES TIPOS
    //*****************************************************************
    public function update($v1,$v2) {

        $consulta = sprintf(
            "UPDATE ordenes_tipos SET
            orden_tipo = %s,
            orden_serie = %s
            WHERE
            idordenes_tipos = %s;",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2)
        	);

        $this->mysqli->query($consulta);

        header('Location: index.php?module=configuracion&page=tipo_ordenes');
    }
    
}
?>