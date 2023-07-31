<ul class="navbar-nav">
    
    <li class="nav-item">
      <a class="nav-link " href="{{ url('/services')}}">
        <i class="fas fa-briefcase text-blue"></i>Services
      </a>
    </li>
    <li class="nav-item  active ">
        <a class="nav-link  active " href="{{ url('/users')}}">
          <i class="ni ni-single-02 text-orange"></i>Users
        </a>
      </li>
    <li class="nav-item">
      <a class="nav-link " href="{{ url('/walkers')}}">
        <i class="fas fa-walking text-orange"></i>Walkers
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="./examples/profile.html">
        <i class="fas fa-clipboard-list"></i>Service Request
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="{{ url('/blogs/create')}}">
        <i class="ni ni-bullet-list-67 text-red"></i>Blog
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="{{ route('logout')}}" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
        <i class="fas fa-sign-in-alt"></i> Sign Off
      </a>
      
    </li>
  </ul>
  <!-- Divider -->
  <hr class="my-3">
  <!-- Heading -->
  <h6 class="navbar-heading text-muted">Reports</h6>
  <!-- Navigation -->
  <ul class="navbar-nav mb-md-3">
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="ni ni-spaceship"></i>Scheduled Services
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html">
        <i class="ni ni-palette"></i>Performance Walkers
      </a>
    
  </ul>
  