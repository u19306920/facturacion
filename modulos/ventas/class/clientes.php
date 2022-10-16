<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/conexion.php');
//echo $_SERVER['DOCUMENT_ROOT'];

class Entidades extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // LISTADO DE ENTIDADES
    //*****************************************************************
    public function entidades(){
        $resultado = $this->mysqli->query("SELECT * FROM entidades ORDER BY razon_social_nombres");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
    // LISTADO DE ENTIDADES AJAX
    //*****************************************************************
    public function entidadesajax(){
        $resultado = $this->mysqli->query("
            SELECT identidades, CONCAT(entidades.ruc_dni, ' - ' , entidades.razon_social_nombres) AS cliente
            FROM entidades 
            WHERE entidades.razon_social_nombres '%".$_GET['q']."%' OR entidades.ruc_dni LIKE '%".$_GET['q']."%' AND  (entidades.estado='ACTIVO' AND entidades.condicion='HABIDO')
            ORDER BY entidades.razon_social_nombres;");

        $json = [];
        while($row = $resultado->fetch_assoc()){
             $json[] = ['id'=>$row['identidades'], 'text'=>$row['cliente']];
        }
        echo json_encode($json);
    }

    //*****************************************************************
    // AGREGAR ENTIDAD
    //*****************************************************************
    public function add($v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$v12) {

        $consulta = sprintf(
            "INSERT INTO entidades values(null, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, now());",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3),
            parent::comillas_inteligentes($v4),
            parent::comillas_inteligentes($v5),
            parent::comillas_inteligentes($v6),
            parent::comillas_inteligentes($v7),
            parent::comillas_inteligentes($v8),
            parent::comillas_inteligentes($v9),
            parent::comillas_inteligentes($v10),
            parent::comillas_inteligentes($v11),
            parent::comillas_inteligentes($v12)
            );
        $this->mysqli->query($consulta);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    //*****************************************************************
    // AGREGAR ENTIDAD
    //*****************************************************************
    public function add2($v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11) {

        $consulta = sprintf(
            "INSERT INTO entidades values(null, %s, %s, %s, %s, %s, %s, null, %s, %s, %s, %s, %s, now());",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3),
            parent::comillas_inteligentes($v4),
            parent::comillas_inteligentes($v5),
            parent::comillas_inteligentes($v6),
            parent::comillas_inteligentes($v7),
            parent::comillas_inteligentes($v8),
            parent::comillas_inteligentes($v9),
            parent::comillas_inteligentes($v10),
            parent::comillas_inteligentes($v11)
            );
        $this->mysqli->query($consulta);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    //*****************************************************************
    // AGREGAR ENTIDAD AJAX
    //*****************************************************************
    public function add3($v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$v12) {

        $consulta = sprintf(
            "INSERT INTO entidades values(null, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, now());",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3),
            parent::comillas_inteligentes($v4),
            parent::comillas_inteligentes($v5),
            parent::comillas_inteligentes($v6),
            parent::comillas_inteligentes($v7),
            parent::comillas_inteligentes($v8),
            parent::comillas_inteligentes($v9),
            parent::comillas_inteligentes($v10),
            parent::comillas_inteligentes($v11),
            parent::comillas_inteligentes($v12)
            );
        $this->mysqli->query($consulta);
        //header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // MODIFICAR ENTIDAD
    //*****************************************************************
    public function update() {

        $consulta = sprintf(
            "UPDATE entidades SET
            tipo_documento = %s,
            ruc_dni = %s,
            razon_social_nombres = %s,
            cliente = %s,
            proveedor = %s,
            codigo_pais = %s,
            ubigeo = %s,
            direccion_fiscal = %s,
            correo = %s,
            telefono = %s,
            estado = %s,
            condicion = %s,
            actualizado = now()
            WHERE
            identidades = %s;",
            parent::comillas_inteligentes($_POST['tipo_documento']),
            parent::comillas_inteligentes($_POST['ruc_dni']),
            parent::comillas_inteligentes($_POST['razon_social_nombres']),
            parent::comillas_inteligentes($_POST['cliente']),
            parent::comillas_inteligentes($_POST['proveedor']),
            parent::comillas_inteligentes($_POST['codigo_pais']),
            parent::comillas_inteligentes($_POST['ubigeo']),
            parent::comillas_inteligentes($_POST['direccion_fiscal']),
            parent::comillas_inteligentes($_POST['correo']),
            parent::comillas_inteligentes($_POST['telefono']),
            parent::comillas_inteligentes($_POST['estado']),
            parent::comillas_inteligentes($_POST['condicion']),
            parent::comillas_inteligentes($_POST['identidades'])
            );

        $this->mysqli->query($consulta);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // MODIFICAR ENTIDAD
    //*****************************************************************
    public function updatecron($v1,$v2,$v3,$v4,$v5,$v6) {

        $consulta = sprintf(
            "UPDATE entidades SET
            razon_social_nombres = %s,
            ubigeo = %s,
            direccion_fiscal = %s,
            estado = %s,
            condicion = %s,
            actualizado = now()
            WHERE
            identidades = %s;",
           
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
    // ELIMINAR ENTIDAD
    //*****************************************************************
    public function delete($id) {
        $query = sprintf(
            "DELETE FROM entidades WHERE identidades = %s;",
            parent::comillas_inteligentes($id)
            );
        $this->mysqli->query($query);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // ENTIDAD POR ID
    //*****************************************************************
    public function entidadPorId($id){
        $consulta = sprintf("SELECT
            entidades.identidades,
            entidades.tipo_documento,
            entidades.ruc_dni,
            entidades.razon_social_nombres,
            entidades.cliente,
            entidades.proveedor,
            entidades.codigo_pais,
            entidades.ubigeo,
            entidades.direccion_fiscal,
            entidades.correo,
            entidades.telefono,
            entidades.estado,
            entidades.condicion,
            entidades.actualizado
            FROM
            entidades
            WHERE
            entidades.identidades = %s",
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
    // ENTIDAD POR RUC O DNI
    //*****************************************************************
    public function entidadPorRuc($id){
        $consulta = sprintf("SELECT
            entidades.identidades,
            entidades.tipo_documento,
            entidades.ruc_dni,
            entidades.razon_social_nombres,
            entidades.cliente,
            entidades.proveedor,
            entidades.codigo_pais,
            entidades.ubigeo,
            entidades.direccion_fiscal,
            entidades.correo,
            entidades.telefono,
            entidades.estado,
            entidades.condicion,
            entidades.actualizado
            FROM
            entidades
            WHERE
            entidades.ruc_dni = %s",
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