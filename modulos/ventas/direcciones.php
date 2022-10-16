<?php
if (isset($principal)) {
  require('class/clientes.php');
  $identidades = $_GET['id'];

  $entidades = new Entidades();
  $entidad = $entidades->entidadPorId($identidades);
?>
      <div class="dt-content">

        <!-- Page Header -->
        <div class="dt-page__header">
          <h1 class="dt-page__title"><?=$entidad[0]['razon_social_nombres']?></h1>
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
                  <h3 class="dt-card__title"><i class="fa fa-fw fa-warehouse"></i> Agregar Dirección</h3>
                </div>
                <!-- /card heading -->

              </div>
              <!-- /card header -->

              <!-- Card Body -->
              <div class="dt-card__body">

                <!-- Form -->
                <form action="modulos/ventas/direcciones_guardar.php" method="POST">
                  <div class="form-row">
                    <div class="col-sm-6 mb-3">
                      <label for="direccion">Dirección</label>
                      <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion" required="">
                    </div>
                    <div class="col-sm-6 mb-3">
                      <label for="ubigeo">Ubigeo</label>
                      <select class="form-control" id="ubigeo" name="ubigeo">
                      </select>
                      <script type="text/javascript">
                        $('#ubigeo').select2({
                          placeholder: 'Seleccione Ubigeo',
                          minimumInputLength: 3,
                          ajax: {
                            url: 'modulos/ventas/ajax/ubigeo.php',
                            dataType: 'json',
                            delay: 250,
                            processResults: function (data) {
                              return {
                                results: data
                              };
                            },
                            cache: true
                          }
                        });
                      </script>
                    </div>
                    <div class="col-sm-3 mb-3">
                      <label for="estado">Estado</label>
                      <select class="form-control" id="estado" name="estado">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                      </select>
                      <input type="hidden" name="identidades" value="<?=$identidades?>">
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
        <div class="row">

          <!-- Grid Item -->
          <div class="col-xl-12">

            <!-- Entry Header -->
            <div class="dt-entry__header">

              <!-- Entry Heading -->
              <div class="dt-entry__heading">
                <h3 class="dt-entry__title"><i class="fa fa-fw fa-warehouse"></i> Direcciones</h3>
              </div>
              <!-- /entry heading -->

            </div>
            <!-- /entry header -->

            <!-- Card -->
            <div class="dt-card overflow-hidden">

              <!-- Card Body -->
              <div class="dt-card__body p-0">

                <!-- Tables -->
                <div class="table-responsive">
                  <table class="table table-hover mb-0">
                    <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th class="text-uppercase" scope="col">Dirección</th>
                      <th class="text-uppercase" scope="col">Ubigeo</th>
                      <th class="text-uppercase" scope="col">Estado</th>
                      <th class="text-uppercase" scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        require('class/direcciones.php');
                        $objDirecciones = new Direcciones();
                        $direcciones = $objDirecciones->direccionPorIdEntidad($identidades);
                        if($direcciones > 0){
                          $i=0;
                          foreach ($direcciones as $direccion){
                            $i=$i+1;
                      ?>
                    <tr>
                      <th scope="row"><?=$i?></th>
                      <td><?=$direccion['direccion']?></td>
                      <td><?=$direccion['ubigeo']?></td>
                      <td><?php if($direccion['estado']==1){ echo "ACTIVO";}?></td>
                      <td><a title="Eliminar" href="modulos/ventas/direcciones_eliminar.php?id=<?=$direccion['iddirecciones']?>"><i class="fa fa-fw fa-trash"></i></a></td>
                    </tr>
                      <?php
                          }
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
                <!-- /tables -->

              </div>
              <!-- /card body -->

            </div>
            <!-- /card -->

          </div>
          <!-- /grid item -->

        </div>
      </div>
<?php
}
else{
  header('Location: ../../login.php');
}
?>