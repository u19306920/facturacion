<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/conexion.php');
//echo $_SERVER['DOCUMENT_ROOT'];

class Conductores extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // LISTADO DE CONDUCTORES
    //*****************************************************************
    public function conductores(){
        $resultado = $this->mysqli->query("SELECT * FROM conductores ORDER BY conductor");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
    // LISTADO DE CONDUCTORES AJAX
    //*****************************************************************
    public function vehiculosajax(){
        $resultado = $this->mysqli->query("
            SELECT conductores.idconductores, CONCAT(conductores.licencia, ' - ' , conductores.nombres) AS conductor 
            FROM conductores
            WHERE conductores.licencia '%".$_GET['q']."%' OR conductores.nombres LIKE '%".$_GET['q']."%' AND  conductores.estado='1'
            ORDER BY conductores.nombres;");

        $json = [];
        while($row = $resultado->fetch_assoc()){
             $json[] = ['id'=>$row['idconductores'], 'text'=>$row['conductor']];
        }
        echo json_encode($json);
    }

    //*****************************************************************
    // AGREGAR CONDUCTOR
    //*****************************************************************
    public function add($v1,$v2,$v3,$v4) {

        $consulta = sprintf(
            "INSERT INTO conductores values(null, %s, %s, %s,%s, now());",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3),
            parent::comillas_inteligentes($v4)
            );
        $this->mysqli->query($consulta);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // MODIFICAR CONDUCTOR
    //*****************************************************************
    public function update() {

        $consulta = sprintf(
            "UPDATE conductores SET
            nombres = %s,
            licencia = %s,
            estado = %s,
            idtransportistas = %s,
            actualizado = now()
            WHERE
            idconductores = %s;",
            parent::comillas_inteligentes($_POST['nombres']),
            parent::comillas_inteligentes($_POST['licencia']),
            parent::comillas_inteligentes($_POST['estado']),
            parent::comillas_inteligentes($_POST['idtransportistas']),
            parent::comillas_inteligentes($_POST['idconductores'])
            );

        $this->mysqli->query($consulta);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // ELIMINAR CONDUCTOR
    //*****************************************************************
    public function delete($id) {
        $query = sprintf(
            "DELETE FROM conductores WHERE idconductores = %s;",
            parent::comillas_inteligentes($id)
            );
        $this->mysqli->query($query);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // CONDUCTOR POR ID
    //*****************************************************************
    public function conductorPorId($id){
        $consulta = sprintf("SELECT
            conductores.idconductores,
            conductores.nombres,
            conductores.licencia,
            conductores.estado,
            conductores.idtransportistas,
            conductores.actualizado
            FROM
            conductores
            WHERE
            conductores.idconductores = %s",
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
    // CONDUCTORES POR TRANSPORTISTA
    //*****************************************************************
    public function conductoresPorIdTransportista($id){
        $consulta = sprintf("SELECT
            conductores.idconductores,
            conductores.nombres,
            conductores.licencia,
            conductores.estado,
            conductores.idtransportistas,
            conductores.actualizado
            FROM
            conductores
            WHERE
            conductores.idtransportistas = %s",
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