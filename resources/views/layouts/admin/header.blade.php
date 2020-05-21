<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>


  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-comments"></i>
      </a>
    </li>
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
      </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link btn dropdown-toggle" href="javascript:;" id="navbarlocaleLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <strong>Language</strong> : @lang('admin_layout.'. app()->getLocale())
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarlocaleLink">
          <a class="dropdown-item" href="{{route('set-locale', 'en')}}">@lang('admin_layout.en')</a>
          <a class="dropdown-item" href="{{route('set-locale', 'cn')}}">@lang('admin_layout.cn')</a>
          <a class="dropdown-item" href="{{route('set-locale', 'fr')}}">@lang('admin_layout.fr')</a>
        </div>
    </li>
  </ul>
</nav>
<!-- /.navbar -->
