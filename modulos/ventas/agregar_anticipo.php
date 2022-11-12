<?php
session_start();
if(!empty($_POST)){
	if(isset($_POST["idcomprobantes"]) && isset($_POST["usar"]) && isset($_POST["nuevo_saldo"])){
		// si es el primer producto simplemente lo agregamos
		if(empty($_SESSION["carro_anticipo"])){
			$_SESSION["carro_anticipo"]=array( array("idcomprobantes"=>$_POST["idcomprobantes"],"comprobante"=>$_POST["comprobante"],"usar"=> $_POST["usar"],"nuevo_saldo"=> ($_POST["inicio"]-$_POST["usar"])));
		}else{
			// apartie del segundo producto:
			$carro_anticipo = $_SESSION["carro_anticipo"];
			$repeated = false;
			// recorremos el carrito en busqueda de producto repetido
			foreach ($carro_anticipo as $c) {
				// si el producto esta repetido rompemos el ciclo
				if($c["idcomprobantes"]==$_POST["idcomprobantes"]){
					$repeated=true;
					break;
				}
			}
			// si el producto es repetido no hacemos nada, simplemente redirigimos
			if($repeated){
				print "<script>alert('Error: Comprobante Repetido!');</script>";
			}else{
				// si el producto no esta repetido entonces lo agregamos a la variable carro_anticipo y despues asignamos la variable carro_anticipo a la variable de sesion
				array_push($carro_anticipo, array("idcomprobantes"=>$_POST["idcomprobantes"],"comprobante"=>$_POST["comprobante"],"usar"=> $_POST["usar"],"nuevo_saldo"=> ($_POST["inicio"]-$_POST["usar"])));
				$_SESSION["carro_anticipo"] = $carro_anticipo;
			}
		}
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	else{
		print_r($_POST);
	}
}
print_r($_POST);
//print_r($carro_anticipo);
?>