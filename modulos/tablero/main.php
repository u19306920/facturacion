<?php
require('modulos/tablero/class/tablero.php');
$objTablero1 = new Tablero();

$ventadelmes = $objTablero1->ventaMes(date('Y'),date('m'));
$ventadelmesS = $objTablero1->ventaMesSoles(date('Y'),date('m'));
$ventadeldia = $objTablero1->ventaDia(date('Y-m-d'));
$ventadeldiaS = $objTablero1->ventaDiaS(date('Y-m-d'));
$ventadelAnio = $objTablero1->ventaAnio(date('Y'));
$ventadelAnioS = $objTablero1->ventaAnioS(date('Y'));
//print_r($ventadeldia);

$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

?>
      <!-- Site Content -->
      <div class="dt-content">

        <!-- Grid -->
        <div class="row">
          <!-- Grid Item -->
          <div class="col-sm-12 col-md-12 col-xl-6">

            <!-- Card -->
            <div class="dt-card dt-card__full-height">

              <!-- Card Header -->
              <div class="dt-card__header">

                <!-- Card Heading -->
                <div class="dt-card__heading">
                  <h3 class="dt-card__title">Ventas del día</h3>
                </div>
                <!-- /card heading -->

              </div>
              <!-- /card header -->

              <!-- Card Body -->
              <div class="dt-card__body">
                <!-- Grid -->
                <div class="row no-gutters">
                  <!-- Grid Item -->
                  <div class="col-sm-7 pr-sm-2 mb-6 mb-sm-0">
                    <!--<h2 class="display-2 font-weight-medium mb-3">-->
                    <h2 class="font-weight-medium mb-3">
                      $ <?php
                          if ($ventadeldia) {
                            echo number_format(round($ventadeldia[0]['total_dia'],2,PHP_ROUND_HALF_UP),2,".",",");
                          } else {
                            echo "0.00";
                          }
                        ?>
                      <!--<span class="d-inline-block f-14 text-success">64% <i class="icon icon-menu-up"></i></span>-->
                    </h2>
                    <h2 class="font-weight-medium mb-3">
                      S/ <?php
                          if ($ventadeldiaS) {
                            echo number_format(round($ventadeldiaS[0]['total_dia'],2,PHP_ROUND_HALF_UP),2,".",",");
                          } else {
                            echo "0.00";
                          }
                        ?>
                      <!--<span class="d-inline-block f-14 text-success">64% <i class="icon icon-menu-up"></i></span>-->
                    </h2>

                    <span class="d-inline-block text-light-gray mb-6">Incluye impuestos</span>

                    <p class="card-text">
                      <a href="javascript:void(0)" class="btn btn-primary mr-2">Crédito</a>
                      <a href="javascript:void(0)" class="btn text-white bg-cyan">Contado</a>
                    </p>
                  </div>
                  <!-- /grid item -->
                  <?php
                  $DistribucionD = $objTablero1->ventadPorTipoVentaDia(date('Y-m-d'));
                  //print_r($Distribucion);
                  $total = 0;
                  $local = 0;
                  $exportacion = 0;
                  $servicios = 0;
                  $otros=0;
                  $l=0;
                  $e=0;
                  $s=0;
                  $o=0;
                  $pl=0;
                  $pe=0;
                  $ps=0;
                  $po=0;
                  //print_r($Distribucion);
                  if(isset($DistribucionD)){
                    foreach ($DistribucionD as $vv) {
                    
                      if ($vv['codigo_tipo_operacion']=="0101") {
                        $local = $vv['total_tipo'];
                      }
                      elseif ($vv['codigo_tipo_operacion']=="0200") {
                        $exportacion = $vv['total_tipo'];
                      }
                      elseif ($vv['codigo_tipo_operacion']=="1001") {
                        $servicios = $vv['total_tipo'];
                      }
                      else{
                        $otros = $vv['total_tipo'];
                      }
                      $total = $total + $vv['total_tipo'];
                                          
                    }
                    //echo $total;
                    if ($total>0) {

                      $l = $local/$total;
                      $e = $exportacion/$total;
                      $s = $servicios/$total;
                      $o = $otros/$total;

                      $pl = round($l*100,0,PHP_ROUND_HALF_UP);
                      $pe = round($e*100,0,PHP_ROUND_HALF_UP);
                      $ps = round($s*100,0,PHP_ROUND_HALF_UP);
                      $po = round($o*100,0,PHP_ROUND_HALF_UP);
                    } 
                  }

                  ?>
                  <!-- Grid Item -->
                  <div class="col-sm-5">
                    <h5 class="mb-4">Distribución</h5>
                    <ul class="dt-indicator">
                      <li class="dt-indicator-item">
                        <h5 class="dt-indicator-title f-12">Local <span
                              class="d-inline-block border-left text-light-gray pl-2 ml-1"><?=number_format($l,2,".",",")?> <?=$pl?></span></h5>
                        <div class="dt-indicator-item__info" data-fill="<?=$pl?>" data-max="100" data-percent="true">
                          <div class="dt-indicator-item__fill bg-success"></div>
                          <span class="dt-indicator-item__count ml-3">0</span>
                        </div>
                      </li>
                      <li class="dt-indicator-item">
                        <h5 class="dt-indicator-title f-12">Exportación <span
                              class="d-inline-block border-left text-light-gray pl-2 ml-1"><?=number_format($e,2,".",",")?></span></h5>
                        <div class="dt-indicator-item__info" data-fill="<?=$pe?>" data-max="100" data-percent="true">
                          <div class="dt-indicator-item__fill bg-primary"></div>
                          <span class="dt-indicator-item__count ml-3">0</span>
                        </div>
                      </li>
                      <!--
                      <li class="dt-indicator-item">
                        <h5 class="dt-indicator-title f-12">Servicios <span
                              class="d-inline-block border-left text-light-gray pl-2 ml-1"><?=number_format($s,2,".",",")?></span></h5>
                        <div class="dt-indicator-item__info" data-fill="<?=$ps?>" data-max="100" data-percent="true">
                          <div class="dt-indicator-item__fill bg-secondary"></div>
                          <span class="dt-indicator-item__count ml-3">0</span>
                        </div>
                      </li>
                      -->
                      <li class="dt-indicator-item">
                        <h5 class="dt-indicator-title f-12">Otros <span
                              class="d-inline-block border-left text-light-gray pl-2 ml-1"><?=number_format($s+$otros,2,".",",")?></span></h5>
                        <div class="dt-indicator-item__info" data-fill="<?=$po+$ps?>" data-max="100" data-percent="true">
                          <div class="dt-indicator-item__fill bg-warning"></div>
                          <span class="dt-indicator-item__count ml-3">0</span>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <!-- /grid item -->
                </div>
                <!-- /grid -->
              </div>
              <!-- /card body -->

            </div>
            <!-- /card -->

          </div>
          <!-- /grid item -->
          <!-- Grid Item -->
          <div class="col-sm-12 col-md-12 col-xl-6">

            <!-- Card -->
            <div class="dt-card dt-card__full-height">

              <!-- Card Header -->
              <div class="dt-card__header">

                <!-- Card Heading -->
                <div class="dt-card__heading">
                  <h3 class="dt-card__title">Ventas del <?=date("Y")?></h3>
                </div>
                <!-- /card heading -->

              </div>
              <!-- /card header -->

              <!-- Card Body -->
              <div class="dt-card__body">
                <!-- Grid -->
                <div class="row no-gutters">
                  <!-- Grid Item -->
                  <div class="col-sm-7 pr-sm-2 mb-6 mb-sm-0">
                    <!--<h2 class="display-2 font-weight-medium mb-3">-->
                    <h2 class="font-weight-medium mb-3">
                      $ <?php
                          if ($ventadelAnio) {
                            echo number_format(round($ventadelAnio[0]['total_anio'],2,PHP_ROUND_HALF_UP),2,".",",");
                          } else {
                            echo "0.00";
                          }
                        ?>
                      <!--<span class="d-inline-block f-14 text-success">64% <i class="icon icon-menu-up"></i></span>-->
                    </h2>
                    <h2 class="font-weight-medium mb-3">
                      S/ <?php
                          if ($ventadelAnioS) {
                            echo number_format(round($ventadelAnioS[0]['total_anio'],2,PHP_ROUND_HALF_UP),2,".",",");
                          } else {
                            echo "0.00";
                          }
                        ?>
                      <!--<span class="d-inline-block f-14 text-success">64% <i class="icon icon-menu-up"></i></span>-->
                    </h2>

                    <span class="d-inline-block text-light-gray mb-6">Incluye impuestos</span>

                    <p class="card-text">
                      <a href="javascript:void(0)" class="btn btn-primary mr-2">Crédito</a>
                      <a href="javascript:void(0)" class="btn text-white bg-cyan">Contado</a>
                    </p>
                  </div>
                  <!-- /grid item -->
                  <?php
                  $Distribucion = $objTablero1->ventadPorTipoVentaMes(date('m'));
                  //print_r($Distribucion);
                  $total = 0;
                  $local = 0;
                  $exportacion = 0;
                  $servicios = 0;
                  $otros=0;
                  $l=0;
                  $e=0;
                  $s=0;
                  $o=0;
                  $pl=0;
                  $pe=0;
                  $ps=0;
                  $po=0;
                  //print_r($Distribucion);
                  if(isset($Distribucion)){
                    foreach ($Distribucion as $vv) {
                    
                      if ($vv['codigo_tipo_operacion']=="0101") {
                        $local = $vv['total_tipo'];
                      }
                      elseif ($vv['codigo_tipo_operacion']=="0200") {
                        $exportacion = $vv['total_tipo'];
                      }
                      elseif ($vv['codigo_tipo_operacion']=="1001") {
                        $servicios = $vv['total_tipo'];
                      }
                      else{
                        $otros = $vv['total_tipo'];
                      }
                      $total = $total + $vv['total_tipo'];
                                          
                    }
                    //echo $total;
                    if ($total>0) {

                      $l = $local/$total;
                      $e = $exportacion/$total;
                      $s = $servicios/$total;
                      $o = $otros/$total;

                      $pl = round($l*100,0,PHP_ROUND_HALF_UP);
                      $pe = round($e*100,0,PHP_ROUND_HALF_UP);
                      $ps = round($s*100,0,PHP_ROUND_HALF_UP);
                      $po = round($o*100,0,PHP_ROUND_HALF_UP);
                    } 
                  }

                  ?>
                  <!-- Grid Item -->
                  <div class="col-sm-5">
                    <h5 class="mb-4">Distribución</h5>
                    <ul class="dt-indicator">
                      <li class="dt-indicator-item">
                        <h5 class="dt-indicator-title f-12">Local <span
                              class="d-inline-block border-left text-light-gray pl-2 ml-1"><?=number_format($l,2,".",",")?> <?=$pl?></span></h5>
                        <div class="dt-indicator-item__info" data-fill="<?=$pl?>" data-max="100" data-percent="true">
                          <div class="dt-indicator-item__fill bg-success"></div>
                          <span class="dt-indicator-item__count ml-3">0</span>
                        </div>
                      </li>
                      <li class="dt-indicator-item">
                        <h5 class="dt-indicator-title f-12">Exportación <span
                              class="d-inline-block border-left text-light-gray pl-2 ml-1"><?=number_format($e,2,".",",")?></span></h5>
                        <div class="dt-indicator-item__info" data-fill="<?=$pe?>" data-max="100" data-percent="true">
                          <div class="dt-indicator-item__fill bg-primary"></div>
                          <span class="dt-indicator-item__count ml-3">0</span>
                        </div>
                      </li>
                      <!--
                      <li class="dt-indicator-item">
                        <h5 class="dt-indicator-title f-12">Servicios <span
                              class="d-inline-block border-left text-light-gray pl-2 ml-1"><?=number_format($s,2,".",",")?></span></h5>
                        <div class="dt-indicator-item__info" data-fill="<?=$ps?>" data-max="100" data-percent="true">
                          <div class="dt-indicator-item__fill bg-secondary"></div>
                          <span class="dt-indicator-item__count ml-3">0</span>
                        </div>
                      </li>
                      -->
                      <li class="dt-indicator-item">
                        <h5 class="dt-indicator-title f-12">Otros <span
                              class="d-inline-block border-left text-light-gray pl-2 ml-1"><?=number_format($otros+$s,2,".",",")?></span></h5>
                        <div class="dt-indicator-item__info" data-fill="<?=$po+$ps?>" data-max="100" data-percent="true">
                          <div class="dt-indicator-item__fill bg-warning"></div>
                          <span class="dt-indicator-item__count ml-3">0</span>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <!-- /grid item -->
                </div>
                <!-- /grid -->
              </div>
              <!-- /card body -->

            </div>
            <!-- /card -->

          </div>
          <!-- /grid item -->
           <!-- Grid Item -->
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

            <!-- Chart Card -->
            <div class="dt-card dt-chart dt-card__full-height">

              <!-- Chart Header -->
              <div class="dt-chart__header">
                <div class="style-default style-crypto">
                  <h3 class="dt-card__title">
                    Ventas <?=$meses[date('n')-1]?> <?=date("Y")?>: 
                  </h3>
                  <h4>&nbsp;
                    $<?php
                      if ($ventadelmes) {
                        echo number_format(round($ventadelmes[0]['total_mes'],2,PHP_ROUND_HALF_UP),2,".",",");
                      } else {
                        echo "0.00";
                      }
                    ?>
                    &nbsp;+&nbsp;
                    S/<?php
                      if ($ventadelmesS) {
                        echo number_format(round($ventadelmesS[0]['total_mes'],2,PHP_ROUND_HALF_UP),2,".",",");
                      } else {
                        echo "0.00";
                      }
                      
                    ?>
                  </h4>
                  <!--
                  <div class="trending-section text-success">
                    <h4>38%</h4>
                    <i class="icon icon-menu-up"></i>
                  </div>
                  -->
                  <p></p>
                </div>
              </div>
              <!-- /chart header -->

              <!-- Action Tools -->
              <div class="action-tools">
                <i class="icon icon-bitcoin icon-3x text-primary"></i>
              </div>
              <!-- /action tools -->

              <!-- Chart Body -->
              <div class="dt-chart__body" style="margin: 0px 20px 20px 20px;">
                <canvas class="rounded-xl" id="ventasMes" height="60" data-shadow="yes"></canvas>
              </div>
              <!-- /chart body -->

            </div>
            <!-- /chart card -->

          </div>
          <!-- /grid item -->
          
          <!-- Grid Item -->
          <div class="col-sm-12 col-md-12 col-xl-12">

            <!-- Card -->
            <div class="dt-card dt-card__full-height">

              <!-- Card Header -->
              <div class="dt-card__header">

                <!-- Card Heading -->
                <div class="dt-card__heading">
                  <h3 class="dt-card__title">Últimos 36 meses</h3>
                </div>
                <!-- /card heading -->

                <!-- Card Tools -->
                <div class="dt-card__tools">

                  <!-- Dropdown -->
                  <!--
                  <div class="dropdown d-inline-block">
                    <a class="dropdown-toggle d-inline-block f-12 py-1 px-2 border rounded text-light-gray"
                       href="#"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                      ---
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="javascript:void(0)">Last week</a>
                      <a class="dropdown-item" href="javascript:void(0)">Last 6 month</a>
                      <a class="dropdown-item" href="javascript:void(0)">Last 1 year</a>
                    </div>
                  </div>
                  -->
                  <!-- /dropdown -->

                </div>
                <!-- /card tools -->

              </div>
              <!-- /card header -->

              <!-- Chart Body -->
              <div class="dt-chart__body" style="margin: 0px 20px 20px 20px;">
                <canvas height="100" id="ventas36meses"></canvas>
              </div>
              <!-- /chart body -->

            </div>
            <!-- /card -->

          </div>
          <!-- /grid item -->
        </div>
        <!-- /grid -->

      </div>
      <!-- /site content -->