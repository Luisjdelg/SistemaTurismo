<?php
require 'vendor/autoload.php';

class ReporteModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    //establecimiento
    public function listEstablecmiento()
    {
        $sql = "SELECT * FROM establecimiento";
        $res = $this->selectAll($sql);
        return $res;
    }
    //lista evaluacion
    public function listarEvaluacion(String $id)
    {
        $sql = "SELECT e.*, f.*, u.*, es.* FROM evaluacion  e INNER JOIN formulario f ON e.id_formulario=f.id_formulario INNER JOIN establecimiento es ON es.id_establecimiento=e.id_establecimiento INNER JOIN usuario u ON u.id_usuario=e.id_usuario WHERE e.id_establecimiento='$id'";
        $res = $this->selectAll($sql);
        return $res;
    }
    //Resumen total
    public function selectResumen(int $id)
    {
        $sql = "SELECT c.nombre_categoria, (SUM(cr.valor_criterio)*100)/(COUNT(*)*10) total FROM detalle d INNER JOIN pregunta p ON p.id_pregunta=d.id_pregunta INNER JOIN categoria c ON c.id_categoria=p.id_categoria INNER JOIN criterio cr ON cr.id_criterio=d.id_criterio WHERE d.id_evaluacion=$id GROUP BY c.nombre_categoria";
        $res = $this->selectAll($sql);
        return $res;
    }
    //select evaluacion
    public function selectEvaluacion(int $id_evaluacion)
    {
        $sql = "SELECT p.*, c.*, es.*, e.*, f.nombre_formulario FROM evaluacion e INNER JOIN detalle d ON d.id_evaluacion=e.id_evaluacion INNER JOIN pregunta p ON p.id_pregunta=d.id_pregunta INNER JOIN criterio c ON c.id_criterio=d.id_criterio INNER JOIN establecimiento es ON es.id_establecimiento=e.id_establecimiento INNER JOIN formulario f ON f.id_formulario=e.id_formulario WHERE d.id_evaluacion=$id_evaluacion ORDER BY p.id_categoria";
        $res = $this->selectAll($sql);
        return $res;
    }
    //crierio
    public function listCriterio()
    {
        $sql = "SELECT * FROM criterio";
        $res = $this->selectAll($sql);
        return $res;
    }
    //establecimiento
    public function selectEstablecimiento(int $id_establecimiento)
    {
        $sql = "SELECT e.*, r.* FROM establecimiento e INNER JOIN representante r ON r.id_representante=e.id_representante WHERE e.id_establecimiento = $id_establecimiento";
        $res = $this->select($sql);
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
}
