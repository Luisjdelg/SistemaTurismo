<?php include "Views/Templates/header.php"; ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-list-alt"></i> Formularios</h1>
    </div>
</div>
<button class="btn btn-primary mb-2" type="button" onclick="frmFormulario()"><i class="fa fa-plus"></i> Nuevo Formulario</button>
<div class="row">
    <div class="col-lg-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-light mt-4" id="tblFormulario" style="width: 100%;">
                        <thead class="thead-dark">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="nuevoFormulario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white" id="title">Registro Formulario</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmFormulario" onsubmit="registrarFormulario(event)">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="lblformulario">Nombre</label>
                                <input type="hidden" id="id_formulario" name="id_formulario">
                                <input id="nombre_formulario" class="form-control" type="text" name="nombre_formulario" required placeholder="Nombre de Formulario">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="lblformulario">Descripción</label>
                                <textarea id="descripcion_formulario" class="form-control" type="text" name="descripcion_formulario" required placeholder="Descripcion..."></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" id="btnAccion">Registrar</button>
                                <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>