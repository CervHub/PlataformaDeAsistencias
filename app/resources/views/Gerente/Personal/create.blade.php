<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="px-1" action="{{ route('personal.store') }}" method="POST" id="createForm">
                @csrf
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title" id="createModalLabel">Crear Personal</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombres" class="form-label">Nombres</label>
                            <input type="text" class="form-control @error('nombres') is-invalid @enderror"
                                id="nombres" name="nombres" value="{{ old('nombres') }}" required>
                            @error('nombres')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control @error('apellidos') is-invalid @enderror"
                                id="apellidos" name="apellidos" value="{{ old('apellidos') }}" required>
                            @error('apellidos')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                                id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}"
                                required>
                            @error('fecha_nacimiento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="documento_identidad" class="form-label">Documento de Identidad</label>
                            <input type="text"
                                class="form-control @error('documento_identidad') is-invalid @enderror"
                                id="documento_identidad" name="documento_identidad"
                                value="{{ old('documento_identidad') }}" required>
                            @error('documento_identidad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo</label>
                            <input type="email" class="form-control @error('correo') is-invalid @enderror"
                                id="correo" name="correo" value="{{ old('correo') }}" required>
                            @error('correo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="posicion" class="form-label">Cargo(Puesto Laboral)</label>
                            <input type="text" class="form-control @error('posicion') is-invalid @enderror"
                                id="posicion" name="posicion" value="{{ old('posicion') }}">
                            @error('posicion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jornada" class="form-label">Jornada</label>
                            <select class="form-control" id="jornada" name="jornada">
                                <option value="">Selecciona una jornada</option>
                                @foreach ($jornadas as $jornada)
                                    <option value="{{ $jornada->id }}">{{ $jornada->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="close">Cerrar</button>
                    <button type="button" class="btn btn-warning" id="clear">Limpiar</button>
                    <button type="submit" class="btn btn-primary" id="store">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>
