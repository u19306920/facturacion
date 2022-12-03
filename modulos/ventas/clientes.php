<?php
if ($_SESSION['estado']!=1 and $_SESSION['estado']!=3 and $_SESSION['estado']!=4) {
  //print_r($_SESSION);
  require('modulos/tablero/denegado.php');
}
else {
  if (isset($principal)) {
    require('class/clientes.php');
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
                    <h3 class="dt-card__title">Clientes</h3><!--Titulo--><br>
                    <a class="btn btn-sm btn-primary" href="modulos/ventas/cron/clientes_update.php" target="_blank"><i class="fa fa-fw fa-sync-alt"></i></a>
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
                         aria-controls="tab-pane-1" aria-selected="true"><i class="fas fa-user"></i> Lista de Clientes
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#tab-pane-2" role="tab"
                         aria-controls="tab-pane-2" aria-selected="true"><i class="icon icon-add"></i> Nuevo Cliente con RUC
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#tab-pane-3" role="tab"
                         aria-controls="tab-pane-3" aria-selected="true"><i class="icon icon-add"></i> Nuevo Cliente - Manual
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
                                    <th>Razon Social</th>
                                    <th>Ruc</th>
                                    <!--<th>Direccion</th>-->
                                    <th>Estado</th>
                                    <th>Condicion</th>
                                    <th>Agregar</th>
                                    <th>Acciones</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $objClientes = new Entidades();
                                    $Clientes = $objClientes->entidades();
                                    if($Clientes > 0){
                                      $i=0;
                                      foreach ($Clientes as $cliente){
                                        $i=$i+1;
                                  ?>
                                  <tr class="gradeX">
                                    <td><?=$i?></td>
                                    <td><?=$cliente['razon_social_nombres']?></td>
                                    <td><?=$cliente['ruc_dni']?></td>
                                    <!--<td><?=$cliente['direccion']?></td>-->
                                    <td><?=$cliente['estado']?></td>
                                    <td><?=$cliente['condicion']?></td>
                                    <td>
                                      <a title="Agregar Direccion" href="?module=ventas&page=direcciones&id=<?=$cliente['identidades']?>"><i class="fa fa-fw fa-warehouse"></i></a>
                                      <a title="Agregar Contacto" href="?module=ventas&page=contactos&id=<?=$cliente['identidades']?>"><i class="fa fa-fw fa-user"></i></a>
                                    </td>
                                    <td>
                                      <a title="Ver" href="?module=ventas&page=clientes_ver&id=<?=$cliente['identidades']?>"><i class="fa fa-fw fa-search"></i></a>
                                      <a title="Actualizado: <?=$cliente['actualizado']?>"><i class="fa fa-fw fa-sync-alt"></i></a>
                                      <a title="Eliminar" href="modulos/ventas/clientes_eliminar.php?id=<?=$cliente['identidades']?>"><i class="fa fa-fw fa-trash"></i></a>
                                    </td>
                                  </tr>
                                  <?php
                                      }
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
                                require('js/clientes.php');
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
                                  <h3 class="dt-card__title">Nuevo Cliente</h3>
                                </div>
                                <!-- /card heading -->

                              </div>
                              <!-- /card header -->

                              <!-- Card Body -->
                              <div class="dt-card__body">

                                <!-- Form -->
                                <form class="form-inline" action="modulos/ventas/clientes_guardar.php" method="POST">
                                  <div class="form-group mr-2">
                                    <label for="ruc" class="sr-only">Ruc</label>
                                    <input type="text" class="form-control" name="ruc" id="ruc" placeholder="Ingrese Ruc">
                                  </div>
                                  <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                                  </div>
                                </form>
                                <!-- /form -->

                              </div>
                              <!-- /card body -->

                            </div>
                            <!-- /card -->

                          </div>
                          <!-- /grid item -->
                        </div>
                      </div>
                    </div>
                    <!-- /tab pane-->
                    <!-- Tab Pane -->
                    <div id="tab-pane-3" class="tab-pane">
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
                                  <h3 class="dt-card__title">Nuevo Cliente</h3>
                                </div>
                                <!-- /card heading -->
                              </div>
                              <!-- /card header -->
                              <!-- Card Body -->
                              <div class="dt-card__body">
                                <!-- Form -->
                                <form action="modulos/ventas/clientes_guardar2.php" method="POST">
                                  <div class="form-row">
                                    <div class="col-sm-3 mb-3">
                                      <label for="tipo_documento">Tipo de Documento</label>
                                      <select class="form-control" id="tipo_documento" name="tipo_documento">
                                        <option value="0">Doc.trib.no.dom.sin.ruc</option>
                                        <option value="6">RUC</option>
                                        <option value="1">DNI</option>
                                        <option value="4">CE</option>
                                        <option value="7">Pasaporte</option>
                                      </select>
                                    </div>
                                    <div class="col-sm-3 mb-3">
                                      <label for="ruc_dni">Numero de Documento</label>
                                      <input type="text" class="form-control" id="ruc_dni" name="ruc_dni" placeholder="Numero de Documento" required="">
                                    </div>
                                  </div>
                                  <div class="form-row">
                                    <div class="col-sm-6 mb-3">
                                      <label for="nombres_apellidos">Razón Social / Nombres y Apellidos</label>
                                      <input type="text" class="form-control" id="nombres_apellidos" name="nombres_apellidos" placeholder="Nombres y Apellidos" required="">
                                    </div>
                                  </div>
                                  <div class="form-row">
                                    <div class="col-sm-6 mb-3">
                                      <label for="direccion_fiscal">Dirección</label>
                                      <input type="text" class="form-control" id="direccion_fiscal" name="direccion_fiscal" placeholder="Direccion" required="">
                                    </div>
                                  </div>
                                  <div class="form-row">
                                    <div class="col-sm-3 mb-3">
                                      <label for="codigo_pais">Codigo Pais</label>
                                      <select class="form-control" id="codigo_pais" name="codigo_pais">
                                        <option value="PE">PERU</option>
                                        <option value="EC">ECUADOR</option>
                                        <option value="CO">COLOMBIA</option>
                                        <option value="CL">CHILE</option>
                                        <option value="BO">BOLIVIA</option>
                                      </select>
                                    </div>
                                    <div class="col-sm-3 mb-3">
                                      <label for="ubigeo">Ubigeo</label><br>
                                      <select class="form-control" id="ubigeo" name="ubigeo">
                                      </select>
                                      <script type="text/javascript">
                                        $('#ubigeo').select2({
                                          placeholder: 'Seleccione Ubigeo',
                                          minimumInputLength: 3,
                                          ajax: {
                                            url: 'modulos/ventas/ajax/ubigeo.php',
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
                                    </div>
                                  </div>
                                  <div class="form-row">  
                                    <div class="col-sm-3 mb-3">
                                      <label for="correo">Correo</label>
                                      <input type="text" class="form-control" id="correo" name="correo" placeholder="Correo">
                                    </div>
                                    <div class="col-sm-3 mb-3">
                                      <label for="telefono">Teléfono</label>
                                      <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono">
                                    </div>
                                  </div>
                                  <div class="form-row">
                                    <div class="col-sm-3 mb-3">
                                      <label for="estado">Estado</label>
                                      <select class="form-control" id="estado" name="estado">
                                        <option value="ACTIVO">ACTIVO</option>
                                        <option value="INACTIVO">INACTIVO</option>
                                      </select>
                                    </div>
                                  </div>
                                  <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Guardar</button>
                                </form>
                                <!-- /form -->
                              </div>
                              <!-- /card body -->
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
}
?>