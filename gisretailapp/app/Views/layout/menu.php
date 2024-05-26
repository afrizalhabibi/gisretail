<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="/" class="text-nowrap logo-img">
            <img src="../assets/images/logos/logo-home.svg" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?=base_url()?>" aria-expanded="false">
                <span>
                  <i class="fa-solid fa-location-dot"></i>
                </span>
                <span class="hide-menu">Peta Lokasi</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Kelola Data</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="/retail" aria-expanded="false">
                <span>
                <i class="fa-solid fa-store"></i>
                </span>
                <span class="hide-menu">Toko Swalayan</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="/pasar" aria-expanded="false">
                <span>
                <i class="fa-solid fa-star"></i>
                </span>
                <span class="hide-menu">Pasar</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->