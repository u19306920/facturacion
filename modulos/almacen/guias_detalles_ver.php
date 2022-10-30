<?php
if (isset($principal)) {

  require('class/guias.php');
  require('class/guias_detalles.php');
  require('class/ordenes.php');
  $idguias = $_GET['id'];

  $guias = new Guias();
  $guia = $guias->guiaPorId($idguias);

?>
      <div class="dt-content">

        <!-- Page Header -->
        <div class="row">

          <!-- Grid Item -->
          <div class="col-12">

            <!-- Card -->
            <div class="dt-card">

              <!-- Card Header -->
              <div class="dt-card__header">

                <!-- Card Heading -->
                <div class="dt-card__heading">
                  <h1>Guia: <?=$guia[0]['guia']?></h1>
                  <h2 class="dt-card__title">Cliente: <?=$guia[0]['razon_social_nombres']?></h2>
                  <h2 class="dt-card__title">Dirección de Entrega: <?=$guia[0]['direccion']?></h2>
                  <h4 class="dt-card__title">Ruc: <?=$guia[0]['ruc_dni']?></h4>
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
                      <?=$guia[0]['fecha_emision']?>
                    </div>
                  </div>
                  <div class="col-sm-3 mb-3">
                    <label for="">Fecha Traslado:</label>
                    <div class="input-group">
                      <?=$guia[0]['fecha_traslado']?>
                    </div>
                  </div>
                  <div class="col-sm-6 mb-3">
                    <label for="">Motivo de Traslado</label>
                    <div class="input-group">
                      <?php
                        $objMotivo = new Ordenes();
                        $motivo = $objMotivo->motivo_trasladoPorId($guia[0]['motivo_traslado']);
                        echo $motivo[0]['descripcion'];
                      ?>
                    </div>
                  </div>
                  <div class="col-sm-3 mb-3">
                    <label for="">Vehiculo:</label>
                    <div class="input-group">
                      <?=$guia[0]['marca']." - ".$guia[0]['placa']?>
                    </div>
                  </div>
                  <div class="col-sm-3 mb-3">
                    <label for="">Conductor:</label>
                    <div class="input-group">
                      <?=$guia[0]['licencia']." - ".$guia[0]['nombres']?>
                    </div>
                  </div>
                </div>
                <?php
                if ($guia[0]['estado']==1) {
                ?>
                <form action="modulos/almacen/guias_ordenes_confirmar.php" method="POST">
                <div class="form-row">
                  <div class="col-sm-3 mb-3">
                    <label for="ocs">Orden de Compra:</label>
                    <div class="input-group">
                      <input class="form-control" type="text" name="ocs" id="ocs" value="<?=$guia[0]['ocs']?>" required>
                    </div>
                  </div>
                  <div class="col-sm-3 mb-3">
                    <label for="ots">Orden de Trabajo:</label>
                    <div class="input-group">
                      <input class="form-control" type="text" name="ots" id="ots" value="<?=$guia[0]['ots']?>" required>
                    </div>
                  </div>
                  <div class="col-sm-3 mb-3">
                    <label>&nbsp;</label>
                    <div class="input-group">
                      <input type="hidden" name="idguias" value="<?=$guia[0]['idguias']?>">
                      <input class="btn btn-sm btn-primary" type="submit" name="confirmar" value="Confirmar Ordenes">
                    </div>
                  </div>
                </div>
                </form>
                <?php
                }
                else{
                ?>
                <div class="form-row">
                  <div class="col-sm-3 mb-3">
                    <label for="">Orden de Compra:</label>
                    <div class="input-group">
                      <?=$guia[0]['ocs']?>
                    </div>
                  </div>
                  <div class="col-sm-3 mb-3">
                    <label for="">Orden de Trabajo:</label>
                    <div class="input-group">
                      <?=$guia[0]['ots']?>
                    </div>
                  </div>
                </div>
                <?php
                }
                ?>
                <div class="form-row">
                  <div class="col-sm-6 mb-3">
                    <label for="moneda">Observacion:</label>
                    <div class="input-group">
                      <?=$guia[0]['observacion']?>
                    </div>
                  </div>
                  <div class="col-sm-3 mb-3">
                    <label for="validationDefault02">Estado</label>
                    <div class="input-group">
                      <?php
                        switch ($guia[0]['estado']) {
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
                      if ($guia[0]['estado']==2) {
                        ?>
                        <a href="modulos/almacen/reportes/guia_remision.php?id=<?=$guia[0]['idguias']?>&e=2" target="_blank" class="btn btn-xs btn-success"><i class="fa fa-fw fa-print"></i> Imprimir</a>
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
        <div class="row">

          <!-- Grid Item -->
          <div class="col-12">

            <!-- Card -->
            <div class="dt-card">

              <!-- Card Header -->
              <div class="dt-card__header">

                <!-- Card Heading -->
                <div class="dt-card__heading">
                  <?php
                    if($guia[0]['estado']==0){
                  ?>
                  <h3 class="dt-card__title"><i class="fa fa-fw fa-list-alt"></i> Detalle de la guia</h3>
                  <?php
                    }
                    else{
                  ?>
                  <h3 class="dt-card__title"><i class="fa fa-fw fa-list-alt"></i> Detalle de la guia</h3>
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
                            <th>Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $objguiasDetalle = new Guias_detalles();
                            $detalles = $objguiasDetalle->guia_detallePorIdGuia($guia[0]['idguias']);
                            $suma_montos=0;
                            if($detalles > 0){
                              $i=0;
                              foreach ($detalles as $detalle){
                                $i=$i+1;
                          ?>
                          <tr class="gradeX">
                            <td><?=$i?></td>
                            <td><?=$detalle['codigo_interno']?></td>
                            <td><?=$detalle['descripcion']?></td>
                            <td><?=$detalle['um']?></td>
                            <td><?=$detalle['cantidad']?></td>
                            <td>
                              <?php
                              $suma_montos = $suma_montos+$detalle['cantidad_pedido']*$detalle['valor_unitario'];
                              if($detalle['estado']==0 and $guia[0]['estado']==0){
                              ?>
                                <!--<a title="Editar"><i class="fa fa-fw fa-pen"></i></a>-->
                                <a title="Eliminar" href="/modulos/almacen/guiaes_detalles_eliminar.php?id=<?=$detalle['idguiaes_detalles']?>"><i class="fa fa-fw fa-trash"></i></a>
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
                            <th colspan="6">
                              
                            </th>
                          </tr>
                        </tfoot>
                      </table>
                      <?php
                        require('js/guias_detalles.php');
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
<?php 
  }
  else{
    header('Location: ../../login.php');
  }
?>