<?php
class UsuariosModel extends Query
{
    private $nombre, $apellido, $correo, $usuario, $clave, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }
    public function getUsuario(string $usuario, string $clave)
    {
        $sql = "SELECT u.*, r.* FROM usuario u INNER JOIN rol r ON u.id_rol=r.id_rol WHERE usuario_usuario = '$usuario' AND clave_usuario = '$clave' AND estado_usuario = 1";
        $data = $this->select($sql);
        return $data;
    }
    public function getUsuarios()
    {
        $sql = "SELECT u.*, r.nombre_rol FROM usuario u INNER JOIN rol r ON u.id_rol = r.id_rol";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarUsuario(string $nombre, string $apellido, string $correo, int $rol, string $usuario, string $clave)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->rol = $rol;
        $this->usuario = $usuario;
        $this->clave = $clave;
        $vericar = "SELECT * FROM usuario WHERE usuario_usuario = '$this->usuario'";
        $existe = $this->select($vericar);
        if (empty($existe)) {
            # code...
            $sql = "INSERT INTO usuario(nombre_usuario, apellido_usuario, correo_usuario, id_rol,  usuario_usuario, clave_usuario) VALUES (?,?,?,?,?,?)";
            $datos = array($this->nombre, $this->apellido, $this->correo, $this->rol, $this->usuario, $this->clave);
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
    public function modificarUsuario(string $nombre, string $apellido, string $correo, int $rol, string $usuario, int $id)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->rol = $rol;
        $this->usuario = $usuario;
        $this->id = $id;
        $sql = "UPDATE usuario SET nombre_usuario = ?, apellido_usuario = ?,  correo_usuario = ?, id_rol = ?,  usuario_usuario = ? WHERE id_usuario = ?";
        $datos = array($this->nombre, $this->apellido, $this->correo, $this->rol, $this->usuario, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editarUser(int $id)
    {
        $sql = "SELECT * FROM usuario WHERE id_usuario = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionUser(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE usuario SET estado_usuario = ? WHERE id_usuario = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }
    public function getPermisos()
    {
        $sql = "SELECT * FROM permisos";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getDetallePermisos(int $id)
    {
        $sql = "SELECT * FROM detalle_permisos WHERE id_usuario = $id";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function deletePermisos(int $id)
    {
        $sql = "DELETE FROM detalle_permisos WHERE id_usuario = ?";
        $datos = array($id);
        $data = $this->save($sql, $datos);
        return $data;
    }
    public function actualizarPermisos(int $usuario, int $permiso)
    {
        $sql = "INSERT INTO detalle_permisos(id_usuario, id_permiso) VALUES (?,?)";
        $datos = array($usuario, $permiso);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
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
    public function actualizarPass(string $clave, int $id)
    {
        $sql = "UPDATE usuario SET clave_usuario = ? WHERE id_usuario = ?";
        $datos = array($clave, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
}
