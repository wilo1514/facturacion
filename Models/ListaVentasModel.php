<?php
class ListaVentasModel extends Query
{
    private $nombre, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }

    public function getVentas(int $id)
    {
        $sql = "SELECT d.*, p.id AS id_pro, p.ngenerico, p.ncomercial, m.id AS id_medico, m.nombre AS nmedico, l.id AS id_listaventa, l.medico, l.seguro, c.id AS id_cli, c.nombre AS ncliente FROM venta d INNER JOIN productos p ON d.id_producto = p.id INNER JOIN listaventas l ON l.id = d.id_venta INNER JOIN medicos m ON m.id = l.medico INNER JOIN clientes c ON c.id = l.id_cliente WHERE d.id_usuario = $id";
        $data = $this->selectAll($sql);
        return $data;
    }
}