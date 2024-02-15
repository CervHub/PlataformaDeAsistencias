<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="px-1">
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title" id="detailModalLabel">Detalles de la Gerencia</h5>
                </div>
                <div class="loading mb-3 mt-3" style="display: none; ">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Cargando...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-body" id="detailForm" style="display: none;">
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Nombre</label>
                        <input class="form-control" id="edit_descripcion" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="ruc" class="form-label">ID de ingreso</label>
                        <input type="text" class="form-control" id="edit_ruc" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Contraseña</label>
                        <input type="text" class="form-control" id="edit_nombre" readonly>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="close">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="copy">Copiar</button>
                </div>
            </div>
        </div>
    </div>
</div>
