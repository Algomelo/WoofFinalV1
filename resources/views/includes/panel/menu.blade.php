<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

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
      <a class="nav-link textomenudashboard" href="{{ url('/services')}}">
        <i class="fas fa-briefcase text-blue"></i>Services
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link textomenudashboard d-none" href="{{ url('/packages')}}">
        <i class="fas fa-briefcase text-blue"></i>Packages
      </a>
    </li>

    <li class="nav-item">
    <a class="nav-link textomenudashboard" href="{{ url('/serviceRequests') }}">
        <i class="fas fa-clipboard-list"></i>Service Request
      </a>
    </li>
    <li class="nav-item">
    <a class="nav-link textomenudashboard" href="{{ url('/serviceRedems') }}">
        <i class="fas fa-clipboard-list"></i>Bookings
      </a>
    </li>
    <li class="nav-item   ">
        <a class="nav-link  textomenudashboard " href="{{ url('/users')}}">
          <i class="ni ni-single-02 text-orange"></i>Users
        </a>
      </li>
    <li class="nav-item">
      <a class="nav-link textomenudashboard" href="{{ url('/walkers')}}">
        <i class="fas fa-walking text-orange"></i>Walkers
      </a>
    </li>
    <li class="nav-item d-none">
      <a class="nav-link textomenudashboard" href="{{ url('/blogs')}}">
        <i class="ni ni-bullet-list-67 text-red"></i>Blog
      </a>
    </li>

    @elseif(auth()->check() && auth()->user()->role == 'user')
    
    <li class="nav-item">
    <a class="nav-link textomenudashboard" href="{{ url('/home')}}">
        <i class="ni ni-bullet-list-67 text-red"></i>My Profile
      </a>
    </li>    
    <li class="nav-item">
      <a class="nav-link textomenudashboard" href="{{ url('/userServiceRequest')}}">
        <i class="ni ni-bullet-list-67 text-red"></i>Request Service
      </a>
    </li>
    <li class="nav-item d-none">
    <a class="nav-link textomenudashboard " href="{{ url('/userRedemption')}}">
        <i class="ni ni-bullet-list-67 text-red"></i>My Services
      </a>
    </li>
    <li class="nav-item">
    <a class="nav-link textomenudashboard" href="{{ url('/userScheduled')}}">
        <i class="ni ni-bullet-list-67 text-red"></i>Scheduled Services
      </a>
    </li>
    <li class="nav-item">
    <a class="nav-link textomenudashboard d-none" href="{{ url('/userPets')}}">

        <i class="ni ni-bullet-list-67 text-red"></i>My Pets
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
        <i class="ni ni-bullet-list-67 textomenudashboard " ></i>Profile
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

  @endif