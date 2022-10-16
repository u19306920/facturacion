<?php
if (isset($principal)) {
  require('class/clientes.php');
  $identidades = $_GET['id'];

  $entidades = new Entidades();
  $entidad = $entidades->entidadPorId($identidades);
?>
      <div class="dt-content">

        <!-- Page Header -->
        <div class="dt-page__header">
          <h1 class="dt-page__title"><?=$entidad[0]['razon_social_nombres']?></h1>
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
                  <h3 class="dt-card__title"><i class="fa fa-fw fa-user"></i> Agregar Contacto</h3>
                </div>
                <!-- /card heading -->

              </div>
              <!-- /card header -->

              <!-- Card Body -->
              <div class="dt-card__body">

                <!-- Form -->
                <form action="modulos/ventas/contactos_guardar.php" method="POST">
                  <div class="form-row">
                    <div class="col-sm-6 mb-3">
                      <label for="nombres_apellidos">Nombres y Apellidos</label>
                      <input type="text" class="form-control" id="nombres_apellidos" name="nombres_apellidos" placeholder="Nombres y Apellidos" required="">
                    </div>
                    <div class="col-sm-3 mb-3">
                      <label for="correo">Correo</label>
                      <input type="text" class="form-control" id="correo" name="correo" placeholder="Correo" required="">
                    </div>
                    <div class="col-sm-3 mb-3">
                      <label for="telefono">Teléfono</label>
                      <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" required="">
                    </div>
                    <div class="col-sm-3 mb-3">
                      <label for="estado">Estado</label>
                      <select class="form-control" id="estado" name="estado">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                      </select>
                      <input type="hidden" name="identidades" value="<?=$identidades?>">
                    </div>
                  </div>
                  <button class="btn btn-primary" type="submit">Guardar</button>
                </form>
                <!-- /form -->

              </div>
              <!-- /card body -->

            </div>
            <!-- /card -->

          </div>

        </div>
        <!-- /grid -->
        <!-- Grid -->
        <div class="row">
          <!-- Grid Item -->
          <div class="col-xl-12">

            <!-- Entry Header -->
            <div class="dt-entry__header">

              <!-- Entry Heading -->
              <div class="dt-entry__heading">
                <h3 class="dt-entry__title"><i class="fa fa-fw fa-user"></i> Contactos</h3>
              </div>
              <!-- /entry heading -->

            </div>
            <!-- /entry header -->

            <!-- Card -->
            <div class="dt-card overflow-hidden">

              <!-- Card Body -->
              <div class="dt-card__body p-0">

                <!-- Tables -->
                <div class="table-responsive">
                  <table class="table table-hover mb-0">
                    <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th class="text-uppercase" scope="col">Nombres y Apellidos</th>
                      <th class="text-uppercase" scope="col">Correo</th>
                      <th class="text-uppercase" scope="col">Telefono</th>
                      <th class="text-uppercase" scope="col">Estado</th>
                      <th class="text-uppercase" scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        require('class/contactos.php');
                        $objContactos = new Contactos();
                        $Contactos = $objContactos->contactoPorIdEntidad($identidades);
                        if($Contactos > 0){
                          $i=0;
                          //print_r($Contactos);
                          foreach ($Contactos as $contacto){
                            $i=$i+1;
                      ?>
                    <tr>
                      <th scope="row"><?=$i?></th>
                      <td><?=$contacto['nombres_apellidos']?></td>
                      <td><?=$contacto['correo']?></td>
                      <td><?=$contacto['telefono']?></td>
                      <td><?php if($contacto['estado']==1){ echo "ACTIVO";}?></td>
                      <td><a title="Eliminar" href="modulos/ventas/contactos_eliminar.php?id=<?=$contacto['idcontactos']?>"><i class="fa fa-fw fa-trash"></i></a></td>
                    </tr>
                    <?php
                        }
                      }
                    ?>
                    </tbody>
                  </table>
                </div>
                <!-- /tables -->

              </div>
              <!-- /card body -->

            </div>
            <!-- /card -->

          </div>
          <!-- /grid item -->     
        </div>
        <!-- /grid -->
      </div>
<?php
}
else{
  header('Location: ../../login.php');
}
?>