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
          <h1 class="dt-page__title"></h1>
        </div>
        <!-- /page header -->
        <div class="row">

          <!-- Grid Item -->
          <div class="col-12">

            <!-- Card -->
            <div class="dt-card">

              <!-- Card Header -->
              <div class="dt-card__header">

                <!-- Card Heading -->
                <div class="dt-card__heading">
                  <h3 class="dt-card__title">Cliente: </h3>
                </div>
                <!-- /card heading -->

              </div>
              <!-- /card header -->

              <!-- Card Body -->
              <div class="dt-card__body">
                <h2><?=$entidad[0]['razon_social_nombres']?></h2>
                <h4><?=$entidad[0]['ruc_dni']?></h4>
                <h4 style="text-transform: uppercase;">
                  <?php
                  echo $entidad[0]['direccion_fiscal']." - ";
                  $ubicaciones = new Entidades3();
                  $ubicacion = $ubicaciones->ubigeo($entidad[0]['ubigeo']);
                  echo $ubicacion[0]['distrito']." - ".$ubicacion[0]['provincia']." - ".$ubicacion[0]['departamento'];
                  ?>
                </h4>
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
          <div class="col-xl-6">

            <!-- Entry Header -->
            <div class="dt-entry__header">

              <!-- Entry Heading -->
              <div class="dt-entry__heading">
                <h3 class="dt-entry__title"><i class="fa fa-fw fa-warehouse"></i> Direcciones</h3>
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
                      <th class="text-uppercase" scope="col">Dirección</th>
                      <th class="text-uppercase" scope="col">Ubigeo</th>
                      <th class="text-uppercase" scope="col">Estado</th>
                      <th class="text-uppercase" scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        require('class/direcciones.php');
                        $objDirecciones = new Direcciones();
                        $direcciones = $objDirecciones->direccionPorIdEntidad($identidades);
                        if($direcciones > 0){
                          $i=0;
                          foreach ($direcciones as $direccion){
                            $i=$i+1;
                      ?>
                    <tr>
                      <th scope="row"><?=$i?></th>
                      <td><?=$direccion['direccion']?></td>
                      <td><?=$direccion['ubigeo']?></td>
                      <td><?php if($direccion['estado']==1){ echo "ACTIVO";}?></td>
                      <td><a title="Eliminar" href="modulos/ventas/direcciones_eliminar.php?id=<?=$direccion['iddirecciones']?>"><i class="fa fa-fw fa-trash"></i></a></td>
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
          <!-- Grid Item -->
          <div class="col-xl-6">

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