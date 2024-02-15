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
                        <button class="btn btn-primary edit-employee">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger delete-employee">
                            <i class="fas fa-trash"></i>
                        </button>
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
