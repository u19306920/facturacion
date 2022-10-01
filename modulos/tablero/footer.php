<?php
if (isset($principal)) {
?>
      <!-- Footer -->
      <footer class="dt-footer">
        Copyright CURSO INTEGRADOR II: SISTEMAS (41153) © <?=date("Y")?>
      </footer>
      <!-- /footer -->
<?php 
}
else{
  header('Location: ../../login.php');
}
?>