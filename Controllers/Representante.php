<?php
class Representante extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $id_user = $_SESSION['id_usuario'];
        $perm = $this->model->verificarPermisos($id_user, "Representante");
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
        $data = $this->model->getRepresentantes();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function listar()
    {
        $data = $this->model->getRepresentantes();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado_representante'] == 1) {
                $data[$i]['estado_representante'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarRepresentante(' . $data[$i]['id_representante'] . ');"><i class="fa fa-pencil-square-o"></i>Editar</button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarRepresentante(' . $data[$i]['id_representante'] . ');"><i class="fa fa-trash-o"></i>Eliminar</button>
                <div/>';
            } else {
                $data[$i]['estado_representante'] = '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarRepresentante(' . $data[$i]['id_representante'] . ');"><i class="fa fa-reply-all"></i>Reingresar</button>
                <div/>';
            }
            if ($data[$i]['id_usuario'] == 0) {
                $data[$i]['id_usuario'] = '<span class="badge badge-danger">Usuario sin Asignar</span>';
            } else {
                $data[$i]['id_usuario'] = '<span class="badge badge-success">Usuario Asignado</span>';
            }


        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    
    public function registrar()
    {
        $nombre = strClean($_POST['nombre']);
        $apellido = strClean($_POST['apellido']);
        $cedula = strClean($_POST['cedula']);
        $correo = strClean($_POST['correo']);
        $telefono = strClean($_POST['telefono']);
        $direccion = strClean($_POST['direccion']);
        $usuario = strClean($_POST['id_usuario']);
        $id_representante = strClean($_POST['id']);
        
        if (empty($nombre)) {
            $msg = array('msg' => 'El nombre es requerido', 'icono' => 'warning');
        } else {
            if ($id_representante == "") {
                $data = $this->model->registrarRepresentante($nombre, $apellido, $cedula, $correo, $telefono, $direccion, $usuario);
                if ($data == "ok") {
                    $msg = array('msg' => 'Representante registrado', 'icono' => 'success');
                } else if ($data == "existe") {
                    $msg = array('msg' => 'Ya existe un representante registrado con el numero de cedula ingresado', 'icono' => 'warning');
                } else {
                    $msg = array('msg' => 'Error al registrar', 'icono' => 'error');
                }
            } else {
                $data = $this->model->modificarRepresentante($nombre, $apellido, $cedula, $correo, $telefono, $direccion, $usuario, $id_representante);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Representante modificado', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al modificar', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar($id_representante)
    {
        $data = $this->model->editarRepresentante($id_representante);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar($id_representante)
    {
        $data = $this->model->estadoRepresentante(0, $id_representante);

        if ($data == 1) {
            $msg = array('msg' => 'Representante dado de baja', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar', 'icono' => 'error');
        }
        
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar($id_representante)
    {
        $data = $this->model->estadoRepresentante(1, $id_representante);
        if ($data == 1) {
            $msg = array('msg' => 'Representante restaurado', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al restaurar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function buscarRepresentante()
    {
        if (isset($_GET['q'])) {
            $valor = $_GET['q'];
            $data = $this->model->buscarRepresentante($valor);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
}