<?php
if (isset($principal)) {
  $idcomprobantes = $_GET['id'];
  require('class/comprobantes.php');

  $objComprobantes = new Comprobantes();
  $info = $objComprobantes->comprobantePorId($idcomprobantes);
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
                  <h3 class="dt-card__title"></h3><!--Titulo-->
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
                       aria-controls="tab-pane-1" aria-selected="true"><i class="fas fa-file-invoice"></i> Editar Comprobantes <?=$info[0]['comprobante']?>
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
                                <h3 class="dt-card__title">Editar Comprobante</h3>
                              </div>
                              <!-- /card heading -->

                            </div>
                            <!-- /card header -->

                            <!-- Card Body -->
                            <div class="dt-card__body">

                              <!-- Form -->
                              <form action="modulos/ventas/comprobantes_editar_guardar.php" method="POST">
                                <div class="form-row">
                                  <div class="col-sm-12 mb-3">
                                    <label for="identidades">Cliente:</label><br>
                                    <select class="form-control" id="identidades" name="identidades" required>
                                      <option value="<?=$info[0]['identidades']?>"><?=$info[0]['razon_social_nombres']?></option>
                                    </select>
                                    <script type="text/javascript">
                                      $('#identidades').select2({
                                        placeholder: 'Seleccione Cliente',
                                        minimumInputLength: 3,
                                        ajax: {
                                          url: 'modulos/almacen/ajax/clientes.php',
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
                                    <label for="fecha_emision">Fecha Emisión</label>
                                    <div class="input-group">
                                      <input type="date" class="form-control" id="fecha_emision" name="fecha_emision" value="<?=$info[0]['fecha_de_emision']?>">
                                    </div>
                                  </div>
                                  
                                  <div class="col-sm-3 mb-3">
                                    <label for="tipo_operacion">Tipo de Operación</label>
                                    <select class="form-control" id="tipo_operacion" name="tipo_operacion" required>
                                      <option value="">SELECCIONE</option>
                                      <option value="0101">VENTA</option>
                                      <option value="0200">EXPORTACION DE BIENES</option>
                                      <option value="0401">VENTAS NO DOMICILIADOS QUE NO CALIFICAN COMO EXPORTACION</option>
                                      <option value="1001">OPERACION SUJETA A DETRACCION</option>
                                    </select>
                                    <input type="hidden" name="idcomprobantes" value="<?=$info[0]['idcomprobantes']?>">
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

                  <!-- Tab Pane -->
                  
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
    <script type="text/javascript">
      $('#aComprobantes').addClass("active");
    </script>
<?php 
}
else{
  header('Location: ../../login.php');
}
?>