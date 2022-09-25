<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/conexion.php');
//echo $_SERVER['DOCUMENT_ROOT'];

class FormasPago extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // LISTADO DE METODO DE PAGO
    //*****************************************************************
    public function metodos_de_pago(){
        $resultado = $this->mysqli->query("SELECT * FROM metodos_de_pago ORDER BY descripcion ASC");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
    
    //*****************************************************************
    // AGREGAR METODO DE PAGO
    //*****************************************************************
    public function add($v1,$v2,$v3) {

        $consulta = sprintf(
            "INSERT INTO metodos_de_pago values(null, %s, %s, %s, '1');",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3)
            );
        $this->mysqli->query($consulta);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // MODIFICAR METODO DE PAGO
    //*****************************************************************
    public function update($v1,$v2,$v3) {

        $consulta = sprintf(
            "UPDATE metodos_de_pago SET
            dias = %s,
            credito = %s,
            estado = %s
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