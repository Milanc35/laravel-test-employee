<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/admin" class="brand-link">
    <img src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('assets/img/avatar.png') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{ route('admin.') }}" class="nav-link {{ (empty($pageTitle) || strtolower($pageTitle) == 'dashboard') ? 'active' : ''}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              @lang('admin_layout.dashboard')
            </p>
          </a>
        </li>
        <li class="nav-item" >
          <a href="{{ route('admin.companies.index') }}" class="nav-link {{ (!empty($pageTitle) && strtolower($pageTitle) == 'companies') ? 'active' : ''}}" >
            <i class="nav-icon fas fa-building"></i>
            <p>
              @lang('admin_layout.companies')
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.employees.index') }}" class="nav-link {{ (!empty($pageTitle) && strtolower($pageTitle) == 'employees') ? 'active' : ''}}">
            <i class="nav-icon fas fa-address-card"></i>
            <p>
              @lang('admin_layout.employees')
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
