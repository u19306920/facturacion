<?php

Class Conexion {

   public function conectar(){
      include($_SERVER['DOCUMENT_ROOT'].'/config/config.php');
      $mysqli = new mysqli($host,$user,$pass,$bd,$port);

      if ($mysqli->connect_errno)
         header('Location: offline.html');

      $mysqli->set_charset('utf8');

      return $mysqli;
   }

   public function comillas_inteligentes($valor) {
      // Retirar las barras
      if (htmlspecialchars($valor)) {
         $valor = stripslashes($valor);
      }
      // Colocar comillas si no es entero
      if (!is_numeric($valor)) {
         $valor = "'" . $this->mysqli->real_escape_string($valor) . "'";
      }
      return $valor;
   }

}

Class Conexion3 {

   public function conectar(){
      include($_SERVER['DOCUMENT_ROOT'].'/config/config.php');
      $mysqli = new mysqli($host3,$user3,$pass3,$bd3,$port3);

      if ($mysqli->connect_errno)
         header('Location: offline.html');

      $mysqli->set_charset('utf8');

      return $mysqli;
   }

   public function comillas_inteligentes($valor) {
      // Retirar las barras
      if (htmlspecialchars($valor)) {
         $valor = stripslashes($valor);
      }
      // Colocar comillas si no es entero
      if (!is_numeric($valor)) {
         $valor = "'" . $this->mysqli->real_escape_string($valor) . "'";
      }
      return $valor;
   }

}
?>