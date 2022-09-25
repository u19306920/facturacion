<?php
if (isset($principal)) {
?>
      <!-- Footer -->
      <footer class="dt-footer">
        Copyright DATASERVER PERU © <?=date("Y")?>
      </footer>
      <!-- /footer -->
<?php 
}
else{
  header('Location: ../../login.php');
}
?>