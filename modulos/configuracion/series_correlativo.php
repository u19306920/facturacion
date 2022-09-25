<?php
if (isset($principal)) {
  require('class/comprobantes_series.php');
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
                  <h3 class="dt-card__title">Correlativo de Series de Comprobantes</h3><!--Titulo-->
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
                       aria-controls="tab-pane-1" aria-selected="true"><i class="fas fa-file"></i> Listado Correlativos de Series
                    </a>
                  </li>
                  <!--
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-pane-2" role="tab"
                       aria-controls="tab-pane-2" aria-selected="true"><i class="icon icon-add"></i> Nueva Serie
                    </a>
                  </li>
                -->
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

                            <table id="data-table2" class="table table-hover dataTable dtr-inline">
                              <thead>
                                <tr class="gradeX">
                                  <th>Tipo de Comprobante</th>
                                  <th>Serie</th>
                                  <th>Numero actual</th>
                                  <th>Estado</th>
                                  <th>Acciones</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  $objSeries = new Comprobantes_series();
                                  $Series = $objSeries->comprobantes_series();
                                  if($Series > 0){
                                    $i=0;
                                    foreach ($Series as $serie){
                                      $i=$i+1;
                                ?>
                                <tr class="gradeX">
                                  <td>
                                    <?php
                                      switch ($serie['tipo_documento']) {
                                        case '01':
                                          echo "FACTURA";
                                          break;
                                        case '03':
                                          echo "BOLETA";
                                          break;
                                        case '07':
                                          echo "NOTA DE CREDITO";
                                          break;
                                        case '08':
                                          echo "NOTA DE DEBITO";
                                          break;
                                        default:
                                          echo $serie['tipo_documento'];
                                          break;
                                      }
                                    ?>
                                  </td>
                                  <td><?=$serie['serie_documento']?></td>
                                  <td>
                                    <?php echo str_pad($serie['numero_actual'],8, "0", STR_PAD_LEFT); ?>
                                  </td>
                                  <td>
                                    <?php
                                    if ($serie['estado']) {
                                      echo "Activo";
                                    }
                                    else {
                                      echo "Inactivo";
                                    }
                                    ?>
                                  </td>
                                  <td>
                                    <a title="Editar" href="?module=configuracion&page=series_editar&id=<?=$serie['idcomprobantes_series']?>" ><i class="fa fa-fw fa-pen"></i></a>
                                    <a title="Eliminar" href="/modulos/configuracion/series_eliminar.php?id=<?=$serie['idcomprobantes_series']?>"><i class="fa fa-fw fa-trash"></i></a>
                                  </td>
                                </tr>
                                <?php
                                    }
                                  }
                                ?>
                              </tbody>
                              <tfoot>
                              <tr>
                                <th colspan="5">&nbsp;</th>
                              </tr>
                              </tfoot>
                            </table>
                            <?php
                              require('js/series.php');
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
                  <!--
                  <div id="tab-pane-2" class="tab-pane">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-12">
                          <div class="dt-card">
                            <div class="dt-card__header">
                              <div class="dt-card__heading">
                                <h3 class="dt-card__title">Nuevo Tipo de Cambio</h3>
                              </div>
                            </div>
                            <div class="dt-card__body">
                              <form action="modulos/configuracion/tipo_cambio_guardar.php" method="POST">
                                <div class="form-row">
                                  <div class="col-sm-3 mb-3">
                                    <label for="fecha">Fecha:</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="far fa-calendar-alt"></i></span>
                                      </div>
                                      <input type="date" class="form-control" id="fecha" name="fecha" value="<?=date("Y-m-d")?>">
                                    </div>
                                  </div>
                                </div>
                                <div class="form-row">
                                  <div class="col-sm-3 mb-3">
                                    <label for="compra">Compra:</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-money-bill-alt"></i></span>
                                      </div>
                                      <input type="text" class="form-control" id="compra" name="compra" value="">
                                    </div>
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="venta">Venta:</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-money-bill-alt"></i></span>
                                      </div>
                                      <input type="text" class="form-control" id="venta" name="venta" value="">
                                    </div>
                                  </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Guardar</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  -->
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