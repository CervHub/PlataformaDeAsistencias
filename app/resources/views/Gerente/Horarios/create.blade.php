<!-- CSS -->

<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="px-1" action="{{ route('horarios.store') }}" method="POST" id="createForm">
                @csrf
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title" id="createModalLabel">Asociar Horario</h5>
                </div>
                <div class="modal-body">
                    <!-- Existing code... -->
                    <div class="mb-3">
                        <label for="employee">Empleado</label>
                        @error('employee')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <select class=" mt-3 form-control @error('employee') is-invalid @enderror" id="employee"
                            name="employee">
                            <option value="">Seleccione un empleado</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="schedule">Horario</label>
                        @error('schedule')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <select class=" mt-3 form-control @error('schedule') is-invalid @enderror" id="schedule"
                            name="schedule">
                            <option value="">Seleccione un horario</option>
                            @foreach ($schedules as $schedule)
                                <option value="{{ $schedule->id }}">{{ $schedule->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="close">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="store">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>
