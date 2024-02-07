@extends('layouts.panel')

@section('content')

        <!--  MENU USUARIOS --->
        <!--  MENU USUARIOS --->
        <!--  MENU USUARIOS --->
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
    @endif

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




        <div class="row">
            <div class="col-md-12 mb-4">
              <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">Actualizar Datos Personales</h5>
                          @csrf
                          @method('PUT')

                          <div class="form-group">
                              <label for="name">Nombre</label>
                              <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}">
                          </div>

                          <div class="form-group">
                              <label for="email">Correo electrónico</label>
                              <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}">
                          </div>

                          <div class="form-group">
                              <label for="photo">Foto de Perfil</label>
                              <input type="file" class="form-control-file" id="photo" name="photo">
                          </div>

                          <button type="submit" class="btn btn-primary">Actualizar Datos</button>
                      </form>
                  </div>
              </div>
            </div>    
        </div>    
      


        <!-- FIN MENU USUARIOS --->
        <!-- FIN MENU USUARIOS --->
        <!-- FIN MENU USUARIOS --->


    


  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript" src="js/prefferGuide.js" ></script>

@endsection
