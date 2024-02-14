@extends('Gerente.main')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection

@section('content')
    <h2 class="main-title">Administrador</h2>
    <div class="row mb-3 px-1">
        <div class="col-2">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="fas fa-plus"></i> Crear
            </button>
        </div>
    </div>

    <div class="table-responsive">
        <table id="example" class="display nowrap mb-1 mt-1" style="width:100%">
            <thead>
                <tr>
                    <th>DOI</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Cargo</th>
                    <th>Fecha de Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr data-id="{{ $employee->id }}">
                        <td>{{ $employee->user->doi }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->lastname }}</td>
                        <td>{{ $employee->position }}</td>
                        <td>{{ $employee->created_at }}</td>
                        <td>
                            <a href="#" class="btn btn-primary" onclick="editEmployee({{ $employee->id }})">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-info" onclick="detailEmployee({{ $employee->id }})">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="#" class="btn btn-danger" onclick="deleteEmployee({{ $employee->id }})">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>DOI</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Cargo</th>
                    <th>Fecha de Creación</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        </table>
    </div>
    @include('Gerente.Administrador.create')
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script>
        function create() {
            // Oculta los botones
            $('#store').hide();
            $('#close').hide();

            // Muestra un mensaje
            $('.modal-footer').append('<div id="loadingMessage">Mandando datos...</div>');

            var client = new ApiClient('/api');

            var data = {
                doi: $('#documento').val(),
                name: $('#nombres').val(),
                lastname: $('#apellidos').val(),
                birthdate: $('#fechaNacimiento').val(),
                position: $('#posicion').val(),
                id_company: '{{ session('company_id') }}',
                role: 'Administrador'
            };

            console.log('Data:', data);

            client.sendRequest('/employee/create', 'POST', data, function(error, response) {
                if (error) {
                    console.error('Error:', error);
                } else {
                    console.log('Response:', response);
                    // Agrega una nueva fila a la tabla con los datos del empleado
                    // Formatea la fecha de creación al formato deseado
                 6.
                    $('tbody').append(newRow);

                    setTimeout(function() {
                        // Elimina el mensaje de carga
                        $('#loadingMessage').remove();

                        // Muestra los botones
                        $('#store').show();
                        $('#close').show();

                        // Cierra el modal
                        $('#createModal').modal('hide');
                    }, 3000);
                }
            });
        }

        function deleteEmployee(id) {
            // Confirmar antes de eliminar
            if (!confirm('¿Estás seguro de que quieres eliminar este empleado?')) {
                return;
            }

            // Crear una nueva instancia de ApiClient
            var client = new ApiClient('/api');

            // Enviar una solicitud DELETE a la API
            client.sendRequest('/employee/delete/' + id, 'DELETE', {}, function(error, response) {
                if (error) {
                    // Hubo un error con la solicitud
                    console.error('Error al eliminar el empleado:', error);
                } else {
                    // La solicitud se completó con éxito
                    console.log('Empleado eliminado con éxito:', response);

                    // Seleccionar y eliminar la fila
                    $('tr[data-id="' + id + '"]').remove();
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });

        $(document).ready(function() {
            $('#store').click(create);
        });

        document.addEventListener('DOMContentLoaded', function() {
            activateElementById('administrador');
        });
    </script>
@endsection
