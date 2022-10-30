<?php
if (isset($principal)) {
  require('class/comprobantes.php');
  require('class/guias.php');
  require('class/comprobantes_detalles.php');
  require('class/ordenes.php');
  require('class/ordenes_detalles.php');
  $idcomprobantes = $_GET['id'];

  $comprobantes = new Comprobantes();
  $comprobante = $comprobantes->comprobantePorId($idcomprobantes);
  //print_r($_SESSION);
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
                  <h1>Comprobante: <?php if($comprobante[0]['codigo_tipo_documento']=='01'){ echo "FACTURA";} elseif($comprobante[0]['codigo_tipo_documento']=='03'){ echo "BOLETA";};?> <?=$comprobante[0]['comprobante']?></h1>
                  <h2 class="dt-card__title">Cliente: <?=$comprobante[0]['razon_social_nombres']?></h2>
                  <h2 class="dt-card__title">Dirección Fiscal: <?=$comprobante[0]['direccion_fiscal']?></h2>
                  <h4 class="dt-card__title">Ruc: <?=$comprobante[0]['ruc_dni']?></h4>
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
                      <?=$comprobante[0]['fecha_de_emision']?>
                      
                    </div>
                  </div>
                  <div class="col-sm-3 mb-3">
                    <label for="">Tipo de Cambio:</label>
                    <div class="input-group">
                      <?=$comprobante[0]['venta']?>
                    </div>
                  </div>
                  <div class="col-sm-6 mb-3">
                    <label for="">Tipo de Operación</label>
                    <div class="input-group">
                      <?php
                        switch ($comprobante[0]['codigo_tipo_operacion']) {
                          case '0101':
                            echo "Venta";
                            break;
                          case '0200':
                            echo "EXPORTACION DE BIENES";
                            break;
                          case '0401':
                            echo "VENTAS NO DOMICILIADOS QUE NO CALIFICAN COMO EXPORTACION";
                            break;
                          case '1001':
                            echo "OPERACION SUJETA A DETRACCION";
                            break;
                          default:
                            echo "Error";
                            break;
                        }
                      ?>
                      
                    </div>
                  </div>
                </div>
                <?php 
                if ($comprobante[0]['estado']=='00' and isset($_POST['validador'])) {
                
                ?>
                <?php
                  //buscar en tabla comprobante
                  if ($comprobante[0]['codigo_tipo_moneda']) {
                    echo $comprobante[0]['codigo_tipo_moneda'];
                    //buscar en ots guias
                    $ots=array();
                    $ocs=array();
                    $mons=array();
                    //$cdp = array();
                    $mdps = array();
                    $datos = new Ordenes();
                    if (!isset($_SESSION['carrito'])) {
                      ?>
                      <script>location.reload();</script>
                      <?php
                    }
                    /*
                    echo "<pre>";
                    print_r($_SESSION);
                    echo "</pre>";
                    */
                    foreach ($_SESSION["carrito"] as $ordenes) {
                      $dato = $datos->ordenPorId($ordenes['idordenes']);
                      foreach ($dato as $d) {
                        array_push($ots,$d['orden']);
                        array_push($ocs,$d['orden_compra']);
                        array_push($mons,$d['moneda']);
                        array_push($mdps,$d['tipo_metodo_pago']);
                      }
                      
                    }
                    $ot = array_unique($ots);
                    $oc = array_unique($ocs);
                    $mon = array_unique($mons);
                    $mdp = array_unique($mdps);
                  }
                  else{
                  //buscar en ots guias
                    $ots=array();
                    $ocs=array();
                    $mons=array();
                    //$cdp = array();
                    $mdps = array();
                    $datos = new Ordenes();
                    if (!isset($_SESSION['carrito'])) {
                      ?>
                      <script>location.reload();</script>
                      <?php
                    }
                    /*
                    echo "<pre>";
                    print_r($_SESSION);
                    echo "</pre>";
                    */
                    foreach ($_SESSION["carrito"] as $ordenes) {
                      $dato = $datos->ordenPorId($ordenes['idordenes']);
                      foreach ($dato as $d) {
                        array_push($ots,$d['orden']);
                        array_push($ocs,$d['orden_compra']);
                        array_push($mons,$d['moneda']);
                        array_push($mdps,$d['tipo_metodo_pago']);
                      }
                      
                    }
                    $ot = array_unique($ots);
                    $oc = array_unique($ocs);
                    $mon = array_unique($mons);
                    $mdp = array_unique($mdps);
                  }
                  //print_r($mon);
                  //buscar en general_payment_conditions

                ?>
                <form action="modulos/ventas/comprobantes_detalles_guardar2.php" method="POST">
                  <div class="form-row">
                    <div class="col-sm-3 mb-3">
                      <label for="">Moneda:</label>
                      <div class="input-group">
                        <?php
                          //buscar en tabla comprobante
                        if ($comprobante[0]['codigo_tipo_moneda']) {
                          echo $comprobante[0]['codigo_tipo_moneda'];
                        }
                        else{
                          //buscar en ots guias
                          ?>
                          <select name="moneda" class="form-control">
                          <?php
                          foreach ($mon as $v1) {
                            ?>
                            <option value="<?=$v1?>"> <?=$v1?></option>
                            <?php
                          }
                          ?>
                          </select>
                          <?php
                          //buscar en cat_currency_types
                        }
                          
                        ?>
                        
                        <input type="hidden" name="idcomprobantes" value="<?=$comprobante[0]['idcomprobantes']?>">
                        <input type="hidden" name="fecha_emision" value="<?=$comprobante[0]['fecha_de_emision']?>">
                        <input type="hidden" name="codigo_tipo_operacion" value="<?=$comprobante[0]['codigo_tipo_operacion']?>">
                      </div>
                    </div>
                  
                    <div class="col-sm-3 mb-3">
                      <label for="">Condición de Pago</label>
                      <div class="input-group">
                        <?php
                          //buscar en tabla comprobante
                        if ($comprobante[0]['codigo_condicion_de_pago']) {
                          echo $comprobante[0]['codigo_condicion_de_pago'];
                        }
                        else{
                          //buscar en ots guias
                          ?>
                          <select name="condicion_de_pago" class="form-control">
                            <option value="01">Contado</option>
                            <option value="02" selected>Credito</option>
                          </select>
                          <?php
                          //buscar en general_payment_conditions
                        }
                          

                        ?>
                      </div>
                    </div>
                    <div class="col-sm-3 mb-3">
                      <label for="">Método de Pago</label>
                      <div class="input-group">
                        <?php
                          //buscar en tabla comprobante
                        if ($comprobante[0]['forma_de_pago']) {
                          echo $comprobante[0]['forma_de_pago'];
                        }
                        else{
                          //buscar en ots guias
                          ?>
                          <select class="form-control" name="forma_de_pago">
                          <?php
                          $objFP = new Ordenes();

                          foreach ($mdp as $v2) {
                            $fp = $objFP->metodos_de_pagoPorId($v2);

                            ?>
                            <option value="<?=$v2?>"> <?=$fp[0]['description']?></option>
                            <?php
                          }
                          ?>
                          </select>
                          <?php
                          //buscar payment_method_types
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-sm-3 mb-3">
                      <label for="">Ordenes de Trabajo</label>
                      <div class="input-group">
                        <?php
                          //buscar en tabla comprobante
                        if ($comprobante[0]['observaciones']) {
                          echo $comprobante[0]['observaciones'];
                        }
                        else{
                          //buscar en ots guias
                          $otform="";
                          foreach ($ot as $v3) {
                            ?>
                            <?=$v3?> <br>
                            <?php
                            $otform.=$v3."/";
                          }
                          //buscar payment_method_types
                        }
                          

                        ?>
                        <input type="hidden" name="ots" value="<?=$otform?>">
                      </div>
                    </div>
                    <div class="col-sm-3 mb-3">
                      <label for="">Ordenes de Compra</label>
                      <div class="input-group">
                        <?php
                          //buscar en tabla comprobante
                        if ($comprobante[0]['observaciones']) {
                          echo $comprobante[0]['numero_orden_de_compra'];
                        }
                        else{
                          //buscar en ots guias
                          $ocform="";
                          foreach ($oc as $v4) {
                            ?>
                            <?=$v4?> <br>
                            <?php
                            $ocform.=$v4."/";
                          }
                          //buscar payment_method_types
                        }
                        ?>
                        <input type="hidden" name="ocs" value="<?=$ocform?>">
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-sm-3 mb-3">
                      <label for="validationDefault02">Estado</label>
                      <div class="input-group">
                        <?php
                          switch ($comprobante[0]['estado']) {
                          case '00':
                            echo "<button class='btn btn-xs btn-info'>Apartado</button>";
                            break;
                          case '01':
                            echo "<button class='btn btn-xs btn-secondary'>Registrado</button>";
                            break;
                          case '03':
                            echo "<button class='btn btn-xs btn-info'>Enviado</button>";
                            break;
                          case '05':
                            echo "<button class='btn btn-xs btn-success'>Aceptado</button>";
                            break;
                          case '07':
                            echo "<button class='btn btn-xs btn-danger'>Observado</button>";
                            break;
                          case '09':
                            echo "<button class='btn btn-xs btn-danger'>Rechazado</button>";
                            break;
                          case '11':
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
                      <label for="validationDefault02">Acciones</label>
                      <div class="input-group">
                        <a href="index.php?module=ventas&page=comprobantes_detalles_modificar" class="btn btn-warning">Modificar</a>
                        <a class="btn btn-primary" href="/modulos/ventas/comprobantes_detalles_guardar2.php?modificar=0">Guardar</a>
                      </div>
                    </div>
                  </div>
                </form>
                <?php 
                }
                ?>
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
                    if($comprobante[0]['estado']=='00' and !isset($_POST['validador'])){
                  ?>
                  <h3 class="dt-card__title"><i class="fa fa-fw fa-list-alt"></i> Seleccionar Orden de Trabajo</h3>
                  <?php
                    }
                    else{
                  ?>
                  <h3 class="dt-card__title"><i class="fa fa-fw fa-list-alt"></i> Detalle de las Ordenes</h3>
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
                          $objOrdenesL = new Ordenes();
                          $ordenesL = $objOrdenesL->ordenPorEntidadF($comprobante[0]['identidades']);
                          $num =0;
                          if($ordenesL){
                            foreach ($ordenesL as $ordenL){
                              $num =$num+1;
                        ?>
                        <div class="col-sm-3 mb-3">
                          
                            <a title="<?=$ordenL['fecha_emision']?>">
                              <input type="checkbox" id="id<?=$num?>" name="id<?=$num?>" value="<?=$ordenL['idordenes']?>"> <?=$ordenL['orden']?>
                            </a>
                          
                        </div>
                        <input type="hidden" name="validador" value="1">
                      </div>
                      <button class="btn btn-primary" type="submit">Siguiente</button>
                        <?php 
                            }
                          }
                          else{
                            echo "No se encontraron ordenes pendientes de facturación para este cliente.";
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
                        for ($i=0; $i < 30; $i++) { 
                          $num2=$num2+1;
                          $idactual="id".$num2;
                          //echo $idactual;
                          if (isset($_POST[$idactual])) {
                            $_SESSION["carrito"][]=array('idordenes'=>$_POST[$idactual]);
                            $j++;
                            $_SESSION['idcomprobantes']=$idcomprobantes;
                          }                        
                        }
                        /*
                        echo "<pre>";
                        print_r($_SESSION["carrito"]);
                        echo "</pre>";
                        */
                        ?>
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
                                <th>Valor</th>
                                <th>Moneda</th>
                                <th>Total</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                $i=1;
                                $total = 0;
                                foreach ($_SESSION['carrito'] as $linea){
                                  
                                  $objDetalle2 = new Ordenes_detalles();
                                  $detalle2 = $objDetalle2->ordenes_detallePorIdOrden($linea['idordenes']);
                                  /*
                                  echo "<pre>";
                                  print_r($detalle2);
                                  echo "</pre>";
                                  */
                                  foreach ($detalle2 as $key) {
                                    $saldo = $key['cantidad_pedido']-$key['cantidad_entregada'];
                                  
                              ?>
                                  <tr class="gradeX">
                                    <td><?=$i?></td>
                                    <td><?=$key['orden']?></td>
                                    <td><?=$key['descripcion']?></td>
                                    <td><?=$key['um']?></td>
                                    <td><?=number_format($saldo,'2','.',',')?></td>
                                    <td><?=number_format($key['valor_unitario'],'2','.',',')?></td>
                                    <td><?=$key['moneda']?></td>
                                    <td><?=number_format(round($saldo*$key['valor_unitario'],2,PHP_ROUND_HALF_UP),'2','.',',')?></td>
                                  </tr>
                              <?php
                                  $total=$total+round($saldo*$key['valor_unitario'],2,PHP_ROUND_HALF_UP);
                                  $i++;
                                  }
                                }
                              ?>
                            </tbody>
                            <tfoot>
                              <tr>
                                <th colspan="6"></th>
                                <th>SubTotal:</th>
                                <th><?=number_format($total,'2','.',',')?></th>
                              </tr>
                              <tr>
                                <th colspan="6"></th>
                                <th>IGV:</th>
                                <th>
                                  <?php
                                  if ($comprobante[0]['codigo_tipo_operacion']=='0200') {
                                    echo number_format($total*0,'2','.',',');
                                  }
                                  else{
                                    echo number_format(round($total*0.18,2,PHP_ROUND_HALF_UP),'2','.',',');
                                  }
                                  
                                  ?>
                                </th>
                              </tr>
                              <tr>
                                <th colspan="6"></th>
                                <th>Total:</th>
                                <th>
                                  <?php
                                  if ($comprobante[0]['codigo_tipo_operacion']=='0200') {
                                    echo number_format($total*1,'2','.',',');
                                  }
                                  else{
                                    echo number_format(round($total*1.18,2,PHP_ROUND_HALF_UP),'2','.',',');
                                  }
                                  
                                  ?>
                                  </th>
                              </tr>
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
      <script type="text/javascript">
        $('#aComprobantes').addClass("active");
      </script>
<?php 
}
else{
  header('Location: ../../login.php');
}
?>