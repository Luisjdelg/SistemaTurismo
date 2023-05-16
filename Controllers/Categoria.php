<?php
class Categoria extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $id_user = $_SESSION['id_usuario'];
        $perm = $this->model->verificarPermisos($id_user, "Categoria");
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
        $data = $this->model->getCategorias();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado_categoria'] == 1) {
                $data[$i]['estado_categoria'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarCategoria(' . $data[$i]['id_categoria'] . ');"><i class="fa fa-pencil-square-o"></i>Editar</button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarCategoria(' . $data[$i]['id_categoria'] . ');"><i class="fa fa-trash-o"></i>Eliminar</button>
                <div/>';
            } else {
                $data[$i]['estado_categoria'] = '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarCategoria(' . $data[$i]['id_categoria'] . ');"><i class="fa fa-reply-all"></i>Reingresar</button>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        $nombre_categoria = strClean($_POST['nombre_categoria']);
        $id_categoria = strClean($_POST['id_categoria']);
        if (empty($nombre_categoria)) {
            $msg = array('msg' => 'El nombre es requerido', 'icono' => 'warning');
        } else {
            if ($id_categoria == "") {
                $data = $this->model->insertarCategoria($nombre_categoria);
                if ($data == "ok") {
                    $msg = array('msg' => 'Categoría registrada', 'icono' => 'success');
                } else if ($data == "existe") {
                    $msg = array('msg' => 'La cateoria ya existe', 'icono' => 'warning');
                } else {
                    $msg = array('msg' => 'Error al registrar', 'icono' => 'error');
                }
            } else {
                $data = $this->model->actualizarCategoria($nombre_categoria, $id_categoria);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Categoría modificada', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al modificar', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar($id_categoria)
    {
        $data = $this->model->editCategoria($id_categoria);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar($id_categoria)
    {
        $data = $this->model->estadoCategoria(0, $id_categoria);

        if ($data == 1) {
            $msg = array('msg' => 'Categoría dada de baja', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar', 'icono' => 'error');
        }
        
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar($id_categoria)
    {
        $data = $this->model->estadoCategoria(1, $id_categoria);
        if ($data == 1) {
            $msg = array('msg' => 'Categoría restaurada', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al restaurar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function buscarCategoria()
    {
        if (isset($_GET['q'])) {
            $valor = $_GET['q'];
            $data = $this->model->buscarCategoria($valor);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
}
