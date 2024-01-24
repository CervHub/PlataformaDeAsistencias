@extends('SuperAdmin.main')

@section('content')
    <h2 class="main-title">Dashboard</h2>

    {{-- Boton para agregar empresa --}}
    <div class="row mb-3">
        <div class="col-lg-12">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarEmpresaModal">
                Agregar Empresa
            </button>
        </div>
    </div>

    {{-- Modal para agregar empresa --}}
    <div class="modal fade" id="agregarEmpresaModal" tabindex="-1" aria-labelledby="agregarEmpresaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarEmpresaModalLabel">Agregar Empresa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Formulario de Bootstrap --}}
                    <form action="{{ route('superadmin.companies_create') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre *</label>
                            <input type="text" class="form-control" id="nombre" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="ruc" class="form-label">RUC *</label>
                            <input type="text" class="form-control" id="ruc" name="ruc" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabla de empresas --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="users-table table-wrapper">
                <table id="myTable" class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>RUC</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Aquí se mostrarán los datos de la empresa --}}
                        <tr>
                            <td>1</td>
                            <td>Empresa 1</td>
                            <td>12345678901</td>
                            <td>Descripción de la empresa 1</td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editarEmpresaModal">
                                    Editar
                                </button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#eliminarEmpresaModal">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal para editar empresa --}}
    <div class="modal fade" id="editarEmpresaModal" tabindex="-1" aria-labelledby="editarEmpresaModalLabel"
        aria-hidden="true">
        <!-- Contenido del modal para editar -->
    </div>

    {{-- Modal para eliminar empresa --}}
    <div class="modal fade" id="eliminarEmpresaModal" tabindex="-1" aria-labelledby="eliminarEmpresaModalLabel"
        aria-hidden="true">
        <!-- Contenido del modal para eliminar -->
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtén el elemento dashboard
            var dashboard = document.querySelector('#companies');

            // Asegúrate de que el elemento dashboard existe
            if (dashboard) {
                // Agrega la clase 'active'
                dashboard.classList.add('active');
            }
        });
        new DataTable('#myTable');
    </script>
@endsection
