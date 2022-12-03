<?php
  if (isset($principal)) {
    require('class/usuarios.php');
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
                    <h3 class="dt-card__title">Permisos de Usuarios</h3><!--Titulo-->
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
                         aria-controls="tab-pane-1" aria-selected="true"><i class="fas fa-user-tie"></i> Listado de Permisos
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
                                    <th>Perfil</th>
                                    <th>Tablero</th>
                                    <th>Ventas</th>
                                    <th>Almacen</th>
                                    <th>Configuracion</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr class="gradeX">
                                    <td>Super Admin</td>
                                    <td><i class="fas fa-check-circle" style="color: green; font-size: 24px;"></i></td>
                                    <td><i class="fas fa-check-circle" style="color: green; font-size: 24px;"></i></td>
                                    <td><i class="fas fa-check-circle" style="color: green; font-size: 24px;"></i></td>
                                    <td><i class="fas fa-check-circle" style="color: green; font-size: 24px;"></i></td>
                                  </tr>
                                  <tr class="gradeX">
                                    <td>Admin</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><i class="fas fa-check-circle" style="color: green; font-size: 24px;"></i></td>
                                  </tr>
                                  <tr class="gradeX">
                                    <td>Gerencia</td>
                                    <td><i class="fas fa-check-circle" style="color: green; font-size: 24px;"></i></td>
                                    <td><i class="fas fa-check-circle" style="color: green; font-size: 24px;"></i></td>
                                    <td><i class="fas fa-check-circle" style="color: green; font-size: 24px;"></i></td>
                                    <td></td>
                                  </tr>
                                  <tr class="gradeX">
                                    <td>Vendedor</td>
                                    <td><i class="fas fa-check-circle" style="color: green; font-size: 24px;"></i></td>
                                    <td><i class="fas fa-check-circle" style="color: green; font-size: 24px;"></i></td>
                                    <td></td>
                                    <td></td>
                                  </tr>
                                  <tr class="gradeX">
                                    <td>Logistica</td>
                                    <td></td>
                                    <td></td>
                                    <td><i class="fas fa-check-circle" style="color: green; font-size: 24px;"></i></td>
                                    <td></td>
                                  </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                  <th colspan="5">&nbsp;</th>
                                </tr>
                                </tfoot>
                              </table>
                              <?php
                                require('js/permisos.php');
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

?>
