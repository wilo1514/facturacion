<?php
class PresentacionesModel extends Query
{
    private $nombre, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }

    public function getPresentaciones()
    {
        $sql = "SELECT * FROM presentaciones";
        $data = $this->selectAll($sql);
        return $data;

    }
    public function registrarPresentacion(string $nombre)
    {
        $this->nombre = $nombre;
        $verificar = "SELECT * FROM presentaciones WHERE nombre = '$this->nombre'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO presentaciones(nombre) VALUES (?)";
            $datos = array($this->nombre);
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
    public function modificarPresentacion(string $nombre, int $id)
    {
        $this->nombre = $nombre;
        $this->id = $id;
        $sql = "UPDATE presentaciones SET nombre = ? WHERE id = ?";
        $datos = array($this->nombre, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editarPre(int $id)
    {
        $sql = "SELECT * FROM presentaciones WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionPre(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE presentaciones SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->SAVE($sql, $datos);
        return $data;
    }

}