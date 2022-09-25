<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/conexion.php');
//echo $_SERVER['DOCUMENT_ROOT'];

class Tipo_Cambio extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // LISTADO DE TIPO DE CAMBIOS
    //*****************************************************************
    public function tipo_cambios(){
        $resultado = $this->mysqli->query("SELECT * FROM tipo_cambio ORDER BY fecha DESC");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
    // LISTADO DE TIPO DE CAMBIO AJAX
    //*****************************************************************
    public function tipo_cambioajax(){
        $resultado = $this->mysqli->query("
            SELECT idtipo_cambio, CONCAT(tipo_cambio.fecha, ' - ' , tipo_cambio.venta) AS tc
            FROM tipo_cambio 
            WHERE tipo_cambio.fecha LIKE '%".$_GET['q']."%' ORDER BY tipo_cambio.fecha;");

        $json = [];
        while($row = $resultado->fetch_assoc()){
             $json[] = ['id'=>$row['idtipo_cambio'], 'text'=>$row['tc']];
        }
        echo json_encode($json);
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
    // AGREGAR TIPO DE CAMBIO
    //*****************************************************************
    public function addcron($v1,$v2,$v3) {

        $consulta = sprintf(
            "INSERT INTO tipo_cambio values(null, %s, %s, %s, now());",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3)
            );
        $this->mysqli->query($consulta);
        //header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // MODIFICAR TIPO DE CAMBIO
    //*****************************************************************
    public function update() {

        $consulta = sprintf(
            "UPDATE tipo_cambio SET
            fecha = %s,
            compra = %s,
            venta = %s,
            registrado = now()
            WHERE
            idtipo_cambio = %s;",
            parent::comillas_inteligentes($_POST['fecha']),
            parent::comillas_inteligentes($_POST['compra']),
            parent::comillas_inteligentes($_POST['venta']),
            parent::comillas_inteligentes($_POST['idtipo_cambio'])
            );

        $this->mysqli->query($consulta);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    //*****************************************************************
    // ELIMINAR TIPO DE CAMBIO
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
    // TIPO DE CAMBIO POR ID
    //*****************************************************************
    public function tipo_cambioPorId($id){
        $consulta = sprintf("SELECT
            tipo_cambio.idtipo_cambio,
            tipo_cambio.fecha,
            tipo_cambio.compra,
            tipo_cambio.venta,
            tipo_cambio.registrado
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
    // TIPO DE CAMBIO POR FECHA
    //*****************************************************************
    public function tipo_cambioPorFecha($fecha){
        $consulta = sprintf("SELECT
            tipo_cambio.idtipo_cambio,
            tipo_cambio.fecha,
            tipo_cambio.compra,
            tipo_cambio.venta

           FROM tipo_cambio

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