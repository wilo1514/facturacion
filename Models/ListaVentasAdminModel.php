<?php
class ListaVentasAdminModel extends Query
{
    private $nombre, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }

    public function getVentas()
    {
        $sql = "SELECT d.*, p.id AS id_pro, p.ngenerico, p.ncomercial, m.id AS id_med, m.nombre AS nmedico, l.id AS id_listaventa, l.medico, l.seguro, c.id AS id_cli, c.nombre AS ncliente, u.id AS id_u, u.usuario FROM venta d INNER JOIN productos p ON d.id_producto = p.id INNER JOIN listaventas l ON l.id = d.id_venta INNER JOIN medicos m ON m.id = l.medico INNER JOIN clientes c ON c.id = l.id_cliente INNER JOIN usuarios u ON u.id = d.id_usuario";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function id_venta(int $id)
    {
        $sql = "SELECT id_venta AS idventa, cantidad AS cant, id_producto AS prod FROM venta WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function canProd(int $id)
    {
        $sql = "SELECT cantidad AS cantact FROM productos WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function canItem(int $item)
    {
        $sql = "SELECT id FROM venta WHERE id_venta = $item";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function eliminarLista(int $item)
    {
        $sql = "DELETE FROM listaventas WHERE id = ?";
        $datos = array($item);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function sumarCant(int $cantidad, int $id)
    {
        $this->id = $id;
        $this->cantidad = $cantidad;
        $sql = "UPDATE productos SET cantidad = ? WHERE id = ?";
        $datos = array($this->cantidad, $this->id);
        $data = $this->SAVE($sql, $datos);
        return $data;
    }
    public function anularV(int $id)
    {
        $sql = "DELETE  FROM venta WHERE id = ?";
        $datos = array($id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function verificarPermiso(int $id_usuario, string $nombre)
    {
        $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_usuario AND p.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
    }
}