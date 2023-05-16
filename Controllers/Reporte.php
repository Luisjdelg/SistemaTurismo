<?php
require 'vendor/autoload.php';

//use MongoDB\Client as Mongo;

class Reporte extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $id_user = $_SESSION['id_usuario'];
        $perm = $this->model->verificarPermisos($id_user, "Reporte");
        if (!$perm && $id_user != 1) {
            $this->views->getView($this, "permisos");
            exit;
        }
    }
    public function index()
    {
        $establecimientos = $this->model->listEstablecmiento();
        $data = ['establecimientos' => $establecimientos];
        $this->views->getView($this, "index", $data);
    }

    public function listar($id)
    {
        $id_establecimiento = $id;
        $evaluacion = $this->model->listarEvaluacion($id_establecimiento);
        echo json_encode($evaluacion, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function listarReporte($id_evaluacion)
    {
        $id_establecimiento = strClean($_POST['id_Establecimiento']);
        $resumen = $this->model->selectResumen($id_evaluacion);
        $criterios = $this->model->listCriterio();
        $establecimiento = $this->model->selectEstablecimiento($id_establecimiento);
        $id_usuario = $_SESSION['id_usuario'];

        if ($id_usuario == 1) {
            $evaluacion = $this->model->selectEvaluacion($id_evaluacion);
        } else {
            $evaluacion = $this->model->selectEvaluacion2($id_evaluacion, $id_usuario);
        }

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
        $data = ['establecimiento' => $establecimiento, 'valor' => $valor, 'clase' => $clase, 'criterios' => $criterios, 'promedio' => $promedio, 'resumen' => $resumen, 'evaluacion' => $evaluacion];
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
