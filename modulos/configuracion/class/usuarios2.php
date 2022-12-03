<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/conexion.php');
//echo $_SERVER['DOCUMENT_ROOT'];

class Operador extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // LISTADO DE OPERADORES
    //*****************************************************************
    public function operador(){
        $resultado = $this->mysqli->query("SELECT * FROM operador ORDER BY apellidos");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
    
    //*****************************************************************
    // AGREGAR OPERADOR
    //*****************************************************************
    public function add($v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11) {

        $consulta = sprintf(
            "INSERT INTO operador values(null, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, null, null, %s, '1');",
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
        //header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    //*****************************************************************
    // MODIFICAR OPERADOR
    //*****************************************************************
    public function update() {

        $consulta = sprintf(
            "UPDATE operador SET
            clave = %s,
            telefono = %s,
            correo = %s,
            admin = %s,
            estado = %s
            WHERE
            idoperador = %s;",
            parent::comillas_inteligentes($_POST['clave']),
            parent::comillas_inteligentes($_POST['telefono']),
            parent::comillas_inteligentes($_POST['correo']),
            parent::comillas_inteligentes($_POST['admin']),
            parent::comillas_inteligentes($_POST['estado']),
            parent::comillas_inteligentes($_POST['idoperador'])
            );

        $this->mysqli->query($consulta);

        header('Location: /index.php?module=configuracion&page=operador');
    }

    //*****************************************************************
    // MODIFICAR OPERADOR
    //*****************************************************************
    public function update2() {

        $consulta = sprintf(
            "UPDATE operador SET
            telefono = %s,
            correo = %s,
            admin = %s,
            estado = %s
            WHERE
            idoperador = %s;",
            parent::comillas_inteligentes($_POST['telefono']),
            parent::comillas_inteligentes($_POST['correo']),
            parent::comillas_inteligentes($_POST['admin']),
            parent::comillas_inteligentes($_POST['estado']),
            parent::comillas_inteligentes($_POST['idoperador'])
            );

        $this->mysqli->query($consulta);

        header('Location: /index.php?module=configuracion&page=operador');
    }

    //*****************************************************************
    // OPERADOR DESHABILITADO
    //*****************************************************************
    public function estado_operador_0($v1) {

        $consulta = sprintf(
            "UPDATE operador SET
            estado = 0
            WHERE
            idoperador = %s;",
            parent::comillas_inteligentes($v1)
            );

        $this->mysqli->query($consulta);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    //*****************************************************************
    // OPERADOR HABILITADO
    //*****************************************************************
    public function estado_operador_1($v1) {

        $consulta = sprintf(
            "UPDATE operador SET
            estado = 1
            WHERE
            idoperador = %s;",
            parent::comillas_inteligentes($v1)
            );

        $this->mysqli->query($consulta);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    //*****************************************************************
    // ELIMINAR OPERADOR
    //*****************************************************************
    public function delete($id) {
        $query = sprintf(
            "DELETE FROM operador WHERE idoperador = %s;",
            parent::comillas_inteligentes($id)
            );
        $this->mysqli->query($query);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    
    //*****************************************************************
    // OPERADOR POR ID
    //*****************************************************************
    public function operadorPorId($id){
        $consulta = sprintf("
        	SELECT
            *
            FROM
            operador
            WHERE
            operador.idoperador = %s",
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
    // OPERADOR POR DNI
    //*****************************************************************
    public function operadorPorDni($id){
        $consulta = sprintf("
            SELECT
            *
            FROM
            operador
            WHERE
            operador.dni = %s",
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
    // OPERADOR LOGIN
    //*****************************************************************
    public function operadorLogin($v1,$v2){
        $consulta = sprintf("
        	SELECT
            operador.idoperador,
            operador.usuario,
            operador.clave,
            operador.apellidos,
            operador.nombres,
            operador.dni,
            operador.foto,
            operador.admin,
            operador.estado
            FROM
            operador
            WHERE
            operador.usuario = %s and operador.clave = %s",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2)
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
