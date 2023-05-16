<?php
require 'vendor/autoload.php';
use MongoDB\Client as Mongo;

class EvaluacionModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    //Seleccionar evaluación
    public function selectEvaluacion(int $id_evaluacion)
    {
        $sql = "SELECT p.*, c.*, es.*, e.* FROM evaluacion e INNER JOIN detalle d ON d.id_evaluacion=e.id_evaluacion INNER JOIN pregunta p ON p.id_pregunta=d.id_pregunta INNER JOIN criterio c ON c.id_criterio=d.id_criterio INNER JOIN establecimiento es ON es.id_establecimiento=e.id_establecimiento WHERE d.id_evaluacion=$id_evaluacion ORDER BY p.id_categoria";
        $res = $this->selectAll($sql);
        return $res;
    }
    //Sleccionar evaluación segun el usuario
    public function selectEvaluacion2(int $id_evaluacion, int $id_usuario)
    {
        $sql = "SELECT p.*, c.*, es.*, e.* FROM evaluacion e INNER JOIN detalle d ON d.id_evaluacion=e.id_evaluacion INNER JOIN pregunta p ON p.id_pregunta=d.id_pregunta INNER JOIN criterio c ON c.id_criterio=d.id_criterio INNER JOIN establecimiento es ON es.id_establecimiento=e.id_establecimiento WHERE d.id_evaluacion=$id_evaluacion and e.id_usuario=$id_usuario ORDER BY p.id_categoria";
        $res = $this->selectAll($sql);
        return $res;
    }
    //----------------Establecimiento----------------
    public function listEstablecmiento()
    {
        $sql = "SELECT * FROM establecimiento";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function selectEstablecimiento(int $id_establecimiento)
    {
        $sql = "SELECT e.*, r.* FROM establecimiento e INNER JOIN representante r ON r.id_representante=e.id_representante WHERE id_establecimiento = $id_establecimiento";
        $res = $this->select($sql);
        return $res;
    }
    //----------------Formulario----------------
    public function listFormulario()
    {
        $sql = "SELECT * FROM formulario";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function selectFormulario(int $id_formulario)
    {
        $sql = "SELECT * FROM formulario WHERE id_formulario = $id_formulario";
        $res = $this->select($sql);
        return $res;
    }
    //Listar Preguntas
    public function listPregunta(int $id_formulario)
    {
        $sql = "SELECT p.*, c.* FROM pregunta p INNER JOIN categoria c ON p.id_categoria=c.id_categoria WHERE id_formulario=$id_formulario ORDER BY p.id_categoria";
        $res = $this->selectAll($sql);
        return $res;
    }
    //Listar Criterios
    public function listCriterio()
    {
        $sql = "SELECT * FROM criterio WHERE estado_criterio=1";
        $res = $this->selectAll($sql);
        return $res;
    }

    //----------------Insertar evaluacion y detalles------------------
    public function insertarEvaluacion(int $id_formulario,  int $id_usuario, int $id_establecmiento)
    {
        $this->id_formulario = $id_formulario;
        $this->id_establecmiento = $id_establecmiento;
        $this->id_usuario = $id_usuario;
        $query = "INSERT INTO evaluacion(id_formulario, id_usuario, id_establecimiento, total, fecha) VALUES (?,?,?,100,CURDATE())";
        $datos = array($this->id_formulario, $this->id_usuario, $this->id_establecmiento);
        if ($result = $this->insert($query, $datos)) {
            return $result;
        }
    }
    public function insertarDetalle(int $id_evaluacion, int $id_pregunta,int $id_criterio)
    {
        $this->id_evaluacion = $id_evaluacion;
        $this->id_pregunta = $id_pregunta;
        $this->id_criterio = $id_criterio;
        $query = "INSERT INTO detalle(id_evaluacion, id_pregunta, id_criterio) VALUES (?,?,?)";
        $datos = array($this->id_evaluacion, $this->id_pregunta, $this->id_criterio);
        if ($result = $this->insert($query, $datos)) {
            return $result;
        }
    }
    //Eliminar Evaluacion
    public function deleteEvaluacion(int $id)
    {
        $query = "DELETE e.*, d.* FROM detalle d INNER JOIN evaluacion e ON d.id_evaluacion=e.id_evaluacion WHERE d.id_evaluacion ='$id'";
        $res = $this->delete($query);
        return $res;
    }
    //Seleccionar resumen
    public function selectResumen(int $id)
    {
        $sql = "SELECT c.nombre_categoria, (SUM(cr.valor_criterio)*100)/(COUNT(*)*10) total FROM detalle d INNER JOIN pregunta p ON p.id_pregunta=d.id_pregunta INNER JOIN categoria c ON c.id_categoria=p.id_categoria INNER JOIN criterio cr ON cr.id_criterio=d.id_criterio WHERE d.id_evaluacion=$id GROUP BY c.nombre_categoria";
        $res = $this->selectAll($sql);
        return $res;
    }
    //Verificar permisos 
    public function verificarPermisos($id_user, $permiso)
    {
        $tiene = false;
        $sql = "SELECT p.*, d.*, u.*, r.* FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso INNER JOIN rol r ON r.id_rol = d.id_rol INNER JOIN usuario u ON u.id_rol = r.id_rol WHERE u.id_usuario = $id_user AND p.nombre = '$permiso'";
        $existe = $this->select($sql);
        if ($existe != null || $existe != "") {
            $tiene = true;
        }
        return $tiene;
    }
}
