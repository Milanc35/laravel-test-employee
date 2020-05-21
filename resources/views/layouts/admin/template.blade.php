<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @foreach([
    "plugins/fontawesome-free/css/all.min.css",
    "https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css",
    "plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css",
    "plugins/icheck-bootstrap/icheck-bootstrap.min.css",
    "plugins/jqvmap/jqvmap.min.css",
    "plugins/datatables-bs4/css/dataTables.bootstrap4.min.css",
    "plugins/datatables-responsive/css/responsive.bootstrap4.min.css",
    "plugins/select2/css/select2.min.css",
    "plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css",
    "assets/css/adminlte.min.css",
    "plugins/overlayScrollbars/css/OverlayScrollbars.min.css",
    "plugins/daterangepicker/daterangepicker.css",
    "plugins/summernote/summernote-bs4.css",
    "https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700",
  ] as $css)
    @if (strpos($css, "//") !== false)
        <link href="{{ $css }}" rel="stylesheet" />
    @else
        <link href="{{ asset($css)  }}" rel="stylesheet" />
    @endif
  @endforeach
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('layouts.admin.header')

    @include('layouts.admin.navbar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">@lang('admin_layout.'. (!empty($pageTitle) ? $pageTitle : 'home'))</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">@lang('admin_layout.home')</a></li>
                @if(isset($pageTitle) && !empty($pageTitle))
                    <li class="breadcrumb-item active">@lang('admin_layout.'.$pageTitle)</li>
                @endif
                @if (isset($pageBreadCurm)  && !empty($pageBreadCurm))
                    <li class="breadcrumb-item active">@lang('admin_layout.'.$pageBreadCurm)</li>
                @endif
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
          @yield('content')
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('layouts.admin.footer')
</div>
<!-- ./wrapper -->

@foreach([
    "plugins/jquery/jquery.min.js",
    "plugins/jquery-ui/jquery-ui.min.js",
    "plugins/bootstrap/js/bootstrap.bundle.min.js",
    "plugins/moment/moment.min.js",
    "plugins/daterangepicker/daterangepicker.js",
    "plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js",
    "plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js",
    "plugins/datatables/jquery.dataTables.min.js",
    "plugins/datatables-bs4/js/dataTables.bootstrap4.min.js",
    "plugins/datatables-responsive/js/dataTables.responsive.min.js",
    "plugins/datatables-responsive/js/responsive.bootstrap4.min.js",
    "plugins/select2/js/select2.full.min.js",
    "plugins/inputmask/min/jquery.inputmask.bundle.min.js",
    "assets/js/adminlte.js",
] as $jsFile)
  @if (strpos($jsFile, "//") !== false)
      <script src="{{ $jsFile }}"></script>
  @else
      <script src="{{ asset($jsFile)  }}"></script>
  @endif
@endforeach
<script type="text/javascript">
    var app = {
        data: {},
        _i18n: {},
    };

    var appUtils = {
        setAppData: function(key, value) {
            app.data.key = value;
        },
        getAppData: function(key, value) {
            if (app.data.key) {
                return app.data.key;
            }

            if (value) {
                return value;
            }

            return;
        },
        setMessages: function(message, moduleName) {
            moduleName = moduleName || '__default';
            if (typeof message == 'object') {
                if (app._i18n[moduleName]) {
                    app._i18n[moduleName] = {...app._i18n[moduleName], ...message};
                } else {
                    app._i18n[moduleName] = {...message};
                }
            }
        },
        getMessage: function(key, msg, moduleName) {
            msg = msg || key;
            moduleName = moduleName || '__default';
            if (app._i18n[moduleName] && app._i18n[moduleName][key]) {
                return app._i18n[moduleName][key];
            }

            return msg;
        },
        displayBootstrapToasts: function(type, title, body, delay) {
            delay = delay || 5000;
            $(".content-wrapper").Toasts('create', {
              class: 'mt-20 mr-20 bg-'+type,
              title: title,
              autohide: true,
              delay: delay,
              body: '<p style="min-width:320px;">'+body+'</p>',
              fixed: true
            });
        },
        initApp: function() {
            this.showErrorMsg();
            $('[data-mask]').inputmask({ "clearIncomplete": true });
            $('[data-select2-input]').select2({
                theme: 'bootstrap4',
            });
        },
        showErrorMsg: function() {
            @foreach (['danger', 'warning', 'success', 'info'] as $key)
             @if(Session::has($key))
                  this.displayBootstrapToasts('{{$key}}', '{{ucfirst($key)}}', '{{ Session::get($key) }}');
             @endif
            @endforeach
        },
        setDefaultMessages: function() {
            appUtils.setMessages({
                'add': "@lang('admin_layout.add')",
                'edit': "@lang('admin_layout.edit')",
                'delete': "@lang('admin_layout.delete')",
                'failed': "@lang('admin_layout.failed')",
            });
        },
        beforeInitApp: function() {
            $.widget.bridge('uibutton', $.ui.button);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            this.setDefaultMessages();
        }
    }
    appUtils.beforeInitApp();
    $(document).ready(function() {
        appUtils.initApp();
    });
</script>
@yield('scripts')
</body>
</html>
