<?php
class CriterioModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getCriterios()
    {
        $sql = "SELECT * FROM criterio";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function insertarCriterio(int $valor_criterio, string $identificacion_criterio, string $fase_criterio, string $nombre_criterio)
    {
        $this->valor_criterio = $valor_criterio;
        $this->identificacion_criterio = $identificacion_criterio;
        $this->fase_criterio = $fase_criterio;
        $this->nombre_criterio = $nombre_criterio;

        $verificar = "SELECT * FROM criterio WHERE nombre_criterio = '$this->nombre_criterio'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $query = "INSERT INTO criterio(valor_criterio, identificacion_criterio, fase_criterio, nombre_criterio) VALUES (?, ?, ?, ?)";
            $datos = array($this->valor_criterio, $this->identificacion_criterio, $this->fase_criterio, $this->nombre_criterio);
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
    public function editCriterio(int $id_criterio)
    {
        $sql = "SELECT * FROM criterio WHERE id_criterio = $id_criterio";
        $res = $this->select($sql);
        return $res;
    }
    public function actualizarCriterio(int $valor_criterio, string $identificacion_criterio, string $fase_criterio, string $nombre_criterio, int $id_criterio)
    {
        $this->id_criterio = $id_criterio;
        $this->valor_criterio = $valor_criterio;
        $this->identificacion_criterio = $identificacion_criterio;
        $this->fase_criterio = $fase_criterio;
        $this->nombre_criterio = $nombre_criterio;
        $query = "UPDATE criterio SET valor_criterio = ?, identificacion_criterio = ?, fase_criterio = ?, nombre_criterio = ? WHERE id_criterio = ?";
        $datos = array($this->valor_criterio, $this->identificacion_criterio, $this->fase_criterio, $this->nombre_criterio, $this->id_criterio);
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function estadoCriterio(int $estado, int $id_criterio)
    {
        $this->estado = $estado;
        $this->id_criterio = $id_criterio;
        $query = "UPDATE criterio SET estado_criterio = ? WHERE id_criterio = ?";
        $datos = array($this->estado, $this->id_criterio);
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
    public function buscarCriterio(string $valor)
    {
        $sql = "SELECT id_criterio, nombre_criterio AS text FROM criterio WHERE nombre_criterio LIKE '%" . $valor . "%'  AND estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
}
