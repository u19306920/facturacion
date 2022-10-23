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
                  <h3 class="dt-card__title">Editar Orden de Trabajo</h3><!--Titulo-->
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
                                <h3 class="dt-card__title">Editar Orden de Trabajo</h3>
                              </div>
                              <!-- /card heading -->

                            </div>
                            <!-- /card header -->

                            <!-- Card Body -->
                            <div class="dt-card__body">

                              <!-- Form -->
                              <form action="modulos/almacen/ordenes_actualizar_guardar.php" method="POST">
                                <div class="form-row">
                                  <div class="col-sm-12 mb-3">
                                    <label for="identidades">Cliente</label>
                                    <select class="form-control" id="identidades" name="identidades">
                                      <option value="<?=$orden[0]['identidades']?>" selected><?=$orden[0]['razon_social_nombres']?></option>
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
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2">@</span>
                                      </div>
                                      <input type="date" class="form-control" id="fecha_emision" name="fecha_emision" value="<?=$orden[0]['fecha_emision']?>">
                                    </div>
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="fecha_entrega">Fecha Entrega</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2">@</span>
                                      </div>
                                      <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" value="<?=$orden[0]['fecha_entrega']?>">
                                    </div>
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="idordenes_tipos">Tipo de Orden</label>
                                    <select class="form-control" id="simple-select" name="idordenes_tipos">
                                      <?php
                                      $objOrdenes_tipos = new Ordenes;
                                      $ordenes_tipos = $objOrdenes_tipos->orden_tipo();
                                      if($ordenes_tipos > 0){
                                        $i=0;
                                        foreach ($ordenes_tipos as $orden_tipo){
                                          $i=$i+1;
                                      ?>
                                      <option value="<?=$orden_tipo['idordenes_tipos']?>" <?php if($orden[0]['idordenes_tipos']==$orden_tipo['idordenes_tipos']){ echo "selected";}?>><?=$orden_tipo['orden_tipo']?></option>
                                      <?php
                                        }
                                      }
                                      ?>
                                    </select>
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="vendedor">Vendedor</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2">@</span>
                                      </div>
                                      <input type="text" class="form-control" id="vendedor" name="vendedor" value="<?=$orden[0]['vendedor']?>">
                                    </div>
                                  </div>
                                </div>
                                <div class="form-row">
                                  <div class="col-sm-3 mb-3">
                                    <label for="cotizacion">Cotizacion</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2">@</span>
                                      </div>
                                      <input type="text" class="form-control" id="cotizacion" name="cotizacion" value="<?=$orden[0]['cotizacion']?>">
                                    </div>
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="orden_compra">Orden de Compra</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2">@</span>
                                      </div>
                                      <input type="text" class="form-control" id="orden_compra" name="orden_compra" value="<?=$orden[0]['orden_compra']?>">
                                    </div>
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="formapago">Forma de Pago</label>
                                    <select class="form-control" id="simple-select" name="formapago">
                                      <?php
                                      $objFormapago = new Ordenes();
                                      $formapagos = $objFormapago->metodos_de_pago();
                                      if($formapagos > 0){
                                        $i=0;
                                        foreach ($formapagos as $formapago){
                                          $i=$i+1;
                                      ?>
                                      <option value="<?=$formapago['idmetodo_de_pago']?>" <?php if($orden[0]['tipo_metodo_pago']==$formapago['idmetodo_de_pago']){ echo "selected";}?> ><?=$formapago['descripcion']?></option>
                                      <?php
                                        }
                                      }
                                      ?>
                                    </select>
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="moneda">Moneda</label>
                                    <select class="form-control" id="simple-select" name="moneda">
                                      <?php
                                      $objMonedas = new Ordenes();
                                      $monedas = $objMonedas->monedas();
                                      if($monedas > 0){
                                        $i=0;
                                        foreach ($monedas as $moneda){
                                          $i=$i+1;
                                      ?>
                                      <option value="<?=$moneda['iso']?>" <?php if($orden[0]['moneda']==$moneda['iso']){ echo "selected";}?> ><?=$moneda['descripcion']?></option>
                                      <?php
                                        }
                                      }
                                      ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-row">
                                  <div class="col-sm-3 mb-3">
                                    <label for="exportacion">Tipo Venta</label>
                                    <select class="form-control" id="exportacion" name="exportacion">
                                      <option value="0" <?php if($orden[0]['exportacion']==0){ echo "selected";}?> >Nacional</option>
                                      <option value="1" <?php if($orden[0]['exportacion']==1){ echo "selected";}?> >Exportación</option>
                                    </select>
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="validationDefault02">Estado</label>
                                    <select class="form-control" id="simple-select">
                                      <option value="1">Activo</option>
                                      <option value="0">Inactivo</option>
                                    </select>
                                    <input type="hidden" name="idordenes" value="<?=$orden[0]['idordenes']?>">
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