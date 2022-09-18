<?php
session_start();
//print_r($_SESSION);
$principal=1;
if (!isset($_SESSION['sesion'])) {
    header('Location: login.php');
}
else {
?>
<!DOCTYPE html>
<html lang="es">
<?php
  require($_SERVER['DOCUMENT_ROOT'].'/modulos/ventas/cron/tipo_cambio_dia.php');
  if(isset($_GET['module']) && isset($_GET['page'])){
    $ruta="modulos/".$_GET['module']."/";
    $module=$_GET['module'];
    $page=$_GET['page'];
  }
  else{
  	//print_r($_SESSION);
    $ruta="modulos/tablero/";
    $module="tablero";
    $page="main";
  }
  require($ruta.'head.php');
?>

<body class="dt-sidebar--fixed dt-header--fixed" onload="startTime()">

<!-- Loader -->
<div class="dt-loader-container" style="background-color: #202020;">
  <div class="dt-loader">
    <svg class="circular" viewBox="25 25 50 50">
      <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
    </svg>
  </div>
</div>
<!-- /loader -->

<!-- Root -->
<div class="dt-root">

<?php
  require($ruta.'header.php');
?>
  <!-- Site Main -->
  <main class="dt-main">
    <?php
      require($ruta.'left.php');
    ?>

    <!-- Site Content Wrapper -->
    <div class="dt-content-wrapper">

      <?php
        $page = $page.".php";
        require($ruta.$page);
        require($ruta.'footer.php');
      ?>

    </div>
    <!-- /site content wrapper -->

    <?php
      require($ruta.'right.php');
    ?>

  </main>
</div>
<!-- /root -->

<?php
  require($ruta.'foot.php');

?>
</body>
</html>
<?php
}
?>