<?php
if (isset($principal)) {
  require('class/comprobantes.php');
  require('class/comprobantes_detalles2.php');
  require('class/ordenes.php');
  require('class/um.php');

  $idcomprobantes = $_GET['id'];
  $comprobantes = new Comprobantes();
  $comprobante = $comprobantes->comprobantePorId($idcomprobantes);
?>
  <div class="dt-content">
    <?php
    if (!$comprobante[0]['codigo_tipo_moneda']) {
      // code...
    
    ?>
    <form action="modulos/ventas/comprobantes_detalles_guardar1.php" method="POST">
      <!-- Page Header -->
      <div class="row" <?php if($comprobante[0]['codigo_tipo_moneda']){ echo " ";}?>>
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
              if($comprobante[0]['estado']==0) {
              ?>
              <?php
               
              ?>
              <div class="form-row">
                <div class="col-sm-3 mb-3">
                  <label for="">Moneda:</label>
                  <div class="input-group">
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
                    <input type="hidden" name="idcomprobantes" value="<?=$comprobante[0]['idcomprobantes']?>">
                    <input type="hidden" name="fecha_emision" value="<?=$comprobante[0]['fecha_de_emision']?>">
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
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-3 mb-3">
                  <label for="">Ordenes de Trabajo</label>
                  <div class="input-group">
                    <input class="form-control" type="text" name="ots">
                  </div>
                </div>
                <div class="col-sm-3 mb-3">
                  <label for="">Ordenes de Compra</label>
                  <div class="input-group">
                    <input class="form-control" type="text" name="ocs">
                  </div>
                </div>
                <div class="col-sm-3 mb-3">
                  <label for="">Anticipo</label>
                  <div class="input-group">
                    <select name="anticipo" class="form-control" required>
                      <option value="">[Seleccione]</option>
                      <option value="1">Si</option>
                      <option value="0">No</option>
                    </select>
                  </div>
                </div>
                
              </div>
              <div class="form-row">
                <div class="col-sm-3 mb-3">
                  <label for="moneda">Monto:</label>
                  <div class="input-group">
                    
                  </div>
                </div>
                <div class="col-sm-3 mb-3">
                  <label for="moneda">Monto Actual:</label>
                  <div class="input-group">
                    <div id="monto_actual"></div>
                  </div>
                </div>
                
                <div class="col-sm-3 mb-3">
                  <label for="validationDefault02">Acciones</label>
                  <div class="input-group">
                    <input type="submit" class="btn btn-primary" value="Actualizar Encabezado">
                  </div>
                </div>
              </div>
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
    </form>
    <?php
    }
    else{

    ?>
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
              
              <div class="form-row">
                <div class="col-sm-3 mb-3">
                  <label for="">Moneda:</label>
                  <div class="input-group">
                    <span class="btn btn-xs btn-secondary"><?=$comprobante[0]['codigo_tipo_moneda']?></span>
                      
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
                    if ($comprobante[0]['codigo_condicion_de_pago']=='01') {
                      echo "Contado";
                    }
                    if ($comprobante[0]['codigo_condicion_de_pago']=='02') {
                      echo "Crédito"; 
                    }
                    ?>
                  </div>
                </div>
                <div class="col-sm-3 mb-3">
                  <label for="">Método de Pago</label>
                  <div class="input-group">
                      <?php
                        $objFormapago = new Ordenes();
                        $formapagos = $objFormapago->metodos_de_pagoPorId($comprobante[0]['forma_de_pago']);
                        echo $formapagos[0]['descripcion'];
                      ?>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-3 mb-3">
                  <label for="">Ordenes de Trabajo</label>
                  <div class="input-group">
                    <?=$comprobante[0]['informacion_adicional']?>
                  </div>
                </div>
                <div class="col-sm-3 mb-3">
                  <label for="">Ordenes de Compra</label>
                  <div class="input-group">
                    <?=$comprobante[0]['numero_orden_de_compra']?>
                  </div>
                </div>
                <div class="col-sm-3 mb-3">
                  <label for="">Anticipo</label>
                  <div class="input-group">
                    <?php
                      if ($comprobante[0]['anticipo']==1) {
                        echo "Si";
                      }
                      else{
                        echo "No";
                      }
                    ?>
                  </div>
                </div>
                
              </div>
              <div class="form-row">
                <div class="col-sm-3 mb-3">
                  <label for="moneda">Monto:</label>
                  <div class="input-group">
                    <?=$comprobante[0]['total_venta']?> <?=$comprobante[0]['codigo_tipo_moneda']?>
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
                      switch ($comprobante[0]['estado']) {
                        case '1':
                          echo "<button class='btn btn-xs btn-secondary'>Borrador</button>";
                          break;
                        case '2':
                          echo "<button class='btn btn-xs btn-info'>Generado</button>";
                          break;
                        case '3':
                          echo "<button class='btn btn-xs btn-success'>En Sunat</button>";
                          break;
                        case '4':
                          echo "<button class='btn btn-xs btn-danger'>Anulado</button>";
                          break;
                        default:
                          echo "<button class='btn btn-xs btn-default'>Apartado</button>";
                          break;
                      }
                    ?>
                  </div>
                </div>
                <div class="col-sm-3 mb-3">
                  <label for="validationDefault02">Acción</label>
                  <div class="input-group">
                    <?php
                    $objContar = new Comprobantes();
                    $nitems = $objContar->contar_items($comprobante[0]['idcomprobantes']);

                    if ($comprobante[0]['estado']==0 and $nitems[0]['nitems']>0) {
                    ?>
                      <a class='btn btn-xs btn-info' onclick="return confirm('¿Desea guardar el comprobante?')"  href="/modulos/ventas/comprobantes_emitir.php?id=<?=$comprobante[0]['idcomprobantes']?>">Guardar</a>
                    <?php
                    }
                    elseif($comprobante[0]['estado']==1){
                    ?>
                      <a class='btn btn-xs btn-success' onclick="return confirm('¿Desea generar el comprobante?')" href="/modulos/ventas/generar_api.php?id=<?=$comprobante[0]['idcomprobantes']?>">Generar</a>
                    <?php
                    }
                    elseif($comprobante[0]['estado']==2){
                    ?>
                      <a class='btn btn-xs btn-success' onclick="return confirm('¿Desea enviar el comprobante a sunat?')" href="/modulos/ventas/envio_api.php?id=<?=$comprobante[0]['idcomprobantes']?>">Enviar a Sunat</a>
                    <?php
                    }
                    else{
                      echo "Ninguna";
                    }
                    
                    ?>
                  </div>
                </div>
              </div>
              <?php
              if($comprobante[0]['anticipo']==0){
                $objAnticipos = new Comprobantes();
                $anticipos = $objAnticipos->anticipoPorEntidad($comprobante[0]['identidades']);
                if (isset($anticipos)) {
                  //print_r($anticipos);
                  //print_r($_SESSION['carro_anticipo']);
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
              <h3 class="dt-card__title"><i class="fa fa-fw fa-list-alt"></i> Detalle del Comprobante</h3>
            </div>
            <!-- /card heading -->
            <?php
              if ($comprobante[0]['codigo_tipo_operacion']=="0200") {
                $porcentaje=0;
              }
              else{
                $porcentaje=0.18;
              }
            ?>
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
                          <th style="text-align: center;">N&deg;</th>
                          <th>Descripción</th>
                          <th style="text-align: center;">Cantidad</th>
                          <th style="text-align: center;">Und. Med.</th>
                          <th style="text-align: center;">Valor Unit.</th>
                          <th style="text-align: center;">Subtotal</th>
                          <th style="text-align: center;">IGV</th>
                          <th style="text-align: center;">Total</th>
                          <th style="text-align: center;">Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $objComprobantesDetalles = new Comprobantes_detalles();
                          $detalles = $objComprobantesDetalles->comprobantes_detallePorIdComprobante($comprobante[0]['idcomprobantes']);
                          $suma_sb=0;
                          $suma_igvsb=0;
                          $suma_totalsb=0;
                          $i=0;
                          if($detalles > 0){
                            $i=0;
                            foreach ($detalles as $detalle){
                              $i=$i+1;
                              $sb = round($detalle['cantidad']*$detalle['valor_unitario'],2,PHP_ROUND_HALF_UP);
                              $igvsb = round($sb*$porcentaje,2,PHP_ROUND_HALF_UP);
                              $totalsb = round($sb+$igvsb,2,PHP_ROUND_HALF_UP);
                              ?>
                                <tr class="gradeX">
                                  <td style="text-align: center;"><?=$i?></td>
                                  <td><?=$detalle['descripcion']?></td>
                                  <td style="text-align: center;"><?=$detalle['cantidad']?></td>
                                  <td style="text-align: center;"><?=$detalle['um']?></td>
                                  <td style="text-align: right;"><?=number_format(round($detalle['valor_unitario'],4,PHP_ROUND_HALF_UP),4,'.',',')?></td>
                                  <td style="text-align: right;"><?=number_format($sb,2,'.',',')?></td>
                                  <td style="text-align: right;"><?=number_format($igvsb,2,'.',',')?></td>
                                  <td style="text-align: right;"><?=number_format($totalsb,2,'.',',')?></td>
                                  <td style="text-align: center;">
                                  <?php
                                    $suma_sb = $suma_sb+$sb;
                                    $suma_igvsb = $suma_igvsb+$igvsb;
                                    $suma_totalsb = $suma_totalsb+$totalsb;
                                    if($comprobante[0]['estado']==0){
                                    ?>
                                      <!--<a title="Editar"><i class="fa fa-fw fa-pen"></i></a>-->
                                      <a title="Eliminar" href="/modulos/ventas/comprobantes_detalles_eliminar.php?id=<?=$detalle['idcomprobantes_detalles']?>"><i class="fa fa-fw fa-trash"></i></a>
                                    <?php
                                    }
                                  ?>                                   
                                  </td>
                                </tr>
                              <?php
                            }
                          }
                        
                          
                          /*Aqui se agrega los anticipos*/
                          $j = $i+1;
                          $total_anticipos=0;
                          if (isset($_SESSION['carro_anticipo'])) {
                            foreach ($_SESSION['carro_anticipo'] as $adicional) {
                              ?>
                              <tr>
                                <td style="text-align: center;"><?=$j?></td>
                                <td><?="ANTICIPO"." ".$adicional['comprobante']?></td>
                                <td style="text-align: center;">1</td>
                                <td style="text-align: center;">NIU</td>
                                <td style="text-align: right;">-<?=number_format(round($adicional['usar'],2,PHP_ROUND_HALF_UP),'2','.',',')?></td>
                                <td style="text-align: right;">-<?=number_format(round($adicional['usar'],2,PHP_ROUND_HALF_UP),'2','.',',')?></td>
                                <td></td>
                                <td style="text-align: right;"></td>
                              </tr>
                              <?php
                              $total_anticipos =$total_anticipos + $adicional['usar'];
                              $j++;
                            }
                          }
                          $suma_sb = $suma_sb - $total_anticipos;
                        ?>
                        <?php
                          if($comprobante[0]['estado']==0){
                        ?>
                        <tr>
                          <form action="modulos/ventas/comprobantes_detalles_agregar_guardar.php" method="POST">
                            <td style="text-align: center;">N</td>
                            <td>
                              <input type="text" class="form-control" name="descripcion" id="descripcion" required style="font-size: 11px;padding: .375rem .375rem; text-align: left;">
                            </td>
                            <td style="text-align: center;">
                              <input type="number" class="form-control" id="cantidad" name="cantidad" required="" min="0.000" step="0.001" style="font-size: 11px;padding: .375rem .375rem; width: 60px; text-align: center; display: inherit;" value="1">
                            </td>
                            <td style="text-align: center;">
                              <select class="form-control" id="simple-select" name="um" style="font-size: 11px;padding: .375rem .375rem; text-align: left; width: 60px; display: inherit;">
                                <?php
                                $objUm = new Ums;
                                $ums = $objUm->ums();
                                if($ums > 0){
                                  $h=0;
                                  foreach ($ums as $um){
                                    $h=$h+1;
                                ?>
                                <option value="<?=$um['simbolo']?>" <?php if($um['simbolo']=="NIU"){ echo "selected";}?> ><?=$um['simbolo']?></option>
                                <?php
                                  }
                                }
                                ?>
                              </select>
                            </td>
                            <td style="text-align: right;">
                              
                              <script type="text/javascript">
                                function multiplicar(){
                                  m1 = document.getElementById("cantidad").value;
                                  m2 = document.getElementById("valor_unitario").value;
                                  r1  =  m1*m2;
                                  subtotal  = Number(r1.toFixed(2));
                                  igv = subtotal*<?=$porcentaje?>;
                                  total = subtotal+igv;
                                  document.getElementById("subtotal").value = subtotal;
                                  document.getElementById("igv").value = Number(igv.toFixed(2));
                                  document.getElementById("total").value = total;
                                }
                                function desglosar(){
                                  d1 = document.getElementById("cantidad").value;
                                  d2 = document.getElementById("total").value;
                                  r2  =  (d2/(1+<?=$porcentaje?>))/d1;
                                  valor_unitario = Number(r2.toFixed(3));
                                  subtotal  = valor_unitario*d1;
                                  igv = subtotal*<?=$porcentaje?>;
                                  total = subtotal+igv;
                                  document.getElementById("valor_unitario").value = valor_unitario;
                                  document.getElementById("subtotal").value = Number(subtotal.toFixed(3));
                                  document.getElementById("igv").value = igv;
                                }
                              </script>
                              <input type="text" class="form-control" id="valor_unitario" name="valor_unitario" required="" onchange="multiplicar()" style="font-size: 11px;padding: .375rem .375rem; text-align: right; width: 80px; display: inherit;">
                            </td>
                            <td style="text-align: right;">
                              <input type="text" class="form-control" id="subtotal" name="subtotal" readonly min="0.00" step="0.001" style="font-size: 11px;padding: .375rem .375rem; text-align: right; width: 80px; display: inherit;">
                            </td>
                            <td style="text-align: right;">
                              <input type="text" class="form-control" id="igv" name="igv" readonly min="0.00" step="0.001" style="font-size: 11px;padding: .375rem .375rem; text-align: right; width: 80px; display: inherit;">
                            </td>
                            <td style="text-align: right;">
                              <input type="text" class="form-control" id="total" name="total" min="0.00" step="0.001" onchange="desglosar()" style="font-size: 11px;padding: .375rem .375rem; text-align: right; width: 80px; display: inherit;">
                            </td>
                            <td style="text-align: center;">
                              <input type="hidden" name="idcomprobantes" value="<?=$comprobante[0]['idcomprobantes']?>">
                              <input type="submit" class="btn btn-sm btn-primary" name="Guardar" value="Agregar">
                            </td>  
                          </form>
                          
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="6"></th>
                          <th>SubTotal:</th>
                          <th style="text-align: right;"><?=number_format($suma_sb,'2','.',',')?></th>
                        </tr>
                        <tr>
                          <th colspan="6"></th>
                          <th>IGV:</th>
                          <th style="text-align: right;">
                            <?php
                            if ($comprobante[0]['codigo_tipo_operacion']=='0200') {
                              echo number_format($suma_sb*0,'2','.',',');
                            }
                            else{
                              echo number_format(round($suma_sb*0.18,2,PHP_ROUND_HALF_UP),'2','.',',');
                            }
                            
                            ?>
                          </th>
                        </tr>
                        <tr>
                          <th colspan="6"></th>
                          <th>Total:</th>
                          <th style="text-align: right;">
                            <?php
                            if ($comprobante[0]['codigo_tipo_operacion']=='0200') {
                              echo number_format($suma_sb*1,'2','.',',');
                            }
                            else{
                              echo number_format(round($suma_sb*1.18,2,PHP_ROUND_HALF_UP),'2','.',',');
                            }
                            
                            ?>
                            </th>
                        </tr>
                        <tr>
                          <th colspan="9">&nbsp;</th>
                        </tr>
                      </tfoot>
                    </table>
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
     <?php
      }
    }
    ?>
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