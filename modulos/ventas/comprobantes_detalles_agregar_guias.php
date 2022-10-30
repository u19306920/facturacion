<?php
if (isset($principal)) {
  require('class/comprobantes.php');
  require('class/guias.php');
  require('class/guias_detalles.php');
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
                  <table style="font-size: 16px;" cellspacing="8px" cellpadding="4px">
                    <tr>
                      <td><b>Cliente</b></td>
                      <td><b>:</b></td>
                      <td><?=$comprobante[0]['razon_social_nombres']?></td>
                    </tr>
                    <tr>
                      <td><b>Ruc</b></td>
                      <td><b>:</b></td>
                      <td><?=$comprobante[0]['ruc_dni']?></td>
                    </tr>
                    <tr>
                      <td><b>Dirección Fiscal</b></td>
                      <td><b>:</b></td>
                      <td><?=$comprobante[0]['direccion_fiscal']?></td>
                    </tr>

                  </table>
                </div>
                <!-- /card heading -->

              </div>
              <!-- /card header -->
              <!-- Card Body -->
              <div class="dt-card__body">
                <div class="form-row">
                  <div class="col-sm-3 mb-3">
                    <label for="fecha_emision"><b>Fecha Emisión:</b></label>
                    <div class="input-group">
                      <?=$comprobante[0]['fecha_de_emision']?>
                      
                    </div>
                  </div>
                  <div class="col-sm-3 mb-3">
                    <label for=""><b>Fecha de Vencimiento:</b></label>
                    <div class="input-group">              
                    </div>
                  </div>
                  <div class="col-sm-3 mb-3">
                    <label for=""><b>Tipo de Cambio:</b></label>
                    <div class="input-group">
                      <?=$comprobante[0]['venta']?>
                    </div>
                  </div>
                  <div class="col-sm-3 mb-3">
                    <label for=""><b>Tipo de Operación</b></label>
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
                if (($comprobante[0]['estado']=='00' and isset($_POST['validador'])) OR isset($_SESSION['validador'])) {
                
                ?>
                <?php
                  //buscar en tabla comprobante
                  if ($comprobante[0]['codigo_tipo_moneda']) {
                    echo $comprobante[0]['codigo_tipo_moneda'];
                  }
                  else{
                  //buscar en ots guias
                    $ots=array();
                    $ocs=array();
                    $mons=array();
                    //$cdp = array();
                    $mdps = array();
                    $datos = new Guias_detalles();
                    if (!isset($_SESSION['carrito'])) {
                      ?>
                      <script>location.reload();</script>
                      <?php
                    }

                    foreach ($_SESSION['carrito'] as $guias) {
                      $dato = $datos->guia_detallePorIdGuia($guias['idguias']);
                      foreach ($dato as $d) {
                        array_push($ots,$d['orden']);
                        array_push($ocs,$d['orden_compra']);
                        array_push($mons,$d['moneda']);
                        array_push($mdps,$d['metodo_pago']);
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
                <form action="modulos/ventas/comprobantes_detalles_guardar.php" method="POST">
                  <div class="form-row">
                    
                    <div class="col-sm-3 mb-3">
                      <label for=""><b>Moneda:</b></label>
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
                          $objmoneda = new Ordenes();
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
                      <label for=""><b>Condición de Pago:</b></label>
                      <div class="input-group">
                        <?php
                          //buscar en tabla comprobante
                        if ($comprobante[0]['codigo_condicion_de_pago']) {
                          echo $comprobante[0]['codigo_condicion_de_pago'];
                        }
                        else{
                          //buscar en ots guias
                          ?>
                          <select name="condicion_de_pago" class="form-control" required>
                            <option value="">Seleccione</option>
                            <option value="01">Contado</option>
                            <option value="02">Credito</option>
                          </select>
                          <?php
                          //buscar en general_payment_conditions
                        }
                          

                        ?>
                      </div>
                    </div>
                    <div class="col-sm-3 mb-3">
                      <label for=""><b>Método de Pago:</b></label>
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
                            <option value="<?=$v2?>"> <?=$fp[0]['descripcion']?></option>
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
                      <label for=""><b>Ordenes de Trabajo:</b></label>
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
                      <label for=""><b>Ordenes de Compra:</b></label>
                      <div class="input-group">
                        <?php
                          //buscar en tabla comprobante
                        if ($comprobante[0]['numero_orden_de_compra']) {
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
                    <div class="col-sm-3 mb-3">
                      <label for=""><b>Guias:</b></label>
                      <div class="input-group">
                        <?php
                          //buscar en tabla comprobante
                        
                          //buscar en ots guias
                          $objGuias = new Guias();
                          $gform="";
                          foreach ($_SESSION['carrito'] as $v5) {
                            foreach ($v5 as $v6) {
                              //echo $v6 ;
                              $g = $objGuias->guiaPorId($v6);
                              echo $g[0]['guia']." <br>";
                              $gform.=$v6."/";
                            }
                          }
                          //buscar payment_method_types
                        
                        ?>
                        <input type="hidden" name="gs" value="<?=$gform?>">
                      </div>
                    </div>
                  </div>
                  <?php
                    $objAnticipos = new Comprobantes();
                    $anticipos = $objAnticipos->anticipoPorEntidad($comprobante[0]['identidades']);
                    
                    //print_r($anticipos);
                    /*
                    if (isset($_SESSION["carro_anticipo"])) {
                      echo "<pre>";
                      print_r($_SESSION["carro_anticipo"]);
                      echo "</pre>";
                    }
                    */
                    
                  ?>
                  <div class="form-row">
                    <div class="col-sm-3 mb-3">
                      <label for="validationDefault02"><b>Estado</b></label>
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
                      <label for="validationDefault02"><b>Acciones</b></label>
                      <div class="input-group">
                        <a href="index.php?module=ventas&page=comprobantes" class="btn btn-danger">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                      </div>
                    </div>
                  </div>
                </form>
                <?php
                if (isset($anticipos)) {
                ?>
                  <!--Si existe anticipos mostrar-->
                  <div class="form-row">
                    <div class="col-sm-3 mb-3">
                      <label for=""><b>Usar Anticipo:</b></label>
                      <div class="input-group">
                        <table cellspacing="8" cellpadding="8" border="0" class="table table-hover dataTable dtr-inline">
                          <tr>
                            <thead>
                              <th>Comprobante</th>
                              <th>Saldo Base</th>
                              <th>Moneda</th>
                              <th>Base a Usar</th>
                              <th>Nuevo Saldo Base</th>
                              <th>Acción</th>
                            </thead>
                          </tr>
                          <?php
                          foreach ($anticipos as $valor_ant) {
                            ?>
                            <tr>
                            <form action="modulos/ventas/agregar_anticipo.php" method="POST">
                              <td style="vertical-align: middle;"><?=$valor_ant['comprobante']?></td>
                              <td style="vertical-align: middle; text-align: right;">
                                <?php
                                if ($valor_ant['codigo_tipo_operacion']=='0200') {
                                  $porcentaje = 0;

                                }
                                else{
                                  $porcentaje = 0.18;
                                }
                                $valor_saldo_anticipo = $valor_ant['saldo_anticipo'];
                                echo number_format($valor_saldo_anticipo,2,'.',',');
                                ?>
                              </td>
                              <td style="vertical-align: middle;"><?=$valor_ant['codigo_tipo_moneda']?></td>

                              <!---->
                              <?php
                                $found = false;
                                
                                if(isset($_SESSION["carro_anticipo"])){ 
                                  foreach ($_SESSION["carro_anticipo"] as $c) { 
                                    if($c["idcomprobantes"]==$valor_ant['idcomprobantes'])
                                        { $found=true; break; }
                                  }
                                }
                              ?>
                              <?php if($found):?>
                                <td style="vertical-align: middle;"><?=$c['usar']?></td>
                                <td style="vertical-align: middle;"><?=$c['nuevo_saldo']?></td>
                                <td style="vertical-align: middle;">
                                  <a href="modulos/ventas/remover.php?id=<?php echo $c["idcomprobantes"];?>" class="btn btn-sm btn-danger oculto-impresion"><i class="fas fa-minus-circle"></i></a>
                                </td>
                              <?php else:?>
                                <td style="vertical-align: middle;">
                                  <input type="hidden" name="inicio" value="<?=number_format(round($valor_saldo_anticipo,2,PHP_ROUND_HALF_UP),2,'.',',')?>">
                                  <input type="number" class="form-control" name="usar" step="0.01" min="0.01" max="<?=round($valor_saldo_anticipo,2,PHP_ROUND_HALF_UP)?>" value="<?=round($valor_saldo_anticipo,2,PHP_ROUND_HALF_UP)?>" style="width: 100px; text-align: right;">
                                </td>
                                <td style="vertical-align: middle;">
                                  <input type="number" class="form-control" name="nuevo_saldo" step="0.01" min="0.01" max="<?=$valor_ant['saldo_anticipo']?>" value="" style="width: 100px; text-align: right;" readonly>
                                </td>
                                <td style="vertical-align: middle;">
                                  <input type="hidden" name="idcomprobantes" value="<?=$valor_ant['idcomprobantes']?>">
                                  <input type="hidden" name="comprobante" value="<?=$valor_ant['comprobante']?>">
                                  <button type="submit" class="btn btn-xs btn-primary"><i class="fas fa-plus"></i></button>
                                </td>
                              <?php
                                endif;
                              ?>



                              <!---->

                            </form>
                            </tr>
                            <?php
                          }
                          ?>
                        </table>            
                      </div>
                    </div>
                  </div>
                  <!--FIn monstrar anticipos-->  
                <?php
                  }
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
                  <h3 class="dt-card__title"><i class="fa fa-fw fa-list-alt"></i> Seleccionar Guias</h3>
                  <?php
                    }
                    else{
                  ?>
                  <h3 class="dt-card__title"><i class="fa fa-fw fa-list-alt"></i> Detalle de las guias</h3>
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
                      
                      if(!isset($_POST['validador']) and !isset($_SESSION['validador'])){
                      unset($_SESSION["carrito"]);
                      
                    ?>
                    <form action="" method="POST">
                      <div class="form-row">
                        <?php
                          $objGuias = new Guias();
                          $guias = $objGuias->guiaPorEntidadF($comprobante[0]['identidades']);
                          $num =0;
                          if($guias){
                            foreach ($guias as $guia){
                              $num =$num+1;
                        ?>
                        <div class="col-sm-3 mb-3">
                          
                            <a title="<?=$guia['fecha_emision']?>">
                              <input type="checkbox" id="id<?=$num?>" name="id<?=$num?>" value="<?=$guia['idguias']?>"> <?=$guia['guia']?>
                            </a>
                          
                        </div>
                        <input type="hidden" name="validador" value="1">
                        
                      
                        <?php 
                            }
                          }
                          else{
                            echo "No se encontraron guias pendientes de facturación para este cliente.";
                          }
                        ?>
                      </div>
                      <?php 
                      if ($guias) {
                      ?>
                      <button class="btn btn-primary" type="submit">Siguiente</button>
                      <?php 
                      }
                      ?>
                    </form>
                    <?php
                      }
                      elseif($_SESSION['validador']==1){
                        /*
                        echo "<pre>";
                        print_r($_SESSION["carrito"]);
                        print_r($_SESSION["validador"]);
                        print_r($_SESSION["carro_anticipo"]);
                        echo "</pre>";
                        */
                        ?>
                        <!-- Tables -->
                        <div class="table-responsive">

                          <table id="data-table" class="table table-hover dataTable dtr-inline">
                            <thead>
                              <tr>
                                <th>N&deg;</th>
                                <th>Guia</th>
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
                                  
                                  $objDetalle2 = new Guias_detalles();
                                  $detalle2 = $objDetalle2->guia_detallePorIdGuia($linea['idguias']);
                                  /*
                                  echo "<pre>";
                                  print_r($detalle2);
                                  echo "</pre>";
                                  */
                                  foreach ($detalle2 as $key) {
                                  
                              ?>
                                  <tr class="gradeX">
                                    <td><?=$i?></td>
                                    <td><?=$key['guia']?></td>
                                    <td><?=$key['orden']?></td>
                                    <td><?=$key['descripcion']?></td>
                                    <td><?=$key['um']?></td>
                                    <td style="text-align: center;"><?=number_format($key['cantidad'],'2','.',',')?></td>
                                    <td><?=number_format($key['valor_unitario'],'2','.',',')?></td>
                                    <td><?=$key['moneda']?></td>
                                    <td style="text-align: right;"><?=number_format(round($key['cantidad']*$key['valor_unitario'],2,PHP_ROUND_HALF_UP),'2','.',',')?></td>
                                  </tr>
                              <?php
                                  $total=$total+round($key['cantidad']*$key['valor_unitario'],2,PHP_ROUND_HALF_UP);
                                  $i++;
                                  }
                                }
                                /*Aqui se agrega los anticipos*/
                                $total_anticipos=0;
                                if (isset($_SESSION['carro_anticipo'])) {
                                  foreach ($_SESSION['carro_anticipo'] as $adicional) {
                                    ?>
                                    <tr>
                                      <td><?=$i?></td>
                                      <td></td>
                                      <td></td>
                                      <td><?="ANTICIPO"." ".$adicional['comprobante']?></td>
                                      <td>NIU</td>
                                      <td style="text-align: center;">1</td>
                                      <td></td>
                                      <td></td>
                                      <td style="text-align: right;">-<?=number_format(round($adicional['usar'],2,PHP_ROUND_HALF_UP),'2','.',',')?></td>
                                    </tr>
                                    <?php
                                    $total_anticipos =$total_anticipos + $adicional['usar'];
                                    $i++;
                                  }
                                }
                                $total = $total - $total_anticipos;
                              ?>
                            </tbody>
                            <tfoot>
                              <tr>
                                <th colspan="7"></th>
                                <th>SubTotal:</th>
                                <th style="text-align: right;"><?=number_format($total,'2','.',',')?></th>
                              </tr>
                              <tr>
                                <th colspan="7"></th>
                                <th>IGV:</th>
                                <th style="text-align: right;">
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
                                <th colspan="7"></th>
                                <th>Total:</th>
                                <th style="text-align: right;">
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

                      }
                      else{
                        $_SESSION['validador']=1;
                        //echo "Crear Carrito";
                        $num2=0;
                        $j=0;
                        $k=0;
                        for ($i=0; $i < 30; $i++) { 
                          $num2=$num2+1;
                          $idactual="id".$num2;
                          //echo $idactual;
                          if (isset($_POST[$idactual])) {
                            $_SESSION["carrito"][]=array('idguias'=>$_POST[$idactual]);
                            $j++;
                            $_SESSION['idcomprobantes']=$idcomprobantes;
                          }                        
                        }
                        /*
                        echo "<pre>";
                        print_r($_SESSION["carrito"]);
                        print_r($_SESSION["validador"]);
                        print_r($_SESSION["carro_anticipo"]);
                        echo "</pre>";
                        */
                        ?>
                        <!-- Tables -->
                        <div class="table-responsive">

                          <table id="data-table" class="table table-hover dataTable dtr-inline">
                            <thead>
                              <tr>
                                <th>N&deg;</th>
                                <th>Guia</th>
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
                                  
                                  $objDetalle2 = new Guias_detalles();
                                  $detalle2 = $objDetalle2->guia_detallePorIdGuia($linea['idguias']);
                                  /*
                                  echo "<pre>";
                                  print_r($detalle2);
                                  echo "</pre>";
                                  */
                                  foreach ($detalle2 as $key) {
                                  
                              ?>
                                  <tr class="gradeX">
                                    <td><?=$i?></td>
                                    <td><?=$key['guia']?></td>
                                    <td><?=$key['orden']?></td>
                                    <td><?=$key['descripcion']?></td>
                                    <td><?=$key['um']?></td>
                                    <td><?=number_format($key['cantidad'],'2','.',',')?></td>
                                    <td><?=number_format($key['valor_unitario'],'2','.',',')?></td>
                                    <td><?=$key['moneda']?></td>
                                    <td style="text-align: right;"><?=number_format(round($key['cantidad']*$key['valor_unitario'],2,PHP_ROUND_HALF_UP),'2','.',',')?></td>
                                  </tr>
                              <?php
                                  $total=$total+round($key['cantidad']*$key['valor_unitario'],2,PHP_ROUND_HALF_UP);
                                  $i++;
                                  }
                                }
                                /*Aqui se agrega los anticipos*/
                              ?>
                            </tbody>
                            <tfoot>
                              <tr>
                                <th colspan="7"></th>
                                <th>SubTotal:</th>
                                <th style="text-align: right;"><?=number_format($total,'2','.',',')?></th>
                              </tr>
                              <tr>
                                <th colspan="7"></th>
                                <th>IGV:</th>
                                <th style="text-align: right;">
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
                                <th colspan="7"></th>
                                <th>Total:</th>
                                <th style="text-align: right;">
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