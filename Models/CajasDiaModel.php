<?php
class CajasDiaModel extends Query
{
    private $nombre, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }

    public function getVentas()
    {
        $sql = "SELECT c.*, u.id AS id_u, u.usuario FROM cierre_caja c INNER JOIN usuarios u ON u.id = c.id_usuario WHERE  YEAR(c.fecha_apertura) = YEAR(CURRENT_DATE())";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function calcularVenta()
    {
        $sql = "SELECT  subtotal, SUM(subtotal) AS total FROM venta WHERE DATE(fecha_venta) = CURDATE()";
        $data = $this->select($sql);
        return $data;
    }

    public function getEmpresa()
    {
        $sql = "SELECT * FROM configuracion";
        $data = $this->select($sql);
        return $data;
    }
    public function getdatos(int $id_usuario, string $fecha_apertura)
    {
        $sql = "SELECT d.*, u.id, u.usuario, d.total_ventas AS ventadia FROM cierre_caja d INNER JOIN usuarios u ON u.id = d.id_usuario  WHERE d.id_usuario = $id_usuario AND DATE(d.fecha_apertura) = DATE('$fecha_apertura')";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getProVenta(int $id_usuario, string $fecha_apertura)
    {
        $sql = "SELECT l.*,c.*, p.id, p.ncomercial, p.precio_venta, u.id, u.usuario FROM listaventas l  INNER JOIN venta c ON l.id = c.id_venta INNER JOIN productos p ON p.id = c.id_producto INNER JOIN usuarios u ON u.id = c.id_usuario WHERE c.id_usuario = $id_usuario AND DATE(c.fecha_venta) = DATE('$fecha_apertura') AND l.tarjeta = 'No'";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getProVentaIess(int $id_usuario, string $fecha_apertura)
    {
        $sql = "SELECT l.*,c.*, p.id, p.ncomercial, p.precio_venta, u.id, u.usuario FROM listaventas l  INNER JOIN venta c ON l.id = c.id_venta INNER JOIN productos p ON p.id = c.id_producto INNER JOIN usuarios u ON u.id = c.id_usuario WHERE c.id_usuario = $id_usuario AND DATE(c.fecha_venta) = DATE('$fecha_apertura') AND l.tarjeta = 'Si'";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getIess(int $id_usuario, string $fecha_apertura)
    {
        $sql = "SELECT l.*,c.*, p.id, p.ncomercial, p.precio_venta, u.id, u.usuario FROM listaventas l  INNER JOIN venta c ON l.id = c.id_venta INNER JOIN productos p ON p.id = c.id_producto INNER JOIN usuarios u ON u.id = c.id_usuario WHERE c.id_usuario = $id_usuario AND DATE(c.fecha_venta) = DATE('$fecha_apertura') AND l.seguro = 'Si'";
        $data = $this->selectAll($sql);
        return $data;
    }
}