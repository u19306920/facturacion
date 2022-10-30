<?php
if (isset($principal)) {

  require('class/guias.php');
  require('class/ordenes.php');
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
                  <h3 class="dt-card__title">Guías</h3><!--Titulo--><br>
                  <a href="index.php?module=almacen&page=guias&year=<?=date("Y")?>" class="btn btn-sm btn-light"><?=date("Y")?></a>
                  <a href="index.php?module=almacen&page=guias&year=<?=date("Y")-1?>" class="btn btn-sm btn-light"><?=date("Y")-1?></a>
                  <a href="index.php?module=almacen&page=guias&year=<?=date("Y")-2?>" class="btn btn-sm btn-light"><?=date("Y")-2?></a>
                  <a href="index.php?module=almacen&page=guias&year=<?=date("Y")-3?>" class="btn btn-sm btn-light"><?=date("Y")-3?></a>
                  <a href="index.php?module=almacen&page=guias&year=<?=date("Y")-4?>" class="btn btn-sm btn-light"><?=date("Y")-4?></a>
                  <a href="index.php?module=almacen&page=guias&year=<?=date("Y")-5?>" class="btn btn-sm btn-light"><?=date("Y")-5?></a>
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
                       aria-controls="tab-pane-1" aria-selected="true"><i class="fas fa-file-alt"></i> Listado de guías
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-pane-2" role="tab"
                       aria-controls="tab-pane-2" aria-selected="true"><i class="icon icon-add"></i> Nueva Guía
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
                              <tr>
                                <th>N</th>
                                <th>Guia Remisión</th>
                                <th>Cliente</th>
                                <th>Emisión</th>
                                <th>Motivo</th>
                                <th>Comprobante</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                                if (isset($_GET['year'])) {
                                  $anio = $_GET['year'];
                                }
                                else{
                                  $anio = date("Y");
                                }

                                $objGuias = new Guias();
                                $guias = $objGuias->guiaPorAnio($anio);
                                if($guias > 0){
                                  $i=0;
                                  foreach ($guias as $guia){
                                    $i=$i+1;
                              ?>
                              <tr class="gradeX">
                                <td><?=$i?></td>
                                <td><?=$guia['guia']?></td>
                                <td><?=$guia['razon_social_nombres']?></td>
                                <td><?=$guia['fecha_emision']?></td>
                                <td>
                                  <?php
                                    $objTraslado = new Ordenes();
                                    $traslado = $objTraslado->motivo_trasladoPorId($guia['motivo_traslado']);
                                    echo $traslado[0]['descripcion'];
                                  ?>
                                </td>
                                <td><?=$guia['comprobante']?></td>
                                <td>
                                  <?php
                                    if($guia['estado']==0){
                                    ?>
                                    <button class="btn btn-xs btn-default">Borrador</button>
                                    <?php
                                    }
                                    if($guia['estado']==1){
                                    ?>
                                    <button class="btn btn-xs btn-warning">Emitido</button>
                                    <?php
                                    }
                                    if($guia['estado']==2){
                                    ?>
                                    <button class="btn btn-xs btn-info">Impreso</button>
                                    <?php
                                    }
                                    if($guia['estado']==3){
                                    ?>
                                    <button class="btn btn-xs btn-success">Con Factura</button>
                                    <?php
                                    }
                                    if($guia['estado']==4){
                                    ?>
                                    <button class="btn btn-xs btn-danger">Anulado</button>
                                    <?php
                                    }
                                  ?>
                                </td>
                                <td>
                                  <?php
                                    if($guia['estado']==0){
                                    ?>
                                      <a title="Agregar Items" href="?module=almacen&page=guias_detalles_agregar&id=<?=$guia['idguias']?>"><i class="fa fa-fw fa-plus"></i></a>
                                      <a title="Eliminar" href="/modulos/almacen/guias_eliminar.php?id=<?=$guia['idguias']?>"><i class="fa fa-fw fa-trash"></i></a>
                                    <?php
                                    }
                                    if($guia['estado']==1){
                                    ?>
                                      <!--<a title="Imprimir" href="/modulos/almacen/reportes/guia_remision.php?id=<?=$guia['idguias']?>&e=2" target="_blank"><i class="fa fa-fw fa-print"></i></a>-->
                                      <a title="Ver" href="?module=almacen&page=guias_detalles_ver&id=<?=$guia['idguias']?>"><i class="fa fa-fw fa-search"></i></a>
                                    <?php
                                    }
                                    if($guia['estado']==2 ){
                                    ?>
                                      <a class="btn btn-xs btn-default" title="Imprimir" href="/modulos/almacen/reportes/guia_remision.php?id=<?=$guia['idguias']?>&e=2" target="_blank"><i class="fa fa-fw fa-print"></i></a>
                                      <a class="btn btn-xs btn-danger" onclick="return confirm('Desea anular el registro')" title="Anular" href="modulos/almacen/guias_anular.php?id=<?=$guia['idguias']?>"><i class="fa fa-fw fa-ban"></i></a>
                                    <?php
                                    }
                                    if($guia['estado']==3){
                                    ?>
                                      <a class="btn btn-xs btn-default" title="Imprimir" href="/modulos/almacen/reportes/guia_remision.php?id=<?=$guia['idguias']?>&e=3" target="_blank"><i class="fa fa-fw fa-print"></i></a>
                                      
                                    <?php
                                    }
                                    if($guia['estado']==4){
                                    ?>
                                      <a class="btn btn-xs btn-danger" title="Eliminar" onclick="return confirm('¿Desea Eliminar la Guia?')" href="/modulos/almacen/guias_eliminar.php?id=<?=$guia['idguias']?>" target="_blank"><i class="fa fa-fw fa-trash"></i></a>
                                      
                                    <?php
                                    }
                                    ?>
                                </td>
                              </tr>
                              <?php
                                  }
                                }
                              ?>
                              </tbody>
                              <tfoot>
                              <tr>
                                <th colspan="8">&nbsp;</th>
                              </tr>
                              </tfoot>
                            </table>
                            <?php
                              require('js/guias.php');
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
                                <h3 class="dt-card__title">Nueva Guía</h3>
                              </div>
                              <!-- /card heading -->

                            </div>
                            <!-- /card header -->

                            <!-- Card Body -->
                            <div class="dt-card__body">

                              <!-- Form -->
                              <form action="modulos/almacen/guias_guardar.php" method="POST">
                                <div class="form-row">

                                  <div class="col-sm-3 mb-3">
                                    <label for="fecha_emision">Fecha Emisión:</label>
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="inputGroupPrepend2"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" class="form-control" id="fecha_emision" name="fecha_emision" value="<?=date("Y-m-d")?>">
                                      </div>
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="fecha_traslado">Fecha Traslado:</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="far fa-calendar-alt"></i></span>
                                      </div>
                                      <input type="date" class="form-control" id="fecha_traslado" name="fecha_traslado" value="<?=date("Y-m-d")?>">
                                    </div>
                                  </div>
                                  <div class="col-sm-6 mb-3">
                                    <label for="motivo_traslado">Motivo de Traslado:</label>
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
                                </div>
                                <div class="form-row">
                                  <div class="col-sm-12 mb-3">
                                    <label for="identidades">Cliente:</label>
                                    <br>
                                    <select class="form-control" id="identidades" name="identidades" required>
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
                                      $(document).on('select2:open', () => {
                                        document.querySelector('.select2-search__field').focus();
                                      });
                                    </script>
                                    <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#form-cliente">
                                      Nuevo Cliente
                                    </button>
                                    
                                  </div>
                                  <div class="col-sm-12 mb-3">
                                    <label for="iddirecciones">Dirección:</label>
                                    <select class="form-control" id="iddirecciones" name="iddirecciones" required="required" style="text-transform: uppercase;">
                                    </select>
                                  </div>
                                </div>
                                <div class="form-row"> 
                                  <div class="col-sm-3 mb-3">
                                    <label for="serie_guia">Serie Guía:</label>
                                    <select class="form-control" id="simple-select" name="serie_guia">
                                      <option value="0001">0001</option>
                                      <option value="0002">0002</option>
                                      <option value="0003">0003</option>
                                      <option value="0004">0004</option>
                                    </select>
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="numero_guia">Numero Guía:</label>
                                    <div class="input-group">
                                      <input type="text" class="form-control" id="numero_guia" name="numero_guia" required>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-row">
                                  <div class="col-sm-3 mb-3">
                                    <label for="tipo_documento">Tipo Documento:</label>
                                    <select class="form-control" id="simple-select" name="tipo_documento">
                                      <option value="00">NINGUNO</option>
                                      <option value="01">FACTURA ELECTRONICA</option>
                                      <option value="03">BOLETA ELECTRONICA</option>
                                    </select>
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="serie_documento">Serie Documento:</label>
                                    <div class="input-group">
                                      <input type="text" class="form-control" id="serie_documento" name="serie_documento" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="numero_documento">Numero Documento:</label>
                                    <div class="input-group">
                                      <input type="text" class="form-control" id="numero_documento" name="numero_documento" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="fecha_documento">Fecha Documento:</label>
                                    <div class="input-group">
                                      <input type="date" class="form-control" id="fecha_documento" name="fecha_documento" value="<?=date("Y-m-d")?>" required>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-row">
                                  
                                  <div class="col-sm-12 mb-3">
                                    <label for="idtransportistas">Transportista:</label>
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
                                    <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#form-transportista">
                                      Nuevo Transportista
                                    </button>
                                  </div>
                                  <div class="col-sm-6 mb-3">
                                    <label for="idvehiculos">Vehículo:</label>
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
                                <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Guardar</button>
                              </form>
                              <!-- /form -->
                              <!--CARGAMOS LAS DIRECCIONES POR CADA CLIENTE-->
                              <script type="text/javascript">
                                $(document).ready(function(){
                                  $('#identidades').val(1);
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

                            </div>
                            <!-- /card body -->

                            
                            <?php
                            require($_SERVER['DOCUMENT_ROOT'].'/modulos/ventas/ajax/clientes.php');
                            ?>
                            <?php
                            require($_SERVER['DOCUMENT_ROOT'].'/modulos/almacen/ajax/transportistas2.php');
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
<?php 
}
else{
  header('Location: ../../login.php');
}
?>