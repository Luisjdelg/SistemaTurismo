<?php
class RepresentanteModel extends Query
{
    private $nombre, $apellido, $correo, $representante, $direccion, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }
    public function getRepresentantes()
    {
        $sql = "SELECT * FROM representante";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarRepresentante(string $nombre, string $apellido, string $cedula, string $correo, string $telefono, string $direccion, int $usuario)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->cedula = $cedula;
        $this->correo = $correo;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->usuario = $usuario;
        $vericar = "SELECT * FROM representante WHERE cedula_representante = '$this->cedula'";
        $existe = $this->select($vericar);
        if (empty($existe)) {
            # code...
            $sql = "INSERT INTO representante(nombre_representante, apellido_representante, cedula_representante, correo_representante, telefono_representante, direccion_representante, id_usuario) VALUES (?,?,?,?,?,?,?)";
            $datos = array($this->nombre, $this->apellido, $this->cedula, $this->correo, $this->telefono, $this->direccion, $this->usuario);
            $data = $this->save($sql, $datos);
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
    public function modificarRepresentante(string $nombre, string $apellido, string $cedula, string $correo, string $telefono, string $direccion, int $usuario, int $id)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->cedula = $cedula;
        $this->correo = $correo;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->usuario = $usuario;
        $this->id = $id;
        $sql = "UPDATE representante SET nombre_representante = ?, apellido_representante = ?, cedula_representante = ?, correo_representante = ?, telefono_representante = ?, direccion_representante = ?,  id_usuario = ? WHERE id_representante = ?";
        $datos = array($this->nombre, $this->apellido, $this->cedula, $this->correo, $this->telefono, $this->direccion,$this->usuario, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editarRepresentante(int $id)
    {
        $sql = "SELECT * FROM representante WHERE id_representante = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function estadoRepresentante(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE representante SET estado_representante = ? WHERE id_representante = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
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

}
