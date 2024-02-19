<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="px-1" action="{{ route('personal.destroy', ['personal' => 0]) }}" method="POST" id="deleteFormPrimary">
                @csrf
                @method('DELETE')
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title" id="deleteModalLabel">Eliminar Personal</h5>
                </div>
                <div class="loading mb-3 mt-3" style="display: none; ">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Cargando...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-body" id="deleteForm">
                    <p>¿Estás seguro de que quieres eliminar a este personal?</p>
                    <div class="mb-3">
                        <label for="documento_identidad" class="form-label">Documento de Identidad</label>
                        <input type="text" class="form-control" id="documento_identidad" name="documento_identidad"
                            value="" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nombres" class="form-label">Nombres</label>
                        <input type="text" class="form-control" id="nombres" name="nombres" value=""
                            readonly>
                    </div>
                    <div class="mb-3">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" value=""
                            readonly>
                    </div>
                    <div class="mb-3">
                        <label for="posicion" class="form-label">Cargo(Puesto Laboral)</label>
                        <input type="text" class="form-control" id="posicion" name="posicion" value=""
                            readonly>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="close">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="delete">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>
