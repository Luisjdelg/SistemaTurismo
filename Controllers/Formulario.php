<?php
class Formulario extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $id_user = $_SESSION['id_usuario'];
        $perm = $this->model->verificarPermisos($id_user, "Formulario");
        if (!$perm && $id_user != 1) {
            $this->views->getView($this, "permisos");
            exit;
        }
    }
    public function index()
    {
        $this->views->getView($this, "index");
    }
    //Listar Formulario
    public function listar()
    {
        $data = $this->model->getFormulario();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado_formulario'] == 1) {
                $data[$i]['estado_formulario'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarFormulario(' . $data[$i]['id_formulario'] . ');"><i class="fa fa-pencil-square-o"></i>Editar</button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarFormulario(' . $data[$i]['id_formulario'] . ');"><i class="fa fa-trash-o"></i>Eliminar</button>
                <div/>';
            } else {
                $data[$i]['estado_formulario'] = '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarFormulario(' . $data[$i]['id_formulario'] . ');"><i class="fa fa-reply-all"></i>Reingresar</button>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    //Registrar Formulario
    public function registrar()
    {
        $nombre_formulario = strClean($_POST['nombre_formulario']);
        $descripcion_formulario = strClean($_POST['descripcion_formulario']);
        $id_formulario = strClean($_POST['id_formulario']);

        if (empty($nombre_formulario)) {
            $msg = array('msg' => 'El nombre es requerido', 'icono' => 'warning');
        } else {
            if ($id_formulario == "") {
                $data = $this->model->insertarFormulario($nombre_formulario, $descripcion_formulario);
                if ($data != 0) {
                    $msg = array('msg' => $data, 'icono' => 'success');
                } else if ($data == "existe") {
                    $msg = array('msg' => 'La formulario ya existe', 'icono' => 'warning');
                } else {
                    $msg = array('msg' => 'Error al registrar', 'icono' => 'error');
                }
            } else {
                $data = $this->model->actualizarFormulario($nombre_formulario, $descripcion_formulario, $id_formulario);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Formulario modificado', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al modificar', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    //Seleccionar 
    public function editar($id_formulario)
    {
        $data = $this->model->editFormulario($id_formulario);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    //Eliminar 
    public function eliminar($id_formulario)
    {
        $data = $this->model->estadoFormulario(0, $id_formulario);
        if ($data == 1) {
            $msg = array('msg' => 'Formulario dado de baja', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    //Reingresar
    public function reingresar($id_formulario)
    {
        $data = $this->model->estadoFormulario(1, $id_formulario);
        if ($data == 1) {
            $msg = array('msg' => 'Formulario restaurado', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al restaurar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    //Buscar
    public function buscarFormulario()
    {
        if (isset($_GET['q'])) {
            $valor = $_GET['q'];
            $data = $this->model->buscarFormulario($valor);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    /*__________________________________________________Pregunta__________________________________________________*/
    //Listar 
    public function edit($id)
    {
        $preguntas = $this->model->selectPregunta($id);
        $categorias = $this->model->selectCategoria();
        $gestiones = $this->model->selectGestion();
        $formulario = $this->model->editFormulario($id);
        $data = ['formulario' => $formulario, 'preguntas' => $preguntas, 'categorias' => $categorias, 'gestiones' => $gestiones];
        $this->views->getView($this, "edit", $data);
    }
    //Cargar Datos Preguntas
    public function cargardatos()
    {
        $categorias = $this->model->selectCategoria();
        $gestiones = $this->model->selectGestion();
        $data = ['categorias' => $categorias, 'gestiones' => $gestiones];
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    //Registrar Pregunta
    public function registrarpregunta()
    {
        $id_pregunta = strClean($_POST['id_pregunta']);
        $nombre_pregunta = strClean($_POST['nombre_pregunta']);
        $id_categoria = strClean($_POST['id_categoria']);
        $id_gestion = strClean($_POST['id_gestion']);
        $id_formulario = strClean($_POST['id_formulario']);

        if (empty($nombre_pregunta || $id_pregunta || $id_categoria || $id_gestion || $id_formulario)) {
            $msg = array('msg' => 'El nombre es requerido', 'icono' => 'warning');
        } else {

            if ($id_pregunta == "") {
                $data = $this->model->insertarPregunta($nombre_pregunta, $id_categoria, $id_gestion, $id_formulario);
                if ($data == "ok") {
                    $msg = array('msg' => 'Pregunta registrada', 'icono' => 'success');
                } else if ($data == "existe") {
                    $msg = array('msg' => 'La Pregunta ya existe', 'icono' => 'warning');
                } else {
                    $msg = array('msg' => 'Error al registrar', 'icono' => 'error');
                }
            } else {
                $data = $this->model->actualizarPregunta($nombre_pregunta, $id_categoria, $id_gestion, $id_formulario, $id_pregunta);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Pregunta modificada', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al modificar', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    //Seleccionar pregunta para editar
    public function editarpregunta($id)
    {
        $data = $this->model->editPregunta($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function eliminarpregunta($id)
    {
        $id_pregunta = $id;
        $result = $this->model->deletePregunta($id_pregunta);
        if ($result) {
            $msg = array('msg' => 'Pregunta Eliminda', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
