<?php include "Views/Templates/header.php"; ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-list-alt"></i> Simulador</h1>
    </div>
</div>

<div class="col-lg-12 text-center">
    <h1> Instrucciones:</h1>
</div>
<div class="row">
    <div class="card col-lg-3">
        <h5 class="card-header">Paso 1</h5>
        <div class="card-body">
            <h5 class="card-title">Iniciar la simulación</h5>
            <p class="card-text">Eligir el formulario, donde se generará las preguntas relacionadas con la calidad de los Servicios Turísticos.</p>
        </div>
    </div>
    <div class="card col-lg-3">
        <h5 class="card-header">Paso 2</h5>
        <div class="card-body">
            <h5 class="card-title">Responder las preguntas</h5>
            <p class="card-text">Cada pregunta cuenta con varias opciones de respuesta según la valoración, seleccione una opción por pregunta.</p>
        </div>
    </div>
    <div class="card col-lg-3">
        <h5 class="card-header">Paso 3</h5>
        <div class="card-body">
            <h5 class="card-title">Finalizar la Simulación</h5>
            <p class="card-text">Una vez que respondió todas preguntas, dar clic en guardar y finalizar simulación.</p>
        </div>
    </div>
    <div class="card col-lg-3">
        <h5 class="card-header">Paso 4</h5>
        <div class="card-body">
            <h5 class="card-title">Visualizar los resultados </h5>
            <p class="card-text">Una vez finalizado se podrá observar el puntaje obtenido según la categoría. Si se desea vuelva  a intentar nuevamente.</p>
        </div>
    </div>
    <div class="col-lg-12 text-center mt-4">
        <a class="btn btn-primary mb-2" type="button" href="<?php echo base_url; ?>Simulador/inicio">Continuar <i class="fa fa-arrow-right"></i></a>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>