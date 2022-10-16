<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/conexion.php');
//echo $_SERVER['DOCUMENT_ROOT'];

class Guias extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // LISTADO DE GUIAS
    //*****************************************************************
    public function guias(){
        $resultado = $this->mysqli->query("
            SELECT DISTINCT
            guias.idguias,
            guias.fecha_emision,
            guias.fecha_traslado,
            guias.serie_guia,
            guias.numero_guia,
            guias.guia,
            guias.cat_transfer_reason_types_id AS motivo_traslado,
            guias.identidades,
            guias.iddirecciones,
            guias.idtransportistas,
            guias.idvehiculos,
            guias.idconductores,
            guias.tipo_documento,
            guias.numero_documento,
            guias.fecha_documento,
            guias.ocs,
            guias.ots,
            guias.observacion,
            guias.extras,
            guias.idcomprobantes,
            guias.creado,
            guias.actualizado,
            guias.estado,
            entidades.razon_social_nombres,
            comprobantes.comprobante

            FROM guias
            INNER JOIN entidades ON entidades.identidades = guias.identidades
            LEFT JOIN ordenes_detalles_guia_factura ON ordenes_detalles_guia_factura.idguias = guias.idguias
            LEFT JOIN comprobantes ON comprobantes.idcomprobantes = ordenes_detalles_guia_factura.idcomprobantes
            
            ORDER BY guias.creado DESC");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
    // LISTADO DE GUIAS AJAX
    //*****************************************************************
    public function guiasajax(){
        $resultado = $this->mysqli->query("
            SELECT guias.idguias, guias.guia 
            FROM guias 
            WHERE guias.guia '%".$_GET['q']."%' AND guias.estado='1'
            ORDER BY guias.orden;");

        $json = [];
        while($row = $resultado->fetch_assoc()){
             $json[] = ['id'=>$row['idguias'], 'text'=>$row['guia']];
        }
        echo json_encode($json);
    }

    //*****************************************************************
    // AGREGAR GUIA
    //*****************************************************************
    public function add($v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$v12,$v13,$v14,$v15,$v16,$v17,$v18,$v19) {

        $consulta = sprintf(
            "INSERT INTO guias values(null, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, now(),now(),'0');",
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
            parent::comillas_inteligentes($v12),
            parent::comillas_inteligentes($v13),
            parent::comillas_inteligentes($v14),
            parent::comillas_inteligentes($v15),
            parent::comillas_inteligentes($v16),
            parent::comillas_inteligentes($v17),
            parent::comillas_inteligentes($v18),
            parent::comillas_inteligentes($v19)
            );
        $this->mysqli->query($consulta);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // MODIFICAR GUIA
    //*****************************************************************
    public function update() {

        $consulta = sprintf(
            "UPDATE guias SET
            fecha_emision = %s,
            fecha_traslado = %s,
            serie_guia = %s,
            numero_guia = %s,
            guia = %s,
            cat_transfer_reason_types_id = %s,
            identidades = %s,
            iddirecciones = %s,
            idtransportistas = %s,
            idvehiculos = %s,
            idconductores = %s,
            tipo_documento = %s,
            numero_documento = %s,
            fecha_documento = %s,
            ocs = %s,
            ots = %s,
            observacion = %s,
            extras = %s,
            actualizado = now()
            WHERE
            idguias = %s;",
            parent::comillas_inteligentes($_POST['fecha_emision']),
            parent::comillas_inteligentes($_POST['fecha_traslado']),
            parent::comillas_inteligentes($_POST['serie_guia']),
            parent::comillas_inteligentes($_POST['numero_guia']),
            parent::comillas_inteligentes($_POST['guia']),
            parent::comillas_inteligentes($_POST['cat_transfer_reason_types_id']),
            parent::comillas_inteligentes($_POST['identidades']),
            parent::comillas_inteligentes($_POST['iddirecciones']),
            parent::comillas_inteligentes($_POST['idtransportistas']),
            parent::comillas_inteligentes($_POST['idvehiculos']),
            parent::comillas_inteligentes($_POST['idconductores']),
            parent::comillas_inteligentes($_POST['tipo_documento']),
            parent::comillas_inteligentes($_POST['numero_documento']),
            parent::comillas_inteligentes($_POST['fecha_documento']),
            parent::comillas_inteligentes($_POST['ocs']),
            parent::comillas_inteligentes($_POST['ots']),
            parent::comillas_inteligentes($_POST['observacion']),
            parent::comillas_inteligentes($_POST['extras']),
            parent::comillas_inteligentes($_POST['idguias'])
            );

        $this->mysqli->query($consulta);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // ELIMINAR GUIA
    //*****************************************************************
    public function delete($id) {
        $query = sprintf(
            "DELETE FROM guias WHERE idguias = %s;",
            parent::comillas_inteligentes($id)
            );
        $this->mysqli->query($query);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // CAMBIAR ESTADO GUIA
    //*****************************************************************
    public function cambiar($estado,$id) {

        $consulta = sprintf(
            "UPDATE guias SET
            guias.estado = %s,
            guias.actualizado = now()
            WHERE
            guias.idguias = %s;",
            parent::comillas_inteligentes($estado),
            parent::comillas_inteligentes($id)
            );

        $this->mysqli->query($consulta);

        //header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // CAMBIAR ESTADO GUIA 2
    //*****************************************************************
    public function cambiar2($estado,$id) {

        $consulta = sprintf(
            "UPDATE guias SET
            guias.estado = %s,
            guias.actualizado = now()
            WHERE
            guias.idguias = %s;",
            parent::comillas_inteligentes($estado),
            parent::comillas_inteligentes($id)
            );

        $this->mysqli->query($consulta);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    //*****************************************************************
    // ACTUALIZAR OCS Y OTS
    //*****************************************************************
    public function update_ocs_ots($ocs,$ots,$id) {

        $consulta = sprintf(
            "UPDATE guias SET
            guias.ocs = %s,
            guias.ots = %s,
            guias.actualizado = now()
            WHERE
            guias.idguias = %s;",
            parent::comillas_inteligentes($ocs),
            parent::comillas_inteligentes($ots),
            parent::comillas_inteligentes($id)
            );

        $this->mysqli->query($consulta);

        //header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    //*****************************************************************
    // ACTUALIZAR OCS Y OTS Y ESTADO
    //*****************************************************************
    public function update_ocs_ots_estado($ocs,$ots,$id) {

        $consulta = sprintf(
            "UPDATE guias SET
            guias.ocs = %s,
            guias.ots = %s,
            guias.estado = 2,
            guias.actualizado = now()
            WHERE
            guias.idguias = %s;",
            parent::comillas_inteligentes($ocs),
            parent::comillas_inteligentes($ots),
            parent::comillas_inteligentes($id)
            );

        $this->mysqli->query($consulta);

        //header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // CONTAR ITEMS DE UNA GUIA
    //*****************************************************************
    public function contar_items($id) {

        $consulta = sprintf("SELECT
            COUNT(ordenes_detalles_guia_factura.idordenes_detalles) AS nitems
            FROM ordenes_detalles_guia_factura
            WHERE ordenes_detalles_guia_factura.idguias = %s;",
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
    // GUIA POR IDGUIA
    //*****************************************************************
    public function guiaPorId($id){
        $consulta = sprintf("SELECT
            guias.idguias,
            guias.fecha_emision,
            guias.fecha_traslado,
            guias.serie_guia,
            guias.numero_guia,
            guias.guia,
            guias.cat_transfer_reason_types_id AS motivo_traslado,
            guias.identidades,
            guias.iddirecciones,
            guias.idtransportistas,
            guias.idvehiculos,
            guias.idconductores,
            guias.tipo_documento,
            guias.numero_documento,
            guias.fecha_documento,
            guias.ocs,
            guias.ots,
            guias.observacion,
            guias.extras,
            guias.creado,
            guias.actualizado,
            guias.estado,

            entidades.razon_social_nombres,
            entidades.ruc_dni,
            entidades.identidades,

            direcciones.direccion,

            transportistas.razon_social,
            transportistas.ruc,

            vehiculos.marca,
            vehiculos.placa,
            vehiculos.inscripcion,

            conductores.nombres,
            conductores.licencia

            FROM guias

            INNER JOIN entidades ON entidades.identidades = guias.identidades
            INNER JOIN direcciones ON direcciones.iddirecciones = guias.iddirecciones
            INNER JOIN transportistas ON transportistas.idtransportistas = guias.idtransportistas
            INNER JOIN vehiculos ON vehiculos.idvehiculos = guias.idvehiculos
            INNER JOIN conductores ON conductores.idconductores = guias.idconductores

            WHERE
            guias.idguias = %s",
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
    // GUIAS POR AÑO
    //*****************************************************************
    public function guiaPorAnio($anio){
        $consulta = sprintf("
            SELECT DISTINCT
            guias.idguias,
            guias.fecha_emision,
            guias.fecha_traslado,
            guias.serie_guia,
            guias.numero_guia,
            guias.guia,
            guias.cat_transfer_reason_types_id AS motivo_traslado,
            guias.identidades,
            guias.iddirecciones,
            guias.idtransportistas,
            guias.idvehiculos,
            guias.idconductores,
            guias.tipo_documento,
            guias.numero_documento,
            guias.fecha_documento,
            guias.ocs,
            guias.ots,
            guias.observacion,
            guias.extras,
            guias.idcomprobantes,
            guias.creado,
            guias.actualizado,
            guias.estado,
            entidades.razon_social_nombres,
            comprobantes.comprobante

            FROM guias
            
            INNER JOIN entidades ON entidades.identidades = guias.identidades
            LEFT JOIN ordenes_detalles_guia_factura ON ordenes_detalles_guia_factura.idguias = guias.idguias
            LEFT JOIN comprobantes ON comprobantes.idcomprobantes = ordenes_detalles_guia_factura.idcomprobantes
            
            WHERE
            YEAR(guias.fecha_emision) = %s

            ORDER BY guias.creado DESC

            ",
            parent::comillas_inteligentes($anio)
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
    // GUIA POR ENTIDAD
    //*****************************************************************
    public function guiaPorEntidad($id){
        $consulta = sprintf("SELECT
            guias.idguias,
            guias.fecha_emision,
            guias.fecha_traslado,
            guias.serie_guia,
            guias.numero_guia,
            guias.guia,
            guias.cat_transfer_reason_types_id AS motivo_traslado,
            guias.identidades,
            guias.iddirecciones,
            guias.idtransportistas,
            guias.idvehiculos,
            guias.idconductores,
            guias.tipo_documento,
            guias.numero_documento,
            guias.fecha_documento,
            guias.ocs,
            guias.ots,
            guias.observacion,
            guias.extras,
            guias.creado,
            guias.actualizado
            FROM guias

            INNER JOIN entidades ON entidades.identidades = guias.identidades

            WHERE
            guias.identidades = %s",
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
    // GUIA POR NUMERO
    //*****************************************************************
    public function guiaPorNumero($id){
        $consulta = sprintf("SELECT
            guias.idguias,
            guias.fecha_emision,
            guias.fecha_traslado,
            guias.serie_guia,
            guias.numero_guia,
            guias.guia,
            guias.cat_transfer_reason_types_id AS motivo_traslado,
            guias.identidades,
            guias.iddirecciones,
            guias.idtransportistas,
            guias.idvehiculos,
            guias.idconductores,
            guias.tipo_documento,
            guias.numero_documento,
            guias.fecha_documento,
            guias.ocs,
            guias.ots,
            guias.observacion,
            guias.extras,
            guias.idcomprobantes,
            guias.creado,
            guias.actualizado
            FROM guias

            INNER JOIN entidades ON entidades.identidades = guias.identidades

            WHERE
            guias.guia = %s",
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