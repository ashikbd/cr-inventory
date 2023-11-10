<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
      <img src="{{ asset('resources/img/logo.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Eve Salon</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) 
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('resources/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>-->

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ url('admin/dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
           
          </li>

          <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Client Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('admin/clients')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Clients</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/clients/birthdays')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Upcoming Birthdays</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/services')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Services</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/sales')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sales</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Inventory Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/stock/current_stock') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Current Stock</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/stock/stockin_list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock IN</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/stock/stockout_list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock OUT</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/stock/expiring') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Expiring Products</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Product Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/products') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/brands') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Brands</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/categories') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Statistics
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General Settings</p>
                </a>
              </li>

              

              <li class="nav-item">
                <a href="{{ url('admin/settings/sms_settings') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SMS Settings</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('admin/users') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin Management</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
    </nav>
   </div>
</aside>