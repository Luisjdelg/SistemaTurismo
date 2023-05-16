<?php
require 'vendor/autoload.php';

//use MongoDB\Client as Mongo;

class Evaluacion extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $id_user = $_SESSION['id_usuario'];
        $perm = $this->model->verificarPermisos($id_user, "Evaluacion");
        if (!$perm && $id_user != 1) {
            $this->views->getView($this, "permisos");
            exit;
        }
    }
    //Index
    public function index()
    {
        $this->views->getView($this, "index");
    }
    //Inicio test
    public function test()
    {
        $formularios = $this->model->listFormulario();
        $establecimientos = $this->model->listEstablecmiento();
        $data = ['formularios' => $formularios, 'establecimientos' => $establecimientos];
        $this->views->getView($this, "test", $data);
        die();
    }
    //Registrar Evaluacion
    public function registrar()
    {
        $id_formulario = strClean($_POST['id_formulario']);
        $id_establecimiento = strClean($_POST['id_establecimiento']);
        $respuesta = json_decode($_POST["respuesta"], true);
        $id_usuario = $_SESSION['id_usuario'];
        $id_evaluacion = $this->model->insertarEvaluacion($id_formulario, $id_usuario, $id_establecimiento);

        if ($id_evaluacion != 0) {
            $msg = array('msg' => 'Error al registrar', 'icono' => 'error');
            foreach ($respuesta as $key => $value) {
                $data = $this->model->insertarDetalle($id_evaluacion, $value["id_pregunta"], $value["id_criterio"]);
                if ($data != 0) {
                    $msg = array('id_evaluacion' => $id_evaluacion, 'msg' => 'Evaluacion Guardada', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al registrar', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    //Resumen 
    public function listarResumen($id_evaluacion)
    {
        $resumen = $this->model->selectResumen($id_evaluacion);
        $evaluacion = $this->model->selectEvaluacion($id_evaluacion);
        $criterios = $this->model->listCriterio();

        $suma = 0;
        for ($i = 0; $i < count($resumen); $i++) {
            $suma = $suma + $resumen[$i]['total'];
            $resumen[$i]['total']=round($resumen[$i]['total'],2);
            if ($resumen[$i]['total'] >= 80) {
                $resumen[$i]['acciones'] = 'MANTENER';
                $resumen[$i]['clase'] = 'badge badge-success';
            } else {
                if ($resumen[$i]['total'] >= 50) {
                    $resumen[$i]['acciones'] = 'MEJORAR';
                    $resumen[$i]['clase'] = 'badge badge-warning';
                } else {
                    $resumen[$i]['acciones'] = 'IMPLEMENTAR';
                    $resumen[$i]['clase'] = 'badge badge-danger';
                }
            }
        }
        $promedio = round($suma / count($resumen), 2);

        if ($promedio >= 80) {
            $valor = "ALTO";
            $clase = "card badge-success col-md-8";
        } else {
            if ($promedio >= 50) {
                $valor = "MEDIO";
                $clase = "card badge-warning col-md-8";
            } else {
                $valor = "BAJO";
                $clase = "card badge-danger col-md-8";
            }
        }
        $data = ['valor' => $valor, 'clase' => $clase, 'criterios' => $criterios, 'promedio' => $promedio, 'resumen' => $resumen, 'evaluacion' => $evaluacion];
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


    //Buscar
    public function buscarEvaluacion()
    {
        if (isset($_GET['q'])) {
            $valor = $_GET['q'];
            $data = $this->model->buscarEvaluacion($valor);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    public function listarPreguntas()
    {
        $id_formulario = strClean($_POST['id_formulario']);
        $id_establecimiento = strClean($_POST['id_establecimiento']);
        /*$mongo = new Mongo("mongodb+srv://Ctc_Vue_Node:qzeaYNRbH1hALOkK@CTC.w7kfj.mongodb.net/ctc_expo");
        try {
            $dbPruebas = $mongo->ctc_expo;
            $establecimient = $dbPruebas->establecimientos;
            //$establecimientos = $establecimiento->find()->toArray();
            $establecimiento = $establecimient->find(array('_id' => $id_establecimiento));
        } catch (PDOException $e) {
            echo "Error en la conexion" . $e->getMessage();
        }*/
        $preguntas = $this->model->listPregunta($id_formulario);
        $criterios = $this->model->listCriterio();
        $formulario = $this->model->selectFormulario($id_formulario);
        $establecimiento = $this->model->selectEstablecimiento($id_establecimiento);
        $data = ['establecimiento' => $establecimiento, 'preguntas' => $preguntas, 'criterios' => $criterios, 'formulario' => $formulario];
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminarevaluacion($id)
    {
        $id_pregunta = $id;
        $result = $this->model->deleteEvaluacion($id_pregunta);
        if ($result) {
            $msg = array('msg' => 'Evaluación Eliminda', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function pdf()
    {
        require('Libraries/pdf/fpdf.php');

        $datos = $this->model->selectDatos();
        $prestamo = $this->model->selectPrestamoDebe();
        if (empty($prestamo)) {
            header('Location: ' . base_url . 'Configuracion/error');
        }
        //require_once 'Libraries/pdf/fpdf.php';
        $pdf = new FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle("Reporte");
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(195, 5, utf8_decode($datos['nombre']), 0, 1, 'C');
        //$pdf->Image(base_url. "Assets/img/logo.png", 180, 10, 30, 30, 'PNG');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 5, utf8_decode("Teléfono: "), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 5, $datos['telefono'], 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 5, utf8_decode("Dirección: "), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 5, utf8_decode($datos['direccion']), 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 5, "Correo: ", 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 5, utf8_decode($datos['correo']), 0, 1, 'L');

        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, 10, "Reporte", 1, 1, 'C', 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(10, 5, utf8_decode('N°'), 1, 0, 'L');
        $pdf->Cell(111, 5, utf8_decode('Pregunta'), 1, 0, 'L');
        $pdf->Cell(30, 5, 'Criterio', 1, 0, 'L');
        $pdf->Cell(30, 5, 'Fecha Prestamo', 1, 0, 'L');
        $pdf->Cell(15, 5, 'Cant.', 1, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $contador = 1;
        $pdf->Cell(50, 10, 'Probando FPDF', 0, 1, 'L');

        $pdf->Cell(50, 5, '', 0, 1);

        $pdf->SetFont('Arial', 'B', 10);

        //convertimos el texto a utf8
        $texto = utf8_decode('Lorem Ipsum …...Lorem Ipsum …...Lorem Ipsum …...Lorem Ipsum …...Lorem Ipsum …...Lorem Ipsum …...Lorem Ipsum …...Lorem Ipsum …...Lorem Ipsum …...Lorem Ipsum …...Lorem Ipsum …...Lorem Ipsum …...');

        $pdf->MultiCell(190, 5, $texto);
        foreach ($prestamo as $row) {
            $pdf->MultiCell(10, 12, $contador, 1, 0, 'L');
            $texto = utf8_decode($row['nombre_pregunta']);
            $pdf->MultiCell(110, 12, $texto, 1);
            $pdf->MultiCell(30, 12, utf8_decode($row['id_evaluacion']), 1, 0, 'L');
            $pdf->MultiCell(30, 12, $row['id_pregunta'], 1, 0, 'L');
            $pdf->MultiCell(15, 12, $row['id_evaluacion'], 1, 1, 'L');
            $contador++;
        }
        $pdf->Output("prestamos.pdf", "I");
    }
}
