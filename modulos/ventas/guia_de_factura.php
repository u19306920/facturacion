<?php
if (isset($principal)) {
  $idcomprobantes = $_GET['id'];
  require('class/guias.php');
  require('class/ordenes.php');

  $objGuiaF = new Guias();
  $Datos = $objGuiaF->guiaDeFactura($idcomprobantes);
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
                  <h3 class="dt-card__title">Emisión de Guía</h3><!--Titulo-->
                </div>
                <!-- /card heading -->

              </div>
              <!-- /card header -->

              <!-- Card Body -->
              <div class="dt-card__body tabs-container">

                <!-- Tab Navigation -->
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tab-pane-1" role="tab" aria-controls="tab-pane-1" aria-selected="true"><i class="fas fa-file-alt"></i> Guía desde Factura <?=$Datos[0]['comprobante']?>
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
                                <!--<h3 class="dt-card__title">Nueva Guia</h3>-->
                              </div>
                              <!-- /card heading -->

                            </div>
                            <!-- /card header -->

                            <!-- Card Body -->
                            <div class="dt-card__body">

                              <!-- Form -->
                              <form action="modulos/ventas/guia_de_factura_guardar.php" method="POST">
                                <div class="form-row">

                                  <div class="col-sm-3 mb-3">
                                    <label for="fecha_emision">Fecha Emisión</label>
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="inputGroupPrepend2"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" class="form-control" id="fecha_emision" name="fecha_emision" value="<?=date("Y-m-d")?>" min="<?=$Datos[0]['fecha_de_emision']?>">
                                      </div>
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="fecha_traslado">Fecha Traslado</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="far fa-calendar-alt"></i></span>
                                      </div>
                                      <input type="date" class="form-control" id="fecha_traslado" name="fecha_traslado" value="<?=date("Y-m-d")?>">
                                    </div>
                                  </div>
                                  <div class="col-sm-6 mb-3">
                                    <label for="motivo_traslado">Motivo de Traslado</label>
                                    <select class="form-control" id="simple-select" name="motivo_traslado">
                                      <?php
                                      $objMotivo = new Ordenes();
                                      $motivos = $objMotivo->motivo_traslado();
                                      if($motivos > 0){
                                        $i=0;
                                        foreach ($motivos as $motivo){
                                          $i=$i+1;
                                      ?>
                                      <option value="<?=$motivo['idmotivo_de_traslado']?>"><?=$motivo['descripcion']?></option>
                                      <?php
                                        }
                                      }
                                      ?>
                                    </select>
                                  </div>
                                  <div class="col-sm-12 mb-3">
                                    <label for="identidades">Cliente:</label><br>
                                    <!--<pre>
                                    <?php //print_r($Datos) ?>
                                    </pre>
                                    -->
                                    <input type="hidden" name="identidades" id="identidades" value="<?=$Datos[0]['identidades']?>">
                                    <?=$Datos[0]['razon_social_nombres']?>
                                    <input type="hidden" name="idcomprobantes" value="<?=$idcomprobantes?>">
                                  </div>
                                  <div class="col-sm-12 mb-3">
                                    <label for="iddirecciones">Direccion:</label>
                                    <select class="form-control" id="iddirecciones" name="iddirecciones" required="required" style="text-transform: uppercase;">
                                    </select>
                                  </div>
                                 
                                  <div class="col-sm-3 mb-3">
                                    <label for="serie_guia">Serie</label>
                                    <select class="form-control" id="simple-select" name="serie_guia">
                                      <option value="0001">0001</option>
                                      <option value="0002">0002</option>
                                      <option value="0003">0003</option>
                                      <option value="0004">0004</option>
                                    </select>
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="numero_guia">Numero Guia</label>
                                    <div class="input-group">
                                      <input type="text" class="form-control" id="numero_guia" name="numero_guia" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="tipo_documento">Tipo Documento</label>
                                    <select class="form-control" id="simple-select" name="tipo_documento1" disabled>
                                      <option value="00">NINGUNO</option>
                                      <option value="01" <?php if($Datos[0]['codigo_tipo_documento']=="01"){ echo "selected";}?>>FACTURA ELECTRONICA</option>
                                      <option value="03" <?php if($Datos[0]['codigo_tipo_documento']=="03"){ echo "selected";}?>>BOLETA ELECTRONICA</option>
                                    </select>
                                    <input type="hidden" name="tipo_documento" value="<?=$Datos[0]['codigo_tipo_documento']?>">
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="numero_documento">Numero Documento</label>
                                    <div class="input-group">
                                      <input type="text" class="form-control" id="numero_documento" name="numero_documento" value="<?=$Datos[0]['comprobante']?>" readonly>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-row">
                                  
                                  <div class="col-sm-12 mb-3">
                                    <label for="idtransportistas">Transportista:</label><br>
                                    <select class="form-control" id="idtransportistas" name="idtransportistas" required>
                                    </select>
                                    <script type="text/javascript">
                                      $('#idtransportistas').select2({
                                        placeholder: 'Seleccione Transportista',
                                        minimumInputLength: 3,
                                        ajax: {
                                          url: 'modulos/almacen/ajax/transportistas.php',
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
                                  <div class="col-sm-6 mb-3">
                                    <label for="idvehiculos">Vehiculo:</label>
                                    <select class="form-control" id="idvehiculos" name="idvehiculos" required="required" style="text-transform: uppercase;">
                                    </select>
                                  </div>
                                  
                                  <div class="col-sm-6 mb-3">
                                    <label for="idconductores">Conductor:</label>
                                    <select class="form-control" id="idconductores" name="idconductores" required="required" style="text-transform: uppercase;">
                                    </select>
                                  </div>
                                  <div class="col-sm-12 mb-3">
                                    <label for="idconductores">Observación:</label>
                                    <textarea rows="2" class="form-control" name="observacion"></textarea>
                                  </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Guardar</button>
                              </form>
                              <!-- /form -->
                              <!--CARGAMOS LAS DIRECCIONES POR CADA CLIENTE-->
                              <script type="text/javascript">
                                $(document).ready(function(){
                                  $('#identidades').val(<?=$Datos[0]['identidades']?>);
                                  recargarLista();

                                  $('#identidades').change(function(){
                                    recargarLista();
                                  });
                                })
                                function recargarLista(){
                                  $.ajax({
                                    type:"POST",
                                    url:"/modulos/almacen/ajax/direcciones.php",
                                    data:"cliente=" + $('#identidades').val(),
                                    success:function(r){
                                      $('#iddirecciones').html(r);
                                    }
                                  });
                                }
                              </script>
                              <!---->
                              <!--CARGAMOS LOS VEHICULOS POR CADA TRANSPORTISTA-->
                              <script type="text/javascript">
                                $(document).ready(function(){
                                  $('#idtransportistas').val(1);
                                  recargarLista2();

                                  $('#idtransportistas').change(function(){
                                    recargarLista2();
                                  });
                                })
                                function recargarLista2(){
                                  $.ajax({
                                    type:"POST",
                                    url:"/modulos/almacen/ajax/vehiculos.php",
                                    data:"transportista=" + $('#idtransportistas').val(),
                                    success:function(r){
                                      $('#idvehiculos').html(r);
                                    }
                                  });
                                }
                              </script>
                              <!---->
                              <!--CARGAMOS LOS CONDUCTORES POR CADA TRANSPORTISTA-->
                              <script type="text/javascript">
                                $(document).ready(function(){
                                  $('#idtransportistas').val(1);
                                  recargarLista3();

                                  $('#idtransportistas').change(function(){
                                    recargarLista3();
                                  });
                                })
                                function recargarLista3(){
                                  $.ajax({
                                    type:"POST",
                                    url:"/modulos/almacen/ajax/conductores.php",
                                    data:"transportista=" + $('#idtransportistas').val(),
                                    success:function(r){
                                      $('#idconductores').html(r);
                                    }
                                  });
                                }
                              </script>

                              <!-- Tables -->
                              <div class="table-responsive">

                                <table id="data-table" class="table table-hover dataTable dtr-inline">
                                  <thead>
                                    <tr>
                                      <th>N&deg;</th>
                                      <th>Orden</th>
                                      <th>Item</th>
                                      <th>U.M</th>
                                      <th>Cantidad</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    $i=1;
                                      foreach ($Datos as $linea){                                  
                                    ?>
                                        <tr class="gradeX">
                                          <td><?=$i?></td>
                                          <td><?=$linea['orden']?></td>
                                          <td><?=$linea['descripcion']?></td>
                                          <td><?=$linea['um']?></td>
                                          <td><?=number_format($linea['cantidad'],'2','.',',')?></td>
                                        </tr>
                                    <?php
                                    $i++;
                                      }
                                    ?>
                                  </tbody>
                                  <tfoot>
                                    <tr>
                                      <th colspan="9">&nbsp;</th>
                                    </tr>
                                  </tfoot>
                                </table>
                                <?php
                                  require('js/comprobantes_detalles_agregar.php');
                                ?>
                                
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