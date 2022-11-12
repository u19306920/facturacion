<?php
if (isset($principal)) {
  unset($_SESSION['carrito']);
  unset($_SESSION['carro_anticipo']);
  unset($_SESSION['validador']);
  require('class/comprobantes.php');
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
                  <h3 class="dt-card__title">Facturación</h3><!--Titulo--><br>
                  <a href="index.php?module=ventas&page=comprobantes&year=<?=date("Y")?>" class="btn btn-sm btn-light"><?=date("Y")?></a>
                  <a href="index.php?module=ventas&page=comprobantes&year=<?=date("Y")-1?>" class="btn btn-sm btn-light"><?=date("Y")-1?></a>
                  <a href="index.php?module=ventas&page=comprobantes&year=<?=date("Y")-2?>" class="btn btn-sm btn-light"><?=date("Y")-2?></a>
                  <a href="index.php?module=ventas&page=comprobantes&year=<?=date("Y")-3?>" class="btn btn-sm btn-light"><?=date("Y")-3?></a>
                  <a href="index.php?module=ventas&page=comprobantes&year=<?=date("Y")-4?>" class="btn btn-sm btn-light"><?=date("Y")-4?></a>
                  <a href="index.php?module=ventas&page=comprobantes&year=<?=date("Y")-5?>" class="btn btn-sm btn-light"><?=date("Y")-5?></a>
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
                       aria-controls="tab-pane-1" aria-selected="true"><i class="fas fa-file-invoice"></i> Comprobantes
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-pane-2" role="tab"
                       aria-controls="tab-pane-2" aria-selected="true"><i class="icon icon-add"></i> Nuevo Comprobante
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
                              <tr>
                                <th>N</th>
                                <th>Comprobante</th>
                                <th>Cliente</th>
                                <th>Emision</th>
                                <th style="text-align: center;">Moneda</th>
                                <th>Base</th>
                                <th>IGV</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Descarga</th>
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

                              $comprobantes = new Comprobantes();
                              $comprobante = $comprobantes->comprobantePorAnio($anio);
                              $i=0;
                              if ($comprobante) {
                                foreach ($comprobante as $key) {
                                $i++;
                              ?>
                              <tr class="gradeX">
                                <td><?=$i?></td>
                                <td><?=$key['comprobante']?></td>
                                <td><?=$key['razon_social_nombres']?></td>
                                <td><?=$key['fecha_de_emision']?></td>
                                <td align="center"><?=$key['codigo_tipo_moneda']?></td>
                                <td style="text-align: right;"><?=number_format($key['total_valor'],2,".",",")?></td>
                                <td style="text-align: right;"><?=number_format($key['total_igv'],2,".",",")?></td>
                                <td style="text-align: right;"><?=number_format($key['total_venta'],2,".",",")?></td>
                                <?php
                                if ($key['estado']=='00' and !isset($key['anticipo'])) {
                                ?>
                                <td><span class="btn btn-xs btn-secondary">Apartado</span></td>
                                <td>
                                  
                                </td>
                                <td>
                                  <ul class="dt-nav">
                                    <li class="dt-nav__item dropdown">
                                      <!-- Dropdown Link -->
                                      <a href="#"  class="dt-nav__link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="btn btn-xs btn-info"><i class="fas fa-cash-register"></i></span></a>&nbsp;
                                      <!-- /dropdown link -->
                                      <!-- Dropdown Option -->
                                      <div class="dropdown-menu dropdown-menu-right" style="">
                                        <a class="dropdown-item" href="?module=ventas&page=comprobantes_detalles_agregar_guias&id=<?=$key['idcomprobantes']?>" title="Desde Guia">
                                          <i class="far fa-file-alt"></i> <span>Guia</span> </a>
                                        <a class="dropdown-item" href="?module=ventas&page=comprobantes_detalles_agregar_ots2&id=<?=$key['idcomprobantes']?>" title="Desde OT">
                                          <i class="fas fa-hammer"></i> <span>OT</span> </a>
                                        <a class="dropdown-item" href="?module=ventas&page=comprobantes_detalles_agregar&id=<?=$key['idcomprobantes']?>" title="Manual">
                                          <i class="fas fa-file-invoice"></i> <span>Manual</span> </a>
                                      </div>
                                      <!-- /dropdown option -->
                                      <a href="?module=ventas&page=comprobantes_editar&id=<?=$key['idcomprobantes']?>" title="Editar" class="btn btn-xs btn-warning"><i class="fas fa-pencil-alt"></i></a>&nbsp;
                                      <!--<a href="#" title="Eliminar" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>-->
                                    </li>
                                  </ul>
                                </td>
                                <?php
                                }
                                elseif ($key['estado']=='00' and isset($key['anticipo'])) {
                                ?>
                                <td><span class="btn btn-xs btn-secondary">Apartado</span></td>
                                <td>
                                  
                                </td>
                                <td>
                                  <ul class="dt-nav">
                                    <li class="dt-nav__item dropdown">
                                      <!-- Dropdown Link -->
                                      <a href="#"  class="dt-nav__link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="btn btn-xs btn-info"><i class="fas fa-cash-register"></i></span></a>&nbsp;
                                      <!-- /dropdown link -->
                                      <!-- Dropdown Option -->
                                      <div class="dropdown-menu dropdown-menu-right" style="">
                                        <a class="dropdown-item" href="?module=ventas&page=comprobantes_detalles_agregar&id=<?=$key['idcomprobantes']?>" title="Otros">
                                          <i class="fas fa-file-invoice"></i> <span>Factura</span> </a>
                                      </div>
                                      <!-- /dropdown option -->
                                      
                                    </li>
                                  </ul>
                                </td>
                                <?php
                                }
                                elseif ($key['estado']=='10') {
                                ?>
                                <td><span class="btn btn-xs btn-info">Borrador</span></td>
                                <td>
                                  
                                </td>
                                <td>
                                  <a href="index.php?module=ventas&page=comprobantes_detalles_agregar&id=<?=$key['idcomprobantes']?>" title="Ver" class="btn btn-xs btn-info"><i class="fas fa-search"></i></a>
                                  <a href="/modulos/ventas/generar_api.php?id=<?=$key['idcomprobantes']?>" title="Generar" class="btn btn-xs btn-success"><i class="fas fa-magic"></i></a>
                                </td>
                                <?php
                                }
                                elseif ($key['estado']=='01') {
                                ?>
                                <td><span class="btn btn-xs btn-info">Registrado</span></td>
                                <td>
                                  <a href="<?=$_SESSION['url']?>/downloads/document/pdf/<?=$key['observaciones']?>" title="Descargar PDF" class="btn btn-xs btn-default" target="_blank">PDF</a>
                                  <a href="<?=$_SESSION['url']?>/downloads/document/xml/<?=$key['observaciones']?>" title="Descargar XML" class="btn btn-xs btn-success">XML</a>
                                </td>
                                <td>
                                  <!--<a href="#" title="Ver" class="btn btn-xs btn-info"><i class="fas fa-search"></i></a>-->
                                  <a href="/modulos/ventas/envio_api.php?id=<?=$key['idcomprobantes']?>" title="Enviar a Sunat" class="btn btn-xs btn-success"><i class="fab fa-telegram-plane"></i></a>
                                </td>
                                <?php
                                }
                                else {
                                  // code...
                                ?>
                                <td>
                                  
                                  <?php
                                    switch($key['estado']){
                                      case '03':
                                        echo "<span class='btn btn-xs btn-info'>Enviado</span>";
                                        break;
                                      case '05':
                                        echo "<span class='btn btn-xs btn-success'>Aceptado</span>";
                                        break;
                                      case '07':
                                        echo "<span class='btn btn-xs btn-secondary'>Observado</span>";
                                        break;
                                      case '09':
                                        echo "<span class='btn btn-xs btn-danger'>Rechazado</span>";
                                        break;
                                      case '11':
                                        echo "<span class='btn btn-xs btn-danger'>Anulado</span>";
                                        break;
                                      case '13':
                                        echo "<span class='btn btn-xs btn-warning'>Por anular</span>";
                                        break;
                                    }
                                  ?>
                                </td>
                                <td align="center">
                                  <ul class="dt-nav">
                                    <li class="dt-nav__item dropdown">

                                      <!-- Dropdown Link -->
                                      <a href="#"  class="dt-nav__link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="btn btn-xs btn-success"><i class="fas fa-cloud-download-alt"></i></span></a>&nbsp;&nbsp;
                                      <!-- /dropdown link -->

                                      <!-- Dropdown Option -->
                                      <div class="dropdown-menu dropdown-menu-right" style="">
                                        <a class="dropdown-item" href="<?=$_SESSION['url']?>/downloads/document/pdf/<?=$key['observaciones']?>" title="Descargar PDF" class="btn btn-xs btn-success">
                                          <i class="far fa-file-alt"></i> <span>PDF</span></a>
                                        <a class="dropdown-item" href="<?=$_SESSION['url']?>/downloads/document/xml/<?=$key['observaciones']?>" title="Descargar XML" class="btn btn-xs btn-success">
                                          <i class="fas fa-code"></i> <span>XML</span> </a>
                                        <a class="dropdown-item" href="<?=$_SESSION['url']?>/downloads/document/cdr/<?=$key['observaciones']?>" title="Descargar CDR" class="btn btn-xs btn-success">
                                          <i class="fas fa-file-archive"></i> <span>CDR</span></a>
                                      </div>
                                      <!-- /dropdown option -->
                                      
                                    </li>
                                  </ul>
                                </td>
                                <td>
                                  <?php
                                  $c=$comprobantes->comprobanteSinGuia($key['idcomprobantes']);
                                  if ($c) {
                                    ?>
                                    <a title="Guia desde Factura" href="?module=ventas&page=guia_de_factura&id=<?=$key['idcomprobantes']?>" class="btn btn-xs btn-info"><i class="fas fa-file-alt"></i></a>
                                    <?php
                                  }
                                  if ($key['estado']=='05') {
                                  ?>
                                  <ul class="dt-nav">
                                    <li class="dt-nav__item dropdown">

                                      <!-- Dropdown Link -->
                                      <!--
                                      <a href="#"  class="dt-nav__link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="btn btn-xs btn-warning"><i class="far fa-clone"></i></span></a>&nbsp;&nbsp;
                                      -->
                                      <!-- /dropdown link -->

                                      <!-- Dropdown Option -->
                                      <!--
                                      <div class="dropdown-menu dropdown-menu-right" style="">
                                        <a class="dropdown-item" href="index.php?module=ventas&page=notas_creditos&key=<?=$key['observaciones']?>&id=<?=$key['idcomprobantes']?>" title="Nota de Credito" class="btn btn-xs btn-success">
                                          <i class="fas fa-minus-square"></i> <span>Nota de Crédito</span></a>
                                        <a class="dropdown-item" href="index.php?module=ventas&page=notas_debitos&key=<?=$key['observaciones']?>&id=<?=$key['idcomprobantes']?>" title="Nota de Debito" class="btn btn-xs btn-success">
                                          <i class="fas fa-plus-square"></i> <span>Nota de Débito</span> </a>
                                      </div>
                                      -->
                                      <!-- /dropdown option -->
                                      
                                    </li>
                                  </ul>
                                    <a href="#" class="btn btn-xs btn-danger"><i class="fas fa-ban"></i></a>
                                  <?php
                                  }
                                  ?>
                                </td>
                                <?php
                                }
                                ?>
                              </tr>
                              <?php
                                }
                              }
                              ?>
                              </tbody>
                              <tfoot>
                              <tr>
                                <th colspan="11"></th>
                              </tr>
                              </tfoot>
                            </table>
                            <?php
                              require('js/comprobantes.php');
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
                                <h3 class="dt-card__title">Nuevo Comprobante</h3>
                              </div>
                              <!-- /card heading -->

                            </div>
                            <!-- /card header -->

                            <!-- Card Body -->
                            <div class="dt-card__body">

                              <!-- Form -->
                              <form action="modulos/ventas/comprobantes_guardar.php" method="POST">
                                <div class="form-row">
                                  <div class="col-sm-12 mb-3">
                                    <label for="identidades">Cliente:</label><br>
                                    <select class="form-control" id="identidades" name="identidades" required>
                                    </select>
                                    <script type="text/javascript">
                                      $('#identidades').select2({
                                        placeholder: 'Seleccione Cliente',
                                        minimumInputLength: 3,
                                        focus: 1,
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
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#form-cliente">
                                      Nuevo Cliente
                                    </button>
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="fecha_emision">Fecha Emisión</label>
                                    <div class="input-group">
                                      <input type="date" class="form-control" id="fecha_emision" name="fecha_emision" value="<?=date("Y-m-d")?>">
                                    </div>
                                  </div>
                                  
                                  <div class="col-sm-3 mb-3">
                                    <label for="tipo_documento">Tipo de Documento</label>
                                    <select class="form-control" id="tipo_documento" name="tipo_documento">
                                      <option>Seleccione</option>
                                      <option value="01">FACTURA ELECTRONICA</option>
                                      <option value="03">BOLETA DE VENTA</option>
                                    </select>
                                    
                                  </div>
                                  <div class="col-sm-3 mb-3">
                                    <label for="serie_documento">Serie</label>
                                    <select class="form-control" id="serie_documento" name="serie_documento">
                                    </select>
                                  </div>
                                  
                                  
                                  <div class="col-sm-3 mb-3">
                                    <label for="tipo_operacion">Tipo de Operación</label>
                                    <select class="form-control" id="tipo_operacion" name="tipo_operacion" required>
                                      <option value="">SELECCIONE</option>
                                      <option value="0101">VENTA</option>
                                      <option value="0200">EXPORTACION DE BIENES</option>
                                      <option value="0401">VENTAS NO DOMICILIADOS QUE NO CALIFICAN COMO EXPORTACION</option>
                                      <option value="1001">OPERACION SUJETA A DETRACCION</option>
                                    </select>
                                  </div>
                                </div>
                                
                                <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Guardar</button>
                              </form>
                              <!-- /form -->
                              
                              <!--CARGAMOS LAS SERIES-->
                              <script type="text/javascript">
                                $(document).ready(function(){
                                  $('#tipo_documento').val(1);
                                  recargarLista();

                                  $('#tipo_documento').change(function(){
                                    recargarLista();
                                  });
                                })
                                function recargarLista(){
                                  $.ajax({
                                    type:"POST",
                                    url:"/modulos/ventas/ajax/series.php",
                                    data:"tipo_documento=" + $('#tipo_documento').val(),
                                    success:function(r){
                                      $('#serie_documento').html(r);
                                    }
                                  });
                                }
                              </script>
                              <!---->

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
      <script type="text/javascript">
        $('#aComprobantes').addClass("active");
      </script>
      <!-- /site content -->
<?php 
}
else{
  header('Location: ../../login.php');
}
?>