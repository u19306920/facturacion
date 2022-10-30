<?php
if (isset($principal)) {

  require('class/guias.php');
  require('class/guias_detalles.php');
  require('class/ordenes.php');
  require('class/ordenes_detalles.php');
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
                    $objContar = new Guias();
                    $nitems = $objContar->contar_items($guia[0]['idguias']);

                    if ($guia[0]['estado']==0 and $nitems[0]['nitems']>0) {
                    ?>
                      <a class='btn btn-xs btn-info' href="/modulos/almacen/guiaes_cambiar_estado.php?id=<?=$guia[0]['idguiaes']?>&e=1">Emitir</a>
                    <?php
                    }
                    elseif($guia[0]['estado']==1){
                    ?>
                      <a class='btn btn-xs btn-success' href="/modulos/almacen/guiaes_cambiar_estado.php?id=<?=$guia[0]['idguiaes']?>&e=2">Aprobar</a>&nbsp;
                      <a class='btn btn-xs btn-warning' href="/modulos/almacen/guiaes_cambiar_estado.php?id=<?=$guia[0]['idguiaes']?>&e=0">Volver a Borrador</a>
                    <?php
                    }
                    elseif($guia[0]['estado']==2){
                      ?>
                      <a class='btn btn-xs btn-warning' href="/modulos/almacen/guiaes_cambiar_estado.php?id=<?=$guia[0]['idguiaes']?>&e=3">Cerrar</a>&nbsp;
                      <a class='btn btn-xs btn-danger' href="/modulos/almacen/guiaes_cambiar_estado.php?id=<?=$guia[0]['idguiaes']?>&e=4">Anular</a>
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
                    if($guia[0]['estado']==0 and !isset($_POST['validador'])){
                  ?>
                  <h3 class="dt-card__title"><i class="fa fa-fw fa-list-alt"></i> Seleccionar Ordenes</h3>
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
                    <?php 
                      if(!isset($_POST['validador'])){

                      
                    ?>
                    <form action="" method="POST">
                      <div class="form-row">
                        <?php
                          $objOrdenesT = new Ordenes();
                          if ($guia[0]['tipo_documento']=='00') {
                            // ordenes no facturables
                            $ordenes = $objOrdenesT->ordenPorEntidadnF($guia[0]['identidades']);
                          }
                          else{
                            //ordenes facturables
                            $ordenes = $objOrdenesT->ordenPorEntidadF($guia[0]['identidades']);
                          }
                          
                          $num =0;
                          /*
                          echo "<pre>";
                          print_r($_SESSION);
                          echo "</pre>";
                          */
                          if ($ordenes) {
                            foreach ($ordenes as $orden){
                              $num =$num+1;
                            ?>
                            <div class="col-sm-3 mb-3">
                              
                                <input type="checkbox" id="id<?=$num?>" name="id<?=$num?>" value="<?=$orden['idordenes']?>"> <?=$orden['orden']?><br>(<?=$orden['orden_compra']?>)
                              
                            </div>
                            <?php 
                            }
                            ?>
                          <input type="hidden" name="validador" value="1">
                        </div>
                      <button class="btn btn-primary" type="submit">Siguiente</button>    
                            <?php
                          }
                          else{
                            echo "No existen ordenes abiertas para este cliente.";
                          }
                        ?>
                    </form>
                    <?php
                      }
                      else{
                        
                        unset($_SESSION["carrito"]);
                        //echo "Crear Carrito";
                        $num2=0;
                        $j=0;
                        $k=0;
                        $_SESSION["ocs"]="";
                        $_SESSION["ots"]="";
                        for ($i=0; $i < 30; $i++) { 
                          $num2=$num2+1;
                          $idactual="id".$num2;
                          //echo $idactual;
                          if (isset($_POST[$idactual])) {
                            $objDetalle = new Ordenes_detalles();
                            $detalle = $objDetalle->ordenes_detallePorIdOrden($_POST[$idactual]);
                            /*
                            echo "<pre>";
                            print_r($detalle);
                            echo "</pre>";
                            */
                            foreach ($detalle as $key) {
                              $saldo=$key['cantidad_pedido']-$key['cantidad_entregada'];

                              if ($saldo>0 and $key['estado']==0) {

                                $_SESSION["carrito"][]=array('iddetalles'=>$key['idordenes_detalles'],'idguias'=>$guia[0]['idguias'],'cantidad'=>$saldo,'posicion'=>$j);
                                $j++;
                                $_SESSION["ocs"].=$key['orden_compra']."|";
                                $_SESSION["ots"].=$key['orden']."|";
                              }
                            }
                            
                            $_SESSION['idguias']=$idguias;
                          }                        
                        }
                        /*
                        echo "<pre>";
                        print_r($_POST);
                        print_r($_SESSION);
                        echo "</pre>";
                        */
                        ?>
                        <!-- Tables -->
                        <div class="table-responsive">

                          <table id="data-table" class="table table-hover dataTable dtr-inline">
                            <thead>
                              <tr class="gradeX">
                                <th>N&deg;</th>
                                <th>Orden C.</th>
                                <th>Item</th>
                                <th>U.M</th>
                                <th>Pedido</th>
                                <th>Entregado</th>
                                <th>A Despachar</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                $i=0;
                                foreach ($_SESSION['carrito'] as $linea){
                                  $i=$i+1;
                              ?>
                              <tr class="gradeX">
                                <td><?=$i?></td>
                                <?php 
                                  $objDetalle2 = new Ordenes_detalles();
                                  $detalle2 = $objDetalle2->ordenes_detallePorId($linea['iddetalles']);
                                ?>
                                <td><?=$detalle2[0]['orden_compra']?></td>
                                <td><?=$detalle2[0]['descripcion']?></td>
                                <td><?=$detalle2[0]['um']?></td>
                                <td><?=$detalle2[0]['cantidad_pedido']?></td>
                                <td><?=$detalle2[0]['cantidad_entregada']?></td>
                                <td><?=number_format($linea['cantidad'],'2','.',',')?></td>
                              </tr>
                              <?php
                                }
                              ?>
                            </tbody>
                            <tfoot>
                            <tr>
                              <th colspan="7">&nbsp;</th>
                            </tr>
                            </tfoot>
                          </table>
                          <?php
                            require('js/guias_detalles_agregar.php');
                          ?>
                          <a href="index.php?module=almacen&page=guias_detalles_modificar" class="btn btn-warning">Modificar</a>
                          <a class="btn btn-primary" href="/modulos/almacen/guias_detalles_guardar.php?modificar=0">Guardar</a>
                        </div>
                        <!-- /tables -->
                        <?php
                        
                        //recibimos los 30 primeros ids
                        
                        
                        //Botones Guardar o Modificar                     
                      }
                    ?>
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