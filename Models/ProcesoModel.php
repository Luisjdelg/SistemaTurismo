<?php
class ProcesoModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getProcesos()
    {
        $sql = "SELECT * FROM proceso";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function insertarProceso(string $nombre_proceso)
    {
        $this->nombre_proceso = $nombre_proceso;
        $verificar = "SELECT * FROM proceso WHERE nombre_proceso = '$this->nombre_proceso'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $query = "INSERT INTO proceso(nombre_proceso) VALUES (?)";
            $datos = array($this->nombre_proceso);
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
    public function editProceso(int $id_proceso)
    {
        $sql = "SELECT * FROM proceso WHERE id_proceso = $id_proceso";
        $res = $this->select($sql);
        return $res;
    }
    public function actualizarProceso(string $nombre_proceso, int $id_proceso)
    {
        $this->nombre_proceso = $nombre_proceso;
        $this->id_proceso = $id_proceso;
        $query = "UPDATE proceso SET nombre_proceso = ? WHERE id_proceso = ?";
        $datos = array($this->nombre_proceso, $this->id_proceso);
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function estadoProceso(int $estado, int $id_proceso)
    {
        $this->estado = $estado;
        $this->id_proceso = $id_proceso;
        $query = "UPDATE proceso SET estado_proceso = ? WHERE id_proceso = ?";
        $datos = array($this->estado, $this->id_proceso);
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
    public function buscarProceso(string $valor)
    {
        $sql = "SELECT id_proceso, nombre_proceso AS text FROM proceso WHERE nombre_proceso LIKE '%" . $valor . "%'  AND estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
}
