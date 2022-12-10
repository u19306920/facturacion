<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/conexion.php');
//echo $_SERVER['DOCUMENT_ROOT'];

class Usuarios extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // LISTADO DE USUARIOS
    //*****************************************************************
    public function usuarios(){
        $resultado = $this->mysqli->query("SELECT * FROM usuarios ORDER BY usuario");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
    
    //*****************************************************************
    // AGREGAR USUARIO
    //*****************************************************************
    public function add($v1,$v2,$v3,$v4,$v5,$v6) {

        $consulta = sprintf(
            "INSERT INTO usuarios values(null, %s, %s, %s, %s, %s, 'gSrXVdDzYAfNZiajWsohZkebGKtmfBuQ635MwUdbUzByh2wHNG', now(), now(), %s);",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3),
            parent::comillas_inteligentes($v4),
            parent::comillas_inteligentes($v5),
            parent::comillas_inteligentes($v6)
            );
        $this->mysqli->query($consulta);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // MODIFICAR USUARIOS
    //*****************************************************************
    public function update($v1,$v2,$v3,$v4,$v5) {

        $consulta = sprintf(
            "UPDATE usuarios SET
            usuario = %s,
            password = %s,
            token = %s,
            actualizado = now(),
            estado = %s
            WHERE
            idusuarios = %s;",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3),
            parent::comillas_inteligentes($v4),
            parent::comillas_inteligentes($v5)
        	);

        $this->mysqli->query($consulta);

        header('Location: ../../index.php?module=configuracion&page=usuarios');
    }
    //*****************************************************************
    // MODIFICAR USUARIOS2
    //*****************************************************************
    public function update2($v1,$v2,$v3,$v4) {

        $consulta = sprintf(
            "UPDATE usuarios SET
            usuario = %s,
            token = %s,
            actualizado = now(),
            estado = %s
            WHERE
            idusuarios = %s;",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2),
            parent::comillas_inteligentes($v3),
            parent::comillas_inteligentes($v4)
            );

        $this->mysqli->query($consulta);

        header('Location: ../../index.php?module=configuracion&page=usuarios');
    }

    //*****************************************************************
    // MODIFICAR USUARIOS3
    //*****************************************************************
    public function update3($v1,$v2) {

        $consulta = sprintf(
            "UPDATE usuarios SET
            password = %s,
            actualizado = now()
            WHERE
            idusuarios = %s;",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2)
            );

        $this->mysqli->query($consulta);

        header('Location: ../../index.php?module=tablero&page=cambiar_ok');
    }
    //*****************************************************************
    // ELIMINAR USUARIOS
    //*****************************************************************
    public function delete($id) {
        $query = sprintf(
            "DELETE FROM usuarios WHERE idusuarios = %s;",
            parent::comillas_inteligentes($id)
            );
        $this->mysqli->query($query);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // USUARIOS POR ID
    //*****************************************************************
    public function usuarioPorId($id){
        $consulta = sprintf("
        	SELECT
            *
            FROM
            usuarios
            WHERE
            usuarios.idusuarios = %s",
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
    // USUARIO LOGIN
    //*****************************************************************
    public function usuarioLogin($usuario,$pass){
        $consulta = sprintf("
        	SELECT
            usuarios.idusuarios,
            usuarios.usuario,
            usuarios.password,
            usuarios.nombres,
            usuarios.apellidos,
            usuarios.dni,
            usuarios.token,
            usuarios.estado
            FROM
            usuarios
            WHERE
            usuarios.usuario = %s and usuarios.password = %s",
            parent::comillas_inteligentes($usuario),
            parent::comillas_inteligentes($pass)
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