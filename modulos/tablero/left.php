<?php
if (isset($principal)) {
?>
    <!-- Sidebar -->
    <aside id="main-sidebar" class="dt-sidebar">
      <div class="dt-sidebar__container">
        
        <!-- Sidebar Navigation -->
        <ul class="dt-side-nav">

          <!-- Menu Header -->
          <li class="dt-side-nav__item dt-side-nav__header">
            <span class="dt-side-nav__text">Menú</span>
          </li>
          <!-- /menu header -->

          <!-- Menu Item -->
          <li class="dt-side-nav__item <?php if($module=="tablero" and $page="main"){ echo 'open selected';}?>">
            <a href="index.php" class="dt-side-nav__link" title="Tablero">
              <i class="icon icon-dashboard icon-fw icon-xl"></i> <span class="dt-side-nav__text">Tablero</span>
            </a>
          </li>
        
          <li class="dt-side-nav__item">
            <a href="javascript:void(0)" class="dt-side-nav__link dt-side-nav__arrow" title="Ventas">
              <i class="icon icon-widgets icon-fw icon-xl"></i>
              <span class="dt-side-nav__text">Ventas</span> </a>
            <ul class="dt-side-nav__sub-menu">
              
              <li class="dt-side-nav__item">
                <a href="index.php?module=ventas&page=comprobantes" class="dt-side-nav__link" title="Comprobantes">
                  <span class="dt-side-nav__text">Comprobantes</span> </a>
              </li>
              <li class="dt-side-nav__item">
                <a href="index.php?module=ventas&page=clientes" class="dt-side-nav__link" title="Clientes">
                  <span class="dt-side-nav__text">Clientes</span> </a>
              </li>
            </ul>
          </li>
        
          <!--
          <li class="dt-side-nav__item">
            <a href="javascript:void(0)" class="dt-side-nav__link dt-side-nav__arrow" title="Compras">
              <i class="icon icon-apps icon-fw icon-xl"></i>
              <span class="dt-side-nav__text">Compras</span>
            </a>
            <ul class="dt-side-nav__sub-menu">
              
              <li class="dt-side-nav__item">
                <a href="index.php?module=compras&page=compras" class="dt-side-nav__link" title="Compras">
                  <span class="dt-side-nav__text">Compras</span> </a>
              </li>
              <li class="dt-side-nav__item">
                <a href="index.php?module=compras&page=ordenes" class="dt-side-nav__link" title="Ordenes de compra">
                  <span class="dt-side-nav__text">Ordenes de Compra</span> </a>
              </li>
              <li class="dt-side-nav__item">
                <a href="index.php?module=compras&page=proveedores" class="dt-side-nav__link" title="Proveedores">
                  <span class="dt-side-nav__text">Proveedores</span> </a>
              </li>
              <li class="dt-side-nav__item">
                <a href="index.php?module=compras&page=reportes" class="dt-side-nav__link" title="Reportes">
                  <span class="dt-side-nav__text">Reportes</span> </a>
              </li>
            </ul>
          </li>
          -->
          <li class="dt-side-nav__item <?php if($module=="almacen"){ echo 'open selected';}?>">
            <a href="javascript:void(0)" class="dt-side-nav__link dt-side-nav__arrow" title="Almacén">
              <i class="icon icon-card icon-fw icon-xl"></i><span class="dt-side-nav__text">Almacén</span>
            </a>
            <ul class="dt-side-nav__sub-menu">
              <li class="dt-side-nav__item">
                <a href="index.php?module=almacen&page=ordenes" class="dt-side-nav__link" title="Ordenes">
                  <span class="dt-side-nav__text">Ordenes</span> </a>
              </li>
              <li class="dt-side-nav__item">
                <a href="index.php?module=almacen&page=guias" class="dt-side-nav__link" title="Despachos">
                  <span class="dt-side-nav__text">Guias de Remisión</span> </a>
              </li>
              <li class="dt-side-nav__item">
                <a href="index.php?module=almacen&page=items" class="dt-side-nav__link" title="Items">
                  <span class="dt-side-nav__text">Items</span> </a>
              </li>
              <li class="dt-side-nav__item <?php if($module=="almacen" and ($page=="transportistas" or $page=="transportistas_ver" or $page=="vehiculos" or $page=="conductores")){ echo 'selected open';}?>">
                <a href="index.php?module=almacen&page=transportistas" class="dt-side-nav__link <?php if($module=="almacen" and ($page=="transportistas" or $page=="transportistas_ver" or $page=="vehiculos" or $page=="conductores")){ echo 'active';}?>" title="Items">
                  <span class="dt-side-nav__text">Transportistas</span> </a>
              </li>
            </ul>
          </li>
        
          <!--
          <li class="dt-side-nav__item">
            <a href="javascript:void(0)" class="dt-side-nav__link dt-side-nav__arrow" title="Producción">
              <i class="icon icon-extensions icon-fw icon-xl"></i>
              <span class="dt-side-nav__text">Producción</span>
            </a>
            <ul class="dt-side-nav__sub-menu">
              
              <li class="dt-side-nav__item">
                <a href="index.php?module=produccion&page=ordenes" class="dt-side-nav__link" title="Ordenes de producción">
                  <span class="dt-side-nav__text">Ordenes de Trabajo</span> </a>
              </li>
              
              <li class="dt-side-nav__item">
                <a href="index.php?module=produccion&page=Ordenes_Servicios" class="dt-side-nav__link" title="Ordenes de servicios">
                  <span class="dt-side-nav__text">Ordenes Servicios</span> </a>
              </li>
              <li class="dt-side-nav__item">
                <a href="index.php?module=produccion&page=Ordenes_Terceros" class="dt-side-nav__link" title="Ordenes de terceros">
                  <span class="dt-side-nav__text">Ordenes a Terceros</span> </a>
              </li>
              
            </ul>
          </li>
          -->
          <!--
          <li class="dt-side-nav__item">
            <a href="javascript:void(0)" class="dt-side-nav__link dt-side-nav__arrow" title="Contabilidad">
              <i class="icon icon-chart icon-fw icon-xl"></i>
              <span class="dt-side-nav__text">Contabilidad</span>
            </a>
            <ul class="dt-side-nav__sub-menu">
              
              <li class="dt-side-nav__item">
                <a href="index.php?module=contabilidad&page=plan_de_cuentas" class="dt-side-nav__link" title="Plan de Cuentas">
                  <span class="dt-side-nav__text">Plan de Cuentas</span> </a>
              </li>
              <li class="dt-side-nav__item">
                <a href="index.php?module=contabilidad&page=registro_compras" class="dt-side-nav__link" title="Registro Compras">
                  <span class="dt-side-nav__text">Registro Compras</span> </a>
              </li>
              <li class="dt-side-nav__item">
                <a href="index.php?module=contabilidad&page=registro_ventas" class="dt-side-nav__link" title="Registro Ventas">
                  <span class="dt-side-nav__text">Registro Ventas</span> </a>
              </li>
              <li class="dt-side-nav__item">
                <a href="index.php?module=contabilidad&page=formatos_txt" class="dt-side-nav__link" title="Formatos TXT">
                  <span class="dt-side-nav__text">Formatos TXT</span> </a>
              </li>
              <li class="dt-side-nav__item">
                <a href="index.php?module=contabilidad&page=reportes" class="dt-side-nav__link" title="Reportes">
                  <span class="dt-side-nav__text">Reportes</span> </a>
              </li>
            </ul>
          </li>
          -->
          <!--
          <li class="dt-side-nav__item">
            <a href="javascript:void(0)" class="dt-side-nav__link dt-side-nav__arrow" title="Finanzas">
              <i class="icon icon-chart-pie icon-fw icon-xl"></i>
              <span class="dt-side-nav__text">Finanzas</span>
            </a>
            <ul class="dt-side-nav__sub-menu">
              
              <li class="dt-side-nav__item">
                <a href="index.php?module=finanzas&page=cuentas_por_cobrar" class="dt-side-nav__link" title="Cuentas por cobrar">
                  <span class="dt-side-nav__text">Cuentas por cobrar</span> </a>
              </li>
              <li class="dt-side-nav__item">
                <a href="index.php?module=finanzas&page=cuentas_por_pagar" class="dt-side-nav__link" title="Cuentas por pagar">
                  <span class="dt-side-nav__text">Cuentas por pagar</span> </a>
              </li>
              <li class="dt-side-nav__item">
                <a href="index.php?module=finanzas&page=cajas_chicas" class="dt-side-nav__link" title="Cajas chicas">
                  <span class="dt-side-nav__text">Cajas chicas</span> </a>
              </li>
              <li class="dt-side-nav__item">
                <a href="index.php?module=finanzas&page=cajas_bancos" class="dt-side-nav__link" title="Cajas bancos">
                  <span class="dt-side-nav__text">Cajas bancos</span> </a>
              </li>
              <li class="dt-side-nav__item">
                <a href="index.php?module=finanzas&page=movimientos" class="dt-side-nav__link" title="Movimientos">
                  <span class="dt-side-nav__text">Movimientos</span> </a>
              </li>
              <li class="dt-side-nav__item">
                <a href="index.php?module=finanzas&page=reportes" class="dt-side-nav__link" title="Reportes">
                  <span class="dt-side-nav__text">Reportes</span> </a>
              </li>
            </ul>
          </li>
          -->
          <!--
          <li class="dt-side-nav__item">
            <a href="#" class="dt-side-nav__link dt-side-nav__arrow" title="Rrhh"> <i class="icon icon-contacts icon-fw icon-xl"></i>
              <span class="dt-side-nav__text">Rrhh</span> </a>
          </li>
          -->
          <li class="dt-side-nav__item">
            <a href="index.php?module=configuracion&page=main" class="dt-side-nav__link dt-side-nav__arrow" title="Configuración">
              <i class="icon icon-setting icon-fw icon-xl"></i>
              <span class="dt-side-nav__text">Configuración</span>
            </a>
          </li>
          <!-- /menu item -->

        </ul>
        <!-- /sidebar navigation -->

      </div>
    </aside>
    <!-- /sidebar -->
<?php
}
else{
  header('Location: ../../login.php');
}
?>