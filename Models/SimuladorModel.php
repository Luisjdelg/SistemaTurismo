<?php
require 'vendor/autoload.php';
use MongoDB\Client as Mongo;

class SimuladorModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getSimulacion()
    {
        $sql = "SELECT * FROM simulacion";
        $res = $this->selectAll($sql);
        return $res;
    }

    public function listarSimulacion(String $id)
    {
        $sql = "SELECT e.*, f.* FROM simulacion  e INNER JOIN formulario f ON e.id_formulario=f.id_formulario WHERE e.id_establecimiento='$id'";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function listPregunta(int $id_formulario)
    {
        $sql = "SELECT p.*, c.* FROM pregunta p INNER JOIN categoria c ON p.id_categoria=c.id_categoria WHERE id_formulario=$id_formulario ORDER BY p.id_categoria";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function listCriterio()
    {
        $sql = "SELECT * FROM criterio WHERE estado_criterio=1";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function listFormulario()
    {
        $sql = "SELECT * FROM formulario";
        $res = $this->selectAll($sql);
        return $res;
    }

    public function listCategoria()
    {
        $sql = "SELECT * FROM categoria ORDER BY id_categoria";
        $res = $this->selectAll($sql);
        return $res;
    }

    public function selectResumen(int $id)
    {
        $sql = "SELECT c.nombre_categoria, (SUM(cr.valor_criterio)*100)/(COUNT(*)*10) total FROM detalle_simulacion d INNER JOIN pregunta p ON p.id_pregunta=d.id_pregunta INNER JOIN categoria c ON c.id_categoria=p.id_categoria INNER JOIN criterio cr ON cr.id_criterio=d.id_criterio WHERE d.id_simulacion=$id GROUP BY c.nombre_categoria";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function selectSimulacion(int $id_simulacion)
    {
        $sql = "SELECT p.*, c.*, es.*, s.* FROM simulacion s INNER JOIN detalle_simulacion d ON d.id_simulacion=s.id_simulacion INNER JOIN pregunta p ON p.id_pregunta=d.id_pregunta INNER JOIN criterio c ON c.id_criterio=d.id_criterio INNER JOIN establecimiento es ON es.id_establecimiento=s.id_establecimiento WHERE d.id_simulacion=$id_simulacion ORDER BY p.id_categoria";
        $res = $this->selectAll($sql);
        return $res;
    }

    public function selectEstablecmiento($id)
    {
        $sql = "SELECT e.*, r.*, u.* FROM establecimiento e INNER JOIN representante r ON e.id_representante=r.id_representante INNER JOIN usuario u ON r.id_usuario=u.id_usuario WHERE r.id_usuario =$id";
        $res = $this->select($sql);
        return $res;
    }
    
    public function selectedSimulacion(int $id_establecimiento)
    {
        $sql = "SELECT eva.*, f.*, u.* FROM simulacion eva INNER JOIN formulario f ON f.id_formulario = eva.id_formulario  INNER JOIN usuario u ON u.id_usuario = eva.id_usuario WHERE eva.id_establecimiento=$id_establecimiento ORDER BY eva.fecha";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function selectFormulario(int $id_formulario)
    {
        $sql = "SELECT * FROM formulario WHERE id_formulario = $id_formulario";
        $res = $this->select($sql);
        return $res;
    }
    public function selectEstablecimiento(int $id_establecimiento)
    {
        $sql = "SELECT * FROM establecimiento WHERE id_establecimiento = $id_establecimiento";
        $res = $this->select($sql);
        return $res;
    }
    //CRUD Simulacion
    public function insertarSimulacion(int $formulario,  int $usuario, int $establecimiento)
    {
        $this->id_formulario = $formulario;
        $this->id_establecimiento = $establecimiento;
        $this->id_usuario = $usuario;
        $query = "INSERT INTO simulacion(id_formulario, id_usuario, id_establecimiento, total_simulacion, fecha_simulacion) VALUES (?,?,?,100,CURDATE())";
        $datos = array($this->id_formulario, $this->id_usuario, $this->id_establecimiento);
        if ($result = $this->insert($query, $datos)) {
            return $result;
        }
    }
    public function insertarDetalle(int $simulacion, int $pregunta,int $criterio)
    {
        $this->id_simulacion = $simulacion;
        $this->id_pregunta = $pregunta;
        $this->id_criterio = $criterio;
        $query = "INSERT INTO detalle_simulacion(id_simulacion, id_pregunta, id_criterio) VALUES (?,?,?)";
        $datos = array($this->id_simulacion, $this->id_pregunta, $this->id_criterio);
        if ($result = $this->insert($query, $datos)) {
            return $result;
        }
    }
    
    public function editSimulacion(int $id_simulacion)
    {
        $sql = "SELECT * FROM simulacion WHERE id_simulacion = $id_simulacion";
        $res = $this->select($sql);
        return $res;
    }
    public function actualizarSimulacion(String $nombre_simulacion, String $descripcion_simulacion, int $id_simulacion)
    {
        $this->nombre_simulacion = $nombre_simulacion;
        $this->descripcion_simulacion = $descripcion_simulacion;
        $this->id_simulacion = $id_simulacion;
        $query = "UPDATE simulacion SET nombre_simulacion = ?, descripcion_simulacion = ? WHERE id_simulacion = ?";
        $data = array($this->nombre_simulacion, $this->descripcion_simulacion, $this->id_simulacion);
        $this->save($query, $data);
        return true;
    }
    public function estadoSimulacion(int $estado, int $id)
    {
        $this->estado = $estado;
        $this->id = $id;
        $query = "UPDATE simulacion SET estado_simulacion = ? WHERE id_simulacion = ?";
        $data = array($this->estado, $this->id);
        $this->save($query, $data);
        return true;
    }
    public function deleteSimulacion(int $id)
    {
        $query = "DELETE e.*, d.* FROM detalle_simulacion d INNER JOIN simulacion e ON d.id_simulacion=e.id_simulacion WHERE d.id_simulacion ='$id'";
        $res = $this->delete($query);
        return $res;
    }

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
    public function contarPreguntas(int $id_formulario)
    {
        $sql = "SELECT COUNT(*) total_preguntas FROM pregunta p WHERE p.id_formulario=$id_formulario";
        $res = $this->selectAll($sql);
        return $res;
    }
    
}
