<?php
if (isset($principal)) {
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
                  <h3 class="dt-card__title">Ordenes de Trabajo</h3><!--Titulo--><br>
                  <a href="index.php?module=almacen&page=ordenes&year=<?=date("Y")?>" class="btn btn-sm btn-light"><?=date("Y")?></a>
                  <a href="index.php?module=almacen&page=ordenes&year=<?=date("Y")-1?>" class="btn btn-sm btn-light"><?=date("Y")-1?></a>
                  <a href="index.php?module=almacen&page=ordenes&year=<?=date("Y")-2?>" class="btn btn-sm btn-light"><?=date("Y")-2?></a>
                  <a href="index.php?module=almacen&page=ordenes&year=<?=date("Y")-3?>" class="btn btn-sm btn-light"><?=date("Y")-3?></a>
                  <a href="index.php?module=almacen&page=ordenes&year=<?=date("Y")-4?>" class="btn btn-sm btn-light"><?=date("Y")-4?></a>
                  <a href="index.php?module=almacen&page=ordenes&year=<?=date("Y")-5?>" class="btn btn-sm btn-light"><?=date("Y")-5?></a>
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
                       aria-controls="tab-pane-1" aria-selected="true"><i class="fas fa-file"></i> Lista de Ordenes
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-pane-2" role="tab"
                       aria-controls="tab-pane-2" aria-selected="true"><i class="icon icon-add"></i> Nueva Orden
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
                                  <th>Orden</th>
                                  <th>Cliente</th>
                                  <th>Emision</th>
                                  <th>Entrega</th>
                                  <th>Moneda</th>
                                  <th>Total</th>
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
                                  $objOrdenes = new Ordenes();
                                  $ordenes = $objOrdenes->ordenPorAnio($anio);
                                  if($ordenes > 0){
                                    $i=0;
                                    foreach ($ordenes as $orden){
                                      $i=$i+1;
                                ?>
                                <tr class="gradeX">
                                  <td><?=$i?></td>
                                  <td><?=$orden['orden']?></td>
                                  <td><?=$orden['razon_social_nombres']?></td>
                                  <td><?=$orden['fecha_emision']?></td>
                                  <td><?=$orden['fecha_entrega']?></td>
                                  <td style="text-align: center;"><?=$orden['moneda']?></td>
                                  <td><?=number_format($orden['monto'],2,'.',',')?></td>
                                  <td>
                                    <?php
                                    if($orden['estado']==0){
                                    ?>
                                    <button class="btn btn-xs btn-default">Borrador</button>
                                    <?php
                                    }
                                    if($orden['estado']==1){
                                    ?>
                                    <button class="btn btn-xs btn-secondary">Emitido</button>
                                    <?php
                                    }
                                    if($orden['estado']==2){
                                    ?>
                                    <button class="btn btn-xs btn-info">Aprobado</button>
                                    <?php
                                    }
                                    if($orden['estado']==3){
                                    ?>
                                    <button class="btn btn-xs btn-success">Cerrado</button>
                                    <?php
                                    }
                                    if($orden['estado']==4){
                                    ?>
                                    <button class="btn btn-xs btn-danger">Anulado</button>
                                    <?php
                                    }
                                    if($orden['estado']==7){
                                    ?>
                                    <button class="btn btn-xs btn-warning">Facturado</button>
                                    <?php
                                    }
                                  ?>
                                  </td>
                                  <td>
                                    <?php
                                    if($orden['estado']==0){
                                    ?>
                                      <a title="Agregar Items" href="?module=almacen&page=ordenes_detalles_ver&id=<?=$orden['idordenes']?>"><i class="fa fa-fw fa-plus"></i></a>
                                      <a title="Correlativo" href="?module=almacen&page=ordenes_actualizar_correlativo&id=<?=$orden['idordenes']?>" ><i class="fas fa-hashtag"></i></a>
                                      <a title="Editar" href="?module=almacen&page=ordenes_actualizar&id=<?=$orden['idordenes']?>" ><i class="fa fa-fw fa-pen"></i></a>
                                      <a title="Eliminar" href="/modulos/almacen/ordenes_eliminar.php?id=<?=$orden['idordenes']?>"><i class="fa fa-fw fa-trash"></i></a>
                                    <?php
                                    }
                                    if($orden['estado']==1){
                                    ?>
                                      <a title="Aprobar" href="/modulos/almacen/ordenes_cambiar_estado.php?id=<?=$orden['idordenes']?>&e=2"><i class="fa fa-fw fa-check"></i></a>
                                      <a title="Actualizar" href="?module=almacen&page=ordenes_detalles_ver&id=<?=$orden['idordenes']?>"><i class="fa fa-fw fa-search"></i></a>
                                    <?php
                                    }
                                    if($orden['estado']>=2){
                                    ?>
                                      <a title="Ver" href="?module=almacen&page=ordenes_detalles_ver&id=<?=$orden['idordenes']?>"><i class="fa fa-fw fa-search"></i></a>
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
                                <th colspan="9">&nbsp;</th>
                              </tr>
                              </tfoot>
                            </table>
                            <?php
                              require('js/ordenes.php');
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
                                <h3 class="dt-card__title">Nueva Orden de Trabajo</h3>
                              </div>
                              <!-- /card heading -->

                            </div>
                            <!-- /card header -->

                            <!-- Card Body -->
                            <div class="dt-card__body">

                              <!-- Form -->
                              <form action="modulos/almacen/ordenes_guardar.php" method="POST">
                                <div class="form-row">
                                  <div class="col-sm-12 mb-3">
                                    <label for="identidades">Cliente:</label><br>
                                    <select class="form-control" id="identidades" name="identidades">
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
                                  <div class="col-sm-3 mb-3">
                                    <label for="fecha_emision">Fecha Emisión</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="far fa-calendar-alt"></i></span>
                                      </div>
                                      <input type="date" class="form-control" id="fecha_emision" name="fecha_emision" value="<?=date("Y-m-d")?>">
                                    </div>
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="fecha_entrega">Fecha Entrega</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="far fa-calendar-alt"></i></span>
                                      </div>
                                      <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" value="<?=date("Y-m-d")?>">
                                    </div>
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="idordenes_tipos">Tipo de Orden</label>
                                    <select class="form-control" id="simple-select" name="idordenes_tipos">
                                      <?php
                                      $objOrdenes_tipos = new Ordenes();
                                      $ordenes_tipos = $objOrdenes_tipos->orden_tipo();
                                      if($ordenes_tipos > 0){
                                        $i=0;
                                        foreach ($ordenes_tipos as $orden_tipo){
                                          $i=$i+1;
                                      ?>
                                      <option value="<?=$orden_tipo['idordenes_tipos']?>"><?=$orden_tipo['orden_tipo']?></option>
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
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="far fa-user"></i></span>
                                      </div>
                                      <input type="text" class="form-control" id="vendedor" name="vendedor" value="Oficina">
                                    </div>
                                  </div>
                                </div>
                                <div class="form-row">
                                  <div class="col-sm-3 mb-3">
                                    <label for="cotizacion">Cotizacion</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-file-alt"></i></span>
                                      </div>
                                      <input type="text" class="form-control" id="cotizacion" name="cotizacion" value="">
                                    </div>
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="orden_compra">Orden de Compra</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-file-alt"></i></span>
                                      </div>
                                      <input type="text" class="form-control" id="orden_compra" name="orden_compra" value="">
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
                                      <option value="<?=$formapago['idmetodo_de_pago']?>"><?=$formapago['descripcion']?></option>
                                      <?php
                                        }
                                      }
                                      ?>
                                    </select>
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="moneda">Tipo de Orden</label>
                                    <select class="form-control" id="simple-select" name="moneda">
                                      <?php
                                      $objMonedas = new Ordenes();
                                      $monedas = $objMonedas->monedas();
                                      if($monedas > 0){
                                        $i=0;
                                        foreach ($monedas as $moneda){
                                          $i=$i+1;
                                      ?>
                                      <option value="<?=$moneda['iso']?>"><?=$moneda['descripcion']?></option>
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
                                      <option value="0">Nacional</option>
                                      <option value="1">Exportación</option>
                                    </select>
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="validationDefault02">Estado</label>
                                    <select class="form-control" id="simple-select">
                                      <option value="1">Activo</option>
                                      <option value="0">Inactivo</option>
                                    </select>
                                  </div>
                                </div>                                
                                <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Guardar</button>
                              </form>
                              <!-- /form -->

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
<?php 
  }
  else{
    header('Location: ../../login.php');
  }
?>