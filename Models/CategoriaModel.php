<?php
class CategoriaModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getCategorias()
    {
        $sql = "SELECT * FROM categoria";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function insertarCategoria(string $nombre_categoria)
    {
        $this->nombre_categoria = $nombre_categoria;
        $verificar = "SELECT * FROM categoria WHERE nombre_categoria = '$this->nombre_categoria'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $query = "INSERT INTO categoria(nombre_categoria) VALUES (?)";
            $datos = array($this->nombre_categoria);
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
    public function editCategoria(int $id_categoria)
    {
        $sql = "SELECT * FROM categoria WHERE id_categoria = $id_categoria";
        $res = $this->select($sql);
        return $res;
    }
    public function actualizarCategoria(string $nombre_categoria, int $id_categoria)
    {
        $this->nombre_categoria = $nombre_categoria;
        $this->id_categoria = $id_categoria;
        $query = "UPDATE categoria SET nombre_categoria = ? WHERE id_categoria = ?";
        $datos = array($this->nombre_categoria, $this->id_categoria);
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function estadoCategoria(int $estado, int $id_categoria)
    {
        $this->estado = $estado;
        $this->id_categoria = $id_categoria;
        $query = "UPDATE categoria SET estado_categoria = ? WHERE id_categoria = ?";
        $datos = array($this->estado, $this->id_categoria);
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
    public function buscarCategoria(string $valor)
    {
        $sql = "SELECT id_categoria, nombre_categoria AS text FROM categoria WHERE nombre_categoria LIKE '%" . $valor . "%'  AND estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
}
