<?php
class Establecimiento extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $id_user = $_SESSION['id_usuario'];
        $perm = $this->model->verificarPermisos($id_user, "Establecimiento");
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
        $data = $this->model->getEstablecimiento();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado_establecimiento'] == 1) {
                $data[$i]['estado_establecimiento'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarEstablecimiento(' . $data[$i]['id_establecimiento'] . ');"><i class="fa fa-pencil-square-o"></i>Editar</button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarEstablecimiento(' . $data[$i]['id_establecimiento'] . ');"><i class="fa fa-trash-o"></i>Eliminar</button>
                <div/>';
            } else {
                $data[$i]['estado_establecimiento'] = '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarEstablecimiento(' . $data[$i]['id_establecimiento'] . ');"><i class="fa fa-reply-all"></i>Reingresar</button>
                <div/>';
            }
            if ($data[$i]['id_representante'] == 0) {
                $data[$i]['id_representante'] = '<span class="badge badge-danger">Representante sin Asignar</span>';
            } else {
                $data[$i]['id_representante'] = '<span class="badge badge-info">' . $data[$i]['nombre_representante'].'   '.$data[$i]['apellido_representante'] . '</span>';
            }


        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    
    public function registrar()
    {
        $nombre = strClean($_POST['nombre']);
        $direccion = strClean($_POST['direccion']);
        $representante = strClean($_POST['id_representante']);
        $id_establecimiento = strClean($_POST['id']);
        
        if (empty($nombre)) {
            $msg = array('msg' => 'El nombre es requerido', 'icono' => 'warning');
        } else {
            if ($id_establecimiento == "") {
                $data = $this->model->registrarEstablecimiento($nombre, $direccion, $representante);
                if ($data == "ok") {
                    $msg = array('msg' => 'Establecimiento registrado', 'icono' => 'success');
                } else if ($data == "existe") {
                    $msg = array('msg' => 'Ya exxiste un establecimiento', 'icono' => 'warning');
                } else {
                    $msg = array('msg' => 'Error al registrar', 'icono' => 'error');
                }
            } else {
                $data = $this->model->actualizarEstablecimiento($nombre, $direccion, $representante, $id_establecimiento);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Establecimiento modificado', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al modificar', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar($id_establecimiento)
    {
        $data = $this->model->editarEstablecimiento($id_establecimiento);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar($id_establecimiento)
    {
        $data = $this->model->estadoEstablecimiento(0, $id_establecimiento);

        if ($data == 1) {
            $msg = array('msg' => 'Establecimiento dado de baja', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar', 'icono' => 'error');
        }
        
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar($id_establecimiento)
    {
        $data = $this->model->estadoEstablecimiento(1, $id_establecimiento);
        if ($data == 1) {
            $msg = array('msg' => 'Establecimiento restaurado', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al restaurar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function buscarEstablecimiento()
    {
        if (isset($_GET['q'])) {
            $valor = $_GET['q'];
            $data = $this->model->buscarEstablecimiento($valor);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
}