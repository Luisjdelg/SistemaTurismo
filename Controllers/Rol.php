<?php
class Rol extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $id_user = $_SESSION['id_usuario'];

        $perm = $this->model->verificarPermisos($id_user, "Rol");
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
        $data = $this->model->getRol();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function listar()
    {
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        $data = $this->model->getRol();
        for ($i=0; $i < count($data); $i++) { 
            if ($data[$i]['estado_rol'] == 1) {
                if ($data[$i]['id_rol'] != 1) {
                    $data[$i]['estado_rol'] = '<span class="badge badge-success">Activo</span>';
                    $data[$i]['acciones'] = '<div>
                    <button class="btn btn-dark" onclick="btnRoles(' . $data[$i]['id_rol'] . ')"><i class="fa fa-key"></i></button>
                    <button class="btn btn-primary" type="button" onclick="btnEditarRol(' . $data[$i]['id_rol'] . ');"><i class="fa fa-pencil-square-o"></i>Editar</button>
                    <button class="btn btn-danger" type="button" onclick="btnEliminarRol(' . $data[$i]['id_rol'] . ');"><i class="fa fa-trash-o"></i>Eliminar</button>
                    <div/>';
                }else{
                    $data[$i]['estado_rol'] = '<span class="badge badge-success">Activo</span>';
                    $data[$i]['acciones'] = '<div class"text-center">
                    <span class="badge-primary p-1 rounded">Super Administrador</span>
                    </div>'; 
                }
            }else {
                $data[$i]['estado_rol'] = '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarRol(' . $data[$i]['id_rol'] . ');"><i class="fa fa-reply-all"></i>Reingresar</button>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
        $nombre_rol = strClean($_POST['nombre_rol']);
        $id_rol = strClean($_POST['id_rol']);
        if (empty($nombre_rol)) {
            $msg = array('msg' => 'El nombre es requerido', 'icono' => 'warning');
        } else {
            if ($id_rol == "") {
                $data = $this->model->insertarRol($nombre_rol);
                if ($data == "ok") {
                    $msg = array('msg' => 'Rol registrado', 'icono' => 'success');
                } else if ($data == "existe") {
                    $msg = array('msg' => 'La cateoria ya existe', 'icono' => 'warning');
                } else {
                    $msg = array('msg' => 'Error al registrar', 'icono' => 'error');
                }
            } else {
                $data = $this->model->actualizarRol($nombre_rol, $id_rol);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Rol modificado', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al modificar', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar($id_rol)
    {
        $data = $this->model->editRol($id_rol);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar($id_rol)
    {
        $data = $this->model->estadoRol(0, $id_rol);
        if ($data == 1) {
            $msg = array('msg' => 'Rol dado de baja', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar($id_rol)
    {
        $data = $this->model->estadoRol(1, $id_rol);
        if ($data == 1) {
            $msg = array('msg' => 'Rol restaurado', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al restaurar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function buscarRol()
    {
        if (isset($_GET['q'])) {
            $valor = $_GET['q'];
            $data = $this->model->buscarRol($valor);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
    public function permisos($id)
    {
        $id_user = $_SESSION['id_usuario'];
        $perm = $this->model->verificarPermisos($id_user, "roles");
        if (!$perm && $id_user != 1) {
            echo '<div class="card">
                    <div class="card-body text-center">
                        <span class="badge badge-danger">No tienes permisos</span>
                    </div>
                </div>';
            exit;
        }
        $data = $this->model->getPermisos();
        $asignados = $this->model->getDetallePermisos($id);
        $datos = array();
        foreach ($asignados as $asignado) {
            $datos[$asignado['id_permiso']] = true;
        }
        echo '<div class="row">
        <input type="hidden" name="id_rol" value="' . $id . '">';
        foreach ($data as $row) {
            echo '<div class="d-inline mx-3 text-center">
                    <hr>
                    <label for="" class="font-weight-bold text-capitalize">' . $row['nombre'] . '</label>
                        <div class="center">
                            <input type="checkbox" name="permisos[]" value="' . $row['id'] . '" ';
            if (isset($datos[$row['id']])) {
                echo "checked";
            }
            echo '>
                            <span class="span">On</span>
                            <span class="span">Off</span>
                        </div>
                </div>';
        }
        echo '</div>
        <button class="btn btn-primary mt-3 btn-block" type="button" onclick="registrarPermisos(event);">Actualizar</button>';
        die();
    }
    public function registrarPermisos()
    {
        $id_rol = strClean($_POST['id_rol']);
        $this->model->deletePermisos($id_rol);
        if (!empty($_POST['permisos'])) {
            $permisos = $_POST['permisos'];
            foreach ($permisos as $permiso) {
                $this->model->actualizarPermisos($id_rol, $permiso);
            }
        }
        echo json_encode("ok");
        die();
    }
}
