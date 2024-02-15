<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="px-1" action="{{ route('company.update', $company) }}" method="POST" id="editForm">
                @csrf
                @method('PUT')
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title" id="editModalLabel">Editar Gerencia</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="ruc" class="form-label">RUC</label>
                        <input type="text" class="form-control @error('ruc') is-invalid @enderror" id="ruc"
                            name="ruc" value="{{ $company->ruc }}" readonly="readonly">
                        @error('ruc')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="nombre"
                            name="name" value="{{ $company->name }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="descripcion" name="description" required>{{ $company->description }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="close">Cerrar</button>
                    <button type="button" class="btn btn-warning" id="clear">Limpiar</button>
                    <button type="submit" class="btn btn-primary" id="update">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
