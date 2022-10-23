<?php
if (isset($principal)) {
?>
<head>

  <!-- Meta tags -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Wieldy - A fully responsive, HTML5 based admin template">
  <meta name="keywords" content="Responsive, HTML5, admin theme, business, professional, jQuery, web design, CSS3, sass">
  <!-- /meta tags -->
  <title>::Empresa 2.0::</title>

  <!-- Site favicon -->
  <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
  <!-- /site favicon -->

  <!-- Font Icon Styles -->
  <link rel="stylesheet" href="node_modules/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="vendors/gaxon-icon/style.css">
  <!-- /font icon Styles -->

  <!-- Perfect Scrollbar stylesheet -->
  <link rel="stylesheet" href="node_modules/perfect-scrollbar/css/perfect-scrollbar.css">
  <!-- /perfect scrollbar stylesheet -->

  <!-- Load Styles -->
  <!-- Data table stylesheet -->
  <script src="../node_modules/jquery/dist/jquery.js"></script>
  <script src="../node_modules/datatables.net/js/jquery.dataTables.js"></script>
  <!--<script src="../node_modules/datatables.net-buttons-bs4/js/buttons.bootstrap4.js"></script>-->
  <script src="../node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
  <script src="../node_modules/datatables.net-buttons/js/dataTables.buttons.js"></script>
  <script src="../node_modules/datatables.net-buttons/js/buttons.html5.js"></script>
  <script src="../node_modules/datatables.net-buttons/js/buttons.flash.js"></script>
  <script src="../node_modules/datatables.net-buttons/js/buttons.print.js"></script>
  <script src="../node_modules/jszip/dist/jszip.js"></script>
  <script src="../node_modules/pdfmake/build/pdfmake.js"></script>
  <script src="../node_modules/pdfmake/build/vfs_fonts.js"></script>

  <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  
  <!--CSS Datatables-->

  <link href="../node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../node_modules/datatables.net-buttons-bs4/css/buttons.bootstrap4.css">
  <!-- /data table stylesheet -->

  <!-- Select 2-->
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css'>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>
  <!-- /Select 2-->

  <link href="assets/fontawesome-free-5.15.4/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/lite-style-1.min.css">
  <link rel="stylesheet" href="assets/css/reloj.css">
  <!-- /load styles -->
  <script type="text/javascript" src="assets/js/reloj.js"></script>

</head>
<?php 
}
else{
  header('Location: ../../login.php');
}
?>