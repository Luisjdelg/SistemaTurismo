<?php include "Views/Templates/header.php"; ?>
<div id="layoutSidenav_content">
    <div class="container-fluid">
        <form id="frmEvaluacion" onsubmit="registrarEvaluacion(event)" method="post">
            <div id="seccion_seleccion" class="card">
                <div class="row">
                    <div class="col-md-6">
                        <div class=" card-body form-group">
                            <h5 class="card-header">Seleccione un Establecimiento:</h5>
                            <select id="id_establecimiento" class="form-control" name="id_establecimiento">
                                <?php foreach ($data['establecimientos'] as $establecimiento) { ?>
                                    <option value="<?php echo $establecimiento['id_establecimiento']; ?>"><?php echo $establecimiento['nombre_establecimiento']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body form-group">
                            <h5 class="card-header">Seleccione un Formulario:</h5>
                            <select id="id_formulario" class="form-control" name="id_formulario">
                                <?php foreach ($data['formularios'] as $formularios) { ?>
                                    <option value="<?php echo $formularios['id_formulario']; ?>"><?php echo $formularios['nombre_formulario']; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="card col-md-12">
                    <div class="card-body">
                        <div class="text-center">
                            <a class="btn btn-danger" href="<?php echo base_url; ?>Evaluacion"><i class="fa fa-arrow-left"></i> Regresar</a>
                            <button onclick="listarPreguntas(event)" class="btn btn-primary">Iniciar Evaluacion <i class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="seccion_informacion" style="display:none" class="card col-lg-12">
                <h5 id="idFormulario" class="card-body">Titulo</h5>
                <h6 class="card-header">Información del Establecimiento</h6>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="hidden" id="idestablecimiento" class="form-control" type="text" name="idestablecimiento">
                            <h6 class="card-title">Nombre:</h6>
                            <p id="nombre_establecimiento" class="card"></p>
                        </div>
                        <div class="col-lg-6">
                            <h6 class="card-title">Dirección:</h6>
                            <p id="direccion_establecimiento" class="card"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <h6 class="card-title">Representante:</h6>
                            <p id="nombre_representante" class="card"></p>
                        </div>
                        <div class="col-lg-6">
                            <h6 class="card-title">Teléfono:</h6>
                            <p id="telefono_representante" class="card"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="seccion_parametro" style="display:none" class="card col-lg-12">
                <div class="card-header">
                    <h6>Parámetros de Calificación</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 text-center">
                            <h6>Valor</h6>
                        </div>
                        <div class="col-md-4">
                            <h6>Identificacion</h6>
                        </div>
                        <div class="col-md-4">
                            <h6>Acciones</h6>
                        </div>
                        <div class="col-md-2">
                            <h6>Fase</h6>
                        </div>
                    </div>
                </div>
                <div id="seccion_criterio">

                </div>
            </div>

            <div id="seccion_preguntas" class="card" style="display:none">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h5>Preguntas</h5>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-2 pl-2 text-center">
                                    <h6>A</h6>
                                </div>
                                <div class="col-md-2 pl-2 text-center">
                                    <h6>B</h6>
                                </div>
                                <div class="col-md-2 pl-2 text-center">
                                    <h6>C</h6>
                                </div>
                                <div class="col-md-2 pl-2 text-center">
                                    <h6>D</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="respuesta" class="form-control" type="text" name="respuesta" placeholder="respuesta">
            <div id="idpreguntas">
                <div class="row">
                    <div class="col-md-8">
                    </div>
                </div>
            </div>
            <div id="list-pregunta">
            </div>
            <div id="seccion_resultados" style="display:none" class="card col-lg-12">
                <div class="card-header">
                    <h6>RESULTADOS DE LA GESTIÓN EN CALIDAD</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h6>NUMERAL DE LA NORMA</h6>
                        </div>
                        <div class="col-md-4">
                            <h6>% OBTENIDO DE IMPLEMENTACION</h6>
                        </div>
                        <div class="col-md-4">
                            <h6>ACCIONES POR REALIZAR</h6>
                        </div>
                    </div>
                </div>
                <div id="list_resumen">
                </div>
                <div id="seccion_resultado">
                </div>
            </div>
            <div id="seccion_botones" style="display:none" class="card col-md-12">
                <div class=" card-body text-center">
                    <a class="btn btn-danger" href="<?php echo base_url; ?>Evaluacion"><i class="fa fa-times"></i> Cancelar</a>
                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>Guardar y Finalizar</button>
                </div>
            </div>
            <div id="seccion_botones2" style="display:none" class="card col-md-12">
                <div class=" card-body text-center">
                    <a class="btn btn-danger" href="<?php echo base_url; ?>Evaluacion"><i class="fa fa-times"></i> Salir</a>
                    <button onclick="Imprimir(event)" class="btn btn-primary"><i class="fa fa-print"></i> Imprimir</button>
                </div>
            </div>
        </form>
    </div>
</div>

<template id="template-listCalificacion">
    <div class="card" id="id_criterios">
        <div class="row">
            <div class="col-md-2 text-center">
                <p id="valor_criterio"></p>
            </div>
            <div class="col-md-4">
                <p id="identificacion_criterio"></p>
            </div>
            <div class="col-md-4">
                <p id="nombre_criterio"></p>
            </div>
            <div class="col-md-2">
                <p id="fase_criterio"></p>
            </div>
        </div>
    </div>
</template>
<template id="template-listPreguntas">
    <div class="card" id="idpreguntas">
        <div class="row">
            <div class="col-md-8">
                <input type="hidden" id="id_pregunta" name="id_pregunta">
                <textarea readonly="readonly" class="form-control" id="nombre_pregunta" name="nombre_pregunta">Pregunta1</textarea>
            </div>
            <div class="col-md-4">
                <div id="list-criterio" class="form-row">
                </div>
            </div>
        </div>
    </div>
</template>
<template id="template-listCriterios">
    <div class="col-md-2 pl-2">
        <div>
            <label for=""></label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" onclick="listarDetalles()" type="radio" required>
        </div>
    </div>
</template>
<template id="template-respCriterios">
    <div class="col-md-2 pl-2">
        <div>
            <label for=""></label>
        </div>
        <div id="criterio" class="form-check form-check-inline">
        </div>
    </div>
</template>
<template id="template-listResumen">
    <div class="card" id="idcriterios">
        <div class="row">
            <div class="col-md-4">
                <p id="categoria"></p>
            </div>
            <div class="col-md-4">
                <p id="total"></p>
            </div>
            <div class="col-md-4 text-center">
                <span id="acciones" class="badge badge-warning"> </span>
            </div>
        </div>
    </div>
</template>
<template id="template-totalResultado">
    <div class="card">
        <div class="row">
            <div class="col-md-4">
                <h6>TOTAL RESULTADO IMPLEMENTACIÓN</h6>
            </div>
            <div id="resultado" class=" card col-md-8">
                <h6 id="total_resultado"></h6>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="row">
            <div class="col-md-4">
                <h6>CALIFICACIÓN GLOBAL EN LA GESTIÓN DE CALIDAD</h6>
            </div>
            <div id="calificacion" class="card col-md-8">
                <h6 id="total_calificacion"></h6>
            </div>
        </div>
    </div>
</template>
<?php include "Views/Templates/footer.php"; ?>