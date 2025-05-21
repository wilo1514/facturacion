<?php
class AdministracionModel extends Query
{
    private $nombre, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }
    public function getUsuario(string $usuario, string $clave)
    {
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";
        $data = $this->select($sql);
        return $data;

    }
    public function getDatos(string $tabla)
    {
        $sql = "SELECT COUNT(*) AS total FROM $tabla";
        $data = $this->select($sql);
        return $data;
    }

}