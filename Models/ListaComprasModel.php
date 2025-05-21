<?php
class ListaComprasModel extends Query
{
    private $nombre, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }

    public function getCompras(int $id)
    {
        $sql = "SELECT  d.*, p.id AS id_pro, p.ngenerico, p.ncomercial FROM compra d INNER JOIN productos p ON d.id_producto = p.id WHERE d.id_usuario = $id";
        $data = $this->selectAll($sql);
        return $data;
    }
}