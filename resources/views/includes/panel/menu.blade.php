<h6 class="navbar-heading text-muted">
  @if(auth()->check() && auth()->user()->role == 'admin')
    Management
  @else 
    Menu
  @endif
</h6>

<ul class="navbar-nav">

  @if(auth()->check() && auth()->user()->role == 'admin')
    
    <li class="nav-item">
      <a class="nav-link " href="{{ url('/services')}}">
        <i class="fas fa-briefcase text-blue"></i>Services
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="{{ url('/packages')}}">
        <i class="fas fa-briefcase text-blue"></i>Packages
      </a>
    </li>
    <li class="nav-item   ">
        <a class="nav-link  " href="{{ url('/users')}}">
          <i class="ni ni-single-02 text-orange"></i>Users
        </a>
      </li>
    <li class="nav-item">
      <a class="nav-link " href="{{ url('/walkers')}}">
        <i class="fas fa-walking text-orange"></i>Walkers
      </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="{{ url('/serviceRequests') }}">
        <i class="fas fa-clipboard-list"></i>Service Request
      </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="{{ url('/serviceRedems') }}">
        <i class="fas fa-clipboard-list"></i>Bookings
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="{{ url('/blogs')}}">
        <i class="ni ni-bullet-list-67 text-red"></i>Blog
      </a>
    </li>

    @elseif(auth()->check() && auth()->user()->role == 'user')
    
    

    
    <li class="nav-item">
      <a class="nav-link " href="{{ url('/userServiceRequest')}}">
        <i class="ni ni-bullet-list-67 text-red"></i>Request Service
      </a>
    </li>
    <li class="nav-item">
    
    <a class="nav-link " href="{{ url('/userRedemption')}}">
        <i class="ni ni-bullet-list-67 text-red"></i>My Services
      </a>
    </li>

    <li class="nav-item">
    <a class="nav-link " href="{{ url('/userScheduled')}}">
        <i class="ni ni-bullet-list-67 text-red"></i>Scheduled Services
        
      </a>
    </li>
    <li class="nav-item">
    <a class="nav-link " href="{{ url('/userPets')}}">

        <i class="ni ni-bullet-list-67 text-red"></i>My Pets
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="./examples/tables.html">
        <i class="ni ni-bullet-list-67 text-red"></i>Profile
      </a>
    </li>



    @else
    <li class="nav-item">
    <a class="nav-link " href="{{ url('/walkersScheduled')}}">
        <i class="ni ni-bullet-list-67 text-red"></i>Assigned Scheduled
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="./examples/tables.html">
        <i class="ni ni-bullet-list-67 text-red"></i>Profile
      </a>
    </li>

    @endif
    
    <li class="nav-item">
      <a class="nav-link" href="{{ route('logout')}}" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
        <i class="fas fa-sign-in-alt"></i> Sign Off
      </a>
      
    </li>
  </ul>
  <!-- Divider -->
  @if(auth()->check() && auth()->user()->role == 'admin')
  <hr class="my-3">
  <!-- Heading -->
  <h6 class="navbar-heading text-muted">Reports</h6>
  <!-- Navigation -->
  <ul class="navbar-nav mb-md-3">
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="ni ni-spaceship"></i>Appointments
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html">
        <i class="ni ni-palette"></i>Performance Walkers
      </a>
    
  </ul>
  @endif