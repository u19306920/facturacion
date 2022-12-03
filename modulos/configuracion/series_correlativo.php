<?php
if (isset($principal)) {
  require('class/comprobantes_series.php');
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
                  <h3 class="dt-card__title">Correlativo de Series de Comprobantes</h3><!--Titulo-->
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
                       aria-controls="tab-pane-1" aria-selected="true"><i class="fas fa-file"></i> Listado Correlativos de Series
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-pane-2" role="tab"
                       aria-controls="tab-pane-2" aria-selected="true"><i class="icon icon-add"></i> Nueva Serie
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

                            <table id="data-table2" class="table table-hover dataTable dtr-inline">
                              <thead>
                                <tr class="gradeX">
                                  <th>Tipo de Comprobante</th>
                                  <th>Serie</th>
                                  <th>Numero actual</th>
                                  <th>Estado</th>
                                  <th>Acciones</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  $objSeries = new Comprobantes_series();
                                  $Series = $objSeries->comprobantes_series();
                                  if($Series > 0){
                                    $i=0;
                                    foreach ($Series as $serie){
                                      $i=$i+1;
                                      if (isset($_GET['idc'])) {
                                        if ($_GET['idc'] == $serie['idcomprobantes_series']) {
                                          ?>
                                          <tr class="gradeX">
                                            <form action="modulos/configuracion/series_correlativo_editar.php" method="POST">
                                              <td>
                                                <?php
                                                  switch ($serie['tipo_documento']) {
                                                    case '01':
                                                      echo "FACTURA";
                                                      break;
                                                    case '03':
                                                      echo "BOLETA";
                                                      break;
                                                    case '07':
                                                      echo "NOTA DE CREDITO";
                                                      break;
                                                    case '08':
                                                      echo "NOTA DE DEBITO";
                                                      break;
                                                    default:
                                                      echo $serie['tipo_documento'];
                                                      break;
                                                  }
                                                ?>
                                              </td>
                                              <td><?=$serie['serie_documento']?></td>
                                              <td>
                                                <input type="number" class="form-control" name="numero_actual" value="<?php echo str_pad($serie['numero_actual'],8, "0", STR_PAD_LEFT); ?>">
                                              </td>
                                              <td>
                                                <select name="estado" class="form-control">
                                                  <option value="1">Activo</option>
                                                  <option value="0">Inactivo</option>
                                                </select>
                                              </td>
                                              <td>
                                                <input type="hidden" name="idc" value="<?=$serie['idcomprobantes_series']?>">
                                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-save"></i></button>
                                              </td>
                                            </form>
                                          </tr>
                                          <?php
                                        }
                                        else{
                                          ?>
                                          <tr class="gradeX">
                                            <td>
                                              <?php
                                                switch ($serie['tipo_documento']) {
                                                  case '01':
                                                    echo "FACTURA";
                                                    break;
                                                  case '03':
                                                    echo "BOLETA";
                                                    break;
                                                  case '07':
                                                    echo "NOTA DE CREDITO";
                                                    break;
                                                  case '08':
                                                    echo "NOTA DE DEBITO";
                                                    break;
                                                  default:
                                                    echo $serie['tipo_documento'];
                                                    break;
                                                }
                                              ?>
                                            </td>
                                            <td><?=$serie['serie_documento']?></td>
                                            <td>
                                              <?php echo str_pad($serie['numero_actual'],8, "0", STR_PAD_LEFT); ?>
                                            </td>
                                            <td>
                                              <?php
                                              if ($serie['estado']) {
                                                echo "Activo";
                                              }
                                              else {
                                                echo "Inactivo";
                                              }
                                              ?>
                                            </td>
                                            <td>
                                              
                                            </td>
                                          </tr>
                                          <?php
                                        }
                                      }
                                      else{
                                        ?>
                                        <tr class="gradeX">
                                          <td>
                                            <?php
                                              switch ($serie['tipo_documento']) {
                                                case '01':
                                                  echo "FACTURA";
                                                  break;
                                                case '03':
                                                  echo "BOLETA";
                                                  break;
                                                case '07':
                                                  echo "NOTA DE CREDITO";
                                                  break;
                                                case '08':
                                                  echo "NOTA DE DEBITO";
                                                  break;
                                                default:
                                                  echo $serie['tipo_documento'];
                                                  break;
                                              }
                                            ?>
                                          </td>
                                          <td><?=$serie['serie_documento']?></td>
                                          <td>
                                            <?php echo str_pad($serie['numero_actual'],8, "0", STR_PAD_LEFT); ?>
                                          </td>
                                          <td>
                                            <?php
                                            if ($serie['estado']) {
                                              echo "Activo";
                                            }
                                            else {
                                              echo "Inactivo";
                                            }
                                            ?>
                                          </td>
                                          <td>
                                            <a title="Editar" href="?module=configuracion&page=series_correlativo&idc=<?=$serie['idcomprobantes_series']?>" ><i class="fa fa-fw fa-pen"></i></a>
                                            <?php
                                            if ($serie['estado']) {
                                              ?>
                                              <a title="Cambiar estado" href="modulos/configuracion/series_estado.php?id=<?=$serie['idcomprobantes_series']?>&e=0" ><i class="fa fa-fw fa-sync-alt"></i></a>
                                              <?php
                                            }
                                            else {
                                              ?>
                                              <a title="Cambiar estado" href="modulos/configuracion/series_estado.php?id=<?=$serie['idcomprobantes_series']?>&e=1" ><i class="fa fa-fw fa-sync-alt"></i></a>
                                              <?php
                                            }
                                            ?>
                                          </td>
                                        </tr>
                                        <?php
                                      }
                                    }
                                  }
                                ?>
                              </tbody>                                
                              <tfoot>
                              <tr>
                                <th colspan="5">&nbsp;</th>
                              </tr>
                              </tfoot>
                            </table>
                            <?php
                              require('js/series.php');
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
                  
                  <div id="tab-pane-2" class="tab-pane">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-12">
                          <div class="dt-card">
                            <div class="dt-card__header">
                              <div class="dt-card__heading">
                                <h3 class="dt-card__title">Nueva Serie de Comprobante</h3>
                              </div>
                            </div>
                            <div class="dt-card__body">
                              <form action="modulos/configuracion/series_guardar.php" method="POST" name="form">
                                <div class="form-row">
                                  <div class="input-group mb-3 col-sm-3">
                                    <div class="input-group-prepend">
                                      <label class="input-group-text" for="inputGroupSelect01"><i class="far fa-file-alt"></i></label>
                                    </div>
                                    <select class="custom-select" id="inputGroupSelect01" required name="tipo">
                                      <option value="">Seleccione...</option>
                                      <option value="03">Boleta</option>
                                      <option value="01">Factura</option>
                                    </select>
                                  </div>
                                  
                                </div>
                                <div class="form-row">
                                  <div class="col-sm-3 mb-3">
                                    <label for="serie">Serie:</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-money-bill-alt"></i></span>
                                      </div>
                                      <input type="text" class="form-control" id="serie" name="serie" required maxlength="4" size="4" onchange="soloNumerosYletras(document.form.serie.value);">
                                    </div>
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="correlativo">Correlativo:</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-money-bill-alt"></i></span>
                                      </div>
                                      <input type="number" class="form-control" id="correlativo" name="correlativo" value="1" required>
                                    </div>
                                  </div>

                                </div>
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input" id="exportacion" name="exportacion" value="1">
                                  <label class="custom-control-label" for="exportacion">Es documento para exportación</label>
                                </div><BR>
                                  
                                
                                <button class="btn btn-primary" type="submit">Guardar</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
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
      <script type="text/javascript">
        function soloNumerosYletras(cadena){
          var validos="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
          var i;
          var j;
          var coinci=0;
          var nocoinci=0;
          var cadena;
              for(j=0; j<=cadena.length; j++){               
                for(i=0; i<validos.length; i++){            
                  if(cadena.charAt(j)==validos.charAt(i)){           
                    coinci++;
                  }
                }
              }
              
              if(cadena.length==coinci){
                alert("todos los caracteres son validos");
              }

              else{                   
                alert("Considerar 4 carecteres alfanumericos ");
                document.getElementById("serie").focus();
                document.getElementById('serie').value = '';
              }
            }
      </script>
      <!-- /site content -->
<?php 
  }
  else{
    header('Location: ../../login.php');
  }
?>