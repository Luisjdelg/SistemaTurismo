<?php
require 'vendor/autoload.php';
use MongoDB\Client as Mongo;
class FormularioModel extends Query
{

 

    public function __construct()
    {
        parent::__construct();
    }
    public function getFormulario()
    {
        $sql = "SELECT * FROM formulario";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function getGestiones()
    {
        //$sql = "SELECT * FROM gestion";
        $sql = "SELECT g.*, p.nombre_proceso FROM gestion g INNER JOIN proceso p ON g.id_proceso = p.id_proceso";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function selectCategoria()
    {
        $sql = "SELECT * FROM categoria";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function selectData()
    {
        $sql = "SELECT * FROM categoria";
        $sql2 = "SELECT * FROM gestion";
        $res = $this->selectAll($sql);
        $res2 = $this->selectAll($sql);
        return $res + $res2;
    }
    public function selectPregunta(int $id_formulario)
    {
        $sql = "SELECT p.*, c.nombre_categoria, g.nombre_gestion FROM pregunta p INNER JOIN categoria c ON p.id_categoria = c.id_categoria INNER JOIN gestion g ON p.id_gestion=g.id_gestion WHERE id_formulario=$id_formulario ORDER BY p.id_categoria ";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function selectGestion()
    {
        $sql = "SELECT * FROM gestion";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function insertarFormularios(String $nombre_formulario, String $descripcion_formulario)
    {
        $this->nombre_formulario = $nombre_formulario;
        $this->descripcion_formulario = $descripcion_formulario;
        $query = "INSERT INTO formulario(nombre_formulario, descripcion_formulario, fecha_formulario) VALUES (?,?,'02-02-2020')";
        $data = array($this->nombre_formulario, $this->descripcion_formulario);
        if ($result = $this->insert($query, $data)) {
            return $result;
        }
    }

    public function insertarFormulario(String $nombre_formulario, String $descripcion_formulario)
    {
        $this->nombre_formulario = $nombre_formulario;
        $this->descripcion_formulario = $descripcion_formulario;
        $verificar = "SELECT * FROM formulario WHERE nombre_formulario = '$this->nombre_formulario'";
        $existe = $this->select($verificar);
        if (empty($existe)) {

            $query = "INSERT INTO formulario(nombre_formulario, descripcion_formulario, fecha_formulario) VALUES (?,?,'02-02-2020')";
            $datos = array($this->nombre_formulario, $this->descripcion_formulario);
            //$data = $this->save($query, $datos);
            if ($result = $this->insert($query, $datos)) {
                return $result;
            }
        } else {
            $res = "existe";
        }
        return $res;
    }
    public function insertarPregunta(String $nombre_pregunta, int $categoria, int $gestion, int $formulario)
    {
        $this->nombre_pregunta = $nombre_pregunta;
        $this->id_categoria = $categoria;
        $this->id_gestion = $gestion;
        $this->id_formulario = $formulario;
        $query = "INSERT INTO pregunta (nombre_pregunta, id_categoria, id_gestion, id_formulario) VALUES (?,?,?,?)";
        $datos = array($this->nombre_pregunta, $this->id_categoria, $this->id_gestion, $this->id_formulario);
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editPregunta(int $id_pregunta)
    {
        $sql = "SELECT * FROM pregunta WHERE id_pregunta = $id_pregunta";
        $res = $this->select($sql);
        return $res;
    }
    public function actualizarPregunta(String $nombre_pregunta, int $categoria, int $gestion, int $formulario, int $id_pregunta)
    {
        $this->nombre_pregunta = $nombre_pregunta;
        $this->id_categoria = $categoria;
        $this->id_gestion = $gestion;
        $this->id_formulario = $formulario;
        $this->id_pregunta = $id_pregunta;
        $query = "UPDATE pregunta SET nombre_pregunta=?, id_categoria=?, id_gestion=?, id_formulario=? WHERE id_pregunta = ?";
        $datos = array($this->nombre_pregunta, $this->id_categoria, $this->id_gestion, $this->id_formulario, $this->id_pregunta);
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;

    }
    public function editFormulario(int $id_formulario)
    {
        $sql = "SELECT * FROM formulario WHERE id_formulario = $id_formulario";
        $res = $this->select($sql);
        return $res;
    }
    public function actualizarFormulario(String $nombre_formulario, String $descripcion_formulario, int $id_formulario)
    {
        $this->nombre_formulario = $nombre_formulario;
        $this->descripcion_formulario = $descripcion_formulario;
        $this->id_formulario = $id_formulario;
        $query = "UPDATE formulario SET nombre_formulario = ?, descripcion_formulario = ? WHERE id_formulario = ?";
        $data = array($this->nombre_formulario, $this->descripcion_formulario, $this->id_formulario);
        $this->save($query, $data);
        return true;
    }
    public function estadoFormulario(int $estado, int $id)
    {
        $this->estado = $estado;
        $this->id = $id;
        $query = "UPDATE formulario SET estado_formulario = ? WHERE id_formulario = ?";
        $data = array($this->estado, $this->id);
        $this->save($query, $data);
        return true;
    }
    public function deletePregunta(int $id)
    {
        $query = "DELETE FROM pregunta WHERE id_pregunta =$id";
        $res = $this->delete($query);
        return $res;
    }

    public function insertarGestion(string $nombre_gestion, int $id_proceso)
    {
        $this->nombre_gestion = $nombre_gestion;
        $this->id_proceso = $id_proceso;
        $verificar = "SELECT * FROM gestion WHERE nombre_gestion = '$this->nombre_gestion'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $query = "INSERT INTO gestion(nombre_gestion, id_proceso) VALUES (?,?)";
            $datos = array($this->nombre_gestion, $this->id_proceso);
            $data = $this->save($query, $datos);
            if ($data == 1) {
                $res = "ok";
            } else {
                $res = "error";
            }
        } else {
            $res = "existe";
        }
        return $res;
    }
    public function editGestion(int $id_gestion)
    {
        $sql = "SELECT * FROM gestion WHERE id_gestion = $id_gestion";
        $res = $this->select($sql);
        return $res;
    }
    public function actualizarGestion(string $nombre_gestion, int $id_proceso, int $id_gestion)
    {
        $this->nombre_gestion = $nombre_gestion;
        $this->id_proceso = $id_proceso;
        $this->id_gestion = $id_gestion;
        $query = "UPDATE gestion SET nombre_gestion = ?, id_proceso = ? WHERE id_gestion = ?";
        $datos = array($this->nombre_gestion, $this->id_proceso, $this->id_gestion);
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function estadoGestion(int $estado, int $id_gestion)
    {
        $this->estado = $estado;
        $this->id_gestion = $id_gestion;
        $query = "UPDATE gestion SET estado_gestion = ? WHERE id_gestion = ?";
        $datos = array($this->estado, $this->id_gestion);
        $data = $this->save($query, $datos);
        return $data;
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
    public function buscarGestion(string $valor)
    {
        $sql = "SELECT id_gestion, nombre_gestion AS text FROM gestion WHERE nombre_gestion LIKE '%" . $valor . "%'  AND estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
}
