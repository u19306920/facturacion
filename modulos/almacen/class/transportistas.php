<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/conexion.php');
//echo $_SERVER['DOCUMENT_ROOT'];

class Transportistas extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // LISTADO DE TRANSPORTES
    //*****************************************************************
    public function transportistas(){
        $resultado = $this->mysqli->query("SELECT * FROM transportistas ORDER BY razon_social");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
    // LISTADO DE TRANSPORTISTAS AJAX
    //*****************************************************************
    public function transportesajax(){
        $resultado = $this->mysqli->query("
            SELECT idtransportistas, CONCAT(transportistas.ruc, ' - ' , transportistas.razon_social) AS transporte 
            FROM transportistas 
            WHERE transportistas.razon_social LIKE '%".$_GET['q']."%' OR transportistas.ruc LIKE '%".$_GET['q']."%' AND  (transportistas.estado='ACTIVO' AND transportistas.condicion='HABIDO')
            ORDER BY transportistas.razon_social;");

        $json = [];
        while($row = $resultado->fetch_assoc()){
             $json[] = ['id'=>$row['idtransportistas'], 'text'=>$row['transporte']];
        }
        echo json_encode($json);
    }

    //*****************************************************************
    // AGREGAR TRANSPORTISTA
    //*****************************************************************
    public function add($v1,$v2,$v3,$v4,$v5,$v6) {

        $consulta = sprintf(
            "INSERT INTO transportistas values(null, %s, %s, %s, %s, %s, %s, now());",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3),
            parent::comillas_inteligentes($v4),
            parent::comillas_inteligentes($v5),
            parent::comillas_inteligentes($v6)
            );
        $this->mysqli->query($consulta);

        $last = $this->mysqli->insert_id;

        $consulta2 = sprintf("INSERT INTO conductores values(null, '-', '-', '1', '".$last."', now());");
        $this->mysqli->query($consulta2);

        $consulta3 = sprintf("INSERT INTO vehiculos values(null, '-', '-', '-', '1', '".$last."', now());");
        $this->mysqli->query($consulta3);
        
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    //*****************************************************************
    // AGREGAR TRANSPORTISTA
    //*****************************************************************
    public function add3($v1,$v2,$v3,$v4,$v5,$v6) {

        $consulta = sprintf(
            "INSERT INTO transportistas values(null, %s, %s, %s, %s, %s, %s, now());",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3),
            parent::comillas_inteligentes($v4),
            parent::comillas_inteligentes($v5),
            parent::comillas_inteligentes($v6)
            );
        $this->mysqli->query($consulta);
        
        $last = $this->mysqli->insert_id;

        $consulta2 = sprintf("INSERT INTO conductores values(null, '-', '-', '1', '".$last."', now());");
        $this->mysqli->query($consulta2);

        $consulta3 = sprintf("INSERT INTO vehiculos values(null, '-', '-', '-', '1', '".$last."', now());");
        $this->mysqli->query($consulta3);
        //header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // MODIFICAR TRANSPORTISTA
    //*****************************************************************
    public function update() {

        $consulta = sprintf(
            "UPDATE transportistas SET
            razon_social = %s,
            ruc = %s,
            ubigeo = %s,
            direccion = %s,
            estado = %s,
            condicion = %s,
            actualizado = now()
            WHERE
            idtransportistas = %s;",
            parent::comillas_inteligentes($_POST['razon_social']),
            parent::comillas_inteligentes($_POST['ruc']),
            parent::comillas_inteligentes($_POST['ubigeo']),
            parent::comillas_inteligentes($_POST['direccion']),
            parent::comillas_inteligentes($_POST['estado']),
            parent::comillas_inteligentes($_POST['condicion']),
            parent::comillas_inteligentes($_POST['idtransportistas'])
            );

        $this->mysqli->query($consulta);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // MODIFICAR TRANSPORTISTA
    //*****************************************************************
    public function updatecron($v1,$v2,$v3,$v4,$v5,$v6) {

        $consulta = sprintf(
            "UPDATE transportistas SET
            razon_social = %s,
            ubigeo = %s,
            direccion = %s,
            estado = %s,
            condicion = %s,
            actualizado = now()
            WHERE
            idtransportistas = %s;",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3),
            parent::comillas_inteligentes($v4),
            parent::comillas_inteligentes($v5),
            parent::comillas_inteligentes($v6)
            );

        $this->mysqli->query($consulta);

        //header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // ELIMINAR TRANSPORTISTA
    //*****************************************************************
    public function delete($id) {
        $query = sprintf(
            "DELETE FROM transportistas WHERE idtransportistas = %s;",
            parent::comillas_inteligentes($id)
            );
        $this->mysqli->query($query);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // TRANSPORTISTA POR ID
    //*****************************************************************
    public function transportistaPorId($id){
        $consulta = sprintf("SELECT
            transportistas.idtransportistas,
            transportistas.razon_social,
            transportistas.ruc,
            transportistas.ubigeo,
            transportistas.direccion,
            transportistas.estado,
            transportistas.condicion,
            transportistas.actualizado
            FROM
            transportistas
            WHERE
            transportistas.idtransportistas = %s",
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
    // TRANSPORTISTA POR RUC
    //*****************************************************************
    public function transportistaPorRuc($id){
        $consulta = sprintf("SELECT
            transportistas.idtransportistas,
            transportistas.razon_social,
            transportistas.ruc,
            transportistas.ubigeo,
            transportistas.direccion,
            transportistas.estado,
            transportistas.condicion,
            transportistas.actualizado
            FROM
            transportistas
            WHERE
            transportistas.ruc = %s",
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

class Transportistas3 extends Conexion3{
    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // TRANSPORTISTA POR RUC
    //*****************************************************************
    public function transportistaPorRuc($id){
        $consulta = sprintf("SELECT * 
            FROM
            padron_reducido_ruc
            WHERE
            padron_reducido_ruc.ruc = %s",
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
    // UBIGEO
    //*****************************************************************
    public function ubigeo($id){
        $consulta = sprintf("
            SELECT distrito, provincia, departamento FROM ubigeo_distritos
            INNER JOIN ubigeo_provincias ON ubigeo_distritos.idprovincias = ubigeo_provincias.id
            INNER JOIN ubigeo_departamentos ON ubigeo_provincias.iddepartamentos = ubigeo_departamentos.id
            WHERE ubigeo_distritos.iddistritos = %s",
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
class Entidades3 extends Conexion3{
    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // ENTIDAD POR RUC
    //*****************************************************************
    public function entidadPorRuc($id){
        $consulta = sprintf("SELECT * 
            FROM
            padron_reducido_ruc
            WHERE
            padron_reducido_ruc.ruc = %s",
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
    // UBIGEO
    //*****************************************************************
    public function ubigeo($id){
        $consulta = sprintf("
            SELECT distrito, provincia, departamento FROM ubigeo_distritos
            INNER JOIN ubigeo_provincias ON ubigeo_distritos.idprovincias = ubigeo_provincias.id
            INNER JOIN ubigeo_departamentos ON ubigeo_provincias.iddepartamentos = ubigeo_departamentos.id
            WHERE ubigeo_distritos.iddistritos = %s",
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

    // LISTADO DE UBIGEO AJAX
    //*****************************************************************
    public function ubigeoajax(){
        $resultado = $this->mysqli->query("
            SELECT 
            ubigeo_distritos.iddistritos as id, 
            CONCAT(departamento,' / ',provincia,' / ',distrito) as ubigeo
            FROM ubigeo_distritos
            INNER JOIN ubigeo_provincias ON ubigeo_distritos.idprovincias = ubigeo_provincias.id
            INNER JOIN ubigeo_departamentos ON ubigeo_provincias.iddepartamentos = ubigeo_departamentos.id
            WHERE ubigeo_distritos.distrito LIKE '%".$_GET['q']."%' ORDER BY ubigeo");

        $json = [];
        while($row = $resultado->fetch_assoc()){
             $json[] = ['id'=>$row['id'], 'text'=>$row['ubigeo']];
        }
        echo json_encode($json);
    }

}
?>