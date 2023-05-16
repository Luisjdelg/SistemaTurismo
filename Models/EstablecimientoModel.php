<?php
class EstablecimientoModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getEstablecimientos()
    {
        $sql = "db. empleados .find( {} )";
        $res = $this->selecTEstablecimientos($sql);
        return $res;
    }
    public function getEstablecimiento()
    {
        $sql = "SELECT e.*, r.* FROM establecimiento e INNER JOIN representante r ON e.id_representante = r.id_representante";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarEstablecimiento(string $nombre_establecimiento, string $direccion_establecimiento, int $id_representante)
    {
        $this->nombre_establecimiento = $nombre_establecimiento;
        $this->direccion_establecimiento = $direccion_establecimiento;
        $this->id_representante = $id_representante;
        $verificar = "SELECT * FROM establecimiento WHERE nombre_establecimiento = '$this->nombre_establecimiento'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $query = "INSERT INTO establecimiento(nombre_establecimiento, direccion_establecimiento, id_representante) VALUES (?, ?, ?)";
            $datos = array($this->nombre_establecimiento, $this->direccion_establecimiento, $this->id_representante);
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
    public function editarEstablecimiento(int $id_establecimiento)
    {
        $sql = "SELECT * FROM establecimiento WHERE id_establecimiento = $id_establecimiento";
        $res = $this->select($sql);
        return $res;
    }
    public function actualizarEstablecimiento(string $nombre_establecimiento, string $direccion_establecimiento, int $id_representante, int $id_establecimiento)
    {
        $this->nombre_establecimiento = $nombre_establecimiento;
        $this->direccion_establecimiento = $direccion_establecimiento;
        $this->id_representante = $id_representante;
        $this->id_establecimiento = $id_establecimiento;
        $query = "UPDATE establecimiento SET nombre_establecimiento = ?, direccion_establecimiento = ?, id_representante = ? WHERE id_establecimiento = ?";
        $datos = array($this->nombre_establecimiento, $this->direccion_establecimiento, $this->id_representante, $this->id_establecimiento);
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function estadoEstablecimiento(int $estado, int $id_establecimiento)
    {
        $this->estado = $estado;
        $this->id_establecimiento = $id_establecimiento;
        $query = "UPDATE establecimiento SET estado_establecimiento = ? WHERE id_establecimiento = ?";
        $datos = array($this->estado, $this->id_establecimiento);
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
    public function buscarEstablecimiento(string $valor)
    {
        $sql = "SELECT id_establecimiento, nombre_establecimiento AS text FROM establecimiento WHERE nombre_establecimiento LIKE '%" . $valor . "%'  AND estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    
}
