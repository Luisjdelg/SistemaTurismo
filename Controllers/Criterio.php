<?php
class Criterio extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $id_user = $_SESSION['id_usuario'];
        $perm = $this->model->verificarPermisos($id_user, "Criterio");
        if (!$perm && $id_user != 1) {
            $this->views->getView($this, "permisos");
            exit;
        }
    }
    public function index()
    {
        $this->views->getView($this, "index");
    }
    public function listar()
    {
        $data = $this->model->getCriterios();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado_criterio'] == 1) {
                $data[$i]['estado_criterio'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarCriterio(' . $data[$i]['id_criterio'] . ');"><i class="fa fa-pencil-square-o"></i>Editar</button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarCriterio(' . $data[$i]['id_criterio'] . ');"><i class="fa fa-trash-o"></i>Eliminar</button>
                <div/>';
            } else {
                $data[$i]['estado_criterio'] = '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarCriterio(' . $data[$i]['id_criterio'] . ');"><i class="fa fa-reply-all"></i>Reingresar</button>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        $valor_criterio = strClean($_POST['valor_criterio']);
        $identificacion_criterio = strClean($_POST['identificacion_criterio']);
        $fase_criterio = strClean($_POST['fase_criterio']);
        $nombre_criterio = strClean($_POST['nombre_criterio']);
        $id_criterio = strClean($_POST['id_criterio']);
        if (empty($identificacion_criterio)) {
            $msg = array('msg' => 'Los datos son requeridos', 'icono' => 'warning');
        } else {
            if ($id_criterio == "") {
                $data = $this->model->insertarCriterio($valor_criterio, $identificacion_criterio, $fase_criterio, $nombre_criterio);
                if ($data == "ok") {
                    $msg = array('msg' => 'Criterio registrado', 'icono' => 'success');
                } else if ($data == "existe") {
                    $msg = array('msg' => 'El criterio ya existe', 'icono' => 'warning');
                } else {
                    $msg = array('msg' => 'Error al registrar', 'icono' => 'error');
                }
            } else {
                $data = $this->model->actualizarCriterio($valor_criterio, $identificacion_criterio, $fase_criterio, $nombre_criterio, $id_criterio);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Criterio modificado', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al modificar', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar($id_criterio)
    {
        $data = $this->model->editCriterio($id_criterio);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar($id_criterio)
    {
        $data = $this->model->estadoCriterio(0, $id_criterio);

        if ($data == 1) {
            $msg = array('msg' => 'Criterio dado de baja', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar', 'icono' => 'error');
        }
        
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar($id_criterio)
    {
        $data = $this->model->estadoCriterio(1, $id_criterio);
        if ($data == 1) {
            $msg = array('msg' => 'Criterio restaurado', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al restaurar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function buscarCriterio()
    {
        if (isset($_GET['q'])) {
            $valor = $_GET['q'];
            $data = $this->model->buscarCriterio($valor);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
}
