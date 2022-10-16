<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/conexion.php');
//echo $_SERVER['DOCUMENT_ROOT'];

class Items extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // LISTADO DE ITEMS
    //*****************************************************************
    public function items(){
        $resultado = $this->mysqli->query("
            SELECT
            items.iditems,
            items.codigo_sunat,
            items.codigo_interno,
            items.descripcion,
            items.um,
            items.estado,
            um.simbolo,
            um.descripcion as um
            FROM
            items
            INNER JOIN um ON um.simbolo = items.um
            ORDER BY descripcion");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }
    
    // LISTADO DE ITEMS AJAX
    //*****************************************************************
    public function itemsajax(){
        $resultado = $this->mysqli->query("
            SELECT items.iditems, CONCAT(items.codigo_interno, ' - ' , items.descripcion, ' - ',items.um) AS item 
            FROM items
            WHERE items.descripcion LIKE '%".$_GET['q']."%' OR items.codigo_interno LIKE '%".$_GET['q']."%' AND  items.estado='1'
            ORDER BY items.descripcion;");

        $json = [];
        while($row = $resultado->fetch_assoc()){
             $json[] = ['id'=>$row['iditems'], 'text'=>$row['item']];
        }
        echo json_encode($json);
    }

    
    //*****************************************************************
    // AGREGAR ITEM
    //*****************************************************************
    public function add($v1,$v2,$v3,$v4,$v5,$v6) {

        $consulta = sprintf(
            "INSERT INTO items values(null, %s, %s, %s, %s, %s, %s, now());",
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
    // MODIFICAR ITEM
    //*****************************************************************
    public function update() {

        $consulta = sprintf(
            "UPDATE items SET
            codigo_sunat = %s,
            codigo_interno = %s,
            descripcion = %s,
            um = %s,
            estado = %s,
            idcategorias = %s,
            actualizado = now()
            WHERE
            iditems = %s;",
            parent::comillas_inteligentes($_POST['codigo_sunat']),
            parent::comillas_inteligentes($_POST['codigo_interno']),
            parent::comillas_inteligentes($_POST['descripcion']),
            parent::comillas_inteligentes($_POST['um']),
            parent::comillas_inteligentes($_POST['estado']),
            parent::comillas_inteligentes($_POST['idcategorias']),
            parent::comillas_inteligentes($_POST['iditems'])
            );

        $this->mysqli->query($consulta);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    //*****************************************************************
    // ELIMINAR ITEM
    //*****************************************************************
    public function delete($id) {
        $query = sprintf(
            "DELETE FROM items WHERE iditems = %s;",
            parent::comillas_inteligentes($id)
            );
        $this->mysqli->query($query);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    
    //*****************************************************************
    // ITEM POR ID
    //*****************************************************************
    public function itemPorId($id){
        $consulta = sprintf("SELECT
            items.iditems,
            items.codigo_sunat,
            items.codigo_interno,
            items.descripcion,
            items.um,
            items.estado,
            items.idcategorias
            FROM
            items
            WHERE
            items.iditems = %s",
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
    // ITEM POR CODIGO APP
    //*****************************************************************
    public function itemPorCodigoSunat($id){
        $consulta = sprintf("SELECT
            items.iditems,
            items.codigo_sunat,
            items.codigo_interno,
            items.descripcion,
            items.um,
            items.estado,
            items.idcategorias
            FROM
            items
            WHERE
            items.codigo_sunat = %s",
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
    // LISTADO DE CATEGORIAS
    //*****************************************************************
    public function categorias(){
        $resultado = $this->mysqli->query("SELECT * FROM items_categorias ORDER BY categoria");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data;
        }
    }

    // LISTADO DE CATEGORIAS AJAX
    //*****************************************************************
    public function categoriasajax(){
        $resultado = $this->mysqli->query("
            SELECT items_categorias.idcategorias, CONCAT(items_categorias.codigo, ' - ' , items_categorias.categoria) AS ncategoria 
            FROM items_categorias
            WHERE items_categorias.categoria LIKE '%".$_GET['q']."%' OR items_categorias.codigo LIKE '%".$_GET['q']."%' AND  items_categorias.estado='1'
            ORDER BY items_categorias.categoria;");

        $json = [];
        while($row = $resultado->fetch_assoc()){
             $json[] = ['id'=>$row['idcategorias'], 'text'=>$row['ncategoria']];
        }
        echo json_encode($json);
    }

    //*****************************************************************
    // AGREGAR CATEGORIA
    //*****************************************************************
    public function addCategoria($v1,$v2) {

        $consulta = sprintf(
            "INSERT INTO items_categorias values(null, %s, %s, '1');",
            parent::comillas_inteligentes($v1),
            parent::comillas_inteligentes($v2)
            );
        $this->mysqli->query($consulta);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    //*****************************************************************
    // ELIMINAR CATEGORIA
    //*****************************************************************
    public function deleteCategoria($id) {
        $query = sprintf(
            "DELETE FROM items_categorias WHERE idcategorias = %s;",
            parent::comillas_inteligentes($id)
            );
        $this->mysqli->query($query);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

?>