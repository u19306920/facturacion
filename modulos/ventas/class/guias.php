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
            SELECT
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
            guias.ocs,
            guias.ots,
            guias.observacion,
            guias.extras,
            guias.idcomprobantes,
            guias.creado,
            guias.actualizado,
            guias.estado,
            entidades.razon_social_nombres

            FROM guias
            INNER JOIN entidades ON entidades.identidades = guias.identidades
            ORDER BY guias.guia DESC");

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
    public function add($v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$v12,$v13,$v14,$v15,$v16,$v17,$v18) {

        $consulta = sprintf(
            "INSERT INTO guias values(null, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, now(),now(),'0');",
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
            parent::comillas_inteligentes($v18)
            );
        $this->mysqli->query($consulta);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    //*****************************************************************
    // AGREGAR GUIA DESDE FACTURA
    //*****************************************************************
    public function addGF($v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$v12,$v13,$v14,$v15,$v16,$v17,$v18,$v19) {

        $consulta = sprintf(
            "INSERT INTO guias values(null, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, now(),now(),'1');",
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
        //header('Location: ' . $_SERVER['HTTP_REFERER']);
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
            guias.ocs,
            guias.ots,
            guias.observacion,
            guias.extras,
            guias.idcomprobantes,
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
            guias.ocs,
            guias.ots,
            guias.observacion,
            guias.extras,
            guias.creado,
            guias.actualizado
            FROM guias

            INNER JOIN entidades ON entidades.identidades = guias.identidades

            WHERE
            guias.identidades = %s and guias.estado = 2",
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
    // GUIA POR ENTIDAD
    //*****************************************************************
    public function guiaPorEntidadF($id){
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
            guias.ocs,
            guias.ots,
            guias.observacion,
            guias.extras,
            guias.creado,
            guias.actualizado
            FROM guias

            INNER JOIN entidades ON entidades.identidades = guias.identidades

            WHERE
            guias.identidades = %s and guias.estado = 2 and guias.tipo_documento !='00'; ",
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
    // GUIA POR IDFACTURA
    //*****************************************************************
    public function guiaPorIdF($id){
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
            guias.idcomprobantes = %s and guias.estado = 1 and guias.tipo_documento !='00'; ",
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
    // GUIA DESDE FACTURA
    //*****************************************************************
    public function guiaDeFactura($id){
        $consulta = sprintf("SELECT
        comprobantes.fecha_de_emision,
        comprobantes.codigo_tipo_operacion,
        comprobantes.identidades,
        entidades.razon_social_nombres,
        comprobantes.codigo_tipo_documento,
        comprobantes.comprobante,
        ordenes_detalles_guia_factura.cantidad,
        items.um,
        items.descripcion,
        ordenes.orden

        FROM ordenes_detalles_guia_factura

        INNER JOIN comprobantes ON comprobantes.idcomprobantes = ordenes_detalles_guia_factura.idcomprobantes
        INNER JOIN ordenes_detalles ON ordenes_detalles.idordenes_detalles = ordenes_detalles_guia_factura.idordenes_detalles
        INNER JOIN items ON items.iditems = ordenes_detalles.iditems
        INNER JOIN ordenes ON ordenes.idordenes = ordenes_detalles.idordenes
        INNER JOIN entidades ON entidades.identidades = comprobantes.identidades

        WHERE ordenes.estado = 7 AND ordenes_detalles_guia_factura.idcomprobantes = %s",
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
    // AMARRAR COMPROBANTE CON GUIA
    //*****************************************************************
    public function amarreGC($idguias,$idcomprobantes) {
        $query = sprintf(
            "UPDATE ordenes_detalles_guia_factura SET idguias = %s WHERE idcomprobantes = %s;",
            parent::comillas_inteligentes($idguias),
            parent::comillas_inteligentes($idcomprobantes)
            );
        $this->mysqli->query($query);
        //header('Location: ' . $_SERVER['HTTP_REFERER']);
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