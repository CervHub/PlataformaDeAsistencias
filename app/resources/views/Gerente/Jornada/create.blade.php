<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <form class="px-1" action="{{ route('jornadas.store') }}" method="POST" id="createForm">
                @csrf
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title" id="createModalLabel">Crear Horario</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
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
                                    <div style="position: relative; height: 100%; margin-right: 10px;">
                                        <button type="button" class="btn day-button" id="{{ $initial }}Button">
                                            <i class="fa fa-circle" style="font-size: 2em; color: transparent;"></i>
                                            <span
                                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center; color: black;">
                                                {{ $initial }}
                                            </span>
                                        </button>
                                    </div>
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
                                        <input type="text" id="totalHours" name="totalHours" class="form-control"
                                            value="00:00" readonly>
                                    </div>
                                </div>
                                <div class="row mt-3 d-flex justify-content-center">
                                    <div class="col-6">
                                        <label for="lunchHours" class="form-label"><i class="fas fa-utensils"></i> Total
                                            de horas de almuerzo</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" id="lunchHours" name="lunchHours" class="form-control"
                                            value="00:00" readonly>
                                    </div>
                                </div>
                                <div class="row mt-3 d-flex justify-content-center">
                                    <div class="col-6">
                                        <label for="workHours" class="form-label"><i class="fas fa-briefcase"></i> Total
                                            de horas laborables</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" id="workHours" name="workHours" class="form-control"
                                            value="00:00" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row mb-3 d-flex flex-column align-items-center">
                                <label for="horas_trabajo" class="form-label">Horas de Entrada y Salida del Trabajo:
                                    <i class="fa fa-circle text-success" id="horas_trabajo_color_indicator"></i>
                                </label>
                                <label for="horas_receso" class="form-label">Horas de Receso o Almuerzo:
                                    <i class="fa fa-circle text-success" id="horas_receso_color_indicator"></i>
                                </label>
                                <label for="horas_almuerzo" class="form-label">Horas de Almuerzo:
                                    <i class="fa fa-circle text-success" id="horas_almuerzo_color_indicator"></i>
                                </label>
                            </div>
                            <div class="mb-3">
                                @php
                                    $days = ['L' => 'Lunes', 'M' => 'Martes', 'X' => 'Miércoles', 'J' => 'Jueves', 'V' => 'Viernes', 'S' => 'Sábado', 'D' => 'Domingo'];
                                @endphp
                                @foreach ($days as $initial => $day)
                                    <div class="row mt-3">
                                        <div class="day-container col-md-12" id="day-{{ $initial }}">
                                            <div class="row">
                                                <div class="col-md-2 d-flex align-items-center">
                                                    <label>{{ $day }} </label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="day-range"
                                                        id="{{ $initial }}Range" />
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="day-range"
                                                        id="lunch{{ $initial }}Range" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="datajson" id="datajson">
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        id="close">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="store">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>
