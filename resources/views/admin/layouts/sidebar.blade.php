<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('images/admin/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="overflow-y: auto;">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <?php
        if(Auth::guard('admin')->user()->image)
        {
          $profileImage = asset('storage/profile/'.Auth::guard('admin')->user()->image);
        }
        else{
          $profileImage = asset('images/admin/avatar.png');
        }
        ?>
          <img src=" {{ $profileImage }} " class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <span class="d-block" style="color:#fff;">{{ Auth::guard('admin')->user()->name }}</span>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div><div class="sidebar-search-results"><div class="list-group"><a href="#" class="list-group-item"><div class="search-title"><strong class="text-light"></strong>N<strong class="text-light"></strong>o<strong class="text-light"></strong> <strong class="text-light"></strong>e<strong class="text-light"></strong>l<strong class="text-light"></strong>e<strong class="text-light"></strong>m<strong class="text-light"></strong>e<strong class="text-light"></strong>n<strong class="text-light"></strong>t<strong class="text-light"></strong> <strong class="text-light"></strong>f<strong class="text-light"></strong>o<strong class="text-light"></strong>u<strong class="text-light"></strong>n<strong class="text-light"></strong>d<strong class="text-light"></strong>!<strong class="text-light"></strong></div><div class="search-path"></div></a></div></div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

         <!-- Dashboard Section -->
          <li class="nav-item">
            <a href="{{ url('admin/dashboard') }}" class="nav-link {{ (Session::get('page') == 'Dashboard') ? 'active' : '' }} ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              Dashboard
            </a>
          </li>
          <!-- /.Dashboard Section -->

          <!-- Settings Section -->
          <li class="nav-item">
            <a href="#" class="nav-link {{ (Session::get('page') == 'Settings') ? 'active' : '' }}">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ url('admin/update-admin-password') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    Update Admin Password
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('admin/update-admin-details') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    Update Admin Details
                  </a>
                </li>
              </ul>
          </li>
          <!-- /. Settings Sections -->

          <!-- Catalog Section -->
          <li class="nav-item">
            <a href="#" class="nav-link {{ (Session::get('page') == 'Catalog') ? 'active' : '' }}">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Catalogues
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
              <ul class="nav nav-treeview">

                <li class="nav-item">
                  <a href="{{ url('admin/sections') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    Section
                  </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/categories') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      Category
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/products') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      Product
                    </a>
                </li>

              </ul>
          </li>
          <!-- /. Catalog Section -->

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
