<?php
if (isset($principal)) {
  require('class/transportistas.php');
  $idtransportistas = $_GET['id'];

  $transportistas = new Transportistas();
  $transportista = $transportistas->transportistaPorId($idtransportistas);

?>
      <div class="dt-content">

        <!-- Page Header -->
        <div class="dt-page__header">
          <h1 class="dt-page__title"><?=$transportista[0]['razon_social']?></h1>
        </div>
        <!-- /page header -->

        <!-- Grid -->
        <div class="row">

          <!-- Grid Item -->
          <div class="col-12">

            <!-- Card -->
            <div class="dt-card">

              <!-- Card Header -->
              <div class="dt-card__header">

                <!-- Card Heading -->
                <div class="dt-card__heading">
                  <h3 class="dt-card__title"><i class="fa fa-fw fa-truck"></i> Agregar Vehiculo</h3>
                </div>
                <!-- /card heading -->

              </div>
              <!-- /card header -->

              <!-- Card Body -->
              <div class="dt-card__body">

                <!-- Form -->
                <form action="modulos/almacen/vehiculos_guardar.php" method="POST">
                  <div class="form-row">
                    <div class="col-sm-3 mb-3">
                      <label for="marca">Marca</label>
                      <input type="text" class="form-control" id="marca" name="marca" placeholder="Marca" required="">
                    </div>
                    <div class="col-sm-3 mb-3">
                      <label for="placa">Placa</label>
                      <input type="text" class="form-control" id="placa" name="placa" placeholder="Placa" required="">
                    </div>
                    <div class="col-sm-3 mb-3">
                      <label for="inscripcion">Const. Inscr.</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="constancia2">@</span>
                        </div>
                        <input type="text" class="form-control" id="inscripcion" name="inscripcion" placeholder="Constancia de inscripcion" aria-describedby="constancia2" required="">
                      </div>
                    </div>
                    <div class="col-sm-3 mb-3">
                      <label for="estado">Estado</label>
                      <select class="form-control" id="simple-select" name="estado">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                      </select>
                      <input type="hidden" name="idtransportistas" value="<?=$idtransportistas?>">
                    </div>
                  </div>
                  <button class="btn btn-primary" type="submit">Guardar</button>
                </form>
                <!-- /form -->

              </div>
              <!-- /card body -->

            </div>
            <!-- /card -->

          </div>

        </div>
        <!-- /grid -->

      </div>
<?php
}
else{
  header('Location: ../../login.php');
}
?>