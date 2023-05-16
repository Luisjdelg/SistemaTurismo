<?php include "Views/Templates/header.php"; ?>
<div id="layoutSidenav_content">
    <div class="container-fluid">
        <div class="rows p-4">
            <h5 class="text-center">Formulario</h5>
            <form id="frmEditFormulario" onsubmit="GuardaFormulario(event)" method="post" autocomplete="off" enctype="multipart/form-data">
                <div class="col-md-12">
                    <div class="row">
                        <label for="lblformulario">Titulo:</label>
                        <input type="hidden" class="form-control" name="id_formulario" value="<?php echo $data['formulario']['id_formulario']; ?>">
                        <input id="nombre_formulario" class="form-control" type="text" required name="nombre_formulario" value="<?php echo $data['formulario']['nombre_formulario']; ?>">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <label for="lblDescripcion">Descripcion:</label>
                        <textarea class="form-control" id="descripcion_formulario" required name="descripcion_formulario"><?php echo $data['formulario']['descripcion_formulario']; ?></textarea>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="col-md-12 p-5">
                        <div class="text-center">
                            <button class="btn btn-info mb-2" type="button" onclick="nuevaPregunta()"> <i class="fa fa-plus-circle"></i> Agregar Pregunta</button>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit"> <i class="fa fa-save"></i> Guardar Cambios</button>
                        <a class="btn btn-danger" href="<?php echo base_url; ?>formulario"><i class="fa fa-reply"></i> Salir</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table mt-4" id="tblPreguntas">
            <thead class="thead">
                <tr>
                    <th>PREGUNTA</th>
                    <th>CATEGORÍA</th>
                    <th>GESTIÓN</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['preguntas'] as $preguntas) { ?>
                    <tr>
                        <td width="50%">
                            <textarea readonly="readonly" class="form-control" id="pregunta" name="pregunta"><?php echo $preguntas['nombre_pregunta']; ?></textarea>
                        </td>
                        <td width="18%">
                            <select disabled="false" readonly="readonly" id="idCategoria" class="form-control" name="idCategoria">
                                <?php foreach ($data['categorias'] as $categoria) { ?>
                                    <option <?php if ($categoria['id_categoria'] == $preguntas['id_categoria']) {
                                                echo 'selected';
                                            } ?> value="<?php echo $categoria['id_categoria']; ?>"><?php echo $categoria['nombre_categoria']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td width="22%">
                            <select disabled="false" readonly="readonly" id="idgestion" class="form-control" name="idgestion">
                                <?php foreach ($data['gestiones'] as $gestion) { ?>
                                    <option <?php if ($gestion['id_gestion'] == $preguntas['id_gestion']) {
                                                echo 'selected';
                                            } ?> value="<?php echo $gestion['id_gestion']; ?>"><?php echo $gestion['nombre_gestion']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td width="10%">
                            <button class="btn btn-primary" type="button" onclick="btnEditarPregunta(<?php echo $preguntas['id_pregunta']; ?>)"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger" type="button" onclick="btnEliminarPregunta(<?php echo $preguntas['id_pregunta']; ?>, <?php echo $data['formulario']['id_formulario']; ?>)"><i class="fa fa-trash-o"></i></button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div id="nuevaPregunta" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title text-white" id="title">Title</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="frmPregunta" onsubmit="registrarPregunta(event,<?php echo $data['formulario']['id_formulario']; ?>)">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="lblNombrePregunta">Pregunta:</label>
                                    <input type="hidden" id="id_pregunta" name="id_pregunta">
                                    <input type="hidden" class="form-control" id="id_formulario" name="id_formulario" value="<?php echo $data['formulario']['id_formulario']; ?>">
                                    <textarea id="nombre_pregunta" class="form-control" name="nombre_pregunta" type="text" required placeholder="Pregunta"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lblcategoria">Seleccione la Categoría:</label>
                                    <select id="id_categoria" class="form-control" name="id_categoria">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lblgestion">Seleccione la Gestión:</label>
                                    <select id="id_gestion" class="form-control" name="id_gestion">
                                    </select>
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