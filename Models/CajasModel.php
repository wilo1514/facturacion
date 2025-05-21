<?php
class CajasModel extends Query
{
    private $nombre, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }

    public function getVentas(int $id)
    {
        $sql = "SELECT d.*, p.id AS id_pro, p.ngenerico, p.ncomercial, m.id AS id_medico, m.nombre AS nmedico, l.id AS id_listaventa, l.medico, l.seguro, c.id AS id_cli, c.nombre AS ncliente FROM venta d INNER JOIN productos p ON d.id_producto = p.id INNER JOIN listaventas l ON l.id = d.id_venta INNER JOIN medicos m ON m.id = l.medico INNER JOIN clientes c ON c.id = l.id_cliente WHERE d.id_usuario = $id AND DATE(d.fecha_venta) = CURDATE()";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function calcularVenta(int $id_usuario)
    {
        $sql = "SELECT  subtotal, SUM(subtotal) AS total FROM venta WHERE id_usuario = $id_usuario AND DATE(fecha_venta) = CURDATE()";
        $data = $this->select($sql);
        return $data;
    }
    public function calcularVentaNorm(int $id_usuario)
    {
        $sql = "SELECT  v.subtotal, SUM(v.subtotal) AS total, l.id AS id_ven, l.seguro FROM venta v INNER JOIN listaventas l ON l.id = v.id_venta WHERE v.id_usuario = $id_usuario AND DATE(v.fecha_venta) = CURDATE() AND l.seguro = 'No'";
        $data = $this->select($sql);
        return $data;
    }

    public function calcularVentaIess(int $id_usuario)
    {
        $sql = "SELECT  v.subtotal, SUM(v.subtotal) AS total, l.id AS id_ven, l.seguro FROM venta v INNER JOIN listaventas l ON l.id = v.id_venta WHERE v.id_usuario = $id_usuario AND DATE(v.fecha_venta) = CURDATE() AND l.seguro = 'Si'";
        $data = $this->select($sql);
        return $data;
    }
    public function calcularVentaTarjeta(int $id_usuario)
    {
        $sql = "SELECT  v.subtotal, SUM(v.subtotal) AS total, l.id AS id_ven, l.seguro FROM venta v INNER JOIN listaventas l ON l.id = v.id_venta WHERE v.id_usuario = $id_usuario AND DATE(v.fecha_venta) = CURDATE() AND l.tarjeta = 'Si'";
        $data = $this->select($sql);
        return $data;
    }
    public function calcularVentaSinTarjeta(int $id_usuario)
    {
        $sql = "SELECT  v.subtotal, SUM(v.subtotal) AS total, l.id AS id_ven, l.seguro FROM venta v INNER JOIN listaventas l ON l.id = v.id_venta WHERE v.id_usuario = $id_usuario AND DATE(v.fecha_venta) = CURDATE() AND l.tarjeta = 'No'";
        $data = $this->select($sql);
        return $data;
    }
    public function verificarReporte(int $id_usuario)
    {
        $sql = "SELECT COUNT(*) AS numero FROM cierre_caja WHERE id_usuario = $id_usuario AND DATE(fecha_apertura) = CURDATE()";
        $data = $this->select($sql);
        return $data;
    }
    public function id_reporte(int $id_usuario)
    {
        $sql = "SELECT MAX(id) AS id FROM cierre_caja WHERE id_usuario = $id_usuario AND DATE(fecha_apertura) = CURDATE()";
        $data = $this->select($sql);
        return $data;
    }
    public function setDatos(string $monto_inicial, string $monto_final, string $subtotal_ventas, string $subtotal_iess, string $subtotal_tarjeta, string $subtotal_sin, string $total_ventas, string $observacion, int $id)
    {
        $sql = "UPDATE cierre_caja SET monto_inicial = ?, monto_final = ?, subtotal_ventas = ?, subtotal_iess = ?,subtotal_tarjeta = ?,subtotal_sin = ?, total_ventas = ?, observacion = ? WHERE id =?";
        $datos = array($monto_inicial, $monto_final, $subtotal_ventas, $subtotal_iess, $subtotal_tarjeta, $subtotal_sin, $total_ventas, $observacion, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function registrarReporte(int $id_usuario, string $monto_inicial, string $monto_final, string $subtotal_ventas, string $subtotal_iess, string $subtotal_tarjeta, string $subtotal_sin, string $total_ventas, string $observacion)
    {
        $sql = "INSERT INTO cierre_caja(id_usuario, monto_inicial, monto_final, subtotal_ventas, subtotal_iess,subtotal_tarjeta,subtotal_sin, total_ventas, observacion) VALUES (?,?,?,?,?,?,?,?,?)";
        $datos = array($id_usuario, $monto_inicial, $monto_final, $subtotal_ventas, $subtotal_iess, $subtotal_tarjeta, $subtotal_sin, $total_ventas, $observacion);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function getEmpresa()
    {
        $sql = "SELECT * FROM configuracion";
        $data = $this->select($sql);
        return $data;
    }
    public function getdatos(int $id_usuario)
    {
        $sql = "SELECT d.*, u.id, u.usuario, d.total_ventas AS ventadia FROM cierre_caja d INNER JOIN usuarios u ON u.id = d.id_usuario WHERE d.id_usuario = $id_usuario AND DATE(d.fecha_apertura) = CURDATE()";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getProVenta(int $id_usuario)
    {
        $sql = "SELECT l.*,c.*, p.id, p.ncomercial, p.precio_venta, u.id, u.usuario FROM listaventas l  INNER JOIN venta c ON l.id = c.id_venta INNER JOIN productos p ON p.id = c.id_producto INNER JOIN usuarios u ON u.id = c.id_usuario WHERE c.id_usuario = $id_usuario AND DATE(c.fecha_venta) = CURDATE() AND l.tarjeta = 'No'";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getProVentaIess(int $id_usuario)
    {
        $sql = "SELECT l.*,c.*, p.id, p.ncomercial, p.precio_venta, u.id, u.usuario FROM listaventas l  INNER JOIN venta c ON l.id = c.id_venta INNER JOIN productos p ON p.id = c.id_producto INNER JOIN usuarios u ON u.id = c.id_usuario WHERE c.id_usuario = $id_usuario AND DATE(c.fecha_venta) = CURDATE() AND l.tarjeta = 'Si'";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getIess(int $id_usuario)
    {
        $sql = "SELECT l.*,c.*, p.id, p.ncomercial, p.precio_venta, u.id, u.usuario FROM listaventas l  INNER JOIN venta c ON l.id = c.id_venta INNER JOIN productos p ON p.id = c.id_producto INNER JOIN usuarios u ON u.id = c.id_usuario WHERE c.id_usuario = $id_usuario AND DATE(c.fecha_venta) = CURDATE() AND l.seguro = 'Si'";
        $data = $this->selectAll($sql);
        return $data;
    }
}