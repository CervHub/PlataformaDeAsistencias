<div class="table-responsive">
    <table id="example" class="display nowrap mb-1 mt-1" style="width:100%">
        <thead>
            <tr>
                <th>Nº</th>
                <th>Nombre</th>
                <th>THS</th>
                <th>THA</th>
                <th>THL</th>
                <th>Días</th>
                {{-- <th>Acciones</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($schedules as $schedule)
                <tr data-id="{{ $schedule->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $schedule->name }}</td>
                    <td>{{ $schedule->totalHours }}</td>
                    <td>{{ $schedule->lunchHours }}</td>
                    <td>{{ $schedule->workHours }}</td>
                    <td style="display: flex; justify-content: center; align-items: center;">
                        @foreach ($schedule->getDayStatus() as $day => $status)
                            <div style="position: relative; height: 100%; margin-right: 10px;">
                                <i class="fa fa-circle {{ $status ? 'text-success' : 'text-danger' }}"
                                    style="font-size: 2em;"></i>
                                <span
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center; color: white;">
                                    {{ $day }}
                                </span>
                            </div>
                        @endforeach
                    </td> {{-- <td>
                        <button class="btn btn-primary edit-schedule">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger delete-schedule">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Nº</th>
                <th>Nombre</th>
                <th>THS</th>
                <th>THA</th>
                <th>THL</th>
                <th>Días</th>
                {{-- <th>Acciones</th> --}}
            </tr>
        </tfoot>
    </table>
</div>
