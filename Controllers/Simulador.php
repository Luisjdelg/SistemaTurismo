<?php
class Simulador extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $id_user = $_SESSION['id_usuario'];
        $perm = $this->model->verificarPermisos($id_user, "Simulador");
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
    //Inicio
    public function inicio()
    {
        $id_user = $_SESSION['id_usuario'];
        $formularios = $this->model->listFormulario();
        $establecimiento = $this->model->selectEstablecmiento($id_user);
        $data = ['formularios' => $formularios, 'establecimiento' => $establecimiento];
        $this->views->getView($this, "inicio", $data);
        die();
    }
    //Registrar Simulacion
    public function listarPreguntas()
    {
        $id_user = $_SESSION['id_usuario'];
        $id_formulario = strClean($_POST['id_formulario']);
        $establecimiento = $this->model->selectEstablecmiento($id_user);       
        $preguntas = $this->model->listPregunta($id_formulario);
        $criterios = $this->model->listCriterio();
        $categorias = $this->model->listCategoria();
        $formulario = $this->model->selectFormulario($id_formulario);
        $data = ['establecimiento' => $establecimiento, 'categorias' => $categorias, 'preguntas' => $preguntas, 'criterios' => $criterios, 'formulario' => $formulario];
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
        $id_usuario = $_SESSION['id_usuario'];
        $id_formulario = strClean($_POST['id_formulario']);
        $id_establecimiento = strClean($_POST['id_establecimiento']);
        $respuesta = json_decode($_POST["respuesta"], true);

        $resp_simulacion = $this->model->insertarSimulacion($id_formulario, $id_usuario, $id_establecimiento);
        if ($resp_simulacion != 0) {
            $msg = array('msg' => 'Error al registrar', 'icono' => 'error');
            foreach ($respuesta as $key => $value) {
                $data = $this->model->insertarDetalle($resp_simulacion, $value["id_pregunta"], $value["id_criterio"]);
                if ($data != 0) {
                    $msg = array('id_evaluacion' => $resp_simulacion, 'msg' => 'Simulación Guardada', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al registrar', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function listarResumen($id_simulacion)
    {
        $resumen = $this->model->selectResumen($id_simulacion);
        $simulacion = $this->model->selectSimulacion($id_simulacion);
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
        $data = ['valor' => $valor, 'clase' => $clase, 'criterios' => $criterios, 'promedio' => $promedio, 'resumen' => $resumen, 'simulacion' => $simulacion];
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


}
