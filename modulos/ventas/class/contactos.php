<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/conexion.php');
//echo $_SERVER['DOCUMENT_ROOT'];

class Contactos extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // LISTADO DE CONTACTOS
    //*****************************************************************
    public function contactos(){
        $resultado = $this->mysqli->query("SELECT * FROM contactos ORDER BY nombres_apellidos");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
    // LISTADO DE CONTACTOS AJAX
    //*****************************************************************
    public function contactoajax(){
        $resultado = $this->mysqli->query("
            SELECT contactos.idcontactos, contactos.nombres_apellidos as nombres 
            FROM contactos
            WHERE contactos.nombres_apellidos '%".$_GET['q']."%' AND  contactos.estado='1'
            ORDER BY contactos.nombres_apellidos;");

        $json = [];
        while($row = $resultado->fetch_assoc()){
             $json[] = ['id'=>$row['idcontactos'], 'text'=>$row['nombres_apellidos']];
        }
        echo json_encode($json);
    }

    //*****************************************************************
    // AGREGAR CONTACTO
    //*****************************************************************
    public function add($v1,$v2,$v3,$v4,$v5) {

        $consulta = sprintf(
            "INSERT INTO contactos values(null, %s, %s, %s, %s, %s, now());",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3),
            parent::comillas_inteligentes($v4),
            parent::comillas_inteligentes($v5)
            );
        $res = $this->mysqli->query($consulta);
        if (!$res) {
           printf("Errormessage: %s\n", $this->mysqli->error);
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // MODIFICAR CONTACTO
    //*****************************************************************
    public function update() {

        $consulta = sprintf(
            "UPDATE contactos SET
            nombres_apellidos = %s,
            correo = %s,
            telefono = %s,
            estado = %s,
            identidades = %s,
            actualizado = now()
            WHERE
            idcontactos = %s;",
            parent::comillas_inteligentes($_POST['nombres_apellidos']),
            parent::comillas_inteligentes($_POST['correo']),
            parent::comillas_inteligentes($_POST['telefono']),
            parent::comillas_inteligentes($_POST['estado']),
            parent::comillas_inteligentes($_POST['identidades']),
            parent::comillas_inteligentes($_POST['idcontactos'])
            );

        $this->mysqli->query($consulta);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // ELIMINAR CONTACTO
    //*****************************************************************
    public function delete($id) {
        $query = sprintf(
            "DELETE FROM contactos WHERE idcontactos = %s;",
            parent::comillas_inteligentes($id)
            );
        $this->mysqli->query($query);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // CONTACTO POR ID
    //*****************************************************************
    public function direccionPorId($id){
        $consulta = sprintf("SELECT
            contactos.idcontactos,
            contactos.nombres_apellidos,
            contactos.correo,
            contactos.telefono,
            contactos.estado,
            contactos.identidades,
            contactos.actualizado
            FROM
            contactos
            WHERE
            contactos.idcontactos = %s",
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
    // CONTACTOS POR ENTIDAD
    //*****************************************************************
    public function contactoPorIdEntidad($id){
        $consulta = sprintf("SELECT
            contactos.idcontactos,
            contactos.nombres_apellidos,
            contactos.correo,
            contactos.telefono,
            contactos.estado,
            contactos.identidades,
            contactos.actualizado
            FROM
            contactos
            WHERE
            contactos.identidades = %s",
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