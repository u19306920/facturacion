<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/conexion.php');
//echo $_SERVER['DOCUMENT_ROOT'];

class Ums extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // LISTADO DE UMS
    //*****************************************************************
    public function ums(){
        $resultado = $this->mysqli->query("SELECT * FROM um ORDER BY descripcion");

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
    public function add($v1,$v2,$v3) {

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
    public function update() {

        $consulta = sprintf(
            "UPDATE um SET
            simbolo = %s,
            descripcion = %s,
            estado = %s,
            actualizado = now()
            WHERE
            idum = %s;",
            parent::comillas_inteligentes($_POST['simbolo']),
            parent::comillas_inteligentes($_POST['descripcion']),
            parent::comillas_inteligentes($_POST['estado']),
            parent::comillas_inteligentes($_POST['idum'])
            );

        $this->mysqli->query($consulta);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
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
    public function umPorId($id){
        $consulta = sprintf("SELECT
            um.idum,
            um.simbolo,
            um.descripcion,
            um.estado
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