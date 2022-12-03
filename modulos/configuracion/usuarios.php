<?php
if ($_SESSION['estado']!=1) {
  //print_r($_SESSION);
  require('modulos/tablero/denegado.php');
}
else {
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
                    <h3 class="dt-card__title">Usuarios del Sistema</h3><!--Titulo-->
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
                         aria-controls="tab-pane-1" aria-selected="true"><i class="fas fa-user-tie"></i> Listado de Usuarios
                      </a>
                    </li>
                    
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#tab-pane-2" role="tab"
                         aria-controls="tab-pane-2" aria-selected="true"><i class="icon icon-add icon-xl"></i> Nuevo usuario
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
                                    <th>N&deg;</th>
                                    <th>Usuario</th>
                                    <th>Apellidos y Nombres</th>
                                    <th>DNI</th>
                                    <th>Perfil</th>
                                    <th>Acciones</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $objUsuarios = new Usuarios();
                                    $usuarios = $objUsuarios->usuarios();
                                    
                                    require('class/encriptacion.php');

                                    if($usuarios > 0){
                                      $i=0;
                                      foreach ($usuarios as $operador){
                                        $i=$i+1;
                                  ?>
                                  <tr class="gradeX">
                                    <td><?=$i?></td>
                                    <td><?=$operador['usuario']?></td>
                                    <td><?=$operador['apellidos']?> <?=$operador['nombres']?></td>
                                    <td>
                                      <?php
                                      $number = $operador['dni'];
                                      $length = 8;
                                      $string = substr(str_repeat(0, $length).$number, - $length);
                                      echo $string;
                                      ?>
                                      
                                      </td>
                                    <?php 
                                      if ($operador['estado']==0) {
                                    ?>
                                    <td><span class="btn btn-xs btn-secondary">Inhabilitado</span></td>
                                    <?php
                                      }
                                      elseif ($operador['estado']==1) {
                                    ?>
                                    <td><span class="btn btn-xs btn-success">Super Admin</span></td>
                                    <?php
                                      }
                                      elseif ($operador['estado']==2) {
                                    ?>
                                    <td><span class="btn btn-xs btn-success">Admin</span></td>
                                    <?php
                                      }
                                      elseif ($operador['estado']==3) {
                                    ?>
                                    <td><span class="btn btn-xs btn-success">Gerente</span></td>
                                    <?php
                                      }
                                      elseif ($operador['estado']==4) {
                                    ?>
                                    <td><span class="btn btn-xs btn-success">Vendedor</span></td>
                                    <?php
                                      }
                                    
                                      elseif ($operador['estado']==5) {
                                    ?>
                                    <td><span class="btn btn-xs btn-success">Logistica</span></td>
                                    <?php
                                      }
                                    ?>

                                    <?php  
                                      if ($_SESSION['estado']==1) {
                                    ?>
                                    <td>
                                      <a title="Editar" href="?module=configuracion&page=usuario_editar&id=<?=openssl_encrypt($operador['idusuarios'], $ciphering,$encryption_key, $options, $encryption_iv);?>" class="btn btn-xs btn-info"><i class="fa fa-fw fa-pen"></i></a>
                                      <a title="Eliminar" href="modulos/configuracion/usuario_eliminar.php?id=<?=openssl_encrypt($operador['idusuarios'], $ciphering,$encryption_key, $options, $encryption_iv);?>" class="btn btn-xs btn-danger" onclick="return confirm('Desea eliminar el registro')"><i class="fa fa-fw fa-trash"></i></a>
                                    </td>
                                    <?php
                                      }
                                      else{
                                    ?>
                                    <td>
                                      Ninguna
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
                                  <th colspan="6">&nbsp;</th>
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
                    <?php if ($_SESSION['estado']==1): ?>
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
                                  <h3 class="dt-card__title">Nuevo Registro</h3>
                                </div>
                                <!-- /card heading -->

                              </div>
                              <!-- /card header -->

                              <!-- Card Body -->
                              <div class="dt-card__body">

                                <!-- Form -->
                                <form class="" action="modulos/configuracion/usuario_guardar.php" method="POST">
                                   <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="nombres">NOMBRES:</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="far fa-user"></i></span>
                                      </div>
                                      <input type="text" class="form-control" id="nombres" name="nombres">
                                    </div>
                                  </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="apellidos">APELLIDO:</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="far fa-user"></i></span>
                                      </div>
                                      <input type="text" class="form-control" id="apellidos" name="apellidos">
                                    </div>
                                  </div>
                                  <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="dni">DNI:</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-id-card"></i></span>
                                      </div>
                                      <input type="number" class="form-control" id="dni" name="dni">
                                    </div>
                                  </div>
                                  <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="usuario">USUARIO:</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="far fa-user"></i></span>
                                      </div>
                                      <input type="text" class="form-control" id="usuario" name="usuario">
                                    </div>
                                  </div>
                                  <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="clave">CONTRASEÑA:</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-key"></i></span>
                                      </div>
                                      <input type="password" class="form-control" id="clave" name="clave">
                                    </div>
                                  </div>
                                  <!--
                                  <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="token">TOKEN:</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-ticket-alt"></i></span>
                                      </div>
                                      <input type="text" class="form-control" id="token" name="token">
                                    </div>
                                  </div>
                                  -->
                                  <!--
                                  <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="correo">CORREO:</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-ticket-alt"></i></span>
                                      </div>
                                      <input type="text" class="form-control" id="correo" name="correo">
                                    </div>
                                  </div>
                                  <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="telefono">TELEFONO:</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-ticket-alt"></i></span>
                                      </div>
                                      <input type="number" class="form-control" id="telefono" name="telefono">
                                    </div>
                                  </div>
                                  -->
                                  <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="perfil">Perfil:</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text">
                                          <input type="radio" name="perfil" value="1"> SuperAdmin
                                        </div>
                                        <div class="input-group-text">
                                          <input type="radio" name="perfil" value="2" > Admin
                                        </div>
                                        <div class="input-group-text">
                                          <input type="radio" name="perfil" value="3" checked> Gerente
                                        </div>
                                        <div class="input-group-text">
                                          <input type="radio" name="perfil" value="4" > Vendedor
                                        </div>
                                        <div class="input-group-text">
                                          <input type="radio" name="perfil" value="5" > Logistica
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <div class="input-group">
                                      <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
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
                    <?php endif ?>
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
