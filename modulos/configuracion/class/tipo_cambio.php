<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/conexion.php');
//echo $_SERVER['DOCUMENT_ROOT'];

class Tipos_cambios extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // LISTADO DE TIPO DE CAMBIO
    //*****************************************************************
    public function tipos_cambios(){
        $resultado = $this->mysqli->query("SELECT * FROM tipo_cambio ORDER BY fecha DESC");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
    
    //*****************************************************************
    // AGREGAR TIPO DE CAMBIO
    //*****************************************************************
    public function add($v1,$v2,$v3) {

        $consulta = sprintf(
            "INSERT INTO tipo_cambio values(null, %s, %s, %s, now());",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3)
            );
        $this->mysqli->query($consulta);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // MODIFICAR TIPO DE CAMBIO
    //*****************************************************************
    public function update($v1,$v2,$v3) {

        $consulta = sprintf(
            "UPDATE tipo_cambio SET
            compra = %s,
            venta = %s,
            registrado = now()
            WHERE
            idtipo_cambio = %s;",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3)
        	);

        $this->mysqli->query($consulta);

        header('Location: index.php?module=configuracion&page=tipo_cambio');
    }
    //*****************************************************************
    // ELIMINAR TIPO CAMBIO
    //*****************************************************************
    public function delete($id) {
        $query = sprintf(
            "DELETE FROM tipo_cambio WHERE idtipo_cambio = %s;",
            parent::comillas_inteligentes($id)
            );
        $this->mysqli->query($query);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    
    //*****************************************************************
    // TIPO CAMBIO POR ID
    //*****************************************************************
    public function tipo_cambioPorId($id){
        $consulta = sprintf("
            SELECT
            *
            FROM
            tipo_cambio
            WHERE
            tipo_cambio.idtipo_cambio = %s",
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
    // TIPO CAMBIO POR FECHA
    //*****************************************************************
    public function tipo_cambioPorFecha($fecha){
        $consulta = sprintf("
            SELECT
            *
            FROM
            tipo_cambio
            WHERE
            tipo_cambio.fecha = %s",
            parent::comillas_inteligentes($fecha)
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