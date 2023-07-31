
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    {{config('app.name')}} | @yield('title')
  </title>
  <!-- Favicon -->
  <link href="{{ asset('img/brand/favicon.png')}}" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="{{ asset('js/plugins/nucleo/css/nucleo.css')}}" rel="stylesheet" />
  <link href="../assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
           <!-- CSS ANTERIOR DASBOARD Y LOGUIN
  <link href="{{asset('css/argon-dashboard.css?v=1.1.2')}}" rel="stylesheet" />
             -->

               <!-- CSS NUEVO LOGUIN-->
      <link href="{{asset('css/new-dashboard-login.css')}}" rel="stylesheet" />
       
 
  
</head>

<body class="bg-default">
  <div class="main-content">


    
   
    <!-- Page content -->
    @yield('content')
    <!-- Page Footer -->

  </div>

  <!--   Core   -->
  <script src="{{ asset('js/plugins/jquery/dist/jquery.min.js')}}"></script>
  <script src="../assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--   Optional JS   -->
  <!--   Argon JS   -->
  <script src="{{asset('js/argon-dashboard.min.js?v=1.1.2')}}"></script>
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