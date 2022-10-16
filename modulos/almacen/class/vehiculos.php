<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/conexion.php');
//echo $_SERVER['DOCUMENT_ROOT'];

class Vehiculos extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // LISTADO DE VEHICULOS
    //*****************************************************************
    public function vehiculos(){
        $resultado = $this->mysqli->query("SELECT * FROM vehiculos ORDER BY marca");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
    // LISTADO DE VEHICULOS AJAX
    //*****************************************************************
    public function vehiculosajax(){
        $resultado = $this->mysqli->query("
            SELECT vehiculos.idvehiculos, CONCAT(vehiculos.marca, ' - ' , vehiculos.placa) AS vehiculo 
            FROM vehiculos
            WHERE vehiculos.marca '%".$_GET['q']."%' OR vehiculos.placa LIKE '%".$_GET['q']."%' AND  vehiculos.estado='1'
            ORDER BY vehiculos.marca;");

        $json = [];
        while($row = $resultado->fetch_assoc()){
             $json[] = ['id'=>$row['idvehiculos'], 'text'=>$row['vehiculo']];
        }
        echo json_encode($json);
    }

    //*****************************************************************
    // AGREGAR VEHICULO
    //*****************************************************************
    public function add($v1,$v2,$v3,$v4,$v5) {

        $consulta = sprintf(
            "INSERT INTO vehiculos values(null, %s, %s, %s, %s, %s, now());",
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
    // MODIFICAR VEHICULO
    //*****************************************************************
    public function update() {

        $consulta = sprintf(
            "UPDATE vehiculos SET
            marca = %s,
            placa = %s,
            inscripcion = %s,
            estado = %s,
            idtransportistas = %s,
            actualizado = now()
            WHERE
            idvehiculos = %s;",
            parent::comillas_inteligentes($_POST['marca']),
            parent::comillas_inteligentes($_POST['placa']),
            parent::comillas_inteligentes($_POST['inscripcion']),
            parent::comillas_inteligentes($_POST['estado']),
            parent::comillas_inteligentes($_POST['idtransportistas']),
            parent::comillas_inteligentes($_POST['idvehiculos'])
            );

        $this->mysqli->query($consulta);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // ELIMINAR VEHICULO
    //*****************************************************************
    public function delete($id) {
        $query = sprintf(
            "DELETE FROM vehiculos WHERE idvehiculos = %s;",
            parent::comillas_inteligentes($id)
            );
        $this->mysqli->query($query);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // VEHICULO POR ID
    //*****************************************************************
    public function vehiculoPorId($id){
        $consulta = sprintf("SELECT
            vehiculos.idvehiculos,
            vehiculos.marca,
            vehiculos.placa,
            vehiculos.inscripcion,
            vehiculos.estado,
            vehiculos.idtransportistas,
            vehiculos.actualizado
            FROM
            vehiculos
            WHERE
            vehiculos.idvehiculos = %s",
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
    // VEHICULOS POR TRANSPORTISTA
    //*****************************************************************
    public function vehiculosPorIdTransportista($id){
        $consulta = sprintf("SELECT
            vehiculos.idvehiculos,
            vehiculos.marca,
            vehiculos.placa,
            vehiculos.inscripcion,
            vehiculos.estado,
            vehiculos.idtransportistas,
            vehiculos.actualizado
            FROM
            vehiculos
            WHERE
            vehiculos.idtransportistas = %s",
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