<?php
/*
* Eliminar un producto del carrito
*/
session_start();
if(!empty($_SESSION["carro_anticipo"])){
	$cart  = $_SESSION["carro_anticipo"];
	if(count($cart)==1){ unset($_SESSION["carro_anticipo"]); }
	else{
		$newcart = array();
		foreach($cart as $c){
			if($c["idcomprobantes"]!=$_GET["id"]){
				$newcart[] = $c;
			}
		}
		$_SESSION["carro_anticipo"] = $newcart;
	}
}
header('Location: ' . $_SERVER['HTTP_REFERER']);

?>