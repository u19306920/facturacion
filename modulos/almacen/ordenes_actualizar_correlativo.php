<?php
if (isset($principal)) {
  require('class/ordenes.php');
  $idordenes = $_GET['id'];
  $objOrdenes = new Ordenes();
  $orden = $objOrdenes->ordenPorId($idordenes);
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
                  <h3 class="dt-card__title">Editar Correlativo</h3><!--Titulo-->
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
                       aria-controls="tab-pane-1" aria-selected="true"><i class="fas fa-file"></i> <?=$orden[0]['orden']?>
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
                                <h3 class="dt-card__title">Editar Correlativo Orden de Trabajo</h3>

                              </div>
                              <!-- /card heading -->

                            </div>
                            <!-- /card header -->

                            <!-- Card Body -->
                            <div class="dt-card__body">
                              <h4><?=$orden[0]['razon_social_nombres']?></h4>
                              <!-- Form -->
                              <form action="modulos/almacen/ordenes_actualizar_guardarC.php" method="POST">
                                <div class="form-row">
                                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12 mb-3">
                                    <label for="serie">Serie</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2">@</span>
                                      </div>
                                      <input type="text" class="form-control" id="serie" name="serie" value="<?=$orden[0]['orden_serie']?>-<?=$orden[0]['anio']?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12 mb-3">
                                    <label for="correlativo">Correlativo</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-hashtag"></i></span>
                                      </div>
                                      <input type="text" class="form-control" id="correlativo" name="correlativo" value="<?=$orden[0]['correlativo']?>">
                                      <input type="hidden" class="form-control" id="idordenes" name="idordenes" value="<?=$orden[0]['idordenes']?>">
                                    </div>
                                  </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Actualizar</button>
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