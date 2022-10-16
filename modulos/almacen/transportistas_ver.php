<?php
if (isset($principal)) {
  require('class/transportistas.php');
  $idtransportistas = $_GET['id'];

  $transportistas = new Transportistas();
  $transportista = $transportistas->transportistaPorId($idtransportistas);
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
                  <h3 class="dt-card__title">Transportista: </h3>
                </div>
                <!-- /card heading -->

              </div>
              <!-- /card header -->

              <!-- Card Body -->
              <div class="dt-card__body">
                <h2><?=$transportista[0]['razon_social']?></h2>
                <h4><?=$transportista[0]['ruc']?></h4>
                <h4><?=$transportista[0]['direccion']?></h4>
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
                <h3 class="dt-entry__title"><i class="fa fa-fw fa-truck"></i> Vehículos</h3>
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
                      <th class="text-uppercase" scope="col">Marca</th>
                      <th class="text-uppercase" scope="col">Placa</th>
                      <th class="text-uppercase" scope="col">Const. Inscr.</th>
                      <th class="text-uppercase" scope="col">Estado</th>
                      <th class="text-uppercase" scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        require('class/vehiculos.php');
                        $objVehiculos = new Vehiculos();
                        $Vehiculos = $objVehiculos->vehiculosPorIdTransportista($idtransportistas);
                        if($Vehiculos > 0){
                          $i=0;
                          foreach ($Vehiculos as $vehiculo){
                            $i=$i+1;
                      ?>
                    <tr>
                      <th scope="row"><?=$i?></th>
                      <td><?=$vehiculo['marca']?></td>
                      <td><?=$vehiculo['placa']?></td>
                      <td><?=$vehiculo['inscripcion']?></td>
                      <td><?php if($vehiculo['estado']==1){ echo "ACTIVO";}?></td>
                      <td><i class="fa fa-fw fa-edit"></i> <a title="Eliminar" href="/modulos/almacen/vehiculos_eliminar.php?id=<?=$vehiculo['idvehiculos']?>"><i class="fa fa-fw fa-trash"></i></a></td>
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
                <h3 class="dt-entry__title"><i class="fa fa-fw fa-user-tie"></i> Conductores</h3>
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
                      <th class="text-uppercase" scope="col">Nombres</th>
                      <th class="text-uppercase" scope="col">Licencia</th>
                      <th class="text-uppercase" scope="col">Estado</th>
                      <th class="text-uppercase" scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        require('class/conductores.php');
                        $objConductores = new Conductores();
                        $Conductores = $objConductores->conductoresPorIdTransportista($idtransportistas);
                        if($Conductores > 0){
                          $i=0;
                          foreach ($Conductores as $conductor){
                            $i=$i+1;
                      ?>
                    <tr>
                      <th scope="row"><?=$i?></th>
                      <td><?=$conductor['nombres']?></td>
                      <td><?=$conductor['licencia']?></td>
                      <td><?php if($conductor['estado']==1){ echo "ACTIVO";}?></td>
                      <td><i class="fa fa-fw fa-edit"></i> <a title="Eliminar" href="/modulos/almacen/conductores_eliminar.php?id=<?=$conductor['idconductores']?>"><i class="fa fa-fw fa-trash"></i></a></td>
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