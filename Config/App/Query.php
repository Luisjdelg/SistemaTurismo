<?php
class Query extends Conexion{
    private $pdo, $con, $sql, $datos;
    public function __construct() {
        $this->pdo = new Conexion();
        //$this->pdo2 = new ConexionMongo();

        $this->con = $this->pdo->conect();
       // $this->con2 = $this->pdo2->conect();

    }
    public function select(string $sql)
    {
        $this->sql = $sql;
        $resul = $this->con->prepare($this->sql);
        $resul->execute();
        $data = $resul->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    public function selectAll(string $sql)
    {
        $this->sql = $sql;
        $resul = $this->con->prepare($this->sql);
        $resul->execute();
        $data = $resul->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function selecTEstablecimientos(string $sql)
    {
        $this->sql = $sql;
        $resul = $this->con->prepare($this->sql);
        $resul->execute();
        $data = $resul->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function save(string $sql, array $datos)
    {
        $this->sql = $sql;
        $this->datos = $datos;
        $insert = $this->con->prepare($this->sql);
        $data = $insert->execute($this->datos);
        if ($data) {
            $res = 1;
        }else{
            $res = 0;
        }
        return $res;
    }
    public function insert(string $sql, array $datos)
    {
        $this->sql = $sql;
        $this->datos = $datos;
        $insert = $this->con->prepare($this->sql);
        $data = $insert->execute($this->datos);
        if ($data) {
            $res = $this->con->lastInsertId();;
        } else {
            $res = 0;
        }
        return $res;
    }

    public function delete(string $sql)
    {
        $this->sql = $sql;
        $delete = $this->con->prepare($this->sql);
        $res = $delete->execute();
        return $res;
    }
}


?>