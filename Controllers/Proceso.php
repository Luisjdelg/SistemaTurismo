<?php
class Proceso extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $id_user = $_SESSION['id_usuario'];
        $perm = $this->model->verificarPermisos($id_user, "Proceso");
        if (!$perm && $id_user != 1) {
            $this->views->getView($this, "permisos");
            exit;
        }
    }
    public function index()
    {
        $this->views->getView($this, "index");
    }
    public function obtener()
    {
        $data = $this->model->getProcesos();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function listar()
    {
        $data = $this->model->getProcesos();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado_proceso'] == 1) {
                $data[$i]['estado_proceso'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarProceso(' . $data[$i]['id_proceso'] . ');"><i class="fa fa-pencil-square-o"></i>Editar</button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarProceso(' . $data[$i]['id_proceso'] . ');"><i class="fa fa-trash-o"></i>Elimnar</button>
                <div/>';
            } else {
                $data[$i]['estado_proceso'] = '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarProceso(' . $data[$i]['id_proceso'] . ');"><i class="fa fa-reply-all"></i>Reingresar</button>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        $nombre_proceso = strClean($_POST['nombre_proceso']);
        $id_proceso = strClean($_POST['id_proceso']);
        if (empty($nombre_proceso)) {
            $msg = array('msg' => 'El nombre es requerido', 'icono' => 'warning');
        } else {
            if ($id_proceso == "") {
                $data = $this->model->insertarProceso($nombre_proceso);
                if ($data == "ok") {
                    $msg = array('msg' => 'Proceso registrado', 'icono' => 'success');
                } else if ($data == "existe") {
                    $msg = array('msg' => 'La cateoria ya existe', 'icono' => 'warning');
                } else {
                    $msg = array('msg' => 'Error al registrar', 'icono' => 'error');
                }
            } else {
                $data = $this->model->actualizarProceso($nombre_proceso, $id_proceso);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Proceso modificado', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al modificar', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar($id_proceso)
    {
        $data = $this->model->editProceso($id_proceso);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar($id_proceso)
    {
        $data = $this->model->estadoProceso(0, $id_proceso);
        if ($data == 1) {
            $msg = array('msg' => 'Proceso dado de baja', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar($id_proceso)
    {
        $data = $this->model->estadoProceso(1, $id_proceso);
        if ($data == 1) {
            $msg = array('msg' => 'Proceso restaurado', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al restaurar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function buscarProceso()
    {
        if (isset($_GET['q'])) {
            $valor = $_GET['q'];
            $data = $this->model->buscarProceso($valor);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
}
