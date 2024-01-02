@extends('layouts.panel')

@section('content')

<style>
    #deleteSelected {
        display: none;
    }
</style>




      <div class="card shadow">
            <div class="card-header border-0">
  
                <h2 >Users</h2> <br>
                <div class="col text-right">
                        <a href="{{ url('users/create')}}" class="btn btn-sm btn-primary">New User</a>
                        <button type="button" class="btn btn-sm btn-danger" id="deleteSelected">Delete Select</button>
                </div>
     
                    <div class="row ">
                        <div class="col-md-6">
                            <label for="filterInput" class="form-label">Filter by Name:</label>
                            <input type="text" class="form-control" id="filterNameInput" placeholder="Type to filter by name">
                        </div>
                        <div class="col-md-6 " >
                            <label for="filterEmailInput" class="form-label">Filter by Email:</label>
                            <input type="text" class="form-control" id="filterEmailInput" placeholder="Type to filter by email">
                        </div>
                    </div>


            </div>
            <div class="card-body">
                @if(session('notification'))
                <div class="alert alert-success" role="alert">
                    {{session('notification')}}
                </div>

                @endif

                </div>
                <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Name</th>
            

                        <th scope="col">Phone</th>
                
                        <th scope="col">Options</th>
                        
                        <th scope="col">
                        <input type="checkbox"  id="selectAllCheckbox">      Select All                 

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">
                                    {{$user->name}}
                                    
                                </th>
                                <td>
                                    {{$user->phone}}
                                </td>
                                <td>
                                    <form action="{{ url('/users/'.$user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ url('/users/'.$user->id.'/edit') }}" class="btn btn-sm btn-primary">See More Info / Edit Info</a>
                                        <a href="{{ route('users.assignPackagesForm', ['userId' => $user->id]) }}" class="btn btn-sm btn-primary">Management Services</a>

                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmDeleteModal{{ $user->id }}">
                                            Delete
                                        </button>


                                        <!-- Modal para confirmar la eliminación -->
                                        <div class="modal fade" id="confirmDeleteModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this user?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                <td>        
                                    <input type="checkbox" class="user-checkbox" value="{{ $user->id }}">   
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
             </table>
            </div>
        </div>

 
<!-- Agrega esto al final de tu vista antes de cerrar el cuerpo (</body>) -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Modifica el script jQuery -->
<script>
    $(document).ready(function () {
        // Manejar el evento de entrada en el campo de filtrado por nombre
        $('#filterNameInput').on('input', function () {
            filterTable();
        });

        // Manejar el evento de entrada en el campo de filtrado por correo electrónico
        $('#filterEmailInput').on('input', function () {
            filterTable();
        });

        function filterTable() {
            var nameFilterValue = $('#filterNameInput').val().toLowerCase(); // Obtener el valor del campo de filtrado por nombre
            var emailFilterValue = $('#filterEmailInput').val().toLowerCase(); // Obtener el valor del campo de filtrado por correo electrónico

            // Iterar sobre las filas de la tabla y mostrar/ocultar según los filtros
            $('tbody tr').each(function () {
                var name = $(this).find('th').text().toLowerCase(); // Obtener el nombre de la fila
                var email = $(this).find('td:eq(2)').text().toLowerCase(); // Obtener el correo electrónico de la fila

                // Mostrar u ocultar la fila según si coincide con los filtros
                if (name.includes(nameFilterValue) && email.includes(emailFilterValue)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    });
</script>



<script>
    $(document).ready(function () {
        // Manejar clic en el botón "Eliminar seleccionados"
        $('#deleteSelected').on('click', function () {
            var selectedIds = [];

            // Obtener los IDs de los usuarios seleccionados
            $('.user-checkbox:checked').each(function () {
                selectedIds.push($(this).val());
            });

            // Si no se selecciona ningún usuario, mostrar un mensaje o realizar la lógica que prefieras
            if (selectedIds.length === 0) {
                alert('Selecciona al menos un usuario para eliminar.');
                return;
            }

            // Mostrar un mensaje de confirmación o un modal si lo deseas

            // Enviar una solicitud AJAX para eliminar los usuarios seleccionados
            console.log('IDs a eliminar:', selectedIds);

            $.ajax({
                url: '{{ url("/delete-selected-users") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    ids: selectedIds
                },
                success: function (response) {
                    // Manejar la respuesta del servidor (puede ser un mensaje de éxito, recargar la página, etc.)
                    alert(response.message);
                    location.reload(); // Recargar la página después de eliminar
                    console.log(response);

                },
                error: function (error) {
                    // Manejar errores, si los hay
                    console.error(error);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        // ...

        // Manejar clic en el botón "Eliminar seleccionados"
        $('#deleteSelected').on('click', function () {
            var selectedIds = [];

            // Obtener los IDs de los usuarios seleccionados
            $('.user-checkbox:checked').each(function () {
                selectedIds.push($(this).val());
            });

            // Si no se selecciona ningún usuario, mostrar un mensaje
            if (selectedIds.length === 0) {
                alert('Selecciona al menos un usuario para eliminar.');
                return;
            }

            // Mostrar un mensaje de confirmación o un modal si lo deseas

            // Enviar una solicitud AJAX para eliminar los usuarios seleccionados
            $.ajax({
                url: '{{ url("/delete-selected-users") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    ids: selectedIds
                },
                success: function (response) {
                    // Manejar la respuesta del servidor (puede ser un mensaje de éxito, recargar la página, etc.)
                    alert(response.message);
                    location.reload(); // Recargar la página después de eliminar
                },
                error: function (error) {
                    // Manejar errores, si los hay
                    console.error(error);
                }
            });
        });

        // Manejar cambios en los checkboxes para mostrar u ocultar el botón
        $('.user-checkbox').on('change', function () {
            var checkedCheckboxes = $('.user-checkbox:checked');

            // Mostrar u ocultar el botón según el número de checkboxes seleccionados
            if (checkedCheckboxes.length > 1) {
                $('#deleteSelected').show();
            } else {
                $('#deleteSelected').hide();
            }
        });

        // ...
    });
</script>


<script>
    $(document).ready(function () {
        // ...

        // Manejar clic en el checkbox de selección total
        $('#selectAllCheckbox').on('change', function () {
            var isChecked = $(this).prop('checked');

            // Aplicar la selección/deselección a todos los checkboxes de usuarios
            $('.user-checkbox').prop('checked', isChecked);

            // Mostrar u ocultar el botón de eliminar seleccionados según la situación
            updateDeleteButtonVisibility();
        });

        // Manejar cambios en los checkboxes individuales
        $('.user-checkbox').on('change', function () {
            // Mostrar u ocultar el botón de eliminar seleccionados según la situación
            updateDeleteButtonVisibility();
        });

        // Actualizar la visibilidad del botón de eliminar seleccionados
        function updateDeleteButtonVisibility() {
            var checkedCheckboxes = $('.user-checkbox:checked');

            // Mostrar u ocultar el botón según el número de checkboxes seleccionados
            if (checkedCheckboxes.length > 1) {
                $('#deleteSelected').show();
            } else {
                $('#deleteSelected').hide();
            }
        }

        // ...
    });
</script>


@endsection
