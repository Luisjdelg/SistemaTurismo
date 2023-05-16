<?php include "Views/Templates/header.php"; ?>
<div class="container-fluid">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-list-ol"></i> Evaluación</h1>
        </div>
    </div>
    <div class="col-lg-12 text-center">
        <h2> Instrucciones:</h2>
    </div>
    <div class="row">
        <div class="card col-lg-3">
            <h5 class="card-header">Paso 1</h5>
            <div class="card-body">
                <h5 class="card-title">Iniciar la Evaluación</h5>
                <p class="card-text">Eligir el formulario y el establecimiento a evaluar</p>
            </div>
        </div>
        <div class="card col-lg-3">
            <h5 class="card-header">Paso 2</h5>
            <div class="card-body">
                <h5 class="card-title">Responder las preguntas</h5>
                <p class="card-text">Cada pregunta cuenta con varias opciones de respuesta según la valoración, sólo se debe selecionar una opción por pregunta.</p>
            </div>
        </div>
        <div class="card col-lg-3">
            <h5 class="card-header">Paso 3</h5>
            <div class="card-body">
                <h5 class="card-title">Finalizar la Evaluación</h5>
                <p class="card-text">Una vez que respondió todas preguntas, dar clic en guardar y finalizar evaluación.</p>
            </div>
        </div>
        <div class="card col-lg-3">
            <h5 class="card-header">Paso 4</h5>
            <div class="card-body">
                <h5 class="card-title">Visualizar los resultados</h5>
                <p class="card-text">Una vez finalizado se podra observar los resultados de la evalaución.</p>
            </div>
        </div>
        <div class="col-lg-12 text-center mt-4">
            <a class="btn btn-primary mb-2" type="button" href="<?php echo base_url; ?>Evaluacion/test">Continuar<i class="fa fa-arrow-right"></i> </a>
        </div>
    </div>
    <?php include "Views/Templates/footer.php"; ?>