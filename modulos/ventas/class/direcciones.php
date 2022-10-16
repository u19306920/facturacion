<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/conexion.php');
//echo $_SERVER['DOCUMENT_ROOT'];

class Direcciones extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // LISTADO DE DIRECCIONES
    //*****************************************************************
    public function direcciones(){
        $resultado = $this->mysqli->query("SELECT * FROM direcciones ORDER BY ubigeo");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
    // LISTADO DE DIRECCIONES AJAX
    //*****************************************************************
    public function direccionajax(){
        $resultado = $this->mysqli->query("
            SELECT direcciones.iddirecciones, CONCAT(direcciones.ubigeo, ' - ' , direcciones.direccion) AS direccion 
            FROM direcciones
            WHERE direcciones.ubigeo '%".$_GET['q']."%' OR direcciones.direccion LIKE '%".$_GET['q']."%' AND  direcciones.estado='1'
            ORDER BY direcciones.ubigeo;");

        $json = [];
        while($row = $resultado->fetch_assoc()){
             $json[] = ['id'=>$row['iddirecciones'], 'text'=>$row['direccion']];
        }
        echo json_encode($json);
    }

    //*****************************************************************
    // AGREGAR DIRECCION
    //*****************************************************************
    public function add($v1,$v2,$v3,$v4) {

        $consulta = sprintf(
            "INSERT INTO direcciones values(null, %s, %s, %s, %s, now());",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3),
            parent::comillas_inteligentes($v4)
            );
        $this->mysqli->query($consulta);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // MODIFICAR DIRECCION
    //*****************************************************************
    public function update() {

        $consulta = sprintf(
            "UPDATE direcciones SET
            direccion = %s,
            ubigeo = %s,
            estado = %s,
            identidades = %s,
            actualizado = now()
            WHERE
            iddirecciones = %s;",
            parent::comillas_inteligentes($_POST['direccion']),
            parent::comillas_inteligentes($_POST['ubigeo']),
            parent::comillas_inteligentes($_POST['estado']),
            parent::comillas_inteligentes($_POST['identidades']),
            parent::comillas_inteligentes($_POST['iddirecciones'])
            );

        $this->mysqli->query($consulta);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // ELIMINAR DIRECCION
    //*****************************************************************
    public function delete($id) {
        $query = sprintf(
            "DELETE FROM direcciones WHERE iddirecciones = %s;",
            parent::comillas_inteligentes($id)
            );
        $this->mysqli->query($query);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // DIRECCION POR ID
    //*****************************************************************
    public function direccionPorId($id){
        $consulta = sprintf("SELECT
            direcciones.iddirecciones,
            direcciones.direccion,
            direcciones.ubigeo,
            direcciones.estado,
            direcciones.identidades,
            direcciones.actualizado
            FROM
            direcciones
            WHERE
            direcciones.iddirecciones = %s",
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
    // DIRECCIONES POR ENTIDAD
    //*****************************************************************
    public function direccionPorIdEntidad($id){
        $consulta = sprintf("SELECT
            direcciones.iddirecciones,
            direcciones.direccion,
            direcciones.ubigeo,
            direcciones.estado,
            direcciones.identidades,
            direcciones.actualizado
            FROM
            direcciones
            WHERE
            direcciones.identidades = %s",
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