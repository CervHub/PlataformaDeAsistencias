<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h5 class="modal-title" id="createModalLabel">Crear Empleado</h5>
            </div>
            <div class="modal-body">
                <form class="px-1">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="documento" class="form-label">Documento de Identidad</label>
                            <input type="text" class="form-control" id="documento" name="doi">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fechaNacimiento" name="birthdate">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <label for="nombres" class="form-label">Nombres</label>
                            <input type="text" class="form-control" id="nombres" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="lastname">
                        </div>
                        <div class="mb-3">
                            <label for="posicion" class="form-label">Posición</label>
                            <input type="text" class="form-control" id="posicion" name="position">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="close">Cerrar</button>
                <button type="button" class="btn btn-primary" id="store">Crear</button>
            </div>
        </div>
    </div>
</div>
