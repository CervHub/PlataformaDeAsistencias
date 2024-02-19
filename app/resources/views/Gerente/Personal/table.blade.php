<div class="table-responsive">
    <table id="example" class="display nowrap employee-table">
        <thead>
            <tr>
                <th>Nº</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Doc. Ident.</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr data-id="{{ $employee->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->lastname }}</td>
                    <td>{{ $employee->user->doi }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>
                        <button class="btn btn-primary edit-employee">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger delete-employee" data-bs-toggle="modal" data-bs-target="#deleteModal"
                            data-id="{{ $employee->id }}">
                            <i class="fas fa-trash"></i>
                        </button>

                     
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Nº</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Doc. Ident.</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
    </table>
</div>
