<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <form class="px-1" action="{{ route('administradores.store') }}" method="POST" id="createForm">
                @csrf
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title" id="createModalLabel">Crear Horario</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nombre_jornada" class="form-label">Nombre de la Jornada</label>
                                <input type="text" class="form-control @error('nombre_jornada') is-invalid @enderror"
                                    id="nombre_jornada" name="nombre_jornada" value="{{ old('nombre_jornada') }}"
                                    required>
                                @error('nombre_jornada')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 d-flex justify-content-center">
                                @php
                                    $days = ['L' => 'Lunes', 'M' => 'Martes', 'X' => 'Miércoles', 'J' => 'Jueves', 'V' => 'Viernes', 'S' => 'Sábado', 'D' => 'Domingo'];
                                @endphp
                                @foreach ($days as $initial => $day)
                                    <button class="btn btn-outline-primary day-button rounded-circle mx-2"
                                        type="button" id="{{ $initial }}Button">{{ $initial }}</button>
                                @endforeach
                            </div>
                            <div class="mb-3">
                                <h5><i class="fas fa-history"></i> Historial de horas</h5>
                                <div class="row">
                                    @foreach ($days as $initial => $day)
                                        <div class="col-6">
                                            <div class="row d-flex justify-content-center">
                                                <div class="col-4 mt-3">
                                                    <label for="{{ $initial }}Hours"
                                                        class="form-label">{{ $day }}</label>
                                                </div>
                                                <div class="col-4 mt-3">
                                                    <input type="text" id="{{ $initial }}Hours"
                                                        class="form-control" value="00:00" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row mt-3  d-flex justify-content-center">
                                    <div class="col-6">
                                        <label for="totalHours" class="form-label"><i class="fas fa-calendar-week"></i>
                                            Total de horas a la semana</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" id="totalHours" class="form-control" value="00:00"
                                            readonly>
                                    </div>
                                </div>
                                <div class="row mt-3 d-flex justify-content-center">
                                    <div class="col-6">
                                        <label for="lunchHours" class="form-label"><i class="fas fa-utensils"></i> Total
                                            de horas de almuerzo</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" id="lunchHours" class="form-control" value="00:00"
                                            readonly>
                                    </div>
                                </div>
                                <div class="row mt-3 d-flex justify-content-center">
                                    <div class="col-6">
                                        <label for="workHours" class="form-label"><i class="fas fa-briefcase"></i> Total
                                            de horas laborables</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" id="workHours" class="form-control" value="00:00"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="horas_receso" class="form-label">Horas de Receso o Almuerzo</label>
                                <input type="number" class="form-control @error('horas_receso') is-invalid @enderror"
                                    id="horas_receso" name="horas_receso" min="0" max="24" step="0.25"
                                    required>
                                @error('horas_receso')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @error('tipo_jornada')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                @php
                                    $days = ['L' => 'Lunes', 'M' => 'Martes', 'X' => 'Miércoles', 'J' => 'Jueves', 'V' => 'Viernes', 'S' => 'Sábado', 'D' => 'Domingo'];
                                @endphp
                                @foreach ($days as $initial => $day)
                                    <div class="day-container row" id="day-{{ $initial }}">
                                        <div class="col-md-2 d-flex align-items-center">
                                            <label>{{ $day }} </label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="day-range" id="{{ $initial }}Range"
                                                name="{{ $day }}Range" />
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        id="close">Cerrar</button>
                    <button type="button" class="btn btn-warning" id="clear">Limpiar</button>
                    <button type="submit" class="btn btn-primary" id="store">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>
