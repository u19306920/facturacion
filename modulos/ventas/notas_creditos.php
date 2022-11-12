<?php
if (isset($principal)) {
  unset($_SESSION['carrito']);
  unset($_SESSION['carro_anticipo']);
  unset($_SESSION['validador']);
  require('class/comprobantes.php');
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
                  <h3 class="dt-card__title">Nota de Crédito</h3><!--Titulo-->
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
                       aria-controls="tab-pane-1" aria-selected="true"><i class="fas fa-file-invoice"></i> Nueva Nota de Crédito
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
                                <h3 class="dt-card__title">Nuevo Comprobante</h3>
                              </div>
                              <!-- /card heading -->

                            </div>
                            <!-- /card header -->

                            <!-- Card Body -->
                            <div class="dt-card__body">

                              <!-- Form -->
                              <form action="modulos/ventas/comprobantes_guardar.php" method="POST">
                                <div class="form-row">
                                  <div class="col-sm-12 mb-3">
                                    <label for="identidades">Cliente:</label><br>
                                    <select class="form-control" id="identidades" name="identidades" required>
                                    </select>
                                    <script type="text/javascript">
                                      $('#identidades').select2({
                                        placeholder: 'Seleccione Cliente',
                                        minimumInputLength: 3,
                                        focus: 1,
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
                                      $(document).on('select2:open', () => {
                                        document.querySelector('.select2-search__field').focus();
                                      });
                                    </script>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#form-cliente">
                                      Nuevo Cliente
                                    </button>
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="fecha_emision">Fecha Emisión</label>
                                    <div class="input-group">
                                      <input type="date" class="form-control" id="fecha_emision" name="fecha_emision" value="<?=date("Y-m-d")?>">
                                    </div>
                                  </div>
                                  
                                  <div class="col-sm-3 mb-3">
                                    <label for="tipo_documento">Tipo de Documento</label>
                                    <select class="form-control" id="tipo_documento" name="tipo_documento">
                                      <option>Seleccione</option>
                                      <option value="01">FACTURA ELECTRONICA</option>
                                      <option value="03">BOLETA DE VENTA</option>
                                    </select>
                                    
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="serie_documento">Serie</label>
                                    <select class="form-control" id="serie_documento" name="serie_documento">
                                    </select>
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
                                  </div>
                                </div>
                                
                                <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Guardar</button>
                              </form>
                              <!-- /form -->
                              
                              <!--CARGAMOS LAS SERIES-->
                              <script type="text/javascript">
                                $(document).ready(function(){
                                  $('#tipo_documento').val(1);
                                  recargarLista();

                                  $('#tipo_documento').change(function(){
                                    recargarLista();
                                  });
                                })
                                function recargarLista(){
                                  $.ajax({
                                    type:"POST",
                                    url:"/modulos/ventas/ajax/series.php",
                                    data:"tipo_documento=" + $('#tipo_documento').val(),
                                    success:function(r){
                                      $('#serie_documento').html(r);
                                    }
                                  });
                                }
                              </script>
                              <!---->

                            </div>
                            <!-- /card body -->
                            <?php
                            require($_SERVER['DOCUMENT_ROOT'].'/modulos/ventas/ajax/clientes.php');
                            ?>
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
    <script type="text/javascript">
      $('#aComprobantes').addClass("active");
    </script>
<?php 
}
else{
  header('Location: ../../login.php');
}
?>