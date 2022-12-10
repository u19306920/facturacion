<?php
if (isset($principal)) {
?>
  <!-- Header -->
  <header class="dt-header">

    <!-- Header container -->
    <div class="dt-header__container">

      <!-- Brand -->
      <div class="dt-brand">

        <!-- Brand tool -->
        <div class="dt-brand__tool" data-toggle="main-sidebar">
          <i class="icon icon-xl icon-menu-fold d-none d-lg-inline-block"></i>
          <i class="icon icon-xl icon-menu d-lg-none"></i>
        </div>
        <!-- /brand tool -->

        <!-- Brand logo -->
        <span class="dt-brand__logo">
        <a class="dt-brand__logo-link" href="index.php">
          <img src="assets/images/logo.png" width="48px" alt=""> <span class="brand-text">EMPRESA</span>
        </a>
      </span>
        <!-- /brand logo -->

      </div>
      <!-- /brand -->

      <!-- Header toolbar-->
      <div class="dt-header__toolbar">

        <!-- Search box -->
        <!--
        <form class="search-box d-none d-lg-block">
          <input class="form-control border-0" placeholder="Search in app..." value="" type="search">
          <span class="search-icon text-light-gray"><i class="icon icon-search icon-lg"></i></span>
        </form>
        -->
        <!-- /search box -->

        <!-- Header Menu Wrapper -->
        <div class="dt-nav-wrapper">
          
          <!-- Header Menu -->
          <ul class="dt-nav">
            <li class="dt-nav__item dt-notification-search dropdown">

              <!-- Dropdown Link -->
              <!--<a href="#" class="dt-nav__link dropdown-toggle no-arrow" data-toggle="dropdown"
                 aria-haspopup="true" aria-expanded="false"> <i class="icon icon-search-new icon-fw icon-lg"></i> </a>
              -->
              <!-- /dropdown link -->

              <!-- Dropdown Option -->
              <div class="dropdown-menu">

                <!-- Search Box -->
                <!--
                <form class="search-box right-side-icon">
                  <input class="form-control form-control-lg" type="search" placeholder="Search in app...">
                  <button type="submit" class="search-icon"><i class="icon icon-search icon-lg"></i></button>
                </form>
                -->
                <!-- /search box -->

              </div>
              <!-- /dropdown option -->

            </li>
          </ul>
          <!-- /header menu -->

          <!-- Header Menu -->
          <ul class="dt-nav">
            
            <li class="dt-nav__item dt-notification dropdown">
              <?php
                require_once('class/tablero.php');
                $objPendiente = new Tablero();
                $pendiente = $objPendiente->pendiente();

                if ($pendiente[0]['pendiente']!=0) {
                ?>
                <a href="index.php?module=ventas&page=comprobantes" class="dt-nav__link dropdown-toggle no-arrow" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false"> <i class="icon icon-notification icon-fw dt-icon-alert" style="font-size: 24px;"></i>
                   <div style="font-size: 18px; font-weight: bold; color: white; border-radius: 50%; background-color: #fd6565; width: 24px; height: 22px; text-align: center;">
                    <?php  
                      echo $pendiente[0]['pendiente'];
                    ?>
                   </div>
                </a>
                <?php
                }
              ?>
              <!--
              <div class="dropdown-menu dropdown-menu-right dropdown-menu-media">
                <div class="dropdown-menu-header">
                  <h4 class="title">Notifications (9)</h4>

                  <div class="ml-auto action-area">
                    <a href="javascript:void(0)">Mark All Read</a> <a class="ml-2" href="javascript:void(0)">
                    <i class="icon icon-setting icon-lg text-light-gray"></i> </a>
                  </div>
                </div>
                
                <div class="dropdown-menu-body ps-custom-scrollbar">

                  <div class="h-auto">
                    <a href="javascript:void(0)" class="media">
                      <img class="dt-avatar mr-3" src="assets/images/user02.png" alt="User">
                      <span class="media-body">
                        <span class="message">
                          <span class="user-name">Stella Johnson</span> and <span class="user-name">Chris Harris</span> have birthdays today. Help them celebrate!
                        </span>
                        <span class="meta-date">8 hours ago</span>
                      </span>
                    </a>
                    
                    <a href="javascript:void(0)" class="media">
                      <img class="dt-avatar mr-3" src="assets/images/user02.png" alt="User">
                      <span class="media-body">
                        <span class="message">
                          <span class="user-name">Jonathan Madano</span> commented on your post.
                        </span>
                        <span class="meta-date">9 hours ago</span>
                      </span>
                    </a>
                    
                    <a href="javascript:void(0)" class="media">
                      <img class="dt-avatar mr-3" src="assets/images/user02.png" alt="User">
                      <span class="media-body">
                        <span class="message">
                          <span class="user-name">Chelsea Brown</span> sent a video recomendation.
                        </span>
                        <span class="meta-date">
                          <i class="icon icon-menu-right text-primary icon-fw mr-1"></i>
                          13 hours ago
                        </span>
                      </span>
                    </a>
                    
                    <a href="javascript:void(0)" class="media">
                      <img class="dt-avatar mr-3" src="assets/images/user02.png" alt="User">
                      <span class="media-body">
                        <span class="message">
                          <span class="user-name">Alex Dolgove</span> and <span class="user-name">Chris Harris</span>
                          like your post.
                        </span>
                        <span class="meta-date">
                          <i class="icon icon-like text-light-blue icon-fw mr-1"></i>
                          yesterday at 9:30
                        </span>
                      </span>
                    </a>
                  </div>
                </div>
                <div class="dropdown-menu-footer">
                  <a href="javascript:void(0)" class="card-link"> See All <i class="icon icon-arrow-right icon-fw"></i>
                  </a>
                </div>
              </div>
              -->
            </li>

            <!--
            <li class="dt-nav__item dt-notification dropdown">
              <a href="#" class="dt-nav__link dropdown-toggle no-arrow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="icon icon-chat-new icon-fw"></i>
              </a>
              
              <div class="dropdown-menu dropdown-menu-right dropdown-menu-media">
                <div class="dropdown-menu-header">
                  <h4 class="title">Messages (6)</h4>

                  <div class="ml-auto action-area">
                    <a href="javascript:void(0)">Mark All Read</a> <a class="ml-2" href="javascript:void(0)">
                    <i class="icon icon-setting icon-lg text-light-gray"></i></a>
                  </div>
                </div>
                
                <div class="dropdown-menu-body ps-custom-scrollbar">

                  <div class="h-auto">
                    <a href="javascript:void(0)" class="media">
                      <img class="dt-avatar mr-3" src="assets/images/user02.png" alt="User">
                      <span class="media-body text-truncate">
                        <span class="user-name mb-1">Chris Mathew</span>
                        <span class="message text-light-gray text-truncate">Okay.. I will be waiting for your...</span>
                      </span>
                      <span class="action-area h-100 min-w-80 text-right">
                        <span class="meta-date mb-1">8 hours ago</span>
                        <span class="toggle-button" data-toggle="tooltip" data-placement="left" title="Mark as read">
                          <span class="show"><i class="icon icon-circle-o icon-fw f-10 text-light-gray"></i></span>
                          <span class="hide"><i class="icon icon-circle icon-fw f-10 text-light-gray"></i></span>
                        </span>
                      </span>
                    </a>
                    
                    <a href="javascript:void(0)" class="media">
                      <img class="dt-avatar mr-3" src="assets/images/user02.png" alt="User">
                      <span class="media-body text-truncate">
                        <span class="user-name mb-1">Alia Joseph</span>
                        <span class="message text-light-gray text-truncate">
                          Alia Joseph just joined Messenger! Be the first to send a welcome message or sticker.
                        </span>
                      </span>
                      <span class="action-area h-100 min-w-80 text-right">
                        <span class="meta-date mb-1">9 hours ago</span>
                          <span class="toggle-button" data-toggle="tooltip" data-placement="left" title="Mark as read">
                            <span class="show"><i class="icon icon-circle-o icon-fw f-10 text-light-gray"></i></span>
                            <span class="hide"><i class="icon icon-circle icon-fw f-10 text-light-gray"></i></span>
                          </span>
                      
                        </span>
                      </a>
                    
                    <a href="javascript:void(0)" class="media">
                      <img class="dt-avatar mr-3" src="assets/images/user02.png" alt="User">
                      <span class="media-body text-truncate">
                        <span class="user-name mb-1">Joshua Brian</span>
                        <span class="message text-light-gray text-truncate">
                          Alex will explain you how to keep the HTML structure and all that.
                        </span>
                      </span>
                      <span class="action-area h-100 min-w-80 text-right">
                        <span class="meta-date mb-1">12 hours ago</span>
                          <span class="toggle-button" data-toggle="tooltip" data-placement="left" title="Mark as read">
                            <span class="show"><i class="icon icon-circle-o icon-fw f-10 text-light-gray"></i></span>
                            <span class="hide"><i class="icon icon-circle icon-fw f-10 text-light-gray"></i></span>
                          </span>
                      </span>
                    </a>
                    
                    <a href="javascript:void(0)" class="media">
                      <img class="dt-avatar mr-3" src="assets/images/user02.png" alt="User">
                      <span class="media-body text-truncate">
                        <span class="user-name mb-1">Domnic Brown</span>
                        <span class="message text-light-gray text-truncate">Okay.. I will be waiting for your...</span>
                      </span>
                      <span class="action-area h-100 min-w-80 text-right">
                        <span class="meta-date mb-1">yesterday</span>
                          <span class="toggle-button" data-toggle="tooltip" data-placement="left" title="Mark as read">
                            <span class="show"><i class="icon icon-circle-o icon-fw f-10 text-light-gray"></i></span>
                            <span class="hide"><i class="icon icon-circle icon-fw f-10 text-light-gray"></i></span>
                          </span>
                      </span>
                    </a>
                  </div>
                </div>
                <div class="dropdown-menu-footer">
                  <a href="javascript:void(0)" class="card-link"> See All <i class="icon icon-arrow-right icon-fw"></i>
                  </a>
                </div>
              </div>
            </li>
            -->
          </ul>
          <!-- /header menu -->

          <!-- Header Menu -->
          <!--
          <ul class="dt-nav">
            <li class="dt-nav__item dropdown">
              <a href="#" class="dt-nav__link dropdown-toggle" data-toggle="dropdown"
                 aria-haspopup="true"
                 aria-expanded="false">
                <i class="flag-icon flag-icon-es mr-2"></i><span>Español</span> </a>
              
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="javascript:void(0)">
                  <i class="flag-icon flag-icon-es mr-2"></i><span>Español</span> </a>
                <a class="dropdown-item" href="javascript:void(0)">
                  <i class="flag-icon flag-icon-us mr-2"></i><span>English</span> </a>
                <a class="dropdown-item" href="javascript:void(0)">
                  <i class="flag-icon flag-icon-cn mr-2"></i><span>Chinese</span> </a>
                <a class="dropdown-item" href="javascript:void(0)">
                  <i class="flag-icon flag-icon-fr mr-2"></i><span>French</span> </a>
                <a class="dropdown-item" href="javascript:void(0)">
                  <i class="flag-icon flag-icon-it mr-2"></i><span>Italian</span> </a>
                <a class="dropdown-item" href="javascript:void(0)">
                  <i class="flag-icon flag-icon-sa mr-2"></i><span>Arabic</span> </a>
              </div>
            </li>
          </ul>
          -->
          <!-- /header menu -->

          <!-- Header Menu -->
          <ul class="dt-nav">
            <li class="dt-nav__item dropdown">

              <!-- Dropdown Link -->
              <a href="#" class="dt-nav__link dropdown-toggle no-arrow dt-avatar-wrapper"
                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="dt-avatar size-40" src="assets/images/user02.png" alt="Domnic Harris">
              </a>
              <!-- /dropdown link -->

              <!-- Dropdown Option -->
              <div class="dropdown-menu dropdown-menu-right">
                <div class="dt-avatar-wrapper flex-nowrap p-6 mt--5 bg-gradient-purple text-white rounded-top">
                  <img class="dt-avatar" src="assets/images/user02.png" alt="Domnic Harris">
                  <span class="dt-avatar-info">
                  <span class="dt-avatar-name"><?=$_SESSION['empleado']?></span>
                  <span class="f-12">Administrador</span>
                </span>
                </div>
                <!--<a class="dropdown-item" href="javascript:void(0)"> <i class="icon icon-user-o icon-fw mr-2 mr-sm-1"></i>Cuenta </a>-->
                <!--<a class="dropdown-item" href="javascript:void(0)"> <i class="icon icon-setting icon-fw mr-2 mr-sm-1"></i>Configuración </a>-->
                <a class="dropdown-item" href="index.php?module=configuracion&page=cambiar"> <i class="fas fa-key"></i> Cambiar contraseña</a>
                <a class="dropdown-item" href="logout.php"> <i class="fas fa-sign-out-alt"></i> Salir </a>
              </div>
              <!-- /dropdown option -->

            </li>
          </ul>
          <!-- /header menu -->
          
          <ul class="" style="margin-top: 0px; list-style: none; left: 50%; margin-left: -100px; position: absolute; left: 50%; width: 160px;">
            <li id="clockdate">
              <div class="clockdate-wrapper">
                <div id="clock"></div>
                <div id="date"></div>
              </div>
            </li>
          </ul>
        </div>
        <!-- Header Menu Wrapper -->

      </div>
      <!-- /header toolbar -->

    </div>
    <!-- /header container -->

  </header>
  <!-- /header -->
<?php
}
else{
  header('Location: ../../login.php');
}
?>