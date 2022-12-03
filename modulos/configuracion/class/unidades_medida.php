<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/conexion.php');
//echo $_SERVER['DOCUMENT_ROOT'];

class Um extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // LISTADO DE UM
    //*****************************************************************
    public function um(){
        $resultado = $this->mysqli->query("SELECT * FROM um ORDER BY descripcion ASC");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
    
    //*****************************************************************
    // AGREGAR UM
    //*****************************************************************
    public function add($v1,$v2) {

        $consulta = sprintf(
            "INSERT INTO um values(null, %s, %s, '1', now());",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2)
            );
        $this->mysqli->query($consulta);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // MODIFICAR UM
    //*****************************************************************
    public function update($v1,$v2,$v3,$v4) {

        $consulta = sprintf(
            "UPDATE um SET
            simbolo = %s,
            descripcion = %s,
            estado = %s,
            actualizado = now()
            WHERE
            idum = %s;",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3),
            parent::comillas_inteligentes($v4)
        	);

        $this->mysqli->query($consulta);

        header('Location: index.php?module=configuracion&page=unidades_medida');
    }
    //*****************************************************************
    // ELIMINAR UM
    //*****************************************************************
    public function delete($id) {
        $query = sprintf(
            "DELETE FROM um WHERE idum = %s;",
            parent::comillas_inteligentes($id)
            );
        $this->mysqli->query($query);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    
    //*****************************************************************
    // UM POR ID
    //*****************************************************************
    public function tipo_cambioPorId($id){
        $consulta = sprintf("
            SELECT
            *
            FROM
            um
            WHERE
            um.idum = %s",
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