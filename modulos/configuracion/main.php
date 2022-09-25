<?php
if (isset($principal)) {
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
                  <h3 class="dt-card__title">Configuración</h3><!--Titulo-->
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
                       aria-controls="tab-pane-1" aria-selected="true"><i class="fas fa-file"></i> General
                    </a>
                  </li>
                </ul>
                <!-- /tab navigation -->
                <!-- Tab Content -->
                <div class="tab-content">
                  <div class="card-body">
                    <div class="row">
                      <!-- Grid Item -->
                      <div class="col-sm-6">
                        <!-- Card -->
                        <div class="dt-card">
                          <!-- Card Header -->
                          <div class="dt-card__header">
                            <!-- Card Heading -->
                            <div class="dt-card__heading">
                              <h3 class="dt-card__title">Empresa</h3>
                            </div>
                            <!-- /card heading -->
                          </div>
                          <!-- /card header -->
                          <!-- Card Body -->
                          <div class="dt-card__body">
                            <!-- Tables -->
                            <div class="table-responsive">
                              <ul>
                                <li>Datos de la Empresa</li>
                                <li>Locales</li>
                                <li>Cuentas Bancarias</li>
                                <li>Certificado</li>
                              </ul>
                            </div>
                            <!-- /tables -->
                          </div>
                          <!-- /card body -->
                        </div>
                        <!-- /card -->
                      </div>
                      <!-- /grid item -->
                      <!-- Grid Item -->
                      <div class="col-sm-6">

                        <!-- Card -->
                        <div class="dt-card">
                          <!-- Card Header -->
                          <div class="dt-card__header">

                            <!-- Card Heading -->
                            <div class="dt-card__heading">
                              <h3 class="dt-card__title">Documentos</h3>
                            </div>
                            <!-- /card heading -->

                          </div>
                          <!-- /card header -->
                          <!-- Card Body -->
                          <div class="dt-card__body">
                            <!-- Tables -->
                            <div class="table-responsive">
                              <ul>
                                <li><a href="index.php?module=configuracion&page=series">Series de Comprobantes</a></li>
                                <li><a href="index.php?module=configuracion&page=series_correlativo">Correlativos</a></li>
                                <li><a href="index.php?module=configuracion&page=formas_pago">Formas de Pago</a></li>
                                <li><a href="index.php?module=configuracion&page=tipo_ordenes">Tipos de Ordenes</a></li>
                              </ul>
                            </div>
                            <!-- /tables -->
                          </div>
                          <!-- /card body -->
                        </div>
                        <!-- /card -->
                      </div>
                      <!-- /grid item -->
                      <!-- Grid Item -->
                      <div class="col-sm-6">
                        <!-- Card -->
                        <div class="dt-card">
                          <!-- Card Header -->
                          <div class="dt-card__header">
                            <!-- Card Heading -->
                            <div class="dt-card__heading">
                              <h3 class="dt-card__title">Usuarios</h3>
                            </div>
                            <!-- /card heading -->
                          </div>
                          <!-- /card header -->
                          <!-- Card Body -->
                          <div class="dt-card__body">
                            <!-- Tables -->
                            <div class="table-responsive">
                              <ul>
                                <li>Usuarios</li>
                                <li>Perfiles</li>
                                <li>Permisos</li>
                              </ul>
                            </div>
                            <!-- /tables -->
                          </div>
                          <!-- /card body -->
                        </div>
                        <!-- /card -->
                      </div>
                      <!-- /grid item -->
                      <!-- Grid Item -->
                      <div class="col-sm-6">
                        <!-- Card -->
                        <div class="dt-card">
                          <!-- Card Header -->
                          <div class="dt-card__header">
                            <!-- Card Heading -->
                            <div class="dt-card__heading">
                              <h3 class="dt-card__title">Sunat</h3>
                            </div>
                            <!-- /card heading -->
                          </div>
                          <!-- /card header -->
                          <!-- Card Body -->
                          <div class="dt-card__body">
                            <!-- Tables -->
                            <div class="table-responsive">
                              <ul>
                                <li>Tipo de Detracción</li>
                                <li><a href="index.php?module=configuracion&page=tipo_cambio">Tipo de Cambio</a></li>
                                <li>Unidades de Medida</li>                                  
                              </ul>
                            </div>
                            <!-- /tables -->
                          </div>
                          <!-- /card body -->
                        </div>
                        <!-- /card -->
                      </div>
                      <!-- /grid item -->
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
      <!-- /site content -->
<?php 
}
else{
  header('Location: ../../login.php');
}
?>