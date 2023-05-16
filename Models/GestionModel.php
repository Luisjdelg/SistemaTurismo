<?php
class GestionModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getGestiones()
    {
        //$sql = "SELECT * FROM gestion";
        $sql = "SELECT g.*, p.nombre_proceso FROM gestion g INNER JOIN proceso p ON g.id_proceso = p.id_proceso";
        $res = $this->selectAll($sql);
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
