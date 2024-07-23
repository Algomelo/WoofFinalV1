
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
     {{config('app.name')}} | Dashboard
  </title>
  <!-- Favicon -->
  <link href="{{asset('img/brand/favicon.png')}}" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="{{asset('js/plugins/nucleo/css/nucleo.css')}}" rel="stylesheet" />
  <link href="{{asset('js/plugins/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="{{asset('css/argon-dashboard.css?v=1.1.2')}}" rel="stylesheet" />
</head>

<body class="">
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light" id="sidenav-main" style="background-image: url(/img/banner_huellas_azul.png) !important;">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation" style="background-color:#F2761D;">
        <span class="navbar-toggler-icon"  ></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="/home">
        <img src="{{asset('img/brand/blue3.png')}}" class="navbar-brand-img" alt="...">
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ni ni-bell-55"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
              @if(auth()->user()->photo)
                    <img src="{{ asset('storage/images/' . auth()->user()->photo) }}" alt="Profile Picture">
              @else
                  <img src="{{asset('img/testimonio3.jpg')}}" alt="Mike Johnson" alt="Image placeholder">
              @endif                
              </span>
            </div>
          </a>
          @include('includes.panel.UserOptions')
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="./index.html">
                <!--<img width="500" height="200"src="{{asset('img/brand/blue.png')}}"> -->
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
  
        
        <!-- Navigation -->
      

    
        
        @include('includes.panel.menu')

      </div>
    </div>
  </nav>
  <div class="main-content">
    <div class="header bg-gradient-primary pb-8 pt-4 pt-md-6">
      <div class="container-fluid navbar navbar-top">
        <div class="row">
          <div class="col-12 col-sm-9">
              <a class="h2 inline-block" href="./home" style="background:white; border-radius:12px; padding: 4px 10px;">G'day,  {{ auth()->user()->name }}! Welcome to a ripper Woof experience!</a>
          </div>
          <div class="col-3 text-right">
            <ul class="navbar-nav d-none d-md-flex">
              <li class="nav-item dropdown">
                <a class="nav-link " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="container text-center d-block">
                      <span class="avatar avatar-sm rounded-circle">
                        <!-- Mostrar la foto de perfil del usuario -->
                          @if(auth()->user()->photo)
                              <img src="{{ asset('storage/images/' . auth()->user()->photo) }}" alt="Profile Picture">
                          @else
                              <img src="{{asset('img/testimonio3.jpg')}}" alt="Mike Johnson" alt="Image placeholder">
                          @endif
                      </span><br>
                      <span class="profile">
                          @if(auth()->check() && auth()->user()->name)
                          Profile  {{ auth()->user()->name }}
                          @else
                            @auth
                              {{ Auth::logout() }}
                            @endauth
                          @endif
                        </span>
                    </div>
                </a>
                @include('includes.panel.UserOptions')
              </li>
            </ul>
          </div>
        </div>
      </div>  
    </div>
    <div class="container-fluid mt--5   mt-sm--7">
     @yield('content')
      <!-- Footer -->
      @include('includes.panel.footer')
    </div>
  </div>
  <!--   Core   -->
  <script src="{{asset('js/plugins/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <!--   Optional JS   -->
  <script src="{{asset('js/plugins/chart.js/dist/Chart.min.js')}}"></script>
  <script src="{{asset('js/plugins/chart.js/dist/Chart.extension.js')}}"></script>
  <!--   Argon JS   -->
  <script src="{{asset('js/argon-dashboard.min.js?v=1.1.2"')}}"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
  </script>
 
</body>

</html>