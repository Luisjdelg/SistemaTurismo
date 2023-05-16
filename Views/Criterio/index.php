<?php include "Views/Templates/header.php"; ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-list"></i> Criterios</h1>
    </div>
</div>
<button class="btn btn-primary mb-2" type="button" onclick="frmCriterio()"><i class="fa fa-plus"></i> Nuevo Criterio</button>
<div class="row">
    <div class="col-lg-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-light mt-4" id="tblCriterio" style="width: 100%;">
                        <thead class="thead-dark">
                            <tr>
                                <th>Valor</th>
                                <th>Identificador</th>
                                <th>Fase</th>
                                <th>Acción</th>
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
<div id="nuevoCriterio" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white" id="title">Registro Criterio</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmCriterio" onsubmit="registrarCriterio(event)">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="valor_criterio">Valor</label>
                                <input type="hidden" id="id_criterio" name="id_criterio">
                                <input id="valor_criterio" class="form-control" type="text" name="valor_criterio" required placeholder="Valor">
                            </div>
                            <div class="form-group">
                                <label for="identificacion_criterio">Identificador</label>
                                <input id="identificacion_criterio" class="form-control" type="text" name="identificacion_criterio" required placeholder="Identificador del Criterio">
                            </div>
                            <div class="form-group">
                                <label for="fase_criterio">Fase</label>
                                <input id="fase_criterio" class="form-control" type="text" name="fase_criterio" required placeholder="Fase">
                            </div>
                            <div class="form-group">
                                <label for="nombre_criterio">Accion</label>
                                <input id="nombre_criterio" class="form-control" type="text" name="nombre_criterio" required placeholder="Accion a realizar">
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