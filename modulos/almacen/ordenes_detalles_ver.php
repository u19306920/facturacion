<?php
if (isset($principal)) {
  require('class/ordenes.php');
  require('class/ordenes_detalles.php');
  require('class/um.php');

  $idordenes = $_GET['id'];

  $ordenes = new Ordenes();
  $orden = $ordenes->ordenPorId($idordenes);

?>
      <div class="dt-content">

        <!-- Page Header -->
        <div class="row" onmousemove="monto()">

          <!-- Grid Item -->
          <div class="col-12">

            <!-- Card -->
            <div class="dt-card">

              <!-- Card Header -->
              <div class="dt-card__header">

                <!-- Card Heading -->
                <div class="dt-card__heading">
                  <h1>Orden: <?=$orden[0]['orden']?></h1>
                  <h2 class="dt-card__title">Cliente: <?=$orden[0]['razon_social_nombres']?></h2>
                  <h4 class="dt-card__title">Ruc: <?=$orden[0]['ruc_dni']?></h4>
                </div>
                <!-- /card heading -->

              </div>
              <!-- /card header -->
              <!-- Card Body -->
              <div class="dt-card__body">
                <div class="form-row">
                  <div class="col-sm-3 mb-3">
                    <label for="fecha_emision">Fecha Emisión:</label>
                    <div class="input-group">
                      <?=$orden[0]['fecha_emision']?>
                    </div>
                  </div>
                  <div class="col-sm-3 mb-3">
                    <label for="fecha_entrega">Fecha Entrega:</label>
                    <div class="input-group">
                      <?=$orden[0]['fecha_entrega']?>
                    </div>
                  </div>
                  <div class="col-sm-3 mb-3">
                    <label for="idordenes_tipos">Tipo de Orden:</label>
                    <div class="input-group">
                      <?=$orden[0]['orden_tipo']?>
                    </div>
                  </div>
                  <div class="col-sm-3 mb-3">
                    <label for="vendedor">Vendedor:</label>
                    <div class="input-group">
                      <?=$orden[0]['vendedor']?>
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-sm-3 mb-3">
                    <label for="cotizacion">Cotizacion:</label>
                    <div class="input-group">
                      <?=$orden[0]['cotizacion']?>
                    </div>
                  </div>
                  <div class="col-sm-3 mb-3">
                    <label for="orden_compra">Orden de Compra</label>
                    <div class="input-group">
                      <?=$orden[0]['orden_compra']?>
                    </div>
                  </div>
                  <div class="col-sm-3 mb-3">
                    <label for="formapago">Forma de Pago</label>
                    <div class="input-group">
                      <?php
                        $objFormapago = new Ordenes();
                        $formapago = $objFormapago->metodos_de_pagoPorId($orden[0]['tipo_metodo_pago']);
                        echo $formapago[0]['descripcion'];
                      ?>
                    </div>
                  </div>
                  <div class="col-sm-3 mb-3">
                    <label for="exportacion">Tipo Venta</label>
                    <div class="input-group">
                      <?php
                        if($orden[0]['exportacion']==0){
                          echo "Nacional";
                        }
                        else{
                          echo "Exportacion";
                        }
                      ?>
                    </div>
                  </div>
                  
                </div>
                <div class="form-row">
                  <div class="col-sm-3 mb-3">
                    <label for="moneda">Monto:</label>
                    <div class="input-group">
                      <?=$orden[0]['monto']?> <?=$orden[0]['moneda']?>
                    </div>
                  </div>
                  <div class="col-sm-3 mb-3">
                    <label for="moneda">Monto Actual:</label>
                    <div class="input-group">
                      <div id="monto_actual"></div>
                    </div>
                  </div>
                  <div class="col-sm-3 mb-3">
                    <label for="validationDefault02">Estado</label>
                    <div class="input-group">
                      <?php
                        switch ($orden[0]['estado']) {
                          case '1':
                            echo "<button class='btn btn-xs btn-info'>Emitido</button>";
                            break;
                          case '2':
                            echo "<button class='btn btn-xs btn-success'>Aprobado</button>";
                            break;
                          case '3':
                            echo "<button class='btn btn-xs btn-secondary'>Cerrado</button>";
                            break;
                          case '4':
                            echo "<button class='btn btn-xs btn-danger'>Anulado</button>";
                            break;
                          case '7':
                            echo "<button class='btn btn-xs btn-warning'>Facturado</button>";
                            break;
                          default:
                            echo "<button class='btn btn-xs btn-default'>Borrador</button>";
                            break;
                        }
                      ?>
                    </div>
                  </div>
                  <div class="col-sm-3 mb-3">
                    <label for="validationDefault02">Acción</label>
                    <div class="input-group">
                    <?php
                    $objContar = new Ordenes();
                    $nitems = $objContar->contar_items($orden[0]['idordenes']);

                    if ($orden[0]['estado']==0 and $nitems[0]['nitems']>0) {
                      //SE CAMBIA DE 1 A 2 EN EL PRIMER LINK
                    ?>
                      <a class='btn btn-xs btn-info' onclick="return confirm('¿Desea Emitir la Orden?')"  href="/modulos/almacen/ordenes_cambiar_estado.php?id=<?=$orden[0]['idordenes']?>&e=2">Emitir y Aprobar</a>
                    <?php
                    }
                    elseif($orden[0]['estado']==1){
                    ?>
                      <a class='btn btn-xs btn-success' onclick="return confirm('¿Desea Aprobar la Orden?')" href="/modulos/almacen/ordenes_cambiar_estado.php?id=<?=$orden[0]['idordenes']?>&e=2">Aprobar</a>&nbsp;
                      <a class='btn btn-xs btn-warning' href="/modulos/almacen/ordenes_cambiar_estado.php?id=<?=$orden[0]['idordenes']?>&e=0">Volver a Borrador</a>
                    <?php
                    }
                    elseif($orden[0]['estado']==2){
                      ?>
                      <a class='btn btn-xs btn-info' onclick="return confirm('¿Desea Abrir la Orden?')"  href="/modulos/almacen/ordenes_cambiar_estado.php?id=<?=$orden[0]['idordenes']?>&e=0">Abrir</a>&nbsp;
                      <a class='btn btn-xs btn-warning' onclick="return confirm('¿Desea Cerrar la Orden?')"  href="/modulos/almacen/ordenes_cambiar_estado.php?id=<?=$orden[0]['idordenes']?>&e=3">Cerrar</a>&nbsp;
                      <a class='btn btn-xs btn-danger' onclick="return confirm('¿Desea Anular el registro?')"  href="/modulos/almacen/ordenes_cambiar_estado.php?id=<?=$orden[0]['idordenes']?>&e=4">Anular</a>
                      <?php
                    }
                    else{
                      echo "Ninguna";
                    }
                    
                    ?>
                    </div>
                  </div>
                  
                </div>
              </div>
              <!-- /card body -->

            </div>
            <!-- /card -->

          </div>
          <!-- /grid item -->
        </div>
        <!-- /page header -->

        <!-- Grid -->
        <div class="row" onmousemove="monto()">

          <!-- Grid Item -->
          <div class="col-12">

            <!-- Card -->
            <div class="dt-card">

              <!-- Card Header -->
              <div class="dt-card__header">

                <!-- Card Heading -->
                <div class="dt-card__heading">
                  <?php
                    if($orden[0]['estado']==0){
                  ?>
                  <h3 class="dt-card__title"><i class="fa fa-fw fa-list-alt"></i> Agregar Detalle de la Orden</h3>
                  <?php
                    }
                    else{
                  ?>
                  <h3 class="dt-card__title"><i class="fa fa-fw fa-list-alt"></i> Detalle de la Orden</h3>
                  <?php
                    }
                  ?>
                </div>
                <!-- /card heading -->

              </div>
              <!-- /card header -->

              <!-- Card Body -->
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
                            <th>Codigo Int.</th>
                            <th>Item</th>
                            <th>Und. Med.</th>
                            <th>Pedido</th>
                            <th>Valor Unit.</th>
                            <th>Total</th>
                            <th>Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $objOrdenesDetalle = new Ordenes_detalles();
                            $detalles = $objOrdenesDetalle->ordenes_detallePorIdOrden($orden[0]['idordenes']);
                            $suma_montos=0;
                            $i=0;
                            if($detalles > 0){
                              
                              foreach ($detalles as $detalle){
                                $i=$i+1;
                          ?>
                          <tr class="gradeX">
                            <td><?=$i?></td>
                            <td><?=$detalle['codigo_interno']?></td>
                            <td><?=$detalle['descripcion']?></td>
                            <td><?=$detalle['um']?></td>
                            <td><?=$detalle['cantidad_pedido']?></td>
                            <td><?=$detalle['valor_unitario']?></td>
                            <td><?=number_format($detalle['cantidad_pedido']*$detalle['valor_unitario'],2,'.',',')?></td>
                            <td>
                              <?php
                              $suma_montos = $suma_montos+$detalle['cantidad_pedido']*$detalle['valor_unitario'];
                              if($detalle['estado']==0 and $orden[0]['estado']==0){
                              ?>
                                <!--<a title="Editar"><i class="fa fa-fw fa-pen"></i></a>-->
                                <a title="Eliminar" href="/modulos/almacen/ordenes_detalles_eliminar.php?id=<?=$detalle['idordenes_detalles']?>"><i class="fa fa-fw fa-trash"></i></a>
                              <?php
                              }
                              ?>                                   
                            </td>
                          </tr>
                          <?php
                              }
                            }
                          ?>
                          <?php
                            if($orden[0]['estado']==0){
                              $number = $i+1;
                              $length = 3;
                              $string = substr(str_repeat(0, $length).$number, - $length);
                          ?>
                          <tr>
                            <form action="modulos/almacen/ordenes_detalles_guardar.php" method="POST">
                              <td>N</td>
                              <td>
                                <input type="text" name="codigo" class="form-control" value="<?=$orden[0]['orden']?>-<?php echo $string;  ?>" style="font-size: 11px;padding: .375rem .375rem;height: calc(2.5rem + 2px); width: 140px;">
                                
                                <script type="text/javascript">
                                  function multiplicar(){
                                    m1 = document.getElementById("cantidad_pedido").value;
                                    m2 = document.getElementById("valor_unitario").value;
                                    r1  =  m1*m2;
                                    n1  = Number(r1.toFixed(2));
                                    document.getElementById("total").value = n1;
                                  }
                                </script>
                              </td>
                              <td>
                                <input type="text" name="descripcion" class="form-control" style="font-size: 11px;padding: .375rem .375rem;height: calc(2.5rem + 2px); width: 200px;" required>
                                <!--
                                <select class="form-control" id="iditems" name="iditems" style="font-size: 11px;padding: .375rem .375rem;height: calc(2.5rem + 2px); width: 340px;">
                                </select>
                                <script type="text/javascript">
                                  $('#iditems').select2({
                                    placeholder: 'Seleccione Item',
                                    minimumInputLength: 3,
                                    ajax: {
                                      url: 'modulos/almacen/ajax/items.php',
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
                                -->
                              </td>
                              <td>
                                <select class="form-control" id="um" name="um" style="font-size: 11px;padding: .375rem .375rem;height: calc(2.5rem + 2px); width: 60px;" required>
                                  <option value="">Seleccione</option>
                                  <?php
                                    $objUms = new Ums();
                                    $Ums = $objUms->ums();
                                    foreach ($Ums as $um) {
                                      ?>
                                      <option value="<?=$um['simbolo']?>" <?php if ($um['simbolo']=="NIU"){ echo "selected";}?> > <?=$um['descripcion']?></option>
                                      <?php
                                    }
                                  ?>
                                </select>
                              </td>
                              <td>
                                <input type="number" class="form-control" id="cantidad_pedido" name="cantidad_pedido" required="" min="0.000" step="0.001" style="font-size: 11px;padding: .375rem .375rem;height: calc(2.5rem + 2px); text-align: right;">
                              </td>
                              <td>
                                <input type="text" class="form-control" id="valor_unitario" name="valor_unitario" required="" style="font-size: 11px;padding: .375rem .375rem;height: calc(2.5rem + 2px); text-align: right;" min="0.00000" step="0.00001" onchange="multiplicar()">
                              </td>
                              <td>
                                <input type="text" class="form-control" id="total" name="total" readonly style="font-size: 11px;padding: .375rem .375rem;height: calc(2.5rem + 2px); text-align: right;" min="0.00" step="0.01">
                                
                              </td>
                              <td>
                                <input type="hidden" name="idordenes" value="<?=$orden[0]['idordenes']?>">
                                <input type="submit" name="Guardar" value="Agregar">
                              </td>  
                            </form>
                            
                          </tr>
                          <?php
                            }
                          ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th colspan="8">
                              <script>
                                function monto(){
                                  document.getElementById('monto_actual').innerHTML='<?=$suma_montos?> <?=$orden[0]['moneda']?>';
                                }
                              </script>
                            </th>
                          </tr>
                        </tfoot>
                      </table>
                      <?php
                        require('js/ordenes_detalles.php');
                      ?>

                    </div>
                    <!-- /tables -->

                  </div>
                  <!-- /card body -->

                </div>
                <!-- /card -->

              </div>
              
              <!-- /card body -->

            </div>
            <!-- /card -->

          </div>

        </div>
        <!-- /grid -->

      </div>
      <script type="text/javascript">
        $('#aOrdenes').addClass("active");
      </script>
<?php 
  }
  else{
    header('Location: ../../login.php');
  }
?>