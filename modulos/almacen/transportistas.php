<?php
if (isset($principal)) {
  require('class/transportistas.php');
?>
      <!-- Site Content -->
      <div class="dt-content">

        <!-- Page Header -->
        <div class="dt-page__header">
          <h1 class="dt-page__title"></h1><!--Titulo-->
        </div>
        <!-- /page header -->

        <!-- Grid -->
        <div class="row dt-masonry">

          <!-- Grid Item -->
          <div class="col-md-12 dt-masonry__item">

            <!-- Card -->
            <div class="dt-card">

              <!-- Card Header -->
              <div class="dt-card__header">

                <!-- Card Heading -->
                <div class="dt-card__heading">
                  <h3 class="dt-card__title">Transportistas</h3><!--Titulo-->
                </div>
                <!-- /card heading -->

              </div>
              <!-- /card header -->

              <!-- Card Body -->
              <div class="dt-card__body tabs-container">

                <!-- Tab Navigation -->
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tab-pane-1" role="tab"
                       aria-controls="tab-pane-1" aria-selected="true"><i class="fab fa-waze"></i> Lista de Transportistas
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-pane-2" role="tab"
                       aria-controls="tab-pane-2" aria-selected="true"><i class="icon icon-add"></i> Nuevo Transportista
                    </a>
                  </li>
                </ul>
                <!-- /tab navigation -->

                <!-- Tab Content -->
                <div class="tab-content">

                  <!-- Tab Pane -->
                  <div id="tab-pane-1" class="tab-pane active">
                    <div class="card-body">
                      
                      <!-- Card -->
                      <div class="dt-card">

                        <!-- Card Body -->
                        <div class="dt-card__body">

                          <!-- Tables -->
                          <div class="table-responsive">

                            <table id="data-table" class="table table-hover dataTable dtr-inline">
                              <thead>
                                <tr class="gradeX">
                                  <th>N&deg;</th>
                                  <th>Razon Social</th>
                                  <th>Ruc</th>
                                  <!--<th>Direccion</th>-->
                                  <th>Estado</th>
                                  <th>Condicion</th>
                                  <th>Agregar</th>
                                  <th>Acciones</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  $objTransportistas = new Transportistas();
                                  $Transportistas = $objTransportistas->transportistas();
                                  if($Transportistas > 0){
                                    $i=0;
                                    foreach ($Transportistas as $transportista){
                                      $i=$i+1;
                                ?>
                                <tr class="gradeX">
                                  <td><?=$i?></td>
                                  <td><?=$transportista['razon_social']?></td>
                                  <td><?=$transportista['ruc']?></td>
                                  <!--<td><?=$transportista['direccion']?></td>-->
                                  <td><?=$transportista['estado']?></td>
                                  <td><?=$transportista['condicion']?></td>
                                  <td>
                                    <a title="Agregar Vehiculo" href="?module=almacen&page=vehiculos&id=<?=$transportista['idtransportistas']?>"><i class="fa fa-fw fa-truck"></i></a>
                                    <a href="?module=almacen&page=conductores&id=<?=$transportista['idtransportistas']?>"><i class="fa fa-fw fa-user-tie"></i></a>
                                  </td>
                                  <td>
                                    <a title="Ver" href="?module=almacen&page=transportistas_ver&id=<?=$transportista['idtransportistas']?>"><i class="fa fa-fw fa-search"></i></a>
                                    <a title="Actualizado: <?=$transportista['actualizado']?>"><i class="fa fa-fw fa-sync-alt"></i></a>
                                    <a title="Eliminar" href="/modulos/almacen/transportistas_eliminar.php?id=<?=$transportista['idtransportistas']?>"><i class="fa fa-fw fa-trash"></i></a>
                                  </td>
                                </tr>
                                <?php
                                    }
                                  }
                                ?>
                              </tbody>
                              <tfoot>
                              <tr>
                                <th colspan="7">&nbsp;</th>
                              </tr>
                              </tfoot>
                            </table>
                            <?php
                              require('js/transportistas.php');
                            ?>

                          </div>
                          <!-- /tables -->

                        </div>
                        <!-- /card body -->

                      </div>
                      <!-- /card -->

                    </div>
                  </div>
                  <!-- /tab pane-->

                  <!-- Tab Pane -->
                  <div id="tab-pane-2" class="tab-pane">
                    <div class="card-body">
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
                                <h3 class="dt-card__title">Nuevo Transportista</h3>
                              </div>
                              <!-- /card heading -->

                            </div>
                            <!-- /card header -->

                            <!-- Card Body -->
                            <div class="dt-card__body">

                              <!-- Form -->
                              <form class="form-inline" action="modulos/almacen/transportistas_guardar.php" method="POST">
                                <div class="form-group mr-2">
                                  <label for="ruc" class="sr-only">Ruc</label>
                                  <input type="text" class="form-control" name="ruc" id="ruc" placeholder="Ingrese Ruc">
                                </div>
                                <div class="form-group">
                                  <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                                </div>
                              </form>
                              <!-- /form -->

                            </div>
                            <!-- /card body -->

                          </div>
                          <!-- /card -->

                        </div>
                        <!-- /grid item -->
                      </div>
                    </div>
                  </div>
                  <!-- /tab pane-->

                </div>
                <!-- /tab content -->

              </div>
              <!-- /card body -->

            </div>
            <!-- /card -->

          </div>
          <!-- /grid item -->

        </div>
        <!-- /grid -->

      </div>
      <!-- /site content -->
<?php
}
else{
  header('Location: ../../login.php');
}
?>