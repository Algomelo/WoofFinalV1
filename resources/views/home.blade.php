@extends('layouts.panel')

@section('content')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    // Ejemplo de script que muestra una ventana modal
    $(document).ready(function() {
        $('#myModal').modal('show'); // Asegúrate de que el ID del modal coincida con el que estás utilizando
    });
</script>


    <!-- Aquí verificamos si el campo show_manual es verdadero -->
    @if(auth()->check() && auth()->user()->role == 'user' && !auth()->user()->show_manual)
        <!-- Aquí puedes mostrar una ventana modal o ejecutar un script -->
        <script>
            // Ejemplo de script que muestra una ventana modal
            $(document).ready(function() {
                $('#myModal').modal('show'); // Asegúrate de que el ID del modal coincida con el que estás utilizando
            });
        </script>

        <!-- Agrega aquí el código HTML para la ventana modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Guidelines for Service Requests</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Discover our tailored services by selecting the 'Service Request' option.</p>
                        <img  src="{{asset('img/home.PNG')}}"  class="img-fluid">
                    </div>
                    <div class="modal-footer">
                        <form id="manualPreferenceForm" action="{{ url('manualPreference') }}" method="post">
                            @method('PUT') <!-- Agrega el método PUT -->
                            @csrf
                            <div class="form-check">
                                <input type="hidden" name="noMostrarManual" value="0"> <!-- Valor predeterminado, se enviará si el checkbox no está marcado -->
                                <input class="form-check-input" type="checkbox" id="noMostrarManual" name="noMostrarManual" value="1" onchange="updateCheckboxValue(this)">
                                    <label class="form-check-label" for="noMostrarManual">
                                        Hide this message in the future
                                    </label>
                                </div>

                        </form>
                        <button type="button" class="btn boton" data-dismiss="modal" onclick="submitForm()">Close</button> <!-- Cambiar a tipo "button" -->

                    </div>
                </div>
            </div>
        </div>
    @endif
<div class="row">

    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                {{ __('You are logged in!') }}
            </div>
        </div>
    </div>
    

    <div class="col-xl-8 mb-5 mb-xl-0">
      <div class="card bg-gradient-default shadow">
        <div class="card-header bg-transparent">
          <div class="row align-items-center">
            <div class="col">
              <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
              <h2 class="text-white mb-0">Sales value</h2>
            </div>
            <div class="col">
              <ul class="nav nav-pills justify-content-end">
                <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}' data-prefix="$" data-suffix="k">
                  <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                    <span class="d-none d-md-block">Month</span>
                    <span class="d-md-none">M</span>
                  </a>
                </li>
                <li class="nav-item" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}' data-prefix="$" data-suffix="k">
                  <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                    <span class="d-none d-md-block">Week</span>
                    <span class="d-md-none">W</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="card-body">
          <!-- Chart -->
          <div class="chart">
            <!-- Chart wrapper -->
            <canvas id="chart-sales" class="chart-canvas"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4">
      <div class="card shadow">
        <div class="card-header bg-transparent">
          <div class="row align-items-center">
            <div class="col">
              <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
              <h2 class="mb-0">Total orders</h2>
            </div>
          </div>
        </div>
        <div class="card-body">
          <!-- Chart -->
          <div class="chart">
            <canvas id="chart-orders" class="chart-canvas"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-5">
    <div class="col-xl-8 mb-5 mb-xl-0">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Page visits</h3>
            </div>
            <div class="col text-right">
              <a href="#!" class="btn btn-sm btn-primary">See all</a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">Page name</th>
                <th scope="col">Visitors</th>
                <th scope="col">Unique users</th>
                <th scope="col">Bounce rate</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">
                  /argon/
                </th>
                <td>
                  4,569
                </td>
                <td>
                  340
                </td>
                <td>
                  <i class="fas fa-arrow-up text-success mr-3"></i> 46,53%
                </td>
              </tr>
              <tr>
                <th scope="row">
                  /argon/index.html
                </th>
                <td>
                  3,985
                </td>
                <td>
                  319
                </td>
                <td>
                  <i class="fas fa-arrow-down text-warning mr-3"></i> 46,53%
                </td>
              </tr>
              <tr>
                <th scope="row">
                  /argon/charts.html
                </th>
                <td>
                  3,513
                </td>
                <td>
                  294
                </td>
                <td>
                  <i class="fas fa-arrow-down text-warning mr-3"></i> 36,49%
                </td>
              </tr>
              <tr>
                <th scope="row">
                  /argon/tables.html
                </th>
                <td>
                  2,050
                </td>
                <td>
                  147
                </td>
                <td>
                  <i class="fas fa-arrow-up text-success mr-3"></i> 50,87%
                </td>
              </tr>
              <tr>
                <th scope="row">
                  /argon/profile.html
                </th>
                <td>
                  1,795
                </td>
                <td>
                  190
                </td>
                <td>
                  <i class="fas fa-arrow-down text-danger mr-3"></i> 46,53%
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-xl-4">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Social traffic</h3>
            </div>
            <div class="col text-right">
              <a href="#!" class="btn btn-sm btn-primary">See all</a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">Referral</th>
                <th scope="col">Visitors</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">
                  Facebook
                </th>
                <td>
                  1,480
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="mr-2">60%</span>
                    <div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">
                  Facebook
                </th>
                <td>
                  5,480
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="mr-2">70%</span>
                    <div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">
                  Google
                </th>
                <td>
                  4,807
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="mr-2">80%</span>
                    <div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">
                  Instagram
                </th>
                <td>
                  3,678
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="mr-2">75%</span>
                    <div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"></div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">
                  twitter
                </th>
                <td>
                  2,645
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="mr-2">30%</span>
                    <div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-warning" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript" src="js/prefferGuide.js" ></script>

@endsection
