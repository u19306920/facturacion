<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/conexion.php');

class Tablero extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }  
    
    //*****************************************************************
    // VENTA POR DIA (VISTA PRINCIPAL) DOLARES
    //*****************************************************************
    public function ventaDia($fecha){
        $consulta = sprintf("SELECT comprobantes.fecha_de_emision dia, SUM(total_venta) total_dia
            FROM comprobantes
            WHERE comprobantes.fecha_de_emision = %s AND comprobantes.codigo_tipo_moneda = 'USD'
            GROUP BY dia
            ORDER BY dia asc
            LIMIT 1; ",
            parent::comillas_inteligentes($fecha)
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
    // VENTA POR DIA (VISTA PRINCIPAL) SOLES
    //*****************************************************************
    public function ventaDiaS($fecha){
        $consulta = sprintf("SELECT comprobantes.fecha_de_emision dia, SUM(total_venta) total_dia
            FROM comprobantes
            WHERE comprobantes.fecha_de_emision = %s AND comprobantes.codigo_tipo_moneda = 'PEN'
            GROUP BY dia
            ORDER BY dia asc
            LIMIT 1; ",
            parent::comillas_inteligentes($fecha)
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
    // VENTA POR TIPO DE OPERACION DIA
    //*****************************************************************
    public function ventadPorTipoVentaDia($fecha){
        $consulta = sprintf("SELECT comprobantes.codigo_tipo_operacion, round(SUM(total_venta),2) total_tipo
            FROM comprobantes
            WHERE comprobantes.fecha_de_emision = %s
            GROUP BY comprobantes.codigo_tipo_operacion;",
            parent::comillas_inteligentes($fecha)
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
    // VENTA DEL AÑO (VISTA PRINCIPAL) DOLARES
    //*****************************************************************
    public function ventaAnio($anio){
        $consulta = sprintf("SELECT YEAR(comprobantes.fecha_de_emision) anio, round(SUM(total_venta),2) total_anio
            FROM comprobantes
            WHERE YEAR(comprobantes.fecha_de_emision) = %s AND comprobantes.codigo_tipo_moneda = 'USD'
            GROUP BY anio
            ORDER BY anio asc
            LIMIT 1; ",
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
    // VENTA DEL AÑO (VISTA PRINCIPAL) SOLES
    //*****************************************************************
    public function ventaAnioS($anio){
        $consulta = sprintf("SELECT YEAR(comprobantes.fecha_de_emision) anio, round(SUM(total_venta),2) total_anio
            FROM comprobantes
            WHERE YEAR(comprobantes.fecha_de_emision) = %s AND comprobantes.codigo_tipo_moneda = 'PEN'
            GROUP BY anio
            ORDER BY anio asc
            LIMIT 1; ",
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
    // VENTA POR TIPO DE OPERACION MES
    //*****************************************************************
    public function ventadPorTipoVentaMes($mes){
        $consulta = sprintf("SELECT comprobantes.codigo_tipo_operacion, SUM(total_venta) total_tipo
            FROM comprobantes
            WHERE MONTH(comprobantes.fecha_de_emision) = %s
            GROUP BY comprobantes.codigo_tipo_operacion;",
            parent::comillas_inteligentes($mes)
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
    // VENTA MES (PRIMER GRAFICO VALOR GLOBAL) SEPARADO DOLARES
    //*****************************************************************
    public function ventaMes($anio,$mes){
        $consulta = sprintf("
            SELECT 
            CONCAT(YEAR(comprobantes.fecha_de_emision),'-',MONTH(comprobantes.fecha_de_emision)) periodo,
            SUM(total_venta) total_mes
            FROM comprobantes
            WHERE YEAR(comprobantes.fecha_de_emision)=%s AND MONTH(comprobantes.fecha_de_emision) = %s AND comprobantes.codigo_tipo_moneda = 'USD'
            GROUP BY periodo
            ORDER BY periodo desc
            LIMIT 1; ",
            parent::comillas_inteligentes($anio),
            parent::comillas_inteligentes($mes)
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
    // VENTA DIAS POR MES SEPARADO DOLARES
    //*****************************************************************
    public function ventadiasMES($anio,$mes){
        $consulta = sprintf("
            SELECT DAY(comprobantes.fecha_de_emision) dia, round(SUM(total_venta),2) total_dia

            FROM comprobantes
            WHERE YEAR(comprobantes.fecha_de_emision) = %s AND MONTH(comprobantes.fecha_de_emision) = %s AND comprobantes.codigo_tipo_moneda = 'USD'
            GROUP BY dia
            ORDER BY dia asc; ",
            parent::comillas_inteligentes($anio),
            parent::comillas_inteligentes($mes)
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
    // VENTA MES (PRIMER GRAFICO VALOR GLOBAL) SEPARADO SOLES
    //*****************************************************************
    public function ventaMesSoles($anio,$mes){
        $consulta = sprintf("
            SELECT 
            CONCAT(YEAR(comprobantes.fecha_de_emision),'-',MONTH(comprobantes.fecha_de_emision)) periodo,
            SUM(total_venta) total_mes
            FROM comprobantes
            WHERE YEAR(comprobantes.fecha_de_emision)=%s AND MONTH(comprobantes.fecha_de_emision) = %s AND comprobantes.codigo_tipo_moneda = 'PEN'
            GROUP BY periodo
            ORDER BY periodo desc
            LIMIT 1; ",
            parent::comillas_inteligentes($anio),
            parent::comillas_inteligentes($mes)
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
    // VENTA DIAS POR MES SEPARADO SOLES
    //*****************************************************************
    public function ventadiasMESSoles($anio,$mes){
        $consulta = sprintf("
            SELECT DAY(comprobantes.fecha_de_emision) dia, round(SUM(total_venta),2) total_dia

            FROM comprobantes
            WHERE YEAR(comprobantes.fecha_de_emision) = %s AND MONTH(comprobantes.fecha_de_emision) = %s AND comprobantes.codigo_tipo_moneda = 'PEN'
            GROUP BY dia
            ORDER BY dia asc; ",
            parent::comillas_inteligentes($anio),
            parent::comillas_inteligentes($mes)
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
    // LISTADO DE VENTAS MENSUALES ULTIMOS 36 MESES DOLARES
    //*****************************************************************
    public function ventas36m(){
        $resultado = $this->mysqli->query("
            
            SELECT CONCAT(YEAR(comprobantes.fecha_de_emision),'-',LPAD(MONTH(comprobantes.fecha_de_emision),2,'0')) AS Periodo, round(SUM(total_venta),2) AS total_mes
            FROM comprobantes
            WHERE comprobantes.codigo_tipo_moneda = 'USD'
            GROUP BY Periodo
            ORDER BY periodo desc
            LIMIT 36
        ");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }

    //*****************************************************************
    // LISTADO DE VENTAS MENSUALES ULTIMOS 36 MESES SOLES
    //*****************************************************************
    public function ventas36mS(){
        $resultado = $this->mysqli->query("
            
            SELECT CONCAT(YEAR(comprobantes.fecha_de_emision),'-',LPAD(MONTH(comprobantes.fecha_de_emision),2,'0')) AS Periodo, round(SUM(total_venta),2) AS total_mes
            FROM comprobantes
            WHERE comprobantes.codigo_tipo_moneda = 'PEN'
            GROUP BY Periodo
            ORDER BY periodo desc
            LIMIT 36
        ");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
}
?>