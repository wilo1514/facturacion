<?php
class CajasAdModel extends Query
{
    private $nombre, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }

    public function getVentas()
    {
        $sql = "SELECT d.*, p.id AS id_pro, p.ngenerico, p.ncomercial, m.id AS id_med, m.nombre AS nmedico, l.id AS id_listaventa, l.medico, l.seguro, c.id AS id_cli, c.nombre AS ncliente, u.id AS id_u, u.usuario FROM venta d INNER JOIN productos p ON d.id_producto = p.id INNER JOIN listaventas l ON l.id = d.id_venta INNER JOIN medicos m ON m.id = l.medico INNER JOIN clientes c ON c.id = l.id_cliente INNER JOIN usuarios u ON u.id = d.id_usuario WHERE YEAR(d.fecha_venta) = YEAR(CURRENT_DATE()) AND MONTH(d.fecha_venta) = MONTH(CURRENT_DATE())";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function calcularVenta()
    {
        $sql = "SELECT  subtotal, SUM(subtotal) AS total FROM venta WHERE YEAR(fecha_venta) = YEAR(CURRENT_DATE()) AND MONTH(fecha_venta) = MONTH(CURRENT_DATE())";
        $data = $this->select($sql);
        return $data;
    }
    public function getEmpresa()
    {
        $sql = "SELECT * FROM configuracion";
        $data = $this->select($sql);
        return $data;
    }
    public function getdatos()
    {
        $sql = "SELECT l.*,c.*,d.*, p.id, p.ncomercial, p.precio_venta, u.id, u.usuario, d.total_ventas AS ventadia FROM listaventas l  INNER JOIN venta c ON l.id = c.id_venta INNER JOIN productos p ON p.id = c.id_producto INNER JOIN cierre_caja d ON d.id_usuario = c.id_usuario INNER JOIN usuarios u ON u.id = c.id_usuario WHERE YEAR(c.fecha_venta) = YEAR(CURRENT_DATE()) AND MONTH(c.fecha_venta) = MONTH(CURRENT_DATE())";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getProVenta()
    {
        $sql = "SELECT l.*,c.*, p.id, p.ncomercial, p.precio_venta, u.id, u.usuario FROM listaventas l  INNER JOIN venta c ON l.id = c.id_venta INNER JOIN productos p ON p.id = c.id_producto INNER JOIN usuarios u ON u.id = c.id_usuario WHERE YEAR(c.fecha_venta) = YEAR(CURRENT_DATE()) AND MONTH(c.fecha_venta) = MONTH(CURRENT_DATE()) AND l.tarjeta = 'No'";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getProVentaTarjeta()
    {
        $sql = "SELECT l.*,c.*, p.id, p.ncomercial, p.precio_venta, u.id, u.usuario FROM listaventas l  INNER JOIN venta c ON l.id = c.id_venta INNER JOIN productos p ON p.id = c.id_producto INNER JOIN usuarios u ON u.id = c.id_usuario WHERE YEAR(c.fecha_venta) = YEAR(CURRENT_DATE()) AND MONTH(c.fecha_venta) = MONTH(CURRENT_DATE()) AND l.tarjeta = 'Si'";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getProVentaIess()
    {
        $sql = "SELECT l.*,c.*, p.id, p.ncomercial, p.precio_venta, u.id, u.usuario FROM listaventas l  INNER JOIN venta c ON l.id = c.id_venta INNER JOIN productos p ON p.id = c.id_producto INNER JOIN usuarios u ON u.id = c.id_usuario WHERE YEAR(c.fecha_venta) = YEAR(CURRENT_DATE()) AND MONTH(c.fecha_venta) = MONTH(CURRENT_DATE()) AND l.seguro = 'Si'";
        $data = $this->selectAll($sql);
        return $data;
    }
}