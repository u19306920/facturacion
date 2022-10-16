<?php
if (isset($principal)) {
?>
<!-- Optional JavaScript -->
<script src="../node_modules/moment/moment.js"></script>

<!-- Perfect Scrollbar jQuery -->
<script src="../node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
<!-- /perfect scrollbar jQuery -->

<!-- masonry script -->
<script src="../node_modules/masonry-layout/dist/masonry.pkgd.min.js"></script>
<script src="../node_modules/sweetalert2/dist/sweetalert2.js"></script>

<!-- Custom JavaScript -->

<!--<script src="assets/js/custom/data-table.js"></script>-->
<script src="assets/js/script.js"></script>
<?php 
  }
  else{
    header('Location: ../../login.php');
  }
?>