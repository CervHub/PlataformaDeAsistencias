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
                        <div class="col d-flex justify-content-center">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-4 px-5">
                                    <div class="mb-3">
                                        <label for="nombre_jornada" class="form-label">Nombre de la Jornada</label>
                                        <input type="text"
                                            class="form-control @error('nombre_jornada') is-invalid @enderror"
                                            id="nombre_jornada" name="nombre_jornada"
                                            value="{{ old('nombre_jornada') }}" required>
                                        @error('nombre_jornada')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @php
                                        $days = ['L' => 'Lunes', 'M' => 'Martes', 'X' => 'Miércoles', 'J' => 'Jueves', 'V' => 'Viernes', 'S' => 'Sábado', 'D' => 'Domingo'];
                                    @endphp

                                    <div class="mb-3">
                                        <label><i class="fas fa-history"></i>Horas por dia</label>
                                        <div class="row mt-3 mb-3">
                                            @foreach ($days as $initial => $day)
                                                <div class="col-8">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1"
                                                            style="border-top-left-radius: 10px !important; border-bottom-left-radius: 10px !important; display: inline-block; width: 100px;">{{ $day }}</span>
                                                        <input type="text" class="form-control"
                                                            aria-describedby="basic-addon1"
                                                            style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important;"
                                                            readonly value="00:00" id="{{ $initial }}Day">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row mt-3 d-flex justify-content-center">
                                            <div class="col-12">
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1"
                                                        style="display: inline-block; width: 180px;border-top-left-radius: 10px !important; border-bottom-left-radius: 10px !important;"><i
                                                            class="fas fa-calendar-week"></i> T.H. Semana</span>
                                                    <input type="text" id="totalHours" name="totalHours"
                                                        class="form-control" value="00:00" readonly
                                                        style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3 d-flex justify-content-center">
                                            <div class="col-12">
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1"
                                                        style="display: inline-block; width: 180px;border-top-left-radius: 10px !important; border-bottom-left-radius: 10px !important;"><i
                                                            class="fas fa-utensils"></i> T.H. Almuerzo</span>
                                                    <input type="text" id="lunchHours" name="lunchHours"
                                                        class="form-control" value="00:00" readonly
                                                        style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3 d-flex justify-content-center">
                                            <div class="col-12">
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1"
                                                        style="display: inline-block; width: 180px;border-top-left-radius: 10px !important; border-bottom-left-radius: 10px !important;"><i
                                                            class="fas fa-briefcase"></i> T.H. Laborables</span>
                                                    <input type="text" id="workHours" name="workHours"
                                                        class="form-control" value="00:00" readonly
                                                        style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 px-5">
                                    <div class="mb-3">
                                        <label><i class="fas fa-history"></i> Selecciona los días a laborar</label>
                                        <p class="text-primary">
                                            <i class="fas fa-circle"></i> Horario de entrada y salida (color azul)
                                        </p>
                                        <p class="text-warning">
                                            <i class="fas fa-circle"></i> Horario de salida y retorno del almuerzo
                                            (color naranja). En caso de no tener, dejar en 0 horas.
                                        </p>
                                    </div>
                                    <div class="mb-3 d-flex justify-content-center">
                                        @foreach ($days as $initial => $day)
                                            <div style="position: relative; height: 100%; margin-right: 10px;">
                                                <button type="button" class="btn day-button"
                                                    id="{{ $initial }}Button">
                                                    <i class="fa fa-circle"
                                                        style="font-size: 2em; color: transparent;"></i>
                                                    <span
                                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center; color: black;">
                                                        {{ $initial }}
                                                    </span>
                                                </button>
                                            </div>
                                        @endforeach
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
