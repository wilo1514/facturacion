<?php
class MedicosModel extends Query
{
    private $dni, $nombre, $telefono, $direccion, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }

    public function getMedicos()
    {
        $sql = "SELECT * FROM medicos";
        $data = $this->selectAll($sql);
        return $data;

    }
    public function registrarMedico(string $dni, string $nombre, string $telefono, string $direccion)
    {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $verificar = "SELECT * FROM medicos WHERE dni = '$this->dni'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO medicos(dni, nombre, telefono, direccion) VALUES (?,?,?,?)";
            $datos = array($this->dni, $this->nombre, $this->telefono, $this->direccion);
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
    public function modificarMedico(string $dni, string $nombre, string $telefono, string $direccion, int $id)
    {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->id = $id;
        $sql = "UPDATE medicos SET dni = ?, nombre = ?, telefono = ?, direccion = ? WHERE id = ?";
        $datos = array($this->dni, $this->nombre, $this->telefono, $this->direccion, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editarMed(int $id)
    {
        $sql = "SELECT * FROM medicos WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionMed(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE medicos SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->SAVE($sql, $datos);
        return $data;
    }

}