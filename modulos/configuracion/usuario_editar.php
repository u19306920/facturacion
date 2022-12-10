<?php

  if (isset($principal)) {
    require('class/usuarios.php');
    require('class/encriptacion.php');
    $idusuarios = $_GET['id'];

    $idusuarios = openssl_decrypt ($idusuarios, $ciphering, $decryption_key, $options, $decryption_iv);

    $objUsuarios = new Usuarios();
    $usuarios = $objUsuarios->usuarioPorId($idusuarios);

    //print_r($_SESSION);

    //echo $idusuarios;
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
                         aria-controls="tab-pane-1" aria-selected="true"><i class="fas fa-user-tie"></i> Editar Usuario
                      </a>
                    </li>
                  </ul>
                  <!-- /tab navigation -->

                  <!-- Tab Content -->
                  <div class="tab-content">
                    <!-- Tab Pane -->
                    <div id="tab-pane-1" class="tab-pane active">
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
                                  <h3 class="dt-card__title">Editar Registro</h3>
                                </div>
                                <!-- /card heading -->

                              </div>
                              <!-- /card header -->

                              <!-- Card Body -->
                              <div class="dt-card__body">

                                <!-- Form -->
                                <form class="" action="modulos/configuracion/usuario_editar_guardar.php" method="POST">
                                   <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="nombres">NOMBRES:</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="far fa-user"></i></span>
                                      </div>
                                      <input type="text" class="form-control" id="nombres" name="nombres" value="<?=$usuarios[0]['nombres']?>" <?php if ($_SESSION['estado']!=1) { echo  "readonly";} ?>>
                                    </div>
                                  </div>
                                   <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="apellidos">APELLIDO:</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="far fa-user"></i></span>
                                      </div>
                                      <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?=$usuarios[0]['apellidos']?>" <?php if ($_SESSION['estado']!=1) { echo  "readonly";} ?>>
                                    </div>
                                  </div>
                                  <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="dni">DNI:</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-id-card"></i></span>
                                      </div>
                                      <input type="number" class="form-control" id="dni" name="dni" value="<?=$usuarios[0]['dni']?>" <?php if ($_SESSION['estado']!=1) { echo  "readonly";} ?>>
                                    </div>
                                  </div>
                                  <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="usuario">USUARIO:</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="far fa-user"></i></span>
                                      </div>
                                      <input type="text" class="form-control" id="usuario" name="usuario" value="<?=$usuarios[0]['usuario']?>">
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
                                          <input type="radio" name="perfil" value="1" <?php if ($usuarios[0]['estado']==1){ echo "checked";} ?> <?php if($_SESSION['estado']>1){ echo "disabled";}?>> SuperAdmin
                                        </div>
                                        <div class="input-group-text">
                                          <input type="radio" name="perfil" value="2" <?php if ($usuarios[0]['estado']==2){ echo "checked";} ?> <?php if($_SESSION['estado']>1){ echo "disabled";}?>> Admin
                                        </div>
                                        <div class="input-group-text">
                                          <input type="radio" name="perfil" value="3" <?php if ($usuarios[0]['estado']==3){ echo "checked";} ?>> Gerente
                                        </div>
                                        <div class="input-group-text">
                                          <input type="radio" name="perfil" value="4" <?php if ($usuarios[0]['estado']==4){ echo "checked";} ?>> Vendedor
                                        </div>
                                        <div class="input-group-text">
                                          <input type="radio" name="perfil" value="5" <?php if ($usuarios[0]['estado']==5){ echo "checked";} ?>> Logistica
                                          <input type="hidden" name="idusuarios" value="<?=$idusuarios?>">
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
