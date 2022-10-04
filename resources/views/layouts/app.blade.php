<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('styles')
    <title>{{ config('app.name', 'Laravel') }}</title>
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/img/brand/favicon.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
     <!-- Page plugins -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/argon.css?v=1.1.0') }}" type="text/css">
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2/sweetalert2.css') }}" type="text/css">
</head>
<body>
  <div id="app">
    @guest
        <section class="ftco-section">
            @yield('content-guest')
        </section>
    @else
        <!-- Sidenav -->
      <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
          <!-- Brand -->
          <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="../../pages/dashboards/dashboard.html">
              {{-- <img src="../../assets/img/brand/blue.png" class="navbar-brand-img" alt="..."> --}}
              <h3>ATS</h3>
            </a>
            <div class="ml-auto">
              <!-- Sidenav toggler -->
              <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
              <!-- Nav items -->
              
              <ul class="navbar-nav">

                {{-- Dasboard --}}
                <li class="nav-item">
                  <a id='home' class="nav-link" href="{{ route('home') }}">
                    <i class="ni ni-shop text-primary"></i>
                    <span class="nav-link-text">Dashboard</span>
                  </a>
                </li>

                {{-- FPTK --}}
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('hr_fptk.index') }}">
                    <i class="ni ni-shop text-primary"></i>
                    <span class="nav-link-text">FPTK</span>
                  </a>
                </li>

                {{-- MPP --}}
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('hr_mpp.index') }}">
                    <i class="ni ni-shop text-primary"></i>
                    <span class="nav-link-text">MPP</span>
                  </a>
                </li>

                {{-- URL --}}
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('hr_url.index') }}">
                    <i class="ni ni-shop text-primary"></i>
                    <span class="nav-link-text">URL</span>
                  </a>
                </li>

                {{-- Master Table --}}
                <li class="nav-item">
                  <a id="masterTable" class="nav-link collapsed" href="#navbar-mastertable" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-mastertable">
                    <i class="ni ni-align-left-2 text-default"></i>
                    <span class="nav-link-text">Master Table</span>
                  </a>
                  <div class="collapse" id="navbar-mastertable">
                    <ul class="nav nav-sm flex-column">
                      <li class="nav-item">
                        <a id="url-Internal" href="{{ route('mt.internal') }}" class="nav-link">Internal</a>
                      </li>
                      <li class="nav-item">
                        <a id="url-Form" href="{{ route('mt.form') }}" class="nav-link">Form</a>
                      </li>
                      <li class="nav-item">
                        <a id="url-Vendor" href="{{ route('mt.vendor') }}" class="nav-link">Vendor</a>
                      </li>
                    </ul>
                  </div>
                </li>
              </ul>
              <!-- Divider -->
              <hr class="my-3">
            </div>
          </div>
        </div>
      </nav>
      <!-- Main content -->
      <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
          <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <!-- Navbar links -->
              <ul class="navbar-nav align-items-center ml-md-auto">
                <li class="nav-item d-xl-none">
                  <!-- Sidenav toggler -->
                  <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                      <i class="sidenav-toggler-line"></i>
                      <i class="sidenav-toggler-line"></i>
                      <i class="sidenav-toggler-line"></i>
                    </div>
                  </div>
                </li>
              </ul>
              <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                <li class="nav-item dropdown">
                  <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                      <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('assets/img/theme/team-4.jpg')}}">
                      </span>
                    </div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header noti-title">
                      <h5 class="text-overflow m-0">Welcome!</h5>
                      <h5 class="text-overflow m-0" id="welcome">{{ Auth::user()->nama }}</h5>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                          <i class="ni ni-user-run"></i>
                          <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        {{-- {{ dd(Str::contains(Route::currentRouteName(),'mt.')) }} --}}
        @yield('content')
      </div>
    @endguest
    <!-- Argon Scripts -->
    <!-- Core -->
  </div>
  <script src="{{ asset('assets/sweetalert2/sweetalert2.all.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/js-cookie/js.cookie.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
  <!-- Optional JS -->
  <script src="{{ asset('assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>
  <!-- Argon JS -->
  <script src="{{ asset('assets/js/argon.js?v=1.1.0') }}"></script>
  <!-- Demo JS - remove this in your project -->
  <script src="{{ asset('assets/js/demo.min.js') }}"></script>
  <script src="{{ asset('js/select2.min.js') }}"></script>
    @yield('script')
    
  {{-- active dashboard --}}
  @if (Route::currentRouteName()=='home' )
    <script>
      $(document).ready(() => {
        $('#home').addClass("active");
      });
    </script>
  @endif
  
  {{-- active master table --}}
  @if (Str::contains(Route::currentRouteName(),'mt.'))
    <script>
      $(document).ready(() => {
        $('#masterTable').removeClass( "collapsed" );
        $('#masterTable').attr( "aria-expanded","true");
        $('#navbar-mastertable').addClass("show");
        $('#masterTable').addClass("active");
      });
    </script>
    @if (Route::currentRouteName()=='mt.internal')
      <script>
        $(document).ready(() => {
          $('#url-Internal').addClass("active");
        })
      </script>
    @elseif (Route::currentRouteName()=='mt.form')
      <script>
        $(document).ready(() => {
          $('#url-Form').addClass("active");
        })
      </script>
    @else
      <script>
        $(document).ready(() => {
          $('#url-Vendor').addClass("active");
        })
      </script>
    @endif
  @endif
</body>
</html>
