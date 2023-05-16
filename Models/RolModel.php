<?php
class RolModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getRol()
    {
        $sql = "SELECT * FROM rol WHERE estado_rol=1";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function insertarRol(string $nombre_rol)
    {
        $this->nombre_rol = $nombre_rol;
        $verificar = "SELECT * FROM rol WHERE nombre_rol = '$this->nombre_rol'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $query = "INSERT INTO rol(nombre_rol) VALUES (?)";
            $datos = array($this->nombre_rol);
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
    public function editRol(int $id_rol)
    {
        $sql = "SELECT * FROM rol WHERE id_rol = $id_rol";
        $res = $this->select($sql);
        return $res;
    }
    public function actualizarRol(string $nombre_rol, int $id_rol)
    {
        $this->nombre_rol = $nombre_rol;
        $this->id_rol = $id_rol;
        $query = "UPDATE rol SET nombre_rol = ? WHERE id_rol = ?";
        $datos = array($this->nombre_rol, $this->id_rol);
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function estadoRol(int $estado, int $id_rol)
    {
        $this->estado = $estado;
        $this->id_rol = $id_rol;
        $query = "UPDATE rol SET estado_rol = ? WHERE id_rol = ?";
        $datos = array($this->estado, $this->id_rol);
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
    public function buscarRol(string $valor)
    {
        $sql = "SELECT id_rol, nombre_rol AS text FROM rol WHERE nombre_rol LIKE '%" . $valor . "%'  AND estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getPermisos()
    {
        $sql = "SELECT * FROM permisos";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getDetallePermisos(int $rol)
    {
        $sql = "SELECT * FROM detalle_permisos WHERE id_rol = $rol";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function deletePermisos(int $rol)
    {
        $sql = "DELETE FROM detalle_permisos WHERE id_rol = ?";
        $datos = array($rol);
        $data = $this->save($sql, $datos);
        return $data;
    }
    public function actualizarPermisos(int $rol, int $permiso)
    {
        $sql = "INSERT INTO detalle_permisos(id_rol, id_permiso) VALUES (?,?)";
            $datos = array($rol, $permiso);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "ok";
            } else {
                $res = "error";
            }
        return $res;
    }
}
