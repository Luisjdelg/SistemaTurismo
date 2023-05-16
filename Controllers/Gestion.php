<?php
class Gestion extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $id_user = $_SESSION['id_usuario'];
        $perm = $this->model->verificarPermisos($id_user, "Gestion");
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
        $data = $this->model->getGestiones();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado_gestion'] == 1) {
                $data[$i]['estado_gestion'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarGestion(' . $data[$i]['id_gestion'] . ');"><i class="fa fa-pencil-square-o"></i>Editar</button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarGestion(' . $data[$i]['id_gestion'] . ');"><i class="fa fa-trash-o"></i>Eliminar</button>
                <div/>';
            } else {
                $data[$i]['estado_gestion'] = '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarGestion(' . $data[$i]['id_gestion'] . ');"><i class="fa fa-reply-all"></i>Reingresar</button>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        $nombre_gestion = strClean($_POST['nombre_gestion']);
        $id_proceso = strClean($_POST['id_proceso']);
        $id_gestion = strClean($_POST['id_gestion']);

        if (empty($nombre_gestion)) {
            $msg = array('msg' => 'El nombre es requerido', 'icono' => 'warning');
        } else {
            if ($id_gestion == "") {
                $data = $this->model->insertarGestion($nombre_gestion, $id_proceso);
                if ($data == "ok") {
                    $msg = array('msg' => 'Gestión registrado', 'icono' => 'success');
                } else if ($data == "existe") {
                    $msg = array('msg' => 'La gestión ya existe', 'icono' => 'warning');
                } else {
                    $msg = array('msg' => 'Error al registrar', 'icono' => 'error');
                }
            } else {
                $data = $this->model->actualizarGestion($nombre_gestion, $id_proceso, $id_gestion);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Gestión modificado', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al modificar', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar($id_gestion)
    {
        $data = $this->model->editGestion($id_gestion);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar($id_gestion)
    {
        $data = $this->model->estadoGestion(0, $id_gestion);
        if ($data == 1) {
            $msg = array('msg' => 'Gestión dado de baja', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar($id_gestion)
    {
        $data = $this->model->estadoGestion(1, $id_gestion);
        if ($data == 1) {
            $msg = array('msg' => 'Gestión restaurado', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al restaurar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function buscarGestion()
    {
        if (isset($_GET['q'])) {
            $valor = $_GET['q'];
            $data = $this->model->buscarGestion($valor);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
}
