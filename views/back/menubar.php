<?php 
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>
 
 <!-- Menu -->

 <aside
          id="layout-menu"
          class="layout-menu menu-vertical menu bg-menu-theme"
        >
          <div class="app-brand demo">
            <a href="index.php" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="assets/img/img_logo.png" style="height:30px;width:30px;" alt="image logo" />
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2"
                >Learn Hub</span
              >
            </a>

            <a
              href="javascript:void(0);"
              class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none"
            >
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item <?= isPageActive('index.php') ? 'active' : '' ?>">
              <a href="index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>

         
            <?php if ($_SESSION['role'] === 'admin') : ?>
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Users</span>
    </li>
    <li class="menu-item <?= isPageActive('users_lists.php') || isPageActive('create_user.php') ? 'active' : '' ?>">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-dock-top"></i>
            <div data-i18n="Account Settings">User Management</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item">
                <a href="users_lists.php" class="menu-link">
                    <div data-i18n="Account">List</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="create_user.php" class="menu-link">
                    <div data-i18n="Notifications">Create Account</div>
                </a>
            </li>
        </ul>
    </li>
<?php endif; ?>
          
            <!-- Components -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Formations</span>
            </li>

            <!-- User interface -->
            <li class="menu-item <?= isPageActive('formations_lists.php') || isPageActive('create_formation.php') ? 'active' : '' ?>">
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="User interface">Formation Management</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="formations_lists.php" class="menu-link">
                    <div data-i18n="Accordion">List</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="create_formation.php" class="menu-link">
                    <div data-i18n="Accordion">Create Formation</div>
                  </a>
                </li>
             
              </ul>
            </li>

            <?php if ($_SESSION['role'] === 'admin') : ?>

            <!-- Forms & Tables -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Formation Type</span>
            </li>
            <!-- Forms -->
            <li class="menu-item <?= isPageActive('types_lists.php') || isPageActive('create_type.php')  ? 'active' : '' ?>">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Type Management</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="types_lists.php" class="menu-link">
                    <div data-i18n="Basic Inputs">List</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="create_type.php" class="menu-link">
                    <div data-i18n="Input groups">Create Type</div>
                  </a>
                </li>
              </ul>
            </li>
        
            <?php endif; ?>
            
           
           
          </ul>
        </aside>
        <!-- / Menu -->


<?php
function isPageActive($pageName) {
    $currentPage = basename($_SERVER['PHP_SELF']);
    return ($currentPage === $pageName);
}
?>