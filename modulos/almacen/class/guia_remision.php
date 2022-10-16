<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/conexion.php');

class Guia extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    //  GUIA POR ID
    //*****************************************************************
    public function guiaPorId($id){
        $consulta = sprintf("
            SELECT

            guias.idguias,
            guias.fecha_emision,
            guias.fecha_traslado,
            guias.serie_guia,
            guias.numero_guia,
            guias.guia,
            guias.cat_transfer_reason_types_id,
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

            direcciones.direccion as destino,
            direcciones.ubigeo,
            transportistas.razon_social,
            transportistas.ruc,
            transportistas.direccion,
            transportistas.ubigeo,
            vehiculos.marca,
            vehiculos.placa,
            vehiculos.inscripcion,
            conductores.nombres,
            conductores.licencia

            FROM guias

            INNER JOIN transportistas ON transportistas.idtransportistas = guias.idtransportistas
            INNER JOIN vehiculos ON vehiculos.idvehiculos = guias.idvehiculos
            INNER JOIN conductores ON conductores.idconductores = guias.idconductores
            INNER JOIN direcciones ON direcciones.iddirecciones = guias.iddirecciones

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
    //  DETALLE DE GUIA POR IDGUIA
    //*****************************************************************
    public function guiadetallePorIdguia($id){
        $consulta = sprintf("
            SELECT

            ordenes_detalles_guia_factura.cantidad,
            ordenes_detalles_guia_factura.idordenes_detalles,

            ordenes_detalles.iditems,
            ordenes.orden

            FROM ordenes_detalles_guia_factura

            INNER JOIN ordenes_detalles ON ordenes_detalles_guia_factura.idordenes_detalles = ordenes_detalles.idordenes_detalles
            INNER JOIN ordenes ON ordenes.idordenes = ordenes_detalles.idordenes
            WHERE
            ordenes_detalles_guia_factura.idguias = %s",
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
}
?>