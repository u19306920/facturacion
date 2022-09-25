<?php
if (isset($principal)) {
  require('class/tipo_cambio.php');
  $objTipoCambio = new Tipos_cambios();
  $tipo_cambio = $objTipoCambio->tipo_cambioPorId($_GET['id']);
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
                  <h3 class="dt-card__title">Tipo de Cambio</h3><!--Titulo-->
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
                       aria-controls="tab-pane-1" aria-selected="true"><i class="icon icon-add icon-xl"></i> Nuevo Tipo de Cambio
                    </a>
                  </li>
                </ul>
                <!-- /tab navigation -->

                <!-- Tab Content -->
                <div class="tab-content">
                  <!-- Tab Pane -->
                  <div id="tab-pane-1" class="tab-pane active">
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
                                <h3 class="dt-card__title">Editar Tipo de Cambio</h3>
                              </div>
                              <!-- /card heading -->

                            </div>
                            <!-- /card header -->

                            <!-- Card Body -->
                            <div class="dt-card__body">

                              <!-- Form -->
                              <form action="modulos/configuracion/tipo_cambio_editar_guardar.php" method="POST">
                                <div class="form-row">
                                  <div class="col-sm-3 mb-3">
                                    <label for="fecha">Fecha:</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="far fa-calendar-alt"></i></span>
                                      </div>
                                      <input type="date" class="form-control" id="fecha" name="fecha" value="<?=$tipo_cambio[0]['fecha']?>" readonly>
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
                                      <input type="text" class="form-control" id="compra" name="compra" value="<?=$tipo_cambio[0]['compra']?>">
                                    </div>
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="venta">Venta:</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-money-bill-alt"></i></span>
                                      </div>
                                      <input type="text" class="form-control" id="venta" name="venta" value="<?=$tipo_cambio[0]['venta']?>">
                                      <input type="hidden" name="idtipo_cambio" value="<?=$tipo_cambio[0]['idtipo_cambio']?>">
                                    </div>
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