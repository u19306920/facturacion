<?php
if (isset($principal)) {
?>
<head>

  <!-- Meta tags -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Empresa 2.0">
  <meta name="keywords" content="Responsive, HTML5, admin theme, business, professional, jQuery, web design, CSS3, sass">
  <!-- /meta tags -->
  <title>::EMPRESA.:</title>

  <!-- Site favicon -->
  <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">

  <!-- /site favicon -->

  <!-- Font Icon Styles -->
  <link rel="stylesheet" href="node_modules/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="vendors/gaxon-icon/style.css">
  <link href="assets/fontawesome-free-5.15.4/css/all.css" rel="stylesheet">
  <!-- /font icon Styles -->

  <!-- Perfect Scrollbar stylesheet -->
  <link rel="stylesheet" href="node_modules/perfect-scrollbar/css/perfect-scrollbar.css">
  <!-- /perfect scrollbar stylesheet -->

  <!-- Load Styles -->

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