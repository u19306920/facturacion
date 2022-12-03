<?php
if (isset($principal)) {
  //require('class/clientes.php');
  //$identidades = $_GET['id'];

  //$entidades = new Entidades();
  //$entidad = $entidades->entidadPorId($identidades);
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
                  <h3 class="dt-card__title">Empresa: </h3>
                </div>
                <!-- /card heading -->

              </div>
              <!-- /card header -->

              <!-- Card Body -->
              <div class="dt-card__body">
                <h2>DEMO SAC</h2>
                <h4>20000000000</h4>
                <h4 style="text-transform: uppercase;">
                  <?php
                  echo "AV. PERU 123 - LIMA - LIMA - LIMA";
                  //$ubicaciones = new Entidades3();
                  //$ubicacion = $ubicaciones->ubigeo($entidad[0]['ubigeo']);
                  //echo $ubicacion[0]['distrito']." - ".$ubicacion[0]['provincia']." - ".$ubicacion[0]['departamento'];
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
          <div class="col-xl-12">

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
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        /*require('class/direcciones.php');
                        $objDirecciones = new Direcciones();
                        $direcciones = $objDirecciones->direccionPorIdEntidad($identidades);
                        if($direcciones > 0){
                          $i=0;
                          foreach ($direcciones as $direccion){
                            $i=$i+1;*/
                      ?>
                    <tr>
                      <th scope="row">1</th>
                      <td>AV. PERU 123 LIMA - LIMA - LIMA</td>
                      <td>150101</td>
                      <td>ACTIVO</td>
                    </tr>
                      <?php
                          /*}
                        }*/
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