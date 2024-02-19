<div class="table-responsive">
    <table id="example" class="display nowrap attendace-table">
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
            @foreach ($attendances as $attendace)
                <tr data-id="{{ $attendace->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $attendace->employee->name }}</td>
                    <td>{{ $attendace->lastname }}</td>
                    <td>{{ $attendace->user }}</td>
                    <td>{{ $attendace->email }}</td>
                    <td>
                        <button class="btn btn-primary edit-attendace">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger delete-attendace">
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
